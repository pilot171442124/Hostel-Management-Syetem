@extends('hmslayout')


@section('maincontent')



<div id="formpanel" class="panel panel-default " style="">
			
					
					


					<div class="row">
						<div class="col-lg-12">
							<div class="card">
							<div class="card-header bg-primary p-3"><i class="fa fa-graduation-cap" style="font-size:20px"> &nbsp; {{ __('Create Attendance of Student ') }}</i>  </div>
								<div class="card-body">
								<div class="changedat"> 

						<button class="pull-right btn btn-primary " id="datechangebutton"><i class="fa fa-plus "> </i> Change Date </button>
                     </div>


					 <div class="backbtn" id="backbtn"style="display:none"> 

						<button class="pull-right btn btn-primary " id="back"><i class="fa fa-mail-reply "> </i> Back </button>
						</div>



					 <form  id="changedateform" method="POST" style="display:none">
									@csrf
										<div class="row">
											<div class="col-md-4">
												<div class="form-group">
													<label> Change Date<span class="red">*</span></label>
													<input type="text" class="form-control "  name="changedate" id="changedate"  autocomplete="off"  required  data-parsley-trigger="keyup" placeholder="Enter Month and Year">
												</div>
											</div>

											
						
										</div>

										<div class="row" style="display:none">
											<div class="col-md-4">
												<div class="form-group">
													<label>Before Date<span class="red">*</span></label>
													<input type="text" class="form-control "  name="Beforedate" id="Beforedate" required  data-parsley-trigger="keyup" placeholder="Enter Month and Year">
												</div>
											</div>

											
						
										</div>

									
										<div class="form-group row">
											<div class="col align-self-center">
											<input type="submit" id="submit" name="submit" value="Submit" class="btn btn-success" />
												
										 	   </div>
     							
											</div>
										
											
							
	
									</form>












									<form  id="attendance" method="POST">
									@csrf
										<div class="row">
											<div class="col-md-4">
												<div class="form-group">
													<label>Date<span class="red">*</span></label>
													<input type="text" class="form-control "  name="date" id="date" required  data-parsley-trigger="keyup" autocomplete="off" placeholder="Enter Month and Year">
												</div>
											</div>

											
						
										</div>
									
										<div class="form-group row">
											<div class="col align-self-center">
											<input type="submit" id="submit" name="submit" value="Submit" class="btn btn-success" />
												
										 	   </div>
     							
											</div>
										
											
							
	
									</form>
                                 
									</div>
									</div>
									</div>

								
									</div>
									</div>

									


<section class="testimonial-area pt-10 pb-10" p-2>


<div id="listpanel" style="" >


        <div class="container">
      
                <div class="row">
                    <div class="col-lg-12">	
                        <table id="tableMain" class="table table-striped table-bordered table-responsive" style="width:100%">
                            <thead>
                                <tr>
                                    <th style="display:none;">Id</th>
                        
                                    <th>Serial</th>
                                    <th>Student Name</th>
                                    <th>Student ID</th>

                                    <th>Hall Name</th>
                                    <th>Room No</th>
									 <th> Date</th>
                                    <th> Absent</th>
                                    <th> Present</th>
                                   

            
                                  

                                </tr>
                            </thead>
                            <tbody>
                            </tbody>				
                        </table>
                    </div>
                </div>
            </div>
    </div>

</secttion>

<br>
<br>
<br>








@endsection


@section('customjs')

<script>
var SITEURL = '{{URL::to('')}}';
var tablemain;



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





function datechange(){

$('#datechangebutton').click(function(){


	$('#attendance').hide();
	$('#datechangebutton').hide();

	$('#changedateform').show();
	$('#backbtn').show();
	
	
								$.ajax({
											"type" : "POST",
											"url": SITEURL+"/getdatetochangedate",
											datatype:"json",
								            data: {
								            	"id":1,
								            	
								        		"_token":$('meta[name="csrf-token"]').attr('content')
								    		},
											"success" : function(response) {
								
											$('#Beforedate').val(response);

											}	
										});









});


$('#back').click(function(){

$('#datechangebutton').show();

$('#attendance').show();
$('#changedateform').hide();
$('#backbtn').hide();



});





}







