<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use Services\BookService;
use Illuminate\Http\Request;
use Services\CategoryService;

class CategoryController extends Controller
{
    /**
     * @var CategoryService
     */
    protected $categoryService;
    protected $bookService;

    /**
     * BookController Constructor
     *
     *
     */
    public function __construct(CategoryService $categoryService, BookService $bookService)
    {
        $this->categoryService = $categoryService;
        $this->bookService = $bookService;
    }

    public function detailCategory(Request $request, Category $category)
    {
        $requestTitle = $request->input('title');
        $requestIsbn = $request->input('isbn');
        $requestPublication = $request->input('publication');
        $requestAuthor = $request->input('author');
        $requestPublisher = $request->input('publisher');

        $category_name = $category['category_name'];
        $category_slug = $category['slug'];

        $books = Book::where('category_id', $category['id'])
                    ->when($requestTitle, function($query) use ($requestTitle) {
                        return $query->where('title', 'like', "%{$requestTitle}%");
                    })
                    ->when($requestIsbn, function($query) use ($requestIsbn) {
                        return $query->where('isbn', 'like', "%{$requestIsbn}%");
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

        return view('categories', compact('books', 'allBooks', 'category_name', 'category_slug', 'request'));
    }
}