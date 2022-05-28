<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	$m_obj =& get_instance();
	$m_obj->load->model('users');
	
	$sfh_fan_page = base_url().'fan/';
	$sfh_club_page = base_url().'club/';
	$sfh_setting_page = base_url().'settings/';
	$sfh_notification_page = base_url().'notifications/';
	
	$log_user = $this->session->userdata('logged_in');
	
	$sfh_view_nicename = $this->session->userdata('sfh_view_nicename');
	$sfh_view_id = $this->session->userdata('sfh_view_id');
	
	$sfh_nairatodollar = 199;
	
	if($log_user == FALSE) {
		$user_menu ='
			<li style="padding:10px;">
				<a class="btn btn-inverse" data-toggle="modal" href="#model_login">Sign In</a>
			</li>
		';
		$user_notification = '<button type="button" class="btn btn-link pull-left nav-toggle visible-xs" data-toggle="class:slide-nav slide-nav-left" data-target="body"> <i class="fa fa-bars fa-lg text-default"></i> </button>';
		$add = '';
		$follow = '';
		$post_forum = '';
		$post_article = '';
		
		$log_user_nicename = '';
		$log_user_id = '';
		$log_display_name = '';
		$log_user_email = '';
		$log_user_pics = '';
		$log_user_pics_small = '';
		$log_user_country = '';
		$log_user_club_id = '';
		$log_user_club_ban = '';
		$log_user_global_code = '';
		$log_user_verified = '';
		$log_user_sex = '';
		$log_user_dob = '';
		$log_user_address = '';
		$log_user_bio = '';
		$log_user_city = '';
		$log_user_phone = '';
		$log_user_website = '';
		$log_user_facebook = '';
		$log_user_twitter = '';
		$log_user_linkedin = '';
		$log_user_role = '';
		$log_user_pro = '';
	} else {
		$log_user_id = $this->session->userdata('sfh_id');
		$log_display_name = ucwords($this->session->userdata('sfh_display_name'));
		$log_user_nicename = $this->session->userdata('sfh_user_nicename');
		$log_user_email = $this->session->userdata('sfh_user_email');
		$log_user_pics = $this->session->userdata('sfh_user_pics');
		$log_user_pics_small = $this->session->userdata('sfh_user_pics_small');
		$log_user_country = $this->session->userdata('sfh_user_country');
		$log_user_club_id = $this->session->userdata('sfh_user_club_id');
		$log_user_club_ban = $this->session->userdata('sfh_user_club_ban');
		$log_user_global_code = $this->session->userdata('sfh_user_global_code');
		$log_user_verified = $this->session->userdata('sfh_user_verified');
		$log_user_sex = $this->session->userdata('sfh_user_sex');
		$log_user_dob = $this->session->userdata('sfh_user_dob');
		$log_user_address = $this->session->userdata('sfh_user_address');
		$log_user_bio = $this->session->userdata('sfh_user_bio');
		$log_user_city = $this->session->userdata('sfh_user_city');
		$log_user_phone = $this->session->userdata('sfh_user_phone');
		$log_user_website = $this->session->userdata('sfh_user_website');
		$log_user_facebook = $this->session->userdata('sfh_user_facebook');
		$log_user_twitter = $this->session->userdata('sfh_user_twitter');
		$log_user_linkedin = $this->session->userdata('sfh_user_linkedin');
		$log_user_role = strtolower($this->session->userdata('sfh_user_role'));
		$log_user_pro = $this->session->userdata('sfh_user_pro');
		
		if($log_user_pics=='' || file_exists(FCPATH.$log_user_pics)==FALSE){$log_user_pics='img/avatar.jpg';}
		if($log_user_pics_small=='' || file_exists(FCPATH.$log_user_pics_small)==FALSE){$log_user_pics_small='img/avatar.jpg';}
		
	}