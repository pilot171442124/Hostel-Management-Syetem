<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;

use Illuminate\Support\Str;
use DB;
use Auth;
class postmanPaymentController extends Controller
{
    

	

	public function gethallnameanddid(Request $request)

{
    $loginuserid = Auth::user()->id;


    $rowTotalObj = DB::table('studentpayment')
    ->join('hallname', 'studentpayment.hall_name', '=', 'hallname.id')
    ->join('users', 'studentpayment.perstudent_id', '=', 'users.id')
	->select('studentpayment.*','hallname.hallname','users.usercode')
    ->where('perstudent_id',$loginuserid)->get();


foreach ($rowTotalObj as $value) {
	

$get_id=$value->usercode;
$hallname=$value->hallname;
$student_name=$value->student_name;


}

return ["id"=>$get_id,"hallname"=>$hallname,"name"=>$student_name];

}



public function getpaymentdata(Request $request)

{

    $loginuserid = Auth::user()->id;

    $columns = array(1=>'id', 2=>'invoice_no',3=>'phone',4=>'amount',5=>'Serial',6=>'roomno',7=>'program',
	7=>'batchno',8=>'month',
);
    $limit = $_POST['length'];
    $start = $_POST['start'];
    $order = $columns[$_POST['order'][0]['column']];
    $dir = $_POST['order'][0]['dir'];

    $search = $_POST['search']['value'];




    $rowTotalObj = DB::table('studentpayment')
    ->join('hallname', 'studentpayment.hall_name', '=', 'hallname.id')
    ->join('users', 'studentpayment.perstudent_id', '=', 'users.id')
    ->join('application', 'studentpayment.perstudent_id', '=', 'application.studentid')
    
    
    ->select(DB::raw('count(*) as rcount'))
    
    
    ->where('perstudent_id',$loginuserid )

					->where(function($query) use ($search)
		              {
		                if(!empty($search)):
							$query->Where('room_no','like', '%' . $search . '%');
							$query->orWhere('program','like', '%' . $search . '%');
							$query->orWhere('batchno','like', '%' . $search . '%');
							$query->orWhere('month','like', '%' . $search . '%');
							$query->orWhere('status','like', '%' . $search . '%');
						   
						
	


		                endif;
		              })
                     ->get();
		$totalData = $rowTotalObj[0]->rcount;



        $posts = DB::table('studentpayment')
       
		->join('hallname', 'studentpayment.hall_name', '=', 'hallname.id')
		->join('users', 'studentpayment.perstudent_id', '=', 'users.id')
		->join('application', 'studentpayment.perstudent_id', '=', 'application.studentid')
		
                	
             ->select('studentpayment.*','hallname.hallname','users.usercode','application.status as applicationstatus')
			 ->where('perstudent_id',$loginuserid )

	
			->where(function($query) use ($search)
              {
                if(!empty($search)):
                   
					
                    $query->Where('room_no','like', '%' . $search . '%');
                    $query->orWhere('program','like', '%' . $search . '%');
                    $query->orWhere('batchno','like', '%' . $search . '%');
                    $query->orWhere('month','like', '%' . $search . '%');
                    $query->orWhere('status','like', '%' . $search . '%');
                   
                    //$query->orWhere('date','like', '%' . $search . '%');
                  
                  
                 

					
				

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

           

             
				$arr['id'] = $r->id;
				$arr['roomno'] = $r->room_no;

				$arr['hallname'] = $r->hallname;

				$arr['program'] = $r->program;
				$arr['batchno'] = $r->batchno;
				
				$arr['Serial'] = $serial++;
				$arr['month'] = $r->month;
                	
				$arr['status'] = $r->status;

				

			
					
					if ($r->status=="unpaid") {

						$arr['action'] = $x;
							
							
						}	

						else {
							$arr['action'] ="Completed ";
			
						}
			

						
						if ($r->applicationstatus!="Accepted") {

							$arr['action'] = "Processing.....";
								
								
							}	
	
							
						
						
						
						
						
						

				


				

			//else {
			//	$arr['action'] ="Processing";

		//	}


				$arr['invoic_no'] = $r->invoic_no;
				$arr['amount'] = $r->amount;
				$arr['phone'] = $r->cellno;
				
		
				
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








public function payment(Request $request)
{

	



	$recordid   = $request->recordid;
	$name   = $request->name ;
	$phone  = $request->phone;
	$amount = $request->amount;
	
	//$name   ="Nayem Hossain";
	//$phone  ="01921074945";
	//$amount =20;
	
	$trnxId = 'trnx_' . Str::uuid();     // must be unique
	
	

	try {
		$responsejSON = Http::withHeaders([
			'client-id'     => env('PL_CLIENT_ID'),
			'client-secret' => env('PL_CLIENT_SECRET')
		])->post(env('PL_URL') . '/v1/ecom-payment/initiate', [
			'customer_name'   => $name,
			'customer_mobile' => $phone,
			'amount'          => $amount,
			'transaction_id'  => $trnxId,
			'success_url'     => 'https://hostaxil.com/hms/paymentsuccess/'.$recordid,  // success url
			'fail_url'        => 'https://hostaxil.com/hms/paymentfail/'.$recordid,   // failed url
		])->json();

		$code    = $responsejSON['code'];
		$message = $responsejSON['message'];

				
	if ($code !== 200) {
				return Redirect::back()
	                ->withErrors([$message]);
			}else{

			
				//update payment status
		$obj = DB::table('studentpayment')->where('id',$recordid)->update(
	  
		[
		'txrID' => $trnxId, 
		
		]		       
	);	


	//paymentDetails($trnxId);


    return $responsejSON['data']['link'];

			//	return redirect()->to($responsejSON['data']['link'])->send();
			}

			//$response['plInitiateUrl'] = $responsejSON['data']['link'];
			
			//$response = Http::get($response['plInitiateUrl']);
		} catch (\Exception $ex) {
			return Redirect::back()
	                ->withErrors([$ex->getMessage()]);
		}
	}





	public function paymentDetails($tran_id)
    {
        try {
            $responsejSON = Http::withHeaders([
                'client-id'     => env('PL_CLIENT_ID'),
                'client-secret' => env('PL_CLIENT_SECRET')
            ])->get(env('PL_URL') . '/v1/ecom-payment/details', [
                'transaction_id'   => $tran_id,
            ])->json();
    
            $code    = $responsejSON['code'];
            $message = $responsejSON['message'];
    
            if ($code !== 200) {
                return Redirect::back()
                    ->withErrors([$message]);
            }

            else{

                $obj = DB::table('studentpayment')->where('id',$tran_id)->update(
	   
                    [
                    'status' => "paid", 
                    
                    ]		       
                );


            }
        } catch (\Exception $ex) {
            return Redirect::back()
                    ->withErrors([$ex->getMessage()]);
        }
    }










public function successpayment(Request $request)
            
{
	$recordid=$request->id;

	$obj = DB::table('studentpayment')->where('id',$recordid)->update(
	  
		[
		'status' =>"paid",
		
		]		       
	);	

return view('postmanpayment');

}


public function paymentfail(Request $request)

{


	$recordid=$request->id;

	$obj = DB::table('studentpayment')->where('id',$recordid)->update(
	  
		[
		'status' =>"unpaid",
		
		]		       
	);	

	return view('postmanpayment');

}












}
