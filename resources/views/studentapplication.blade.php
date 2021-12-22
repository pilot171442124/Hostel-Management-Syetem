@extends('hmslayout')


@section('maincontent')

<div id="p"></div>


<div id="formpanel" class="panel panel-default " style="">
	
<div class="container">
      
<br>
       <center>                      
        <div id="profileimage">
       
        </div>
       <b id="pname"style="font-size:15px"></b>
        <br>
        <b style="font-size:20px">Fill Out the Application Form</b>
        </center> 
        
        <br>
         	
         	
            <div class="row">
                
            <div class="col-lg-12">

                    <div class="card"> 
                 
                        <div class="card-body">
                        
                         

                            <form  id="studentapplication" method="POST">
                            @csrf
                          


                                    @if(Auth::check())
                                    @if(Auth::user()->userrole =='Admin'|| Auth::user()->userrole =='Employee')
          

                                    <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Student ID<span class="red">*</span></label>													
                                            <select data-placeholder="Choose Student ID..." class="chosen-select" id="studentid" name="studentid" >
                                               
                                                <option value="">Select the Student ID</option>

                                                @foreach($data as $row)
                                            
                                                <option value="{{ $row->id }}">{{ $row->usercode}}</option>
                                                

                                                @endforeach

                                                <!--<option value="Other">Other</option>-->
                                            </select>
                                        </div>											
                                    </div>
                                    </div>

                                    @endif








                       @if(Auth::user()->userrole =='Student')


                       <div class="row">
                                    <div class="col-md-6" >
                                        <div class="form-group" style="display:none">
                                            <label> ID Number<span class="red">*</span></label>
                                            <input type="text" class="form-control "  value="{{ Auth::user()->id}}" name="studentid" id="studetntidnumber" data-parsley-type="number" required placeholder="Enter Phone Number">
                                        </div>
                                    </div>
                                    </div>



                    @endif
                        
                    @endif



                           



                                    <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Student Name<span class="red">*</span></label>
                                            <input type="text" class="form-control "  name="studentname" id="studentname" required  data-parsley-trigger="keyup" placeholder="Enter Employee Type" >
                                        </div>
                                    </div>

                                    </div>

                                    
                                   

                                    <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
													<label>E-mail <span class="red">*</span></label>
													<input type="text" class="form-control " name="email" id="email" required data-parsley-type="email" data-parsley-trigger="keyup" placeholder="Enter Student E-mail">
												
                                        </div>
                                    </div>
                                    </div>


                                   


                                    <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Phone Number<span class="red">*</span></label>
                                            <input type="text" class="form-control " name="Phone" id="Phone" data-parsley-type="number" required placeholder="Enter Phone Number">
                                        </div>
                                    </div>
                                    </div>


                                    <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Program<span class="red">*</span></label>
                                            <input type="text" class="form-control "  name="Program" id="Program" required  data-parsley-trigger="keyup" placeholder="Enter Program" >
                                        </div>
                                    </div>
                                    </div>






                                    <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Batch No.<span class="red">*</span></label>
                                            <input type="text" class="form-control "  name="batchno" id="batchno" required  data-parsley-trigger="keyup" placeholder="Enter Batch No............" >
                                        </div>
                                    </div>
                                    </div>




                                    

                                    <div class="row">
											<div class="col-md-4">
												<div class="form-group">
													<label>Gender<span class="red">*</span></label>
													<br>
                                                    <input type="radio" name="gender" id="male"  value="male" required> Male <input type="radio" name="gender" id="female" value="female"> Female
													<input type="radio" name="gender" id="other" value="other"> Other
												
												</div>
											</div>
											</div>

                                <!--

                                            <div class="row">
											<div class="col-md-4">
												<div class="form-group">
													<label>Gender<span class="red">*</span></label>
													<br>
                                                    <input type="text" name="gender" id="gender"> 
													
												
												</div>
											</div>
											</div>
                                            -->










                                            <div class="row">
											<div class="col-md-6">
												<div class="form-group">
													<label>Date of Birth<span class="red">*</span></label>
													<input type="date" class="form-control " name="dob" id="dob"  data-parsley-trigger="keyup" data-parsley-type="date" required >
												</div>
											</div>
											</div>



                                            <div class="row">
                                                <div class="col-md-6">
                                                 <div class="form-group">
                                                      <label>Blood Group<span class="red">*</span></label>
                                                     <input type="text" class="form-control "  name="bldgrp" id="bldgrp" required  data-parsley-trigger="keyup" placeholder="Enter Blood Group" >
                                                 </div>
                                            </div>
                                    </div>





                                    <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Nationality<span class="red">*</span></label>													
                                            <select data-placeholder="Choose the Country..." class="chosen-select" id="Nationality" name="Nationality" >
                                               
                                                <option value="">Select the Country</option>



                                    <option value="Afganistan">Afghanistan</option>
                                    <option value="Albania">Albania</option>
                                    <option value="Algeria">Algeria</option>
                                    <option value="American Samoa">American Samoa</option>
                                    <option value="Andorra">Andorra</option>
                                    <option value="Angola">Angola</option>
                                    <option value="Anguilla">Anguilla</option>
                                    <option value="Antigua & Barbuda">Antigua & Barbuda</option>
                                    <option value="Argentina">Argentina</option>
                                    <option value="Armenia">Armenia</option>
                                    <option value="Aruba">Aruba</option>
                                    <option value="Australia">Australia</option>
                                    <option value="Austria">Austria</option>
                                    <option value="Azerbaijan">Azerbaijan</option>
                                    <option value="Bahamas">Bahamas</option>
                                    <option value="Bahrain">Bahrain</option>
                                    <option value="Bangladesh">Bangladesh</option>
                                    <option value="Barbados">Barbados</option>
                                    <option value="Belarus">Belarus</option>
                                    <option value="Belgium">Belgium</option>
                                    <option value="Belize">Belize</option>
                                    <option value="Benin">Benin</option>
                                    <option value="Bermuda">Bermuda</option>
                                    <option value="Bhutan">Bhutan</option>
                                    <option value="Bolivia">Bolivia</option>
                                    <option value="Bonaire">Bonaire</option>
                                    <option value="Bosnia & Herzegovina">Bosnia & Herzegovina</option>
                                    <option value="Botswana">Botswana</option>
                                    <option value="Brazil">Brazil</option>
                                    <option value="British Indian Ocean Ter">British Indian Ocean Ter</option>
                                    <option value="Brunei">Brunei</option>
                                    <option value="Bulgaria">Bulgaria</option>
                                    <option value="Burkina Faso">Burkina Faso</option>
                                    <option value="Burundi">Burundi</option>
                                    <option value="Cambodia">Cambodia</option>
                                    <option value="Cameroon">Cameroon</option>
                                    <option value="Canada">Canada</option>
                                    <option value="Canary Islands">Canary Islands</option>
                                    <option value="Cape Verde">Cape Verde</option>
                                    <option value="Cayman Islands">Cayman Islands</option>
                                    <option value="Central African Republic">Central African Republic</option>
                                    <option value="Chad">Chad</option>
                                    <option value="Channel Islands">Channel Islands</option>
                                    <option value="Chile">Chile</option>
                                    <option value="China">China</option>
                                    <option value="Christmas Island">Christmas Island</option>
                                    <option value="Cocos Island">Cocos Island</option>
                                    <option value="Colombia">Colombia</option>
                                    <option value="Comoros">Comoros</option>
                                    <option value="Congo">Congo</option>
                                    <option value="Cook Islands">Cook Islands</option>
                                    <option value="Costa Rica">Costa Rica</option>
                                    <option value="Cote DIvoire">Cote DIvoire</option>
                                    <option value="Croatia">Croatia</option>
                                    <option value="Cuba">Cuba</option>
                                    <option value="Curaco">Curacao</option>
                                    <option value="Cyprus">Cyprus</option>
                                    <option value="Czech Republic">Czech Republic</option>
                                    <option value="Denmark">Denmark</option>
                                    <option value="Djibouti">Djibouti</option>
                                    <option value="Dominica">Dominica</option>
                                    <option value="Dominican Republic">Dominican Republic</option>
                                    <option value="East Timor">East Timor</option>
                                    <option value="Ecuador">Ecuador</option>
                                    <option value="Egypt">Egypt</option>
                                    <option value="El Salvador">El Salvador</option>
                                    <option value="Equatorial Guinea">Equatorial Guinea</option>
                                    <option value="Eritrea">Eritrea</option>
                                    <option value="Estonia">Estonia</option>
                                    <option value="Ethiopia">Ethiopia</option>
                                    <option value="Falkland Islands">Falkland Islands</option>
                                    <option value="Faroe Islands">Faroe Islands</option>
                                    <option value="Fiji">Fiji</option>
                                    <option value="Finland">Finland</option>
                                    <option value="France">France</option>
                                    <option value="French Guiana">French Guiana</option>
                                    <option value="French Polynesia">French Polynesia</option>
                                    <option value="French Southern Ter">French Southern Ter</option>
                                    <option value="Gabon">Gabon</option>
                                    <option value="Gambia">Gambia</option>
                                    <option value="Georgia">Georgia</option>
                                    <option value="Germany">Germany</option>
                                    <option value="Ghana">Ghana</option>
                                    <option value="Gibraltar">Gibraltar</option>
                                    <option value="Great Britain">Great Britain</option>
                                    <option value="Greece">Greece</option>
                                    <option value="Greenland">Greenland</option>
                                    <option value="Grenada">Grenada</option>
                                    <option value="Guadeloupe">Guadeloupe</option>
                                    <option value="Guam">Guam</option>
                                    <option value="Guatemala">Guatemala</option>
                                    <option value="Guinea">Guinea</option>
                                    <option value="Guyana">Guyana</option>
                                    <option value="Haiti">Haiti</option>
                                    <option value="Hawaii">Hawaii</option>
                                    <option value="Honduras">Honduras</option>
                                    <option value="Hong Kong">Hong Kong</option>
                                    <option value="Hungary">Hungary</option>
                                    <option value="Iceland">Iceland</option>
                                    <option value="Indonesia">Indonesia</option>
                                    <option value="India">India</option>
                                    <option value="Iran">Iran</option>
                                    <option value="Iraq">Iraq</option>
                                    <option value="Ireland">Ireland</option>
                                    <option value="Isle of Man">Isle of Man</option>
                                    <option value="Israel">Israel</option>
                                    <option value="Italy">Italy</option>
                                    <option value="Jamaica">Jamaica</option>
                                    <option value="Japan">Japan</option>
                                    <option value="Jordan">Jordan</option>
                                    <option value="Kazakhstan">Kazakhstan</option>
                                    <option value="Kenya">Kenya</option>
                                    <option value="Kiribati">Kiribati</option>
                                    <option value="Korea North">Korea North</option>
                                    <option value="Korea Sout">Korea South</option>
                                    <option value="Kuwait">Kuwait</option>
                                    <option value="Kyrgyzstan">Kyrgyzstan</option>
                                    <option value="Laos">Laos</option>
                                    <option value="Latvia">Latvia</option>
                                    <option value="Lebanon">Lebanon</option>
                                    <option value="Lesotho">Lesotho</option>
                                    <option value="Liberia">Liberia</option>
                                    <option value="Libya">Libya</option>
                                    <option value="Liechtenstein">Liechtenstein</option>
                                    <option value="Lithuania">Lithuania</option>
                                    <option value="Luxembourg">Luxembourg</option>
                                    <option value="Macau">Macau</option>
                                    <option value="Macedonia">Macedonia</option>
                                    <option value="Madagascar">Madagascar</option>
                                    <option value="Malaysia">Malaysia</option>
                                    <option value="Malawi">Malawi</option>
                                    <option value="Maldives">Maldives</option>
                                    <option value="Mali">Mali</option>
                                    <option value="Malta">Malta</option>
                                    <option value="Marshall Islands">Marshall Islands</option>
                                    <option value="Martinique">Martinique</option>
                                    <option value="Mauritania">Mauritania</option>
                                    <option value="Mauritius">Mauritius</option>
                                    <option value="Mayotte">Mayotte</option>
                                    <option value="Mexico">Mexico</option>
                                    <option value="Midway Islands">Midway Islands</option>
                                    <option value="Moldova">Moldova</option>
                                    <option value="Monaco">Monaco</option>
                                    <option value="Mongolia">Mongolia</option>
                                    <option value="Montserrat">Montserrat</option>
                                    <option value="Morocco">Morocco</option>
                                    <option value="Mozambique">Mozambique</option>
                                    <option value="Myanmar">Myanmar</option>
                                    <option value="Nambia">Nambia</option>
                                    <option value="Nauru">Nauru</option>
                                    <option value="Nepal">Nepal</option>
                                    <option value="Netherland Antilles">Netherland Antilles</option>
                                    <option value="Netherlands">Netherlands (Holland, Europe)</option>
                                    <option value="Nevis">Nevis</option>
                                    <option value="New Caledonia">New Caledonia</option>
                                    <option value="New Zealand">New Zealand</option>
                                    <option value="Nicaragua">Nicaragua</option>
                                    <option value="Niger">Niger</option>
                                    <option value="Nigeria">Nigeria</option>
                                    <option value="Niue">Niue</option>
                                    <option value="Norfolk Island">Norfolk Island</option>
                                    <option value="Norway">Norway</option>
                                    <option value="Oman">Oman</option>
                                    <option value="Pakistan">Pakistan</option>
                                    <option value="Palau Island">Palau Island</option>
                                    <option value="Palestine">Palestine</option>
                                    <option value="Panama">Panama</option>
                                    <option value="Papua New Guinea">Papua New Guinea</option>
                                    <option value="Paraguay">Paraguay</option>
                                    <option value="Peru">Peru</option>
                                    <option value="Phillipines">Philippines</option>
                                    <option value="Pitcairn Island">Pitcairn Island</option>
                                    <option value="Poland">Poland</option>
                                    <option value="Portugal">Portugal</option>
                                    <option value="Puerto Rico">Puerto Rico</option>
                                    <option value="Qatar">Qatar</option>
                                    <option value="Republic of Montenegro">Republic of Montenegro</option>
                                    <option value="Republic of Serbia">Republic of Serbia</option>
                                    <option value="Reunion">Reunion</option>
                                    <option value="Romania">Romania</option>
                                    <option value="Russia">Russia</option>
                                    <option value="Rwanda">Rwanda</option>
                                    <option value="St Barthelemy">St Barthelemy</option>
                                    <option value="St Eustatius">St Eustatius</option>
                                    <option value="St Helena">St Helena</option>
                                    <option value="St Kitts-Nevis">St Kitts-Nevis</option>
                                    <option value="St Lucia">St Lucia</option>
                                    <option value="St Maarten">St Maarten</option>
                                    <option value="St Pierre & Miquelon">St Pierre & Miquelon</option>
                                    <option value="St Vincent & Grenadines">St Vincent & Grenadines</option>
                                    <option value="Saipan">Saipan</option>
                                    <option value="Samoa">Samoa</option>
                                    <option value="Samoa American">Samoa American</option>
                                    <option value="San Marino">San Marino</option>
                                    <option value="Sao Tome & Principe">Sao Tome & Principe</option>
                                    <option value="Saudi Arabia">Saudi Arabia</option>
                                    <option value="Senegal">Senegal</option>
                                    <option value="Seychelles">Seychelles</option>
                                    <option value="Sierra Leone">Sierra Leone</option>
                                    <option value="Singapore">Singapore</option>
                                    <option value="Slovakia">Slovakia</option>
                                    <option value="Slovenia">Slovenia</option>
                                    <option value="Solomon Islands">Solomon Islands</option>
                                    <option value="Somalia">Somalia</option>
                                    <option value="South Africa">South Africa</option>
                                    <option value="Spain">Spain</option>
                                    <option value="Sri Lanka">Sri Lanka</option>
                                    <option value="Sudan">Sudan</option>
                                    <option value="Suriname">Suriname</option>
                                    <option value="Swaziland">Swaziland</option>
                                    <option value="Sweden">Sweden</option>
                                    <option value="Switzerland">Switzerland</option>
                                    <option value="Syria">Syria</option>
                                    <option value="Tahiti">Tahiti</option>
                                    <option value="Taiwan">Taiwan</option>
                                    <option value="Tajikistan">Tajikistan</option>
                                    <option value="Tanzania">Tanzania</option>
                                    <option value="Thailand">Thailand</option>
                                    <option value="Togo">Togo</option>
                                    <option value="Tokelau">Tokelau</option>
                                    <option value="Tonga">Tonga</option>
                                    <option value="Trinidad & Tobago">Trinidad & Tobago</option>
                                    <option value="Tunisia">Tunisia</option>
                                    <option value="Turkey">Turkey</option>
                                    <option value="Turkmenistan">Turkmenistan</option>
                                    <option value="Turks & Caicos Is">Turks & Caicos Is</option>
                                    <option value="Tuvalu">Tuvalu</option>
                                    <option value="Uganda">Uganda</option>
                                    <option value="United Kingdom">United Kingdom</option>
                                    <option value="Ukraine">Ukraine</option>
                                    <option value="United Arab Erimates">United Arab Emirates</option>
                                    <option value="United States of America">United States of America</option>
                                    <option value="Uraguay">Uruguay</option>
                                    <option value="Uzbekistan">Uzbekistan</option>
                                    <option value="Vanuatu">Vanuatu</option>
                                    <option value="Vatican City State">Vatican City State</option>
                                    <option value="Venezuela">Venezuela</option>
                                    <option value="Vietnam">Vietnam</option>
                                    <option value="Virgin Islands (Brit)">Virgin Islands (Brit)</option>
                                    <option value="Virgin Islands (USA)">Virgin Islands (USA)</option>
                                    <option value="Wake Island">Wake Island</option>
                                    <option value="Wallis & Futana Is">Wallis & Futana Is</option>
                                    <option value="Yemen">Yemen</option>
                                    <option value="Zaire">Zaire</option>
                                    <option value="Zambia">Zambia</option>
                                    <option value="Zimbabwe">Zimbabwe</option>



                                                <!--<option value="Other">Other</option>-->
                                            </select>
                                        </div>											
                                    </div>
                                    </div>





                                    <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                        <label>Passport No.<span class="red">*</span></label>
											<br>
                                            <input type="radio" name="passport" id="yes" value="Yes"required> Yes  <input type="text"  name="passportno" id="passport" style="display:none">
											<input type="radio" name="passport" id="no" value="N/A"> No
                                        </div>
                                    </div>
                                    </div>




                                    <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Father Name<span class="red">*</span></label>
                                            <input type="text" class="form-control "  name="fname" id="fname" required  data-parsley-trigger="keyup" placeholder="Enter Father Name" >
                                        </div>
                                    </div>
                                    </div>



                                    <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Mother Name<span class="red">*</span></label>
                                            <input type="text" class="form-control "  name="mname" id="mname" required  data-parsley-trigger="keyup" placeholder="Enter Mother Name" >
                                        </div>
                                    </div>
                                    </div>



                                    <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Father/Mother Cell No.<span class="red">*</span></label>
                                            <input type="text" class="form-control " name="fcellno" id="fcellno" data-parsley-type="number" required placeholder="Enter Father or Mother Cell No......................">
                                        </div>
                                    </div>
                                    </div>









                                
                       
                   
                                <div class="row " >
                                    
                                <div class="column bg-light"  style="border:1px solid" >
                                <label > Present Address</label>
                               


                                         <div class="row" >
											<div class="col-md-6">
												<div class="form-group">
													<label>Village/town/Road<span class="red">*</span></label>
													<textarea   class="txtarea form-control" id="Present_textarea"name="Present_textarea" rows="4" cols="50" required   >
 
  
  													</textarea>
													
											</div>
											</div>
											</div>


                                    <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>District<span class="red">*</span></label>
                                            <input type="text" class="form-control " name="Present_District" id="Present_District" data-parsley-trigger="keyup" required placeholder="Enter District Name">
                                        </div>
                                    </div>
                                    </div>


                                
                                         
                                      

                                       
                                     
                                        
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Post Office<span class="red">*</span></label>
                                            <input type="text" class="form-control " name="Present_PostOffice" id="Present_PostOffice" data-parsley-trigger="keyup" required placeholder="Enter Post Office name">
                                        </div>
                                    </div>
                                    </div>

                                      
                                    <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Post Code<span class="red">*</span></label>
                                            <input type="text" class="form-control " name="Present_postcode" id="Present_postcode" data-parsley-type="number" required placeholder="Enter Post Code">
                                        </div>
                                    </div>
                                    </div>


                                    </div>
                              





                                
                                <div class="column bg-light " style="border:1px solid" >

                                <label style="">Present Address <input type="checkbox" id="check_rules"  /> Same as Parmanet Address</label>
                                


                                <div class="row" >
											<div class="col-md-6">
												<div class="form-group">
													<label>Village/town/Road<span class="red">*</span></label>
													<textarea   class="txtarea form-control" id="Parmanet_textarea"name="Parmanet_textarea" rows="4" cols="50" required  >
 
  
  													</textarea>
													
											</div>
											</div>
											</div>


                                    <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>District<span class="red">*</span></label>
                                            <input type="text" class="form-control " name="Parmanet_District" id="Parmanet_District" data-parsley-trigger="keyup" required placeholder="Enter District Name">
                                        </div>
                                    </div>
                                    </div>


                                
                                         
                                      

                                       
                                     
                                        
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Post Office<span class="red">*</span></label>
                                            <input type="text" class="form-control " name="Parmanet_postoffice" id="Parmanet_postoffice" data-parsley-trigger="keyup" required placeholder="Enter Post office Name">
                                        </div>
                                    </div>
                                    </div>

                                      
                                    <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Post Code<span class="red">*</span></label>
                                            <input type="text" class="form-control " name="parmanent_postcode" id="parmanent_postcode" data-parsley-type="number" required placeholder="Enter Post Code">
                                        </div>
                                    </div>
                                    </div>
                             
                                </div>
                                </div>

                                <br>




                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Hall Name<span class="red">*</span></label>													
                                            <select data-placeholder="Choose Hall Name..." class="chosen-select" id="hallname" name="hallname" >
                                               
                                                <option value="">Select the Hall Name</option>

                                                @foreach($hallname as $row)
                                            
                                                <option value="{{ $row->id }}">{{ $row->hallname}}</option>
                                                

                                                @endforeach

                                                <!--<option value="Other">Other</option>-->
                                            </select>
                                        </div>											
                                    </div>
                                    </div>





                                





                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Room No.<span class="red">*</span></label>
                                            <input type="text" class="form-control " name="roomno" id="roomno" data-parsley-type="number" required placeholder="Enter the Room Number">
                                        </div>
                                    </div>
                                    </div>

                                    <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Cost of Room.<span class="red">*</span></label>
                                            <input type="text" class="form-control " name="roomcost" id="roomcost" data-parsley-type="number" required placeholder="Enter Cost">
                                        </div>
                                    </div>
                                    </div>

                                


                                         <div class="row">
											<div class="col-lg-6">
                                                <div class="form-group ">
                                                    <label > Insert Image of Student<span class="red">*</span></label>
                                                     <input type="file" name="file" required>
                                                </div>
                                            </div>
                                            </div>




 

                                            <div class="row">
											<div class="col-md-6">
												<div class="form-group">
													<label>Approximate date of arrival<span class="red">*</span></label>
													<input type="date" class="form-control " name="doj" id="doj"  data-parsley-trigger="keyup" data-parsley-type="date" required >
												</div>
											</div>
											</div>




                                            <div class="row">
											<div class="col-md-4">
												<div class="form-group">
													<label>Active Status<span class="red">*</span></label>													
													<select data-placeholder="Choose Active Status..." class="chosen-select" id="activestatus" name="activestatus" required>
														<option value="">Select Status</option>
														<option value="Active">Active</option>
														<option value="Inactive">Inactive</option>
													</select>
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
                           <br> 
                            </div>
					

