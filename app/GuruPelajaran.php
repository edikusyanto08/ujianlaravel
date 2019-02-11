<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GuruPelajaran extends Model
{
    protected $table = 'guru_mata_pelajaran';

    public function pelajaran()
    {
      return $this->belongsTo('App\Pelajaran');
    }
}
