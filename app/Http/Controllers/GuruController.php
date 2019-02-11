<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Sekolah;
use App\Guru;
use App\GuruPelajaran;
use App\Pelajaran;
use App\Provinsi;
use App\Kota;
use App\Kecamatan;
use App\Kelurahan;
use App\User;
use App\RoleUser;
use Carbon\Carbon;
use Auth;
use App\Http\Controllers\ExcelController as ExcelHelper;
use Excel;
use PDF;

class GuruController extends Controller
{
    public function __construct()
    {
      $this->excelHelper = new ExcelHelper;
    }

    public function index()
    {
      $guru = Guru::orderBy('nama')->paginate(10);
      $no = $guru->firstItem();
      return view('semaya.master.guru.index', ['data' => $guru, 'no' => $no, 'q' => '']);
    }

    public function create()
    {
      $agama = [
        ['id' => 1, 'agama' =>'Islam'],
        ['id' => 2, 'agama' =>'Katolik'],
        ['id' => 3, 'agama' =>'Protestan'],
        ['id' => 4, 'agama' =>'Hindu'],
        ['id' => 5, 'agama' =>'Budha'],
        ['id' => 6, 'agama' =>'Konghucu'],
      ];
      $pelajaran = Pelajaran::orderBy('jenis_pelajaran_id')->get();
      $sekolah = Sekolah::orderBy('nama_sekolah')->get();
      $provinsi = Provinsi::orderBy('nama_provinsi')->get();
      return view('semaya.master.guru.create.index', ['agama' => $agama, 'pelajaran' => $pelajaran, 'provinsi' => $provinsi, 'sekolah' => $sekolah]);
    }

    public function store(Request $r)
    {
      $message = [
        'sekolah.required'  => 'Sekolah harus diisi!',
        'nuptk.required'  => 'NUPTK harus diisi!',
        'no_ktp.required'  => 'No. KTP harus diisi!',
        'nama.required'  => 'Nama harus diisi!',
        'kelamin.required'  => 'Jenis kelamin harus diisi!',
        'tempat_lahir.required'  => 'Tempat lahir harus diisi!',
        'tgl_lahir.required'  => 'Tanggal lahir harus diisi!',
        'agama.required'  => 'Agama harus diisi!',
        'alamat.required'  => 'Alamat harus diisi!',
        'status_kawin.required'  => 'Status kawin harus diisi!',
        'nuptk.numeric'  => 'NUPTK harus berupa angka!',
        'nip.numeric'  => 'NIP harus berupa angka!',
        'no_ktp.numeric'  => 'No. KTP harus berupa angka!',
        'no_hp.numeric'  => 'No. HP harus berupa angka!',
        'rt.numeric'  => 'RT harus berupa angka!',
        'rw.numeric'  => 'RW harus berupa angka!',
        'kode_pos.numeric'  => 'Kode pos harus berupa angka!',
        'email.email'  => 'Format email harus benar!',
      ];

      $this->validate($r, [
        // 'sekolah'  => 'required',
        'nuptk'  => 'required|numeric',
        'nip'  => 'nullable|numeric',
        'no_ktp'  => 'required|numeric',
        'nama'  => 'required',
        'kelamin'  => 'required',
        'tempat_lahir'  => 'required',
        'tgl_lahir'  => 'required',
        'agama'  => 'required',
        'alamat'  => 'required',
        'status_kawin'  => 'required',
        'email'  => 'nullable|email',
        'no_hp'  => 'nullable|numeric',
        'rt'  => 'nullable|numeric',
        'rw'  => 'nullable|numeric',
        'kode_pos'  => 'nullable|numeric',
      ], $message);

      //Start teacher number formatting
      $sekolah_id = Auth::user()->sekolah_id;
      $get_teacher = Guru::all();

      if ($sekolah_id > 9) {
        $first_letter = '2'.$sekolah_id;
      }
      else {
        $first_letter = '20'.$sekolah_id;
      }

      if (count($get_teacher) > 0) {
        $calculate_second_letter = count($get_teacher) + 1;
        if ($calculate_second_letter > 999) {
          $second_letter = $calculate_second_letter;
        }
        elseif ($calculate_second_letter > 99) {
          $second_letter = '0'.$calculate_second_letter;
        }
        elseif ($calculate_second_letter > 9) {
          $second_letter = '00'.$calculate_second_letter;
        }
        elseif ($calculate_second_letter < 10 && $calculate_second_letter > 0) {
          $second_letter = '000'.$calculate_second_letter;
        }
      }
      else {
        $second_letter = '0001';
      }

      $final_teacher_number = $first_letter.$second_letter;
      //End teacher number formatting

      $pin = str_replace('/', '', $r->input('tgl_lahir'));
      $guru = new Guru;
      $guru->nip = $r->input('nip');
      $guru->nuptk = $r->input('nuptk');
      $guru->no_ktp = $r->input('no_ktp');
      $guru->gelar_depan = $r->input('gelar_depan');
      $guru->nama = $r->input('nama');
      $guru->gelar_belakang = $r->input('gelar_belakang');
      $guru->kelamin = $r->input('kelamin');
      $guru->tempat_lahir = $r->input('tempat_lahir');
      $guru->tgl_lahir = Carbon::createFromFormat('d/m/Y', $r->input('tgl_lahir'))->toDateString();
      $guru->agama = $r->input('agama');
      $guru->alamat = $r->input('alamat');
      $guru->rt = $r->input('rt');
      $guru->rw = $r->input('rw');
      $guru->kelurahan = $r->input('kelurahan');
      $guru->kecamatan = $r->input('kecamatan');
      $guru->kota = $r->input('kota');
      $guru->provinsi = $r->input('provinsi');
      $guru->kode_pos = $r->input('kode_pos');
      $guru->status_kawin = $r->input('status_kawin');
      $guru->no_hp = $r->input('no_hp');
      $guru->email = $r->input('email');
      $guru->nama_ibu = $r->input('nama_ibu');
      $guru->nomor_kartu = $final_teacher_number;
      $guru->pin = $pin;
      $guru->foto = 'avatar.jpg';
      $guru->status = 1;
      $guru->save();

      $guru = Guru::whereNoKtp($r->input('no_ktp'))->first();
      if ($r->input('pelajaran') != null) {
        $pelajaran = new GuruPelajaran;
        $pelajaran->pelajaran_id = $r->input('pelajaran');
        $pelajaran->guru_id = $guru->id;
        $pelajaran->save();
      }

      $user = new User;
      $user->username = $guru->nomor_kartu;
      $user->password = bcrypt($pin);
      $user->sekolah_id = Auth::user()->sekolah_id;
      $user->save();

      $role_user = new RoleUser;
      $role_user->user_id = $user->id;
      $role_user->role_id = 4;
      $role_user->save();

      session(['id_guru' => $guru->id]);
      return redirect()->route('guru_create_education');
    }

