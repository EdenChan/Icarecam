<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


//用户模型
class User_model extends CI_Model{

	const TBL_USER = 'user';

	public function add_user($data){
		return $this->db->insert(self::TBL_USER,$data);
	}

	public function list_user($limit,$offset){
		$query = $this->db->limit($limit,$offset)->get(self::TBL_USER);
		return $query->result_array();
	}

	public function count_user(){
		return $this->db->count_all(self::TBL_USER);
	}

	public function update_user($data,$user_id) {
		$condition['user_id'] = $user_id;
		$query = $this->db->where($condition)->update(self::TBL_USER,$data);
		return $query ? $user_id : false;
	}

	public function get_user($username,$password){
		$condition['user_name'] = $username;
		$condition['password'] = md5($password);
		$query = $this->db->where($condition)->get(self::TBL_USER);
		return $query->row_array();
	}

	public function get_user_byname($username){
		$condition['user_name'] = $username;
		$query = $this->db->where($condition)->get(self::TBL_USER);
		return $query->row_array();
	}

	public function delete_user($user_id) {
		$condition['user_id'] = $user_id;
		$query = $this->db->where($condition)->delete(self::TBL_USER);
		if ($query && $this->db->affected_rows() > 0) {
			# code...
			return true;
		} else {
			# code...
			return false;
		}
	}
}