<?php

namespace App\Repositories\Eloquent;

use App\Models\Book;
use App\Models\Borrow;
use App\Repositories\ReturnedRepositoryInterface;


class ReturnedRepository implements ReturnedRepositoryInterface
{
    public function getByActive()
    {
        $borrows = Borrow::whereNotIn('status', ['Selesai', 'Belum Disetujui'])->get();
        $datatable = datatables()->of($borrows)
                        ->addColumn('books', function ($borrows) {
                            return $borrows->book->title;
                        })
                        ->addColumn('users', function ($borrows) {
                            return $borrows->user->name;
                        })
                        ->addColumn('action', function($data){
                            $button = '<a href="returneds/'.$data->id.'/edit" class="d-sm-inline-block btn btn-sm btn-success shadow-sm mx-1"><i class="fas fa-edit fa-sm"></i> Edit</a>';
                            $button .= '&nbsp;&nbsp;';
                            $button .= '<button type="button" name="delete" id="'.$data->id.'"class="delete d-sm-inline-block btn btn-sm btn-danger shadow-sm mx-1"><i class="fas fa-trash-alt fa-sm"></i> Hapus</button>';
                            return $button;
                        })
                        ->rawColumns(['books', 'users', 'action'])
                        ->addIndexColumn()
                        ->make(true);
        return $datatable;
    }

    public function getByNonactive()
    {
        
        $borrows = Borrow::whereIn('status', ['selesai'])->get();
        $datatable = datatables()->of($borrows)
                        ->addColumn('books', function ($borrows) {
                            return $borrows->book->title;
                        })
                        ->addColumn('users', function ($borrows) {
                            return $borrows->user->name;
                        })
                        ->addColumn('action', function($data){
                            $button = '<a href="returneds/'.$data->id.'/edit" class="d-sm-inline-block btn btn-sm btn-success shadow-sm mx-1"><i class="fas fa-edit fa-sm"></i> Edit</a>';
                            $button .= '&nbsp;&nbsp;';
                            $button .= '<button type="button" name="delete" id="'.$data->id.'"class="delete d-sm-inline-block btn btn-sm btn-danger shadow-sm mx-1"><i class="fas fa-trash-alt fa-sm"></i> Hapus</button>';
                            return $button;
                        })
                        ->rawColumns(['books', 'users', 'action'])
                        ->addIndexColumn()
                        ->make(true);
        return $datatable;
    }

    public function update($data, $id)
    {
        $idBook = $data['book_id'];
        $total_borrow = $data['total'];
        $status = $data['status'];
        
        if($status == 'Selesai') {
            Book::where('id', $idBook)->increment('stock', $total_borrow);
        }

        return Borrow::where('id', $id)
            ->update([
                'book_id'       => $data['book_id'],
                'user_id'       => $data['user_id'],
                'borrow_date'   => $data['borrow_date'],
                'return_date'   => $data['return_date'],
                'total'         => $total_borrow,
                'status'        => $status,
                'returned_date' => $data['returned_date'],
                'book_fine'     => $data['book_fine'],
            ]);
    }

    public function delete($id)
    {
        return Borrow::where('id', $id)
            ->delete($id);
    }
}