<?php

namespace App\Http\Controllers;
use App\Providers\RouteServiceProvider;
use App\Models\Salary;
use Illuminate\Http\Request;
use Redirect,Response;
use DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;


class salaryController extends Controller
{
    

public function  getdataforsalraycarete(Request $request){

   

   
    $data=DB::table('users')->select('id','usercode')->where('userrole','Employee')->get();


    return view('addsalary',['data'=>$data]);  

}


public function getinputdataforsalary(Request $request){

                
            if($request->ajax())
            {

                        $salary= $request->salary;

                        $posts = DB::table('employee')
                        ->select('name','phone','emptype','hallnameid')->where('userid', $salary)->get();
                        

                        foreach($posts as $row){


                            return ["name"=>$row->name,"phone"=>$row->phone,"emptype"=>$row->emptype,"hallnameid"=>$row->hallnameid,];
                            



                        }   
                        
                     

            }



    }



public function getspecifichallname(Request $request){



    if($request->ajax())
    {


    $hallnameid= $request->id; 


                if(!empty($hallnameid))
                {

                    $posts = DB::table('hallname')
                    ->select('id', 'hallname')->where('id',$hallnameid)->get();
                        
                    
                    return $posts ;
                    
                }
            else{

                return 0;
            }





        



}



}

public function salaryentry(Request $request){

	$dateaandtime=date ( 'Y-m-d H:i:s' );

    $obj=DB::table('salary')->updateOrInsert(

        ['empid' => $request->input("empid"), 
        'hallnameid' => $request->input("hallnameid"),
        'empname' => $request->input("empname"),
        'emptype' => $request->input("emptype"), 
        'empphone' => $request->input("phone"),
        'amount' => $request->input("amount"),
        'monthyear' => $request->input("monthandyear"),
        'bonus' => $request->input("bonus"),
        'created_at' => $dateaandtime,


        ]
    );
    
    if($obj==true)
    {
        return 1;
    }
    
    }




public function viewsalarylist(Request $request){


    $columns = array(1=>'Serial',2=>'empid',3=>'hallname',4=>'empname',5=>'emptype',6=>'phone',7=>'amount',8=>'bonus',9=>'month');
    $limit = $_POST['length'];
    $start = $_POST['start'];
    $order = $columns[$_POST['order'][0]['column']];
    $dir = $_POST['order'][0]['dir'];

    $search = $_POST['search']['value'];




    $rowTotalObj = DB::table('salary')->join('users', 'salary.empid', '=', 'users.id')
    
    ->join('hallname', 'salary.hallnameid', '=', 'hallname.id')
    
    ->select(DB::raw('count(*) as rcount'))

					->where(function($query) use ($search)
		              {
		                if(!empty($search)):
		                  $query->Where('usercode','like', '%' . $search . '%');
		                   $query->orWhere('hallname','like', '%' . $search . '%');
		                   $query->orWhere('empname','like', '%' . $search . '%');
		                   $query->orWhere('emptype','like', '%' . $search . '%');
		                   $query->orWhere('amount','like', '%' . $search . '%');
		                   $query->orWhere('bonus','like', '%' . $search . '%');
		                   $query->orWhere('phone','like', '%' . $search . '%');


		                   



		                 
		                  

		                endif;
		              })
                     ->get();
		$totalData = $rowTotalObj[0]->rcount;



        $posts = DB::table('salary')
        ->join('users', 'salary.empid', '=', 'users.id')
        ->join('hallname', 'salary.hallnameid', '=', 'hallname.id')

         	->select('salary.*', 'hallname.hallname','users.usercode')
	
			->where(function($query) use ($search)
              {
                if(!empty($search)):
                           $query->Where('usercode','like', '%' . $search . '%');
		                   $query->orWhere('hallname','like', '%' . $search . '%');
		                   $query->orWhere('empname','like', '%' . $search . '%');
		                   $query->orWhere('emptype','like', '%' . $search . '%');
		                   $query->orWhere('amount','like', '%' . $search . '%');
		                   $query->orWhere('bonus','like', '%' . $search . '%');
		                   $query->orWhere('phone','like', '%' . $search . '%');

		                   
                           
		                 
                   


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
                $arr['employeeid'] = $r->usercode;
				$arr['hallname'] = $r->hallname;
				$arr['empname'] = $r->empname;
				$arr['emptype'] = $r->emptype;
				$arr['phone'] = $r->empphone;
				$arr['amount'] = $r->amount;
				$arr['bonus'] = $r->bonus;
				$arr['monthyear'] = $r->monthyear;

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
        




public function salaryedit(Request $request){


    $dateaandtime=date ( 'Y-m-d H:i:s' );
    $id=$request->input("id");
       $obj = DB::table('salary')->where('id',$id)->update(
   
           ['empname' => $request->input("empname"), 
           'emptype' => $request->input("emptype"), 
           'empphone' => $request->input("phone"), 
           'amount' => $request->input("amount"),
           'monthyear' => $request->input("monthandyear"),
           'bonus' => $request->input("bonus"),

           'updated_at' =>$dateaandtime
          
           ]		       
       );
       if($obj==true){
           echo 1; 
   
       }


    }


public function deletesalarydata(Request $request){


    $id=$request->input("id");
    $obj = DB::table('salary')->where('id',$id)->delete();

        if($obj==true){

         return 1;
        }



}




}






