@extends('hmslayout')
@section('maincontent')






<div id="formpanel" class="panel panel-default " style="display:none">
			
					
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                

                    <div class="card-header bg-light p-3"> <button class="btn btn-primary"><i class="fa fa-bars" style="font-size:15px">&nbsp;{{ __('Update the Student Bill') }}</i></button> 
                    
                    <button id="back" class="btn btn-primary pull-right "> <i class="fa fa-mail-reply"></i> Back</button>
                    
                    
                    </div>





                        <div class="card-body">
                        
                            <form  id="studentbill" method="POST">
                            @csrf
                          

                            <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Student Name<span class="red">*</span></label>
                                            <input type="text" class="form-control "  name="studentname" id="studentname" required  data-parsley-trigger="keyup"  >
                                        </div>
                                    </div>
                                    </div>
                               



                          


                                


                                    <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Room Number<span class="red">*</span></label>
                                            <input type="text" class="form-control " name="room_no" id="room_no" data-parsley-type="number" required >
                                        </div>
                                    </div>
                                    </div>


                                    <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Program<span class="red">*</span></label>
                                            <input type="text" class="form-control "  name="program" id="program" required  data-parsley-trigger="keyup"  >
                                        </div>
                                    </div>
                                    </div>

                                    <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Batch<span class="red">*</span></label>
                                            <input type="text" class="form-control "  name="batchno" id="batchno" required  data-parsley-trigger="keyup"  >
                                        </div>
                                    </div>
                                    </div>



                                    <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Month and Year<span class="red">*</span></label>
                                            <input type="text" class="form-control "  name="m_y" id="m_y" required  data-parsley-trigger="keyup"  >
                                        </div>
                                    </div>
                                    </div>








                                    <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Amount<span class="red">*</span></label>
                                            <input type="text" class="form-control " name="amount" id="amount" data-parsley-type="number" required >
                                        </div>
                                    </div>
                                    </div>

                                    <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Select Status<span class="red">*</span></label>													
                                            <select data-placeholder="Choose Status..." class="chosen-select" id="amount_status" name="amount_status" >
                                               
                                                <option value="">Select the Status</option>

                                            
                                                <option value="paid">paid</option>
                                                <option value="unpaid">unpaid</option>
                                                


                                                <!--<option value="Other">Other</option>-->
                                            </select>
                                        </div>											
                                    </div>
                                    </div>
                               


                                    <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                           
                                            <input type="hidden" class="form-control " name="recordid" id="recordid" data-parsley-type="number" required >
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
                 








<section class="testimonial-area pt-10 pb-10" p-2>


<div id="listpanel" style="" >


        <div class="container">
      
                <div class="row">
                    <div class="col-lg-12">	
                        <table id="tableMain" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th style="display:none;">Id</th>
                                
                                    <th>Serial</th>
                                    <th>Name</th>
                                    <th>ID</th>
                                    <th>Hall</th>
                                    <th>Room</th>
                                    <th>program</th>
                                    <th>Batch</th>
                                    <th>Amount</th>
                                    <th>Status</th>

                                    <th>Month</th>
                                
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
@endsection
@section('customjs')

<script>

var  tablemain;
var SITEURL = '{{URL::to('')}}';




function cancel(){
$('#cancel,#back').click(function(){
$('#listpanel').show();  
$('#formpanel').hide();


});

}



function showandhide(){
$('#formpanel').show();
$('#listpanel').hide();



}




function studentbill(){


$('#studentbill').parsley();



$('#studentbill').on('submit', function(event){
event.preventDefault();
if($('#studentbill').parsley().isValid())
{
$.ajax({
        url: SITEURL +"/editstudentbill",
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

        $('#studentbill')[0].reset();
        $('#amount_status').trigger("chosen:updated");

        $('#studentbill').parsley().reset();
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







}






//drop table


function onConfirmWhenDelete(recordId) {

$.ajax({
	type: "post",
	
	url: SITEURL+"/deletestudentbillRoute",
	
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

  
  
    $.ajaxSetup({
headers: {
   'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
}
});



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
            "url": "<?php route('studentbill') ?>",
            "datatype": "json",
            "type": "POST",
            "data": {"_token":$('meta[name="csrf-token"]').attr('content')}
        },





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
										$('#studentname').val(aData['student_name']);

										
										$('#room_no').val(aData['room_no']);
		                               
		                              
										$('#program').val(aData['program']);
		                                
                                        
                                        $('#batchno').val(aData['batch_no']);

		                                $('#m_y').val(aData['month']);
		                                $('#noofemptseat').val(aData['emptyseat']);

		                                $('#amount').val(aData['amount']);

		                                $('#amount_status').val(aData['status']).trigger("chosen:updated");
		                              
		                            

										
										showandhide();
										
										
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
		 
		        {"data":"Serial","sWidth": "5%", "sClass": "align-center", "bSortable": false},
		        
				{"data":"student_name","sWidth": "10%"},
				
				{"data":"perstudent_id","sWidth": "8%"},
		        
		        {"data":"hall_name","sWidth": "10%"},
		        {"data":"room_no","sWidth": "5%"},
		        {"data":"program","sWidth": "7%"},
		        {"data":"batch_no","sWidth": "5%"},

		        {"data":"amount","sWidth": "7%"},
		        {"data":"status","sWidth": "7%"},

		        {"data":"month","sWidth": "5%"},


		        {"data":"action","sWidth": "10%" ,"bSortable": false},

		      		       
		
		        
		    ]





    });









    $('.chosen-select').chosen({width: "100%"});


    cancel();
    onConfirmWhenDelete();

    studentbill();


    getMyNewPostCount();


});













</script>
@endsection
