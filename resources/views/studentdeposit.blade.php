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












$(document).ready(function(){

  
    $( ".StudentManagementbyadmin-menu" ).addClass( "active" );
		$( ".StudentManagementbyadmin-menu ul" ).addClass( "in" );
		$( ".StudentManagementbyadmin-menu ul" ).attr("aria-expanded", "true");
		$( ".studentdeposit-menu" ).addClass( "active" );








  
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
            "url": "<?php route('studentdeposit') ?>",
            "datatype": "json",
            "type": "POST",
            "data": {"_token":$('meta[name="csrf-token"]').attr('content')}
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


		        //{"data":"action","sWidth": "10%" ,"bSortable": false},

		      		       
		
		        
		    ]





    });





    getMyNewPostCount();


});













</script>
@endsection
