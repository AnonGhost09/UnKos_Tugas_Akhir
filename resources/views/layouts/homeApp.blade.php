<!doctype html>
<html lang="en">

<head>
    <title>Home</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="{{asset('storage/images/logo/favicon.ico')}}" type="image/x-icon">
    <link rel="stylesheet" href="{{asset('/css/styles.css')}}">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <!--AOS-->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <link href="{{asset('adminp/vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
        integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body data-spy="scroll" data-target="#main-navbar" data-offset="200">
    <!--NAVBAR-->
    <nav id="main-navbar" class="navbar navbar-expand-md navbar-light bg-white fixed-top py-2-md-0">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{url('/')}}">
                <img src="{{asset('/storage/images/logo/unkos.png')}}" width="200" height="70" alt="Logo Unkos">
            </a>
            <button class="navbar-toggler" data-target="#my-nav" data-toggle="collapse" aria-controls="my-nav"
                aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div id="my-nav" class="collapse navbar-collapse">
                {{-- @if(Route::current()->getName() == 'home')
                Hello This is testing
                @endif --}}
                <ul class="navbar-nav m-auto">
                    <li class="nav-item">
                        <a class="nav-link p-3 active z" href="#showcase">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link p-3 z" href="#product">Fitur</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link p-3 z" href="#team">About</a>
                    </li>
                </ul>
                @auth
                <div class="font-weight"><strong>{{Str::ucfirst(Auth::user()->nama)}}</strong></div>
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
                <ul class="navbar-nav">
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

    @yield('content')

    <!--footer-->
    <section id="footer" class="text-dark py-5 text-center">
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
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
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
<script>
    AOS.init({
        once: false, //jika once dianti jd false, maka scroll akan berulang2, kalo true saat sampai kebawah scroll tidak akan diulang
        duration: 800
    });
    //   $(document).ready(function(){
    //       $("a").on('click',function(event){
    //           if(this.hash !== ""){
    //               event.preventDefault();
    //           }

    //           var hash = this.hash;
    //           $('html, body').animate({
    //               scrollTop: $(hash).offset().top
    //           },800, function(){
    //               window.location.hash = hash;
    //           });

    //       });
    //     });
</script>

</html>
