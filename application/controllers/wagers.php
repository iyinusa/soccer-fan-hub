<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Wagers extends CI_Controller {

	function __construct()
    {
        parent::__construct();
		$this->load->model('users'); //load MODEL
		$this->load->model('m_wagers'); //load MODEL
		$this->load->library('form_validation');
		$this->load->helper('url');
    }
	
	public function index() 
	{
		$all_wager = $this->m_wagers->query_all_wager();
		if(!empty($all_wager)) {
			$data['allwager'] = $all_wager;
		}
		
		$data['title'] = 'Wagers | SoccerFanHub';
		$data['page_active'] = 'wager';

	  	$this->load->view('designs/header', $data);
	  	$this->load->view('wagers/wagers', $data);
	  	$this->load->view('designs/footer', $data);
	}
	
	public function add(){
		if($this->session->userdata('logged_in') == FALSE){
			//register redirect page
			$s_data = array ('sfh_redirect' => uri_string());
			$this->session->set_userdata($s_data);
			redirect(base_url('login'), 'refresh');	
		}
		
		$data['fan_pro'] = $this->session->userdata('sfh_user_pro');
		$log_user_id = $this->session->userdata('sfh_id');
		
		//check for update
		$get_id = $this->input->get('edit');
		if($get_id != ''){
			$gq = $this->m_wagers->query_wager_id($get_id);
			foreach($gq as $item){
				$data['e_id'] = $item->id;
				$data['e_type'] = $item->type;
				$data['e_content'] = $item->content;
				$data['e_amt'] = $item->amt;
				$data['e_starts'] = $item->starts;	
				$data['e_ends'] = $item->ends;	
				$data['e_remark'] = $item->remark;
				$data['e_status'] = $item->status;
				$data['e_privacy'] = $item->privacy;		
			}
		}
		
		//check record delete
		$del_id = $this->input->get('del');
		if($del_id != ''){
			$gd = $this->m_wagers->query_all_wagerer($del_id);
			if(!empty($gd)){
				foreach($gd as $ditem){
					if($ditem->creator==1){
						$user_id = $ditem->user_id;
					}
				}
			}
			//only creator, editor and admin can delete
			if($user_id != $log_user_id || $this->session->userdata('sfh_user_role')=='Administrator'){
				redirect(base_url('wagers/add'), 'refresh');
			}
			
			if($this->m_wagers->delete_wager($del_id) > 0){
				$data['err_msg'] = '<div class="alert alert-info"><h5>Deleted</h5></div>';
				redirect(base_url('wagers'), 'refresh');
			} else {
				$data['err_msg'] = '<div class="alert alert-info"><h5>There is problem this time. Try later</h5></div>';
			}
		}
		
		//set form input rules 
		$this->form_validation->set_rules('amt','Amount','trim|required|xss_clean');
		$this->form_validation->set_rules('starts','Start Date','trim|required|xss_clean');
		
		$this->form_validation->set_error_delimiters('<div class="alert alert-warning no-radius no-margin padding-sm"><i class="fa fa-info-circle"></i>', '</div>'); //error delimeter
	  
	  	if ($this->form_validation->run() == FALSE)
		{
			$data['err_msg'] = '';
		}
		else
		{
			//check if ready for post
			if($_POST){
				$wager_id = $_POST['wager_id'];
				$content = $_POST['clubA'].' VS '.$_POST['clubB'];;
				$type = $_POST['type'];
				$amt = $_POST['amt'];
				$starts = $_POST['starts'];
				if(isset($_POST['ends'])){$ends = $_POST['ends'];}else{$ends='';}
				$remark = $_POST['remark'];
				if(isset($_POST['status'])){$status = $_POST['status'];}else{$status=0;}
				if(isset($_POST['privacy'])){$privacy = $_POST['privacy'];}else{$privacy=0;}
				
				$now = date("Y-m-d H:i:s");
				
				//check constraints
				$user_quota = $this->users->query_user_quota($log_user_id);
				$cal_quota = 0;
				if(empty($user_quota)){
					$cal_quota = 0;	
				} else {
					foreach($user_quota as $quota){
						$cal_quota += $quota->point;
					}
				}
				
				
				//check for update
				if($wager_id != ''){
					$upd_data = array(
						'type' => $type,
						'content' => $content,
						'amt' => $amt,
						'starts' => $starts,
						'ends' => $ends,
						'remark' => $remark,
						'status' => $status,
						'privacy' => $privacy
					);
					
					if($this->m_wagers->update_wager($wager_id, $upd_data) > 0){
						$data['err_msg'] = '<div class="alert alert-info"><h5>Successfully</h5></div>';
					} else {
						$data['err_msg'] = '<div class="alert alert-info"><h5>No Changes Made</h5></div>';
					}
				} else {
					if($this->m_wagers->check_wager($type,$content,$amt,$starts) > 0){
						//don't duplicate in database
					} else {
						if($cal_quota < $amt){
							$data['err_msg'] = '<div class="alert alert-info"><h5>Wallet too low. <a href="'.base_url().'wallet">Fund Your Wallet</a></h5></div>';
						} else {
							$reg_data = array(
								'type' => $type,
								'content' => $content,
								'amt' => $amt,
								'starts' => $starts,
								'ends' => $ends,
								'remark' => $remark,
								'status' => $status,
								'privacy' => $privacy,
								'reg_date' => $now
							);
							
							$insert_id = $this->m_wagers->reg_insert($reg_data);
							if($insert_id){
								//register fan as creator
								$reg_w_data = array(
									'wager_id' => $insert_id,
									'user_id' => $log_user_id,
									'privacy' => $privacy,
									'creator' => 1,
									'win' => 0,
									'reg_date' => $now
								);
								if($this->m_wagers->reg_insert_wagerer($reg_w_data)){
									//remove point
									$reg_point = array(
										'user_id' => $log_user_id,
										'point' => -$amt,
										'purpose' => 'Placed Wager',
										'reg_date' => $now
									);
									
									$this->users->reg_point($reg_point);
									$data['err_msg'] = '<div class="alert alert-info"><h5>Successfully</h5></div>';
								} else {
									$data['err_msg'] = '<div class="alert alert-info"><h5>There is problem this time. Try later</h5></div>';	
								}
							} else {
								$data['err_msg'] = '<div class="alert alert-info"><h5>There is problem this time. Try later</h5></div>';
							}
						}
					}
				}
			}
		}
		
		$data['title'] = 'Wagers | SoccerFanHub';
		$data['page_active'] = 'wager';

	  	$this->load->view('designs/header', $data);
	  	$this->load->view('wagers/add', $data);
	  	$this->load->view('designs/footer', $data);
	}
	
	public function joinbet(){
		$log_user_pro = $this->session->userdata('sfh_user_pro');
		$log_user_id = $this->session->userdata('sfh_id');
		
		if($log_user_pro==0){$privacy = 0;}else{$privacy = 1;}
		
		if($_POST){
			$place_id = $_POST['place_id'];
			$place_creator = $_POST['place_creator'];
			$place_type = $_POST['place_type'];
			$place_amt = $_POST['place_amt'];
			
			if($place_id && $place_creator && $place_type && $place_amt){
				$now = date("Y-m-d H:i:s");
				
				//check wagerer wallet
				$user_quota = $this->users->query_user_quota($log_user_id);
				$cal_quota = 0;
				if(empty($user_quota)){
					$cal_quota = 0;	
				} else {
					foreach($user_quota as $quota){
						$cal_quota += $quota->point;
					}
				}
				
				if($cal_quota < $place_amt){
					echo '&nbsp;<a href="'.base_url().'wallet/">Fund Your Wallet >></a>';
				} else {
					//check if user already joined
					if($this->m_wagers->check_user_wagerer($place_id, $log_user_id) > 0){
						echo '&nbsp;Already placed';
					} else {
						//check bet type
						if($place_type=='One-To-One'){
							if(count($this->m_wagers->query_all_wagerer($place_id)) > 1){
								echo '&nbsp;Limit reached'; exit;
							}
						}
						
						//now place bet
						$reg_w_data = array(
							'wager_id' => $place_id,
							'user_id' => $log_user_id,
							'privacy' => $privacy,
							'creator' => 0,
							'win' => 0,
							'reg_date' => $now
						);
						if($this->m_wagers->reg_insert_wagerer($reg_w_data)){
							//remove point
							$reg_point = array(
								'user_id' => $log_user_id,
								'point' => -$place_amt,
								'purpose' => 'Placed Wager',
								'reg_date' => $now
							);
							
							$this->users->reg_point($reg_point);
							echo '&nbsp;Bet placed';
						} else {
							echo '&nbsp;Try later';	
						}
					}
				}
			}
		}exit;
	}
	
	public function view($get_fact){
		$single_fact = $this->m_facts->query_fact_id($get_fact);
		$fact_id = '';
		$data['title'] = '';
		$data['pg_link'] = '';
		$data['club_msg'] = '';
		if(!empty($single_fact)) {
			foreach($single_fact as $frow) {
				$fact_id = $frow->id;
				$data['fact_id'] = $frow->id;
				$data['title'] = character_limiter($frow->fact_details,30).' | SoccerFanHub';
				$data['pg_link'] = $get_fact;
				$data['club_id'] = $frow->club_id;
				$data['fact_date'] = $frow->fact_date;
				$data['fact_year'] = $frow->fact_year;
				$data['fact_details'] = $frow->fact_details;
				$data['fact_reg_date'] = $frow->reg_date;
				
				$reg_date_ago = timespan(strtotime($frow->reg_date), time());
				$reg_date = date(('D, j M Y H:m'), strtotime($frow->reg_date));
													
				$data['reg_date_ago'] = $reg_date_ago.' ago';
				$data['reg_date'] = $reg_date;
				
				//get club details
				$single_club = $this->m_clubs->query_single_club_id($frow->club_id);
				if(!empty($single_club)) {
					foreach($single_club as $row) {
						$row_pics = $row->pics;
						$row_pics_square = $row->pics_square;
						
						if($row_pics=='' || file_exists(FCPATH.$row_pics)==FALSE){$row_pics='img/avatar.jpg';}
						if($row_pics_square=='' || file_exists(FCPATH.$row_pics_square)==FALSE){$row_pics_square='img/avatar.jpg';}
						
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
						
						//get fans
						$data['club_fans_count'] = count($this->m_clubs->query_club_fans($row->id));
						$data['all_club_fans'] = $this->m_clubs->query_club_fans($row->id);
						
						//query fan moots
						$data['allmoots'] = $this->m_moots->query_moot_club($row->id);
						$data['club_moot_count'] = count($this->m_moots->query_moot_club($row->id));
						$data['club_moot_reply_count'] = count($this->m_moots->query_moot_reply_club($row->id));
						$data['club_moot_all'] = count($this->m_moots->query_all_moot());
					}
				}
			}
		} else {redirect(base_url().'facts/', 'refresh');}
		
		$data['page_active'] = 'fact';
		
		$this->load->view('designs/header', $data);
		$this->load->view('facts/view', $data);
		$this->load->view('designs/footer', $data);
	}
}