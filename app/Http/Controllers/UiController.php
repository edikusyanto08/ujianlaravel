<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UiController extends Controller
{
    public function index()
    {
      return view('semaya.sample.index');
    }
}
