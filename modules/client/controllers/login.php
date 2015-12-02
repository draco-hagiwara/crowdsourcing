<?php

class Login extends MY_Controller
{

	public function __construct()
	{
		parent::__construct();

		$this->_set_validation();											// バリデーション設定

	}

	// ログイン 初期表示
	public function index()
	{

		if ($this->session->userdata('c_login') == TRUE)
		{
			$this->smarty->assign('login_chk', TRUE);
			$this->smarty->assign('login_name', $this->session->userdata('c_memNAME'));

			$this->view('client/top/index.tpl');
		} else {
			$this->smarty->assign('err_mess', '');
			$this->view('client/login/index.tpl');
		}

	}

	// ログインID＆パスワード チェック
	public function check()
	{

		// バリデーション・チェック
		$this->_set_validation();											// バリデーション設定
		if ($this->form_validation->run() == FALSE) {
			$this->smarty->assign('err_mess', '');
			$this->view('client/login/index.tpl');
		} else {
			// ログインメンバーの読み込み
			$this->config->load('config_comm');
			$login_member = $this->config->item('LOGIN_CLIENT');

			// ログインID＆パスワードチェック
			$this->load->model('comm_auth', 'auth', TRUE);

			$loginid = $this->input->post('cl_email');
			$password = $this->input->post('cl_password');

			$err_mess = $this->auth->check_Login($loginid, $password, $login_member);
			if (isset($err_mess)) {
				// 入力エラー
				$this->smarty->assign('err_mess', $err_mess);
				$this->view('client/login/index.tpl');
			} else {
				// 認証OK
				// ログイン日時 更新
				$this->load->model('Client', 'cl', TRUE);
				$this->cl->update_Logindate($this->session->userdata('c_memID'));

				// クライアント・マイページ画面TOPへ
				//$this->view('client/top/index.tpl');
				$this->load->helper('url');
				redirect('/top/');
			}
		}
	}

	// ログアウト チェック
	public function logout()
	{
		// SESSION クリア
		$this->load->model('comm_auth', 'auth', TRUE);
		$this->auth->logout('client');

		// TOPへリダイレクト
		//$this->load->helper('url');
		redirect(base_url());
	}

	// フォーム・バリデーションチェック
	private function _set_validation()
	{

		$rule_set = array(
				array(
						'field'   => 'cl_email',
						'label'   => 'ログインID　（メールアドレス）',
						'rules'   => 'trim|required|valid_email|max_length[50]'
				),
				array(
						'field'   => 'cl_password',
						'label'   => 'パスワード',
						'rules'   => 'trim|required|regex_match[/^[\x21-\x7e]+$/]|min_length[8]|max_length[50]'
				),
		);

		$this->load->library('form_validation', $rule_set);							// バリデーションクラス読み込み

	}

}
