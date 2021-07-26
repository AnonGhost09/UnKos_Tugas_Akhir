@extends('dashboard.layouts.master')
@section('content')
<!-- Page Content -->
<div class="container-fluid">
    <h1 class="my-4">Lokasi Kos</h1>
    <div class="row">
        <div class="col-12 border border-dark p-0">
            <div id="map" class="container-fluid"></div>
        </div>
    </div>
    <!-- Portfolio Item Heading -->
    <h1 class="my-4">{{$kos->title}}</h1>

    <!-- Portfolio Item Row -->
    <div class="row">

        <div class="col-lg-6">
            <img class="img" width="100%" height="350px" src="{{asset("/storage/images/kos/$kos->gambar")}}" alt="">
        </div>

        <div class="col-lg-3 border-right border-dark">
            <h3 class="my-3 text-center">Deskripsi Kos</h3>
            <p class="h5">{{$kos->desc_kos}}</p>
            <h3 class="mt-3 mb-3 text-center">Harga</h3>
            <p class="h5">@currency($kos->harga)</p>

        </div>

        <div class="col-lg-3">
            <h3 class="my-3 text-center">Fasilitas</h3>
            <div class="row">
                @foreach ($kos->fasilitas as $data)
                <ul class="mb-0">
                    <li>{{$data->nama_fasilitas}}</li>
                </ul>
                @endforeach
            </div>
            <h3 class="mt-3 mb-3 text-center">Slot Kamar</h3>
            @if ($slotS != $slotJ)
            <p class="text-success h1">{{$slotS}}/{{$slotJ}}</p>
            @else
            <p class="text-danger h1">{{$slotS}}/{{$slotJ}}</p>
            @endif
        </div>

    </div>
    <!-- /.row -->

    <!-- Related Projects Row -->
    <div class="border-top border-dark mt-4">
        <h3 class="my-4 ">Daftar Kamar</h3>
        <div class="row">
            <div class="d-sm-inline-block col-md-4 mr-auto my-2 my-md-0 mw-100"></div>
            <form action="{{route('slot.update',$kos->id)}}" method="post">
                @method('PATCH')
                @csrf
                @if(!(Auth::user()->roles->first()->role == 'admin'))
                <input type="submit" class="btn btn-success" value="Ubah Slot">
                <a href="{{route('kamar.create',$kos->id)}}" class="btn btn-primary px-3">Tambah Kamar</a>
                 @endif

        </div>
        <div class="row text-center">
            @forelse($kamars as $idS => $kamar)
            <div class="card ml-5 mb-3 mt-5 col-md-2">
                <div id="carouselExampleControls-{{$idS}}" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        @foreach ($kamar->gambars as $key => $gambar)
                        <li data-target="#carouselExampleIndicators-{{$idS}}" data-slide-to="{{$key}}"
                            class="{{$key == 0 ? 'active' : ''}}">
                        </li>
                        @endforeach
                    </ol>
                    <div class="carousel-inner">
                        @foreach ($kamar->gambars as $key => $gambar)
                        <div class="carousel-item {{$key == 0 ? 'active' : ''}}">
                            <img class="d-block" height="300px" width="400px"
                                src="{{asset('/storage/images/kamar/'.$gambar->nama)}}" alt="Gambar Kamar">
                        </div>
                        @endforeach
                    </div>
                    <a class="carousel-control-prev" href="#carouselExampleControls-{{$idS}}" role="button"
                        data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleControls-{{$idS}}" role="button"
                        data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>

                <div class="card-body">
                    <strong>
                        <h5 class="card-title">Deskripsi Kamar</h5>
                    </strong>
                    <p class="card-text">{{$kamar->desc_kamar}}</p>
                    {{-- Tombol edit & hapus hanya untuk user sendiri atau admin --}}
                    {{-- Ini menggunakan laravel policy  dia akan berulang dan memeriksa athorizenya--}}
                    {{--cek in dong ke policy apakah true jika $user->email ada di user yang sedang login--}}

             @if(!(Auth::user()->roles->first()->role == 'admin'))
                    <div class="btn-action">
                        <a href="{{route('kamar.edit',$kamar->id)}}" class="btn btn-primary d-inline-block">Edit</a>
                        <a class="btn btn-danger btn-hapus text-white" data-id="{{$kamar->id}}" data-toggle="modal"
                            data-target="#hapusKamar">Hapus</a>
                    </div>
            @endif
                </div>
                <div class="card-footer bg-info text-center">
                    <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" name="slot[{{$kamar->id}}]" {{(!(Auth::user()->roles->first()->role == 'admin') ? '' : 'disabled')}} {{$kamar->slot == 'T' ? 'checked' : ''}}
                            class="custom-control-input" value='T' style="cursor:pointer" id="sudah-{{$kamar->id}}">
                        <label class="custom-control-label text-light" for="sudah-{{$kamar->id}}">SUDAH TERISI</label>
                    </div>
                    <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" name="slot[{{$kamar->id}}]" {{$kamar->slot == 'F' ? 'checked' : ''}} {{(!(Auth::user()->roles->first()->role == 'admin') ? '' : 'disabled')}}
                            class="custom-control-input" value='F' style="cursor:pointer" id="belum-{{$kamar->id}}">
                        <label class="custom-control-label text-light" for="belum-{{$kamar->id}}">BELUM TERISI</label>
                    </div>
                </div>
            </div>
            @empty
            <p class="text-center">Tidak ada data...</p>
            @endforelse
        </div>
        </form>
        <!-- /.row -->
    </div>

