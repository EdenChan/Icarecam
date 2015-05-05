<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
date_default_timezone_set('Etc/GMT-8');

//用户控制器

class User extends Admin_Controller{

	public function __construct(){
		parent::__construct();
		$this->load->model('user_model');
		$this->load->model('userinfo_model');
		$this->load->library('pagination');
	}

	public function index($offset = ''){
		#配置分页信息
		$config['base_url'] = site_url('admin/user/index/');
		$config['total_rows'] = $this->user_model->count_user();
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
		$data['user'] = $this->user_model->list_user($limit,$offset);
		$this->load->view('user_list.php',$data);
	}

	public function detail(){
		#获取配送信息
		$userinfo_id = $this->uri->segment(4,0);
		$data['userinfo'] = $this->userinfo_model->get_userinfo($userinfo_id);

		$this->load->view('user_detail.php',$data);
	}


	public function delete(){

		$user_id = $this->uri->segment(4);
		# code...
		if ($this->user_model->delete_user($user_id)) {
			# code...
			$data['message'] = '删除成功';
			$data['wait'] = 3;
			$data['url'] = site_url('admin/user/index');
			$this->load->view('message.php',$data);
		} else {
			# code...
			$data['message'] = '删除失败';
			$data['wait'] = 3;
			$data['url'] = site_url('admin/user/index');
			$this->load->view('message.php',$data);
		}
	}


}