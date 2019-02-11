@extends('semaya.layouts.app')

@section('content')

<!-- Start breadcrumb content -->
    <div class="card-panel">
      <div class="row mar-bot">
        <div class="col s12 m12 l12">
          <h4 class="page-title">Jenis Mutasi</h4>
        </div>
      </div>
      <div class="row mar-bot">
        <div class="col s12 m6 l6">
          <ul class="custom-breadcrumb">
            <li>Jenis Mutasi</li>
          </ul>
        </div>
        <div class="col s12 m6 l6">
          <div class="right">
            <a href="{{ route('jenis_mutasi_create') }}" class="btn indigo tooltipped" data-position="top" data-delay="50" data-tooltip="Tambah Jenis Mutasi"><i class="material-icons">add</i></a>
          </div>
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
              <th>Nama Mutasi</th>
              <th>Tipe</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($jenis_mutasi as $value)
              <tr>
                <td>{{ $no++ }}.</td>
                <td>{{ $value->mutasi }}</td>
                @if($value->tipe == 1)
                <td>Siswa</td>
                @elseif($value->tipe == 2)
                <td>Guru</td>
                @elseif($value->tipe == 3)
                <td>Karyawan</td>
                @endif
                <td>
                  <a href="{{ route('jenis_mutasi_edit', ['id' => $value->id]) }}" class="btn btn-edit indigo tooltipped" data-position="top" data-delay="50" data-tooltip="Ubah Jenis Mutasi"><i class="material-icons">edit</i></a>
                  <a href="{{ route('jenis_mutasi_destroy', ['id' => $value->id]) }}" class="btn btn-delete indigo tooltipped" data-position="top" data-delay="50" data-tooltip="Hapus Jenis Mutasi" onclick="return confirm('Apakah anda yakin ingin menghapus jenis mutasi ini?')"><i class="material-icons">delete</i></a>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
      <div class="center">
        {{ $jenis_mutasi->links() }}
      </div>
    </div>
  </div>
</div>
<!-- End content of page -->

@endsection
