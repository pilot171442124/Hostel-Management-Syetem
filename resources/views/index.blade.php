@extends('hmsindexlayout')
@section('content')

    <!-- Section authentication -->
    
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

    <!-- /Section authentication-->   

    <!-- Slider Section -->
    <div class="slider-section">
        <div class="single-slider slider-screen" data-black-overlay="5" style="background-image:url({{ asset('public/images/hostel.jpg') }});">
            <div id="particles-js"></div>
            <div class="container">
                <div class="slider-content style-1">
                    <p>Welcome to Online</p>
                    <h2>Hostel Management System</h2>
                    <!--<a class="btn blue-btn" href="#">Read More About Us</a>-->
                </div>
            </div>
        </div>
    </div>
    <!-- /Slider Section -->
    <!-- Featured Section -->
    <br>
    <br>
    <br>

    <section class="featured-area style-1">
        <div class="container">
            <div class="row no-gutters">
                <div class="col-lg-4 col-md-4">
                    <div class="featured-item">
                        <i class="fa fa-user-o" aria-hidden="true"></i>
                        <h3>Admin</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                    </div>
                </div>

                <div class="col-lg-4 col-md-4">
                    <div class="featured-item active">
                        <i class="fa fa-group" aria-hidden="true"></i>
                        <h3 class="active">Employee</h3>
                        <p class="active">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                    </div>
                </div>

                <div class="col-lg-4 col-md-4">
                    <div class="featured-item">
                        <i class="fa fa-group" aria-hidden="true"></i>
                        <h3>Student</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                    </div>
                </div>

             
            </div>
        </div>
    </section>
    <!-- /Featured Section -->

    <!-- About Us Section -->
    <section class="about-area pt-50 pb-90">
        <div class="container">
            <div class="row text-center">
                <div class="col">
                    <div class="section-heading mb-70">
                        <h2>About Us</h2>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit</p>
                    </div>
                </div>
            </div>
            

                </div>
                
            </div>
        </div>
    </section>
    <!-- /About Us Section -->

@endsection


@section('customindexjs')

<!-- particles js -->
<script src="{{ asset('public/js/particles.min.js') }}" crossorigin="anonymous"></script>
<script src="{{ asset('public/js/app.js') }}" crossorigin="anonymous"></script>

<style>

.font-white {
    color: white !important;
}
</style>
@endsection