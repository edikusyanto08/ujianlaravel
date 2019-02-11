@extends('semaya.layouts.app')

@section('content')

  <div id="modal-search" class="modal">
    <div class="modal-content">
      <h4>Cari Laporan Kehadiran</h4>
      <div class="row margin-bottom">
        <form class="col s12" id="formPrint" action="{{ route('absensi_siswa') }}" method="get">
          <div class="row">
            <div class="input-field col s12 m6 l6">
              <select class="select2" name="m" style="width:100%">
                <option value="" selected disabled>Bulan</option>
                @for($b = 1; $b <= 12; $b++)
                  @if($b < 10)
                  <option value="0{{ $b }}" @if ($b == $bulan['id']) selected @endif>{{ date("F", mktime(0,0,0, $b, 1)) }}</option>
                  @else
                  <option value="{{ $b }}" @if ($b == $bulan['id']) selected @endif>{{ date("F", mktime(0,0,0, $b, 1)) }}</option>
                  @endif
                @endfor
              </select>
            </div>
            <div class="input-field col s12 m6 l6">
              <select class="select2" name="y" style="width:100%">
                <option value="" selected disabled>Tahun</option>
                @for($a = Carbon::now()->format('Y'); $a >= 2010; $a--)
                <option value="{{ $a }}" @if ($a == $tahun) selected @endif>{{ $a }}</option>
                @endfor
              </select>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="submit" id="btn_create" class="btn waves-effect waves-light indigo">Lihat</button>
        <a href="javascript:void(0)" class="modal-action modal-close waves-effect btn-flat btn-cancel" id="cancel_create">Batal</a>
      </form>
    </div>
  </div>

<!-- Start breadcrumb content -->
    <div class="card-panel">
      <div class="row mar-bot">
        <div class="col s12 m12 l12">
          <h4 class="page-title">Laporan Kehadiran</h4>
        </div>
      </div>
      <div class="row mar-bot">
        <div class="col s12 m6 l6">
          <ul class="custom-breadcrumb">
            <li><a href="#">Laporan Kehadiran</a></li>
            {{-- <li><a href="#">{{ $bulan['nama'] }}</a></li> --}}
            <li>{{ ucwords(strtolower($data->nama_lengkap)) }}</li>
          </ul>
        </div>
        <div class="col s12 m6 l6">
          <div class="right">
            <a href="#modal-search" class="btn indigo tooltipped modal-trigger" data-position="top" data-delay="50" data-tooltip="Cari Laporan Kehadiran"><i class="material-icons">search</i></a>
          </div>
        </div>
      </div>
    </div>
<!-- End breadcrumb content -->

<!-- Start content of page -->
<div class="row">
  <div class="col s12 m12 l12 child-content">
    <div class="card-panel">
      <div class="row margin-bottom">
        <div class="input-field col s12 m12 l12">
          <div class="center">
            @if ($data->foto == "avatar.jpg")
              <img src="{{ 'http://'.Request::server('SERVER_ADDR').'/semaya/public/assets/img/users/'.$data->foto }}" alt="{{ $data->foto }}" width="150">
            @else
              <img src="{{ 'http://'.Request::server('SERVER_ADDR').'/semaya/public/assets/img/users/siswa/'.$data->foto }}" alt="{{ $data->foto }}" width="150">
            @endif
          </div>
          <h4 class="center">
            <span class="{{ ($data->kelamin == "P") ? "red-text" : "black-text"}}">{{ ucwords(strtolower($data->nama_lengkap)) }}</span>
          </h4>
          <h5>
            {{ $data->kelas_siswa->kelas->nama_kelas }}
            <span class="right">{{ $bulan['nama'] }} {{ $tahun }}</span>
          </h5>
        </div>
      </div>
      <table class="striped responsive-table">
        <thead>
          <th>No</th>
          <th>Hari</th>
          <th>Tanggal</th>
          <th>Waktu Absensi Masuk</th>
          <th>Waktu Absensi Pulang</th>
          <th>Status Kehadiran</th>
        </thead>
        <tbody>
          @for ($i=1; $i <= $dom; $i++)
            @php
              if (strlen($i) == 1) {
                $date = $tahun.'-'.$bulan['id'].'-0'.$i;
              } else {
                $date = $tahun.'-'.$bulan['id'].'-'.$i;
              }
              $hari = Carbon::createFromFormat('Y-m-d', $date)->format('l');
              $tanggal = Carbon::createFromFormat('Y-m-d', $date)->format('d-m-Y');
              $absen = App\Absensi::where('user_id', $data->nis)
                                  ->where('created_at', 'like', '%' . $date . '%')
                                  ->first();
              if (count($absen) > 0) {
                $waktu_masuk = ($absen->datetime_in != null) ? Carbon::createFromFormat('Y-m-d H:i:s', $absen->datetime_in)->format('H:i:s') : '-';
                $waktu_pulang = ($absen->datetime_out != null) ? Carbon::createFromFormat('Y-m-d H:i:s', $absen->datetime_out)->format('H:i:s') : '-';
              } else {
                $waktu_masuk = '-';
                $waktu_pulang  = '-';
              }
            @endphp
            <tr>
              <td>{{ $i }}</td>
              @if ($hari == "Monday")
                <td>Senin</td>
              @elseif ($hari == "Tuesday")
                <td>Selasa</td>
              @elseif ($hari == "Wednesday")
                <td>Rabu</td>
              @elseif ($hari == "Thursday")
                <td>Kamis</td>
              @elseif ($hari == "Friday")
                <td>Jum'at</td>
              @elseif ($hari == "Saturday")
                <td class="red-text">Sabtu</td>
              @elseif ($hari == "Sunday")
                <td class="red-text">Minggu</td>
              @else
                <td>-</td>
              @endif
              <td>{{ $tanggal }}</td>
              <td @if ($waktu_masuk > $waktu->in_time_late) class="orange-text" title="Terlambat" @endif>{{ $waktu_masuk }}</td>
              <td>{{ $waktu_pulang }}</td>
              @if (count($absen) > 0)
                @if ($absen->status_kehadiran == 1)
                  <td class="green-text" title="{{ $absen->alasan }}">Hadir</td>
                @elseif ($absen->status_kehadiran == 2)
                  <td class="orange-text" title="{{ $absen->alasan }}">Izin</td>
                @elseif ($absen->status_kehadiran == 3)
                  <td class="blue-text" title="{{ $absen->alasan }}">Sakit</td>
                @elseif ($absen->status_kehadiran == 0)
                  <td class="red-text" title="{{ $absen->alasan }}">Tidak Hadir</td>
                @endif
              @else
                <td>-</td>
              @endif
            </tr>
          @endfor
        </tbody>
      </table>
    </div>
  </div>
</div>
<!-- End content of page -->

@endsection
