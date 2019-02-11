@extends('semaya.layouts.app')

@section('content')

<!-- Start breadcrumb content -->
    <div class="card-panel">
      <div class="row mar-bot">
        <div class="col s12 m12 l12">
          <h4 class="page-title">Tambah Admin</h4>
        </div>
      </div>
      <div class="row mar-bot">
        <div class="col s12 m12 l12">
          <ul class="custom-breadcrumb">
            <li><a href="{{ route('admin_index') }}">Admin</a></li>
            <li>Tambah</li>
          </ul>
        </div>
      </div>
    </div>
<!-- End breadcrumb content -->

<!-- Start content of page -->
<div class="row">
  <div class="col s12 m12 l12 child-content">
    @if (session('message') != null)
      <div class="card-panel red white-text">
        @foreach (session('message') as $error)
            <li>{{ $error }}</li>
        @endforeach
      </div>
    @endif
    <div class="card-panel">
      <div class="row">
        <form class="col s12 m12 l12" action="{{ route('admin_store') }}" method="post" autocomplete="off" enctype="multipart/form-data">
          {{ csrf_field() }}
          <div class="row">
            <div class="input-field col s12 m6 l6">
              <input type="text" name="nama" id="nama" required value="{{ old('nama') }}">
              <label for="nama">Nama</label>
            </div>
            <div class="input-field col s12 m6 l6">
              <select class="select2" name="tipe">
                <option value="" selected disabled>Tipe Admin</option>
                @foreach($roles as $value)
                <option value="{{ $value->id }}" @if(old('tipe') == $value->id) @endif>{{ $value->display_name }}</option>
                @endforeach
              </select>
            </div>
          </div>
          <div class="row">
            <div class="input-field col s12 m6 l6">
              <input type="text" name="nama_pengguna" id="nama_pengguna" required value="{{ old('nama_pengguna') }}">
              <label for="nama_pengguna">Nama Pengguna</label>
            </div>
            <div class="input-field col s12 m6 l6">
              <input type="password" name="password" id="password" required value="{{ old('password') }}">
              <label for="password">Password</label>
            </div>
          </div>
          <div class="row">
            <div class="file-field input-field col s12 m6 l6">
              <div class="btn indigo">
                <span>Foto (Opsional)</span>
                <input type="file" name="foto" accept="image/*">
              </div>
              <div class="file-path-wrapper">
                <input class="file-path validate" type="text">
              </div>
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
