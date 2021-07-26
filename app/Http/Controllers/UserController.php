<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function edit(User $user)
    {
        $users = Auth::user();
        return view('dashboard.layouts.profile', [
            'title' => 'My Profile',
            'users' => $users,
        ]);
    }

    public function update(Request $request, User $profil)
    {
        $validate = $request->validate([
            'nama' => ['required'],
            'email' => ['required', 'email', 'unique:users,email,' . $profil->id],
            'phone' => ['required', 'numeric', 'unique:users,phone,' . $profil->id],
            'gambar_profil' => ['sometimes', 'file', 'image', 'max:5000'],
        ]);

        if ($request->hasFile('gambar_profil')) {
            // if()
            File::delete("/storage/images/profile/$profil->gambar_profil");
            $imageEx = $request->gambar_profil->getClientOriginalExtension();
            $nama = Str::slug($request->nama);
            $file = $nama . '-' . time() . '-.' . $imageEx;
            $request->gambar_profil->storeAs('/public/images/profile', $file);
        } else {
            $file = $profil->gambar_profil;
        }

        $validate['gambar_profil'] = $file;

        $profil->update($validate);

        return redirect()->back()->with('update', "Data Profile $request->nama berhasil diudate");
    }
}
