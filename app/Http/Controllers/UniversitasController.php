<?php

namespace App\Http\Controllers;

use App\Universitas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class UniversitasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.layouts.admin.universitas.create', ['title' => 'Tambah Universitas']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'nama' => ['required', 'min:4'],
            'gambar' => ['required', 'image', 'max:5000'],
            'lat' => ['required'],
            'lng' => ['required'],
            'desc_universitas' => ['required', 'min:5']
        ]);

        $imageEx = $request->gambar->getClientOriginalExtension();
        $nama = Str::slug($request->nama);
        $file = $nama . '-' . time() . '-.' . $imageEx;
        $request->gambar->storeAs('/public/images/universitas', $file);

        $validate['gambar'] = $file;
        Universitas::create($validate);

        return redirect()->route('admin.dashboard')->with('add', "Data Universitas $request->nama Berhasil Ditambahkan");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Universitas  $universitas
     * @return \Illuminate\Http\Response
     */
    public function show(Universitas $universitas)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Universitas  $universitas
     * @return \Illuminate\Http\Response
     */
    public function edit(Universitas $universita, Request $request)
    {
        return view('dashboard.layouts.admin.universitas.edit', ['title' => 'Edit Data', 'universitas' => $universita]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Universitas  $universitas
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Universitas $universita)
    {
        $validate = $request->validate([
            'nama' => ['required', 'min:6'],
            'lat' => [],
            'lng' => [],
            'gambar' => ['sometimes', 'file', 'image', 'max:2000'],
            'desc_universitas' => []
        ]);
        if ($request->hasFile('gambar')) {
            File::delete("/storage/images/universitas/$universita->gambar");
            $imageEx = $request->gambar->getClientOriginalExtension();
            $nama = Str::slug($request->nama);
            $file = $nama . '-' . time() . '-.' . $imageEx;
            $request->gambar->storeAs('/public/images/universitas', $file);
        } else {
            $file = $universita->gambar;
        }
        $validate['gambar'] = $file;
        $universita->update($validate);

        return redirect()->route('admin.dashboard')->with('update', "Data Universitas $request->nama Berhasil Diupdate");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Universitas  $universitas
     * @return \Illuminate\Http\Response
     */
    public function destroy(Universitas $universita) //harus sama dengan yg di ur;
    {
        $nama = $universita->nama;
        File::delete("storage/images/universitas/$universita->gambar");
        $universita->delete();
        return redirect()->route('admin.dashboard')->with('delete', "Data Universitas $nama berhasil dihapus");
    }
}
