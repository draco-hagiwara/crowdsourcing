<?php

class Contact extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();

        //$this->load->library('database');                                    // データベースクラス読み込み。autoload.php へ移動
        //$this->load->library('session');                                    // セッションクラス読み込み。autoload.php へ移動
        //$this->load->library('smarty');                                    // Smartyクラス読み込み。autoload.php へ移動
        $this->load->library('form_validation');                            // バリデーションクラス読み込み

        // セッション書き込み
        if (!$this->session->userdata('ticket')) {
            $this->ticket = md5(uniqid(mt_rand(), true));
            $this->session->set_userdata('ticket', $this->ticket);
        }

    }

    // お問合せフォームTOP表示
    public function index()
    {

        // セッションのチェック
        $this->ticket = $this->session->userdata('ticket');
        //if (!$this->input->post('ticket') || $this->input->post('ticket') !== $this->ticket) {
        if (!$this->ticket)
        {
            $message = 'セッション・エラーが発生しました。';
            show_error($message, 400);
        } else {
            $this->smarty->assign('ticket', $this->ticket);
        }

        $this->view('contact/index.tpl');
    }

    // 確認画面表示
    public function confirm()
    {

        // セッションのチェック
        $this->ticket = $this->session->userdata('ticket');
        if (!$this->input->post('ticket') || $this->input->post('ticket') !== $this->ticket)
        {
            $message = 'セッション・エラーが発生しました。';
            show_error($message, 400);
        } else {
            $this->smarty->assign('ticket', $this->ticket);
        }

        // バリデーション・チェック
        if ($this->form_validation->run() == FALSE)
        {
            $this->view('contact/index.tpl');
        } else {
            $this->view('contact/confirm.tpl');
        }
    }

    // 完了画面表示
    public function complete()
    {

        // セッションのチェック
        $this->ticket = $this->session->userdata('ticket');
        if (!$this->input->post('ticket') || $this->input->post('ticket') !== $this->ticket)
        {
            $message = 'セッション・エラーが発生しました。';
            show_error($message, 400);
        } else {
            $this->smarty->assign('ticket', $this->ticket);
        }

        // バリデーション・チェック
        $this->form_validation->run();

        // 「戻る」ボタン押下の場合
        if ( $this->input->post('_back') ) {
            $this->view('contact/index.tpl');
            return;
        }


        // メール送信先設定
        $mail['from']      = "";
        $mail['from_name'] = "";
        $mail['subject']   = "";
        $mail['to']        = "";
        $mail['cc']        = $this->input->post('inputEmail');
        $mail['bcc']       = "";

        // メール本文置き換え文字設定
        $arrRepList = array(
                'inputName'    => $this->input->post('inputName'),
                'inputEmail'   => $this->input->post('inputEmail'),
                'inputTel'     => $this->input->post('inputTel'),
                'inputComment' => $this->input->post('inputComment')
        );

        // メールテンプレートの読み込み
        $this->config->load('config_mailtpl');                                // メールテンプレート情報読み込み
        $mail_tpl = $this->config->item('MAILTPL_CONTACT_ID');

        // メール送信
        $this->load->model('Mailtpl', 'mailtpl', TRUE);
        if ($this->mailtpl->getMailTpl($mail, $arrRepList, $mail_tpl)) {
            $this->view('contact/end.tpl');
        } else {
            echo "メール送信エラー";
            $this->view('contact/end.tpl');
        }

    }

}
