<?php

class Entryclient extends MY_Controller
{

    private $_options_pref;
    private $_pref_name;

    public function __construct()
    {
        parent::__construct();

        $this->load->library('form_validation');                            // バリデーションクラス読み込み
        $this->config->load('config_pref');                                    // 都道府県情報読み込み

                // セッション書き込み
        if (!$this->session->userdata('ticket')) {
            $setData = array(
                    'ticket' => md5(uniqid(mt_rand(), true)),
                    'w_login' => FALSE,
                    //'login_mem' => '',
            );
            $this->session->set_userdata($setData);
        }

        // 都道府県情報設定
        $this->_options_pref = $this->config->item('pref');
        $this->smarty->assign('options_pref', $this->_options_pref);

        // 都道府県チェック
        if ($this->input->post('cl_pref')) {
            $pref_id = $this->input->post('cl_pref');
            $this->_pref_name = $this->_options_pref[$pref_id];
        }
    }

    // クライアント新規会員登録TOP
    public function index()
    {

        // セッションのチェック
        $this->ticket = $this->session->userdata('ticket');
        //if (!$this->input->post('ticket') || $this->input->post('ticket') !== $this->ticket) {
        if (!$this->ticket) {
            $message = 'セッション・エラーが発生しました。';
            show_error($message, 400);
        } else {
            $this->smarty->assign('ticket', $this->ticket);
        }

        $this->smarty->assign('err_email1', FALSE);
        $this->smarty->assign('err_passwd', FALSE);
        $this->view('entryclient/index.tpl');
    }

    // 確認画面表示
    public function confirm()
    {

        // セッションのチェック
        $this->ticket = $this->session->userdata('ticket');
        if (!$this->input->post('ticket') || $this->input->post('ticket') !== $this->ticket) {
            $message = 'セッション・エラーが発生しました。';
            show_error($message, 400);
        } else {
            $this->smarty->assign('ticket', $this->ticket);
        }

        // 都道府県チェック
        $this->smarty->assign('pref_name', $this->_pref_name);

        // バリデーション・チェック
        if ($this->form_validation->run() == FALSE) {
            $this->smarty->assign('err_email1', FALSE);
            $this->smarty->assign('err_passwd', FALSE);
            $this->view('entryclient/index.tpl');
        } else {

            // パスワード再入力チェック
            if ($this->input->post('cm_password') !== $this->input->post('retype_password')) {
                $this->smarty->assign('err_passwd', TRUE);
                $this->view('entryclient/index.tpl');
                return;
            }

            $this->view('entryclient/confirm.tpl');
        }
    }

    // 完了画面表示
    public function complete()
    {

        // セッションのチェック
        $this->ticket = $this->session->userdata('ticket');
        if (!$this->input->post('ticket') || $this->input->post('ticket') !== $this->ticket) {
            $message = 'セッション・エラーが発生しました。';
            show_error($message, 400);
        } else {
            $this->smarty->assign('ticket', $this->ticket);
        }

        // バリデーション・チェック
        $this->form_validation->run();

        // 「戻る」ボタン押下の場合
        if ( $this->input->post('_back') ) {
            $this->smarty->assign('err_email1', FALSE);
            $this->smarty->assign('err_passwd', FALSE);
            $this->view('entryclient/index.tpl');
            return;
        }

        // ログインID(メールアドレス)の重複チェック
        $this->load->model('Client', 'client', TRUE);

        if ($this->client->check_LoginID($this->input->post('cl_email'))) {
            $this->smarty->assign('err_email1', TRUE);
            $this->smarty->assign('err_passwd', FALSE);
            $this->view('entryclient/index.tpl');
            return;
        }

        // DB書き込み
        $this->setData = $this->input->post();

        // 不要パラメータ削除
        unset($this->setData["ticket"]) ;
        unset($this->setData["submit"]) ;
        unset($this->setData["retype_password"]) ;

        // トランザクション・START
        $this->db->trans_strict(FALSE);                                  // StrictモードをOFF
        $this->db->trans_start();                                        // trans_begin

            $this->client->insert_Client($this->setData);

        // トランザクション・COMMIT
        $this->db->trans_complete();                                    // trans_rollback & trans_commit
        if ($this->db->trans_status() === FALSE)
        {
            log_message('error', 'TOP::[complete()]クライアント会員登録処理 トランザクションエラー');
            $_res = 'トランザクションエラー';
        } else {
            $_res = '';
        }


        // メール送信先設定
        $mail['from']      = "";
        $mail['from_name'] = "";
        $mail['subject']   = "";
        $mail['to']        = "";
        $mail['cc']        = "";
        $mail['bcc']       = "";

        // メール本文置き換え文字設定
        $arrRepList = array(
                'cl_company'      => $this->input->post('cl_company'),
                'cl_company_kana' => $this->input->post('cl_company_kana'),
                'cl_zip01'        => $this->input->post('cl_zip01'),
                'cl_zip02'        => $this->input->post('cl_zip02'),
                'cl_pref'         => $this->_pref_name,
                'cl_addr01'       => $this->input->post('cl_addr01'),
                'cl_addr02'       => $this->input->post('cl_addr02'),
                'cl_buil'         => $this->input->post('cl_buil'),
                'cl_person01'     => $this->input->post('cl_person01'),
                'cl_person02'     => $this->input->post('cl_person02'),
                'cl_email'        => $this->input->post('cl_email'),
                'cl_email2'       => $this->input->post('cl_email2'),
                'cl_tel01'        => $this->input->post('cl_tel01'),
                'cl_tel02'        => $this->input->post('cl_tel02'),
                'cl_hp'           => $this->input->post('cl_hp'),
                'res'             => $_res
        );

        // メールテンプレートの読み込み
        $this->config->load('config_mailtpl');                                // メールテンプレート情報読み込み
        $mail_tpl = $this->config->item('MAILTPL_ENT_CLIENT_ID');

        // メール送信
        $this->load->model('Mailtpl', 'mailtpl', TRUE);
        if ($this->mailtpl->getMailTpl($mail, $arrRepList, $mail_tpl)) {
            $this->view('entryclient/end.tpl');
        } else {
            echo "メール送信エラー";
            $this->view('entryclient/end.tpl');
        }
    }

}
