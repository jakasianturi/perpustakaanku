<?php

namespace App\Repositories\Eloquent;

use App\Models\Banner;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\Repositories\BannerRepositoryInterface;


class BannerRepository implements BannerRepositoryInterface
{
    public function getAll()
    {
        return Banner::all();
    }

    public function getById($id)
    {
        return Banner::find($id);
    }

    public function getDatatable()
    {
        $banners = Banner::all();
        $datatable = datatables()->of($banners)
                        ->addColumn('action', function($data){
                            $button = '<a href="banners/'.$data->id.'/edit" class="d-sm-inline-block btn btn-sm btn-success shadow-sm mx-1"><i class="fas fa-edit fa-sm"></i> Edit</a>';
                            $button .= '&nbsp;&nbsp;';
                            $button .= '<button type="button" name="delete" id="'.$data->id.'"class="delete d-sm-inline-block btn btn-sm btn-danger shadow-sm mx-1"><i class="fas fa-trash-alt fa-sm"></i> Hapus</button>';
                            return $button;
                        })
                        ->rawColumns(['action'])
                        ->addIndexColumn()
                        ->make(true);
        return $datatable;
    }

    public function save($data)
    {
        $imgName = Str::slug($data['title'], '-');
        if(isset($data['background'])) {
            $image = $data['background'];
            $fileName = time() . '-' .$imgName. '.' . $image->getClientOriginalExtension();
            Storage::putFileAs('public/uploads', $image, $fileName);
        } else {
            $fileName = "";
        }

        return Banner::create([
            'title'       => $data['title'],
            'description' => $data['description'],
            'button_text' => $data['button_text'],
            'button_url'  => $data['button_url'],
            'background'  => $fileName,
        ]);
    }

    public function update($data, $id)
    {
        $banner = Banner::find($id);

        $imgName = Str::slug($data['title'], '-');
        if(isset($data['background'])) {
            $image = $data['background'];
            $fileName = time() . '-' .$imgName. '.' . $image->getClientOriginalExtension();
            Storage::putFileAs('public/uploads', $image, $fileName);
        } else {
            $fileName = $banner->background;
        }

        return Banner::where('id', $id)
            ->update([
                'title'        => $data['title'],
                'description'  => $data['description'],
                'button_text'  => $data['button_text'],
                'button_url'   => $data['button_url'],
                'background'   => $fileName,
            ]);
    }

    public function delete($id)
    {
        return Banner::where('id', $id)
            ->delete($id);
    }
}