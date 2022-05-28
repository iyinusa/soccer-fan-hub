<?php include(APPPATH.'libraries/inc.php'); ?>
        <section class="layout">
            <!-- main content -->
            <section class="main-content">
                <!-- content wrapper -->
                <div class="content-wrap">
                    <!-- inner content wrapper -->
                    <div class="wrapper">
                    	<div class="row">
                            <div class="col-md-8">
                            	<div class="col-lg-12">
                                	<h2><i class="ti-settings"></i> Update Profile</h2>
                                </div>
                                
                                <div class="col-lg-12">
                                	<div class="widget">
                                        <div class="widget-body no-p">
                                            <?php echo $err_msg; ?>
                                  
											<?php echo form_open('settings/account', array('id'=>'stepy', 'class'=>'stepy')); ?>
            									<fieldset title="Profile">
                                                    <legend>Identity</legend>
            
                                                    <div class="form-group">
                                                        <label>Username/Display Name</label>
                                                        <div class="form-inline">
                                                        	<div class="form-group">
                                                                <input name="name" type="text" class="form-control" placeholder="Username" value="<?php if(!empty($log_user_nicename)){echo $log_user_nicename;} ?>" />
                                                            </div>
                                                            <div class="form-group">
                                                                <input name="displayname" type="text" class="form-control" placeholder="Display Name" required="required" value="<?php if(!empty($log_display_name)){echo $log_display_name;} ?>" />
                                                            </div>
                                                        </div>
                                                    </div>
            
                                                    <div class="form-group">
                                                        <label>Gender/Date of Birth</label>
                                                        <div class="form-inline">
                                                            <div class="input-group mb15">
                                                                <?php
																	if(!empty($log_user_sex)){
																		if($log_user_sex == 'Male'){
																			$m_sel = 'selected="selected"';
																			$f_sel = '';
																		} else {
																			$m_sel = '';
																			$f_sel = 'selected="selected"';
																		}
																	} else {$m_sel = '';$f_sel = '';}
																?>
                                                                <select data-placeholder="Gender" class="form-control chosen" name="sex" required="required">
                                                                    <option>Select Gender</option>
                                                                    <option value="Male" <?php echo $m_sel; ?>>Male</option>
                                                                    <option value="Female" <?php echo $f_sel; ?>>Female</option>
                                                                </select>
                                                            </div>
                                                            <div class="input-group mb15">
                                                                <input name="dob" type="text" class="form-control datepicker" placeholder="Date of Birth" value="<?php if(!empty($log_user_dob)){echo $log_user_dob;} ?>">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="form-group">
                                                        <label>Bio</label>
                                                        <div>
                                                            <textarea name="bio" id="bio" class="form-control"><?php if(!empty($log_user_bio)){echo $log_user_bio;} ?></textarea>
                                                        </div>
                                                    </div>
                                                </fieldset>
            
                                                <fieldset title="Contact">
                                                    <legend>Information</legend>
            										<div class="form-inline">
                                                        <div class="form-group">
                                                            <label>Phone</label>
                                                            <div>
                                                                <input name="phone" type="text" class="form-control" placeholder="Phone Number" value="<?php if(!empty($log_user_phone)){echo $log_user_phone;} ?>" />
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Email</label>
                                                            <div>
                                                                <input name="email" type="email" class="form-control" placeholder="Email Address" value="<?php if(!empty($log_user_email)){echo $log_user_email;} ?>" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Address</label>
                                                        <div>
                                                            <textarea name="address" id="address" class="form-control"><?php if(!empty($log_user_address)){echo $log_user_address;} ?></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="form-inline">
                                                        <div class="form-group">
                                                            <label>State</label>
                                                            <div>
                                                                <input name="city" type="text" class="form-control" placeholder="State" value="<?php if(!empty($log_user_city)){echo $log_user_city;} ?>" />
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Country</label>
                                                            <div>
                                                                <select data-placeholder="Country" class="form-control chosen" name="country" required="required">
                                                                    <option>Select Country</option>
                                                                    <option value="<?php if(!empty($log_user_country)){echo $log_user_country;} ?>" selected="selected"><?php if(!empty($log_user_country)){echo $log_user_country;} ?></option>
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
                                                                    <option value="Nigeria">Nigeria</option>
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
                                                        </div>
                                                    </div>
                                                </fieldset>
            
                                                <fieldset title="Social">
                                                    <legend>Information</legend>
                                                    <div class="form-group">
                                                        <label>Website <small class="text-muted">(eg http://your-site.com)</small></label>
                                                        <div>
                                                            <input name="website" type="text" class="form-control" placeholder="Website" value="<?php if(!empty($log_user_website)){echo $log_user_website;} ?>" />
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Facebook <small class="text-muted">(eg http://fabebook.com/your-fb-page)</small></label>
                                                        <div>
                                                            <input name="fb_page" type="text" class="form-control" placeholder="Facebook Page" value="<?php if(!empty($log_user_facebook)){echo $log_user_facebook;} ?>" />
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Twitter <small class="text-muted">(eg http://twitter.com/your-twitter-handle)</small></label>
                                                        <div>
                                                            <input name="twitter" type="text" class="form-control" placeholder="Twitter Page" value="<?php if(!empty($log_user_twitter)){echo $log_user_twitter;} ?>" />
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>LinkedIn <small class="text-muted">(eg http://linkedin.com/in/your-linkedin-page)</small></label>
                                                        <div>
                                                            <input name="linkedin" type="text" class="form-control" placeholder="LinkedIn Page" value="<?php if(!empty($log_user_linkedin)){echo $log_user_linkedin;} ?>" />
                                                        </div>
                                                    </div>
                                                </fieldset>
            
                                                <button type="submit" class="btn btn-primary stepy-finish pull-right"><i class="ti-share mr5"></i> Update Record</button>
            									<div class="col-lg-12"></div>
                                            <?php echo form_close(); ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            
                            <div class="col-md-4">