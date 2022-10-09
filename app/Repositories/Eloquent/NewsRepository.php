<?php

namespace App\Repositories\Eloquent;

use Carbon\Carbon;
use App\Models\News;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\Repositories\NewsRepositoryInterface;


class NewsRepository implements NewsRepositoryInterface
{
    public function getAll()
    {
        return News::all();
    }

    public function getById($id)
    {
        return News::find($id);
    }

    public function getLast()
    {
        return News::latest()->first();
    }

    public function getLatest()
    {
        return News::latest()->skip(1)->take(4)->get();
    }

    public function getDetailNews($data)
    {
        return News::where('slug', $data)->first();
    }

    public function getRelatedNews($data)
    {
        return News::latest()
                            ->where('slug', '!=' ,$data)
                            ->take(6)
                            ->get();
    }

    public function getDatatable()
    {
        $news = News::all();
        $datatable = datatables()->of($news)
                        ->addColumn('users', function ($news) {
                            return $news->user->name;
                        })
                        ->addColumn('action', function($data){
                            $button = '<a href="news/'.$data->id.'/edit" class="d-sm-inline-block btn btn-sm btn-success shadow-sm mx-1"><i class="fas fa-edit fa-sm"></i> Edit</a>';
                            $button .= '&nbsp;&nbsp;';
                            $button .= '<button type="button" name="delete" id="'.$data->id.'"class="delete d-sm-inline-block btn btn-sm btn-danger shadow-sm mx-1"><i class="fas fa-trash-alt fa-sm"></i> Hapus</button>';
                            return $button;
                        })
                        ->editColumn('created_at', function ($news) {
                            return $news->created_at ? with(new Carbon($news->created_at))->translatedFormat('l, j F Y - H:i:s') : '';
                        })
                        ->rawColumns(['users', 'action'])
                        ->addIndexColumn()
                        ->make(true);
        return $datatable;
    }

    public function save($data)
    {
        $imgName = Str::slug($data['title'], '-');
        if(isset($data['thumbnail'])) {
            $image = $data['thumbnail'];
            $fileName = time() . '-' .$imgName. '.' . $image->getClientOriginalExtension();
            Storage::putFileAs('public/uploads', $image, $fileName);
        } else {
            $fileName = "";
        }

        return News::create([
            'title'       => $data['title'],
            'thumbnail'   => $fileName,
            'content'     => $data['content'],
            'user_id'     => $data['user_id'],
        ]);
    }

    public function update($data, $id)
    {
        $news = News::find($id);

        $imgName = Str::slug($data['title'], '-');
        if(isset($data['thumbnail'])) {
            $image = $data['thumbnail'];
            $fileName = time() . '-' .$imgName. '.' . $image->getClientOriginalExtension();
            Storage::putFileAs('public/uploads', $image, $fileName);
        } else {
            $fileName = $news->thumbnail;
        }

        return News::where('id', $id)
            ->update([
                'title'      => $data['title'],
                'thumbnail'  => $fileName,
                'content'    => $data['content'],
                'user_id'    => $data['user_id'],
            ]);
    }

    public function delete($id)
    {
        return News::where('id', $id)
            ->delete($id);
    }
}