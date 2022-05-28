<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Accounts extends CI_Controller {

	function __construct()
    {
        parent::__construct();
		$this->load->model('users');
		$this->load->model('m_clubs');
		$this->load->model('m_moots');
		$this->load->library('form_validation');
		$this->load->helper('url');
    }
	
	public function index() 
	{
		if($this->session->userdata('logged_in') == TRUE){
			$log_role = $this->session->userdata('sfh_user_role');
			if(strtolower($log_role) != 'administrator'){
				redirect(base_url('fan/'.$this->session->userdata('sfh_nicename')), 'refresh');
			}
		} else {
			//register redirect page
			$s_data = array ('sfh_redirect' => uri_string());
			$this->session->set_userdata($s_data);
			redirect(base_url('login'), 'refresh');
		}
		
		$data['err_msg'] = '';
		
		//check for update
		$get_id = $this->input->get('edit');
		if($get_id != ''){
			$gq = $this->users->query_single_user_id($get_id);
			foreach($gq as $item){
				$data['e_id'] = $item->ID;
				$data['e_display_name'] = $item->display_name;
				$data['e_role'] = $item->role;
				
				//query fan quota
				$cal_quota = 0;
				$user_quota = $this->users->query_user_quota($item->ID);
				if(empty($user_quota)){
					$cal_quota = 0;	
				} else {
					foreach($user_quota as $quota){
						$cal_quota += $quota->point;
					}
				}
				
				$data['e_points'] = $cal_quota;
			}
		}
		
		//check record delete
		$del_id = $this->input->get('del');
		if($del_id != ''){
			//only admin can delete
			if(strtolower($log_role) != 'administrator'){
				redirect(base_url('admin/accounts'), 'refresh');
			}
			
			if($this->m_leagues->delete_league($del_id) > 0){
				$data['err_msg'] = '<div class="alert alert-info"><h5>Deleted</h5></div>';
			} else {
				$data['err_msg'] = '<div class="alert alert-info"><h5>There is problem this time. Try later</h5></div>';
			}
		}
		
		//check record update
		if($_POST){
			$user_id = $_POST['user_id'];
			$role = $_POST['role'];
			$point = $_POST['point'];
			$purpose = $_POST['purpose'];
			
			if($user_id && $role){
				$upd_data = array(
					'role' => $role
				);
				
				if($this->users->update_user($user_id, $upd_data) > 0){
					$data['err_msg'] = '<div class="alert alert-info"><h5>Role Changed</h5></div>';
				} else {
					$data['err_msg'] = '<div class="alert alert-info"><h5>No Changes Made To Role</h5></div>';
				}
				
				//check if point is set
				if($point!=''){
					if($purpose==''){
						$data['err_msg'] .= '<div class="alert alert-info"><h5>Point needs purpose</h5></div>';
					} else {
						$now = date("Y-m-d H:i:s");
						//try give fan assigned point
						$reg_point = array(
							'user_id' => $user_id,
							'point' => $point,
							'purpose' => $purpose,
							'reg_date' => $now
						);
						
						if($this->users->reg_point($reg_point) > 0){
							$data['err_msg'] .= '<div class="alert alert-info"><h5>Points Awarded</h5></div>';
						}
					}
				}
			}	
		}
		
		//query uploads
		$data['alluser'] = $this->users->query_all_user();
		
		$data['title'] = 'Manage Accounts | SoccerFanHub';
		$data['page_active'] = 'accounts';

	  	$this->load->view('designs/header', $data);
	  	$this->load->view('admin/user/accounts', $data);
	  	$this->load->view('designs/footer', $data);
	}
}