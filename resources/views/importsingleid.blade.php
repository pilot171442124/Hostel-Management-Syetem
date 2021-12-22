@extends('hmslayout')


@section('maincontent')


             <div id="formpanel" class="panel panel-default " style="">
			
					
					<div class="row">
						<div class="col-lg-12">
							<div class="card">
							<div class="card-header bg-light p-3"> <button class="btn btn-primary"><i class="fa fa-bars" style="font-size:15px">&nbsp;{{ __('Import Single Id of Students') }}</i></button> </div>
								<div class="card-body">
								
									<form  id="importidsingle" method="POST">
									@csrf
										<div class="row">
											<div class="col-md-6">
												<div class="form-group">
													<label>Student ID.<span class="red">*</span></label>
													<input type="text" class="form-control "  name="studentid" id="studentid" required  data-parsley-type="number" data-parsley-trigger="keyup"  placeholder="Enter Student ID">
												</div>
											</div>
											</div>

                                            <div class="row">
											<div class="col-md-6">
												<div class="form-group">
													<label>Student Name<span class="red">*</span></label>
													<input type="text" class="form-control " name="studentname" id="studentname"  data-parsley-trigger="keyup" required placeholder="Enter Student Name">
												</div>
											</div>
											</div>

                       
                                            <div class="row">
											<div class="col-md-6">
												<div class="form-group">
													<label>Student Department<span class="red">*</span></label>
													<input type="text" class="form-control " name="studentdept" id="studentdept"  data-parsley-trigger="keyup" required placeholder="Enter Student Department">
												</div>
											</div>
											</div>



                                            <div class="row">
											<div class="col-md-6">
												<div class="form-group">
													<label>Batch<span class="red">*</span></label>
													<input type="text" class="form-control " name="batch" id="batch"  required data-parsley-trigger="keyup" placeholder="Enter Batch">
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
	$( ".studentinfo-menu" ).addClass( "active" );
		$( ".studentinfo-menu ul" ).addClass( "in" );
		$( ".studentinfo-menu ul" ).attr("aria-expanded", "true");
		$( ".importsingleid-menu" ).addClass( "active" );





//if csrf tooken is miss then ajax header  setups		
	$.ajaxSetup({
    headers: {
       'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
}
});


	$('#importidsingle').parsley();




	$('#importidsingle').on('submit', function(event){
        event.preventDefault();
        if($('#importidsingle').parsley().isValid())
  {
		$.ajax({
				url: SITEURL +"/importidsingle",
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

				$('#importidsingle')[0].reset();
				$('#importidsingle').parsley().reset();	



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