<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
$config = array(
                 'signup' => array(
                                    array(
                                            'field' => 'user_id',
                                            'label' => 'phone',
                                            'rules' => 'callback_user_id_check|numeric|trim|required|min_length[10]|max_length[12]|xss_clean|is_unique[users.user_id]'
                                         ),
                                    array(
                                            'field' => 'passwd',
                                            'label' => 'Password',
                                            'rules' => 'trim|required|matches[passconf]|md5'
                                         ),
                                    array(
                                            'field' => 'passconf',
                                            'label' => 'PasswordConfirmation',
                                            'rules' => 'trim|required'
                                         ),
                                    array(
                                            'field' => 'address',
                                            'label' => 'address',
                                            'rules' => 'trim|required'
                                         )
                                    )
                 
               );