
@extends('hmslayout')
@section('maincontent')






<section class="testimonial-area pt-10 pb-10">
			<div class="container">

 
				<div class="row " id="hallimage">

              @foreach($data as $row)

					<div class="col-lg-4">
						<div class="ibox">
							<div class="ibox-content ">
								

							<p class='card-text text-center m-0 p-0' id='title'style='color:black; font-size:17px;'> {{ $row->hallname}}</p>

       
						<center>	<img class='card-img-top animate__animated wow animate__fadeInDown ' src='images/{{ $row->hallpic}}' alt='Card image' style='width:210px;height:210px;'></center>
								
							<p class='card-text text-center m-0 p-0' id='title'style='color:black'> {{ $row->gender}}</p> 
							<a href='#'class='btn btn-dark bg-primary  hallclass' id='{{ $row->id}}' > View Room</a>

							</div>
						</div>
					</div>
					
					@endforeach
			
						</div>
						<br>
					</div>




</section>













       
  



<section class="testimonial-area pt-10 pb-10" p-2>





	<div id="listpanel" style="display:none" >


			<div class="container">
			<button id="back" class="btn btn-primary pull-left m-2"> <i class="fa fa-mail-reply"></i> Back</button>	
	<br>
	<br>
			
					<div class="row">
						<div class="col-lg-12">	
							<table id="tableMain" class="table table-striped table-bordered" style="width:100%">
								<thead>
									<tr>
										<th style="display:none;">Id</th>
										<th>Serial</th>
										<th>Hall Name</th>
										<th>Room No</th>
										<th>Total Seat</th>
										<th> Current Empty</th>
										<th> New Empty Date</th>
										<th> New Empty no</th>

										<th>Cost</th>

										<th>Active-Room</th>
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

function showlistpanelandhallimage(){

  $("#listpanel").show();
  $("#hallimage").hide();
  
}

function showhallnamepage(){

$("#listpanel").hide();
$("#hallimage").show();

}



var SITEURL = '{{URL::to('')}}';
$(document).ready(function() {



	$.ajaxSetup({
    headers: {
       'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
}
});




 
//if csrf tooken is miss then ajax header  setups		
	


$(document).on('click', '.hallclass', function(){ 
		var hallid=$(this).attr("id");
    showlistpanelandhallimage();

 
	$("#tableMain").dataTable({


		"bFilter" : true,
		"scrollY": true,
		    "bDestroy": true,
			"bAutoWidth": false,
		    "bJQueryUI": true,      
		    "bSort" : true,
		    "bInfo" : true,
		    "bPaginate" : true,
		    "bSortClasses" : true,
		    "bProcessing" : true,
		    "bServerSide" : true,
			"order": [[ 3, "asc" ]],
		    
		    "aLengthMenu" : [[10, 25, 50, 100], [10, 25, 50, 100]],
		    "iDisplayLength" : 10,
		    "ajax":{
		        "url": "<?php route('getroomlist') ?>",
		        "datatype": "json",
		        "type": "POST",
		        "data": { "hallid":hallid,":_token":$('meta[name="csrf-token"]').attr('content')}
		    },


			"columns":[
				
		        {"data":"id","bVisible" : false},
		        {"data":"Serial","sWidth": "5%", "sClass": "align-center", "bSortable": false},
		        
				{"data":"hallname","sWidth": "20%"},
				
				{"data":"roomno","sWidth": "10%"},
		        {"data":"noofseat","sWidth": "10%"},
		        
		        {"data":"emptyseat","sWidth": "10%"},
		        {"data":"newemptydate","sWidth": "10%"},

		        {"data":"newemptyno","sWidth": "10%"},


		        {"data":"cost","sWidth": "10%"},



		        {"data":"isactive","sWidth": "15%"},
		      		       
		
		        
		    ]
		




});




        

});


$('#back').click(function(){

	showhallnamepage();


});




});





    
    
    
    </script>

      @endsection
