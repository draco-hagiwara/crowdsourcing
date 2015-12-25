<?php

class Cl_member extends MY_Controller
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

    // 案件一覧TOP
    public function index()
    {

        // セッションデータをクリア
        $this->load->model('comm_auth', 'comm_auth', TRUE);
        $this->comm_auth->delete_session('client');

        // セッションからフラッシュデータ読み込み
        $flash_data['c_memID'] = $this->session->userdata('c_memID');

        // バリデーション・チェック
        $this->_set_validation01();                                            // バリデーション設定
        $this->form_validation->run();

        // 検索項目 初期値セット
        $this->_form_item_set($flash_data['c_memID']);
        $this->smarty->assign('err_email',  FALSE);

        // クライアント・メンバー情報を取得
        $this->load->model('Client', 'cl', TRUE);
        $get_list = $this->cl->get_client_memlist($flash_data['c_memID']);
        $this->smarty->assign('listall', $get_list);

        $input_post = $this->input->post();
        $this->smarty->assign('client_info', $input_post);

        $this->view('client/cl_member/index.tpl');

    }

    // 詳細表示
    public function detail()
    {

        // セッションからフラッシュデータ読み込み
        $flash_data['c_memID'] = $this->session->userdata('c_memID');

        $this->load->model('Client', 'cl', TRUE);

        // バリデーション・チェック
        $this->_set_validation01();                                            // バリデーション設定

        // 検索項目 初期値セット
        $this->_form_item_set($flash_data['c_memID']);
        $this->smarty->assign('err_email',  FALSE);

        $input_post = $this->input->post();

        // 処理の振り分け
        if (isset($input_post['memid_chg']))
        {

            // 更新処理
            // クライアント・メンバー個別情報を取得
            $get_deta = $this->cl->get_client_member($input_post['memid_chg'], $flash_data['c_memID']);
            $this->smarty->assign('client_info', $get_deta[0]);

        } elseif (isset($input_post['memid_del'])) {

            // 削除(フラグ)処理
            // DB::tb_client_mem 更新
            $set_data['cm_mem_id']  = $input_post['memid_del'];
            $set_data['cm_cl_id']   = $flash_data['c_memID'];
            $set_data['cm_del_flg'] = TRUE;

            $this->cl->update_client_mem($set_data);

            redirect('/cl_member/');

        }

        // クライアント・メンバー情報を取得
        $get_list = $this->cl->get_client_memlist($flash_data['c_memID']);
        $this->smarty->assign('listall', $get_list);

        $this->view('client/cl_member/index.tpl');

    }

    // 更新＆新規作成処理
    public function up_date()
    {

        // セッションからフラッシュデータ読み込み
        $flash_data['c_memID']  = $this->session->userdata('c_memID');

        $this->load->model('Client', 'cl', TRUE);

        // 検索項目 初期値セット
        $this->_form_item_set($flash_data['c_memID']);
        $this->smarty->assign('err_email',  FALSE);

        $input_post = $this->input->post();

        // バリデーション・チェック
        if ($input_post['submit'] == '_chg')
        {
            $this->_set_validation01();
        } elseif ($input_post['submit'] == '_new') {
            $this->_set_validation02();
        }

        if ($this->form_validation->run() == TRUE)
        {

            if ($input_post['submit'] == '_chg')
            {
                // 更新

                // ログインIDの重複チェック
                $get_deta = $this->cl->get_client_member($input_post['cm_mem_id'], $flash_data['c_memID']);
                if ($get_deta[0]['cm_login'] != $input_post['cm_login'])
                {
                    if ($this->cl->check_LoginID($input_post['cm_login']) == TRUE)
                    {
                        $this->smarty->assign('err_email', TRUE);
                    }

                } else {

                    // DB::tb_client_mem 更新
                    $set_data              = $input_post;
                    $set_data['cm_cl_id']  = $flash_data['c_memID'];

                    // パスワード作成
                    if ($input_post['cm_password'] == '')
                    {
                        unset($set_data['cm_password']);
                    } else {
                        $set_data["cm_password"] = password_hash($input_post["cm_password"], PASSWORD_DEFAULT);
                    }

                    unset($set_data['cl_person01']);
                    unset($set_data['cl_person02']);
                    unset($set_data['cl_department']);
                    unset($set_data['retype_password']);
                    unset($set_data['submit']);

                    $this->cl->update_client_mem($set_data);
                }

            } elseif ($input_post['submit'] == '_new') {
                // 新規作成

                // ログインIDの重複チェック
                if ($this->cl->check_LoginID($input_post['cm_login']) == TRUE)
                {
                    $this->smarty->assign('err_email', TRUE);
                } else {

                    $set_data              = $input_post;
                    $set_data['cm_cl_id']  = $flash_data['c_memID'];

                    // パスワード作成
                    $set_data["cm_password"] = password_hash($input_post["cm_password"], PASSWORD_DEFAULT);

                    unset($set_data['cm_mem_id']);
                    unset($set_data['cl_person01']);
                    unset($set_data['cl_person02']);
                    unset($set_data['cl_department']);
                    unset($set_data['retype_password']);
                    unset($set_data['submit']);

                    $this->cl->insert_client_member($set_data);

                }
            }
        }

        // クライアント・メンバー情報を取得
        $get_list = $this->cl->get_client_memlist($flash_data['c_memID']);
        $this->smarty->assign('listall', $get_list);

        $this->smarty->assign('client_info', $input_post);

        $this->view('client/cl_member/index.tpl');

    }


    // 各項目 初期値セット
    private function _form_item_set($cl_id)
    {

        // ステータス状態 選択項目セット
        $this->config->load('config_status');
        if ($cl_id == '1')
        {
            $arroptions_memauth = $this->config->item('A_MEMBER_AUTH');
            $arroptions_memst   = $this->config->item('A_MEMBER_ST');
        } else {
            $arroptions_memauth = $this->config->item('C_MEMBER_AUTH');
            $arroptions_memst   = $this->config->item('C_MEMBER_ST');
        }

        $this->smarty->assign('options_cm_authority', $arroptions_memauth);
        $this->smarty->assign('options_cm_status',    $arroptions_memst);

    }

    // フォーム・バリデーションチェック::更新時
    private function _set_validation01()
    {

        $rule_set = array(
                array(
                        'field'   => 'cm_person01',
                        'label'   => '担当者姓',
                        'rules'   => 'trim|required|max_length[50]'
                ),
                array(
                        'field'   => 'cm_person02',
                        'label'   => '担当者名',
                        'rules'   => 'trim|required|max_length[50]'
                ),
                array(
                        'field'   => 'cm_department',
                        'label'   => '担当部署',
                        'rules'   => 'trim|max_length[50]'
                ),
                array(
                        'field'   => 'cm_login',
                        'label'   => 'メールアドレス（代表）＆　ログインID',
                        'rules'   => 'trim|required|valid_email'
                ),
                array(
                        'field'   => 'cm_password',
                        'label'   => 'パスワード',
                        'rules'   => 'trim|regex_match[/^[\x21-\x7e]+$/]|min_length[8]|max_length[50]|matches[retype_password]'
                ),
                array(
                        'field'   => 'retype_password',
                        'label'   => 'パスワード再入力',
                        'rules'   => 'trim|regex_match[/^[\x21-\x7e]+$/]|min_length[8]|max_length[50]|matches[cm_password]'
                ),
                array(
                        'field'   => 'cm_authority',
                        'label'   => '権限設定',
                        'rules'   => 'trim|required|max_length[2]|is_numeric'
                ),
                array(
                        'field'   => 'cm_status',
                        'label'   => '稼働有無',
                        'rules'   => 'trim|required|max_length[1]|is_numeric'
                ),
        );

        $this->load->library('form_validation', $rule_set);                            // バリデーションクラス読み込み

    }

    // フォーム・バリデーションチェック::新規作成時
    private function _set_validation02()
    {

        $rule_set = array(
                array(
                        'field'   => 'cm_person01',
                        'label'   => '担当者姓',
                        'rules'   => 'trim|required|max_length[50]'
                ),
                array(
                        'field'   => 'cm_person02',
                        'label'   => '担当者名',
                        'rules'   => 'trim|required|max_length[50]'
                ),
                array(
                        'field'   => 'cm_department',
                        'label'   => '担当部署',
                        'rules'   => 'trim|max_length[50]'
                ),
                array(
                        'field'   => 'cm_login',
                        'label'   => 'メールアドレス（代表）＆　ログインID',
                        'rules'   => 'trim|required|valid_email'
                ),
                array(
                        'field'   => 'cm_password',
                        'label'   => 'パスワード',
                        'rules'   => 'trim|required|regex_match[/^[\x21-\x7e]+$/]|min_length[8]|max_length[50]|matches[retype_password]'
                ),
                array(
                        'field'   => 'retype_password',
                        'label'   => 'パスワード再入力',
                        'rules'   => 'trim|required|regex_match[/^[\x21-\x7e]+$/]|min_length[8]|max_length[50]|matches[cm_password]'
                ),
                array(
                        'field'   => 'cm_authority',
                        'label'   => '権限設定',
                        'rules'   => 'trim|required|max_length[2]|is_numeric'
                ),
                array(
                        'field'   => 'cm_status',
                        'label'   => '稼働有無',
                        'rules'   => 'trim|required|max_length[1]|is_numeric'
                ),
        );

        $this->load->library('form_validation', $rule_set);                            // バリデーションクラス読み込み

    }

}
