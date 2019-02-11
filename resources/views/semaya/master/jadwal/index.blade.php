@extends('semaya.layouts.app')

@section('content')

<!-- Start breadcrumb content -->
    <div class="card-panel">
      <div class="row mar-bot">
        <div class="col s12 m12 l12">
          <h4 class="page-title">Daftar Jadwal Pelajaran</h4>
        </div>
      </div>
      <div class="row mar-bot">
        <div class="col s10 m10 l10">
          <ul class="custom-breadcrumb">
            <li><a href="#">Master</a></li>
            <li>Jadwal Pelajaran</li>
          </ul>
        </div>
        <div class="col s2 m2 l2">
          <div class="right">
            <a href="{{ route('jadwal_create') }}" class="btn btn-plus indigo tooltipped" data-position="top" data-delay="50" data-tooltip="Tambah Jadwal Pelajaran"><i class="material-icons">add</i></a>
            <a href="{{ route('jadwal_rekap') }}" class="btn btn-plus indigo tooltipped" data-position="top" data-delay="50" data-tooltip="Rekap Jadwal Pelajaran"><i class="material-icons">view_list</i></a>
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
              <th>Hari</th>
              <th>Pelajaran</th>
              <th>Kelas</th>
              <th>Guru</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($data as $key => $value)
              <tr>
                <td>{{ $key + 1 }}</td>
                <td>{{ $value->hari->hari }}</td>
                <td>{{ $value->pelajaran->pelajaran }}</td>
                <td>{{ $value->kelas->nama_kelas }}</td>
                <td>
                  @if ($value->guru->gelar_depan != null)
                    {{ $value->guru->gelar_depan }}.
                  @endif
                  {{ $value->guru->nama }}@if ($value->guru->gelar_belakang != null), {{ $value->guru->gelar_belakang }}@endif
                </td>
                <td>
                  <a href="{{ route('jadwal_edit', ['id' => $value->id]) }}" class="btn btn-edit indigo tooltipped" data-position="top" data-delay="50" data-tooltip="Ubah Jadwal Pelajaran"><i class="material-icons">edit</i></a>
                  <a href="{{ route('jadwal_delete', ['id' => $value->id]) }}" class="btn btn-delete indigo tooltipped" data-position="top" data-delay="50" data-tooltip="Hapus Jadwal Pelajaran" onclick="return confirm('Hapus Jadwal Pelajaran?')"><i class="material-icons">delete</i></a>
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
