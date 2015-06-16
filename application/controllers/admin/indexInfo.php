<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
date_default_timezone_set('Etc/GMT-8');

//站点信息控制器

class IndexInfo extends Admin_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('indexInfo_model');
    }

    public function index() {

        $data['index_brief'] = $this->indexInfo_model->get_indexInfo_route('index_brief');
        $data['index_slogan'] = $this->indexInfo_model->get_indexInfo_route('index_slogan');
        $data['index_slogan_bg'] = $this->indexInfo_model->get_indexInfo_route('index_slogan_bg');
        $data['index_merit_1'] = $this->indexInfo_model->get_indexInfo_route('index_merit_1');
        $data['index_merit_2'] = $this->indexInfo_model->get_indexInfo_route('index_merit_2');
        $data['index_merit_3'] = $this->indexInfo_model->get_indexInfo_route('index_merit_3');
        $data['index_slide_1_url'] = $this->indexInfo_model->get_indexInfo_route('index_slide_1_url');
        $data['index_slide_2_url'] = $this->indexInfo_model->get_indexInfo_route('index_slide_2_url');
        $data['index_slide_3_url'] = $this->indexInfo_model->get_indexInfo_route('index_slide_3_url');
        $data['index_slide_4_url'] = $this->indexInfo_model->get_indexInfo_route('index_slide_4_url');
        $this->load->view('indexInfo_list.php', $data);
    }

    public function update() {

        $index_brief_id = $this->input->post('index_brief_id');
        $data_index_brief['indexInfo_desc'] = $this->input->post('index_brief_desc');
        $index_slogan_id = $this->input->post('index_slogan_id');
        $data_index_slogan['indexInfo_desc'] = $this->input->post('index_slogan_desc');
//        $index_slogan_bg_id = $this->input->post('index_slogan_bg_id');
//        $data_index_slogan_bg['indexInfo_desc'] = $this->input->post('index_slogan_bg_desc');
        $index_merit_1_id = $this->input->post('index_merit_1_id');
        $data_index_merit_1['indexInfo_desc'] = $this->input->post('index_merit_1_desc');
        $index_merit_2_id = $this->input->post('index_merit_2_id');
        $data_index_merit_2['indexInfo_desc'] = $this->input->post('index_merit_2_desc');
        $index_merit_3_id = $this->input->post('index_merit_3_id');
        $data_index_merit_3['indexInfo_desc'] = $this->input->post('index_merit_3_desc');
        $index_slide_1_url_id = $this->input->post('index_slide_1_url_id');
        $data_index_slide_1_url['indexInfo_desc'] = $this->input->post('index_slide_1_url');
        $index_slide_2_url_id = $this->input->post('index_slide_2_url_id');
        $data_index_slide_2_url['indexInfo_desc'] = $this->input->post('index_slide_2_url');
        $index_slide_3_url_id = $this->input->post('index_slide_3_url_id');
        $data_index_slide_3_url['indexInfo_desc'] = $this->input->post('index_slide_3_url');
        $index_slide_4_url_id = $this->input->post('index_slide_4_url_id');
        $data_index_slide_4_url['indexInfo_desc'] = $this->input->post('index_slide_4_url');

        if (($index_brief_id = $this->indexInfo_model->update_indexInfo($data_index_brief, $index_brief_id))
            && ($index_slogan_id = $this->indexInfo_model->update_indexInfo($data_index_slogan, $index_slogan_id))
            && ($index_merit_1_id = $this->indexInfo_model->update_indexInfo($data_index_merit_1, $index_merit_1_id))
            && ($index_merit_2_id = $this->indexInfo_model->update_indexInfo($data_index_merit_2, $index_merit_2_id))
            && ($index_merit_3_id = $this->indexInfo_model->update_indexInfo($data_index_merit_3, $index_merit_3_id))
            && ($index_slide_1_url_id = $this->indexInfo_model->update_indexInfo($data_index_slide_1_url, $index_slide_1_url_id))
            && ($index_slide_2_url_id = $this->indexInfo_model->update_indexInfo($data_index_slide_2_url, $index_slide_2_url_id))
            && ($index_slide_3_url_id = $this->indexInfo_model->update_indexInfo($data_index_slide_3_url, $index_slide_3_url_id))
            && ($index_slide_4_url_id = $this->indexInfo_model->update_indexInfo($data_index_slide_4_url, $index_slide_4_url_id))

        ) {
            if ($_FILES['index_slogan_bg']['name'] != '') {
                $config['file_name'] = 'index_slogan_bg.jpg';
                $config['upload_path'] = './public/uploads/';
                $config['allowed_types'] = 'jpg|gif|png|rar|7z|zip';
                $config['max_size'] = 70000;
                $config['overwrite'] = true;
                $this->load->library('upload', $config);
                $this->upload->do_upload('index_slogan_bg');
            }
            for ($i = 1; $i < 5; $i++) {
                if ($_FILES['index_slide_' . $i]['name'] != '') {
                    $config['file_name'] = 'index_slide_' . $i . '.jpg';
                    $config['upload_path'] = './public/uploads/';
                    $config['allowed_types'] = 'jpg|gif|png|rar|7z|zip';
                    $config['max_size'] = 70000;
                    $config['overwrite'] = true;
                    $this->load->library('upload', $config);
                    $this->upload->do_upload('index_slide_' . $i);
                }
            }

            $data['message'] = '设置成功';
            $data['url'] = site_url('admin/indexInfo/index');
            $data['wait'] = 3;
            $this->load->view('message.php', $data);

        } else {
            # 失败
            $data['message'] = '设置失败';
            $data['url'] = site_url('admin/indexInfo/index');
            $data['wait'] = 3;
            $this->load->view('message.php', $data);
        }
    }

    public function delImg() {
        $i = $this->uri->segment(4, 0);
        if (@unlink('public/uploads/' . 'index_slide_' . $i . '.jpg')) {
            $data['message'] = '删除成功';
            $data['url'] = site_url('admin/indexInfo/index');
            $data['wait'] = 3;
            $this->load->view('message.php', $data);
        } else {
            $data['message'] = '删除失败';
            $data['url'] = site_url('admin/indexInfo/index');
            $data['wait'] = 3;
            $this->load->view('message.php', $data);
        }
    }
}