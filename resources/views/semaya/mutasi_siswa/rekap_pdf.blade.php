@extends('semaya.layouts.pdf')

@section('content')
<!-- Start content of page -->
<h1 class="text-center">Data Mutasi Siswa</h1>
        <table class="striped">
          <thead>
            <tr>
              <th>No</th>
              <th>Nama Siswa</th>
              <th>Tahun Ajaran</th>
              <th>Jenis Mutasi</th>
              <th>Tanggal Mutasi</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($log_mutasi_siswa as $value)
              <tr>
                <td>{{ $no++ }}.</td>
                <td>{{ $value->siswa_nama }}</td>
                <td>{{ $value->tahun_ajaran_nama }}</td>
                <td>{{ $value->jenis_mutasi_nama }}</td>
                <td>{{ $value->tanggal }}</td>
              </tr>
            @endforeach
          </tbody>
        </table>
<!-- End content of page -->

@endsection
