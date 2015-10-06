<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Shop extends MY_Controller
//class Shop extends CI_Controller
{
    private $_user;

    public function __construct()
    {
        parent::__construct();
        $this->_user = 'ゲストさん';
    }

    public function greet($surname=NULL, $firstname=NULL)
    {
        if ( is_null($surname) ) {
           echo 'Hello, ' . $this->_user . '.';
        } else {
           echo 'Hello, ' . $surname;
            if ( ! is_null($firstname) ) {
                echo ' ' . $firstname;
            }
        }

        // Model のチェック
		$this->load->model('User');
	    if ($name = $this->User->getNameJa('taro')) {
	        echo '<br><br>名前= ' . $name;
	    }


		$member = array(
		    'firstname' => '山田',
		    'surname' => '太郎',
		    'age' => 29,
		);
		//$member['firstname'] = '山田';

		$test_smarty = "Smarty 3.1.27";



		$this->smarty->assign('data', $member);
		//$this->smarty->assign($member);
		//$smarty->assign('data', $member);
		//$this->smarty->display('contents/member_info.tpl');


		$this->view('member_info.tpl');
		//$this->view('member_info.tpl', $member);
		//$this->_output($member_info);
		//$this->view('member_info.tpl');
		//$this->load->view('contents/member_info.tpl', $member_info);
		//$this->load->view('contents/member_info.tpl', $member_info, '$test_smarty');
		//$this->load->view('contents/member_info', $member_info);


    }
}
