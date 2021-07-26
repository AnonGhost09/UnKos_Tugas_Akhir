<?php

namespace App\Http\Controllers;

use App\Fasilitas;
use App\Kos;
use App\Universitas;
use Illuminate\Http\Request;

class FilterController extends Controller
{
    public function index()
    {
        $kos = Kos::paginate(6);
        $fasilitas = Fasilitas::all();
        $universitas = Universitas::all();
        $checkH = 'all';
        $checkF = '';

        return view('filter', compact('kos', 'fasilitas', 'universitas', 'checkH', 'checkF'));
    }

    public function filter(Request $request)
    {

        $checkF = $request->sortingUniversitas;
        $checkH = $request->harga;
        $fasilitas = Fasilitas::all();
        $universitas = Universitas::all();
        // $kos = Kos::all();
        //         $kos = Kos::whereHas('fasilitas', function (Builder $query) {
        //     $query->where('id_fasilitas', [2, 1]);
        // })->get();

        // dd($kos->kamars()->where('slot', 'T')->count());
        $filterF = Fasilitas::find($request->fasilitas);
        // dd($filterF[0]->kos()->get()); //penting ini untuk filter all
        // $kos = Kos::whereHas('fasilitas', function ($query) {
        //     $query->where('id_fasilitas', $filterF);
        // })->get();

        if ($request->sortingUniversitas != 'universitas') {

            $universitasF = Universitas::where('id', $request->sortingUniversitas)->first();
            $lat1 = $universitasF->lat;
            $lng1 = $universitasF->lng;

            $kos = Kos::selectRaw("*,  ( 6371 * acos( cos( radians(" . $lat1 . ") ) *
                                        cos( radians(lat) ) *
                                        cos( radians(lng) - radians(" . $lng1 . ") ) +
                                        sin( radians(" . $lat1 . ") ) *
                                        sin( radians(lat) ) ) )
                                        AS jarak")->having("jarak", "<", 4)->orderBy("jarak");

        } else {
            $kos = new Kos;
        }

        if ($request->has('fasilitas')) { //jika diklik fasilitas
            if ($request->harga == 'all') { //jika di klik harga
                $kos = $kos->whereHas('fasilitas', function ($query) use ($request) {
                    $query->whereIn('id_fasilitas', $request->fasilitas);
                })->paginate(6);

            } else { //jika tidak di klik harga

                if ($request->harga > '1000000') {
                    $hargaA = $request->harga;
                    $kos = $kos->where('harga', '>', $hargaA)->whereHas('fasilitas', function ($query) use ($request) {
                        $query->whereIn('id_fasilitas', $request->fasilitas);
                    })->paginate(6);

                } else if ($request->harga > '600000') {
                    $hargaA = 600000;
                    $hargaB = $request->harga;
                    $kos = $kos->where('harga', '>', $hargaA)->where('harga', '<', $hargaB)->whereHas('fasilitas', function ($query) use ($request) {
                        $query->whereIn('id_fasilitas', $request->fasilitas);
                    })->paginate(6);
                } else {
                    $hargaA = 0;
                    $hargaB = $request->harga;
                    $kos = $kos->where('harga', '>', $hargaA)->where('harga', '<', $hargaB)->whereHas('fasilitas', function ($query) use ($request) {
                        $query->whereIn('id_fasilitas', $request->fasilitas);
                    })->paginate(6);
                }

                // foreach ($filterF as $fasil) {
                //     if ($request->harga > '1000000') {
                //         $hargaA = $request->harga;
                //         $kos = $fasil->kos()->where('harga', '>', $hargaA)->paginate(6);

                //     } else if ($request->harga > '600000') {
                //         $hargaA = 600000;
                //         $hargaB = $request->harga;
                //         $kos = $fasil->kos()->where('harga', '>', $hargaA)->where('harga', '<', $hargaB)->paginate(6);
                //     } else {
                //         $hargaA = 0;
                //         $hargaB = $request->harga;
                //         $kos = $fasil->kos()->where('harga', '>', $hargaA)->where('harga', '<', $hargaB)->paginate(6);
                //     }
                // }
            }

        } else { //jika tidak klik fasiltas
            if ($checkH == 'all') {
                //jika universitas yidka di filter larikan ke route index
                $kos = $kos->paginate(6);

            } else if ($request->harga > '1000000') {
                $hargaA = $request->harga;
                $kos = $kos->where('harga', '>', $hargaA)->paginate(6);

            } else if ($request->harga > '600000') {

                $hargaA = 600000;
                $hargaB = $request->harga;
                $kos = $kos->where('harga', '>', $hargaA)->where('harga', '<', $hargaB)->paginate(6);

            } else {
                $hargaA = 0;
                $hargaB = $request->harga;
                $kos = $kos->where('harga', '>', $hargaA)->where('harga', '<', $hargaB)->paginate(6);
            }

        }
        return view('filter', compact('fasilitas', 'universitas', 'kos', 'checkH', 'checkF'));
    }

    public function detail(Request $request, Kos $kos)
    {
        $slotJ = $kos->kamars()->count();
        $slotS = $kos->kamars()->where('slot', 'T')->count();
        $kamars = $kos->kamars()->get();
        return view('filterDetail', compact('kos', 'slotJ', 'slotS', 'kamars'));
    }

}
