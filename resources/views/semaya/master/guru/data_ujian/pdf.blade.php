@extends('semaya.layouts.pdf')

@section('content')
  <h1 class="text-center">Data Guru</h1>
  <div>
    <table>
      <thead>
        <tr>
          <th>No</th>
          <th>Nama Lengkap</th>
          <th>Nama Pengguna</th>
          <th>Kata Sandi</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($data as $key => $value)
          <tr>
            <td>{{ $key + 1 }}</td>
            <td @if ($value->kelamin == "P") class="red-text" @endif>
              {{ ($value->gelar_depan) ? $value->gelar_depan.'.' : '' }} {{ $value->nama }}{{ ($value->gelar_belakang) ? ', '.$value->gelar_belakang.'.' : '' }}
            </td>
            <td>{{ $value->nomor_kartu }}</td>
            <td>{{ $value->pin }}</td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
@endsection
