@extends('hmslayout')


@section('maincontent')


             <div id="formpanel" class="panel panel-default " style="">
			
					
					<div class="row">
						<div class="col-lg-12">
							<div class="card">
							<div class="card-header bg-light p-3"> <button class="btn btn-primary"><i class="fa fa-bars" style="font-size:15px">&nbsp;{{ __('Add Salary') }}</i></button> </div>
								<div class="card-body">
								
									<form  id="salary" method="POST">
									@csrf
                                  




									<div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Employee ID<span class="red">*</span></label>													
                                                    <select data-placeholder="Choose Employee ID..." class="chosen-select" id="empid" name="empid" >
                                                       
													    <option value="">Select the Employee ID</option>
								
														@foreach($data as $row)

													
                                                        <option value="{{$row->id}}">{{$row->usercode}}</option>
														
														@endforeach


                                                        <!--<option value="Other">Other</option>-->
                                                    </select>
                                                </div>											
                                            </div>
                                            </div>




											<div class="row" style="display:none">
											<div class="col-md-6">
												<div class="form-group">
													<label>Hallnameid<span class="red">*</span></label>
													<input type="text" class="form-control " name="hallnameid" id="hallnameid" data-parsley-type="number" >
												</div>
											</div>
											</div>







                                            <div class="row">
											<div class="col-md-6">
												<div class="form-group">
													<label>Employee Name<span class="red">*</span></label>
													<input type="text" class="form-control "  name="empname" id="empname" required  data-parsley-trigger="keyup" placeholder="Enter Employee Type" >
												</div>
											</div>
											</div>

                                            

                                            
                                           

                                            <div class="row">
											<div class="col-md-6">
												<div class="form-group">
													<label>Employee Type<span class="red">*</span></label>
													<input type="text" class="form-control "  name="emptype" id="emptype" required  data-parsley-trigger="keyup" placeholder="Enter Employee Type">
												</div>
											</div>
											</div>


											<div class="row">
											<div class="col-md-6">
												<div class="form-group">
													<label>Phone Number<span class="red">*</span></label>
													<input type="text" class="form-control " name="phone" id="phone" data-parsley-type="number" required placeholder="Enter Employee Phone Number">
												</div>
											</div>
											</div>





                                            <div class="row">
											<div class="col-md-6">
												<div class="form-group">
													<label>Amount<span class="red">*</span></label>
													<input type="text" class="form-control " name="amount" id="amount" data-parsley-type="number" required placeholder="Enter Amount">
												</div>
											</div>
											</div>


											<div class="row">
											<div class="col-md-6">
												<div class="form-group">
													<label>Month-year<span class="red">*</span></label>
													<input type="text" class="form-control "  name="monthandyear" id="monthandyear" required  data-parsley-trigger="keyup" placeholder="Enter Month-Year" >
												</div>
											</div>
											</div>


											<div class="row">
											<div class="col-md-6">
												<div class="form-group">
													<label>Bonus</label>
													<input type="text" class="form-control " name="bonus" id="bonus" data-parsley-type="number" placeholder="Enter Bonus">
												</div>
											</div>
											</div>




										<div class="form-group row">
											<div class="col align-self-center">
											<input type="submit" id="submit" name="submit" value="Submit" class="btn btn-success" />
												
										 	   </div>
     							
											</div>
										
											<br>

										
									</form>
                                     
									</div>
									</div>
									</div>
									</div>
									</div>

                                     
							

@endsection

@section('customjs')
<script>
var SITEURL = '{{URL::to('')}}';
var hallnameid;

//gethallname

function gethallnametList(hallnameid) {

$.ajax({
    type: "post",
    url: SITEURL+"/getspecifichallname",
    data: {
        "id":hallnameid,
        "_token":$('meta[name="csrf-token"]').attr('content')
    },
	
    success:function(response){		

		if(response==0){
			
			$("#hallnameid").val("");

		}
else{
        $.each(response, function(i, obj) {

           

            $("#hallnameid").val(obj.id);
           
        });
		
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
        toastr.error("Dropdown can not fillup");

        }, 1300);

    }

});
}




$(document).ready(function(){



	//if csrf tooken is miss then ajax header  setups		
	$.ajaxSetup({
    headers: {
       'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
}
});




	
	//active menu
	$( ".EmployeeManagement-menu" ).addClass( "active" );
		$( ".EmployeeManagement-menu ul" ).addClass( "in" );
		$( ".EmployeeManagement-menu ul" ).attr("aria-expanded", "true");
		$( ".addsalary-menu" ).addClass( "active" );

	
//get for input data	
	
$("#empid").change(function(){
        var salary = $(this).children("option:selected").val();
        


		$.ajax({
				url: SITEURL +"/getinputdataforsalary",
				type:"POST",
			
				data: {"salary":salary
				
				},
				
			  
			
				success:function(data)
				{
			     $('#empname').val(data.name);
			     $('#phone').val(data.phone);
			     $('#emptype').val(data.emptype);
			     //$('#amount').val(data.amount);
				 hallnameid=(data.hallnameid);
				
				 gethallnametList(hallnameid);
			     


if(data==0){

	setTimeout(function() {
					toastr.options = {
						closeButton: true,
						progressBar: true,
						showMethod: 'slideDown',
						timeOut: 4000
					};
					toastr.error("Does not have this employee");

				}, 1300);




}



				}


    });





})


//add data of this form


$('#salary').parsley();




	$('#salary').on('submit', function(event){
        event.preventDefault();
        if($('#salary').parsley().isValid())
  {

	if($('#hallnameid').val() == '')  
           {  
               
			setTimeout(function() {
					toastr.options = {
						closeButton: true,
						progressBar: true,
						showMethod: 'slideDown',
						timeOut: 4000
					};
					toastr.error("This is not an employee plesse select valid employee id");

				}, 1300);

           }  


else{



		$.ajax({
				url: SITEURL +"/salaryentry",
				type:"POST",
			
				data:  new FormData(this),
				contentType: false,
					cache: false,
			processData:false,
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
					toastr.success("Data Inserted Successfully");

				}, 1300);

				$('#salary')[0].reset();
				$('#salary').parsley().reset();	



			}

			else{

				setTimeout(function() {
								toastr.options = {
									closeButton: true,
									progressBar: true,
									showMethod: 'slideDown',
									timeOut: 4000
								};
								toastr.error("operation Faild ");

							}, 1300);

			}

							
							$('#submit').attr('disabled',false);
							$('#submit').val('Submit');
						
						
						}
					});
}


		}

			});








	
	$('.chosen-select').chosen({width: "100%"});


});




</script>
@endsection

