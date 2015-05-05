<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

//前台首页控制器
class Home extends Home_Controller{

	public function __construct(){
		parent::__construct();
		$this->load->model('goods_model');
		$this->load->model('apps_model');
		$this->load->model('videos_model');
	}

	public function index(){
		$data['goods'] = $this->goods_model->get_index();
		$data['videos'] = $this->videos_model->get_index();

		$this->load->view('index.php',$data);

	}
}