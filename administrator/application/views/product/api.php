<?php 
include('includes/api_functions.php');
include("includes/api_constant.php");
//print_r($_REQUEST); die('ss');
//define(GET_PUB_DETAILS,"get_pub_details");
// Action from API
$action = $_REQUEST['action'];
//echo $action;die;
if($action != ""){
switch($action){
	// User login
	case USER_LOGIN:
	$result = userLogin($_REQUEST);

	header('Content-type: application/json');
	echo json_encode($result);
	break;
	//user Register
	case USER_REGISTER:
	$result = userRegister($_REQUEST);
	header('Content-type: application/json');
	echo json_encode($result);
	break;
	//forgot password
	case FORGET_PASSWORD:
	$result = forgotPassword($_REQUEST);
	header('Content-type: application/json');
	echo json_encode($result);
	break;
	//change password
	case CHANGE_PASSWORD:
	$result = changePasword($_REQUEST);
	header('Content-type: application/json');
	echo json_encode($result);
	break;
	case "search_event_listing":
	$result = getEventSearchListing($_REQUEST);
	header('Content-type: application/json');
	echo json_encode($result);
	break;
	case "event_list":
	$result = getEventList($_REQUEST);
	header('Content-type: application/json');
	echo json_encode($result);
	break;
	case "add_event_favorite":
	$result = addEventFavorite($_REQUEST);
	header('Content-type: application/json');
	echo json_encode($result);
	break;
	case "update_token_id":
	$result = updateTokenId($_REQUEST);
	header('Content-type: application/json');
	echo json_encode($result);
	break;
	case social_login:
	$result = socialLogin($_REQUEST);
	header('Content-type: application/json');
	echo json_encode($result);
	break;
	case 'add_user_frnd_list':
	$result = addUserFriendList($_REQUEST);
	header('Content-type: application/json');
	echo json_encode($result);
	break;
	case 'action_user_friend_request':
	$result = actionUserFriendList($_REQUEST);
	header('Content-type: application/json');
	echo json_encode($result);
	break;
	case "get_user_frnd_list":
	$result = getUserFriendList($_REQUEST);
	header('Content-type: application/json');
	echo json_encode($result);
	break;
	case "get_user_friend_request":
	$result = getUserFriendRequest($_REQUEST);
	header('Content-type: application/json');
	echo json_encode($result);
	break;
	case user_profile_detail:
	$result = getUserProfile($_REQUEST);
	header('Content-type: application/json');
	echo json_encode($result);
	break;
	case update_user_profile_detail:
	$result = updateUserProfile($_REQUEST);
	header('Content-type: application/json');
	echo json_encode($result);
	break;	
    case "search_user_by_name_email":
	$result = searchUserByNameEmail($_REQUEST);
	header('Content-type: application/json');
	echo json_encode($result);
	break;		
    case "add_event":
	$result = addEvent($_REQUEST);
	header('Content-type: application/json');
	echo json_encode($result);
	break;	
	case "get_all_speakers":
	$result = getAllSpeakers($_REQUEST);
	header('Content-type: application/json');
	echo json_encode($result);
	break;	
	case "get_all_sponsers":
	$result = getAllSponsers($_REQUEST);
	header('Content-type: application/json');
	echo json_encode($result);
	break;	
	case "get_agenda_list":
	$result = getAllAgenda($_REQUEST);
	header('Content-type: application/json');
	echo json_encode($result);
	break;	
	case "get_ance_refral_list":
	$result = getAnceRefralList($_REQUEST);
	header('Content-type: application/json');
	echo json_encode($result);
	break;
	case "add_ticket":
	$result = addTicket($_REQUEST);
	header('Content-type: application/json');
	echo json_encode($result);
	break;
	case "get_winner_list":
	$result = getWinnerList($_REQUEST);
	header('Content-type: application/json');
	echo json_encode($result);
	break;	
	case "get_blog_list":
	$result = listBlogs($_REQUEST);
	header('Content-type: application/json');
	echo json_encode($result);
	break;	
	case "get_my_blog_list":
	$result = myListBlogs($_REQUEST);
	header('Content-type: application/json');
	echo json_encode($result);
	break;	

	case "add_blog":
	$result = addBlog($_REQUEST);
	header('Content-type: application/json');
	echo json_encode($result);
	break;	
	case "update_blog":
	$result = updateBlog($_REQUEST);
	header('Content-type: application/json');
	echo json_encode($result);
	break;	
	case "delete_blog":
	$result = deleteBlog($_REQUEST);
	header('Content-type: application/json');
	echo json_encode($result);
	break;	
	case "like_feed":
	$result = likeFeed($_REQUEST);
	header('Content-type: application/json');
	echo json_encode($result);
	break;	
	case "get_all_awards":
	$result = getAllAwards($_REQUEST);
	header('Content-type: application/json');
	echo json_encode($result);
	break;	
	case "get_user_event_list":
	$result = getUserEventList($_REQUEST);
	header('Content-type: application/json');
	echo json_encode($result);
	break;	
	case "get_gallery_list":
	$result = getGalleryList($_REQUEST);
	header('Content-type: application/json');
	echo json_encode($result);
	break;
	case "add_gallery":
	$result = addGallery($_REQUEST);
	header('Content-type: application/json');
	echo json_encode($result);
	break;									    
}
}else{
	$result =  array("status"=>0, "statusCode"=>0, "msg" => "No action Found!!");
	header('Content-type: application/json');
	echo json_encode($result);
}

		
?>