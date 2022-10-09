<?php

namespace App\Repositories\Eloquent;

use App\Models\Borrow;
use App\Repositories\MemberReturnedRepositoryInterface;


class MemberReturnedRepository implements MemberReturnedRepositoryInterface
{
    public function getByActive()
    {
        $user = auth()->user();
        $borrows = Borrow::whereIn('user_id', [$user->id])
                    ->whereNotIn('status', ['Selesai', 'Belum Disetujui'])->get();
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
        
        $user = auth()->user();
        $borrows = Borrow::whereIn('user_id', [$user->id])
                    ->whereIn('status', ['selesai'])->get();
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
}