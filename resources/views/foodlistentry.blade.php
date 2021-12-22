@extends('hmslayout')
@section('maincontent')

<section class="testimonial-area pt-10 pb-10" >

<div class="container">
      
	  

                 <div class="form-group">  
                     <form name="add_name" id="add_name" enctype="multipart/form-data">  
                          <div class="table-responsive">  
                               <table class="table table-bordered bg-light" id="">  
                                    <tr>  
                                         <td><input type="text" name="name[]" placeholder="Enter Food Name" required class="form-control name_list" /> 
                                         </td>  

                                         <td><input type="text" name="price[]" placeholder="Enter Food price" required class="form-control name_list" /> 
                                         </td>  
                                    

                                         <td><button type="button" name="add" id="add" class="btn btn-success">Add More</button></td>  
                                   
                                               
                                           
                                   
                                   
                                    </tr>  

                                     

                               </table>  



                               <table class="table table-bordered bg-light" id="dynamic_field">  
                 
                          



                               </table>  



                               <input type="submit" name="submit" id="submit" class="btn btn-info" value="Submit" />  
                          </div>  
                     </form>  
                </div>  
                </div>  
               




</section>



<section class="testimonial-area pt-10 pb-10">


<div id="listpanel" style="" >
<br>

        <div class="container">
      
                <div class="row">
                    <div class="col-lg-12">	
                        <table id="tableMain" class="table table-striped table-bordered table-reponsive" style="width:100%">
                            <thead>
                                <tr>
                                    <th style="display:none;">Id</th>
                                   
                                    <th>Serial</th>
                                    <th>Food Name</th>
                                    <th>Food Price</th>
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





<section class="testimonial-area pt-10 pb-10">


<div id="editpanel" style="display:none" >
<br>

        <div class="container">
      
              
		<div class="row">
                <div class="col-lg-12">
                    <div class="card">
                    <div class="card-header bg-light p-3"> <button class="btn btn-primary"><i class="fa fa-bars" style="font-size:15px">&nbsp;{{ __('Update the Food List') }}</i></button> 
                    
                    <button id="back" class="btn btn-primary pull-right "> <i class="fa fa-mail-reply"></i> Back</button>
                    
                    
                    </div>
                       
                        <div class="card-body">
	               
                               
                            <form  id="foodlistedit" method="POST">
                            @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Food Name<span class="red">*</span></label>
                                            <input type="text" class="form-control "  name="foodname" id="foodname" required   placeholder="Enter the Food Name">
                                        </div>
                                    </div>
                                    </div>


									<div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Food Price<span class="red">*</span></label>
                                            <input type="text" class="form-control "  name="foodprice" id="foodprice" required   placeholder="Enter the Food Name">
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
</secttion>











  @endsection


  @section('customjs')

<script>



var tablemain;

var SITEURL = '{{URL::to('')}}';







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







function editpanel(){

$('#editpanel').show();
$('#listpanel').hide();


}



function back(){

$('#editpanel').hide();
$('#listpanel').show();


}



function edit(){

$('#foodlistedit').parsley();



    $('#foodlistedit').on('submit', function(event){
        event.preventDefault();
        if($('#foodlistedit').parsley().isValid())
  {
		$.ajax({
				url: SITEURL +"/foodlistedit",
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

				$('#foodlistedit')[0].reset();
				$('#foodlistedit').parsley().reset();
				$("#tableMain").dataTable().fnDraw();
}




				
				$('#submit').attr('disabled',false);
				$('#submit').val('Submit');
			
		back();	


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
	
	url: SITEURL+"/foodlistdelete",
	
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
		$( ".MealManagement-menu" ).addClass( "active" );
		$( ".MealManagement-menu ul" ).addClass( "in" );
		$( ".MealManagement-menu ul" ).attr("aria-expanded", "true");
		$( ".foodlistentry-menu" ).addClass( "active" );


$.ajaxSetup({
headers: {
   'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
}
});








//drop table

var i=1;  
      $('#add').click(function(){  
           i++;  
 
           $('#dynamic_field').append('<tr id="row'+i+'"><td><input type="text" name="name[]" placeholder="Enter Food Name" class="form-control name_list" /></td><td><input type="text" name="price[]" placeholder="Enter Food price" required class="form-control name_list" /><td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">X</button></td></tr>');  
      });  
      $(document).on('click', '.btn_remove', function(){  
           var button_id = $(this).attr("id");   
           $('#row'+button_id+'').remove();  
      });  
      
      
      
      
      


      $('#add_name').on('submit', function(event){
        event.preventDefault();
	$.ajax({
				url: SITEURL +"/foodlistentrytableinsert",
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

				if(data=1)
				{

					setTimeout(function() {
					toastr.options = {
						closeButton: true,
						progressBar: true,
						showMethod: 'slideDown',
						timeOut: 4000
					};
					toastr.success("Data Inserted Successfully");

				}, 1300);

				$('#add_name')[0].reset();
					
                  

                    $("#dynamic_field").empty();

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
					toastr.error("Operation Faild");

				}, 1300);
				
			}




				$('#submit').attr('disabled',false);
				$('#submit').val('Submit');
			
			
			   }
		});
		

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
			"url": "<?php route('getfoodlistentry') ?>",
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
										
										$('#foodname').val(aData['foodname']);
										$('#foodprice').val(aData['foodprice']);
		                               

		                               
										editpanel();
								
		                            },
									cancel: function () {
		                                //$.alert('Canceled!');
		                            }


								}

							});


					   });
					});















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
			
			{"data":"foodname","sWidth": "20%"},
			
			{"data":"foodprice","sWidth": "10%"},
		


			{"data":"action","sWidth": "15%" ,"bSortable": false},
			
		
						 
	
			
		]





});


$("#back,#cancel").click(function(){

	back();

});

edit();


getMyNewPostCount();


});











</script>

  @endsection
