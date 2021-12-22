<?php

namespace App\Http\Controllers;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;

use Redirect,Response;
use Auth;

use DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class addattendanceController extends Controller
{
    
public function addattendance(Request $request){

$date=$request->input('date');
$dateaandtime=date ( 'Y-m-d ' );


$rowTotalObj = DB::table('attendance')->select('date')

->where('date',$date)
->orwhere('created_at',$dateaandtime)

->count();

if($rowTotalObj>0)
{


return "exist";
	


}

else {

	$get_data=DB::table('application')
	->where('status','=','Accepted')
	->where('is_active','=','Active')
	
	
	->get();
	$multipledata=array();
		foreach($get_data as  $row){
		
	
			$applicationgetvalue1=$row->studentid;
			$applicationgetvalue2=$row->hallname_id;
			$applicationgetvalue3=$row->room_no;
			$applicationgetvalue4=$row->studentname;
		
			
			
	
			$multipledata[]=array(
	
	
				'student_id' => $applicationgetvalue1, 
				'hall_name' => $applicationgetvalue2,
				'room_no' => $applicationgetvalue3,
		
				'student_name' => $applicationgetvalue4,
			
				'date' => $date,
		
				'created_at'=>$dateaandtime,
	
	
	
	
			);
				
			
			
		
				
		
		}
			   
		$obj=DB::table('attendance')->Insert($multipledata);
	
	 
	if($obj==true){
	
	return 1;
	
	}

}



    }


public function getdatafromattendance(Request $request){

	$dateaandtime=date ( 'Y-m-d ' );


	$columns = array(2=>'student_name',3=>'student_id',4=>'hall_name',5=>'room_no',6=>'date',);
	$limit = $_POST['length'];
	$start = $_POST['start'];
	$order = $columns[$_POST['order'][0]['column']];
	$dir = $_POST['order'][0]['dir'];

	$search = $_POST['search']['value'];







	if(Auth::user()->userrole =='Employee')
	{

$loginuserid = Auth::user()->id;

$data=DB::table('employee')->select('hallnameid')->where('userid',$loginuserid)->get();
  

foreach($data as $hallname){

$hallname=$hallname->hallnameid;

}


$rowTotalObj = DB::table('attendance')

	->join('users', 'attendance.student_id', '=', 'users.id')
	->join('hallname', 'attendance.hall_name', '=', 'hallname.id')


	->select(DB::raw('count(*) as rcount'))
	->where('hall_name',$hallname)
	->where('attendance.created_at','=',$dateaandtime)

   ->where(function($query) use ($search)
	 {
	   if(!empty($search)):
		  $query->Where('student_name','like', '%' . $search . '%');
		  $query->orWhere('student_id','like', '%' . $search . '%');
		  $query->orWhere('student_id','like', '%' . $search . '%');
		  $query->orWhere('student_id','like', '%' . $search . '%');
		 

	   endif;
	 })
	->get();

	


	$totalData = $rowTotalObj[0]->rcount;




	$posts = DB::table('attendance')
	->join('users', 'attendance.student_id', '=', 'users.id')
	->join('hallname', 'attendance.hall_name', '=', 'hallname.id')

	->select('attendance.*','users.usercode','hallname.hallname')
	->where('hall_name',$hallname)
	->where('attendance.created_at','=',$dateaandtime)

		
	->where(function($query) use ($search)
		  {
			if(!empty($search)):
			   $query->Where('student_name','like', '%' . $search . '%');
			   $query->orWhere('student_id','like', '%' . $search . '%');
			   $query->orWhere('student_id','like', '%' . $search . '%');
			   $query->orWhere('student_id','like', '%' . $search . '%');
			  
			  

			endif;
		  })
		->offset($start)
		->limit($limit)
		->orderByRaw("id desc")
		->get();


	$data = array();

	if($posts){

	
		
		
		//$y = "<a class='task-del itmEdit' style='margin-left:4px' href='javascript:void(0);'><span class='label label-info'>Accept</span></a>";
	//	$z = "<a class='task-del itmDrop' style='margin-left:4px' href='javascript:void(0);'><span class='label label-danger'>Cancel</span></a>";




		$serial = $_POST['start'] + 1;
		foreach($posts as $r){

			
			$checkedAbsence="";
			$checkedPresent="";
			
			if($r->is_present == 'P'){
				$checkedPresent="checked";
			}
			if($r->is_present == 'A'){
				$checkedAbsence="checked";
			}
			else{
				$checkedPresent="checked";
			}

			
			
			$AttItemId=$r->id;

				$Absence = "<input class='attChange' type='radio' id='absence".$AttItemId."' name='AttendanceRadio".$AttItemId."' value='A' ".$checkedAbsence.">";
				$Present = "<input class='attChange' type='radio' id='present".$AttItemId."' name='AttendanceRadio".$AttItemId."' value='P' ".$checkedPresent.">";



			
			
			//$Absence = "<input class='attChange' type='radio' id='absence' name='AttendanceRadio' value='A'".$checkedAbsence.">";
			//$Present = "<input class='attChange' type='radio' id='present' name='AttendanceRadio' value='P'".$checkedPresent." >";
	
	
	


					$arr['id'] = $r->id;
					$arr['Serial'] = $serial++;
					$arr['studentid'] = $r->usercode;
					$arr['studentname'] = $r->student_name;
					$arr['hallname'] = $r->hallname;
					$arr['room_no'] = $r->room_no;
					$arr['date'] = $r->date;
					$arr['Absence'] = $Absence;
					$arr['Present'] = $Present;
				

           
			


						
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




else {
	


	$rowTotalObj = DB::table('attendance')

	->join('users', 'attendance.student_id', '=', 'users.id')
	->join('hallname', 'attendance.hall_name', '=', 'hallname.id')


	->select(DB::raw('count(*) as rcount'))
	->where('attendance.created_at','=',$dateaandtime)



   ->where(function($query) use ($search)
	 {
	   if(!empty($search)):
		  $query->Where('student_name','like', '%' . $search . '%');
		  $query->orWhere('student_id','like', '%' . $search . '%');
		  $query->orWhere('student_id','like', '%' . $search . '%');
		  $query->orWhere('student_id','like', '%' . $search . '%');
		 

	   endif;
	 })
	->get();

	


	$totalData = $rowTotalObj[0]->rcount;




	$posts = DB::table('attendance')
	->join('users', 'attendance.student_id', '=', 'users.id')
	->join('hallname', 'attendance.hall_name', '=', 'hallname.id')

	->select('attendance.*','users.usercode','hallname.hallname')
	->where('attendance.created_at','=',$dateaandtime)

	
	
	->where(function($query) use ($search)
		  {
			if(!empty($search)):
			   $query->Where('student_name','like', '%' . $search . '%');
			   $query->orWhere('student_id','like', '%' . $search . '%');
			   $query->orWhere('student_id','like', '%' . $search . '%');
			   $query->orWhere('student_id','like', '%' . $search . '%');
			  
			  

			endif;
		  })
		->offset($start)
		->limit($limit)
		->orderByRaw("id desc")
		->get();


	$data = array();

	if($posts){

	
		
		
		//$y = "<a class='task-del itmEdit' style='margin-left:4px' href='javascript:void(0);'><span class='label label-info'>Accept</span></a>";
	//	$z = "<a class='task-del itmDrop' style='margin-left:4px' href='javascript:void(0);'><span class='label label-danger'>Cancel</span></a>";




		$serial = $_POST['start'] + 1;
		foreach($posts as $r){

			
			$checkedAbsence="";
			$checkedPresent="";
			
			if($r->is_present == 'P'){
				$checkedPresent="checked";
			}
			if($r->is_present == 'A'){
				$checkedAbsence="checked";
			}
			else{
				$checkedPresent="checked";
			}

			
			
			$AttItemId=$r->id;

				$Absence = "<input class='attChange' type='radio' id='absence".$AttItemId."' name='AttendanceRadio".$AttItemId."' value='A' ".$checkedAbsence.">";
				$Present = "<input class='attChange' type='radio' id='present".$AttItemId."' name='AttendanceRadio".$AttItemId."' value='P' ".$checkedPresent.">";



			
			
			//$Absence = "<input class='attChange' type='radio' id='absence' name='AttendanceRadio' value='A'".$checkedAbsence.">";
			//$Present = "<input class='attChange' type='radio' id='present' name='AttendanceRadio' value='P'".$checkedPresent." >";
	
	
	


					$arr['id'] = $r->id;
					$arr['Serial'] = $serial++;
					$arr['studentid'] = $r->usercode;
					$arr['studentname'] = $r->student_name;
					$arr['hallname'] = $r->hallname;
					$arr['room_no'] = $r->room_no;
					$arr['date'] = $r->date;
					$arr['Absence'] = $Absence;
					$arr['Present'] = $Present;
				

           
			


						
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



public function updateattendance(Request $request)

{
$id=$request->recordId;

$present=$request->IsPresent;



$dateaandtime=date ( 'Y-m-d H:i:s' );
		
		   $obj = DB::table('attendance')->where('id',$id)->update(
	   
			 [
				   
				'is_present' => $present, 
			  
			  
			   'updated_at' =>$dateaandtime
			  
			   ]		       
		   );
		  if($obj==true){
			   echo 1; 
	   
		  }










}





public function getdatetochangedate(Request $request){


	$data=DB::table('attendance')->select('date')->get();
  

	foreach($data as $lastdate){
	
	$last_date=$lastdate->date;
	
	}


return $last_date;


}


public function changedate(Request $request){




	$changedate=$request->changedate;

$Beforedate=$request->Beforedate;



$dateaandtime=date ( 'Y-m-d H:i:s' );
		
		   $obj = DB::table('attendance')->where('date',$Beforedate)->update(
	   
			 [
				   
				'date' => $changedate, 
			  
			  
			   'updated_at' =>$dateaandtime
			  
			   ]		       
		   );
		  if($obj==true){
			   echo 1; 
	   
		  }








}



public function addattendancereport(Request $request){

	$dateaandtime=date ( 'Y-m-d ' );


	$columns = array(2=>'student_name',3=>'student_id',4=>'hall_name',5=>'room_no',6=>'date',);
	$limit = $_POST['length'];
	$start = $_POST['start'];
	$order = $columns[$_POST['order'][0]['column']];
	$dir = $_POST['order'][0]['dir'];

	$search = $_POST['search']['value'];







	if(Auth::user()->userrole =='Employee')
	{

$loginuserid = Auth::user()->id;

$data=DB::table('employee')->select('hallnameid')->where('userid',$loginuserid)->get();
  

foreach($data as $hallname){

$hallname=$hallname->hallnameid;

}


$rowTotalObj = DB::table('attendance')

	->join('users', 'attendance.student_id', '=', 'users.id')
	->join('hallname', 'attendance.hall_name', '=', 'hallname.id')


	->select(DB::raw('count(*) as rcount'))
	->where('hall_name',$hallname)
	

   ->where(function($query) use ($search)
	 {
	   if(!empty($search)):
		  $query->Where('student_name','like', '%' . $search . '%');
		  $query->orWhere('student_id','like', '%' . $search . '%');
		  $query->orWhere('date','like', '%' . $search . '%');
		  $query->orWhere('student_id','like', '%' . $search . '%');
		 

	   endif;
	 })
	->get();

	


	$totalData = $rowTotalObj[0]->rcount;




	$posts = DB::table('attendance')
	->join('users', 'attendance.student_id', '=', 'users.id')
	->join('hallname', 'attendance.hall_name', '=', 'hallname.id')

	->select('attendance.*','users.usercode','hallname.hallname')
	->where('hall_name',$hallname)
	

		
	->where(function($query) use ($search)
		  {
			if(!empty($search)):
			   $query->Where('student_name','like', '%' . $search . '%');
			   $query->orWhere('student_id','like', '%' . $search . '%');
			   $query->orWhere('date','like', '%' . $search . '%');
			   $query->orWhere('student_id','like', '%' . $search . '%');
			  
			  

			endif;
		  })
		->offset($start)
		->limit($limit)
		->orderByRaw("id desc")
		->get();


	$data = array();

	if($posts){

	
		
		
		//$y = "<a class='task-del itmEdit' style='margin-left:4px' href='javascript:void(0);'><span class='label label-info'>Accept</span></a>";
	//	$z = "<a class='task-del itmDrop' style='margin-left:4px' href='javascript:void(0);'><span class='label label-danger'>Cancel</span></a>";




		$serial = $_POST['start'] + 1;
		foreach($posts as $r){

			
			$checkedAbsence="";
			$checkedPresent="";
			
			if($r->is_present == 'P'){
				$checkedPresent="checked";
			}
			if($r->is_present == 'A'){
				$checkedAbsence="checked";
			}
			else{
				$checkedPresent="checked";
			}

			
			
			$AttItemId=$r->id;

				$Absence = "<input class='attChange' type='radio' id='absence".$AttItemId."' name='AttendanceRadio".$AttItemId."' value='A' ".$checkedAbsence.">";
				$Present = "<input class='attChange' type='radio' id='present".$AttItemId."' name='AttendanceRadio".$AttItemId."' value='P' ".$checkedPresent.">";



			
			
			//$Absence = "<input class='attChange' type='radio' id='absence' name='AttendanceRadio' value='A'".$checkedAbsence.">";
			//$Present = "<input class='attChange' type='radio' id='present' name='AttendanceRadio' value='P'".$checkedPresent." >";
	
	
	


					$arr['id'] = $r->id;
					$arr['Serial'] = $serial++;
					$arr['studentid'] = $r->usercode;
					$arr['studentname'] = $r->student_name;
					$arr['hallname'] = $r->hallname;
					$arr['room_no'] = $r->room_no;
					$arr['date'] = $r->date;
					$arr['Absence'] = $Absence;
					$arr['Present'] = $Present;
				

           
			


						
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




else {
	


	$rowTotalObj = DB::table('attendance')

	->join('users', 'attendance.student_id', '=', 'users.id')
	->join('hallname', 'attendance.hall_name', '=', 'hallname.id')


	->select(DB::raw('count(*) as rcount'))
	



   ->where(function($query) use ($search)
	 {
	   if(!empty($search)):
		  $query->Where('student_name','like', '%' . $search . '%');
		  $query->orWhere('student_id','like', '%' . $search . '%');
		  $query->orWhere('date','like', '%' . $search . '%');
		  $query->orWhere('student_id','like', '%' . $search . '%');
		 

	   endif;
	 })
	->get();

	


	$totalData = $rowTotalObj[0]->rcount;




	$posts = DB::table('attendance')
	->join('users', 'attendance.student_id', '=', 'users.id')
	->join('hallname', 'attendance.hall_name', '=', 'hallname.id')

	->select('attendance.*','users.usercode','hallname.hallname')


	
	
	->where(function($query) use ($search)
		  {
			if(!empty($search)):
			   $query->Where('student_name','like', '%' . $search . '%');
			   $query->orWhere('student_id','like', '%' . $search . '%');
			   $query->orWhere('date','like', '%' . $search . '%');
			   $query->orWhere('student_id','like', '%' . $search . '%');
			  
			  

			endif;
		  })
		->offset($start)
		->limit($limit)
		->orderByRaw("id desc")
		->get();


	$data = array();

	if($posts){

	
		
		
		//$y = "<a class='task-del itmEdit' style='margin-left:4px' href='javascript:void(0);'><span class='label label-info'>Accept</span></a>";
	//	$z = "<a class='task-del itmDrop' style='margin-left:4px' href='javascript:void(0);'><span class='label label-danger'>Cancel</span></a>";




		$serial = $_POST['start'] + 1;
		foreach($posts as $r){

			
			$checkedAbsence="";
			$checkedPresent="";
			
			if($r->is_present == 'P'){
				$checkedPresent="checked";
			}
			if($r->is_present == 'A'){
				$checkedAbsence="checked";
			}
			else{
				$checkedPresent="checked";
			}

			
			
			$AttItemId=$r->id;

				$Absence = "<input class='attChange' type='radio' id='absence".$AttItemId."' name='AttendanceRadio".$AttItemId."' value='A' ".$checkedAbsence.">";
				$Present = "<input class='attChange' type='radio' id='present".$AttItemId."' name='AttendanceRadio".$AttItemId."' value='P' ".$checkedPresent.">";



			
			
			//$Absence = "<input class='attChange' type='radio' id='absence' name='AttendanceRadio' value='A'".$checkedAbsence.">";
			//$Present = "<input class='attChange' type='radio' id='present' name='AttendanceRadio' value='P'".$checkedPresent." >";
	
	
	


					$arr['id'] = $r->id;
					$arr['Serial'] = $serial++;
					$arr['studentid'] = $r->usercode;
					$arr['studentname'] = $r->student_name;
					$arr['hallname'] = $r->hallname;
					$arr['room_no'] = $r->room_no;
					$arr['date'] = $r->date;
					$arr['Absence'] = $Absence;
					$arr['Present'] = $Present;
				

           
			


						
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




public function studentaddattendancereport(Request $request)

{



	$columns = array(2=>'student_name',3=>'student_id',4=>'hall_name',5=>'room_no',6=>'date',);
	$limit = $_POST['length'];
	$start = $_POST['start'];
	$order = $columns[$_POST['order'][0]['column']];
	$dir = $_POST['order'][0]['dir'];

	$search = $_POST['search']['value'];







	if(Auth::user()->userrole =='Student')
	{

$loginuserid = Auth::user()->id;



$rowTotalObj = DB::table('attendance')

	->join('users', 'attendance.student_id', '=', 'users.id')
	->join('hallname', 'attendance.hall_name', '=', 'hallname.id')


	->select(DB::raw('count(*) as rcount'))
	->where('student_id',$loginuserid)
	

   ->where(function($query) use ($search)
	 {
	   if(!empty($search)):
		  $query->Where('student_name','like', '%' . $search . '%');
		  $query->orWhere('student_id','like', '%' . $search . '%');
		  $query->orWhere('date','like', '%' . $search . '%');
		  $query->orWhere('student_id','like', '%' . $search . '%');
		 

	   endif;
	 })
	->get();

	


	$totalData = $rowTotalObj[0]->rcount;




	$posts = DB::table('attendance')
	->join('users', 'attendance.student_id', '=', 'users.id')
	->join('hallname', 'attendance.hall_name', '=', 'hallname.id')

	->select('attendance.*','users.usercode','hallname.hallname')

	->where('student_id',$loginuserid)
	

		
	->where(function($query) use ($search)
		  {
			if(!empty($search)):
			   $query->Where('student_name','like', '%' . $search . '%');
			   $query->orWhere('student_id','like', '%' . $search . '%');
			   $query->orWhere('date','like', '%' . $search . '%');
			   $query->orWhere('student_id','like', '%' . $search . '%');
			  
			  

			endif;
		  })
		->offset($start)
		->limit($limit)
		->orderByRaw("id desc")
		->get();


	$data = array();

	if($posts){

	
		
		
		//$y = "<a class='task-del itmEdit' style='margin-left:4px' href='javascript:void(0);'><span class='label label-info'>Accept</span></a>";
	//	$z = "<a class='task-del itmDrop' style='margin-left:4px' href='javascript:void(0);'><span class='label label-danger'>Cancel</span></a>";




		$serial = $_POST['start'] + 1;
		foreach($posts as $r){

			
		
			
			
			

			
			
			//$Absence = "<input class='attChange' type='radio' id='absence' name='AttendanceRadio' value='A'".$checkedAbsence.">";
			//$Present = "<input class='attChange' type='radio' id='present' name='AttendanceRadio' value='P'".$checkedPresent." >";
	
	
	
					$arr['id'] = $r->id;
					$arr['Serial'] = $serial++;
					$arr['studentid'] = $r->usercode;
					$arr['studentname'] = $r->student_name;
					$arr['hallname'] = $r->hallname;
					$arr['room_no'] = $r->room_no;
					$arr['date'] = $r->date;
					
				

               if (empty($r->is_present)) {
				$arr['isPresent'] = "P";
				   
			   }
			
else{

	$arr['isPresent'] = $r->is_present;

}

						
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
	
}












