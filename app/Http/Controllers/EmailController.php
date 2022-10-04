<?php

namespace App\Http\Controllers;

use App\Mail\Sendmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
// use Mail;

class EmailController extends Controller
{
    //
    public function ESourcing(){
       return view('Email and WA/konten');
    }
}
