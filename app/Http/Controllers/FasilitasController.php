<?php

namespace App\Http\Controllers;

use App\Fasilitas;
use Illuminate\Http\Request;

class FasilitasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $fasilitas = Fasilitas::latest()->paginate(5);
        return view('dashboard.layouts.admin.fasilitas.index', ['title' => 'Fasilitas', 'fasilitas' => $fasilitas]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
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
            'nama_fasilitas' => ['required']
        ]);
        Fasilitas::create($validate);

        return back()->with('add', "Data Fasilitas $request->nama_fasilitas berhasil dimasukan");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
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
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Fasilitas $fasilita)
    {
        $validate = $request->validate([
            'nama_fasilitas' => ['required']
        ]);
        $fasilita->update($validate);

        return redirect()->route('fasilitas.index')->with('update', "Data Fasilitas $request->nama_fasilitas berhasil diudate");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Fasilitas $fasilita)
    {
        $nama = $fasilita->nama;
        $fasilita->delete();
        return back()->with('delete', "Data Fasilitas $nama berhasil dihapus");
    }
}
