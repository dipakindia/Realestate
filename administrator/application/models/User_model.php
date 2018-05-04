<?php
class User_model extends CI_Model {
function __construct(){			
	parent::__construct();
}
public function saveNotification($post){
	//print_r($post);
	$check_date_time_scedule = $this->input->post('check_date_time_scedule');
	$schedule_date_time = date("Y-m-d", strtotime($this->input->post('schedule_date_time'))).' '.$this->input->post('schedule_time');
	$date_schedule_content = $this->input->post('date_schedule_content');
	$check_date_scedule = $this->input->post('schedule_date_time');
	$day_notification_content = $this->input->post('day_notification_content');
	$check_for_new_post_notification = $this->input->post('check_for_new_post_notification');
	$user_id = $this->session->userdata('userID');
	$newDate = date("Y-m-d H:i:s", strtotime($schedule_date_time));
	if($newDate!='' && $date_schedule_content!='' && $check_date_time_scedule!=''){
	$dataArray = array('user_id' => $user_id, 'date_time' => $newDate,'text_for_notification_mail' => $date_schedule_content, 'status' => '1','added_date' => date("Y-m-d H:i:s"));
	//echo '<pre>';
	//print_r($dataArray);

	$sql = $this->db->query("SELECT * FROM `schedule_notification` WHERE `user_id` = '".$user_id."'"); 
		if($sql->num_rows($sql) > 0){
			$result = $this->db->update('schedule_notification',$dataArray,'user_id ="'.$user_id.'"');
		}else{
			$result = $this->db->insert('schedule_notification',$dataArray);
		}
	}
	//echo $this->db->last_query();
	//exit();
	if($check_date_scedule!=''){
		$dataArray1 = array('user_id' => $user_id,'notification_text' => $day_notification_content, 'status' => '1','added_date' => date("Y-m-d H:i:s"));
		$sql1 = $this->db->query("SELECT * FROM `user_day_notification` WHERE `user_id` = '".$user_id."'"); 
		if($sql1->num_rows($sql) > 0){
			$result = $this->db->update('user_day_notification',$dataArray1,'user_id ="'.$user_id.'"');
		}else{
			$result = $this->db->insert('user_day_notification',$dataArray1);
		}
	}
	if($check_for_new_post_notification!=''){
		$dataArray2 = array('user_id' => $user_id,'status' => '1','added_date' => date("Y-m-d H:i:s"));
		$sql2 = $this->db->query("SELECT * FROM `new_post_notification` WHERE `user_id` = '".$user_id."'"); 
		if($sql2->num_rows($sql) > 0){
			$result = $this->db->update('new_post_notification',$dataArray2,'user_id ="'.$user_id.'"');
		}else{
			$result = $this->db->insert('new_post_notification',$dataArray2);
		}
	}else{
		$result = $this->db->delete('new_post_notification','user_id ="'.$user_id.'"');
	}
	
			
	if($result){ 
		return true;
	}else{ 
		return false;
	}
}
public function getNotificationData($user_id){
$this->db->select('date_time,text_for_notification_mail', FALSE);  
	$this->db->from('schedule_notification');  
	$this->db->where('schedule_notification.user_id',$user_id);  
	$query = $this->db->get();     
	$details = array();  
	if($query->num_rows() > 0){  
		foreach($query->result() as $row){  
			$details = $row;  
		}  
	}else{
		$details = array();
	}  
	return $details;  
}
public function getNotificationData2($user_id){
$this->db->select('notification_text', FALSE);  
	$this->db->from('user_day_notification');  
	$this->db->where('user_day_notification.user_id',$user_id);  
	$query = $this->db->get();     
	$details = array();  
	if($query->num_rows() > 0){  
		foreach($query->result() as $row){  
			$details = $row;  
		}  
	}else{
		$details = array();
	}  
	return $details;  
}
public function getNotificationData3($user_id){
	$this->db->select('user_id');  
	$this->db->from('new_post_notification');  
	$this->db->where('new_post_notification.user_id',$user_id);  
	$query = $this->db->get();     
	$details = array();  
	if($query->num_rows() > 0){    
		$details = array('new_post_notification'=>1);  
	}else{
		$details = array('new_post_notification'=>0);  
	}  
	return $details;  
}
public function getCategories(){
	$this->db->select('*');  
	$this->db->from('menu_category');  
	$this->db->where('menu_category.status','1');  
	$query = $this->db->get();     
	$details = array();  
	if($query->num_rows() > 0){  
		foreach($query->result() as $row){  
			$details[] = $row;  
		}  
	}else{
		$details = array();
	}  
	return $details;  
}
public function getUserInfo($user_id){
	$this->db->select('*');  
	$this->db->from('users');  
	$this->db->where('users.UserID',$user_id);  
	$query = $this->db->get();     
	$details = array();  
	if($query->num_rows() > 0){  
		foreach($query->result() as $row){  
			$details = $row;  
		}  
	}else{
		$details = array();
	}  
	return $details;  
}
public function getMenuData($cat_id){
	$user_id = $this->session->userdata('userID');
	$this->db->select('um_id,menu_name,vagitarian',FALSE);  
	$this->db->where('user_menus.menu_category',$cat_id); 
    $this->db->where('user_menus.user_id',$user_id);  
	$query = $this->db->get('user_menus');     
	//echo $this->db->last_query();
	$details = array();  
	if($query->num_rows() > 0){  
		foreach($query->result() as $row){  
			$details[] = $row;  
		}  
	}else{
		$details = array();
	}  
	return $details;  	
}
public function getMenuCount($cat_id,$type){
	$user_id = $this->session->userdata('userID');
	$this->db->select('count(menu_category) as allCatItem',FALSE);  
	$this->db->where('user_menus.menu_category',$cat_id);
    $this->db->where('user_menus.user_id',$user_id); 
	if($type!=''){  
	$this->db->where('user_menus.vagitarian',$type);  
	}
	$query = $this->db->get('user_menus');     
	$details = array();  
	if($query->num_rows() > 0){  
		foreach($query->result() as $row){  
			$details[] = $row;  
		}  
	}else{
		$details = array();
	}  
	return $details;  	
}
public function addMenuData(){
	$user_id = $this->session->userdata('userID');
	$menu_category = $this->input->post('cat_id');
	$menu_name = $this->input->post('textvalue');
	$vegi = $this->input->post('vregi');
	$dataArray = array(
		'user_id' => $user_id,
		'menu_category' => $menu_category,
		'menu_name' => $menu_name,
		'vagitarian' => $vegi, 
		'status' => '1',
		'added_date' => date("Y-m-d H:i:s")
	);
	$result = $this->db->insert('user_menus',$dataArray);
	$lastId = $this->db->insert_id();
	if($result){
		return $lastId;
	}else{
		return false;
	}
}
//remove menu data
public function removeMenuData(){
	$user_id = $this->session->userdata('userID');
	$menu_id = $this->input->post('menu_id');
	$dataArray = array(
		'user_id' => $user_id,
		'um_id' => $menu_id,
	);
	$result = $this->db->delete('user_menus',$dataArray);
	if($result){
		return $result;
	}else{
		return false;
	}
}
//update dead line Date
public function updateDeadlineDate(){
	$user_id = $this->session->userdata('userID');
	$deadline_date = explode("/", $this->input->post('deadline_date'));
	$array = array('deadline_date' => $deadline_date[2].'-'.$deadline_date[1].'-'.$deadline_date[0]);
	//print_r($array);
	$result = $this->db->update('users',$array,"UserID = '".$user_id."'");
	if($result){
		return true;
	}else{
		return false;
	}
}
public function sendNotification(){
	$user_id = $this->session->userdata('userID');
	$this->db->select('guests.Name,guests.Email,guests.GuestID,schedule_notification.text_for_notification_mail,schedule_notification.date_time',FALSE);   
	$this->db->join("schedule_notification","schedule_notification.user_id=guests.UserID"); 
	$this->db->where('guests.UserID',$user_id);
	$query = $this->db->get('guests');     
	//echo $this->db->last_query();
	$details = array();  
	if($query->num_rows() > 0){  
		foreach($query->result() as $row){ 
		$to = $row->Email; 
		$subject = '';
		$message = 'Hi '.$row->Name;
		$message.= $row->text_for_notification_mail;
		// Always set content-type when sending HTML email
		$headers = "MIME-Version: 1.0" . "\r\n";
		$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
		
		// More headers
		$headers .= 'From: <admin@jondig.com>' . "\r\n";
		$headers .= 'Cc: deepak.kumar@jondig.com' . "\r\n";
		$currentDateTime = date("Y-m-d H:i:s");
		$mail = mail($to,$subject,$message,$headers);
		if($mail){ $status = 1;}else{ $status = 0;}
			$details[] = array('Name'=> $row->Name, 'Email' => $row->Email, 'status' => $status );  
		}  
	}else{
		$details = array();
	}  
	return $details;  	
}
public function guestList($query){
	$user_id = $this->session->userdata('userID');
/*	$this->db->select('*');  
	$this->db->where('guests.UserID',$user_id);
	if($query!=""){
	$this->db->like('guests.Name',"%".$query."%");
	$this->db->escape_like_str($query);
	}
	$query = $this->db->get('guests'); */
	if($query!=""){
	$str = "AND `guests`.`Name` LIKE '%".trim($query)."%'";
	}
	$sql = $this->db->query("SELECT `guest_id` FROM `guest_menu_records` WHERE `user_id` = '".$user_id."' GROUP BY `guest_id`");
	$drt = '';
	if($sql->num_rows() > 0){
	$sqlData = $sql->result();
	$finaldd = '';
	foreach($sqlData as $nida){
	$finaldd.= "'".$nida->guest_id."',";
	$drt = "AND `GuestID` NOT IN (".rtrim($finaldd,',').")";
	}
	}
	$query = $this->db->query("SELECT `GuestID`,`Name` FROM `guests` WHERE `guests`.`UserID` = '".$user_id."' AND `guests`.`InvitationSent` = '1' AND `guests`.`InvitationAccepted` = '1'  $drt $str");
	//echo $this->db->last_query();    
	$details = array();  
	if($query->num_rows() > 0){  
		foreach($query->result() as $row){  
			$details[] = $row;  
		}  
	}else{
		$details = array();
	}  
	return $details;  	
}
public function getGuestInfo($gid){
	$this->db->select('*');  
	$this->db->where('guests.GuestID',$gid);
	$query = $this->db->get('guests');     
	$details = array();  
	if($query->num_rows() > 0){  
		foreach($query->result() as $row){  
			$details = $row;  
		}  
	}else{
		$details = array();
	}  
	return $details;  	
}
public function addMenuToGuest(){
	$user_id = $this->session->userdata('userID');
	$menu_id = $this->input->post('menu_id');
	$guest_id = $this->input->post('guest_id');
	$dataArray = array(
		'user_id' => $user_id,
		'menu_id' => $menu_id,
		'guest_id' => $guest_id,
		'status' => '1',
		'added_date' => date("Y-m-d H:i:s")
	);
	$result = $this->db->insert('guest_menu_records',$dataArray);
	$lastId = $this->db->insert_id();
	if($result){
		return $lastId;
	}else{
		return false;
	}
}
public function checkGuestMenuRecord($gid,$menu_id){
	$user_id = $this->session->userdata('userID');
	$this->db->select('*'); 
	$array = array('guest_id' => $gid,'menu_id' => $menu_id,'user_id' => $user_id); 
	$this->db->where($array);
	$query = $this->db->get('guest_menu_records');     
	$details = array();  
	if($query->num_rows() > 0){  
		$details = 1;
	}else{
		$details = 0;
	}  
	return $details; 
}
public function removeMenuToGuest(){
	$user_id = $this->session->userdata('userID');
	$menu_id = $this->input->post('menu_id');
	$guest_id = $this->input->post('guest_id');
	$dataArray = array(
		'user_id' => $user_id,
		'menu_id' => $menu_id,
		'guest_id' => $guest_id,
	);
	$result = $this->db->delete('guest_menu_records',$dataArray);
	if($result){
		return $result;
	}else{
		return false;
	}
}
public function getCaterersMenu(){
	$user_id = $this->session->userdata('userID');
	$this->db->select('guests.Name,menu_category.menu_cat_name,user_menus.menu_name,user_menus.vagitarian',FALSE);   
	$this->db->join("user_menus","user_menus.um_id=guest_menu_records.menu_id"); 
	$this->db->join("menu_category","menu_category.mc_id=user_menus.menu_category"); 
	$this->db->join("guests","guests.GuestID=guest_menu_records.guest_id"); 
	$this->db->where('guests.UserID',$user_id);
	$query = $this->db->get('guest_menu_records');  	
	//echo $this->db->last_query();
	//exit();
	$details = array();  
	if($query->num_rows() > 0){  
		$details = $query->result();
	}else{
		$details = 0;
	}  
	return $details;
}
public function addNearBy(){
	$user_id = $this->session->userdata('userID');
	$name = $this->input->post('name');
	$website = $this->input->post('website');
	$postcode = $this->input->post('postcode');
	$dataArray = array(
		'user_id' => $user_id,
		'name' => $name,
		'website' => $website,
		'postcode' => $postcode,
		'status' => '1',
		'added_date' => date("Y-m-d H:i:s")
	);
	$result = $this->db->insert('near_by_records',$dataArray);
	$lastId = $this->db->insert_id();
	if($result){
		return $lastId;
	}else{
		return false;
	}	
}
public function getNearByData(){
	$user_id = $this->session->userdata('userID');
	$this->db->select('*'); 
	$array = array('user_id' => $user_id); 
	$this->db->where($array);
	$query = $this->db->get('near_by_records');     
	$details = array();  
	if($query->num_rows() > 0){  
		$details = $query->result();
	}else{
		$details = 0;
	}  
	return $details;
}
public function removeNearBy(){
	$user_id = $this->session->userdata('userID');
	$nb_id = $this->input->post('nb_id');
	$dataArray = array(
		'user_id' => $user_id,
		'nbr_id' => $nb_id
	);
	$result = $this->db->delete('near_by_records',$dataArray);
	if($result){
		return $result;
	}else{
		return false;
	}
}
public function updateMenuField(){

	$user_id = $this->session->userdata('userID');
	$menu_id = $this->input->post('menu_id');
	$data = $this->input->post('data');
	$type = $this->input->post('type');
	if($type == 'text'){
		$dataArray = array(
			'user_id' => $user_id,
			'menu_name' => $data
		);
	}else{
		$dataArray = array(
			'user_id' => $user_id,
			'vagitarian' => $data
		);
	}
	$ui = array('um_id' => $menu_id);
	$result = $this->db->update('user_menus',$dataArray, $ui);
	if($result){
		return true;
	}else{
		return false;
	}
}
//add News data
public function addNewsData(){
	$user_id = $this->session->userdata('userID');
	$post_title = $this->input->post('post_title');
	$post_description = $this->input->post('post_description');
	//print_r($_FILES);
	$post_image = $_FILES['post_image']['name'];
	//exit();
	move_uploaded_file($_FILES["post_image"]["tmp_name"],
	"assets/blog_images/". $_FILES["post_image"]["name"]);
	$dataArray = array(
		'user_id' => $user_id,
		'post_title' => $post_title,
		'post_description' => $post_description,
		'post_image' => $post_image,
		'post_status' => '1',
		'added_date' => date("Y-m-d H:i:s")
	);
	$result = $this->db->insert('news_records',$dataArray);
	$lastId = $this->db->insert_id();
	/*$msg = 'A New post added: '.$post_title;
	$subject = 'Notification for new post';
	// Always set content-type when sending HTML email
	$headers = "MIME-Version: 1.0" . "\r\n";
	$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
	
	// More headers
	$headers .= 'From: < admin@hitcheasy.co >' . "\r\n";
	$headers .= 'Cc: deepak.kumar@jondig.com' . "\r\n";
	
	$sqlMail = $this->db->query("SELECT * FROM `guests` WHERE `InvitationSent` = '1' AND `InvitationAccepted` = '1' AND `UserID` = '".$user_id."'");
	if($sqlMail->$num_rows() > 0){
		$rows = $sqlMail->result();
		foreach($rows as $row){
			$mail = mail($row->Email,$subject,$msg,$headers);
		}
	}*/
	return $lastId;
	if($result){
	//$sqlMailPost = $this->db->query("SELECT * FROM `new_post_notification` WHERE `status` = '1' AND `user_id` = '".$user_id."'");
	//if($sqlMailPost->$num_rows() > 0){
	
	//}
		return $lastId;
	}else{
		return false;
	}	
}
public function getNews($blog_id){
	$user_id = $this->session->userdata('userID');
	$this->db->select('*'); 
	$array = array('post_id' => $blog_id); 
	$this->db->where($array);
	$query = $this->db->get('news_records');     
	$details = array();  
	if($query->num_rows() > 0){  
		$detail = $query->result();
		$details = $detail[0];
	}else{
		$details = 0;
	}  
	return $details;
}
public function getUserDetails($user_id){
	$this->db->select('*'); 
	$array = array('UserID' => $user_id); 
	$this->db->where($array);
	$query = $this->db->get('users');     
	$details = array();  
	if($query->num_rows() > 0){  
		$detail = $query->result();
		$details = $detail[0];
	}else{
		$details = 0;
	}  
	return $details;
}
public function getAllNews(){
	$user_id = $this->session->userdata('userID');
	$this->db->select('*'); 
	$array = array('user_id' => $user_id); 
	$this->db->where($array);
	$this->db->order_by("post_id", "desc"); 
	$query = $this->db->get('news_records');  
	$details = array();  
	if($query->num_rows() > 0){  
		$details = $query->result();
	}else{
		$details = array();
	}  
	return $details;
}
public function updatePostSubmit(){
	$user_id = $this->session->userdata('userID');
	$post_id = $this->input->post('post_id');
	$post_title = $this->input->post('post_title');
	$post_description = $this->input->post('post_description');
	$post_image = $_FILES['post_image']['name'];
	move_uploaded_file($_FILES["post_image"]["tmp_name"],
	"assets/blog_images/". $_FILES["post_image"]["name"]);
	if($post_image!=""){
		$dataArray = array(
			'post_title' => $post_title,
			'post_description' => $post_description,
			'post_image' => $post_image,
			'updated_date' => date("Y-m-d H:i:s")
		);
	}else{
		$dataArray = array(
			'post_title' => $post_title,
			'post_description' => $post_description,
			'updated_date' => date("Y-m-d H:i:s")
		);
	}

	$result = $this->db->update('news_records',$dataArray,'post_id='.$post_id);
	if($result){
		return $post_id;
	}else{
		return false;
	}	
}
//remove News data
public function removeNewsData(){
	$user_id = $this->session->userdata('userID');
	$post_id = $this->input->post('item_id');
	$dataArray = array(
		'user_id' => $user_id,
		'post_id' => $post_id,
	);
	$this->db->select('*'); 
	$this->db->where($dataArray);
	$query = $this->db->get('news_records');     
	//$details = array();  
	if($query->num_rows() > 0){  
		$details = $query->result();
		unlink('assets/blog_images/'.$details[0]->post_image);
		$result = $this->db->delete('news_records',$dataArray);
	}	
	if($result){
		return $details;
	}else{
		return false;
	}
}
function getPostLike($postId){
		$count = 0;
		$sqlDT = $this->db->query("SELECT * FROM `news_likes_records` WHERE `news_id` = '".$postId."'");
		$count = $sqlDT->num_rows();
		if($count == 0 || $count == '' ){
		$data = 0;
		}else{
		$data = $count;
		}
		//echo $this->db->last_query();
		return $data;
}
					
public function addRegistryDta(){
	$user_id = $this->session->userdata('userID');
	//print_r($this->input->post());
	$jsonArray = $_REQUEST['data'];
	if($jsonArray!=""){
    foreach($jsonArray as $key => $value) {
        //echo $key."<br>";
        //echo "<pre>"; print_r($value);
        if(array_key_exists('gd$email', $value)) {
            //echo "1"."<br>";
            foreach( $value as $key1 => $value1 ) {
                //echo $key1."<br>";
                //echo "<pre>"; print_r($value1);
                if( $key1 == 'gd$email' ) {
                    //echo "<pre>"; print_r($value1);
                    $email = $value1[0]['address'];
					$nm = explode("@", $email);
					$name = $nm[0];
					$sql = $this->db->query("SELECT * FROM `guests` WHERE `Email` = '".$email."' AND `UserID` = '".$user_id."'");
					$num = $sql->num_rows();
					if($num > 0){
						$dataVal = 'already';
					}else{
						$dataArray = array(
						'UserID' => $user_id,
						'Name' => $name,
						'Email' => $email,
						'added_date' => date("Y-m-d H:i:s")
						);
						$result = $this->db->insert('guests',$dataArray);
						$lastId = $this->db->insert_id();
						if($result){
							$dataVal = $lastId;
						}else{
							$dataVal = 0;
						}
					}	
                }
            }
        } 
    }
	}else{
	$email = $this->input->post('email');
	$name = $this->input->post('name');
	$sql = $this->db->query("SELECT * FROM `guests` WHERE `Email` = '".$email."' AND `UserID` = '".$user_id."'");
					$num = $sql->num_rows();
					if($num > 0){
						$dataVal = 'already';
					}else{
						$dataArray = array(
						'UserID' => $user_id,
						'Name' => $name,
						'Email' => $email,
						'added_date' => date("Y-m-d H:i:s")
						);
						$result = $this->db->insert('guests',$dataArray);
						$lastId = $this->db->insert_id();
						if($result){
							$dataVal = $lastId;
						}else{
							$dataVal = 0;
						}
					}	
	}
return $dataVal;
}					
	
public function addressBook(){
	$user_id = $this->session->userdata('userID');
	$this->db->select('*'); 
	$array = array('UserID' => $user_id,'InvitationSent' => 0); 
	$this->db->where($array);
	$query = $this->db->get('guests');     
	$details = array();  
	if($query->num_rows() > 0){  
		$details = $query->result();
	}else{
		$details = array();
	}  
	return $details;
}
public function initedGuest(){
	$user_id = $this->session->userdata('userID');
	$this->db->select('*'); 
	$array = array('UserID' => $user_id,'InvitationSent' => 1); 
	$this->db->where($array);
	$query = $this->db->get('guests');     
	$details = array();  
	if($query->num_rows() > 0){  
		$details = $query->result();
	}else{
		$details = array();
	}  
	return $details;
}
public function sendInvitations(){
	$user_id = $this->session->userdata('userID');
	$invites = $this->input->post('invite');
	//print_r($invites);
	if(count($invites) > 0){
		foreach($invites as $invt){
			$arr = array("InvitationSent" => 1);
			$result = $this->db->update('guests',$arr, 'GuestID='.$invt);
			$sql = $this->db->query("SELECT * FROM  `guests` WHERE `GuestID` ='".$invt."'");
			$row = $sql->result();
			$to = $row[0]->Email;
			$subject = 'Invitation for: Event';
			$message = 'You have invitate';
			// Always set content-type when sending HTML email
			$headers = "MIME-Version: 1.0" . "\r\n";
			$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
			// More headers
			$headers .= 'From: The Wedding App <supprt@hitcheasy.co>' . "\r\n";
			//$headers .= 'Cc: myboss@example.com' . "\r\n";
			$mail = mail($to,$subject,$message,$headers);
		}
	}
	return true;
}
public function sendPassToMail($email_id){
/*echo $email_id;
exit();*/
$query = $this->db->query("SELECT * FROM `users` WHERE `EmailID` = '".$email_id."'");
if($query->num_rows() > 0){
	$row = $query->result();
	$password = $row[0]->Password;
	$data = 1;
	$to = $row[0]->EmailID;
	$link = base_url("login/reset_password/".$row[0]->UserID);
	$cndn = array("UserID" => $row[0]->UserID);
	$arUp = array("forgot_pass_status" => 1);
	$updt = $this->db->update("users",$arUp, $cndn);
	$subject = 'Forgot Password Request';
	//$message = 'Your link is: '.$link;
	$message = '<table width="100%" cellspacing="0" cellpadding="0" style="border-collapse:collapse">
  <tbody>
    <tr>
      <td height="28" style="line-height:28px">&nbsp;</td>
    </tr>
    <tr>
      <td><span style="font-family:Helvetica Neue,Helvetica,Lucida Grande,tahoma,verdana,arial,sans-serif;font-size:16px;line-height:21px;color:#141823">
        <p>Hi '.$row[0]->Name.',</p>
        </span>
        <p><span style="font-family:Helvetica Neue,Helvetica,Lucida Grande,tahoma,verdana,arial,sans-serif;font-size:16px;line-height:21px;color:#141823">Somebody recently asked to reset your The Wedding App Password.</span></p>
        <span style="font-family:Helvetica Neue,Helvetica,Lucida Grande,tahoma,verdana,arial,sans-serif;font-size:16px;line-height:21px;color:#141823"><p><a target="_blank" style="color:#3b5998;text-decoration:none" href="'.$link.'">Click here to change your password.</a></p>
        </span></td>
    </tr>
    <tr>
      <td height="14" style="line-height:14px">&nbsp;</td>
    </tr>
  </tbody>
</table>';
	// Always set content-type when sending HTML email
	$headers = "MIME-Version: 1.0" . "\r\n";
	$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
	// More headers
	$headers .= 'From: The Wedding App <supprt@hitcheasy.co>' . "\r\n";
	//$headers .= 'Cc: myboss@example.com' . "\r\n";
	
	$mail = mail($to,$subject,$message,$headers);
	if($mail){
		$data = 1;	
	}else{
		$data = 0;	
	}
	
}else{
	$data = 2;
}
return $data;
}
public function resetUserPass($userId,$password){
	$data = 0;
$query = $this->db->query("SELECT * FROM `users` WHERE `UserID` = '".$userId."' AND `forgot_pass_status` = '1'");
if($query->num_rows() > 0){
	$row = $query->result();

	$cndn = array("UserID" => $userId);
	$arUp = array("Password" => $password, "forgot_pass_status" => 0);
	$updt = $this->db->update("users",$arUp,$cndn);

	if($updt){
		$data = 1;	
	}else{
		$data = 0;	
	}
	
}else{
	$data = 2;
}
return $data;
}
public function uploadGallery(){	
	$user_id = $this->session->userdata('userID');
	foreach($_FILES['fileToUpload']['name'] as $key=>$value){
	
		move_uploaded_file($_FILES["fileToUpload"]["tmp_name"][$key],"assets/gallery/". $value);
		$dataArray = array(
			'user_id' => $user_id,
			'photo_link' => $value,
			'status' => '1',
			'added_date' => date("Y-m-d H:i:s")
		);
		$result = $this->db->insert('photo_gallery',$dataArray);
		}

		return true;
}
public function getGallery(){
			$user_id = $this->session->userdata('userID');
			$this->db->select("*");
			$this->db->from("photo_gallery",false);
			$this->db->where('photo_gallery.user_id',$user_id);
			$galData = $this->db->get();
			$rowGallery = $galData->result();
            $rowGalleryData = array();
            foreach($rowGallery as $row){
                    $gv = $this->db->query("SELECT * FROM `gallery_likes_records` WHERE `gallery_id` = '".$row->pg_id."'");
                    $glike = $gv->num_rows();
                $rowGalleryData[] = array("pg_id" => $row->pg_id , "user_id" => $row->user_id, "photo_link" => $row->photo_link, "status" => $row->status, "added_date" => $row->added_date, "glike" => $glike );
            }
            
			return $rowGalleryData;
}
	public function deleteGallery($g_id){
	$delete = $this->db->delete('photo_gallery', array('pg_id' => $g_id));
		if($delete){
			return true;
		}else{
			return false;
		}
	}
	//share link
	public function getEventInfo($user_id){
	$this->db->select('*');  
	$this->db->from('event');  
	$this->db->where('event.UserID',$user_id);  
	$query = $this->db->get();     
	$details = array();  
	if($query->num_rows() > 0){  
		foreach($query->result() as $row){  
			$details = $row;  
		}  
	}else{
		$details = array();
	}  
	return $details;   }
	public function getTableData($user_id){
			$sql = $this->db->query("SELECT *  FROM `tables` WHERE `UserID` = '".$user_id."'");
			if($sql->num_rows() > 0){
			$result = $sql->result();
			$table_list = array();
			$a = 0;
			$tbl = array("","One","Two","Three","Four","Five","Six","Seven","Eight","Nine","Ten","Eleven","Twelve","Thirteen","Fourteen","Fifteen","Sixteen","Seventeen","Eighteen","Ninteen","Twenty");
			foreach($result as $row){ $a++;
				$tblusr = $this->db->query("SELECT * FROM `seatings` WHERE `TableID` = '".$row->TableID."'");
				$user_list = array();
				if($tblusr->num_rows() > 0){
					foreach($tblusr->result() as $rowtbl){
						$uId = $this->getUserIDofGuest($rowtbl->GuestID);
						$user_list[] = array("guest_name" => $this->guestName($rowtbl->GuestID),"guest_fb_link" => $this->FbLink($rowtbl->GuestID),"user_id" => $uId, "image_url" => $this->getUserImage($uId));
					}
				}
				$table_list[] = array("table_name" => "Table ".$tbl[$a], "guest_list" => $user_list);
			}
			}
		
		return $table_list;		
	}
	public function getGalleryShare($user_id){
			//$user_id = $this->session->userdata('userID');
			$this->db->select("*");
			$this->db->from("photo_gallery",false);
			$this->db->where('photo_gallery.user_id',$user_id);
			$galData = $this->db->get();
			$rowGallery = $galData->result();
            $rowGalleryData = array();
            foreach($rowGallery as $row){
                    $gv = $this->db->query("SELECT * FROM `gallery_likes_records` WHERE `gallery_id` = '".$row->pg_id."'");
                    $glike = $gv->num_rows();
                $rowGalleryData[] = array("pg_id" => $row->pg_id , "user_id" => $row->user_id, "photo_link" => $row->photo_link, "status" => $row->status, "added_date" => $row->added_date, "glike" => $glike );
            }
            
			return $rowGalleryData;
}
	function guestName($GuestID){
			$sql = $this->db->query("SELECT *  FROM `guests` WHERE `GuestID` = '".$GuestID."'");
			if($sql->num_rows() > 0){
			$result = $sql->result();
			$n = $result[0]->Name;
			}
		return $n;	
	}
		function FbLink($GuestID){
			$sql = $this->db->query("SELECT `users`.`FB_ID` FROM `guests`,`users` WHERE `guests`.`GuestID` = '".$GuestID."' AND `guests`.`Email` = `users`.`EmailID`");
			if($sql->num_rows() > 0){
			$result = $sql->result();
			$n = 'https://www.facebook.com/'.$result[0]->FB_ID;
			}else{
			$n = '';
			}
		return $n;	
	}
	function getUserIDofGuest($GuestID){
			$sql = $this->db->query("SELECT `users`.`UserID` FROM `guests`,`users` WHERE `guests`.`GuestID` = '".$GuestID."' AND `guests`.`Email` = `users`.`EmailID`");
			if($sql->num_rows() > 0){
			$result = $sql->result();
			$n = $result[0]->UserID;
			}else{
			$n = '';
			}
		return $n;	
	}
		function getUserImage($userID){
			$sql = $this->db->query("SELECT `Image` FROM `users` WHERE `UserID` = '".$userID."'");
			if($sql->num_rows() > 0){
			$result = $sql->result();
			if($result[0]->Image!=""){
			$n = BASE_URLD.'uploads/'.$result[0]->Image;
			}else{
			$n = '';
			}
			}else{
			$n = '';
			}
		return $n;	
	}
	public function checkHashTagInDB(){
		$user_id = $this->session->userdata('userID');
		$hsTag = $this->input->post('hash_tag');
		if($hsTag!=""){
		$sql = $this->db->query("SELECT * FROM `users` WHERE `hash_tag` = '".$hsTag."' AND `UserID` != '".$user_id."'");
		if($sql->num_rows() > 0){
			$result = 1;
		}else{
			$result = 0;
		}
		}else{
			$result = 0;
		}
		return $result;
	}
	public function getUserIdByHashTag($hashtag){
		$sql = $this->db->query("SELECT * FROM `users` WHERE `hash_tag` = '".$hashtag."'");
		if($sql->num_rows() > 0){
			$rows = $sql->result(); 
			$result = $rows[0]->UserID;
		}else{
			$result = 0;
		}
		return $result;
	}
}



 