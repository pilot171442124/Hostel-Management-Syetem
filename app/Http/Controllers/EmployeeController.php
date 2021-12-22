<?php

namespace App\Http\Controllers;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Redirect,Response;
use App\Models\Employee;
use DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class EmployeeController extends Controller
{
    //

public function getuserdataforselecttoemployee(Request $request){

    
    $data=DB::table('users')->select('id','usercode')->where('userrole','Employee')->get();
    $hallname=DB::table('hallname')->select('id','hallname')->get();

    return view('addnewemployee',['data'=>$data,'hallname'=>$hallname]);  



}

/*
public function gethallnameforemployee(Request $request){


    $hallname=DB::table('hallname')->select('id','hallname')->get();

    return view('addnewemployee',['hallname'=>$hallname]);  



}

*/

public function gethallname(Request $request){

    $posts = DB::table('hallname')
    ->select('id', 'hallname')
 ->orderByRaw("hallname asc")
    ->get();

 return $posts;


}






public function getothesnameofuser(Request $request){

if($request->ajax())
{
$name= $request->name;

 $posts = DB::table('users')
 ->select('name','phone')->where('id', $name)->get();
    
 foreach($posts as $row){
    return ["name"=>$row->name,"phone"=>$row->phone];
    
 }








}  
    
}


public function employeeentry(Request $request){



    $file=$request->file('file');
    $nam=$file->getClientOriginalName();
    $file->move('images/',$nam); 

    $obj=DB::table('employee')->updateOrInsert(

        ['userid' => $request->input("empid"), 
        'name' => $request->input("empname"),
        'gender' => $request->input("gender"),

        'emptype' => $request->input("emptype"),
        'dob' => $request->input("dob"), 
        'phone' => $request->input("phone"), 
        'address' => $request->input("empadd"), 
        'doj' => $request->input("doj"), 
        'hallnameid' => $request->input("hallname"), 

        'designation' => $request->input("empdesig"), 

        'salary' => $request->input("salary"),
        'isactive' => $request->input("empstatus"),
        'perphoto' =>$nam


        ]
    );
    
    if($obj==true)
    {
        return 1;
    }



}


public function getemployeelist(Request $request){



    $columns = array(2=>'name',3=>'userid',4=>'emptype',5=>'gender',6=>'dob',7=>'phone',8=>'address',9=>'doj',10=>'designation',11=>'salary',12=>'isactive',13=>'prephoto');
    $limit = $_POST['length'];
    $start = $_POST['start'];
    $order = $columns[$_POST['order'][0]['column']];
    $dir = $_POST['order'][0]['dir'];

    $search = $_POST['search']['value'];




    $rowTotalObj = DB::table('employee')->join('hallname', 'employee.hallnameid', '=', 'hallname.id')->select(DB::raw('count(*) as rcount'))

					->where(function($query) use ($search)
		              {
		                if(!empty($search)):
		                  $query->Where('name','like', '%' . $search . '%');
		                   $query->orWhere('hallname','like', '%' . $search . '%');
		                   $query->orWhere('emptype','like', '%' . $search . '%');

		                   $query->orWhere('phone','like', '%' . $search . '%');
		                   $query->orWhere('address','like', '%' . $search . '%');
		                   $query->orWhere('doj','like', '%' . $search . '%');
		                   $query->orWhere('salary','like', '%' . $search . '%');
		                   $query->orWhere('isactive','like', '%' . $search . '%');



		                endif;
		              })
                     ->get();
		$totalData = $rowTotalObj[0]->rcount;



		
        $posts = DB::table('employee')
         	->join('hallname', 'employee.hallnameid', '=', 'hallname.id')
             //->join( 'users','employee.userid','=','users.id')
         	->select('employee.*', 'hallname.hallname','hallname.id as hallnameid')
	
			->where(function($query) use ($search)
              {
                if(!empty($search)):
                   $query->Where('name','like', '%' . $search . '%');
                   $query->orWhere('hallname','like', '%' . $search . '%');  
                   $query->orWhere('emptype','like', '%' . $search . '%');

                  $query->orWhere('phone','like', '%' . $search . '%');
                   $query->orWhere('address','like', '%' . $search . '%');
                    $query->orWhere('doj','like', '%' . $search . '%');
                    $query->orWhere('salary','like', '%' . $search . '%');
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
			$x = ".Tk";
            

			$serial = $_POST['start'] + 1;
			foreach($posts as $r){
				$arr['id'] = $r->id;
				$arr['Serial'] = $serial++;
                $arr['name'] = $r->name;
                $arr['hallnameid'] = $r->hallnameid;

                $arr['hallname'] = $r->hallname;
                $arr['emptype'] = $r->emptype;

				$arr['phone'] = $r->phone;
				$arr['address'] = $r->address;

				$arr['doj'] = $r->doj;
				$arr['salary'] = $r->salary." ".$x;
				$arr['perphoto'] = $r->perphoto;
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


public function  employeeformedit(Request $request){

    $dateaandtime=date ( 'Y-m-d H:i:s' );
    $file=$request->file('file');

$salary=$request->input("salary");
$removestring=str_replace(".Tk","",$salary);

    if(!empty($file))
    {

                $nam=$file->getClientOriginalName();
                    $file->move('images/',$nam);

                $id=$request->input("id");
                $obj = DB::table('employee')->where('id',$id)->update(
            
                    ['name' => $request->input("empname"), 
                    'hallnameid' => $request->input("hallname"), 
                    'emptype' => $request->input("emptype"), 
                    'phone' => $request->input("phone"),
                    'address' => $request->input("empadd"),
                    'doj' => $request->input("doj"),
                    'salary' => $removestring,
                    'perphoto' => $nam,
                    'isactive' => $request->input("empstatus"),

                    'updated_at' =>$dateaandtime
                    
                    ]		       
                );
                if($obj==true){
                    echo 1; 
            
                }

    }

else{

                $id=$request->input("id");
                $obj = DB::table('employee')->where('id',$id)->update(

                    ['name' => $request->input("empname"), 
                    'hallnameid' => $request->input("hallname"), 
                    'emptype' => $request->input("emptype"), 
                    'phone' => $request->input("phone"),
                    'address' => $request->input("empadd"),
                    'doj' => $request->input("doj"),
                    'salary' => $removestring,
                    'isactive' => $request->input("empstatus"),
                    
                    'updated_at' =>$dateaandtime
                
                    ]		       
                );
                if($obj==true){
                    echo 1; 

                }




            }


}


public function deleteemployeetabledatasRoute(Request $request){


    $id=$request->input("id");
    $obj = DB::table('employee')->where('id',$id)->delete();

        if($obj==true){

         return 1;
        }

}




}
