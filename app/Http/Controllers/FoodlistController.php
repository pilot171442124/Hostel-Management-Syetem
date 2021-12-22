<?php
namespace App\Http\Controllers;
use App\Providers\RouteServiceProvider;

use Illuminate\Http\Request;
use Redirect,Response;
use DB;
use Auth;
use Carbon\Carbon;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class FoodlistController extends Controller
{
    public function addfoodlistentry(Request $request){


        $dateaandtime=date ( 'Y-m-d H:i:s' );
        $obj = DB::table('foodlistentry')->updateOrInsert(
    
            ['morning' => $request->input("Morning"), 
            'lunch' => $request->input("Lunch"),
            'dinner' => $request->input("Dinner"), 
            'price' => $request->input("Price"), 


         
           
            'status' => $request->input("activestatus"),
           
            'created_at' =>$dateaandtime
            ]		       
        );
        if($obj==true){
            echo 1; 
    
        }

        

    }




public function foodlistentry(Request $request)

{

  
    

    $foodlist_name=$request->name;
    $foodlist_price=$request->price;
   






    $number = count($foodlist_name);




    if($number > 0)  
    {  
         for($i=0; $i<$number; $i++)  
         {  
         

                $dateaandtime=date ( 'Y-m-d H:i:s' );
                $obj = DB::table('foodlist')->updateOrInsert(
            
                    ['foodname' => $foodlist_name[$i], 
                    'foodprice' => $foodlist_price[$i], 
                   
                  
               
                    ]		       
                );
          



       
    } 





}









}



public function getfoodlist(Request $request)
{
    
    $posts = DB::table('foodlist')
           //->select('StudentsId', 'StudentName')
            ->select(DB::raw("id,CONCAT(foodname) as StudentName"))
            ->orderByRaw("StudentName asc")
            ->get();

         return $posts;



}



public function foodlistentryperday(Request $request)

{


    $dateaandtime=Carbon::today()->toDateString();


    $foodid = json_decode($request->input("foodid"), true );

    $foodselecttime=$request->foodselecttime;


    foreach($foodid as $foodid){
        
     $get_food_id=$foodid;



     $multipledata[]=array(


        'foodid' => $get_food_id, 
      
        'food_status' =>'Y', 
        'date'=>$dateaandtime,
        'foodselecttime'=>$foodselecttime,



    );


    }

	$obj=DB::table('foodmenuperday')->Insert($multipledata);

	

if( $obj==true)

{
return 1;

}


  
}



public function getfooditesam(Request $request)

{


    $columns = array(1=>'Serial', 2=>'foodname',3=>'foodprice',4=>'food_status',);
    $limit = $_POST['length'];
    $start = $_POST['start'];
    $order = $columns[$_POST['order'][0]['column']];
    $dir = $_POST['order'][0]['dir'];

    $search = $_POST['search']['value'];




    $rowTotalObj = DB::table('foodmenuperday')
    ->join('foodlist', 'foodmenuperday.foodid', '=', 'foodlist.id')
   // ->join('users', 'studentpayment.perstudent_id', '=', 'users.id')
    
    
    ->select(DB::raw('count(*) as rcount'))
    
    
    //->where('status','paid')

					->where(function($query) use ($search)
		              {
		                if(!empty($search)):
		                  $query->Where('foodname','like', '%' . $search . '%');
		                   $query->orWhere('foodlist.foodprice','like', '%' . $search . '%');
		                  
                           $query->orWhere('foodselecttime','like', '%' . $search . '%');
						 
						
	


		                endif;
		              })
                     ->get();
		$totalData = $rowTotalObj[0]->rcount;



        $posts = DB::table('foodmenuperday')
        ->join('foodlist', 'foodmenuperday.foodid', '=', 'foodlist.id')

                	
             ->select('foodmenuperday.*', 'foodlist.foodname','foodlist.foodprice',)
             //->where('status','paid')
	
			->where(function($query) use ($search)
              {
                if(!empty($search)):
                   
					
                    $query->Where('foodname','like', '%' . $search . '%');
                    $query->orWhere('foodlist.foodprice','like', '%' . $search . '%');
                    $query->orWhere('foodselecttime','like', '%' . $search . '%');
                   
                  
                 

					
				

                endif;
              })
			->offset($start)
			->limit($limit)

		 ->orderByRaw("id desc")

			//->orderByRaw("$order $dir")
            ->get();


		$data = array();

		if($posts){

			$z = "<a class='task-del itmDrop' style='margin-left:4px' href='javascript:void(0);'><span class='label label-danger'>Delete</span></a>";
        
            $y=" <span >&nbsp;.Tk </span>";


			$serial = $_POST['start'] + 1;
			foreach($posts as $r){



                $checked_NotAvailable="";
                $checked_Available="";
                
                if($r->food_status == 'Y'){
                    $checked_Available="checked";
                }
                if($r->food_status == 'N'){
                    $checked_NotAvailable="checked";
                }
                else{
                    $checked_Available="checked";
                }
    
                
                
                $AttItemId=$r->id;
    
                    $Available = "<input class='attChange' type='radio' id='absence".$AttItemId."' name='Checksufficient".$AttItemId."' value='Y' ".$checked_Available.">";
                    $NotAvailable = "<input class='attChange' type='radio' id='present".$AttItemId."' name='Checksufficient".$AttItemId."' value='N' ".$checked_NotAvailable.">";
    
    






				$arr['id'] = $r->id;
				$arr['foodname'] = $r->foodname;
				$arr['Serial'] = $serial++;
				$arr['foodprice'] = $r->foodprice.$y;
				$arr['Available'] = $Available;
				$arr['NotAvailable'] = $NotAvailable;
				$arr['time'] = $r->foodselecttime;

				$arr['date'] = $r->date;
				
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




public function updatefoodstatusRoute(Request $request)

{


    $id=$request->recordId;

    $Checksufficient=$request->Checksufficient;
    
    
    
    $dateaandtime=date ( 'Y-m-d H:i:s' );
            
               $obj = DB::table('foodmenuperday')->where('id',$id)->update(
           
                 [
                       
                    'food_status' => $Checksufficient, 
                  
                  
                   'updated_at' =>$dateaandtime
                  
                   ]		       
               );
              if($obj==true){
                   echo 1; 
           
              }
    
    
    




}



public function deletetodaymenulistRoute(Request $request)

{


    $id=$request->id;
    $obj = DB::table('foodmenuperday')->where('id',$id)->delete();

        if($obj==true){

         return 1;
        }



    
}



public function getfoodilisttime(Request $request)

{

    $dateaandtime=Carbon::today()->toDateString();



    $columns = array(1=>'Serial', 2=>'foodname',3=>'foodprice',4=>'food_status',);
    $limit = $_POST['length'];
    $start = $_POST['start'];
    $order = $columns[$_POST['order'][0]['column']];
    $dir = $_POST['order'][0]['dir'];

    $search = $_POST['search']['value'];




    $rowTotalObj = DB::table('foodmenuperday')
    ->join('foodlist', 'foodmenuperday.foodid', '=', 'foodlist.id')
   // ->join('users', 'studentpayment.perstudent_id', '=', 'users.id')
    
    
    ->select(DB::raw('count(*) as rcount'))
    
    
    //->where('status','paid')

					->where(function($query) use ($search)
		              {
		                if(!empty($search)):
		                  $query->Where('foodname','like', '%' . $search . '%');
		                   $query->orWhere('foodlist.foodprice','like', '%' . $search . '%');
		                  
                           $query->orWhere('foodselecttime','like', '%' . $search . '%');
						 
						
	


		                endif;
		              })
                     ->get();
		$totalData = $rowTotalObj[0]->rcount;



        $posts = DB::table('foodmenuperday')
        ->join('foodlist', 'foodmenuperday.foodid', '=', 'foodlist.id')

                	
             ->select('foodmenuperday.*', 'foodlist.foodname','foodlist.foodprice',)
             ->where('date',$dateaandtime)
	
			->where(function($query) use ($search)
              {
                if(!empty($search)):
                   
					
                    $query->Where('foodname','like', '%' . $search . '%');
                    $query->orWhere('foodlist.foodprice','like', '%' . $search . '%');
                    $query->orWhere('foodselecttime','like', '%' . $search . '%');
                   
                  
                 

					
				

                endif;
              })
			->offset($start)
			->limit($limit)
			
		   ->orderByRaw("id desc")
            
            
            //->orderByRaw("$order $dir")
            ->get();


		$data = array();

		if($posts){

			$z = "<a class='task-del itmDrop' style='margin-left:4px' href='javascript:void(0);'><span class='label label-danger'>Delete</span></a>";
        
            $y=" <span >&nbsp;.Tk </span>";


			$serial = $_POST['start'] + 1;
			foreach($posts as $r){


                $Available="";
                $NotAvailable="";
                if($r->food_status=="Y"){


                    $Available="Available";
            
            
                }
                else{
                
                    $NotAvailable="Not Available";
                }
            





				$arr['id'] = $r->id;
				$arr['foodname'] = $r->foodname;
				$arr['Serial'] = $serial++;
				$arr['foodprice'] = $r->foodprice.$y;
				$arr['Available'] = $Available;
				$arr['NotAvailable'] = $NotAvailable;
				$arr['time'] = $r->foodselecttime;

				$arr['date'] = $r->date;
				
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



public function getfoodlistperday(Request $request) 
{

    $posts = DB::table('foodmenuperday')
    //->select('StudentsId', 'StudentName')
    ->join('foodlist', 'foodmenuperday.foodid', '=', 'foodlist.id')


     ->select('foodmenuperday.*','foodlist.foodname',)
     ->orderByRaw("id asc")
     ->get();

  return $posts;


}



public function getuserid(Request $request)
{

    $posts = DB::table('users')

     ->select('users.*',)
     ->orderByRaw("id asc")
     ->get();

  return $posts;


}


public function foodmenutentryperday(Request $request)

{

    $dateaandtime=Carbon::today()->toDateString();

$time=time();


    $multipledata=array();


    $foodid = json_decode($request->input("foodid"), true );
   $userid=$request->input("selectid");




  $posts = DB::table('foodlist')->whereIn('id',$foodid)->sum('foodprice');






  foreach($foodid as $foodid){
        
    $get_food_id=$foodid;



    $multipledata[]=array(


       'foodid' => $get_food_id, 
     
  
     
       'userid'=>$userid,
       'date'=>$dateaandtime,
       'invoice'=>$time,


   );


   }


   $obj=DB::table('storefoodid')->Insert($multipledata);




 

if($obj==true){

   
    $obj2 = DB::table('makebill')->updateOrInsert(

        [
     
            'ueserid' => $userid, 
             'perbill'=>$posts,
             'date'=>$dateaandtime,
             'invoiceno'=>$time,
    
    
        ]		       
    );
    
   
   
   
   
   
    return 1;
   }


  



}



public function getprice(Request $request)

{

    $foodid = $request->foodid;
    


    $posts = DB::table('foodlist')->whereIn('id',$foodid)->sum('foodprice');




    return $posts;






    
}


public function getbilllist(Request $request)

{



    $columns = array(1=>'Serial', 2=>'userid',3=>'perbill',4=>'date',);
    $limit = $_POST['length'];
    $start = $_POST['start'];
    $order = $columns[$_POST['order'][0]['column']];
    $dir = $_POST['order'][0]['dir'];

    $search = $_POST['search']['value'];




    $rowTotalObj = DB::table('makebill')
    ->join('users', 'makebill.ueserid', '=', 'users.id')
   // ->join('users', 'studentpayment.perstudent_id', '=', 'users.id')
    
    
    ->select(DB::raw('count(*) as rcount'))
    
    
    //->where('status','paid')

					->where(function($query) use ($search)
		              {
		                if(!empty($search)):
		                  $query->Where('usercode','like', '%' . $search . '%');
		                   $query->orWhere('perbill','like', '%' . $search . '%');
		                  
                           $query->orWhere('date','like', '%' . $search . '%');
						 
						
	


		                endif;
		              })
                     ->get();
		$totalData = $rowTotalObj[0]->rcount;



        $posts = DB::table('makebill')
       
        ->join('users', 'makebill.ueserid', '=', 'users.id')
       
       
        //->join('foodlist', 'foodmenuperday.foodid', '=', 'foodlist.id')

                	
             ->select('makebill.*', 'users.usercode','users.name')
             //->where('status','paid')
	
			->where(function($query) use ($search)
              {
                if(!empty($search)):
                   
					
                    $query->Where('usercode','like', '%' . $search . '%');
                    $query->orWhere('perbill','like', '%' . $search . '%');
                   
                    $query->orWhere('date','like', '%' . $search . '%');
                  
                  
                 

					
				

                endif;
              })
			->offset($start)
			->limit($limit)
			
		   ->orderByRaw("id desc")
            
            
            //->orderByRaw("$order $dir")
            ->get();


		$data = array();





		if($posts){

		
	     $serial = $_POST['start'] + 1;
			foreach($posts as $r){


                $x = "<a class='task-del itmview' style='margin-left:4px' href='javascript:void(0);'><span class='label label-info'>View</span></a>";

           
                $z = "<a class='task-del itmDrop' style='margin-left:4px' href='javascript:void(0);'><span class='label label-danger'>Delete</span></a>";
    
    


             
				$arr['id'] = $r->id;
				$arr['userid'] = $r->usercode;
				$arr['name'] = $r->name;
				$arr['invoiceno'] = $r->invoiceno;
				

				$arr['Serial'] = $serial++;
				$arr['foodprice'] = $r->perbill;
                
			
				$arr['date'] = $r->date;
				
				$arr['action'] = $x.$z;
		
				
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



public function getfoodlistasperuser(Request $request)

{
  

    $invoiceno=$request->invoiceno;

$getid=$request->recordid;


    $take_food_id=array();
    $get_food_name=array();
        $get_userid = DB::table('makebill')->select('ueserid','invoiceno')->where('id',$getid)->where('invoiceno',$invoiceno)->get();
           foreach($get_userid as $get_userid){
    
             $takeid=$get_userid->ueserid;
             $invoice_no=$get_userid->invoiceno;
    
           }
      
        $get_foodid = DB::table('storefoodid')->select('foodid')->where('userid',$takeid)->where('invoice',$invoice_no)->get();
       
    
         foreach($get_foodid as $get_foodid){
    
            $take_food_id[]=$get_foodid->foodid;
    
          }
    
    
    
    
     $get_food_nameid = DB::table('foodlist')->whereIn('id',$take_food_id)->get();
     
     
   



foreach ($get_food_nameid as $value) {
    
$foodname[]=$value->foodname;
$foodprice[]=$value->foodprice;

$dataccount=count($get_food_nameid);




}

if ($dataccount>0) {

for ($i=0; $i <$dataccount ; $i++) { 
  
echo '<tr><td>'.$foodname[$i].'</td> <td>'.$foodprice[$i].'</td> </tr>';
  

 
}


}
else {
    echo  "not available data";



}
 




}

public function deletemakebill(Request $request)

{

    $id=$request->id;
    $obj = DB::table('makebill')->where('id',$id)->delete();

        if($obj==true){

         return 1;
        }



}



public function getfoodlistentry(Request $request)


{


    $columns = array(1=>'Serial', 2=>'foodname',3=>'foodprice',);
    $limit = $_POST['length'];
    $start = $_POST['start'];
    $order = $columns[$_POST['order'][0]['column']];
    $dir = $_POST['order'][0]['dir'];

    $search = $_POST['search']['value'];




    $rowTotalObj = DB::table('foodlist')
   
    ->select(DB::raw('count(*) as rcount'))
    
    


					->where(function($query) use ($search)
		              {
		                if(!empty($search)):
                            $query->Where('foodname','like', '%' . $search . '%');
                            $query->orWhere('foodprice','like', '%' . $search . '%');
                            
                           
	


		                endif;
		              })
                     ->get();
		$totalData = $rowTotalObj[0]->rcount;



        $posts = DB::table('foodlist')
       
       

                	
             ->select('foodlist.*',)
             //->where('status','paid')
	
			->where(function($query) use ($search)
              {
                if(!empty($search)):
                   
					
                    $query->Where('foodname','like', '%' . $search . '%');
                    $query->orWhere('foodprice','like', '%' . $search . '%');
                    
                   
                  
                 

					
				

                endif;
              })
			->offset($start)
			->limit($limit)
			
		   ->orderByRaw("id desc")
            
            
            //->orderByRaw("$order $dir")
            ->get();


		$data = array();





		if($posts){

		
	     $serial = $_POST['start'] + 1;
			foreach($posts as $r){


                $x = "<a class='task-del itmEdit' style='margin-left:4px' href='javascript:void(0);'><span class='label label-info'>Edit</span></a>";

           
                $z = "<a class='task-del itmDrop' style='margin-left:4px' href='javascript:void(0);'><span class='label label-danger'>Delete</span></a>";
    
    


             
				$arr['id'] = $r->id;
				$arr['Serial'] = $serial++;
				$arr['foodname'] = $r->foodname;
				$arr['foodprice'] = $r->foodprice;

				$arr['action'] = $x.$z;
		
				
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


public function foodlistdelete(Request $request)

{


    $id=$request->id;
    $obj = DB::table('foodlist')->where('id',$id)->delete();

        if($obj==true){

         return 1;
        }


}



public function getfpricer(Request $request)

{



    $invoiceno=$request->invoiceno;

    $getid=$request->recordid;
    
    
        $take_food_id=array();
        $get_food_name=array();
            $get_userid = DB::table('makebill')->select('ueserid','invoiceno')->where('id',$getid)->where('invoiceno',$invoiceno)->get();
               foreach($get_userid as $get_userid){
        
                 $takeid=$get_userid->ueserid;
                 $invoice_no=$get_userid->invoiceno;
        
               }
          
            $get_foodid = DB::table('storefoodid')->select('foodid')->where('userid',$takeid)->where('invoice',$invoice_no)->get();
           
        
             foreach($get_foodid as $get_foodid){
        
                $take_food_id[]=$get_foodid->foodid;
        
              }
        
        
        
        
         $get_food_nameid = DB::table('foodlist')->whereIn('id',$take_food_id)->get();
         
         
        $get_food_sum= DB::table('foodlist')->whereIn('id',$take_food_id)->sum('foodprice');
    
    
    
   
    
    
    return $get_food_sum;




}


public function foodlistedit(Request $request)
{
    
    $dateaandtime=date ( 'Y-m-d H:i:s' );
    $id=$request->input("id");
       $obj = DB::table('foodlist')->where('id',$id)->update(
   
           ['foodname' => $request->input("foodname"), 
           'foodprice' => $request->input("foodprice"), 
           'updated_at' => $dateaandtime, 
        
          
           ]		       
       );
       if($obj==true){
           echo 1; 
   
       }
   
   


}
}