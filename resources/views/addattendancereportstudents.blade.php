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
                        
                                    <th>Serial</th>
                                    <th>Student Name</th>
                                    <th>Student ID</th>

                                    <th>Hall Name</th>
                                    <th>Room No</th>
									 <th> Date</th>
                                    <th> Attendance</th>
                                   

            
                                  

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

<br>
<br>
<br>








@endsection


@section('customjs')

<script>
var SITEURL = '{{URL::to('')}}';
var tablemain;





	
						











function getdata(){


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
      "url": "<?php route('getdatafromattendance') ?>",
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
						var sGroup = oSettings.aoData[oSettings.aiDisplay[iDisplayIndex]]._aData['date'];
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



//console.log(sLastGroup);





			
},



	
		"columns":[
				
		        {"data":"id","bVisible" : false},
		     

		        {"data":"Serial","sWidth": "5%", "sClass": "align-center", "bSortable": false},
		        
				{"data":"studentname","sWidth": "20%"},
				{"data":"studentid","sWidth": "10%"},
				
				{"data":"hallname","sWidth": "20%"},
		        {"data":"room_no","sWidth": "10%"},
		        
		        {"data":"date","sWidth": "15%"},
		      
		        {"data":"isPresent","sWidth": "10%","bSortable": false},


		       
	       
		
		        
		    ]
	
	
	
	
	
	
	
	
	});




}












$(document).ready(function(){




//active menu
$( ".Attendance-menu" ).addClass( "active" );
		$( ".Attendance-menu ul" ).addClass( "in" );
		$( ".Attendance-menu ul" ).attr("aria-expanded", "true");
		$( ".addattendancereportstudents-menu" ).addClass( "active" );






			getdata();



});




</script>


@endsection
