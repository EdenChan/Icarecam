<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


//购物车控制器
class Cart extends Home_Controller
{

    public function __construct()
    {
        parent::__construct();
        // $this->load->library('cart');
    }

    #显示购物车页面
    public function show()
    {
        #获取购物车数据
        $data['carts'] = $this->cart->contents();
        $this->load->view('cart', $data);
    }

    public function add()
    {
        #利用session判断 只允许登录后的用户使用购物车功能
        if ($this->session->userdata('user') != null) {
            #获取表单数据
            $data['id'] = $this->input->post('goods_id');
            $data['name'] = $this->input->post('goods_name');
            // $data['name'] = 'aaa';
            $data['qty'] = $this->input->post('goods_quantity');
            $data['price'] = $this->input->post('shop_price');
            $data['img'] = $this->input->post('goods_img');
            $data['subtotal'] = $data['price'] * $data['qty'];

            #在插入之前，需要判断即将要加入的商品是否已经存在于购物车中
            $carts = $this->cart->contents();
            foreach ($carts as $v) {
                if ($v['id'] == $data['id']) {
                    $data['qty'] += $v['qty'];
                    $data['subtotal'] += $v['subtotal'];
                }
            }

            if ($this->cart->insert($data)) {
                # ok
                redirect('cart/show');
            } else {
                # error
                redirect('cart/show');
            }
        } else {
            $data['message'] = '请先登录或注册为Icarecam的会员后，再进行购物';
            $data['url'] = site_url('user/showCenter');
            $data['wait'] = 3;
            $this->load->view('message.php', $data);
        }

    }

    #删除购物车信息
    public function delete($rowid)
    {
        $data['rowid'] = $rowid;
        $data['qty'] = 0;
        $this->cart->update($data);
        redirect('cart/show');
    }
}