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
										<th>Employee ID</th>
										<th>Hallname</th>
										<th> Name</th>
										<th>Type</th>
										<th>Phone</th>
										<th>Amount</th>
										<th>Bonus</th>
										<th>Month-year</th>

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



<!--for edit salary-->



<div id="formpanel" class="panel panel-default " style="display:none">
			
					
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                    <div class="card-header bg-light p-3"> <button class="btn btn-primary"><i class="fa fa-bars" style="font-size:15px">&nbsp;{{ __('Update Salary') }}</i></button> 
                    
                    <button id="back" class="btn btn-primary pull-right "> <i class="fa fa-mail-reply"></i> Back</button>
                    
                    
                    </div>
                        <div class="card-body">
                        
                            <form  id="salaryedit" method="POST">
                            @csrf



                                    <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Employee Name<span class="red">*</span></label>
                                            <input type="text" class="form-control "  name="empname" id="empname" required  data-parsley-trigger="keyup" placeholder="Enter Employee Type" >
                                        </div>
                                    </div>
                                    </div>

                                    

                                    
                                   

                                    <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Employee Type<span class="red">*</span></label>
                                            <input type="text" class="form-control "  name="emptype" id="emptype" required  data-parsley-trigger="keyup" placeholder="Enter Employee Type">
                                        </div>
                                    </div>
                                    </div>


                                    <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Phone Number<span class="red">*</span></label>
                                            <input type="text" class="form-control " name="phone" id="phone" data-parsley-type="number" required placeholder="Enter Employee Phone Number">
                                        </div>
                                    </div>
                                    </div>





                                    <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Amount<span class="red">*</span></label>
                                            <input type="text" class="form-control " name="amount" id="amount" data-parsley-type="number" required placeholder="Enter Amount">
                                        </div>
                                    </div>
                                    </div>


                                    <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Month-year<span class="red">*</span></label>
                                            <input type="text" class="form-control "  name="monthandyear" id="monthandyear" required  data-parsley-trigger="keyup" placeholder="Enter Month-Year" >
                                        </div>
                                    </div>
                                    </div>


                                    <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Bonus</label>
                                            <input type="text" class="form-control " name="bonus" id="bonus" data-parsley-type="number" placeholder="Enter Bonus">
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
$("#listpanel").hide();
$("#formpanel").show();

}

function cancel(){
$("#listpanel").show();
$("#formpanel").hide();

}

function activemenu(){

//active menu
$( ".EmployeeManagement-menu" ).addClass( "active" );
		$( ".EmployeeManagement-menu ul" ).addClass( "in" );
		$( ".EmployeeManagement-menu ul" ).attr("aria-expanded", "true");
		$( ".salaryview-menu" ).addClass( "active" );


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





//delete salary table data


function onConfirmWhenDelete(recordId) {

$.ajax({
	type: "post",
	
	url: SITEURL+"/deletesalarydataRoute",
	
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













$(document).ready(function(){

    activemenu();

	$.ajaxSetup({
headers: {
   'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
}
});

    
    
$('#salaryedit').parsley();



$('#salaryedit').on('submit', function(event){
    event.preventDefault();
    if($('#salaryedit').parsley().isValid())
{
    $.ajax({
            url: SITEURL +"/salaryedit",
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

            $('#salaryedit')[0].reset();
            $('#salaryedit').parsley().reset();
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
		        "url": "<?php route('viewsalarylist') ?>",
		        "datatype": "json",
		        "type": "POST",
		        "data": {"_token":$('meta[name="csrf-token"]').attr('content')}

		    },
			
///show for upadat form


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
		                                $('#hallname').val(aData['hallname']);
		                                $('#empname').val(aData['empname']);
		                                $('#emptype').val(aData['emptype']);
		                                $('#phone').val(aData['phone']);
		                                $('#amount').val(aData['amount']);
		                                $('#amount').val(aData['amount']);
		                                $('#monthandyear').val(aData['monthyear']);


		                                $('#bonus').val(aData['bonus']);
		        
										
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
		
		        {"data":"Serial","sWidth": "10%", "sClass": "align-center", "bSortable": false},
		        
				{"data":"employeeid","sWidth": "10%"},	
				{"data":"hallname","sWidth": "10%"},
		        {"data":"empname","sWidth": "10%"},
		        {"data":"emptype","sWidth": "10%"},
		        {"data":"phone","sWidth": "10%"},
		        {"data":"amount","sWidth": "10%"},
		        {"data":"bonus","sWidth": "10%"},
		        {"data":"monthyear","sWidth": "10%"},

		     
		        {"data":"action","sWidth": "10%" ,"bSortable": false},

		      		       
		
		        
		    ]



});

$("#cancel,#back").click(function(){


cancel();

});

getMyNewPostCount();
});




</script>


@endsection