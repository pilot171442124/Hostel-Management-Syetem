@extends('hmslayout')


@section('maincontent')



<section class="testimonial-area pt-10 pb-10 ">
	<div id="listpanel" >
			<div class="container">

					<div class="row">
						<div class="col-lg-12">	
							<table id="tableMain" class="table table-striped table-bordered" style="width:100%">
								<thead>
									<tr>
										<th style="display:none;">Id</th>
										<th>Serial</th>
										<th>Hall Name</th>
										<th>Picture</th>
										<th>Gender</th>
										<th>Action</th>
										
									</tr>
								</thead>
								<tbody>
								</tbody>				
							</table>
						</div>
					</div>
				</div>
		</div>


<!--for edit panel-->

		
<div id="formpanel" class="panel panel-default " style="display:none">
			

					
					<div class="row">
						<div class="col-lg-12">
							<div class="card">
							<div class="card-header bg-primary p-3 "> {{ __('Hall Name Entry') }}</div>
								<div class="card-body">
								<button id="back" class="btn btn-primary pull-right m-2"> <i class="fa fa-mail-reply"></i> Back</button>	
                                <br>
                                <br>
                                <br>
                                <br>
                                <br>
                                <br>
									<form  id="hallname" method="POST">
									@csrf
										<div class="row">
											<div class="col-md-4">
												<div class="form-group">
													<label>Hall Name<span class="red">*</span></label>
													<input type="text" class="form-control "  name="hallname" id="hallnameid" required  data-parsley-trigger="keyup" placeholder="Enter Hall Name">
												</div>
											</div>

											

                                            <div class="col-lg-8">
                                                <div class="form-group p-4 m-2">
                                                    <label > Insert Image</label>
                                                     <input type="file" name="file" id="imagename" >
                                                </div>
                                            </div>
                                            </div>


											<div class="row">
											<div class="col-md-4">
												<div class="form-group">
													<label>Select Gender<span class="red">*</span></label>													
													<select data-placeholder="Choose Gender..." class="chosen-select" id="gender" name="gender" required>
														<option value="">Select Status</option>
														<option value="Male">Male</option>
														<option value="Famale">Famale</option>
													</select>
												</div>											
											</div>
											</div>

											<div class="row">
											<div class="col-md-6">
									         	<div class="form-group">
											   	<input type="hidden" name="id" id="recordid"  class="form-control" />
											</div>
									      </div>
									      </div>
										  
							

									        <div class="form-group row">
											<div class="col align-self-center">
											<input type="submit" id="submit" name="submit" value="Submit" class="btn btn-success" />
												
											<a href="#" class="btn btn-warning"id="cancel"> Cancel</a>
										 	   </div>
     							
											</div>
     							
											
										

									</form>
                                     
								</div>
							</div>
						</div>
					</div>
				</div>
				




</section>











@endsection


@section('customjs')
<script>

var tablemain;
var SITEURL = '{{URL::to('')}}';


function editpanel(){

$('#formpanel').show();
$('#listpanel').hide();


}

function cancel(){

$('#formpanel').hide();
$('#listpanel').show();


}



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


	$( ".HallManagement-menu" ).addClass( "active" );
		$( ".HallManagement-menu ul" ).addClass( "in" );
		$( ".HallManagement-menu ul" ).attr("aria-expanded", "true");
		$( ".viewhallname-menu" ).addClass( "active" );






//if csrf tooken is miss then ajax header  setups		
	$.ajaxSetup({
    headers: {
       'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
}
});

    
//edit  hallname

$('#hallname').parsley();



$('#hallname').on('submit', function(event){
	event.preventDefault();
	if($('#hallname').parsley().isValid())
{
	$.ajax({
			url: SITEURL +"/edithallname",
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
		

if(data==1){

setTimeout(function() {
				toastr.options = {
					closeButton: true,
					progressBar: true,
					showMethod: 'slideDown',
					timeOut: 4000
				};
				toastr.success("Data Updated Successfully");

			}, 1300);

			$('#hallname')[0].reset();
			$('#gender').trigger("chosen:updated");

			$('#hallname').parsley().reset();
			$("#tableMain").dataTable().fnDraw();
}

else{

	setTimeout(function() {
				toastr.options = {
					closeButton: true,
					progressBar: true,
					showMethod: 'slideDown',
					timeOut: 4000
				};
				toastr.error("operation Faild");

			}, 1300);


}





			
			$('#submit').attr('disabled',false);
			$('#submit').val('Submit');
		
		
		   }
	});
	}


});


