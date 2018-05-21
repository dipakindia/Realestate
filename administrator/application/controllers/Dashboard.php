<?php
defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting(0);
class Dashboard extends CI_Controller {

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
		//$this->load->library(array('session'));
		//$this->load->library('email');
		$this->load->helper(array('url'));
		$this->load->helper('dashboard');
		$this->load->model('dashboard_model','',true);
		if ($this->session->userdata('logged_in') != true) {
			redirect(site_url('Login'),301);
		}
	} 
	public function index(){
		$data = array();
		$this->load->view('header');
		$this->load->view('dashboard/index', $data);
		$this->load->view('footer');
	}
	public function owners(){
		$array = array('is_merchant' => 1, 'status' => 1);
		$data['alldata'] =  $this->dashboard_model->getMultipleData('tbl_user_records',$array);
		$this->load->view('header');
		$this->load->view('users/index', $data);
		$this->load->view('footer');
	}	
	public function users(){
		$array = array('is_merchant' => 0);
		$data['alldata'] =  $this->dashboard_model->getMultipleData('tbl_user_records',$array);
		$this->load->view('header');
		$this->load->view('users/index', $data);
		$this->load->view('footer');
	}	
	public function pending_owner(){
	$array = array('is_merchant' => 1, 'status' => 0);
		$data['alldata'] = $this->dashboard_model->getMultipleData('tbl_user_records',$array);
		$this->load->view('header');
		$this->load->view('users/index', $data);
		$this->load->view('footer');
	}	
	public function sub_admins(){
		$data['alldata'] = $this->dashboard_model->getMultipleData('admin','status=1');
		$this->load->view('header');
		$this->load->view('users/sub_admins', $data);
		$this->load->view('footer');
	}		
	public function user_information(){
		$uid = $this->uri->segment(3);
		$data['data']['category_list'] = $this->dashboard_model->getMultipleData('tbl_category_records','parent_id = 0');
		$data['data']['sub_category_list'] = $this->dashboard_model->get_data_list('tbl_category_records','category_id','DESC');
		$data['data']['place_list'] = $this->dashboard_model->get_data_list('tbl_places_records','id','DESC');
		$data['data']['tbl_filters'] = $this->dashboard_model->get_data_list('tbl_Filters','id','DESC');
		$data['data']['user_info'] = $this->dashboard_model->getSingleData('tbl_user_records','id='.$uid);
		$this->load->view('header');
		$this->load->view('users/merchant_info', $data);
		$this->load->view('footer');
	}
	public function get_sub_category(){
		$cat_id = rtrim($this->input->post('cat_id'),', ');
		$sub_cat_id = $this->input->post('sub_cat_id');
		$ctArray = explode(",", $sub_cat_id);
		$data_category = $this->dashboard_model->getMultipleData('tbl_category_records','parent_id IN('.$cat_id.')');
		foreach($data_category as $cat){
		 $classC = $sel = '';
		  if($val->parent_id == 0){ $classC ='parent'; }else{ $classC = 'sub-cat'; $textData = getCategoryName($val->parent_id).'>> '; }
		  if(in_array($cat->category_id,$ctArray)){ $sel = 'checked="checked"';}else{ $sel = ''; }
		  echo '<li class="'.$classC.'"><input type="checkbox" name="sub_category[]" '.$sel.' value ="'.(int)$cat->category_id.'" > <a>'.$textData .$cat->category_name.'</a></li>';
		}

	}	
	public function offer_information(){
		$uid = $this->uri->segment(3);
		//$data['data']['offer_list'] = $this->dashboard_model->get_data_list('tbl_offer_sponsered_records','id','DESC');
		//$data['data']['place_list'] = $this->dashboard_model->get_data_list('tbl_places_records','id','DESC');
		//$data['data']['tbl_filters'] = $this->dashboard_model->get_data_list('tbl_Filters','id','DESC');
		//$data['data']['offer_info'] = $this->dashboard_model->getSingleData('tbl_offer_sponsered_records','offer_id='.$uid);
		$data = array();
		$this->load->view('header');
		$this->load->view('offer/offer_info', $data);
		$this->load->view('footer');
	}	
	public function update_user_city(){
		$post['action'] = 'update';
		$post['table_name'] = 'tbl_user_records';
		$post['value'] = $this->input->post('user_id');
		$post['key'] = 'id';
		$post['update_field'] = json_encode(array("Locality_ids" => $this->input->post('locality_name'),"latitude" => $this->input->post('latitude'),"longitude" => $this->input->post('longitude')), true); 
		/*echo '<pre>';
		print_r($post);*/
		$response = $this->dashboard_model->update_page($post);
		if($response){
			echo '<script>window.location="'.site_url("dashboard/user_information/".$this->input->post('user_id')).'"</script>';
		}
	}
	public function subscribers(){
		$data['alldata'] = $this->dashboard_model->get_data_list('tbl_subscribe_list','id','DESC');
		$this->load->view('header');
		$this->load->view('subscriber/index', $data);
		$this->load->view('footer');
	}
	public function products(){
		$data['alldata'] = $this->dashboard_model->get_data_list('tbl_product_records','product_id','DESC');
		$this->load->view('header');
		$this->load->view('product/index', $data);
		$this->load->view('footer');
	}
	public function offers(){
		$data['alldata'] = $this->dashboard_model->get_data_list('tbl_offers_records','offer_id','DESC');
		$this->load->view('header');
		$this->load->view('offer/index', $data);
		$this->load->view('footer');
	}
	public function offers_plan(){
		$data['alldata'] = $this->dashboard_model->get_data_list('tbl_sponser_plans_records','id','DESC');
		$this->load->view('header');
		$this->load->view('offer/offer_plan', $data);
		$this->load->view('footer');
	}
	public function recomonded(){
		$data['alldata'] = $this->dashboard_model->getRecOfferList();
		$this->load->view('header');
		$this->load->view('offer/rec_list', $data);
		$this->load->view('footer');
	}
	public function add_to_recomonded_list(){
		$user_id = $this->input->post('value');
		$key = $this->input->post('key');
		$data = $this->dashboard_model->addToRecomondedList($key,$user_id);
		echo $data;
	}
	public function contents(){
		$data['alldata'] = $this->dashboard_model->get_data_list('tbl_content_records','content_id','DESC');
		$this->load->view('header');
		$this->load->view('content/index', $data);
		$this->load->view('footer');
	}
	public function blogs(){
		$data['alldata'] = $this->dashboard_model->get_data_list('tbl_blog_records','blog_id','DESC');
		$this->load->view('header');
		$this->load->view('blog/index', $data);
		$this->load->view('footer');
	}		
	public function get_data(){
		$table_name = $this->input->post('table_name');
		$value = $this->input->post('value');
		$key = $this->input->post('key');
		$data = $this->dashboard_model->getMultipleData($table_name,$key.'='.$value);
		echo json_encode($data, true);
	}		
	public function categories(){
		$data['alldata'] = $this->dashboard_model->get_category_list();
		/*if ($this->uri->segment(3) === FALSE){
        	$category_id = 0;
		}else{
			$category_id = $this->uri->segment(3);
			$data['data'] = $this->dashboard_model->getSingleData('tbl_category_records',array('category_id' => $category_id));
		}*/
		$this->load->view('header');
		$this->load->view('category/index', $data);
		$this->load->view('footer');
		
	}
	public function places(){
		$data['alldata'] = $this->dashboard_model->get_data_list('tbl_places_records','id', 'DESC');
		$this->load->view('header');
		$this->load->view('places/index', $data);
		$this->load->view('footer');
		
	}	
	public function localities(){
		$data['alldata'] = $this->dashboard_model->get_data_list('tbl_locality','id', 'DESC');
		$this->load->view('header');
		$this->load->view('places/localities', $data);
		$this->load->view('footer');
		
	}	
	public function add_sub_admin(){
		// create the data object
		$data = new stdClass();
		$data->parent_data = $this->dashboard_model->getMultipleData('tbl_state_records',array('status' => '1'));
		// load form helper and validation library
		$this->load->helper('form');
		$this->load->library('form_validation');
		// set validation rules
		$this->form_validation->set_rules('user_name', 'User Name', 'trim|required|min_length[2]|is_unique[admin.username]', array('is_unique' => 'This User Name already exists. Please choose another one.'));
		$this->form_validation->set_rules('admin_name', 'Admin Name', 'trim|required');
		$this->form_validation->set_rules('admin_email', 'Admin Email', 'trim|required');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[4]');
		$this->form_validation->set_rules('admin_type', 'Admin Type', 'trim|required');		
		$this->form_validation->set_rules('status', 'Status', 'trim|required');	
		if ($this->form_validation->run() === false) {
			
		// validation not ok, send validation errors to the view
		$this->load->view('header');
		$this->load->view('users/add_sub_admin', $data);
		$this->load->view('footer');
			
		} else {			
			if ($this->dashboard_model->add_admin($this->input->post())) {
				$data->success = "Admin successfully Added!";
				// user creation ok
				$this->load->view('header');
				$this->load->view('users/add_sub_admin', $data);
				$this->load->view('footer');
				
			} else {
				
				// user creation failed, this should never happen
				$data->error = 'There was a problem creating your new account. Please try again.';
				
				// send error to the view
				$this->load->view('header');
				$this->load->view('users/add_sub_admin', $data);
				$this->load->view('footer');
				
			}
			
		}
		
	}
	public function add_place(){
		// create the data object
		$data = new stdClass();
		$data->parent_data = $this->dashboard_model->getMultipleData('tbl_state_records',array('status' => '1'));
		// load form helper and validation library
		$this->load->helper('form');
		$this->load->library('form_validation');
		// set validation rules
		$this->form_validation->set_rules('city_name', 'City Name', 'trim|required|min_length[2]|is_unique[tbl_places_records.city_name]', array('is_unique' => 'This City Name already exists. Please choose another one.'));
		$this->form_validation->set_rules('status', 'Status', 'trim|required');
		$this->form_validation->set_rules('state', 'State', 'trim|required');

		
		if ($this->form_validation->run() === false) {
			
		// validation not ok, send validation errors to the view
		$this->load->view('header');
		$this->load->view('places/add_place', $data);
		$this->load->view('footer');
			
		} else {			
			if ($this->dashboard_model->add_place($this->input->post())) {
				$data->success = "City successfully Added!";
				$data->error = "";
				// user creation ok
				$this->load->view('header');
				$this->load->view('places/add_place', $data);
				$this->load->view('footer');
				
			} else {
				
				// user creation failed, this should never happen
				$data->error = 'There was a problem creating your new account. Please try again.';
				
				// send error to the view
				$this->load->view('header');
				$this->load->view('places/add_place', $data);
				$this->load->view('footer');
				
			}
			
		}
		
	}
	public function add_locality(){
		// create the data object
		$data = new stdClass();
		$data->parent_data = $this->dashboard_model->getMultipleData('tbl_places_records',array('status' => '1'));
		//$data->place_data = $this->dashboard_model->getMultipleData('tbl_state_records',array('status' => '1'));
		// load form helper and validation library
		$this->load->helper('form');
		$this->load->library('form_validation');
		// set validation rules
		$this->form_validation->set_rules('city', 'City ', 'trim|required');
		$this->form_validation->set_rules('locality_name', 'Locality Name', 'trim|required|min_length[2]|is_unique[tbl_locality.name]', array('is_unique' => 'This locality Name already exists. Please choose another one.'));
		$this->form_validation->set_rules('status', 'Status', 'trim|required');

		
		if ($this->form_validation->run() === false) {
			
		// validation not ok, send validation errors to the view
		$this->load->view('header');
		$this->load->view('places/add_locality', $data);
		$this->load->view('footer');
			
		} else {			
			if ($this->dashboard_model->add_locality($this->input->post())) {
				$data->success = "Locality successfully Added!";
				// user creation ok
				$this->load->view('header');
				$this->load->view('places/add_locality', $data);
				$this->load->view('footer');
				
			} else {
				
				// user creation failed, this should never happen
				$data->error = 'There was a problem creating your new account. Please try again.';
				
				// send error to the view
				$this->load->view('header');
				$this->load->view('places/add_locality', $data);
				$this->load->view('footer');
				
			}
			
		}
		
	}
	public function add_user(){
		// create the data object
		$data = new stdClass();
		// load form helper and validation library
		$this->load->helper('form');
		$this->load->library('form_validation');
		// set validation rules
		$this->form_validation->set_rules('first_name', 'First Name', 'trim|required|min_length[2]');
		$this->form_validation->set_rules('last_name', 'last Name', 'trim|required|min_length[2]');
		$this->form_validation->set_rules('email', 'Email', 'trim|required|min_length[2]|is_unique[tbl_user_records.email_id]', array('is_unique' => 'This Email already exists. Please choose another one.'));
		$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[5]');
		$this->form_validation->set_rules('mobile', 'Mobile', 'trim|required|min_length[2]|is_unique[tbl_user_records.mobile]', array('is_unique' => 'This Mobile already exists. Please choose another one.'));
		$this->form_validation->set_rules('status', 'Status', 'trim|required');

		
		if ($this->form_validation->run() === false) {
			//$data->success = "Category successfully Added!";
			// validation not ok, send validation errors to the view
		$this->load->view('header');
		$this->load->view('users/add_user', $data);
		$this->load->view('footer');
			
		} else {			
			if ($this->dashboard_model->add_user($this->input->post())) {
				$data->success = "User successfully Added!";
				// user creation ok
				$this->load->view('header');
				$this->load->view('users/add_user', $data);
				$this->load->view('footer');
				
			} else {
				
				// user creation failed, this should never happen
				$data->error = 'There was a problem creating your new account. Please try again.';
				
				// send error to the view
				$this->load->view('header');
				$this->load->view('users/add_user', $data);
				$this->load->view('footer');
				
			}
			
		}
		
	}
	public function add_category(){
		/*$data = $this->dashboard_model->add_category($this->input->post());
		if($data){
			redirect(site_url('Dashboard/categories'),301);
		}else{
			redirect(site_url('Dashboard/categories'),301);
		}*/
		// create the data object
		$data = new stdClass();
		$data->parent_data = $this->dashboard_model->getMultipleData('tbl_category_records',array('status' => '1'));
		// load form helper and validation library
		$this->load->helper('form');
		$this->load->library('form_validation');
		// set validation rules
		$this->form_validation->set_rules('category_name', 'Category Name', 'trim|required|min_length[2]');
		$this->form_validation->set_rules('status', 'Status', 'trim|required');

		
		if ($this->form_validation->run() === false) {
			//$data->success = "Category successfully Added!";
			// validation not ok, send validation errors to the view
		$this->load->view('header');
		$this->load->view('category/add_category', $data);
		$this->load->view('footer');
			
		} else {			
			if ($this->dashboard_model->add_category($this->input->post())) {
				$data->success = "Category successfully Added!";
				// user creation ok
				$this->load->view('header');
				$this->load->view('category/add_category', $data);
				$this->load->view('footer');
				
			} else {
				
				// user creation failed, this should never happen
				$data->error = 'There was a problem creating your new account. Please try again.';
				
				// send error to the view
				$this->load->view('header');
				$this->load->view('category/add_category', $data);
				$this->load->view('footer');
				
			}
			
		}
		
	}
	
	public function add_product(){
		$merchant_id = $this->uri->segment(3);
		// create the data object
		$data = new stdClass();
		$data->parent_data = $this->dashboard_model->getMultipleData('tbl_category_records',array('status' => '1',""));
		$data->merchant_info = $this->dashboard_model->getSingleData('tbl_user_records', array('id' => $merchant_id));
		// load form helper and validation library
		$this->load->helper('form');
		$this->load->library('form_validation');
		// set validation rules
		$this->form_validation->set_rules('product_name', 'Product Name', 'trim|required|min_length[2]');
		$this->form_validation->set_rules('category_name', 'Category Name', 'trim|required');
		$this->form_validation->set_rules('sub_category_name', 'Sub Category Name', 'trim|required');
		$this->form_validation->set_rules('status', 'Status', 'trim|required');

		
		if ($this->form_validation->run() === false) {
			//$data->success = "Category successfully Added!";
			// validation not ok, send validation errors to the view
		$this->load->view('header');
		$this->load->view('product/add_product', $data);
		$this->load->view('footer');
			
		} else {			
			if ($this->dashboard_model->add_product($this->input->post())) {
				$data->success = "Product successfully Added!";
				// user creation ok
				$this->load->view('header');
				$this->load->view('product/add_product', $data);
				$this->load->view('footer');
				
			} else {
				
				// user creation failed, this should never happen
				$data->error = 'There was a problem creating your new account. Please try again.';
				
				// send error to the view
				$this->load->view('header');
				$this->load->view('product/add_product', $data);
				$this->load->view('footer');
				
			}
			
		}
		
	}
	public function edit_product(){
		/*$data = $this->dashboard_model->add_category($this->input->post());
		if($data){
			redirect(site_url('Dashboard/categories'),301);
		}else{
			redirect(site_url('Dashboard/categories'),301);
		}*/
		
		// create the data object
		$product_id = $this->uri->segment(3);
		$data = new stdClass();
		$data->parent_data = $this->dashboard_model->getMultipleData('tbl_category_records',array('status' => '1'));
		$data->product_info = $this->dashboard_model->getSingleData('tbl_product_records',array('product_id' => $product_id));
		$data->merchant_info = $this->dashboard_model->getSingleData('tbl_user_records', array('id' => $data->product_info->user_id));
		$data->image_info = $this->dashboard_model->getMultipleData('tbl_product_images', array('product_id' => $product_id));
		//print_r($data->image_info);die;
		// load form helper and validation library
		$this->load->helper('form');
		$this->load->library('form_validation');
		// set validation rules
		$this->form_validation->set_rules('product_name', 'Product Name', 'trim|required|min_length[2]');
		$this->form_validation->set_rules('category_name', 'Category Name', 'trim|required');
		$this->form_validation->set_rules('sub_category_name', 'Sub Category Name', 'trim|required');
		$this->form_validation->set_rules('status', 'Status', 'trim|required');

		
		if ($this->form_validation->run() === false) {
			//$data->success = "Category successfully Added!";
			// validation not ok, send validation errors to the view
		$this->load->view('header');
		$this->load->view('product/edit_product', $data);
		$this->load->view('footer');
			
		} else {			
		
			if ($this->dashboard_model->edit_product($this->input->post())) {
				$data->success = "Product successfully Updated!";
				// user creation ok
				$this->load->view('header');
				$this->load->view('product/edit_product', $data);
				$this->load->view('footer');
				
			} else {
				
				// user creation failed, this should never happen
				$data->error = 'There was a problem creating your new account. Please try again.';
				
				// send error to the view
				$this->load->view('header');
				$this->load->view('product/edit_product', $data);
				$this->load->view('footer');
				
			}
			
		}
		
	}
	public function add_banner(){
		$product_id = $this->uri->segment(3);
		// create the data object
		$data = new stdClass();
		
		$data->product_info = $this->dashboard_model->getSingleData('tbl_product_records', array('product_id' => $product_id));
		//echo print_r($data->product_info->user_id); die;
		$data->product_list = $this->dashboard_model->getMultipleData('tbl_product_records',array('user_id' => $data->product_info->user_id));
		// load form helper and validation library
		$this->load->helper('form');
		$this->load->library('form_validation');
		// set validation rules
		$this->form_validation->set_rules('offer_name', 'Offer Name', 'trim|required|min_length[2]');
		$this->form_validation->set_rules('product_id', 'Product Id', 'trim|required');
		$this->form_validation->set_rules('status', 'Status', 'trim|required');

		
		if ($this->form_validation->run() === false) {
			//$data->success = "Category successfully Added!";
			// validation not ok, send validation errors to the view
		$this->load->view('header');
		$this->load->view('offer/add_offer', $data);
		$this->load->view('footer');
			
		} else {			
			if ($this->dashboard_model->add_offer($this->input->post())) {
				$data->success = "Banner successfully Added!";
				// user creation ok
				$this->load->view('header');
				$this->load->view('offer/add_banner', $data);
				$this->load->view('footer');
				
			} else {
				
				// user creation failed, this should never happen
				$data->error = 'There was a problem creating your new account. Please try again.';
				
				// send error to the view
				$this->load->view('header');
				$this->load->view('offer/add_offer', $data);
				$this->load->view('footer');
				
			}
			
		}
		
	}
	public function edit_offer(){
		/*$data = $this->dashboard_model->add_category($this->input->post());
		if($data){
			redirect(site_url('Dashboard/categories'),301);
		}else{
			redirect(site_url('Dashboard/categories'),301);
		}*/
		
		// create the data object
		$offer_id = $this->uri->segment(3);
		$data = new stdClass();
		$data->offer_info = $this->dashboard_model->getSingleData('tbl_offers_records', array('offer_id' => $offer_id));
		$data->product_info = $this->dashboard_model->getSingleData('tbl_product_records', array('product_id' => $data->offer_info->product_id));
		//echo print_r($data->product_info->user_id); die;
		$data->product_list = $this->dashboard_model->getMultipleData('tbl_product_records',array('user_id' => $data->product_info->user_id));
		$data->image_info = $this->dashboard_model->getMultipleData('tbl_offer_images', array('offer_id' => $offer_id));
		//print_r($data->image_info);die;
		// load form helper and validation library
		$this->load->helper('form');
		$this->load->library('form_validation');
		// set validation rules
		$this->form_validation->set_rules('offer_name', 'Offer Name', 'trim|required|min_length[2]');
		$this->form_validation->set_rules('product_id', 'Product id', 'trim|required');
		$this->form_validation->set_rules('status', 'Status', 'trim|required');

		
		if ($this->form_validation->run() === false) {
			//$data->success = "Category successfully Added!";
			// validation not ok, send validation errors to the view
		$this->load->view('header');
		$this->load->view('offer/edit_offer', $data);
		$this->load->view('footer');
			
		} else {			
		
			if ($this->dashboard_model->edit_offer($this->input->post())) {
				$data->success = "Offer successfully Updated!";
				// user creation ok
				$this->load->view('header');
				$this->load->view('offer/edit_offer', $data);
				$this->load->view('footer');
				
			} else {
				
				// user creation failed, this should never happen
				$data->error = 'There was a problem creating your new account. Please try again.';
				
				// send error to the view
				$this->load->view('header');
				$this->load->view('offer/edit_offer', $data);
				$this->load->view('footer');
				
			}
			
		}
		
	}	
	public function edit_category(){
		$category_id = $this->uri->segment(3);
		// create the data object
		$data = new stdClass();
		$data->parent_data = $this->dashboard_model->getMultipleData('tbl_category_records',array('status' => '1'));
		$data->data = $this->dashboard_model->getSingleData('tbl_category_records',array('category_id' => $category_id));
		// load form helper and validation library
		$this->load->helper('form');
		$this->load->library('form_validation');
		// set validation rules
		$this->form_validation->set_rules('category_name', 'Category Name', 'trim|required|min_length[2]');
		$this->form_validation->set_rules('status', 'Status', 'trim|required');

		
		if ($this->form_validation->run() === false) {
			
			// validation not ok, send validation errors to the view
		$this->load->view('header');
		$this->load->view('category/edit_category', $data);
		$this->load->view('footer');
			
		} else {			
			if ($this->dashboard_model->update_category($this->input->post())) {
				$data->success = "Category successfully Updated!";
				// user creation ok
				$this->load->view('header');
				$this->load->view('category/edit_category', $data);
				$this->load->view('footer');
				
			} else {
				
				// user creation failed, this should never happen
				$data->error = 'There was a problem creating your new account. Please try again.';
				
				// send error to the view
				$this->load->view('header');
				$this->load->view('category/edit_category', $data);
				$this->load->view('footer');
				
			}
			
		}
		
	}
	public function add_content(){
		// create the data object
		$data = new stdClass();
		//$data->parent_data = $this->dashboard_model->getMultipleData('tbl_content_records',array('content' => '1'));
		// load form helper and validation library
		$this->load->helper('form');
		$this->load->library('form_validation');
		// set validation rules
		$this->form_validation->set_rules('content_title', 'Page Title', 'trim|required|min_length[2]');
		$this->form_validation->set_rules('action', 'Page Slug', 'trim|required|min_length[2]|is_unique[tbl_content_records.action]', array('is_unique' => 'This Page Name already exists. Please choose another one.'));
		$this->form_validation->set_rules('status', 'Status', 'trim|required');

		
		if ($this->form_validation->run() === false) {

		$this->load->view('header');
		$this->load->view('content/add_content', $data);
		$this->load->view('footer');
			
		} else {			
			if ($this->dashboard_model->add_content($this->input->post())) {
				$data->success = "Content successfully Added!";
				// user creation ok
				$this->load->view('header');
				$this->load->view('content/add_content', $data);
				$this->load->view('footer');
				
			} else {
				
				// user creation failed, this should never happen
				$data->error = 'There was a problem creating your new account. Please try again.';
				
				// send error to the view
				$this->load->view('header');
				$this->load->view('content/add_content', $data);
				$this->load->view('footer');
				
			}
			
		}
		
	}
	public function edit_content(){
		$content_id = $this->uri->segment(3);
		
		//print_r($data);
		//exit;
		// create the data object
		$data = new stdClass();
		//$data->parent_data = $this->dashboard_model->getMultipleData('tbl_content_records',array('content' => '1'));
		// load form helper and validation library
		$data->data = $this->dashboard_model->getSingleData('tbl_content_records',array('content_id' => $content_id));
		$this->load->helper('form');
		$this->load->library('form_validation');
		// set validation rules
		$this->form_validation->set_rules('content_title', 'Page Title', 'trim|required|min_length[2]');
		if ($this->form_validation->run() === false) {
		
		$this->load->view('header');
		$this->load->view('content/edit_content', $data);
		$this->load->view('footer');
			
		} else {			
			if ($this->dashboard_model->update_content($this->input->post())) {
				$data->success = "Content successfully Updated!";
				// user creation ok
				$this->load->view('header');
				$this->load->view('content/edit_content', $data);
				$this->load->view('footer');
				
			} else {
				
				// user creation failed, this should never happen
				$data->error = 'There was a problem creating your new account. Please try again.';
				
				// send error to the view
				$this->load->view('header');
				$this->load->view('content/edit_content', $data);
				$this->load->view('footer');
				
			}
			
		}
	}
	public function push_notification(){// create the data object
		$data = new stdClass();
		$data->alldata = $this->dashboard_model->get_user_list();
		// load form helper and validation library
		$this->load->helper('form');
		$this->load->library('form_validation');
		// set validation rules
		$this->form_validation->set_rules('select_users_type', 'Select User Type', 'trim|required');
		$this->form_validation->set_rules('subject', 'Email Subject', 'trim|required');
		if ($this->form_validation->run() === false) {
		
		$this->load->view('header');
		$this->load->view('notification/push', $data);
		$this->load->view('footer');
			
		} else {
		/*echo $this->dashboard_model->sendEmailToUsers($this->input->post());
		exit;*/
					
			if ($this->dashboard_model->sendPushToUsers($this->input->post())) {
				$data->success = "Email successfully Sent!";
				// user creation ok
				$this->load->view('header');
				$this->load->view('notification/push', $data);
				$this->load->view('footer');
				
			} else {
				
				// user creation failed, this should never happen
				$data->error = 'There was a problem sending email. Please try again.';
				
				// send error to the view
				$this->load->view('header');
				$this->load->view('notification/push', $data);
				$this->load->view('footer');
				
			}
			
		}
		}
	public function email_notification(){
		// create the data object
		
		$data = new stdClass();
		$data->alldata = $this->dashboard_model->get_user_list();
		// load form helper and validation library
		$this->load->helper('form');
		$this->load->library('form_validation');
		// set validation rules
		$this->form_validation->set_rules('select_users_type', 'Select User Type', 'trim|required');
		$this->form_validation->set_rules('subject', 'Email Subject', 'trim|required');
		if ($this->form_validation->run() === false) {
		
		$this->load->view('header');
		$this->load->view('notification/email', $data);
		$this->load->view('footer');
			
		} else {
		/*echo $this->dashboard_model->sendEmailToUsers($this->input->post());
		exit;*/
					
			if ($this->dashboard_model->sendEmailToUsers($this->input->post())) {
				$data->success = "Email successfully Sent!";
				// user creation ok
				$this->load->view('header');
				$this->load->view('notification/email', $data);
				$this->load->view('footer');
				
			} else {
				
				// user creation failed, this should never happen
				$data->error = 'There was a problem sending email. Please try again.';
				
				// send error to the view
				$this->load->view('header');
				$this->load->view('notification/email', $data);
				$this->load->view('footer');
				
			}
			
		}
	}
	public function delete_page(){
		echo $this->dashboard_model->delete_page($this->input->post());
	}	
	public function update_page(){
		echo $this->dashboard_model->update_page($this->input->post());
	}		
	public function add_offer_sponsered(){
		$response = $this->dashboard_model->addOfferSponsered($this->input->post());
		if($response){
			echo '<script>window.location="'.site_url("dashboard/offer_information/".$this->input->post('offer_id')).'"</script>';
		}
	}	
	public function submit_merchant_info(){
		$post['action'] = 'update';
		$post['table_name'] = 'tbl_user_records';
		$post['value'] = $this->input->post('user_id');
		$post['key'] = 'id';
		//$array[] = array();
		if($_FILES["profile_pic"]["name"]){
		$profile_pic = $this->makeFileRename($_FILES["profile_pic"]["name"]);
			move_uploaded_file($_FILES["profile_pic"]["tmp_name"],
			"uploads/profile_pic/" .$profile_pic );
			$array['profile_pic'] = $profile_pic;
		}	
		if($_FILES["profile_pic"]["name"]){
		$cover_pic = $this->makeFileRename($_FILES["cover_pic"]["name"]);
			move_uploaded_file($_FILES["cover_pic"]["tmp_name"],
			"uploads/cover_pic/" .$cover_pic );
			$array['cover_pic'] = $cover_pic;
		}
		if(count($this->input->post('category')) > 0){
			$array['category_ids'] = implode(',',$this->input->post('category'));
		}
		if(count($this->input->post('sub_category')) > 0){
			$array['Subcategory_ids'] = implode(',',$this->input->post('sub_category'));
		}		
			//print_r($array); die;
		$post['update_field'] = json_encode($array, true); 

		$response = $this->dashboard_model->update_page($post);
		if($response){
			echo '<script>window.location="'.site_url("dashboard/user_information/".$this->input->post('user_id')).'"</script>';
		}
	}	
	function makeFileRename($file_name){
		$vl = explode('.', $file_name);
		$ext = end($vl);
		$imgName = str_replace('.'.$ext, '', $file_name);
		$finalImgName = $imgName."_".strtotime(date('y-m-d h:i:s')).".".$ext;
		$filename = trim(addslashes($finalImgName));
		return $finalImgName = str_replace(' ', '_', $filename);
	}
		/*start by RT filters*/
	public function add_filters(){
		// create the data object
		$data = new stdClass();
		//$data->parent_data = $this->dashboard_model->getMultipleData('tbl_content_records',array('content' => '1'));
		// load form helper and validation library
		$this->load->helper('form');
		$this->load->library('form_validation');
		// set validation rules
		/*$this->form_validation->set_rules('Name', 'Filter Name', 'trim|required|min_length[2]');*/
		/*$this->form_validation->set_rules('action', 'Page Slug', 'trim|required|min_length[2]|is_unique[tbl_Filters.action]', array('is_unique' => 'This Page Name already exists. Please choose another one.'));*/
		/*$this->form_validation->set_rules('status', 'Status', 'trim|required');*/

		
		if ($this->form_validation->run() === false) {

		$this->load->view('header');
		$this->load->view('filters/add_filters', $data);
		$this->load->view('footer');
			
		} else {			
			if ($this->dashboard_model->add_filters($this->input->post())) {
				$data->success = "Filters successfully Added!";
				// user creation ok
				$this->load->view('header');
				$this->load->view('filters/add_filters', $data);
				$this->load->view('footer');
				
			} else {
				
				// user creation failed, this should never happen
				$data->error = 'There was a problem creating your new account. Please try again.';
				
				// send error to the view
				$this->load->view('header');
				$this->load->view('filters/add_filters', $data);
				$this->load->view('footer');
				
			}
			
		}
		
	}
	public function edit_filters(){
		$content_id = $this->uri->segment(3);
		
		//print_r($data);
		//exit;
		// create the data object
		$data = new stdClass();
		//$data->parent_data = $this->dashboard_model->getMultipleData('tbl_content_records',array('content' => '1'));
		// load form helper and validation library
		$data->data = $this->dashboard_model->getSingleData('tbl_Filters',array('id' => $content_id));
		$this->load->helper('form');
		$this->load->library('form_validation');
		// set validation rules
		$this->form_validation->set_rules('Name', 'Filter Title', 'trim|required|min_length[2]');
		if ($this->form_validation->run() === false) {
		
		$this->load->view('header');
		$this->load->view('filters/edit_filters', $data);
		$this->load->view('footer');
			
		} else {			
			if ($this->dashboard_model->update_filters($this->input->post())) {
				$data->success = "filters successfully Updated!";
				// user creation ok
				$this->load->view('header');
				$this->load->view('filters/edit_filters', $data);
				$this->load->view('footer');
				
			} else {
				
				// user creation failed, this should never happen
				$data->error = 'There was a problem creating your new account. Please try again.';
				
				// send error to the view
				$this->load->view('header');
				$this->load->view('filters/edit_filters', $data);
				$this->load->view('footer');
				
			}
			
		}
	}
	/*end by RT*/
	public function filters(){
		$data['alldata'] = $this->dashboard_model->get_data_list('tbl_Filters','id','DESC');
		$this->load->view('header');
		$this->load->view('filters/index', $data);
		$this->load->view('footer');
	}
	public function recommend(){
		$data['alldata'] = $this->dashboard_model->get_data_list('tbl_recommeded_merchant','id','DESC');
		$this->load->view('header');
		$this->load->view('recommend/index', $data);
		$this->load->view('footer');
	}
}
