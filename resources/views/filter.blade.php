<!doctype html>
<html lang="en">

<head>
    <title>Dipa</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="{{asset('storage/images/logo/favicon.ico')}}" type="image/x-icon">
    <link rel="stylesheet" href="{{asset('/css/filter.css')}}">
    <link rel="stylesheet" href="{{asset('/css/styles.css')}}">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <link href="{{asset('adminp/vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
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
    <section id="sidebar">
        <div class="border-bottom pb-2 ml-2">
            <h4 id="burgundy">Filters</h4>
        </div>

        <div class="py-2 border-bottom ml-3">
            <h6 class="font-weight-bold">Harga</h6>
            <div id="orange"><span class="fa fa-minus"></span></div>
            <form action="{{route('filter.search')}}" method="GET">
                <div class="form-group"> <input type="radio" id="kosong" value="all"
                        {{$checkH == 'all' ? 'checked' : ''}} name="harga"> <label for="kosong">Semua Harga</label>
                </div>
                <div class="form-group"> <input type="radio" id="satu" value="600000"
                        {{$checkH == '600000' ? 'checked' : ''}} name="harga"> <label for="satu">RP. 0 -
                        600.000</label> </div>
                <div class="form-group"> <input type="radio" id="dua" value="1000000"
                        {{$checkH == '1000000' ? 'checked' : ''}} name="harga"> <label for="dua">RP.
                        600.001 - 1.000.000</label> </div>
                <div class="form-group"> <input type="radio" id="tiga" value="1000001"
                        {{$checkH == '1000001' ? 'checked' : ''}} name="harga"> <label for="tiga">RP.
                        1.000.000+++</label></div>
        </div>

        <div class="py-2 border-bottom ml-3">
            <h6 class="font-weight-bold">Fasilitas</h6>
            <div id="orange"><span class="fa fa-minus"></span></div>
            @foreach ($fasilitas as $dataF)
            <div class="form-group"> <input type="checkbox" name="fasilitas[]" id="{{$dataF->nama_fasilitas}}"
                    value="{{$dataF->id}}"> <label for="{{$dataF->nama_fasilitas}}">{{$dataF->nama_fasilitas}}</label>
            </div>
            @endforeach
        </div>
        <div class="py-2 ml-3 text-center mt-2">
            <input type="submit" class="btn btn-primary" value="FILTER PILIHAN">

        </div>
    </section>
    <!-- products section -->
    <section id="products">
        <div class="container">
            <div class="d-flex flex-row">
                <div class="text-muted m-2" id="res">Showing {{$kos->count()}} results</div>
                <div class="ml-auto mr-lg-4">
                    <div id="sorting" class="border rounded p-1 m-1 mb-4"> <span class="text-muted">Sort by</span>
                        <select name="sortingUniversitas" id="sort">
                            <option value="universitas"><b>Universitas</b></option>
                            @foreach ($universitas as $univ)
                            <option value="{{$univ->id}}" {{ ($checkF == $univ->id) ? "selected":"" }}>
                                <b>{{$univ->nama}}</b>
                            </option>
                            @endforeach
                        </select> </div>
                </div>
            </div>
            </form>

            <div class="row">
                @forelse ($kos as $dataK)
                <div class="col-lg-4 col-md-6 col-sm-10 offset-md-0 offset-sm-1 mb-3">
                    <div class="card"> <img class="card-img-top"
                            src="{{asset('./storage/images/kos/'.$dataK->gambar)}}">
                        <div class="card-body">
                            <div class="row">
                                <h5 class="ml-3 mr-auto"><b>{{ Str::limit($dataK->title, 13, $end = '...') }}</b> </h5>
                                @if ($dataK->jarak == null)
                                @else
                                <strong>{{number_format($dataK->jarak,2)}} KM</strong>
                                @endif

                            </div>

                            <div class="d-flex flex-row my-2">
                                <div class="text-muted">
                                    @currency($dataK->harga)
                                </div>
                                <div
                                    class="{{$dataK->kamars()->where('slot','T')->count() == $dataK->kamars()->count() ? 'text-danger': 'text-success'}} ml-auto">
                                    Slot Kamar :
                                    {{$dataK->kamars()->where('slot','T')->count()}}/{{$dataK->kamars()->count()}}
                                </div>
                            </div>
                            <div class="d-flex flex-row my-2 heros">
                                <div class="text-muted">
                                    @php
                                    $string = $dataK->desc_kos;
                                    @endphp
                                    {{ Str::limit($string, 100, $end = '...') }}
                                </div>
                            </div>
                            <div class="d-flex flex-row my-2">
                                <div class="text-muted">
                                    <strong> Fasilitas : </strong>
                                    @php
                                    foreach($dataK->fasilitas as $dataF){
                                    $fas[] = $dataF->nama_fasilitas;
                                    }
                                    $string = implode(', ',$fas);
                                    unset($fas);
                                    @endphp
                                    {{ Str::limit($string, 25, $end = '...') }}
                                </div>
                            </div>
                            <div class="text-center mt-3">
                                <a href="{{route('filter.detail',$dataK->id)}}"
                                    class="btn btn-primary w-40 rounded">Detail</a>
                                <a href="https://api.WhatsApp.com/send?phone={{$dataK->pemiliks->users->phone}}"
                                    class="btn btn-success  w-40 rounded">Pesan</a>
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                <div class="text-center">
                    Data Tidak Ada
                </div>
                @endforelse
            </div>
            {{$kos->withQueryString()->links()}}
        </div>
    </section>
    <!--footer-->
    <div class="clear"></div>
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
                <div class="modal-body">Anda yakin mau keluar dari akun ? klik Logout jika ingin keluar</div>
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
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
</body>

</html>
