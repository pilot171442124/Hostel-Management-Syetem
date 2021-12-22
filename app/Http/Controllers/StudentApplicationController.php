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


class StudentApplicationController extends Controller
{

 
 public function hallnameid(Request $request)   
{

$hallnameid=$request->hallnameid;
$roomno=$request->roomno;

$room_cost = DB::table('room')->select('cost')->where('hallid',$hallnameid)->where('roomno',$roomno)->get();

foreach($room_cost as $row)

{
$cost=$row->cost;

}
return $cost;
}
















//for student get all information


public function studetntidnumber(Request $request){

    $studetntidnumber=$request->studetntidnumber;

    
    $studetnt_information = DB::table('users')
    ->select('usercode','email','phone','name','gender','dob','bldgrp','nationality',
    'passport','pass_no','f_name','m_name','p_cell','image'
    )->where('id',$studetntidnumber)->get();


    foreach($studetnt_information as $row){


    $usercode=$row->usercode;
    $studentmail=$row->email;

    $studentphone=$row->phone;
    $studentname=$row->name;
    $studengender=$row->gender;

    $dob=$row->dob;
    $bldgrp=$row->bldgrp;
    $nationality=$row->nationality;
    $pass_status=$row->passport;
    $passno=$row->pass_no;

    $f_name=$row->f_name;
    $m_name=$row->m_name;
    $p_cell=$row->p_cell;
    $image=$row->image;





    }   
    

    $get_informattion_from_manageloginid_table=DB::table('manageloginid')->select('studentname','studentdept','batch')->where('studentid',$usercode)->get();


    if($get_informattion_from_manageloginid_table==true)

{

    foreach($get_informattion_from_manageloginid_table as $row){


       
    
        $studentdept=$row->studentdept;
        $batch=$row->batch;
    
    
        }   
        

}









return ["studentname"=>$studentname,"studentdept"=>$row->studentdept,

"studentmail"=>$studentmail, "studentphone"=>$studentphone,"studentgender"=>$studengender,"batch"=>$batch,
"dob"=>$dob,"bldgrp"=>$bldgrp,"nationality"=>$nationality,"pass_status"=>$pass_status,
"passno"=>$passno,"f_name"=>$f_name,"m_name"=>$m_name,"p_cell"=>$p_cell,"image"=>$image


];




}


















    
    
   public function getstudentid(Request $request){

    $loginuserid = Auth::user()->id;


    $get_gender=DB::table('users')->select('gender')->where('userrole','Student')->where('id',$loginuserid)->get();

foreach($get_gender as $row)
{

$gender= $row->gender;


}





    
    if(Auth::user()->userrole =='Admin' ||  Auth::user()->userrole =='Employee')
{

    $data=DB::table('users')->select('id','usercode')->where('userrole','Student')->get();
    $hallname=DB::table('hallname')->select('id','hallname')->get();


    return view('studentapplication',['data'=>$data, 'hallname'=>$hallname]); 


}


else{

    $data=DB::table('users')->select('id','usercode')->where('userrole','Student')->where('id',$loginuserid)
    ->get();





    $hallname=DB::table('hallname')->select('id','hallname')->where('gender',$gender)->get();

    return view('studentapplication',['data'=>$data, 'hallname'=>$hallname]); 


}

    

 



   } 
    
    
    
    
    
    
    
    
    
    
    
    public function getinputdataforstudentapplication(Request $request){


        if($request->ajax())
        {

                    $studentid= $request->studentid;

                    $users = DB::table('users')
                    ->select('name','email','phone','usercode','gender','dob','bldgrp','nationality','passport','pass_no','f_name','m_name','p_cell','image')
                    ->where('id', $studentid)->get();
                    

                    foreach($users as $row){

                    $name=$row->name;
                    $phone=$row->phone;
                    $email=$row->email;
                    $usercode=$row->usercode;

                    $gender=$row->gender;
                    $dob=$row->dob;
                    $bldgrp=$row->bldgrp;
                    $nationality=$row->nationality;
                    $pass_status=$row->passport;
                    $passno=$row->pass_no;

                    $f_name=$row->f_name;
                    $m_name=$row->m_name;
                    $p_cell=$row->p_cell;
                    $image=$row->image;






                        
                    }   
                   
                   
                  
                    $manageloginid = DB::table('manageloginid')
                    ->select('studentdept','batch')->where('studentid', $usercode)->get();
                    

                    foreach($manageloginid as $row){


                        $studentdept=$row->studentdept;
                        $batch=$row->batch;
    


                    }               



                   
                   
                   
                   
                    return ["name"=>$name,"phone"=>$phone,"email"=>$email,
                    
                    "studentdept"=>$studentdept,"gender"=>$gender,"batch"=>$batch,
                   
                    "dob"=>$dob,"bldgrp"=>$bldgrp,"nationality"=>$nationality,"pass_status"=>$pass_status,
                    "passno"=>$passno,"f_name"=>$f_name,"m_name"=>$m_name,"p_cell"=>$p_cell,"image"=>$image
                
                ];        
                 

        }

    }


