<?php

namespace App\Http\Controllers;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Redirect,Response;
use DB;
use Auth;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class DashboardController extends Controller
{
    

public function highchart(Request $request)
{

  $search='';


  if(Auth::user()->userrole =='Student')
  {

    $loginuserid = Auth::user()->id;


    $posts = DB::table('studentpayment')
    //->select(DB::raw("CONCAT(YEAR(`IssueDate`),'-',MONTH(`IssueDate`)) AS IssuedYearMonth,COUNT(`RequestId`) AS RequestCount"))
    ->select(DB::raw("DATE_FORMAT(created_at, '%Y-%m') AS IssuedYearMonth,COUNT(`id`) AS RequestCount "))
   
   
    ->whereNotNull('created_at')
    ->where('perstudent_id',$loginuserid)

    ->where('status','=','paid')

    ->groupByRaw("DATE_FORMAT(created_at, '%Y-%m')")
    //->tosql();
    ->get();


    $get_amounts = DB::table('studentpayment')->select('amount')
    ->whereNotNull('created_at')
    ->where('perstudent_id',$loginuserid)

    ->where('status','=','paid')->get();

    $amount= array();

    foreach($get_amounts as $r){
    
      $amount[] = $r->amount;
  
     
      
    }





  $category = array();
  $series = array("name"=>"Student","data"=>array(),"color"=>"#00587E");

  foreach($posts as $r){
    $category[] = $r->IssuedYearMonth;
   

    settype($r->RequestCount,"int");
    $series["data"][] = $r->RequestCount;
  }
  
  $output = array();
  $output["category"] = $category;
  $output["series"][] = $series;

  //$output["amount"] = $amount;

  
  return $output;//json_encode($output);



  }
    

else{




  $posts = DB::table('studentpayment')
  //->select(DB::raw("CONCAT(YEAR(`IssueDate`),'-',MONTH(`IssueDate`)) AS IssuedYearMonth,COUNT(`RequestId`) AS RequestCount"))
  ->select(DB::raw("DATE_FORMAT(created_at, '%Y-%m') AS IssuedYearMonth,COUNT(`id`) AS RequestCount"))
  ->whereNotNull('created_at')
  ->where('status','=','paid')

  ->groupByRaw("DATE_FORMAT(created_at, '%Y-%m')")
  //->tosql();
  ->get();


$category = array();
$series = array("name"=>"Student","data"=>array(),"color"=>"#00587E");

foreach($posts as $r){
  $category[] = $r->IssuedYearMonth;

  settype($r->RequestCount,"int");
  $series["data"][] = $r->RequestCount;
}

$output = array();
$output["category"] = $category;
$output["series"][] = $series;


return $output;//json_encode($output);




}



  }




public function dashborard(Request $request)



{


  if(Auth::user()->userrole =='Student')
  {

    $loginuserid = Auth::user()->id;

    $get_hallname_id = DB::table('application')->select('hallname_id','room_no')->where('studentid',$loginuserid )->get();

foreach($get_hallname_id as $row)


{
$hallname_id=$row->hallname_id;
$room_no=$row->room_no;


}


$get_hallname = DB::table('hallname')->select('hallname')->where('id',$hallname_id )->get();




//$get_total_room = DB::table('application')->where('hallid',$hallname_id )->count();


$get_total_current_student = DB::table('application')->where('hallname_id',$hallname_id )
->where('status','Accepted' )
->where('is_active','Active' )
->count();

$get_total_employee_the_room = DB::table('employee')->where('hallnameid',$hallname_id )->count();


if($get_hallname==true)

{

foreach($get_hallname as $row)  
{

$gethallname=$row->hallname;

}




}



return ["hallname"=>$gethallname,"totalstudenthallroom"=>$room_no, "totalcurrentstudeninthishall"=>$get_total_current_student
,"totalemployeeinthishall"=>$get_total_employee_the_room,];

  }


//employee

  if(Auth::user()->userrole =='Employee')
  {

    $loginuserid = Auth::user()->id;

    $get_hallname_id = DB::table('employee')->select('hallnameid')->where('userid',$loginuserid )->get();

foreach($get_hallname_id as $row)


{
$hallname_id=$row->hallnameid;



}
$totalstudent = DB::table('application')->where('hallname_id',$hallname_id )->count();

$get_employee = DB::table('employee')->where('hallnameid',$hallname_id)->count();

$get_room = DB::table('room')->where('hallid',$hallname_id)->count();

$get_hall = DB::table('hallname')->count();





return ["hallnamecount"=>$get_hall,"totalstudentemp"=>$totalstudent, "totalroomemp"=>$get_room
,"totalemployeeinthishallemp"=>$get_employee,];

  }











else{

  $posts = DB::table('application')
  ->where('is_active','=','Active')->count();

  $totalhall = DB::table('hallname')->count();

  $totalroom = DB::table('room')->count();
  $totalemployee = DB::table('employee')->count();
  

  return ["totalstudent"=>$posts,"totalhall"=>$totalhall, "totalroom"=>$totalroom
,"totalemployee"=>$totalemployee,];



}

}



}
