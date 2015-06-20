<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


//用户信息控制器
class Userinfo extends Home_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('userinfo_model');
        $this->load->library('pagination');
    }

    public function setInfo()
    {
        $userinfo_id = $this->input->post('userinfo_id');

        #通过获取userinfo信息判断当前用户是否设置过配送信息 若未设置 则进行条目添加操作 若已设置 则进行条目更新操作
        if (!($this->userinfo_model->get_userinfo($userinfo_id))) {

            $this->form_validation->set_rules('user_realname', '用户真实姓名', 'required');
            $this->form_validation->set_rules('user_street', '所在街区', 'required');
            $this->form_validation->set_rules('user_mobile', '联系电话', 'required|numeric');
            $this->form_validation->set_rules('user_zipcode', '邮编', 'required');

            if ($this->form_validation->run() == false) {
                #未通过表单验证
                $data['message'] = validation_errors();
                $data['url'] = site_url('user/showCenter');
                $data['wait'] = 3;
                $this->load->view('message.php', $data);
            } else {
                #通过表单验证 进行注册

                #获取提交的数据

                $data['userinfo_id'] = $this->input->post('userinfo_id');
                $data['user_realname'] = $this->input->post('user_realname');
                $data['user_province'] = $this->input->post('location_p');
                $data['user_city'] = $this->input->post('location_c');
                $data['user_district'] = $this->input->post('location_a');
                $data['user_street'] = $this->input->post('user_street');
                $data['user_mobile'] = $this->input->post('user_mobile');
                $data['user_zipcode'] = $this->input->post('user_zipcode');

                if ($userinfo_id = $this->userinfo_model->add_userinfo($data)) {
                    $data['message'] = '设置用户信息成功';
                    $data['url'] = site_url('user/showCenter');
                    $data['wait'] = 3;
                    $this->load->view('message.php', $data);
                } else {
                    # 失败
                    $data['message'] = '设置用户信息失败';
                    $data['url'] = site_url('user/showCenter');
                    $data['wait'] = 3;
                    $this->load->view('message.php', $data);
                }
            }

        } else {

            $this->form_validation->set_rules('user_realname', '用户真实姓名', 'required');
            $this->form_validation->set_rules('user_street', '所在街区', 'required');
            $this->form_validation->set_rules('user_mobile', '联系电话', 'required|numeric');
            $this->form_validation->set_rules('user_zipcode', '邮编', 'required');
            if ($this->form_validation->run() == false) {
                #未通过表单验证
                $data['message'] = validation_errors();
                $data['url'] = site_url('user/showCenter');
                $data['wait'] = 3;
                $this->load->view('message.php', $data);
            } else {
                #通过表单验证 进行更新

                #获取提交的数据

                $data['user_realname'] = $this->input->post('user_realname');
                $data['user_province'] = $this->input->post('location_p');
                $data['user_city'] = $this->input->post('location_c');
                $data['user_district'] = $this->input->post('location_a');
                $data['user_street'] = $this->input->post('user_street');
                $data['user_mobile'] = $this->input->post('user_mobile');
                $data['user_zipcode'] = $this->input->post('user_zipcode');

                if ($userinfo_id = $this->userinfo_model->update_userinfo($data, $userinfo_id)) {
                    $data['message'] = '更新用户信息成功';
                    $data['url'] = site_url('user/showCenter');
                    $data['wait'] = 3;
                    $this->load->view('message.php', $data);
                } else {
                    # 失败
                    $data['message'] = '更新用户信息失败';
                    $data['url'] = site_url('user/showCenter');
                    $data['wait'] = 3;
                    $this->load->view('message.php', $data);
                }
            }
        }
    }
}