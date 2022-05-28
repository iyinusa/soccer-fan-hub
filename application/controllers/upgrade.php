<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Upgrade extends CI_Controller {

	function __construct()
    {
        parent::__construct();
		$this->load->model('users'); //load MODEL
		$this->load->helper('text'); //for content limiter
		$this->load->library('form_validation'); //load form validate rule
    }
	
	public function index()
	{
		if($this->session->userdata('logged_in')==FALSE){
			//register redirect page
			$s_data = array ('sfh_redirect' => uri_string());
			$this->session->set_userdata($s_data);
			redirect(base_url('login'), 'refresh');	
		}
		
		$log_user_id = $this->session->userdata('sfh_id');
		$data['err_msg'] = '';
		
		
		
		$data['title'] = 'Upgrade Pro | SoccerFanHub';
		$data['page_active'] = 'upgrade';
		
		$this->load->view('designs/header', $data);
		$this->load->view('upgrade/upgrade', $data);
		$this->load->view('designs/footer', $data);
	}
}