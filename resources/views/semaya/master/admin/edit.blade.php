@extends('semaya.layouts.app')

@section('content')

<!-- Start breadcrumb content -->
    <div class="card-panel">
      <div class="row mar-bot">
        <div class="col s12 m12 l12">
          <h4 class="page-title">Ubah Admin</h4>
        </div>
      </div>
      <div class="row mar-bot">
        <div class="col s12 m12 l12">
          <ul class="custom-breadcrumb">
            <li><a href="{{ route('admin_index') }}">Admin</a></li>
            <li>Ubah</li>
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
        <form class="col s12 m12 l12" action="{{ route('admin_update') }}" method="post" autocomplete="off" enctype="multipart/form-data">
          {{ csrf_field() }}
          <input type="hidden" name="id" value="{{ $admin->id }}">
          <input type="hidden" name="user_id" value="{{ $user->id }}">
          <div class="row">
            <div class="input-field col s12 m6 l6">
              <input type="text" name="nama" id="nama" required value="{{ $admin->nama }}">
              <label for="nama">Nama</label>
            </div>
            <div class="input-field col s12 m6 l6">
              <select class="select2" name="tipe">
                <option value="" selected disabled>Tipe Admin</option>
                @foreach($roles as $value)
                <option value="{{ $value->id }}" @if($role_user->role_id == $value->id)selected @endif>{{ $value->display_name }}</option>
                @endforeach
              </select>
            </div>
          </div>
          <div class="row">
            <div class="input-field col s12 m6 l6">
              <input type="text" name="nama_pengguna" id="nama_pengguna" required value="{{ $admin->username }}">
              <label for="nama_pengguna">Nama Pengguna</label>
            </div>
            <div class="input-field col s12 m6 l6">
              <input type="password" name="password" id="password">
              <label for="password">Password (Isi jika akan diganti)</label>
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
            <div class="input-field col s12 m4 l4">
              <img src="{{ url('assets/img/users/'.$admin->foto) }}" alt="Foto Admin" class="responsive-img">
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
