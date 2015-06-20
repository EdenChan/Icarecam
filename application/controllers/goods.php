<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


//商品控制器
class Goods extends Home_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('goods_model');
        $this->load->library('pagination');
    }

    public function all($offset = '')
    {
        #配置分页信息
        $config['base_url'] = site_url('goods/all/');
        $config['total_rows'] = $this->goods_model->count_goods();
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
        $data['goods'] = $this->goods_model->list_goods($limit, $offset);
        $this->load->view('cameras.php', $data);
    }

    public function single($goods_id)
    {
        $data['goods'] = $this->goods_model->get_goods($goods_id);
        $this->load->view('cameraSingle.php', $data);
    }
}