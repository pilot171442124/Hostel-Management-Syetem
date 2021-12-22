@extends('hmslayout')
@section('maincontent')

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
                                    <th>Hall Name</th>
                                    <th>Room No</th>

                                    <th>phone</th>
                                    <th>Program</th>
                                    <th>Batch</th>
                                
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







		
    <div id="formpanel" class="panel panel-default " style="display:none">
			

					
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                    <div class="card-header bg-primary p-3 "> {{ __('Inactive for Students') }}</div>



                        <br>
                        <div class="card-body">
                        <button id="back" class="btn btn-primary pull-right m-2"> <i class="fa fa-mail-reply"></i> Back</button>	

                        <form  id="inactivestudent" method="POST">
                            @csrf

                                    <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Select Active status<span class="red">*</span></label>													
                                            <select data-placeholder="Choose Gender..." class="chosen-select" id="status" name="status" required>
                                                <option value="">Select Status</option>
                                                <option value="Inactive">Inactive</option>
                                                <option value="Active">Active</option>
                                            </select>
                                        </div>											
                                    </div>
                                    </div>
                                   

                                
                                    <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group" style="display:none">
                                            <label>ID<span class="red">*</span></label>													
                                           <input type="text" name="recordId" id="recordId">
                                        </div>											
                                    </div>
                                    </div>
                            



                    
                                    <div class="row">
                                
                                    <div class="form-group">
                                    <div class="col align-self-center">
                                    <input type="submit" id="submit" name="submit" value="Submit" class="btn btn-success" />
                                        
                                    <a href="#" class="btn btn-warning"id="cancel"> Cancel</a>
                                        </div>
                         
                                    </div>
                         
                                    </div>
                                    
                                

                            </form>
                             
                        </div>
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


function editpanel() {

$("#formpanel").show();
$("#listpanel").hide();

}

function cancel() {

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









function onConfirmWheninactive() {

   // $('#formpanel').parsley();



$('#inactivestudent').on('submit', function(event){
    event.preventDefault();

    $.ajax({
            url: SITEURL +"/inactiveeditforstudent",
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

            $('#inactivestudent')[0].reset();
            $('#inactivestudent').parsley().reset();
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
    


});

	}






//drop table




$(document).ready(function(){

  


//active menu
$( ".RoomManagement-menu" ).addClass( "active" );
		$( ".RoomManagement-menu ul" ).addClass( "in" );
		$( ".RoomManagement-menu ul" ).attr("aria-expanded", "true");
		$( ".leaveroom-menu" ).addClass( "active" );









  
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
            "url": "<?php route('leaveroomforstudent') ?>",
            "datatype": "json",
            "type": "POST",
            "data": {"_token":$('meta[name="csrf-token"]').attr('content')}
        },




//foracept
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
		                        content: 'Do you really want to Inactive the Student?',
		                        icon: 'fa fa-question',
		                        theme: 'bootstrap',
		                        closeIcon: true,
		                        animation: 'scale',
		                        type: 'orange',
								buttons: {

									confirm: function () {

		                               $("#recordId").val(aData['id']);
                                        
                                       onConfirmWheninactive();

										
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

       
       
       
       

       
       
       
       
        },


















        "columns":[
				
		        {"data":"id","bVisible" : false},
		 
		        {"data":"Serial","sWidth": "10%", "sClass": "align-center", "bSortable": false},
		        
				{"data":"studentname","sWidth": "10%"},
				
                {"data":"studentid","sWidth": "10%"},	       

                {"data":"hallname","sWidth": "10%"},	       
                {"data":"room_no","sWidth": "10%" },	       


				{"data":"phone","sWidth": "10%"},
		        {"data":"program","sWidth": "10%"},
		        
		        {"data":"batchno","sWidth": "10%"},
	

		


		        {"data":"action","sWidth": "10%" ,"bSortable": false},



		    ]





    });






    getMyNewPostCount();


$("#cancel,#back").click(function(){


cancel();


});


$('.chosen-select').chosen({width: "100%"});





});













</script>
@endsection
