@extends('semaya.layouts.app')

@section('content')

<!-- Start breadcrumb content -->
    <div class="card-panel">
      <div class="row mar-bot">
        <div class="col s12 m12 l12">
          <h4 class="page-title">Ubah Mata Pelajaran</h4>
        </div>
      </div>
      <div class="row mar-bot">
        <div class="col s12 m12 l12">
          <ul class="custom-breadcrumb">
            <li><a href="#">Master</a></li>
            <li><a href="#">Mata Pelajaran</a></li>
            <li>Ubah</li>
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
        <form class="col s12 m12 l12" action="{{ route('pelajaran_update') }}" method="post" autocomplete="off">
          {!! csrf_field() !!}
          <input type="hidden" name="id_pelajaran" value="{{ $data->id }}">
          <div class="row">
            <div class="input-field col s12 m12 l12">
              <input id="kode_pelajaran" name="kode_pelajaran" type="text" class="validate" value="{{ $data->kode_pel }}" required>
              <label for="kode_pelajaran">Kode Pelajaran</label>
            </div>
          </div>
          <div class="row">
            <div class="input-field col s12 m12 l12">
              <input id="nama_pelajaran" name="nama_pelajaran" type="text" class="validate" value="{{ $data->pelajaran }}" required>
              <label for="nama_pelajaran">Nama Pelajaran</label>
            </div>
          </div>
          <div class="row">
            <div class="input-field col s12 m12 l12">
              <select class="select2" style="width: 100%;" name="jenis_pelajaran">
                <option disabled selected>Kelompok Pelajaran</option>
                @foreach ($jenis as $value)
                  <option value="{{ $value->id }}" @if ($value->id == $data->jenis_pelajaran_id) selected @endif>{{ $value->nama }}</option>
                @endforeach
              </select>
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
