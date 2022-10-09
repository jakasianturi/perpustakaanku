<?php

namespace App\Repositories\Eloquent;

use App\Models\Book;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\Repositories\BookRepositoryInterface;


class BookRepository implements BookRepositoryInterface
{
    public function getAll()
    {
        return Book::all();
    }

    public function getById($id)
    {
        return Book::find($id);
    }

    public function getDetailBook($data)
    {
        return Book::where('slug', $data)->first();
    }

    public function getRelatedBook($data)
    {
        $book = Book::where('slug', $data)->first();
        $author = isset($book->author) ? $book->author : '';
        $title = isset($book->title) ? $book->title : '';
        return Book::where('author', $author)
                            ->where('title', '!=' ,$title)
                            ->take(6)
                            ->get();
    }

    public function getDataAuthorByQuery($data)
    {
        $search = isset($data['q']) ? $data['q'] : '';
        return Book::select('author')
                            ->groupBy('author')
                            ->where('author', 'like', "%{$search}%")
                            ->get();
    }

    public function getDataPublicationByQuery($data)
    {
        $search = isset($data['q']) ? $data['q'] : '';
        return Book::select('publication')
                            ->groupBy('publication')
                            ->where('publication', 'like', "%{$search}%")
                            ->get();
    }

    public function getDataPublisherByQuery($data)
    {
        $search = isset($data['q']) ? $data['q'] : '';
        return Book::select('publisher')
                            ->groupBy('publisher')
                            ->where('publisher', 'like', "%{$search}%")
                            ->get();
    }

    public function searchData($data)
    {
        return Book::when($data, function($query) use ($data) {
            return $query->where('title', 'like', "%{$data}%");
        })
        ->paginate(8);
    }

    public function getLatest()
    {
        return Book::latest()->paginate(8);
    }

    public function getDatatable()
    {
        $books = Book::all();
        $datatable = datatables()->of($books)
                        ->addColumn('categories', function ($books) {
                            return $books->category->category_name;
                        })
                        ->addColumn('bookshelves', function ($books) {
                            return $books->bookshelf->bookshelf_name;
                        })
                        ->addColumn('action', function($data){
                            $button = '<a href="books/'.$data->id.'/edit" class="d-sm-inline-block btn btn-sm btn-success shadow-sm mx-1"><i class="fas fa-edit fa-sm"></i> Edit</a>';
                            $button .= '&nbsp;&nbsp;';
                            $button .= '<button type="button" name="delete" id="'.$data->id.'"class="delete d-sm-inline-block btn btn-sm btn-danger shadow-sm mx-1"><i class="fas fa-trash-alt fa-sm"></i> Hapus</button>'; 
                            return $button;
                        })
                        ->rawColumns(['categories', 'bookshelves', 'action'])
                        ->addIndexColumn()
                        ->make(true);
        return $datatable;
    }

    public function getDataByQuery($data)
    {
        $search = isset($data['q']) ? $data['q'] : '';
        return Book::select('id', 'title')
                                    ->where('title', 'like', "%{$search}%")
                                    ->get();
    }

    public function save($data)
    {
        $imgName = Str::slug($data['title'], '-');
        if(isset($data['cover'])) {
            $image = $data['cover'];
            $fileName = time() . '-' .$imgName. '.' . $image->getClientOriginalExtension();
            Storage::putFileAs('public/uploads', $image, $fileName);
        } else {
            $fileName = "";
        }
        return Book::create([
            'book_id'       => $data['book_id'],
            'category_id'   => $data['category_id'],
            'bookshelf_id'  => $data['bookshelf_id'],
            'title'         => $data['title'],
            'author'        => $data['author'],
            'publisher'     => $data['publisher'],
            'publication'   => $data['publication'],
            'isbn'          => $data['isbn'],
            'stock'         => $data['stock'],
            'description'   => $data['description'],
            'cover'         => $fileName,
        ]);
    }

    public function update($data, $id)
    {
        $book = Book::find($id);
        $imgName = Str::slug($data['title'], '-');
        if(isset($data['cover'])) {
            $image = $data['cover'];
            $fileName = time() . '-' .$imgName. '.' . $image->getClientOriginalExtension();
            Storage::putFileAs('public/uploads', $image, $fileName);
        } else {
            $fileName = $book->cover;
        }

        return Book::where('id', $id)
            ->update([
                'book_id'       => $data['book_id'],
                'category_id'   => $data['category_id'],
                'bookshelf_id'  => $data['bookshelf_id'],
                'title'         => $data['title'],
                'author'        => $data['author'],
                'publisher'     => $data['publisher'],
                'publication'   => $data['publication'],
                'isbn'          => $data['isbn'],
                'stock'         => $data['stock'],
                'description'   => $data['description'],
                'cover'         => $fileName,
            ]);
    }

    public function delete($id)
    {
        return Book::where('id', $id)
            ->delete($id);
    }
}