@extends('hmslayout')
@section('titlename') Home @endsection


@section('maincontent')





<section class="testimonial-area pt-10 pb-10">
			<div class="container">

			@if(Auth::check())
          
          @if(Auth::user()->userrole =='Admin')

            


            <div class="row">
					<div class="col-lg-6">
						<div class="ibox ">
							<div class="ibox-content bg-primary">
								<h1 class="no-margins" id="totalhall"></h1>
								<span class="no-margins"><i class="fa fa-home" style="font-size:25px;"></i> Total Hall</span>
							</div>
						</div>
					</div>
				


        
					<div class="col-lg-6">
						<div class="ibox ">
							<div class="ibox-content bg-success">
								<h1 class="no-margins" id="totalroom"></h1>
								<span class="no-margins"><i class="fa fa-hotel" style="font-size:25px;"></i> Total Room</span>
							</div>
						</div>
					</div>
				
                </div>







				<div class="row">
					<div class="col-lg-4">
						<div class="ibox ">
							<div class="ibox-content bg-info">
								<h1 class="no-margins" id="totalstudent"></h1>
								<span class="no-margins"><i class="fa fa-users" style="font-size:25px; color:yellow"></i> Total Current Student</span>
							</div>
						</div>
					</div>
					<div class="col-lg-4">
						<div class="ibox ">
							<div class="ibox-content bg-secondary">
                  
                            <h1 class="no-margins" id="totalemployee"> </h1>
                            
								<span class="no-margins"> <i class="fa fa-users" style="font-size:25px;color:yellow "></i>  Total Employee</span>
                               


							</div>
						</div>
					</div>
			

					<div class="col-lg-4">
						<div class="ibox">
							<div class="ibox-content bg-warning">
								<h1 class="no-margins" id="date">0</h1>
								<span><i class=" fa fa-hand-o-right" style="font-size:25px; color:yellow"></i> Date</span>
							</div>
						</div>
					</div>
					</div>
					
			
 

				<div class="row">
					<div class="col-lg-12">
						<div class="ibox-content">
							<div id="issuedtrendbymonth"></div>
						</div>
					</div>
				</div>	

				@endif







	@if(Auth::user()->userrole =='Employee')

            


<div class="row">
		<div class="col-lg-6">
			<div class="ibox ">
				<div class="ibox-content bg-primary">
					<h1 class="no-margins" id="totalhallemp">0</h1>
					<span class="no-margins"><i class="fa fa-home" style="font-size:25px;"></i> Total Hall</span>
				</div>
			</div>
		</div>
	



		<div class="col-lg-6">
			<div class="ibox ">
				<div class="ibox-content bg-success">
					<h1 class="no-margins" id="totalroomemp">0</h1>
					<span class="no-margins"><i class="fa fa-hotel" style="font-size:25px;"></i> Total Room</span>
				</div>
			</div>
		</div>
	
	</div>







	<div class="row">
		<div class="col-lg-4">
			<div class="ibox ">
				<div class="ibox-content bg-info">
					<h1 class="no-margins" id="totalstudentemp">0</h1>
					<span class="no-margins"><i class="fa fa-users" style="font-size:25px; color:yellow"></i> Total Current Student</span>
				</div>
			</div>
		</div>
		<div class="col-lg-4">
			<div class="ibox ">
				<div class="ibox-content bg-secondary">
	  
				<h1 class="no-margins" id="totalemployeeemp"> 0</h1>
				
					<span class="no-margins"> <i class="fa fa-users" style="font-size:25px;color:yellow "></i>  Total Employee</span>
				   


				</div>
			</div>
		</div>


		<div class="col-lg-4">
			<div class="ibox">
				<div class="ibox-content bg-warning">
					<h1 class="no-margins" id="date">0</h1>
					<span><i class=" fa fa-hand-o-right" style="font-size:25px; color:yellow"></i> Date</span>
				</div>
			</div>
		</div>
		</div>
		



	<div class="row">
		<div class="col-lg-12">
			<div class="ibox-content">
				<div id="issuedtrendbymonth"></div>
			</div>
		</div>
	</div>	

	@endif











				@if(Auth::user()->userrole =='Student')



				<div class="row">
					<div class="col-lg-6 col-md-6">
						<div class="ibox ">
							<div class="ibox-content bg-primary">
								<h1 class="no-margins" id="hallname">0</h1>
								<span class="no-margins"><i class="fa fa-home" style="font-size:25px;"></i> Hall Name</span>
							</div>
						</div>
					</div>
				


        
					<div class="col-lg-6 col-md-6">
						<div class="ibox ">
							<div class="ibox-content bg-success">
								<h1 class="no-margins" id="totalroomofthestudent">0</h1>
								<span class="no-margins"><i class="fa fa-hotel" style="font-size:25px;"></i> Room Number of the Student</span>
							</div>
						</div>
					</div>
				
                </div>







				<div class="row">
					<div class="col-lg-4 col-md-4">
						<div class="ibox ">
							<div class="ibox-content bg-info">
								<h1 class="no-margins" id="totalcurrenstudenttofthehall">0</h1>
								<span class="no-margins"><i class="fa fa-users" style="font-size:25px; color:yellow"></i> Total Current Student</span>
							</div>
						</div>
					</div>
					<div class="col-lg-8 col-md-8">
						<div class="ibox ">
							<div class="ibox-content bg-secondary">
                  
                            <h1 class="no-margins" id="totalemployeeofthehall"> 0</h1>
                            
								<span class="no-margins"> <i class="fa fa-users" style="font-size:25px;color:yellow "></i>  Total Employee</span>
                               


							</div>
						</div>
					</div>
					</div>
			
		
			
 

				<div class="row">
					<div class="col-lg-12">
						<div class="ibox-content">
							<div id="issuedtrendbymonth"></div>
						</div>
					</div>
				</div>	

				@endif





				@endif


