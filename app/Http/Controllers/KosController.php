<?php

namespace App\Http\Controllers;

use App\Fasilitas;
use App\Gambar;
use App\Kamar;
use App\Kos;
use App\Pemilik;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class KosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function kosMe()
    {
        $kos = Auth::user()->kos;
        $title = 'Kos Me';
        return view('dashboard.layouts.pemilik.kos.kosMe', compact('kos', 'title'));
    }

    public function index(Request $request)
    {
        if (Auth::user()->roles->first()->role == 'pemilik') {
            return abort(403);

        }
        $kos = Kos::paginate(6);
        $title = 'Admin Kos';
        return view('dashboard.layouts.admin.kos.index', compact('kos', 'title'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $fasilitas = Fasilitas::all();
        return view('dashboard.layouts.pemilik.kos.create', ['title' => 'Tambah Kos', 'fasilitas' => $fasilitas]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request['harga'] = preg_replace('/[^0-9]/', '', $request->harga);
        $request->validate([
            'title' => ['required', 'min:5'],
            'desc_kos' => ['required', 'min:5'],
            'lat' => ['required'],
            'lng' => ['required'],
            'harga' => ['required', 'numeric'],
            'fasilitas' => ['required'],
            'gambar' => ['required', 'image', 'max:5000'],
        ]);

        $imageEx = $request->gambar->getClientOriginalExtension();
        $nama = Str::slug($request->nama);
        $file = $nama . '-' . time() . '-.' . $imageEx;
        $request->gambar->storeAs('/public/images/kos', $file);

        $validate['gambar'] = $file;
        //create kos and fasilitas
        $id = User::find(Auth::user()->id)->pemiliks->id;
        $pemilik = Pemilik::find($id);
        $pemilik->kos()->create([
            'title' => $request->title,
            'desc_kos' => $request->desc_kos,
            'lat' => $request->lat,
            'lng' => $request->lng,
            'harga' => $request->harga,
            'gambar' => $file,
        ])->fasilitas()->sync(array_map('intval', $request->fasilitas));

        return redirect()->route('pemilik.dashboard')->with('add', "Kos dengan nama $request->name berhasil dimasukan");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Kos $ko)
    {
        $pemilik = Pemilik::where('id', $ko->id_pemilik)->first();
        if (Auth::user()->id != $pemilik->id_user and !(Auth::user()->roles->first()->role == 'admin')) {
            return abort(403);
        }

        $kamars = Kamar::where('id_kos', $ko->id)->get();
        foreach ($kamars as $key => $kamar) {
            $kamars[$key]['gambars'] = Gambar::where('id_kamar', $kamar->id)->get();
        }

        $slotS = Kamar::where('id_kos', $ko->id)->where('slot', 'T')->get()->count();
        $slotJ = $kamars->count();
        return view('dashboard.layouts.pemilik.kos.show', [
            'title' => 'Detail Kos',
            'kos' => $ko, $ko->fasilitas,
            'kamars' => $kamars,
            'slotS' => $slotS,
            'slotJ' => $slotJ,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Kos $ko)
    {
        $fasilitas = Fasilitas::all();
        return view('dashboard.layouts.pemilik.kos.edit', [
            'title' => 'Edit Data',
            'kos' => $ko,
            'fasilitas' => $fasilitas,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Kos $ko)
    {
        $request['harga'] = preg_replace('/[^0-9]/', '', $request->harga);
        $validate = $request->validate([
            'title' => ['required', 'min:5'],
            'desc_kos' => ['required', 'min:5'],
            'lat' => ['required'],
            'lng' => ['required'],
            'harga' => ['required', 'numeric'],
            'fasilitas' => ['required'],
            'gambar' => ['sometimes', 'file', 'image', 'max:5000'],
        ]);
        if ($request->hasFile('gambar')) {
            File::delete("/storage/images/kos/$ko->gambar");
            $imageEx = $request->gambar->getClientOriginalExtension();
            $nama = Str::slug($request->title);
            $file = $nama . '-' . time() . '-.' . $imageEx;
            $request->gambar->storeAs('/public/images/kos', $file);
        } else {
            $file = $ko->gambar;
        }

        $validate['gambar'] = $file;
        // $ko->update($validate);
        $ko->update([
            'title' => $request->title,
            'desc_kos' => $request->desc_kos,
            'lat' => $request->lat,
            'lng' => $request->lng,
            'harga' => $request->harga,
            'gambar' => $file,
        ]);
        $ko->fasilitas()->sync(array_map('intval', $request->fasilitas));
        return redirect()->route('pemilik.dashboard')->with('update', "Data Kos $request->nama_title berhasil diudate");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Kos $ko)
    {
        $title = $ko->title;
        File::delete("/storage/images/kos/$ko->gambar");
        $ko->delete();
        return redirect()->back()->with('delete', "Data kos $title berhasil dihapus");
    }
}
