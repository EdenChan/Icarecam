<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

//视频模型
class Videos_model extends CI_Model
{
    const TBL_videos = 'videos';

    #分页获取视频
    public function list_videos($limit, $offset)
    {
        $query = $this->db->limit($limit, $offset)->get(self::TBL_videos);
        return $query->result_array();
    }

    #添加视频，注意返回值,是新插入记录的id
    public function add_videos($data)
    {
        $query = $this->db->insert(self::TBL_videos, $data);
        return $query ? $this->db->insert_id() : false;
    }

    #获取视频总数
    public function count_videos()
    {
        return $this->db->count_all(self::TBL_videos);
    }

    #获取视频信息
    public function get_videos($videos_id)
    {
        $condition['videos_id'] = $videos_id;
        $query = $this->db->where($condition)->get(self::TBL_videos);
        return $query->row_array();
    }

    public function get_index()
    {
        $query = $this->db->where('is_index', 1)->limit(1, 0)->get(self::TBL_videos);
        return $query->result_array();
    }

    #删除
    public function delete_videos($videos_id)
    {
        $condition['videos_id'] = $videos_id;
        $query = $this->db->where($condition)->delete(self::TBL_videos);
        if ($query && $this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    #更新
    public function update_videos($data, $videos_id)
    {
        $condition['videos_id'] = $videos_id;
        $query = $this->db->where($condition)->update(self::TBL_videos, $data);
        return $query ? $videos_id : false;
    }

}