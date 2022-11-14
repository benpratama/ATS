<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class DokumenController extends Controller
{
    //
    public function ETHsurat(){
        return view('Surat MCU.eth');
    }
    public function Fimasurat(){
        return view('Surat MCU.fima');
    }
    public function HJsurat(){
        return view('Surat MCU.hj');
    }
    public function fkpk(){
        return view('form_kpk');
    }
}
