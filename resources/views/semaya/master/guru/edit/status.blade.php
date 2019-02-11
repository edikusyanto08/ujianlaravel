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
            <li>Data Status Guru</li>
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
        <form class="col s12 m12 l12" action="{{ route('guru_update_status') }}" method="post" autocomplete="off">
          {!! csrf_field() !!}
          <input type="hidden" name="id_guru" value="{{ $data->id }}">
          <div class="row">
            <div class="input-field col s12 m12 l12">
              <select class="select2" style="width: 100%;" name="status_guru" id="status_guru">
                <option selected disabled>Status Guru</option>
                <option value="1" @if ($data->status_guru == 1) selected @endif>Tetap</option>
                <option value="0" @if ($data->status_guru == 0) selected @endif>Tidak Tetap</option>
              </select>
            </div>
          </div>
          <div class="row" id="tetap">
            <div class="input-field col s12 m12 l12">
              <input id="tmt_guru_tetap" name="tmt_guru_tetap" type="text" class="datepicker" @if ($data->tmt_guru_tetap != null)
                value="{{ \Carbon\Carbon::createFromFormat('Y-m-d', $data->tmt_guru_tetap)->format('d/m/Y') }}" @endif>
              <label for="tmt_guru_tetap">TMT Guru Tetap</label>
            </div>
          </div>
          <div class="row" id="tidak_tetap">
            <div class="input-field col s12 m12 l12">
              <input id="tmt_guru_tidak_tetap" name="tmt_guru_tidak_tetap" type="text" class="datepicker" @if ($data->tmt_guru_tidak_tetap)
                value="{{ \Carbon\Carbon::createFromFormat('Y-m-d', $data->tmt_guru_tidak_tetap)->format('d/m/Y') }}" @endif>
              <label for="tmt_guru_tidak_tetap">TMT Guru Tidak Tetap</label>
            </div>
          </div>
          <div class="row">
            <div class="input-field col s12 m12 l12">
              <input id="jenis_guru" name="jenis_guru" type="text" class="validate" value="{{ $data->jenis_guru }}">
              <label for="jenis_guru">Jenis Guru</label>
            </div>
          </div>
          <div class="row">
            <div class="input-field col s12 m12 l12">
              <select class="select2" style="width: 100%;" name="tugas_tambahan" id="tugas_tambahan">
                <option selected disabled>Tugas Tambahan</option>
                <option value="Kepala Sekolah" @if ($data->tugas_tambahan == "Kepala Sekolah") selected @endif>Kepala Sekolah</option>
                <option value="Wali Kelas" @if ($data->tugas_tambahan == "Wali Kelas") selected @endif>Wali Kelas</option>
                <option value="Tidak Ada" @if ($data->tugas_tambahan == "Tidak Ada") selected @endif>Tidak Ada</option>
                <option value="Lainnya" @if ($data->tugas_tambahan != "Kepala Sekolah" AND $data->tugas_tambahan != "Wali Kelas" AND $data->tugas_tambahan != "Tidak Ada") selected @endif>Lainnya</option>
              </select>
            </div>
          </div>
          <div class="row" id="tugas_lainnya">
            <div class="input-field col s12 m12 l12">
              <input id="tugas_lainnya" name="tugas_lainnya" type="text" class="validate" @if ($data->tugas_tambahan != "Kepala Sekolah" AND $data->tugas_tambahan != "Wali Kelas" AND $data->tugas_tambahan != "Tidak Ada") value="{{ $data->tugas_tambahan }}" @endif>
              <label for="tugas_lainnya">Tugas Tambahan</label>
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
      @if($data->status_guru == 1)
        $("#tetap").show();
        $("#tidak_tetap").hide();
      @else
        $("#tetap").hide();
        $("#tidak_tetap").show();
      @endif
      $("#tugas_lainnya").hide();

      @if ($data->tugas_tambahan != "Kepala Sekolah" && $data->tugas_tambahan != "Wali Kelas" && $data->tugas_tambahan != "Tidak Ada")
        $("#tugas_lainnya").show();
      @endif

      $('#status_guru').change(function() {
        var status = $('#status_guru').val();
        if (status == "Tetap") {
          $("#tetap").show();
          $("#tidak_tetap").hide();
        } else {
          $("#tetap").hide();
          $("#tidak_tetap").show();
        }
      });

      $('#tugas_tambahan').change(function() {
        var tugas = $('#tugas_tambahan').val();
        if (tugas == "Lainnya") {
          $("#tugas_lainnya").show();
        } else {
          $("#tugas_lainnya").hide();
        }
      });
    })
  </script>
@endsection
