<?php

class Form extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('news_model');
        $this->load->model('register_model');
        $this->load->helper(array('form', 'url', 'html', 'security'));
        $this->load->library('form_validation');
        $this->load->library('image_lib');
        $this->load->library('encrypt'); //加密函数和session
        $this->load->library('session');
        $this->load->library('cart');
    }

    function register() {
        if ($this->form_validation->run('signup') == FALSE) { //通不过验证就提示重新注册
            $this->load->view('myform');
        } else { //插入到数据库中
            $post_data = array(//获取数据
                'user_id' => $this->input->post('user_id'),
                'passwd' => $this->input->post('passwd'),
                'address' => $this->input->post('address')
            );
            $post_data['passwd'] = do_hash($this->input->post('passwd'), 'md5'); //默认是SHA1,我选择了MD5 
            // 数据库中的注册和登录验证的要以相同的方式获取，否者hash出来的东西不一样，比如用：$this->input->post('passwd')
            $this->db->insert('users', $post_data);


            $this->load->view('home'); //默认返回主页
        }
    }

    public function user_id_check($tel) { //检查是否是真正的手机号码
        $iphone = preg_match("/^13[0-9]{1}[0-9]{8}$|15[0189]{1}[0-9]{8}$|189[0-9]{8}$/", $tel);
        if (!$iphone) {
            $this->form_validation->set_message('user_id_check', '你的 %s  不对');
            return FALSE;
        } else {
            return TRUE;
        }
    }

    function login() {
        $this->form_validation->set_rules('user_id', 'user_id', 'trim|required|min_length[10]|max_length[12]|xss_clean');
        $this->form_validation->set_rules('passwd', 'passwd', 'trim|required');

        $iphone = $this->input->post('user_id');
        $pwd = $this->input->post('passwd');

        $pwd = do_hash($pwd, 'md5');


        $query = $this->db->get_where('users', array('user_id' => $iphone, 'passwd' => $pwd));
        //相当于 select * from users where user_id = $iphone and passwd= $pwd ;
        /* 对session的测试
          $arr_session = $this->session->all_userdata();
          foreach ($arr_session as $key => $value) {
          echo $key . "=>" . $value;
          echo br();
          }
         */
        if ($this->form_validation->run() == FALSE || $query->num_rows() < 1) {
            $this->load->view('pages/login');
        } else {
            $newdata = array(
                'username' => $iphone, //添加用户名到session中
                'logged_in' => TRUE   //标记为已经登录了
            );
            $this->session->set_userdata($newdata);

            $this->load->view('/log/include_logout'); //转到具有logout的主页
        }
    }

    function logout() {
        $this->cart->destroy(); //销毁购物车
        $this->session->sess_destroy(); //销毁session
        $this->load->view('home'); //返回主页
    }

    function login_verify() {
        echo 'success!';
    }

    function myself() {

        $this->load->view('/log/myself');
        echo '你是：' . $this->session->userdata('username');
        echo br();
    }

    function home() {
        $this->load->view('home');
        /* 测试session 
          $arr_session = $this->session->all_userdata();
          foreach ($arr_session as $key => $value) {
          echo $key . "=>" . $value;
          echo br();
          }
         */
    }

    function include_logout_home() {
        $this->load->view('/log/include_logout');
        
    }

    function about() {
        $this->load->view('pages/about');
    }

    function contact() {
        $this->load->view('contact');
    }

    function  add_cart(){
          $post_data = array(//获取数据
                'id' => $this->input->post('item_id'),
                'name' => $this->input->post('item_name'),
                'price' => $this->input->post('price'),
                'qty' => $this->input->post('qty')
            );
            $this->cart->insert($post_data);
        echo $this->cart->total_items();
        echo br();
        echo $this->cart->total();
        echo br();

        $this->load->view('view_cart');
    }
   function cart_buy() {
        
        $data = array(
            array(
                'id' => '100',
                'qty' => 1,
                'price' => 39.95,
                'name' => 'bread'
            ),
            array(
                'id' => '101',
                'qty' => 1,
                'price' => 29.95,
                'name' => 'milk'
            )
        );
        $this->cart->insert($data);
        echo $this->cart->total_items();
        echo br();
        echo $this->cart->total();
        echo br();

        $this->load->view('view_cart');
    }

}
