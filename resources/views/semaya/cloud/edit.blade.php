@extends('semaya.layouts.app')

@section('content')

<!-- Start breadcrumb content -->
    <div class="card-panel">
      <div class="row mar-bot">
        <div class="col s12 m12 l12">
          <h4 class="page-title">Ubah Sekolah Pengguna Semaya</h4>
        </div>
      </div>
      <div class="row mar-bot">
        <div class="col s12 m12 l12">
          <ul class="custom-breadcrumb">
            <li><a href="#">Semaya Cloud</a></li>
            <li>Ubah</li>
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
      <form action="{{ route('cloud_computing_update') }}" method="post" autocomplete="off">
        {{ csrf_field() }}
        <input type="hidden" name="id" value="{{ $sekolah_master->id }}">
        <div class="row mar-bot">
          <div class="input-field col s12 m12 l6">
            <input id="nama_sekolah" type="text" required name="nama_sekolah" value="{{ $sekolah_master->nama }}" readonly>
            <label for="nama_sekolah">Nama Sekolah</label>
          </div>
          <div class="input-field col s12 m12 l6">
            <input id="tanggal_expired" type="text" class="datepicker" required name="tanggal_expired" value="{{ Carbon::createFromFormat('Y-m-d', $sekolah_master->expired)->format('d/m/Y') }}">
            <label for="tanggal_expired">Tanggal Expired</label>
          </div>
        </div>
        <div class="row">
          <div class="input-field col s12 m12 l12">
            Pilih fitur yang akan digunakan:
          </div>
        </div>
        <div class="row">
          @foreach($modules as $key => $value)
          @php
          if($value['id'] == 2) {
            $feature = $sekolah_master->database2;
          }
          elseif($value['id'] == 3) {
            $feature = $sekolah_master->database3;
          }
          elseif($value['id'] == 4) {
            $feature = $sekolah_master->database4;
          }
          @endphp
          <div class="col s12 m12 l4">
            <input type="checkbox" id="check-{{ $value['id'] }}" class="filled-in" name="feature[{{ $value['id'] }}]" @if($feature != '')checked @endif />
            <label for="check-{{ $value['id'] }}">{{ $value['feature'] }}</label>
          </div>
          @endforeach
        </div>
        <div class="row">
          <div class="input-field col s12 m12 l12">
            <button type="submit" class="btn waves-effect waves-light indigo">Simpan</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
<!-- End content of page -->

@endsection
