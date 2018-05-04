<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('getCategoryName')){
    function getCategoryName($category_id){
    $CI = get_instance();
    // You may need to load the model if it hasn't been pre-loaded
    $CI->load->model('dashboard_model');
    // Call a function of the model
    $data = $CI->dashboard_model->getSingleData('tbl_category_records',array("category_id" => $category_id));
	return $data->category_name;
    }   
}
if ( ! function_exists('getUserName')){
    function getUserName($user_id){
    $CI = get_instance();
    // You may need to load the model if it hasn't been pre-loaded
    $CI->load->model('dashboard_model');
    // Call a function of the model
    $data = $CI->dashboard_model->getSingleData('tbl_user_records',array("id" => $user_id));
	return $data->first_name;
    }   
}
if ( ! function_exists('getProductName')){
    function getProductName($product_id){
    $CI = get_instance();
    // You may need to load the model if it hasn't been pre-loaded
    $CI->load->model('dashboard_model');
    // Call a function of the model
    $data = $CI->dashboard_model->getSingleData('tbl_product_records',array("product_id" => $product_id));
	return $data->product_title;
    }   
}
if ( ! function_exists('getCityWithLocalityName')){
    function getCityWithLocalityName($locality_id){
    $CI = get_instance();
    // You may need to load the model if it hasn't been pre-loaded
    $CI->load->model('dashboard_model');
    // Call a function of the model
    $dataLoc = $CI->dashboard_model->getSingleData('tbl_locality',"id = ".$locality_id);
	$data = $CI->dashboard_model->getSingleData('tbl_places_records',"id =".$dataLoc->city_id);
	return $data->city_name.' >> '.$dataLoc->name;
    }   
}
if ( ! function_exists('getCityName')){
    function getCityName($city_id){
    $CI = get_instance();
    // You may need to load the model if it hasn't been pre-loaded
    $CI->load->model('dashboard_model');
    // Call a function of the model
	$data = $CI->dashboard_model->getSingleData('tbl_places_records',"id =".$city_id);
	return $data->city_name;
    }   
}
if ( ! function_exists('getofferSponsered')){
    function getofferSponsered($offer_id){
    $CI = get_instance();
    // You may need to load the model if it hasn't been pre-loaded
    $CI->load->model('dashboard_model');
    // Call a function of the model
	$datat = $CI->dashboard_model->getSingleData('tbl_offers_records',"offer_id =".$offer_id);
	$data = $CI->dashboard_model->getSingleData('tbl_offer_sponsered_records',"offer_id =".$offer_id);
	$data->title = $datat->offer_title;
	return $data;
    }   
}
?>