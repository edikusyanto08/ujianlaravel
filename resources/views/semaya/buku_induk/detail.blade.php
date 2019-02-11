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
            <li><a href="#">Buku Induk</a></li>
            <li>{{ ucwords(strtolower($data->nama_lengkap)) }}</li>
          </ul>
        </div>
        <div class="col s12 m6 l6">
          <div class="right">
            <a href="{{ route('buku_induk_pdf', ['nis' => $data->nis]) }}" class="btn btn-plus indigo tooltipped" data-position="top" data-delay="50" data-tooltip="Ekspor Buku Induk"><i class="material-icons">cloud_upload</i></a>
          </div>
        </div>
      </div>
    </div>
<!-- End breadcrumb content -->

<!-- Start content of page -->
<div class="row">
  <div class="col s12 m12 l12 child-content">
    <div class="row">
      <div class="card-panel">
        <div class="center">
          <h5>
            Keterangan Tentang Diri Siswa
          </h5>
        </div>
        <div class="row">
          <div class="col s12 m5 l5">1. Nama Lengkap</div>
          <div class="col s12 m7 l7">: {{ ($data->nama_lengkap) ? $data->nama_lengkap : '-' }}</div>
          <div class="col s12 m5 l5">2. NIS / NISN</div>
          <div class="col s12 m7 l7">: {{ ($data->nis) ? $data->nis : '-' }} / {{ ($data->nisn) ? $data->nisn : '-' }}</div>
          <div class="col s12 m5 l5">3. Jenis Kelamin</div>
          <div class="col s12 m7 l7">: {{ ($data->kelamin) ? $data->kelamin : '-' }}</div>
          <div class="col s12 m5 l5">4. Tempat dan Tanggal Lahir</div>
          <div class="col s12 m7 l7">: {{ ($data->tempat_lahir) ? $data->tempat_lahir : '-' }}, {{ ($data->tgl_lahir) ? Carbon::createFromFormat('Y-m-d', $data->tgl_lahir)->format('d-m-Y') : '-' }}</div>
          <div class="col s12 m5 l5">5. Agama</div>
          <div class="col s12 m7 l7">: {{ ($data->agama) ? $data->agama : '-' }}</div>
          <div class="col s12 m5 l5">6. Alamat Siswa</div>
          <div class="col s12 m7 l7">: {{ ($data->alamat) ? $data->alamat : '-' }}</div>
          <div class="col s12 m5 l5">7. Telp</div>
          <div class="col s12 m7 l7">: {{ ($data->no_telp) ? $data->no_telp : '-' }}</div>
          <div class="col s12 m12 l12">8. Sekolah Asal</div>
          {{-- @for ($i=0; $i < 4; $i++)&nbsp;@endfor  --}}
          <div class="col s12 m5 l5">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;a. Nama Sekolah</div>
          <div class="col s12 m7 l7">: {{ ($data->tamat_dari) ? $data->tamat_dari : '-' }}</div>
          <div class="col s12 m5 l5">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;b. Alamat</div>
          {{-- <div class="col s12 m7 l7">: {{ ($data->no_telp) ? $data->no_telp : '-' }}</div>  --}}
          <div class="col s12 m12 l12">9. Surat Tanda Tamat Belajar (STTB)</div>
          <div class="col s12 m5 l5">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;a. Tahun</div>
          <div class="col s12 m7 l7">: {{ ($data->tgl_ijazah) ? Carbon::createFromFormat('Y-m-d', $data->tgl_ijazah)->format('Y') : '-' }}</div>
          <div class="col s12 m5 l5">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;b. Nomor</div>
          <div class="col s12 m7 l7">: {{ ($data->no_ijazah) ? $data->no_ijazah : '-' }}</div>
          <div class="col s12 m12 l12">10. Diterima Di Sekolah Ini</div>
          <div class="col s12 m5 l5">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;a. Ditingkat / Kelas</div>
          <div class="col s12 m7 l7">: {{ ($data->kelas_siswa) ? $data->kelas_siswa->kelas->tingkat->nama_tingkat : '-' }}</div>
          <div class="col s12 m5 l5">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;b. Pada Tanggal, Bulan dan Tahun</div>
          <div class="col s12 m7 l7">: {{ ($data->no_telp) ? $data->no_telp : '-' }}</div>
          <div class="col s12 m12 l12">11. Nama Orang Tua</div>
          <div class="col s12 m5 l5">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;a. Ayah</div>
          <div class="col s12 m7 l7">: {{ ($data->nama_ayah) ? $data->nama_ayah : '-' }}</div>
          <div class="col s12 m5 l5">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;b. Ibu</div>
          <div class="col s12 m7 l7">: {{ ($data->nama_ibu) ? $data->nama_ibu : '-' }}</div>
          <div class="col s12 m12 l12">12. Alamat Orang Tua</div>
          <div class="col s12 m5 l5">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;a. Ayah</div>
          <div class="col s12 m7 l7">: {{ ($data->alamat_ayah) ? $data->alamat_ayah : '-' }}</div>
          <div class="col s12 m5 l5">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;b. Ibu</div>
          <div class="col s12 m7 l7">: {{ ($data->alamat_ibu) ? $data->alamat_ibu : '-' }}</div>
          <div class="col s12 m12 l12">13. Pekerjaan Orang Tua</div>
          <div class="col s12 m5 l5">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;a. Ayah</div>
          <div class="col s12 m7 l7">: {{ ($data->pekerjaan_ayah) ? $data->pekerjaan_ayah : '-' }}</div>
          <div class="col s12 m5 l5">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;b. Ibu</div>
          <div class="col s12 m7 l7">: {{ ($data->pekerjaan_ibu) ? $data->pekerjaan_ibu : '-' }}</div>
          <div class="col s12 m5 l5">14. Nama Wali</div>
          <div class="col s12 m7 l7">: {{ ($data->nama_wali) ? $data->nama_wali : '-' }}</div>
          <div class="col s12 m5 l5">15. Alamat Wali Wali</div>
          <div class="col s12 m7 l7">: {{ ($data->alamat_wali) ? $data->alamat_wali : '-' }}</div>
          <div class="col s12 m5 l5">16. Pekerjaan Wali Wali</div>
          <div class="col s12 m7 l7">: {{ ($data->pekerjaan_wali) ? $data->pekerjaan_wali : '-' }}</div>
          <div class="col s12 m5 l5">17. Keluar Tgl, Bln, Thn</div>
          <div class="col s12 m7 l7">: {{ ($data->pekerjaan_wali) ? $data->pekerjaan_wali : '-' }}</div>
          <div class="col s12 m5 l5">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Nomor Surat</div>
          <div class="col s12 m7 l7">: {{ ($data->pekerjaan_wali) ? $data->pekerjaan_wali : '-' }}</div>
          <div class="col s12 m5 l5">18. Lulus Tgl, Bln, Thn</div>
          <div class="col s12 m7 l7">: {{ ($data->tgl_ijazah_lulus) ? Carbon::createFromFormat('Y-m-d', $data->tgl_ijazah_lulus)->format('d-m-Y') : '-' }}</div>
          <div class="col s12 m5 l5">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Nomor STTB</div>
          <div class="col s12 m7 l7">: {{ ($data->no_ijazah_lulus) ? $data->no_ijazah_lulus : '-' }}</div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- End content of page -->

@endsection
