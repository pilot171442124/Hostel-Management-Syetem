<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>{{ config('app.name') }} - @yield('titlename')</title>
    <meta name="description" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <link href="{{ asset('public/css/bootstrap.css') }}" rel="stylesheet">
    <link href="{{ asset('public/font-awesome/css/font-awesome.css') }}" rel="stylesheet">

    <!-- Toastr style -->
    <link href="{{ asset('public/css/plugins/toastr/toastr.min.css') }}" rel="stylesheet"> 

    <!-- Sweet Alert -->
    <link href="{{ asset('public/css/plugins/sweetalert/sweetalert.css') }}" rel="stylesheet"> 



    <link href="{{ asset('public/css/animate.css') }}" rel="stylesheet"> 
    <link href="{{ asset('public/css/style.css') }}" rel="stylesheet"> 
    <link href="{{ asset('public/css/formdesign.css') }}" rel="stylesheet"> 

    <link href="{{ asset('public/css/jquery-confirm.css') }}" rel="stylesheet"> 
    <!-- dataTable -->
    <link href="{{ asset('public/css/plugins/dataTable/dataTables.bootstrap4.min.css') }}" rel="stylesheet"> 
    <link href="{{ asset('public/css/plugins/chosen/bootstrap-chosen.css') }}" rel="stylesheet"> 

    <!-- Chosen -->

    <link href="{{ asset('public/css/plugins/chosen/bootstrap-chosen.css') }}" rel="stylesheet"> 
    <link rel="icon" type="img/ico" href="{{ asset('public/images/fav.png') }}">

    <!-- Chosen -->
    <link href="{{ asset('public/css/plugins/datapicker/datepicker3.css') }}" rel="stylesheet"> 



    
    <link href="{{ asset('public/css/plugins/daterangepicker/daterangepicker-bs3.css') }}" rel="stylesheet"> 
    
    <link href="{{ asset('public/css/updateanimate.css') }}" rel="stylesheet"> 


    <link href="{{ asset('public/css/jquery-ui.css') }}" rel="stylesheet"> 

    

   

    <!--<link href="{{ asset('public/css/jquery.datetimepicker.css') }}" rel="stylesheet">  -->
 

</head>

<body class="pace-done fixed-nav fixed-sidebar">
   
    <div id="wrapper">
        
        <!-- header -->
        @include('navigationleft')
        <!-- /header -->

      


        <div id="page-wrapper" class="gray-bg">
            <div class="row border-bottom">
            <div class="col-lg-12 ">

                <nav class="navbar navbar-fixed-top " role="navigation" style="margin-top:0px;">
                    <div class="navbar-header">
                        <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
                    </div>
   

                                    
                    <div>   

                    <i  style="font-size:40px; float:left"class="fa fa-graduation-cap"> </i>

                    <span style=" font-size:20px; text-align:left">&nbsp;Hostel Management </span>
                  

                    </div>






                        <a href="{{ url('dashboard') }}">
                           
                           
                        <div class="sitetitleinnersite m-r-sm text-muted welcome-message"></div>
                      
                    
                    
                    </a>
                   
                    <ul class="nav navbar-top-links navbar-right" id="navbarSupportedContent" >

                    
                  
                    
                    
                    <li>                  
                            <a class="notification-ico" href="{{ url('checknotificationview') }}"><i class="fa fa-bell"></i> <sup><span id="notificationcount"></span></sup></a>
                    
                    </li>
                        <li>
                            <span class="m-r-sm text-muted ">Hi <a href="{{ url('profile') }}"><u>{{ Auth::user()->name }}</u> </a>
                       
                      <img src="images/{{Auth::user()->image}}" height="20px" width="20px" style="border-radius: 50%;" talt="logo" />
                       
                        </li>
                

                    
                
             
                        <li>
                            <a href="{{ url('logout') }}">
                                <i class="fa fa-sign-out"></i> Log out
                            </a>
                        </li>
                  
                    </ul>
                
                    
                            
                </nav>
            </div>
       
            </div>
           
          <br>
          <br>




            <main>
                @yield('maincontent')
            </main>



