@extends('semaya.layouts.app')

@section('content')

<!-- Start breadcrumb content -->
    <div class="card-panel">
      <div class="row mar-bot">
        <div class="col s12 m12 l12">
          <h4 class="page-title">Edit Kamera CCTV</h4>
        </div>
      </div>
      <div class="row mar-bot">
        <div class="col s12 m10 l10">
          <ul class="custom-breadcrumb">
            <li><a href="#">Lainnya</a></li>
            <li><a href="#">Kamera CCTV</a></li>
            <li>Edit</li>
          </ul>
        </div>
      </div>
    </div>
<!-- End breadcrumb content -->

<!-- Start content of page -->
<div class="row">
  <div class="col s12 m12 l12 child-content">
    @if (count($errors) > 0)
      <div class="card-panel red white-text">
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
      </div>
    @endif
    <div class="card-panel">
      <div class="row">
        <form class="col s12 m12 l12" action="{{ route('cctv_update') }}" method="post" autocomplete="off">
          {!! csrf_field() !!}
          <input type="hidden" name="id" value="{{ $cctv->id }}">
          <div class="row">
            <div class="input-field col s12 m6 l6">
              <input id="nama_tempat" type="text" class="validate" name="nama_tempat" required value="{{ $cctv->nama_tempat }}">
              <label for="nama_tempat">Nama Tempat</label>
            </div>
            <div class="input-field col s12 m6 l6">
              <input id="ip" type="text" class="validate" name="ip" required value="{{ $cctv->ip }}">
              <label for="ip">IP CCTV (Contoh: 110.232.89.70)</label>
            </div>
          </div>
          <div class="row">
            <div class="input-field col s12 m6 l6">
              <input id="username" type="text" class="validate" name="username" required value="{{ $cctv->username }}">
              <label for="username">Username</label>
            </div>
            <div class="input-field col s12 m6 l6">
              <input id="password" type="text" class="validate" name="password" value="{{ $cctv->password }}">
              <label for="password">Password (Opsional)</label>
            </div>
          </div>
          <div class="row">
            <div class="input-field col s12 m12 l12">
              <input id="channel" type="text" class="validate" name="channel" required value="{{ $cctv->channel }}">
              <label for="channel">Channel (Contoh: 5)</label>
            </div>
          </div>
          <div class="row">
            <div class="input-field col s12 m12 l12">
              <button type="submit" class="waves-effect waves-light btn indigo">Simpan</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- End content of page -->

@endsection
