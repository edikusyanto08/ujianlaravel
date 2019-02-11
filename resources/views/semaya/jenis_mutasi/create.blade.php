@extends('semaya.layouts.app')

@section('content')

<!-- Start breadcrumb content -->
    <div class="card-panel">
      <div class="row mar-bot">
        <div class="col s12 m12 l12">
          <h4 class="page-title">Tambah Jenis Mutasi</h4>
        </div>
      </div>
      <div class="row mar-bot">
        <div class="col s12 m6 l6">
          <ul class="custom-breadcrumb">
            <li><a href="#">Jenis Mutasi</a></li>
            <li>Tambah</li>
          </ul>
        </div>
      </div>
    </div>
<!-- End breadcrumb content -->

<!-- Start content of page -->
<div class="row">
  <div class="col s12 m12 l12 child-content">
    @if ($errors->any())
      <div class="card-panel red white-text">
        <ul class="error-list">
          @foreach($errors->all() as $error)
          <li>
            {{ $error }}
          </li>
          @endforeach
        </ul>
      </div>
    @endif
    <div class="card-panel">
      <form action="{{ route('jenis_mutasi_store') }}" method="post" autocomplete="off">
        {{ csrf_field() }}
        <div class="row">
          <div class="input-field col s12 m12 l6">
            <input id="nama" type="text" class="validate" name="nama" value="{{ old('nama') }}" required>
            <label for="nama">Nama Mutasi</label>
          </div>
          <div class="input-field col s12 m12 l6">
            <select class="select2" name="tipe">
              <option value disabled selected>Pilih Tipe Mutasi:</option>
              @foreach($tipe as $key => $value)
              <option value="{{ $value['id'] }}" @if(old('tipe') == $value['id'])selected @endif>{{ $value['tipe'] }}</option>
              @endforeach
            </select>
          </div>
        </div>
        <div class="row">
          <div class="input-field col s12 m12 l12">
            <button type="submit" class="btn indigo waves-effect waves-light">Simpan</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
<!-- End content of page -->

@endsection
