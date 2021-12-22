<?php

namespace App\Http\Controllers;
use App\Providers\RouteServiceProvider;
use App\Models\Hallname;
use Illuminate\Http\Request;
use Redirect,Response;
use DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class hallnameentryConttroller extends Controller
{
   


public function createhallname(Request $request){

    $file=$request->file('file');
    $nam=$file->getClientOriginalName();
    $file->move('images/',$nam);
    $obj = DB::table('hallname')
        ->updateOrInsert(
            
             [
             'hallname' => $request->input("hallname"), 
            
            'hallpic' => $nam,
            'gender' => $request->input("gender")


           

        ]
        ); 


if( $obj==true)

{
    return 1;
}

}


public function viewhallname(Request $request){


    $columns = array(2=>'hallname',3=>'hallpic',4=>'gender');

    $totalData = Hallname::count();
    $limit = $_POST['length'];
    $start = $_POST['start'];
    $order = $columns[$_POST['order'][0]['column']];
    $dir = $_POST['order'][0]['dir'];

    $search = $_POST['search']['value'];

    $posts = DB::table('hallname')
        ->select('id','hallname','hallpic','gender')
        ->where('hallname', 'LIKE', '%'.$search.'%')
        ->orWhere('hallpic', 'LIKE', '%'.$search.'%')
        ->orWhere('gender', 'LIKE', '%'.$search.'%')

   
        ->offset($start)
        ->limit($limit)
        ->orderByRaw('id','ASC')
        ->get();

    $data = array();

    if($posts){

        //$fileNot = "<a class='task-del fileUpload'  href='javascript:void(0);'><span class='label label-lemon'><i class='fa fa-upload'></i></span></a>";
        //$fileExist = "<a class='task-del fileUpload'  href='javascript:void(0);'><span class='label label-lemon'><i class='fa fa-file-pdf-o'></i></span></a>";


        $y = "<a class='task-del itmEdit' style='margin-left:4px' href='javascript:void(0);'><span class='label label-info'>Edit</span></a>";
        $z = "<a class='task-del itmDrop' style='margin-left:4px' href='javascript:void(0);'><span class='label label-danger'>Delete</span></a>";
        
        $serial = $_POST['start']+1;
        foreach($posts as $r){
            $arr['id'] = $r->id;
            $arr['Serial'] = $serial++;
            $arr['hallname'] = $r->hallname;
            $arr['hallpic'] = $r->hallpic;
            $arr['gender'] = $r->gender;

         
            $arr['action'] =$y.$z;
          
            
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


public function hallnameupdate(Request $request){



    $dateaandtime=date ( 'Y-m-d H:i:s' );


    $file=$request->file('file');


    if(!empty($file))
    {


        $nam=$file->getClientOriginalName();
        $file->move('images/',$nam);
    
    
        $id=$request->input("id");
           $obj = DB::table('hallname')->where('id',$id)->update(
       
               ['hallname' => $request->input("hallname"), 
               'hallpic' => $nam, 
               'gender' => $request->input("gender"),
               'updated_at' =>$dateaandtime
              
               ]		       
           );
           if($obj==true){
               echo 1; 
       
           }



    }

    
else{


    $id=$request->input("id");
    $obj = DB::table('hallname')->where('id',$id)->update(

        ['hallname' => $request->input("hallname"), 
        'gender' => $request->input("gender"),
        'updated_at' =>$dateaandtime
       
        ]		       
    );
    if($obj==true){
        echo 1; 

    }



}



   
   

}   




public function deletehallnametabledata(Request $request){



    $id=$request->input("id");
    $obj = DB::table('hallname')->where('id',$id)->delete();

        if($obj==true){

         return 1;
        }



}




}
