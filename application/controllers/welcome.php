<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {

	function __construct(){
        parent::__construct();
		$this->load->model('users'); //load MODEL
		$this->load->model('m_clubs'); //load MODEL
		$this->load->model('m_moots'); //load MODEL
		$this->load->model('subscribe'); //load MODEL
		//$this->load->library('form_validation'); //load form validate rules
		
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
		//check if logged in
		if($this->session->userdata('logged_in') == TRUE){
			
			
			$data['title'] = 'Activity | SoccerFanHub';
			$data['page_active'] = 'activity';
	
			$this->load->view('designs/header', $data);
			$this->load->view('activity', $data);
			$this->load->view('designs/footer', $data);
		} else {
			if($_POST){
				$sub_email = $_POST['email'];
				
				//check if already subscribed
				$check = $this->subscribe->check_subscriber($sub_email);
				if(!empty($check)){
					echo 'Thanks!!! We already have you listed';
				} else {
					//prepare to insert
					$now = date('l, j F, Y H:m');
					$reg_data = array(
						'email' => $sub_email,
						'name' => '',
						'reg_date' => $now
					);
					
					//save records in database
					$insert_id = $this->subscribe->reg_insert($reg_data);
					
					if($insert_id) {
						//get total subscriptions
						$total = count($this->subscribe->all_subscriber());
						
						//email notification processing
						$this->email->clear(); //clear initial email variables
						$this->email->to($sub_email);
						$this->email->from('info@soccerfanhub.com','SFH - SoccerFanHub');
						$this->email->subject('Subscribed SoccerFanHub Updates');
						
						//compose html body of mail
						$mail_subhead = 'Subscribed to Updates';
						$body_msg = '
							Thanks for subscribing to SoccerFanHub updates. We will always keep you posted as the development goes, mostly about club issues debates and others.
						';
						
						$mail_data = array('message'=>$body_msg, 'subhead'=>$mail_subhead);
						$this->email->set_mailtype("html"); //use HTML format
						$mail_design = $this->load->view('designs/email_template', $mail_data, TRUE);
	 
						$this->email->message($mail_design);
						
						if($this->email->send()) {
							echo 'Successful! You will always get updates from the SoccerFanHub';
							
							//copy admin as well
							$this->email->clear(); //clear initial email variables
							$this->email->to('info@soccerfanhub.com');
							$this->email->from($sub_email,'SFH - SoccerFanHub');
							$this->email->subject('New Subscriber at SoccerFanHub');
							
							//compose html body of mail
							$mail_subhead = 'New Subscriber';
							$body_msg = '
								<h2>'.$total.' subscribers and growing...</h2>
								Congrats!!! - We now have new subscriber to SoccerFanHub platform with email address ('.$sub_email.').
							';
							
							$mail_data = array('message'=>$body_msg, 'subhead'=>$mail_subhead);
							$this->email->set_mailtype("html"); //use HTML format
							$mail_design = $this->load->view('designs/email_template', $mail_data, TRUE);
		 
							$this->email->message($mail_design);
							
							if($this->email->send()) {} //mail sent to admin		
						} else {
							echo 'There is problem this time. Please try later';
						}
						
					} else {
						echo 'There is problem this time. Please try later';
					}
				}
				
				exit;
			}
			
			$data['club_count'] = count($this->m_clubs->query_all_club());
			$data['fan_count'] = count($this->users->query_all_user());
			$data['moot_count'] = count($this->m_moots->query_all_moot());
			$data['trend_count'] = count($this->m_moots->query_all_moot_reply());
			
			$data['title'] = 'SFH - SoccerFanHub';
			$data['page_active'] = 'welcome';
	
			//$this->load->view('designs/header', $data);
			$this->load->view('welcome', $data);
			//$this->load->view('designs/footer', $data);
		}
	}
}