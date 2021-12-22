@extends('hmslayout')


@section('maincontent')

<section class="testimonial-area pt-10 pb-10" >

<div class="container">


<div class="row" id="form-panel" >
			

				<div class="col-lg-12">
				
                    <div class="ibox ">
                        <div class="ibox-title">
                            <h5>Select Food Iteam to Create a Bill</h5>
							  



                        </div>

			

						<span id="showprice" class="pull-right"  style="color:red; font-size:30px"></span>



                        <div class="ibox-content">
					

                
					
								
                        <div id="SubjectsDynamicControls">
								</div>


                     <form name="foodmenutentryperday" id="foodmenutentryperday">  
                         
                              
                                 
                              <div class="form-group row" style="border:1px solid #e7eaec; padding-top: 3px;">
									<label class="col-lg-3 col-form-label"><strong>Crarete Today Menu</strong></label>
									<div class="col-lg-7">
										<select data-placeholder="Choose the Food..." class="chosen-select" id="todayfood" name="todayfood" required="true" >
											<option value="0">Select Food</option>
										</select>
									</div>
									<div class="col-lg-1">
										<a href="javascript:void(0)" class="btn btn-warning btn-sm" onClick="addtodaymenu()"><i class="fa fa-plus"></i> Add</a>
									</div>
								</div>
								
        
							<div class="form-group row">
                            <label class="col-lg-3 col-form-label"><strong>Choose the ID</strong></label>
									<div class="col-lg-7">
										<select data-placeholder="Choose the User ID..." class="chosen-select" id="selectid" name="selectid" required="true" >
											<option value="0">Select User ID</option>
										</select>
									</div>
                            </div>
                        </div>


  
                               <input type="submit" name="submit" id="submit" class="btn btn-info" value="Submit" />  
                          </div>  
                     </form>  
                </div>  
                </div>  

                </div>  



</section>



<section class="testimonial-area pt-10 pb-10">


<div id="listpanel" style="" >
<br>

        <div class="container">
      
                <div class="row">
                    <div class="col-lg-12">	
                        <table id="tableMain" class="table table-striped table-bordered table-responsive" style="width:100%">
                            <thead>
                                <tr>
                                    <th style="display:none;">Id</th>
                                    <th style="display:none;">Date</th>
									<th style="display:none;">Name</th>
                                    <th style="display:none;">Invoice</th>
                                    <th>Serial</th>
                                    <th>ID</th>
                                    <th>Price</th>
                                   
                                    <th>Date</th>
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

<button id="print"  style="display:none"class="btn btn-primary pull-right print"> </i> print</button>
<button id="back" style="display:none" class="btn btn-primary pull-right "> <i class="fa fa-mail-reply"></i> Back</button>

<section class="testimonial-area pt-10 pb-10" id='invoice' style="display:none">



<center> <p style="font-size:15px"> <b>Invoice No- <span id="invoiceno"> </span></b></p></center>
        <div class="container">
	

		<p> Name: <span id="name"> </span></p>
        <p> ID: <span id="id"> </span></p>
        <p> Date: <span id="date"> </span></p>
       
        

            
		<table id="tablMain" class="table table-striped table-bordered table-reponsive" style="width:100%">
                            <thead>
                                <tr>
                                   

                                    <th>Food Name</th>
                                    <th>Food Price</th>
                                   
                                </tr>




                            </thead>
                            <tbody id="tabledata">

                            </tbody>
							
							<tfoot>
								<tr ><td colspan="1">Total</td><td> =<span id="total" ></span> Tk</td></tr>
							</tfoot>

                        </table>			
          <br>
          <br>                  
          <br>                  

        <p> Signature.........................</p>
                         
             
         </div>


	 

</secttion>
	



<br>












@endsection


@section('customjs')
<script>
var tabledata;	
var i=0;
var recordid;
var  foodid= [];

var filtercount = 0;

