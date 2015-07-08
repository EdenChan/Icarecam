<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

//订单控制器
class Order extends Home_Controller
{
    private $alipay_config;
    public function __construct()
    {
        parent::__construct();
        $this->_init_config();
        $this->load->helper('url');
        $this->load->library('cart');
        $this->load->model('user_model');
        $this->load->model('userinfo_model');
        $this->load->model('order_model');
        $this->load->library('pagination');
    }

    #显示用户订单页面
    public function show()
    {
        $session_name = $this->session->userdata('user');
        if ($session_name != null) {
            #获取当前用户id
            $data['user'] = $this->user_model->get_user_byname($session_name);
            $userinfo_id = $data['user']['user_id'];

            #获取用户信息
            $data['userinfo'] = $this->userinfo_model->get_userinfo($userinfo_id);

            #判断是否已完成设置用户信息
            if (empty($data['userinfo'])) {
                $data['message'] = '请先在会员中心设置好个人的配送信息后，再前往结账';
                $data['url'] = site_url('user/showCenter');
                $data['wait'] = 3;
                $this->load->view('message.php', $data);
            } else {
                #获取购物车数据
                $data['carts'] = $this->cart->contents();
                $this->load->view('orderConfirm', $data);
            }
        } else {
            $data['message'] = '请先登录或注册为Icarecam的会员后，再访问此页面';
            $data['url'] = site_url('user/showCenter');
            $data['wait'] = 3;
            $this->load->view('message.php', $data);
        }
    }

    function do_alipay()
    {
        require_once(APPPATH . 'third_party/alipay/lib/alipay_submit.class.php');
        #获取当前用户id及用户信息
        $alipay_config = $this->alipay_config;
        $session_name = $this->session->userdata('user');
        $userNow = $this->user_model->get_user_byname($session_name);
        $userinfoNow = $this->userinfo_model->get_userinfo($userNow['user_id']);
        $userAddress = $userinfoNow['user_province'].$userinfoNow['user_city'].$userinfoNow['user_district'].$userinfoNow['user_street'];
        #生成订单号
        $year_code = array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J');
        $order_sn = $year_code[intval(date('Y')) - 2010] . strtoupper(dechex(date('m'))) . date('d') . substr(time(), -5) . substr(microtime(), 2, 5) . sprintf('d', rand(0, 99));
        $postscripts = $this->input->post('postscripts');
        $goods_amount = $this->cart->total();
        if ($goods_amount < 100) {
            switch ($this->input->post('shipping')) {
                case '1':
                    $shipping_method= '普通快递';
                    $order_amount = $this->cart->total() + 10;
                    break;

                case '2':
                    $shipping_method = 'EMS';
                    $order_amount = $this->cart->total() + 20;
                    break;

                case '3':
                    $shipping_method = '顺丰';
                    $order_amount = $this->cart->total() + 30;
                    break;
            }
        } else {
            $shipping_method = '免运费';
            $order_amount = $goods_amount;
        }
        $this->session->set_userdata('order_sn', $order_sn);
        $this->session->set_userdata('postscripts', $postscripts);
        $this->session->set_userdata('shipping_method', $shipping_method);
        $this->session->set_userdata('order_amount', $order_amount);

        //构造要请求的参数数组，无需改动
        $parameter = array(
            "service" => "create_partner_trade_by_buyer",
            'key' =>trim($alipay_config['key']),
            "partner" => trim($alipay_config['partner']),
            "seller_email" => trim($alipay_config['seller_email']),
            "payment_type" => "1",
            "notify_url" => site_url('order/do_notify'),
            "return_url" => site_url('order/do_return'),
            "out_trade_no" => $order_sn,//商户订单号
            "subject" => 'Icarecam官方网站订单'.$order_sn,//订单名称
            //"total_fee"       => $this->input->post('WIDtotal_fee'),//必填,付款金额
            "price" => $order_amount,//测试用
            "quantity"=>1,
            "body" =>'感谢您在Icarecam官方网站购买产品，您的订单号是'.$order_sn.'订单备注：'.$postscripts,//必填,订单描述
            "show_url" => site_url('user/showCenter'),
            "anti_phishing_key" => '',//防钓鱼时间戳
            "exter_invoke_ip" => '',//客户端的IP地址
            "receive_name" => $userinfoNow['user_realname'],
            "receive_address" => $userAddress,
            "receive_zip" => $userinfoNow['user_zipcode'],
            "receive_mobile" => $userinfoNow['user_mobile'],
            "logistics_fee" => "0.00",
            //必填，即运费
            //物流类型
            "logistics_type" => "EXPRESS",
            //必填，三个值可选：EXPRESS（快递）、POST（平邮）、EMS（EMS）
            //物流支付方式
            "logistics_payment" =>"SELLER_PAY",
            "_input_charset" => trim(strtolower($alipay_config['input_charset']))
        );


        //建立请求
        $alipaySubmit = new AlipaySubmit($this->alipay_config);
        $html_text = $alipaySubmit->buildRequestForm($parameter, "get", "正在为您转入支付宝页面...");
        echo $html_text;
    }


