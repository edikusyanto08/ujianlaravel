@extends('semaya.layouts.app')

@section('content')

<div id="modal-import" class="modal">
    <form action="{{ route('guru_import_excel') }}" method="post" enctype="multipart/form-data" autocomplete="off">
      <div class="modal-content">
        <div class="row">
          <div class="col s12 m12 l12 mar-bot">
            <h4 class="mar-bot">Impor dari Ms. Excel</h4>
          </div>
        </div>
        <div class="row">
          <div class="col s12 m12 l12">
            Agar proses impor guru berjalan sukses, ikuti format data pada excel yang telah kami buat. <a href="{{ route('guru_sample_excel') }}">Download contoh.</a>
          </div>
        </div>
        <div class="row">
          <div class="col s12 m12 l12">
            Kolom <span class="highlight-text red darken-1">NAMA</span> dan <span class="highlight-text red darken-1">TGL_LAHIR</span> harus diisi.
          </div>
        </div>
        <div class="row">
          <div class="file-field input-field col s12 m12 l12">
            <div class="btn indigo">
              <span>File Excel</span>
              <input type="file" name="excel_file" required accept=".xlsx, .xls, .csv">
            </div>
            <div class="file-path-wrapper">
              <input class="file-path validate" type="text">
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <a href="javascript:void(0)" class="modal-action modal-close waves-effect waves-indigo btn-flat">Tutup</a>
        <button type="submit" class="waves-effect waves-indigo btn-flat">Impor</button>
      </div>
    </form>
  </div>

<div id="modal-export" class="modal">
    <form action="{{ route('guru_export_excel') }}" method="get" autocomplete="off" class="no-loader">
      <div class="modal-content">
        <div class="row">
          <div class="col s12 m12 l12 mar-bot">
            <h4 class="mar-bot">Ekspor Guru</h4>
          </div>
        </div>
        <div class="row">
          <div class="input-field col s12 m12 l12">
            <div class="label-block">Pilih format</div>
            <select class="select2" name="format">
              <option value="pdf">.pdf</option>
              <option value="xlsx">.xlsx</option>
              <option value="xls">.xls</option>
              <option value="csv">.csv</option>
            </select>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <a href="javascript:void(0)" class="modal-action modal-close waves-effect waves-indigo btn-flat">Tutup</a>
        <button type="submit" class="waves-effect waves-indigo btn-flat">Ekspor</button>
      </div>
    </form>
  </div>

  <div id="modal-data-ujian" class="modal">
      <form action="{{ route('guru_data_ujian') }}" method="get" autocomplete="off" class="no-loader">
        <div class="modal-content">
          <div class="row">
            <div class="col s12 m12 l12 mar-bot">
              <h4 class="mar-bot">Ekspor Data Ujian</h4>
            </div>
          </div>
          <div class="row">
            <div class="input-field col s12 m12 l12">
              <div class="label-block">Pilih format</div>
              <select class="select2" name="format">
                <option value="pdf">.pdf</option>
                <option value="xlsx">.xlsx</option>
                <option value="xls">.xls</option>
                <option value="csv">.csv</option>
              </select>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <a href="javascript:void(0)" class="modal-action modal-close waves-effect waves-indigo btn-flat">Tutup</a>
          <button type="submit" class="waves-effect waves-indigo btn-flat">Ekspor</button>
        </div>
      </form>
    </div>

<!-- Start breadcrumb content -->
    <div class="card-panel">
      <div class="row mar-bot">
        <div class="col s12 m12 l12">
          <h4 class="page-title">Daftar Guru</h4>
        </div>
      </div>
      <div class="row mar-bot">
        <div class="col s12 m6 l6">
          <ul class="custom-breadcrumb">
            <li><a href="#">Master</a></li>
            <li>Guru</li>
          </ul>
        </div>
        <div class="col s12 m6 l6">
          <div class="right">
            <a href="{{ route('guru_create') }}" class="btn btn-plus indigo tooltipped" data-position="top" data-delay="50" data-tooltip="Tambah Guru"><i class="material-icons">add</i></a>
            <a href="#modal-export" class="btn indigo tooltipped modal-trigger" data-position="top" data-delay="50" data-tooltip="Ekspor Guru"><i class="material-icons">cloud_upload</i></a>
            <a href="#modal-import" class="btn indigo tooltipped modal-trigger" data-position="top" data-delay="50" data-tooltip="Impor Guru dari Excel"><i class="material-icons">cloud_download</i></a>
            <a href="#modal-data-ujian" class="btn indigo tooltipped modal-trigger" data-position="top" data-delay="50" data-tooltip="Ekspor Data Ujian"><i class="material-icons">assignment_ind</i></a>
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
        <form action="{{ route('guru_search') }}" method="get">
          <div class="input-field col s12 m12 l4">
            <input type="text" name="q" id="search_input" value="{{ $q }}">
            <label for="search_input">Cari Nama Guru</label>
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
              <th>NUPTK</th>
              <th>Nama</th>
              <th>Nomor Kartu</th>
              <th>PIN</th>
              <th>Foto</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($data as $key => $value)
              <tr>
                <td>{{ $no++ }}</td>
                <td>{{ $value->nuptk}}</td>
                <td @if ($value->status == 0) class="red-text" @endif>{{ ($value->gelar_depan != null) ? $value->gelar_depan.'.' : '' }} {{ $value->nama }}{{ ($value->gelar_belakang != null) ? ', '.$value->gelar_belakang.'.' : '' }}</td>
                <td>{{ $value->nomor_kartu }}</td>
                <td>{{ $value->pin }}</td>
                <td>
                  @if ($value->foto == "avatar.jpg")
                    <img class="responsive-img" src="{{ url('assets/img/users/' . $value->foto) }}" alt="{{ $value->foto }}" width="30">
                  @else
                    <img class="responsive-img" src="{{ url('assets/img/users/guru/' . $value->foto) }}" alt="{{ $value->foto }}" width="30">
                  @endif
                </td>
                <td>
                  <a href="{{ route('guru_edit', ['id' => $value->id]) }}" class="btn btn-edit indigo tooltipped" data-position="top" data-delay="50" data-tooltip="Ubah Guru"><i class="material-icons">edit</i></a>
                  <a href="{{ route('guru_mata_pelajaran_index', ['id' => $value->id]) }}" class="btn btn-edit indigo tooltipped" data-position="top" data-delay="50" data-tooltip="Pengaturan Pelajaran"><i class="material-icons">insert_drive_file</i></a>
                  <a href="{{ route('guru_delete', ['id' => $value->id]) }}" class="btn btn-delete indigo tooltipped" data-position="top" data-delay="50" data-tooltip="Hapus Guru" onclick="return confirm('Hapus Guru?')"><i class="material-icons">delete</i></a>
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
