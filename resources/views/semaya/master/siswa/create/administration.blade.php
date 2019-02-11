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
            <li>Data Administrasi</li>
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
        <form class="col s12 m12 l12" action="{{ route('siswa_store_admin') }}" method="post" autocomplete="off">
          {!! csrf_field() !!}
          <input type="hidden" name="id_siswa" value="{{ session('id_siswa')}}">
          <div class="row">
            <div class="input-field col s12 m12 l12">
              <input id="lulusan_dari" name="lulusan_dari" type="text" class="validate">
              <label for="lulusan_dari">Lulusan Dari</label>
            </div>
          </div>
          <div class="row">
            <div class="input-field col s12 m6 l6">
              <input id="tgl_ijazah" name="tgl_ijazah" type="text" class="datepicker">
              <label for="tgl_ijazah">Tanggal Ijazah</label>
            </div>
            <div class="input-field col s12 m6 l6">
              <input id="no_ijazah" name="no_ijazah" type="text" class="validate">
              <label for="no_ijazah">No. Ijazah</label>
            </div>
          </div>
          <div class="row">
            <div class="input-field col s12 m6 l6">
              <input id="tgl_skhun" name="tgl_skhun" type="text" class="datepicker">
              <label for="tgl_skhun">Tanggal SKHUN</label>
            </div>
            <div class="input-field col s12 m6 l6">
              <input id="no_skhun" name="no_skhun" type="text" class="validate">
              <label for="no_skhun">No. SKHUN</label>
            </div>
          </div>
          <div class="row">
            <div class="input-field col s12 m12 l12">
              <input id="dari_sekolah" name="dari_sekolah" type="text" class="validate">
              <label for="dari_sekolah">Pindahan Dari Sekolah Lain</label>
            </div>
          </div>
          <div class="row">
            <div class="input-field col s12 m12 l12">
              <textarea id="alasan_pindah" name="alasan_pindah" class="validate materialize-textarea"></textarea>
              <label for="alasan_pindah">Alasan Kepindahan</label>
            </div>
          </div>
          <div class="row">
            <div class="input-field col s12 m6 l6">
              <select class="select2" style="width: 100%;" name="jurusan_id" id="jurusan">
                <option disabled selected>Jurusan *</option>
                @foreach ($jurusan as $value)
                  <option value="{{ $value->id }}">{{ $value->singkatan_jurusan }}</option>
                @endforeach
              </select>
            </div>
            <div class="input-field col s12 m6 l6">
              <select class="select2" style="width: 100%;" name="kelas_id" id="kelas">
                <option disabled selected>Kelas *</option>
              </select>
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
      $("#jurusan").change(function() {
        var jurusanid = $("#jurusan").val();

        $.ajax({
          method: "GET",
          url: "{{ url("ajax") }}" + "/" + jurusanid + "/kelas",
          data: {},
          dataType: 'json',
          success: function(json) {
            $('#kelas').empty();
            $('#kelas').append($('<option value="" selected disabled>Kelas</option>'));
            $.each(json, function(i, value) {
              $('#kelas').append($('<option>').text(value.nama_kelas).attr('value', value.id));
            });
          }, error: function(e) {
            console.log('ajax error');
          }
        });
      });
    });
  </script>
@endsection
