<?php

class My_Controller extends CI_Controller {
    protected $template;

    public function __construct()
    {
        parent::__construct();

        // ログイン有無チェック
        if ($this->session->userdata('w_login') == TRUE) {
        	$this->smarty->assign('login_chk', $this->session->userdata('w_login'));
        	//$this->smarty->assign('login_mem', $this->session->userdata('login_mem'));
        } else {
        	$this->smarty->assign('login_chk', FALSE);
        	//$this->smarty->assign('login_mem', '');
        }

        // Smarty 設定
        $this->smarty->template_dir = APPPATH . 'views/contents';
        $this->smarty->compile_dir  = APPPATH . 'views/templates_c';
        $this->template = 'layout.tpl';

    }

    public function view($template)
    {
        $this->template = $template;
    }

    public function _output($output)
    {
        if (strlen($output) > 0) {
            echo $output;
        } else {
            $this->smarty->display($this->template);
        }
    }
}