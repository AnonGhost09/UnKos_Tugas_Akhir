@extends('dashboard.layouts.master')

@section('content')


          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
          </div>

          <!-- Content Row -->
          <div class="row">

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Kos</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">Total <span class="badge badge-primary">{{empty($totalKos)?'Masih Kosong':$totalKos}}</span></div>
                    </div>
                    <div class="col-auto">
                        <i class="fa fa-location-arrow fa-2x text-gray-300" aria-hidden="true"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Total Kamar</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">Total <span class="badge badge-success">{{empty($totalKamar)?'Masih Kosong':$totalKamar}}</span></div>
                    </div>
                    <div class="col-auto">
                      <i class="fa fa-home fa-2x text-gray-300" aria-hidden="true"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-info text-uppercase mb-1">KAMAR TERISI</div>
                      <div class="row no-gutters align-items-center">
                        <div class="col-auto">
                          <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{empty($kamarT)?'Masih Kosong':$kamarT}}</div>
                        </div>
                        <div class="col">
                          <div class="progress progress-sm mr-2">
                            <div class="progress-bar bg-info" role="progressbar" style="width: {{empty($totalTerisiB)?0:$totalTerisiB}}%"></div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Pending Requests Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-danger shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">KAMAR KOSONG</div>
                        <div class="row no-gutters align-items-center">
                          <div class="col-auto">
                            <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{empty($kamarF)?'Masih Kosong':$kamarF}}</div>
                          </div>
                          <div class="col">
                            <div class="progress progress-sm mr-2">
                              <div class="progress-bar bg-danger" role="progressbar" style="width: {{empty($totalKosongB)?0:$totalKosongB}}%"></div>
                            </div>
                          </div>
                        </div>
                      </div>
                    <div class="col-auto">
                      <i class="fas fa-comments fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Content Row -->

          <div class="row">
               <form class="d-sm-inline-block form-inline col-md-4 mr-auto my-2 my-md-0 mw-100 navbar-search" action="{{Route('searchKos')}}" method="GET">
            <div class="input-group">
              <input type="text" name="searchKos" class="form-control bg-white border-0 small" placeholder="Cari Kos" aria-label="Search" aria-describedby="basic-addon2">
              <div class="input-group-append">
                <button class="btn btn-primary" type="submit">
                  <i class="fas fa-search fa-sm"></i>
                </button>
              </div>
            </div>
          </form>
            <a href="{{route('kos.create')}}" class="btn btn-primary col-md-2 mb-4 ml-md-auto mr-3 mx-3">Tambah Kos</a>
            <div class="col-xl-12 col-lg-12">
              <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Data Kos</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body table-responsive">
                  <table class="table table-striped table-inverse table-bordered">
                      <thead class="thead-inverse">
                          <tr class="text-center">
                              <th>No</th>
                              <th>Title</th>
                              <th>Deskripsi</th>
                              <th>Gambar</th>
                              <th>Harga (RP)</th>
                              <th>Kamar</th>
                              <th>Slot Terisi</th>
                              <th>Action</th>
                          </tr>
                          </thead>
                          <tbody>
                              @forelse ($kos as $data)
                                  <tr>
                                    <td class="text-center">{{($kos->currentpage()-1) * $kos->perpage() + $loop->iteration}}</td>
                                    <td>{{Str::of($data->title)->limit(30)}}</td>
                                    <td>{{Str::of($data->desc_kos)->limit(30)}}</td>
                                    <td class="text-center">
                                        <img src="{{asset("/storage/images/kos/$data->gambar")}}" width="50" height="50">
                                    </td>
                                    <td>@currency($data->harga)</td>
                                    <td class="text-center">{{$data->kamars()->get()->count()}}</td>
                                    <td class="text-center">{{$data->kamars()->where('slot','T')->get()->count()}}</td>
                                    <td class="text-center align-middle">
                                        <a href="{{route('kos.show',['ko'=>$data->id])}}" class="btn btn-warning">Detail</a>
                                        <a href="{{route('kos.edit',['ko'=>$data->id])}}" class="btn btn-primary">Edit</a>
                                        <form action="{{route('kos.destroy',['ko'=>$data->id])}}" method="post" class="d-inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Hapus</button>
                                        </form>
                                    </td>
                                  </tr>
                              @empty
                                  <tr>
                                      <td colspan="8">Data Kos Tidak Ada</td>
                                  </tr>
                              @endforelse
                          </tbody>
                  </table>
                  {{ $kos->onEachSide(1)->withQueryString()->links()}}
                </div>
              </div>
            </div>
          </div>

@endsection