@endsection

@section('customjs')
<script>
var SITEURL = '{{URL::to('')}}';


//get notification count number
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
    $( ".StudentManagementbyadmin-menu" ).addClass( "active" );
		$( ".StudentManagementbyadmin-menu ul" ).addClass( "in" );
		$( ".StudentManagementbyadmin-menu ul" ).attr("aria-expanded", "true");
		$( ".Admission-menu" ).addClass( "active" );







//for csrf token


    $.ajaxSetup({
headers: {
   'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
}
});

//for passport yes or no 
$('#yes').click(function(){

$('#passport').show();

})

$('#no').click(function(){

$('#passport').hide(1000);

});


// send auto value for parmanent address

$('#check_rules').click(function(){
    
   
    Present_textarea= $('#Present_textarea').val();
    Present_District= $('#Present_District').val();
    Present_PostOffice= $('#Present_PostOffice').val();
     Present_postcode= $('#Present_postcode').val();

    $('#Parmanet_textarea').val(Present_textarea);
    $('#Parmanet_District').val(Present_District);
    $('#Parmanet_postoffice').val(Present_PostOffice);
    $('#parmanent_postcode').val(Present_postcode);
   
});


//get student information form uses table to student application form

$("#studentid").change(function(){
        var studentid = $(this).children("option:selected").val();
        


		$.ajax({
				url: SITEURL +"/getinputdataforstudentapplication",
				type:"POST",
			
				data: {"studentid":studentid
				
				},
				
			  
			
				success:function(data)
				{
			     $('#studentname').val(data.name);
			     $('#pname').html(data.name);

			     $('#Phone').val(data.phone);
			     $('#email').val(data.email);
			     //$('#amount').val(data.amount);
			
			     $('#Program').val(data.studentdept);
			     $('#batchno').val(data.batch);
			     $('#dob').val(data.dob);
			     $('#bldgrp').val(data.bldgrp);
			    
			     $('#Nationality').val(data.nationality).trigger("chosen:updated");
              
                 $('#fname').val(data.f_name);

                 $('#mname').val(data.m_name);
                 $('#fcellno').val(data.p_cell);
                 $("#profileimage").html('<img src="images/'+data.image+'" width="100px" height="120px" style="border-radius: 50%;" />');



                 if(data.pass_status=="Yes")

                    {


                    $("#yes").attr('checked', true).trigger('click');

                    $('#passport').val(data.passno);
			     

                    }

              
                 


                 if(data.gender=="female")

                        {


                        $("#female").attr('checked', true).trigger('click');



                        }

                        if(data.gender=="male")

                        {


                        $("#male").attr('checked', true).trigger('click');



                        }


                        if(data.gender=="other")

                        {


                        $("#other").attr('checked', true).trigger('click');



                        }












				}


    });

});




