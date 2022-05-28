<?php include(APPPATH.'views/logics/recent_activity.php'); ?>
        <section class="layout">
            <!-- main content -->
            <section class="main-content">
                <!-- content wrapper -->
                <div class="content-wrap">
                    <!-- inner content wrapper -->
                    <div class="wrapper">
                    	<div class="row">
                            <div class="col-md-8">
                                <img alt="" src="<?php echo base_url('img/ads.png'); ?>" width="100%" />
                            </div>
                            
                            <div class="col-md-4">
                            	<?php if(!empty($ra_indicator) && !empty($ra_item)){ ?>
                                    <div class="panel">
                                        <div class="carousel slide" data-ride="carousel" id="quote-carousel">
                                            <ol class="carousel-indicators">
                                                <?php if(!empty($ra_indicator)){echo $ra_indicator;} ?>
                                            </ol>
        
                                            <div class="carousel-inner">
                                                <?php if(!empty($ra_item)){echo $ra_item;} ?>
                                            </div>
          
                                            <a data-slide="prev" href="#quote-carousel" class="left carousel-control">
                                                <i class="ti-arrow-circle-left"></i>
                                            </a>
                                            <a data-slide="next" href="#quote-carousel" class="right carousel-control">
                                                <i class="ti-arrow-circle-right"></i>
                                            </a>
                                        </div>
                                    </div>
                                <?php } ?>
                                <!--<div class="panel">
                                    <div class="carousel slide" data-ride="carousel" id="quote-carousel">
                                        <ol class="carousel-indicators">
                                            <li data-target="#quote-carousel" data-slide-to="0" class="active"></li>
                                            <li data-target="#quote-carousel" data-slide-to="1"></li>
                                            <li data-target="#quote-carousel" data-slide-to="2"></li>
                                        </ol>
    
                                        <div class="carousel-inner">
                                            <div class="item active">
      
                                                <div class="row">
                                                    <div class="col-sm-3 text-center">
                                                        <img class="img-circle avatar avatar-md" src="img/face4.jpg" alt="">
                                                    </div>
                                                    <div class="col-sm-9">
                                                        <p>Your eyes can deceive you. Don't trust them. I don't know what you're talking about.</p>
                                                        <small>
                                                            <i>Someone famous</i>
                                                        </small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="item">
                                                <div class="row">
                                                    <div class="col-sm-3 text-center">
                                                        <img class="img-circle avatar avatar-md" src="img/face5.jpg" alt="">
                                                    </div>
                                                    <div class="col-sm-9">
                                                        <p><a href="<?php base_url('moots'); ?>">Your eyes can deceive you. Don't trust them. I don't know what you're talking about thiff hgghjkb hvhjjk hvb hhjk i j jhgjkjkmnkn jjkk.</a></p>
                                                        <small>
                                                            <i>Another famous person</i>
                                                        </small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="item">
                                                <div class="row">
                                                    <div class="col-sm-3 text-center">
                                                        <img class="img-circle avatar avatar-md" src="img/face1.jpg" alt="">
                                                    </div>
                                                    <div class="col-sm-9">
                                                        <p>Your eyes can deceive you. Don't trust them. I don't know what you're talking about.</p>
                                                        <small>
                                                            <i>The same famous person</i>
                                                        </small>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
      
                                        <a data-slide="prev" href="#quote-carousel" class="left carousel-control">
                                            <i class="ti-arrow-circle-left"></i>
                                        </a>
                                        <a data-slide="next" href="#quote-carousel" class="right carousel-control">
                                            <i class="ti-arrow-circle-right"></i>
                                        </a>
                                    </div>
                                </div>-->
                                
                                <div id="login" class="panel">
                                	<div class="panel-heading">
                                    	<h3><i class="ti ti-key"></i> Sign In</h3>
                                    </div>
                                    <div class="panel-body">
                                    	<a href="<?php echo base_url(); ?>hauth/login/Facebook" class="btn btn-social btn-sm btn-facebook mr5"><i class="fa fa-facebook"></i> Facebook</a>
                                        <!--<a class="btn btn-social btn-lg btn-twitter mr5"><i class="fa fa-twitter"></i> Twitter</a>-->
                                        <br /><br />
                                        <?php echo $err_msg; ?>
          
										<?php echo form_open('login') ?>
                                          <div class="form-group">
                                            <input name="email" type="email" placeholder="Email/Username" class="form-control input-lg" value="<?php echo set_value('email'); ?>">
                                          </div>
                                          <div class="form-group">
                                            <input name="password" type="password" id="inputPassword" placeholder="Password" class="form-control input-lg">
                                          </div>
                                          <div class="form-group"> 
                                              <input name="remind" type="checkbox" name="checkboxA"> Keep me signed in</a>
                                          </div>
                                          <a href="<?php echo base_url(); ?>forgot" class="pull-right m-t-mini"><small>Forgot password?</small></a>
                                          <button type="submit" class="btn btn-info"><i class="ti-key"></i> Sign In</button>
                                          <div class="line line-dashed"></div>
                                          
                                          <p class="text-muted text-center"><small>Do not have an account?</small></p>
                                          <a href="<?php echo base_url(); ?>register" class="btn btn-default btn-block"><i class="ti-user"></i> Create an account</a>
                                        <?php echo form_close() ?>
                                        
                                        <?php
																				?>										
                                    </div>
                                </div>
                            