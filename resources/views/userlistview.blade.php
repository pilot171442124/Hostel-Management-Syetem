@extends('hmslayout')


@section('maincontent')



<section class="testimonial-area pt-10 pb-10">
	<div id="listpanel" >
			<div class="container">

					<div class="row">
						<div class="col-lg-12">	
							<table id="tableMain" class="table table-striped table-bordered table-responsive" style="width:100%">
								<thead>
									<tr>
										<th style="display:none;">Id</th>
										<th>Serial</th>
										<th>User Name</th>
										<th>User ID</th>
										<th>Phone No</th>
										<th>E-mail</th>
										<th>Role</th>
										<th>Status</th>
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

</secttion>
<!-- editt user data-->


<div id="formpanel" class="panel panel-default " style="">
			
					<div class="row">
						<div class="col-lg-12 mb-10">
							<button class="btn btn-info btn-sm pull-right" type="button" id="btnBack"><i class="fa fa-mail-reply"></i>&nbsp;&nbsp;<span class="bold">Back</span></button>
						</div>
					</div>		
			<br>
			<br>
			<br>

			<div class="row">
				<div class="col-lg-12">
					<div class="card">
					<div class="card-header bg-primary p-3">{{ __('Create User') }}</div>
						<div class="card-body">
						
							<form  id="editform" method="POST">
							@csrf
								<div class="row">
									<div class="col-md-4">
										<div class="form-group">
											<label>User Name<span class="red">*</span></label>
											<input type="text" class="form-control "  name="name" id="name" required  data-parsley-trigger="keyup" placeholder="Enter User Name">
										</div>
									</div>

									<div class="col-md-4">
										<div class="form-group">
											<label>ID<span class="red">*</span></label>
											<input type="text" class="form-control " name="usercode" id="usercode" data-parsley-trigger="text" data-required="true" placeholder="Enter ID">
										</div>
									</div>

									<div class="col-md-4">
										<div class="form-group">
											<label>Phone No<span class="red">*</span></label>
											<input type="text" class="form-control " name="phone" id="phone" required data-parsley-type="number" required data-parsley-length="[11, 11]" data-parsley-trigger="keyup" placeholder="Enter User Phone No">
										</div>
									</div>
									

								</div>


								<div class="row">

								<div class="col-md-6">
									<div class="form-group">
										<label>Role<span class="red">*</span></label>													
										<select data-placeholder="Choose Role..." class="chosen-select" id="userrole" name="userrole" required>
											<option value="">Select Role</option>
											<option value="Admin">Admin</option>
											<option value="Employee">Employee</option>
											<option value="Student">Student</option>
											<!--<option value="Other">Other</option>-->
										</select>
									</div>											
								</div>



								<div class="col-md-6">
										<div class="form-group">
											<label>E-mail <span class="red">*</span></label>
											<input type="text" class="form-control " name="email" id="email" required data-parsley-type="email" data-parsley-trigger="keyup" placeholder="Enter User E-mail">
										</div>
									</div>
									</div>

									
									



								<div class="row">
									<div class="col-md-4">
										<div class="form-group">
											<label>Active Status<span class="red">*</span></label>													
											<select data-placeholder="Choose Active Status..." class="chosen-select" id="activestatus" name="activestatus" required>
												<option value="">Select Status</option>
												<option value="Active">Active</option>
												<option value="Inactive">Inactive</option>
											</select>
										</div>											
									</div>
									
								</div>

								<div class="col-md-6">
										<div class="form-group">
											   
												<input type="hidden" name="id" id="recordid"  class="form-control" />
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
							



				
@endsection


@section('customjs')
<script>

var tablemain;
var SITEURL = '{{URL::to('')}}';
function onFormPanel(){
	
		$("#listpanel").show();
		$("#formpanel").hide();

		
	}
function editpanel(){
	
		$("#formpanel").show();
		$("#listpanel").hide();

		
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


//acttve menu
	$( ".Studentuser-menu" ).addClass( "active" );
		$( ".Studentuser-menu ul" ).addClass( "in" );
		$( ".Studentuser-menu ul" ).attr("aria-expanded", "true");
		$( ".userlist-menu" ).addClass( "active" );



//if csrf tooken is miss then ajax header  setups		
	$.ajaxSetup({
    headers: {
       'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
}
});

 //edit form  
    $('#editform').parsley();



    $('#editform').on('submit', function(event){
        event.preventDefault();
        if($('#editform').parsley().isValid())
  {
		$.ajax({
				url: SITEURL +"/editform",
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

				$('#editform')[0].reset();
				$('#editform').parsley().reset();
				$("#tableMain").dataTable().fnDraw();
}



				
				$('#submit').attr('disabled',false);
				$('#submit').val('Submit');
			
			
			   }
		});
		}


	});




//

function onConfirmWhenDelete(recordId) {

$.ajax({
	type: "post",
	//url: "http://localhost/olms/deleteBookTypeRoute",
	url: SITEURL+"/deleteUserRoute",
	
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
					toastr.error("Data Deleted Successfully");

				}, 1300);

		}
		
		//alert("success");
		//console.log(response);
		//$("#tableMain").dataTable().fnDraw();

		$("#tableMain").dataTable().fnDraw();
	},
	

});
}







	
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
			"order": [[ 3, "asc" ]],
		    
		    "aLengthMenu" : [[10, 25, 50, 100], [10, 25, 50, 100]],
		    "iDisplayLength" : 10,
		    "ajax":{
		        "url": "<?php route('usertabledatafetch') ?>",
		        "datatype": "json",
		        "type": "POST",
		        "data": {"_token":$('meta[name="csrf-token"]').attr('content')}
		    },

//for userform edit 
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
		                                $('#name').val(aData['name']);
		                                $('#usercode').val(aData['usercode']);
		                                $('#phone').val(aData['phone']);
		                                $('#email').val(aData['email']);
		                                //$('#password').vala(Data['password']);
		                                $('#userrole').val(aData['userrole']).trigger("chosen:updated");
		                                $('#activestatus').val(aData['activestatus']).trigger("chosen:updated");

										
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


//


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
			




			dom: '<"br"B>lfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ],

		buttons: [
                            
							{
									extend: 'print',
									
									text:'<i class="fa fa-print" style="color:red; font-size:20px"></i>',
								   className:'btn btn-info',
		
	
									exportOptions: {
										columns: [  1,2,3,4,5]
									}
	
	
							},

							{
                                extend: 'pdfHtml5',
                                text:'<i class="fa fa-file-pdf-o" style="color:red; font-size:20px"></i>',
                                className:'btn btn-info',
								footer: true,
                                exportOptions: {
                                    columns: [ 0, 1,2,3,4,5 ],
                                    
                                }
							}
		],
			
			"columns":[
		        {"data":"id","bVisible" : false},
		        {"data":"Serial","sWidth": "5%", "sClass": "align-center", "bSortable": false},
		        {"data":"name","sWidth": "15%"},
		        {"data":"usercode","sWidth": "12%"},
		        {"data":"phone","sWidth": "12%"},
		        {"data":"email","sWidth": "19%"},
		        {"data":"userrole","sWidth": "10%"},
		        {"data":"activestatus","sWidth": "10%"},		       
		        {"data":"action","sWidth": "15%", "sClass": "align-center", "bSortable": false},
		       
		    ]





	});

//for cancel	
$("#cancel").click(function(){
	onFormPanel();

});

//for Back Button	
$("#btnBack").click(function(){
	onFormPanel();

});



	onFormPanel();
	$('.chosen-select').chosen({width: "100%"});
	
	
	getMyNewPostCount();

});




</script>
				
@endsection