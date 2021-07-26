<!doctype html>
<html lang="en">
<head>
  <title>Search By Map</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <script src="https://api.mapbox.com/mapbox-gl-js/v1.12.0/mapbox-gl.js"></script>
  <script src='https://npmcdn.com/@turf/turf/turf.min.js'></script>

  <link href="https://api.mapbox.com/mapbox-gl-js/v1.12.0/mapbox-gl.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <style>
    body {
      margin: 0;
      padding: 0;
    }

    #map {
      width: 100%;
      position:absolute;
      bottom:0;
      top:0;
    }

    img {
      width: 100%;
      height:100%;
    }

    #inRadius{
        position:absolute;
        margin-left:20px;
        margin-top:20px;
    }

    #instructions {
      position: absolute;
      height: 400px;
      margin: 20px;
      margin-top:50px;
      width: 25%;
      top: 0;
      bottom: 0;
      padding: 20px;
      background-color: rgba(255, 255, 255, 0.9);
      overflow-y: scroll;
      font-family: sans-serif;
    }

    .mapboxgl-popup {


    }

    .mapboxgl-popup-content{
      height:265px;
      width:500px;
    }

    #zok {
      overflow-y: scroll;
      max-width: 500px;
      max-height: 250px;
      height:250px;
      width:500px;
    }
  </style>
</head>

