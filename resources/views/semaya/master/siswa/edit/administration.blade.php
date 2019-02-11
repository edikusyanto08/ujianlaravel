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
            <li>Data Administrasi</li>
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
        <form class="col s12 m12 l12" action="{{ route('siswa_update_admin') }}" method="post" autocomplete="off">
          {!! csrf_field() !!}
          <input type="hidden" name="id_siswa" value="{{ $data->id }}">
          <div class="row">
            <div class="input-field col s12 m12 l12">
              <input id="lulusan_dari" name="lulusan_dari" type="text" class="validate" value="{{ $data->tamat_dari }}">
              <label for="lulusan_dari">Lulusan Dari</label>
            </div>
          </div>
          <div class="row">
            <div class="input-field col s12 m6 l6">
              <input id="tgl_ijazah" name="tgl_ijazah" type="text" class="datepicker" @if ($data->tgl_ijazah != null)
                value="{{ \Carbon\Carbon::createFromFormat('Y-m-d', $data->tgl_ijazah)->format('d/m/Y') }}" @endif>
              <label for="tgl_ijazah">Tanggal Ijazah</label>
            </div>
            <div class="input-field col s12 m6 l6">
              <input id="no_ijazah" name="no_ijazah" type="text" class="validate" value="{{ $data->no_ijazah }}">
              <label for="no_ijazah">No. Ijazah</label>
            </div>
          </div>
          <div class="row">
            <div class="input-field col s12 m6 l6">
              <input id="tgl_skhun" name="tgl_skhun" type="text" class="datepicker" @if ($data->tgl_skhun != null)
                value="{{ \Carbon\Carbon::createFromFormat('Y-m-d', $data->tgl_skhun)->format('d/m/Y') }}" @endif>
              <label for="tgl_skhun">Tanggal SKHUN</label>
            </div>
            <div class="input-field col s12 m6 l6">
              <input id="no_skhun" name="no_skhun" type="text" class="validate" value="{{ $data->no_skhun }}">
              <label for="no_skhun">No. SKHUN</label>
            </div>
          </div>
          <div class="row">
            <div class="input-field col s12 m12 l12">
              <input id="dari_sekolah" name="dari_sekolah" type="text" class="validate" value="{{ $data->dari_sekolah }}">
              <label for="dari_sekolah">Pindahan Dari Sekolah Lain</label>
            </div>
          </div>
          <div class="row">
            <div class="input-field col s12 m12 l12">
              <textarea id="alasan_pindah" name="alasan_pindah" class="validate materialize-textarea">{{ $data->alasan }}</textarea>
              <label for="alasan_pindah">Alasan Kepindahan</label>
            </div>
          </div>
          <div class="row">
            <div class="input-field col s12 m6 l6">
              <select class="select2" style="width: 100%;" name="jurusan_id" id="jurusan">
                <option disabled selected>Jurusan</option>
                @foreach ($jurusan as $value)
                  <option value="{{ $value->id }}" @if ($value->id == $data->kelas_siswa->kelas->jurusan->id) selected @endif>{{ $value->singkatan_jurusan }}</option>
                @endforeach
              </select>
            </div>
            <div class="input-field col s12 m6 l6">
              <select class="select2" style="width: 100%;" name="kelas_id" id="kelas">
                <option disabled selected>Kelas</option>
                @foreach ($kelas as $value)
                  <option value="{{ $value->id }}" @if ($value->id == $data->kelas_siswa->kelas->id) selected @endif>{{ $value->nama_kelas   }}</option>
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
        }, error: function() {
          console.log('ajax error');
        }
      });
    });
  });
  </script>
@endsection
