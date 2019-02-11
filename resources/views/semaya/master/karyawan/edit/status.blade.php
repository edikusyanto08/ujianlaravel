@extends('semaya.layouts.app')

@section('content')

<!-- Start breadcrumb content -->
    <div class="card-panel">
      <div class="row mar-bot">
        <div class="col s12 m12 l12">
          <h4 class="page-title">Ubah Karyawan</h4>
        </div>
      </div>
      <div class="row mar-bot">
        <div class="col s12 m8 l8">
          <ul class="custom-breadcrumb">
            <li><a href="#">Master</a></li>
            <li><a href="#">Karyawan</a></li>
            <li><a href="#">Ubah</a></li>
            <li>Status Karyawan</li>
          </ul>
        </div>
        <div class="col s12 m4 l4">
          <a href="{{ route('karyawan_edit', ['id' => $data->id]) }}" class="btn btn-plus indigo tooltipped" data-position="top" data-delay="50" data-tooltip="Data Pribadi Karyawan"><i class="material-icons">person</i></a>
          <a href="{{ route('karyawan_edit_education', ['id' => $data->id]) }}" class="btn btn-plus indigo tooltipped" data-position="top" data-delay="50" data-tooltip="Data Pendidikan dan Kepegawaian Karyawan"><i class="material-icons">school</i></a>
          <a href="{{ route('karyawan_edit_status', ['id' => $data->id]) }}" class="btn btn-plus indigo tooltipped" data-position="top" data-delay="50" data-tooltip="Data Status Karyawan"><i class="material-icons">verified_user</i></a>
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
    @if (session('message'))
      <div class="card-panel green white-text">
        {{ session('message') }}
      </div>
    @endif
    <div class="card-panel">
      <div class="row">
        <form class="col s12 m12 l12" action="{{ route('karyawan_update_status') }}" method="post" autocomplete="off">
          {!! csrf_field() !!}
          <input type="hidden" name="id_karyawan" value="{{ $data->id }}">
          <div class="row">
            <div class="input-field col s12 m12 l12">
              <select class="select2" style="width: 100%;" name="status_karyawan" id="status_karyawan">
                <option selected disabled>Status Karyawan</option>
                <option value="Tetap" @if ($data->status_karyawan == "Tetap") selected @endif>Tetap</option>
                <option value="Tidak Tetap" @if ($data->status_karyawan == "Tidak Tetap") selected @endif>Tidak Tetap</option>
              </select>
            </div>
          </div>
          <div class="row">
            <div class="input-field col s12 m12 l12">
              <input id="tmt_karyawan" name="tmt_karyawan" type="text" class="datepicker" @if ($data->tmt_karyawan != null)
                value="{{ \Carbon\Carbon::createFromFormat('Y-m-d', $data->tmt_karyawan)->format('d/m/Y') }}" @endif>
              <label for="tmt_karyawan">TMT Karyawan</label>
            </div>
          </div>
          <div class="row">
            <div class="input-field col s12 m12 l12">
              <input id="no_sk_pengangkatan" name="no_sk_pengangkatan" type="text" class="validate" value="{{ $data->no_sk_pengangkatan }}">
              <label for="no_sk_pengangkatan">No. SK Pengangkatan Karyawan</label>
            </div>
          </div>
          <div class="row">
            <div class="input-field col s12 m12 l12">
              <select class="select2" style="width: 100%;" name="jabatan_karyawan" id="jabatan_karyawan">
                <option selected disabled>Jabatan *</option>
                <option value="Ka. TU" @if ($data->jabatan_karyawan == "Ka. TU") selected @endif>Kepala Tata Usaha (Ka. TU)</option>
                <option value="Lainnya" @if ($data->jabatan_karyawan != "Ka. TU") selected @endif>Lainnya</option>
              </select>
            </div>
          </div>
          <div class="row" id="jabatan_lainnya">
            <div class="input-field col s12 m12 l12">
              <input id="jabatan_lainnya" name="jabatan_lainnya" type="text" class="validate" @if ($data->jabatan_karyawan != "Ka. TU") value="{{ $data->jabatan_karyawan }}" @endif>
              <label for="jabatan_lainnya">Jabatan *</label>
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
  $(function() {
    @if ($data->jabatan_karyawan != "Ka. TU")
      $('#jabatan_lainnya').show();
    @else
      $('#jabatan_lainnya').hide();
    @endif

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
