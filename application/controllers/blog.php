<?php

class Blog extends CI_Controller {

    function __construct() {
        parent::__construct();
    }

    public function index() {
        echo "hello world";
        //  $this->load->view('blogview');
        $this->load->helper('url');
        $data['title'] = "My Real Title";
        $data['heading'] = "My Real Heading";
        $data['todo_list'] = array('Clean House', 'Call Mom', 'Run Errands');
        $this->load->view('templates/header', $data);

        $this->load->view('templates/footer');
    }

    public function comments() {
        echo 'Look at this! </br>';
    }

}
