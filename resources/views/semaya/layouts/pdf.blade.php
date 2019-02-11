<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Semaya</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ public_path('assets/css/pdf.css?v='.config('etc.asset_ver')) }}">
  </head>
  <body>
    <div class="container">
      @if(App\Sekolah::count() > 0)
      <div class="row header">
        <div class="col-2">
          @php
          $sekolah = App\Sekolah::first();
          @endphp
          <img src="{{ public_path('assets/img/sekolah/'.$sekolah->logo) }}" alt="{{ $sekolah->nama_sekolah }}" class="responsive-img">
        </div>
        <div class="col-10">
          <h1 class="text-center">{{ $sekolah->nama_sekolah }}</h1>
          <h3 class="text-center">{{ $sekolah->alamat }}</h3>
        </div>
      </div>
      @endif
      <div class="row">
        <div class="col-12">
          @yield('content')
        </div>
      </div>
    </div>
  </body>
</html>
