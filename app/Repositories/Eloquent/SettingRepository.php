<?php

namespace App\Repositories\Eloquent;

use App\Models\Setting;
use Illuminate\Support\Facades\Storage;
use App\Repositories\SettingRepositoryInterface;


class SettingRepository implements SettingRepositoryInterface
{
    public function getSetting()
    {
        return Setting::first();
    }

    public function getAbout()
    {
        return Setting::select('about_title', 'about_thumbnail', 'about_content')
        ->first();
    }

    public function update($data, $id)
    {
        $setting = Setting::find($id);

        if(isset($data['favicon'])) {
            $favicon = $data['favicon'];
            $faviconName = time() . '-' .'favicon'. '.' . $favicon->getClientOriginalExtension();
            Storage::putFileAs('public/uploads', $favicon, $faviconName);
        } else {
            $faviconName = $setting->favicon;
        }

        if(isset($data['logo'])) {
            $logo = $data['logo'];
            $logoName = time() . '-' .'logo'. '.' . $logo->getClientOriginalExtension();
            Storage::putFileAs('public/uploads', $logo, $logoName);
        } else {
            $logoName = $setting->logo;
        }

        if(isset($data['about_thumbnail'])) {
            $about_thumbnail = $data['about_thumbnail'];
            $about_thumbnailName = time() . '-' .'about_thumbnail'. '.' . $about_thumbnail->getClientOriginalExtension();
            Storage::putFileAs('public/uploads', $about_thumbnail, $about_thumbnailName);
        } else {
            $about_thumbnailName = $setting->about_thumbnail;
        }

        return Setting::where('id', $id)
            ->update([
                'site_name'        => $data['site_name'],
                'site_footer'        => $data['site_footer'],
                'logo'             => $logoName,
                'favicon'          => $faviconName,
                'ga_code'          => $data['ga_code'],
                'social_facebook'  => $data['social_facebook'],
                'social_twitter'   => $data['social_twitter'],
                'social_instagram' => $data['social_instagram'],
                'email'            => $data['email'],
                'phone'            => $data['phone'],
                'operational_time' => $data['operational_time'],
                'google_map'       => $data['google_map'],
                'address'          => $data['address'],
                'about_title'      => $data['about_title'],
                'about_thumbnail'  => $about_thumbnailName,
                'about_content'    => $data['about_content'],
                'meta_description' => $data['meta_description'],
                'meta_keyword'     => $data['meta_keyword'],
            ]);
    }
}