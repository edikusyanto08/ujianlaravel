@extends('semaya.layouts.pdf')

@section('content')
<!-- Start content of page -->
<h1 class="text-center">Data Mutasi Karyawan</h1>
        <table class="striped">
          <thead>
            <tr>
              <th>No</th>
              <th>Nama Karyawan</th>
              <th>Tahun Ajaran</th>
              <th>Jenis Mutasi</th>
              <th>Tanggal Mutasi</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($log_mutasi_karyawan as $value)
              <tr>
                <td>{{ $no++ }}.</td>
                <td>{{ $value->karyawan_nama }}</td>
                <td>{{ $value->tahun_ajaran_nama }}</td>
                <td>{{ $value->jenis_mutasi_nama }}</td>
                <td>{{ $value->tanggal }}</td>
              </tr>
            @endforeach
          </tbody>
        </table>
<!-- End content of page -->

@endsection
