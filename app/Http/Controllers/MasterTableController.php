<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MasterTableController extends Controller
{   
    //MASTER TABLE INTERNAL
    public function indexInternal(){
        return view('master table/mt_internal');
    }

    //MASTER TABLE FORM
    public function indexForm(){
        return view('master table/mt_form');
    }
    //----SIM----
    public function ShowSim(){
    $sims = DB::table('M_SIM')
            ->select('id','nama','active','deleted')
            ->where('deleted',0)
            ->get();
    return $sims;
    }

    //MASTER TABLE VENDOR
    public function indexVendor(){
        return view('master table/mt_vendor');
    }
}
