<?php

namespace App\Http\Controllers\Dashboard;

use Exception;
use Illuminate\Http\Request;
use Services\Admin\ProfileService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ProfileRequest;

class ProfileController extends Controller
{
    /**
     * @var ProfileService
     */
    protected $profileService;

    /**
     * ProfileController Constructor
     *
     *
     */
    public function __construct(ProfileService $profileService)
    {
        $this->middleware(['auth', 'role:admin']);
        $this->profileService = $profileService;

    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = auth()->user();
        return view('dashboard/profile/detail', [
                    'user'    => $user,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * 
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        $user = auth()->user();
        return view('dashboard/profile/form', [
            'user'      => $user,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(ProfileRequest $request, $id)
    {
        $data = $request->only([
            'name',
            'email',
            'address',
            'phone',
            'gender',
            'password', 
        ]);

        $result = ['status' => 200];

        try {
            $result['data'] = $this->profileService->update($data, $id);

        } catch (Exception $e) {
            $result = [
                'status' => 500,
                'error' => $e->getMessage()
            ];
        }
        return redirect()
        ->route('dashboard.profiles.index')
        ->with('message', __('messages.update_profile'));
        // return response()->json($result, $result['status']);
    }

    public function updateAvatar(Request $request)
    {
        $data = $request->avatar;
        $id = $request->id;

        $result = ['status' => 200];

        try {
            $result['data'] = $this->profileService->updateAvatar($data, $id);

        } catch (Exception $e) {
            $result = [
                'status' => 500,
                'error' => $e->getMessage()
            ];
        }

        return response()->json($result, $result['status']);

    }
}