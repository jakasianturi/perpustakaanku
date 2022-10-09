<?php

namespace App\Repositories\Eloquent;

use App\Models\Bookshelf;
use App\Repositories\BookshelfRepositoryInterface;


class BookshelfRepository implements BookshelfRepositoryInterface
{
    public function getAll()
    {
        return Bookshelf::all();
    }

    public function getById($id)
    {
        return Bookshelf::find($id);
    }

    public function getDatatable()
    {
        $bookshelves = Bookshelf::all();
        $datatable = datatables()->of($bookshelves)
                        ->addColumn('books', function ($bookshelves) {
                            return $bookshelves->book->count();
                        })
                        ->addColumn('action', function($data){
                            $button = '<a href="bookshelves/'.$data->id.'/edit" class="d-sm-inline-block btn btn-sm btn-success shadow-sm mx-1"><i class="fas fa-edit fa-sm"></i> Edit</a>';
                            $button .= '&nbsp;&nbsp;';
                            $button .= '<button type="button" name="delete" id="'.$data->id.'"class="delete d-sm-inline-block btn btn-sm btn-danger shadow-sm mx-1"><i class="fas fa-trash-alt fa-sm"></i> Hapus</button>';     
                            return $button;
                        })
                        ->rawColumns(['books', 'action'])
                        ->addIndexColumn()
                        ->make(true);
        return $datatable;
    }

    public function getDataByQuery($data)
    {
        $search = isset($data['q']) ? $data['q'] : '';
        return Bookshelf::select('id', 'bookshelf_name')
                                    ->where('bookshelf_name', 'like', "%{$search}%")
                                    ->get();
    }

    public function save($data)
    {
        return Bookshelf::create($data);
    }

    public function update($data, $id)
    {
        return Bookshelf::where('id', $id)
            ->update($data);
    }

    public function delete($id)
    {
        return Bookshelf::where('id', $id)
            ->delete($id);
    }
}