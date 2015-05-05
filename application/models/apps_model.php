<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

//软件模型
class Apps_model extends CI_Model{
	const TBL_apps = 'apps';

	#分页获取软件
	public function list_apps($limit,$offset){
		$query = $this->db->limit($limit,$offset)->get(self::TBL_apps);
		return $query->result_array();
	}

	#添加软件，注意返回值,是新插入记录的id
	public function add_apps($data){
		$query = $this->db->insert(self::TBL_apps,$data);
		return $query ? $this->db->insert_id() : false;
	}

	#获取软件总数
	public function count_apps(){
		return $this->db->count_all(self::TBL_apps);
	}

	#获取软件信息
	public function get_apps($apps_id){
		$condition['apps_id'] = $apps_id;
		$query = $this->db->where($condition)->get(self::TBL_apps);
		return $query->row_array();
	}

	#删除
	public function delete_apps($apps_id){
		$condition['apps_id'] = $apps_id;
		$query = $this->db->where($condition)->delete(self::TBL_apps);
		if ($query && $this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}

	#更新
	public function update_apps($data,$apps_id){
		$condition['apps_id'] = $apps_id;
		$query = $this->db->where($condition)->update(self::TBL_apps,$data);
		return $query ? $apps_id : false;
	}

}