var tablemain;
var SITEURL = '{{URL::to('')}}';



$(function() {

  $("#print").on('click', function() {

    $.print("#invoice");

//console.log('jfhjh');


	

  });

});







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
















function invoice(){

$("#invoice").show();
$("#listpanel").hide();
$("#print").show();

$("#back").show();


}


function backbtn(){

$("#back").click(function(){

	$("#invoice").hide();
   $("#listpanel").show();

   $("#print").hide();

$("#back").hide();

});



}



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






function onConfirmWhenDelete(recordId) {

$.ajax({
	type: "post",
	
	url: SITEURL+"/deletemakebill",
	
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

















function getfoodlid() {

$.ajax({
    type: "post",
    url: SITEURL+"/getprice",
    data: {
        "id":1,
		"foodid":foodid,
        "_token":$('meta[name="csrf-token"]').attr('content')
    },
    success:function(response){
    	
    $("#showprice").html(response+'.00.Tk');



    },

	error:function(error){
		$("#showprice").empty();
   

    }

});




}





function getfoodlistperday() {

$.ajax({
    type: "post",
    url: SITEURL+"/getfoodlistperday",
    data: {
        "id":1,
        "_token":$('meta[name="csrf-token"]').attr('content')
    },
    success:function(response){
        $.each(response, function(i, obj) {
            $("#todayfood").append($('<option></option>').val(obj.foodid).html(obj.foodname));
        
   
        
        });
        $("#todayfood").trigger("chosen:updated");


        filtercount++;
				if(filtercount>1){
					getTableMainData();
				}

    },
    error:function(error){
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









function getuserid() {

$.ajax({
    type: "post",
    url: SITEURL+"/getuserid",
    data: {
        "id":1,
        "_token":$('meta[name="csrf-token"]').attr('content')
    },
    success:function(response){
        $.each(response, function(i, obj) {
            $("#selectid").append($('<option></option>').val(obj.id).html(obj.usercode));
        
   
        
        });
        $("#selectid").trigger("chosen:updated");



    },
    error:function(error){
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












function addtodaymenu(){
		var todayfoodval = $("#todayfood").val();
		var todayfoodselectval=$('#todayfood').find(":selected").text();
		// alert(SubjectId);
		if(todayfoodval == 0){
			setTimeout(function() {
					toastr.options = {
						closeButton: true,
						progressBar: true,
						showMethod: 'slideDown',
						timeOut: 4000
					};
					toastr.error("Please select a food.");

				}, 1300);
			return;
		}




        if(jQuery.inArray(todayfoodval, foodid) != -1) {
			setTimeout(function() {
					toastr.options = {
						closeButton: true,
						progressBar: true,
						showMethod: 'slideDown',
						timeOut: 4000
					};
					toastr.error("Already exist this food.");

				}, 1300);





			return;
		}






		var subjectControlHtml='<div class="form-group row" id="Items_'+todayfoodval+'">'
					+'<a href="javascript:void(0)" class="btn btn-danger btn-sm" style="height: 29px; margin-top:4px;" onClick="deleteTransType('+todayfoodval+');"><i class="fa fa-times"></i></a>'
					+'<label class="col-lg-10 col-form-label">'+todayfoodselectval+'</label>'
					+'<input style="display:none;" type="text" id="Subjects_'+todayfoodval+'" value="'+todayfoodval+'">'
				+'</div>';

		$("#SubjectsDynamicControls").append(subjectControlHtml);

		foodid.push(todayfoodval);
		$("#todayfood").val(0).trigger("chosen:updated");
	
//console.log(foodid);
	
getfoodlid();	
	
	
	}



	function deleteTransType(todayfoodval){
		
	
		foodid = foodid.filter(function(elem){
		 return elem != todayfoodval; 
		});
		$('#Items_'+todayfoodval+ '').remove();

		//foodid.push(todayfoodval);
		getfoodlid();	


	}







$(document).ready(function(){


	$( ".MealManagement-menu" ).addClass( "active" );
		$( ".MealManagement-menu ul" ).addClass( "in" );
		$( ".MealManagement-menu ul" ).attr("aria-expanded", "true");
		$( ".takebill-menu" ).addClass( "active" );






//if csrf tooken is miss then ajax header  setups		
	$.ajaxSetup({
    headers: {
       'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
}
});

    
//edit  hallname



$('#foodmenutentryperday').on('submit', function(event){
        event.preventDefault();
 
		$.ajax({
				url: SITEURL +"/foodmenutentryperday",
				type:"POST",
			
				data: $("#foodmenutentryperday").serialize()+"&foodid="+JSON.stringify(foodid),
				//data: {
					//subjectIds:10
				//},
				
				//contentType: false,
					//cache: false,
			//  processData:false,
				beforeSend:function(){
				$('#submit').attr('disabled','disabled');
				$('#submit').val('Submitting...');
				},
				success:function(data)
				{
			
          if(data==1)
		  {

			
				
				


			

				setTimeout(function() {
					toastr.options = {
						closeButton: true,
						progressBar: true,
						showMethod: 'slideDown',
						timeOut: 4000
					};
					toastr.success("This Bill Created");

				}, 200);

				
				
				foodid = [];
			  $("#SubjectsDynamicControls,#showprice").empty();
			  //$("#showprice").empty();

			  $("#tableMain").dataTable().fnDraw();

			  


		  }



				
				$('#submit').attr('disabled',false);
				$('#submit').val('Submit');
			



			
			   }
		});
		

			});


//drop table








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
			"url": "<?php route('getbilllist') ?>",
			"datatype": "json",
			"type": "POST",
			"data": {"_token":$('meta[name="csrf-token"]').attr('content')}
		},



		"fnDrawCallback" : function(oSettings) {
				
				if (oSettings.aiDisplay.length == 0) {
		                return;
		            }





					$('a.itmview', tablemain.fnGetNodes()).each(function() {
		               
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

		                                
										recordid= aData['id'];
							
										price= aData['foodprice'];
										name= aData['name'];
										invoiceno= aData['invoiceno'];
										userid= aData['userid'];
										date= aData['date'];
                                         
					


				$.ajax({
				url: SITEURL +"/getfoodlistasperuser",
				type:"POST",
			
				//dataType: 'json',
				
			     data: {
					recordid:recordid,
					invoiceno:invoiceno,
				},
				
				success:function(data)
				{
			
			
		//	$("#total").html(price);
			
			
			$("#invoiceno").html(invoiceno);
			
			$("#name").html(name);
			
			$("#id").html(userid);
			$("#date").html(date);

					invoice();
    

           $("#tabledata").html(data);
	
		   $('#example').dataTable( {
         "searching": false
             });
	
			   }
		});




///////


		$.ajax({
				url: SITEURL +"/getfpricer",
				type:"POST",
			
				//dataType: 'json',
				
			     data: {
					recordid:recordid,
					invoiceno:invoiceno,
				},
				
				success:function(data)
				{
			
			
			$("#total").html(data);
			
			
		
         
	
			   }
		});














					
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
			//{"data":"date","bVisible" : false},
			{"data":"name","bVisible" : false},
			{"data":"invoiceno","bVisible" : false},
			

			{"data":"Serial","sWidth": "5%", "sClass": "align-center", "bSortable": false},
			
			{"data":"userid","sWidth": "20%"},
			
			{"data":"foodprice","sWidth": "10%"},
		
			{"data":"date","sWidth": "20%","bSortable": false},

			{"data":"action","sWidth": "15%" ,"bSortable": false},
			
		
						 
	
			
		]




});



















getMyNewPostCount();



backbtn();

getfoodlistperday();
getuserid();


$('.chosen-select').chosen({width: "100%"});

getMyNewPostCount();      


});


</script>
				
@endsection