    public function addstudentapplication(Request $request){
    
       $find_stdid=$request->input("studentid");
        $loginuserid = Auth::user()->id;

        $count_application_table=DB::table('application')->where('studentid',$loginuserid)->count();
        $count_application_id=DB::table('application')->where('studentid',$find_stdid)->count();


if ($count_application_table) {
   return "available";
}


else if ($count_application_id) {
    return "available";
 }
 


else {
 





	$dateaandtime=date ( 'Y-m-d H:i:s' );
        
	$first_payment_time = date('Y-m-d', strtotime($dateaandtime. " + 5 day"));		
        
        $date=date("ymdi-s");
		$currentmonth = Carbon::now()->format('F');
		$currentyear = Carbon::now()->format('Y');

        $currentyearandmonth=$currentyear."-".$currentmonth;
        $currentyearandmonthnewapplication=$currentmonth."-".$currentyear;

        $file=$request->file('file');
        $nam=$file->getClientOriginalName();
        $file->move('images/',$nam); 

$inputroomno= $request->input("roomno");
$hallname= $request->input("hallname");


///



//






$countvalidroomnumber=DB::table('room')->where('roomno',$inputroomno)->where('hallid',$hallname)->where('emptyseat','!=','0')->count();

//$countvalidroomnumber=DB::table('room')->where('roomno',$inputroomno)->where('hallid',$hallname)->where('emptyseat','!=','0')->count();


//$countvalidroomnumber=DB::table('room')->where('roomno',$inputroomno)->where('hallid',$hallname)->where('newemptydate','=','NUll')->orwhere('newemptydate','!=','NUll')->count();

$countfornewemptydate=DB::table('room')->where('roomno',$inputroomno)->where('hallid',$hallname)->where('newemptydate','!=','NUll')->where('emptyseat','=',0)->count();


if($countvalidroomnumber>0){



    $foremptyseat=DB::table('room')->select('emptyseat','cost')->where('hallid',$hallname)->where('roomno',$inputroomno)->get();

            foreach($foremptyseat as  $row){

                $cost=$row->cost;

                $emptyseat=$row->emptyseat;

        


}


$lessvaluewhensumittheapplication=$emptyseat-1;


if(0>$lessvaluewhensumittheapplication)
{
    return "notempty";
}





else{


		   $minusvalueupadate = DB::table('room')->where('roomno',$inputroomno)->update(
	   
			   ['emptyseat' => $lessvaluewhensumittheapplication]		       
		   );


    }







    $obj=DB::table('application')->updateOrInsert(
    
        ['studentid' => $request->input("studentid"), 
        'hallname_id' => $request->input("hallname"), 

        'studentname' => $request->input("studentname"),
        'email' => $request->input("email"),
        'cellno' => $request->input("Phone"),
        'program' => $request->input("Program"),
        'batchno' => $request->input("batchno"),
        'gender' => $request->input("gender"),
        'dob' => $request->input("dob"), 
        'bloodgrp' => $request->input("bldgrp"), 
        'nationality' => $request->input("Nationality"), 
        'pass_status' => $request->input("passport"), 

        'passno' => $request->input("passportno"), 
        'fname' => $request->input("fname"), 

        'mname' => $request->input("mname"), 

        'f_m_cellno' => $request->input("fcellno"),
        'p_address_v_t_r' => $request->input("Present_textarea"),
        'p_district' => $request->input("Present_District"),
        'p_postoffice' => $request->input("Present_PostOffice"),
        'p_postcode' => $request->input("Present_postcode"),
        'par_address_v_t_r' => $request->input("Parmanet_textarea"),
        'par_district' => $request->input("Parmanet_District"),
        'Par_postoffice' => $request->input("Parmanet_postoffice"),
        'Par_postcode' => $request->input("parmanent_postcode"),
        'room_no' => $request->input("roomno"),
        'roomcost' => $request->input("roomcost"),
        
        'admit_date' => $request->input("doj"),
        'invoice_no'=>$date,

        'app_month'=>$currentyearandmonth,


        'is_active' => $request->input("activestatus"),
        'per_photo' =>$nam,
        'created_at' =>$dateaandtime,


        ]
    );
    
    if($obj==true)
    {
 
        

        $obj=DB::table('studentpayment')->updateOrInsert(
    
            [
            'perstudent_id' => $request->input("studentid"), 
            'hall_name' => $request->input("hallname"), 
            'room_no' => $request->input("roomno"),
    
            'student_name' => $request->input("studentname"),
        
            'cellno' => $request->input("Phone"),
            'program' => $request->input("Program"),
            'batchno' => $request->input("batchno"),
            'currency' => "BDT",
            'amount' =>  $cost,
            'invoic_no'=>$date,
            'application_status'=>'new',
            'month'=>$currentyearandmonthnewapplication,
            'status'=>'unpaid',

            //'first_Payment_time'=>$first_payment_time,
            'number_of_seat'=>1,

            'created_at' =>$dateaandtime,
            

           
        
    
    
    
            ]
        );
        












       
        return 1;
    }



}









else if($countfornewemptydate>0){





    $foremptyseat=DB::table('room')->select('newemptyno,cost')->where('roomno',$inputroomno)->get();

    foreach($foremptyseat as  $row){
    
    
        $newemptyno=$row->newemptyno;
    
        $cost=$row->cost;


    }
    
    
    $lessvaluewhensumittheapplication=$newemptyno-1;
    
    
    if(0>$lessvaluewhensumittheapplication)
    {
        return "notempty";
    }
    
    
    
    
    
    else{
    
    
               $minusvalueupadate = DB::table('room')->where('roomno',$inputroomno)->update(
           
                   ['newemptyno' => $lessvaluewhensumittheapplication]
                   		       

               );
    
    
            }
    
    
    
    
    
    
    
        $obj=DB::table('application')->updateOrInsert(
        
            ['studentid' => $request->input("studentid"), 
            'hallname_id' => $request->input("hallname"), 
    
            'studentname' => $request->input("studentname"),
            'email' => $request->input("email"),
            'cellno' => $request->input("Phone"),
            'program' => $request->input("Program"),
            'batchno' => $request->input("batchno"),
            'gender' => $request->input("gender"),
            'dob' => $request->input("dob"), 
            'bloodgrp' => $request->input("bldgrp"), 
            'nationality' => $request->input("Nationality"), 
            'pass_status' => $request->input("passport"), 
    
            'passno' => $request->input("passportno"), 
            'fname' => $request->input("fname"), 
    
            'mname' => $request->input("mname"), 
    
            'f_m_cellno' => $request->input("fcellno"),
            'p_address_v_t_r' => $request->input("Present_textarea"),
            'p_district' => $request->input("Present_District"),
            'p_postoffice' => $request->input("Present_PostOffice"),
            'p_postcode' => $request->input("Present_postcode"),
            'par_address_v_t_r' => $request->input("Parmanet_textarea"),
            'par_district' => $request->input("Parmanet_District"),
            'Par_postoffice' => $request->input("Parmanet_postoffice"),
            'Par_postcode' => $request->input("parmanent_postcode"),
            'room_no' => $request->input("roomno"),
            'roomcost' => $request->input("roomcost"),

            'admit_date' => $request->input("doj"),
            'status' => "pending",
            'invoice_no'=>$date,
            'app_month'=>$currentyearandmonth,

            'is_active' => $request->input("activestatus"),
            'per_photo' =>$nam,
            'created_at' =>$dateaandtime,
    
    
            ]
        );

        if($obj==true)
        {




            $obj=DB::table('studentpayment')->updateOrInsert(
    
                [
                'perstudent_id' => $request->input("studentid"), 
                'hall_name' => $request->input("hallname"), 
                'room_no' => $request->input("roomno"),
        
                'student_name' => $request->input("studentname"),
            
                'cellno' => $request->input("Phone"),
                'program' => $request->input("Program"),
                'batchno' => $request->input("batchno"),
                'currency' => "BDT",
                'amount' =>  $cost,
                'invoic_no'=>$date,
                'application_status'=>'new',
                'month'=>$currentyearandmonthnewapplication,

                'status'=>'unpaid',
                //'first_Payment_time'=>$first_payment_time,
                'number_of_seat'=>1,

                'created_at' =>$dateaandtime,

               
                
        
        
        
                ]
            );
            



            return 1;
        }

}



else{


    $for_emptyseat=DB::table('room')->where('hallid',$hallname)->where('roomno',$inputroomno)->count();



  if($for_emptyseat<=0)

{

    return "hallandroomnonotmatch";
}

else{

    $for_emptyseat=DB::table('room')->where('hallid',$hallname)->where('roomno',$inputroomno)
    ->where('newemptydate','=','NUll')->where('emptyseat','=',0)->count();



   if($for_emptyseat>0)
{
    return "notempty";


}


}
      
    
}

}




    }
    



public function getstudentlistrequest(Request $request){


	

        $columns = array(2=>'hallname_id',3=>'room_no',4=>'studentid',5=>'village',
    
        6=>'P_district',7=>'nationality',8=>'dob',9=>'gender',10=>'fname',
        11=>'mname',12=>'passno',13=>'per_photo',14=>'hallname',15=>'usercode',16=>'Serial',
        17=>'studentname',18=>'phone',19=>'program',20=>'batchno'
       
    );
        $limit = $_POST['length'];
		$start = $_POST['start'];
		$order = $columns[$_POST['order'][0]['column']];
		$dir = $_POST['order'][0]['dir'];

		$search = $_POST['search']['value'];
//
    
        if(Auth::user()->userrole =='Employee')
        {
    
    $loginuserid = Auth::user()->id;

    $data=DB::table('employee')->select('hallnameid')->where('userid',$loginuserid)->get();
      
    
foreach($data as $hallname){

    $hallname=$hallname->hallnameid;

}




    $rowTotalObj = DB::table('application')
    ->join('hallname', 'application.hallname_id', '=', 'hallname.id')
    ->join('users', 'application.studentid', '=', 'users.id')
              
    
                 ->select(DB::raw('count(*) as rcount'))
                  ->where('hallname_id',$hallname)
                 // ->where('status','Accepted')
                  
					->where(function($query) use ($search)
		              {
		                if(!empty($search)):
		                   $query->Where('studentname','like', '%' . $search . '%');
		                   $query->orWhere('cellno','like', '%' . $search . '%');
		                  

		                endif;
		              })
                     ->get();
          
                     


                     $totalData = $rowTotalObj[0]->rcount;




                     $posts = DB::table('application')
                     ->join('hallname', 'application.hallname_id', '=', 'hallname.id')
                     ->join('users', 'application.studentid', '=', 'users.id')
              
                     ->select('application.*','hallname.hallname','users.usercode')
                         ->where('hallname_id',$hallname)
                         // ->where('status','Accepted')

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
             
                        $x = "<a class='task-del itmview' style='margin-left:4px' href='javascript:void(0);'><span class='label label-info'>View</span></a>";
                              
                         $y = "<a class='task-del itmEdit' style='margin-left:4px' href='javascript:void(0);'><span class='label label-info'>Accept</span></a>";
                         $z = "<a class='task-del itmDrop' style='margin-left:4px' href='javascript:void(0);'><span class='label label-danger'>Cancel</span></a>";
             
             
             
             
                         $serial = $_POST['start'] + 1;
                         foreach($posts as $r){
                             $arr['id'] = $r->id;
                             $arr['Serial'] = $serial++;
                             $arr['studentid'] = $r->studentid;
                             $arr['studentname'] = $r->studentname;
                             $arr['phone'] = $r->cellno;
                             $arr['program'] = $r->program;
                             $arr['batchno'] = $r->batchno;
                             $arr['hallname_id'] = $r->hallname_id;
				             $arr['room_no'] = $r->room_no;
                             $arr['studentid'] = $r->studentid;
                           
                           
                             $arr['village'] = $r->p_address_v_t_r;
                             $arr['P_district'] = $r->p_district;
                             $arr['nationality'] = $r->nationality;
                             $arr['dob'] = $r->dob;
                             $arr['gender'] = $r->gender;
                             $arr['fname'] = $r->fname;
                             $arr['mname'] = $r->mname;

                             $arr['passno'] = $r->passno;
                             $arr['per_photo'] = $r->per_photo;
                             $arr['usercode'] = $r->usercode;
                             $arr['hallname'] = $r->hallname;
             


                             if($r->status == "Accepted"){
                                 $arr['action'] = "<span class='text-success'>".$r->status."</span>";
                             }
                             else{
                                 $arr['action'] =$y.$z.$x;
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




///
else{
		$rowTotalObj = DB::table('application')
                    
        ->join('hallname', 'application.hallname_id', '=', 'hallname.id')
        ->join('users', 'application.studentid', '=', 'users.id')
        
        
        ->select(DB::raw('count(*) as rcount'))
                     
					->whereNull('status')
					->orwhere('status','Accepted')

                  

					->where(function($query) use ($search)
		              {
		                if(!empty($search)):
		                   $query->Where('studentname','like', '%' . $search . '%');
		                   $query->orWhere('cellno','like', '%' . $search . '%');
		                  

		                endif;
		              })
                     ->get();


    

		$totalData = $rowTotalObj[0]->rcount;




        $posts = DB::table('application')

        ->join('hallname', 'application.hallname_id', '=', 'hallname.id')
        ->join('users', 'application.studentid', '=', 'users.id')
        ->select('application.*','hallname.hallname','users.usercode')


        ->whereNull('status')
		->orwhere('status','Accepted')   
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

            $x = "<a class='task-del itmview' style='margin-left:4px' href='javascript:void(0);'><span class='label label-info'>View</span></a>";

            $y = "<a class='task-del itmEdit' style='margin-left:4px' href='javascript:void(0);'><span class='label label-info'>Accept</span></a>";
			$z = "<a class='task-del itmDrop' style='margin-left:4px' href='javascript:void(0);'><span class='label label-danger'>Cancel</span></a>";




			$serial = $_POST['start'] + 1;
			foreach($posts as $r){
				$arr['id'] = $r->id;
				$arr['Serial'] = $serial++;
				$arr['studentid'] = $r->studentid;
				$arr['studentname'] = $r->studentname;
				$arr['phone'] = $r->cellno;
				$arr['program'] = $r->program;
				$arr['batchno'] = $r->batchno;
				$arr['hallname_id'] = $r->hallname_id;
				$arr['room_no'] = $r->room_no;
				$arr['studentid'] = $r->studentid;
                $arr['village'] = $r->p_address_v_t_r;
                $arr['P_district'] = $r->p_district;
                $arr['nationality'] = $r->nationality;
                $arr['dob'] = $r->dob;
                $arr['gender'] = $r->gender;
                $arr['fname'] = $r->fname;
                $arr['mname'] = $r->mname;

                $arr['passno'] = $r->passno;
                $arr['per_photo'] = $r->per_photo;

                $arr['usercode'] = $r->usercode;
                $arr['hallname'] = $r->hallname;

				
                if($r->status == "Accepted"){
					$arr['action'] = "<span class='text-success'>".$r->status."</span>";
				}
				else{
					$arr['action'] =$y.$z.$x;
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
































/*       
		$columns = array(2=>'studentname',3=>'phoneo',4=>'program',5=>'batchno',);
        $limit = $_POST['length'];
		$start = $_POST['start'];
		$order = $columns[$_POST['order'][0]['column']];
		$dir = $_POST['order'][0]['dir'];

		$search = $_POST['search']['value'];

		$rowTotalObj = DB::table('application')
                     ->select(DB::raw('count(*) as rcount'))
                  
					->where(function($query) use ($search)
		              {
		                if(!empty($search)):
		                   $query->Where('studentname','like', '%' . $search . '%');
		                   $query->orWhere('phone','like', '%' . $search . '%');
		                  

		                endif;
		              })
                     ->get();
		$totalData = $rowTotalObj[0]->rcount;




        $posts = DB::table('application')->select('application.*')
			->where(function($query) use ($search)
              {
                if(!empty($search)):
                   $query->Where('studentname','like', '%' . $search . '%');
                   $query->orWhere('phone','like', '%' . $search . '%');
                  

                endif;
              })
			->offset($start)
			->limit($limit)
			->orderByRaw("id desc")
            ->get();


		$data = array();

		if($posts){


            $y = "<a class='task-del itmEdit' style='margin-left:4px' href='javascript:void(0);'><span class='label label-info'>Accept</span></a>";
			$z = "<a class='task-del itmDrop' style='margin-left:4px' href='javascript:void(0);'><span class='label label-danger'>Cancel</span></a>";




			$serial = $_POST['start'] + 1;
			foreach($posts as $r){
				$arr['id'] = $r->id;
				$arr['Serial'] = $serial++;
				$arr['studentid'] = $r->studentid;
				$arr['studentname'] = $r->studentname;
				$arr['phone'] = $r->cellno;
				$arr['program'] = $r->program;
				$arr['batchno'] = $r->batchno;
				
                if($r->status == "Accepted"){
					$arr['action'] = "<span class='text-success'>".$r->status."</span>";
				}
				else{
					$arr['action'] =$y.$z;
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
	
*/

    }



public function  acceptapplicationRequest(Request $request){

    $dateaandtime=date ( 'Y-m-d H:i:s' );
        
	$first_payment_time = date('Y-m-d', strtotime($dateaandtime. " + 5 day"));	


    $id = $request->input("id");

    $hallname_id=$request->input("hallname_id");
    $room_no=$request->input("room_no");
    $studentid=$request->input("studentid");







    $book = DB::table('application')
          ->where('id', $id)
          ->update(['Status' => 'Accepted']);

          $studentpayment = DB::table('studentpayment')
          ->where('perstudent_id',$studentid)

          ->update(['first_Payment_time' => $first_payment_time]);

        

    

}


public function cancelapplicationRequestRequest(Request $request){

    $id=$request->input("id");
    $hallname_id=$request->input("hallname_id");
    $room_no=$request->input("room_no");
    $studentid=$request->input("studentid");


    $room=DB::table('room')->select('emptyseat')
    ->where('hallid', $hallname_id)
    ->where('roomno', $room_no)
    ->get();
    foreach($room as $r){

        $get_room_emptyseat=$r->emptyseat;

        

    }

$add_number_1=$get_room_emptyseat+1;

$roo_update_value = DB::table('room')
            ->where('hallid', $hallname_id)
            ->where('roomno', $room_no)

            ->update(['emptyseat' =>  $add_number_1]);


    $obj = DB::table('application')->where('id',$id)->delete();

                if($obj==true){

    $obj = DB::table('studentpayment')->where('perstudent_id',$studentid)->delete();




                return 1;
                }








    
}













public function getMyNewPostCount(){


    if(Auth::check()){

        $myNewPostCount = 0;


        $loginuserrole = Auth::user()->userrole; 
        $loginuserid = Auth::user()->id;
       
       
      if($loginuserrole=="Student") {

       
        $rowTotalObj = DB::table('application')
                         ->select(DB::raw('count(*) as rcount'))                     
                         ->where('studentid', $loginuserid)
                         ->where('status', 'Accepted')
                         ->whereNull('seen_notification')
                         ->get();
    

                      
        $myNewPostCount = $rowTotalObj[0]->rcount;




        return $myNewPostCount;
       
 


      }
       
       
      if($loginuserrole=="Admin") {

       
       
      
       
       $rowTotalObjpending = DB::table('application')
       ->select(DB::raw('count(*) as rcount'))                                            
        ->Where('status','pending')
        ->WhereNull('seen_by_admin')
       
  
       ->get();


       $rowTotalObjempty = DB::table('application')
       ->select(DB::raw('count(*) as rcount'))                                            
        ->WhereNull('status')
        ->WhereNull('seen_by_admin')
       
  
       ->get();






       $myNewPostCountpending = $rowTotalObjpending[0]->rcount;
         
       $myNewPostCountempty= $rowTotalObjempty[0]->rcount;

      
       
return ["pending"=>$myNewPostCountpending, "empty"=>$myNewPostCountempty];
       
 


      }   
       
       
       
       
       
       
        
        ///$LastPostViewDate = Auth::user()->LastPostViewDate;


    }

//


                    


}











public function applicationacceptdata(){


    $loginuserid = Auth::user()->id;
    $loginuserrole = Auth::user()->userrole;

    $posts = DB::table('application')
        ->join('hallname', 'application.hallname_id', '=', 'hallname.id')
        ->join('users', 'application.studentid', '=', 'users.id')
        ->join('studentpayment', 'application.studentid', '=', 'studentpayment.perstudent_id')

        ->select('application.*','hallname','usercode','studentpayment.first_Payment_time')
        /*->where('UserId','=',$loginuserid)*/
        ->where('studentid',$loginuserid )
        ->where('application.status','Accepted' )

            

        ->orderByRaw("id desc")
        ->get();




        echo json_encode($posts);

             
}





public function updateseen(Request $request){


    if(Auth::check()){
    $loginuserrole = Auth::user()->userrole; 


if( $loginuserrole=="Student")
{
    $loginuserid = Auth::user()->id;
    

    $book = DB::table('application')
          ->where('studentid', $loginuserid)
          ->where('status', 'Accepted')

          ->update(['seen_notification' => 'seen']);

}

if( $loginuserrole=="Admin")
{
 
    

    $book = DB::table('application')
          ->update(['seen_by_admin' => 'seenbyadmin']);

} 




    }


   



}



public function getpendingrequestlist(Request $request){

    $columns = array(2=>'studentname',3=>'phoneo',4=>'program',5=>'batchno',);
    $limit = $_POST['length'];
    $start = $_POST['start'];
    $order = $columns[$_POST['order'][0]['column']];
    $dir = $_POST['order'][0]['dir'];

    $search = $_POST['search']['value'];

    $rowTotalObj = DB::table('application')
    ->select(DB::raw('count(*) as rcount'))->where('status','pending')
 
   ->where(function($query) use ($search)
     {
       if(!empty($search)):
          $query->Where('studentname','like', '%' . $search . '%');
          $query->orWhere('cellno','like', '%' . $search . '%');
         

       endif;
     })
    ->get();




$totalData = $rowTotalObj[0]->rcount;




$posts = DB::table('application')->select('application.*')->where('status','pending')
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


$y = "<a class='task-del itmEdit' style='margin-left:4px' href='javascript:void(0);'><span class='label label-info'>Accept</span></a>";
$z = "<a class='task-del itmDrop' style='margin-left:4px' href='javascript:void(0);'><span class='label label-danger'>Cancel</span></a>";




$serial = $_POST['start'] + 1;
foreach($posts as $r){
$arr['id'] = $r->id;
$arr['Serial'] = $serial++;
$arr['studentid'] = $r->studentid;
$arr['studentname'] = $r->studentname;
$arr['phone'] = $r->cellno;
$arr['program'] = $r->program;
$arr['batchno'] = $r->batchno;

if($r->status == "Accepted"){
   $arr['action'] = "<span class='text-success'>".$r->status."</span>";
}
else{
   $arr['action'] =$y.$z;
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







public function showpendingandrequestlist (){


    if(Auth::check()){

        $myNewPostCount = 0;


        $loginuserrole = Auth::user()->userrole; 
        $loginuserid = Auth::user()->id;
       
       
       
       
      if($loginuserrole=="Admin") {

       
       
      
       
       $rowTotalObjpending = DB::table('application')
       ->select(DB::raw('count(*) as rcount'))                                            
        ->Where('status','pending')

       
  
       ->get();


       $rowTotalObjempty = DB::table('application')
       ->select(DB::raw('count(*) as rcount'))                                            
        ->WhereNull('status')     
  
       ->get();






       $myNewPostCountpending = $rowTotalObjpending[0]->rcount;
         
       $myNewPostCountempty= $rowTotalObjempty[0]->rcount;

      
       
return ["pending"=>$myNewPostCountpending, "empty"=>$myNewPostCountempty];
       
 


      }   
       
       
       
       
       
       
        
        ///$LastPostViewDate = Auth::user()->LastPostViewDate;


    }

//


                    


}



public function admissionformpaymentfail(Request $request){



    $dateaandtime=date ( 'Y-m-d ' );
    

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
 
 
 ->where('first_payment_time','<',$dateaandtime )
 ->where('first_payment_time','!=',$dateaandtime )



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
                       
          ->select('studentpayment.*', 'hallname.hallname','hallname.id','users.usercode')
          //->where('status','paid')
        
          ->where('first_payment_time','<',$dateaandtime )
          ->where('first_payment_time','!=',$dateaandtime )
        
 
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

         //$y = "<a class='task-del itmEdit' style='margin-left:4px' href='javascript:void(0);'><span class='label label-info'>Edit</span></a>";
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
            
             $arr['hallname_id'] = $r->hall_name;
       
             $arr['studentid'] = $r->perstudent_id;
             
            
            
             $arr['status'] = $r->status;
             
             $arr['month'] = $r->month;
             
             $arr['action'] = $z;


             
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




public function deleteaddmisionpaymentfail(Request $request){



        $id=$request->input("id");
        $hallname_id=$request->input("hallname_id");
        $room_no=$request->input("room_no");
        $studentid=$request->input("studentid");
    
  
        $room=DB::table('room')->select('emptyseat')
        ->where('hallid', $hallname_id)
        ->where('roomno', $room_no)
        ->get();
        foreach($room as $r){
    
            $get_room_emptyseat=$r->emptyseat;
    
            
    
        }
    
    $add_number_1=$get_room_emptyseat+1;
    
    $roo_update_value = DB::table('room')
                ->where('hallid', $hallname_id)
                ->where('roomno', $room_no)
    
                ->update(['emptyseat' =>  $add_number_1]);
    
    
        $obj = DB::table('application')->where('id',$id)->delete();
    
                    if($obj==true){
    
        $obj = DB::table('studentpayment')->where('perstudent_id',$studentid)->delete();
    

    
                    return 1;
                  }
    
    
    
    




}










public function leaveroomforstudent(Request $request){




    $columns = array(1=>'Serial',2=>'studentname',3=>'studentid',4=>'hallname', 5=>'room_no',6=>'phone',7=>'program',8=>'batchno',);
    $limit = $_POST['length'];
    $start = $_POST['start'];
    $order = $columns[$_POST['order'][0]['column']];
    $dir = $_POST['order'][0]['dir'];

    $search = $_POST['search']['value'];
//

   








$rowTotalObj = DB::table('application')
->join('users', 'application.studentid', '=', 'users.id')
->join('hallname', 'application.hallname_id', '=', 'hallname.id')

         ->select(DB::raw('count(*) as rcount'))
        
             // ->where('status','Accepted')
              
                ->where(function($query) use ($search)
                  {
                    if(!empty($search)):
                       $query->Where('studentname','like', '%' . $search . '%');
                       $query->orWhere('usercode','like', '%' . $search . '%');
                       $query->orWhere('hallname','like', '%' . $search . '%');
                       $query->orWhere('room_no','like', '%' . $search . '%');
                       $query->orWhere('phone','like', '%' . $search . '%');
                       $query->orWhere('program','like', '%' . $search . '%');
                       $query->orWhere('batchno','like', '%' . $search . '%');
                      

                    endif;
                  })
                 ->get();
      
                 


                 $totalData = $rowTotalObj[0]->rcount;




                 $posts = DB::table('application')
                 ->join('users', 'application.studentid', '=', 'users.id')
                ->join('hallname', 'application.hallname_id', '=', 'hallname.id')

                 ->select('application.*','hallname.hallname','users.usercode')
                     

                     // ->where('status','Accepted')

                     ->where(function($query) use ($search)
                       {
                         if(!empty($search)):
                       $query->Where('studentname','like', '%' . $search . '%');
                       $query->orWhere('usercode','like', '%' . $search . '%');
                       $query->orWhere('hallname','like', '%' . $search . '%');
                       $query->orWhere('room_no','like', '%' . $search . '%');
                       $query->orWhere('phone','like', '%' . $search . '%');
                       $query->orWhere('program','like', '%' . $search . '%');
                       $query->orWhere('batchno','like', '%' . $search . '%');
                      
         
                         endif;
                       })
                     ->offset($start)
                     ->limit($limit)
                     ->orderByRaw("id desc")
                     ->get();
         
         
                 $data = array();
         
                 if($posts){
         
         
                     $y = "<a class='task-del itmEdit' style='margin-left:4px' href='javascript:void(0);'><span class='label label-info'>Inactive</span></a>";
                     //$z = "<a class='task-del itmDrop' style='margin-left:4px' href='javascript:void(0);'><span class='label label-danger'>Cancel</span></a>";
         
         
         
         
                     $serial = $_POST['start'] + 1;
                     foreach($posts as $r){
                         $arr['id'] = $r->id;
                         $arr['Serial'] = $serial++;
                         $arr['studentid'] = $r->usercode;
                         $arr['studentname'] = $r->studentname;
                         $arr['phone'] = $r->cellno;
                         $arr['program'] = $r->program;
                         $arr['batchno'] = $r->batchno;
                         $arr['hallname'] = $r->hallname;
                         $arr['room_no'] = $r->room_no;
                       
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





    
    
}




public function inactiveeditforstudent(Request $request)
{


    $id=$request->input("recordId");
		


    $dateaandtime=date ( 'Y-m-d H:i:s' );
	
		   $obj = DB::table('application')->where('id',$id)->update(
	   
			   ['is_active' => $request->input("status"), 
			  
			   'updated_at' =>$dateaandtime
			  
			   ]		       
		   );
		   if($obj==true){
			   echo 1; 
	   
		   }
	   



    
}







}
