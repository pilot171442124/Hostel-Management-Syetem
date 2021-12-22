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



var tablemain;

var SITEURL = '{{URL::to('')}}';





function onConfirmWhenDelete(recordId,hallname_id,room_no,studentid) {

$.ajax({
	type: "post",
	
	url: SITEURL+"/deleteaddmisionpaymentfail",
	
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











$(document).ready(function() {


 
//active menu
$( ".StudentManagementbyadmin-menu" ).addClass( "active" );
		$( ".StudentManagementbyadmin-menu ul" ).addClass( "in" );
		$( ".StudentManagementbyadmin-menu ul" ).attr("aria-expanded", "true");
		$( ".admissionformpaymentfail-menu" ).addClass( "active" );






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
            "url": "<?php route('admissionformpaymentfail') ?>",
            "datatype": "json",
            "type": "POST",
            "data": {"_token":$('meta[name="csrf-token"]').attr('content')}
        },

    
    



//edit for room
"fnDrawCallback" : function(oSettings) {
				
				if (oSettings.aiDisplay.length == 0) {
		                return;
		            }



//delete data


	
$('a.itmDrop', tablemain.fnGetNodes()).each(function() {

$(this).click(function() {

	var nTr = this.parentNode.parentNode;
	var aData = tablemain.fnGetData(nTr);

	$.confirm({
	title: 'Are you sure?!',
	content: 'Do you really want to Cancel this Request?',
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

                {"data":"hallname_id","bSortable": false,"bVisible" : false},	       
		

                {"data":"studentid","bSortable": false, "bVisible" : false},




		        {"data":"action","sWidth": "10%" ,"bSortable": false},

		      		       
		
		        
		    ]

    
    
    
    
    
    
    });
          



getMyNewPostCount();





});















</script>

  @endsection
