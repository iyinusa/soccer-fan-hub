<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Facts extends CI_Controller {

	function __construct()
    {
        parent::__construct();
		$this->load->model('m_clubs'); //load MODEL
		$this->load->model('m_facts'); //load MODEL
		$this->load->library('form_validation');
		$this->load->helper('url');
    }
	
	public function index() 
	{
		$all_fact = $this->m_facts->query_all_fact();
		if(!empty($all_fact)) {
			$data['allfact'] = $all_fact;
		}
		
		$all_club = $this->m_clubs->query_all_club();
		if(!empty($all_club)) {
			$data['allclub'] = $all_club;
		}
		
		$data['title'] = 'Club Facts | SoccerFanHub';
		$data['page_active'] = 'fact';

	  	$this->load->view('designs/header', $data);
	  	$this->load->view('facts/facts', $data);
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
		
		$all_club = $this->m_clubs->query_all_club();
		if(!empty($all_club)) {
			$data['allclub'] = $all_club;
		}
		
		//check for update
		$get_id = $this->input->get('edit');
		if($get_id != ''){
			$gq = $this->m_facts->query_fact_id($get_id);
			foreach($gq as $item){
				$data['e_id'] = $item->id;
				$data['e_club_id'] = $item->club_id;
				$data['e_fact_date'] = $item->fact_date;
				$data['e_fact_details'] = $item->fact_details;	
			}
		}
		
		//check record delete
		$del_id = $this->input->get('del');
		if($del_id != ''){
			//only admin can delete
			if(strtolower($log_role) != 'administrator'){
				redirect(base_url('facts/add'), 'refresh');
			}
			
			if($this->m_facts->delete_fact($del_id) > 0){
				$data['err_msg'] = '<div class="alert alert-info"><h5>Deleted</h5></div>';
			} else {
				$data['err_msg'] = '<div class="alert alert-info"><h5>There is problem this time. Try later</h5></div>';
			}
		}
		
		//set form input rules 
		$this->form_validation->set_rules('club_id','Club','trim|required|xss_clean');
		$this->form_validation->set_rules('date','Fact','trim|required|xss_clean');
		$this->form_validation->set_rules('details','Fact Details','trim|required|xss_clean');
		
		$this->form_validation->set_error_delimiters('<div class="alert alert-warning no-radius no-margin padding-sm"><i class="fa fa-info-circle"></i>', '</div>'); //error delimeter
	  
	  	if ($this->form_validation->run() == FALSE)
		{
			$data['err_msg'] = '';
		}
		else
		{
			//check if ready for post
			if($_POST){
				$fact_id = $_POST['fact_id'];
				$club_id = $_POST['club_id'];
				$date = $_POST['date'];
				$details = $_POST['details'];
				
				$now = date("Y-m-d H:i:s");
				$year = date("d F Y", strtotime($date));
				
				//check for update
				if($fact_id != ''){
					$upd_data = array(
						'club_id' => $club_id,
						'fact_date' => $date,
						'fact_year' => $year,
						'fact_details' => $details
					);
					
					if($this->m_facts->update_fact($fact_id, $upd_data) > 0){
						$data['err_msg'] = '<div class="alert alert-info"><h5>Successfully</h5></div>';
					} else {
						$data['err_msg'] = '<div class="alert alert-info"><h5>No Changes Made</h5></div>';
					}
				} else {
					$reg_data = array(
						'club_id' => $club_id,
						'fact_date' => $date,
						'fact_year' => $year,
						'fact_details' => $details,
						'reg_date' => $now
					);
					
					if($this->m_facts->reg_insert($reg_data) > 0){
						$data['err_msg'] = '<div class="alert alert-info"><h5>Successfully</h5></div>';
					} else {
						$data['err_msg'] = '<div class="alert alert-info"><h5>There is problem this time. Try later</h5></div>';
					}
				}
			}
		}
		
		//query uploads
		$data['allfact'] = $this->m_facts->query_all_fact();
		
		$data['title'] = 'Manage Club Facts | SoccerFanHub';
		$data['page_active'] = 'fact';

	  	$this->load->view('designs/header', $data);
	  	$this->load->view('facts/add', $data);
	  	$this->load->view('designs/footer', $data);
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