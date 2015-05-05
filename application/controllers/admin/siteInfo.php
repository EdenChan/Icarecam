<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
date_default_timezone_set('Etc/GMT-8');

//站点信息控制器

class SiteInfo extends Admin_Controller{

	public function __construct(){
		parent::__construct();
		$this->load->model('siteInfo_model');
	}

	public function index(){

		$data['siteInfo'] = $this->siteInfo_model->list_siteInfo();
		$this->load->view('siteInfo_list.php',$data);
	}


	public function edit(){
		#获取站点信息
		$siteInfo_id = $this->uri->segment(4,0);
		$data['siteInfo'] = $this->siteInfo_model->get_siteInfo($siteInfo_id);

		$this->load->view('siteInfo_edit.php',$data);
	}


	public function update(){

		$siteInfo_id = $this->input->post('siteInfo_id');
		$data['siteInfo_desc'] = $this->input->post('siteInfo_desc');

		if ($siteInfo_id = $this->siteInfo_model->update_siteInfo($data,$siteInfo_id)) {

			$data['message'] = '设置成功';
			$data['url'] = site_url('admin/siteInfo/edit') . '/'.$siteInfo_id;
			$data['wait'] = 3;
			$this->load->view('message.php',$data);

		} else {
			# 失败
			$data['message'] = '设置失败';
			$data['url'] = site_url('admin/siteInfo/edit') . '/'.$siteInfo_id;
			$data['wait'] = 3;
			$this->load->view('message.php',$data);
		}

	}

}