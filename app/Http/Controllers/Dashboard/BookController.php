<?php

namespace App\Http\Controllers\Dashboard;

use Exception;
use App\Models\Book;
use App\Models\Category;
use App\Models\Bookshelf;
use Illuminate\Http\Request;
use Services\Admin\BookService;
use Services\Admin\CategoryService;
use App\Http\Controllers\Controller;
use Services\Admin\BookshelfService;
use App\Http\Requests\Admin\BookRequest;

class BookController extends Controller
{
    /**
     * @var BookService
     */
    protected $bookService;
    protected $categoryService;
    protected $bookshelfService;

    /**
     * BookController Constructor
     *
     *
     */
    public function __construct(BookService $bookService, CategoryService $categoryService, BookshelfService $bookshelfService)
    {
        $this->middleware(['auth', 'role:admin']);
        $this->bookService = $bookService;
        $this->categoryService = $categoryService;
        $this->bookshelfService = $bookshelfService;
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
                $result['data'] = $this->bookService->getDatatable();
                return $result['data'];
            }
        } catch (Exception $e) {
            $result = [
                'status' => 500,
                'error' => $e->getMessage()
            ];
        }
        return view('dashboard/book/list');
        // return response()->json($result, $result['status']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories  = Category::all();
        $bookshelves = Bookshelf::all();
        return view('dashboard/book/form', [
                    'categories'    => $categories,
                    'bookshelves'   => $bookshelves,
                    'url'           => 'dashboard.books.store',
                    'button'        => 'Simpan',

        ]);
    }

    public function getDataCategory(Request $request)
    {
        $getDataCategory = $this->categoryService->getDataByQuery($request->all());
        return response()->json($getDataCategory);
    }

    public function getDataBookshelf(Request $request)
    {
        $getDataBookshelf = $this->bookshelfService->getDataByQuery($request->all());
        return response()->json($getDataBookshelf);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BookRequest $request)
    {
        $data = $request->only([
            'book_id',
            'category_id',
            'bookshelf_id',
            'title',
            'author',
            'publisher',
            'publication',
            'isbn',
            'stock',
            'description',
            'cover',    
        ]);

        $result = ['status' => 200];

        try {
            $result['data'] = $this->bookService->save($data);
        } catch (Exception $e) {
            $result = [
                'status' => 500,
                'error' => $e->getMessage()
            ];
        }
        return redirect()
                ->route('dashboard.books.index')
                ->with('message', __('messages.create_book', ['attribute' => $request->input('title')]));
        // return response()->json($result, $result['status']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Book $book)
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
        $book = Book::find($id);
        $categories = Category::all();
        $bookshelves = Bookshelf::all();
        return view('dashboard/book/form', [
            'book'          => $book,
            'categories'    => $categories,
            'bookshelves'   => $bookshelves,
            'url'           => 'dashboard.books.update',
            'button'        => 'Perbaharui',
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(BookRequest $request, $id)
    {
        $data = $request->only([
            'book_id',
            'category_id',
            'bookshelf_id',
            'title',
            'author',
            'publisher',
            'publication',
            'isbn',
            'stock',
            'description',
            'cover',  
        ]);

        $result = ['status' => 200];

        try {
            $result['data'] = $this->bookService->update($data, $id);

        } catch (Exception $e) {
            $result = [
                'status' => 500,
                'error' => $e->getMessage()
            ];
        }
        return redirect()
        ->route('dashboard.books.index')
        ->with('message', __('messages.update_book', ['attribute' => $request->input('title')]));
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
            $result['data'] = $this->bookService->deleteById($id);
        } catch (Exception $e) {
            $result = [
                'status' => 500,
                'error' => $e->getMessage()
            ];
        }
        return response()->json($result, $result['status']);
    }
}