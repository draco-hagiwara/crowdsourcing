<?php

class Top extends MY_Controller
{

	public function __construct()
	{
		parent::__construct();

		if (($this->session->userdata('login_mem') == 'admin') && ($this->session->userdata('login_chk') == TRUE))
		{
			$this->smarty->assign('login_chk', TRUE);
<<<<<<< HEAD
<<<<<<< HEAD
        	$this->smarty->assign('login_mem', 'admin');
			$this->smarty->assign('login_name', $this->session->userdata('memberNAME'));
		} else {
        	$this->smarty->assign('login_chk', FALSE);
        	$this->smarty->assign('login_mem', 'admin');

        	$this->load->helper('url');
=======
		} else {
        	$this->smarty->assign('login_chk', FALSE);
        	$this->smarty->assign('login_mem', 'admin');
			$this->load->helper('url');
>>>>>>> 778364b11983b8ecd0f1ae7ce60860e34a1a71c4
=======
        	$this->smarty->assign('login_mem', 'admin');
			$this->smarty->assign('login_name', $this->session->userdata('memberNAME'));
		} else {
        	$this->smarty->assign('login_chk', FALSE);
        	$this->smarty->assign('login_mem', 'admin');

        	$this->load->helper('url');
>>>>>>> develop
			redirect('/login/');
		}

	}

	// ログイン 初期表示
	public function index()
	{

		$this->view('admin/top/index.tpl');

	}

}
