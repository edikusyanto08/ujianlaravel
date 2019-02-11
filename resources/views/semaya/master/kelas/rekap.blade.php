@extends('semaya.layouts.app')

@section('content')

<div id="modal-export" class="modal">
    <form action="{{ route('kelas_rekap_export') }}" method="get" autocomplete="off" class="no-loader">
      <div class="modal-content">
        <div class="row">
          <div class="col s12 m12 l12 mar-bot">
            <h4 class="mar-bot">Ekspor Data Rekapitulasi</h4>
          </div>
        </div>
        <div class="row">
          <div class="input-field col s12 m12 l12">
            <div class="label-block">Pilih format</div>
            <select class="select2" name="format">
              <option value="xls">.xls</option>
              <option value="pdf">.pdf</option>
            </select>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <a href="javascript:void(0)" class="modal-action modal-close waves-effect waves-indigo btn-flat">Tutup</a>
        <button type="submit" class="waves-effect waves-indigo btn-flat">Ekspor</button>
      </div>
    </form>
  </div>
<!-- Start breadcrumb content -->
    <div class="card-panel">
      <div class="row mar-bot">
        <div class="col s12 m12 l12">
          <h4 class="page-title">Rekapitulasi Kelas</h4>
        </div>
      </div>
      <div class="row mar-bot">
        <div class="col s12 m6 l6">
          <ul class="custom-breadcrumb">
            <li><a href="#">Master</a></li>
            <li><a href="#">Kelas</a></li>
            <li>Rekapitulasi</li>
          </ul>
        </div>
        <div class="col s12 m6 l6">
          <div class="right">
            <a href="#modal-export" class="btn indigo tooltipped modal-trigger" data-position="top" data-delay="50" data-tooltip="Ekspor Rekapitulasi Kelas"><i class="material-icons">cloud_upload</i></a>
          </div>
        </div>
      </div>
    </div>
<!-- End breadcrumb content -->

<!-- Start content of page -->
<div class="row">
  <div class="col s12 m12 l12 child-content">
    <div class="card-panel">
      <div class="row">
        <table class="striped">
          <thead>
            <tr>
              <th>No</th>
              <th>Kelas</th>
              <th>L</th>
              <th>P</th>
              <th>JML</th>
            </tr>
          </thead>
          <tbody>
            @foreach($tingkat as $value)
              @php
              $no = 1;
              $tingkat_siswa_total = 0;
              $tingkat_siswa_l = 0;
              $tingkat_siswa_p = 0;
              $kelas = App\Kelas::where('tingkat_id', $value->id)->orderBy('nama_kelas')->get();
              @endphp
              @foreach($kelas as $kelas_value)
                @php
                $siswa = App\KelasSiswa::join('siswa','kelas_siswa.siswa_id','=','siswa.id')->where('kelas_id', $kelas_value->id)->count();
                $siswa_l = App\KelasSiswa::join('siswa','kelas_siswa.siswa_id','=','siswa.id')->where('kelas_id', $kelas_value->id)->where('kelamin', 'L')->count();
                $siswa_p = App\KelasSiswa::join('siswa','kelas_siswa.siswa_id','=','siswa.id')->where('kelas_id', $kelas_value->id)->where('kelamin', 'P')->count();

                $total_siswa_perkelas = $siswa;
                $tingkat_siswa_total += $total_siswa_perkelas;
                $total_siswa += $total_siswa_perkelas;

                $total_siswa_perkelas_l = $siswa_l;
                $tingkat_siswa_l += $total_siswa_perkelas_l;
                $total_siswa_l += $total_siswa_perkelas_l;

                $total_siswa_perkelas_p = $siswa_p;
                $tingkat_siswa_p += $total_siswa_perkelas_p;
                $total_siswa_p += $total_siswa_perkelas_p;
                @endphp
                <tr>
                  <td>{{ $no++ }}.</td>
                  <td>{{ $kelas_value->nama_kelas }}</td>
                  <td>{{ $total_siswa_perkelas_l }}</td>
                  <td>{{ $total_siswa_perkelas_p }}</td>
                  <td>{{ $total_siswa_perkelas }}</td>
                </tr>
              @endforeach
            <tr>
              <td colspan="2" class="center">Jumlah Siswa Kelas {{ $value->nama_tingkat }}</td>
              <td>{{ $tingkat_siswa_l }}</td>
              <td>{{ $tingkat_siswa_p }}</td>
              <td>{{ $tingkat_siswa_total }}</td>
            </tr>
            @endforeach
            <tr>
              <td colspan="2" class="center">Jumlah Total Siswa</td>
              <td>{{ $total_siswa_l }}</td>
              <td>{{ $total_siswa_p }}</td>
              <td>{{ $total_siswa }}</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
<!-- End content of page -->

@endsection
