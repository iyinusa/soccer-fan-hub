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
                                	<div class="col-xs-6">
                                    	<h2><i class="fa fa-users"></i> Manage Users</h2>
                                    </div>
                                </div>
                                
                                <div class="col-lg-12">
                                	<?php echo $err_msg; ?>
                                  
									<?php if(!empty($e_id)){ ?>
										<?php echo form_open('admin/accounts') ?>
                                            <div class="form-group mr5">
                                                <input name="user_id" type="hidden" value="<?php if(!empty($e_id)){echo $e_id;} ?>">
                                                <?php if(!empty($e_name)){echo $e_name;} ?>
                                            </div>
                                            <div class="form-group mr5">
                                                <?php if(!empty($e_display_name)){echo $e_display_name;} ?>
                                            </div>
                                            <div class="form-group mr5">
                                                <select data-placeholder="Role" class="form-control chosen" name="role">
                                                    <option value="<?php if(!empty($e_role)){echo $e_role;} ?>">Select Role</option>
                                                    <option value="User">User</option>
                                                    <option value="Editor">Editor</option>
                                                    <option value="Administrator">Administrator</option>
                                                </select>
                                            </div>
                                            <div class="form-inline mr5">
                                                <div class="form-group">
                                                	<label>Points</label><br />
                                                    <input type="text" name="point" class="form-control" value="<?php if(!empty($e_points)){echo $e_points;} ?>" readonly="readonly" />
                                                </div>
                                                <div class="form-group">
                                                	<label>Give Points</label><br />
                                                    <input type="text" name="point" class="form-control" />
                                                </div>
                                                <div class="form-group">
                                                	<label>Purpose</label><br />
                                                    <input type="text" name="purpose" class="form-control" />
                                                </div>
                                            </div><hr />
                                            
                                            <button type="submit" class="btn btn-info btn-lg"><i class="ti-pencil"></i> Update Record</button><br /><br />
                                        <?php echo form_close() ?>
                                    <?php } ?>
                                </div>
                                
                                <?php
									$ins =& get_instance();
									$ins->load->model('m_clubs');
									$dir_list = '';
									if(!empty($alluser)){
										foreach($alluser as $user){
											//only admin can see delete
											if(strtolower($log_user_role) == 'administrator'){
												$del_btn = '<a href="'.base_url().'admin/accounts?del='.$user->ID.'" class="btn btn-danger btn-xs"><i class="fa fa-times"></i> <b>Delete</b></a>';
											} else {$del_btn = '';}
											
											if($user->pics_small=='' || file_exists(FCPATH.$user->pics_small)==FALSE){$user_pics='img/avatar.jpg';}else{$user_pics = $user->pics_small;}
											
											//get club details
											$gc = $ins->m_clubs->query_single_club_id($user->club_id);
											if(!empty($gc)){
												foreach($gc as $c){
													$club_name = $c->name;	
												}
											} else {$club_name = 'No Club';}
											if($user->club_ban==0){$club_status='';}else{$club_status=' (Ban)';}
											
											$dir_list .= '
												<tr>
													<td><img alt="" src="'.base_url($user_pics).'" class="avatar img-circle" width="50" /></td>
													<td><a href="'.base_url('fan/'.$user->user_nicename).'">'.ucwords($user->display_name).'</a></td>
													<td>'.$user->sex.'</td>
													<td>'.$user->country.'</td>
													<td>'.$club_name.$club_status.'</td>
													<td>'.$user->role.'</td>
													<td>
														<a href="'.base_url().'admin/accounts?edit='.$user->ID.'" class="btn btn-primary btn-xs"><i class="ti-pencil"></i> <b>Edit</b></a>
														'.$del_btn.'
													</td>
												</tr>
											';	
										}
									}
								?>
                                
                                <div class="col-lg-12">
                                	<section class="panel panel-default">
                                        <header class="panel-heading">
                                            <h5><i class="fa fa-users"></i> Users Account</h5>
                                        </header>
                                        <div class="panel-body">
                                            <div class="table-responsive no-border">
                                                <table id="sfhtblist" class="table table-bordered table-striped mg-t datatable">
                                                    <thead>
                                                        <tr>
                                                            <th width="50">Photo</th>
                                                            <th>Name</th>
                                                            <th>Sex</th>
                                                            <th>Country</th>
                                                            <th>Club</th>
                                                            <th>Role</th>
                                                            <th width="120">Manage</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    	<?php echo $dir_list; ?>
                                                    </tbody>
                                                    <tfoot>
                                                    	<tr>
                                                            <th>Photo</th>
                                                            <th>Name</th>
                                                            <th>Sex</th>
                                                            <th>Country</th>
                                                            <th>Club</th>
                                                            <th>Role</th>
                                                            <th width="120">Manage</th>
                                                        </tr>
                                                    </tfoot>
                                                </table>
                                            </div>
                                        </div>
                                    </section>
                                </div>
                            </div>
                            
                            <div class="col-md-4">