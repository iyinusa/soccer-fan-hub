<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Clubs extends CI_Controller {

	function __construct()
    {
        parent::__construct();
		$this->load->model('users'); //load MODEL
		$this->load->model('m_clubs'); //load MODEL
		$this->load->model('m_moots'); //load MODEL
		$this->load->model('m_leagues');
		$this->load->model('m_facts'); //load MODEL
		$this->load->library('form_validation');
		$this->load->helper('text'); //for content limiter
		$this->load->library('image_lib');
		
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
		$all_club = $this->m_clubs->query_all_club();
		if(!empty($all_club)) {
			$data['allclub'] = $all_club;
		}
		
		$all_league = $this->m_leagues->query_all_league();
		if(!empty($all_league)) {
			$data['allleague'] = $all_league;
		}
		
		$data['title'] = 'Clubs | SoccerFanHub';
		$data['page_active'] = 'clubs';
		
		$this->load->view('designs/header', $data);
		$this->load->view('clubs/clubs', $data);
		$this->load->view('designs/footer', $data);
	}
	
	public function view($club)
	{
		$data['club_msg'] = '';
		$data['allclubfact'] = '';
		$now = date("Y-m-d H:i:s");
		$now_group = date("F Y");
		$log_user_id = $this->session->userdata('sfh_id');
		$log_user_club_id = $this->session->userdata('sfh_user_club_id');
		$log_display_name = ucwords($this->session->userdata('sfh_display_name'));
		$log_user_pics_small = $this->session->userdata('sfh_user_pics_small');
		if($log_user_pics_small=='' || file_exists(FCPATH.$log_user_pics_small)==FALSE){$log_user_pics_small='img/avatar.jpg';}
		
		//check for join club
		$get_id = $this->input->get('join');
		if($get_id != ''){
			if($this->session->userdata('logged_in') == FALSE){redirect(base_url('clubs'), 'refresh');}
			
			if($log_user_club_id != 0 || $log_user_club_id == 1){
				$data['club_msg'] = '<br /><span>You already belong to a Club, or Banned</span><br />';	
			} else {
				//get club name
				$gcn = $this->m_clubs->query_single_club_id($get_id );
				if(!empty($gcn)){
					foreach($gcn as $cn){
						$club_name = $cn->name;	
					}
				} else {$club_name = 'No Club';}
				
				//update record
				$upd_data = array(
					'club_id' => $get_id
				);
				
				if($this->users->update_user($log_user_id, $upd_data) > 0){
					//add data to session
					$s_data = array (
						'sfh_user_club_id' => $get_id
					);
					
					$check = $this->session->set_userdata($s_data);
					
					//check if user already have point
					if(count($this->users->check_user_quota($log_user_id, 'Join club bonus')) <= 0){
						//try give fan 100 point on joining club
						$reg_point = array(
							'user_id' => $log_user_id,
							'point' => 100,
							'purpose' => 'Join club bonus',
							'reg_date' => $now
						);
						
						$this->users->reg_point($reg_point);	
					}
					
					//post moot for joined fan
					$reg_data = array(
						'fan_id' => $log_user_id,
						'club_id' => $get_id,
						'moot' => 'Hi Fans! - I just joined '.$club_name.' on SoccerFanHub.',
						'privacy' => 0,
						'status' => 1,
						'reg_date' => $now
					);
					
					$insert_id = $this->m_moots->reg_insert($reg_data);
					if($insert_id){
						//try register activity
						$reg_activity = array(
							'type' => 'join club',
							'fan_id' => $log_user_id,
							'p_id' => $insert_id,
							's_id' => $insert_id,
							'content' => $log_display_name.' is now a Fan of '.$club_name.' on SoccerFanHub.',
							'reg_date' => $now
						);
						
						$this->users->reg_activity($reg_activity);
						
						//try send mail to all fans
						$gall = $this->users->query_all_user();
						foreach($gall as $all){
							if($log_user_id != $all->ID){
								//try register notification
								$reg_notify = array(
									'type' => 'join club',
									'fan_id' => $log_user_id,
									'receive_id' => $all->ID,
									'p_id' => $insert_id,
									's_id' => $insert_id,
									'content' => $log_display_name.' is now a Fan of '.$club_name.' on SoccerFanHub.',
									'reg_date' => $now,
									'date_group' => $now_group
								);
								
								$this->users->reg_notification($reg_notify);
								
								/////////////////////////////////////////////////////////////////////////////////////
								//send notification mail to all fans
								$this->email->clear(); //clear initial email variables
								$this->email->to($all->user_email);
								$this->email->from('info@soccerfanhub.com','SoccerFanHub');
								$this->email->subject($club_name.' has a New Fan on SoccerFanHub');
								
								//compose html body of mail
								$mail_subhead = $log_display_name.' joined '.$club_name.' on SoccerFanHub';
								$body_msg = '
									<div style="overflow:auto;">
									<img alt="" src="'.base_url($log_user_pics_small).'" width="50px" style="float:left; margin-right:10px;" />
									'.$log_display_name.' just became a Fan of '.$club_name.' on SoccerFanHub.<br /><br />Welcome Fan with a Moot Reply.<br /><br /></div>
									<a href="'.base_url('moot/'.$insert_id).'" class="email_btn">View Now</a>
								';
								
								$mail_data = array('message'=>$body_msg, 'subhead'=>$mail_subhead);
								$this->email->set_mailtype("html"); //use HTML format
								$mail_design = $this->load->view('designs/email_template', $mail_data, TRUE);
			 
								$this->email->message($mail_design);
								
								if($this->email->send()) {}
							}
						}
					}
					
					$data['club_msg'] = '<br /><span>Joined</span><br />';
					redirect(base_url('club/'.$club), 'refresh');
				} else {
					$data['club_msg'] = '<br /><span>Try Later</span><br />';
				}
			}
		}
		
		//check for leave club
		$leave_id = $this->input->get('leave');
		if($leave_id != ''){
			if($this->session->userdata('logged_in') == FALSE){redirect(base_url('clubs'), 'refresh');}
			
			//get club name
			$glcn = $this->m_clubs->query_single_club_id($leave_id );
			if(!empty($glcn)){
				foreach($glcn as $lcn){
					$l_club_name = $lcn->name;	
				}
			} else {$l_club_name = 'No Club';}
			
			//update record
			$upd_data = array(
				'club_id' => 0
			);
			
			if($this->users->update_user($log_user_id, $upd_data) > 0){
				//add data to session
				$s_data = array (
					'sfh_user_club_id' => 0
				);
				$check = $this->session->set_userdata($s_data);
				
				//post moot for decamp fan
				$reg_data = array(
					'fan_id' => $log_user_id,
					'club_id' => $leave_id,
					'moot' => 'Hi Fans! - I just decamped from '.$l_club_name.' on SoccerFanHub.',
					'privacy' => 0,
					'status' => 1,
					'reg_date' => $now
				);
				
				$insert_id = $this->m_moots->reg_insert($reg_data);
				if($insert_id){
					//try register activity
					$reg_activity = array(
						'type' => 'leave club',
						'fan_id' => $log_user_id,
						'p_id' => $insert_id,
						's_id' => $insert_id,
						'content' => $log_display_name.' just decamped from '.$l_club_name.' on SoccerFanHub.',
						'reg_date' => $now
					);
					
					$this->users->reg_activity($reg_activity);
					
					//try send mail to all fans
					$gall = $this->users->query_all_user();
					foreach($gall as $all){
						if($log_user_id != $all->ID){
							//try register notification
							$reg_notify = array(
								'type' => 'leave club',
								'fan_id' => $log_user_id,
								'receive_id' => $all->ID,
								'p_id' => $insert_id,
								's_id' => $insert_id,
								'content' => $log_display_name.' just decamped from '.$l_club_name.' on SoccerFanHub.',
								'reg_date' => $now,
								'date_group' => $now_group
							);
							
							$this->users->reg_notification($reg_notify);
							
							/////////////////////////////////////////////////////////////////////////////////////
							//send notification mail to all fans
							$this->email->clear(); //clear initial email variables
							$this->email->to($all->user_email);
							$this->email->from('info@soccerfanhub.com','SoccerFanHub');
							$this->email->subject($l_club_name.' Fan decamped on SoccerFanHub');
							
							//compose html body of mail
							$mail_subhead = $log_display_name.' decamped from '.$l_club_name.' on SoccerFanHub';
							$body_msg = '
								<div style="overflow:auto;">
								<img alt="" src="'.base_url($log_user_pics_small).'" width="50px" style="float:left; margin-right:10px;" />
								'.$log_display_name.' just decamped from '.$l_club_name.' on SoccerFanHub.<br /><br />Ask Fan Why?.<br /><br /></div>
								<a href="'.base_url('moot/'.$insert_id).'" class="email_btn">View Now</a>
							';
							
							$mail_data = array('message'=>$body_msg, 'subhead'=>$mail_subhead);
							$this->email->set_mailtype("html"); //use HTML format
							$mail_design = $this->load->view('designs/email_template', $mail_data, TRUE);
		 
							$this->email->message($mail_design);
							
							if($this->email->send()) {}
						}
					}
				}
				
				redirect(base_url('club/'.$club), 'refresh');
			} else {
				$data['club_msg'] = '<br /><span>Try Later</span><br />';
			}
		}	
		
		$single_club = $this->m_clubs->query_single_club($club);
		if(!empty($single_club)) {
			foreach($single_club as $row) {
				$row_pics = $row->pics;
				$row_pics_square = $row->pics_square;
				
				if($row_pics=='' || file_exists(FCPATH.$row_pics)==FALSE){$row_pics='img/avatar.jpg';}
				if($row_pics_square=='' || file_exists(FCPATH.$row_pics_square)==FALSE){$row_pics_square='img/avatar.jpg';}
				
				$data['title'] = ucwords($row->name).' | SoccerFanHub';
				$data['club_id'] = $row->id;
				$data['club_name'] = ucwords($row->name);
				$data['club_pics'] = $row_pics;
				$data['club_pics_square'] = $row_pics_square;
				$data['club_slogan'] = $row->slogan;
				$data['club_slug'] = $row->slug;
				$data['club_bio'] = $row->details;
				$data['club_colour'] = $row->colour;
				$data['club_fore_colour'] = $row->fore_colour;
				
				//get league
				$gl = $this->m_leagues->query_league_id($row->league_id);
				if(!empty($gl)){
					foreach($gl as $litem){
						$data['club_league'] = $litem->name;
					}
				}
				
				//get facts
				$allclubfact = $this->m_facts->query_fact_club_id($row->id);
				if(!empty($allclubfact)){
					$data['allclubfact'] = $allclubfact;	
				}
				
				//get fans
				$data['club_fans_count'] = count($this->m_clubs->query_club_fans($row->id));
				$data['all_club_fans'] = $this->m_clubs->query_club_fans($row->id);
				
				//query fan moots
				$data['allmoots'] = $this->m_moots->query_moot_club($row->id);
				$data['club_moot_count'] = count($this->m_moots->query_moot_club($row->id));
				$data['club_moot_reply_count'] = count($this->m_moots->query_moot_reply_club($row->id));
				$data['club_moot_all'] = count($this->m_moots->query_all_moot());
			}
		} else {redirect(base_url().'clubs/', 'refresh');}
		
		$data['page_active'] = 'club';
		
		$this->load->view('designs/header', $data);
		$this->load->view('clubs/view', $data);
		$this->load->view('designs/footer', $data);
	}
	
	public function add(){
		if($this->session->userdata('logged_in') == TRUE){
			$log_role = $this->session->userdata('sfh_user_role');
			if(strtolower($log_role) != 'editor' && strtolower($log_role) != 'administrator'){
				redirect(base_url('fan/'.$this->session->userdata('sfh_nicename')), 'refresh');
			}
		} else {
			//register redirect page
			$s_data = array ('sfh_redirect' => uri_string());
			$this->session->set_userdata($s_data);
			redirect(base_url('login'), 'refresh');
		}
		
		//query leagues
		$data['allleague'] = $this->m_leagues->query_all_league();
		
		//check for update
		$get_id = $this->input->get('edit');
		if($get_id != ''){
			$gq = $this->m_clubs->query_single_club_id($get_id);
			foreach($gq as $item){
				$data['e_id'] = $item->id;
				$data['e_league_id'] = $item->league_id;
				$data['e_name'] = $item->name;
				$data['e_slug'] = $item->slug;
				$data['e_slogan'] = $item->slogan;
				$data['e_slug'] = $item->slug;
				$data['e_desc'] = $item->details;
				$data['e_colour'] = $item->colour;
				$data['e_fore_colour'] = $item->fore_colour;
				$data['e_pics'] = $item->pics;
				$data['e_pics_small'] = $item->pics_small;
				$data['e_pics_square'] = $item->pics_square;	
			}
		}
		
		//check record delete
		$del_id = $this->input->get('del');
		if($del_id != ''){
			//only admin can delete
			if(strtolower($log_role) != 'administrator'){
				redirect(base_url('clubs/add'), 'refresh');
			}
			
			if($this->m_clubs->delete_club($del_id) > 0){
				$data['err_msg'] = '<div class="alert alert-info"><h5>Deleted</h5></div>';
			} else {
				$data['err_msg'] = '<div class="alert alert-info"><h5>There is problem this time. Try later</h5></div>';
			}
		}
		
		//set form input rules 
		$this->form_validation->set_rules('name','Category','trim|required|xss_clean');
		
		$this->form_validation->set_error_delimiters('<div class="alert alert-warning no-radius no-margin padding-sm"><i class="fa fa-info-circle"></i>', '</div>'); //error delimeter
	  
	  	if ($this->form_validation->run() == FALSE)
		{
			$data['err_msg'] = '';
		}
		else
		{
			//check if ready for post
			if($_POST){
				$club_id = $_POST['club_id'];
				$league = $_POST['league'];
				$name = $_POST['name'];
				$bcolour = $_POST['bcolour'];
				$fcolour = $_POST['fcolour'];
				$bio = $_POST['bio'];
				$slogan = $_POST['slogan'];
				$pics = $_POST['pics'];
				$pics_small = $_POST['pics_small'];
				$pics_square = $_POST['pics_square'];
				$stamp = time();
				$save_path = '';
				$save_path400 = '';
				$save_path100 = '';
				
				//===get nicename and convert to seo friendly====
				$slug = strtolower($name);
				$slug = preg_replace("/[^a-z0-9_\s-]/", "", $slug);
				$slug = preg_replace("/[\s-]+/", " ", $slug);
				$slug = preg_replace("/[\s_]/", "-", $slug);
				//================================================
				
				if(isset($_FILES['up_file']['name'])){
					$path = 'img/clubs';
					 
					if (!is_dir($path))
						mkdir($path, 0755);
	 
					$pathMain = './img/clubs';
					if (!is_dir($pathMain))
						mkdir($pathMain, 0755);
	 
					$result = $this->do_upload("up_file", $pathMain);
	 
					if (!$result['status']){
						$data['err_msg'] ='<div class="alert alert-info"><h5>Can not upload Logo, try another</h5></div>';
					} else {
						$save_path = $path . '/' . $result['upload_data']['file_name'];
						
						//if size not up to 400px above
						if($result['image_width'] >= 400){
							if($result['image_width'] >= 400 || $result['image_height'] >= 400) {
								if($this->resize_image($pathMain . '/' . $result['upload_data']['file_name'], $stamp .'-400.gif','400','400', $result['image_width'], $result['image_height'])){
									$resize400 = $pathMain . '/' . $stamp.'-400.gif';
									$resize400_dest = $resize400;
									
									if($this->crop_image($resize400, $resize400_dest,'400','220')){
										$save_path400 = $path . '/' . $stamp .'-400.gif';
									}
								}
							}
								
							if($result['image_width'] >= 200 || $result['image_height'] >= 200){
								if($this->resize_image($pathMain . '/' . $result['upload_data']['file_name'], $stamp .'-150.gif','200','200', $result['image_width'], $result['image_height'])){
									$resize100 = $pathMain . '/' . $stamp.'-150.gif';
									$resize100_dest = $resize100;	
									
									if($this->crop_image($resize100, $resize100_dest,'150','150')){
										$save_path100 = $path . '/' . $stamp .'-150.gif';
									}
								}
							}
							
						} else {
							$data['err_msg'] = '<div class="alert alert-info"><h5>Must be at least 400px in Width</h5></div>';
						}
					}
				}
				
				//check if images loads
				if($pics && $pics_small && $pics_square){
					$save_path = $pics;
					$save_path400 = $pics_small;
					$save_path100 = $pics_square;
				}
				
				//prepare insert record
				if($save_path=='' && $save_path400=='' && $save_path100==''){
					if($club_id != ''){
						$upd_data = array(
							'league_id' => $league,
							'name' => $name,
							'slug' => $slug,
							'slogan' => $slogan,
							'details' => $bio,
							'colour' => $bcolour,
							'fore_colour' => $fcolour
						);
						
						if($this->m_clubs->update_club($club_id, $upd_data) > 0){
							$data['err_msg'] = '<div class="alert alert-info"><h5>Successfully</h5></div>';
						} else {
							$data['err_msg'] = '<div class="alert alert-info"><h5>There is problem this time. Try later</h5></div>';
						}
					}
				} else {
					//check for update
					if($club_id != ''){
						$upd_data = array(
							'league_id' => $league,
							'name' => $name,
							'slug' => $slug,
							'slogan' => $slogan,
							'details' => $bio,
							'colour' => $bcolour,
							'fore_colour' => $fcolour,
							'pics' => $save_path,
							'pics_small' => $save_path400,
							'pics_square' => $save_path100
						);
						
						if($this->m_clubs->update_club($club_id, $upd_data) > 0){
							$data['err_msg'] = '<div class="alert alert-info"><h5>Successfully</h5></div>';
						} else {
							$data['err_msg'] = '<div class="alert alert-info"><h5>No Changes Made</h5></div>';
						}
					} else {
						$reg_data = array(
							'league_id' => $league,
							'name' => $name,
							'slug' => $slug,
							'slogan' => $slogan,
							'details' => $bio,
							'colour' => $bcolour,
							'fore_colour' => $fcolour,
							'pics' => $save_path,
							'pics_small' => $save_path400,
							'pics_square' => $save_path100
						);
						
						if($this->m_clubs->reg_insert($reg_data) > 0){
							$data['err_msg'] = '<div class="alert alert-info"><h5>Successfully</h5></div>';
						} else {
							$data['err_msg'] = '<div class="alert alert-info"><h5>There is problem this time. Try later</h5></div>';
						}
					}
				}
			}
		}
		
		//query uploads
		$data['allclub'] = $this->m_clubs->query_all_club();
		
		$data['title'] = 'Manage Club | SoccerFanHub';
		$data['page_active'] = 'club';

	  	$this->load->view('designs/header', $data);
	  	$this->load->view('clubs/add', $data);
	  	$this->load->view('designs/footer', $data);
	}
	
	function do_upload($htmlFieldName, $path)
    {
        $config['file_name'] = time();
        $config['upload_path'] = $path;
        $config['allowed_types'] = 'gif|jpg|jpeg|png|tif';
        $config['max_size'] = '10000';
        $config['max_width'] = '6000';
        $config['max_height'] = '6000';
        $this->load->library('upload', $config);
        $this->upload->initialize($config);
        unset($config);
        if (!$this->upload->do_upload($htmlFieldName))
        {
            return array('error' => $this->upload->display_errors(), 'status' => 0);
        } else
        {
            $up_data = $this->upload->data();
			return array('status' => 1, 'upload_data' => $this->upload->data(), 'image_width' => $up_data['image_width'], 'image_height' => $up_data['image_height']);
        }
    }
	
	function resize_image($sourcePath, $desPath, $width = '500', $height = '500', $real_width, $real_height)
    {
        $this->image_lib->clear();
		$config['image_library'] = 'gd2';
        $config['source_image'] = $sourcePath;
        $config['new_image'] = $desPath;
        $config['quality'] = '100%';
        $config['create_thumb'] = TRUE;
        $config['maintain_ratio'] = TRUE;
        $config['thumb_marker'] = '';
		$config['width'] = $width;
        $config['height'] = $height;
		
		$dim = (intval($real_width) / intval($real_height)) - ($config['width'] / $config['height']);
		$config['master_dim'] = ($dim > 0)? "height" : "width";
		
		$this->image_lib->initialize($config);
 
        if ($this->image_lib->resize())
            return true;
        return false;
    }
	
	function crop_image($sourcePath, $desPath, $width = '320', $height = '320')
    {
        $this->image_lib->clear();
        $config['image_library'] = 'gd2';
        $config['source_image'] = $sourcePath;
        $config['new_image'] = $desPath;
        $config['quality'] = '100%';
        $config['maintain_ratio'] = FALSE;
        $config['width'] = $width;
        $config['height'] = $height;
		$config['x_axis'] = '20';
		$config['y_axis'] = '20';
        
		$this->image_lib->initialize($config);
 
        if ($this->image_lib->crop())
            return true;
        return false;
    }
}