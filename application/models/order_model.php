<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

//订单模型
class order_model extends CI_Model
{
    const TBL_order = 'order';
    const TBL_order_goods = 'order_goods';

    #分页获取订单
    public function list_order($limit, $offset)
    {
        $query = $this->db->limit($limit, $offset)->get(self::TBL_order);
        return $query->result_array();
    }

    #分页获取当前用户订单
    public function list_user_order($user_id)
    {
        $query = $this->db->get_where(self::TBL_order, array('user_id' => $user_id));
        return $query->result_array();
    }

    #根据订单id获取单条订单信息
    public function get_order_byid($order_id)
    {
        $condition['order_id'] = $order_id;
        $query = $this->db->where($condition)->get(self::TBL_order);
        return $query->row_array();
    }

    #根据订单号获取单条订单信息
    public function get_order($order_sn)
    {
        $condition['order_sn'] = $order_sn;
        $query = $this->db->where($condition)->get(self::TBL_order);
        return $query->row_array();
    }

    #根据订单号获取单条订单中的商品信息
    public function get_order_goods($order_sn)
    {
        $condition['order_sn'] = $order_sn;
        $query = $this->db->where($condition)->get(self::TBL_order_goods);
        return $query->result_array();
    }

    #获取订单总数
    public function count_order()
    {
        return $this->db->count_all(self::TBL_order);
    }

    #获取当前用户订单总数
    public function count_user_order()
    {
        return $this->db->count_all(self::TBL_order);
    }

    #添加订单，注意返回值,是新插入记录的id
    public function add_order($data)
    {
        $query = $this->db->insert(self::TBL_order, $data);
        return $query ? $this->db->insert_id() : false;
    }

    #添加订单物品条目
    public function add_order_goods($data)
    {
        $query = $this->db->insert(self::TBL_order_goods, $data);
        return $query ? true : false;
    }


    #根据订单号删除单条订单信息
    public function delete_order($order_sn)
    {
        $condition['order_sn'] = $order_sn;
        $query = $this->db->where($condition)->delete(self::TBL_order);
        if ($query && $this->db->affected_rows() > 0) {
            # code...
            return true;
        } else {
            # code...
            return false;
        }
    }

    #更新
    public function update_order($data, $order_sn)
    {
        $condition['order_sn'] = $order_sn;
        $query = $this->db->where($condition)->update(self::TBL_order, $data);
        return $query ? $order_sn : false;
    }

}