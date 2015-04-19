<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
$config = array(
                 'signup' => array(
                                    array(
                                            'field' => 'user_id',
                                            'label' => '手机号码',
                                            'rules' => 'callback_user_id_check|numeric|trim|required|min_length[10]|max_length[12]|xss_clean|is_unique[users.user_id]'
                                         ),
                                    array(
                                            'field' => 'passwd',
                                            'label' => '密码',
                                            'rules' => 'trim|required|matches[passconf]'
                                         ),
                                    array(
                                            'field' => 'passconf',
                                            'label' => '密码确认',
                                            'rules' => 'trim|required'
                                         ),
                                    array(
                                            'field' => 'address',
                                            'label' => '地址',
                                            'rules' => 'trim|required'
                                         )
                                    )
                 
               );