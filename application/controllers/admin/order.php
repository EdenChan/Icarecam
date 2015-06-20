<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
date_default_timezone_set('Etc/GMT-8');

//后台订单控制器

class order extends Admin_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('order_model');
        $this->load->model('user_model');
        $this->load->model('userinfo_model');
        $this->load->library('pagination');
    }

    public function index($offset = '')
    {
        #配置分页信息
        $config['base_url'] = site_url('admin/order/index/');
        $config['total_rows'] = $this->order_model->count_order();
        $config['per_page'] = 10;
        $config['uri_segment'] = 4;

        #自定义分页链接
        $config['first_link'] = '首页';
        $config['last_link'] = '尾页';
        $config['prev_link'] = '上一页';
        $config['next_link'] = '下一页';

        #初始化分页类
        $this->pagination->initialize($config);

        #生成分页信息
        $data['pageinfo'] = $this->pagination->create_links();

        $limit = $config['per_page'];
        $data['order'] = $this->order_model->list_order($limit, $offset);

        $this->load->view('order_list.php', $data);
    }

    public function detail()
    {
        $order_sn = $this->uri->segment(4);

        $data['order'] = $this->order_model->get_order($order_sn);
        $userinfo_id = $data['order']['user_id'];
        $data['userinfo'] = $this->userinfo_model->get_userinfo($userinfo_id);
        $data['order'] = $this->order_model->get_order($order_sn);
        $data['order_goods'] = $this->order_model->get_order_goods($order_sn);
        $this->load->view('order_detail.php', $data);
    }

    #更新订单状态
    public function update()
    {

        $order_sn = $this->input->post('order_sn');
        $data['order_status'] = $this->input->post('order_status');

        if ($siteInfo_id = $this->order_model->update_order($data, $order_sn)) {

            $data['message'] = '设置订单状态成功';
            $data['url'] = site_url('admin/order/index');
            $data['wait'] = 3;
            $this->load->view('message.php', $data);

        } else {
            # 失败
            $data['message'] = '设置失败';
            $data['url'] = site_url('admin/order/index');
            $data['wait'] = 3;
            $this->load->view('message.php', $data);
        }

    }

    #删除订单
    public function delete()
    {

        $order_sn = $this->uri->segment(4);
        # code...
        if ($this->order_model->delete_order($order_sn)) {
            # code...
            $data['message'] = '删除成功';
            $data['wait'] = 3;
            $data['url'] = site_url('admin/order/index');
            $this->load->view('message.php', $data);
        } else {
            # code...
            $data['message'] = '删除失败';
            $data['wait'] = 3;
            $data['url'] = site_url('admin/order/index');
            $this->load->view('message.php', $data);
        }
    }


}