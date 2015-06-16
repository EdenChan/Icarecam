<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

//前台首页控制器
class Home extends Home_Controller{

	public function __construct(){
		parent::__construct();
		$this->load->model('goods_model');
		$this->load->model('apps_model');
		$this->load->model('videos_model');
        $this->load->model('indexInfo_model');
	}

	public function index(){
		$data['goods'] = $this->goods_model->get_index();
		$data['videos'] = $this->videos_model->get_index();
        $data['index_brief'] = $this->indexInfo_model->get_indexInfo_route('index_brief');
        $data['index_slogan'] = $this->indexInfo_model->get_indexInfo_route('index_slogan');
        $data['index_merit_1'] = $this->indexInfo_model->get_indexInfo_route('index_merit_1');
        $data['index_merit_2'] = $this->indexInfo_model->get_indexInfo_route('index_merit_2');
        $data['index_merit_3'] = $this->indexInfo_model->get_indexInfo_route('index_merit_3');
        $data['index_slide_1_url'] = $this->indexInfo_model->get_indexInfo_route('index_slide_1_url');
        $data['index_slide_2_url'] = $this->indexInfo_model->get_indexInfo_route('index_slide_2_url');
        $data['index_slide_3_url'] = $this->indexInfo_model->get_indexInfo_route('index_slide_3_url');
        $data['index_slide_4_url'] = $this->indexInfo_model->get_indexInfo_route('index_slide_4_url');

		$this->load->view('index.php',$data);

	}
}