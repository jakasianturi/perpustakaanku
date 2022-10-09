<?php

namespace App\Http\Controllers\Dashboard;

use Exception;
use App\Models\Bookshelf;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Services\Admin\BookshelfService;
use App\Http\Requests\Admin\BookshelfRequest;

class BookshelfController extends Controller
{
    /**
     * @var BookshelfService
     */
    protected $bookshelfService;

    /**
     * BookshelfController Constructor
     *
     *
     */
    public function __construct(BookshelfService $bookshelfService)
    {
        $this->middleware(['auth', 'role:admin']);
        $this->bookshelfService = $bookshelfService;
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
                $result['data'] = $this->bookshelfService->getDatatable();
                return $result['data'];
            }
        } catch (Exception $e) {
            $result = [
                'status' => 500,
                'error' => $e->getMessage()
            ];
        }
        return view('dashboard/bookshelf/list');
        // return response()->json($result, $result['status']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard/bookshelf/form', [
            'url'           => 'dashboard.bookshelves.store',
            'button'        => 'Simpan',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BookshelfRequest $request)
    {
        $data = $request->only([
            'bookshelf_name',
        ]);

        $result = ['status' => 200];

        try {
            $result['data'] = $this->bookshelfService->save($data);
        } catch (Exception $e) {
            $result = [
                'status' => 500,
                'error' => $e->getMessage()
            ];
        }
        return redirect()
                ->route('dashboard.bookshelves.index')
                ->with('message', __('messages.create_bookshelf', ['attribute' => $request->input('bookshelf_name')]));
        // return response()->json($result, $result['status']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Bookshelf  $bookshelf
     * @return \Illuminate\Http\Response
     */
    public function show(Bookshelf $bookshelf)
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
        $bookshelf = Bookshelf::find($id);
        return view('dashboard/bookshelf/form', [
            'bookshelf'      => $bookshelf,
            'url'           => 'dashboard.bookshelves.update',
            'button'        => 'Perbaharui',
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(BookshelfRequest $request, $id)
    {
        $data = $request->only([
            'bookshelf_name',
        ]);

        $result = ['status' => 200];

        try {
            $result['data'] = $this->bookshelfService->update($data, $id);

        } catch (Exception $e) {
            $result = [
                'status' => 500,
                'error' => $e->getMessage()
            ];
        }
        return redirect()
        ->route('dashboard.bookshelves.index')
        ->with('message', __('messages.update_bookshelf', ['attribute' => $request->input('bookshelf_name')]));
        return response()->json($result, $result['status']);
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
            $result['data'] = $this->bookshelfService->deleteById($id);
        } catch (Exception $e) {
            $result = [
                'status' => 500,
                'error' => $e->getMessage()
            ];
        }
        return response()->json($result, $result['status']);
    }
}