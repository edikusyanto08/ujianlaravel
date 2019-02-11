@extends('semaya.layouts.app')

@section('content')

<!-- Start breadcrumb content -->
    <div class="card-panel">
      <div class="row mar-bot">
        <div class="col s12 m12 l12">
          <h4 class="page-title">Buku Induk</h4>
        </div>
      </div>
      <div class="row mar-bot">
        <div class="col s12 m6 l6">
          <ul class="custom-breadcrumb">
            <li>Buku Induk</li>
          </ul>
        </div>
        <div class="col s12 m6 l6">
          {{-- <div class="right">
            <a href="{{ route('cloud_computing_create') }}" class="btn btn-plus indigo tooltipped" data-position="top" data-delay="50" data-tooltip="Tambah Pengguna Semaya Cloud"><i class="material-icons">add</i></a>
          </div> --}}
        </div>
      </div>
    </div>
<!-- End breadcrumb content -->

<!-- Start content of page -->
<div class="row">
  <div class="col s12 m12 l12 child-content">
    <div class="row">
      @foreach ($data as $key => $value)
      <div class="col s12 m4 l4">
        <div class="card-panel">
          <div class="center row">
            @if ($value->foto == "avatar.jpg")
            <img class="responsive-img" src="{{ url('assets/img/users/' . $value->foto) }}" alt="{{ $value->foto }}" width="150">
            @else
            <img class="responsive-img" src="{{ url('assets/img/users/siswa/' . $value->foto) }}" alt="{{ $value->foto }}" width="150">
            @endif
          </div>
          <div class="center">
            <a href="{{ route('buku_induk_detail', ['nis' => $value->nis]) }}">{{ $value->nama_lengkap }}</a>
          </div>
        </div>
      </div>
      @endforeach
    </div>
    <div class="row">
      <div class="col s12 m12 l12">
        <div class="center">
          {{ $data->links() }}
        </div>
      </div>
    </div>
  </div>
</div>
<!-- End content of page -->

@endsection
