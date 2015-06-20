<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


//站点信息控制器
class SiteInfo extends Home_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('siteInfo_model');
    }

    public function show($siteInfo_route)
    {
        $data['siteInfo'] = $this->siteInfo_model->get_siteInfo_r($siteInfo_route);
        $this->load->view($siteInfo_route . '.php', $data);
    }
}