<br>
<br>





			</div>







		</section>




















<!---
  
    <section class="bg-section ysuccess pt-10 pb-10" data-black-overlay="8" style="background-image: url({{ asset('public/images/background/bg-2.jpg') }})">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-12 align-right">
                     @if (Route::has('login'))
                        <div class="top-right links">
                            @auth
                                <span>Hi, {{ Auth::user()->name }}</span>
                                <a class="btn btn-primary mb-0" href="{{ url('logout') }}"><i class="fa fa-lock"></i> {{ __('Logout') }}</a>
                            @else
                                <a class="btn btn-primary mb-0" href="{{ route('login') }}"><i class="fa fa-unlock"></i> {{ __('Login') }}</a>

                                @if (Route::has('register'))
                                    <a class="btn btn-success mb-0" href="{{ route('register') }}"><i class="fa fa-user-plus"></i> {{ __('Register') }}</a>
                                @endif
                            @endauth
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
  
-->
    @endsection

	@section('extralibincludefooter')
   <!-- Highchart -->
	<script src="{{ asset('public/js/highcharts.js') }}" crossorigin="anonymous"></script>
	<script src="{{ asset('public/js/exporting.js') }}" crossorigin="anonymous"></script>
@endsection




    @section('customjs')

<script>

let today = new Date().toISOString().slice(0, 10);



var amount;
var rowcount;
var  tablemain;
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


//highchart


function dashborard(){


	$.ajax({
	type: "post",
	url: SITEURL+"/dashborard",
	data: {
		"id":1,
		"_token":$('meta[name="csrf-token"]').attr('content')
	},
	success:function(response){
$("#totalstudent").html(response.totalstudent);
$("#totalhall").html(response.totalhall);
$("#totalroom").html(response.totalroom);
$("#totalemployee").html(response.totalemployee);

//

$("#hallname").html(response.hallname);
$("#totalroomofthestudent").html(response.totalstudenthallroom);
$("#totalcurrenstudenttofthehall").html(response.totalcurrentstudeninthishall);
$("#totalemployeeofthehall").html(response.totalemployeeinthishall);





$("#totalhallemp").html(response.hallnamecount);
$("#totalroomemp").html(response.totalroomemp);
$("#totalstudentemp").html(response.totalstudentemp);
$("#totalemployeeemp").html(response.totalemployeeinthishallemp);





	}

	});

}







function getIssuedTrendData(){


$.ajax({
	type: "post",
	url: SITEURL+"/highchart",
	data: {
		"id":1,
		"_token":$('meta[name="csrf-token"]').attr('content')
	},
	success:function(response){


		$("#issuedtrendbymonth").highcharts({
		chart: {
				type: "bar",
				animation: Highcharts.svg,
				height:350
			},
		title: {
			text: "Payment by Year-Month"
		},
		// subtitle: {
			// text: $("#StartDate").val()+" to "+$("#EndDate").val()+" and Accounts Head: "+$('#CarId').find(":selected").text()
		// },
		yAxis: {
			//gridLineWidth: 0,
			title: {
				text: 'Number of Students'
			}
		},
		xAxis: {
			// categories: ["1 Aug 18", "2 Aug 18", "3 Aug 18", "4 Aug 18", "5 Aug 18", "6 Aug 18", "7 Aug 18", "8 Aug 18"]
			categories: response.category
			,labels: {
						 //enabled:false,//default is true
						 y : 20, rotation: -45, align: 'right' 
					}
		},
		legend: {
			layout: 'horizontal'
		},
		credits: {
				enabled: false
			},
		exporting: {
				filename: "Payment_by_Year_Month"
			},
		tooltip: {
			shared: true,
			crosshairs: true
		},
		plotOptions: {
			series: {
				label: {
					connectorAllowed: false
				},
				marker: {
					//fillColor: '#FFFFFF',
					lineWidth: 1//,
					//lineColor: null // inherit from series
				}
			}
		},
		series: response.series
		




	});


	},
	error:function(error){
		setTimeout(function() {
			toastr.options = {
				closeButton: true,
				progressBar: true,
				showMethod: 'slideDown',
				timeOut: 4000
			};
		toastr.error("Can not fillup");

		}, 1300);

	}

});


}














$(document).ready(function(){

    getMyNewPostCount();

	getIssuedTrendData();


	dashborard();



$('#date').html(today);




});



</script>


<style>
.ibox {
	clear: both;
	margin-bottom: 25px;
	margin-top: 0;
	padding: 0;
	background-color: red;

}

.ibox-content {
	clear: both;
}
.ibox-content {
	
	color: white;
	padding: 15px 20px 20px 20px;
	border-color: #e7eaec;
	border-image: none;
	border-style: solid solid none;
	border-width: 1px 0;
	text-align: center;
}

.ibox-content h1{
	color: white;
}
		
.font-white {
    color: white !important;
}

</style>







    @endsection




