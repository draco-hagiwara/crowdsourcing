<?php

class Login extends MY_Controller
{

    private $_writerID;
    private $_writerKEY;

    public function __construct()
    {
        parent::__construct();

        // セッション書き込み
        if (!$this->session->userdata('ticket'))
        {

            $setData = array(
                    'ticket' => md5(uniqid(mt_rand(), true)),
                    'w_login' => FALSE,
                    //'login_mem' => '',
            );
            $this->session->set_userdata($setData);
        } else {

            // ログイン有無のチェック
            if ($this->session->userdata('w_login') == TRUE) {
                // TOPへリダイレクト
                //$this->load->helper('url');
                redirect(base_url());
                return;
            }
            $this->smarty->assign('login_chk', FALSE);
            //$this->smarty->assign('login_mem', $this->session->userdata('login_mem'));
        }

        //$this->_set_validation();                                            // バリデーション設定

    }

    // ログイン＆ログアウト 初期表示
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

            // 前URIを保存
            $referer = $this->input->server('HTTP_REFERER');
            $this->session->set_userdata('referer', $referer);
        }

        $this->_set_validation();                                            // バリデーション設定

        $this->smarty->assign('err_mess', '');
        $this->view('writer/login/index.tpl');

    }

    // ログイン チェック
    public function check()
    {

        // セッションのチェック
        $this->ticket = $this->session->userdata('ticket');
        if (!$this->input->post('ticket') || $this->input->post('ticket') !== $this->ticket) {
        //if (!$this->ticket) {
            $message = 'セッション・エラーが発生しました。';
            show_error($message, 400);
        } else {
            $this->smarty->assign('ticket', $this->ticket);
            $this->smarty->assign('err_mess', '');
        }

        // バリデーション・チェック
        $this->_set_validation();                                            // バリデーション設定
        if ($this->form_validation->run() == FALSE)
        {
            $this->smarty->assign('err_mess', '');
            $this->view('writer/login/index.tpl');
        } else {
            // ログインメンバーの読み込み
            $this->config->load('config_comm');
            $login_member = $this->config->item('LOGIN_WRITER');

            // ログインID＆パスワードチェック
            $this->load->model('comm_auth', 'auth', TRUE);

            $loginid  = $this->input->post('wr_email');
            $password = $this->input->post('wr_password');

            $err_mess = $this->auth->check_Login($loginid, $password, $login_member);
            if (isset($err_mess))
            {
                // 入力エラー
                $this->smarty->assign('err_mess', $err_mess);
                $this->view('writer/login/index.tpl');
            } else {
                // 認証OK
                // ログイン日時 更新
                $this->load->model('Writer', 'wr', TRUE);
                $this->wr->update_Logindate($this->session->userdata('w_memID'));

                // 前URLへリダイレクト
                redirect('login/reissue_ngend');
                //$this->load->helper('url');
                //redirect($this->session->userdata('referer'));
            }
        }
    }

    // パスワード再発行 初期表示
    public function reissue()
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
            $this->smarty->assign('err_mess', '');
            $this->smarty->assign('err_captcha', '');
        }

        $this->_set_validation01();                                            // バリデーション設定




        // 画像認証コード作成
        $img_captcha = $this->_captsha_create();
        $this->smarty->assign('captcha', $img_captcha);






        $this->view('writer/login/reissue.tpl');

    }

    // パスワード再発行 チェック
    public function reissuecheck()
    {

        // セッションのチェック
        $this->ticket = $this->session->userdata('ticket');
        if (!$this->input->post('ticket') || $this->input->post('ticket') !== $this->ticket)
        {
        //if (!$this->ticket) {
            $message = 'セッション・エラーが発生しました。';
            show_error($message, 400);
        } else {
            $this->smarty->assign('ticket', $this->ticket);
            $this->smarty->assign('err_mess', '');
            $this->smarty->assign('err_captcha', '');
        }

        // バリデーション・チェック
        $this->_set_validation01();                                                // バリデーション設定
        if ($this->form_validation->run() == FALSE)
        {
            // 画像認証コード作成
            $img_captcha = $this->_captsha_create();
            $this->smarty->assign('captcha', $img_captcha);

            $this->view('writer/login/reissue.tpl');
        } else {

            // 入力ログインID の存在チェック
            $this->load->model('Writer', 'wr', TRUE);

            $input_email = $this->input->post('wr_email');
            if ($this->wr->exist_LoginID($input_email) == FALSE)
            {
                $this->smarty->assign('err_mess', '入力されたログインID（メールアドレス）は登録されていません。');
                $this->view('writer/login/reissue.tpl');
                return;
            }

            // 画像認証コードのチェック
            //  どうも大文字・小文字の判定がおかしい？？ 両方小文字に変換して判定。
            //  時間のある時、フォントを入れ替えて再検証！
            $captcha_word = strtolower($this->input->post('captcha_word'));        // 画像認証コード文字
            $captcha_chr = strtolower($this->input->post('captcha_chr'));        // 入力文字

            if ( $captcha_chr != $captcha_word )
            {
                // 画像認証コード作成
                $img_captcha = $this->_captsha_create();
                $this->smarty->assign('captcha', $img_captcha);

                $this->smarty->assign('err_captcha', '入力された画像認証コードが一致しません。');
                $this->view('writer/login/reissue.tpl');
                return;
            }

            // 仮PW、PW再発行Key、PW再発行時間 をセット
            $this->wr->update_Repasswd($input_email, $this->input->post('wr_password'), NULL);

            // 仮PW発行メールの送信
            $arrData = $this->wr->exist_LoginID($input_email);
            foreach ($arrData as $r) {
                $wr_id        = $r['wr_id'];
                $wr_nickname  = $r['wr_nickname'];
                $wr_tmp_pwkey = $r['wr_tmp_pwkey'];
            }

            $mail['from']      = "";
            $mail['from_name'] = "";
            $mail['subject']   = "";
            $mail['to']        = $input_email;
            $mail['cc']        = "";
            $mail['bcc']       = "";

            // メール本文置き換え文字設定
            $this->config->load('config_comm');
            $tmp_time = $this->config->item('REPASSWD_TIME');                    // 仮パスワード保持制限時間設定

            //$this->load->helper('url');
            $tmp_uri = site_url() . 'login/reissuecomp/' . $wr_id . '/' . $wr_tmp_pwkey ;    // PW本登録URI設定

            $arrRepList = array(
                    'nickname'     => $wr_nickname,
                    'tmp_uri'      => $tmp_uri,
                    'tmp_time'     => $tmp_time,
            );

            // メールテンプレートの読み込み
            $this->config->load('config_mailtpl');                                // メールテンプレート情報読み込み
            $mail_tpl = $this->config->item('MAILTPL_REPASSWORD_ID');

            // メール送信
            $this->load->model('Mailtpl', 'mailtpl', TRUE);
            if ($this->mailtpl->getMailTpl($mail, $arrRepList, $mail_tpl))
            {
                //$this->view('writer/entrywriter/end.tpl');
            } else {
                echo "メール送信エラー";
                //$this->view('writer/entrywriter/end.tpl');
            }

            $this->smarty->assign('reissue_status', 'temp');
            $this->smarty->assign('tmp_time', $tmp_time);
            $this->view('writer/login/reissue_end.tpl');
        }
    }

    // パスワード本登録 チェック
    public function reissuecomp()
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

        //$this->load->helper('url');
        $this->load->model('Writer', 'wr', TRUE);

        // URIセグメントの取得
        $segments = $this->uri->segment_array();
        $this->_writerID = $segments[3];
        $this->_writerKEY = $segments[4];

        // ライター情報の読み込み
        $arrData = $this->wr->exist_WriterID($this->_writerID);
        if (count($arrData) != 0)
        {
            foreach ($arrData as $r) {
                $wr_tmp_password  = $r['wr_tmp_password'];
                $wr_tmp_pwkey     = $r['wr_tmp_pwkey'];
                $wr_tmp_pwtime    = $r['wr_tmp_pwtime'];
            }
        } else {
            redirect('login/reissue_ngend');
        }

        // KEYチェック
        if ($this->_writerKEY != $wr_tmp_pwkey)
        {
            redirect('login/reissue_ngend');
        }

        // 制限時間チェック
        $result_timechk = $this->_repasswd_timechk($wr_tmp_pwtime);
        if ($result_timechk)
        {
            redirect('login/reissue_ngend');
        }

        // パスワード書き換え
        $result = $this->wr->update_Password($this->_writerID, $wr_tmp_password);

        redirect('login/reissue_okend');
    }

    // パスワード本登録 成功
    public function reissue_okend()
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


        $this->smarty->assign('reissue_status', 'ok');
        $this->view('writer/login/reissue_end.tpl');

    }

    // パスワード本登録 失敗
    public function reissue_ngend()
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


        $this->smarty->assign('reissue_status', 'ng');
        $this->view('writer/login/reissue_end.tpl');

    }

    // ログアウト チェック --> /top/logout に移動
    //public function logout()
    //{
    //    // セッションのチェック
    //    $this->ticket = $this->session->userdata('ticket');
    //    if (!$this->ticket) {
    //        $message = 'セッション・エラーが発生しました。';
    //        show_error($message, 400);
    //    } else {
    //        $this->smarty->assign('ticket', $this->ticket);
    //    }
    //
    //    // SESSION クリア
    //    $this->load->model('comm_auth', 'auth', TRUE);
    //    $this->auth->logout();
    //
    //    // TOPへリダイレクト
    //    $this->load->helper('url');
    //    redirect(base_url());
    //}




    // 仮パスワード変更制限時間チェック
    private function _repasswd_timechk($wr_tmp_pwtime)
    {
        $this->config->load('config_comm');
        $tmp_repasswdtime = $this->config->item('REPASSWD_TIME');                    // 仮パスワード保持制限時間設定
        $count_time = date('Y-m-d H:i:s', strtotime($wr_tmp_pwtime . "+" . $tmp_repasswdtime .  " minute"));

        $time = time();
        $tmp_nowtime = date("Y-m-d H:i:s", $time);
        if (strtotime($count_time) <= strtotime($tmp_nowtime))
        {
            return TRUE;
        }

        return FALSE;

    }

    // 画像認証コード作成
    private function _captsha_create()
    {
        $this->load->helper('captcha');

        $info['word'] = '';
        $info['img_width'] = 150;
        $info['img_path'] = 'img/captcha/';
        $info['img_url'] = '/img/captcha/';
        $info['font_path'] = 'img/captcha/fonts/4.ttf';
        $img_captcha = create_captcha($info);

        return $img_captcha;
    }

    // フォーム・バリデーションチェック
    private function _set_validation()
    {

        $rule_set = array(
                array(
                        'field'   => 'wr_email',
                        'label'   => 'ログインID　（メールアドレス）',
                        'rules'   => 'trim|required|valid_email|max_length[50]'
                ),
                array(
                        'field'   => 'wr_password',
                        'label'   => 'パスワード',
                        'rules'   => 'trim|required|regex_match[/^[\x21-\x7e]+$/]|min_length[8]|max_length[50]'
                ),
        );

        $this->load->library('form_validation', $rule_set);                            // バリデーションクラス読み込み

    }

    private function _set_validation01()
    {

        $rule_set = array(
                array(
                        'field'   => 'wr_email',
                        'label'   => 'ログインID　（メールアドレス）',
                        'rules'   => 'trim|required|valid_email|max_length[50]'
                ),
                array(
                        'field'   => 'wr_password',
                        'label'   => 'パスワード',
                        'rules'   => 'trim|required|regex_match[/^[\x21-\x7e]+$/]|min_length[8]|max_length[50]'
                ),
                array(
                        'field'   => 'retype_password',
                        'label'   => 'パスワード再入力',
                        'rules'   => 'trim|required|regex_match[/^[\x21-\x7e]+$/]|min_length[8]|max_length[50]|matches[wr_password]'
                ),
                array(
                        'field'   => 'captcha_chr',
                        'label'   => '画像認証コード',
                        'rules'   => 'trim|required|min_length[8]|max_length[8]|alpha_numeric'
                ),
        );

        $this->load->library('form_validation', $rule_set);                            // バリデーションクラス読み込み

    }

}
