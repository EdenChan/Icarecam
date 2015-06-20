<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

//站点信息模型
class SiteInfo_model extends CI_Model
{
    const TBL_siteInfo = 'siteInfo';

    #获取所有站点信息
    public function list_siteInfo()
    {
        $query = $this->db->get(self::TBL_siteInfo);
        return $query->result_array();
    }

    #获取单条站点信息(根据ID值)
    public function get_siteInfo($siteInfo_id)
    {
        $condition['siteInfo_id'] = $siteInfo_id;
        $query = $this->db->where($condition)->get(self::TBL_siteInfo);
        return $query->row_array();
    }

    #获取单条站点信息(根据route值)
    public function get_siteInfo_r($siteInfo_route)
    {
        $condition['siteInfo_route'] = $siteInfo_route;
        $query = $this->db->where($condition)->get(self::TBL_siteInfo);
        return $query->row_array();
    }

    #更新单条信息
    public function update_siteInfo($data, $siteInfo_id)
    {
        $condition['siteInfo_id'] = $siteInfo_id;
        $query = $this->db->where($condition)->update(self::TBL_siteInfo, $data);
        return $query ? $siteInfo_id : false;
    }

}