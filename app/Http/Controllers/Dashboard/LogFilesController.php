<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;

class LogFilesController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'role:admin']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!file_exists(storage_path('logs'))) {
            return [];
        }

        $logFiles = File::allFiles(storage_path('logs'));

        // Sort files by modified time DESC
        usort($logFiles, function ($a, $b) {
            return -1 * strcmp($a->getMTime(), $b->getMTime());
        });

        return view('dashboard/log/log-files', compact('logFiles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($fileName)
    {
        if (file_exists(storage_path('logs/'.$fileName))) {
            $path = storage_path('logs/'.$fileName);

            return response()->file($path, ['content-type' => 'text/plain']);
        }

        return 'Invalid file name.';
    }

    public function download($fileName)
    {
        if (file_exists(storage_path('logs/'.$fileName))) {
            $path = storage_path('logs/'.$fileName);
            $downloadFileName = env('APP_ENV').'.'.$fileName;

            return response()->download($path, $downloadFileName);
        }

        return 'Invalid file name.';
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}