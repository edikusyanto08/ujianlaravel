@extends('semaya.layouts.app')

@section('content')

<!-- Start breadcrumb content -->
    <div class="card-panel">
      <div class="row mar-bot">
        <div class="col s12 m12 l12">
          <h4 class="page-title">Ubah Guru</h4>
        </div>
      </div>
      <div class="row mar-bot">
        <div class="col s12 m7 l7">
          <ul class="custom-breadcrumb">
            <li><a href="#">Master</a></li>
            <li><a href="#">Guru</a></li>
            <li><a href="#">Ubah</a></li>
            <li>Data Keahlian</li>
          </ul>
        </div>
        <div class="col s12 m5 l5">
          <a href="{{ route('guru_edit', ['id' => $data->id]) }}" class="btn btn-plus indigo tooltipped" data-position="top" data-delay="50" data-tooltip="Data Pribadi Guru"><i class="material-icons">person</i></a>
          <a href="{{ route('guru_edit_education', ['id' => $data->id]) }}" class="btn btn-plus indigo tooltipped" data-position="top" data-delay="50" data-tooltip="Data Pendidikan dan Kepegawaian Guru"><i class="material-icons">school</i></a>
          <a href="{{ route('guru_edit_experience', ['id' => $data->id]) }}" class="btn btn-plus indigo tooltipped" data-position="top" data-delay="50" data-tooltip="Data Keahlian Guru"><i class="material-icons">account_balance</i></a>
          <a href="{{ route('guru_edit_status', ['id' => $data->id]) }}" class="btn btn-plus indigo tooltipped" data-position="top" data-delay="50" data-tooltip="Data Status Guru"><i class="material-icons">verified_user</i></a>
        </div>
      </div>
    </div>
<!-- End breadcrumb content -->

<!-- Start content of page -->
<div class="row">
  <div class="col s12 m12 l12 child-content">
    @if (session('message'))
      <div class="card-panel green white-text">
        {{ session('message') }}
      </div>
    @endif
    <div class="card-panel">
      <div class="row">
        <form class="col s12 m12 l12" action="{{ route('guru_update_experience') }}" method="post" autocomplete="off">
          {!! csrf_field() !!}
          <input type="hidden" name="id_guru" value="{{ $data->id }}">
          {{-- ini kiri --}}
          <div class="row col s12 m6 l6">
            <div class="row">
              <div class="input-field col s12 m12 l12">
                <input id="bidang_studi_sertifikasi" name="bidang_studi_sertifikasi" type="text" class="validate" value="{{ $data->bidang_studi_sertifikasi }}">
                <label for="bidang_studi_sertifikasi">Bidan Studi Sertifikasi</label>
              </div>
            </div>
            <div class="row">
              <div class="input-field col s12 m6 l6">
                <input id="no_peserta_sertifikasi" name="no_peserta_sertifikasi" type="text" class="validate" value="{{ $data->no_peserta_sertifikasi }}">
                <label for="no_peserta_sertifikasi">No. Peserta Sertifikasi</label>
              </div>
              <div class="input-field col s12 m6 l6">
                <input id="tgl_sertifikasi" name="tgl_sertifikasi" type="text" class="datepicker" @if ($data->tgl_sertifikasi != null)
                  value="{{ \Carbon\Carbon::createFromFormat('Y-m-d', $data->tgl_sertifikasi)->format('d/m/Y') }}" @endif>
                <label for="tgl_sertifikasi">Tanggal Sertifikasi</label>
              </div>
            </div>
            <div class="row">
              <div class="input-field col s12 m12 l12">
                <input id="lptk_penyelenggara_sertifikasi" name="lptk_penyelenggara_sertifikasi" type="text" class="validate" value="{{ $data->lptk_penyelenggara_sertifikasi }}">
                <label for="lptk_penyelenggara_sertifikasi">LPTK Penyelenggara Sertifikasi</label>
              </div>
            </div>
          </div>
          {{-- ini kanan --}}
          <div class="row col s12 m6 l6">
            <div class="row">
              <div class="input-field col s12 m6 l6">
                <input id="no_peserta_sertifikasi_konversi" name="no_peserta_sertifikasi_konversi" type="text" class="validate" value="{{ $data->no_peserta_sertifikasi_konversi }}">
                <label for="no_peserta_sertifikasi_konversi">No. Peserta Sertifikasi Konversi</label>
              </div>
              <div class="input-field col s12 m6 l6">
                <input id="nrg" name="nrg" type="text" class="validate" value="{{ $data->nrg }}">
                <label for="nrg">NRG</label>
              </div>
            </div>
            <div class="row">
              <div class="input-field col s12 m12 l12">
                <input id="bidang_studi_sertifikasi2" name="bidang_studi_sertifikasi2" type="text" class="validate" value="{{ $data->bidang_studi_sertifikasi2 }}">
                <label for="bidang_studi_sertifikasi2">Bidan Studi Sertifikasi Kedua</label>
              </div>
            </div>
            <div class="row">
              <div class="input-field col s12 m6 l6">
                <input id="no_peserta_sertifikasi2" name="no_peserta_sertifikasi2" type="text" class="validate" value="{{ $data->no_peserta_sertifikasi2 }}">
                <label for="no_peserta_sertifikasi2">No. Peserta Sertifikasi Kedua</label>
              </div>
              <div class="input-field col s12 m6 l6">
                <input id="tgl_sertifikasi2" name="tgl_sertifikasi2" type="text" class="datepicker" @if ($data->tgl_sertifikasi2 != null)
                  value="{{ \Carbon\Carbon::createFromFormat('Y-m-d', $data->tgl_sertifikasi2)->format('d/m/Y') }}" @endif>
                <label for="tgl_sertifikasi2">Tanggal Sertifikasi Kedua</label>
              </div>
            </div>
            <div class="row">
              <div class="input-field col s12 m12 l12">
                <input id="lptk_penyelenggara_sertifikasi2" name="lptk_penyelenggara_sertifikasi2" type="text" class="validate" value="{{ $data->lptk_penyelenggara_sertifikasi2 }}">
                <label for="lptk_penyelenggara_sertifikasi2">LPTK Penyelenggara Sertifikasi Kedua</label>
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
