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
            <li>Data Kelulusan</li>
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
        <form class="col s12 m12 l12" action="{{ route('siswa_update_graduation') }}" method="post" autocomplete="off">
          {!! csrf_field() !!}
          <input type="hidden" name="id_siswa" value="{{ $data->id }}">
          <div class="row">
            <div class="col s12">
              <ul class="tabs tabs-fixed-width">
                <li class="tab col s6"><a class="active" href="#kelulusan">Kelulusan</a></li>
                <li class="tab col s6"><a href="#kepindahan">Kepindahan</a></li>
              </ul>
            </div>
            <div id="kelulusan" class="col s12 m12 l12">
              <div class="row">
                <div class="input-field col s12 m6 l6">
                  <input id="tgl_ijazah_lulus" name="tgl_ijazah_lulus" type="text" class="datepicker" @if ($data->tgl_ijazah_lulus != null)
                    value="{{ \Carbon\Carbon::createFromFormat('Y-m-d', $data->tgl_ijazah_lulus)->format('d/m/Y') }}" @endif>
                  <label for="tgl_ijazah_lulus">Tanggal Ijazah</label>
                </div>
                <div class="input-field col s12 m6 l6">
                  <input id="no_ijazah_lulus" name="no_ijazah_lulus" type="text" class="validate" value="{{ $data->no_ijazah_lulus }}">
                  <label for="no_ijazah_lulus">No. Ijazah</label>
                </div>
              </div>
              <div class="row">
                <div class="input-field col s12 m6 l6">
                  <input id="tgl_skhun_lulus" name="tgl_skhun_lulus" type="text" class="datepicker" @if ($data->tgl_skhun_lulus != null)
                    value="{{ \Carbon\Carbon::createFromFormat('Y-m-d', $data->tgl_skhun_lulus)->format('d/m/Y') }}" @endif>
                  <label for="tgl_skhun_lulus">Tanggal SKHUN</label>
                </div>
                <div class="input-field col s12 m6 l6">
                  <input id="no_skhun_lulus" name="no_skhun_lulus" type="text" class="validate" value="{{ $data->no_skhun_lulus }}">
                  <label for="no_skhun_lulus">No. SKHUN</label>
                </div>
              </div>
              <div class="row">
                <div class="input-field col s12 m12 l12">
                  <input id="lanjut_di" name="lanjut_di" type="text" class="validate" value="{{ $data->lanjut_di }}">
                  <label for="lanjut_di">Nama Universitas (Jika Lanjut Kuliah)</label>
                </div>
              </div>
              <div class="row">
                <div class="input-field col s12 m6 l6">
                  <input id="perusahaan" name="perusahaan" type="text" class="validate" value="{{ $data->perusahaan }}">
                  <label for="perusahaan">Nama Perusahaan</label>
                </div>
                <div class="input-field col s12 m6 l6">
                  <input id="tgl_mulai_kerja" name="tgl_mulai_kerja" type="text" class="datepicker" @if ($data->tgl_mulai_kerja != null)
                    value="{{ \Carbon\Carbon::createFromFormat('Y-m-d', $data->tgl_mulai_kerja)->format('d/m/Y') }}" @endif>
                  <label for="tgl_skhun_lulus">Tanggal Mulai Kerja</label>
                </div>
              </div>
              <div class="row">
                <div class="input-field col s12 m12 l12">
                  <input id="th_lulus" name="th_lulus" type="text" class="validate" value="{{ $data->th_lulus }}">
                  <label for="th_lulus">Tahun Kelulusan</label>
                </div>
              </div>
            </div>
            <div id="kepindahan" class="col s12">
              <div class="row">
                <div class="input-field col s12 m6 l6">
                  <input id="sekolah_pindah" name="sekolah_pindah" type="text" class="validate" value="{{ $data->sekolah_pindah }}">
                  <label for="sekolah_pindah">Sekolah Tujuan</label>
                </div>
                <div class="input-field col s12 m6 l6">
                  <input id="tgl_pindah_sekolah" name="tgl_pindah_sekolah" type="text" class="datepicker" @if ($data->tgl_pindah_sekolah != null)
                    value="{{ \Carbon\Carbon::createFromFormat('Y-m-d', $data->tgl_pindah_sekolah)->format('d/m/Y') }}" @endif>
                  <label for="tgl_pindah_sekolah">Tanggal Pindah Sekolah</label>
                </div>
              </div>
              <div class="row">
                <div class="input-field col s12 m12 l12">
                  <textarea id="alasan_pindah" name="alasan_pindah" class="validate materialize-textarea">{{ $data->alasan_pindah }}</textarea>
                  <label for="alasan_pindah">Alasan Kepindahan</label>
                </div>
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
    $('#th_lulus').mask('0000');
  });
  </script>
@endsection
