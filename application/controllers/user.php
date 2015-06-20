<?php


//用户控制器
class User extends Home_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('user_model');
        $this->load->model('userinfo_model');
        $this->load->model('order_model');
        $this->load->library('pagination');
    }

    #显示注册页面
    public function register()
    {
        $this->load->view('userCenter.php');
    }

    #显示用户页面
    public function showCenter()
    {
        $session_name = $this->session->userdata('user');
        if ($session_name != null) {
            $data['user'] = $this->user_model->get_user_byname($session_name);
            $userinfo_id = $data['user']['user_id'];
            $data['userinfo'] = $this->userinfo_model->get_userinfo($userinfo_id);

            $data['orders'] = $this->order_model->list_user_order($userinfo_id);
            $this->load->view('userInfo.php', $data);
        } else {
            $this->load->view('userCenter.php');
        }
    }

    #注册动作
    public function do_register()
    {
        #设置验证规则
        $this->form_validation->set_rules('username', '用户名', 'required');
        $this->form_validation->set_rules('password', '密码', 'required|min_length[6]|max_length[16]|md5');
        $this->form_validation->set_rules('repassword', '重复密码', 'required|matches[password]');
        $this->form_validation->set_rules('email', '电子邮箱', 'required|valid_email');

        if ($this->form_validation->run() == false) {
            # 未通过
            $data['message'] = validation_errors();
            $data['url'] = site_url('user/showCenter');
            $data['wait'] = 3;
            $this->load->view('message.php', $data);
        } else {
            # 通过,注册
            $data['user_name'] = $this->input->post('username', true);
            $data['password'] = $this->input->post('password', true);
            $data['email'] = $this->input->post('email', true);
            $data['reg_time'] = date("Y-m-d H:i:s");
            # 检查用户名是否重复
            if (!($this->user_model->get_user_byname($data['user_name']))) {
                if ($this->user_model->add_user($data)) {
                    # 注册成功
                    $this->session->set_userdata('user', $data['user_name']);
                    $data['message'] = '您已注册成功，非常感谢！请设置好配送信息后，再进行购物';
                    $data['url'] = site_url('user/showCenter');
                    $data['wait'] = 3;
                    $this->load->view('message.php', $data);
                } else {
                    # 注册失败
                    $data['message'] = '注册出错，请重试';
                    $data['url'] = site_url('user/showCenter');
                    $data['wait'] = 3;
                    $this->load->view('message.php', $data);
                }
            } else {
                # 用户名重复 注册失败
                $data['message'] = '该用户名已存在，请重试';
                $data['url'] = site_url('user/showCenter');
                $data['wait'] = 3;
                $this->load->view('message.php', $data);
            }
        }
    }


    #登录动作
    public function signin()
    {
        #验证 省略
        $username = $this->input->post('username');
        $password = $this->input->post('password');

        if ($user = $this->user_model->get_user($username, $password)) {
            #成功，将用户信息保存至session
            $this->session->set_userdata('user', $user['user_name']);
            redirect('user/showCenter');
        } else {
            # error
            $data['message'] = '用户或密码错误';
            $data['url'] = site_url('user/showCenter');
            $data['wait'] = 3;
            $this->load->view('message.php', $data);
        }

    }

    #登出动作
    public function logout()
    {
        $this->session->unset_userdata('user');
        redirect('user/showCenter');
    }

    #更新用户信息（密码）
    public function updatepass()
    {
        $this->form_validation->set_rules('password', '密码', 'required|min_length[6]|max_length[16]|md5');
        $this->form_validation->set_rules('repassword', '重复密码', 'required|matches[password]');

        if ($this->form_validation->run() == false) {
            # 未通过
            $data['message'] = validation_errors();
            $data['url'] = site_url('user/showCenter');
            $data['wait'] = 3;
            $this->load->view('message.php', $data);
        } else {
            # 通过,更新密码
            $user_id = $this->input->post('user_id', true);
            $data['password'] = $this->input->post('password', true);
            if ($this->user_model->update_user($data, $user_id)) {
                # 更新成功
                $data['message'] = '修改密码操作已经生效';
                $data['url'] = site_url('user/showCenter');
                $data['wait'] = 3;
                $this->load->view('message.php', $data);
            } else {
                # 更新失败
                $data['message'] = '修改密码出错，请重试';
                $data['url'] = site_url('user/showCenter');
                $data['wait'] = 3;
                $this->load->view('message.php', $data);
            }

        }
    }

    #更新用户信息（邮箱）
    public function updatemail()
    {
        $this->form_validation->set_rules('email', '电子邮箱', 'required|valid_email');

        if ($this->form_validation->run() == false) {
            # 未通过
            $data['message'] = validation_errors();
            $data['url'] = site_url('user/showCenter');
            $data['wait'] = 3;
            $this->load->view('message.php', $data);
        } else {
            # 通过,更新密码
            $user_id = $this->input->post('user_id', true);
            $data['email'] = $this->input->post('email', true);
            if ($this->user_model->update_user($data, $user_id)) {
                # 更新成功
                $data['message'] = '修改邮箱操作已经生效';
                $data['url'] = site_url('user/showCenter');
                $data['wait'] = 3;
                $this->load->view('message.php', $data);
            } else {
                # 更新失败
                $data['message'] = '修改邮箱出错，请重试';
                $data['url'] = site_url('user/showCenter');
                $data['wait'] = 3;
                $this->load->view('message.php', $data);
            }

        }
    }

}