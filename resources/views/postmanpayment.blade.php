@extends('hmslayout')


@section('maincontent')





<section class="testimonial-area pt-10 pb-10 ">

        <div class="container">

        <div class="jumbotron">
        <p>Name: <span id="student_name"></span>  </p>


        <p>ID: <span id="student_id"></span>  </p>


        <p>Hall Name: <span id="hall_name"></span>  </p>

        




        

        </div>

        </div>


</section>


<p id="perid" style="display:none"></p>

<section class="testimonial-area pt-10 pb-10  " id='invoice' style="display:none">

<div class="container">
<div class="jumbotron">
<div class="printarea">
  <center> <p style="font-size:15px"> <b>Invoice No: <span id="invoiceno"> </span></b></p></center>
      
	

		<p> Name: <span id="name"> </span></p>
        <p> ID: <span id="id"> </span></p>
        <p> Date: <span id="date"> </span></p>
       
  <center> <p style="font-size:15px"> <b> <span id="hall"> </span></b></p></center>
        
	<table id="tablMain" class="table table-striped table-bordered " style="width:100px;">
                            <thead>
                                <tr>
                                   
                                

                                    <th>Room No</th>
                                    <th>Phone No</th>
                                    <th>Month</th>
                                    <th>Amount</th>
                                   
                                </tr>

                                <tr>
                                   
                                
                                <td id="roomno"></td>
                                <td id="phone"></td>

                                <td id="month"></td>
                                <td id="amount"></td>
                                  
                               </tr>


                            </thead>
                            <tbody id="tabledata">

                            </tbody>
							
							<tfoot>
								<tr class="bg-light"><td colspan="3">Total</td><td> =<span id="total" ></span> Tk</td></tr>
							</tfoot>

                        </table>			
					
                        <br>
          <br>                  
          <br>                  

        <p> Signature.........................</p>
        </div>                 

		<button class="pull-right btn btn-primary" id="print"><i style="color:red;font-size:18px"class="fa fa-print"></i></button>

     <button class=" pull-right btn btn-warning" id="cancel">Cancel</button>

      <button class="pull-right btn btn-primary" id="pay">Pay</button>
 
       
        

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
                                   
                                    <th style="display:none;">Invoice</th>
                                    <th style="display:none;">phone</th>
                                   
                                   
									<th>Serial</th>
                                    <th>Room</th>
                                    <th>Program</th>
                                   
                                    <th>Batch</th>
                                    <th>Month-Year</th>
                                    <th>Amount</th>

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

</section>

<br>
<br>



@endsection


@section('customjs')
<script>


let today = new Date().toISOString().slice(0, 10);



var tabledata;	
var recordid;

var filtercount = 0;

var tablemain;
var SITEURL = '{{URL::to('')}}';







$(function() {

$("#print").on('click', function() {

  $.print(".printarea");

//console.log('jfhjh');


  

});

});






function invoice(){

$('#invoice').show();

$('#listpanel').hide();




}

function cancel(){

$('#invoice').hide();

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






$(document).ready(function(){


	$( ".StudentManagementbyadmin-menu" ).addClass( "active" );
		$( ".StudentManagementbyadmin-menu ul" ).addClass( "in" );
		$( ".StudentManagementbyadmin-menu ul" ).attr("aria-expanded", "true");
		$( ".payment-menu" ).addClass( "active" );






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
			"url": "<?php route('getpaymentdata') ?>",
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
										hallname= aData['hallname'];
										roomno= aData['roomno'];
										month= aData['month'];
										invoic_no= aData['invoic_no'];
										amount= aData['amount'];
										phone= aData['phone'];
                                        

						                
                               

                                $('#roomno').html(roomno);
                                $('#hall').html(hallname);

                                $('#month').html(month);
                                $('#invoiceno').html(invoic_no);
                                $('#amount,#total').html(amount);
                                $('#date').html(today);
                                $('#phone').html(phone);
                               $('#perid').html(recordid);
  
                                


                            invoice();
/* 					

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
			
			
	
			
		
			   }
		});


*/


					
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
		
			{"data":"invoic_no","bVisible" : false},
			{"data":"phone","bVisible" : false},
			
			{"data":"Serial","sWidth": "5%", "sClass": "align-center", "bSortable": false},
			{"data":"roomno","sWidth": "20%"},

			{"data":"program","sWidth": "10%"},
			
			{"data":"batchno","sWidth": "20%"},
			
			{"data":"month","sWidth": "10%"},
			{"data":"amount","sWidth": "10%"},

			{"data":"status","sWidth": "20%","bSortable": false},

			{"data":"action","sWidth": "15%" ,"bSortable": false},
			
		
						 
	
			
		]




});









$.ajax({
	type: "post",
	
	url: SITEURL+"/gethallnameanddid",
	
	datatype:"post",
	data: {
		"id":1,
		"_token":$('meta[name="csrf-token"]').attr('content')
	},
	success:function(response){

    $('#student_id,#id').html(response.id);
    $('#student_name,#name').html(response.name);
    $('#hall_name').html(response.hallname);

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






$('#pay').click(function(){

perid=$("#perid").text();
phone=$("#phone").text();
name=$("#student_name").text();
amount=$("#amount").text();




	$.ajax({
				url: SITEURL +"/pay",
				type:"POST",
			
				//dataType: 'json',
				
			     data: {
					recordid:perid,
					phone:phone,
					name:name,
					amount:amount,

				},
				
				success:function(data)
				{
					window.open(data,'_self');

				},


});

});

$('#cancel').click(function(){

cancel();
});




getMyNewPostCount();





$('.chosen-select').chosen({width: "100%"});

        


});


</script>
				
@endsection