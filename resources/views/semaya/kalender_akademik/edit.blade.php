@extends('semaya.layouts.app')

@section('content')

<!-- Start breadcrumb content -->
    <div class="card-panel">
      <div class="row mar-bot">
        <div class="col s12 m12 l12">
          <h4 class="page-title">Ubah Kalender Akademik</h4>
        </div>
      </div>
      <div class="row mar-bot">
        <div class="col s12 m12 l12">
          <ul class="custom-breadcrumb">
            <li><a href="{{ route('kalender_akademik_index') }}">Kalender Akademik</a></li>
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
        <form class="col s12 m12 l12" action="{{ route('kalender_akademik_update') }}" method="post" autocomplete="off">
          {{ csrf_field() }}
          <input type="hidden" name="id" value="{{ $kalender_akademik->id }}">
          <div class="row">
            <div class="input-field col s12 m6 l6">
              <input type="text" name="nama_kegiatan" id="nama_kegiatan" required value="{{ $kalender_akademik->nama_kegiatan }}">
              <label for="nama_kegiatan">Nama Kegiatan</label>
            </div>
            <div class="input-field col s12 m6 l6">
              <select class="select2" name="tahun_ajaran_id">
                <option disabled selected>Tahun Ajaran</option>
                @foreach ($tahun_ajaran as $value)
                  @if($kalender_akademik->tahun_ajaran_id == $value->id)
                  <option value="{{ $value->id }}" selected>{{ $value->nama }}</option>
                  @else
                  <option value="{{ $value->id }}">{{ $value->nama }}</option>
                  @endif
                @endforeach
              </select>
            </div>
          </div>
          <div class="row">
            <div class="input-field col s12 m6 l6">
              <input type="text" name="tanggal_mulai" id="tanggal_mulai" class="datepicker" value="{{ Carbon::createFromFormat('Y-m-d', $kalender_akademik->tanggal_mulai)->format('d/m/Y') }}">
              <label for="tanggal_mulai">Tanggal Mulai</label>
            </div>
            <div class="input-field col s12 m6 l6">
              <input type="text" name="tanggal_selesai" id="tanggal_selesai" class="datepicker" value="{{ Carbon::createFromFormat('Y-m-d', $kalender_akademik->tanggal_selesai)->format('d/m/Y') }}">
              <label for="tanggal_selesai">Tanggal Selesai</label>
            </div>
          </div>
          <div class="row">
            <div class="input-field col s12 m6 l6">
              <select name="jenis_kegiatan" class="select2">
                <option value="" disabled selected>Tipe</option>
                <option value="1" @if($kalender_akademik->tipe == '1')selected @endif>Liburan</option>
                <option value="2" @if($kalender_akademik->tipe == '2')selected @endif>Magang</option>
                <option value="3" @if($kalender_akademik->tipe == '3')selected @endif>Kegiatan (Libur)</option>
                <option value="4" @if($kalender_akademik->tipe == '4')selected @endif>Kegiatan (Tidak Libur)</option>
              </select>
            </div>
            <div class="input-field col s12 m6 l6">
              <select name="warna_label" class="select2">
                <option value="" disabled selected>Warna Label</option>
                <option value="#E53935" @if($kalender_akademik->warna_label == '#E53935')selected @endif>Merah</option>
                <option value="#1565C0" @if($kalender_akademik->warna_label == '#1565C0')selected @endif>Biru</option>
                <option value="#00796B" @if($kalender_akademik->warna_label == '#00796B')selected @endif>Hijau</option>
                <option value="#FFEB3B" @if($kalender_akademik->warna_label == '#FFEB3B')selected @endif>Kuning</option>
              </select>
            </div>
          </div>
          <div class="row">
            <div class="input-field col s12 m6 l6">
              <textarea id="deskripsi_kegiatan" class="materialize-textarea" name="deskripsi_kegiatan">{{ $kalender_akademik->deskripsi }}</textarea>
              <label for="deskripsi_kegiatan">Deskripsi Kegiatan (Opsional)</label>
            </div>
            <div class="input-field col s12 m6 l6">
              <select name="tingkat" class="select2">
                <option value="0" selected>Tingkat Kelas</option>
                @foreach ($tingkat as $value)
                  <option value="{{ $value->id }}" @if($kalender_akademik->tingkat_id == $value->id)selected @endif>{{ $value->nama_tingkat }}</option>
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
