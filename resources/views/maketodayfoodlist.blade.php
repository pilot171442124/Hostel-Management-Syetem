@extends('hmslayout')
@section('maincontent')
<section class="testimonial-area pt-10 pb-10" >



<div class="row" id="form-panel" >
			

<div class="container">       





				<div class="col-lg-12">
				
                    <div class="ibox ">
                        <div class="ibox-title">
                            <h5>Select Food Iteam to Make Today Food List</h5>
							  




                        </div>
                        <div class="ibox-content">

								
                        <div id="SubjectsDynamicControls">
								</div>


                     <form name="foodlistentryperday" id="foodlistentryperday">  
                         
                              
                                 
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
                            <label for="gender" class="col-md-4 col-form-label text-md-right">{{ __('Click the button to select time') }}</label>

                            <div class="col-md-6 p-2">
                            &nbsp; <input type="radio" name="foodselecttime" value="Morning" required> Morning <input type="radio" name="foodselecttime" value="Lunch"> Lunch
							<input type="radio" name="foodselecttime" value="Dinner"> Dinner 
                            
                            </div>
                        </div>


  
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
                                    <th style="display:none;">Date</th>

                                    <th>Serial</th>
                                    <th>Food Name</th>
                                    <th>Price</th>
                                    <th>Available</th>
                                    <th>Not Available</th>
                                    <th>Time</th>

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




<br>

<br>

  @endsection


  @section('customjs')

<script>
var  foodid= [];

var filtercount = 0;
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







function onConfirmWhenDelete(recordId) {

$.ajax({
	type: "post",
	
	url: SITEURL+"/deletetodaymenulistRoute",
	
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










function foodlistdatainsert()
{


$('#foodlistentryperday').on('submit', function(event){
        event.preventDefault();
 
		$.ajax({
				url: SITEURL +"/foodlistentryperday",
				type:"POST",
			
				data: $("#foodlistentryperday").serialize()+"&foodid="+JSON.stringify(foodid),
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
					toastr.success("This Food Menu Created");

				}, 200);

				
				
				foodid = [];
			  $("#SubjectsDynamicControls").empty();

			  $("#tableMain").dataTable().fnDraw();




		  }



				
				$('#submit').attr('disabled',false);
				$('#submit').val('Submit');
			



			
			   }
		});
		

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
	
	
	
	
	}





	function deleteTransType(todayfoodval){
		
	
		foodid = foodid.filter(function(elem){
		 return elem != todayfoodval; 
		});
		$('#Items_'+todayfoodval+ '').remove();

		//foodid.push(todayfoodval);


	}






 
    function getfoodlist() {

$.ajax({
    type: "post",
    url: SITEURL+"/getfoodlist",
    data: {
        "id":1,
        "_token":$('meta[name="csrf-token"]').attr('content')
    },
    success:function(response){
        $.each(response, function(i, obj) {
            $("#todayfood").append($('<option></option>').val(obj.id).html(obj.StudentName));
        
   
        
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






$(document).ready(function() {



 /***Menu Active***/
		$( ".MealManagement-menu" ).addClass( "active" );
		$( ".MealManagement-menu ul" ).addClass( "in" );
		$( ".MealManagement-menu ul" ).attr("aria-expanded", "true");
		$( ".maketodayfoodlist-menu" ).addClass( "active" );


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
			"url": "<?php route('getfooditesam') ?>",
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





					$('input.attChange', tablemain.fnGetNodes()).each(function() {
				
				
				
				$(this).click(function() {
					var nTr = this.parentNode.parentNode;
					var aData = tablemain.fnGetData(nTr);
					recordId = aData['id'];
					console.log(recordId);
					
				var radioValue = $("input[name='Checksufficient"+recordId+"']:checked").val();
					
				//console.log(radioValue);
					
					
				
		


				$.ajax({
											"type" : "POST",
											"url": SITEURL+"/updatefoodstatusRoute",
											datatype:"json",
								            data: {
								            	"recordId":recordId,
								            	"Checksufficient":radioValue,
								        		"_token":$('meta[name="csrf-token"]').attr('content')
								    		},
											"success" : function(response) {
												if (response != 1) {
													setTimeout(function() {
														toastr.options = {
															closeButton: true,
															progressBar: true,
															showMethod: 'slideDown',
															timeOut: 4000
														};
														toastr.error(response);

													}, 1300);
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
			{"data":"date","bVisible" : false},
			

			{"data":"Serial","sWidth": "5%", "sClass": "align-center", "bSortable": false},
			
			{"data":"foodname","sWidth": "20%"},
			
			{"data":"foodprice","sWidth": "10%"},
			{"data":"Available","sWidth": "10%","bSortable": false},
			{"data":"NotAvailable","sWidth": "20%","bSortable": false},
			{"data":"time","sWidth": "20%","bSortable": false},

			{"data":"action","sWidth": "15%" ,"bSortable": false},
			
		
						 
	
			
		]





});





















getfoodlist();

//drop table
$('.chosen-select').chosen({width: "100%"});


foodlistdatainsert();

getMyNewPostCount();

});















</script>

  @endsection
