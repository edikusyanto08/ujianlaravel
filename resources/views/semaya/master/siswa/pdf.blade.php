@extends('semaya.layouts.pdf')
@section('content')
  <h1 class="text-center">Data Siswa</h1>
  <div>
    <table>
      <thead>
        <tr>
          <th>No</th>
          <th>NIS</th>
          <th>Nama</th>
          <th>Kelas</th>
          <th>Jenis Kelamin</th>
          <th>Tanggal Lahir</th>
          <th>Agama</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($data as $key => $value)
          <tr>
            <td>{{ $key + 1 }}</td>
            <td>{{ $value->nis }}</td>
            <td @if ($value->kelamin == "P") class="red-text" @endif>{{ $value->nama_lengkap }}</td>
            <td>{{ $value->nama_kelas }}</td>
            <td>{{ $value->kelamin }}</td>
            <td>{{ $value->tgl_lahir }}</td>
            <td>{{ $value->agama }}</td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
@endsection
