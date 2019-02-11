@extends('semaya.layouts.app')

@section('content')

<!-- Start breadcrumb content -->
    <div class="card-panel">
      <div class="row mar-bot">
        <div class="col s12 m12 l12">
          <h4 class="page-title">Pengaturan Pelajaran Guru</h4>
        </div>
      </div>
      <div class="row mar-bot">
        <div class="col s12 m12 l12">
          <ul class="custom-breadcrumb">
            <li><a href="#">Master</a></li>
            <li><a href="#">Guru</a></li>
            <li>Pengaturan Pelajaran</li>
          </ul>
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
    @if (session('error'))
      <div class="card-panel red white-text">
        {{ session('error') }}
      </div>
    @endif
    <div class="card-panel">
      <form action="{{ route('guru_mata_pelajaran_store', ['id' => $guru->id]) }}" method="post">
        <div class="row mar-bot">
          <div class="col s12 m12 l12">
            <div class="center">
              <img src="{{ url('assets/img/users/'.$guru->foto) }}" alt="{{ $guru->nama }}" class="responsive-img circle" width="150">
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col s12 m12 l12">
            <div class="center">
              <h5>{{ $guru->nama }}</h5>
            </div>
          </div>
        </div>
        @foreach($jenis_pelajaran as $value)
        <div class="row">
          <div class="col s12 m12 l12">
            <h5>{{ $value->nama }}</h5>
          </div>
        </div>
          @php
          $pelajaran = App\Pelajaran::where('jenis_pelajaran_id', $value->id)->get();
          @endphp

          @foreach($pelajaran->chunk(4) as $chunk_value)
          <div class="row">
            @foreach($chunk_value as $pelajaran_value)
            @php
            $count_guru_pelajaran = App\GuruPelajaran::where('pelajaran_id', $pelajaran_value->id)->where('guru_id', $guru->id)->count();
            @endphp

            <div class="col s12 m12 l3">
              <input type="checkbox" class="filled-in" id="filled-{{ $pelajaran_value->id }}" name="lesson_id[{{ $pelajaran_value->id }}]" @if($count_guru_pelajaran > 0)checked @endif />
              <label for="filled-{{ $pelajaran_value->id }}">{{ $pelajaran_value->pelajaran }}</label>
            </div>
            @endforeach
          </div>
          @endforeach
        @endforeach
        <div class="row">
          <div class="col s12 m12 l12">
            <button type="submit" class="btn indigo waves-effect waves-light">Simpan</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
<!-- End content of page -->

@endsection
