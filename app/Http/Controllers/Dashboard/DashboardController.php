<?php

namespace App\Http\Controllers\Dashboard;

use Carbon\Carbon;
use App\Models\Book;
use App\Models\User;
use App\Models\Borrow;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    /**
     * DashboardController Constructor
     *
     *
     */
    public function __construct()
    {
        $this->middleware(['auth', 'role:admin']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $borrows_this_month =  Borrow::whereIn('status', ['aktif', 'diperpanjang'])
                                ->whereMonth('created_at', Carbon::now()->month)
                                ->count();
        $borrows_request = Borrow::whereIn('status', ['belum disetujui'])
                            ->count();
        $books_total = Book::count();
        $users_total = User::count();

        // Chart Area
        $month_name = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agust', 'Sep', 'Okt', 'Nov', 'Des'];
        $month = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12];
        $borrows_months = Borrow::select(DB::raw("Month(created_at) as month"))
                            ->whereYear('created_at', date('Y'))
                            ->groupBy(DB::raw("Month(created_at)"))
                            ->pluck('month');
        $borrows_year = [];
        
        foreach ($month as $key => $value) {
            $borrows_year[] = Borrow::whereIn('status', ['aktif', 'diperpanjang', 'selesai'])
            ->whereMonth('created_at', $value)
            ->whereYear('created_at', date('Y'))
            ->count();
        }

        return view('dashboard/dashboard/welcome', compact('borrows_this_month', 'books_total', 'users_total', 'borrows_request'))
                ->with('month_name',json_encode($month_name,JSON_NUMERIC_CHECK))
                ->with('borrows_year',json_encode($borrows_year,JSON_NUMERIC_CHECK));
    }
}