<?php

namespace App\Http\Controllers;

use App\Gambar;
use App\Kamar;
use App\Kos;
use App\Pemilik;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class KamarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function slot(Request $request, $ko)
    {

        foreach ($request['slot'] as $key => $slot) {
            $kamar = Kamar::find($key);
            if (($ko == $kamar->id_kos) and ($slot == 'F' or $slot == 'T')) {
                $kamar->update(
                    [
                        'slot' => $slot,
                    ]
                );
            }
        }
        return redirect()->back()->with('update', 'Slot kamar berhasil di dirubah');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $kos = Kos::where('id', $id)->firstOrFail();
        $pemilik = Pemilik::where('id', $kos->id_pemilik)->first();
        if (Auth::user()->id != $pemilik->id_user) {
            return abort(403);
        }
        return view('dashboard.layouts.pemilik.kamar.create', [
            'title' => 'Tambah Kamar',
            'kos' => $id,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $kos = Kos::find($request->kos);

        $request->validate(
            [
                'desc_kamar' => ['required', 'min:5'],
                'gambar' => ['required'],
                'gambar.*' => ['mimes:doc,pdf,docx,txt,zip,jpeg,jpg,png'],

            ]
        );
        $kamar = Kamar::create(
            [
                'desc_kamar' => $request->desc_kamar,
                'id_kos' => $kos->id,
            ]
        );

        foreach ($request->gambar as $gambar) {
            $imageEx = $gambar->getClientOriginalExtension();
            $nama = $kos->title;
            $file = $nama . '-' . microtime();
            $fileU = Str::slug($file) . '.' . $imageEx;
            $gambar->storeAs('/public/images/kamar', $fileU);

            Gambar::create(
                [
                    'nama' => $fileU,
                    'id_kamar' => $kamar->id,
                ]
            );

        }
        return redirect()->route("kos.show", $kos->id)->with('add', "Kamar berhasil ditambahkan");

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($kos)
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
        $kamar = Kamar::where('id', $id)->firstOrFail();

        $kos = Kos::where('id', $kamar->id_kos)->firstOrFail();

        $pemilik = Pemilik::where('id', $kos->id_pemilik)->first();

        if (Auth::user()->id != $pemilik->id_user) {
            return abort('403'); //jika dia mau ke id yang tidak login larang
        }

        $kamars = Kamar::where('id', $id)->get();

        foreach ($kamars as $key => $kamar) {
            $kamars[$key]['gambars'] = Gambar::where('id_kamar', $kamar->id)->get();

        }

        $kamar = $kamars->first();
        $title = 'Edit Data Kamar';
        return view('dashboard.layouts.pemilik.kamar.edit', compact('kamar', 'title'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $request->validate(
            [
                'desc_kamar' => ['required', 'min:5'],
                'gambar.*' => ['mimes:doc,pdf,docx,txt,zip,jpeg,jpg,png'],

            ]
        );

        $kamar = Kamar::find($id);
        $kos = Kos::find($kamar->id_kos);
        try {
            if (count($request->gambarsH) == Gambar::where('id_kamar', $kamar->id)->count()) {

                return redirect()->back()->with('error', 'Gagal Mengupdate Data, Sisakan 1 Image Untuk Data Kamar');

            }

            throw new \Exception('ada kesalahan');

        } catch (\Exception $e) {

            $kamar->update(
                [
                    'desc_kamar' => $request->desc_kamar,
                ]
            );

            if ($request->gambarsH != null) {
                foreach ($request->gambarsH as $gambarH) {
                    $gambarH = Gambar::find($gambarH);
                    File::delete("/storage/images/kamar/$gambarH->nama");
                    $gambarH->delete();
                }
            }

            if ($request->hasFile('gambar')) {
                foreach ($request->gambar as $gambar) {
                    $imageEx = $gambar->getClientOriginalExtension();
                    $nama = $kos->title;
                    $file = $nama . '-' . microtime();
                    $fileU = Str::slug($file) . '.' . $imageEx;
                    $gambar->storeAs('/public/images/kamar', $fileU);

                    Gambar::create(
                        [
                            'nama' => $fileU,
                            'id_kamar' => $kamar->id,
                        ]
                    );
                }
            }

            return redirect()->back()->with('update', 'Data Kamar Berhasil di Perbarui');

        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $kamar = Kamar::find($id);
        $gambars = Gambar::where('id_kamar', $kamar->id)->get();
        foreach ($gambars as $gambar) {
            File::delete("/storage/images/kamar/$gambar->nama");
        }
        $kamar->delete();
        return back()->with('delete', "Data Kamar berhasil dihapus");

    }
}