    public function create_education()
    {
      if (session("id_guru") == "") {
        return redirect()->route('guru_index')->with('message', 'Tambahkan guru dari awal!');
      }
      return view('semaya.master.guru.create.education');
    }

    public function store_education(Request $r)
    {
      $r['gaji_pokok'] = str_replace('.', '', $r->input('gaji_pokok'));
      $id_guru = $r->input('id_guru');
      $guru = Guru::find($id_guru);
      $guru->pend_akhir = $r->input('pend_akhir');
      if ($r->input('tgl_lulus_pend_akhir') != null) {
        $guru->tgl_lulus_pend_akhir = Carbon::createFromFormat('d/m/Y', $r->input('tgl_lulus_pend_akhir'))->toDateString();
      } else {
        $guru->tgl_lulus_pend_akhir = null;
      }
      $guru->jurusan_pend_akhir = $r->input('jurusan_pend_akhir');
      $guru->lembaga_pend_akhir = $r->input('lembaga_pend_akhir');
      $guru->status_kepegawaian = $r->input('status_kepegawaian');
      if ($r->input('tmt_cpns') != null) {
        $guru->tmt_cpns = Carbon::createFromFormat('d/m/Y', $r->input('tmt_cpns'))->toDateString();
      } else {
        $guru->tmt_cpns = null;
      }
      if ($r->input('tmt_pns') != null) {
        $guru->tmt_pns = Carbon::createFromFormat('d/m/Y', $r->input('tmt_pns'))->toDateString();
      } else {
        $guru->tmt_pns = null;
      }
      if ($r->input('tmt_inpassing_nonpns') != null) {
        $guru->tmt_inpassing_nonpns = Carbon::createFromFormat('d/m/Y', $r->input('tmt_inpassing_nonpns'))->toDateString();
      } else {
        $guru->tmt_inpassing_nonpns = null;
      }
      $guru->no_sk_inpassing_nonpns = $r->input('no_sk_inpassing_nonpns');
      $guru->golongan = $r->input('golongan');
      if ($r->input('tmt_golongan') != null) {
        $guru->tmt_golongan = Carbon::createFromFormat('d/m/Y', $r->input('tmt_golongan'))->toDateString();
      } else {
        $guru->tmt_golongan = null;
      }
      $guru->masa_kerja_th = $r->input('masa_kerja_th');
      $guru->masa_kerja_bln = $r->input('masa_kerja_bln');
      $guru->gaji_pokok = $r->input('gaji_pokok');
      $guru->save();
      session(['id_guru' => $id_guru]);
      return redirect()->route('guru_create_experience');
    }

    public function create_experience()
    {
      if (session("id_guru") == "") {
        return redirect()->route('guru_index')->with('message', 'Tambahkan guru dari awal!');
      }
      return view('semaya.master.guru.create.experience');
    }

