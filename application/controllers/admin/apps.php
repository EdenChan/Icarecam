<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
date_default_timezone_set('Etc/GMT-8');

//软件控制器

class Apps extends Admin_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('apps_model');
        $this->load->library('pagination');
        // $this->output->enable_profiler(true);
    }

    public function index($offset = '')
    {
        #配置分页信息
        $config['base_url'] = site_url('admin/apps/index/');
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
        $this->load->view('apps_list.php', $data);
    }

    public function add()
    {
        $this->load->view('apps_add.php');
    }


    public function edit()
    {
        #获取app信息
        $apps_id = $this->uri->segment(4, 0);
        $data['apps'] = $this->apps_model->get_apps($apps_id);

        $this->load->view('apps_edit.php', $data);
    }

    #添加商品
    public function insert()
    {
        #获取提交的数据
        $data['apps_name'] = $this->input->post('apps_name');
        $data['apps_brief'] = $this->input->post('apps_brief');
        $data['apps_desc'] = $this->input->post('apps_desc');
        $data['add_time'] = date("Y-m-d H:i:s");

        #完成上传文件
        $config['upload_path'] = './public/uploads/';
        $config['allowed_types'] = 'jpg|gif|png|rar|7z|zip';
        $config['max_size'] = 500000;
        $this->load->library('upload', $config);

        if ($this->upload->do_upload('apps_img')) {
            $res = $this->upload->data(); //获取上传文件的信息
            $data['apps_img'] = $res['file_name'];
            if ($this->upload->do_upload('apps_file')) {
                $res2 = $this->upload->data(); //获取上传文件的信息
                $data['apps_file'] = $res2['file_name'];

                if ($apps_id = $this->apps_model->add_apps($data)) {
                    $data['message'] = '添加APP成功';
                    $data['url'] = site_url('admin/apps/index');
                    $data['wait'] = 3;
                    $this->load->view('message.php', $data);
                } else {
                    # 失败
                    $data['message'] = '添加APP失败';
                    $data['url'] = site_url('admin/apps/add');
                    $data['wait'] = 3;
                    $this->load->view('message.php', $data);
                }
            }

        } else {
            # 上传失败
            $data['message'] = $this->upload->display_errors();
            $data['url'] = site_url('admin/apps/add');
            $data['wait'] = 3;
            $this->load->view('message.php', $data);
        }

    }

    public function delete()
    {

        $apps_id = $this->uri->segment(4);
        # code...
        if ($this->apps_model->delete_apps($apps_id)) {
            # code...
            $data['message'] = '删除成功';
            $data['wait'] = 3;
            $data['url'] = site_url('admin/apps/index');
            $this->load->view('message.php', $data);
        } else {
            # code...
            $data['message'] = '删除失败';
            $data['wait'] = 3;
            $data['url'] = site_url('admin/apps/index');
            $this->load->view('message.php', $data);
        }
    }

    public function update()
    {

        $apps_id = $this->input->post('apps_id');
        $data['apps_name'] = $this->input->post('apps_name');
        $data['apps_brief'] = $this->input->post('apps_brief');
        $data['apps_desc'] = $this->input->post('apps_desc');
        $data['add_time'] = date("Y-m-d H:i:s");

        if ($apps_id = $this->apps_model->update_apps($data, $apps_id)) {

            $data['message'] = '更新成功';
            $data['url'] = site_url('admin/apps/edit') . '/' . $apps_id;
            $data['wait'] = 3;
            $this->load->view('message.php', $data);


        } else {
            # 失败
            $data['message'] = '更新失败';
            $data['url'] = site_url('admin/apps/edit') . '/' . $apps_id;
            $data['wait'] = 3;
            $this->load->view('message.php', $data);
        }

    }

    public function update_img()
    {

        $apps_id = $this->input->post('apps_id');

        $config['upload_path'] = './public/uploads/';
        $config['allowed_types'] = 'jpg|gif|png|rar|7z|zip';
        $config['max_size'] = 500000;
        $this->load->library('upload', $config);

        if ($this->upload->do_upload('apps_img')) {
            $res = $this->upload->data(); //获取上传文件的信息
            $data['apps_img'] = $res['file_name'];

            if ($apps_id = $this->apps_model->update_apps($data, $apps_id)) {
                $data['message'] = '更改图片成功';
                $data['url'] = $data['url'] = site_url('admin/apps/edit') . '/' . $apps_id;
                $data['wait'] = 3;
                $this->load->view('message.php', $data);
            } else {
                # 失败
                $data['message'] = '更改图片失败';
                $data['url'] = site_url('admin/apps/edit') . '/' . $apps_id;
                $data['wait'] = 3;
                $this->load->view('message.php', $data);
            }

        } else {
            # 上传失败
            $data['message'] = $this->upload->display_errors();
            $data['url'] = site_url('admin/apps/edit') . '/' . $apps_id;
            $data['wait'] = 3;
            $this->load->view('message.php', $data);
        }
    }

    public function update_file()
    {

        $apps_id = $this->input->post('apps_id');

        $config['upload_path'] = './public/uploads/';
        $config['allowed_types'] = 'jpg|gif|png|rar|7z|zip';
        $config['max_size'] = 500000;
        $this->load->library('upload', $config);

        if ($this->upload->do_upload('apps_file')) {
            $res = $this->upload->data(); //获取上传文件的信息
            $data['apps_file'] = $res['file_name'];

            if ($apps_id = $this->apps_model->update_apps($data, $apps_id)) {
                $data['message'] = '更改文件成功';
                $data['url'] = $data['url'] = site_url('admin/apps/edit') . '/' . $apps_id;
                $data['wait'] = 3;
                $this->load->view('message.php', $data);
            } else {
                # 失败
                $data['message'] = '更改文件失败';
                $data['url'] = site_url('admin/apps/edit') . '/' . $apps_id;
                $data['wait'] = 3;
                $this->load->view('message.php', $data);
            }

        } else {
            # 上传失败
            $data['message'] = $this->upload->display_errors();
            $data['url'] = site_url('admin/apps/edit') . '/' . $apps_id;
            $data['wait'] = 3;
            $this->load->view('message.php', $data);
        }
    }

}