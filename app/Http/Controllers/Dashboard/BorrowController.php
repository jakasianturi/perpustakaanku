<?php

namespace App\Http\Controllers\Dashboard;

use Exception;
use App\Models\Book;
use App\Models\User;
use App\Models\Borrow;
use Illuminate\Http\Request;
use Services\Admin\BookService;
use Services\Admin\UserService;
use Services\Admin\BorrowService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\BorrowRequest;

class BorrowController extends Controller
{
    /**
     * @var BorrowService
     */
    protected $borrowService;
    protected $userService;
    protected $bookService;

    /**
     * BorrowController Constructor
     *
     *
     */
    public function __construct(BorrowService $borrowService, UserService $userService, BookService $bookService)
    {
        $this->middleware(['auth', 'role:admin']);
        $this->borrowService = $borrowService;
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
                $result['data'] = $this->borrowService->getDatatable();
                return $result['data'];
            }
        } catch (Exception $e) {
            $result = [
                'status' => 500,
                'error' => $e->getMessage()
            ];
        }
        return view('dashboard/borrow/list');
        // return response()->json($result, $result['status']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $books = Book::all();
        $users = User::whereNotIn('user_role', [1])->get();
        return view('dashboard/borrow/form', [
                    'books'         => $books,
                    'users'          => $users,
                    'url'           => 'dashboard.borrows.store',
                    'button'        => 'Simpan',

        ]);
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
    public function store(BorrowRequest $request)
    {
        $data = $request->only([
            'book_id',
            'user_id',
            'borrow_date',
            'return_date',
            'total',
            'status',   
        ]);

        $attribute = Book::find($request->input('book_id'))->title;

        $result = ['status' => 200];

        try {
            $result['data'] = $this->borrowService->save($data);
        } catch (Exception $e) {
            $result = [
                'status' => 500,
                'error' => $e->getMessage()
            ];
        }
        return redirect()
                ->route('dashboard.borrows.index')
                ->with('message', __('messages.create_borrow', ['attribute' => $attribute]));
        // return response()->json($result, $result['status']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
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
        return view('dashboard/borrow/form_edit', [
                    'borrow'         => $borrow,
                    'books'         => $books,
                    'users'         => $users,
                    'url'           => 'dashboard.borrows.update',
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
    public function update(BorrowRequest $request, $id)
    {
        $data = $request->only([
            'book_id',
            'user_id',
            'borrow_date',
            'return_date',
            'total',
            'status',
        ]);

        $attribute = Book::find($request->input('book_id'))->title;

        $result = ['status' => 200];

        try {
            $result['data'] = $this->borrowService->update($data, $id);

        } catch (Exception $e) {
            $result = [
                'status' => 500,
                'error' => $e->getMessage()
            ];
        }
        return redirect()
        ->route('dashboard.borrows.index')
        ->with('message', __('messages.update_borrow', ['attribute' => $attribute]));
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
            $result['data'] = $this->borrowService->deleteById($id);
        } catch (Exception $e) {
            $result = [
                'status' => 500,
                'error' => $e->getMessage()
            ];
        }
        return response()->json($result, $result['status']);
    }
}