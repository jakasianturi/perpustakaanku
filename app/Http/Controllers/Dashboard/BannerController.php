<?php

namespace App\Http\Controllers\Dashboard;

use Exception;
use App\Models\Banner;
use Illuminate\Http\Request;
use Services\Admin\BannerService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\BannerRequest;

class BannerController extends Controller
{
    /**
     * @var BannerService
     */
    protected $bannerService;

    /**
     * BannerController Constructor
     *
     *
     */
    public function __construct(BannerService $bannerService)
    {
        $this->middleware(['auth', 'role:admin']);
        $this->bannerService = $bannerService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $result = ['status' => 200];

        try {
            if($request->ajax()){
                $result['data'] = $this->bannerService->getDatatable();
                return $result['data'];
            }
        } catch (Exception $e) {
            $result = [
                'status' => 500,
                'error' => $e->getMessage()
            ];
        }
        return view('dashboard/banner/list');
        // return response()->json($result, $result['status']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard/banner/form', [
            'url'           => 'dashboard.banners.store',
            'button'        => 'Simpan',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BannerRequest $request)
    {
        $data = $request->only([
            'title',
            'description',
            'button_text',
            'button_url',
            'background',
        ]);

        $result = ['status' => 200];

        try {
            $result['data'] = $this->bannerService->save($data);
        } catch (Exception $e) {
            $result = [
                'status' => 500,
                'error' => $e->getMessage()
            ];
        }
        return redirect()
                ->route('dashboard.banners.index')
                ->with('message', __('messages.create_banner', ['attribute' => $request->input('title')]));
        // return response()->json($result, $result['status']);
    }

    /**
     * Display the specified resource.
     *
     * 
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * 
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $banner = Banner::find($id);
        return view('dashboard/banner/form', [
            'banner'          => $banner,
            'url'           => 'dashboard.banners.update',
            'button'        => 'Perbaharui',
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(BannerRequest $request, $id)
    {
        $data = $request->only([
            'title',
            'description',
            'button_text',
            'button_url',
            'background', 
        ]);

        $result = ['status' => 200];

        try {
            $result['data'] = $this->bannerService->update($data, $id);

        } catch (Exception $e) {
            $result = [
                'status' => 500,
                'error' => $e->getMessage()
            ];
        }
        return redirect()
        ->route('dashboard.banners.index')
        ->with('message', __('messages.update_banner', ['attribute' => $request->input('title')]));
        // return response()->json($result, $result['status']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $result = ['status' => 200];

        try {
            $result['data'] = $this->bannerService->deleteById($id);
        } catch (Exception $e) {
            $result = [
                'status' => 500,
                'error' => $e->getMessage()
            ];
        }
        return response()->json($result, $result['status']);
    }
}