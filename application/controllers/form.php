<?php

class Form extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('news_model');
        $this->load->model('register_model');
        $this->load->helper(array('form', 'url', 'html', 'security'));
        $this->load->library('form_validation');
        $this->load->library('image_lib');
    }

    function register() {

        if ($this->form_validation->run('signup') == FALSE) { //通不过验证就提示重新注册
            $this->load->view('myform');
        } else {
            $post_data = array(//获取数据
                'user_id' => $this->input->post('user_id'),
                'passwd' => $this->input->post('passwd'),
                'address' => $this->input->post('address')
            );
            $post_data['passwd'] = do_hash($post_data['passwd']); //默认是SHA1
            $this->db->insert('users', $post_data);

            $this->load->view('home'); //return home 
        }
    }

    public function user_id_check($tel) { //
        $iphone = preg_match("/^13[0-9]{1}[0-9]{8}$|15[0189]{1}[0-9]{8}$|189[0-9]{8}$/",$tel); 
        if (!$iphone) {
            $this->form_validation->set_message('user_id_check','你的 %s number 不对');
            return FALSE;
        } else {
            return TRUE;
        }
    }

    function login() {
        $this->form_validation->set_rules('user_id', 'user_id', 'trim|required|min_length[10]|max_length[12]|xss_clean');
        $this->form_validation->set_rules('passwd', 'passwd', 'trim|required|matches[passconf]|md5');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('pages/login');
        } else {
            $this->load->view('home');
        }
    }

    function login_verify() {
        echo 'success!';
    }

    function home() {
        $this->load->view('home');
    }

    function about() {
        $this->load->view('pages/about');
    }

    function contact() {
        $this->load->view('contact');
    }

}
