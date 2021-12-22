@extends('hmsindexlayout')

@section('content')
<br>

<div id="p"></div>


<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">


<div id="p"></div>

            <div class="card" id="register" style="">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" id="formregister" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}"     data-parsley-type="email" data-parsley-trigger="keyup"           required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>



                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Phone Number') }}</label>

                            <div class="col-md-6">
                                <input id="phone" type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" required  data-parsley-length="[11, 11]" data-parsley-trigger="keyup"   autocomplete="phone">

                                @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="gender" class="col-md-4 col-form-label text-md-right">{{ __('Gender') }}</label>

                            <div class="col-md-6 p-2">
                            &nbsp; <input type="radio" name="gender" value="male" required> Male <input type="radio" name="gender" value="female"> Female
							<input type="radio" name="gender" value="other"> Other 
                            
                            </div>
                        </div>

                    
                                

                   

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Student ID') }}</label>

                            <div class="col-md-6">
                                
                                <input id="studentid" type="text"  class="form-control" name="studentid" required   autocomplete="off">

                               <div class="div">
                               <span id="error"  style="color:red; padding-left:0px"></span>


                               </div> 

                            </div>
                        </div>
                   
                   
                   

           





                        <div class="form-group row" style="display:none">
                            <label for="usercode" class="col-md-4 col-form-label text-md-right">{{ __('Student ID') }}</label>

                            <div class="col-md-6">
                                <input id="usercode" type="text"  class="form-control" name="usercode"  required autocomplete="off">

                            </div>
                        </div>
<!---userrole and status column will be auto create from the input and it has set default value -->

                        <input id="userrole" type="hidden" class="form-control" name="userrole" value="Student" required autocomplete="studentid">
                        <input id="status" type="hidden" class="form-control" name="status" value="Active" required autocomplete="status">
                        


                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"  name="password" required   data-parsley-length="[8, 16]" data-parsley-trigger="keyup"  autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation"   data-parsley-equalto="#password"  data-parsley-trigger="keyup"   required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" id="registersubmit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
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



@section('customindexjs')

<script>
var SITEURL = '{{URL::to('')}}';



function past(){


    $( "#studentid" ).keyup(function() {
        var studentid = $( this ).val();
    
       


    if(studentid.length >3)
        {
        $('#error').html("Type valid id to register *");
        }
else{

    $('#error').html("");
    
}

//

$.ajax({
				url: SITEURL +"/verifiId",
				type:"POST",
			
				data: {
                    "studentid":studentid,
              
                    "_token":$('meta[name="csrf-token"]').attr('content')

	
				},
				
			  
			
				success:function(data)
				{
			    
                if(data=="verified")
                {
                
                $('#usercode').val(studentid);
                $('#error').html("");
			 
	
                  }

                 else if(data=="exist")
                {
                
                
                $('#error').html("This id already taken");
			 
	
                  }

                  
           else{
                           
            //$('#usercode').val(" ");

            $('#usercode').val("");
            
         
            
               

            }


            }

    });




















$('#password').click(function(){

    var studentid = $("#studentid").val();
           

    $.ajax({
				url: SITEURL +"/verifiId",
				type:"POST",
			
				data: {
                    "studentid":studentid,
              
                    "_token":$('meta[name="csrf-token"]').attr('content')

	
				},
				
			  
			
				success:function(data)
				{
			    
                if(data=="verified")
                {
                
                $('#usercode').val(studentid);
                $('#error').html("");
			 
	
                  }

                 else if(data=="exist")
                {
                
                
                $('#error').html("This id already taken");
			 
	
                  }

                  
           else{
                           
            //$('#usercode').val(" ");

            $('#usercode').val("");
            
         
            
               

            }


            }

    });





            

});

//




$('#studentid').click(function(){

var studentid = $("#studentid").val();
       

$.ajax({
            url: SITEURL +"/verifiId",
            type:"POST",
        
            data: {
                "studentid":studentid,
          
                "_token":$('meta[name="csrf-token"]').attr('content')


            },
            
          
        
            success:function(data)
            {
            
            if(data=="verified")
            {
            
            $('#usercode').val(studentid);
            $('#error').html("");
         

              }

             else if(data=="exist")
            {
            
            
            $('#error').html("This id already taken");
         

              }

              
       else{
                       
        //$('#usercode').val(" ");

        $('#usercode').val("");
        
     
        
           

        }


        }

});



});










//




$('#studentid').mouseenter(function(){

var studentid = $("#studentid").val();
       

$.ajax({
            url: SITEURL +"/verifiId",
            type:"POST",
        
            data: {
                "studentid":studentid,
          
                "_token":$('meta[name="csrf-token"]').attr('content')


            },
            
          
        
            success:function(data)
            {
            
            if(data=="verified")
            {
            
            $('#usercode').val(studentid);
            $('#error').html("");
         

              }

             else if(data=="exist")
            {
            
            
            $('#error').html("This id already taken");
         

              }

              
       else{
                       
        //$('#usercode').val(" ");

        $('#usercode').val("");
        
     
        
           

        }


        }

});



});







//




//






$('#studentid').mouseleave(function(){

var studentid = $("#studentid").val();
       

$.ajax({
            url: SITEURL +"/verifiId",
            type:"POST",
        
            data: {
                "studentid":studentid,
          
                "_token":$('meta[name="csrf-token"]').attr('content')


            },
            
          
        
            success:function(data)
            {
            
            if(data=="verified")
            {
            
            $('#usercode').val(studentid);
            $('#error').html("");
         

              }

             else if(data=="exist")
            {
            
            
            $('#error').html("This id already taken");
         

              }

              
       else{
                       
        //$('#usercode').val(" ");

        $('#usercode').val("");
        
     
        
           

        }


        }

});



});










//

$('#registersubmit').hover(function(){

var studentid = $("#studentid").val();
       

$.ajax({
            url: SITEURL +"/verifiId",
            type:"POST",
        
            data: {
                "studentid":studentid,
          
                "_token":$('meta[name="csrf-token"]').attr('content')


            },
            
          
        
            success:function(data)
            {
            
            if(data=="verified")
            {
            
            $('#usercode').val(studentid);
            $('#error').html("");
         

              }

             else if(data=="exist")
            {
            
            
           // $('#error').html("This id already taken");
         

              }

              
       else{
                       
        //$('#usercode').val(" ");

        $('#usercode').val("");
        
     
        
           

        }


        }

});



});


        










	


}).keyup();





}



$(document).ready(function(){

    past();


    $('#formregister').parsley();

        
		
		
});











</script>


@endsection