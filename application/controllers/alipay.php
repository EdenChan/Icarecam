<?php
/**
 * alipy支付接口
 *
 */
class Alipay extends CI_Controller {
    private $alipay_config;

    function __construct() {
        parent::__construct();
        $this->_init_config();
        $this->load->helper('url');
    }

    function index() {
        $this->load->view('alipay');//装载支付视图页面，post到do_alipay
    }

    function do_alipay() {
        require_once(APPPATH . 'third_party/alipay/lib/alipay_submit.class.php');
        //构造要请求的参数数组，无需改动
        $parameter = array(
            // "service"        => "create_direct_pay_by_user",
            // "partner"        => trim($this->alipay_config['partner']),
            // "payment_type"   => '1',
            "service" => "create_partner_trade_by_buyer",
            "partner" => trim($alipay_config['partner']),
            "seller_email" => trim($alipay_config['seller_email']),
            "payment_type" => $payment_type,
            "notify_url" => site_url('alipay/do_notify'),
            "return_url" => site_url('alipay/do_return'),
            "seller_email" => trim($this->alipay_config['seller_emaill']),//支付宝帐户,
            "out_trade_no" => $this->input->post('WIDout_trade_no'),//商户订单号
            "subject" => $this->input->post('WIDsubject'),//订单名称
            //"total_fee"       => $this->input->post('WIDtotal_fee'),//必填,付款金额
            "total_fee" => $this->input->post('WIDtotal_fee'),//测试用
            "body" => $this->input->post('WIDbody'),//必填,订单描述
            //"show_url"        => $this->input->post('WIDshow_url'),//商品展示地址
            "show_url" => 'http://d.arting365.com',
            "anti_phishing_key" => '',//防钓鱼时间戳
            "exter_invoke_ip" => '',//客户端的IP地址
            "receive_name" => $receive_name,
            "receive_address" => $receive_address,
            "receive_zip" => $receive_zip,
            "receive_phone" => $receive_phone,
            "receive_mobile" => $receive_mobile,
            "logistics_fee" => $logistics_fee,
            "logistics_type" => $logistics_type,
            "logistics_payment" => $logistics_payment,
            "_input_charset" => trim(strtolower($alipay_config['input_charset']))
        );


        //建立请求
        $alipaySubmit = new AlipaySubmit($this->alipay_config);
        $html_text = $alipaySubmit->buildRequestForm($parameter, "get", "正在为您转入支付宝页面...");
        //加一个编码页面，避免跳转页面显示错误
        header("Content-type:text/html;charset=utf-8");
        echo $html_text;
    }


    //处理异步通知，只需要处理这个就行，因为当用户付款完毕x掉界面，同步通知就发布过去了，
    function do_notify() {
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
            if ($_POST['trade_status'] == 'TRADE_FINISHED' || $_POST['trade_status'] == 'TRADE_SUCCESS') {
                //判断该笔订单是否在商户网站中已经做过处理
                //如果没有做过处理，根据订单号（out_trade_no）在商户网站的订单系统中查到该笔订单的详细，并执行商户的业务程序
                //如果有做过处理，不执行商户的业务程序
                /********************************************************************************/
                /******************************这里是业务逻辑**************************************/

                $data['alipay_buyer_id'] = $this->input->post('buyer_id');
                $data['alipay_buyer_email'] = $this->input->post('buyer_email');
                $data['alipay_trade_no'] = $this->input->post('trade_no');//支付宝交易号
                $data['ordername'] = $this->input->post('subject');
                $data['orderstr'] = $this->input->post('out_trade_no');
                $data['price'] = $this->input->post('total_fee');
                $data['orderstr'] = $this->input->post('out_trade_no');

                logResult($data['ordername']);
                //$data['trade_status']=$this->input->get('rade_status');//交易状态
                $this->load->Model('alipay_m');
                //先要进行订单号和价格的查询比对，ok之后再去修改order，修改pay的状态
                $this->alipay_m->porder($data);
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
    function do_return() {
        require_once(APPPATH . 'third_party/alipay/lib/alipay_notify.class.php');
        $alipayNotify = new AlipayNotify($this->alipay_config);
        $verify_result = $alipayNotify->verifyReturn();

        if ($verify_result) {//验证成功
            /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
            //请在这里加上商户的业务逻辑程序代码

            //——请根据您的业务逻辑来编写程序（以下代码仅作参考）——
            //获取支付宝的通知返回参数，可参考技术文档中页面跳转同步通知参数列表

            //商户订单号

            $out_trade_no = $_GET['out_trade_no'];

            //支付宝交易号

            $trade_no = $_GET['trade_no'];

            //交易状态
            $trade_status = $_GET['trade_status'];


            if ($_GET['trade_status'] == 'TRADE_FINISHED' || $_GET['trade_status'] == 'TRADE_SUCCESS') {
                //判断该笔订单是否在商户网站中已经做过处理
                //如果没有做过处理，根据订单号（out_trade_no）在商户网站的订单系统中查到该笔订单的详细，并执行商户的业务程序
                //如果有做过处理，不执行商户的业务程序
            } else {
                echo "trade_status=" . $_GET['trade_status'];
            }

            echo "验证成功<br />";

            //——请根据您的业务逻辑来编写程序（以上代码仅作参考）——
            //用model进行数据库入库操作

            /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        } else {
            //验证失败
            //如要调试，请看alipay_notify.php页面的verifyReturn函数
            echo "验证失败";

        }

    }


    /**
     * 初始化支付宝配置，详细参数请根据自己实际接口修改
     */
    private function _init_config() {
        //支付宝帐户
        //*******要配置的地方之一 收款账号*********
        $alipay_config['seller_emaill'] = 'xxxxxxxxxx';


        //合作身份者id，以2088开头的16位纯数字
        //********要配置的地方之二 合作身份者id******
        $alipay_config['partner'] = 'xxxxxxxxxxxx';


        //安全检验码，以数字和字母组成的32位字符
        //********要配置的地方之三 安全检验码*******
        $alipay_config['key'] = 'xxxxxxxxxxxxxxx';

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
}