//drop table


function onConfirmWhenDelete(recordId) {

$.ajax({
	type: "post",
	//url: "http://localhost/olms/deleteBookTypeRoute",
	url: SITEURL+"/deletehallnameRoute",
	
	datatype:"json",
	data: {
		"id":recordId,
		"_token":$('meta[name="csrf-token"]').attr('content')
	},
	success:function(response){
		if(response==1){
			setTimeout(function() {
					toastr.options = {
						closeButton: true,
						progressBar: true,
						showMethod: 'slideDown',
						timeOut: 4000
					};
					toastr.success("Data Deleted Successfully");

				}, 1300);

		}
		
		//alert("success");
		//console.log(response);
		//$("#tableMain").dataTable().fnDraw();

		$("#tableMain").dataTable().fnDraw();
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
				toastr.error("The hall is already using");

				}, 1300);

	        }
	

});
}












   
	tablemain=$("#tableMain").dataTable({
		"bFilter" : true,
		"scrollY": true,
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
		        "url": "<?php route('viewhallname') ?>",
		        "datatype": "json",
		        "type": "POST",
		        "data": {"_token":$('meta[name="csrf-token"]').attr('content')}
		    },
			
			
//edit data for hallname table
			"fnDrawCallback" : function(oSettings) {
				
				if (oSettings.aiDisplay.length == 0) {
		                return;
		            }


			$('a.itmEdit', tablemain.fnGetNodes()).each(function() {
		               
					   $(this).click(function() {

						    var nTr = this.parentNode.parentNode;
		                    var aData = tablemain.fnGetData(nTr);

							$.confirm({
		                        title: 'Are you sure?!',
		                        content: 'Do you really want to edit this data?',
		                        icon: 'fa fa-question',
		                        theme: 'bootstrap',
		                        closeIcon: true,
		                        animation: 'scale',
		                        type: 'orange',
								buttons: {

									confirm: function () {

		                                $('#recordid').val(aData['id']);
		                                $('#hallnameid').val(aData['hallname']);
		                                

		                                $('#gender').val(aData['gender']).trigger("chosen:updated");
		                        
										editpanel();
										
										
		                                //$.alert('Confirmed!');
		                            },
									cancel: function () {
		                                //$.alert('Canceled!');
		                            }


								}

							});


					   });
					});

			



//delete table			
	
$('a.itmDrop', tablemain.fnGetNodes()).each(function() {

$(this).click(function() {

	var nTr = this.parentNode.parentNode;
	var aData = tablemain.fnGetData(nTr);

	$.confirm({
	title: 'Are you sure?!',
	content: 'Do you really want to delete this data?',
	icon: 'fa fa-question',
	theme: 'bootstrap',
	closeIcon: true,
	animation: 'scale',
	type: 'red',
	buttons: {
		confirm: function () {
			onConfirmWhenDelete(aData['id']);
		},
		cancel: function () {
			//$.alert('Canceled!');
		}
	}
});

});
});		
			
				
			
			
			},





			"columns":[
		        {"data":"id","bVisible" : false},
		        {"data":"Serial","sWidth": "10%", "sClass": "align-center", "bSortable": false},
		        {"data":"hallname","sWidth": "30%"},

		        {"data":"hallpic","sWidth": "30%",
                    "render": function(data) {
                        return '<img src="images/'+data+'" width="50" height="50" />';
                    }
                
                
                },
		        {"data":"gender","sWidth": "10%"},

		        {"data":"action","sWidth": "20%","bSortable": false}

		    
		    ]






});

$('#cancel').click(function(){


cancel();

});

$('#back').click(function(){


cancel();

});




$('.chosen-select').chosen({width: "100%"});

getMyNewPostCount();

});


</script>
				
@endsection