<?php

namespace App\Http\Controllers;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Redirect,Response;
use Carbon\Carbon;
use DB;
use Auth;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class paymentController extends Controller
{
  
    public function billgenerate(Request $request){
		
	
		$month = $request->input("date");
		
		$month_str_ireplace=str_ireplace(" ","-",$month);



		$dateaandtime=date ( 'Y-m-d H:i:s' );
	

		

		//$objstudentpayment = DB::table('studentpayment')->whereIn('perstudent_id',$multipleid)->delete();
		//$obj2 = DB::table('application')->whereIn('studentid',$multipleid)->delete();

		$currentmonth = Carbon::now()->format('F');
		$currentyear = Carbon::now()->format('Y');

        $currentyearandmonth=$currentyear."-".$currentmonth;

	$month = $request->input("date");

       


//$countfornewemptydate1=DB::table('application')->count();

$foremptyseat=DB::table('application')
->where('app_month','!=',$currentyearandmonth)
->where('is_active','!=',"Inactive")


->get();
$multipledata=array();
	foreach($foremptyseat as  $row){
	

		$applicationgetvalue1=$row->studentid;
		$applicationgetvalue2=$row->hallname_id;
		$applicationgetvalue3=$row->room_no;
		$applicationgetvalue4=$row->studentname;
		$applicationgetvalue5=$row->cellno;
		$applicationgetvalue6=$row->program;
		$applicationgetvalue7=$row->batchno;
		$applicationgetvalue8=$row->roomcost;
		$applicationgetvalue9=$row->invoice_no;
		
		
	


		$multipledata[]=array(


			'perstudent_id' => $applicationgetvalue1, 
            'hall_name' => $applicationgetvalue2,
            'room_no' => $applicationgetvalue3,
    
            'student_name' => $applicationgetvalue4,
        
            'cellno' => $applicationgetvalue5,
            'program' => $applicationgetvalue6,
            'batchno' => $applicationgetvalue7,
            'currency' => "BDT",
            'amount' =>  $applicationgetvalue8,
            'invoic_no'=>$applicationgetvalue9,
            'month'=>$month_str_ireplace,
			
			
            'status'=>'unpaid',
            'created_at'=>$dateaandtime,




		);
			
		
		
	
			
	
	}
		   
	$obj=DB::table('studentpayment')->Insert($multipledata);

 
if($obj==true){

return 1;

}





    }



	public function paymentverify(){

	$dateaandtime=date ( 'Y-m-d H:i:s' );
		
			
		$Date2 = date('Y-m-d', strtotime($Date1 . " - 1 day"));		
        



	}




public function	getpaymentlist(Request $request){




	//$columns = array(2=>'studentname',3=>'phoneo',4=>'program',5=>'batchno',);
	//$limit = $_POST['length'];
	//$start = $_POST['start'];
	//$order = $columns[$_POST['order'][0]['column']];
	//$dir = $_POST['order'][0]['dir'];

	///$search = $_POST['search']['value'];


	if(Auth::user()->userrole =='Student')
	{

$loginuserid = Auth::user()->id;



$rowTotalObj = DB::table('studentpayment') 
			
//->join('application', 'studentpayment.perstudent_id', '=', 'application.studentid')

//->where('status','unpaid')


->where('perstudent_id',$loginuserid)
              //->where('studentpayment.status','unpaid')
			  //->orwhere('studentpayment.status','paid')
			  //->select('studentpayment.*',  'application.status as acceptstatus')
			  //->orderBy('studentpayment.id', 'DESC')
			  ->orderBy('id', 'DESC')
				
			 
			 
			  ->get();

			
		
			  
			  $rowTotalObj2 = DB::table('application') 
			
 
			  
			  ->where('studentid',$loginuserid)
						
							->orderBy('id', 'DESC')
							  
	 
							->get();








				// ->join('hallname', 'studentpayment.hall_name', '=', 'hallname.id')


				 
/*

				 $totalData = $rowTotalObj[0]->rcount;




				 $posts = DB::table('studentpayment')->select('studentpayment.*')
				 ->where('perstudent_id',$loginuserid)
				 ->where('status','unpaid')


					 ->where(function($query) use ($search)
					   {
						 if(!empty($search)):
							$query->Where('studentname','like', '%' . $search . '%');
							$query->orWhere('cellno','like', '%' . $search . '%');
						   
		 
						 endif;
					   })
					 ->offset($start)
					 ->limit($limit)
					 ->orderByRaw("id desc")
					 ->get();
		 
		 
				 $data = array();
		 
				 if($posts){
		 
		 
					 $y = "<a class='task-del itmEdit btn btn-sm' style='margin-left:4px' href='javascript:void(0);'><span class='label label-info'>Pay</span></a>";
					// $z = "<a class='itmDrop'style='margin-left:4px' href='bkashpayment'><span class='label label-danger'>Cancel</span></a>";
		 
					 //<button id="bKash_button">Pay With bKash</button>
		 
		 
					 $serial = $_POST['start'] + 1;
					 foreach($posts as $r){
						 $arr['perstudent_id'] = $r->perstudent_id;
						 $arr['Serial'] = $serial++;
						 $arr['student_name'] = $r->student_name;
						 $arr['program'] = $r->program;
						 $arr['batch'] = $r->batchno;
						 $arr['hall_name'] = $r->hall_name;
						 $arr['room_no'] = $r->room_no;
						 $arr['amount'] = $r->amount;
						 $arr['month'] = $r->month;
						 $arr['invoic_no'] = $r->invoic_no;
						 $arr['status'] = $r->status;

						 $arr['action'] = $y;
				
		 
		 
					
						 $data[] = $arr;
					 }
		 
					 $json_data = array(
						 "iTotalRecords"=> intval($totalData),
						 "iTotalDisplayRecords"=> intval($totalData),
						 "draw"=>intval($request->input('draw')),
						 "recordsTotal"=> intval($totalData),
						 "data"=>$data
					 );
		 
					 echo json_encode($json_data);


		
	}


	*/

	return view('roompaymentlist',['data'=>$rowTotalObj],['data2'=>$rowTotalObj2]);


}








}

public function	viewpayment(Request $request){


$id= $request->id;

$rowTotalObj = DB::table('studentpayment') ->where('id',$id)
			  ->where('status','unpaid')->get();


				return view('bkashpayment',['view'=>$rowTotalObj]);
				


}



public function	studentid(Request $request){


	$id= $request->stu_id;
	$hall_id= $request->hall_id;
	
	$rowTotalObj = DB::table('users') ->select('usercode','name')->where('id',$id)
		
					 ->get();
	
	
					 foreach($rowTotalObj as  $row){
					
						$usercode=$row->usercode;
						$name=$row->name;


					 }

	
					 $hallname = DB::table('hallname') ->select('hallname')->where('id',$hall_id)
		
					 ->get();				 
					 foreach($hallname as  $row){
					
						$hallname=$row->hallname;


					 }



 return ["student_id"=>$usercode, "hallname"=>$hallname,"name"=>$name];

//return $hall_id;
	}
	







}
