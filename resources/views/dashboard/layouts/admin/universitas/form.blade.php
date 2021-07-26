<div class="form-group ml-4">
        <div class="row">
            <div class="col-md-6">
                <form action="{{$tombol === 'Edit Data' ? route('universitas.update',$universitas->id) : route('universitas.store')}}" method="post" id="formPeta" enctype="multipart/form-data">
                   @if($tombol === 'Edit Data')
                        @method('PATCH')
                    @endif
                    @csrf
                    <label for="nama">Nama : </label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon3">Universitas</span>
                        </div>
                    <input type="text" class="form-control" class="form-control mb-3  @error('nama') is-invalid @enderror" name="nama" id="nama" aria-describedby="helpId" placeholder="Masukan Nama" value="{{old('nama') ?? $universitas->nama ?? ''}}">
                    </div>
                     @error('nama')
                     <div class="alert alert-danger">
                        {{$message}}
                     </div>
                     @enderror

                    <label for="desc_universitas">Desc : </label>
                    <textarea type="text" class="form-control mb-3 @error('desc_universitas') is-invalid @enderror"
                    name="desc_universitas" id="desc_universitas" aria-describedby="helpId" placeholder="Masukan Deskripsi">{{old('desc_universitas') ?? $universitas->desc_universitas ?? ''}}</textarea>
                    @error('desc_universitas')
                    <div class="alert alert-danger">
                        {{$message}}
                     </div>
                    @enderror

                    <label for="latitude">Latitude : </label>
                    <input type="text"
                        class="form-control mb-3  @error('lat') is-invalid @enderror" name="lat" id="latitude" aria-describedby="helpId" placeholder="Drag Map" value="{{old('lat') ?? $universitas->lat ?? ''}}">
                    @error('lat')
                    <div class="alert alert-danger">
                        {{$message}}
                     </div>
                    @enderror

                    <label for="longitude">Longitude : </label>
                    <input type="text"
                        class="form-control mb-3  @error('lng') is-invalid @enderror" name="lng" id="longitude" aria-describedby="helpId" placeholder="Drag Map" value="{{old('lng') ?? $universitas->lng ?? ''}}">
                    @error('lng')
                    <div class="alert alert-danger">
                        {{$message}}
                     </div>
                    @enderror

                    <label for="gambar">Gambar : </label>
                    <input type="file" name="gambar" id="gambar" class="d-block mb-3">
                    @if($tombol === 'Edit Data')
                        <img src="{{asset("/storage/images/universitas/$universitas->gambar")}}" width="100%" height="200" id="fot2" class="d-block">
                    @else
                        <img src="" id="fot2" class="d-block">
                    @endif
                    @error('gambar')
                    <div class="alert alert-danger">
                        {{$message}}
                     </div>
                    @enderror
                    <button type="submit" class="btn btn-primary mt-5">{{$tombol}}</button>
                </form>
            </div>
            <div id="map" class="mt-4 col-md-6"></div>
        </div>
    </div>

@section('map')

 @if($tombol === 'Edit Data')
    <script>
        let univ = {!!json_encode($universitas)!!}
        let centralUniv = [univ.lng,univ.lat];
    </script>
 @else
    <script>
        let centralUniv = [106.73855557306,-6.2063431161804];
    </script>
 @endif

        <script>
            //read image

            let gambar = document.getElementById('gambar');
            let fot2 = document.getElementById('fot2');
            gambar.addEventListener('change',function(){
                readURL(this);
            });
        function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
            fot2.src = e.target.result;
            fot2.style.width = "100%";
            fot2.style.height = 200;
            }

            reader.readAsDataURL(input.files[0]); // convert to base64 string
        }
        }

       mapboxgl.accessToken =
            'pk.eyJ1IjoicHJhbXVkeWEwOSIsImEiOiJja2Z1cTJnYWswdmVoMnFtNm91d2hpNG9hIn0.2wgNxmCFg-cnhUf95sF-sA';
    let form = document.forms.formPeta;
        var map = new mapboxgl.Map({
            container: 'map',
            style: 'mapbox://styles/mapbox/light-v10',
            center: centralUniv,
            zoom: 14
        });
    var marker = new mapboxgl.Marker({
        draggable: true,
      })
        .setLngLat(centralUniv)
        .addTo(map);
      marker.on("drag", function(){
        var lngLat = marker.getLngLat();
        form.latitude.value = lngLat.lat;
        form.longitude.value = lngLat.lng;
      });
      const geolocate = new mapboxgl.GeolocateControl({
        positionOptions: {
          enableHighAccuracy: true,
        },
        trackUserLocation: true,
        showAccuracyCircle: false,
      });
      map.addControl(geolocate);
      // e.target.options.showAccuracyCircle = false;
      geolocate.on("geolocate", function (e) {
          var mark2 = document.querySelectorAll('.mapboxgl-marker'); //hapus marker yang ganda
            if (mark2.length > 1) {
                mark2.forEach(mark => {
                    if(true){
                        mark.remove();
                    }
                })
            }
        var long = e.coords.longitude;
        var lat = e.coords.latitude;
        map.flyTo({
          center: [long, lat],
          zoom: 15, //set zoom acuan 14
        });
    var marker = new mapboxgl.Marker({
        draggable: true,
      })
        .setLngLat([long, lat])
        .addTo(map);
      marker.on("drag", function(){
        var lngLat = marker.getLngLat();

        form.latitude.value = lngLat.lat;
        form.longitude.value = lngLat.lng;
      });
      });
  </script>
    @endsection
