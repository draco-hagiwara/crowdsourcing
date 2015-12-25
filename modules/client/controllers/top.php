<?php

class Top extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();

        if ($this->session->userdata('c_login') == TRUE)
        {
            $this->smarty->assign('login_chk', TRUE);
            //$this->smarty->assign('login_mem', 'client');
            $this->smarty->assign('login_name', $this->session->userdata('c_memNAME'));
            $this->smarty->assign('auth_cd',    $this->session->userdata('c_authCD'));
        } else {
            $this->smarty->assign('login_chk', FALSE);
            //$this->smarty->assign('login_mem', 'client');

            //$this->load->helper('url');
            redirect('/login/');
        }

    }

    // ログイン 初期表示
    public function index()
    {

        // セッションデータをクリア
        $this->load->model('comm_auth', 'comm_auth', TRUE);
        $this->comm_auth->delete_session('client');

        $this->view('client/top/index.tpl');

    }

}