    //处理异步通知，只需要处理这个就行，因为当用户付款完毕x掉界面，同步通知就发布过去了，
    function do_notify()
    {
        require_once(APPPATH . 'third_party/alipay/lib/alipay_notify.class.php');
        //计算得出通知验证结果
        $alipayNotify = new AlipayNotify($this->alipay_config);
        $verify_result = $alipayNotify->verifyNotify();
        logResult('111111111111111/r/n');
        logResult($verify_result);
        if ($verify_result) {//验证成功
            /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
            //请在这里加上商户的业务逻辑程序代


            //——请根据您的业务逻辑来编写程序（以下代码仅作参考）——

            //获取支付宝的通知返回参数，可参考技术文档中服务器异步通知参数列表

            //商户订单号

            $out_trade_no = $_POST['out_trade_no'];

            //支付宝交易号

            $trade_no = $_POST['trade_no'];

            //交易状态
            $trade_status = $_POST['trade_status'];
            logResult($trade_no);
            //异步通知处理，就是支付成功，用户x掉界面后，更新本地的订单
            if ($trade_status == 'TRADE_FINISHED' || $trade_status == 'TRADE_SUCCESS') {
                //判断该笔订单是否在商户网站中已经做过处理
                //如果没有做过处理，根据订单号（out_trade_no）在商户网站的订单系统中查到该笔订单的详细，并执行商户的业务程序
                //如果有做过处理，不执行商户的业务程序
                /********************************************************************************/
                /******************************这里是业务逻辑**************************************/

//                $data['alipay_buyer_id'] = $this->input->post('buyer_id');
//                $data['alipay_buyer_email'] = $this->input->post('buyer_email');
//                $data['alipay_trade_no'] = $this->input->post('trade_no');//支付宝交易号
//                $data['ordername'] = $this->input->post('subject');
//                $data['orderstr'] = $this->input->post('out_trade_no');
//                $data['price'] = $this->input->post('total_fee');
//                $data['orderstr'] = $this->input->post('out_trade_no');
//
//                logResult($data['ordername']);
//                //$data['trade_status']=$this->input->get('rade_status');//交易状态
//                $this->load->Model('alipay_m');
//                //先要进行订单号和价格的查询比对，ok之后再去修改order，修改pay的状态
//                $this->alipay_m->porder($data);
                $this->add();
            }

            //——请根据您的业务逻辑来编写程序（以上代码仅作参考）——

            //请不要修改或删除

            /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        } else {
            //验证失败
            echo "fail";

            //调试用，写文本函数记录程序运行情况是否正常
            //logResult("这里写入想要调试的代码变量值，或其他运行的结果记录");
        }

    }

