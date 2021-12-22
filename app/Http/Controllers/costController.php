<?php

namespace App\Http\Controllers;

use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;

use Redirect,Response;
use App\Models\Userentry;
use DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class costController extends Controller
{

public function gethallname(){


    $data=DB::table('hallname')->get();

    return view('costentry',['data'=>$data]);



}




public function costentry(Request $request){

    $dateaandtime=date ( 'Y-m-d H:i:s' );
    $obj = DB::table('cost')->updateOrInsert(

        ['hall_name' => $request->input("hall"), 
        'room_no' => $request->input("room"), 
        'description' => $request->input("descriptions"), 
        'date' => $request->input("date"),
        'amount' => $request->input("Amount"), 
		'created_at' =>$dateaandtime
        ]		       
    );
    if($obj==true){
        echo 1; 

    }


}



public function gethallnameandidfromhallnametable(Request $request)

{

    $data = DB::table('hallname')
    ->select('id', 'hallname')
->orderByRaw("hallname asc")
    ->get();

 return $data;




}











public function getcostlistdata(Request $request)

{



    $columns = array(1=>'Serial',2=>'hallname',3=>'room_no',4=>'description',5=>'date',6=>'amount',7=>'hallnameid');
    $limit = $_POST['length'];
    $start = $_POST['start'];
    $order = $columns[$_POST['order'][0]['column']];
    $dir = $_POST['order'][0]['dir'];

    $search = $_POST['search']['value'];




    $rowTotalObj = DB::table('cost')->join('hallname', 'cost.hall_name', '=', 'hallname.id')
    
    ->select(DB::raw('count(*) as rcount'))

					->where(function($query) use ($search)
		              {
		                if(!empty($search)):
                            $query->Where('hallname','like', '%' . $search . '%');
                            $query->orWhere('room_no','like', '%' . $search . '%');
                            $query->orWhere('description','like', '%' . $search . '%');
                            $query->orWhere('date','like', '%' . $search . '%');
                            $query->orWhere('amount','like', '%' . $search . '%');
                     
                            



		                 
		                  

		                endif;
		              })
                     ->get();
		$totalData = $rowTotalObj[0]->rcount;



        $posts = DB::table('cost')
       
        ->join('hallname', 'cost.hall_name', '=', 'hallname.id')

         	->select('cost.*', 'hallname.hallname','hallname.id as  hallnameid')
	
			->where(function($query) use ($search)
              {
                if(!empty($search)):
                           $query->Where('hallname','like', '%' . $search . '%');
		                   $query->orWhere('room_no','like', '%' . $search . '%');
		                   $query->orWhere('description','like', '%' . $search . '%');
		                   $query->orWhere('date','like', '%' . $search . '%');
		                   $query->orWhere('amount','like', '%' . $search . '%');
		            
                           
		                 
                   


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
				$arr['Serial'] = $serial++;
				$arr['hallnameid'] = $r->hallnameid;
              
				$arr['hallname'] = $r->hallname;
				$arr['roomno'] = $r->room_no;
				$arr['description'] = $r->description;
				$arr['date'] = $r->date;
				$arr['amount'] = $r->amount;
			
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


public function costedit(Request $request)

{


	$dateaandtime=date ( 'Y-m-d H:i:s' );
	$id=$request->input("recordid");
	   $obj = DB::table('cost')->where('id',$id)->update(
   
		   ['hall_name' => $request->input("hall"), 
		   'room_no' => $request->input("room"), 
		   'description' => $request->input("descriptions"), 
		   'date' => $request->input("date"),
		   'amount' => $request->input("amount"),
		 
		   'updated_at' =>$dateaandtime
		  
		   ]		       
	   );
	   if($obj==true){
		   echo 1; 
   
	   }
   



}


public function deletecostrow(Request $request)

{

	$id=$request->input("id");
	$obj = DB::table('cost')->where('id',$id)->delete();

		if($obj==true){

		 return 1;
		}




}




}
