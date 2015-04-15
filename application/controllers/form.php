<?php

class Form extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('news_model');
        $this->load->model('register_model');
        $this->load->helper(array('form', 'url'));
        $this->load->helper('security');
    }

    function index() {


        $this->load->library('form_validation');

        $this->form_validation->set_rules('user_id', 'user_id', 'trim|required|min_length[5]|max_length[12]|xss_clean');
        $this->form_validation->set_rules('passwd', 'passwd', 'trim|required|matches[passconf]|md5');
        $this->form_validation->set_rules('passconf', 'Password Confirmation', 'trim|required');
        $this->form_validation->set_rules('address', 'address', 'trim|required|valid_email');

        $this->load->library('form_validation');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('myform');
        } else {
            $this->load->view('formsuccess');
        }
    }

    function insert_register() {
        $post_data = array(//获取数据
            'user_id' => $this->input->post('user_id'),
            'passwd' => $this->input->post('passwd'),
            'address' => $this->input->post('address')
        );
        $post_data['passwd'] = do_hash($post_data['passwd']); //默认是SHA1
        $this->db->insert('users', $post_data);
        echo 'Insert success!';
    }

}
