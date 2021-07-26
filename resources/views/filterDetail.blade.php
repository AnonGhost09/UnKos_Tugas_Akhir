<!doctype html>
<html lang="en">

<head>
    <title>Dipa</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <script src="https://api.mapbox.com/mapbox-gl-js/v1.12.0/mapbox-gl.js"></script>
    <link href="https://api.mapbox.com/mapbox-gl-js/v1.12.0/mapbox-gl.css" rel="stylesheet" />
    <link rel="icon" href="{{asset('storage/images/logo/favicon.ico')}}" type="image/x-icon">
    <link rel="stylesheet" href="{{asset('/css/styles.css')}}">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="{{asset('adminp/vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">

    <style>
        #map {
            width: 100%;
            height: 500px;
        }

        #member-list .card-body img {
            width: 125px;
            height: 125px;
            margin-top: -80px;
        }
    </style>
</head>

<body data-spy="scroll" data-target="#main-navbar" data-offset="200" class="bg-light">
    <!--NAVBAR-->
    <nav id="main-navbar" class="navbar navbar-expand-md navbar-light bg-white py-2-md-0">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{url('/')}}">
                <img src="{{asset('/storage/images/logo/unkos.png')}}" width="200" height="70" alt="Logo Unkos">
            </a>
            <button class="navbar-toggler" data-target="#my-nav" data-toggle="collapse" aria-controls="my-nav"
                aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div id="my-nav" class="collapse navbar-collapse">
                @auth
                <div class="font-weigh ml-auto"><strong>{{Str::ucfirst(Auth::user()->nama)}}</strong></div>
                <ul class="navbar-nav">
                    <!-- Nav Item - User Information -->
                    <li class="nav-item dropdown no-arrow">
                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="mr-2 d-none d-lg-inline text-gray-600 small"></span>
                            <img class="img-profile rounded-circle" width="50" height="50"
                                src="{{asset('/storage/images/profile/'.Auth::user()->gambar_profil)}}">
                        </a>
                        <!-- Dropdown - User Information -->
                        <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                            aria-labelledby="userDropdown">
                            @if(Auth::user()->roles->first()->role == 'admin')
                            <a class="dropdown-item" href="{{route('profile.users')}}">
                                <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                Profile
                            </a>
                            @else
                            <a class="dropdown-item" href="{{route('profileP.users')}}">
                                <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                Profile
                            </a>
                            @endif
                            @if(Auth::user()->roles->first()->role == 'admin')
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="{{route('admin.dashboard')}}">
                                <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                Dashboard
                            </a>
                            @else

                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="{{route('pemilik.dashboard')}}">
                                <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                Dashboard
                            </a>
                            @endif
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                Logout
                            </a>
                        </div>
                    </li>
                </ul>

                @endauth
                @guest
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link p-3 z" href="{{route('login')}}">Register</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link p-3 z" href="{{route('login')}}">Login</a>
                    </li>
                </ul>
                @endguest
            </div>
        </div>
    </nav>
    <!-- Sidebar filter section -->
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

            <div class="col-lg-3 border-right border-dark text-center">
                <div class='h-50'>
                    <h3 class="my-3 text-center">Deskripsi Kos</h3>
                    {{$kos->desc_kos}}
                </div>
                <div class="w-100"></div>
                <div>
                    <h3 class="mb-3 text-center">Harga</h3>
                    <p class="h5">@currency($kos->harga)</p>
                </div>
            </div>

            <div class="col-lg-3">
                <div class='h-50'>
                    <h3 class="my-3 text-center">Fasilitas</h3>
                    @foreach ($kos->fasilitas as $data)
                    <ul class="mb-0">
                        <li>{{$data->nama_fasilitas}}</li>
                    </ul>
                    @endforeach
                </div>
                <div class="w-100"></div>
                <div>
                    <h3 class="mb-3 text-center">Slot Kamar</h3>
                    @if ($slotS != $slotJ)
                    <p class="text-success h1 text-center">{{$slotS}}/{{$slotJ}}</p>
                    @else
                    <p class="text-danger h1 text-center">{{$slotS}}/{{$slotJ}}</p>
                    @endif
                </div>
            </div>

        </div>
        <!-- /.row -->
        \
        <!-- Related Projects Row -->

        <div class="border-top border-dark mt-4 text-center">
            <h3 class="my-4 ">Daftar Kamar</h3>
            <div class="row mr-5">
                <a href="https://api.WhatsApp.com/send?phone={{$kos->pemiliks->users->phone}}"
                    class="btn btn-success ml-auto">PESAN SEKARANG</a>
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
                            @if(!($key === 0))
                                 <a href="{{asset('/storage/images/kamar/'.$gambar->nama)}}" data-toggle="lightbox"  width="600" height="600" data-gallery="data-{{$kamar->id}}" class="col-sm-4"></a>
                            @endif
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
                    </div>
                    <div class="card-footer bg-warning text-center">
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" name="slot[{{$kamar->id}}]" {{$kamar->slot == 'T' ? 'checked' : ''}}
                                class="custom-control-input" value='T' style="cursor:pointer" disabled
                                id="sudah-{{$kamar->id}}">
                            <label class="custom-control-label text-light" for="sudah-{{$kamar->id}}">SUDAH
                                TERISI</label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" name="slot[{{$kamar->id}}]" disabled
                                {{$kamar->slot == 'F' ? 'checked' : ''}} class="custom-control-input" value='F'
                                style="cursor:pointer" id="belum-{{$kamar->id}}">
                            <label class="custom-control-label text-light" for="belum-{{$kamar->id}}">BELUM
                                TERISI</label>
                        </div>
                    </div>
                    <div class="text-center m-3">
                        <button type="button" class='btn btn-success' href="{{asset('/storage/images/kamar/'.$kamar->gambars[0]->nama)}}" data-toggle="lightbox" data-gallery="data-{{$kamar->id}}">ZOOM FOTO</button>
                    </div>
                </div>
                @empty
            </div>
            </form>
            <!-- /.row -->
            <p class="text-center">Tidak ada data...</p>
            @endforelse
        </div>

    </div>

    <!-- /.container -->
    {{-- footer --}}
    <section id="footer" class="text-dark py-3 text-center">
        <div class="container">
            <div class="row">
                <div class="col-md-4 text-md-left">
                    <h4>UnKos</h4>
                    <p>UnKos atau yang disebut Universitas Kos ada lah aplikasi yang dibuat untuk membantu para pencari
                        kos mencari kos-kosanya serta
                        membantu para pemilik kos mempromosikan kos-kosannya dan sebagai penghubung antara pencari dan
                        pemilik kos.</p>
                    <p>&copy; UnKos 2021</p>
                </div>
                <div class="col-md-4 ml-auto text-md-left">
                    <h4>Hubungi Kami</h4>
                    <div><i class="fa fa-envelope fa-fw mr-3" aria-hidden="true"></i>pramudyaalamsyah@gmail.com</div>
                    <div><i class="fa fa-phone fa-fw mr-3" aria-hidden="true"></i>0895-3470-24882</div>
                    <div><i class="fa fa-globe fa-fw mr-3" aria-hidden="true"></i>https://tugasAkhir.com</div>
                    <div class="pt-3">
                        <a href="https://facebook.com">
                            <i class="fa fa-facebook-square fa-lg text-info" aria-hidden="true"></i>
                        </a>
                        <a href="https://twitter.com">
                            <i class="fa fa-twitter-square fa-lg mx-3 text-info" aria-hidden="true"></i>
                        </a>
                        <a href="https://twitter.com">
                            <i class="fa fa-twitter-square fa-lg text-wihte" aria-hidden="true"></i>
                        </a>
                        <a href="https://twitter.com">
                            <i class="fa fa-twitter-square fa-lg ml-3" aria-hidden="true"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Anda yakin mau keluar dari akun ? klik Logout jika ingin keluar.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-danger" href="{{ route('logout') }}"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        let kos = {!! json_encode($kos) !!}

    let centralKos = [kos.lng, kos.lat];

    mapboxgl.accessToken =
        'pk.eyJ1IjoicHJhbXVkeWEwOSIsImEiOiJja2Z1cTJnYWswdmVoMnFtNm91d2hpNG9hIn0.2wgNxmCFg-cnhUf95sF-sA';

    let form = document.forms.formPeta;
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
    marker.on("drag", function() {
        var lngLat = marker.getLngLat();
        form.latitude.value = lngLat.lat;
        form.longitude.value = lngLat.lng;
    });

    </script>
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script>
$(document).on('click', '[data-toggle="lightbox"]', function(event) {
                event.preventDefault();
                $(this).ekkoLightbox({
                    showArrows:false,
                });
            });
</script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.3.0/ekko-lightbox.min.js" integrity="sha512-Y2IiVZeaBwXG1wSV7f13plqlmFOx8MdjuHyYFVoYzhyRr3nH/NMDjTBSswijzADdNzMyWNetbLMfOpIPl6Cv9g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</body>

</html>
