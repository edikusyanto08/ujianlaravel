@extends('semaya.layouts.pdf')

@section('content')
  <h1 class="text-center">Data Siswa</h1>
  <div>
    <table>
      <thead>
        <tr>
          <th>No</th>
          <th>Nama Lengkap</th>
          <th>Kelas</th>
          <th>Nama Pengguna</th>
          <th>Kata Sandi</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($data as $key => $value)
          <tr>
            <td>{{ $key + 1 }}</td>
            <td @if ($value->kelamin == "P") class="red-text" @endif>{{ $value->siswa_nama_lengkap }}</td>
            <td>{{ $value->siswa_kelas }}</td>
            <td>{{ $value->siswa_nama_pengguna }}</td>
            <td>{{ $value->siswa_kata_sandi }}</td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
@endsection
