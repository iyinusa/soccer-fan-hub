<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Fans extends CI_Controller {

	function __construct()
    {
        parent::__construct();
		$this->load->model('users'); //load MODEL
		$this->load->model('m_clubs'); //load MODEL
		$this->load->model('m_moots'); //load MODEL
		$this->load->helper('text'); //for content limiter
		
		//mail config settings
		$this->load->library('email'); //load email library
		//$config['protocol'] = 'sendmail';
		//$config['mailpath'] = '/usr/sbin/sendmail';
		//$config['charset'] = 'iso-8859-1';
		//$config['wordwrap'] = TRUE;
		
		//$this->email->initialize($config);
    }
	
	public function index()
	{
		$all_fan = $this->users->query_all_user();
		if(!empty($all_fan)) {
			$data['allfan'] = $all_fan;
		}
		
		$all_club = $this->m_clubs->query_all_club();
		if(!empty($all_club)) {
			$data['allclub'] = $all_club;
		}
		
		$all_country = $this->users->query_country_user();
		if(!empty($all_country)) {
			$data['allcountry'] = $all_country;
		}
		
		$data['title'] = 'Fans | SoccerFanHub';
		$data['page_active'] = 'fans';
		
		$this->load->view('designs/header', $data);
		$this->load->view('fans/fans', $data);
		$this->load->view('designs/footer', $data);
	}
	
	public function view($fan)
	{
		if(!empty($fan)) {
			$this->session->set_userdata('sfh_view_nicename', $fan);
		}
		
		$single_fan = $this->users->query_single_user($fan);
		if(!empty($single_fan)) {
			foreach($single_fan as $row) {
				$row_pics = $row->pics;
				$row_pics_small = $row->pics_small;
				
				if($row_pics=='' || file_exists(FCPATH.$row_pics)==FALSE){$row_pics='img/avatar.jpg';}
				if($row_pics_small=='' || file_exists(FCPATH.$row_pics_small)==FALSE){$row_pics_small='img/avatar.jpg';}
				
				$data['fan_id'] = $row->ID;
				$data['title'] = ucwords($row->display_name).' | SoccerFanHub';
				$data['fan_display_name'] = ucwords($row->display_name);
				$data['fan_nicename'] = $row->user_nicename;
				$data['fan_pics'] = $row_pics;
				$data['fan_pics_small'] = $row_pics_small;
				$data['fan_country'] = $row->country;
				$data['fan_club_id'] = $row->club_id;
				$data['fan_club_ban'] = $row->club_ban;
				$data['fan_global_code'] = $row->global_code;
				$data['fan_verified'] = $row->verified;
				$data['fan_city'] = $row->city;
				$data['fan_bio'] = $row->bio;
				$data['fan_sex'] = $row->sex;
				$data['fan_email'] = $row->user_email;
				$data['fan_website'] = $row->website;
				$data['fan_fb_page'] = $row->fb_page;
				$data['fan_twitter_page'] = $row->twitter_page;
				$data['fan_linkedin_page'] = $row->linkedin_page;
				
				if(!empty($row->city)){$location = $row->city.', '.$row->country;} else {$location = $row->country;}
				$data['fan_location'] = $location;
				
				//query fan quota
				$cal_quota = 0;
				$user_quota = $this->users->query_user_quota($row->ID);
				if(empty($user_quota)){
					$cal_quota = 0;	
				} else {
					foreach($user_quota as $quota){
						$cal_quota += $quota->point;
					}
				}
				
				//query all quota
				$all_cal_quota = 0;
				$all_user_quota = $this->users->query_all_user_quota();
				if(empty($all_user_quota)){
					$all_cal_quota = 0;	
				} else {
					foreach($all_user_quota as $all_quota){
						$all_cal_quota += $all_quota->point;
					}
				}
				
				$quota_perc = number_format((($cal_quota / ($all_cal_quota - $cal_quota)) * 100),2); //get parcentage of quota
				$data['fan_quota'] = $quota_perc;
				$data['fan_quota_value'] = $cal_quota;
				$data['all_quota_value'] = $all_cal_quota;
				
				//get wallet
				$conv_dollar = $cal_quota / 199.39; //convert to dollar
				$data['wallet'] = number_format($cal_quota,2);
				$data['wallet_dollar'] = number_format($conv_dollar,2);
				
				//compute strength legends
				if($quota_perc >= 0.00 && $quota_perc <= 20.00){
					$data['fan_quota_stripe'] = 'danger';
					$data['fan_quota_icon'] = 'fa fa-circle-o';
				} else if($quota_perc > 20.00 && $quota_perc <= 40.00){
					$data['fan_quota_stripe'] = 'warning';
					$data['fan_quota_icon'] = 'fa fa-paper-plane-o';
				} else if($quota_perc > 40.00 && $quota_perc <= 60.00){
					$data['fan_quota_stripe'] = 'primary';
					$data['fan_quota_icon'] = 'fa fa-star-o';
				} else if($quota_perc > 60.00 && $quota_perc <= 80.00){
					$data['fan_quota_stripe'] = 'info';
					$data['fan_quota_icon'] = 'fa fa-moon-o';
				} else if($quota_perc > 80.00 && $quota_perc <= 100.00){
					$data['fan_quota_stripe'] = 'success';
					$data['fan_quota_icon'] = 'fa fa-sun-o';
				} else {
					$data['fan_quota_stripe'] = 'success';	
					$data['fan_quota_icon'] = 'fa fa-sun-o';
				}
				
				//get club
				$gclub = $this->m_clubs->query_single_club_id($row->club_id);
				if(!empty($gclub)){
					foreach($gclub as $gclub){
						$data['fan_club_name'] = $gclub->name;
						$data['fan_club_slug'] = $gclub->slug;
					}
				} else {$data['fan_club_name'] = 'No Club'; $data['fan_club_slug'] = 'no_club';}
				
				//query fan moots
				$data['allmoots'] = $this->m_moots->query_moot_fan($row->ID);
				$data['fan_moot_count'] = count($this->m_moots->query_moot_fan($row->ID));
				$data['fan_moot_reply_count'] = count($this->m_moots->query_moot_reply_fan($row->ID));
				$data['fan_moot_club_count'] = count($this->m_moots->query_moot_club($row->club_id));
				
				$this->session->set_userdata('sfh_view_id', $row->ID);
			}
		} else {redirect(base_url().'fans/', 'refresh');}
		
		$data['page_active'] = 'fan';
		
		$this->load->view('designs/header', $data);
		$this->load->view('fans/view', $data);
		$this->load->view('designs/footer', $data);
	}
	
	function activity_comment() {
		if($_POST) {
			$component = $_POST['component'];
			$item_id = $_POST['item_id'];
			$second_item_id = $_POST['second_item_id'];
			$com = $_POST['com'];
			
			$now = date("Y-m-d H:i:s");
			$primary_link = '';
			$type = '';
			$action = '';
			
			$itc_member_page = base_url().'geek/';
			$itc_group_page = base_url().'group/';
			$itc_article_page = base_url().'article/';
			$itc_forum_page = base_url().'forum/';
			$itc_setting_page = base_url().'setting/';
			
			$log_display_name = $this->session->userdata('itc_display_name');
			$log_user_nicename = $this->session->userdata('itc_user_nicename');
			
			if($com != '') {
				//post to comment of either forum or article
				if($component=='groups' || $component=='forums'){
					$get_forum = $this->forum->query_forum_id($item_id);
					if(!empty($get_forum)){
						foreach($get_forum as $f_item){
							$f_title = $f_item->post_title;	
							$f_slug = $f_item->slug;
						}
					}
					
					$type = 'new_forum_comment';
					$action = '
						<a href="'.$itc_member_page.$log_user_nicename.'">'.$log_display_name.'</a> replied to forum 
						<a href="'.$itc_forum_page.$f_slug.'">'.$f_title.'</a>
					';
					$primary_link = $itc_forum_page.$f_slug;
					
					$reg_data = array(
						'user_id' => $this->session->userdata('itc_id'),
						'comment_post_ID' => $item_id,
						'comment_date' => $now,
						'comment_date_gmt' => $now,
						'comment_content' => $com,
						'comment_approved' => 1,
						'comment_parent' => 0
					);
					
					//add record
					if($this->forum->reg_forum_comment($reg_data)) {
						//echo '<div class="alert alert-info">Comment successful</div>';
					} else {
						echo '<div class="alert alert-danger">There is problem this time. Please try later</div>';
					}
				} else if($component=='blogs' || $component=='articles') {
					$get_article = $this->article->query_article_id($item_id);
					if(!empty($get_article)){
						foreach($get_article as $a_item){
							$a_title = $a_item->post_title;	
							$a_slug = $a_item->slug;
						}
					}
					
					$type = 'new_article_comment';
					$action = '
						<a href="'.$itc_member_page.$log_user_nicename.'">'.$log_display_name.'</a> replied to article  
						<a href="'.$itc_article_page.$a_slug.'">'.$a_title.'</a>
					';
					$primary_link = $itc_article_page.$a_slug;
					
					$reg_data = array(
						'user_id' => $this->session->userdata('itc_id'),
						'comment_post_ID' => $item_id,
						'comment_date' => $now,
						'comment_date_gmt' => $now,
						'comment_content' => $com,
						'comment_approved' => 1,
						'comment_parent' => 0
					);
					
					//add record
					if($this->article->reg_article_comment($reg_data)) {
						//echo '<div class="alert alert-info">Comment successful</div>';
					} else {
						echo '<div class="alert alert-danger">There is problem this time. Please try later</div>';
					}
				}
				
				//now post comment to activity
				if($type==''){$type = 'activity_comment';}
				if($primary_link==''){$primary_link = $itc_member_page.$log_user_nicename;}
				if($action==''){
					$action = '<a href="'.$itc_member_page.$log_user_nicename.'">'.$log_display_name.'</a> posted a new activity comment';
				}
				
				$act_data = array(
					'user_id' => $this->session->userdata('itc_id'),
					'component' => $component,
					'type' => $type,
					'action' => $action,
					'content' => $com,
					'primary_link' => $primary_link,
					'item_id' => $item_id,
					'secondary_item_id' => $second_item_id,
					'date_recorded' => $now,
					'hide_sitewide' => 0,
					'mptt_left' => 0,
					'mptt_right' => 0,
					'is_spam' => 0,
				);
				
				//add record
				if($this->user->reg_activity($act_data)) {
					echo '<div class="alert alert-info">Successful</div>';
				} else {
					echo '<div class="alert alert-danger">There is problem this time. Please try later</div>';
				}
			}
		}
	}
	
	function activity_delete() {
		if($_POST) {
			$activity_id = $_POST['activity_id'];
			
			if($activity_id!='') {
				//remove record
				if($this->user->delete_activity($activity_id)) {
					echo 'Removed';
				} else {
					echo '<div class="alert alert-danger">There is problem this time. Please try later</div>';
				}	
			}
		}
	}
	
	public function verify_fan(){
		if($_POST){
			if(strtolower($this->session->userdata('sfh_user_role'))){
				$fanemail = $_POST['fanemail'];
				$fanid = $_POST['fanid'];
				
				$update_data = array(
					'verified' => 1
				);
				
				if($this->users->update_user($fanid, $update_data) > 0){
					//send notification mail to admin
					$this->email->clear(); //clear initial email variables
					$this->email->to($fanemail);
					$this->email->from('info@soccerfanhub.com','SoccerFanHub');
					$this->email->subject('Congratulations!!! Fan Profile Verified');
					
					//compose html body of mail
					$mail_subhead = 'Fan Profile Verified';
					$body_msg = '
						Congratulations, your Fan Profile page now Verified as a Global Fan.<br /><br />Thanks
					';
					
					$mail_data = array('message'=>$body_msg, 'subhead'=>$mail_subhead);
					$this->email->set_mailtype("html"); //use HTML format
					$mail_design = $this->load->view('designs/email_template', $mail_data, TRUE);
	
					$this->email->message($mail_design);
					
					if($this->email->send()) {
						echo '<h5 class="alert alert-success">Verified</h5>';	
					} else {
						echo '<h5 class="alert alert-warning">Please try later.</h5>';
					}
				} else {
					echo '<h5 class="alert alert-warning">Please try later</h5>';
				}
			}
		}exit;
	}
	
	function add_friend() {
		if($_POST) {
			$friend_id = $_POST['friend_id'];
			$send_id = $this->session->userdata('itc_id');
			$now = date("Y-m-d H:i:s");
			
			if($friend_id!=''){
				//check request already sent
				$check_req = mysql_query("SELECT * FROM nc_bp_friends WHERE (initiator_user_id='$friend_id' AND friend_user_id='$send_id') OR (initiator_user_id='$send_id' AND friend_user_id='$friend_id') AND is_confirmed=0 LIMIT 1");
				if(mysql_num_rows($check_req) > 0){
					echo 'Awaiting approval';
				} else {
					$reg_data = array(
						'initiator_user_id' => $send_id,
						'friend_user_id' => $friend_id,
						'is_confirmed' => 0,
						'is_limited' => 0,
						'date_created' => $now
					);
					
					$reg_id = $this->user->reg_friend($reg_data); //last saved id
					
					//get sender details
					$log_display_name = ucwords($this->session->userdata('itc_display_name'));
					$log_user_nicename = $this->session->userdata('itc_user_nicename');
					$log_user_email = $this->session->userdata('itc_user_email');
					$log_user_pics_small = $this->session->userdata('itc_user_pics_small');
					
					//get receiver details
					$receiver = $this->user->query_single_user_id($friend_id);
					if(!empty($receiver)){
						if($reg_id > 0) {
							foreach($receiver as $receive) {
								$receiver_email = $receive->user_email;
								$receiver_display_name = $receive->display_name;
								$receiver_nicename = $receive->user_nicename;	
							}
							
							//save notification
							$notify_data = array(
								'user_id' => $friend_id,
								'item_id' => $send_id,
								'component_name' => 'friends',
								'component_action' => 'friendship_request',
								'date_notified' => $now,
								'date_group' => date("F Y",strtotime($now)),
								'is_new' => 1
							);
							
							//add notify record
							if($this->user->reg_notify($notify_data)) {}
							
							//send notification mail
							$this->email->clear(); //clear initial email variables
							$this->email->to($receiver_email);
							$this->email->from('info@itcerebral.com','ITCerebral');
							$this->email->subject($log_display_name.' wants to be your friend on ITCerebral');
							
							//compose html body of mail
							$mail_subhead = 'Friend Request';
							$body_msg = '
								<img alt="'.$log_display_name.'" src="'.base_url().$log_user_pics_small.'" style="float:left; margin-right:10px;" />
								<a href="'.base_url().'geek/'.$log_user_nicename.'">'.$log_display_name.'</a> wants to be your friend on ITCerebral<br /><br />
								<b><a href="'.base_url().'notifications/friend?request='.$friend_id.'&sent='.$send_id.'">Confirm Request</a></b>
							';
							
							$mail_data = array('message'=>$body_msg, 'subhead'=>$mail_subhead);
							$this->email->set_mailtype("html"); //use HTML format
							$mail_design = $this->load->view('designs/email_template', $mail_data, TRUE);
		 
							$this->email->message($mail_design);
							
							if($this->email->send()) {
								echo 'Request sent';
							} else {
								//echo 'Request sent with mail';
							}
						}
					} else {
						echo 'Try later';
					}
				}
			}
		}
	}
	
	function remove_friend() {
		if($_POST) {
			$friend_id = $_POST['friend_id'];
			
			if($friend_id!=''){
				if($this->user->delete_friend($friend_id)) {
					echo 'Unfriend';
				} else {
					echo 'Try later';
				}
			}
		}
	}
	
	function add_follow() {
		if($_POST) {
			$follow_id = $_POST['follow_id'];
			$now = date("Y-m-d H:i:s");
			
			if($follow_id!=''){
				$reg_data = array(
					'follower_id' => $this->session->userdata('itc_id'),
					'leader_id' => $follow_id
				);
				
				if($this->user->reg_follow($reg_data)) {
					//get sender details
					$log_display_name = ucwords($this->session->userdata('itc_display_name'));
					$log_user_nicename = $this->session->userdata('itc_user_nicename');
					$log_user_email = $this->session->userdata('itc_user_email');
					$log_user_pics_small = $this->session->userdata('itc_user_pics_small');
					
					//get receiver details
					$receiver = $this->user->query_single_user_id($follow_id);
					if(!empty($receiver)){
						foreach($receiver as $receive) {
							$receiver_email = $receive->user_email;
							$receiver_display_name = $receive->display_name;
							$receiver_nicename = $receive->user_nicename;	
						}
						
						//save notification
						$date_group = date("F Y",strtotime($now));
						$n_data = array(
							'user_id' => $follow_id,
							'item_id' => $this->session->userdata('itc_id'),
							'component_name' => 'follow',
							'component_action' => 'new_follow',
							'date_notified' => $now,
							'date_group' => $date_group,
							'is_new' => 1
						);
						
						//add notify record
						$this->user->reg_notify($n_data);
						
						//send notification mail
						$this->email->clear(); //clear initial email variables
						$this->email->to($receiver_email);
						$this->email->from('info@itcerebral.com','ITCerebral');
						$this->email->subject($log_display_name.' now following you on ITCerebral');
						
						//compose html body of mail
						$mail_subhead = 'New Follower';
						$body_msg = '
							<img alt="'.$log_display_name.'" src="'.base_url().$log_user_pics_small.'" style="float:left; margin-right:10px;" />
							<a href="'.base_url().'geek/'.$log_user_nicename.'">'.$log_display_name.'</a> is now following your activities on ITCerebral.</b>
						';
						
						$mail_data = array('message'=>$body_msg, 'subhead'=>$mail_subhead);
						$this->email->set_mailtype("html"); //use HTML format
						$mail_design = $this->load->view('designs/email_template', $mail_data, TRUE);
	 
						$this->email->message($mail_design);
						
						if($this->email->send()) {
							echo 'Following';
						} else {
							echo 'Following.';
						}
					} else {
						echo 'Try later';
					}
				} else {
					echo 'Try later';
				}
			}
		}
	}
	
	function remove_follow() {
		if($_POST) {
			$follow_id = $_POST['follow_id'];
			
			if($follow_id!=''){
				if($this->user->delete_follow($follow_id)) {
					echo 'Unfollowed';
				} else {
					echo 'Try later';
				}
			}
		}
	}
}