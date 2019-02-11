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
            <li>Data Pendidikan dan Kepegawaian</li>
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
        <form class="col s12 m12 l12" action="{{ route('guru_update_education') }}" method="post" autocomplete="off">
          {!! csrf_field() !!}
          <input type="hidden" name="id_guru" value="{{ $data->id }}">
          <div class="row">
            <div class="row">
              <div class="input-field col s12 m6 l6">
                <input id="pend_akhir" name="pend_akhir" type="text" class="validate" value="{{ $data->pend_akhir }}">
                <label for="pend_akhir">Pendidikan Terakhir</label>
              </div>
              <div class="input-field col s12 m6 l6">
                <input id="tgl_lulus_pend_akhir" name="tgl_lulus_pend_akhir" type="text" class="datepicker" @if ($data->tgl_lulus_pend_akhir != null)
                  value="{{ \Carbon\Carbon::createFromFormat('Y-m-d', $data->tgl_lulus_pend_akhir)->format('d/m/Y') }}" @endif>
                <label for="tgl_lulus_pend_akhir">Tanggal Lulus Pendidikan Terakhir</label>
              </div>
            </div>
            <div class="row">
              <div class="input-field col s12 m6 l6">
                <input id="jurusan_pend_akhir" name="jurusan_pend_akhir" type="text" class="validate" value="{{ $data->jurusan_pend_akhir }}">
                <label for="jurusan_pend_akhir">Jurusan Pendidikan Terakhir</label>
              </div>
              <div class="input-field col s12 m6 l6">
                <input id="lembaga_pend_akhir" name="lembaga_pend_akhir" type="text" class="validate" value="{{ $data->lembaga_pend_akhir }}">
                <label for="lembaga_pend_akhir">Lembaga Pendidikan Terakhir</label>
              </div>
            </div>
            <div class="row">
              <div class="input-field col s12 m6 l6">
                <input id="tmt_cpns" name="tmt_cpns" type="text" class="datepicker" @if ($data->tmt_cpns != null)
                  value="{{ \Carbon\Carbon::createFromFormat('Y-m-d', $data->tmt_cpns)->format('d/m/Y') }}" @endif>
                <label for="tmt_cpns">TMT CPNS</label>
              </div>
              <div class="input-field col s12 m6 l6">
                <input id="tmt_pns" name="tmt_pns" type="text" class="datepicker" @if ($data->tmt_pns != null)
                  value="{{ \Carbon\Carbon::createFromFormat('Y-m-d', $data->tmt_pns)->format('d/m/Y') }}" @endif>
                <label for="tmt_pns">TMT PNS</label>
              </div>
            </div>
            <div class="row">
              <div class="input-field col s12 m6 l6">
                <input id="tmt_inpassing_nonpns" name="tmt_inpassing_nonpns" type="text" class="datepicker" @if ($data->tmt_inpassing_nonpns != null)
                  value="{{ \Carbon\Carbon::createFromFormat('Y-m-d', $data->tmt_inpassing_nonpns)->format('d/m/Y') }}" @endif>
                <label for="tmt_inpassing_nonpns">TMT Inpassing Guru Non PNS</label>
              </div>
              <div class="input-field col s12 m6 l6">
                <input id="no_sk_inpassing_nonpns" name="no_sk_inpassing_nonpns" type="text" class="validate" value="{{ $data->no_sk_inpassing_nonpns }}">
                <label for="no_sk_inpassing_nonpns">No. SK Inpassing Guru Non PNS</label>
              </div>
            </div>
            <div class="row">
              <div class="input-field col s12 m12 l12">
                <input id="status_kepegawaian" name="status_kepegawaian" type="text" class="validate" value="{{ $data->status_kepegawaian }}">
                <label for="status_kepegawaian">Status Kepegawaian</label>
              </div>
            </div>
            <div class="row">
              <div class="input-field col s12 m6 l6">
                <input id="golongan" name="golongan" type="text" class="validate" value="{{ $data->golongan }}">
                <label for="golongan">Golongan</label>
              </div>
              <div class="input-field col s12 m6 l6">
                <input id="tmt_golongan" name="tmt_golongan" type="text" class="datepicker" @if ($data->tmt_golongan != null)
                  value="{{ \Carbon\Carbon::createFromFormat('Y-m-d', $data->tmt_golongan)->format('d/m/Y') }}" @endif>
                <label for="tmt_golongan">TMT Golongan</label>
              </div>
            </div>
            <div class="row">
              <div class="input-field col s12 m2 l2">
                <input id="masa_kerja_th" name="masa_kerja_th" type="text" class="validate" value="{{ $data->masa_kerja_th }}">
                <label for="masa_kerja_th">Masa Kerja (Tahun)</label>
              </div>
              <div class="input-field col s12 m2 l2">
                <input id="masa_kerja_bln" name="masa_kerja_bln" type="text" class="validate" value="{{ $data->masa_kerja_bln }}">
                <label for="masa_kerja_bln">Masa Kerja (Bulan)</label>
              </div>
              <div class="input-field col s12 m8 l8">
                <input id="gaji_pokok" name="gaji_pokok" type="text" class="validate" value="{{ $data->gaji_pokok }}">
                <label for="gaji_pokok">Gaji Pokok</label>
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
    $(function() {
      $('#gaji_pokok').mask("#.##0", {reverse: true});
      $('#masa_kerja_bln').mask("0000");
      $('#masa_kerja_th').mask("0000");
    });
  </script>
@endsection
