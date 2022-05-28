		<section class="layout">
            <!-- main content -->
            <section class="main-content">
                <!-- content wrapper -->
                <div class="content-wrap">
                    <!-- inner content wrapper -->
                    <div class="wrapper">
                    	<div class="row">
                            <div class="col-md-8">
                                <h2><i class="ti ti-user"></i> Create Account</h2>
                                
                                <div class="col-sm-12 text-center"> 
                                    Join Network Using <i class="ti-angle-right"></i> <a href="<?php echo base_url(); ?>hauth/login/Facebook" class="btn btn-social btn-sm btn-facebook mr5"><i class="fa fa-facebook"></i> Facebook</a>
                                </div>
                                    <!--<div class="col-sm-6 text-center"> <a href="<?php echo base_url(); ?>hauth/login/Twitter" class="btn btn-twitter btn-circle btn-sm"><i class="fa fa-twitter"></i>Sign up with Twitter</a> </div>-->
                               	<br /><br />
                           		<?php echo $err_msg; ?>
                                  
                           		<?php echo form_open('register') ?>
                               		<div class="col-md-6">
                                        <div class="form-group mr5">
                                            <input name="name" type="text" placeholder="Display Name" class="form-control input-lg" value="<?php echo set_value('name'); ?>">
                                        </div>
                                        <div class="form-group mr5">
                                            <input name="username" type="text" placeholder="Username" class="form-control input-lg" value="<?php echo set_value('username'); ?>">
                                        </div>
                                        <div class="form-group mr5">
                                            <input name="password" type="password" id="inputPassword" placeholder="Password" class="form-control input-lg" value="<?php echo set_value('password'); ?>">
                                        </div>
                                        <div class="form-group mr5">
                                            <input name="confirm" type="password" id="inputPassword" placeholder="Confim Password" class="form-control input-lg" value="<?php echo set_value('confirm'); ?>">
                                        </div>
                                        <div class="form-group mr5">
                                            <input name="email" type="email" placeholder="yours@email.com" class="form-control input-lg" value="<?php echo set_value('email'); ?>">
                                        </div>
                                        <div class="form-group mr5">
                                            <input name="phone" type="text" placeholder="Phone" class="form-control input-lg" value="<?php echo set_value('phone'); ?>">
                                        </div>
                                        <div class="form-group mr5">
                                            <div class="radio input-lg">
                                            	<label><input type="radio" name="sex" value="Male">Male</label>&nbsp;
                                                <label><input type="radio" name="sex" value="Female">Female</label>
                                          	</div>
                                        </div>
                                   	</div>
                                    
                                    <div class="col-md-6">
                                        <div class="form-group mr5">
                                            <select name="country" class="form-control input-lg">
                                              <option value="Afghanistan">Afghanistan</option>
                                              <option value="Albania">Albania</option>
                                              <option value="Algeria">Algeria</option>
                                              <option value="American Samoa">American Samoa</option>
                                              <option value="Andorra">Andorra</option>
                                              <option value="Angola">Angola</option>
                                              <option value="Anguilla">Anguilla</option>
                                              <option value="Antarctica">Antarctica</option>
                                              <option value="Antigua And Barbuda">Antigua And Barbuda</option>
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
                                              <option value="Bosnia And Herzegovina">Bosnia And Herzegovina</option>
                                              <option value="Botswana">Botswana</option>
                                              <option value="Bouvet Island">Bouvet Island</option>
                                              <option value="Brazil">Brazil</option>
                                              <option value="British Indian Ocean Territory">British Indian Ocean Territory</option>
                                              <option value="Brunei Darussalam">Brunei Darussalam</option>
                                              <option value="Bulgaria">Bulgaria</option>
                                              <option value="Burkina Faso">Burkina Faso</option>
                                              <option value="Burundi">Burundi</option>
                                              <option value="Cambodia">Cambodia</option>
                                              <option value="Cameroon">Cameroon</option>
                                              <option value="Canada">Canada</option>
                                              <option value="Cape Verde">Cape Verde</option>
                                              <option value="Cayman Islands">Cayman Islands</option>
                                              <option value="Central African Republic">Central African Republic</option>
                                              <option value="Chad">Chad</option>
                                              <option value="Chile">Chile</option>
                                              <option value="China">China</option>
                                              <option value="Christmas Island">Christmas Island</option>
                                              <option value="Cocos (Keeling) Islands">Cocos (Keeling) Islands</option>
                                              <option value="Colombia">Colombia</option>
                                              <option value="Comoros">Comoros</option>
                                              <option value="Congo">Congo</option>
                                              <option value="Cook Islands">Cook Islands</option>
                                              <option value="Costa Rica">Costa Rica</option>
                                              <option value="Cote D&#39;Ivoire">Cote D&#39;Ivoire</option>
                                              <option value="Croatia (Local Name: Hrvatska)">Croatia (Local Name: Hrvatska)</option>
                                              <option value="Cuba">Cuba</option>
                                              <option value="Cyprus">Cyprus</option>
                                              <option value="Czech Republic">Czech Republic</option>
                                              <option value="Denmark">Denmark</option>
                                              <option value="Djibouti">Djibouti</option>
                                              <option value="Dominica">Dominica</option>
                                              <option value="Dominican Republic">Dominican Republic</option>
                                              <option value="Ecuador">Ecuador</option>
                                              <option value="Egypt">Egypt</option>
                                              <option value="El Salvador">El Salvador</option>
                                              <option value="Equatorial Guinea">Equatorial Guinea</option>
                                              <option value="Eritrea">Eritrea</option>
                                              <option value="Estonia">Estonia</option>
                                              <option value="Ethiopia">Ethiopia</option>
                                              <option value="Falkland Islands (Malvinas)">Falkland Islands (Malvinas)</option>
                                              <option value="Faroe Islands">Faroe Islands</option>
                                              <option value="Fiji">Fiji</option>
                                              <option value="Finland">Finland</option>
                                              <option value="France">France</option>
                                              <option value="France, Metropolitan">France, Metropolitan</option>
                                              <option value="French Guiana">French Guiana</option>
                                              <option value="French Polynesia">French Polynesia</option>
                                              <option value="French Southern Territories">French Southern Territories</option>
                                              <option value="Gabon">Gabon</option>
                                              <option value="Gambia">Gambia</option>
                                              <option value="Georgia">Georgia</option>
                                              <option value="Germany">Germany</option>
                                              <option value="Ghana">Ghana</option>
                                              <option value="Gibraltar">Gibraltar</option>
                                              <option value="Greece">Greece</option>
                                              <option value="Greenland">Greenland</option>
                                              <option value="Grenada">Grenada</option>
                                              <option value="Guadeloupe">Guadeloupe</option>
                                              <option value="Guam">Guam</option>
                                              <option value="Guatemala">Guatemala</option>
                                              <option value="Guinea">Guinea</option>
                                              <option value="Guinea-Bissau">Guinea-Bissau</option>
                                              <option value="Guyana">Guyana</option>
                                              <option value="Haiti">Haiti</option>
                                              <option value="Heard Island &amp; Mcdonald Islands">Heard Island &amp; Mcdonald Islands</option>
                                              <option value="Honduras">Honduras</option>
                                              <option value="Hong Kong">Hong Kong</option>
                                              <option value="Hungary">Hungary</option>
                                              <option value="Iceland">Iceland</option>
                                              <option value="India">India</option>
                                              <option value="Indonesia">Indonesia</option>
                                              <!--<option value="IR">Iran, Islamic Republic Of</option>-->
                                              <option value="Iraq">Iraq</option>
                                              <option value="Ireland">Ireland</option>
                                              <option value="Israel">Israel</option>
                                              <option value="Italy">Italy</option>
                                              <option value="Jamaica">Jamaica</option>
                                              <option value="Japan">Japan</option>
                                              <option value="Jordan">Jordan</option>
                                              <option value="Kazakhstan">Kazakhstan</option>
                                              <option value="Kenya">Kenya</option>
                                              <option value="Kiribati">Kiribati</option>
                                              <!--<option value="KP">Korea, Democratic People&#39;S Republic Of</option>-->
                                              <!--<option value="KR">Korea, Republic Of</option>-->
                                              <option value="Kuwait">Kuwait</option>
                                              <option value="Kyrgyzstan">Kyrgyzstan</option>
                                              <option value="Lao People&#39;S Democratic Republic">Lao People&#39;S Democratic Republic</option>
                                              <option value="Latvia">Latvia</option>
                                              <option value="Lebanon">Lebanon</option>
                                              <option value="Lesotho">Lesotho</option>
                                              <option value="Liberia">Liberia</option>
                                              <option value="Libyan Arab Jamahiriya">Libyan Arab Jamahiriya</option>
                                              <option value="Liechtenstein">Liechtenstein</option>
                                              <option value="Lithuania">Lithuania</option>
                                              <option value="Luxembourg">Luxembourg</option>
                                              <option value="Macau">Macau</option>
                                              <!--<option value="MK">Macedonia, The Former Yugoslav Republic Of</option>-->
                                              <option value="Madagascar">Madagascar</option>
                                              <option value="Malawi">Malawi</option>
                                              <option value="Malaysia">Malaysia</option>
                                              <option value="Maldives">Maldives</option>
                                              <option value="Mali">Mali</option>
                                              <option value="Malta">Malta</option>
                                              <option value="Marshall Islands">Marshall Islands</option>
                                              <option value="Martinique">Martinique</option>
                                              <option value="Mauritania">Mauritania</option>
                                              <option value="Mauritius">Mauritius</option>
                                              <option value="Mayotte">Mayotte</option>
                                              <option value="Mexico">Mexico</option>
                                              <!--<option value="FM">Micronesia, Federated States Of</option>-->
                                              <!--<option value="MD">Moldova, Republic Of</option>-->
                                              <option value="Monaco">Monaco</option>
                                              <option value="Mongolia">Mongolia</option>
                                              <option value="Montserrat">Montserrat</option>
                                              <option value="Morocco">Morocco</option>
                                              <option value="Mozambique">Mozambique</option>
                                              <option value="Myanmar">Myanmar</option>
                                              <option value="Namibia">Namibia</option>
                                              <option value="Nauru">Nauru</option>
                                              <option value="Nepal">Nepal</option>
                                              <option value="Netherlands">Netherlands</option>
                                              <option value="Netherlands Antilles">Netherlands Antilles</option>
                                              <option value="New Caledonia">New Caledonia</option>
                                              <option value="New Zealand">New Zealand</option>
                                              <option value="Nicaragua">Nicaragua</option>
                                              <option value="Niger">Niger</option>
                                              <option value="Nigeria" selected="selected">Nigeria</option>
                                              <option value="Niue">Niue</option>
                                              <option value="Norfolk Island">Norfolk Island</option>
                                              <option value="Northern Mariana Islands">Northern Mariana Islands</option>
    
                                              <option value="Norway">Norway</option>
                                              <option value="Oman">Oman</option>
                                              <option value="Pakistan">Pakistan</option>
                                              <option value="Palau">Palau</option>
                                              <option value="Panama">Panama</option>
                                              <option value="Papua New Guinea">Papua New Guinea</option>
                                              <option value="Paraguay">Paraguay</option>
                                              <option value="Peru">Peru</option>
                                              <option value="Philippines">Philippines</option>
                                              <option value="Pitcairn">Pitcairn</option>
                                              <option value="Poland">Poland</option>
                                              <option value="Portugal">Portugal</option>
                                              <option value="Puerto Rico">Puerto Rico</option>
                                              <option value="Qatar">Qatar</option>
                                              <option value="Reunion">Reunion</option>
                                              <option value="Romania">Romania</option>
                                              <option value="Russian Federation">Russian Federation</option>
                                              <option value="Rwanda">Rwanda</option>
                                              <option value="Saint Helena">Saint Helena</option>
                                              <option value="Saint Kitts And Nevis">Saint Kitts And Nevis</option>
                                              <option value="Saint Lucia">Saint Lucia</option>
                                              <option value="Saint Pierre And Miquelon">Saint Pierre And Miquelon</option>
                                              <option value="Saint Vincent And The Grenadines">Saint Vincent And The Grenadines</option>
                                              <option value="Samoa">Samoa</option>
                                              <option value="San Marino">San Marino</option>
                                              <option value="Sao Tome And Principe">Sao Tome And Principe</option>
                                              <option value="Saudi Arabia">Saudi Arabia</option>
                                              <option value="Senegal">Senegal</option>
                                              <option value="Seychelles">Seychelles</option>
                                              <option value="Sierra Leone">Sierra Leone</option>
                                              <option value="Singapore">Singapore</option>
                                              <option value="Slovakia (Slovak Republic)">Slovakia (Slovak Republic)</option>
                                              <option value="Slovenia">Slovenia</option>
                                              <option value="Solomon Islands">Solomon Islands</option>
                                              <option value="Somalia">Somalia</option>
                                              <option value="South Africa">South Africa</option>
                                              <option value="Spain">Spain</option>
                                              <option value="Sri Lanka">Sri Lanka</option>
                                              <option value="Sudan">Sudan</option>
                                              <option value="Suriname">Suriname</option>
                                              <option value="Svalbard And Jan Mayen Islands">Svalbard And Jan Mayen Islands</option>
                                              <option value="Swaziland">Swaziland</option>
                                              <option value="Sweden">Sweden</option>
                                              <option value="Switzerland">Switzerland</option>
                                              <option value="Syrian Arab Republic">Syrian Arab Republic</option>
                                              <option value="Taiwan, Province Of China">Taiwan, Province Of China</option>
                                              <option value="Tajikistan">Tajikistan</option>
                                              <!--<option value="TZ">Tanzania, United Republic Of</option>-->
                                              <option value="Thailand">Thailand</option>
                                              <option value="Togo">Togo</option>
                                              <option value="Tokelau">Tokelau</option>
                                              <option value="Tonga">Tonga</option>
                                              <option value="Trinidad And Tobago">Trinidad And Tobago</option>
                                              <option value="Tunisia">Tunisia</option>
                                              <option value="Turkey">Turkey</option>
                                              <option value="Turkmenistan">Turkmenistan</option>
                                              <option value="Turks And Caicos Islands">Turks And Caicos Islands</option>
                                              <option value="Tuvalu">Tuvalu</option>
                                              <option value="Uganda">Uganda</option>
                                              <option value="Ukraine">Ukraine</option>
                                              <option value="United Arab Emirates">United Arab Emirates</option>
                                              <option value="United Kingdom">United Kingdom</option>
                                              <option value="United States">United States</option>
                                              <option value="United States Minor Outlying Islands">United States Minor Outlying Islands</option>
                                              <option value="Uruguay">Uruguay</option>
                                              <option value="Uzbekistan">Uzbekistan</option>
                                              <option value="Vanuatu">Vanuatu</option>
                                              <option value="Vatican City State (Holy See)">Vatican City State (Holy See)</option>
                                              <option value="Venezuela">Venezuela</option>
                                              <option value="Viet Nam">Viet Nam</option>
                                              <option value="Virgin Islands (British)">Virgin Islands (British)</option>
                                              <option value="Virgin Islands (U.S.)">Virgin Islands (U.S.)</option>
                                              <option value="Wallis And Futuna Islands">Wallis And Futuna Islands</option>
                                              <option value="Western Sahara">Western Sahara</option>
                                              <option value="Yemen">Yemen</option>
                                              <option value="Yugoslavia">Yugoslavia</option>
                                              <option value="Zaire">Zaire</option>
                                              <option value="Zambia">Zambia</option>
                                              <option value="Zimbabwe">Zimbabwe</option>
                                            </select>
                                        </div>
                                        
                                        <div class="form-group mr5">
                                        	<div class="checkbox"> 
                                                <label class="checkbox-custom input-lg"> 
                                                    <input type="checkbox" name="checkboxA" checked="checked"> Agree the <a data-toggle="modal" href="#model_tos">terms and policy</a>
                                                </label> 
                                            </div>
                                            <div>
                                                <?php echo $recaptcha_html; ?>
                                            </div>
                                            <button type="submit" class="btn btn-info btn-lg"><i class="ti-user"></i> Join Club Network <i class="ti-arrow-circle-right"></i></button>
                                            <p class="text-muted text-right"><small>Already have an account?</small> <a href="<?php echo base_url(); ?>login" class="btn btn-default btn-sm"><i class="ti-key"></i> Sign In <i class="ti-angle-right"></i></a></p>
                                      		
                                        </div>
                                   	</div>
                                    
                                  <?php echo form_close() ?>
                            </div>
                            
                            <div class="col-md-4">

                            