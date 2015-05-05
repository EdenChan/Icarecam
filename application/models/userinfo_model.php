<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

//用户信息模型
class userinfo_model extends CI_Model{
	const TBL_userinfo = 'userinfo';

	#分页获取用户信息
	public function list_userinfo($limit,$offset){
		$query = $this->db->limit($limit,$offset)->get(self::TBL_userinfo);
		return $query->result_array();
	}

	#添加用户信息，注意返回值,是新插入记录的id
	public function add_userinfo($data){
		$query = $this->db->insert(self::TBL_userinfo,$data);
		return $query ? $this->db->insert_id() : false;
	}


	#获取用户信息信息
	public function get_userinfo($userinfo_id){
		$condition['userinfo_id'] = $userinfo_id;
		$query = $this->db->where($condition)->get(self::TBL_userinfo);
		return $query->row_array();
	}

	#更新
	public function update_userinfo($data,$userinfo_id){
		$condition['userinfo_id'] = $userinfo_id;
		$query = $this->db->where($condition)->update(self::TBL_userinfo,$data);
		return $query ? $userinfo_id : false;
	}

}