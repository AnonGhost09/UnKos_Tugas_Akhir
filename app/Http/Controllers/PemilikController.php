<?php

namespace App\Http\Controllers;

use App\Kos;
use App\Pemilik;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class PemilikController extends Controller
{

    public function destroy($user)
    {
        $user = User::find($user);
        $title = $user->nama;
        File::delete("/storage/images/profile/$user->gambar_profil");
        $user->delete();
        return redirect()->back()->with('delete', "Data kos $title berhasil dihapus");

    }

    public function view(Request $request)
    {
        $id = User::find(Auth::user()->id)->pemiliks->id;
        $pemilik = Pemilik::find($id);
        $kos = $pemilik->kos()->latest()->paginate(5);
        $kamar = $pemilik->kamars()->get();
        // $pemilik = Pemilik::find($id);
        // // dd($pemilik);
        // // $totalKamar = count($pemilik->kamars);
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

        // $totalTerisiA = count($pemilik->kamars()->where('slot', 'terisi')->get()) ?? 0;
        // $totalTerisiB = (count($pemilik->kamars()->where('slot', 'terisi')->get()) / $totalKamar) * 100;
        // $totalKosongA = count($pemilik->kamars()->where('slot', 'kosong')->get());
        // $totalKosongB = (count($pemilik->kamars()->where('slot', 'kosong')->get()) / $totalKamar) * 100;
        // return view('dashboard.index')->with(
        //     [
        //         'title' => 'Dashboard Pemilik',
        //         'totalKos' => $totalKos,
        //         'totalKamar' => $totalKamar,
        //         'totalTerisiA' => $totalTerisiA,
        //         'totalTerisiB' => $totalTerisiB,
        //         'totalKosongA' => $totalKosongA,
        //         'totalKosongB' => $totalKosongB
        //     ]
        // );
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
}
