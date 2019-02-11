@extends('semaya.layouts.pdf')

@section('content')

    <!-- Start content of page -->
              <h1 class="text-center">
                Keterangan Tentang Diri Siswa
              </h1>
            <div class="row">
              <div class="col-5">1. Nama Lengkap</div>
              <div class="col-7">: {{ ($data->nama_lengkap) ? $data->nama_lengkap : '-' }}</div>
              <div class="col-5">2. NIS / NISN</div>
              <div class="col-7">: {{ ($data->nis) ? $data->nis : '-' }} / {{ ($data->nisn) ? $data->nisn : '-' }}</div>
              <div class="col-5">3. Jenis Kelamin</div>
              <div class="col-7">: {{ ($data->kelamin) ? $data->kelamin : '-' }}</div>
              <div class="col-5">4. Tempat dan Tanggal Lahir</div>
              <div class="col-7">: {{ ($data->tempat_lahir) ? $data->tempat_lahir : '-' }}, {{ ($data->tgl_lahir) ? Carbon::createFromFormat('Y-m-d', $data->tgl_lahir)->format('d-m-Y') : '-' }}</div>
              <div class="col-5">5. Agama</div>
              <div class="col-7">: {{ ($data->agama) ? $data->agama : '-' }}</div>
              <div class="col-5">6. Alamat Siswa</div>
              <div class="col-7">: {{ ($data->alamat) ? $data->alamat : '-' }}</div>
              <div class="col-5">7. Telp</div>
              <div class="col-7">: {{ ($data->no_telp) ? $data->no_telp : '-' }}</div>
              <div class="col-12">8. Sekolah Asal</div>
              {{-- @for ($i=0; $i < 4; $i++)&nbsp;@endfor  --}}
              <div class="col-5">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;a. Nama Sekolah</div>
              <div class="col-7">: {{ ($data->tamat_dari) ? $data->tamat_dari : '-' }}</div>
              <div class="col-5">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;b. Alamat</div>
              {{-- <div class="col-7">: {{ ($data->no_telp) ? $data->no_telp : '-' }}</div>  --}}
              <div class="col-12">9. Surat Tanda Tamat Belajar (STTB)</div>
              <div class="col-5">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;a. Tahun</div>
              <div class="col-7">: {{ ($data->tgl_ijazah) ? Carbon::createFromFormat('Y-m-d', $data->tgl_ijazah)->format('Y') : '-' }}</div>
              <div class="col-5">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;b. Nomor</div>
              <div class="col-7">: {{ ($data->no_ijazah) ? $data->no_ijazah : '-' }}</div>
              <div class="col-12">10. Diterima Di Sekolah Ini</div>
              <div class="col-5">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;a. Ditingkat / Kelas</div>
              <div class="col-7">: {{ ($data->kelas_siswa) ? $data->kelas_siswa->kelas->tingkat->nama_tingkat : '-' }}</div>
              <div class="col-5">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;b. Pada Tanggal, Bulan dan Tahun</div>
              <div class="col-7">: {{ ($data->no_telp) ? $data->no_telp : '-' }}</div>
              <div class="col-12">11. Nama Orang Tua</div>
              <div class="col-5">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;a. Ayah</div>
              <div class="col-7">: {{ ($data->nama_ayah) ? $data->nama_ayah : '-' }}</div>
              <div class="col-5">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;b. Ibu</div>
              <div class="col-7">: {{ ($data->nama_ibu) ? $data->nama_ibu : '-' }}</div>
              <div class="col-12">12. Alamat Orang Tua</div>
              <div class="col-5">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;a. Ayah</div>
              <div class="col-7">: {{ ($data->alamat_ayah) ? $data->alamat_ayah : '-' }}</div>
              <div class="col-5">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;b. Ibu</div>
              <div class="col-7">: {{ ($data->alamat_ibu) ? $data->alamat_ibu : '-' }}</div>
              <div class="col-12">13. Pekerjaan Orang Tua</div>
              <div class="col-5">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;a. Ayah</div>
              <div class="col-7">: {{ ($data->pekerjaan_ayah) ? $data->pekerjaan_ayah : '-' }}</div>
              <div class="col-5">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;b. Ibu</div>
              <div class="col-7">: {{ ($data->pekerjaan_ibu) ? $data->pekerjaan_ibu : '-' }}</div>
              <div class="col-5">14. Nama Wali</div>
              <div class="col-7">: {{ ($data->nama_wali) ? $data->nama_wali : '-' }}</div>
              <div class="col-5">15. Alamat Wali Wali</div>
              <div class="col-7">: {{ ($data->alamat_wali) ? $data->alamat_wali : '-' }}</div>
              <div class="col-5">16. Pekerjaan Wali Wali</div>
              <div class="col-7">: {{ ($data->pekerjaan_wali) ? $data->pekerjaan_wali : '-' }}</div>
              <div class="col-5">17. Keluar Tgl, Bln, Thn</div>
              <div class="col-7">: {{ ($data->pekerjaan_wali) ? $data->pekerjaan_wali : '-' }}</div>
              <div class="col-5">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Nomor Surat</div>
              <div class="col-7">: {{ ($data->pekerjaan_wali) ? $data->pekerjaan_wali : '-' }}</div>
              <div class="col-5">18. Lulus Tgl, Bln, Thn</div>
              <div class="col-7">: {{ ($data->tgl_ijazah_lulus) ? Carbon::createFromFormat('Y-m-d', $data->tgl_ijazah_lulus)->format('d-m-Y') : '-' }}</div>
              <div class="col-5">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Nomor STTB</div>
              <div class="col-7">: {{ ($data->no_ijazah_lulus) ? $data->no_ijazah_lulus : '-' }}</div>
            </div>
    <!-- End content of page -->

@endsection
