<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sekolah extends Model
{
    protected $table = 'sekolah';

    public function sekolahProv()
    {
      return $this->belongsTo('App\Provinsi', 'provinsi', 'id');
    }
}
