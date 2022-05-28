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
                                    	<h2><i class="ti-pencil"></i> Manage Leagues</h2>
                                    </div>
                                </div>
                                
                                <div class="col-lg-12">
                                	<?php echo $err_msg; ?>
                                  
									<?php echo form_open('leagues/add') ?>
                                        <div class="form-group mr5">
                                            <input name="league_id" type="hidden" value="<?php if(!empty($e_id)){echo $e_id;} ?>">
                                            <input name="name" type="text" placeholder="League Name" class="form-control input-lg" value="<?php if(!empty($e_name)){echo $e_name;} ?>" required="required">
                                        </div>
                                        <div class="form-group mr5">
                                            <input name="slogan" type="text" placeholder="League Slogan (if any)" class="form-control input-lg" value="<?php if(!empty($e_slogan)){echo $e_slogan;} ?>">
                                        </div>
                                        
                                        <button type="submit" class="btn btn-info btn-lg"><i class="ti-pencil"></i> Update Record</button><br /><br />
                                      <?php echo form_close() ?>
                                </div>
                                
                                <?php
									$dir_list = '';
									if(!empty($allleague)){
										foreach($allleague as $league){
											//only admin can see delete
											if(strtolower($log_user_role) == 'administrator'){
												$del_btn = '<a href="'.base_url().'leagues/add?del='.$league->id.'" class="btn btn-danger btn-xs"><i class="fa fa-times"></i> <b>Delete</b></a>';
											} else {$del_btn = '';}
											
											$dir_list .= '
												<tr>
													<td>'.ucwords($league->name).'</td>
													<td>'.$league->slogan.'</td>
													<td>
														<a href="'.base_url().'leagues/add?edit='.$league->id.'" class="btn btn-primary btn-xs"><i class="ti-pencil"></i> <b>Edit</b></a>
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
                                            <h5><i class="ti-pencil"></i> Leagues</h5>
                                        </header>
                                        <div class="panel-body">
                                            <div class="table-responsive no-border">
                                                <table id="sfhtblist" class="table table-bordered table-striped mg-t datatable">
                                                    <thead>
                                                        <tr>
                                                            <th>Name</th>
                                                            <th>Slogan</th>
                                                            <th width="120">Manage</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    	<?php echo $dir_list; ?>
                                                    </tbody>
                                                    <tfoot>
                                                    	<tr>
                                                            <th>Name</th>
                                                            <th>Slogan</th>
                                                            <th>Manage</th>
                                                        </tr>
                                                    </tfoot>
                                                </table>
                                            </div>
                                        </div>
                                    </section>
                                </div>
                            </div>
                            
                            <div class="col-md-4">