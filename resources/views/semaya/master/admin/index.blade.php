@extends('semaya.layouts.app')

@section('content')

<!-- Start breadcrumb content -->
    <div class="card-panel">
      <div class="row mar-bot">
        <div class="col s12 m12 l12">
          <h4 class="page-title">Admin</h4>
        </div>
      </div>
      <div class="row mar-bot">
        <div class="col s12 m9 l9">
          <ul class="custom-breadcrumb">
            <li>Admin</li>
          </ul>
        </div>
        <div class="col s12 m3 l3">
          <div class="right">
            <a href="{{ route('admin_create') }}" class="btn btn-plus indigo tooltipped waves-effect waves-light" data-position="top" data-delay="50" data-tooltip="Tambah Admin"><i class="material-icons">add</i></a>
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
      <div id="table-content">
        <table class="striped centered">
          <thead>
            <tr>
                <th>No.</th>
                <th>Nama</th>
                <th>Nama Pengguna</th>
                <th>Tipe</th>
                <th>Tindakan</th>
            </tr>
          </thead>
          <tbody>
            @foreach($admin as $value)
            @php
            $user = App\User::where('username', $value->username)->first();
            $role_user = App\RoleUser::where('user_id', $user->id)->first();
            $role = App\Role::find($role_user->role_id);
            @endphp
            <tr>
              <td>{{ $no++ }}.</td>
              <td>{{ $value->nama }}</td>
              <td>{{ $value->username }}</td>
              <td>{{ $role->display_name }}</td>
              <td>
                <a href="{{ route('admin_edit', ['id'=>$value->id]) }}" class="btn btn-edit indigo tooltipped waves-effect waves-light" data-position="top" data-delay="50" data-tooltip="Ubah Admin"><i class="material-icons">edit</i></a>
                <a href="{{ route('admin_destroy', ['id'=>$value->id]) }}" class="btn btn-delete indigo tooltipped waves-effect waves-light" data-position="top" data-delay="50" data-tooltip="Hapus Admin" onclick="return confirm('Apakah anda yakin ingin menghapus {{ $value->nama_kegiatan }} dari daftar admin?')"><i class="material-icons">delete</i></a>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
      <div class="center">
        {{ $admin->links() }}
      </div>
    </div>
  </div>
</div>
<!-- End content of page -->

@endsection
