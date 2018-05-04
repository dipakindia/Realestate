<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
error_reporting(1);
class Mobile_api extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('User_model','',true);
		$this->load->model('Api_model','',true);
	}
	public function index()
	{
		echo '<div style="clear:both; height:150px;"></div>';
		echo '<center><h1 style="background: rgb(51, 102, 153) none repeat scroll 0px 0px; border-radius: 0px 50px 0px 49px; padding: 15px 44px; font: 35px calibri; color: rgb(255, 255, 255); width: 50px;">PA</h1></center>';
		echo '<h1 align="center" style="color:#369; font:50px calibri;">Property App Mobile API</h1>';
	}
	public function send_notification(){
	$result = $this->Api_model->sendAllUserPushNotification($_REQUEST);
	//print_r($result);
	$this->session->set_userdata('succ_msg','Notifications succesfully sent.');
	redirect(base_url('admin/manage_notification') , 'refresh');
	/*echo '<script>window.location="'.base_url('admin/manage_notification').'"</script>';*/
	}
	public function api(){
	
	$action = $_REQUEST['action'];
	if($action!=''){
		switch ($action){
			// Social check API 
			case "get_categories":
			$result = $this->Api_model->allCategoriesList($_REQUEST);
			echo json_encode($result,JSON_UNESCAPED_SLASHES);
			break;
			case "all_tab_list":
			$result = $this->Api_model->allTabList($_REQUEST);
			echo json_encode($result,JSON_UNESCAPED_SLASHES);
			break;
			case "user_login":
			$result = $this->Api_model->userLogin($_REQUEST);
			echo json_encode($result,JSON_UNESCAPED_SLASHES);
			break;
			case "user_register":
			$result = $this->Api_model->userRegister($_REQUEST);
			echo json_encode($result,JSON_UNESCAPED_SLASHES);
			break;
			case "get_user_info":
			$result =  $this->Api_model->getUserInfo($_REQUEST);
			header('Content-type: application/json');
			echo json_encode($result);
			break;	
			case "get_content_data":
			$result =  $this->Api_model->getContentData($_REQUEST);
			header('Content-type: application/json');
			echo json_encode($result);
			break;				
			case "get_places_list":
			$result = $this->Api_model->allPlacesList($_REQUEST);
			echo json_encode($result,JSON_UNESCAPED_SLASHES);
			break;
			case "upgrade_account_to_merchant":
			$result = $this->Api_model->upgradeAccountToMerchant($_REQUEST);
			echo json_encode($result,JSON_UNESCAPED_SLASHES);
			break;
			case "user_logout":
			$result = $this->Api_model->userLogout($_REQUEST);
			echo json_encode($result,JSON_UNESCAPED_SLASHES);
			break;
			case "change_password":
			$result = $this->Api_model->changePasword($_REQUEST);
			echo json_encode($result,JSON_UNESCAPED_SLASHES);
			break;			
			case "send_token_id":
			$result = $this->Api_model->updateTokenId($_REQUEST);
			echo json_encode($result,JSON_UNESCAPED_SLASHES);
			break;
			case "update_profile":
			$result = $this->Api_model->updateProfile($_REQUEST);
			echo json_encode($result,JSON_UNESCAPED_SLASHES);
			break;
			case "get_product_list":
			$result = $this->Api_model->getProductWithOffer($_REQUEST);
			echo json_encode($result,JSON_UNESCAPED_SLASHES);
			break;			
			case "get_product_details":
			$result = $this->Api_model->getProductWithOfferDetails($_REQUEST);
			echo json_encode($result,JSON_UNESCAPED_SLASHES);
			break;		
			case "merchent_details_with_offer_list":
			$result = $this->Api_model->allMerchentOfferLists($_REQUEST);
			echo json_encode($result,JSON_UNESCAPED_SLASHES);
			break;	
			case "search_location_by_area_pincode":
			$result = $this->Api_model->searchLocationByAreaPincode($_REQUEST);
			echo json_encode($result,JSON_UNESCAPED_SLASHES);
			break;
			case "click_banner_count_data":
			$result = $this->Api_model->clickBannerCountData($_REQUEST);
			echo json_encode($result,JSON_UNESCAPED_SLASHES);
			break;					
			case "user_points_redeeme":
			$result = $this->Api_model->userPointRedeeme($_REQUEST);
			echo json_encode($result,JSON_UNESCAPED_SLASHES);
			break;	
			case "user_rate_offers":
			$result = $this->Api_model->userRateOffers($_REQUEST);
			echo json_encode($result,JSON_UNESCAPED_SLASHES);
			break;	
			case "save_app_rating":
			$result = $this->Api_model->saveAppRating($_REQUEST);
			echo json_encode($result,JSON_UNESCAPED_SLASHES);
			break;	
			case "get_area_by_city_name":
			$result = $this->Api_model->getAreaByCityName($_REQUEST);
			echo json_encode($result,JSON_UNESCAPED_SLASHES);
			break;	
			case "get_city_list":
			$result = $this->Api_model->getCityList($_REQUEST);
			echo json_encode($result,JSON_UNESCAPED_SLASHES);
			break;
			case "verify_location":
			$result = $this->Api_model->checkServicesAvailable($_REQUEST);
			echo json_encode($result,JSON_UNESCAPED_SLASHES);
			break;	
			case "get_wallet_data":
			$result = $this->Api_model->getWalletData($_REQUEST);
			echo json_encode($result,JSON_UNESCAPED_SLASHES);
			break;
			case "delete_address":
			$result = $this->Api_model->deleteAddress($_REQUEST);
			echo json_encode($result,JSON_UNESCAPED_SLASHES);
			break;	
			case "contact_us":
			$result = $this->Api_model->getContactUs($_REQUEST);
			echo json_encode($result,JSON_UNESCAPED_SLASHES);
			break;		
			case "all_news_list":
			$result= $this->Api_model->allNewsLists($_REQUEST);
			echo json_encode($result,JSON_UNESCAPED_SLASHES);
			break;		
			case "add_request":
			$result= $this->Api_model->addRequest($_REQUEST);
			echo json_encode($result,JSON_UNESCAPED_SLASHES);
			break;		
			case "create_order":
			$result= $this->Api_model->createOrder($_REQUEST);
			echo json_encode($result,JSON_UNESCAPED_SLASHES);
			break;		
			case "send_push":
			$result= $this->Api_model->simplePushDemo($_REQUEST);
			echo json_encode($result,JSON_UNESCAPED_SLASHES);
			break;	
			case "order_list":
			$result= $this->Api_model->getOrderLists($_REQUEST);
			echo json_encode($result,JSON_UNESCAPED_SLASHES);
			break;	
			case "notify_me":
			$result= $this->Api_model->notifyMe($_REQUEST);
			echo json_encode($result,JSON_UNESCAPED_SLASHES);
			break;							
			case "offer_mail":			
			$result = $this->Api_model->offerMail($_REQUEST);			
			echo json_encode($result,JSON_UNESCAPED_SLASHES);			
			break;
			case "all_merchant_data":			
			$result = $this->Api_model->allMerchantData($_REQUEST);			
			echo json_encode($result,JSON_UNESCAPED_SLASHES);			
			break;
			case "all_city_data":			
			$result = $this->Api_model->allCityData($_REQUEST);			
			echo json_encode($result,JSON_UNESCAPED_SLASHES);			
			break;

			case "user_validation":			
			$result = $this->Api_model->userValidation($_REQUEST);			
			echo json_encode($result,JSON_UNESCAPED_SLASHES);			
			break;

			//delete product
			case "delete_product":
			$result = $this->Api_model->DeleteProduct($_REQUEST);
			echo json_encode($result, JSON_UNESCAPED_SLASHES);
			break;

			//delete offer
			case "delete_offer":
			$result = $this->Api_model->DeleteOffer($_REQUEST);
			echo json_encode($result, JSON_UNESCAPED_SLASHES);
			break;

			//Add offer
			case "add_offer":
			$result = $this->Api_model->AddOffer($_REQUEST);
			echo json_encode($result ,JSON_UNESCAPED_SLASHES);
			break;



		} 
		}else{
			$result = array("status"=> 0, "statusCode"=>0, "msg" => "No Action Found!!" );			
			echo json_encode($result,JSON_UNESCAPED_SLASHES);
		}
	}
}