    //同步通知处理，不要进行处理了，避免重复，因为不管怎么样，都会发异步通知
    //不过这里同步通知可以本地调试，可以调试好业务逻辑代码
    function do_return()
    {
        require_once(APPPATH . 'third_party/alipay/lib/alipay_notify.class.php');
        //计算得出通知验证结果
        $alipayNotify = new AlipayNotify($this->alipay_config);
        $verify_result = $alipayNotify->verifyReturn();
        logResult('111111111111111/r/n');
        logResult($verify_result);
        if ($verify_result) {//验证成功
            /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
            //请在这里加上商户的业务逻辑程序代


            //——请根据您的业务逻辑来编写程序（以下代码仅作参考）——

            //获取支付宝的通知返回参数，可参考技术文档中服务器异步通知参数列表

            //商户订单号

            $out_trade_no = $_GET['out_trade_no'];

            //支付宝交易号

            $trade_no = $_GET['trade_no'];

            //交易状态
            $trade_status = $_GET['trade_status'];
            logResult($trade_no);
            //异步通知处理，就是支付成功，用户x掉界面后，更新本地的订单
            if ($trade_status == 'TRADE_FINISHED' || $trade_status == 'TRADE_SUCCESS'|| $trade_status == 'WAIT_SELLER_SEND_GOODS') {
                //判断该笔订单是否在商户网站中已经做过处理
                //如果没有做过处理，根据订单号（out_trade_no）在商户网站的订单系统中查到该笔订单的详细，并执行商户的业务程序
                //如果有做过处理，不执行商户的业务程序
                /********************************************************************************/
                /******************************这里是业务逻辑**************************************/

//                $data['alipay_buyer_id'] = $this->input->post('buyer_id');
//                $data['alipay_buyer_email'] = $this->input->post('buyer_email');
//                $data['alipay_trade_no'] = $this->input->post('trade_no');//支付宝交易号
//                $data['ordername'] = $this->input->post('subject');
//                $data['orderstr'] = $this->input->post('out_trade_no');
//                $data['price'] = $this->input->post('total_fee');
//                $data['orderstr'] = $this->input->post('out_trade_no');
//
//                logResult($data['ordername']);
//                //$data['trade_status']=$this->input->get('rade_status');//交易状态
//                $this->load->Model('alipay_m');
//                //先要进行订单号和价格的查询比对，ok之后再去修改order，修改pay的状态
//                $this->alipay_m->porder($data);
                $this->add();
            }

            //——请根据您的业务逻辑来编写程序（以上代码仅作参考）——

            //请不要修改或删除

            /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        } else {
            //验证失败
            echo "fail";

            //调试用，写文本函数记录程序运行情况是否正常
            //logResult("这里写入想要调试的代码变量值，或其他运行的结果记录");
        }

    }


    /**
     * 初始化支付宝配置，详细参数请根据自己实际接口修改
     */
    private function _init_config()
    {
        //支付宝帐户
        //*******要配置的地方之一 收款账号*********
        $alipay_config['seller_email'] = 'admin@xplorecam.com';


        //合作身份者id，以2088开头的16位纯数字
        //********要配置的地方之二 合作身份者id******
        $alipay_config['partner'] = '2088411945124018';


        //安全检验码，以数字和字母组成的32位字符
        //********要配置的地方之三 安全检验码*******
        $alipay_config['key'] = '14x64jjt2xpjdry3glccq3l0pddjdpfi';

        //签名方式 不需修改
        $alipay_config['sign_type'] = strtoupper('MD5');

        //字符编码格式 目前支持 gbk 或 utf-8
        $alipay_config['input_charset'] = strtolower('utf-8');

        //ca证书路径地址，用于curl中ssl校验
        //请保证cacert.pem文件在当前文件夹目录中
        $alipay_config['cacert'] = APPPATH . 'third_party/alipay/cacert.pem';

        //访问模式,根据自己的服务器是否支持ssl访问，若支持请选择https；若不支持请选择http
        $alipay_config['transport'] = 'http';

        $this->alipay_config = $alipay_config;
    }