</div>
<!-- /.container -->
  @if(!(Auth::user()->roles->first()->role == 'admin'))
{{-- Modal untuk konfirmasi proses delete --}}

<div id="hapusKamar" class="modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
        <!-- Modal content-->
        <form action="" id="deleteKamar" method="post">
            @csrf
            @method('DELETE')
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title text-center">Konfirmasi</h4>
                    <button type="button" class="close" data-dismiss="modal">
                        &times;</button>
                </div>
                <div class="modal-body">
                    <p class="text-center">Anda yakin akan menghapus Kamar ini?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" data-dismiss="modal">
                        Cancel</button>
                    <button type="submit" class="btn btn-danger" data-dismiss="modal">
                        Ya, Hapus Kamar
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endif
@endsection
@section('map')
<script>
    let kos = {!! json_encode($kos) !!}

    let centralKos = [kos.lng, kos.lat];

    mapboxgl.accessToken =
        'pk.eyJ1IjoicHJhbXVkeWEwOSIsImEiOiJja2Z1cTJnYWswdmVoMnFtNm91d2hpNG9hIn0.2wgNxmCFg-cnhUf95sF-sA';

    var map = new mapboxgl.Map({
        container: 'map',
        style: 'mapbox://styles/mapbox/light-v10',
        center: centralKos,
        zoom: 14
    });
    var marker = new mapboxgl.Marker({

        })
        .setLngLat(centralKos)
        .addTo(map);


</script>
<script>
    // $(".btn-hapus").click(function() {
    // let idHapus = $(this).attr("data-id");
    // $("#deleteForm").attr("action", "/users/" + idHapus);
    // });

    // // Jika tombol "Ya, Hapus" di klik, submit form

    // $('#deleteForm [type="submit"]').click(function() {
    // $("#deleteForm").submit();
    // });
    let btnHapus = document.getElementsByClassName('btn-hapus');
    let deleteKamar = document.getElementById('deleteKamar');

if(btnHapus == undefined && deleteKamar == undefined){

}
else{
for(i=0;i<btnHapus.length;i++){
        btnHapus[i].addEventListener('click',function(event){
            let idHapus = event.target.dataset.id;
            deleteKamar.setAttribute('action',`/pemilik/kamar/${idHapus}`);
        });
    }

    let submitKamar = deleteKamar.querySelector('[type="submit"]');;
    submitKamar.addEventListener('click',function(){
        deleteKamar.submit();
    });
}
</script>
</body>
@endsection
