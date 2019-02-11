@php
$role_user = App\RoleUser::where('user_id', Auth::user()->id)->first();
$role = App\Role::find($role_user->role_id);
if ($role->id == 1) {
  $root = App\Root::where('username', Auth::user()->username)->first();
  $user_name = $root->nama;
  $user_foto = $root->foto;
}
elseif ($role->id == 2) {
  $admin = App\Admin::where('username', Auth::user()->username)->first();
  $user_name = $admin->nama;
  $user_foto = $admin->foto;
}
elseif ($role->id == 4) {
  $guru = App\Guru::where('nomor_kartu', Auth::user()->username)->first();
  $user_name = $guru->nama;
  $user_foto = $guru->foto;
}
elseif ($role->id == 5) {
  $siswa = App\Siswa::where('nomor_kartu', Auth::user()->username)->first();
  $user_name = $siswa->nama_lengkap;
  $user_foto = $siswa->foto;
}
@endphp
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Semaya</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ url('assets/img/favicon.jpg?v=').config('etc.asset_ver') }}">
    <link rel="stylesheet" href="{{ url('assets/css/materialize.min.css?v=').config('etc.asset_ver') }}">
    <link rel="stylesheet" href="{{ url('assets/css/icon.css?v=').config('etc.asset_ver') }}">
    <link rel="stylesheet" href="{{ url('assets/plugins/select2/css/select2.min.css?v=').config('etc.asset_ver') }}">
    <link rel="stylesheet" href="{{ url('assets/plugins/perfect-scrollbar/css/perfect-scrollbar.min.css?v=').config('etc.asset_ver') }}">
    @yield('asset_header')
    <link rel="stylesheet" href="{{ url('assets/css/custom.css?v=').config('etc.asset_ver') }}">
  </head>
  <body class="grey lighten-3">
    @include('semaya.layouts.navbar')

    @include('semaya.layouts.sidenav')

    <div id="page-content">
      @yield('content')
    </div>

    <script src="{{ url('assets/js/jquery.min.js?v=').config('etc.asset_ver') }}"></script>
    <script src="{{ url('assets/js/materialize.min.js?v=').config('etc.asset_ver') }}"></script>
    <script src="{{ url('assets/plugins/select2/js/select2.min.js?v=').config('etc.asset_ver') }}"></script>
    <script src="{{ url('assets/js/jquery.mask.min.js?v=').config('etc.asset_ver') }}"></script>
    <script src="{{ url('assets/plugins/perfect-scrollbar/js/perfect-scrollbar.jquery.min.js?v=').config('etc.asset_ver') }}"></script>
    @yield('asset_footer')
    <script src="{{ url('assets/js/admin.js?v=').config('etc.asset_ver') }}"></script>
  </body>
</html>
