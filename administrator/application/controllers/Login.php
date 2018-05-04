<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function __construct(){
		parent::__construct();
		$this->load->model('login_model','',true);
		//$this->load->model('Api_model','',true);
	} 
	public function index()
	{
		//$this->load->view('login/login_view');
		// create the data object
		$data = new stdClass();
		// load form helper and validation library
		$this->load->helper('form');
		$this->load->library('form_validation');
		// set validation rules
		$this->form_validation->set_rules('username', 'Username', 'required|alpha_numeric');
		$this->form_validation->set_rules('password', 'Password', 'required');
		if ($this->form_validation->run() == false) {
			// validation not ok, send validation errors to the view
			$this->load->view('login/login_view');
		} else {
			// set variables from the form
			$username = $this->input->post('username');
			$password = $this->input->post('password');
			
			if ($this->login_model->resolve_user_login($username, $password)) {
				
				$user_id = $this->login_model->get_user_id_from_username($username);
				$user    = $this->login_model->get_user($user_id);
				
				// set session user datas
					$this->session->set_userdata('user_id', (int)$user->id);
					$this->session->set_userdata('user_name', (string)$user->username);
					$this->session->set_userdata('logged_in', true);
					$this->session->set_userdata('validated', true);

				
				// user login ok
				//$this->load->view('login/login_view',$data);
				redirect(site_url('Dashboard'),301);
				
			} else {
				
				// login failed
				$data->error = $this->lang->line('invalid_username_password');
				
				// send error to the view
				$this->load->view('login/login_view', $data);
				
			}
			
		}
		
		
	}
		public function do_login()
	{
	echo '<pre>';
	print_r($this->input->post());
	exit;
	
		$this->load->view('login/login_view');
	}
	public function logout() {
		
		// create the data object
		$data = new stdClass();
		
		if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
			
			// remove session datas
			foreach ($_SESSION as $key => $value) {
				unset($_SESSION[$key]);
			}
			
			// user logout ok
			redirect(site_url('Login'),301);
			
		} else {
			
			// there user was not logged in, we cannot logged him out,
			// redirect him to site root
			redirect(site_url('Login'),301);
			
		}
		
	}
}