<br>
<br>
<br>


            <div class="footer">
                <div class="float-right">
                    <small>© 2021</small>
                </div>
                <div>
                    <a href="{{ url('dashboard') }}">Hostel Management System</a>
                </div>

                <!-- Mainly scripts -->


                <script src="{{ asset('public/js/jquery-1.8.3.min.js') }}" crossorigin="anonymous"></script>


               

                <script src="{{ asset('public/js/jquery-3.3.1.js') }}" crossorigin="anonymous"></script>

                <!-- dataTables -->
                <script src="{{ asset('public/js/jquery.dataTables2.min.js') }}" crossorigin="anonymous"></script>

                <script src="{{ asset('public/js/dataTables.bootstrap-4.min.js') }}" crossorigin="anonymous"></script>
                

               
          <!-- <script src="{{ asset('public/js/plugins/dataTable/jquery.dataTables.min.js') }}" crossorigin="anonymous"></script>
                <script src="{{ asset('public/js/plugins/dataTable/dataTables.bootstrap4.min.js') }}" crossorigin="anonymous"></script>
             -->
                <!-- bootstrap -->
                <script src="{{ asset('public/js/popper.min.js') }}" crossorigin="anonymous"></script>
                <script src="{{ asset('public/js/bootstrap.js') }}" crossorigin="anonymous"></script>
                <script src="{{ asset('public/js/plugins/metisMenu/jquery.metisMenu.js') }}" crossorigin="anonymous"></script>
                <script src="{{ asset('public/js/plugins/slimscroll/jquery.slimscroll.min.js') }}" crossorigin="anonymous"></script>

                <!-- Custom and plugin javascript -->
                <script src="{{ asset('public/js/inspinia.js') }}" crossorigin="anonymous"></script>
                <script src="{{ asset('public/js/plugins/pace/pace.min.js') }}" crossorigin="anonymous"></script>

                <!-- Chosen -->
                <script src="{{ asset('public/js/plugins/chosen/chosen.jquery.js') }}" crossorigin="anonymous"></script>

                <!-- Highchart  -->
            
                <!-- Sweet alert -->
                <script src="{{ asset('public/js/plugins/sweetalert/sweetalert.min.js') }}" crossorigin="anonymous"></script>

                <!-- Toastr -->
                <script src="{{ asset('public/js/plugins/toastr/toastr.min.js') }}" crossorigin="anonymous"></script>

                <!-- Data picker -->
                <script src="{{ asset('public/js/plugins/datapicker/bootstrap-datepicker.js') }}" crossorigin="anonymous"></script>
                <!-- Date range picker -->
                <script src="{{ asset('public/js/plugins/daterangepicker/daterangepicker.js') }}" crossorigin="anonymous"></script>

                <script src="{{ asset('public/js/jQuery.print.min.js') }}" crossorigin="anonymous"></script>



                

                <!-- confirm message -->
        <script src="{{ asset('public/js/jquery-confirm.js') }}" crossorigin="anonymous"></script>
                <!--validation--> 
                 <!-- <script src="{{ asset('public/js/parsley.min.js') }}" crossorigin="anonymous"></script> -->

                 <script src="{{ asset('public/js/parsley.js') }}" crossorigin="anonymous"></script>



                <script src="http://parsleyjs.org/dist/parsley.js"> </script>
                
               <!-- button for export-->

               <script src="https://cdn.datatables.net/buttons/1.6.4/js/dataTables.buttons.min.js"></script>
               <script src="https://cdn.datatables.net/buttons/1.6.4/js/buttons.print.min.js"></script>
                <script src="http://parsleyjs.org/dist/parsley.js"></script>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>


                <script src="https://cdn.datatables.net/buttons/1.6.4/js/buttons.html5.min.js"></script>
                
                
                
             
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
           
                    
   
                
                
                
                
                
                <!--<script src="{{ asset('public/js/jquery.datetimepicker.js') }}" crossorigin="anonymous"></script>--> 
                
                <!-- bkahs support jquery-->
                
                <script id = "myScript" src="https://scripts.sandbox.bka.sh/versions/1.2.0-beta/checkout/bKash-checkout-sandbox.js"></script>
                <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
 
              
                
                @yield('extralibincludefooter')

            </div>


        </div>
    </div>

    @yield('customjs')


   




</body>
</html>