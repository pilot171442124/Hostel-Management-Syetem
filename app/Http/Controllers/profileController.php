<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;
use Illuminate\Support\Facades\Hash;
class profileController extends Controller
{
    

public function getprofiledata(Request $request){

    $loginuserid = Auth::user()->id;


$users=DB::table('users')->where('id',$loginuserid)->get();



foreach ($users as $users) {
  
    
$user_name=$users->name;
$user_usercode=$users->usercode;
$user_email=$users->email;
$user_gender=$users->gender;
$user_phone=$users->phone;


$dob=$users->dob;
$bldgrp=$users->bldgrp;
$nationality=$users->nationality;
$pass_status=$users->passport;
$passno=$users->pass_no;

$f_name=$users->f_name;
$m_name=$users->m_name;
$p_cell=$users->p_cell;
$image=$users->image;


}

return ["username"=>$user_name,"usercode"=>$user_usercode,"useremail"=>$user_email,

"usergender"=>$user_gender,"userphone"=>$user_phone,

"dob"=>$dob,"bldgrp"=>$bldgrp,"nationality"=>$nationality,"pass_status"=>$pass_status,
"passno"=>$passno,"f_name"=>$f_name,"m_name"=>$m_name,"p_cell"=>$p_cell,"image"=>$image


];


}







public function updateprofile(Request $request)
{
    $loginuserid = Auth::user()->id;


    $file=$request->file('file');




      $dateaandtime=date ( 'Y-m-d H:i:s' );
    

if (empty($file)) {


    $obj = DB::table('users')->where('id',$loginuserid)->update(
   
        ['name' => $request->input("name"), 
       
        'phone' => $request->input("phone"), 
        'email' => $request->input("email"),
        'gender' => $request->input("gender"),
        'dob' => $request->input("dob"),
        'bldgrp' => $request->input("bldgrp"),
        'Nationality' => $request->input("Nationality"),
        'passport' => $request->input("passport"),
        'pass_no' => $request->input("passportno"),


        
        'f_name' => $request->input("fname"),
        'm_name' => $request->input("mname"),
        'p_cell' => $request->input("fcellno"),
      

        'updated_at' =>$dateaandtime
       
        ]		       
    );
    if($obj==true){
        echo 1; 

    }



}


else {
    $nam=$file->getClientOriginalName();
    $file->move('images/',$nam); 
   

    $obj = DB::table('users')->where('id',$loginuserid)->update(
   
        ['name' => $request->input("name"), 
       
        'phone' => $request->input("phone"), 
        'email' => $request->input("email"),
        'gender' => $request->input("gender"),
        'dob' => $request->input("dob"),
        'bldgrp' => $request->input("bldgrp"),
        'Nationality' => $request->input("Nationality"),
        'passport' => $request->input("passport"),
        'pass_no' => $request->input("passportno"),


        
        'f_name' => $request->input("fname"),
        'm_name' => $request->input("mname"),
        'p_cell' => $request->input("fcellno"),
        
        'image' => $nam,
        

        'updated_at' =>$dateaandtime
       
        ]		       
    );
    if($obj==true){
        echo 1; 

    }






}

       
}
}
