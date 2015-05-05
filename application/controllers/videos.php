<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


//视频控制器
class Videos extends Home_Controller{

	public function __construct(){
		parent::__construct();
		$this->load->model('videos_model');
		$this->load->library('pagination');
	}

	public function all($offset = ''){
		#配置分页信息
		$config['base_url'] = site_url('videos/all/');
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
		$this->load->view('videos.php',$data);
	}

	public function single($videos_id){
		$data['videos'] = $this->videos_model->get_videos($videos_id);
		$this->load->view('videoSingle.php',$data);
	}
}