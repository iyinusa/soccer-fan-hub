<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Leagues extends CI_Controller {

	function __construct()
    {
        parent::__construct();
		$this->load->model('users');
		$this->load->model('users'); //load MODEL
		$this->load->model('m_clubs'); //load MODEL
		$this->load->model('m_moots'); //load MODEL
		$this->load->model('m_leagues');
		$this->load->library('form_validation');
		$this->load->helper('url');
    }
	
	public function index() 
	{
		$data['title'] = 'Manage Leagues | SoccerFanHub';
		$data['page_active'] = 'league';

	  	$this->load->view('designs/header', $data);
	  	$this->load->view('leagues/add', $data);
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
		
		//check for update
		$get_id = $this->input->get('edit');
		if($get_id != ''){
			$gq = $this->m_leagues->query_league_id($get_id);
			foreach($gq as $item){
				$data['e_id'] = $item->id;
				$data['e_name'] = $item->name;
				$data['e_slug'] = $item->slug;
				$data['e_slogan'] = $item->slogan;	
			}
		}
		
		//check record delete
		$del_id = $this->input->get('del');
		if($del_id != ''){
			//only admin can delete
			if(strtolower($log_role) != 'administrator'){
				redirect(base_url('leagues/add'), 'refresh');
			}
			
			if($this->m_leagues->delete_league($del_id) > 0){
				$data['err_msg'] = '<div class="alert alert-info"><h5>Deleted</h5></div>';
			} else {
				$data['err_msg'] = '<div class="alert alert-info"><h5>There is problem this time. Try later</h5></div>';
			}
		}
		
		//set form input rules 
		$this->form_validation->set_rules('name','League Name','trim|required|xss_clean');
		
		$this->form_validation->set_error_delimiters('<div class="alert alert-warning no-radius no-margin padding-sm"><i class="fa fa-info-circle"></i>', '</div>'); //error delimeter
	  
	  	if ($this->form_validation->run() == FALSE)
		{
			$data['err_msg'] = '';
		}
		else
		{
			//check if ready for post
			if($_POST){
				$league_id = $_POST['league_id'];
				$name = $_POST['name'];
				$slogan = $_POST['slogan'];
				
				//===get nicename and convert to seo friendly====
				$slug = strtolower($name);
				$slug = preg_replace("/[^a-z0-9_\s-]/", "", $slug);
				$slug = preg_replace("/[\s-]+/", " ", $slug);
				$slug = preg_replace("/[\s_]/", "-", $slug);
				//================================================
				
				//check for update
				if($league_id != ''){
					$upd_data = array(
						'name' => $name,
						'slug' => $slug,
						'slogan' => $slogan
					);
					
					if($this->m_leagues->update_league($league_id, $upd_data) > 0){
						$data['err_msg'] = '<div class="alert alert-info"><h5>Successfully</h5></div>';
					} else {
						$data['err_msg'] = '<div class="alert alert-info"><h5>No Changes Made</h5></div>';
					}
				} else {
					$reg_data = array(
						'name' => $name,
						'slug' => $slug,
						'slogan' => $slogan
					);
					
					if($this->m_leagues->reg_insert($reg_data) > 0){
						$data['err_msg'] = '<div class="alert alert-info"><h5>Successfully</h5></div>';
					} else {
						$data['err_msg'] = '<div class="alert alert-info"><h5>There is problem this time. Try later</h5></div>';
					}
				}
			}
		}
		
		//query uploads
		$data['allleague'] = $this->m_leagues->query_all_league();
		
		$data['title'] = 'Manage Leagues | SoccerFanHub';
		$data['page_active'] = 'league';

	  	$this->load->view('designs/header', $data);
	  	$this->load->view('leagues/add', $data);
	  	$this->load->view('designs/footer', $data);
	}
}