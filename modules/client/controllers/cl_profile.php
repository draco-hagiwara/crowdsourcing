<?php

class Cl_profile extends MY_Controller
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

    // クライアントプロフィール表示TOP
    public function index()
    {

        // セッションデータをクリア
        $this->load->model('comm_auth', 'comm_auth', TRUE);
        $this->comm_auth->delete_session('client');

        // セッションからフラッシュデータ読み込み
        $tmp_clientid = $this->session->userdata('c_memID');

        // クライアントのデータ取得
        $this->load->model('Client', 'cl', TRUE);
        $get_data = $this->cl->get_client_info($tmp_clientid);

        // 都道府県情報設定
        $this->config->load('config_pref');
        $this->_options_pref = $this->config->item('pref');
        $this->smarty->assign('options_pref', $this->_options_pref);

        $this->smarty->assign('client_info', $get_data[0]);

        // バリデーション設定
        $this->_set_validation();

        $this->view('client/cl_profile/index.tpl');

    }

    // データ更新
    public function complete()
    {

        // セッションからフラッシュデータ読み込み
        $tmp_clientid = $this->session->userdata('c_memID');

        // 更新対象クライアントメンバーのデータ取得
        $input_post = $this->input->post();
        $this->load->model('Client', 'cl', TRUE);

        $this->_set_validation();                                            // バリデーション設定
        if ($this->form_validation->run() == FALSE)
        {
            $this->smarty->assign('client_info', $this->input->post());
        } else {
            // DB書き込み
            $set_data          = $input_post;
            $set_data['cl_id'] = $tmp_clientid;

            unset($set_data['submit']);

            $this->cl->update_Client($set_data);
        }

        // クライアントのデータ取得
        $get_data = $this->cl->get_client_info($tmp_clientid);

        // 都道府県情報設定
        $this->config->load('config_pref');
        $this->_options_pref = $this->config->item('pref');
        $this->smarty->assign('options_pref', $this->_options_pref);

        $this->smarty->assign('client_info', $get_data[0]);

        // バリデーション設定
        $this->_set_validation();

        $this->view('client/cl_profile/index.tpl');

    }

    // フォーム・バリデーションチェック :: クライアント更新フォーム
    private function _set_validation()
    {

        $rule_set = array(
                //array(
                //        'field'   => 'cl_company',
                //        'label'   => '会社名',
                //        'rules'   => 'trim|required|max_length[100]'
                //),
                //array(
                //        'field'   => 'cl_company_kana',
                //        'label'   => '会社名カナ（全角）',
                //        'rules'   => 'trim|regex_match[/^[ァ-タダ-ヴ　ー・]+$/]|required|max_length[100]'
                //),
                array(
                        'field'   => 'cl_president01',
                        'label'   => '代表者姓',
                        'rules'   => 'trim|required|max_length[50]'
                ),
                array(
                        'field'   => 'cl_president02',
                        'label'   => '代表者名',
                        'rules'   => 'trim|required|max_length[50]'
                ),
                array(
                        'field'   => 'cl_president_kana01',
                        'label'   => '代表者セイ（全角）',
                        'rules'   => 'trim|required|max_length[50]'
                ),
                array(
                        'field'   => 'cl_president_kana02',
                        'label'   => '代表者メイ（全角）',
                        'rules'   => 'trim|required|max_length[50]'
                ),
                array(
                        'field'   => 'cl_department',
                        'label'   => '担当部署',
                        'rules'   => 'trim|max_length[50]'
                ),
                array(
                        'field'   => 'cl_person01',
                        'label'   => '担当者姓',
                        'rules'   => 'trim|required|max_length[50]'
                ),
                array(
                        'field'   => 'cl_person02',
                        'label'   => '担当者名',
                        'rules'   => 'trim|required|max_length[50]'
                ),
                array(
                        'field'   => 'cl_person_kana01',
                        'label'   => '担当者セイ（全角）',
                        'rules'   => 'trim|required|max_length[50]'
                ),
                array(
                        'field'   => 'cl_person_kana02',
                        'label'   => '担当者メイ（全角）',
                        'rules'   => 'trim|required|max_length[50]'
                ),
                array(
                        'field'   => 'cl_zip01',
                        'label'   => '郵便番号（3ケタ）',
                        'rules'   => 'trim|required|max_length[3]|is_numeric'
                ),
                array(
                        'field'   => 'cl_zip02',
                        'label'   => '郵便番号（4ケタ）',
                        'rules'   => 'trim|required|max_length[4]|is_numeric'
                ),
                array(
                        'field'   => 'cl_pref',
                        'label'   => '都道府県',
                        'rules'   => 'trim|required|max_length[2]'
                ),
                array(
                        'field'   => 'cl_addr01',
                        'label'   => '市区町村',
                        'rules'   => 'trim|required|max_length[100]'
                ),
                array(
                        'field'   => 'cl_addr02',
                        'label'   => '町名・番地',
                        'rules'   => 'trim|required|max_length[100]'
                ),
                array(
                        'field'   => 'cl_buil',
                        'label'   => 'ビル・マンション名など',
                        'rules'   => 'trim|max_length[100]'
                ),
                array(
                        'field'   => 'cl_email',
                        'label'   => 'メールアドレス（代表）',
                        'rules'   => 'trim|required|valid_email'
                ),
                array(
                        'field'   => 'cl_email2',
                        'label'   => 'メールアドレス（予備）',
                        'rules'   => 'trim|valid_email'
                ),
                array(
                        'field'   => 'cl_tel01',
                        'label'   => '代表電話番号',
                        'rules'   => 'trim|required|regex_match[/^[0-9\-]+$/]|max_length[15]'
                ),
                array(
                        'field'   => 'cl_tel02',
                        'label'   => '担当者電話番号',
                        'rules'   => 'trim|regex_match[/^[0-9\-]+$/]|max_length[15]'
                ),
                array(
                        'field'   => 'cl_mobile',
                        'label'   => '担当者携帯番号',
                        'rules'   => 'trim|regex_match[/^[0-9\-]+$/]|max_length[15]'
                ),
                array(
                        'field'   => 'cl_fax',
                        'label'   => 'ＦＡＸ番号',
                        'rules'   => 'trim|regex_match[/^[0-9\-]+$/]|max_length[15]'
                ),
                array(
                        'field'   => 'cl_hp',
                        'label'   => '会社ＨＰ(http://～)',
                        'rules'   => 'trim|regex_match[/^(https?)(:\/\/[-_.!~*\'()a-zA-Z0-9;\/?:\@&=+\$,%#]+)$/]|max_length[100]'
                ),
                //array(
                //        'field'   => 'cl_password',
                //        'label'   => 'パスワード',
                //        'rules'   => 'trim|regex_match[/^[\x21-\x7e]+$/]|min_length[8]|max_length[50]|matches[retype_password]'
                //),
                //array(
                //        'field'   => 'retype_password',
                //        'label'   => 'パスワード再入力',
                //        'rules'   => 'trim|regex_match[/^[\x21-\x7e]+$/]|min_length[8]|max_length[50]|matches[cl_password]'
                //)
        );

        $this->load->library('form_validation', $rule_set);                            // バリデーションクラス読み込み

    }

}
