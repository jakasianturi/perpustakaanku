<?php

namespace App\Http\Controllers\Dashboard;

use Exception;
use App\Models\Book;
use App\Models\User;
use App\Models\Borrow;
use Illuminate\Http\Request;
use Services\Admin\BookService;
use Services\Admin\UserService;
use Services\Admin\ReturnedService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ReturnedRequest;

class ReturnedController extends Controller
{
    /**
     * @var ReturnedService
     */
    protected $returnedService;
    protected $userService;
    protected $bookService;

    /**
     * ReturnedController Constructor
     *
     *
     */
    public function __construct(ReturnedService $returnedService, UserService $userService, BookService $bookService)
    {
        $this->middleware(['auth', 'role:admin']);
        $this->returnedService = $returnedService;
        $this->userService = $userService;
        $this->bookService = $bookService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $result = ['status' => 200];

        try {
            if($request->ajax()){
                $result['data'] = $this->returnedService->getByActive();
                return $result['data'];
            }
        } catch (Exception $e) {
            $result = [
                'status' => 500,
                'error' => $e->getMessage()
            ];
        }
        return view('dashboard/returned/list');
        // return response()->json($result, $result['status']);
    }

    public function nonactive(Request $request)
    {
        $result = ['status' => 200];

        try {
            if($request->ajax()){
                $result['data'] = $this->returnedService->getByNonactive();
                return $result['data'];
            }
        } catch (Exception $e) {
            $result = [
                'status' => 500,
                'error' => $e->getMessage()
            ];
        }
        return view('dashboard/returned/nonactive');
        // return response()->json($result, $result['status']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    public function getDataMember(Request $request)
    {
        $getDataMember = $this->userService->getDataMemberByQuery($request->all());
        return response()->json($getDataMember);
    }

    public function getDataBook(Request $request)
    {
        $getDataBook = $this->bookService->getDataByQuery($request->all());
        return response()->json($getDataBook);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Borrow $borrow)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $borrow = Borrow::find($id);
        $books  = Book::all();
        $users = User::whereNotIn('user_role', [1])->get();
        return view('dashboard/returned/form', [
                    'borrow'         => $borrow,
                    'books'         => $books,
                    'users'         => $users,
                    'url'           => 'dashboard.returneds.update',
                    'button'        => 'Perbaharui',

        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ReturnedRequest $request, $id)
    {
        $data = $request->only([
            'book_id',
            'user_id',
            'borrow_date',
            'return_date',
            'total',
            'status',
            'returned_date',
            'book_fine',
        ]);

        $result = ['status' => 200];

        try {
            $result['data'] = $this->returnedService->update($data, $id);

        } catch (Exception $e) {
            $result = [
                'status' => 500,
                'error' => $e->getMessage()
            ];
        }
        return redirect()
                ->route('dashboard.returneds.index')
                ->with('message', __('messages.update_returned'));
        // return response()->json($result, $result['status']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $result = ['status' => 200];

        try {
            $result['data'] = $this->returnedService->deleteById($id);
        } catch (Exception $e) {
            $result = [
                'status' => 500,
                'error' => $e->getMessage()
            ];
        }
        return response()->json($result, $result['status']);
    }
}