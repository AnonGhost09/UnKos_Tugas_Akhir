@extends('dashboard.layouts.master')

@section('content')

<div class="container rounded bg-white mt-5 mb-5">
    <div class="row">
        <div class="col-md-6 border-right">
            <div class="d-flex flex-column align-items-center text-center p-3 py-5">
                <img class="rounded-circle mt-3  mb-5" width="400px" height="400px" id="fot2"
                    src="{{asset('/storage/images/profile/'.$users->gambar_profil)}}">

                <span class="font-weight-bold mb-1 h4">{{$users->nama}}</span>
                <span class="text-black-50 h2 text-break">{{$users->email}}</span>

            </div>
        </div>
        <div class="col-md-6 border-right">
            <div class="p-3 py-5">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4 class="text-right">Edit Profile</h4>
                </div>
                @if(Auth::user()->roles->first()->role == 'admin')
                <form action="{{route('profile.update',$users->id)}}" method="post" enctype="multipart/form-data">
                    @else
                    <form action="{{route('profileP.update',$users->id)}}" method="post" enctype="multipart/form-data">
                        @endif
                        @csrf
                        @method('PATCH')
                        <div class="row mt-2">
                            <div class="col-md-12">
                                <label class="labels">Nama</label>
                                <input type="text" class="form-control @error('nama') is-invalid @enderror" name="nama"
                                    placeholder="Nama" value="{{old('nama') ?? $users->nama}}">
                            </div>
                            @error('name')
                            <div class="alert alert-danger">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-12">
                                <label class="labels">Nomor Telepon</label>
                                <input type="text" class="form-control @error('phone') is-invalid @enderror"
                                    name="phone" placeholder="Masuka Nomor Telepon"
                                    value="{{old('phone') ?? $users->phone}}">
                            </div>
                            @error('phone')
                            <div class="alert alert-danger">
                                {{$message}}
                            </div>
                            @enderror
                            <div class="col-md-12 mt-3">
                                <label class="labels">Email</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror"
                                    name="email" placeholder="Masukan Email" value="{{old('email') ?? $users->email}}">
                            </div>
                            @error('email')
                            <div class="alert alert-danger">
                                {{$message}}
                            </div>
                            @enderror
                            <div class="col-md-12 mt-3">
                                <label class="labels">Gambar Profile</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Upload</span>
                                    </div>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" name="gambar_profil" id="gambar">
                                        <label class="custom-file-label" for="gambar">Choose file</label>
                                    </div>
                                </div>
                                @error('gambar_profil')
                                <div class="alert alert-danger">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="mt-5 text-center"><button class="btn btn-primary profile-button" type="submit">Save
                                Profile</button></div>
                    </form>
            </div>
        </div>
    </div>
</div>
</div>
</div>

<script>
    //read image
    let gambar = document.getElementById('gambar');
    let fot2 = document.getElementById('fot2');
    gambar.addEventListener('change', function() {
        readURL(this);
    });

    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                fot2.src = e.target.result;
            }

            reader.readAsDataURL(input.files[0]); // convert to base64 string
        }
    }
</script>
@endsection
