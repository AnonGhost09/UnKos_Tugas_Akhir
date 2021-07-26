@extends('dashboard.layouts.master')

@section('content')

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Fasilitas</h1>
          </div>
          <!-- Content Row -->

          <div class="row">
              <!-- Topbar Search -->
          <form class="d-sm-inline-block col-12 col-md-5 mw-100 navbar-search" action="{{route('searchFasilitas')}}" method="GET">
            <div class="input-group">
              <input type="text" name="searchFasilitas" class="form-control bg-white small" placeholder="Cari Fasilitas" aria-label="Search" aria-describedby="basic-addon2">
              <div class="input-group-append">
                <button class="btn btn-primary" type="submit">
                  <i class="fas fa-search fa-sm"></i>
                </button>
              </div>
            </div>
          </form>
          <form action="{{route('fasilitas.store')}}" method="POST" id="tambah" class="col-md-12 mt-4">
            @csrf
            <div class="input-group">
              <input type="text"  name="nama_fasilitas" value="{{old('nama_fasilitas')}}" class="@error('nama_fasilitas') is-invalid @enderror form-control d-inline-block bg-white border-0 small col-md-7 mr-3 mb-3" placeholder="Masukan Fasilitas" aria-label="Add" aria-describedby="basic-addon2">
              <button type="submit" class="btn d-inline-block btn-primary col-md-5 mb-4 ml-auto mr-3 ml-auto">Tambah Fasilitas</button>
            </div>
            @error('nama_fasilitas')
                <div class="alert alert-danger">{{$message}}</div>
            @enderror
          </form>
        <form action="" method="POST" id="editFak" class="d-none col-md-12 mt-4">
            @method('PATCH')
            @csrf
            <div class="input-group">
              <input type="text" id="edit_fasilitas" name="nama_fasilitas" value="{{old('nama_fasilitas')}}" class="@error('nama_fasilitas') is-invalid @enderror form-control d-inline-block bg-white border-0 small col-md-7 mr-3 mb-3" placeholder="Edit Fasilitas" aria-label="Add" aria-describedby="basic-addon2">
              <button type="submit" class="btn d-inline-block btn-primary col-md-5 mb-4 ml-auto mr-3 ml-auto">Edit Fasilitas</button>
            </div>
            @error('nama_fasilitas')
                <div class="alert alert-danger">{{$message}}</div>
            @enderror
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
                              <th>Fasilitas</th>
                              <th>Action</th>
                          </tr>
                          </thead>
                          <tbody>
                              @forelse($fasilitas as $data)
                                <tr>
                                  <td class="align-middle text-center">{{ ($fasilitas->currentpage()-1) * $fasilitas->perpage() + $loop->iteration}}</td>
                                  <td class="align-middle text-center">{{$data->nama_fasilitas}}</td>
                                  <td class="text-center align-middle">
                                  <button data-fasilitas="{{$data->nama_fasilitas}}" data-id="{{$data->id}}" class="edit btn btn-primary">Edit</button>
                                    <form action="{{route('fasilitas.destroy',$data->id)}}" method="post" class="d-inline-block">
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
                  {{ $fasilitas->onEachSide(1)->withQueryString()->links() }}
                </div>
              </div>
            </div>
          </div>

@endsection

@section('fasilitasScript')
    <script>
        let edit = document.getElementById('editFak');
        let tabel = document.getElementById('dataTabel');
        let edit_fas = document.getElementById('edit_fasilitas');
        tabel.addEventListener('click',function(e){
            if(e.target.classList.contains('edit')){
                edit.classList.remove('d-none');
                let nama = e.target.dataset.fasilitas;
                let id = e.target.dataset.id;
                edit_fas.value = nama;
                edit.action ="{{url('admin/fasilitas/')}}/"+id;
            }
        })

    </script>
@endsection
