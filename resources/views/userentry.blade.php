@extends('hmslayout')


@section('maincontent')



             <div id="formpanel" class="panel panel-default " style="">
			
					
					<div class="row">
						<div class="col-lg-12">
							<div class="card">
							<div class="card-header bg-primary p-3">{{ __('Create User') }}</div>
								<div class="card-body">
								
									<form  id="addeditform" method="POST">
									@csrf
										<div class="row">
											<div class="col-md-4">
												<div class="form-group">
													<label>User Name<span class="red">*</span></label>
													<input type="text" class="form-control "  name="name" id="name" required  data-parsley-trigger="keyup" placeholder="Enter User Full Name">
												</div>
											</div>

											<div class="col-md-4">
												<div class="form-group">
													<label>ID<span class="red">*</span></label>
													<input type="text" class="form-control " name="usercode" id="usercode" data-parsley-trigger="text" data-required="true" placeholder="Enter ID">
												</div>
											</div>

											<div class="col-md-4">
												<div class="form-group">
													<label>Phone No<span class="red">*</span></label>
													<input type="text" class="form-control " name="phone" id="phone" required data-parsley-type="number" required data-parsley-length="[11, 11]" data-parsley-trigger="keyup" placeholder="Enter User Phone No">
												</div>
											</div>
											

										</div>


										<div class="row">

										<div class="col-md-6">
											<div class="form-group">
												<label>Role<span class="red">*</span></label>													
												<select data-placeholder="Choose Role..." class="chosen-select" id="userrole" name="userrole" required>
													<option value="">Select Role</option>
													<option value="Admin">Admin</option>
													<option value="Employee">Employee</option>
													<option value="Student">Student</option>
													<!--<option value="Other">Other</option>-->
												</select>
											</div>											
										</div>



										<div class="col-md-6">
												<div class="form-group">
													<label>E-mail <span class="red">*</span></label>
													<input type="text" class="form-control " name="email" id="email" required data-parsley-type="email" data-parsley-trigger="keyup" placeholder="Enter User E-mail">
												</div>
											</div>
											</div>


											<div class="row">
											<div class="col-md-4">
												<div class="form-group">
													<label>Gender<span class="red">*</span></label>
													<br>
                                                    <input type="radio" name="gender" value="male" required> Male <input type="radio" name="gender" value="female"> Female
													<input type="radio" name="gender" value="female"> Other
												
												</div>
											</div>
											</div>


											
											<div class="row">
											<div class="col-md-6">
											<div class="form-group">
											   
       												<label for="password">Password <span class="red">*</span></label>
       												<input type="password" name="password" id="password" placeholder="Password" required data-parsley-length="[8, 16]" data-parsley-trigger="keyup" class="form-control" />
     										 
     										 </div>
     										</div>




											<div class="col-md-6">
												<div class="form-group">
       												<label for="cpassword">Confirm Password<span class="red">*</span></label>
														<input type="password" name="confirm_password" id="confirm_password" placeholder="Confirm Password"data-parsley-equalto="#password" data-parsley-trigger="keyup" required class="form-control" />
													</div>
											</div>
										</div>





										<div class="row">
											<div class="col-md-4">
												<div class="form-group">
													<label>Active Status<span class="red">*</span></label>													
													<select data-placeholder="Choose Active Status..." class="chosen-select" id="activestatus" name="activestatus" required>
														<option value="">Select Status</option>
														<option value="Active">Active</option>
														<option value="Inactive">Inactive</option>
													</select>
												</div>											
											</div>
											
										</div>
										<div class="form-group row">
											<div class="col align-self-center">
											<input type="submit" id="submit" name="submit" value="Submit" class="btn btn-success" />
												
										 	   </div>
     							
											</div>
										
											

										
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
        if(response == 0){
            $("#notificationcount").html('');
        }
		if(response.empty >0 && response.pending>0){
            $("#notificationcount").html(rowcount);
        }
     
        else{
           $("#notificationcount").html(response);

       }

	   console.log( response.empty) 
		







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



 /***Menu Active***/
 $( ".Studentuser-menu" ).addClass( "active" );
		$( ".Studentuser-menu ul" ).addClass( "in" );
		$( ".Studentuser-menu ul" ).attr("aria-expanded", "true");
		$( ".createuser-menu" ).addClass( "active" );





	getMyNewPostCount();

//if csrf tooken is miss then ajax header  setups		
	$.ajaxSetup({
    headers: {
       'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
}
});

    
    $('#addeditform').parsley();



    $('#addeditform').on('submit', function(event){
        event.preventDefault();
        if($('#addeditform').parsley().isValid())
  {
		$.ajax({
				url: SITEURL +"/adduserentry",
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
			
          if(data=="getemail")
		  {

			setTimeout(function() {
					toastr.options = {
						closeButton: true,
						progressBar: true,
						showMethod: 'slideDown',
						timeOut: 4000
					};
					toastr.error("This email already taken");

				}, 1300);
		  }

  if(data=="getphonenumber")
{
	setTimeout(function() {
					toastr.options = {
						closeButton: true,
						progressBar: true,
						showMethod: 'slideDown',
						timeOut: 4000
					};
					toastr.error("This Phone number already taken");

				}, 1300);

}


if(data=="getusercode")
{
	setTimeout(function() {
					toastr.options = {
						closeButton: true,
						progressBar: true,
						showMethod: 'slideDown',
						timeOut: 4000
					};
					toastr.error("This ID already taken");

				}, 1300);

}

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

				$('#addeditform')[0].reset();
				$('#addeditform').parsley().reset();
}



				
				$('#submit').attr('disabled',false);
				$('#submit').val('Submit');
			
			
			   }
		});
		}

			});


		



		$('.chosen-select').chosen({width: "100%"});
		
		
});



</script>



@endsection
