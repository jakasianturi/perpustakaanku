<?php

namespace App\Http\Controllers\Dashboard;

use Exception;
use App\Models\News;
use Illuminate\Http\Request;
use Services\Admin\NewsService;
use Services\Admin\UserService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\NewsRequest;

class NewsController extends Controller
{
    /**
     * @var NewsService
     */
    protected $newsService;
    protected $userService;

    /**
     * NewsController Constructor
     *
     *
     */
    public function __construct(NewsService $newsService, UserService $userService)
    {
        $this->middleware(['auth', 'role:admin']);
        $this->newsService = $newsService;
        $this->userService = $userService;
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
                $result['data'] = $this->newsService->getDatatable();
                return $result['data'];
            }
        } catch (Exception $e) {
            $result = [
                'status' => 500,
                'error' => $e->getMessage()
            ];
        }
        return view('dashboard/news/list');
        // return response()->json($result, $result['status']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = $this->userService->isAdmin();
        return view('dashboard/news/form', [
                    'users'          => $users,
                    'url'           => 'dashboard.news.store',
                    'button'        => 'Simpan',
        ]);
    }

    public function getDataAdmin(Request $request)
    {
        $getDataAdmin = $this->userService->getDataAdminByQuery($request->all());
        return response()->json($getDataAdmin);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(NewsRequest $request)
    {
        $data = $request->only([
            'title',
            'thumbnail',
            'content',
            'user_id',
        ]);

        $result = ['status' => 200];

        try {
            $result['data'] = $this->newsService->save($data);
        } catch (Exception $e) {
            $result = [
                'status' => 500,
                'error' => $e->getMessage()
            ];
        }
        return redirect()
                ->route('dashboard.news.index')
                ->with('message', __('messages.create_news', ['attribute' => $request->input('title')]));
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $news = News::find($id);
        $users = $this->userService->isAdmin();
        return view('dashboard/news/form', [
                    'news'          => $news,
                    'users'          => $users,
                    'url'           => 'dashboard.news.update',
                    'button'        => 'Perbaharui',
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function update(NewsRequest $request, $id)
    {
        $data = $request->only([
            'title',
            'thumbnail',
            'content',
            'user_id',
        ]);

        $result = ['status' => 200];

        try {
            $result['data'] = $this->newsService->update($data, $id);

        } catch (Exception $e) {
            $result = [
                'status' => 500,
                'error' => $e->getMessage()
            ];
        }
        return redirect()
        ->route('dashboard.news.index')
        ->with('message', __('messages.update_news', ['attribute' => $request->input('title')]));
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
            $result['data'] = $this->newsService->deleteById($id);
        } catch (Exception $e) {
            $result = [
                'status' => 500,
                'error' => $e->getMessage()
            ];
        }
        return response()->json($result, $result['status']);
    }
}