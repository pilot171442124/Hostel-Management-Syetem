@extends('hmslayout')







@section('maincontent')





        <div class="row" id="card" style="">
						<div class="col-lg-12">
							<div class="card">
    
							<div class="card-header bg-info p-3"> <button class="btn btn-primary"><i class="fa fa-bars" style="font-size:15px; color:black">&nbsp;{{ __('Add Room Payment') }}</i> </button> 
                            
                            
   
                            
                            
                            </div>
								<div class="card-body bg-success">
                                <a class=" btn btn-warning pull-right" href="{{ url('roompayment') }}"id="canncel">Cancel</a>

                                @foreach($view as $row)
                               
                                <p id="amount" style="display:none">{{ $row->amount }}</p>
                                <p id="invoice" style="display:none">{{ $row->invoic_no }}</p>
                               
                             

                               <br><p>Room No: <span id="roomno"> {{$row->room_no}}</span></p> 

                               <p id="invoice" class="text-center " style="font-size:20px; color:black">Invoice-No: <i><b>{{ $row->invoic_no }}</b></i></p>




                               <br><p>Program: <span id="program"> {{$row->program}}</span></p>
                               <br><p>Batch: <span id="batch"> {{$row->batchno}}</span></p>
                               <br><p>Amount: <span id="batch"> {{$row->amount}}</span></p>
                              
                               
                               <br><p>Mont and Year: <span id="m_and_y">{{$row->month}} </span></p>
                            
                               @endforeach
                         
                               
                               
                         <button class=" btn btn-primary pull-right"id="bKash_button">Pay With bKash</button>
                               @csrf
                   <br>
                   <br>
                   <br>


                                </div>
                               

					</div>
				</div>
		</div>



       

        



@endsection

@section('customjs')





<script>
var accessToken='';
//var tablemain;

var SITEURL = '{{URL::to('')}}';

var tablemain;
var SITEURL = '{{URL::to('')}}';
var amount;


console.log(amount);
function activemenu(){

//active menu
$( ".StudentManagement-menu" ).addClass( "active" );
		$( ".StudentManagement-menu ul" ).addClass( "in" );
		$( ".StudentManagement-menu ul" ).attr("aria-expanded", "true");
		$( ".roompayment-menu" ).addClass( "active" );


}


function showpayment(){

//active menu
$( "#tableMain" ).hide();
$( "#card" ).show();


}





$(document).ready(function(){
       
       
    $.ajaxSetup({
headers: {
   'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
}
});
       
       
       
       
       
       
        $.ajax({
            url: "{!! route('token') !!}",
        
            type: 'POST',
            contentType: 'application/json',
            success: function (data) {
                console.log('got data from token  ..');
				console.log(JSON.stringify(data));
				
                accessToken=JSON.stringify(data);
            },
			error: function(){
						console.log('error');
                        
            }

    
        });

             
        var paymentConfig={
            createCheckoutURL: "{!! route('createpayment') !!}",
            executeCheckoutURL: "{!! route('executepayment') !!}"
        };

		
        var paymentRequest;
        
        paymentRequest = {amount: $('#amount').text(), intent: 'sale', invoice:$('#invoice').text()};
        
        //paymentRequest = { amount:'105',intent:'sale'};
		console.log(JSON.stringify(paymentRequest));



        bKash.init({
            paymentMode: 'checkout',
            paymentRequest: paymentRequest,
            createRequest: function(request){
                console.log('=> createRequest (request) :: ');
                console.log(request);
                
                $.ajax({
                   
                   
                    url: paymentConfig.createCheckoutURL + "?amount=" + paymentRequest.amount + "&invoice=" + paymentRequest.invoice,
                   
                    //url: paymentConfig.createCheckoutURL+"?amount="+paymentRequest.amount,
                    type:'GET',
                    contentType: 'application/json',
                    success: function(data) {
                        console.log('got data from create  ..');
                        console.log('data ::=>');
                        console.log(JSON.stringify(data));
                        
                        var obj = JSON.parse(data);
                        
                        if(data && obj.paymentID != null){
                            paymentID = obj.paymentID;
                            bKash.create().onSuccess(obj);
                        }
                        else {
							console.log('error');
                            bKash.create().onError();
                        }
                    },
                    error: function(){
						console.log('error');
                        bKash.create().onError();
                    }
                });
            },
            
            executeRequestOnAuthorization: function(){
                console.log('=> executeRequestOnAuthorization');
                $.ajax({
                    url: paymentConfig.executeCheckoutURL+"?paymentID="+paymentID,
                    type: 'GET',
                    contentType:'application/json',
                    success: function(data){
                        console.log('got data from execute  ..');
                        console.log('data ::=>');
                        console.log(JSON.stringify(data));
                        
                        data = JSON.parse(data);
                        if(data && data.paymentID != null){
                            alert('[SUCCESS] data : ' + JSON.stringify(data));
                            window.location.href = "success.html";                              
                        }
                        else {
                            bKash.execute().onError();
                        }
                    },
                    error: function(){
                        bKash.execute().onError();
                    }
                });
            }
        });
        
		console.log("Right after init ");



//get payment list data from studentpayment table





activemenu();











        
    });















function callReconfigure(val){
        bKash.reconfigure(val);
    }

    function clickPayButton(){
        $("#bKash_button").trigger('click');
    }




</script>


@endsection
