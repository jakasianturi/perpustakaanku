<?php

namespace App\Repositories\Eloquent;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Repositories\ProfileRepositoryInterface;


class ProfileRepository implements ProfileRepositoryInterface
{
    public function update($data, $id)
    {
        $user = User::find($id);

        if(isset($data['password'])) {
            $password = Hash::make($data['password']);
        } else {
            $password = $user->password;
        }

        $gender = isset($data['gender']) ? $data['gender'] : 'L';

        return User::where('id', $id)
            ->update([
                'name'      => $data['name'],
                'email'     => $data['email'],
                'address'   => $data['address'],
                'phone'     => $data['phone'],
                'gender'    => $gender,
                'password'  => $password,
            ]);
    }

    public function updateAvatar($data, $id)
    {
        $user = User::find($id);
        $name = $user->name;

        $image_parts = explode(";base64,", $data);
        $image_base64 = base64_decode($image_parts[1]);
        $imgName = Str::slug($name, '-');
        $fileName = time() . '-' . $imgName . '.png';
        Storage::disk('local')->put('public/uploads/'.$fileName, $image_base64);

        return User::where('id', $id)
            ->update([
                'avatar'      => $fileName,
            ]);
    }
}