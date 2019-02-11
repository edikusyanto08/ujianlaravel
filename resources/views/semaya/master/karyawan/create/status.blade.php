@extends('semaya.layouts.app')

@section('content')

<!-- Start breadcrumb content -->
    <div class="card-panel">
      <div class="row mar-bot">
        <div class="col s12 m12 l12">
          <h4 class="page-title">Tambah Karyawan</h4>
        </div>
      </div>
      <div class="row mar-bot">
        <div class="col s12 m12 l12">
          <ul class="custom-breadcrumb">
            <li><a href="#">Master</a></li>
            <li><a href="#">Karyawan</a></li>
            <li><a href="#">Tambah</a></li>
            <li>Status Karyawan</li>
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
        <form class="col s12 m12 l12" action="{{ route('karyawan_store_status') }}" method="post" autocomplete="off">
          {!! csrf_field() !!}
          <input type="hidden" name="id_karyawan" value="{{ session('id_karyawan') }}">
          <div class="row">
            <div class="input-field col s12 m12 l12">
              <select class="select2" style="width: 100%;" name="status_karyawan" id="status_karyawan">
                <option selected disabled>Status Karyawan *</option>
                <option value="Tetap">Tetap</option>
                <option value="Tidak Tetap">Tidak Tetap</option>
              </select>
            </div>
          </div>
          <div class="row">
            <div class="input-field col s12 m12 l12">
              <input id="tmt_karyawan" name="tmt_karyawan" type="text" class="datepicker">
              <label for="tmt_karyawan">TMT Karyawan *</label>
            </div>
          </div>
          <div class="row">
            <div class="input-field col s12 m12 l12">
              <input id="no_sk_pengangkatan" name="no_sk_pengangkatan" type="text" class="validate">
              <label for="no_sk_pengangkatan">No. SK Pengangkatan Karyawan</label>
            </div>
          </div>
          <div class="row">
            <div class="input-field col s12 m12 l12">
              <select class="select2" style="width: 100%;" name="jabatan_karyawan" id="jabatan_karyawan">
                <option selected disabled>Jabatan *</option>
                <option value="Ka. TU">Kepala Tata Usaha (Ka. TU)</option>
                <option value="Lainnya">Lainnya</option>
              </select>
            </div>
          </div>
          <div class="row" id="jabatan_lainnya">
            <div class="input-field col s12 m12 l12">
              <input id="jabatan_lainnya" name="jabatan_lainnya" type="text" class="validate">
              <label for="jabatan_lainnya">Jabatan *</label>
            </div>
          </div>
          <div class="row">
            <div class="input-field col s12 m12 l12">
              <button type="submit" class="waves-effect waves-light btn indigo">Tambah</button>
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
  $(function() {
    $('#jabatan_lainnya').hide();

    $('#jabatan_karyawan').change(function() {
      var jabatan = $('#jabatan_karyawan').val();
      if (jabatan == "Lainnya") {
        $("#jabatan_lainnya").show();
      } else {
        $("#jabatan_lainnya").hide();
      }
    });
  });
</script>
@endsection
