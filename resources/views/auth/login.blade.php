<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script
      src="https://kit.fontawesome.com/64d58efce2.js"
      crossorigin="anonymous"
    ></script>
    <link rel="stylesheet" href="{{asset('css/login.css')}}" />
    <title>Sign in & Sign up Form</title>
  </head>
  <body>
 @isset($regis)
     <h1>awwdw</h1>
 @endisset
     @if(session()->has('regis'))
        <div class="container sign-up-mode">
        {{session()->forget('regis')}}
     @else
        <div class="container">
     @endif
      <div class="forms-container">
        <div class="signin-signup">
          <form  method="POST" action="{{route('login')}}" class="sign-in-form">
            @csrf
            <h2 class="title">Sign in</h2>
            <div class="input-field">
              <i class="fas fa-user"></i>
              <input type="text" class="@error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Enter Email Address..." />

            </div>
             @error('email')
                      <span style="color:red;" class="loginE" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
            @enderror

            <div class="input-field">
              <i class="fas fa-lock"></i>
              <input type="password" class="@error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Password" />
            </div>
              @error('password')
                     <span style="color:red;" class="loginE" role="alert">
                        <strong>{{ $message }}</strong>
                     </span>
            @enderror
            <div class="form-group">
            @if (Route::has('password.request'))
                    <div class="text-center">
                        <a class="small" href="{{ route('password.request') }}">Lupa Password</a>
                    </div>
            @endif
                    <div class="custom-control custom-checkbox small">
                        <input type="checkbox" class="custom-control-input" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                        <label class="custom-control-label" for="remember">Ingat Aku</label>
                    </div>

            </div>

            <input type="submit" value="Login" class="btn solid" />
          </form>

          <form  method="POST" action="{{ route('register') }}" class="sign-up-form">
            @csrf

            <h2 class="title">Sign up</h2>
            <div class="input-field">
              <i class="fas fa-user"></i>
              <input type="text" class="@error('nama') is-invalid @enderror" name="nama" value="{{ old('nama') }}" placeholder="username" required autocomplete="nama" autofocus />
            </div>
             @error('nama')
                    <span  style="color:red;" class="loginE" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
            @enderror


            <div class="input-field">
              <i class="fas fa-envelope"></i>
              <input type="email" class="@error('email') is-invalid @enderror" name="email" value="{{ old('email') }}"  placeholder="email" required autocomplete="email" />
            </div>
            @error('email')
                  <span  style="color:red;" class="loginE" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
            @enderror

             <div class="input-field">
              <i class="fas fa-phone"></i>
              <input type="phone" class="@error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}"  placeholder="phone example 0895347024882" required autocomplete="phone" />
            </div>
            @error('phone')
                  <span  style="color:red;" class="loginE" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
            @enderror

            <div class="input-field">
              <i class="fas fa-lock"></i>
              <input  type="password" class="@error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="Password" />
            </div>
              @error('password')
                    <span  style="color:red;" class="loginE" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
             @enderror

             <div class="input-field">
              <i class="fas fa-lock"></i>
             <input class="form-control form-control-user" id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" placeholder="Repeat Password">
            </div>

            <input type="submit" class="btn" value="Daftar" />
          </form>
        </div>
      </div>

      <div class="panels-container">
        <div class="panel left-panel">
          <div class="content">
            <h3>Belum Mendaftar ?</h3>
            <p>
              Daftarkan diri anda disini sebelum login jika anda seorang pemilik Kos
            </p>
            <button class="btn transparent" id="sign-up-btn">
              Sign up
            </button>
             <button class="btn transparent lhome">
              Home
            </button>
          </div>
          <img src="{{asset('storage/images/logo/log.svg')}}" class="image" alt="" />
        </div>
        <div class="panel right-panel">
          <div class="content">
            <h3>Sudah punya akun?</h3>
            <p>
              Silakan login sebagai pemilik kos jika anda sudah punya akun, dan daftarkan kos anda di aplikasi ini
            </p>
            <button class="btn transparent" id="sign-in-btn">
              Sign in
            </button>
            <button class="btn transparent lhome">
              Home
            </button>
          </div>
        <img src="{{asset('storage/images/logo/register.svg')}}" class="image" alt="" />
        </div>
      </div>
    </div>

    <script src="{{asset('js/login.js')}}"></script>
    <script>

    </script>
  </body>
</html>