    public function store_experience(Request $r)
    {
      $id_guru = $r->input('id_guru');
      $guru = Guru::find($id_guru);
      $guru->bidang_studi_sertifikasi = $r->input('bidang_studi_sertifikasi');
      $guru->no_peserta_sertifikasi = $r->input('no_peserta_sertifikasi');
      if ($r->input('tgl_sertifikasi') != null) {
        $guru->tgl_sertifikasi = Carbon::createFromFormat('d/m/Y', $r->input('tgl_sertifikasi'))->toDateString();
      } else {
        $guru->tgl_sertifikasi = null;
      }
      $guru->lptk_penyelenggara_sertifikasi = $r->input('lptk_penyelenggara_sertifikasi');
      $guru->no_peserta_sertifikasi_konversi = $r->input('no_peserta_sertifikasi_konversi');
      $guru->nrg = $r->input('nrg');
      $guru->bidang_studi_sertifikasi2 = $r->input('bidang_studi_sertifikasi2');
      $guru->no_peserta_sertifikasi2 = $r->input('no_peserta_sertifikasi2');
      if ($r->input('tgl_sertifikasi2') != null) {
        $guru->tgl_sertifikasi2 = Carbon::createFromFormat('d/m/Y', $r->input('tgl_sertifikasi2'))->toDateString();
      } else {
        $guru->tgl_sertifikasi2 = null;
      }
      $guru->lptk_penyelenggara_sertifikasi2 = $r->input('lptk_penyelenggara_sertifikasi2');
      $guru->save();
      session(['id_guru' => $id_guru]);
      return redirect()->route('guru_create_status');
    }

    public function create_status()
    {
      if (session("id_guru") == "") {
        return redirect()->route('guru_index')->with('message', 'Tambahkan guru dari awal!');
      }
      return view('semaya.master.guru.create.status');
    }

    public function store_status(Request $r)
    {
      $id_guru = $r->input('id_guru');
      $guru = Guru::find($id_guru);
      $tugas_tambahan = $r->input('tugas_tambahan');

      $guru->status_guru = $r->input('status_guru');
      if ($r->input('tmt_guru_tetap') != null) {
        $guru->tmt_guru_tetap = Carbon::createFromFormat('d/m/Y', $r->input('tmt_guru_tetap'))->toDateString();
      } else {
        $guru->tmt_guru_tetap = null;
      }
      if ($r->input('tmt_guru_tidak_tetap') != null) {
        $guru->tmt_guru_tidak_tetap = Carbon::createFromFormat('d/m/Y', $r->input('tmt_guru_tidak_tetap'))->toDateString();
      } else {
        $guru->tmt_guru_tidak_tetap = null;
      }
      $guru->jenis_guru = $r->input('jenis_guru');
      if ($tugas_tambahan == "Lainnya") {
        $guru->tugas_tambahan = $r->input('tugas_lainnya');
      } else {
        $guru->tugas_tambahan = $r->input('tugas_tambahan');
      }
      $guru->save();
      session()->flush();
      return redirect()->route('guru_index');
    }

    public function edit($id)
    {
      $agama = [
        ['id' => 1, 'agama' =>'Islam'],
        ['id' => 2, 'agama' =>'Katolik'],
        ['id' => 3, 'agama' =>'Protestan'],
        ['id' => 4, 'agama' =>'Hindu'],
        ['id' => 5, 'agama' =>'Budha'],
        ['id' => 6, 'agama' =>'Konghucu'],
      ];
      $guru = Guru::find($id);
      $pelajaran = Pelajaran::orderBy('jenis_pelajaran_id')->get();
      $provinsi = Provinsi::orderBy('nama_provinsi')->get();
      $kota = Kota::whereProvinsiId($guru->provinsi)->orderBy('nama_kota')->get();
      $kecamatan = Kecamatan::whereKotaId($guru->kota)->orderBy('nama_kecamatan')->get();
      $kelurahan = Kelurahan::whereKecamatanId($guru->kecamatan)->orderBy('nama_kelurahan')->get();
      return view('semaya.master.guru.edit.index', ['data' => $guru, 'agama' => $agama, 'pelajaran' => $pelajaran, 'provinsi' => $provinsi, 'kota' => $kota, 'kecamatan' => $kecamatan, 'kelurahan' => $kelurahan]);
    }

