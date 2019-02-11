@extends('semaya.layouts.pdf')
@section('content')
  <h1 class="text-center">Data Guru</h1>
  <div>
    <table>
      <thead>
        <tr>
          <th>No</th>
          <th>NIP</th>
          <th>NUPTK</th>
          <th>Nama</th>
          <th>Jenis Kelamin</th>
          <th>Tanggal Lahir</th>
          <th>Agama</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($data as $key => $value)
          <tr>
            <td>{{ $key + 1 }}</td>
            <td>{{ $value->nip }}</td>
            <td>{{ $value->nuptk }}</td>
            <td @if ($value->kelamin == "P") class="red-text" @endif>
              {{ ($value->gelar_depan) ? $value->gelar_depan.'.' : '' }} {{ $value->nama }}{{ ($value->gelar_belakang) ? ', '.$value->gelar_belakang.'.' : '' }}
            </td>
            <td>{{ $value->kelamin }}</td>
            <td>{{ $value->tgl_lahir }}</td>
            <td>{{ $value->agama }}</td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
@endsection
