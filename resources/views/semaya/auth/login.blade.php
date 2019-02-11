<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Masuk - {{ config('app.name') }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ url('assets/css/materialize.min.css?v=').config('etc.asset_ver') }}">
    <link rel="stylesheet" href="{{ url('assets/css/icon.css?v=').config('etc.asset_ver') }}">
    <link rel="stylesheet" href="{{ url('assets/css/login.css?v=').config('etc.asset_ver') }}">
  </head>
  <body class="dark-custom">
    <div class="login-container">
      <div class="row center">
        <div class="col s12 m12 l12">
          <a href="javascript:void(0)" class="white-text login-logo">{{ config('app.name') }}</a>
        </div>
      </div>
      <div class="row">
        <div class="col s12 m12 l12">
          <div class="card-panel">
            <div class="row center mar-bot">
              <div class="col s12 m12 l12">
                <i class="material-icons md-login indigo-text">account_circle</i>
              </div>
            </div>
            <form action="{{ route('post_login') }}" method="post" autocomplete="off">
              {{ csrf_field() }}
              <div class="row mar-bot">
                <div class="input-field col s12 m12 l12">
                  <i class="material-icons prefix">account_box</i>
                  <input id="username" name="username" type="text" class="validate" required value="{{ old('username') }}">
                  <label for="username">Nama Pengguna</label>
                </div>
              </div>
              <div class="row mar-bot">
                <div class="input-field col s12 m12 l12">
                  <i class="material-icons prefix">lock</i>
                  <input id="password" name="password" type="password" class="validate" required value="{{ old('password') }}">
                  <label for="password">Kata Sandi</label>
                </div>
              </div>
              <div class="row">
                <div class="input-field col s12 m12 l12">
                  <button type="submit" class="btn waves-effect waves-light indigo btn-full">Masuk</button>
                </div>
              </div>
              @if(session('message'))
              <div class="row mar-bot">
                <div class="col s12 m12 l12">
                  <div class="card-panel red darken-1 white-text">
                    {{ session('message') }}
                  </div>
                </div>
              </div>
              @endif
            </form>
          </div>
        </div>
      </div>
    </div>
    <div class="container">
      <div class="row center white-text">
        <div class="col s12 m12 l12">
          &copy; {{ date('Y').' '.config('app.name') }}. Dikaryakan oleh Jurusan RPL SMK Negeri 10 Jakarta.
        </div>
      </div>
    </div>

    <script src="{{ url('assets/js/jquery.min.js?v=').config('etc.asset_ver') }}"></script>
    <script src="{{ url('assets/js/materialize.min.js?v=').config('etc.asset_ver') }}"></script>
    <script src="{{ url('assets/js/login.js?v=').config('etc.asset_ver') }}"></script>
  </body>
</html>
