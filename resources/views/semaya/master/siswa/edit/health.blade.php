@extends('semaya.layouts.app')

@section('content')

<!-- Start breadcrumb content -->
    <div class="card-panel">
      <div class="row mar-bot">
        <div class="col s12 m12 l12">
          <h4 class="page-title">Ubah Siswa</h4>
        </div>
      </div>
      <div class="row mar-bot">
        <div class="col s6 m6 l6">
          <ul class="custom-breadcrumb">
            <li><a href="#">Master</a></li>
            <li><a href="#">Siswa</a></li>
            <li><a href="#">Ubah</a></li>
            <li>Data Kesehatan</li>
          </ul>
        </div>
        <div class="col s6 m6 l6">
          <a href="{{ route('siswa_edit', ['id' => $data->id]) }}" class="btn btn-plus indigo tooltipped" data-position="top" data-delay="50" data-tooltip="Data Pribadi Siswa"><i class="material-icons">person</i></a>
          <a href="{{ route('siswa_edit_health', ['id' => $data->id]) }}" class="btn btn-plus indigo tooltipped" data-position="top" data-delay="50" data-tooltip="Data Kesehatan Siswa"><i class="material-icons">local_hospital</i></a>
          <a href="{{ route('siswa_edit_family', ['id' => $data->id]) }}" class="btn btn-plus indigo tooltipped" data-position="top" data-delay="50" data-tooltip="Data Orang Tua Siswa"><i class="material-icons">group</i></a>
          <a href="{{ route('siswa_edit_admin', ['id' => $data->id]) }}" class="btn btn-plus indigo tooltipped" data-position="top" data-delay="50" data-tooltip="Data Administrasi Siswa"><i class="material-icons">location_city</i></a>
          <a href="{{ route('siswa_edit_graduation', ['id' => $data->id]) }}" class="btn btn-plus indigo tooltipped" data-position="top" data-delay="50" data-tooltip="Data Kepindahan/Kelulusan Siswa"><i class="material-icons">school</i></a>
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
    @if (count($errors) > 0)
      <div class="card-panel red white-text">
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
      </div>
    @endif
    <div class="card-panel">
      <div class="row">
        <form class="col s12 m12 l12" action="{{ route('siswa_update_health') }}" method="post" autocomplete="off">
          {!! csrf_field() !!}
          <input type="hidden" name="id_siswa" value="{{ $data->id }}">
          <div class="row">
            <div class="row">
              <div class="input-field col s12 m12 l12">
                <input id="goldar" name="goldar" type="text" class="validate" value="{{ $data->gol_darah }}">
                <label for="goldar">Golongan Darah</label>
              </div>
            </div>
            <div class="row">
              <div class="input-field col s12 m12 l12">
                <input id="penyakit" name="penyakit" type="text" class="validate" value="{{ $data->penyakit }}">
                <label for="penyakit">Penyakit Yang Pernah Diderita</label>
              </div>
            </div>
            <div class="row">
              <div class="input-field col s12 m12 l12">
                <input id="kelainan" name="kelainan" type="text" class="validate" value="{{ $data->kelainan }}">
                <label for="kelainan">Kelainan Jasmani</label>
              </div>
            </div>
            <div class="row">
              <div class="input-field col s12 m6 l6">
                <input id="tinggi" name="tinggi" type="text" class="validate" value="{{ $data->tinggi }}">
                <label for="tinggi">Tiggi Badan (CM)</label>
              </div>
              <div class="input-field col s12 m6 l6">
                <input id="berat" name="berat" type="text" class="validate" value="{{ $data->berat }}">
                <label for="berat">Berat Badan (KG)</label>
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

@section('asset_footer')
  <script>
  $(document).ready(function() {
    $('#berat').mask('00000');
    $('#tinggi').mask('00000');
  });
  </script>
@endsection