//add data into application table

$('#studentapplication').parsley();




	$('#studentapplication').on('submit', function(event){
        event.preventDefault();
        if($('#studentapplication').parsley().isValid())
  {


		$.ajax({
				url: SITEURL +"/addstudentapplication",
				type:"POST",
			
				data:  new FormData(this),
				contentType: false,
					cache: false,
			processData:false,
				beforeSend:function(){
				//$('#submit').attr('disabled','disabled');
				//$('#submit').val('Submitting...');
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
					toastr.success("Applicated");

				}, 1300);

				$('#studentapplication')[0].reset();
				$('#studentapplication').parsley().reset();	



			}


            if(data=="available")
					{
					setTimeout(function() {
					toastr.options = {
						closeButton: true,
						progressBar: true,
						showMethod: 'slideDown',
						timeOut: 10000
					};
					toastr.error("You did already an application. Your application is pending and  not accepted yet. ");

				}, 1300);

			
			}




            




            if(data=="hallandroomnonotmatch")
					{
					setTimeout(function() {
					toastr.options = {
						closeButton: true,
						progressBar: true,
						showMethod: 'slideDown',
						timeOut: 4000
					};
					toastr.error("Does not match hall name and  room number");

				}, 1300);

				

			}



            if(data=="notempty")
					{
					setTimeout(function() {
					toastr.options = {
						closeButton: true,
						progressBar: true,
						showMethod: 'slideDown',
						timeOut: 4000
					};
					toastr.error("sorry not empty the Seat");

				}, 1300);

				

			}






                }
                
                });

                }
                });





