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















function onConfirmWhenAccept(recordId) {

$.ajax({
    type: "post",
    url: SITEURL+"/pendingrequestlist",            
    datatype:"json",
    data: {
        "id":recordId,
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



$(document).ready(function(){

  
//active menu
$( ".StudentManagementbyadmin-menu" ).addClass( "active" );
		$( ".StudentManagementbyadmin-menu ul" ).addClass( "in" );
		$( ".StudentManagementbyadmin-menu ul" ).attr("aria-expanded", "true");
		$( ".pendinglist-menu" ).addClass( "active" );







  
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

		                                
                                        onConfirmWhenAccept(aData['id']);
							

										
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

        },


















        "columns":[
				
		        {"data":"id","bVisible" : false},
		 
		        {"data":"Serial","sWidth": "10%", "sClass": "align-center", "bSortable": false},
		        
				{"data":"studentname","sWidth": "20%"},
				
				{"data":"phone","sWidth": "15%"},
		        {"data":"program","sWidth": "15%"},
		        
		        {"data":"batchno","sWidth": "10%"},
	
		        {"data":"action","sWidth": "20%" ,"bSortable": false},

		      		       
		
		        
		    ]





    });






    getMyNewPostCount();


});













</script>
@endsection
