@extends('hmslayout')


@section('maincontent')


             <div id="formpanel" class="panel panel-default " style="">
			
					
					<div class="row">
						<div class="col-lg-12">
							<div class="card">
							<div class="card-header bg-light p-3"> <button class="btn btn-primary"><i class="fa fa-bars" style="font-size:15px">&nbsp;{{ __('Add Employee') }}</i></button> </div>
								<div class="card-body">
								
									<form  id="employeeform" method="POST">
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





                                            <div class="row">
											<div class="col-md-4">
												<div class="form-group">
													<label>Employee Name<span class="red">*</span></label>
													<input type="text" class="form-control "  name="empname" id="empname" required  data-parsley-trigger="keyup" placeholder="Enter Employee Type">
												</div>
											</div>
											</div>

                                            

                                            

                                            <div class="row">
											<div class="col-md-4">
												<div class="form-group">
													<label>Gender<span class="red">*</span></label>
													<br>
                                                    <input type="radio" name="gender" value="male" required=""> Male <input type="radio" name="gender" value="female"> Female
													<input type="radio" name="gender" value="female"> Other
												
												</div>
											</div>
											</div>



                                           

                                            <div class="row">
											<div class="col-md-4">
												<div class="form-group">
													<label>Employee Type<span class="red">*</span></label>
													<input type="text" class="form-control "  name="emptype" id="emptype" required  data-parsley-trigger="keyup" placeholder="Enter Employee Type">
												</div>
											</div>
											</div>


											<div class="row">
											<div class="col-md-6">
												<div class="form-group">
													<label>Date of Birth<span class="red">*</span></label>
													<input type="date" class="form-control " name="dob" id="dob"  data-parsley-trigger="keyup" data-parsley-type="date" required >
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





                                            <div class="row" >
											<div class="col-md-6">
												<div class="form-group">
													<label>Employee Address<span class="red">*</span></label>
													<textarea id="empadd" name="empadd" rows="4" cols="50" required style="display:block" >
 
  
  													</textarea>
													
											</div>
											</div>
											</div>


                       

											
											<div class="row">
											<div class="col-md-6">
												<div class="form-group">
													<label>Date of Joint<span class="red">*</span></label>
													<input type="date" class="form-control " name="doj" id="doj" data-parsley-type="keyup" required >
												</div>
											</div>
											</div>
                        

											<div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Hall Name <span class="red">*</span></label>													
                                                    <select data-placeholder="Choose the Hall Name..." class="chosen-select" id="hallname" name="hallname" >
                                                       
													
													    <option value="">Select the Employee Name</option>
														@foreach($hallname as $row)
                                                        <option value="{{$row->id}}">{{$row->hallname}}</option>
														@endforeach
                                                        <!--<option value="Other">Other</option>-->
                                                    </select>
                                                </div>											
                                            </div>
                                            </div>
											


                                            <div class="row">
											<div class="col-md-6">
												<div class="form-group">
													<label>Designation of Employee<span class="red">*</span></label>
													<input type="text" class="form-control "  name="empdesig" id="empdesig" required  data-parsley-trigger="keyup" placeholder="Enter User Full Name">
													
											</div>
											</div>
											</div>






                                            <div class="row">
											<div class="col-md-6">
												<div class="form-group">
													<label>Salary of the Employee<span class="red">*</span></label>
													<input type="text" class="form-control " name="salary" id="salary" data-parsley-type="number" required placeholder="Enter Number of Seat">
												</div>
											</div>
											</div>



											


                                                                                        
                                            <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Employee Status<span class="red">*</span></label>													
                                                    <select data-placeholder="Choose Active Status..." class="chosen-select" id="empstatus" name="empstatus" >
                                                        <option value="">Select the Active status</option>
														
                                                        <option value="Yes">Yes</option>
                                                        <option value="No">No</option>

                                                      
                                                        <!--<option value="Other">Other</option>-->
                                                    </select>
                                                </div>											
                                            </div>
                                            </div>
							
                                            <div class="row">
											<div class="col-lg-6">
                                                <div class="form-group ">
                                                    <label > Insert Image of Employee<span class="red">*</span></label>
                                                     <input type="file" name="file" required>
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




$(document).ready(function(){




//active menu
$( ".EmployeeManagement-menu" ).addClass( "active" );
		$( ".EmployeeManagement-menu ul" ).addClass( "in" );
		$( ".EmployeeManagement-menu ul" ).attr("aria-expanded", "true");
		$( ".addnewemployee-menu" ).addClass( "active" );









	$.ajaxSetup({
    headers: {
       'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
}
});




	$('#employeeform').parsley();

    $('#employeeform').on('submit', function(event){
        event.preventDefault();
        if($('#employeeform').parsley().isValid())
  {
		
	if($('#hallname').val() == '')  
           {  
               
			setTimeout(function() {
					toastr.options = {
						closeButton: true,
						progressBar: true,
						showMethod: 'slideDown',
						timeOut: 4000
					};
					toastr.error("Hall name is Empty");

				}, 1300);

           }  



		  else if($('#empid').val() == '')  
           {  


			setTimeout(function() {
					toastr.options = {
						closeButton: true,
						progressBar: true,
						showMethod: 'slideDown',
						timeOut: 4000
					};
					toastr.error("Employee ID is Empty");

				}, 1300);




           }  


		  else if($('#empstatus').val() == '')  
           {  
                
			setTimeout(function() {
					toastr.options = {
						closeButton: true,
						progressBar: true,
						showMethod: 'slideDown',
						timeOut: 4000
					};
					toastr.error("Employee Status is Empty");

				}, 1300);





           }  
		
		
		else{
		
		$.ajax({
				url: SITEURL +"/employeeentry",
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
			
if(data==1){

	setTimeout(function() {
					toastr.options = {
						closeButton: true,
						progressBar: true,
						showMethod: 'slideDown',
						timeOut: 4000
					};
					toastr.success("Data Inserted Successfully");

				}, 1300);

				$('#employeeform')[0].reset();
				$('#employeeform').parsley().reset();
}









				
				$('#submit').attr('disabled',false);
				$('#submit').val('Submit');
			
			
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
		}

			});




	
		


	
	
	
	
	
	
	
	
	
	
	$('.chosen-select').chosen({width: "100%"});

//get input value

	$("#empid").change(function(){
        var name = $(this).children("option:selected").val();
        


		$.ajax({
				url: SITEURL +"/getofthesnameofuser",
				type:"POST",
			
				data: {"name":name
				
				},
				
			  
			
				success:function(data)
				{
			     $('#empname').val(data.name);
			     $('#phone').val(data.phone);


				}


    });





})
});









</script>

@endsection