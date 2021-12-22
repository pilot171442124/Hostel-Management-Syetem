@extends('hmslayout')


@section('maincontent')


<div id="formpanel" class="panel panel-default " style="">
			
					
					<div class="row">
						<div class="col-lg-12">
							<div class="card">
							<div class="card-header bg-primary p-3 "> {{ __('Hall Name Entry') }}</div>
								<div class="card-body">
								
                                <br>
                                <br>
                                <br>
                                <br>
                                <br>
                                <br>
									<form  id="hallname" method="POST">
									@csrf
										<div class="row">
											<div class="col-md-4">
												<div class="form-group">
													<label>Hall Name<span class="red">*</span></label>
													<input type="text" class="form-control "  name="hallname" id="hallname" required  data-parsley-trigger="keyup" placeholder="Enter Hall Name">
												</div>
											</div>

											

                                            <div class="col-lg-8">
                                                <div class="form-group p-4 m-2">
                                                    <label > Insert Image</label>
                                                     <input type="file" name="file" required>
                                                </div>
                                            </div>
                                            </div>


											<div class="row">
											<div class="col-md-4">
												<div class="form-group">
													<label>Select Gender<span class="red">*</span></label>													
													<select data-placeholder="Choose Gender..." class="chosen-select" id="gender" name="gender" required>
														<option value="">Select Status</option>
														<option value="male">Male</option>
														<option value="female">Famale</option>
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



/***Menu Active***/
$( ".HallManagement-menu" ).addClass( "active" );
		$( ".HallManagement-menu ul" ).addClass( "in" );
		$( ".HallManagement-menu ul" ).attr("aria-expanded", "true");
		$( ".hallnameentry-menu" ).addClass( "active" );







//if csrf tooken is miss then ajax header  setups		
	$.ajaxSetup({
    headers: {
       'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
}
});

    
    $('#hallname').parsley();



    $('#hallname').on('submit', function(event){
        event.preventDefault();
        if($('#hallname').parsley().isValid())
  {
		$.ajax({
				url: SITEURL +"/hallnameentry",
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

				if(data=1)
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

				$('#hallname')[0].reset();
				$('#hallname').parsley().reset();	
				}

			else{


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




				$('#submit').attr('disabled',false);
				$('#submit').val('Submit');
			
			
			   }
		});
		}

			});


		


			$('.chosen-select').chosen({width: "100%"});
		

			getMyNewPostCount();

});



</script>



@endsection
