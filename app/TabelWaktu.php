<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TabelWaktu extends Model
{
    protected $connection = 'absensi';
    protected $table = 'tabel_waktu';
}
