@extends('hmslayout')
@section('maincontent')



<section class="testimonial-area pt-10 pb-10">
			<div class="container">

				<div id="postlist">
				
					<!--
					<div class="row">
						<div class="col-md-12">
							<article class="post style-2">
								<div class="post-header">
									<div class="post-meta">
										<span><i class="fa fa-clock-o"></i>01 September</span>
										<span><i class="fa fa-user"></i>Rubel</span>
										<span><i class="fa fa-gear"></i>Admin</span>
									</div>
									<div class="post-title">
										<span>Lorem ipsum dolor sit amet</span>
									</div>
								</div>
								<div class="post-content">
									<p>
									Lorem ipsum dolor sit amet consectetur adipiscing elit sed do eiusmod.
									Lorem ipsum dolor sit amet consectetur adipiscing elit sed do eiusmod.
									Lorem ipsum dolor sit amet consectetur adipiscing elit sed do eiusmod.
									Lorem ipsum dolor sit amet consectetur adipiscing elit sed do eiusmod.
									Lorem ipsum dolor sit amet consectetur adipiscing elit sed do eiusmod.
									Lorem ipsum dolor sit amet consectetur adipiscing elit sed do eiusmod.
									Lorem ipsum dolor sit amet consectetur adipiscing elit sed do eiusmod.
									Lorem ipsum dolor sit amet consectetur adipiscing elit sed do eiusmod.
									Lorem ipsum dolor sit amet consectetur adipiscing elit sed do eiusmod.
									Lorem ipsum dolor sit amet consectetur adipiscing elit sed do eiusmod.
									</p>
								</div>
							</article>
						</div>
					</div>-->
				
				


				</div>
				
				
				
			</div>
		</section>







@endsection




@section('customjs')
<script>
var tableMain;
var SITEURL = '{{URL::to('')}}';

$(document).ready(function() {

	$.ajaxSetup({
headers: {
   'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
}
});
    
    
    
    
    
    
    
    
    
    $.ajax({
        type: "post",
        dataType: "json",
        url: SITEURL+"/applicationacceptdata",
        data: {"_token":$('meta[name="csrf-token"]').attr('content')},
        success:function(response){

			var posthtml = "";
            //console.log(response);








			$.each(response, function(i, obj) {
				//$("#CarId").append($('<option></option>').val(obj.CarId).html(obj.CarName));
		
				
				pos=" <a href='{{url("postmanpayment")}}' class='btn btn-primary btn-sm pull-right'>"+" Go to payment"+"</a>";


			    posthtml = '<div class="row ">'+
							'<div class="col-md-12">'+
								'<article class="post style-2 bg-light">'+
									'<div class="post-header">'+
										'<div class="post-meta">'+
											'<span><i class="fa fa-user admin"></i>'+'From Admin'+ '<p  style="color:red">'+'Deadline to Pay: '+obj.first_Payment_time+'</p>'+'</a>'+'</span>'+pos+
											
										'</div>'+
										'<div class="post-title ">'+
											'<span>'+'Student Name: '+obj.studentname+'</span>'+
										'</div>'+
										'<div class="post-title">'+
											'<span>'+'Student ID: '+obj.usercode+'</span>'+
										'</div>'+

										'<div class="post-title">'+
											'<span>'+'Department: '+obj.program+'</span>'+
										'</div>'+

										'<div class="post-title">'+
											'<span>'+'Batch No: '+obj.batchno+'</span>'+
										'</div>'+

										'<div class="post-title">'+
											'<span>'+'Hall Name: '+obj.hallname+'</span>'+
										'</div>'+
										'<div class="post-title">'+
											'<span>'+'Room no: '+obj.room_no+'</span>'+
										'</div>'+
										'<div class="post-title">'+
											'<span>'+'Admit Date in the room: '+obj.admit_date+'</span>'+
										'</div>'+

										'<div class="text-success">'+
											'<span>'+'Your application is accepted. Please pay rent of the room in your time limit. '+'</span>'+
										'</div>'+
									'</div>'+
									
								'</article>'+
							'</div>'+
						'</div>';


					 $("#postlist").append(posthtml);
				});



			
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
			toastr.error("Operation fail");

			}, 1300);

        }

    });








//

$.ajax({
        type: "post",
        dataType: "json",
        url: SITEURL+"/showrequestandpendlist",
        data: {"_token":$('meta[name="csrf-token"]').attr('content')},
        success:function(response){

			var posthtmlpeding = "";
            //console.log(response);

	
				//$("#CarId").append($('<option></option>').val(obj.CarId).html(obj.CarName));
			
			    posthtmlpeding = '<div class="row ">'+
							'<div class="col-md-12">'+
								'<article class="post style-2 bg-light">'+
									'<div class="post-header">'+
										'<div class="post-meta">'+
											'<span><i class="fa fa-user admin"></i>'+'From Admin'+'</span>'+
											
										'</div>'+
										'<div class="post-title ">'+
											'<span>'+'Pending '+'<a href="{{ url('pendingrequest') }}">View Student Pening Request List</a>'+'</span>'+
										'</div>'+
									

										
									'</div>'+
									
								'</article>'+
							'</div>'+
						'</div>';


						posthtmlrequest = '<div class="row ">'+
							'<div class="col-md-12">'+
								'<article class="post style-2 bg-light">'+
									'<div class="post-header">'+
										'<div class="post-meta">'+
											'<span><i class="fa fa-user admin"></i>'+'Someone Request for room'+'</span>'+
											
										'</div>'+
										
									
										'<div class="post-title ">'+
											'<span>'+'Student Name: '+'<a href="{{ url('viewstudentlist&request') }}">View Student Request List </a>'+'</span>'+
										'</div>'+

										
									'</div>'+
									
								'</article>'+
							'</div>'+
						'</div>';







					 //$("#postlist").append(posthtml);

					 if(response.empty >0 && response.pending>0){
                
						$("#postlist").append(posthtmlpeding);
						
						$("#postlist").append(posthtmlrequest);
						
						
        }
					
		else if(response.empty >0){
                
				//$("#postlist").append(posthtmlpeding);
				
				$("#postlist").append(posthtmlrequest);
				
				
}
      else if(response.pending >0 ){
                
						$("#postlist").append(posthtmlpeding);
						
						//$("#postlist").append(posthtmlrequest);
						
						
        }

	

			
        },
        
	

    });


 updateLastPostViewDateByUser();
});














function updateLastPostViewDateByUser() {

	    $.ajax({
	        type: "post",
	        url: SITEURL+"/updateseen",
	        data: {
	        	"id":1,
        		"_token":$('meta[name="csrf-token"]').attr('content')
        	},
	        success:function(response){
	        	//$("#notificationcount").html(response);
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
				toastr.error("Last post view date cann't updated successfully");

				}, 1300);

	        }

	    });
	}


</script>


<style>
	.post-title{
		font-size: 15px;
	}
	.font-white {
    color: white !important;
}

.post-meta{
	font-size: 20px;

}

</style>

@endsection