@extends('hmslayout')
@section('maincontent')

<section class="testimonial-area pt-10 pb-10" p-2>

<br>
<div id="listpanel" style="" >


        <div class="container">
      
                <div class="row">
                    <div class="col-lg-12">	
                        <table id="tableMain" class="table table-striped table-bordered table-responsive" style="width:100%">
                            <thead>
                                <tr>
                                    <th style="display:none;">Id</th>
                                    <th style="display:none;">hallnameid</th>
                                    <th>Serial</th>
                                    <th>Hall Name</th>
                                    <th>Room No</th>
                                    <th>Description</th>
                                    <th>Date</th>
                                    <th>Amount</th>
                
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

<!--edit part of room -->



<div id="formpanel" class="panel panel-default " style="display:none">
			

					
					<div class="row">
						<div class="col-lg-12">
							<div class="card">
							<div class="card-header bg-primary p-3 ">  <b> Cost Entry of the hall</b> 
							
							<button id="back" class="btn btn-primary pull-right "> <i class="fa fa-mail-reply"></i> Back</button>
							
							
							
							</div>
								
								
								
								<div class="card-body">
								
                                <br>
                                <br>
                            
									<form  id="costedit" method="POST">
									@csrf
                                    <div class="row">
											<div class="col-md-6">
												<div class="form-group">
													<label>Select Hall<span class="red">*</span></label>													
													<select data-placeholder="Choose Hall..." class="chosen-select" id="hall" name="hall" required>
														<option value="">Select Hall</option>
										
														<option value=""></option>
								
													</select>
												</div>											
											</div>
											</div>





											<div class="row">
											<div class="col-md-6">
												<div class="form-group">
													<label>Room no<span class="red">*</span></label>													
                                                    <input type="text" id="room" name="room"  class="form-control" required placeholder="Enter room no"/>

												</div>											
											</div>
											</div>


                                            <div class="row">
											<div class="col-md-6">
												<div class="form-group">
													<label>Descriptions<span class="red">*</span></label>													
                                                    <textarea  name="descriptions" id="descriptions" class="form-control" rows="4" cols="50">
                                                  
                                                    </textarea>


												</div>											
											</div>
											</div>




    







                                            <div class="row">
											<div class="col-md-6">
												<div class="form-group">
													<label>Select Date<span class="red">*</span></label>													
                                                    <input type="date" id="date" name="date"  class="form-control" required placeholder="Enter room no"/>

												</div>											
											</div>
											</div>


                                            <div class="row">
											<div class="col-md-6">
												<div class="form-group">
													<label>Amount<span class="red">*</span></label>													
                                                    <input type="text" id="amount" name="amount"  class="form-control" required placeholder="Enter Amount"/>

												</div>											
											</div>
											</div>



                                            <div class="row" style="display:none" >
											<div class="col-md-6">
												<div class="form-group">
													<label>Id<span class="red">*</span></label>													
                                                    <input type="text" id="recordid" name="recordid"  class="form-control" required />

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
				<br>
				<br>





  @endsection


  @section('customjs')

<script>



var tablemain;

var SITEURL = '{{URL::to('')}}';


function editpanel(){

$('#listpanel').hide();
$('#formpanel').show();


}


function cancelandback(){
	
    $("#formpanel").hide();
    $("#listpanel").show();

    
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








function gethalltList() {

$.ajax({
    type: "post",
    url: SITEURL+"/gethallnameandidfromhallnametable",
    data: {
        "id":1,
        "_token":$('meta[name="csrf-token"]').attr('content')
    },
    success:function(response){				
        $.each(response, function(i, obj) {
            $("#hall").append($('<option></option>').val(obj.id).html(obj.hallname));
           
        });
        $("#hall").trigger("chosen:updated");
         
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
        toastr.error("Dropdown can not fillup");

        }, 1300);

    }

});
}






$(document).ready(function() {



 /***Menu Active***/
		$( ".CostManagement-menu" ).addClass( "active" );
		$( ".CostManagement-menu ul" ).addClass( "in" );
		$( ".CostManagement-menu ul" ).attr("aria-expanded", "true");
		$( ".costview-menu" ).addClass( "active" );


$.ajaxSetup({
headers: {
   'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
}
});


// for edit

$('#costedit').parsley();



    $('#costedit').on('submit', function(event){
        event.preventDefault();
        if($('#costedit').parsley().isValid())
  {
		$.ajax({
				url: SITEURL +"/costedit",
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

				$('#costedit')[0].reset();
				$('#costedit').parsley().reset();
				$("#tableMain").dataTable().fnDraw();
}




				
				$('#submit').attr('disabled',false);
				$('#submit').val('Submit');
			
			
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
				toastr.error("Operation Faild");

				}, 1300);

	        }
	







		});
		}


	});





//drop table


function onConfirmWhenDelete(recordId) {

$.ajax({
	type: "post",
	
	url: SITEURL+"/deletecostrowRoute",
	
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
				toastr.error("Operation Faild");

				}, 1300);

	        }
	

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
			"order": [[ 2, "asc" ]],
		    
		    "aLengthMenu" : [[10, 25, 50, 100], [10, 25, 50, 100]],
		    "iDisplayLength" : 10,
		    "ajax":{
		        "url": "<?php route('getcostlistdata') ?>",
		        "datatype": "json",
		        "type": "POST",
		        "data": {"_token":$('meta[name="csrf-token"]').attr('content')}
		    },


//edit for room
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

		                                $('#hall').val(aData['hallnameid']).trigger("chosen:updated");

										$('#room').val(aData['roomno']);
		                                $('#descriptions').val(aData['description']);
		                                $('#amount').val(aData['amount']);
		                                $('#date').val(aData['date']);
		                          
		                               

		                              

										
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



//delete data


	
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
		        {"data":"hallnameid","bVisible" : false},
		      
		        {"data":"Serial","sWidth": "5%", "sClass": "align-center", "bSortable": false},
		        
				{"data":"hallname","sWidth": "20%"},
				
				{"data":"roomno","sWidth": "10%"},
		        {"data":"description","sWidth": "20%"},
		        
		        {"data":"date","sWidth": "15%"},
		    
		        {"data":"amount","sWidth": "10%"},

			
		        {"data":"action","sWidth": "20%" ,"bSortable": false},

		      		       
		
		        
		    ]





});



getMyNewPostCount();

gethalltList();


$('.chosen-select').chosen({width: "100%"});

$('#back,#cancel').click(function(){

cancelandback();

});




});















</script>

  @endsection
