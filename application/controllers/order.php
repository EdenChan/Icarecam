<?php if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

//订单控制器
class Order extends Home_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->library('cart');
		$this->load->model('user_model');
		$this->load->model('userinfo_model');
		$this->load->model('order_model');
		$this->load->library('pagination');
	}

	#显示用户订单页面
	public function show() {
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

	#添加订单到数据库
	public function add() {
		#利用session判断 只允许登录后的用户使用订单功能
		if ($this->session->userdata('user') != null) {

			#添加订单信息
			#############################################

			#生成订单号
			$year_code = array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J');
			$data['order_sn'] = $year_code[intval(date('Y')) - 2010] . strtoupper(dechex(date('m'))) . date('d') . substr(time(), -5) . substr(microtime(), 2, 5) . sprintf('d', rand(0, 99));

			#获取购物车总额
			$data['goods_amount'] = $this->cart->total();

			#记录快递方式 计算订单总额
			switch ($this->input->post('shipping')) {
				case '1':
					$data['shipping_method'] = '普通快递';
					$data['order_amount'] = $this->cart->total() + 10;
					break;

				case '2':
					$data['shipping_method'] = 'EMS';
					$data['order_amount'] = $this->cart->total() + 20;
					break;

				case '3':
					$data['shipping_method'] = '顺丰';
					$data['order_amount'] = $this->cart->total() + 30;
					break;

				default:
					$data['shipping_method'] = '免运费';
					$data['order_amount'] = $this->cart->total();
					break;
			}

			#获取当前用户id
			$session_name = $this->session->userdata('user');
			$userNow = $this->user_model->get_user_byname($session_name);
			$data['user_id'] = $userNow['user_id'];

			#获取订单附言
			$data['postscripts'] = $this->input->post('postscripts');

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

				#添加订单末尾操作：发送提醒邮件

				// $mail_body = 'Icarecam订单:'.$orderNow['order_sn'].'已提交成功,请点击链接查看历史订单，关注订单发货状态，发送时间：'.date('Y-m-d H:i:s');
				//      	$this->load->library('Mailer');
				//      	$this->mailer->sendmail(
				//          	$userNow['email'],
				//          	$userNow['user_name'],
				//          	'您在Icarecam的订单'.$orderNow['order_sn'].'已提交成功',
				//          	$mail_body
				//      	);
				$data['message'] = '订单提交成功，可在用户中心查看提交过的订单';
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

	public function check() {
		print_r($this->cart->contents());
		echo APPPATH;
	}

	#获取订单详情
	public function detail() {
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
	public function delete() {

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