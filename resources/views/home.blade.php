@extends('layouts.homeApp')

@section('content')
<!--showcase-->
    <section id="showcase" class="py-5">
        <div class="dark-overlay">
            <div class="container">
                <div class="row">
                    <div class="col text-center text-white mt-md-5">
                        <h1 class="display-3 mt-md-5">Un <strong>Kos</strong></h1>
                        <p class="lead mb-5"><strong>UnKos</strong> atau yang disebut <strong>Universitas Kos</strong> adalah aplikasi yang dibuat untuk mencari kost-kosan terdekat dari Universitas yang digunakan untuk membantu mahasiswa-mahasiswa yang sedang mencari kost di sekitar universitas</p>
                        <a class="btn btn-primary mt-5 p-4 mr-3 col-md-2" href="{{route('map')}}" role="button">SEARCH MAP</a>
                        <a class="btn btn-success mt-3 mt-md-5 p-4 text-nowrap col-md-2" href="{{route('filter.index')}}" role="button">SEARCH FILTER</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!--showof-1 bentuk kiri gambar kanan tulisan-->
    <section id="showoff-1" data-aos="fade-right" class="bg-light text-muted py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <img src="{{asset('storage/images/logo/blog-blogger-blogging-cup-4458.jpg')}}" alt="gambar" class="img-fluid mb-3">
                </div>
                <div class="col-md-6">
                    <h2>Mudah</h2>
                    <p>Aplikasi yang mudah digunakan karena memiliki tampilan yang sederhana tapi masih powerfull dengan fitur-fiturnya, menyajikan fitur yang mempermudah para pencari kost mencari kost-kosannya</p>
                    <p>Aplikasi ini tidak hanya dibuka lewat mobile, tapi juga dapat dibuka lewat HP tentunya lewat browser dengan tampilan yang responsive</p>

                </div>
            </div>
        </div>
    </section>

    <section id="showoff-2" data-aos="fade-right" class="text-muted py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h2>Efisien</h2>
                   <p>Daripada nyari kost muter-muter jalan kaki, atau dengan kendaraan, buang-buang waktu mending pakai aplikasi ini lebih efisien</p>
                   <p>Menghemat waktu, tenaga, uang transport, dan pikiran. tinggal search lalu pilih kost-kosan mana yang kamu inginkan</p>
                </div>
                <div class="col-md-6">
                    <img src="{{asset('storage/images/logo/macbook-air-flower-bouquet-and-magazines-on-white-table-839443.jpg')}}" alt="foto" class="img-fluid mb-3">
                </div>
            </div>
        </div>
    </section>

    <!--product-->
    <section id="product" class="bg-light py-5">
        <div class="container">
            <div class="row">
                <div class="col text-center">
                    <h2>FITUR - FITUR</h2>
                    <hr class="w-25">
                    <p class="lead">Ada fitur-fitur yang mnarik di aplikasi ini yang membuat para pencari kost mudah mencari kost serta pemilik kost mudah mempromosikan kost-kosannya</p>
                </div>
            </div>

            <div class="row text-center justify-content-between mt-3">
                <!-- .justify-content-between
            merupakan class flexbox Bootstrap agar semua kolom tampil dengan jarak sama satu dengan
            yang lain. -->
                <div class="col-sm-6 col-md-3 p-3">
                    <i class="fas fa-map-marked-alt fa-4x"></i>
                    <h4 class="mt-3">Map</h4>
                    <p>Dapat mencari lokasi kost-kosan terdekat dari universitas yang diinginkan</p>
                </div>
                <div class="col-sm-6 col-md-3 p-3">
                    <i class="fas fa-filter fa-4x" aria-hidden="true"></i>
                    <h4 class="mt-3">Filter</h4>
                    <p>Dapat mencari kost-kosan berdasarkan harga dan fasilitas yang ingin dicari dengan mudah dan praktis</p>
                </div>
                <div class="col-sm-6 col-md-3 p-3">
                    <i class="fas fa-compass fa-4x" aria-hidden="true"></i>
                    <h4 class="mt-3">Radius</h4>
                    <p>Menggunakan fitur radius dalam jangkauan satu sampai empat kilometer supaya para pencari kost dapat mencari kostan yang sangat dekat dengan universitasnya</p>
                </div>
                <div class="col-sm-6 col-md-3 p-3">
                    <i class="fas fa-tasks fa-4x"></i>
                    <h4 class="mt-3">Manejemen Kost</h4>
                    <p>Dapat menentukan lokasi kost atau mempromosikan kost-kosannya bagi para pemilik kost supaya kostan yang dimilikinya cepat ditemukan oleh para pencari kost</p>
                </div>
            </div>
        </div>
    </section>

    <!--EXPLORE-->
    <section class="bg-dark text-light py-5" id="explore">
        <div class="container">
            <div class="row">
                <div class="col text-center">
                    <h1 class="display-4 pb-3 ">Motto</h1>
                    <hr class="w-25 bg-success">
                    <p class="lead">"Kalo ada cara yang mudah kenapa harus melakukan dengan yang susah?"</p>
                    <p class="lead">Cari Kostan yang kamu inginkan di aplikasi ini, dapatkan yang dekat dengan universitasmu</p>
                </div>
            </div>
        </div>
    </section>

    <!--ourteam-->

    <section id="team" class="bg-light py-5 text-center">
        <div class="container">
            <div class="row">
                    <div class="card ">
                        <div class="card-body">
                            <img src="{{asset('storage/images/profile/default.jpg')}}" alt="foto1" class="img-fluid rounded-circle mb-3d">
                            <h3 class="card-title">Pramudya</h3>
                            <h5 class="text-muted">Developer</h5>
                            <p class="card-text">Aplikasi ini sangat recomended untuk mereka yang mencari kost-kosan dengan jarak yang dekat dengan universitas,
                                serta untuk pemilik kos yang ingin mempromosikan kost-kosannya agar cepat terisi.
                            </p>
                            <i class="fa fa-facebook-square fa-2x" aria-hidden="true"></i>
                            <i class="fa fa-twitter-square mx-3 fa-2x " aria-hidden="true"></i>
                            <i class="fa fa-instagram fa-2x" aria-hidden="true"></i>
                        </div>
                </div>
            </div>
        </div>
    </section>

@endsection
