<?php if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

//软件控制器
class Apps extends Home_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('apps_model');
		$this->load->library('pagination');
	}

	public function all($offset = '') {
		#配置分页信息
		$config['base_url'] = site_url('apps/all/');
		$config['total_rows'] = $this->apps_model->count_apps();
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
		$data['apps'] = $this->apps_model->list_apps($limit, $offset);
		$this->load->view('appDownload.php', $data);
	}

	public function single($apps_id) {
		$data['apps'] = $this->apps_model->get_apps($apps_id);
		$this->load->view('appSingle.php', $data);
	}
}