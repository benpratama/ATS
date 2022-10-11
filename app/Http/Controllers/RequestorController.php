<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RequestorController extends Controller
{
    //
    public function index(){
        //ini nanti filternya
        return view ('requestor/home_requestor');
    }
}
