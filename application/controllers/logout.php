<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Logout extends CI_Controller {

	function __construct()
    {
        parent::__construct();
		$this->load->model('users'); //load MODEL
		$this->load->model('m_clubs'); //load MODEL
		$this->load->model('m_moots'); //load MODEL
		$this->load->helper('cookie');
    }
	
	public function index()
	{
		$shf_id = $this->session->userdata('sfh_id');
		
		$status_update = array('user_status'=>0);
		if($this->users->update_user($shf_id,$status_update) > 0){
			$newdata = array(
				'sfh_id' => '',
				'sfh_nicename' => '',
				'sfh_user_email' => '',
				'sfh_user_registered' => '',
				'sfh_user_lastlog' => '',
				'sfh_user_status' => '',
				'sfh_display_name' => '',
				'sfh_user_nicename' => '',
				'sfh_user_pics' => '',
				'sfh_user_pics_small' => '',
				'sfh_user_country' => '',
				'sfh_user_bio' => '',
				'sfh_user_sex' => '',
				'sfh_user_address' => '',
				'sfh_user_city' => '',
				'sfh_user_dob' => '',
				'sfh_user_phone' => '',
				'sfh_user_website' => '',
				'sfh_user_facebook' => '',
				'sfh_user_twitter' => '',
				'sfh_user_linkedin' => '',
				'sfh_user_role' => '',
				'sfh_user_pro' => '',
				'logged_in' => FALSE,
			);
			$this->session->unset_userdata($newdata);
			//unset($this->session->userdata); 
			$this->session->sess_destroy();
			delete_cookie( config_item('sess_cookie_name') ); 
		}
		
		$data['title'] = 'Sign Out | SoccerFanHub';
		$data['page_active'] = 'logout';
		
		$this->load->view('designs/header', $data);
		$this->load->view('logout', $data);
		$this->load->view('designs/footer', $data);
		
		redirect(base_url().'hauth/logout', 'refresh');
		redirect('/', 'refresh');
	}
}