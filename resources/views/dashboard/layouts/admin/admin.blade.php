@extends('dashboard.layouts.master')

@section('content')

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
</div>

<!-- Content Row -->
<div class="row">

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-6 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total seluruh Kos</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">Total <span
                                class="badge badge-primary">{{empty($kos) ? 'Masih Kosong':$kos}}</span></div>
                    </div>
                    <div class="col-auto">
                        <i class="fa fa-location-arrow fa-2x text-gray-300" aria-hidden="true"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-6 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Total seluruh Kamar</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">Total <span
                                class="badge badge-success">{{ empty($kamar) ?'Masih Kosong': $kamar}}</span></div>
                    </div>
                    <div class="col-auto">
                        <i class="fa fa-bed fa-2x text-gray-300" aria-hidden="true"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-6 col-md-6 mb-4">
        <div class="card border-left-warning shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Total seluruh Universitas
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">Total <span
                                class="badge badge-warning">{{ empty($universitas) ?'Masih Kosong': count($universitas)}}</span>
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fa fa-home fa-2x text-gray-300" aria-hidden="true"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-6 col-md-6 mb-4">
        <div class="card border-left-info shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Total seluruh Fasilitas
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">Total <span
                                class="badge badge-info">{{ empty($fasilitas) ?'Masih Kosong':$fasilitas}}</span></div>
                    </div>
                    <div class="col-auto">
                        <i class="fa fa-list-alt fa-2x text-gray-300" aria-hidden="true"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-12 col-md-12 mb-4">
        <div class="card border-left-danger shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2 text-center">
                        <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Total seluruh Pemilik
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><span
                                class="badge badge-danger">{{ empty($pemilik) ?'Masih Kosong':$pemilik}}</span></div>
                    </div>
                    <div class="col-auto">
                        <i class="fa fa-users fa-2x text-gray-300" aria-hidden="true"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>


<!-- Content Row -->

<div class="row">
    <!-- Topbar Search -->
    <form class="d-none d-sm-inline-block form-inline mr-auto col-4 ml-md-3 my-2 my-md-0 mw-100 navbar-search" method="GET" action="{{route('searchUniversitas')}}">
        <div class="input-group">
            <input type="text" name="searchUniversitas" class="form-control bg-white border-0 small" placeholder="Cari Universitas"
                aria-label="Search" aria-describedby="basic-addon2">
            <div class="input-group-append">
                <button class="btn btn-primary" type="submit">
                    <i class="fas fa-search fa-sm"></i>
                </button>
            </div>
        </div>
    </form>

    <a href="{{route('universitas.create')}}" class="btn btn-primary col-md-2 mb-4 ml-md-auto mr-3 mx-3">Tambah
        Universitas</a>
    <div class="col-xl-12 col-lg-12">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Data Universitas</h6>
            </div>
            <!-- Card Body -->
            <div class="card-body table-responsive">
                <table class="table table-striped table-inverse table-bordered">
                    <thead class="thead-inverse">
                        <tr class="text-center">
                            <th>No</th>
                            <th>Universitas</th>
                            <th>Deskripsi</th>
                            <th>Gambar</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>

                        @forelse ($universitas as $data)
                        <tr>
                            <td class="align-middle text-center">
                                {{ ($universitas->currentpage()-1) * $universitas->perpage() + $loop->iteration}}</td>
                            <td class="align-middle">{{$data->nama}}</td>
                            <td class="align-middle">{{Str::of($data->desc_universitas)->limit(30)}}</td>
                            <td class="text-center align-middle">
                                <img src="{{asset("/storage/images/universitas/$data->gambar")}}" width="100"
                                    height="50" alt="Gambar Universitas">
                            </td>
                            <td class="text-center align-middle">
                                <a href="{{route('universitas.edit',$data->id)}}" class="btn btn-primary">Edit</a>
                                <form action="{{route('universitas.destroy',['universita' => $data->id])}}"
                                    method="post" class="d-inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Hapus</button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center">Data Tidak Ada</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
                {{ $universitas->onEachSide(1)->withQueryString()->links() }}
            </div>
        </div>
    </div>
</div>

@endsection
