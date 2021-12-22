@extends('hmslayout')


@section('maincontent')


<div id="formpanel" class="panel panel-default " style="">
			
					
					<div class="row">
						<div class="col-lg-12">
							<div class="card">
							<div class="card-header bg-primary p-3 "> {{ __('Cost Entry') }}</div>
								<div class="card-body">
								
                                <br>
                                <br>
                            
									<form  id="costentry" method="POST">
									@csrf
                                    <div class="row">
											<div class="col-md-6">
												<div class="form-group">
													<label>Select Hall<span class="red">*</span></label>													
													<select data-placeholder="Choose Hall..." class="chosen-select" id="hall" name="hall" required>
														<option value="">Select Hall</option>
														@foreach($data as $row)
														<option value="{{$row->id}}">{{$row->hallname}}</option>
											@endforeach
													</select>
												</div>											
											</div>
											</div>





											<div class="row">
											<div class="col-md-6">
												<div class="form-group">
													<label>Room no<span class="red">*</span></label>													
                                                    <input type="text" id="room" name="room"  class="form-control" required placeholder="Enter room no"/>

												</div>											
											</div>
											</div>


                                            <div class="row">
											<div class="col-md-6">
												<div class="form-group">
													<label>Descriptions<span class="red">*</span></label>													
                                                    <textarea id="w3review" name="descriptions" class="form-control" rows="4" cols="50">
                                                  
                                                    </textarea>


												</div>											
											</div>
											</div>




    







                                            <div class="row">
											<div class="col-md-6">
												<div class="form-group">
													<label>Select Date<span class="red">*</span></label>													
                                                    <input type="date" id="date" name="date"  class="form-control" required placeholder="Enter room no"/>

												</div>											
											</div>
											</div>


                                            <div class="row">
											<div class="col-md-6">
												<div class="form-group">
													<label>Amount<span class="red">*</span></label>													
                                                    <input type="text" id="Amount" name="Amount"  class="form-control" required placeholder="Enter Amount"/>

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
				<br>
				
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
$( ".CostManagement-menu" ).addClass( "active" );
		$( ".CostManagement-menu ul" ).addClass( "in" );
		$( ".CostManagement-menu ul" ).attr("aria-expanded", "true");
		$( ".costentry-menu" ).addClass( "active" );








//if csrf tooken is miss then ajax header  setups		
	$.ajaxSetup({
    headers: {
       'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
}
});

    
    $('#costentry').parsley();



    $('#costentry').on('submit', function(event){
        event.preventDefault();
        if($('#costentry').parsley().isValid())
  {
		$.ajax({
				url: SITEURL +"/costentry",
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

				$('#costentry')[0].reset();
				$('#costentry').parsley().reset();	
				$("#hall").val('');



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
