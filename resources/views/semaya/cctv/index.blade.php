@extends('semaya.layouts.app')

@section('content')

<!-- Start breadcrumb content -->
    <div class="card-panel">
      <div class="row mar-bot">
        <div class="col s12 m12 l12">
          <h4 class="page-title">Kamera CCTV</h4>
        </div>
      </div>
      <div class="row mar-bot">
        <div class="col s10 m10 l10">
          <ul class="custom-breadcrumb">
            <li><a href="#">Lainnya</a></li>
            <li>Kamera CCTV</li>
          </ul>
        </div>
        <div class="col s2 m2 l2">
          <div class="right">
            <a href="{{ route('cctv_create') }}" class="btn btn-plus indigo tooltipped" data-position="top" data-delay="50" data-tooltip="Tambah Kamera CCTV"><i class="material-icons">add</i></a>
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
              <th>Nama Tempat</th>
              <th>IP</th>
              <th>Channel</th>
              <th>Tindakan</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($cctv as $value)
              <tr>
                <td>{{ $no++ }}</td>
                <td>{{ $value->nama_tempat }}</td>
                <td>{{ $value->ip }}</td>
                <td>{{ $value->channel }}</td>
                <td>
                  <a href="{{ route('cctv_edit', ['id' => $value->id]) }}" class="btn btn-edit indigo tooltipped" data-position="top" data-delay="50" data-tooltip="Ubah CCTV"><i class="material-icons">edit</i></a>
                  <a href="{{ route('cctv_destroy', ['id' => $value->id]) }}" class="btn btn-delete indigo tooltipped" data-position="top" data-delay="50" data-tooltip="Hapus CCTV" onclick="return confirm('Hapus kamera CCTV?')"><i class="material-icons">delete</i></a>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
        <div class="center">
          {{ $cctv->links() }}
        </div>
      </div>
    </div>
  </div>
</div>
<!-- End content of page -->

@endsection
