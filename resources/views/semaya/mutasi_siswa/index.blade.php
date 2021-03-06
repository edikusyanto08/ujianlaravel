@extends('semaya.layouts.app')

@section('content')

<!-- Start breadcrumb content -->
    <div class="card-panel">
      <div class="row mar-bot">
        <div class="col s12 m12 l12">
          <h4 class="page-title">Mutasi Siswa</h4>
        </div>
      </div>
      <div class="row mar-bot">
        <div class="col s12 m6 l6">
          <ul class="custom-breadcrumb">
            <li>Mutasi Siswa</li>
          </ul>
        </div>
        <div class="col s12 m6 l6">
          <div class="right">
            <a href="{{ route('mutasi_siswa_create') }}" class="btn indigo tooltipped" data-position="top" data-delay="50" data-tooltip="Tambah Mutasi Siswa"><i class="material-icons">add</i></a>
            <a href="{{ route('mutasi_siswa_pdf') }}" class="btn indigo tooltipped" data-position="top" data-delay="50" data-tooltip="Ekspor PDF"><i class="material-icons">cloud_upload</i></a>
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
              <th>Nama Siswa</th>
              <th>Tahun Ajaran</th>
              <th>Jenis Mutasi</th>
              <th>Tanggal Mutasi</th>
              <th>Tindakan</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($log_mutasi_siswa as $value)
              <tr>
                <td>{{ $no++ }}.</td>
                <td>{{ $value->siswa_nama }}</td>
                <td>{{ $value->tahun_ajaran_nama }}</td>
                <td>{{ $value->jenis_mutasi_nama }}</td>
                <td>{{ $value->tanggal }}</td>
                <td>
                  <a href="{{ route('mutasi_siswa_edit', ['id' => $value->id]) }}" class="btn btn-edit indigo tooltipped" data-position="top" data-delay="50" data-tooltip="Ubah Mutasi Siswa"><i class="material-icons">edit</i></a>
                  <a href="{{ route('mutasi_siswa_destroy', ['id' => $value->id]) }}" class="btn btn-delete indigo tooltipped" data-position="top" data-delay="50" data-tooltip="Hapus Mutasi Siswa" onclick="return confirm('Apakah anda yakin ingin menghapus mutasi siswa ini?')"><i class="material-icons">delete</i></a>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
      <div class="center">
        {{ $log_mutasi_siswa->links() }}
      </div>
    </div>
  </div>
</div>
<!-- End content of page -->

@endsection
