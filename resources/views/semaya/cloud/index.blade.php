@extends('semaya.layouts.app')

@section('content')

<!-- Start breadcrumb content -->
    <div class="card-panel">
      <div class="row mar-bot">
        <div class="col s12 m12 l12">
          <h4 class="page-title">Daftar Sekolah Pengguna Semaya</h4>
        </div>
      </div>
      <div class="row mar-bot">
        <div class="col s12 m6 l6">
          <ul class="custom-breadcrumb">
            <li>Semaya Cloud</li>
          </ul>
        </div>
        <div class="col s12 m6 l6">
          <div class="right">
            <a href="{{ route('cloud_computing_create') }}" class="btn btn-plus indigo tooltipped" data-position="top" data-delay="50" data-tooltip="Tambah Pengguna Semaya Cloud"><i class="material-icons">add</i></a>
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
              <th>Nama Sekolah</th>
              <th>Masa Berlaku</th>
              <th>Status</th>
              <th>Tindakan</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($sekolah_master as $value)
              <tr>
                <td>{{ $no++ }}.</td>
                <td>{{ $value->nama }}</td>
                <td>{{ $value->expired }}</td>
                @if($value->status == 1)
                  @if(Carbon::now()->format('Y-m-d') > $value->expired)
                  <td>Expired</td>
                  @else
                  <td>Aktif</td>
                  @endif
                @else
                  @if(Carbon::now()->format('Y-m-d') > $value->expired)
                  <td>Expired</td>
                  @else
                  <td>Tidak Aktif</td>
                  @endif
                @endif
                <td>
                  <a href="{{ route('cloud_computing_edit', ['id' => $value->id]) }}" class="btn btn-edit indigo tooltipped" data-position="top" data-delay="50" data-tooltip="Ubah Pengguna Semaya Cloud"><i class="material-icons">edit</i></a>
                  @if($value->status == 1)
                  <a href="{{ route('cloud_computing_disable', ['id' => $value->id]) }}" class="btn btn-edit indigo tooltipped" data-position="top" data-delay="50" data-tooltip="Nonaktifkan Pengguna Semaya Cloud" onclick="return confirm('Apakah anda yakin ingin menonaktifkan pengguna Semaya Cloud?')"><i class="material-icons">cloud_off</i></a>
                  @elseif($value->status == 0)
                  <a href="{{ route('cloud_computing_activate', ['id' => $value->id]) }}" class="btn btn-edit indigo tooltipped" data-position="top" data-delay="50" data-tooltip="Aktifkan Pengguna Semaya Cloud" onclick="return confirm('Apakah anda yakin ingin mengaktifkan pengguna Semaya Cloud?')"><i class="material-icons">cloud_done</i></a>
                  @endif
                  <a href="{{ route('cloud_computing_destroy', ['id' => $value->id]) }}" class="btn btn-delete indigo tooltipped" data-position="top" data-delay="50" data-tooltip="Hapus Pengguna Semaya Cloud" onclick="return confirm('Apakah anda yakin ingin menghapus pengguna Semaya Cloud?')"><i class="material-icons">delete</i></a>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
      <div class="center">
        {{ $sekolah_master->links() }}
      </div>
    </div>
  </div>
</div>
<!-- End content of page -->

@endsection
