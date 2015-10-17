<?php

class Login extends MY_Controller
{

<<<<<<< HEAD
<<<<<<< HEAD
	/*
	 * ADMIN管理者は クライアント登録(tb_client) の クライアントID(cl_id)=='1' 固定とする。
	*/
=======
>>>>>>> 778364b11983b8ecd0f1ae7ce60860e34a1a71c4
=======
	/*
	 * ADMIN管理者は クライアント登録(tb_client) の クライアントID(cl_id)=='1' 固定とする。
	*/
>>>>>>> develop
	public function __construct()
	{
		parent::__construct();

		$this->_set_validation();											// バリデーション設定

	}

	// ログイン 初期表示
	public function index()
	{

		if (($this->session->userdata('login_mem') == 'admin') && ($this->session->userdata('login_chk') == TRUE))
		{
			$this->view('admin/top/index.tpl');
		} else {
			$this->smarty->assign('err_mess', '');
			$this->view('admin/login/index.tpl');
		}

	}

	// ログインID＆パスワード チェック
	public function check()
	{

		// バリデーション・チェック
		$this->_set_validation();											// バリデーション設定
		if ($this->form_validation->run() == FALSE) {
			$this->smarty->assign('err_mess', '');
			$this->view('admin/login/index.tpl');
		} else {
			// ログインメンバーの読み込み
			$this->config->load('config_comm');
			$login_member = $this->config->item('LOGIN_ADMIN');

			// ログインID＆パスワードチェック
			$this->load->model('comm_auth', 'auth', TRUE);

			$loginid = $this->input->post('ad_email');
			$password = $this->input->post('ad_password');

			$err_mess = $this->auth->check_Login($loginid, $password, $login_member);
			if (isset($err_mess)) {
				// 入力エラー
				$this->smarty->assign('err_mess', $err_mess);
				$this->view('admin/login/index.tpl');
			} else {
				// 認証OK
				// ログイン日時 更新
<<<<<<< HEAD
<<<<<<< HEAD
				$this->load->model('Admin', 'ad', TRUE);
				$this->ad->update_Logindate($this->session->userdata('memberID'));
=======
				$this->load->model('Client', 'cl', TRUE);
				$this->cl->update_Logindate($this->session->userdata('memberID'));
>>>>>>> 778364b11983b8ecd0f1ae7ce60860e34a1a71c4
=======
				$this->load->model('Admin', 'ad', TRUE);
				$this->ad->update_Logindate($this->session->userdata('memberID'));
>>>>>>> develop

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
		$this->auth->logout();

		// TOPへリダイレクト
		$this->load->helper('url');
		redirect(base_url());
	}

	// フォーム・バリデーションチェック
	private function _set_validation()
	{

		$rule_set = array(
				array(
						'field'   => 'ad_email',
						'label'   => 'ログインID　（メールアドレス）',
						'rules'   => 'trim|required|valid_email|max_length[50]'
				),
				array(
						'field'   => 'ad_password',
						'label'   => 'パスワード',
						'rules'   => 'trim|required|regex_match[/^[\x21-\x7e]+$/]|min_length[8]|max_length[50]'
				),
		);

		$this->load->library('form_validation', $rule_set);							// バリデーションクラス読み込み

	}

}
