@extends('semaya.layouts.app')

@section('content')

<!-- Start breadcrumb content -->
    <div class="card-panel">
      <div class="row mar-bot">
        <div class="col s12 m12 l12">
          <h4 class="page-title">Tambah Mutasi Karyawan</h4>
        </div>
      </div>
      <div class="row mar-bot">
        <div class="col s12 m6 l6">
          <ul class="custom-breadcrumb">
            <li><a href="#">Mutasi Karyawan</a></li>
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
      <form action="{{ route('mutasi_karyawan_store') }}" method="post" autocomplete="off">
        {{ csrf_field() }}
        <div class="row">
          <div class="input-field col s12 m12 l6">
            <select class="select2" name="karyawan_id">
              <option value selected disabled>Pilih Karyawan:</option>
              @foreach($karyawan as $value)
              <option value="{{ $value->id }}" @if(old('karyawan_id') == $value->id)selected @endif>{{ $value->nama }}</option>
              @endforeach
            </select>
          </div>
          <div class="input-field col s12 m12 l6">
            <select class="select2" name="jenis_mutasi_id">
              <option value selected disabled>Pilih Jenis Mutasi:</option>
              @foreach($jenis_mutasi as $value)
              <option value="{{ $value->id }}" @if(old('jenis_mutasi_id') == $value->id)selected @endif>{{ $value->mutasi }}</option>
              @endforeach
            </select>
          </div>
        </div>
        <div class="row mar-bot">
          <div class="input-field col s12 m12 l6">
            <select class="select2" name="tahun_ajaran_id">
              <option value selected disabled>Pilih Tahun Ajaran:</option>
              @foreach($tahun_ajaran as $value)
              <option value="{{ $value->id }}" @if(old('tahun_ajaran_id') == $value->id)selected @endif>{{ $value->nama }}</option>
              @endforeach
            </select>
          </div>
          <div class="input-field col s12 m12 l6">
            <input type="text" class="datepicker" name="tanggal" id="tanggal_mutasi" value="{{ old('tanggal') }}">
            <label for="tanggal_mutasi">Tanggal Mutasi</label>
          </div>
        </div>
        <div class="row">
          <div class="input-field col s12 m12 l6">
            <textarea id="alasan_mutasi" class="materialize-textarea validate" name="alasan" required>{{ old('alasan') }}</textarea>
            <label for="alasan_mutasi">Alasan Mutasi</label>
          </div>
          <div class="input-field col s12 m12 l6">
            <input id="mutasi_ke" type="text" class="validate" name="mutasi_ke" required value="{{ old('mutasi_ke') }}">
            <label for="mutasi_ke">Mutasi Ke</label>
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
