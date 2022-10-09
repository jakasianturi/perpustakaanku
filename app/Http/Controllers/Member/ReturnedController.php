<?php

namespace App\Http\Controllers\Member;

use Exception;
use App\Models\Borrow;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Services\Member\ReturnedService;

class ReturnedController extends Controller
{
    /**
     * @var ReturnedService
     */
    protected $returnedService;

    /**
     * ReturnedController Constructor
     *
     *
     */
    public function __construct(ReturnedService $returnedService)
    {
        $this->middleware(['auth', 'role:member']);
        $this->returnedService = $returnedService;
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
                $result['data'] = $this->returnedService->getByActive();
                return $result['data'];
            }
        } catch (Exception $e) {
            $result = [
                'status' => 500,
                'error' => $e->getMessage()
            ];
        }
        return view('member/returned/list');
        // return response()->json($result, $result['status']);
    }

    public function nonactive(Request $request)
    {
        $result = ['status' => 200];

        try {
            if($request->ajax()){
                $result['data'] = $this->returnedService->getByNonactive();
                return $result['data'];
            }
        } catch (Exception $e) {
            $result = [
                'status' => 500,
                'error' => $e->getMessage()
            ];
        }
        return view('member/returned/nonactive');
        // return response()->json($result, $result['status']);
    }
}