function getdata(){


	tablemain=$("#tableMain").dataTable({

"bFilter" : true,
	//"scrollY": true,
		"bDestroy": true,
		"bAutoWidth": false,
		"bJQueryUI": true,      
		"bSort" : true,
		"bInfo" : true,
		"bPaginate" : true,
		"bSortClasses" : true,
		"bProcessing" : true,
		"bServerSide" : true,
		"order": [[ 2, "asc" ]],
		
		"aLengthMenu" : [[10, 25, 50, 100], [10, 25, 50, 100]],
		"iDisplayLength" : 10,
		"ajax":{
      "url": "<?php route('getdatafromattendance') ?>",
			"datatype": "json",
			"type": "POST",
			"data": {"_token":$('meta[name="csrf-token"]').attr('content')}
		},

	



		"fnDrawCallback" : function(oSettings) {
			
			if (oSettings.aiDisplay.length == 0) {
				return;
			}
			
			$('input.attChange', tablemain.fnGetNodes()).each(function() {
				
				
				
				$(this).click(function() {
					var nTr = this.parentNode.parentNode;
					var aData = tablemain.fnGetData(nTr);
					recordId = aData['id'];
					console.log(recordId);
					
				var radioValue = $("input[name='AttendanceRadio"+recordId+"']:checked").val();
					
				//console.log(radioValue);
					
					
				
		


				$.ajax({
											"type" : "POST",
											"url": SITEURL+"/updateAttendanceStatusRoute",
											datatype:"json",
								            data: {
								            	"recordId":recordId,
								            	"IsPresent":radioValue,
								        		"_token":$('meta[name="csrf-token"]').attr('content')
								    		},
											"success" : function(response) {
												if (response != 1) {
													setTimeout(function() {
														toastr.options = {
															closeButton: true,
															progressBar: true,
															showMethod: 'slideDown',
															timeOut: 4000
														};
														toastr.error(response);

													}, 1300);
												}
											}	
										});










				});
			});

},












	
		"columns":[
				
		        {"data":"id","bVisible" : false},
		     

		        {"data":"Serial","sWidth": "5%", "sClass": "align-center", "bSortable": false},
		        
				{"data":"studentname","sWidth": "20%"},
				{"data":"studentid","sWidth": "10%"},
				
				{"data":"hallname","sWidth": "20%"},
		        {"data":"room_no","sWidth": "10%"},
		        
		        {"data":"date","sWidth": "15%"},
		        {"data":"Absence","sWidth": "10%","bSortable": false},
	
		        {"data":"Present","sWidth": "10%","bSortable": false},


		       
	       
		
		        
		    ]
	
	
	
	
	
	
	
	
	});




}












$(document).ready(function(){




//active menu
$( ".Attendance-menu" ).addClass( "active" );
		$( ".Attendance-menu ul" ).addClass( "in" );
		$( ".Attendance-menu ul" ).attr("aria-expanded", "true");
		$( ".addattendance-menu" ).addClass( "active" );









    $("#date,#changedate").datepicker({
        dateFormat: 'yy MM DD',
        changeMonth: true,
        changeYear: true,
        showButtonPanel: true,

        
    });

   



//insert date


$('#attendance').parsley();



    $('#attendance').on('submit', function(event){
        event.preventDefault();
        if($('#attendance').parsley().isValid())
  {
		$.ajax({
				url: SITEURL +"/attendance",
				type:"POST",
			
				data:  new FormData(this),
				contentType: false,
					cache: false,
			processData:false,
				beforeSend:function(){
				$('#submit').attr('disabled','disabled');
				$('#submit').val('Submitting...');
				},
				success:function(data)
				{
			
       if(data==1)
	   {
					setTimeout(function() {
					toastr.options = {
						closeButton: true,
						progressBar: true,
						showMethod: 'slideDown',
						timeOut: 4000
					};
					toastr.success("Attendance Creaeted Successfully");

				}, 1300);
				getdata();

	   }





				
				$('#submit').attr('disabled',false);
				$('#submit').val('Submit');
			
			
			   }
		});
		}

			});


//update Change Date



$('#changedateform').parsley();



    $('#changedateform').on('submit', function(event){
        event.preventDefault();
        if($('#changedateform').parsley().isValid())
  {
		$.ajax({
				url: SITEURL +"/changedateform",
				type:"POST",
			
				data:  new FormData(this),
				contentType: false,
					cache: false,
			processData:false,
				beforeSend:function(){
				$('#submit').attr('disabled','disabled');
				$('#submit').val('Submitting...');
				},
				success:function(data)
				{
			
       if(data==1)
	   {
					setTimeout(function() {
					toastr.options = {
						closeButton: true,
						progressBar: true,
						showMethod: 'slideDown',
						timeOut: 4000
					};
					toastr.success("Date Change Successfully");

				}, 1300);
				getdata();

	   }





				
				$('#submit').attr('disabled',false);
				$('#submit').val('Submit');
			
			
			   }
		});
		}

			});


	




			getdata();

			datechange();

			getMyNewPostCount();

});




</script>


@endsection
