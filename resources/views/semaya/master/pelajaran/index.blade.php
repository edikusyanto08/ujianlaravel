@extends('semaya.layouts.app')

@section('content')

<!-- Start breadcrumb content -->
    <div class="card-panel">
      <div class="row mar-bot">
        <div class="col s12 m12 l12">
          <h4 class="page-title">Daftar Mata Pelajaran</h4>
        </div>
      </div>
      <div class="row mar-bot">
        <div class="col s10 m10 l10">
          <ul class="custom-breadcrumb">
            <li><a href="#">Master</a></li>
            <li>Mata Pelajaran</li>
          </ul>
        </div>
        <div class="col s2 m2 l2">
          <a href="{{ route('pelajaran_create') }}" class="btn btn-plus indigo tooltipped" data-position="top" data-delay="50" data-tooltip="Tambah Mata Pelajaran"><i class="material-icons">add</i></a>
        </div>
      </div>
    </div>
<!-- End breadcrumb content -->

<!-- Start content of page -->
<div class="row">
  <div class="col s12 m12 l12 child-content">
    <div class="card-panel">
      <div class="row">
        <form action="{{ route('pelajaran_search') }}" method="get">
          <div class="input-field col s12 m12 l4">
            <input type="text" name="q" id="search_input" value="{{ $q }}">
            <label for="search_input">Cari Nama Pelajaran</label>
          </div>
          <div class="input-field col s12 m12 l8">
            <button type="submit" class="btn waves-effect waves-light indigo"><i class="material-icons">search</i></button>
          </div>
        </form>
      </div>
      <div class="row">
        <table class="striped">
          <thead>
            <tr>
              <th>No</th>
              <th>Kode Pelajaran</th>
              <th>Nama Pelajaran</th>
              <th>Kelompok Pelajaran</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($data as $key => $value)
              <tr>
                <td>{{ $key + 1 }}</td>
                <td>{{ $value->kode_pel }}</td>
                <td>{{ $value->pelajaran }}</td>
                <td>
                  @if ($value->jenis_pelajaran == null)
                    -
                  @else
                    {{ $value->jenis_pelajaran->nama }}
                  @endif
                </td>
                <td>
                  <a href="{{ route('pelajaran_edit', ['id' => $value->id]) }}" class="btn btn-edit indigo tooltipped" data-position="top" data-delay="50" data-tooltip="Ubah Mata Pelajaran"><i class="material-icons">edit</i></a>
                  <a href="{{ route('pelajaran_delete', ['id' => $value->id]) }}" class="btn btn-delete indigo tooltipped" data-position="top" data-delay="50" data-tooltip="Hapus Mata Pelajaran" onclick="return confirm('Hapus Mata Pelajaran?')"><i class="material-icons">delete</i></a>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
        <div class="center">
          @if($q != "")
            {{ $data->appends(['q' => $q])->links() }}
          @else
            {{ $data->links() }}
          @endif
        </div>
      </div>
    </div>
  </div>
</div>
<!-- End content of page -->

@endsection
