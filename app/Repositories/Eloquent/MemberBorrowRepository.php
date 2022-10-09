<?php

namespace App\Repositories\Eloquent;

use Carbon\Carbon;
use App\Models\Book;
use App\Models\Borrow;
use App\Repositories\MemberBorrowRepositoryInterface;


class MemberBorrowRepository implements MemberBorrowRepositoryInterface
{
    public function getDatatable()
    {
        $user = auth()->user();
        $borrows = Borrow::whereIn('user_id', [$user->id])
                            ->whereIn('status', ['Belum Disetujui'])->get();
                            
        $datatable = datatables()->of($borrows)
                        ->addColumn('books', function ($borrows) {
                            return $borrows->book->title;
                        })
                        ->addColumn('users', function ($borrows) {
                            return $borrows->user->name;
                        })
                        ->addColumn('action', function($data){
                            $button = '<a href="borrows/'.$data->id.'/edit" class="d-sm-inline-block btn btn-sm btn-success shadow-sm mx-1"><i class="fas fa-edit fa-sm"></i> Edit</a>';
                            $button .= '&nbsp;&nbsp;';
                            $button .= '<button type="button" name="delete" id="'.$data->id.'"class="delete d-sm-inline-block btn btn-sm btn-danger shadow-sm mx-1"><i class="fas fa-trash-alt fa-sm"></i> Hapus</button>';
                            return $button;
                        })
                        ->rawColumns(['books', 'users', 'action'])
                        ->addIndexColumn()
                        ->make(true);
        return $datatable;
    }

    public function save($data)
    {
        $date = Carbon::now();
        $borrow_date= $date->toDateString();
        
        $user  = auth()->user();

        return Borrow::create([
            'book_id'       => $data['book_id'],
            'user_id'       => $user->id,
            'borrow_date'   => $borrow_date,
            'total'         => $data['total'],
        ]);
    }

    public function update($data, $id)
    {
        $date = Carbon::now();
        $borrow_date= $date->toDateString();
        
        $user  = auth()->user();

        return Borrow::where('id', $id)
            ->update([
                'book_id'       => $data['book_id'],
                'user_id'       => $user->id,
                'borrow_date'   => $borrow_date,
                'total'         => $data['total'],
            ]);
    }

    public function delete($id)
    {
        return Borrow::where('id', $id)
            ->delete($id);
    }
}