    public function update(Request $r)
    {
      // dd($r->input('kelurahan'));
      $message = [
        'nuptk.required'  => 'NUPTK harus diisi!',
        'no_ktp.required'  => 'No. KTP harus diisi!',
        'nama.required'  => 'Nama harus diisi!',
        'kelamin.required'  => 'Jenis kelamin harus diisi!',
        'tempat_lahir.required'  => 'Tempat lahir harus diisi!',
        'tgl_lahir.required'  => 'Tanggal lahir harus diisi!',
        'agama.required'  => 'Agama harus diisi!',
        'alamat.required'  => 'Agama harus diisi!',
        'status_kawin.required'  => 'Status kawin harus diisi!',
        'nuptk.numeric'  => 'NUPTK harus berupa angka!',
        'nip.numeric'  => 'NIP harus berupa angka!',
        'no_ktp.numeric'  => 'No. KTP harus berupa angka!',
        'no_hp.numeric'  => 'No. HP harus berupa angka!',
        'rt.numeric'  => 'RT harus berupa angka!',
        'rw.numeric'  => 'RW harus berupa angka!',
        'kode_pos.numeric'  => 'Kode pos harus berupa angka!',
        'email.email'  => 'Format email harus benar!',
      ];

      $this->validate($r, [
        'nuptk'  => 'required|numeric',
        'nip'  => 'nullable|numeric',
        'no_ktp'  => 'required|numeric',
        'nama'  => 'required',
        'kelamin'  => 'required',
        'tempat_lahir'  => 'required',
        'tgl_lahir'  => 'required',
        'agama'  => 'required',
        'alamat'  => 'required',
        'status_kawin'  => 'required',
        'email'  => 'nullable|email',
        'no_hp'  => 'nullable|numeric',
        'rt'  => 'nullable|numeric',
        'rw'  => 'nullable|numeric',
        'kode_pos'  => 'nullable|numeric',
      ], $message);

      $tgl_lahir = Carbon::createFromFormat('d/m/Y', $r->input('tgl_lahir'))->toDateString();
      $pin = str_replace('/', '', $r->input('tgl_lahir'));
      $id_guru = $r->input('id_guru');
      $guru = Guru::find($id_guru);

      User::where('username', $guru->nomor_kartu)
          ->update([
            'password' => bcrypt($pin)
          ]);

      $pelajaran = GuruPelajaran::whereGuruId($id_guru)->first();
      $guru->nip = $r->input('nip');
      $guru->nuptk = $r->input('nuptk');
      $guru->no_ktp = $r->input('no_ktp');
      $guru->gelar_depan = $r->input('gelar_depan');
      $guru->nama = $r->input('nama');
      $guru->gelar_belakang = $r->input('gelar_belakang');
      $guru->kelamin = $r->input('kelamin');
      $guru->tempat_lahir = $r->input('tempat_lahir');
      $guru->tgl_lahir = $tgl_lahir;
      $guru->agama = $r->input('agama');
      $guru->alamat = $r->input('alamat');
      $guru->rt = $r->input('rt');
      $guru->rw = $r->input('rw');
      $guru->kelurahan = $r->input('kelurahan');
      $guru->kecamatan = $r->input('kecamatan');
      $guru->kota = $r->input('kota');
      $guru->provinsi = $r->input('provinsi');
      $guru->kode_pos = $r->input('kode_pos');
      $guru->status_kawin = $r->input('status_kawin');
      $guru->no_hp = $r->input('no_hp');
      $guru->email = $r->input('email');
      $guru->nama_ibu = $r->input('nama_ibu');
      $guru->pin = $pin;
      $guru->status = $r->input('status');
      if ($r->input('status') != 1) {
        $guru->tgl_non_aktif = Carbon::now();
      } else {
        $guru->tgl_non_aktif = null;
      }

      if ($r->input('foto') != "") {
        $imgName = 'img_'.time().'.'.$r->file('foto')->getClientOriginalExtension();
        $r->file('foto')->move(public_path('assets/img/users/guru'), $imgName);
        $guru->foto = $imgName;
      }
      $guru->save();

      if ($r->input('pelajaran') != null) {
        if (count($pelajaran) > 0) {
          $pelajaran->guru_id = $id_guru;
          $pelajaran->pelajaran_id = $r->input('pelajaran');
          $pelajaran->save();
        } elseif (count($pelajaran) == 0) {
          $pelajaran = new GuruPelajaran;
          $pelajaran->guru_id = $id_guru;
          $pelajaran->pelajaran_id = $r->input('pelajaran');
          $pelajaran->save();
        }
      } elseif ($r->input('pelajaran') == null) {
        if ($pelajaran != null) {
          $pelajaran->delete();
        }
      }

      return redirect()->route('guru_edit', ['id' => $id_guru])->with('message', 'Data berhasil diubah!');
    }

    public function edit_education($id)
    {
      $guru = Guru::find($id);
      return view('semaya.master.guru.edit.education', ['data' => $guru]);
    }

    public function update_education(Request $r)
    {
      $r['gaji_pokok'] = str_replace('.', '', $r->input('gaji_pokok'));
      $id_guru = $r->input('id_guru');
      $guru = Guru::find($id_guru);
      $guru->pend_akhir = $r->input('pend_akhir');
      if ($r->input('tgl_lulus_pend_akhir') != null) {
        $guru->tgl_lulus_pend_akhir = Carbon::createFromFormat('d/m/Y', $r->input('tgl_lulus_pend_akhir'))->toDateString();
      } else {
        $guru->tgl_lulus_pend_akhir = null;
      }
      $guru->jurusan_pend_akhir = $r->input('jurusan_pend_akhir');
      $guru->lembaga_pend_akhir = $r->input('lembaga_pend_akhir');
      $guru->status_kepegawaian = $r->input('status_kepegawaian');
      if ($r->input('tmt_cpns') != null) {
        $guru->tmt_cpns = Carbon::createFromFormat('d/m/Y', $r->input('tmt_cpns'))->toDateString();
      } else {
        $guru->tmt_cpns = null;
      }
      if ($r->input('tmt_pns') != null) {
        $guru->tmt_pns = Carbon::createFromFormat('d/m/Y', $r->input('tmt_pns'))->toDateString();
      } else {
        $guru->tmt_pns = null;
      }
      if ($r->input('tmt_inpassing_nonpns') != null) {
        $guru->tmt_inpassing_nonpns = Carbon::createFromFormat('d/m/Y', $r->input('tmt_inpassing_nonpns'))->toDateString();
      } else {
        $guru->tmt_inpassing_nonpns = null;
      }
      $guru->no_sk_inpassing_nonpns = $r->input('no_sk_inpassing_nonpns');
      $guru->golongan = $r->input('golongan');
      if ($r->input('tmt_golongan') != null) {
        $guru->tmt_golongan = Carbon::createFromFormat('d/m/Y', $r->input('tmt_golongan'))->toDateString();
      } else {
        $guru->tmt_golongan = null;
      }
      $guru->masa_kerja_th = $r->input('masa_kerja_th');
      $guru->masa_kerja_bln = $r->input('masa_kerja_bln');
      $guru->gaji_pokok = $r->input('gaji_pokok');
      $guru->save();
      return redirect()->route('guru_edit_education', ['id' => $id_guru])->with('message', 'Data berhasil diubah!');
    }

