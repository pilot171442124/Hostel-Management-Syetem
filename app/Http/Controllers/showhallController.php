<?php

namespace App\Http\Controllers;
use App\Providers\RouteServiceProvider;
use App\Models\Room;
use Illuminate\Http\Request;
use Redirect,Response;
use DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;


class showhallController extends Controller
{
    public function showhallname(Request $request){


        $data=DB::table('hallname')->get();

        return view('showhall',['data'=>$data]);
        
        }






public function hallandroomdata(Request $request){

  
             
$roomdata=$request->hallid;




$columns = array(2=>'roomno',3=>'noofseat',4=>'hallid',5=>'emptyseat',6=>'cost',7=>'isactive');
$limit = $_POST['length'];
		$start = $_POST['start'];
		$order = $columns[$_POST['order'][0]['column']];
		$dir = $_POST['order'][0]['dir'];

		$search = $_POST['search']['value'];

		//$totalData = AvailableBookList::count();
		$rowTotalObj = DB::table('room')
                     ->select(DB::raw('count(*) as rcount'))
                    ->where('hallid', '=',  $roomdata)
					->where(function($query) use ($search)
		              {
		                if(!empty($search)):
		                   $query->Where('roomno','like', '%' . $search . '%');
		                   $query->orWhere('noofseat','like', '%' . $search . '%');
		                   $query->orWhere('hallid','like', '%' . $search . '%');
		                   $query->orWhere('emptyseat','like', '%' . $search . '%');
		                   $query->orWhere('isactive','like', '%' . $search . '%');


		                endif;
		              })
                     ->get();
		$totalData = $rowTotalObj[0]->rcount;



		//BookTypeId=1=hard copy
        $posts = DB::table('room')
         	->join('hallname', 'room.hallid', '=', 'hallname.id')
         	->select('room.*', 'hallname.hallname')
			->where('hallid', '=',  $roomdata)
			->where(function($query) use ($search)
              {
                if(!empty($search)):
                   $query->Where('roomno','like', '%' . $search . '%');
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

			$serial = $_POST['start'] + 1;
			foreach($posts as $r){
				$arr['id'] = $r->id;
				$arr['Serial'] = $serial++;
				$arr['roomno'] = $r->roomno;
				$arr['noofseat'] = $r->noofseat;
				$arr['hallname'] = $r->hallname;
				$arr['emptyseat'] = $r->emptyseat;
				$arr['newemptydate'] = $r->newemptydate;
				$arr['newemptyno'] = $r->newemptyno;
				$arr['cost'] = $r->cost;

				$arr['isactive'] = $r->isactive;

				
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
