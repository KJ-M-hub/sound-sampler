<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SoundSamplerController extends Controller
{
    public function main(){
        return view('main');
    }

    public function recording(){
        return view('recording');
    }
}