    public function edit_experience($id)
    {
      $guru = Guru::find($id);
      return view('semaya.master.guru.edit.experience', ['data' => $guru]);
    }

    public function update_experience(Request $r)
    {
      $id_guru = $r->input('id_guru');
      $guru = Guru::find($id_guru);
      $guru->bidang_studi_sertifikasi = $r->input('bidang_studi_sertifikasi');
      $guru->no_peserta_sertifikasi = $r->input('no_peserta_sertifikasi');
      if ($r->input('tgl_sertifikasi') != null) {
        $guru->tgl_sertifikasi = Carbon::createFromFormat('d/m/Y', $r->input('tgl_sertifikasi'))->toDateString();
      } else {
        $guru->tgl_sertifikasi = null;
      }
      $guru->lptk_penyelenggara_sertifikasi = $r->input('lptk_penyelenggara_sertifikasi');
      $guru->no_peserta_sertifikasi_konversi = $r->input('no_peserta_sertifikasi_konversi');
      $guru->nrg = $r->input('nrg');
      $guru->bidang_studi_sertifikasi2 = $r->input('bidang_studi_sertifikasi2');
      $guru->no_peserta_sertifikasi2 = $r->input('no_peserta_sertifikasi2');
      if ($r->input('tgl_sertifikasi2') != null) {
        $guru->tgl_sertifikasi2 = Carbon::createFromFormat('d/m/Y', $r->input('tgl_sertifikasi2'))->toDateString();
      } else {
        $guru->tgl_sertifikasi2 = null;
      }
      $guru->lptk_penyelenggara_sertifikasi2 = $r->input('lptk_penyelenggara_sertifikasi2');
      $guru->save();
      return redirect()->route('guru_edit_experience', ['id' => $id_guru])->with('message', 'Data berhasil diubah!');
    }

    public function edit_status($id)
    {
      $guru = Guru::find($id);
      return view('semaya.master.guru.edit.status', ['data' => $guru]);
    }

    public function update_status(Request $r)
    {
      $id_guru = $r->input('id_guru');
      $guru = Guru::find($id_guru);
      $tugas_tambahan = $r->input('tugas_tambahan');

      $guru->status_guru = $r->input('status_guru');
      if ($r->input('status_guru') == 1) {
        $guru->tmt_guru_tidak_tetap = null;
        if ($r->input('tmt_guru_tetap') != null) {
          $guru->tmt_guru_tetap = Carbon::createFromFormat('d/m/Y', $r->input('tmt_guru_tetap'))->toDateString();
        } else {
          $guru->tmt_guru_tetap = null;
        }
      } else if($r->input('status_guru') == 0) {
        $guru->tmt_guru_tetap = null;
        if ($r->input('tmt_guru_tidak_tetap') != null) {
          $guru->tmt_guru_tidak_tetap = Carbon::createFromFormat('d/m/Y', $r->input('tmt_guru_tidak_tetap'))->toDateString();
        } else {
          $guru->tmt_guru_tidak_tetap = null;
        }
      }
      $guru->jenis_guru = $r->input('jenis_guru');
      if ($tugas_tambahan == "Lainnya") {
        $guru->tugas_tambahan = $r->input('tugas_lainnya');
      } else {
        $guru->tugas_tambahan = $r->input('tugas_tambahan');
      }
      $guru->save();
      return redirect()->route('guru_edit_status', ['id' => $id_guru])->with('message', 'Data berhasil diubah!');
    }

    public function delete($id)
    {
      $guru = Guru::find($id);

      $user = User::where('username', $guru->nomor_kartu)->where('sekolah_id', Auth::user()->sekolah_id)->delete();

      $guru->delete();

      return redirect()->route('guru_index');
    }

    public function search(Request $r)
    {
      $q = $r->input('q');
      $guru = Guru::where('nama', 'like', '%' . $q . '%')->orderBy('nama')->paginate(10);
      $no = $guru->firstItem();
      return view('semaya.master.guru.index', ['data' => $guru, 'no' => $no, 'q' => $q]);
    }

    public function exportToPdf(Request $r)
    {
      $sekolah_id = Auth::user()->sekolah_id;
      $sekolah = Sekolah::find($sekolah_id);
      $guru = Guru::orderBy('nama')->get();
      $html = view('semaya.master.guru.pdf', ['data' => $guru, 'sekolah' => $sekolah]);
      $pdf = PDF::loadHTML($html)->setPaper('a4')->setOrientation('portrait');
      return $pdf->inline('Data Guru - '.Carbon::now()->format('Ymd').'.pdf');
    }

