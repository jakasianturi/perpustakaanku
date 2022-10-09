<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * DashboardController Constructor
     *
     *
     */
    public function __construct()
    {
        $this->middleware(['auth', 'role:member']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('member/dashboard/welcome');
    }
}