<?php

namespace App\Http\Controllers;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Redirect,Response;
use App\Models\Room;
use DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
class createaandshowController extends Controller
{
    
public function getdataformhallnametable(){


    $data=DB::table('hallname')->get();

    return view('createroom',['data'=>$data]);
    
}

/*
public function getdataforselectvalue(){


    $data=DB::table('hallname')->get();

    return view('viewroomdetails',['data'=>$data]);
    
}

*/
public function getDepartmentList()
{

  $posts = DB::table('hallname')
		  ->select('id', 'hallname')
	->orderByRaw("hallname asc")
		  ->get();

	   return $posts;
}





public function createroom( Request $request){

$obj=DB::table('room')->updateOrInsert(

    ['roomno' => $request->input("roomno"), 
    'noofseat' => $request->input("noofseat"),
    'emptyseat' => $request->input("noofemptyseat"),
    'hallid' => $request->input("hallname"), 
	'cost' => $request->input("cost"),
    'isactive' => $request->input("activestatusofroom"),
    ]
);

if($obj==true)
{

	return 1;
}

}

public function getroomdata(Request $request){
    $columns = array(1=>'Serial',2=>'hallname',3=>'hallname',4=>'roomno',5=>'noofseat',6=>'emptyseat',7=>'cost',8=>'isactive',);
    $limit = $_POST['length'];
    $start = $_POST['start'];
    $order = $columns[$_POST['order'][0]['column']];
    $dir = $_POST['order'][0]['dir'];

    $search = $_POST['search']['value'];




    $rowTotalObj = DB::table('room')->join('hallname', 'room.hallid', '=', 'hallname.id')->select(DB::raw('count(*) as rcount'))

					->where(function($query) use ($search)
		              {
		                if(!empty($search)):
		                  $query->Where('roomno','like', '%' . $search . '%');
		                   $query->orWhere('hallname','like', '%' . $search . '%');

                          
		                   $query->orWhere('noofseat','like', '%' . $search . '%');
		                   $query->orWhere('hallid','like', '%' . $search . '%');
		                   $query->orWhere('emptyseat','like', '%' . $search . '%');
		                   $query->orWhere('isactive','like', '%' . $search . '%');


		                endif;
		              })
                     ->get();
		$totalData = $rowTotalObj[0]->rcount;



        $posts = DB::table('room')
         	->join('hallname', 'room.hallid', '=', 'hallname.id')
         	->select('room.*', 'hallname.hallname','hallname.id as hallnameid')
	
			->where(function($query) use ($search)
              {
                if(!empty($search)):
                   $query->Where('roomno','like', '%' . $search . '%');
                   $query->orWhere('hallname','like', '%' . $search . '%');

                   $query->orWhere('noofseat','like', '%' . $search . '%');
                   $query->orWhere('hallid','like', '%' . $search . '%');
                   $query->orWhere('emptyseat','like', '%' . $search . '%');
                   $query->orWhere('isactive','like', '%' . $search . '%');


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
				$arr['hallnameid'] = $r->hallnameid;
				$arr['Serial'] = $serial++;
				$arr['roomno'] = $r->roomno;
				$arr['noofseat'] = $r->noofseat;
				$arr['hallname'] = $r->hallname;
				$arr['emptyseat'] = $r->emptyseat;
				$arr['newemptydate'] = $r->newemptydate;
				$arr['newemptyno'] = $r->newemptyno;
				
				$arr['cost'] = $r->cost;
				$arr['isactive'] = $r->isactive;
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
        
	

	public function	editroomform(Request $request){


		$dateaandtime=date ( 'Y-m-d H:i:s' );
		$id=$request->input("id");
		   $obj = DB::table('room')->where('id',$id)->update(
	   
			   ['roomno' => $request->input("roomno"), 
			   'noofseat' => $request->input("noofseat"), 
			   'hallid' => $request->input("hallname"), 
			   'emptyseat' => $request->input("noofemptyseat"),
			   'newemptydate' => $request->input("newemptydate"),
			   'newemptyno' => $request->input("newemptyno"),

			   'cost' => $request->input("cost"),
			   
			   'isactive' => $request->input("activestatusofroom"),
			   'updated_at' =>$dateaandtime
			  
			   ]		       
		   );



		   
		   if($obj==true){
			   echo 1; 
	   
		   }


	}


public function deleteroomform(Request $request){


	$id=$request->input("id");
    $obj = DB::table('room')->where('id',$id)->delete();

        if($obj==true){

         return 1;
        }



}



}
