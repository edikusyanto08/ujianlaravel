@extends('semaya.layouts.app')

@section('content')

<!-- Start breadcrumb content -->
    <div class="card-panel">
      <div class="row mar-bot">
        <div class="col s12 m12 l12">
          <h4 class="page-title">Daftar Tingkat Kelas</h4>
        </div>
      </div>
      <div class="row mar-bot">
        <div class="col s10 m10 l10">
          <ul class="custom-breadcrumb">
            <li><a href="#">Master</a></li>
            <li>Tingkat Kelas</li>
          </ul>
        </div>
        <div class="col s2 m2 l2">
          <a href="{{ route('tingkat_create') }}" class="btn btn-plus indigo tooltipped" data-position="top" data-delay="50" data-tooltip="Tambah Tingkat Kelas"><i class="material-icons">add</i></a>
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
              <th>Nama Tingkatan</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($data as $key => $value)
              <tr>
                <td>{{ $key + 1 }}</td>
                <td>{{ $value->nama_tingkat }}</td>
                <td>
                  <a href="{{ route('tingkat_edit', ['id' => $value->id]) }}" class="btn btn-edit indigo tooltipped" data-position="top" data-delay="50" data-tooltip="Ubah Tingkat Kelas"><i class="material-icons">edit</i></a>
                  <a href="{{ route('tingkat_delete', ['id' => $value->id]) }}" class="btn btn-delete indigo tooltipped" data-position="top" data-delay="50" data-tooltip="Hapus Tingkat Kelas" onclick="return confirm('Hapus Tingkat Kelas?')"><i class="material-icons">delete</i></a>
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
