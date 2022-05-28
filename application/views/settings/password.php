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
                                	<h2><i class="ti-key"></i> Change Password</h2>
                                </div>
                                
                                <div class="col-lg-12 mb25">
                                	<?php echo $err_msg; ?>
									<?php echo form_open('settings/password') ?>
                						<div class="form-group">
                                            <?php echo form_error('old'); ?>
                                         	<input type="password" name="old" placeholder="Old password" class="input-lg form-control">
                                     	</div>
                                      	<div class="form-group">
                                            <?php echo form_error('new'); ?>
                                      		<input type="password" name="new" placeholder="New password" class="input-lg form-control">
                                     	</div>
                                      	<div class="form-group">
                                            <?php echo form_error('confirm'); ?>
                                           	<input type="password" name="confirm" placeholder="Confirm password" class="input-lg form-control">
                                      	</div>
                                        
                                        <button type="submit" class="btn btn-primary stepy-finish pull-left"><i class="ti-share mr5"></i> Update Photo</button>
                                    <?php echo form_close() ?>
                               	</div>
                                
                            </div>
                            
                            <div class="col-md-4">