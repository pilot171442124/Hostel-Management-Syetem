@extends('hmslayout')
@section('maincontent')









<section class="testimonial-area pt-10 pb-10" >




<div class=""id="studentdetails" style="display:none;" >

        <div class="container">
      
                <div class="row ">


                 <div class="col-lg-3  ">	
               

            
            
                    </div>





                    <div class="col-lg-6 border  bg-info">	
               

               
               <div id="image">

               </div>

                <p> Name: <span id="name"></span></p>
                <p> ID: <span id="usercode"></span></p>

                <p> Hall: <span id="hall"></span></p>
                 <p> Room: <span id="room"></span></p>
                 <p> Father's Name: <span id="fname"></span></p>
                 <p> Mother's Name: <span id="mname"></span></p>
                 <p> Date of Birth: <span id="dob"></span></p>
                 <p> Gender: <span id="gender"></span></p>
                 <p> Nationality: <span id="nationality"></span></p>
                 <p> Passport No: <span id="passno"></span></p>
                 <p> Village: <span id="village"></span></p>
                 <p> District: <span id="district"></span></p>


                 <button class="pull-right" id="back">Back</button>
           <br>
           <br>

                   </div>

                </div>

            </div>        
    </div>
  
  

</secttion>










<section class="testimonial-area pt-10 pb-10" p-2>


<div id="listpanel" style="" >


        <div class="container">
      
                <div class="row">
                    <div class="col-lg-12">	
                        <table id="tableMain" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th style="display:none;">Id</th>
                                    <th style="display:none;">hallname</th>
                                    <th style="display:none;">room</th>
                                    <th style="display:none;">stdId</th>
                                   
                                    <th style="display:none;">village</th>
                                    <th style="display:none;">Dristict</th>
                                    <th style="display:none;">nationality</th>
                                    <th style="display:none;">dob</th>
                                    <th style="display:none;">gender</th>
                                    <th style="display:none;">fname</th>
                                    <th style="display:none;">mname</th>

                                    <th style="display:none;">passno</th>
                                    <th style="display:none;">photo</th>
                                    <th style="display:none;">Hallname</th>
                                    <th style="display:none;">userid</th>
                                                                        
                                
                                    <th>Serial</th>
                                    <th>Name</th>
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

</secttion>
@endsection
@section('customjs')

<script>

var  tablemain;
var SITEURL = '{{URL::to('')}}';




function studentdetails(){

$("#studentdetails").show(200);

$("#listpanel").hide();


}

function back(){

$("#studentdetails").hide();

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















function onConfirmWhenAccept(recordId,hallname_id,room_no,studentid ) {

$.ajax({
    type: "post",
    url: SITEURL+"/acceptapplicationRequestRoute",            
    datatype:"json",
    data: {
        "id":recordId,

        "hallname_id":hallname_id,
		"room_no":room_no,
		"studentid":studentid,



        "_token":$('meta[name="csrf-token"]').attr('content')
    },
    success:function(response){

        var msg = "Application accepted successfully.";
        setTimeout(function() {
            toastr.options = {
                closeButton: true,
                progressBar: true,
                showMethod: 'slideDown',
                timeOut: 4000
            };
            toastr.success(msg);

        }, 1300);
        $("#tableMain").dataTable().fnDraw();
    }


});
	}






//drop table


				
function onConfirmWhenDelete(recordId,hallname_id,room_no,studentid) {

$.ajax({
	type: "post",
	
	url: SITEURL+"/cancelapplicationRequestRoute",
	
	datatype:"json",
	data: {
		"id":recordId,
		"hallname_id":hallname_id,
		"room_no":room_no,
		"studentid":studentid,

        


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
$( ".StudentManagementbyadmin-menu" ).addClass( "active" );
		$( ".StudentManagementbyadmin-menu ul" ).addClass( "in" );
		$( ".StudentManagementbyadmin-menu ul" ).attr("aria-expanded", "true");
		$( ".viewstudentlistrequest-menu" ).addClass( "active" );









  
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
            "url": "<?php route('getstudentlist&request') ?>",
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
		                        content: 'Do you really want to accept the application?',
		                        icon: 'fa fa-question',
		                        theme: 'bootstrap',
		                        closeIcon: true,
		                        animation: 'scale',
		                        type: 'orange',
								buttons: {

									confirm: function () {

		                                
                                        onConfirmWhenAccept(aData['id'],aData['hallname_id'],aData['room_no'],aData['studentid']);
							

										
										///editpanel();
										
										
		                                //$.alert('Confirmed!');
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
			onConfirmWhenDelete(aData['id'],aData['hallname_id'],aData['room_no'],aData['studentid']);
		},
		cancel: function () {
			//$.alert('Canceled!');
		}
	}
});

});
});		

 
       
       
       
       
       
//view derails




$('a.itmview', tablemain.fnGetNodes()).each(function() {
		               
					   $(this).click(function() {

						    var nTr = this.parentNode.parentNode;
		                    var aData = tablemain.fnGetData(nTr);

							$.confirm({
		                        title: 'Are you sure?!',
		                        content: 'Do you really want to accept the application?',
		                        icon: 'fa fa-question',
		                        theme: 'bootstrap',
		                        closeIcon: true,
		                        animation: 'scale',
		                        type: 'orange',
								buttons: {

									confirm: function () {

		                                
                                       //onConfirmWhen(aData['id'],aData['hallname_id'],aData['room_no'],aData['studentid']);
							
                                        studentdetails();
                                       
										$("#name").html(aData['studentname']);
										$("#usercode").html(aData['usercode']);

										$("#hall").html(aData['hallname']);
										$("#room").html(aData['room_no']);
										$("#fname").html(aData['fname']);
										$("#mname").html(aData['mname']);
										$("#dob").html(aData['dob']);
										$("#gender").html(aData['gender']);
										$("#nationality").html(aData['nationality']);

										$("#passno").html(aData['passno']);
										
										$("#village").html(aData['village']);
										$("#district").html(aData['P_district']);
                    $("#image").html('<img src="images/'+aData['per_photo']+'" width="100px" height="120px" style="border-radius: 50%;" />');
										
		                           
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
                {"data":"hallname_id","bSortable": false,"bVisible" : false},	       
		
                {"data":"room_no","bSortable": false, "bVisible" : false},	       

                {"data":"studentid","bSortable": false, "bVisible" : false},	       


                
                {"data":"village","bSortable": false, "bVisible" : false},	       
                {"data":"P_district","bSortable": false, "bVisible" : false},	       
                {"data":"nationality","bSortable": false, "bVisible" : false},	       
                {"data":"dob","bSortable": false, "bVisible" : false},	       
                {"data":"gender","bSortable": false, "bVisible" : false},
                {"data":"fname","bSortable": false, "bVisible" : false},
                {"data":"mname","bSortable": false, "bVisible" : false},

                {"data":"passno","bSortable": false, "bVisible" : false},	       
                {"data":"per_photo","bSortable": false, "bVisible" : false},	       
                {"data":"hallname","bSortable": false, "bVisible" : false},	       
                {"data":"usercode","bSortable": false, "bVisible" : false},	       
                                




		        {"data":"Serial","sWidth": "10%", "sClass": "align-center", "bSortable": false},
		        
				{"data":"studentname","sWidth": "20%"},
				
				{"data":"phone","sWidth": "15%"},
		        {"data":"program","sWidth": "15%"},
		        
		        {"data":"batchno","sWidth": "10%"},
	
		        {"data":"action","sWidth": "20%" ,"bSortable": false},

                

		    ]





    });


$("#back").click(function(){

    back();

});







    getMyNewPostCount();


});













</script>
@endsection
