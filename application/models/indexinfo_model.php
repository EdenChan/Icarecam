<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

//站点信息模型
class IndexInfo_model extends CI_Model
{
    const TBL_indexInfo = 'indexInfo';

//    #获取所有主页信息
//    public function list_indexInfo(){
//        $query = $this->db->get(self::TBL_indexInfo);
//        return $query->result_array();
//    }

    #获取单条主页信息(根据ID值)
    public function get_indexInfo($indexInfo_id)
    {
        $condition['indexInfo_id'] = $indexInfo_id;
        $query = $this->db->where($condition)->get(self::TBL_indexInfo);
        return $query->row_array();
    }

    #获取单条主页信息(根据route值)
    public function get_indexInfo_route($indexInfo_route)
    {
        $condition['indexInfo_route'] = $indexInfo_route;
        $query = $this->db->where($condition)->get(self::TBL_indexInfo);
        return $query->row_array();
    }

    #更新单条信息
    public function update_indexInfo($data, $indexInfo_id)
    {
        $condition['indexInfo_id'] = $indexInfo_id;
        $query = $this->db->where($condition)->update(self::TBL_indexInfo, $data);
        return $query ? $indexInfo_id : false;
    }

}