@extends('hmslayout')
@section('maincontent')


<section class="testimonial-area pt-10 pb-10">


<div id="listpanel" style="" >
<br>

        <div class="container">
      

		<center>
<strong>
<table class="table-bordered text-center"> <tr><th style="font-size:20px">Today Food Menu 


</th> <img src="{{ asset('images/food.jpg') }}" height="200px" width="800px" alt="logo" /> </tr></table></strong>
</center>



                <div class="row">
                    <div class="col-lg-12">	
                        <table id="tableMain" class="table table-striped table-bordered table-hover table-responsive animate__animated  animate__fadeInDown " style="width:100%">
                            <thead>
                                <tr>
								    <th style="display:none;">Id</th>
                                    <th style="display:none;">Date</th>

                                    <th>Serial</th>
                                    <th>Food Name</th>
                                    <th>Price</th>
                                    <th>Available</th>
                                    <th>Not Available</th>

                                 
                                                  
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
var  foodid= [];

var filtercount = 0;
var tablemain;

var SITEURL = '{{URL::to('')}}';







  



$(document).ready(function() {



 /***Menu Active***/
		$( ".MealManagement-menu" ).addClass( "active" );
		$( ".MealManagement-menu ul" ).addClass( "in" );
		$( ".MealManagement-menu ul" ).attr("aria-expanded", "true");
		$( ".viewtodayfoodlist-menu" ).addClass( "active" );


$.ajaxSetup({
headers: {
   'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
}
});




tablemain=$("#tableMain").dataTable({

"bFilter" : true,
	//"scrollY": true,
	"searching": false,
	
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
			"url": "<?php route('getfoodilisttime') ?>",
			"datatype": "json",
			"type": "POST",
			"data": {"_token":$('meta[name="csrf-token"]').attr('content')}
		},






		"fnDrawCallback" : function(oSettings) {
			
			if (oSettings.aiDisplay.length == 0) {
				return;
			}
			


			var nTrs = $('#tableMain tbody tr');
					var iColspan = nTrs[0].getElementsByTagName('td').length;
					var sLastGroup = "";
					for (var i = 0; i < nTrs.length; i++) {
						var iDisplayIndex = i;
						var sGroup = oSettings.aoData[oSettings.aiDisplay[iDisplayIndex]]._aData['time'];
						if (sGroup != sLastGroup) {
							var nGroup = document.createElement('tr');
							var nCell = document.createElement('td');
							nCell.colSpan = iColspan;
							nCell.className = "tableGroupStyle";
							nCell.innerHTML = sGroup;
							nGroup.appendChild(nCell);
							nTrs[i].parentNode.insertBefore(nGroup, nTrs[i]);
							sLastGroup = sGroup;
						}
					}


		},













		dom: 'frti',




		"columns":[
			
			{"data":"id","bVisible" : false},
			{"data":"date","bVisible" : false},
			

			{"data":"Serial","sWidth": "5%", "sClass": "align-center", "bSortable": false},
			
			{"data":"foodname","sWidth": "20%"},
			
			{"data":"foodprice","sWidth": "20%"},
			{"data":"Available","sWidth": "20%","bSortable": false},
			{"data":"NotAvailable","sWidth": "20%","bSortable": false},
			//{"data":"time","sWidth": "20%","bSortable": false},

			
		
						 
	
			
		]





});
























});















</script>

  @endsection