    public function exportToExcel(Request $r)
    {
      $excelHelper = $this->excelHelper;
      $format = $r->input('format');
      $excel_name_format = 'Ekspor Data Guru - '.Carbon::now();

      if ($format == 'pdf') {
        return $this->exportToPdf($r);
      }

      Excel::create($excel_name_format, function($excel) use($excelHelper){
          $guru = Guru::all();

          $excel->sheet('Guru', function ($sheet) use($guru, $excelHelper){

            $sheet->setColumnFormat([
              'A'=>'@',
              'B'=>'@',
              'C'=>'@',
              'AZ'=>'@',
              'BA'=>'@',
              // 'I'=>'yyyy-mm-dd',
              // 'X'=>'yyyy-mm-dd',
              // 'AM'=>'yyyy-mm-dd',
              // 'AS'=>'yyyy-mm-dd',
              // 'BA'=>'yyyy-mm-dd',
            ]);

            $sheet->row(1, $excelHelper->guruHeader());

            $sheet->row(1, function($row) {
              $row->setBackground('#3f51b5');
              $row->setFontColor('#ffffff');
              $row->setFontWeight('bold');
              $row->setFontSize(15);
            });

            $no = 2;
            foreach ($guru as $guru_value) {
              $num = $no++;
              $sheet->row($num, function($row) {
                $row->setFontSize(15);
              });

              $provinsi = Provinsi::find($guru_value->provinsi);
              $kota = Kota::find($guru_value->kota);
              $kecamatan = Kecamatan::find($guru_value->kecamatan);
              $kelurahan = Kelurahan::find($guru_value->kelurahan);

              if ($provinsi != null && $guru_value->provinsi != '') {
                $get_provinsi = $provinsi->name;
              }
              else {
                $get_provinsi = '';
              }

              if ($kota != null && $guru_value->kota != '') {
                $get_kota = $kota->name;
              }
              else {
                $get_kota = '';
              }

              if ($kecamatan != null && $guru_value->kecamatan != '') {
                $get_kecamatan = $kecamatan->name;
              }
              else {
                $get_kecamatan = '';
              }

              if ($kelurahan != null && $guru_value->kelurahan != '') {
                $get_kelurahan = $kelurahan->name;
              }
              else {
                $get_kelurahan = '';
              }

              if ($guru_value->status == 1) {
                $get_status = 'AKTIF';
              }
              else {
                $get_status = 'TIDAK AKTIF';
              }

              $sheet->row($num, [
                $guru_value->nip,
                $guru_value->nuptk,
                $guru_value->no_ktp,
                $guru_value->nama,
                $guru_value->gelar_depan,
                $guru_value->gelar_belakang,
                $guru_value->kelamin,
                $guru_value->tempat_lahir,
                $guru_value->tgl_lahir,
                $guru_value->agama,
                $guru_value->alamat,
                $guru_value->rt,
                $guru_value->rw,
                $get_kelurahan,
                $get_kecamatan,
                $get_kota,
                $get_provinsi,
                $guru_value->kode_pos,
                $guru_value->status_kawin,
                $guru_value->no_hp,
                $guru_value->email,
                $guru_value->nama_ibu,
                $guru_value->pend_akhir,
                $guru_value->tgl_lulus_pend_akhir,
                $guru_value->jurusan_pend_akhir,
                $guru_value->lembaga_pend_akhir,
                $guru_value->status_kepegawaian,
                $guru_value->tmt_cpns,
                $guru_value->tmt_pns,
                $guru_value->tmt_inpassing_nonpns,
                $guru_value->no_sk_inpassing_nonpns,
                $guru_value->golongan,
                $guru_value->tmt_golongan,
                $guru_value->masa_kerja_th,
                $guru_value->masa_kerja_bln,
                $guru_value->gaji_pokok,
                $guru_value->bidang_studi_sertifikasi,
                $guru_value->no_peserta_sertifikasi,
                $guru_value->tgl_sertifikasi,
                $guru_value->lptk_penyelenggara_sertifikasi,
                $guru_value->no_peserta_sertifikasi_konversi,
                $guru_value->nrg,
                $guru_value->bidang_studi_sertifikasi2,
                $guru_value->no_peserta_sertifikasi2,
                $guru_value->tgl_sertifikasi2,
                $guru_value->lptk_penyelenggara_sertifikasi2,
                $guru_value->status_guru,
                $guru_value->tmt_guru_tidak_tetap,
                $guru_value->tmt_guru_tetap,
                $guru_value->jenis_guru,
                $guru_value->tugas_tambahan,
                (string) $guru_value->nomor_kartu,
                (string) $guru_value->pin,
                $get_status,
                $guru_value->tgl_non_aktif,
              ]);
            }
          });
      })->export($format);
    }

