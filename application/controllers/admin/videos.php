<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
date_default_timezone_set('Etc/GMT-8');

//视频控制器

class Videos extends Admin_Controller{

	public function __construct(){
		parent::__construct();
		$this->load->model('videos_model');
		$this->load->library('pagination');
	}

	public function index($offset = ''){
		#配置分页信息
		$config['base_url'] = site_url('admin/videos/index/');
		$config['total_rows'] = $this->videos_model->count_videos();
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
		$data['videos'] = $this->videos_model->list_videos($limit,$offset);
		$this->load->view('videos_list.php',$data);
	}

	public function add(){
		$this->load->view('videos_add.php');
	}


	public function edit(){
		#获取视频信息
		$videos_id = $this->uri->segment(4,0);
		$data['videos'] = $this->videos_model->get_videos($videos_id);

		$this->load->view('videos_edit.php',$data);
	}

	#添加商品
	public function insert(){
		#获取提交的数据
		$data['videos_name'] = $this->input->post('videos_name');
		$data['videos_src'] = $this->input->post('videos_src');
		$data['is_index'] = $this->input->post('is_index');
		$data['videos_desc'] = $this->input->post('videos_desc');
		$data['videos_brief'] = $this->input->post('videos_brief');
		$data['add_time'] = date("Y-m-d H:i:s");

			if ($videos_id = $this->videos_model->add_videos($data)) {
				$data['message'] = '添加视频成功';
				$data['url'] = site_url('admin/videos/index');
				$data['wait'] = 3;
				$this->load->view('message.php',$data);
			} else {
				# 失败
				$data['message'] = '添加视频失败';
				$data['url'] = site_url('admin/videos/add');
				$data['wait'] = 3;
				$this->load->view('message.php',$data);
			}

	}

	public function delete(){

		$videos_id = $this->uri->segment(4);
		# code...
		if ($this->videos_model->delete_videos($videos_id)) {
			# code...
			$data['message'] = '删除成功';
			$data['wait'] = 3;
			$data['url'] = site_url('admin/videos/index');
			$this->load->view('message.php',$data);
		} else {
			# code...
			$data['message'] = '删除失败';
			$data['wait'] = 3;
			$data['url'] = site_url('admin/videos/index');
			$this->load->view('message.php',$data);
		}
	}

	public function update(){

		$videos_id = $this->input->post('videos_id');
		$data['videos_name'] = $this->input->post('videos_name');
		$data['is_index'] = $this->input->post('is_index');
		$data['videos_desc'] = $this->input->post('videos_desc');
		$data['videos_src'] = $this->input->post('videos_src');
		$data['videos_brief'] = $this->input->post('videos_brief');
		$data['add_time'] = date("Y-m-d H:i:s");

		if ($videos_id = $this->videos_model->update_videos($data,$videos_id)) {

			$data['message'] = '更新成功';
			$data['url'] = site_url('admin/videos/edit') . '/'.$videos_id;
			$data['wait'] = 3;
			$this->load->view('message.php',$data);


		} else {
			# 失败
			$data['message'] = '更新失败';
			$data['url'] = site_url('admin/videos/edit') . '/'.$videos_id;
			$data['wait'] = 3;
			$this->load->view('message.php',$data);
		}

	}

}