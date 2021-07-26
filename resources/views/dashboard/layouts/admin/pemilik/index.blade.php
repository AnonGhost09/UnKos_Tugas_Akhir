@extends('dashboard.layouts.master')
@section('content')

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">TOTAL USERS PEMILIK</h1>
          </div>

          <!-- Content Row -->

          <div class="row">
              <!-- Topbar Search -->
          <form class="d-sm-inline-block col-12 col-md-5 mw-100 navbar-search" method="GET" action="{{route('searchPemilik')}}">
            <div class="input-group">
              <input type="text" class="form-control bg-white small" name="searchPemilik" placeholder="Cari Pemilik" aria-label="Search" aria-describedby="basic-addon2">
              <div class="input-group-append">
                <button class="btn btn-primary" type="submit">
                  <i class="fas fa-search fa-sm"></i>
                </button>
              </div>
            </div>
          </form>


            <div class="col-xl-12 col-lg-12 mt-2    ">
              <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Data Fasilitas</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body table-responsive">
                  <table class="table table-striped table-inverse table-bordered" id="dataTabel">
                      <thead class="thead-inverse">
                          <tr class="text-center">
                              <th>No</th>
                              <th>Nama</th>
                              <th>Email</th>
                              <th>Phone</th>
                              <th>Gambar Profil</th>
                              <th>Aksi</th>
                          </tr>
                          </thead>
                          <tbody>
                              @forelse($pemiliks as $key => $pemilik)
                                <tr>
                                  <td class="align-middle text-center">{{$pemiliks->firstItem() + $key }}</td>
                                  <td class="align-middle text-center">{{$pemilik->nama}}</td>
                                  <td class="align-middle text-center">{{Str::of($pemilik->email)->limit(30)}}</td>
                                  <td class="align-middle text-center">{{$pemilik->phone}}</td>
                                  <td class="align-middle text-center">
                                    <img src="{{asset("/storage/images/profile/".$pemilik->gambar_profil)}}" width="100" height="50" alt="Gambar Kos">
                                  </td>
                                  <td class="text-center align-middle">
                                    <form action="{{route('pemilik.destroy',$pemilik->id)}}" method="post" class="d-inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Hapus</button>
                                    </form>
                                  </td>
                              </tr>
                             @empty
                              <tr>
                                  <td colspan="3" class="text-center">Data Tidak Ada</td>
                              </tr>
                              @endforelse
                          </tbody>
                  </table>
            {{ $pemiliks->withQueryString()->links() }}
                </div>
              </div>
            </div>
          </div>

@endsection