    public function importFromExcel(Request $r)
    {
      $excel_file = $r->file('excel_file');

      $ext = $excel_file->getClientOriginalExtension();
      $file_name = 'excel_'.round(microtime(true)).'.'.$ext;

      $excel_file->move('assets/excel', $file_name);

      $message = [];

      Excel::load('assets/excel/'.$file_name, function($reader) {
        $reader->each(function($sheet) {
          $sheet->each(function($row) {
            // dd($row);
            $provinsi = Provinsi::where('nama_provinsi', 'like', '%'.$row->provinsi.'%')->first();
            $kota = Kota::where('nama_kota', 'like', '%'.$row->kota.'%')->first();
            $kecamatan = Kecamatan::where('nama_kecamatan', 'like', '%'.$row->kecamatan.'%')->first();
            $kelurahan = Kelurahan::where('nama_kelurahan', 'like', '%'.$row->kelurahan.'%')->first();

            if ($provinsi != null && $row->provinsi != '') {
              $get_provinsi = $provinsi->id;
            }
            else {
              $get_provinsi = NULL;
            }

            if ($kota != null && $row->kota != '') {
              $get_kota = $kota->id;
            }
            else {
              $get_kota = NULL;
            }

            if ($kecamatan != null && $row->kecamatan != '') {
              $get_kecamatan = $kecamatan->id;
            }
            else {
              $get_kecamatan = NULL;
            }

            if ($kelurahan != null && $row->kelurahan != '') {
              $get_kelurahan = $kelurahan->id;
            }
            else {
              $get_kelurahan = NULL;
            }

            //Start teacher number formatting
            $sekolah_id = Auth::user()->sekolah_id;
            $get_teacher = Guru::all();

            if ($sekolah_id > 9) {
              $first_letter = '2'.$sekolah_id;
            }
            else {
              $first_letter = '20'.$sekolah_id;
            }

            if (count($get_teacher) > 0) {
              $calculate_second_letter = count($get_teacher) + 1;
              if ($calculate_second_letter > 999) {
                $second_letter = $calculate_second_letter;
              }
              elseif ($calculate_second_letter > 99) {
                $second_letter = '0'.$calculate_second_letter;
              }
              elseif ($calculate_second_letter > 9) {
                $second_letter = '00'.$calculate_second_letter;
              }
              elseif ($calculate_second_letter < 10 && $calculate_second_letter > 0) {
                $second_letter = '000'.$calculate_second_letter;
              }
            }
            else {
              $second_letter = '0001';
            }

            $final_teacher_number = $first_letter.$second_letter;
            //End teacher number formatting

            $nama = $row->nama;
            $tgl_lahir = date_format(date_create($row->tgl_lahir), 'Y-m-d');

            if ($nama != '' && $row->tgl_lahir != '') {
              $guru = new Guru;
              $guru->nip = $row->nip;
              $guru->nuptk = $row->nuptk;
              $guru->no_ktp = $row->no_ktp;
              $guru->nama = $nama;
              $guru->gelar_depan = $row->gelar_depan;
              $guru->gelar_belakang = $row->gelar_belakang;
              $guru->kelamin = $row->kelamin;
              $guru->tempat_lahir = $row->tempat_lahir;
              $guru->tgl_lahir = $tgl_lahir;
              $guru->agama = $row->agama;
              $guru->alamat = $row->alamat;
              $guru->rt = $row->rt;
              $guru->rw = $row->rw;
              $guru->kelurahan = $get_kelurahan;
              $guru->kecamatan = $get_kecamatan;
              $guru->kota = $get_kota;
              $guru->provinsi = $get_provinsi;
              $guru->kode_pos = $row->kode_pos;
              $guru->status_kawin = $row->status_kawin;
              $guru->no_hp = $row->no_hp;
              $guru->email = $row->email;
              $guru->nama_ibu = $row->nip;
              $guru->pend_akhir = $row->pend_akhir;
              $guru->tgl_lulus_pend_akhir = date_format(date_create($row->tgl_lulus_pend_akhir), 'Y-m-d');
              $guru->jurusan_pend_akhir = $row->jurusan_pend_akhir;
              $guru->lembaga_pend_akhir = $row->lembaga_pend_akhir;
              $guru->status_kepegawaian = $row->status_kepegawaian;
              $guru->tmt_cpns = $row->tmt_cpns;
              $guru->tmt_pns = $row->tmt_pns;
              $guru->tmt_inpassing_nonpns = $row->tmt_inpassing_nonpns;
              $guru->no_sk_inpassing_nonpns = $row->no_sk_inpassing_nonpns;
              $guru->golongan = $row->golongan;
              $guru->tmt_golongan = $row->tmt_golongan;
              $guru->masa_kerja_th = $row->masa_kerja_th;
              $guru->masa_kerja_bln = $row->masa_kerja_bln;
              $guru->gaji_pokok = $row->gaji_pokok;
              $guru->bidang_studi_sertifikasi = $row->bidang_studi_sertifikasi;
              $guru->no_peserta_sertifikasi = $row->no_peserta_sertifikasi;
              $guru->tgl_sertifikasi = $row->tgl_sertifikasi;
              $guru->lptk_penyelenggara_sertifikasi = $row->lptk_penyelenggara_sertifikasi;
              $guru->no_peserta_sertifikasi_konversi = $row->no_peserta_sertifikasi_konversi;
              $guru->nrg = $row->nrg;
              $guru->bidang_studi_sertifikasi2 = $row->bidang_studi_sertifikasi2;
              $guru->no_peserta_sertifikasi2 = $row->no_peserta_sertifikasi2;
              $guru->tgl_sertifikasi2 = $row->tgl_sertifikasi2;
              $guru->lptk_penyelenggara_sertifikasi2 = $row->lptk_penyelenggara_sertifikasi2;
              $guru->status_guru = $row->status_guru;
              $guru->tmt_guru_tidak_tetap = $row->tmt_guru_tidak_tetap;
              $guru->tmt_guru_tetap = $row->tmt_guru_tetap;
              $guru->jenis_guru = $row->jenis_guru;
              $guru->tugas_tambahan = $row->tugas_tambahan;
              if ($row->tgl_non_aktif != '') {
                $guru->status = 0;
              }
              else {
                $guru->status = 1;
              }
              $guru->tgl_non_aktif = $row->tgl_non_aktif;
              $guru->nomor_kartu = $final_teacher_number;
              $guru->pin = Carbon::createFromFormat('Y-m-d', $tgl_lahir)->format('dmY');
              $guru->foto = 'avatar.jpg';
              $guru->save();

              $user = new User;
              $user->username = $guru->nomor_kartu;
              $user->password = bcrypt($guru->pin);
              $user->sekolah_id = Auth::user()->sekolah_id;
              $user->save();

              $role_user = new RoleUser;
              $role_user->user_id = $user->id;
              $role_user->role_id = 4;
              $role_user->save();
            }
          });
        });
      });

      return redirect()->route('guru_index')->with('message', 'Guru berhasil diimpor.');
    }