<body>
  <style>
    #marker {
      background-size: cover;
      width: 50px;
      height: 50px;
      border-radius: 50%;
      cursor: pointer;
    }

    #kos {
      background-size: cover;
      width: 50px;
      height: 50px;
      border-radius: 50%;
      cursor: pointer;
    }
  </style>
  <div id="map"></div>
  <div id='instructions'>
    <div id="calculated-line"></div>
    <div id="google_translate_element"></div>
  </div>
  <div class="text-dark" id="inRadius">
    <div class="custom-control custom-radio custom-control-inline">
      <input type="radio" id="1km" name="radius" value="1" class="custom-control-input" onclick="getData(this)" />
      <label class="custom-control-label" for="1km">1 Kilometer</label>
    </div>
    <div class="custom-control custom-radio custom-control-inline">
      <input type="radio" id="2km" name="radius" value="2" class="custom-control-input" onclick="getData(this)" />
      <label class="custom-control-label" for="2km">2 Kilometer</label>
    </div>
    <div class="custom-control custom-radio custom-control-inline">
      <input type="radio" id="3km" name="radius" value="3" class="custom-control-input" onclick="getData(this)" />
      <label class="custom-control-label" for="3km">3 Kilometer</label>
    </div>
    <div class="custom-control custom-radio custom-control-inline">
      <input type="radio" id="4km" name="radius" value="4" class="custom-control-input" onclick="getData(this)" />
      <label class="custom-control-label" for="4km">4 Kilometer</label>
    </div>
  </div>
  <script>

    var instructions = document.getElementById('instructions');
    //jika tidak kampus tidak bisa di klik
    function getData(data) {
      data.checked = false;
      alert('TEKAN DULU KAMPUSNYA !');
    }
    mapboxgl.accessToken =
      'pk.eyJ1IjoicHJhbXVkeWEwOSIsImEiOiJja2Z1cTJnYWswdmVoMnFtNm91d2hpNG9hIn0.2wgNxmCFg-cnhUf95sF-sA';//ambil API mapbox

      //pasang map dengan style tersebut, dan tentukan titik centernya dengan latitude dan longitude dengan zoom 11
    var map = new mapboxgl.Map({
      container: 'map',
      style: 'mapbox://styles/mapbox/light-v10',
      center: [106.738513, -6.2097560000000005],
      zoom: 11
    });

    var kampus = {!! json_encode($universitas) !!} //ambil data universitas dari php dan rubah menjadi json agar bisa di proses oleh javascript

    var lokasi = {!!json_encode($kos) !!} //ambil data kos dari php dan rubah menjadi json agar bisa di proses oleh javascript
    console.log(lokasi);
    var latLng = [];

    lokasi.forEach((lok) => {//filter data kos dan ambil bagian latitude dan longitudenya aja
      latLng.push([lok.lng, lok.lat]);
    });
    console.log(latLng);

    var points = turf.points(latLng);

    function haversine(lat1,lat2,lng1,lng2){//cari jarak terpendek
            var haver = Math.acos(Math.sin(lat1 * (Math.PI/180)) * Math.sin(lat2 * (Math.PI/180)) + Math.cos(lat1 * (Math.PI/180))
            * Math.cos(lat2 * (Math.PI/180)) * Math.cos((lng1 * (Math.PI/180)) - (lng2 * (Math.PI/180)))) * 6371;
            return haver;//dalam satuan KM
        }


    kampus.forEach(marker => {
      mapClear();
      var popup = new mapboxgl.Popup({
        offset: 25,
      }).setHTML(
        `<div id="zok">
                    <h1 style='text-align:center'>${marker.nama}</h1>
                    <strong> Deskripsi : </strong><span>${marker.desc_universitas}</span><br>
                    <center>
                        <img src="{{asset('/storage/images/universitas/${marker.gambar}')}}">
                    </center>
                </div>`
      );
      var lat = marker.lng;
      var lng = marker.lat;

      var el = document.createElement("div");
      el.id = "marker";
      el.style.backgroundImage = `url('/storage/images/universitas/${marker.gambar}')`;

      el.addEventListener("click", (e) => { //PENTING! KETIKA MARKER DI KLIK

        var radius = document.getElementById("inRadius");
        radius.children[0].children[0].checked = true;

        layerLokasi(radius = 1, lat, lng);
        var lat2 = lat;
        var lng2 = lng;


        this.getData = (data) => {
          var radius = data.value;

          layerLokasi(radius, lat2, lng2);
        }

      });

      const mars = new mapboxgl.Marker(el)
        .setLngLat([lat, lng])
        .setPopup(popup)
        .addTo(map);
    });



    function mapClear() {
      var mapLayer = map.getLayer("circle-fill");

      if (typeof mapLayer !== "undefined") {
        map.removeLayer("circle-fill");
        map.removeSource("circle-fill");
      }
    }

    function layerLokasi(radius, lat, lng) {
      mapClear();

      var mark2 = document.querySelectorAll('.mapboxgl-marker');
      if (!(mark2.length == 0)) {
        mark2.forEach(mark => {
          if (mark.id == 'kos') {
            mark.remove();
          }
        })
      }


      var center = turf.point([lat, lng]);
      // //zoom
      map.flyTo({
        center: [lat, lng],
        zoom: 12, //set zoom acuan 14
      });

      var options = {
        steps: 80,
        units: "kilometers",
        properties: {
          foo: "bar",
        },
      };
      var circle = turf.circle(center, radius, options);
      var markerWithin = turf.pointsWithinPolygon(this.points, circle, this.iden);

      map.addLayer({
        id: "circle-fill",
        type: "fill",
        source: {
          type: "geojson",
          data: circle,
        },
        paint: {
          "fill-color": "pink",
          "fill-opacity": 0.5,
        },
      });
      updateRoute(markerWithin, lat, lng);

    }




    //=======================DIRECTION=======================\\
    var formatter = new Intl.NumberFormat(['ban', 'id']);
    function updateRoute(markerWithin, lat, lng) {

      removeRoute(); // hapus layer jika klik universitas
      markerWithin.features.forEach((marker, index) => {

        //menampilkan popUp
        var al = document.createElement("div");
        al.id = "kos";
        al.style.backgroundImage = "url('https://image.flaticon.com/icons/png/512/63/63813.png')";
        //POPUP
        var popup = new mapboxgl.Popup({
          offset: 25,
        }).setHTML(
          `<div id='zok'>
                    <h1 style='text-align:center'>${lokasi[index].title}</h1>
                    <strong> Deskripsi : </strong><span>${lokasi[index].desc_kos}</span><br>
                    <strong> Available Kamar : </strong><span style="color:${lokasi[index].warna}">
                    ${lokasi[index].kamarTerisi}/${lokasi[index].totalKamar}</span><br>
                    <strong> Harga : </strong>RP. ${formatter.format(lokasi[index].harga)}
                    <center>
                        <img src="{{asset('/storage/images/kos/${lokasi[index].gambar}')}}" class="mb-3">
                        <a class="btn btn-success" href="https://api.WhatsApp.com/send?phone=${lokasi[index].nomor}">PESAN</a>
                        <a class="btn btn-primary" href="{{url('/filter/detail/${lokasi[index].id}')}}">DETAIL</a>
                    </center>
                </div>`
        );

        al.addEventListener('click', () => {
          removeRoute();
          let r = marker.geometry.coordinates;
          let c = [lat, lng]
          var coords = [c, r]
          // console.log('ez',coords)
          var newCoords = coords.join(';');
          getMatch(newCoords);
        })
        // Create marker
        const bars = new mapboxgl.Marker(al)
          .setLngLat(marker.geometry.coordinates)
          .setPopup(popup)
          .addTo(map);
      });
    }
    // make a directions request
    function getMatch(e) {

      var url = 'https://api.mapbox.com/directions/v5/mapbox/cycling/' + e +
        '?geometries=geojson&steps=true&access_token=' + mapboxgl.accessToken;
      var req = new XMLHttpRequest();
      req.responseType = 'json';
      req.open('GET', url, true);
      req.onload = function() {
        var jsonResponse = req.response;
        var distance = jsonResponse.routes[0].distance * 0.001;
        var duration = jsonResponse.routes[0].duration / 60;
        var steps = jsonResponse.routes[0].legs[0].steps;
        var coords = jsonResponse.routes[0].geometry;
        //  console.log(steps);
        console.log(coords);
        //  console.log(distance);
        // console.log(duration);

        // get route directions on load map
        console.log(steps)
        steps.forEach(function(step, index) {
          instructions.insertAdjacentHTML('beforeend', `<p> ${index+1}. ${step.maneuver.instruction} </p>`);
        });
        // get distance and duration
        instructions.insertAdjacentHTML('beforeend', `<p> Jarak: ${distance.toFixed(2)} km<br>Durasi: ${duration.toFixed(2)} menit </p>`);

        // add the route to the map
        addRoute(coords);

      };
      req.send();
    }

    function removeRoute() {
      if (map.getSource('route')) {
        map.removeLayer('route');
        map.removeSource('route');
        instructions.innerHTML = '';
      } else {
        return;
      }
    }

    function addRoute(coords) {

      // check if the route is already loaded
      if (map.getSource('route')) {
        map.removeLayer('route');
        map.removeSource('route')
      } else {
        map.addLayer({
          "id": "route",
          "type": "line",
          "source": {
            "type": "geojson",
            "data": {
              "type": "Feature",
              "properties": {},
              "geometry": coords
            }
          },
          "layout": {
            "line-join": "round",
            "line-cap": "round"
          },
          "paint": {
            "line-color": "#1db7dd",
            "line-width": 8,
            "line-opacity": 0.8
          }
        });
      };
    }

    //=======================GEOLOCATION==========================\\
    const geolocate = new mapboxgl.GeolocateControl({
      positionOptions: {
        enableHighAccuracy: true,
      },
      trackUserLocation: true,
      showAccuracyCircle: false,
    });

    map.addControl(geolocate);

    geolocate.on("geolocate", (e) => {
    console . log(geolocate.options.trackUserLocation);

      var radius = document.getElementById("inRadius");
      radius.children[0].children[0].checked = true;

      var lng = e.coords.longitude;
      var lat = e.coords.latitude;

      this.getData = (data) => {
        var radius = data.value;
        layerLokasi(radius, lng, lat);
      }
      layerLokasi(radius = 1, lng, lat);
    });
  </script>
</body>

</html>
