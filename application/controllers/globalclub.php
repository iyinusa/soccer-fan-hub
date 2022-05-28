<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Globalclub extends CI_Controller {

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
		
		$data['global_log'] = FALSE;
		$data['global_link'] = 'No Club';
		
		$get_club = $this->input->get('club');
		if($get_club != ''){
			if($this->session->userdata('logged_in') == TRUE){
				$data['global_log'] = TRUE;
				
				//get user club name
				$club_id = $this->session->userdata('sfh_user_club_id');
				if($club_id == 0){
					$data['log_user_club'] = 'No Club';
				} else {
					$gclub = $this->m_clubs->query_single_club_id($club_id);
					if(!empty($gclub)){
						foreach($gclub as $cl){
							$data['log_user_club'] = $cl->name;
						}
					}
				}
				
				if($get_club == 'Chelsea FC'){
					$data['global_link'] = 'https://mytickets.tickets.com/buy/MyTicketsServlet?agency=CHELSEA_SCLUB&organ_val=46809&trxstate=231';
				}
			} else {
				$data['global_log'] = FALSE;
				//register redirect page
				$s_data = array ('sfh_redirect' => uri_string().'?club='.$get_club);
				$this->session->set_userdata($s_data);
			}
		}
		
		$data['clubname'] = $get_club;
		
		$data['title'] = 'Global Club | SoccerFanHub';
		$data['page_active'] = 'global';
		
		//$this->load->view('designs/reg_header', $data);
		$this->load->view('global', $data);
		//$this->load->view('designs/footer', $data);
	}
}