    public function data_ujian(Request $r)
    {
      $sekolah_id = Auth::user()->sekolah_id;
      $sekolah = Sekolah::find($sekolah_id);
      $guru = Guru::orderBy('nama')->get();
      $format = $r->input('format');
      $no = 1;

      if ($format == 'pdf') {
        $html = view('semaya.master.guru.data_ujian.pdf', ['data' => $guru, 'sekolah' => $sekolah]);
        $pdf = PDF::loadHTML($html)->setPaper('a4')->setOrientation('portrait');
        return $pdf->inline('LAPORAN_DATA_UJIAN_GURU_'.Carbon::now()->format('Ymd').'.pdf');
      } else {
        Excel::create('LAPORAN_DATA_UJIAN_GURU', function ($excel) use($guru, $no){
          $excel->sheet('LAPORAN DATA UJIAN', function ($sheet) use($guru, $no){
            $sheet->setAutoSize(true);
            $start_from = 2;

            //Start First Row Settings
            $sheet->cell('A1', function ($cell) {
              $cell->setValue('No');
            });
            $sheet->cell('B1', function ($cell) {
              $cell->setValue('Nama Lengkap');
            });
            $sheet->cell('C1', function ($cell) {
              $cell->setValue('Nama Pengguna');
            });
            $sheet->cell('D1', function ($cell) {
              $cell->setValue('Kata Sandi');
            });

            foreach ($guru as $value) {
              $sheet->appendRow($start_from++, [
                $no++,
                $value->nama,
                $value->nomor_kartu,
                $value->pin,
              ]);
            }
            $last_row = $start_from - 1;
            $sheet->setBorder('A1:D'.$last_row, 'thin');
          });
        })->export($format);
      }
    }

    public function excelSample()
    {
      $excelHelper = $this->excelHelper;
      $guru_header = $excelHelper->guruHeader();
      $excel_name_format = 'Contoh Data Guru - '.Carbon::now();

      foreach ($guru_header as $key => $value) {
        if ($value == 'NOMOR_KARTU' || $value == 'PIN') {
          unset($guru_header[$key]);
        }
      }

      // dd($guru_header);

      Excel::create($excel_name_format, function($excel) use($guru_header){

        $excel->sheet('Sheet 1', function ($sheet) use($guru_header){

          $sheet->setColumnFormat([
            'A'=>'@',
            'B'=>'@',
            'C'=>'@',
            // 'I'=>'yyyy-mm-dd',
            // 'X'=>'yyyy-mm-dd',
            // 'AM'=>'yyyy-mm-dd',
            // 'AS'=>'yyyy-mm-dd',
            // 'BA'=>'yyyy-mm-dd',
          ]);

          $sheet->row(1, $guru_header);

          $sheet->row(1, function($row) {
            $row->setBackground('#3f51b5');
            $row->setFontColor('#ffffff');
            $row->setFontWeight('bold');
            $row->setFontSize(15);
          });

          $sheet->row(2, function($row) {
            $row->setFontSize(15);
          });
          $sheet->row(3, function($row) {
            $row->setFontSize(15);
          });

          $sheet->cell('D1', function($cell) {
            $cell->setBackground('#E53935');
          });
          $sheet->cell('D2', function($cell) {
            $cell->setValue('Revando');
          });
          $sheet->cell('D3', function($cell) {
            $cell->setValue('Ichsan Firdaus');
          });

          $sheet->cell('I1', function($cell) {
            $cell->setBackground('#E53935');
          });
          $sheet->cell('I2', function($cell) {
            $cell->setValue('1999-05-19');
          });
          $sheet->cell('I3', function($cell) {
            $cell->setValue('1999-02-20');
          });
          $sheet->cell('AZ3', function($cell) {
            $cell->setValue('TIDAK AKTIF');
          });
          $sheet->cell('BA3', function($cell) {
            $cell->setValue('2017-05-19');
          });
        });
      })->export('xls');
    }
}
