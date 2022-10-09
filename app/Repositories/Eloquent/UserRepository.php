<?php

namespace App\Repositories\Eloquent;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Repositories\UserRepositoryInterface;


class UserRepository implements UserRepositoryInterface
{
    public function getAll()
    {
        return User::all();
    }

    public function getById($id)
    {
        return User::find($id);
    }

    public function getDatatable()
    {
        $users = User::whereIn('user_role', [2])->get();
        $datatable = datatables()->of($users)
                        ->addColumn('action', function($data){
                            $button = '<a href="users/'.$data->id.'/edit" class="d-sm-inline-block btn btn-sm btn-success shadow-sm mx-1"><i class="fas fa-edit fa-sm"></i> Edit</a>';
                            $button .= '&nbsp;&nbsp;';
                            $button .= '<button type="button" name="delete" id="'.$data->id.'"class="delete d-sm-inline-block btn btn-sm btn-danger shadow-sm mx-1"><i class="fas fa-trash-alt fa-sm"></i> Hapus</button>'; 
                            return $button;
                        })
                        ->rawColumns(['action'])
                        ->addIndexColumn()
                        ->make(true);
        return $datatable;
    }

    public function getDataByQuery($data)
    {
        $search = isset($data['q']) ? $data['q'] : '';
        return User::select('id', 'name')
                            ->where('name', 'like', "%{$search}%")
                            ->get();
    }

    public function getDataAdminByQuery($data)
    {
        $search = isset($data['q']) ? $data['q'] : '';
        $user = User::whereIn('user_role', ['admin'])
                            ->select('id', 'name')
                            ->where('name', 'like', "%{$search}%")
                            ->get();
        return $user;
    }

    public function getDataMemberByQuery($data)
    {
        $search = isset($data['q']) ? $data['q'] : '';
        $user = User::whereIn('user_role', ['member'])
                            ->select('id', 'name')
                            ->where('name', 'like', "%{$search}%")
                            ->get();
        return $user;
    }

    public function isAdmin()
    {
        $user = User::whereIn('user_role', ['admin'])
                            ->get();
        return $user;
    }

    public function isMember()
    {
        $user = User::whereIn('user_role', ['member'])
                            ->get();
        return $user;
    }

    public function save($data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'gender' => $data['gender'],
            'password' => Hash::make($data['password']),
        ]);
    }

    public function update($data, $id)
    {
        $user =  User::find($id);

        if(isset($data['password'])) {
            $password = Hash::make($data['password']);
        } else {
            $password = $user->password;
        }

        return User::where('id', $id)
            ->update([
                'name' => $data['name'],
                'email' => $data['email'],
                'gender' => $data['gender'],
                'password' => $password,
            ]);
    }

    public function delete($id)
    {
        return User::where('id', $id)
            ->delete($id);
    }
}