    #添加订单到数据库
    public function add()
    {
        #利用session判断 只允许登录后的用户使用订单功能
        if ($this->session->userdata('user') != null) {

            #添加订单信息
            #############################################

            #生成订单号
//            $year_code = array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J');
//            $data['order_sn'] = $year_code[intval(date('Y')) - 2010] . strtoupper(dechex(date('m'))) . date('d') . substr(time(), -5) . substr(microtime(), 2, 5) . sprintf('d', rand(0, 99));
//            $data['order_sn'] = $this->input->post('order_sn');

            $data['order_sn'] = $this->session->userdata('order_sn');
            #获取购物车总额
            $data['goods_amount'] = $this->cart->total();

            $data['shipping_method'] = $this->session->userdata('shipping_method');

            $data['order_amount'] = $this->session->userdata('order_amount');

            #记录快递方式 计算订单总额


            #获取当前用户id
            $session_name = $this->session->userdata('user');
            $userNow = $this->user_model->get_user_byname($session_name);
            $data['user_id'] = $userNow['user_id'];

            #获取订单附言
            $data['postscripts'] = $this->session->userdata('postscripts');

            #设置订单初始状态
            $data['order_status'] = '未发货';

            #设置订单时间
            $data['order_time'] = date("Y-m-d H:i:s");

            #完成订单添加
            if ($order_id = $this->order_model->add_order($data)) {

                #添加订单货物信息
                #############################################

                $carts = $this->cart->contents();
                foreach ($carts as $v) {
                    $data_goods['goods_name'] = $v['name'];
                    $data_goods['goods_number'] = $v['qty'];
                    $data_goods['goods_img'] = $v['img'];
                    $data_goods['shop_price'] = $v['price'];
                    $data_goods['subtotal'] = $v['subtotal'];
                    $orderNow = $this->order_model->get_order_byid($order_id);
                    $data_goods['order_sn'] = $orderNow['order_sn'];
                    $this->order_model->add_order_goods($data_goods);
                }
                $this->cart->destroy();
                $this->session->unset_userdata('order_sn');
                $this->session->unset_userdata('postscripts');
                $this->session->unset_userdata('shipping_method');
                $this->session->unset_userdata('order_amount');

                #添加订单末尾操作：发送提醒邮件

                // $mail_body = 'Icarecam订单:'.$orderNow['order_sn'].'已提交成功,请点击链接查看历史订单，关注订单发货状态，发送时间：'.date('Y-m-d H:i:s');
                //      	$this->load->library('Mailer');
                //      	$this->mailer->sendmail(
                //          	$userNow['email'],
                //          	$userNow['user_name'],
                //          	'您在Icarecam的订单'.$orderNow['order_sn'].'已提交成功',
                //          	$mail_body
                //      	);
                $data['message'] = '您的订单已支付成功，可在用户中心查看提交过的订单';
                $data['url'] = site_url('user/showCenter');
                $data['wait'] = 3;
                $this->load->view('message.php', $data);
            } else {
                $data['message'] = '订单提交失败，请重试';
                $data['url'] = site_url('order/show');
                $data['wait'] = 3;
                $this->load->view('message.php', $data);
            }

        } else {
            $data['message'] = '请先登录或注册为Icarecam的会员后，再访问此页面';
            $data['url'] = site_url('user/showCenter');
            $data['wait'] = 3;
            $this->load->view('message.php', $data);
        }

    }

    public function check()
    {
        print_r($this->cart->contents());
        echo APPPATH;
    }

    #获取订单详情
    public function detail()
    {
        $order_sn = $this->uri->segment(3);

        $session_name = $this->session->userdata('user');
        $data['user'] = $this->user_model->get_user_byname($session_name);
        $userinfo_id = $data['user']['user_id'];
        $data['userinfo'] = $this->userinfo_model->get_userinfo($userinfo_id);
        $data['order'] = $this->order_model->get_order($order_sn);
        $data['order_goods'] = $this->order_model->get_order_goods($order_sn);
        $this->load->view('orderSingle.php', $data);
    }

    #删除订单信息
    public function delete()
    {

        $order_sn = $this->uri->segment(3);
        # code...
        if ($this->order_model->delete_order($order_sn)) {
            # code...
            $data['message'] = '已撤销此订单';
            $data['wait'] = 3;
            $data['url'] = site_url('user/showCenter');
            $this->load->view('message.php', $data);
        } else {
            # code...
            $data['message'] = '撤销失败';
            $data['wait'] = 3;
            $data['url'] = site_url('user/showCenter');
            $this->load->view('message.php', $data);
        }
    }
}