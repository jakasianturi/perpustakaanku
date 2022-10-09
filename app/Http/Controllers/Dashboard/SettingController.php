<?php

namespace App\Http\Controllers\Dashboard;

use Exception;
use App\Models\Setting;
use Illuminate\Http\Request;
use Services\Admin\SettingService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\SettingRequest;

class SettingController extends Controller
{
    /**
     * @var SettingService
     */
    protected $settingService;

    /**
     * SettingController Constructor
     *
     *
     */
    public function __construct(SettingService $settingService)
    {
        $this->middleware(['auth', 'role:admin']);
        $this->settingService = $settingService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $setting = Setting::first();
        
        return view('dashboard/setting/form', compact('setting'));
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SettingRequest $request, $id)
    {
        // dd($request);
        $data = $request->only([
            'site_name',
            'site_footer',
            'logo',
            'favicon',
            'ga_code',
            'social_facebook',
            'social_twitter',
            'social_instagram',
            'email',
            'phone',
            'operational_time',
            'google_map',
            'address',
            'about_title',
            'about_thumbnail',
            'about_content',
            'meta_description',
            'meta_keyword', 
        ]);

        $result = ['status' => 200];

        try {
            $result['data'] = $this->settingService->update($data, $id);

        } catch (Exception $e) {
            $result = [
                'status' => 500,
                'error' => $e->getMessage()
            ];
        }
        return redirect()
                ->route('dashboard.settings.index')
                ->with('message', __('messages.update_setting'));
        // return response()->json($result, $result['status']);
    }
}