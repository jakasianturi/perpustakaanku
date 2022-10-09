<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Services\BookService;
use Illuminate\Http\Request;
use Services\CategoryService;

class BookController extends Controller
{
    /**
     * @var BookService
     */
    protected $bookService;
    protected $categoryService;

    /**
     * BookController Constructor
     *
     *
     */
    public function __construct(BookService $bookService, CategoryService $categoryService)
    {
        $this->bookService = $bookService;
        $this->categoryService = $categoryService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $requestTitle = $request->input('title');
        $requestIsbn = $request->input('isbn');
        $requestCategory = $request->input('categori_id');
        $requestPublication = $request->input('publication');
        $requestAuthor = $request->input('author');
        $requestPublisher = $request->input('publisher');

        $categories = $this->bookService->getCategory();

        $books = Book::when($requestTitle, function($query) use ($requestTitle) {
                        return $query->where('title', 'like', "%{$requestTitle}%");
                    })
                    ->when($requestIsbn, function($query) use ($requestIsbn) {
                        return $query->where('isbn', 'like', "%{$requestIsbn}%");
                    })
                    ->when($requestCategory, function($query) use ($requestCategory) {
                        return $query->where('categori_id', 'like', "%{$requestCategory}%");
                    })
                    ->when($requestPublication, function($query) use ($requestPublication) {
                        return $query->where('publication', 'like', "%{$requestPublication}%");
                    })
                    ->when($requestAuthor, function($query) use ($requestAuthor) {
                        return $query->where('author', 'like', "%{$requestAuthor}%");
                    })
                    ->when($requestPublisher, function($query) use ($requestPublisher) {
                        return $query->where('publisher', 'like', "%{$requestPublisher}%");
                    })
                    ->paginate(8);

        $allBooks = Book::all();
        $request = $request->all();

        return view('books', compact('books', 'allBooks', 'categories', 'request'));
    }

    public function getDataCategory(Request $request)
    {
        $getDataCategory = $this->categoryService->getDataByQuery($request->all());
        return response()->json($getDataCategory);
    }

    public function getDataAuthor(Request $request)
    {
        $getDataAuthor = $this->bookService->getDataAuthorByQuery($request->all());
        return response()->json($getDataAuthor);
    }

    public function getDataPublication(Request $request)
    {
        $getDataPublication = $this->bookService->getDataPublicationByQuery($request->all());
        return response()->json($getDataPublication);
    }

    public function getDataPublisher(Request $request)
    {
        $getDataPublisher = $this->bookService->getDataPublisherByQuery($request->all());
        return response()->json($getDataPublisher);
    }

    public function detailBook($slug)
    {
        $book = $this->bookService->getDetailBook($slug);
        $related_books  = $this->bookService->getRelatedBook($slug);

        if(empty($book)) {
            abort(404);
        }
        
        return view('detail_book', compact('book', 'related_books'));
    }

    public function searchBook(Book $book, Request $request)
    {
        $data = $request->input('query_search');

        $categories = $this->bookService->getCategory();

        $books = $this->bookService->searchData($data);

        $request = $request->all();

        return view('search', compact('books', 'categories', 'request'));
    }
}