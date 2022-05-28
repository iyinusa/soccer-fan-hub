<?php include(APPPATH.'libraries/inc.php'); ?>
		<section class="layout">
            <!-- main content -->
            <section class="main-content">
                <!-- content wrapper -->
                <div class="content-wrap">
                    <!-- inner content wrapper -->
                    <div class="wrapper">
                    	<div class="row">
                            <div class="col-md-4">
                                <!-- profile information sidebar -->
                                <div class="panel overflow-hidden no-b profile p15">
                                    <div class="row mb25">
                                        <div class="col-sm-12">
                                            <div class="row">
                                                <div class="col-xs-12 col-sm-6">
                                                    <h4 class="mb0"><?php echo $fan_display_name; ?></h4>
                                                    <small><?php echo $fan_nicename.' ('.$fan_sex.')'; ?></small>

                                                    <ul class="user-meta">
                                                        <li>
                                                            <i class="ti-cup mr5"></i>
                                                            <span><a href="<?php echo base_url('club/'.$fan_club_slug); ?>"><?php echo $fan_club_name; ?></a></span>
                                                        </li>
                                                        <li>
                                                            <i class="ti-email mr5"></i>
                                                            <span><?php echo $fan_email; ?></span>
                                                        </li>
                                                        <li>
                                                            <i class="ti-location-pin mr5"></i>
                                                            <span><?php echo $fan_location; ?></span>
                                                        </li>
                                                        <?php if($log_user_nicename == $fan_nicename){ ?>
                                                            <li>
                                                                <i class="ti-settings mr5"></i>
                                                                <a href="<?php echo base_url('settings/account'); ?>">Edit Profile</a>
                                                            </li>
                                                        <?php } ?>
                                                    </ul>
                                                    <?php if($log_user_role == 'administrator'){ ?>
                                                        <?php if($fan_verified == 1){ ?>
                                                        	
                                                        <?php } else { ?>
                                                        <input type="hidden" id="fanid" value="<?php echo $fan_id; ?>" />
                                                        <input type="hidden" id="fanemail" value="<?php echo $fan_email; ?>" />
                                                        <button type="button" class="btn btn-sm btn-success" onclick="try_verify();"><i class="fa fa-check"></i> Verify Fan</button><br /><div id="try_verify_reply"></div>
                                                        <script type="text/javascript">
														  function try_verify(){
															  var hr = new XMLHttpRequest();
															  var fanemail = document.getElementById('fanemail').value;
															  var fanid = document.getElementById('fanid').value;
															  var c_vars = "fanemail="+fanemail+"&fanid="+fanid;
															  hr.open("POST", "<?php echo base_url('fans/verify_fan'); ?>", true);
															  hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
															  hr.onreadystatechange = function() {
																  if(hr.readyState == 4 && hr.status == 200) {
																	  var return_data = hr.responseText;
																	  document.getElementById("try_verify_reply").innerHTML = return_data;
																 }
															  }
															  hr.send(c_vars);
															  document.getElementById("try_verify_reply").innerHTML = "<i class=\"icon-spin4 animate-spin loader\"></i>";
														  }
													  </script>
                                                      <?php } ?>
                                                    <?php } ?>
                                                </div>
                                                <div class="col-xs-12 col-sm-6 text-center">
                                                    <figure>
                                                        <img src="<?php echo base_url($fan_pics_small); ?>" alt="" class="avatar avatar-lg img-circle avatar-bordered">
                                                        <div class="small mt10">
                                                        	<i class="<?php echo $fan_quota_icon; ?> text-<?php echo $fan_quota_stripe; ?>"></i>&nbsp;
                                                            <b>Fan Strength</b>
                                                        </div>
                                                        <div class="progress progress-sm progress-striped active mt5 mb5">
                                                            <div class="progress-bar progress-bar-<?php echo $fan_quota_stripe; ?>" role="progressbar" aria-valuenow="<?php echo $fan_quota; ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $fan_quota; ?>%">
                                                            </div>
                                                        </div>
                                                        <small>
															<?php echo $fan_quota_value; ?> / <?php echo $all_quota_value; ?> (<?php echo $fan_quota; ?>%)
                                                            <?php if($log_user_nicename == $fan_nicename || $log_user_role=='administrator'){ ?>
                                                                <br />
                                                                <a href="<?php echo base_url('wallet'); ?>" class="btn btn-info btn-sm">
                                                                    <i class="ti-wallet"></i>
                                                                    <b>Wallet:</b>&nbsp;
                                                                    <span data-toggle="tooltip" data-placement="bottom" title="&#8358;<?php echo $wallet; ?>" style="cursor:pointer;">
                                                                        $<?php echo $wallet_dollar; ?>
                                                                    </span>
                                                                </a>
                                                            <?php } ?>
                                                       	</small>
                                                    </figure>
                                                </div>
                                                <div class="col-lg-12 mt25 text-center bt">
                                                	<div class="mt10"><b>Strength Legend</b></div>
                                                    <div class="small mt10">
                                                    	<span data-toggle="tooltip" data-placement="bottom" title="SFH Starter" style="cursor:pointer;">
                                                        	<i class="fa fa-circle-o text-danger"></i>&nbsp;0-20%&nbsp;
                                                        </span>
                                                        <span data-toggle="tooltip" data-placement="bottom" title="SFH Master" style="cursor:pointer;">
                                                        	<i class="fa fa-paper-plane-o text-warning"></i>&nbsp;21-40%&nbsp;
                                                        </span>
                                                        <span data-toggle="tooltip" data-placement="bottom" title="SFH Star" style="cursor:pointer;">
                                                        	<i class="fa fa-star-o text-primary"></i>&nbsp;41-60%&nbsp;
                                                        </span>
                                                        <span data-toggle="tooltip" data-placement="bottom" title="SFH Moon" style="cursor:pointer;">
                                                        	<i class="fa fa-moon-o text-info"></i>&nbsp;61-80%&nbsp;
                                                        </span>
                                                        <span data-toggle="tooltip" data-placement="bottom" title="SFH Sun" style="cursor:pointer;">
                                                        	<i class="fa fa-sun-o text-success"></i>&nbsp;81-100%&nbsp;
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-xs-12 mt25 text-center bt">
                                            <div class="col-xs-12 col-sm-4">
                                                <h2 class="mb0"><b><?php if($fan_moot_count >= 100000){echo number_format(99999).'+';}else{echo number_format($fan_moot_count);} ?></b></h2> 
                                                <small>Moots</small>
                                            </div>
                                            <div class="col-xs-12 col-sm-4">
                                                <h2 class="mb0"><b><?php if($fan_moot_reply_count >= 100000){echo number_format(99999).'+';}else{echo number_format($fan_moot_reply_count);} ?></b></h2> 
                                                <small>Contributions</small>
                                            </div>
                                            <div class="col-xs-12 col-sm-4">
                                                <h2 class="mb0"><b><?php if($fan_moot_club_count >= 100000){echo number_format(99999).'+';}else{echo number_format($fan_moot_club_count);} ?></b></h2> 
                                                <small><?php echo $fan_club_name; ?> Total Moots</small>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="row mb15">
                                        <div class="col-xs-12">
                                            <h4 class="heading-font">About <?php echo $fan_display_name; ?></h4>
                                            <p><?php echo $fan_bio; ?></p>
                                        </div>

                                        <div class="col-xs-12 mt15">
                                            <h6 class="heading-font">Social Profiles</h6>
                                            <div class="mt10 mb10">
                                                <a href="<?php echo $fan_fb_page; ?>" target="_blank" class="btn btn-social btn-xs btn-facebook mr5"><i class="fa fa-facebook"></i>Facebook </a>
                                                <a href="<?php echo $fan_twitter_page; ?>" target="_blank" class="btn btn-social btn-xs btn-twitter mr5"><i class="fa fa-twitter"></i>Twitter </a>
                                                <a href="<?php echo $fan_linkedin_page; ?>" target="_blank" class="btn btn-social btn-xs btn-linkedin mr5"><i class="fa fa-linkedin"></i>LinkedIn </a>
                                            </div>
                                        </div>

                                    </div>

                                    <a href="<?php echo $fan_website; ?>" target="_blank" class="text-muted">
                                        <i class="fa fa-globe mr15"></i><?php echo $fan_website; ?></a>
                                </div>
                                <!-- /profile information sidebar -->
                            </div>
                            
                            <div class="col-md-4 mb25">
								<?php if($log_user!=FALSE || $log_user_club_id!=0 || $log_user_club_ban!=0){ ?>
                                    <?php if($fan_nicename == $log_user_nicename){ ?>
                                        <section class="panel bordered">
                                            <form method="post" action="<?php echo base_url(); ?>moots/" id="postmoot">
                                                <textarea id="moot" name="moot" placeholder="What's your moot?" rows="2" class="form-control no-b"></textarea>
                                                <div class="panel-footer clearfix no-b">
                                                    <!--<div class="pull-left">
                                                        <button class="btn bg-none btn-sm" type="button">
                                                            <i class="ti-camera"></i>
                                                        </button>
                                                        <button class="btn bg-none btn-sm" type="button">
                                                            <i class="ti-video-camera"></i>
                                                        </button>
                                                        <button class="btn bg-none btn-sm" type="button">
                                                            <i class="ti-time"></i>
                                                        </button>
                                                    </div>-->
                                                    <div class="pull-right">
                                                        <button type="submit" id="submit-moot" class="btn btn-primary btn-sm">&nbsp;&nbsp;&nbsp;<i class="ti-thought"></i> Moot Now&nbsp;&nbsp;&nbsp;</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </section>
                                    <?php } ?>
                                <?php } ?>
                                
                                <section id="sfhscroll" class="panel bordered  post-comments">

                                    <?php include(APPPATH.'views/logics/moot_list.php'); ?>
                                    
                                    <div id="moot-msg"></div>
                                    
                                    <?php echo $moot_list; ?>
                                    
                                </section>
                            </div>
                            
                            <div class="col-md-4">

                            