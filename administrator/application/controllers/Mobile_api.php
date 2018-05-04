<?php
if (!defined('BASEPATH')){
    exit('No direct script access allowed');
}
error_reporting(1);

class Mobile_api extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('User_model', '', true);
        $this->load->model('Api_model', '', true);
    }

    public function index() {
        echo '<div style="clear:both; height:0px;"></div>';
        echo '<center><img src="' . BASE_URLD . 'uploads/logo.png" title="Property App" alt="Property App" /></center>';
        echo '<h1 align="center" style="color:#369; font:50px calibri;">Property App Mobile API</h1>';
    }

    public function send_notification() {
        $result = $this->Api_model->sendAllUserPushNotification($_REQUEST);
        //print_r($result);
        $this->session->set_userdata('succ_msg', 'Notifications succesfully sent.');
        redirect(base_url('admin/manage_notification'), 'refresh');
        /* echo '<script>window.location="'.base_url('admin/manage_notification').'"</script>'; */
    }

    public function api() {

        $action = $_REQUEST['action'];
        if ($action != '') {
            switch ($action) {
                // Social check API 
                case "get_categories":
                    $result = $this->Api_model->allCategoriesList($_REQUEST);
                    echo json_encode($result, JSON_UNESCAPED_SLASHES);
                    break;
                case "all_tab_list":
                    $result = $this->Api_model->allTabList($_REQUEST);
                    echo json_encode($result, JSON_UNESCAPED_SLASHES);
                    break;
                case "user_login":
                    $result = $this->Api_model->userLogin($_REQUEST);
                    echo json_encode($result, JSON_UNESCAPED_SLASHES);
                    break;
                case "user_register":
                    $result = $this->Api_model->userRegister($_REQUEST);
                    echo json_encode($result, JSON_UNESCAPED_SLASHES);
                    break;
                case "get_user_info":
                    $result = $this->Api_model->getUserInfo($_REQUEST);
                    header('Content-type: application/json');
                    echo json_encode($result);
                    break;
                case "get_merchant_info":
                    $result = $this->Api_model->getMerchantInfo($_REQUEST);
                    header('Content-type: application/json');
                    echo json_encode($result);
                    break;					
                case "get_content_data":
                    $result = $this->Api_model->getContentData($_REQUEST);
                    header('Content-type: application/json');
                    echo json_encode($result);
                    break;
                case "get_places_list":
                    $result = $this->Api_model->allPlacesList($_REQUEST);
                    echo json_encode($result, JSON_UNESCAPED_SLASHES);
                    break;
                case "upgrade_account_to_merchant":
                    $result = $this->Api_model->upgradeAccountToMerchant($_REQUEST);
                    echo json_encode($result, JSON_UNESCAPED_SLASHES);
                    break;
                case "user_logout":
                    $result = $this->Api_model->userLogout($_REQUEST);
                    echo json_encode($result, JSON_UNESCAPED_SLASHES);
                    break;
                case "change_password":
                    $result = $this->Api_model->changePasword($_REQUEST);
                    echo json_encode($result, JSON_UNESCAPED_SLASHES);
                    break;
                case "send_token_id":
                    $result = $this->Api_model->updateTokenId($_REQUEST);
                    echo json_encode($result, JSON_UNESCAPED_SLASHES);
                    break;
                case "update_profile":
                    $result = $this->Api_model->updateProfile($_REQUEST);
                    echo json_encode($result, JSON_UNESCAPED_SLASHES);
                    break;
                case "get_product_list":
                    $result = $this->Api_model->getProductWithOffer($_REQUEST);
                    echo json_encode($result, JSON_UNESCAPED_SLASHES);
                    break;
                case "get_product_details":
                    $result = $this->Api_model->getProductWithOfferDetails($_REQUEST);
                    echo json_encode($result, JSON_UNESCAPED_SLASHES);
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
                    $result = $this->Api_model->addOffer($_REQUEST);
                    echo json_encode($result, JSON_UNESCAPED_SLASHES);
                    break;
                //Add Product
                case "add_product":
                    $result = $this->Api_model->addProduct($_REQUEST);
                    echo json_encode($result, JSON_UNESCAPED_SLASHES);
                    break;
                //Add Product
                case "add_product_image":
                    $result = $this->Api_model->addProductImages($_REQUEST);
                    echo json_encode($result, JSON_UNESCAPED_SLASHES);
                    break;
                case "update_product":
                    $result = $this->Api_model->updateProduct($_REQUEST);
                    echo json_encode($result, JSON_UNESCAPED_SLASHES);
                    break;
                case "update_offer":
                    $result = $this->Api_model->updateOffer($_REQUEST);
                    echo json_encode($result, JSON_UNESCAPED_SLASHES);
                    break;
                //Add Product
                case "add_offer_image":
                    $result = $this->Api_model->addOfferImages($_REQUEST);
                    echo json_encode($result, JSON_UNESCAPED_SLASHES);
                    break;
                //Add Product
                case "delete_product_image":
                    $result = $this->Api_model->deleteProductImages($_REQUEST);
                    echo json_encode($result, JSON_UNESCAPED_SLASHES);
                    break;
                //Delete Offer Image
                case "delete_offer_image":
                    $result = $this->Api_model->deleteOfferImages($_REQUEST);
                    echo json_encode($result, JSON_UNESCAPED_SLASHES);
                    break;
                //Subscription
                case "add_subscribe":
                    $result = $this->Api_model->addSubscribeList($_REQUEST);
                    echo json_encode($result, JSON_UNESCAPED_SLASHES);
                    break;
                //Get News Feeds
                case "get_news_feeds":
                    $result = $this->Api_model->getNewsData($_REQUEST);
                    echo json_encode($result, JSON_UNESCAPED_SLASHES);
                    break;
                //Get Recomnded
                case "get_recommended":
                    $result = $this->Api_model->getRecommendedList($_REQUEST);
                    echo json_encode($result, JSON_UNESCAPED_SLASHES);
                    break;
                //Get Recomnded
                case "like_feed":
                    $result = $this->Api_model->likeFeed($_REQUEST);
                    echo json_encode($result, JSON_UNESCAPED_SLASHES);
                    break;
                //Get Recomnded
                case "comment_feed":
                    $result = $this->Api_model->commentFeed($_REQUEST);
                    echo json_encode($result, JSON_UNESCAPED_SLASHES);
                    break;
                //Get Offer Details
                case "offer_details":
                    $result = $this->Api_model->offerDetails($_REQUEST);
                    echo json_encode($result, JSON_UNESCAPED_SLASHES);
                    break;
                //Get Offer Details
                case "send_otp":
                    $result = $this->Api_model->sendOtpByMobile($_REQUEST);
                    echo json_encode($result, JSON_UNESCAPED_SLASHES);
                    break;
                case "get_comment_list":
                    $result = $this->Api_model->getofferCommentListData($_REQUEST);
                    echo json_encode($result, JSON_UNESCAPED_SLASHES);
                    break;
                case "send_recommended_request":
                    $result = $this->Api_model->sendRecomondedRequest($_REQUEST);
                    echo json_encode($result, JSON_UNESCAPED_SLASHES);
                    break;
                case "get_near_by":
                    $result = $this->Api_model->getNearByOffer($_REQUEST);
                    echo json_encode($result, JSON_UNESCAPED_SLASHES);
                    break;
                case "get_notification_list":
                    $result = $this->Api_model->getNotificationList($_REQUEST);
                    echo json_encode($result, JSON_UNESCAPED_SLASHES);
                    break;
                  
                case "add_contact_us":
                    $result = $this->Api_model->getContact($_REQUEST);
                    echo json_encode($result, JSON_UNESCAPED_SLASHES);
                    break;
                case "add_comment_enquiry":
                    $result = $this->Api_model->addCommentEnquiry($_REQUEST);
                    echo json_encode($result, JSON_UNESCAPED_SLASHES);
                    break;
                case "list_enquiry":
                    $result = $this->Api_model->listEnquiry($_REQUEST);
                    echo json_encode($result, JSON_UNESCAPED_SLASHES);
                    break;
                case "my_enquiry":
                    $result = $this->Api_model->myEnquiry($_REQUEST);
                    echo json_encode($result, JSON_UNESCAPED_SLASHES);
                    break;
                case "change_enquiry_status":
                    $result = $this->Api_model->changeEnquiryStatus($_REQUEST);
                    echo json_encode($result, JSON_UNESCAPED_SLASHES);
                    break;

                /*make new api by RT*/    
                case "update_enquiry_status":
                    $result = $this->Api_model->UpdateEnquiryStatus($_REQUEST);
                    echo json_encode($result, JSON_UNESCAPED_SLASHES);
                    break;
                case "update_enquiry_closed":
                    $result = $this->Api_model->UpdateEnquiryClosed($_REQUEST);
                    echo json_encode($result, JSON_UNESCAPED_SLASHES);
                    break;                    
                case "change_user_view_phone_email":
                    $result = $this->Api_model->changeUserViewPhoneEmail($_REQUEST);
                    echo json_encode($result, JSON_UNESCAPED_SLASHES);
                    break;      

                case "enquiry_details_product":
                    $result = $this->Api_model->enquiryDetailsProduct($_REQUEST);
                    echo json_encode($result, JSON_UNESCAPED_SLASHES);
                    break;

                case "delete_subscriber":
                    $result = $this->Api_model->DeleteSubscriber($_REQUEST);
                    echo json_encode($result, JSON_UNESCAPED_SLASHES);
                    break;  

                /*RT 21 july Enquiry for product*/
                case "add_enquiry_product":
                    $result = $this->Api_model->addEnquiryProduct($_REQUEST);
                    echo json_encode($result, JSON_UNESCAPED_SLASHES);
                    break;
                case "list_enquiry_product":
                    $result = $this->Api_model->listEnquiryProduct($_REQUEST);
                    echo json_encode($result, JSON_UNESCAPED_SLASHES);
                    break;
                /*end new api */    

                case "enquiry_details":
                    $result = $this->Api_model->enquiryDetails($_REQUEST);
                    echo json_encode($result, JSON_UNESCAPED_SLASHES);
                    break;
                case "enquiry_rating":
                    $result = $this->Api_model->enquiryRating($_REQUEST);
                    echo json_encode($result, JSON_UNESCAPED_SLASHES);
                    break;
                case "search_merchant":
                    $result = $this->Api_model->searchMerchant($_REQUEST);
                    echo json_encode($result, JSON_UNESCAPED_SLASHES);
                    break;
                case "search_merchant_by_text":
                    $result = $this->Api_model->searchMerchantByText($_REQUEST);
                    echo json_encode($result, JSON_UNESCAPED_SLASHES);
                    break;                    
                case "get_feed":
                    $result = $this->Api_model->getFeedList($_REQUEST);
                    echo json_encode($result, JSON_UNESCAPED_SLASHES);
                    break;
				case "forgot_password":
                    $result = $this->Api_model->forgotPassword($_REQUEST);
                    echo json_encode($result, JSON_UNESCAPED_SLASHES);
                    break;	
				case "report_offer":
                    $result = $this->Api_model->reportOffers($_REQUEST);
                    echo json_encode($result, JSON_UNESCAPED_SLASHES);
                    break;						
            }
        } else {
            $result = array("status" => 0, "statusCode" => 0, "msg" => "No Action Found!!");
            echo json_encode($result, JSON_UNESCAPED_SLASHES);
        }
    }

}
