@extends('semaya.layouts.app')

@section('content')

<!-- Start breadcrumb content -->
    <div class="card-panel">
      <div class="row mar-bot">
        <div class="col s12 m12 l12">
          <h4 class="page-title">Ubah Tahun Ajaran</h4>
        </div>
      </div>
      <div class="row mar-bot">
        <div class="col s12 m12 l12">
          <ul class="custom-breadcrumb">
            <li><a href="#">Master</a></li>
            <li><a href="#">Tahun Ajaran</a></li>
            <li>Ubah</li>
          </ul>
        </div>
      </div>
    </div>
<!-- End breadcrumb content -->

<!-- Start content of page -->
<div class="row">
  <div class="col s12 m12 l12 child-content">
    @if (count($errors) > 0)
      <div class="card-panel red white-text">
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
      </div>
    @endif
    <div class="card-panel">
      <div class="row">
        <form class="col s12 m12 l12" action="{{ route('tahun_update') }}" method="post" autocomplete="off">
          {!! csrf_field() !!}
          <input type="hidden" name="id_tahun" value="{{ $data->id }}">
          <div class="row">
            <div class="input-field col s12 m12 l12">
              <input id="tahun_ajaran" name="tahun_ajaran" type="text" class="validate" value="{{ $data->nama }}" required>
              <label for="tahun_ajaran">Tahun Ajaran</label>
            </div>
          </div>
          <div class="row">
            <div class="row col s12 m6 l6">
              <div class="input-field">
                <input id="tanggal_mulai" name="tanggal_mulai" type="text" class="datepicker" @if ($data->tanggal_mulai != null)
                  value="{{ \Carbon\Carbon::createFromFormat('Y-m-d', $data->tanggal_mulai)->format('d/m/Y') }}" @endif required>
                <label for="tanggal_mulai">Tanggal Mulai</label>
              </div>
            </div>
            <div class="row col s12 m6 l6">
              <div class="input-field">
                <input id="tanggal_selesai" name="tanggal_selesai" type="text" class="datepicker" @if ($data->tanggal_selesai != null)
                  value="{{ \Carbon\Carbon::createFromFormat('Y-m-d', $data->tanggal_selesai)->format('d/m/Y') }}" @endif required>
                <label for="tanggal_selesai">Tanggal Selesai</label>
              </div>
            </div>
            <div class="input-field col s12 m12 l12">
              <select class="select2" style="width: 100%;" name="status">
                <option disabled selected>Status</option>
                <option value="1" @if ($data->status == 1) selected @endif>Aktif</option>
                <option value="0" @if ($data->status == 0) selected @endif>Tidak Aktif</option>
              </select>
            </div>
          </div>
          <div class="row">
            <div class="input-field col s12 m12 l12">
              <button type="submit" class="waves-effect waves-light btn indigo">Simpan</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<script>
  $(document).ready(function() {
    $('#tahun_ajaran').mask('0000/0000');
  });
</script>
<!-- End content of page -->

@endsection
