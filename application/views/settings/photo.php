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
                                	<h2><i class="ti-camera"></i> Profile Photo</h2>
                                </div>
                                
                                <div class="col-lg-12 mb25">
                                	<?php echo $err_msg; ?>
									<?php echo form_open_multipart('settings/photo') ?>
                						<input type="hidden" name="user_id" value="<?php if(!empty($e_id)){echo $e_id;} ?>" />
                         				<input type="hidden" name="pics" value="<?php if(!empty($e_pics)){echo $e_pics;} ?>" />
                        				<input type="hidden" name="pics_small" value="<?php if(!empty($e_pics_small)){echo $e_pics_small;} ?>" />
                    					<input type="hidden" name="pics_square" value="nil" />
                                        
                                        <div class="form-group">
											<h6>Profile picture must be minimum of 400px X 400px</h6>
											<?php
                                                if(!empty($e_pics)){
                                                    echo '<img alt="" src="'.base_url($e_pics).'" style="max-width:100%;" /><br /><br />';	
                                                }
                                            ?>
                                            
                                            <input name="up_file" type="file" class="btn btn-default file-inputs btn-lg mr5" placeholder="Upload Logo">
                                        </div>
                                        
                                        <button type="submit" class="btn btn-primary stepy-finish pull-left"><i class="ti-share mr5"></i> Update Photo</button>
                                    <?php echo form_close() ?>
                               	</div>
                                
                            </div>
                            
                            <div class="col-md-4">