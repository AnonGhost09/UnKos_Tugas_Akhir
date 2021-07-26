<div class="container rounded bg-white mt-5 mb-5">
    <div class="row">
        <div class="col-md-6 border-right">
            <div class="d-flex flex-column align-items-center text-center p-3 py-5">
                <form action="{{$tombol === 'Edit Data' ? route('kamar.update', $kamar->id) : route('kamar.store')}}"
                    method="post" enctype="multipart/form-data">
                    @csrf
                    @if($tombol === 'Edit Data')
                    @method('PATCH')
                    @else
                    <input type='number' hidden value="{{$kos}}" name="kos">
                    @endif
                    @if ($tombol == 'Edit Data')
                    <h5>Gambar Yang Mau Dihapus</h5>
                    <div class="card-body d-flex flex-wrap justify-content-start">
                        <ul class="row caw">
                            @foreach ($kamar->gambars as $key => $gambar)
                            <li><input type="checkbox" id="cb{{$key}}" name="gambarsH[]" value="{{$gambar->id}}" />
                                <label for="cb{{$key}}"><img
                                        src="{{asset('/storage/images/kamar/'.$gambar->nama)}}" /></label>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    <h5>Gambar Yang Mau Ditambah</h5>
                    <div class="card-body d-flex flex-wrap justify-content-start" id="container">

                    </div>
            </div>
        </div>
        <div class="col-md-6 border-right">
            <div class="p-3 py-5">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4 class="text-right">{{$tombol}} Kamar</h4>
                </div>
                <div class="col-md-12 mt-3">
                    <label for="desc_kamar">Deskripsi Kamar </label>
                    <textarea type="text" class="form-control mb-3 @error('desc_kamar') is-invalid @enderror"
                        name="desc_kamar" id="desc_kamar" aria-describedby="helpId"
                        placeholder="Masukan Deskripsi">{{old('desc_kamar') ?? $kamar->desc_kamar ?? ''}}</textarea>

                </div>
                @error('desc_kamar')
                <div class="alert alert-danger">
                    {{$message}}
                </div>
                @enderror
                <div class="col-md-12 mt-3">
                    <label class="labels">Gambar Kamar</label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Upload</span>
                        </div>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" {{$tombol == 'Edit Data' ? '' : 'required' }}
                                multiple name="gambar[]" id="gambar">
                            <label class="custom-file-label" for="gambar">Choose file</label>
                        </div>
                    </div>
                    @error('gambar')
                    <div class="alert alert-danger">
                        {{$message}}
                    </div>
                    @enderror
                </div>
            </div>
            <div class="mb-5 text-center"><button class="btn btn-primary profile-button"
                    type="submit">{{$tombol}}</button>
            </div>
            </form>
        </div>
    </div>
</div>
</div>
</div>
</div>
<script>
    if ( window.FileReader ) {
    let con = document.getElementById('container');
    document.getElementById("gambar").onchange = function(){

        var counter = -1, file;

        while ( file = this.files[ ++counter ] ) {
            var reader = new FileReader();

            reader.onloadend = (function(file){

                return function(){

                    var image = new Image();
                    image.height = 100;
                    image.width = 100;
                    image.title = file.name;
                    image.style.marginLeft = '40px';
                    image.style.marginBottom = '40px';
                    image.src = /^image/.test(file.type)
                        ? this.result
                        : "http://i.stack.imgur.com/t9QlH.png";

                    con.appendChild( image );

                }

            })(file);

            reader.readAsDataURL( file );

        }

    }

}
    // let gambar = document.getElementById('gambar');
    // let fot2 = document.getElementById('fot2');
    // gambar.addEventListener('change', function() {
    //     // let gambars = gambar.files;
    //     // for(i=0;i<gambars.length;i++){
    //     //     console.log(gambars[i].name);
    //     //     fot2.src = gambars[i].name;
    //     //     fot2.style.width = "100%";
    //     //     fot2.style.height = 200;
    //     // }

    //     readURL(this);
    // });

    // function readURL(input) {
    //     if (input.files) {
    //         var reader = new FileReader();
    //         console.log(reader);
    //         reader.onload = function(e) {
    //             console.log('aw');
    //             fot2.src = e.target.result;
    //             fot2.style.width = "100%";
    //             fot2.style.height = 200;
    //         }

    //         for (i = 0; i < input.files.length; i++) {
    //             reader.readAsDataURL(input.files[i]); // convert to base64 string
    //         }


    //     }
    // }
</script>
