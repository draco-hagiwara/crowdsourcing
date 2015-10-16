<?php

class Top extends MY_Controller
{

	public function __construct()
	{
		parent::__construct();

		if (($this->session->userdata('login_mem') == 'client') && ($this->session->userdata('login_chk') == TRUE))
		{
			$this->smarty->assign('login_chk', TRUE);
		} else {
        	$this->smarty->assign('login_chk', FALSE);
        	$this->smarty->assign('login_mem', 'client');
			$this->load->helper('url');
			redirect('/login/');
		}

	}

	// ログイン 初期表示
	public function index()
	{

		$this->view('client/top/index.tpl');

	}

}
