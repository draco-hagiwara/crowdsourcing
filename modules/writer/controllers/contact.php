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
        if (!$this->session->userdata('w_ticket')) {
            $this->ticket = md5(uniqid(mt_rand(), true));
            $this->session->set_userdata('w_ticket', $this->ticket);
        }

    }

    // お問合せフォームTOP表示
    public function index()
    {

        // セッションのチェック
        $this->ticket = $this->session->userdata('w_ticket');
        //if (!$this->input->post('ticket') || $this->input->post('ticket') !== $this->ticket) {
        if (!$this->ticket)
        {
            $message = 'セッション・エラーが発生しました。';
            show_error($message, 400);
        } else {
            $this->smarty->assign('ticket', $this->ticket);
        }

        $this->view('writer/contact/index.tpl');
    }

    // 確認画面表示
    public function confirm()
    {

        //var_dump($this->input->post());


        // セッションのチェック
        $this->ticket = $this->session->userdata('w_ticket');
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
            $this->view('writer/contact/index.tpl');
        } else {
            $this->view('writer/contact/confirm.tpl');
        }
    }

    // 完了画面表示
    public function complete()
    {

        // セッションのチェック
        $this->ticket = $this->session->userdata('w_ticket');
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
            $this->view('writer/contact/index.tpl');
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
            $this->view('writer/contact/end.tpl');
        } else {
            echo "メール送信エラー";
            $this->view('writer/contact/end.tpl');
        }


        //if (defined('ENVIRONMENT')) {
        //    switch (ENVIRONMENT)
        //    {
        //        case 'development':
        //
        //            $where = array('mt_id' => $mail_tpl);
        //            $query = $this->db->get_where('tb_mail_tpl', $where);
        //            foreach ($query->result_array() as $row)
        //            {
        //                $mail['from']      = $row['mt_from'];
        //                $mail['from_name'] = $row['mt_from_name'];
        //                $mail['to']        = $row['mt_to'];
        //                $mail['cc']        = $this->input->post('inputEmail');
        //                $mail['bcc']       = "";
        //                $mail['subject']   = $row['mt_subject'];
        //
        //                $arrRepList = array(
        //                                'inputName'    => $this->input->post('inputName'),
        //                                'inputEmail'   => $this->input->post('inputEmail'),
        //                                'inputTel'     => $this->input->post('inputTel'),
        //                                'inputComment' => $this->input->post('inputComment')
        //                            );
        //                if ($arrRepList) {
        //
        //                    // 置き換え文字列の処理
        //                    $arrRepPattern = array();
        //                    $arrRepTag     = array();
        //                    foreach( $arrRepList as $strKey => $strValue )
        //                    {
        //                        $arrRepPattern[] = '/\[' . $strKey . '\]/';
        //                        $arrRepTag[]     = $strValue;
        //                    }
        //
        //                    $strResult = preg_replace( $arrRepPattern, $arrRepTag, $row['mt_body'] );
        //                } else {
        //                    $strResult = $row['mt_body'];
        //                }
        //
        //                $mail['body'] = $strResult;
        //            }
        //
        //            break;
        //
        //        case 'testing':
        //            break;
        //
        //        case 'production':
        //            break;
        //
        //        default:
        //    }
        //}

        //if ($this->_sendmail($mail)) {
        //    $this->view('writer/contact_end.tpl');
        //    $this->session->sess_destroy();
        //} else {
        //    echo "メール送信エラー";
        //    $this->view('writer/contact_end.tpl');
        //    $this->session->sess_destroy();
        //}
    }


    // ※functin　なので　helper　かな？
    //private function _sendmail($mail)
    //{
    //
    //    $this->load->library('email');
    //
    //    $from_name = mb_encode_mimeheader($mail['from_name'], 'ISO-2022-JP'   , 'UTF-8');
    //    $subject   = mb_convert_encoding ($mail['subject']  , 'ISO-2022-JP-MS', 'UTF-8');
    //    $body      = mb_convert_encoding ($mail['body']     , 'ISO-2022-JP-MS', 'UTF-8');
    //
    //    $this->email->clear();
    //    $this->email->reply_to('autoreply@cs.com.dev', 'CrowdSourcing');
    //    $this->email->from($mail['from'] , $from_name);
    //    $this->email->to($mail['to']);
    //    $this->email->cc($mail['cc']);
    //    $this->email->bcc($mail['bcc']);
    //    $this->email->subject($subject);
    //    $this->email->message($body);
    //
    //    if ($this->email->send()) {
    //        return TRUE;
    //    } else {
    //        return FALSE;
    //    }
    //
    //    echo $this->email->print_debugger();
    //
    //}
}
