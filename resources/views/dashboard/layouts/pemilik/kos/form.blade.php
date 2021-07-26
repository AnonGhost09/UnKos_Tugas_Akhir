<div class="form-group ml-4">
    <div class="row">
        <div class="col-md-6">
            <form action="{{$tombol === 'Edit Data' ? route('kos.update',$kos->id) : route('kos.store')}}" method="post"
                id="formPeta" enctype="multipart/form-data">
                @if($tombol === 'Edit Data')
                @method('PATCH')
                @endif
                @csrf
                <label for="title">Title : </label>
                <div class="input-group mb-3">
                    <input type="text" class="form-control"
                        class="form-control mb-3  @error('title') is-invalid @enderror" name="title" id="title"
                        aria-describedby="helpId" placeholder="Masukan title"
                        value="{{old('title') ?? $kos->title ?? ''}}">
                </div>
                @error('title')
                <div class="alert alert-danger">
                    {{$message}}
                </div>
                @enderror

                <label for="desc_kos">Desc : </label>
                <textarea type="text" class="form-control mb-3 @error('desc_kos') is-invalid @enderror" name="desc_kos"
                    id="desc_kos" aria-describedby="helpId"
                    placeholder="Masukan Deskripsi">{{old('desc_kos') ?? $kos->desc_kos ?? ''}}</textarea>
                @error('desc_kos')
                <div class="alert alert-danger">
                    {{$message}}
                </div>
                @enderror

                <label for="latitude">Latitude : </label>
                <input type="text" class="form-control mb-3  @error('lat') is-invalid @enderror" name="lat"
                    id="latitude" aria-describedby="helpId" placeholder="Drag Map"
                    value="{{old('lat') ?? $kos->lat ?? ''}}">
                @error('lat')
                <div class="alert alert-danger">
                    {{$message}}
                </div>
                @enderror

                <label for="longitude">Longitude : </label>
                <input type="text" class="form-control mb-3  @error('lng') is-invalid @enderror" name="lng"
                    id="longitude" aria-describedby="helpId" placeholder="Drag Map"
                    value="{{old('lng') ?? $kos->lng ?? ''}}">
                @error('lng')
                <div class="alert alert-danger">
                    {{$message}}
                </div>
                @enderror


                <label for="harga">Harga : </label>
                <input type="text" class="form-control mb-3  @error('harga') is-invalid @enderror" name="harga"
                    id="harga" aria-describedby="helpId" placeholder="Masukan Harga"
                    value="{{old('harga') ?? $kos->harga ?? ''}}">
                @error('harga')
                <div class="alert alert-danger">
                    {{$message}}
                </div>
                @enderror

                <label for="fasilitas">Fasilitas : </label>
                <div class="row ml-1">
                    @php
                    $i = 0
                    @endphp
                    @foreach($fasilitas as $data)
                    {{-- {{dd($kos->fasilitas[1])}} --}}
                    <div class="form-check mr-4">
                        <label class="form-check-label">
                            <input type="checkbox" class="form-check-input" name="fasilitas[]" value="{{$data->id}}"
                                @php if(!empty($kos->fasilitas[$i]->id)){
                            if(($kos->fasilitas[$i]->id == $data->id)){
                            echo 'checked';
                            $i++;
                            }
                            }
                            @endphp>
                            {{$data->nama_fasilitas}}
                        </label>
                    </div>
                    @endforeach
                </div>
                @error('fasilitas')
                <div class="alert alert-danger">
                    {{$message}}
                </div>
                @enderror



                <label for="gambar" class="mt-3">Gambar : </label>
                <input type="file" name="gambar" id="gambar" class="d-block mb-3">
                @if($tombol === 'Edit Data')
                <img src="{{asset("/storage/images/kos/$kos->gambar")}}" width="100%" height="200" id="fot2"
                    class="d-block">
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
    let kos = {!!json_encode($kos)!!}
        let centralkos = [kos.lng,kos.lat];
</script>
@else
<script>
    let centralkos = [106.73855557306,-6.2063431161804];
</script>
@endif

<script>
    //Harga
var harga = document.getElementById("harga");
harga.addEventListener("keyup", function(e) {
  // tambahkan 'Rp.' pada saat form di ketik
  // gunakan fungsi formatharga() untuk mengubah angka yang di ketik menjadi format angka
  harga.value = formatHarga(this.value, "Rp. ");
});

/* Fungsi formatharga */
function formatHarga(angka, prefix) {
  var number_string = angka.replace(/[^,\d]/g, "").toString(),
    split = number_string.split(","),
    sisa = split[0].length % 3,
    harga = split[0].substr(0, sisa),
    ribuan = split[0].substr(sisa).match(/\d{3}/gi);

  // tambahkan titik jika yang di input sudah menjadi angka ribuan
  if (ribuan) {
    separator = sisa ? "." : "";
    harga += separator + ribuan.join(".");
  }

  harga = split[1] != undefined ? harga + "," + split[1] : harga;
  return prefix == undefined ? harga : harga ? "Rp. " + harga : "";
}
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
            center: centralkos,
            zoom: 14
        });
    var marker = new mapboxgl.Marker({
        draggable: true,
      })
        .setLngLat(centralkos)
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
