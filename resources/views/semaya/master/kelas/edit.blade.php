@extends('semaya.layouts.app')

@section('content')

<!-- Start breadcrumb content -->
    <div class="card-panel">
      <div class="row mar-bot">
        <div class="col s12 m12 l12">
          <h4 class="page-title">Ubah Kelas</h4>
        </div>
      </div>
      <div class="row mar-bot">
        <div class="col s12 m12 l12">
          <ul class="custom-breadcrumb">
            <li><a href="#">Master</a></li>
            <li><a href="#">Kelas</a></li>
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
        <form class="col s12 m12 l12" action="{{ route('kelas_update') }}" method="post" autocomplete="off">
          {!! csrf_field() !!}
          <input type="hidden" name="id_kelas" value="{{ $data->id }}">
          <div class="row">
            <div class="input-field col s12 m12 l12">
              <input id="nama" name="nama" type="text" class="validate" value="{{ $data->nama_kelas }}" required>
              <label for="nama">Nama Kelas</label>
            </div>
          </div>
          <div class="row">
            <div class="input-field col s12 m12 l12">
              <select class="select2" style="width: 100%;" name="wali_kelas">
                <option disabled selected>Wali Kelas (Opsional)</option>
                @foreach ($guru as $value)
                  <option value="{{ $value->id }}" {{ ($data->wali_kelas) ? (($value->id == $data->wali_kelas->guru_id) ? 'selected' : '') : '' }}>
                    {{ ($value->gelar_depan) ? $value->gelar_depan.'.' : '' }} {{ $value->nama }}{{ ($value->gelar_belakang) ? ', '.$value->gelar_belakang.'.' : '' }}
                  </option>
                @endforeach
              </select>
            </div>
          </div>
          <div class="row">
            <div class="input-field col s12 m6 l6">
              <select class="select2" style="width: 100%;" name="tingkat">
                <option disabled selected>Tingkatan</option>
                @foreach ($tingkat as $value)
                  <option value="{{ $value->id }}" @if ($value->id == $data->tingkat_id) selected @endif>{{ $value->nama_tingkat }}</option>
                @endforeach
              </select>
            </div>
            <div class="input-field col s12 m6 l6">
              <select class="select2" style="width: 100%;" name="jurusan">
                <option disabled selected>Jurusan</option>
                @foreach ($jurusan as $key => $value)
                  <option value="{{ $value->id }}" @if ($value->id == $data->jurusan_id) selected @endif>{{ $value->singkatan_jurusan }}</option>
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
