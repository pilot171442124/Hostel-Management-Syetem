<?php

namespace App\Http\Controllers;

use App\Models\Manageloginid;
use Illuminate\Http\Request;
use Excel;
use DB;
use App\Imports\StudentidImport;
class ImportidbyExcelController extends Controller
{
    

    public function import(Request $request){


        \Excel::import(new StudentidImport,$request->file);

        //\Session::put('success', 'Your file is imported successfully in database.');
           
        return back();

        
}



public function importstudentid(Request $request){



	$columns = array(1=>'Serial',2=>'studentid',3=>'studentname',4=>'studentdept');

    $limit = $_POST['length'];
    $start = $_POST['start'];
    $order = $columns[$_POST['order'][0]['column']];
    $dir = $_POST['order'][0]['dir'];

    $search = $_POST['search']['value'];




    $rowTotalObj = DB::table('manageloginid')->select(DB::raw('count(*) as rcount'))
    
					->where(function($query) use ($search)
		              {
		                if(!empty($search)):
					$query->Where('studentid','like', '%' . $search . '%');
					$query->orWhere('studentname','like', '%' . $search . '%');
						
					$query->orWhere('studentdept','like', '%' . $search . '%');
					
	


		                endif;
		              })
                     ->get();
		$totalData = $rowTotalObj[0]->rcount;



        $posts = DB::table('manageloginid')
         
             ->select('manageloginid.*')
         
			
	
			->where(function($query) use ($search)
              {
                if(!empty($search)):
					$query->Where('studentid','like', '%' . $search . '%');
					$query->orWhere('studentname','like', '%' . $search . '%');
					
					
					$query->orWhere('studentdept','like', '%' . $search . '%');
				

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
				$arr['studentid'] = $r->studentid;
				$arr['Serial'] = $serial++;
				$arr['studentname'] = $r->studentname;
				$arr['batch'] = $r->batch;

				$arr['studentdept'] = $r->studentdept;
				
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





public function updateimportinformation(Request $request)
{



	$dateaandtime=date ( 'Y-m-d H:i:s' );
	$id=$request->input("id");
	   $obj = DB::table('manageloginid')->where('id',$id)->update(
   
		   [
		   'studentid' => $request->input("studentid"), 
		   'studentname' => $request->input("studentname"), 
		   'batch' => $request->input("batch"), 
		   'studentdept' => $request->input("department"),
		 
		   'updated_at' =>$dateaandtime
		  
		   ]		       
	   );
	   if($obj==true){
		   echo 1; 
   
	   }



}




public function deletestudentinformationnameRoute(Request $request)


{

	$id=$request->input("id");
	$obj = DB::table('manageloginid')->where('id',$id)->delete();

		if($obj==true){

		 return 1;
		}





}


public function importidsingle(Request $request)

{
	$dateaandtime=date ( 'Y-m-d H:i:s' );


	$obj = DB::table('manageloginid')->updateOrInsert(

        ['studentid' => $request->input("studentid"), 
        'studentname' => $request->input("studentname"), 
        'studentdept' => $request->input("studentdept"), 
        'batch' => $request->input("batch"), 
      
        
		'created_at' =>$dateaandtime
        ]		       
    );
    if($obj==true){
        echo 1; 

    }



}

}







