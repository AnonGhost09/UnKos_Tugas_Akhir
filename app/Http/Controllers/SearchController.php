<?php

namespace App\Http\Controllers;

use App\Fasilitas;
use App\Kamar;
use App\Kos;
use App\Pemilik;
use App\Role;
use App\Universitas;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SearchController extends Controller
{
    public function searchKos(Request $request)
    {
        $kos = Auth::user()->kos()->where('title', 'LIKE', "%$request->searchKos%")->paginate(5);
        $id = User::find(Auth::user()->id)->pemiliks->id;
        $pemilik = Pemilik::find($id);
        $kamar = $pemilik->kamars()->get();

        $totalKos = count($pemilik->kos()->get());
        $totalKamar = count($kamar);
        $kamarF = count($pemilik->kamars()->where('slot', 'F')->get());
        $kamarT = count($pemilik->kamars()->where('slot', 'T')->get());
        if ($totalKamar != 0) {
            $totalTerisiB = ($kamarT / $totalKamar) * 100;
            $totalKosongB = ($kamarF / $totalKamar) * 100;
        } else {
            $totalTerisiB = 0;
            $totalKosongB = 0;

        }
        return view('dashboard.index', [
            'title' => 'Pemilik Kos',
            'kos' => $kos,
            'totalKos' => $totalKos,
            'totalKamar' => $totalKamar,
            'kamarT' => $kamarT,
            'kamarF' => $kamarF,
            'totalTerisiB' => $totalTerisiB,
            'totalKosongB' => $totalKosongB,
        ]);

    }

    public function searchFasilitas(Request $request)
    {
        $fasilitas = Fasilitas::where('nama_fasilitas', 'LIKE', "%$request->searchFasilitas%")->paginate(5);
        return view('dashboard.layouts.admin.fasilitas.index', ['title' => 'Fasilitas', 'fasilitas' => $fasilitas]);

    }

    public function searchPemilik(Request $request)
    {
        $pemiliks = Role::where('id', 2)->first()->users()->where('nama', 'LIKE', "%$request->searchPemilik%")->paginate(6);
        $title = 'Admin Pemilik';
        return view('dashboard.layouts.admin.pemilik.index', compact('pemiliks', 'title'));
    }

    public function searchKosA(Request $request)
    {
        $kos = Kos::where('title', 'LIKE', "%$request->searchKos%")->paginate(6);
        $title = 'Admin Kos';

        return view('dashboard.layouts.admin.kos.index', compact('kos', 'title'));
    }

    public function searchUniversitas(Request $request)
    {
        $universitas = Universitas::where('nama', 'LIKE', "%$request->searchUniversitas%")->latest()->paginate(5);
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
}
