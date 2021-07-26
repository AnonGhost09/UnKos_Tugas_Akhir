<?php

namespace App\Http\Controllers;

use App\Fasilitas;
use App\Kamar;
use App\Kos;
use App\Pemilik;
use App\Role;
use App\Universitas;

class AdminController extends Controller
{

    public function index()
    {
        $universitas = Universitas::latest()->paginate(5);
        $fasilitas = count(Fasilitas::all());
        $kos = count(Kos::all());
        $pemilik = count(Pemilik::all());
        $kamar = count(Kamar::all());

        // if (Auth::user()->roles->first()->id != 1) {
        //     return redirect()->route('pemilik.dashboard');
        // }
        return view('dashboard.layouts.admin.admin', [
            'title' => 'admin',
            'universitas' => $universitas,
            'fasilitas' => $fasilitas,
            'kos' => $kos,
            'pemilik' => $pemilik,
            'kamar' => $kamar,
        ]);
    }

    public function adPemilik()
    {
        $pemiliks = Role::where('id', 2)->first()->users()->paginate(6);
        $title = 'Admin Pemilik';
        return view('dashboard.layouts.admin.pemilik.index', compact('pemiliks', 'title'));
    }

}
