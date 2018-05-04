<?php
class Dashboard_model extends CI_Model {
	function __construct(){			
		parent::__construct();
		$this->load->library('email');
	}
	public function resolve_user_login($username, $password) {
		$this->db->select('password');
		$this->db->from('tbl_admin_users');
		$this->db->where('username', $username);
		//$this->db->where('password', md5($password));
		$hash = $this->db->get()->row('password');
		return $this->verify_password_hash($password, $hash);
	}
	public function get_user_id_from_username($username) {
			$this->db->select('id');
			$this->db->from('tbl_admin_users');
			$this->db->where('username', $username);
			return $this->db->get()->row('id');
	}
	public function get_user($user_id) {
		$this->db->from('tbl_admin_users');
		$this->db->where('id', $user_id);
		return $this->db->get()->row();
	}
	private function hash_password($password) {
		return password_hash($password, PASSWORD_BCRYPT);
	}
	private function verify_password_hash($password, $hash) {
		if($hash == md5($password)){
			return true;
		}else{
			return false;
		}
	}
	//Get All Users List
	public function get_user_list(){
		$this->db->select('*');
		$this->db->from('tbl_user_records');
		$query = $this->db->get();
		foreach($query->result() as $res){
		$res->date_diff = $this->calculate_time_span($res->date);
		$data[] = $res;
		}
		return $data;
	}
	//Get All category List
	public function get_category_list(){
		$this->db->select('*');
		$this->db->from('tbl_category_records');
		$query = $this->db->get();
		return $query->result();
	}
	public function get_data_list($table_name,$title,$sort){
		$this->db->select('*');
		$this->db->from($table_name);
		$this->db->order_by($title, $sort);
		$query = $this->db->get();
		return $query->result();
	}	
	public function getSingleData($table_name,$condition){
		$this->db->select('*');
		$this->db->from($table_name);
		$this->db->where($condition);
		$query = $this->db->get();
		$data = $query->result();
		return $data[0];
	}
	public function getMultipleData($table_name,$condition){
		$this->db->select('*');
		$this->db->from($table_name);
		$this->db->where($condition);
		$query = $this->db->get();
		$data = $query->result();
		return $data;
	}		
	public function delete_page($post){
		extract($_POST);
		$ret = 0;
		if($action == 'delete'){
			if($table_name!=''){
			$delete_page  = $this->db->delete($table_name, array($key => $value));
			if($delete_page){
				$ret = 1;
			}
		}
		}	
		return $ret;
	}
	public function update_page($post){
		extract($post);
		$ret = 0;
		if($action == 'update'){
			if($table_name!=''){
			$updateFiels = json_decode($update_field,true); 
			$delete_page  = $this->db->update($table_name, $updateFiels,array($key => $value));
			if($delete_page){
				$ret = 1;
				}
			}
		}
		return $ret;
	}	
	public function add_category($post){
		/*echo '<pre>';
	print_r($post);
	exit;*/
			$img_name = $this->makeFileRename($_FILES["category_image"]["name"]);
			move_uploaded_file($_FILES["category_image"]["tmp_name"],
			base_url("uploads/category_images/") .$img_name );
			$data = array("category_name" => $post['category_name'],"parent_id" => $post['parent_id'],"category_description" => $post['category_desc'],"category_image" => $img_name,"status" => $post['status']);
			$sql = $this->db->insert('tbl_category_records',$data);
			$category_id = $this->db->insert_id();
			return $sql;
	}	
	public function add_product($post){
		
			$data = array("product_title" => $post['product_name'],"product_description" => $post['product_desc'],"latitude" => $post['latitude'],"longitude" => $post['longitude'], "status" => $post['status'], "price" => $post['price'], "discount_price" => $post['discount_price'], "category_id" => $post['category_name'], "sub_category_id" => $post['sub_category_name'], "child_category_id" => $post['child_category_name'],"user_id" => $post['user_id']);
			$sql = $this->db->insert('tbl_product_records',$data);
			$product_id = $this->db->insert_id();
			
			if($_FILES["product_image"]){
				foreach($_FILES['product_image']['name'] as $key => $value){
					//echo $value.''.$_FILES['product_image']['tmp_name'][$key];
					$img_name[$key] = $this->makeFileRename($value);
					move_uploaded_file($_FILES["product_image"]["tmp_name"][$key],
					"uploads/product_images/" .$img_name[$key] );
					$data_images = array("product_id" => $product_id,"status" => 1,"image_url" => $img_name[$key],"added_date" => date("Y-m-d H:i:s"));
					$sql_images = $this->db->insert('tbl_product_images',$data_images);
				}
			}
			
			return $sql;
	}
	public function edit_product($post){
		
			$data = array("product_title" => $post['product_name'],"product_description" => $post['product_desc'],"latitude" => $post['latitude'],"longitude" => $post['longitude'], "status" => $post['status'], "price" => $post['price'], "discount_price" => $post['discount_price'], "category_id" => $post['category_name'], "sub_category_id" => $post['sub_category_name'], "child_category_id" => $post['child_category_name']);
			//print($data);die;
			$sql = $this->db->update('tbl_product_records',$data,array("product_id" => $post['product_id']));
			
			$product_id = $post['product_id'];
			//print_r($_FILES["product_image"]['name']); die;
			if($_FILES["product_image"]['name'][0]){
				foreach($_FILES['product_image']['name'] as $key => $value){
					//echo $value.''.$_FILES['product_image']['tmp_name'][$key];
					$img_name[$key] = $this->makeFileRename($value);
					move_uploaded_file($_FILES["product_image"]["tmp_name"][$key],
					"uploads/product_images/" .$img_name[$key] );
					$data_images = array("product_id" => $product_id,"status" => 1,"image_url" => $img_name[$key],"added_date" => date("Y-m-d H:i:s"));
					$sql_images = $this->db->insert('tbl_product_images',$data_images);
					
				}
			}
			
			return $sql;
	}
		public function add_offer($post){
			$dat = explode("-",$post['date_range']);
			$start_date = $dat[0];
			$end_date = $dat[1];
			$data = array("offer_title" => $post['offer_name'],"offer_desc" => $post['offer_desc'], "status" => $post['status'],"start_date" => date("Y-m-d", strtotime($start_date)),"end_date" => date("Y-m-d", strtotime($end_date)), "product_id" => $post['product_id']);
			$sql = $this->db->insert('tbl_offers_records',$data);
			$offer_id = $this->db->insert_id();
			
			if($_FILES["offer_image"]){
				foreach($_FILES['offer_image']['name'] as $key => $value){
					//echo $value.''.$_FILES['product_image']['tmp_name'][$key];
					$img_name[$key] = $this->makeFileRename($value);
					move_uploaded_file($_FILES["offer_image"]["tmp_name"][$key],
					"uploads/offer_images/" .$img_name[$key] );
					$data_images = array("offer_id" => $offer_id,"status" => 1,"image_url" => $img_name[$key],"added_date" => date("Y-m-d H:i:s"));
					$sql_images = $this->db->insert('tbl_offer_images',$data_images);
				}
			}
			
			return $sql;
	}
	public function edit_offer($post){
			$dat = explode("-",$post['date_range']);
			$start_date = $dat[0];
			$end_date = $dat[1];
			$data = array("offer_title" => $post['offer_name'],"offer_desc" => $post['offer_desc'], "status" => $post['status'],"start_date" => date("Y-m-d", strtotime($start_date)),"end_date" => date("Y-m-d", strtotime($end_date)), "product_id" => $post['product_id']);
			//print($data);die;
			$sql = $this->db->update('tbl_offers_records',$data,array("offer_id" => $post['offer_id']));
			echo $this->db->last_query();die;
			$offer_id = $post['offer_id'];
			//print_r($_FILES["product_image"]['name']); die;
			if($_FILES["offer_image"]['name'][0]){
				foreach($_FILES['offer_image']['name'] as $key => $value){
					//echo $value.''.$_FILES['product_image']['tmp_name'][$key];
					$img_name[$key] = $this->makeFileRename($value);
					move_uploaded_file($_FILES["offer_image"]["tmp_name"][$key],
					"uploads/product_images/" .$img_name[$key] );
					$data_images = array("offer_id" => $offer_id,"status" => 1,"image_url" => $img_name[$key],"added_date" => date("Y-m-d H:i:s"));
					$sql_images = $this->db->insert('tbl_offer_images',$data_images);
					
				}
			}
			
			return $sql;
	}
	public function add_user($post){
			$img_name = $this->makeFileRename($_FILES["category_image"]["name"]);
			move_uploaded_file($_FILES["category_image"]["tmp_name"],
			base_url("uploads/profile_pic/") .$img_name );
			$data = array("first_name" => $post['first_name'],"last_name" => $post['last_name'],"email_id" => $post['email'],"mobile" => $post['mobile'],"password" => $post['password'],"status" => $post['status'],"phone_verified" => 1, "email_verified" => 1);
			$sql = $this->db->insert('tbl_user_records',$data);
			$category_id = $this->db->insert_id();
			return $sql;
	}		
	public function add_place($post){
		/*echo '<pre>';
	print_r($post);
	exit;*/
			$img_name = $this->makeFileRename($_FILES["place_image"]["name"]);
			move_uploaded_file($_FILES["place_image"]["tmp_name"],
			"uploads/place_images/" .$img_name );
			$data = array("city_name" => $post['city_name'],"place_image" => $img_name,"status" => $post['status'],"longitude" => $post['longitude'],"latitude" => $post['latitude'],"state" => $post['state']);
			$sql = $this->db->insert('tbl_places_records',$data);
			$category_id = $this->db->insert_id();
			return $sql;
	}
	public function add_admin($post){
		/*echo '<pre>';
	print_r($post);
	exit;*/

			$data = array("name" => $post['admin_name'],"email_id" => $post['admin_email'],"status" => $post['status'],"password" => $post['password'],"username" => $post['user_name'],"mobile" => $post['mobile'],"added_date" => date("Y-m-d H:i:s"));
			$sql = $this->db->insert('admin',$data);
			$category_id = $this->db->insert_id();
			return $sql;
	}
	public function add_locality($post){
			$img_name = $this->makeFileRename($_FILES["place_image"]["name"]);
			move_uploaded_file($_FILES["place_image"]["tmp_name"],
			"uploads/place_images/" .$img_name );
			$data = array("name" => $post['locality_name'],"status" => $post['status'],"longitude" => $post['longitude'],"latitude" => $post['latitude'],"city_id" => $post['city']);
			$sql = $this->db->insert('tbl_locality',$data);
			$category_id = $this->db->insert_id();
			return $sql;
	}			
	public function add_content($post){
	/*echo '<pre>';
	print_r($post);
	exit;*/
			$data = array("content_title" => $post['content_title'],"content_description" => $post['content_description'],"action" => $post['action'],"status" => $post['status'],"added_date" => date("Y-m-d H:i:s"));
			$sql = $this->db->insert('tbl_content_records',$data);
			return $sql;
	}	
	public function update_category($post){
/*		echo '<pre>';
	print_r($_FILES["category_image"]["name"]);
	exit;*/
			$img_name = $this->makeFileRename($_FILES["category_image"]["name"]);
			move_uploaded_file($_FILES["category_image"]["tmp_name"],
			"uploads/category_images/" .$img_name );
			
			$data = array("category_name" => $post['category_name'],"parent_id" => $post['parent_id'],"category_description" => $post['category_desc'],"status" => $post['status']);
			if($_FILES["category_image"]["name"]){
			$data["category_image"] = $img_name;
			}
			$sql = $this->db->update('tbl_category_records',$data,array("category_id" => $post['category_id']));
			return $sql;
	}	
	public function update_content($post){
	/*echo '<pre>';
	print_r($post);
	exit;*/
			$data = array("content_title" => $post['content_title'],"content_description" => $post['content_description'],"status" => $post['status'],"updated_date" => date("Y-m-d H:i:s"));
			$sql = $this->db->update('tbl_content_records',$data,array("content_id" => $post['content_id']));
			return $sql;
	}		
	function makeFileRename($file_name){
		$vl = explode('.', $file_name);
		$ext = end($vl);
		$imgName = str_replace('.'.$ext, '', $file_name);
		$finalImgName = $imgName."_".strtotime(date('y-m-d h:i:s')).".".$ext;
		$filename = trim(addslashes($finalImgName));
		return $finalImgName = str_replace(' ', '_', $filename);
	}
	public function sendEmailToUsers($post){
		//echo '<pre>';
		//echo '<pre>';
		//print_r($_POST);
		//exit;
		$uids = implode(",",$post['user_ids']);
		$str = '';
		if($post['select_users_type'] == 'multiple_users'){
			$str = " AND `id` IN(".$uids.")";
		}
		//$body_text = $post['body_text'];
		$template_text = 'text Only'.$post['body_text'];
		$template_image = 'Image Only';
		$template_text_image = 'Image with Text'.$post['body_text'];
		if($post['email_type'] == 'text'){
            	$body_text = $template_text;
			}else if($post['email_type'] == 'image'){
            	$body_text = $template_image;
			}else if($post['email_type'] == 'text_image'){
            	$body_text = $template_text_image;
			}else{
				$body_text = $template_text;
			}

		$sql = $this->db->query("SELECT `first_name`,`email_id` FROM `tbl_user_records` WHERE `status` = '1' $str");
		if($sql->num_rows() > 0){
			foreach($sql->result() as $data){
			echo $post['subject'].'<br />';
			//echo $body_text.'<br />';
			//echo '------------------<br />';
			$this->email->from('admin@mysolutions4u.com', 'Support MySolutions');
			$this->email->to($data->email_id);
			$this->email->cc('dipak.yts@gmail.com','artianu1991@gmail.com');
			$this->email->bcc('them@their-example.com');
			
			$this->email->subject($post['subject']);
			$this->email->message($body_text);

			$this->email->send();
			}
		}
		return true;	
	}
	public function sendPushToUsers($post){
		//echo '<pre>';
		$uids = implode(",",$post['user_ids']);
		$str = '';
		if($post['select_users_type'] == 'multiple_users'){
			$str = " AND `id` IN(".$uids.")";
		}
		$body_text = $post['body_text'];
		$sql = $this->db->query("SELECT `first_name`,`email_id` FROM `tbl_user_records` WHERE `status` = '1' $str");
		if($sql->num_rows() > 0){
			foreach($sql->result() as $data){
			/*$this->email->from('admin@mysolutions4u.com', 'Support MySolutions');
			$this->email->to($data->email_id);
			$this->email->cc('dipak.yts@gmail.com');
			//$this->email->bcc('them@their-example.com');
			$this->email->subject($post['subject']);
			$this->email->message($body_text);
			$this->email->send();*/
			}
		}
		return true;	
	}
	public function calculate_time_span($date){
    	$seconds  = strtotime(date('Y-m-d H:i:s')) - strtotime($date);
        $months = floor($seconds / (3600*24*30));
        $day = floor($seconds / (3600*24));
        $hours = floor($seconds / 3600);
        $mins = floor(($seconds - ($hours*3600)) / 60);
        $secs = floor($seconds % 60);

        if($seconds < 60)
            $time = $secs." seconds ago";
        else if($seconds < 60*60 )
            $time = $mins." min ago";
        else if($seconds < 60*60*60)
            $time = $hours." hours ago";
        else if($seconds < 24*60*60*60)
            $time = $day." day ago";
        else
            $time = $months." month ago";
		return $time;
        //return $months.'-'.$day.'-'.$hours.'-'.$mins.'-'.$seconds;
	}
	public function addOfferSponsered($post){
		$data = array("offer_id`" => $post['offer_id'],"start_date" => date("Y-m-d", strtotime($post['start_date'])),"end_date" => date("Y-m-d", strtotime($post['end_date'])),"status" => '1',"added_date" => date("Y-m-d H:i:s"));
		$sql = $this->db->insert('tbl_offer_sponsered_records',$data);
		return $sql;
	}
	public function getRecOfferList(){
		$sql = $this->db->query("SELECT * FROM `tbl_offers_records`,`tbl_offer_sponsered_records` WHERE `tbl_offer_sponsered_records`.`offer_id` = `tbl_offers_records`.`offer_id` group by `tbl_offer_sponsered_records`.`offer_id`");
		return $sql->result();
	}
	public function addToRecomondedList($key, $user_id){
		if($key=='1'){
			$sql1 = $this->db->query("SELECT * FROM `tbl_recommeded_merchant` WHERE `merchant_id` = '".$user_id."'");
			if($sql1->num_rows() < 1){
				$data = array("merchant_id" => $user_id);
				$sql = $this->db->insert('tbl_recommeded_merchant',$data);
				$value = 1;
			}
		}else{
			$data = array("merchant_id" => $user_id);
			$sql = $this->db->delete('tbl_recommeded_merchant',$data);
			$value = 1;
		}
		//echo $value;
		return $value;
	}
}



 