@extends('semaya.layouts.app')

@section('content')

<!-- Start breadcrumb content -->
    <div class="card-panel">
      <div class="row mar-bot">
        <div class="col s12 m12 l12">
          <h4 class="page-title">Daftar Jurusan</h4>
        </div>
      </div>
      <div class="row mar-bot">
        <div class="col s6 m6 l6">
          <ul class="custom-breadcrumb">
            <li><a href="#">Master</a></li>
            <li>Jurusan</li>
          </ul>
        </div>
        <div class="col s6 m6 l6">
          <div class="right">
            <a href="{{ route('jurusan_create') }}" class="btn btn-plus indigo tooltipped" data-position="top" data-delay="50" data-tooltip="Tambah Jurusan"><i class="material-icons">add</i></a>
            <a href="{{ route('jurusan_rekap') }}" class="btn btn-plus indigo tooltipped" data-position="top" data-delay="50" data-tooltip="Rekap Jurusan"><i class="material-icons">view_list</i></a>
          </div>
        </div>
      </div>
    </div>
<!-- End breadcrumb content -->

<!-- Start content of page -->
<div class="row">
  <div class="col s12 m12 l12 child-content">
    <div class="card-panel">
      <div class="row">
        <table class="striped">
          <thead>
            <tr>
              <th>No</th>
              <th>Nama Jurusan</th>
              <th>Kode Jurusan</th>
              <th>Paket Keahlian</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($data as $key => $value)
              <tr>
                <td>{{ $key + 1 }}</td>
                <td>{{ $value->singkatan_jurusan }}</td>
                <td>{{ $value->kode_jurusan }}</td>
                <td>{{ $value->paket_jurusan }}</td>
                <td>
                  <a href="{{ route('jurusan_edit', ['id' => $value->id]) }}" class="btn btn-edit indigo tooltipped" data-position="top" data-delay="50" data-tooltip="Ubah Jurusan"><i class="material-icons">edit</i></a>
                  <a href="{{ route('jurusan_delete', ['id' => $value->id]) }}" class="btn btn-delete indigo tooltipped" data-position="top" data-delay="50" data-tooltip="Hapus Jurusan" onclick="return confirm('Hapus Jurusan?')"><i class="material-icons">delete</i></a>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
        <div class="center">
          {{ $data->links() }}
        </div>
      </div>
    </div>
  </div>
</div>
<!-- End content of page -->

@endsection
