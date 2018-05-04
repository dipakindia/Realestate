<?php
class Login_model extends CI_Model {
	function __construct(){			
		parent::__construct();
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
	
	/**
	 * get_user function.
	 * 
	 * @access public
	 * @param mixed $user_id
	 * @return object the user object
	 */
	public function get_user($user_id) {
		
		$this->db->from('tbl_admin_users');
		$this->db->where('id', $user_id);
		return $this->db->get()->row();
		
	}
	private function hash_password($password) {
		
		return password_hash($password, PASSWORD_BCRYPT);
		
	}
	
	/**
	 * verify_password_hash function.
	 * 
	 * @access private
	 * @param mixed $password
	 * @param mixed $hash
	 * @return bool
	 */
	private function verify_password_hash($password, $hash) {
		
		if($hash == md5($password)){
			return true;
		}else{
			return false;
		}
		
	}
}



 