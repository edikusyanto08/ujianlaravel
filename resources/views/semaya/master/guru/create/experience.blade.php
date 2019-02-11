@extends('semaya.layouts.app')

@section('content')

<!-- Start breadcrumb content -->
    <div class="card-panel">
      <div class="row mar-bot">
        <div class="col s12 m12 l12">
          <h4 class="page-title">Tambah Guru</h4>
        </div>
      </div>
      <div class="row mar-bot">
        <div class="col s12 m12 l12">
          <ul class="custom-breadcrumb">
            <li><a href="#">Master</a></li>
            <li><a href="#">Guru</a></li>
            <li><a href="#">Tambah</a></li>
            <li>Data Keahlian</li>
          </ul>
        </div>
      </div>
    </div>
<!-- End breadcrumb content -->

<!-- Start content of page -->
<div class="row">
  <div class="col s12 m12 l12 child-content">
    <div class="card-panel">
      <div class="row">
        <form class="col s12 m12 l12" action="{{ route('guru_store_experience') }}" method="post" autocomplete="off">
          {!! csrf_field() !!}
          <input type="hidden" name="id_guru" value="{{ session('id_guru') }}">
          {{-- ini kiri --}}
          <div class="row col s12 m6 l6">
            <div class="row">
              <div class="input-field col s12 m12 l12">
                <input id="bidang_studi_sertifikasi" name="bidang_studi_sertifikasi" type="text" class="validate">
                <label for="bidang_studi_sertifikasi">Bidan Studi Sertifikasi</label>
              </div>
            </div>
            <div class="row">
              <div class="input-field col s12 m6 l6">
                <input id="no_peserta_sertifikasi" name="no_peserta_sertifikasi" type="text" class="validate">
                <label for="no_peserta_sertifikasi">No. Peserta Sertifikasi</label>
              </div>
              <div class="input-field col s12 m6 l6">
                <input id="tgl_sertifikasi" name="tgl_sertifikasi" type="text" class="datepicker">
                <label for="tgl_sertifikasi">Tanggal Sertifikasi</label>
              </div>
            </div>
            <div class="row">
              <div class="input-field col s12 m12 l12">
                <input id="lptk_penyelenggara_sertifikasi" name="lptk_penyelenggara_sertifikasi" type="text" class="validate">
                <label for="lptk_penyelenggara_sertifikasi">LPTK Penyelenggara Sertifikasi</label>
              </div>
            </div>
          </div>
          {{-- ini kanan --}}
          <div class="row col s12 m6 l6">
            <div class="row">
              <div class="input-field col s12 m6 l6">
                <input id="no_peserta_sertifikasi_konversi" name="no_peserta_sertifikasi_konversi" type="text" class="validate">
                <label for="no_peserta_sertifikasi_konversi">No. Peserta Sertifikasi Konversi</label>
              </div>
              <div class="input-field col s12 m6 l6">
                <input id="nrg" name="nrg" type="text" class="validate">
                <label for="nrg">NRG</label>
              </div>
            </div>
            <div class="row">
              <div class="input-field col s12 m12 l12">
                <input id="bidang_studi_sertifikasi2" name="bidang_studi_sertifikasi2" type="text" class="validate">
                <label for="bidang_studi_sertifikasi2">Bidan Studi Sertifikasi Kedua</label>
              </div>
            </div>
            <div class="row">
              <div class="input-field col s12 m6 l6">
                <input id="no_peserta_sertifikasi2" name="no_peserta_sertifikasi2" type="text" class="validate">
                <label for="no_peserta_sertifikasi2">No. Peserta Sertifikasi Kedua</label>
              </div>
              <div class="input-field col s12 m6 l6">
                <input id="tgl_sertifikasi2" name="tgl_sertifikasi2" type="text" class="datepicker">
                <label for="tgl_sertifikasi2">Tanggal Sertifikasi Kedua</label>
              </div>
            </div>
            <div class="row">
              <div class="input-field col s12 m12 l12">
                <input id="lptk_penyelenggara_sertifikasi2" name="lptk_penyelenggara_sertifikasi2" type="text" class="validate">
                <label for="lptk_penyelenggara_sertifikasi2">LPTK Penyelenggara Sertifikasi Kedua</label>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="input-field col s12 m12 l12">
              <button type="submit" class="waves-effect waves-light btn indigo">Selanjutnya</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- End content of page -->

@endsection
