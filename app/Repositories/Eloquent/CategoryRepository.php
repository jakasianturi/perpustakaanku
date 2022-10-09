<?php

namespace App\Repositories\Eloquent;

use App\Models\Category;
use App\Repositories\CategoryRepositoryInterface;


class CategoryRepository implements CategoryRepositoryInterface
{
    public function getAll()
    {
        return Category::all();
    }

    public function getById($id)
    {
        return Category::find($id);
    }

    public function getDetailCategory($data)
    {
        return Category::where('slug', $data)->first();
    }

    public function getDatatable()
    {
        $categories = Category::all();
        $datatable = datatables()->of($categories)
                        ->addColumn('books', function ($categories) {
                            return $categories->book->count();
                        })
                        ->addColumn('action', function($data){
                            $button = '<a href="categories/'.$data->id.'/edit" class="d-sm-inline-block btn btn-sm btn-success shadow-sm mx-1"><i class="fas fa-edit fa-sm"></i> Edit</a>';
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
        return Category::select('id', 'category_name')
                                    ->where('category_name', 'like', "%{$search}%")
                                    ->get();
    }

    public function save($data)
    {
        return Category::create($data);
    }

    public function update($data, $id)
    {
        return Category::where('id', $id)
            ->update($data);
    }

    public function delete($id)
    {
        return Category::where('id', $id)
            ->delete($id);
    }
}