@extends('semaya.layouts.app')

@section('content')

<!-- Start breadcrumb content -->
    <div class="card-panel">
      <div class="row mar-bot">
        <div class="col s12 m12 l12">
          <h4 class="page-title">Daftar Kelas</h4>
        </div>
      </div>
      <div class="row mar-bot">
        <div class="col s12 m6 l6">
          <ul class="custom-breadcrumb">
            <li><a href="#">Master</a></li>
            <li>Kelas</li>
          </ul>
        </div>
        <div class="col s12 m6 l6">
          <div class="right">
            <a href="{{ route('kelas_create') }}" class="btn btn-plus indigo tooltipped" data-position="top" data-delay="50" data-tooltip="Tambah Kelas"><i class="material-icons">add</i></a>
            <a href="{{ route('kelas_rekap') }}" class="btn btn-plus indigo tooltipped" data-position="top" data-delay="50" data-tooltip="Rekapitulasi Kelas"><i class="material-icons">view_list</i></a>
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
              <th>Nama Kelas</th>
              <th>Wali Kelas</th>
              <th>Tingkat</th>
              <th>Jurusan</th>
              <th>Jumlah Siswa</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($data as $key => $value)
            @php
            $jumlah_siswa = App\KelasSiswa::where('kelas_id', $value->id)->count();
            @endphp
              <tr>
                <td>{{ $key + 1 }}</td>
                <td>{{ $value->nama_kelas }}</td>
                @if ($value->wali_kelas)
                  <td>
                    {{ ($value->wali_kelas->guru->gelar_depan) ? $value->wali_kelas->guru->gelar_depan.'.' : '' }} {{ $value->wali_kelas->guru->nama }}{{ ($value->wali_kelas->guru->gelar_belakang) ? ', '.$value->wali_kelas->guru->gelar_belakang.'.' : '' }}
                  </td>
                @else
                  <td>-</td>
                @endif

                <td>{{ $value->tingkat->nama_tingkat }}</td>
                <td>{{ $value->jurusan->singkatan_jurusan }}</td>
                <td>{{ $jumlah_siswa }}</td>
                <td>
                  <a href="{{ route('kelas_edit', ['id' => $value->id]) }}" class="btn btn-edit indigo tooltipped" data-position="top" data-delay="50" data-tooltip="Ubah Kelas"><i class="material-icons">edit</i></a>
                  <a href="{{ route('kelas_delete', ['id' => $value->id]) }}" class="btn btn-delete indigo tooltipped" data-position="top" data-delay="50" data-tooltip="Hapus Kelas" onclick="return confirm('Hapus Kelas?')"><i class="material-icons">delete</i></a>
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
