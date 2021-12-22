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

class studentbillController extends Controller
{
   

public function studentbill(Request $request){

   // $columns = array(1=>'student_name',2=>'perstudent_id',3=>'hall_name',4=>'room_no',5=>'program',6=>'batchno',7=>'amount',8=>'status',9=>'month',);

        
    $columns = array(1=>'Serial',2=>'student_name',3=>'perstudent_id',4=>'hall_name',5=>'room_no',6=>'program',7=>'batchno',8=>'amount',9=>'status',10=>'month', 11=>'action',);
    $limit = $_POST['length'];
    $start = $_POST['start'];
    $order = $columns[$_POST['order'][0]['column']];
    $dir = $_POST['order'][0]['dir'];

    $search = $_POST['search']['value'];




    $rowTotalObj = DB::table('studentpayment')->join('hallname', 'studentpayment.hall_name', '=', 'hallname.id')
    ->join('users', 'studentpayment.perstudent_id', '=', 'users.id')
    
    
    ->select(DB::raw('count(*) as rcount'))
    
    
    //->where('status','paid')

					->where(function($query) use ($search)
		              {
		                if(!empty($search)):
		                  $query->Where('student_name','like', '%' . $search . '%');
		                   $query->orWhere('usercode','like', '%' . $search . '%');
		                  
						 
						
						   $query->orWhere('hallname','like', '%' . $search . '%');
		                   $query->orWhere('room_no','like', '%' . $search . '%');
		                   $query->orWhere('program','like', '%' . $search . '%');
		                   $query->orWhere('batchno','like', '%' . $search . '%');
		                   $query->orWhere('amount','like', '%' . $search . '%');
		                   $query->orWhere('status','like', '%' . $search . '%');

		                   $query->orWhere('month','like', '%' . $search . '%');
                          
	


		                endif;
		              })
                     ->get();
		$totalData = $rowTotalObj[0]->rcount;



        $posts = DB::table('studentpayment')
         	->join('hallname', 'studentpayment.hall_name', '=', 'hallname.id')
         	->join('users', 'studentpayment.perstudent_id', '=', 'users.id')
         	         	
             ->select('studentpayment.*', 'hallname.hallname','users.usercode')
             //->where('status','paid')
	
			->where(function($query) use ($search)
              {
                if(!empty($search)):
                   
					
					$query->Where('student_name','like', '%' . $search . '%');
					$query->orWhere('usercode','like', '%' . $search . '%');
					
					
					$query->orWhere('hallname','like', '%' . $search . '%');
					$query->orWhere('room_no','like', '%' . $search . '%');
					$query->orWhere('program','like', '%' . $search . '%');
					$query->orWhere('batchno','like', '%' . $search . '%');
					$query->orWhere('amount','like', '%' . $search . '%');
					$query->orWhere('status','like', '%' . $search . '%');

					$query->orWhere('month','like', '%' . $search . '%');
				   
   

                endif;
              })
			->offset($start)
			->limit($limit)
			->orderByRaw("$order $dir")
            ->get();


		$data = array();

		if($posts){

            $y = "<a class='task-del itmEdit' style='margin-left:4px' href='javascript:void(0);'><span class='label label-info'>Edit</span></a>";
			$z = "<a class='task-del itmDrop' style='margin-left:4px' href='javascript:void(0);'><span class='label label-danger'>Delete</span></a>";


			$serial = $_POST['start'] + 1;
			foreach($posts as $r){
				$arr['id'] = $r->id;
				$arr['perstudent_id'] = $r->usercode;
				$arr['Serial'] = $serial++;
				$arr['student_name'] = $r->student_name;
				$arr['program'] = $r->program;
				$arr['batch_no'] = $r->batchno;
				$arr['hall_name'] = $r->hallname;
				$arr['room_no'] = $r->room_no;
				$arr['amount'] = $r->amount;
				$arr['status'] = $r->status;
				
				$arr['month'] = $r->month;
				
				$arr['action'] = $y.$z;


				
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
		
        



}





public function paidbill(Request $request){


        
	$columns = array(1=>'Serial',2=>'student_name',3=>'perstudent_id',4=>'hall_name',5=>'room_no',6=>'program',7=>'batchno',8=>'amount',9=>'status',10=>'month',);

    $limit = $_POST['length'];
    $start = $_POST['start'];
    $order = $columns[$_POST['order'][0]['column']];
    $dir = $_POST['order'][0]['dir'];

    $search = $_POST['search']['value'];




    $rowTotalObj = DB::table('studentpayment')->join('hallname', 'studentpayment.hall_name', '=', 'hallname.id')
    ->join('users', 'studentpayment.perstudent_id', '=', 'users.id')
    
    
    ->select(DB::raw('count(*) as rcount'))
    

    ->where('status','paid')

					->where(function($query) use ($search)
		              {
		                if(!empty($search)):
					$query->Where('student_name','like', '%' . $search . '%');
					$query->orWhere('usercode','like', '%' . $search . '%');
					
					
					$query->orWhere('hallname','like', '%' . $search . '%');
					$query->orWhere('room_no','like', '%' . $search . '%');
					$query->orWhere('program','like', '%' . $search . '%');
					$query->orWhere('batchno','like', '%' . $search . '%');
					$query->orWhere('amount','like', '%' . $search . '%');
					$query->orWhere('status','like', '%' . $search . '%');

					$query->orWhere('month','like', '%' . $search . '%');
				   
	


		                endif;
		              })
                     ->get();
		$totalData = $rowTotalObj[0]->rcount;



        $posts = DB::table('studentpayment')
         	->join('hallname', 'studentpayment.hall_name', '=', 'hallname.id')
         	->join('users', 'studentpayment.perstudent_id', '=', 'users.id')
         	         	
             ->select('studentpayment.*', 'hallname.hallname','users.usercode')
             ->where('status','paid')
	
			->where(function($query) use ($search)
              {
                if(!empty($search)):
					$query->Where('student_name','like', '%' . $search . '%');
					$query->orWhere('usercode','like', '%' . $search . '%');
					
					
					$query->orWhere('hallname','like', '%' . $search . '%');
					$query->orWhere('room_no','like', '%' . $search . '%');
					$query->orWhere('program','like', '%' . $search . '%');
					$query->orWhere('batchno','like', '%' . $search . '%');
					$query->orWhere('amount','like', '%' . $search . '%');
					$query->orWhere('status','like', '%' . $search . '%');

					$query->orWhere('month','like', '%' . $search . '%');
				   

                endif;
              })
			->offset($start)
			->limit($limit)
			->orderByRaw("$order $dir")
            ->get();


		$data = array();

		if($posts){

            $y = "<a class='task-del itmEdit' style='margin-left:4px' href='javascript:void(0);'><span class='label label-info'>Edit</span></a>";
			$z = "<a class='task-del itmDrop' style='margin-left:4px' href='javascript:void(0);'><span class='label label-danger'>Delete</span></a>";


			$serial = $_POST['start'] + 1;
			foreach($posts as $r){
				$arr['id'] = $r->id;
				$arr['perstudent_id'] = $r->usercode;
				$arr['Serial'] = $serial++;
				$arr['student_name'] = $r->student_name;
				$arr['program'] = $r->program;
				$arr['batch_no'] = $r->batchno;
				$arr['hall_name'] = $r->hallname;
				$arr['room_no'] = $r->room_no;
				$arr['amount'] = $r->amount;
				$arr['status'] = $r->status;
				
				$arr['month'] = $r->month;
				
				$arr['action'] = $y.$z;


				
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
		
        



}






public function currentmonthdbill(Request $request){

	$dateaandtime=date ( 'Y-m' );
	
	$currentmonth = Carbon::now()->format('F');
		$currentyear = Carbon::now()->format('Y');

        $currentyearandmonth=$currentmonth."-".$currentyear;
		
     
	$columns = array(1=>'Serial',2=>'student_name',3=>'perstudent_id',4=>'hall_name',5=>'room_no',6=>'program',7=>'batchno',8=>'amount',9=>'status',10=>'month',);

    $limit = $_POST['length'];
    $start = $_POST['start'];
    $order = $columns[$_POST['order'][0]['column']];
    $dir = $_POST['order'][0]['dir'];

    $search = $_POST['search']['value'];




    $rowTotalObj = DB::table('studentpayment')->join('hallname', 'studentpayment.hall_name', '=', 'hallname.id')
    ->join('users', 'studentpayment.perstudent_id', '=', 'users.id')
    
    
    ->select(DB::raw('count(*) as rcount'))
    
	->where('month', $currentyearandmonth)
 

					->where(function($query) use ($search)
		              {
		                if(!empty($search)):
					$query->Where('student_name','like', '%' . $search . '%');
					$query->orWhere('usercode','like', '%' . $search . '%');
					
					
					$query->orWhere('hallname','like', '%' . $search . '%');
					$query->orWhere('room_no','like', '%' . $search . '%');
					$query->orWhere('program','like', '%' . $search . '%');
					$query->orWhere('batchno','like', '%' . $search . '%');
					$query->orWhere('amount','like', '%' . $search . '%');
					$query->orWhere('status','like', '%' . $search . '%');

					$query->orWhere('month','like', '%' . $search . '%');
				   
	


		                endif;
		              })
                     ->get();
		$totalData = $rowTotalObj[0]->rcount;



        $posts = DB::table('studentpayment')
         	->join('hallname', 'studentpayment.hall_name', '=', 'hallname.id')
         	->join('users', 'studentpayment.perstudent_id', '=', 'users.id')
         	         	
             ->select('studentpayment.*', 'hallname.hallname','users.usercode')
			 ->where('month', $currentyearandmonth)

			 


	
			->where(function($query) use ($search)
              {
                if(!empty($search)):
                   

					$query->Where('student_name','like', '%' . $search . '%');
					$query->orWhere('usercode','like', '%' . $search . '%');
					
					
					$query->orWhere('hallname','like', '%' . $search . '%');
					$query->orWhere('room_no','like', '%' . $search . '%');
					$query->orWhere('program','like', '%' . $search . '%');
					$query->orWhere('batchno','like', '%' . $search . '%');
					$query->orWhere('amount','like', '%' . $search . '%');
					$query->orWhere('status','like', '%' . $search . '%');

					$query->orWhere('month','like', '%' . $search . '%');
				   

   

                endif;
              })
			->offset($start)
			->limit($limit)
			->orderByRaw("$order $dir")
            ->get();


		$data = array();

		if($posts){

            $y = "<a class='task-del itmEdit' style='margin-left:4px' href='javascript:void(0);'><span class='label label-info'>Edit</span></a>";
			$z = "<a class='task-del itmDrop' style='margin-left:4px' href='javascript:void(0);'><span class='label label-danger'>Delete</span></a>";


			$serial = $_POST['start'] + 1;
			foreach($posts as $r){
				$arr['id'] = $r->id;
				$arr['perstudent_id'] = $r->usercode;
				$arr['Serial'] = $serial++;
				$arr['student_name'] = $r->student_name;
				$arr['program'] = $r->program;
				$arr['batch_no'] = $r->batchno;
				$arr['hall_name'] = $r->hallname;
				$arr['room_no'] = $r->room_no;
				$arr['amount'] = $r->amount;
				$arr['status'] = $r->status;
				
				$arr['month'] = $r->month;
				
				$arr['action'] = $y.$z;


				
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
 


}




public function unpaidbill(Request $request){


     
	$columns = array(1=>'Serial',2=>'student_name',3=>'perstudent_id',4=>'hall_name',5=>'room_no',6=>'program',7=>'batchno',8=>'amount',9=>'status',10=>'month',);

    $limit = $_POST['length'];
    $start = $_POST['start'];
    $order = $columns[$_POST['order'][0]['column']];
    $dir = $_POST['order'][0]['dir'];

    $search = $_POST['search']['value'];




    $rowTotalObj = DB::table('studentpayment')->join('hallname', 'studentpayment.hall_name', '=', 'hallname.id')
    ->join('users', 'studentpayment.perstudent_id', '=', 'users.id')
    
    
    ->select(DB::raw('count(*) as rcount'))
    
	->where('status', 'unpaid')
 

					->where(function($query) use ($search)
		              {
		                if(!empty($search)):
					$query->Where('student_name','like', '%' . $search . '%');
					$query->orWhere('usercode','like', '%' . $search . '%');
					
					
					$query->orWhere('hallname','like', '%' . $search . '%');
					$query->orWhere('room_no','like', '%' . $search . '%');
					$query->orWhere('program','like', '%' . $search . '%');
					$query->orWhere('batchno','like', '%' . $search . '%');
					$query->orWhere('amount','like', '%' . $search . '%');
					$query->orWhere('status','like', '%' . $search . '%');

					$query->orWhere('month','like', '%' . $search . '%');
				   


		                endif;
		              })
                     ->get();
		$totalData = $rowTotalObj[0]->rcount;



        $posts = DB::table('studentpayment')
         	->join('hallname', 'studentpayment.hall_name', '=', 'hallname.id')
         	->join('users', 'studentpayment.perstudent_id', '=', 'users.id')
         	         	
             ->select('studentpayment.*', 'hallname.hallname','users.usercode')
			 ->where('status', 'unpaid')


			 


	
			->where(function($query) use ($search)
              {
                if(!empty($search)):
					
					$query->Where('student_name','like', '%' . $search . '%');
					$query->orWhere('usercode','like', '%' . $search . '%');
					
					
					$query->orWhere('hallname','like', '%' . $search . '%');
					$query->orWhere('room_no','like', '%' . $search . '%');
					$query->orWhere('program','like', '%' . $search . '%');
					$query->orWhere('batchno','like', '%' . $search . '%');
					$query->orWhere('amount','like', '%' . $search . '%');
					$query->orWhere('status','like', '%' . $search . '%');

					$query->orWhere('month','like', '%' . $search . '%');
				   

                endif;
              })
			->offset($start)
			->limit($limit)
			->orderByRaw("$order $dir")
            ->get();


		$data = array();

		if($posts){

            $y = "<a class='task-del itmEdit' style='margin-left:4px' href='javascript:void(0);'><span class='label label-info'>Edit</span></a>";
			$z = "<a class='task-del itmDrop' style='margin-left:4px' href='javascript:void(0);'><span class='label label-danger'>Delete</span></a>";


			$serial = $_POST['start'] + 1;
			foreach($posts as $r){
				$arr['id'] = $r->id;
				$arr['perstudent_id'] = $r->usercode;
				$arr['Serial'] = $serial++;
				$arr['student_name'] = $r->student_name;
				$arr['program'] = $r->program;
				$arr['batch_no'] = $r->batchno;
				$arr['hall_name'] = $r->hallname;
				$arr['room_no'] = $r->room_no;
				$arr['amount'] = $r->amount;
				$arr['status'] = $r->status;
				
				$arr['month'] = $r->month;
				
				$arr['action'] = $y.$z;


				
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
 


}





public function editstudentbill(Request $request){


	$dateaandtime=date ( 'Y-m-d H:i:s' );
	$id=$request->input("recordid");
	//return $request; 
	  

	$obj = DB::table('studentpayment')->where('id',$id)->update(
   
		   ['student_name' => $request->input("studentname"), 
		
		   'room_no' => $request->input("room_no"),
		   'program' => $request->input("program"),
		   'batchno' => $request->input("batchno"),
		   'month' => $request->input("m_y"),
		   'amount' => $request->input("amount"),
		   'status' => $request->input("amount_status"),


		   'updated_at' =>$dateaandtime
		  
		   ]		       
	   );
	   if($obj==true){
		   return 1; 
   
	   }
   
   


	    



}



public function deletestudentbillRoute(Request $request){


	$id=$request->input("id");
		   $obj = DB::table('studentpayment')->where('id',$id)->delete();
	   
			   if($obj==true){

				return 1;
			   }


}



public function studentdeposit(Request $request){



    $loginuserid = Auth::user()->id;




	$columns = array(1=>'Serial',2=>'student_name',3=>'perstudent_id',4=>'hall_name',5=>'room_no',6=>'program',7=>'batchno',8=>'amount',9=>'status',10=>'month',);

    $limit = $_POST['length'];
    $start = $_POST['start'];
    $order = $columns[$_POST['order'][0]['column']];
    $dir = $_POST['order'][0]['dir'];

    $search = $_POST['search']['value'];




    $rowTotalObj = DB::table('studentpayment')->join('hallname', 'studentpayment.hall_name', '=', 'hallname.id')
    ->join('users', 'studentpayment.perstudent_id', '=', 'users.id')
    
    
    ->select(DB::raw('count(*) as rcount'))
    

    ->where('status','paid')
    ->where('perstudent_id',$loginuserid)

					->where(function($query) use ($search)
		              {
		                if(!empty($search)):
					$query->Where('student_name','like', '%' . $search . '%');
					$query->orWhere('usercode','like', '%' . $search . '%');
					
					
					$query->orWhere('hallname','like', '%' . $search . '%');
					$query->orWhere('room_no','like', '%' . $search . '%');
					$query->orWhere('program','like', '%' . $search . '%');
					$query->orWhere('batchno','like', '%' . $search . '%');
					$query->orWhere('amount','like', '%' . $search . '%');
					$query->orWhere('status','like', '%' . $search . '%');

					$query->orWhere('month','like', '%' . $search . '%');
				   
	


		                endif;
		              })
                     ->get();
		$totalData = $rowTotalObj[0]->rcount;



        $posts = DB::table('studentpayment')
         	->join('hallname', 'studentpayment.hall_name', '=', 'hallname.id')
         	->join('users', 'studentpayment.perstudent_id', '=', 'users.id')
         	         	
             ->select('studentpayment.*', 'hallname.hallname','users.usercode')
             ->where('status','paid')
			 ->where('perstudent_id',$loginuserid)
	
			->where(function($query) use ($search)
              {
                if(!empty($search)):
					$query->Where('student_name','like', '%' . $search . '%');
					$query->orWhere('usercode','like', '%' . $search . '%');
					
					
					$query->orWhere('hallname','like', '%' . $search . '%');
					$query->orWhere('room_no','like', '%' . $search . '%');
					$query->orWhere('program','like', '%' . $search . '%');
					$query->orWhere('batchno','like', '%' . $search . '%');
					$query->orWhere('amount','like', '%' . $search . '%');
					$query->orWhere('status','like', '%' . $search . '%');

					$query->orWhere('month','like', '%' . $search . '%');
				   

                endif;
              })
			->offset($start)
			->limit($limit)
			->orderByRaw("$order $dir")
            ->get();


		$data = array();

		if($posts){

           // $y = "<a class='task-del itmEdit' style='margin-left:4px' href='javascript:void(0);'><span class='label label-info'>Edit</span></a>";
			//$z = "<a class='task-del itmDrop' style='margin-left:4px' href='javascript:void(0);'><span class='label label-danger'>Delete</span></a>";


			$serial = $_POST['start'] + 1;
			foreach($posts as $r){
				$arr['id'] = $r->id;
				$arr['perstudent_id'] = $r->usercode;
				$arr['Serial'] = $serial++;
				$arr['student_name'] = $r->student_name;
				$arr['program'] = $r->program;
				$arr['batch_no'] = $r->batchno;
				$arr['hall_name'] = $r->hallname;
				$arr['room_no'] = $r->room_no;
				$arr['amount'] = $r->amount;
				$arr['status'] = $r->status;
				
				$arr['month'] = $r->month;
				
				//$arr['action'] = $y.$z;


				
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
		




}









}
