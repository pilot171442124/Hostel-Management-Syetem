@extends('hmslayout')


@section('maincontent')



<div id="formpanel" class="panel panel-default " style="">
			
					
					<div class="row">
						<div class="col-lg-12">
							<div class="card">
							<div class="card-header bg-primary p-3">{{ __('Create Bil Per Month') }}</div>
								<div class="card-body">
								
									<form  id="billpermonth" method="POST">
									@csrf
										<div class="row">
											<div class="col-md-4">
												<div class="form-group">
													<label>Date<span class="red">*</span></label>
													<input type="text" class="form-control " autocomplete="off" name="date" id="date" required  data-parsley-trigger="keyup" placeholder="Enter Month and Year">
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


$(document).ready(function(){




//active menu
$( ".StudentPayment-menu" ).addClass( "active" );
		$( ".StudentPayment-menu ul" ).addClass( "in" );
		$( ".StudentPayment-menu ul" ).attr("aria-expanded", "true");
		$( ".generatebill-menu" ).addClass( "active" );









    $("#date").datepicker({
        dateFormat: 'MM yy',
        changeMonth: true,
        changeYear: true,
        showButtonPanel: true,

        onClose: function(dateText, inst) {
            var month = $("#ui-datepicker-div .ui-datepicker-month :selected").val();
            var year = $("#ui-datepicker-div .ui-datepicker-year :selected").val();
            $(this).val($.datepicker.formatDate('MM yy', new Date(year, month, 1)));
        }
    });

    $("#date").focus(function () {
        $(".ui-datepicker-calendar").hide();
        $("#ui-datepicker-div").position({
            my: "center top",
            at: "center bottom",
            of: $(this)
        });
    });



//insert date


$('#billpermonth').parsley();



    $('#billpermonth').on('submit', function(event){
        event.preventDefault();
        if($('#billpermonth').parsley().isValid())
  {
		$.ajax({
				url: SITEURL +"/billgenerate",
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
			
       
				
				$('#submit').attr('disabled',false);
				$('#submit').val('Submit');
			
			
			   }
		});
		}

			});











});




</script>


@endsection