$('.chosen-select').chosen({width: "100%"});


getMyNewPostCount();



$( "#studetntidnumber" ).keyup(function() {
    var studetntidnumber = $( this ).val();
   

    $.ajax({
				url: SITEURL +"/studetntidnumber",
				type:"POST",
			
				data: {"studetntidnumber":studetntidnumber
				
				},
				
			  
			
				success:function(data)
				{
			 
                 $('#studentname,#pname').val(data.studentname);
			     $('#Phone').val(data.studentphone);
			     $('#email').val(data.studentmail);
			     $('#Program').val(data.studentdept);
			     $('#batchno').val(data.batch);
			     $('#dob').val(data.dob);
			     $('#bldgrp').val(data.bldgrp);
                 $('#Nationality').val(data.nationality).trigger("chosen:updated");
              
                 $('#fname').val(data.f_name);

                 $('#mname').val(data.m_name);
                 $('#fcellno').val(data.p_cell);
                 $("#profileimage").html('<img src="images/'+data.image+'" width="100px" height="120px" style="border-radius: 50%;" />');
			     $('#pname').html(data.studentname);



                 if(data.pass_status=="Yes")

                    {


                    $("#yes").attr('checked', true).trigger('click');

                    $('#passport').val(data.passno);
			     

                    }




                if(data.studentgender=="female")

                {
             

                $("#female").attr('checked', true).trigger('click');



                }

                if(data.studentgender=="male")

              {


                $("#male").attr('checked', true).trigger('click');



                }


                if(data.studentgender=="other")

                {


                $("#other").attr('checked', true).trigger('click');



                }



			    
				}


    });







  }).keyup();


// auto insert will be into the room cost input field
  

$("#hallname").change(function(){
        var hallnameid = $(this).children("option:selected").val();
        

        $( "#roomno" ).keyup(function() {
        var roomno = $( this ).val();
   

       


		$.ajax({
				url: SITEURL +"/hallnameid",
				type:"POST",
			
				data: {
                    "hallnameid":hallnameid,
                    "roomno":roomno,

				
				},
				
			  
			
				success:function(data)
				{
			    $('#roomcost').val(data);
			 
	
				}


    });

}).keyup();

})










});



</script>



@endsection
