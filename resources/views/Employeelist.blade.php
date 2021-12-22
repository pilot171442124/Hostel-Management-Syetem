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
                                    <th style="display:none;">hallnammeid</th>

                                    <th>Serial</th>
                                    <th>Employee Name </th>
                                    <th>Hallname </th>
                                    <th>Type</th>

                                    <th>Phone</th>
                                   <th>Address</th>
                                   <th>joint</th>
                                   <th>Salary</th>
                                   <th>Status</th>
                                   <th>Photo</th>
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

<div id="formpanel" class="panel panel-default " style="display:none">
			
					
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                    <div class="card-header bg-light p-3"> <button class="btn btn-primary"><i class="fa fa-bars" style="font-size:15px">&nbsp;{{ __('Update Employee') }}</i></button> 
                    <button id="back" class="btn btn-primary pull-right "> <i class="fa fa-mail-reply"></i> Back</button>
					
					
					</div>
                       
					   
					   
					    <div class="card-body">
                        
                            <form  id="employeeformedit" method="POST">
                            @csrf
                          





                                    <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Employee Name<span class="red">*</span></label>
                                            <input type="text" class="form-control "  name="empname" id="empname" required  data-parsley-trigger="keyup" placeholder="Enter Employee Type">
                                        </div>
                                    </div>
                                    </div>

                                    
                                    <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Hall Name <span class="red">*</span></label>													
                                            <select data-placeholder="Choose the Hall Name..." class="chosen-select" id="hallname" name="hallname" >
                                               
                                                <option value="">Select the Employee ID</option>
                                              
                                                <option value=""></option>
  
                                                <!--<option value="Other">Other</option>-->
                                            </select>
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
                                            <label>Employee Address<span class="red">*</span></label>
                                            <textarea id="empadd" name="empadd" rows="4" cols="50" required style="display:block">


                                              </textarea>
                                            
                                    </div>
                                    </div>
                                    </div>


               

                                    
                                    <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Date of Joint<span class="red">*</span></label>
                                            <input type="date" class="form-control " name="doj" id="doj" data-parsley-type="keyup" required >
                                        </div>
                                    </div>
                                    </div>
                

                                   






                                    <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Salary of the Employee<span class="red">*</span></label>
                                            <input type="text" class="form-control " name="salary" id="salary"  required placeholder="Enter Number of Seat">
                                        </div>
                                    </div>
                                    </div>



                                    


                                                                                
                                    <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Employee Status<span class="red">*</span></label>													
                                            <select data-placeholder="Choose Active Status..." class="chosen-select" id="empstatus" name="empstatus" >
                                                <option value="">Select the Active status</option>
                                                
                                                <option value="Yes">Yes</option>
                                                <option value="No">No</option>

                                              
                                                <!--<option value="Other">Other</option>-->
                                            </select>
                                        </div>											
                                    </div>
                                    </div>
                    
                                    <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group ">
                                            <label > Insert Image of Employee<span class="red">*</span></label>
                                             <input type="file" name="file">
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








function gethalltList() {

$.ajax({
    type: "post",
    url: SITEURL+"/gethallname",
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

//delete  table
function onConfirmWhenDelete(recordId) {

$.ajax({
	type: "post",
	
	url: SITEURL+"/deleteemployeetabledatasRoute",
	
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





//active menu
$( ".EmployeeManagement-menu" ).addClass( "active" );
		$( ".EmployeeManagement-menu ul" ).addClass( "in" );
		$( ".EmployeeManagement-menu ul" ).attr("aria-expanded", "true");
		$( ".Employeelist-menu" ).addClass( "active" );













//if csrf tooken is miss then ajax header  setups		
	$.ajaxSetup({
    headers: {
       'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
}
});

//for employeee  form  edit

$('#employeeformedit').parsley();



    $('#employeeformedit').on('submit', function(event){
        event.preventDefault();
        if($('#employeeformedit').parsley().isValid())
  {
		$.ajax({
				url: SITEURL +"/employeeformedit",
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

				$('#employeeformedit')[0].reset();
				$('#employeeformedit').parsley().reset();
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
		        "url": "<?php route('employeelist') ?>",
		        "datatype": "json",
		        "type": "POST",
		        "data": {"_token":$('meta[name="csrf-token"]').attr('content')}
		    },
			

//edit data

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
		                                $('#empname').val(aData['name']);
		                                $('#hallname').val(aData['hallnameid']).trigger("chosen:updated");
		                                $('#emptype').val(aData['emptype']);
		                                $('#phone').val(aData['phone']);
		                                $('#empadd').val(aData['address']);
		                                $('#doj').val(aData['doj']);
		                                $('#salary').val(aData['salary']);
		                                $('#empstatus').val(aData['isactive']).trigger("chosen:updated");




		                                

		                                //$('#gender').val(aData['gender']).trigger("chosen:updated");
		                        
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
		        {"data":"name","sWidth": "10%"},

		        {"data":"hallname","sWidth": "10%"},
		        {"data":"emptype","sWidth": "10%"},

		        {"data":"phone","sWidth": "10%"},
		        {"data":"address","sWidth": "10%"},
		        {"data":"doj","sWidth": "10%"},
		        {"data":"salary","sWidth": "10%"},
		        {"data":"isactive","sWidth": "5%"},

                
                {"data":"perphoto","sWidth": "10%",
                    "render": function(data) {
                        return '<img src="images/'+data+'" width="50" height="50" />';
                    }
                
                
                },
		        
                {"data":"action","sWidth": "10%","bSortable": false},


		    ]





});
gethalltList();

$('.chosen-select').chosen({width: "100%"});


$('#back,#cancel').click(function(){


cancel();


});

getMyNewPostCount();

});



</script>


@endsection