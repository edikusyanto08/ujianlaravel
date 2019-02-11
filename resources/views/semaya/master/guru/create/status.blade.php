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
            <li>Status Guru</li>
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
        <form class="col s12 m12 l12" action="{{ route('guru_store_status') }}" method="post" autocomplete="off">
          {!! csrf_field() !!}
          <input type="hidden" name="id_guru" value="{{ session('id_guru') }}">
          <div class="row">
            <div class="input-field col s12 m12 l12">
              <select class="select2" style="width: 100%;" name="status_guru" id="status_guru">
                <option selected disabled>Status Guru</option>
                <option value="Tetap">Tetap</option>
                <option value="Tidak Tetap">Tidak Tetap</option>
              </select>
            </div>
          </div>
          <div class="row" id="tetap">
            <div class="input-field col s12 m12 l12">
              <input id="tmt_guru_tetap" name="tmt_guru_tetap" type="text" class="datepicker">
              <label for="tmt_guru_tetap">TMT Guru Tetap</label>
            </div>
          </div>
          <div class="row" id="tidak_tetap">
            <div class="input-field col s12 m12 l12">
              <input id="tmt_guru_tidak_tetap" name="tmt_guru_tidak_tetap" type="text" class="datepicker">
              <label for="tmt_guru_tidak_tetap">TMT Guru Tidak Tetap</label>
            </div>
          </div>
          <div class="row">
            <div class="input-field col s12 m12 l12">
              <input id="jenis_guru" name="jenis_guru" type="text" class="validate">
              <label for="jenis_guru">Jenis Guru</label>
            </div>
          </div>
          <div class="row">
            <div class="input-field col s12 m12 l12">
              <select class="select2" style="width: 100%;" name="tugas_tambahan" id="tugas_tambahan">
                <option selected disabled>Tugas Tambahan</option>
                <option value="Kepala Sekolah">Kepala Sekolah</option>
                <option value="Wali Kelas">Wali Kelas</option>
                <option value="Tidak Ada">Tidak Ada</option>
                <option value="Lainnya">Lainnya</option>
              </select>
            </div>
          </div>
          <div class="row" id="tugas_lainnya">
            <div class="input-field col s12 m12 l12">
              <input id="tugas_lainnya" name="tugas_lainnya" type="text" class="validate">
              <label for="tugas_lainnya">Tugas Tambahan</label>
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
      $("#tetap").hide();
      $("#tidak_tetap").hide();
      $("#tugas_lainnya").hide();

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
