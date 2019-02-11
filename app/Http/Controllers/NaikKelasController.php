<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Kelas;
use App\Siswa;
use App\KelasSiswa;
use Validator;

class NaikKelasController extends Controller
{
    public function index()
    {
    	$kelas = Kelas::all();
    	return view('semaya.naik_kelas.index', ['kelas'=>$kelas]);
    }

    public function process(Request $r)
    {
    	$dari_kelas = $r->input('dari_kelas');
    	$ke_kelas = $r->input('ke_kelas');

    	$validator = Validator::make($r->all(), [
    		'dari_kelas' => 'required',
    		'ke_kelas' => 'required'
    	]);

    	if ($validator->fails()) {
			return redirect()->route('naik_kelas_index')->withErrors($validator);
    	}

    	$siswa = Siswa::select('siswa.id as siswa_id', 'kelas_siswa.kelas_id as kelas_id')
    			->join('kelas_siswa', 'siswa.id', '=', 'kelas_siswa.siswa_id')
    			->where('kelas_siswa.kelas_id', $dari_kelas)
    			->where('siswa.status', 1)
    			->where('siswa.lulus', 0)
    			->get();

    	if (count($siswa) > 0) {
	    	foreach ($siswa as $siswa_data) {
		  		$checkSiswa = $r->input('check_'.$siswa_data->siswa_id);

	    		if ($checkSiswa) {
	    			if ($ke_kelas == '0') {
	    				$select_siswa = Siswa::find($siswa_data->siswa_id);
	    				$select_siswa->lulus = 1;
	    				$select_siswa->save();
	    			}
	    			else {
						KelasSiswa::where('siswa_id', $siswa_data->siswa_id)
									->update([
										'kelas_id' => $ke_kelas
									]);
	    			}
	    		}
	    	}

	    	if ($ke_kelas == '0') {
		    	return redirect()->route('naik_kelas_index')->with('message', 'Siswa terpilih berhasil diluluskan.');
	    	}

	    	return redirect()->route('naik_kelas_index')->with('message', 'Siswa terpilih berhasil naik kelas.');
    	}

    	return redirect()->route('naik_kelas_index')->with('message', 'Gagal, belum ada siswa.');
    }
}
