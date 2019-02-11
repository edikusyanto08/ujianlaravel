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
            <li>Data Pendidikan dan Kepegawaian</li>
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
        <form class="col s12 m12 l12" action="{{ route('karyawan_store_education') }}" method="post" autocomplete="off">
          {!! csrf_field() !!}
          <input type="hidden" name="id_karyawan" value="{{ session('id_karyawan')}}">
          <div class="row">
            <div class="row">
              <div class="input-field col s12 m6 l6">
                <input id="pend_akhir" name="pend_akhir" type="text" class="validate">
                <label for="pend_akhir">Pendidikan Terakhir</label>
              </div>
              <div class="input-field col s12 m6 l6">
                <input id="tgl_lulus_pend_akhir" name="tgl_lulus_pend_akhir" type="text" class="datepicker">
                <label for="tgl_lulus_pend_akhir">Tanggal Lulus Pendidikan Terakhir</label>
              </div>
            </div>
            <div class="row">
              <div class="input-field col s12 m6 l6">
                <input id="jurusan_pend_akhir" name="jurusan_pend_akhir" type="text" class="validate">
                <label for="jurusan_pend_akhir">Jurusan Pendidikan Terakhir</label>
              </div>
              <div class="input-field col s12 m6 l6">
                <input id="lembaga_pend_akhir" name="lembaga_pend_akhir" type="text" class="validate">
                <label for="lembaga_pend_akhir">Lembaga Pendidikan Terakhir</label>
              </div>
            </div>
            <div class="row">
              <div class="input-field col s12 m6 l6">
                <input id="tmt_cpns" name="tmt_cpns" type="text" class="datepicker">
                <label for="tmt_cpns">TMT CPNS</label>
              </div>
              <div class="input-field col s12 m6 l6">
                <input id="no_sk_cpns" name="no_sk_cpns" type="text" class="validate">
                <label for="no_sk_cpns">No. SK CPNS</label>
              </div>
            </div>
            <div class="row">
              <div class="input-field col s12 m6 l6">
                <input id="tmt_pns" name="tmt_pns" type="text" class="datepicker">
                <label for="tmt_pns">TMT PNS</label>
              </div>
              <div class="input-field col s12 m6 l6">
                <input id="no_sk_pns" name="no_sk_pns" type="text" class="validate">
                <label for="no_sk_pns">No. SK PNS</label>
              </div>
            </div>
            <div class="row">
              <div class="input-field col s12 m12 l12">
                <input id="status_kepegawaian" name="status_kepegawaian" type="text" class="validate">
                <label for="status_kepegawaian">Status Kepegawaian</label>
              </div>
            </div>
            <div class="row">
              <div class="input-field col s12 m6 l6">
                <input id="golongan" name="golongan" type="text" class="validate">
                <label for="golongan">Golongan</label>
              </div>
              <div class="input-field col s12 m6 l6">
                <input id="tmt_golongan" name="tmt_golongan" type="text" class="datepicker">
                <label for="tmt_golongan">TMT Golongan</label>
              </div>
            </div>
            <div class="row">
              <div class="input-field col s12 m12 l12">
                <input id="no_sk_golongan_akhir" name="no_sk_golongan_akhir" type="text" class="validate">
                <label for="no_sk_golongan_akhir">No. SK Golongan Terakhir</label>
              </div>
            </div>
            <div class="row">
              <div class="input-field col s12 m2 l2">
                <input id="masa_kerja_th" name="masa_kerja_th" type="text" class="validate">
                <label for="masa_kerja_th">Masa Kerja (Tahun)</label>
              </div>
              <div class="input-field col s12 m2 l2">
                <input id="masa_kerja_bln" name="masa_kerja_bln" type="text" class="validate">
                <label for="masa_kerja_bln">Masa Kerja (Bulan)</label>
              </div>
              <div class="input-field col s12 m8 l8">
                <input id="gaji_pokok" name="gaji_pokok" type="text" class="validate">
                <label for="gaji_pokok">Gaji Pokok</label>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="input-field col s12 m12 l12">
              <button type="submit" class="waves-effect waves-light btn indigo">Selanjutnya</button>
            </div>
          </div>
        </form>
      </div>{{-- End Row --}}
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
