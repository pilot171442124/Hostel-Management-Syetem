<?php

namespace App\Http\Controllers;
use App\Providers\RouteServiceProvider;

use Illuminate\Http\Request;
use Redirect,Response;
use DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;


class mealController extends Controller
{

public function getfoodlistdata(){

    $data=DB::table('foodlistentry')->select('id','morning','lunch','dinner')->get();
   

    return view('mealentry',['data'=>$data]);  


}


}
