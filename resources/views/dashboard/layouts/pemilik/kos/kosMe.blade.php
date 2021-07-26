@extends('dashboard.layouts.master')
@section('content')
<!-- Page Content -->
<div class="container-fluid">
    <h1 class="my-4">Lokasi Semua Kosan Ku</h1>
    <div class="row">
        <div class="col-12 border border-dark p-0">
            <div id="map" class="container-fluid"></div>
        </div>
    </div>
</div>
@endsection
@section('map')
<script>
      let kos = {!! json_encode($kos) !!}

     var latLng = [];

    kos.forEach((lok) => {

      latLng.push([lok.lng, lok.lat]);

    });

   mapboxgl.accessToken =
      'pk.eyJ1IjoicHJhbXVkeWEwOSIsImEiOiJja2Z1cTJnYWswdmVoMnFtNm91d2hpNG9hIn0.2wgNxmCFg-cnhUf95sF-sA';

   var map = new mapboxgl.Map({
        container: 'map',
        style: 'mapbox://styles/mapbox/light-v10',
        center: latLng[0],
        zoom: 14
    });

    latLng.forEach((maps) => {
    var marker = new mapboxgl.Marker({

        })
        .setLngLat(maps)
        .addTo(map);
    });





    //=======================GEOLOCATION==========================\\
    const geolocate = new mapboxgl.GeolocateControl({
      positionOptions: {
        enableHighAccuracy: true,
      },
      trackUserLocation: true,
      showAccuracyCircle: false,
    });

    map.addControl(geolocate);

</script>
</body>
@endsection
