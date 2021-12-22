@extends('hmslayout')


@section('maincontent')


             <div id="formpanel" class="panel panel-default " style="">
			
					
					<div class="row">
						<div class="col-lg-12">
							<div class="card">
							<div class="card-header bg-light p-3"> <button class="btn btn-primary"><i class="fa fa-bars" style="font-size:15px">&nbsp;{{ __('Create Room') }}</i></button> </div>
								<div class="card-body">
								
									<form  id="roomform" method="POST">
									@csrf
										<div class="row">
											<div class="col-md-6">
												<div class="form-group">
													<label>Room No.<span class="red">*</span></label>
													<input type="text" class="form-control "  name="roomno" id="roomno" required  data-parsley-type="number" data-parsley-trigger="keyup"  placeholder="Enter The Room Number">
												</div>
											</div>
											</div>

                                            <div class="row">
											<div class="col-md-6">
												<div class="form-group">
													<label>Number of Seat<span class="red">*</span></label>
													<input type="text" class="form-control " name="noofseat" id="noofseat" data-parsley-type="number" data-parsley-trigger="keyup" required placeholder="Enter Number of Seat">
												</div>
											</div>
											</div>

                       
                                            <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="hallname">Hall Name<span class="red">*</span></label>													
                                                    <select data-placeholder="Choose hall..." class="chosen-select" id="hallname" name="hallname" required >
                                                        <option value="">Select the Hall Name</option>
														@foreach($data as $row)
                                                        <option value="{{ $row->id}}">{{ $row->hallname}}</option>
                                                        
                                                       @endforeach
                                                        <!--<option value="Other">Other</option>-->
                                                    </select>
                                                </div>											
                                            </div>
                                            </div>


                                            <div class="row">
											<div class="col-md-6">
												<div class="form-group">
													<label>Number of Empty Seat<span class="red">*</span></label>
													<input type="text" class="form-control " name="noofemptyseat" id="noofemptseat"  required data-parsley-trigger="keyup" placeholder="Enter Number of Empty Seat">
												</div>
											</div>
											</div>

                                            
											<div class="row">
											<div class="col-md-6">
												<div class="form-group">
													<label>Cost of Room<span class="red">*</span></label>
													<input type="text" class="form-control " name="cost" id="cost"  required data-parsley-trigger="keyup" placeholder="Enter Number of Empty Seat">
												</div>
											</div>
											</div>




                                                                                        
                                            <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Active The Room<span class="red">*</span></label>													
                                                    <select data-placeholder="Choose status..." class="chosen-select" id="activestatusofroom" name="activestatusofroom" required>
                                                        <option value="">Select the Status</option>
                                                        <option value="Yes">Yes</option>
                                                        <option value="No">No</option>
                                                       
                                                        <!--<option value="Other">Other</option>-->
                                                    </select>
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

//active menu
	$( ".RoomManagement-menu" ).addClass( "active" );
		$( ".RoomManagement-menu ul" ).addClass( "in" );
		$( ".RoomManagement-menu ul" ).attr("aria-expanded", "true");
		$( ".createroom-menu" ).addClass( "active" );





//if csrf tooken is miss then ajax header  setups		
	$.ajaxSetup({
    headers: {
       'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
}
});


	$('#roomform').parsley();




	$('#roomform').on('submit', function(event){
        event.preventDefault();
        if($('#roomform').parsley().isValid())
  {
		$.ajax({
				url: SITEURL +"/roomentry",
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

				$('#roomform')[0].reset();
				$('#roomform').parsley().reset();	



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

			});










    $('.chosen-select').chosen({width: "100%"});

	getMyNewPostCount();
});

</script>


@endsection