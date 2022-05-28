<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Wallet extends CI_Controller {

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
		
		
		//get user quota
		$data['wallets'] = $this->users->query_user_quota($log_user_id);
		
		$data['title'] = 'Wallet | SoccerFanHub';
		$data['page_active'] = 'wallet';
		
		$this->load->view('designs/header', $data);
		$this->load->view('wallet/wallet', $data);
		$this->load->view('designs/footer', $data);
	}
	
	public function prepare(){
		if($_POST){
			$amount = $_POST['amount'];
			$type = $_POST['type'];
			
			if($type=='$'){$amount *= 199; $type='&#8358;';}
			
			if(!$amount){
				echo '<div class="alert alert-info"><h3>Amount is required</h3></div>';
			} else {
				echo '
					<div class="col-lg-12">
						<h3>
							'.$type.''.number_format($amount,2).' 
							<i class="ti-arrow-right"></i> 
							<i class="ti-wallet"></i> My Wallet
						</h3>
						<div class="text-muted">'.$type.''.number_format($amount,2).' will be added to your wallet account on successful transaction.<br><br></div>
					</div>
					
					<div class="col-lg-12">
						<form action="https://voguepay.com/pay/" method="post">
							<input type="hidden" name="v_merchant_id" value="7341-0027817" />
							<input type="hidden" name="merchant_ref" value="234-567-890" />
							<input type="hidden" name="memo" value="Fund Wallet" />
							<input type="hidden" name="total" value="'.$amount.'" />
							<!--<input type="hidden" name="notify_url" value="http://www.mydomain.com/notification.php" />
							<input type="hidden" name="success_url" value="http://www.mydomain.com/thank_you.html" />
							<input type="hidden" name="fail_url" value="http://www.mydomain.com/failed.html" />-->
							<button class="btn btn-success btn-lg"><i class="ti-shopping-cart"></i> Continue To Checkout</button>
						</form>
					</div>
				';
			}
			exit;
		}exit;
	}
}