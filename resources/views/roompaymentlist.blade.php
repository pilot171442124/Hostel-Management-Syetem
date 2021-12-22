@extends('hmslayout')


@section('maincontent')



<section class="testimonial-area pt-10 pb-10 ">



<div class="jumbotron">
<p>Name: <span id="student_name"></span>  </p>


<p>ID: <span id="student_id"></span>  </p>


<p>Hall Name: <span id="hall_name"></span>  </p>





 

  </div>



	<div id="listpanel" >
			<div class="container">

					<div class="row">
						<div class="col-lg-12">	
							<table id="tableMain" class="table table-striped table-bordered table-responsive" style="width:100%">
								<thead>
									<tr>
										<th style="display:none;">Id</th>
										<th> Room</th>
										<th>Program</th>
										<th>Batch</th>
										<th>Amount</th>
										<th>Month-year</th>
										<th>Status</th>

										<th>Action</th>
										
									</tr>
								</thead>
								<tbody>

                                @foreach($data  as $row)
                                   
                                   
                                <tr>
                                
                                <td> {{$row->room_no}} </td> 
                                <td> {{$row->program}} </td> 
                                <td> {{$row->batchno}} </td> 
                                <td> {{$row->amount}}.00 </td> 
                                <td> {{$row->month}} </td> 
                                <td > 
                                @if($row->status == 'paid')
                                <span style="color:green"> {{$row->status}}</span>
                                @else
                                <span style="color:red"> {{$row->status}}</span>
                               
                                @endif

                        

                                
                                
                                
                                </td> 
                                
                                <td class="text-left">

                                @foreach($data2  as $row2)

                                @if($row2->status == 'Accepted' && $row->status == 'unpaid' )

								<a href="view/{{ $row->id }}" class="btn btn-sm btn-primary"> View</a>
                             
                                @else

                                @if($row2->status == 'Accepted' && $row->status == 'paid' )
                                <span style="color:green; text-align:left;"> complete</span>

                                @else
                                <span style="color:red; text-align:left;"> Processing....</span>

                                @endif
                               
                               
                                @endif
                               
                               


                            
                             </td>
                             @endforeach
                                </tr>
                                   
                                   
                                @endforeach

								</tbody>				
							</table>
						</div>
					</div>
				</div>
		</div>
        @foreach($data  as $row)

 <p id="stu_id" style="display:none">{{ $row->perstudent_id }}</p>
 <p id="hall_id" style="display:none">{{ $row->hall_name }}</p>

 @endforeach



@endsection


@section('customjs')

<script>
var tablemain;
var SITEURL = '{{URL::to('')}}';


function editpanel(){
$("#listpanel").hide();
$("#formpanel").show();

}

function cancel(){
$("#listpanel").show();
$("#formpanel").hide();

}

function activemenu(){

//active menu
$( ".StudentManagementbyadmin-menu" ).addClass( "active" );
		$( ".StudentManagementbyadmin-menu ul" ).addClass( "in" );
		$( ".StudentManagementbyadmin-menu ul" ).attr("aria-expanded", "true");
		$( ".roompayment-menu" ).addClass( "active" );


}

//notification count

function getMyNewPostCount() {

$.ajax({
    type: "post",
    url: SITEURL+"/getMyNewPostCountRoute",
    data: {
        "id":1,
        "_token":$('meta[name="csrf-token"]').attr('content')
    },
    success:function(response){
		rowcount=response.empty+response.pending;
		rowcountempty=response.empty;
		rowcountpending=response.pending;

        if(response == 0){
            $("#notificationcount").html('');
        }
		else if(response.empty >0 && response.pending>0){
            $("#notificationcount").html(rowcount);
        }
     
		else if(response.empty >0){
            $("#notificationcount").html(rowcountempty);
        }

		else if(response.pending >0){
            $("#notificationcount").html(rowcountpending);
        }


        else{
           $("#notificationcount").html(response);

       }

	 
		







    },




    error:function(error){
        //alert("fail");
        setTimeout(function() {
            toastr.options = {
                closeButton: true,
                progressBar: true,
                showMethod: 'slideDown',
                timeOut: 4000
            };
        toastr.error("New post count can not fillup");

        }, 1300);

    }

});
}












$(document).ready(function(){

    activemenu();

	$.ajaxSetup({
headers: {
   'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
}
});

    



///////

stu_id=$('#stu_id').html();

hall_id=$('#hall_id').html();




$.ajax({
    type: "post",
    url: SITEURL+"/stu_id",
    data: {
        "stu_id":stu_id,
        "hall_id":hall_id,
        "_token":$('meta[name="csrf-token"]').attr('content')
    },
	
    success:function(response){		

        
        
        
        
        $('#student_id').html(response.student_id);
        $('#hall_name').html(response.hallname);
        $('#student_name').html(response.name);

         
    },
    error:function(error){
        //alert("fail");
        setTimeout(function() {
            toastr.options = {
                closeButton: true,
                progressBar: true,
                showMethod: 'slideDown',
                timeOut: 4000
            };
       // toastr.error("Dropdown can not fillup");

        }, 1300);

    }

});















         
		      	

getMyNewPostCount();
});




</script>


@endsection