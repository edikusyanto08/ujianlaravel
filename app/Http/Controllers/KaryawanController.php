<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Sekolah;
use App\Karyawan;
use App\Provinsi;
use App\Kota;
use App\Kecamatan;
use App\Kelurahan;
use Carbon\Carbon;
use Auth;
use Excel;
use App\Http\Controllers\ExcelController as ExcelHelper;
use PDF;

class KaryawanController extends Controller
{
    public function __construct()
    {
      $this->excelHelper = new ExcelHelper;
    }
    public function index()
    {
      $karyawan = Karyawan::orderBy('nama')->paginate(10);
      $no = $karyawan->firstItem();
      return view('semaya.master.karyawan.index', ['data' => $karyawan, 'no' => $no, 'q' => '']);
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
      $sekolah = Sekolah::orderBy('nama_sekolah')->get();
      $provinsi = Provinsi::orderBy('nama_provinsi')->get();
      return view('semaya.master.karyawan.create.index', ['agama' => $agama, 'provinsi' => $provinsi, 'sekolah' => $sekolah]);
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

      //Start employee number formatting
      $sekolah_id = Auth::user()->sekolah_id;
      $get_employee = Karyawan::all();

      if ($sekolah_id > 9) {
        $first_letter = '3'.$sekolah_id;
      }
      else {
        $first_letter = '30'.$sekolah_id;
      }

      if (count($get_employee) > 0) {
        $calculate_second_letter = count($get_employee) + 1;
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

      $final_employee_number = $first_letter.$second_letter;
      //End employee number formatting

      $pin = str_replace('/', '', $r->input('tgl_lahir'));
      $karyawan = new Karyawan;
      $karyawan->nip = $r->input('nip');
      $karyawan->nuptk = $r->input('nuptk');
      $karyawan->no_ktp = $r->input('no_ktp');
      $karyawan->gelar_depan = $r->input('gelar_depan');
      $karyawan->nama = $r->input('nama');
      $karyawan->gelar_belakang = $r->input('gelar_belakang');
      $karyawan->kelamin = $r->input('kelamin');
      $karyawan->tempat_lahir = $r->input('tempat_lahir');
      $karyawan->tgl_lahir = Carbon::createFromFormat('d/m/Y', $r->input('tgl_lahir'))->toDateString();
      $karyawan->agama = $r->input('agama');
      $karyawan->alamat = $r->input('alamat');
      $karyawan->rt = $r->input('rt');
      $karyawan->rw = $r->input('rw');
      $karyawan->Kelurahan = $r->input('kelurahan');
      $karyawan->kecamatan = $r->input('kecamatan');
      $karyawan->kota = $r->input('kota');
      $karyawan->provinsi = $r->input('provinsi');
      $karyawan->kode_pos = $r->input('kode_pos');
      $karyawan->status_kawin = $r->input('status_kawin');
      $karyawan->no_hp = $r->input('no_hp');
      $karyawan->email = $r->input('email');
      $karyawan->nama_ibu = $r->input('nama_ibu');
      $karyawan->nomor_kartu = $final_employee_number;
      $karyawan->pin = $pin;
      $karyawan->foto = 'avatar.jpg';
      $karyawan->status = 1;
      $karyawan->save();

      $karyawan = Karyawan::whereNoKtp($r->input('no_ktp'))->first();
      session(['id_karyawan' => $karyawan->id]);
      return redirect()->route('karyawan_create_education');
    }

    public function create_education()
    {
      if (session("id_karyawan") == "") {
        return redirect()->route('karyawan_index')->with('message', 'Tambahkan karyawan dari awal!');
      }
      return view('semaya.master.karyawan.create.education');
    }

    public function store_education(Request $r)
    {
      $r['gaji_pokok'] = str_replace('.', '', $r->input('gaji_pokok'));
      $id_karyawan = $r->input('id_karyawan');
      $karyawan = Karyawan::find($id_karyawan);
      $karyawan->pend_akhir = $r->input('pend_akhir');
      if ($r->input('tgl_lulus_pend_akhir') != null) {
        $karyawan->tgl_lulus_pend_akhir = Carbon::createFromFormat('d/m/Y', $r->input('tgl_lulus_pend_akhir'))->toDateString();
      } else {
        $karyawan->tgl_lulus_pend_akhir = null;
      }
      $karyawan->jurusan_pend_akhir = $r->input('jurusan_pend_akhir');
      $karyawan->lembaga_pend_akhir = $r->input('lembaga_pend_akhir');
      if ($r->input('tmt_cpns') != null) {
        $karyawan->tmt_cpns = Carbon::createFromFormat('d/m/Y', $r->input('tmt_cpns'))->toDateString();
      } else {
        $karyawan->tmt_cpns = null;
      }
      $karyawan->no_sk_cpns = $r->input('no_sk_cpns');
      if ($r->input('tmt_pns') != null) {
        $karyawan->tmt_pns = Carbon::createFromFormat('d/m/Y', $r->input('tmt_pns'))->toDateString();
      } else {
        $karyawan->tmt_pns = null;
      }
      $karyawan->no_sk_pns = $r->input('no_sk_pns');
      $karyawan->status_kepegawaian = $r->input('status_kepegawaian');
      $karyawan->golongan = $r->input('golongan');
      if ($r->input('tmt_golongan') != null) {
        $karyawan->tmt_golongan = Carbon::createFromFormat('d/m/Y', $r->input('tmt_golongan'))->toDateString();
      } else {
        $karyawan->tmt_golongan = null;
      }
      $karyawan->no_sk_golongan_akhir = $r->input('no_sk_golongan_akhir');
      $karyawan->masa_kerja_th = $r->input('masa_kerja_th');
      $karyawan->masa_kerja_bln = $r->input('masa_kerja_bln');
      $karyawan->gaji_pokok = $r->input('gaji_pokok');
      $karyawan->save();
      session(['id_karyawan' => $id_karyawan]);
      return redirect()->route('karyawan_create_status');
    }

    public function create_status()
    {
      if (session("id_karyawan") == "") {
        return redirect()->route('karyawan_index')->with('message', 'Tambahkan karyawan dari awal!');
      }
      return view('semaya.master.karyawan.create.status');
    }

    public function store_status(Request $r)
    {
      $message = [
        'status_karyawan.required'  => 'Status karyawan harus diisi!',
        'tmt_karyawan.required'  => 'TMT karyawan harus diisi!',
        'jabatan_karyawan.required'  => 'Jabatan karyawan harus diisi!',
      ];

      $this->validate($r, [
        'status_karyawan'  => 'required',
        'tmt_karyawan'  => 'required',
        'jabatan_karyawan'  => 'required',
      ], $message);

      $id_karyawan = $r->input('id_karyawan');
      $karyawan = Karyawan::find($id_karyawan);
      $jabatan = $r->input('jabatan_karyawan');

      $karyawan->status_karyawan = $r->input('status_karyawan');
      if ($r->input('tmt_karyawan') != null) {
        $karyawan->tmt_karyawan = Carbon::createFromFormat('d/m/Y', $r->input('tmt_karyawan'))->toDateString();
      } else {
        $karyawan->tmt_karyawan = null;
      }
      $karyawan->no_sk_pengangkatan = $r->input('no_sk_pengangkatan');
      if ($jabatan == "Lainnya") {
        $karyawan->jabatan_karyawan = $r->input('jabatan_lainnya');
      } else {
        $karyawan->jabatan_karyawan = $r->input('jabatan_karyawan');
      }
      $karyawan->save();
      session()->flush();
      return redirect()->route('karyawan_index');
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
      $karyawan = Karyawan::find($id);
      $provinsi = Provinsi::orderBy('nama_provinsi')->get();
      $kota = Kota::whereProvinsiId($karyawan->provinsi)->orderBy('nama_kota')->get();
      $kecamatan = Kecamatan::whereKotaId($karyawan->kota)->orderBy('nama_kecamatan')->get();
      $kelurahan = Kelurahan::whereKecamatanId($karyawan->kecamatan)->orderBy('nama_kelurahan')->get();
      return view('semaya.master.karyawan.edit.index', ['data' => $karyawan, 'agama' => $agama, 'provinsi' => $provinsi, 'kota' => $kota, 'kecamatan' => $kecamatan, 'kelurahan' => $kelurahan]);
    }

    public function update(Request $r)
    {
      $message = [
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

      $pin = str_replace('/', '', $r->input('tgl_lahir'));
      $id_karyawan = $r->input('id_karyawan');
      $karyawan = Karyawan::find($id_karyawan);
      $karyawan->nip = $r->input('nip');
      $karyawan->nuptk = $r->input('nuptk');
      $karyawan->no_ktp = $r->input('no_ktp');
      $karyawan->gelar_depan = $r->input('gelar_depan');
      $karyawan->nama = $r->input('nama');
      $karyawan->gelar_belakang = $r->input('gelar_belakang');
      $karyawan->kelamin = $r->input('kelamin');
      $karyawan->tempat_lahir = $r->input('tempat_lahir');
      $karyawan->tgl_lahir = Carbon::createFromFormat('d/m/Y', $r->input('tgl_lahir'))->toDateString();
      $karyawan->agama = $r->input('agama');
      $karyawan->alamat = $r->input('alamat');
      $karyawan->rt = $r->input('rt');
      $karyawan->rw = $r->input('rw');
      $karyawan->Kelurahan = $r->input('kelurahan');
      $karyawan->kecamatan = $r->input('kecamatan');
      $karyawan->kota = $r->input('kota');
      $karyawan->provinsi = $r->input('provinsi');
      $karyawan->kode_pos = $r->input('kode_pos');
      $karyawan->status_kawin = $r->input('status_kawin');
      $karyawan->no_hp = $r->input('no_hp');
      $karyawan->email = $r->input('email');
      $karyawan->nama_ibu = $r->input('nama_ibu');
      $karyawan->pin = $pin;
      $karyawan->status = $r->input('status');
      if ($r->input('status') != 1) {
        $karyawan->tgl_non_aktif = Carbon::now();
      } else {
        $karyawan->tgl_non_aktif = null;
      }

      if ($r->input('foto') != "") {
        $imgName = 'img_'.time().'.'.$r->file('foto')->getClientOriginalExtension();
        $r->file('foto')->move(public_path('assets/img/users/karyawan'), $imgName);
        $karyawan->foto = $imgName;
      }
      $karyawan->save();
      return redirect()->route('karyawan_edit', ['id' => $id_karyawan])->with('message', 'Data berhasil diubah!');
    }

    public function edit_education($id)
    {
      $karyawan = Karyawan::find($id);
      return view('semaya.master.karyawan.edit.education', ['data' => $karyawan]);
    }

    public function update_education(Request $r)
    {
      $r['gaji_pokok'] = str_replace('.', '', $r->input('gaji_pokok'));
      $id_karyawan = $r->input('id_karyawan');
      $karyawan = Karyawan::find($id_karyawan);
      $karyawan->pend_akhir = $r->input('pend_akhir');
      if ($r->input('tgl_lulus_pend_akhir') != null) {
        $karyawan->tgl_lulus_pend_akhir = Carbon::createFromFormat('d/m/Y', $r->input('tgl_lulus_pend_akhir'))->toDateString();
      } else {
        $karyawan->tgl_lulus_pend_akhir = null;
      }
      $karyawan->jurusan_pend_akhir = $r->input('jurusan_pend_akhir');
      $karyawan->lembaga_pend_akhir = $r->input('lembaga_pend_akhir');
      if ($r->input('tmt_cpns') != null) {
        $karyawan->tmt_cpns = Carbon::createFromFormat('d/m/Y', $r->input('tmt_cpns'))->toDateString();
      } else {
        $karyawan->tmt_cpns = null;
      }
      $karyawan->no_sk_cpns = $r->input('no_sk_cpns');
      if ($r->input('tmt_pns') != null) {
        $karyawan->tmt_pns = Carbon::createFromFormat('d/m/Y', $r->input('tmt_pns'))->toDateString();
      } else {
        $karyawan->tmt_pns = null;
      }
      $karyawan->no_sk_pns = $r->input('no_sk_pns');
      $karyawan->status_kepegawaian = $r->input('status_kepegawaian');
      $karyawan->golongan = $r->input('golongan');
      if ($r->input('tmt_golongan') != null) {
        $karyawan->tmt_golongan = Carbon::createFromFormat('d/m/Y', $r->input('tmt_golongan'))->toDateString();
      } else {
        $karyawan->tmt_golongan = null;
      }
      $karyawan->no_sk_golongan_akhir = $r->input('no_sk_golongan_akhir');
      $karyawan->masa_kerja_th = $r->input('masa_kerja_th');
      $karyawan->masa_kerja_bln = $r->input('masa_kerja_bln');
      $karyawan->gaji_pokok = $r->input('gaji_pokok');
      $karyawan->save();
      return redirect()->route('karyawan_edit_education', ['id' => $id_karyawan])->with('message', 'Data berhasil diubah!');
    }

    public function edit_status($id)
    {
      $karyawan = Karyawan::find($id);
      return view('semaya.master.karyawan.edit.status', ['data' => $karyawan]);
    }

    public function update_status(Request $r)
    {
      $message = [
        'status_karyawan.required'  => 'Status karyawan harus diisi!',
        'tmt_karyawan.required'  => 'TMT karyawan harus diisi!',
        'jabatan_karyawan.required'  => 'Jabatan karyawan harus diisi!',
      ];

      $this->validate($r, [
        'status_karyawan'  => 'required',
        'tmt_karyawan'  => 'required',
        'jabatan_karyawan'  => 'required',
      ], $message);

      $id_karyawan = $r->input('id_karyawan');
      $karyawan = Karyawan::find($id_karyawan);
      $jabatan = $r->input('jabatan_karyawan');


      $karyawan->status_karyawan = $r->input('status_karyawan');
      if ($r->input('tmt_karyawan') != null) {
        $karyawan->tmt_karyawan = Carbon::createFromFormat('d/m/Y', $r->input('tmt_karyawan'))->toDateString();
      } else {
        $karyawan->tmt_karyawan = null;
      }
      $karyawan->no_sk_pengangkatan = $r->input('no_sk_pengangkatan');
      if ($jabatan == "Lainnya") {
        $karyawan->jabatan_karyawan = $r->input('jabatan_lainnya');
      } else {
        $karyawan->jabatan_karyawan = $r->input('jabatan_karyawan');
      }
      $karyawan->save();
      return redirect()->route('karyawan_edit_status', ['id' => $id_karyawan])->with('message', 'Data berhasil diubah!');
    }

    public function delete($id)
    {
      $karyawan = Karyawan::find($id);
      $karyawan->delete();
      return redirect()->route('karyawan_index');
    }

    public function search(Request $r)
    {
      $q = $r->input('q');
      $karyawan = Karyawan::where('nama', 'like', '%' . $q . '%')->orderBy('nama')->paginate(10);
      $no = $karyawan->firstItem();
      return view('semaya.master.karyawan.index', ['data' => $karyawan, 'no' => $no, 'q' => $q]);
    }

    public function exportToPdf(Request $r)
    {
      $sekolah_id = Auth::user()->sekolah_id;
      $sekolah = Sekolah::find($sekolah_id);
      $karyawan = Karyawan::orderBy('nama')->get();
      // $pdf = PDF::loadView('semaya.master.karyawan.pdf', ['data' => $karyawan, 'sekolah' => $sekolah]);
      // return $pdf->setPaper('a4','potrait')->stream('DATA_KARYAWAN.pdf');
      $html = view('semaya.master.karyawan.pdf', ['data' => $karyawan, 'sekolah' => $sekolah]);
      $pdf = PDF::loadHTML($html)->setPaper('a4')->setOrientation('portrait');
      return $pdf->inline('Data Karyawan - '.Carbon::now()->format('Ymd').'.pdf');
    }

    public function exportToExcel(Request $r)
    {
      $excelHelper = $this->excelHelper;
      $format = $r->input('format');
      $excel_name_format = 'Ekspor Data Karyawan - '.Carbon::now();

      if ($format == 'pdf') {
        return $this->exportToPdf($r);
      }

      Excel::create($excel_name_format, function($excel) use($excelHelper){
          $karyawan = Karyawan::all();

          $excel->sheet('Karyawan', function ($sheet) use($karyawan, $excelHelper){

            $sheet->setColumnFormat([
              'A'=>'@',
              'B'=>'@',
              'C'=>'@',
              'AP'=>'@',
              'AQ'=>'@',
              // 'I'=>'yyyy-mm-dd',
              // 'X'=>'yyyy-mm-dd',
              // 'AM'=>'yyyy-mm-dd',
              // 'AS'=>'yyyy-mm-dd',
              // 'BA'=>'yyyy-mm-dd',
            ]);

            $sheet->row(1, $excelHelper->karyawanHeader());

            $sheet->row(1, function($row) {
              $row->setBackground('#3f51b5');
              $row->setFontColor('#ffffff');
              $row->setFontWeight('bold');
              $row->setFontSize(15);
            });

            $no = 2;
            foreach ($karyawan as $karyawan_value) {
              $num = $no++;
              $sheet->row($num, function($row) {
                $row->setFontSize(15);
              });

              $provinsi = Provinsi::find($karyawan_value->provinsi);
              $kota = Kota::find($karyawan_value->kota);
              $kecamatan = Kecamatan::find($karyawan_value->kecamatan);
              $kelurahan = Kelurahan::find($karyawan_value->kelurahan);

              if ($provinsi != null && $karyawan_value->provinsi != '') {
                $get_provinsi = $provinsi->name;
              }
              else {
                $get_provinsi = '';
              }

              if ($kota != null && $karyawan_value->kota != '') {
                $get_kota = $kota->name;
              }
              else {
                $get_kota = '';
              }

              if ($kecamatan != null && $karyawan_value->kecamatan != '') {
                $get_kecamatan = $kecamatan->name;
              }
              else {
                $get_kecamatan = '';
              }

              if ($kelurahan != null && $karyawan_value->kelurahan != '') {
                $get_kelurahan = $kelurahan->name;
              }
              else {
                $get_kelurahan = '';
              }

              if ($karyawan_value->status == 1) {
                $get_status = 'AKTIF';
              }
              else {
                $get_status = 'TIDAK AKTIF';
              }

              $sheet->row($num, [
                $karyawan_value->nip,
                $karyawan_value->nuptk,
                $karyawan_value->no_ktp,
                $karyawan_value->nama,
                $karyawan_value->gelar_depan,
                $karyawan_value->gelar_belakang,
                $karyawan_value->kelamin,
                $karyawan_value->tempat_lahir,
                $karyawan_value->tgl_lahir,
                $karyawan_value->agama,
                $karyawan_value->alamat,
                $karyawan_value->rt,
                $karyawan_value->rw,
                $get_kelurahan,
                $get_kecamatan,
                $get_kota,
                $get_provinsi,
                $karyawan_value->kode_pos,
                $karyawan_value->status_kawin,
                $karyawan_value->no_hp,
                $karyawan_value->email,
                $karyawan_value->nama_ibu,
                $karyawan_value->pend_akhir,
                $karyawan_value->tgl_lulus_pend_akhir,
                $karyawan_value->jurusan_pend_akhir,
                $karyawan_value->lembaga_pend_akhir,
                $karyawan_value->tmt_cpns,
                $karyawan_value->no_sk_cpns,
                $karyawan_value->tmt_pns,
                $karyawan_value->no_sk_pns,
                $karyawan_value->status_kepegawaian,
                $karyawan_value->golongan,
                $karyawan_value->tmt_golongan,
                $karyawan_value->no_sk_golongan_akhir,
                $karyawan_value->masa_kerja_th,
                $karyawan_value->masa_kerja_bln,
                $karyawan_value->gaji_pokok,
                $karyawan_value->status_karyawan,
                $karyawan_value->tmt_karyawan,
                $karyawan_value->no_sk_pengangkatan,
                $karyawan_value->jabatan_karyawan,
                $karyawan_value->nomor_kartu,
                $karyawan_value->pin,
                $karyawan_value->status,
                $karyawan_value->tgl_non_aktif,
              ]);
            }
          });
      })->export($format);
    }

    public function excelSample(Request $r)
    {
      $excelHelper = $this->excelHelper;
      $karyawan_header = $excelHelper->karyawanHeader();
      $excel_name_format = 'Contoh Data Karyawan - '.Carbon::now();

      foreach ($karyawan_header as $key => $value) {
        if ($value == 'NOMOR_KARTU' || $value == 'PIN') {
          // echo $value;
          unset($karyawan_header[$key]);
        }
      }

      // dd($karyawan_header);

      Excel::create($excel_name_format, function($excel) use($karyawan_header){

        $excel->sheet('Sheet 1', function ($sheet) use($karyawan_header){

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

          $sheet->row(1, $karyawan_header);

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
          $sheet->cell('AP3', function($cell) {
            $cell->setValue('TIDAK AKTIF');
          });
          $sheet->cell('AQ3', function($cell) {
            $cell->setValue('2017-05-19');
          });
        });
      })->export('xls');
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

            //Start employee number formatting
            $sekolah_id = Auth::user()->sekolah_id;
            $get_employee = Karyawan::all();

            if ($sekolah_id > 9) {
              $first_letter = '3'.$sekolah_id;
            }
            else {
              $first_letter = '30'.$sekolah_id;
            }

            if (count($get_employee) > 0) {
              $calculate_second_letter = count($get_employee) + 1;
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

            $final_employee_number = $first_letter.$second_letter;
            //End employee number formatting

            $nama = $row->nama;
            $tgl_lahir = date_format(date_create($row->tgl_lahir), 'Y-m-d');

            if ($nama != '' && $row->tgl_lahir != '') {
              $karyawan = new Karyawan;
              $karyawan->nip = $row->nip;
              $karyawan->nuptk = $row->nuptk;
              $karyawan->no_ktp = $row->no_ktp;
              $karyawan->nama = $row->nama;
              $karyawan->gelar_depan = $row->gelar_depan;
              $karyawan->gelar_belakang = $row->gelar_belakang;
              $karyawan->kelamin = $row->kelamin;
              $karyawan->tempat_lahir = $row->tempat_lahir;
              $karyawan->tgl_lahir = $tgl_lahir;
              $karyawan->agama = $row->agama;
              $karyawan->alamat = $row->alamat;
              $karyawan->rt = $row->rt;
              $karyawan->rw = $row->rw;
              $karyawan->kelurahan = $get_kelurahan;
              $karyawan->kecamatan = $get_kecamatan;
              $karyawan->kota = $get_kota;
              $karyawan->provinsi = $get_provinsi;
              $karyawan->kode_pos = $row->kode_pos;
              $karyawan->status_kawin = $row->status_kawin;
              $karyawan->no_hp = $row->no_hp;
              $karyawan->email = $row->email;
              $karyawan->nama_ibu = $row->nama_ibu;
              $karyawan->pend_akhir = $row->pend_akhir;
              $karyawan->tgl_lulus_pend_akhir = date_format(date_create($row->tgl_lulus_pend_akhir), 'Y-m-d');
              $karyawan->jurusan_pend_akhir = $row->jurusan_pend_akhir;
              $karyawan->lembaga_pend_akhir = $row->lembaga_pend_akhir;
              $karyawan->tmt_cpns = $row->tmt_cpns;
              $karyawan->no_sk_cpns = $row->no_sk_cpns;
              $karyawan->tmt_pns = $row->tmt_pns;
              $karyawan->no_sk_pns = $row->no_sk_pns;
              $karyawan->status_kepegawaian = $row->status_kepegawaian;
              $karyawan->golongan = $row->golongan;
              $karyawan->tmt_golongan = $row->tmt_golongan;
              $karyawan->no_sk_golongan_akhir = $row->no_sk_golongan_akhir;
              $karyawan->masa_kerja_th = $row->masa_kerja_th;
              $karyawan->masa_kerja_bln = $row->masa_kerja_bln;
              $karyawan->gaji_pokok = $row->gaji_pokok;
              $karyawan->status_karyawan = $row->status_karyawan;
              $karyawan->tmt_karyawan = $row->tmt_karyawan;
              $karyawan->no_sk_pengangkatan = $row->no_sk_pengangkatan;
              $karyawan->jabatan_karyawan = $row->jabatan_karyawan;
              if ($row->tgl_non_aktif != '') {
                $karyawan->status = 0;
              }
              else {
                $karyawan->status = 1;
              }
              $karyawan->tgl_non_aktif = $row->tgl_non_aktif;
              $karyawan->nomor_kartu = $final_employee_number;
              $karyawan->pin = Carbon::createFromFormat('Y-m-d', $tgl_lahir)->format('dmY');
              $karyawan->foto = 'avatar.jpg';
              $karyawan->save();
            }
          });
        });
      });

      return redirect()->route('karyawan_index')->with('message', 'Karyawan berhasil diimpor.');
    }
}
