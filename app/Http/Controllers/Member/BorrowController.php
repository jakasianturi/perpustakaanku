<?php

namespace App\Http\Controllers\Member;

use Exception;
use App\Models\Book;
use App\Models\Borrow;
use Services\BookService;
use Illuminate\Http\Request;
use Services\Member\BorrowService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Member\BorrowRequest;

class BorrowController extends Controller
{
    /**
     * @var BorrowService
     */
    protected $borrowService;
    protected $bookService;

    /**
     * BorrowController Constructor
     *
     *
     */
    public function __construct(BorrowService $borrowService, BookService $bookService)
    {
        $this->middleware(['auth', 'role:member']);
        $this->borrowService = $borrowService;
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
        return view('member/borrow/list');
        // return response()->json($result, $result['status']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $books  = Book::all();
        return view('member/borrow/form', [
                    'books'         => $books,
                    'url'           => 'member.borrows.store',
                    'button'        => 'Simpan',
        ]);
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
            'total', 
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
                ->route('member.borrows.index')
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
        return view('member/borrow/form', [
                    'borrow'         => $borrow,
                    'books'         => $books,
                    'url'           => 'member.borrows.update',
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
                ->route('member.borrows.index')
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