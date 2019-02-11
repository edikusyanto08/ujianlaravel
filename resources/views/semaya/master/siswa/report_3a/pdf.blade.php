@extends('semaya.layouts.pdf')

@section('content')

<h1 class="text-center">Report 3A Kelas {{ $kelas->nama_kelas }}</h1>
<table>
  <thead>
    <tr>
      <th colspan="3">NOMOR</th>
      <th rowspan="2">NAMA PESERTA DIDIK</th>
      <th rowspan="2">L/P</th>
      <th rowspan="2" colspan="2">TEMPAT.TANGGAL  LAHIR</th>
      <th rowspan="2">AGAMA</th>
      <th rowspan="2">NAMA ORANG TUA</th>
      <th rowspan="2">ALAMAT ORANG TUA / WALI</th>
      {{-- <th rowspan="2">NOMOR IJAZAH SLTP</th>
      <th rowspan="2">TAHUN IJAZAH</th> --}}
      <th rowspan="2">NOMOR UJIAN SMP</th>
    </tr>
    <tr>
      <th>URUT</th>
      <th>NIS</th>
      <th>NISN</th>
    </tr>
    <tr>
      <th>1</th>
      <th>2</th>
      <th>3</th>
      <th>4</th>
      <th>5</th>
      <th colspan="2">6</th>
      <th>7</th>
      <th>8</th>
      <th>9</th>
      <th>10</th>
      {{-- <th>11</th> --}}
    </tr>
  </thead>
  <tbody>
    @foreach($siswa as $value)
    <tr>
      <td>{{ $no++ }}</td>
      <td>{{ $value->siswa_nis }}</td>
      <td>{{ $value->siswa_nisn }}</td>
      <td>{{ $value->siswa_nama }}</td>
      <td>{{ $value->siswa_kelamin }}</td>
      <td>{{ $value->siswa_tempat_lahir }}</td>
      <td>{{ Carbon::parse($value->siswa_tanggal_lahir)->format('d F Y') }}</td>
      <td>{{ $value->siswa_agama }}</td>
      <td>{{ $value->siswa_nama_ayah }}</td>
      <td>{{ $value->siswa_alamat_ayah }}</td>
      <td>-</td>
      {{-- <td>{{ $value->siswa_no_ijazah }}</td>
      <td>{{ Carbon::parse($value->siswa_tgl_ijazah)->format('Y') }}</td> --}}
    </tr>
    @endforeach
  </tbody>
</table>

@endsection
