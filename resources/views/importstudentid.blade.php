@extends('hmslayout')


@section('maincontent')


    
<button class="btn btn-primary pull-right" id="add"> Add</button>

<br>
<br>


<div id="formpanel" class="panel panel-default " style="display:none">
			
					
					<div class="row">
						<div class="col-lg-12">
							<div class="card">
							<div class="card-header bg-primary p-3 "> {{ __('Entry all of the sutudent identity ') }}</div>
								<div class="card-body">
	
									<form  id="hallname" enctype="multipart/form-data"  action=" {{url('/import')}}" method="POST">
									{{ csrf_field() }}
										<div class="row">
										
                                            <div class="col-lg-8">
                                                <div class="form-group p-4 m-2">
                                                    <label > <b> <i> Insert Student Information use Excel File </i></b> </label>
                                                     <input type="file" name="file" required>
                                                </div>
                                            </div>
                                            </div>


											


									        <div class="form-group row">
											<div class="col align-self-center">
											<input type="submit" id="submit" name="submit" value="Submit" class="btn btn-success" />
												
                                            <a href="{{url('importstudentid')}}" class="btn btn-warning"id="cancel"> Cancel</a>
										 	  
                                               
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
                                    <th>Student ID</th>
                                    <th>Student Name</th>
                                    <th>Student Department</th>
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

</section>




<section class="testimonial-area pt-10 pb-10" p-2>


<div id="formupdatepanel" class="panel panel-default " style="display:none">
			
					
					<div class="row">
						<div class="col-lg-12">
							<div class="card">
							<div class="card-header bg-primary p-3 "> {{ __('Update Student Information') }}</div>
								<div class="card-body">
								
                                <br>
                             
									<form  id="updateimportinformation" method="POST">
									@csrf
										
											
                                    <div class="row">
                                    <div class="col-md-6" >
                                        <div class="form-group" style="">
                                            <label> Student ID<span class="red">*</span></label>
                                            <input type="text" class="form-control "  name="studentid" id="studentid" data-parsley-type="number" required placeholder="Enter Student ID">
                                        </div>
                                    </div>
                                    </div>


                                    <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Student Name<span class="red">*</span></label>
                                            <input type="text" class="form-control "  name="studentname" id="studentname" required  data-parsley-trigger="keyup" placeholder="Enter Student Name" >
                                        </div>
                                    </div>

                                    </div>

                                    
                                    <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Student Department<span class="red">*</span></label>
                                            <input type="text" class="form-control "  name="department" id="department" required  data-parsley-trigger="keyup" placeholder="Enter Student Department" >
                                        </div>
                                    </div>

                                    </div>


                                    <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Student Batch<span class="red">*</span></label>
                                            <input type="text" class="form-control "  name="batch" id="batch" required  data-parsley-trigger="keyup" placeholder="Enter Student Batch" >
                                        </div>
                                    </div>

                                    </div>



                                    <div class="row" style="display:none">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>recorid<span class="red">*</span></label>
                                            <input type="text" class="form-control "  name="id" id="id" required  data-parsley-trigger="keyup" placeholder="Enter Student Batch" >
                                        </div>
                                    </div>

                                    </div>








						                  <div class="form-group row">
											<div class="col align-self-center">
											<input type="submit" id="submit" name="submit" value="Submit" class="btn btn-success" />
                                            <a href="#" class="btn btn-warning"id="cancelupdate"> Cancel</a>
											
                                            
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







function cancel(){


$("#listpanel").show();
$("#add").show();

$("#formupdatepanel").hide();


}







function showupdatebox(){


$("#listpanel").hide();
$("#add").hide();

$("#formupdatepanel").show();


}







function add(){

$("#add").click(function(){

$("#formpanel").show();

$("#listpanel").hide();



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









function edit(){

$('#updateimportinformation').parsley();



    $('#updateimportinformation').on('submit', function(event){
        event.preventDefault();
        if($('#updateimportinformation').parsley().isValid())
  {
		$.ajax({
				url: SITEURL +"/updateimportinformation",
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

				$('#updateimportinformation')[0].reset();
				$('#updateimportinformation').parsley().reset();
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




}







function onConfirmWhenDelete(recordId) {

$.ajax({
	type: "post",
	
	url: SITEURL+"/deletestudentinformationnameRoute",
	
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

















$(document).ready(function() {



/***Menu Active***/
$( ".studentinfo-menu" ).addClass( "active" );
		$( ".studentinfo-menu ul" ).addClass( "in" );
		$( ".studentinfo-menu ul" ).attr("aria-expanded", "true");
		$( ".studentid-menu" ).addClass( "active" );







//if csrf tooken is miss then ajax header  setups		
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
            "url": "<?php route('getstudentid') ?>",
            "datatype": "json",
            "type": "POST",
            "data": {"_token":$('meta[name="csrf-token"]').attr('content')}
        },


        //room
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

		                               
										$('#id').val(aData['id']);
										$('#studentid').val(aData['studentid']);
		                                $('#studentname').val(aData['studentname']);
		                                $('#department').val(aData['studentdept']);
		                                $('#batch').val(aData['batch']);
		                              

										
										showupdatebox();
										
										
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
		        
				{"data":"studentid","sWidth": "25%"},
				
				{"data":"studentname","sWidth": "25%"},
		        {"data":"studentdept","sWidth": "25%"},
		        {"data":"batch","sWidth": "25%"},
		        {"data":"action","sWidth": "10%", "sClass": "align-center", "bSortable": false},
		 
		
		        
		    ]







    });


    



    add();
    edit();

getMyNewPostCount();



$("#cancelupdate").click(function(){

cancel();





});













});



</script>



@endsection