@extends('semaya.layouts.app')

@section('content')

<!-- Start breadcrumb content -->
    <div class="card-panel">
      <div class="row mar-bot">
        <div class="col s12 m12 l12">
          <h4 class="page-title">Tambah Siswa</h4>
        </div>
      </div>
      <div class="row mar-bot">
        <div class="col s12 m12 l12">
          <ul class="custom-breadcrumb">
            <li><a href="#">Master</a></li>
            <li><a href="#">Siswa</a></li>
            <li><a href="#">Tambah</a></li>
            <li>Data Kesehatan</li>
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
        <form class="col s12 m12 l12" action="{{ route('siswa_store_health') }}" method="post" autocomplete="off">
          {!! csrf_field() !!}
          <input type="hidden" name="id_siswa" value="{{ session('id_siswa')}}">
          <div class="row">
            <div class="row">
              <div class="input-field col s12 m12 l12">
                <input id="goldar" name="goldar" type="text" class="validate">
                <label for="goldar">Golongan Darah</label>
              </div>
            </div>
            <div class="row">
              <div class="input-field col s12 m12 l12">
                <input id="penyakit" name="penyakit" type="text" class="validate">
                <label for="penyakit">Penyakit Yang Pernah Diderita</label>
              </div>
            </div>
            <div class="row">
              <div class="input-field col s12 m12 l12">
                <input id="kelainan" name="kelainan" type="text" class="validate">
                <label for="kelainan">Kelainan Jasmani</label>
              </div>
            </div>
            <div class="row">
              <div class="input-field col s12 m6 l6">
                <input id="tinggi" name="tinggi" type="text" class="validate">
                <label for="tinggi">Tiggi Badan (CM)</label>
              </div>
              <div class="input-field col s12 m6 l6">
                <input id="berat" name="berat" type="text" class="validate">
                <label for="berat">Berat Badan (KG)</label>
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

@section('asset_footer')
  <script>
  $(document).ready(function() {
    $('#berat').mask('00000');
    $('#tinggi').mask('00000');
  });
  </script>
@endsection
