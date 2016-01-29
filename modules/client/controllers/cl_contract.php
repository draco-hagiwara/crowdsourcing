<?php

class Cl_contract extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();

        if ($this->session->userdata('c_login') == TRUE)
        {
            $this->smarty->assign('login_chk', TRUE);
            $this->smarty->assign('login_name', $this->session->userdata('c_memNAME'));
            $this->smarty->assign('auth_cd',    $this->session->userdata('c_authCD'));
        } else {
            $this->smarty->assign('login_chk', FALSE);

            redirect('/login/');
        }
    }

    // 会員情報更新画面表示
    public function index()
    {

        // セッションデータをクリア
        $this->load->model('comm_auth', 'comm_auth', TRUE);
        $this->comm_auth->delete_session('client');

        // セッションからフラッシュデータ読み込み
        $tmp_clientid = $this->session->userdata('c_memID');

        // 初期値セット
        $this->_form_item_set();

        // バリデーション設定
        $this->_set_validation();

        // クライアントのデータ取得
        $this->load->model('Client', 'cl', TRUE);
        $get_data = $this->cl->get_client_contract($tmp_clientid);
        $this->smarty->assign('client_info', $get_data[0]);

        $this->view('client/cl_contract/index.tpl');

    }

    // 初期値セット
    private function _form_item_set()
    {

    	// 契約形態 項目セット
    	$this->config->load('config_comm');
        $arroptions_contract = $this->config->item('CLIENT_FEE');

    	$this->smarty->assign('options_contractid', $arroptions_contract);

    }

    // フォーム・バリデーションチェック
    private function _set_validation()
    {

        $rule_set = array(
        );

        $this->load->library('form_validation', $rule_set);                            // バリデーションクラス読み込み

    }

}
