<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    protected $table = 'jadwal';

    public function hari()
    {
      return $this->belongsTo('App\Hari');
    }

    public function pelajaran()
    {
      return $this->belongsTo('App\Pelajaran');
    }

    public function guru()
    {
      return $this->belongsTo('App\Guru');
    }

    public function kelas()
    {
      return $this->belongsTo('App\Kelas');
    }
}
