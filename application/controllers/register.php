<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Register extends CI_Controller {

	function __construct()
    {
        parent::__construct();
		$this->load->model('users'); //load MODEL
		$this->load->model('m_clubs'); //load MODEL
		$this->load->model('m_moots'); //load MODEL
		$this->load->library('form_validation'); //load form validate rules
		$this->load->library('recaptcha'); //load reCAPTCHA library
		
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
		//check if already logged in
		If($this->session->userdata('logged_in')==TRUE){redirect(base_url('fan/'.$this->session->userdata('sfh_user_nicename')), 'refresh');}
		
		//set form input rules 
		$this->form_validation->set_rules('name','Display name','required|xss_clean');
		$this->form_validation->set_rules('username','User name','trim|required|xss_clean');
		$this->form_validation->set_rules('email','Email Address','trim|required|valid_email|xss_clean');
		$this->form_validation->set_rules('password','Password','trim|required|xss_clean|md5');
		$this->form_validation->set_rules('confirm','Confirm Password','trim|required|matches[password]|xss_clean');
		$this->form_validation->set_rules('sex','Sex','required|xss_clean');
		$this->form_validation->set_rules('phone','Phone','required|xss_clean');
		$this->form_validation->set_rules('country','Country','required|xss_clean');
		
		$this->form_validation->set_error_delimiters('<div id="pass-info" class="alert alert-danger">', '</div>'); //error delimeter
		
		if ($this->form_validation->run() == FALSE)
		{
			$data['err_msg'] = '';
			$data['recaptcha_html'] = '';
		}
		else
		{
			//check if ready for post
			if($_POST) {
				$name = $_POST['name'];
				$username = $_POST['username'];
				$email = $_POST['email'];
				$password = $_POST['password'];
				$sex = $_POST['sex'];
				$phone = $_POST['phone'];
				$country = $_POST['country'];
				$role = 'User';
				//===get nicename and convert to seo friendly====
				$nicename = strtolower($username);
				$nicename = preg_replace("/[^a-z0-9_\s-]/", "", $nicename);
				$nicename = preg_replace("/[\s-]+/", " ", $nicename);
				$nicename = preg_replace("/[\s_]/", "-", $nicename);
				//================================================
				
				//Call to recaptcha to get the data validation set within the class. 
                $this->recaptcha->recaptcha_check_answer();
				
				if($this->users->check_by_email($email) > 0 || $this->users->check_by_username($username) > 0) {
					$data['err_msg'] = '<div class="alert alert-danger">Member already exist with this username or email address</div>';
				} else {
					//check reCpatcha Value
					if(!$this->recaptcha->getIsValid()) {
						$data['err_msg'] = '<div class="alert alert-danger">Incorrect Captcha</div>';
					} else {
						$time = time();
						$now = date("Y-m-d H:i:s");
						
						$reg_data = array(
							'display_name' => ucwords($name),
							'user_login' => $username,
							'user_nicename' => $nicename,
							'user_email' => $email,
							'user_pass' => $password,
							'role' => $role,
							'sex' => $sex,
							'phone' => $phone,
							'country' => $country,
							'user_registered' => $now,
							'regstamp' => $time,
							'activate' => 0,
							'user_status' => 0
						);
						
						//email notification processing
						$this->email->clear(); //clear initial email variables
						$this->email->to($email);
						$this->email->from('info@soccerfanhub.com','SoccerFanHub');
						$this->email->subject('Activate Email Address');
						
						//compose html body of mail
						$mail_stamp = $time;
						$mail_subhead = 'Email Activation';
						$body_msg = '
							Thanks for registering on SoccerFanHub.<br /><br />
							Kindly <a href="'.base_url().'activate?stamp='.$mail_stamp.'&amp;email='.$email.'">Activate your email address</a><br /><br />Thanks
						';
						
						$mail_data = array('message'=>$body_msg, 'subhead'=>$mail_subhead);
						$this->email->set_mailtype("html"); //use HTML format
						$mail_design = $this->load->view('designs/email_template', $mail_data, TRUE);
	 
						$this->email->message($mail_design);
						
						if($this->email->send()) {
							$data['err_msg'] = '<div class="alert alert-success">Please activate your Email Address to complete registration. Click on link sent to '.$email.' (NB: Check SPAM if not in INBOX)</div>';
													
							$insert_id = $this->users->reg_insert($reg_data); //save records in database
							
							//try give fan 20 point on registration
							$reg_point = array(
								'user_id' => $insert_id,
								'point' => 20,
								'purpose' => 'Registration bonus',
								'reg_date' => $now
							);
							
							$this->users->reg_point($reg_point);
							
							/////////////////////////////////////////////////////////////////////////////////////
							//send notification mail to admin
							$this->email->clear(); //clear initial email variables
							$this->email->to('info@soccerfanhub.com');
							$this->email->from($email,'SoccerFanHub');
							$this->email->subject('New SoccerFanHub Member');
							
							//compose html body of mail
							$mail_stamp = $time;
							$mail_subhead = 'New Account Creation';
							$body_msg = '
								This is to notify you that SoccerFanHub now has new member.<br /><br />
								Check <a href="'.base_url().'fan/'.$nicename.'">'.$name.'</a> Profile<br /><br />Thanks
							';
							
							$mail_data = array('message'=>$body_msg, 'subhead'=>$mail_subhead);
							$this->email->set_mailtype("html"); //use HTML format
							$mail_design = $this->load->view('designs/email_template', $mail_data, TRUE);
		 
							$this->email->message($mail_design);
							
							if($this->email->send()) {}						
						} else {
							$data['err_msg'] = '<div class="alert alert-danger">Problem sending email this time. You will need to try again with valid Email Address.</div>';
						}
					}
				}
			}
		}
        
		//Store the captcha HTML for correct MVC pattern use.
        $data['recaptcha_html'] = $this->recaptcha->recaptcha_get_html();
		
		$data['title'] = 'Join Club | SoccerFanHub';
		$data['page_active'] = 'register';

	  	$this->load->view('designs/header', $data);
	  	$this->load->view('register', $data);
	  	$this->load->view('designs/footer', $data);
	}
}