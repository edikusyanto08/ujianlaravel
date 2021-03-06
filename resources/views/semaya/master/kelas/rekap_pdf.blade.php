@extends('semaya.layouts.pdf')

@section('content')

<h1 class="text-center">Laporan Rekapitulasi Kelas</h1>
<div class="table-content">
      <table class="table">
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

@endsection
