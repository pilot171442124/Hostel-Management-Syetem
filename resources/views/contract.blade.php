@extends('hmsindexlayout')


@section('content')
	



<section class="bg-section ysuccess pt-10 pb-10" data-black-overlay="8" style="background-image: url({{ asset('public/images/background/bg-2.jpg') }})">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-12 align-right">
                   
                        <div class="top-right links">
                    

						
          
						@if(Auth::check())			


					
                            <a class="btn btn-primary mb-0" href="{{ url('home') }}">
                                Dashboard
                            </a>
                      

                            <a class="btn btn-primary mb-0" href="{{ url('logout') }}">
                                <i class="fa fa-sign-out  "></i> Log out
                            </a>
                      


                               
					               
                      @else

                                <a class="btn btn-primary mb-0" href="{{ route('login') }}"><i class="fa fa-unlock"></i> {{ __('Login') }}</a>

                               
                                    <a class="btn btn-success mb-0" href="{{ route('register') }}"><i class="fa fa-user-plus"></i> {{ __('Register') }}</a>
							@endif


                        </div>
                  
                </div>
            </div>
        </div>
    </section>





		<!-- Section -->
	
		<!-- /Section -->	

		<!-- Contact info Section -->
		<section class="contact style-1">
			<div class="container " >
				<div class="row">

					<div class="col-lg-4" style="background: rgba(120, 140, 107, 0.9)">
						<div class="contact-address">
							<h2>Contact Info</h2>
							<ul class="contact-info">
								<li>
									<span class="con-icon">
										<i class="fa fa-map-marker"></i>
									</span>
									<div class="con-desc">
										House/Holding No-A/66, Word No-06<br>Bank Colony,Savar,Dhaka
									</div>
								</li>
								<li>
									<span class="con-icon">
										<i class="fa fa-envelope-o"></i>
									</span>
									<div class="con-desc">
                                    nhsojib@gmail.com jakirkhan30996@gmail.com
									</div>
								</li>
								<li>
									<span class="con-icon">
										<i class="fa fa-phone"></i>
									</span>
									<div class="con-desc">
										01689xxxxxx
									</div>
								</li>
								
							</ul>
						</div>
					</div>
					<div class="col-lg-8">
						<!-- Google Map Section -->
						<div id="map" class="google-map"></div>
						<!-- /Google Map Section -->
					</div>



				</div>
			</div>
		</section>
		<!-- /Contact info Section -->


		
 @endsection

@section('extralibincludefooter')
   <!-- Highchart -->
	<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD7tvmKDI1rNPxCezId3lorKS5n4fI7oOM&callback=initMap"></script>
@endsection


@section('customindexjs')
	
<script>

	function initMap() {
		//var latlng = {lat: Your Latitude, lng: Your Longitude};
		var latlng = {lat: 23.844599, lng: 90.253627};
		var map = new google.maps.Map(document.getElementById('map'), {
			zoom: 12,
			center: latlng,
			zoomControl: true,
			scaleControl: false,
			scrollwheel: false,
			disableDoubleClickZoom: true
		});
		//Tooltip info
		var contentString = '<div class="map-tooltip">'+
				'<div class="map-tooltip-content">'+
					'<ul class="map-tooltip-info">'+
						'<li>'+
								'<h2>Office Loaction</h2>'+
								'House/Holding No-A/66,<br>'+
								'Savar,Dhaka</p>'+
						'</li>'+
					'</ul>'+
				'</div>' +
		'</div>';
		var infowindow = new google.maps.InfoWindow({
		  content: contentString
		});
		var marker = new google.maps.Marker({
		  position: latlng,
		  map: map
		});
		marker.addListener('click', function() {
		  infowindow.open(map, marker);
		});
	}

     
</script>
@endsection