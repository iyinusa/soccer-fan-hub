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
                                    	<h2><i class="fa fa-users"></i> Fans</h2>
                                    </div>
                                    
                                    <div class="col-xs-6 text-right">
                                        <div class="btn-group mr5 mt10">
                                            <button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown"><i class="ti-world"></i> Country
                                                <span class="ti-angle-down ml10"></span>
                                            </button>
                                            <?php
												$inl =& get_instance();
												$inl->load->model('m_clubs');
												$inl->load->model('users');
												$count_fan_all = 0;
												$count_fan_all = count($inl->users->query_all_user());
											?>
											
											<?php
												$reg_country_list = '';
												$count_fan_country = 0;
												if(!empty($allcountry)){
													foreach($allcountry as $cfan){
														$count_fan_country = count($inl->users->query_user_by_country($cfan->country));
														$crp = str_replace(' ','-',strtolower($cfan->country)); 
														$reg_country_list .= '
															<li><a href="javascript:;" data-filter=".'.$crp.'">'.ucwords($cfan->country).' ('.$count_fan_country.')</a></li>
														';	
													}
												}
                                            ?>
                                            <ul class="dropdown-menu text-left filter" data-option-key="filter" role="menu" style="max-height:400px;">
                                                <li><a href="javascript:;" data-filter="*">All Country (<?php echo $count_fan_all; ?>)</a>
                                                </li>
                                                <?php echo $reg_country_list; ?>
                                            </ul>
                                        </div>
                                        
                                        <div class="btn-group mr5 mt10">
                                            <button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown"><i class="fa fa-trophy"></i> Club
                                                <span class="ti-angle-down ml10"></span>
                                            </button>
                                            <?php
												$club_list = '';
												$count_fan_item = 0;
												if(!empty($allclub)){
													foreach($allclub as $club){
														$count_fan_item = count($inl->m_clubs->query_club_fan($club->id));
														$club_list .= '
															<li><a href="javascript:;" data-filter=".'.$club->slug.'">'.ucwords($club->name).' ('.$count_fan_item.')</a>
														';	
													}
												}
                                            ?>
                                            <ul class="dropdown-menu text-left filter" data-option-key="filter" role="menu" style="max-height:400px; overflow:auto;">
                                                <li><a href="javascript:;" data-filter="*">All Clubs (<?php echo $count_fan_all; ?>)</a>
                                                </li>
                                                <?php echo $club_list; ?>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                
                                <hr class="col-lg-12 mb25" />
                                
                                <div class="switcher view-grid col-lg-12">
                                    <div class="row feed">
                                        <?php
											$ins_obj =& get_instance();
											$ins_obj->load->model('m_clubs');
											$fan_list = '';
											$club = '';
											$club_slug = '';
											if(!empty($allfan)){
												foreach($allfan as $fan){
													$club_id = $fan->club_id;
													
													if($fan->pics_small=='' || file_exists(FCPATH.$fan->pics_small)==FALSE){$fan_pics_small='img/avatar.jpg';} else {$fan_pics_small=$fan->pics_small;}
													
													if($fan->city==''){
														$fan_country = $fan->country;
													} else {
														$fan_country = $fan->city.', '.$fan->country;
													}
													
													$rp = str_replace(' ','-',strtolower($fan->country));
													
													//get club
													if($club_id==0){
														$club = 'No Club';
														$club_slug = '';
														$colour_b = '';
														$colour_f = '';
													} else {
														$gc = $this->m_clubs->query_single_club_id($club_id);
														if(!empty($gc)){
															foreach($gc as $citem){
																$club = $citem->name;
																$club_slug = $citem->slug;
																
																//get club colour code
																$sty_b = 'background-color:'.$citem->colour;
																$sty_f = 'color:'.$citem->fore_colour;
																$colour_b = 'style="'.$sty_b.'"';
																$colour_f = 'style="'.$sty_f.'"';
															}
														}
													}
													
													if($club == 'No Club'){$club_slug = 'null';}
													
													$fan_list .= '
														<div class="col-xs-12 col-sm-6 col-lg-4 switch-item '.$rp.' '.$club_slug.'">
															<section class="panel no-b">
																<div class="panel-body">
																	<a href="'.base_url('fan/'.$fan->user_nicename).'" class="show text-center">
																		<img width="128px" height="128px" src="'.base_url($fan_pics_small).'" class="avatar avatar-lg" alt="">
																	</a>
							
																	<div class="show mt15 mb15 text-center">
																		<div class="h5"><a><b href="'.base_url('fan/'.$fan->user_nicename).'">'.$fan->display_name.'</b></a>
																		</div>
																		<p class="show text-muted">
																			'.$fan_country.'
																		</p>
																	</div>
							
																</div>
																<div class="panel-footer no-p no-b">
																	<div class="row no-m">
																		<div class="bg-default p10 text-center brbl" '.$colour_b.' '.$colour_f.'>
																			<b><a href="'.base_url('club/'.$club_slug).'" '.$colour_f.'>
																				<span class="ti-heart show mb5"></span>
																				'.$club.'
																			</a></b>
																		</div>
																	</div>
																</div>
															</section>
														</div>
													';
												}
											}
										?>
                                        
                                        <?php echo $fan_list; ?>
                                   	</div>
                               	</div>
                                
                                
                            </div>
                            
                            <div class="col-md-4">