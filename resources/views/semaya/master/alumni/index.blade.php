@extends('semaya.layouts.app')

@section('content')

<!-- Start breadcrumb content -->
    <div class="card-panel">
      <div class="row mar-bot">
        <div class="col s12 m12 l12">
          <h4 class="page-title">Daftar Alumni</h4>
        </div>
      </div>
      <div class="row mar-bot">
        <div class="col s12 m12 l12">
          <ul class="custom-breadcrumb">
            <li><a href="#">Master</a></li>
            <li>Alumni</li>
          </ul>
        </div>
      </div>
    </div>
<!-- End breadcrumb content -->

<!-- Start content of page -->
<div class="row">
  <div class="col s12 m12 l12 child-content">
    @if (session('message'))
      <div class="card-panel teal white-text">
        {{ session('message') }}
      </div>
    @endif
    <div class="card-panel">
      <div class="row">
        <table class="striped">
          <thead>
            <tr>
              <th>No</th>
              <th>NIS</th>
              <th>Nama</th>
              <th>Kelas Terakhir</th>
              <th>Nomor Kartu</th>
              <th>PIN</th>
              <th>Foto</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($data as $key => $value)
              <tr>
                <td>{{ $no++ }}.</td>
                <td>{{ $value->nis }}</td>
                <td>{{ $value->nama_lengkap }}</td>
                <td>{{ $value->kelas_siswa->kelas->nama_kelas }}</td>
                <td>{{ $value->nomor_kartu }}</td>
                <td>{{ $value->pin }}</td>
                <td>
                  @if ($value->foto == "avatar.jpg")
                    <img class="responsive-img" src="{{ url('assets/img/users/' . $value->foto) }}" alt="{{ $value->foto }}" width="30">
                  @else
                    <img class="responsive-img" src="{{ url('assets/img/users/siswa/' . $value->foto) }}" alt="{{ $value->foto }}" width="30">
                  @endif
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
      <div class="center">
        {{ $data->links() }}
      </div>
    </div>
  </div>
</div>
<!-- End content of page -->

@endsection
