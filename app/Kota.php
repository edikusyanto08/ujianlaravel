<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kota extends Model
{
  protected $connection = 'semaya_master';

  protected $table = 'kota';
}
