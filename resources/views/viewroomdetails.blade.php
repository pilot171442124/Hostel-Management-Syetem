@extends('hmslayout')
@section('maincontent')

<section class="testimonial-area pt-10 pb-10" p-2>


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
                                    <th>Total Seat</th>
                                    <th>Empty Seat</th>
                                    <th>New Empty Date</th>
                                    <th>New Empty No</th>

                                    <th>Cost</th>

                                    <th>Active-Room</th>
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
                    <div class="card-header bg-light p-3"> <button class="btn btn-primary"><i class="fa fa-bars" style="font-size:15px">&nbsp;{{ __('Update the Room') }}</i></button> 
                    
                    <button id="back" class="btn btn-primary pull-right "> <i class="fa fa-mail-reply"></i> Back</button>
                    
                    
                    </div>
                       
                        <div class="card-body">
	               
                               
                            <form  id="roomformedit" method="POST">
                            @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Room No.<span class="red">*</span></label>
                                            <input type="text" class="form-control "  name="roomno" id="roomno" required  data-parsley-type="number" placeholder="Enter the Room Number">
                                        </div>
                                    </div>
                                    </div>

                                    <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Number of Seat<span class="red">*</span></label>
                                            <input type="text" class="form-control " name="noofseat" id="noofseat" data-parsley-type="number" data-required="true" placeholder="Enter Number of Seat">
                                        </div>
                                    </div>
                                    </div>

               
                                    <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Hall Name<span class="red">*</span></label>													
                                            <select data-placeholder="Choose the hall..." class="chosen-select" id="hallname" name="hallname"  required>
                                                <option value="">Select the Hall Name</option>
                                                
                                                <option value=" " ></option>
                                                
                                               
                                                <!--<option value="Other">Other</option>-->
                                            </select>
                                        </div>											
                                    </div>
                                    </div>


                                    <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Number of Empty Seat<span class="red">*</span></label>
                                            <input type="text" class="form-control " name="noofemptyseat" id="noofemptseat" data-parsley-trigger="text" data-required="true" placeholder="Enter Number of Empty Seat">
                                        </div>
                                    </div>
                                    </div>

                                    
									<div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Cost of Room<span class="red">*</span></label>
                                            <input type="text" class="form-control " name="cost" id="cost" data-parsley-trigger="text" data-required="true" placeholder="Enter Number of Empty Seat">
                                        </div>
                                    </div>
                                    </div>

									<div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>New Empty Date<span class="red">*</span></label>
                                            <input type="date" class="form-control " name="newemptydate" id="newemptydate" data-parsley-trigger="text" data-required="true">
                                        </div>
                                    </div>
                                    </div>


									<div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>New Empty No.<span class="red">*</span></label>
                                            <input type="text" class="form-control " name="newemptyno" id="newemptyno" data-parsley-trigger="text" data-required="true" placeholder="Enter Number of Empty Seat">
                                        </div>
                                    </div>
                                    </div>

                                                                                
                                    <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Active The Room<span class="red">*</span></label>													
                                            <select data-placeholder="Choose status..." class="chosen-select" id="activestatusofroom" name="activestatusofroom" required>
                                                <option value="">Select the Status</option>
                                                <option value="Yes">Yes</option>
                                                <option value="No">No</option>
                                               
                                                <!--<option value="Other">Other</option>-->
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
                                
                                    <br>

                                
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
    url: SITEURL+"/gethallnameandid",
    data: {
        "id":1,
        "_token":$('meta[name="csrf-token"]').attr('content')
    },
    success:function(response){				
        $.each(response, function(i, obj) {
            $("#hallname").append($('<option></option>').val(obj.id).html(obj.hallname));
           
        });
        $("#hallname").trigger("chosen:updated");
         
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
		$( ".RoomManagement-menu" ).addClass( "active" );
		$( ".RoomManagement-menu ul" ).addClass( "in" );
		$( ".RoomManagement-menu ul" ).attr("aria-expanded", "true");
		$( ".viewroom-menu" ).addClass( "active" );


$.ajaxSetup({
headers: {
   'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
}
});


// for edit

$('#roomformedit').parsley();



    $('#roomformedit').on('submit', function(event){
        event.preventDefault();
        if($('#roomformedit').parsley().isValid())
  {
		$.ajax({
				url: SITEURL +"/roomformedit",
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

				$('#roomformedit')[0].reset();
				$('#roomformedit').parsley().reset();
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
	
	url: SITEURL+"/deleteroomnameRoute",
	
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
		        "url": "<?php route('getdatafromroom') ?>",
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
										$('#roomno').val(aData['roomno']);
		                                $('#noofseat').val(aData['noofseat']);
		                                $('#hallname').val(aData['hallnameid']).trigger("chosen:updated");
		                                $('#newemptyno').val(aData['newemptyno']);
		                                $('#newemptydate').val(aData['newemptydate']);
		                                $('#noofemptseat').val(aData['emptyseat']);

		                                $('#cost').val(aData['cost']);

		                                $('#activestatusofroom').val(aData['isactive']).trigger("chosen:updated");
		                              

										
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
		        
				{"data":"hallname","sWidth": "10%"},
				
				{"data":"roomno","sWidth": "10%"},
		        {"data":"noofseat","sWidth": "10%"},
		        
		        {"data":"emptyseat","sWidth": "7%"},
		        {"data":"newemptydate","sWidth": "10%"},
		        {"data":"newemptyno","sWidth": "10%"},

				
		        {"data":"cost","sWidth": "10%"},

		        {"data":"isactive","sWidth": "10%"},
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
