<?php

namespace App\Http\Controllers;

use App\Kos;
use App\Universitas;
use App\User;

class MapController extends Controller
{
    public function index()
    {
        $users = User::all();
        $universitas = Universitas::all();
        $i = 0;
        foreach ($users as $user) {
            foreach ($user->kos as $key => $koz) {
                $kos[$i] = $koz;
                $kos[$i]->nomor = $user->phone;
                $totalKamar = count($koz->kamars);
                $kamarTerisi = count($koz->kamars()->where('slot', 'T')->get());
                $kos[$i]->totalKamar = $totalKamar;
                $kos[$i]->kamarTerisi = $kamarTerisi;
                $kos[$i]->warna = $totalKamar == $kamarTerisi ? 'red' : 'green';
                $i++;
            }
        }
        return view('map', compact('kos', 'universitas'));
    }

    public function haver()
    {
        $universitas = Universitas::where('id', 1)->first();
        $lat1 = $universitas->lat;
        $lng1 = $universitas->lng;
        $kos = Kos::where('id_pemilik', 1)->get();

        function getDistance($latitude1, $longitude1, $latitude2, $longitude2)
        {

            $earth_radius = 6371;

            $dLat = deg2rad($latitude2 - $latitude1);
            $dLon = deg2rad($longitude2 - $longitude1);

            $a = sin($dLat / 2) * sin($dLat / 2) + cos(deg2rad($latitude1)) * cos(deg2rad($latitude2)) * sin($dLon / 2) * sin($dLon / 2);
            $c = 2 * asin(sqrt($a));
            $d = $earth_radius * $c;

            return $d;

        }
        echo "Lat1 : $lat1 | Lng1 : $lng1 <br>";
        foreach ($kos as $data) {
            $lat2 = $data->lat;
            $lng2 = $data->lng;
            echo "Lat2 : $lat2 | Lng2 : $lng2 | ";
            echo getDistance($lat1, $lng1, $lat2, $lng2) . " KM | $data->title <br>";
        }
    }
}
