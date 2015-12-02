<?php

class Cl_info extends MY_Controller
{

	public function __construct()
	{
		parent::__construct();

		if ($this->session->userdata('c_login') == TRUE)
		{
			$this->smarty->assign('login_chk', TRUE);
			$this->smarty->assign('login_name', $this->session->userdata('c_memNAME'));
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

		// バリデーション設定
		$this->_set_validation();

		// 初期値セット
		$this->smarty->assign('err_email',  FALSE);
		$this->smarty->assign('res_mess',   '');

		// クライアントのデータ取得
		$this->load->model('Client', 'cl', TRUE);
		$get_data = $this->cl->select_client_id($tmp_clientid);
		$this->smarty->assign('client_info', $get_data[0]);

		// 現在の会員ランク単価を取得
		$this->_get_member_tanka($tmp_clientid);

		$this->view('client/cl_info/index.tpl');

	}

	// 完了画面表示
	public function complete()
	{

		$input_post = $this->input->post();
		$tmp_clientid = $input_post['cl_id'];

		// 初期値セット
		$this->smarty->assign('err_email', FALSE);
		$this->smarty->assign('res_mess',  '');

		// バリデーション・チェック
		switch ($input_post['submit'])
		{
			case '_mail':
				$this->_set_validation01();
				break;
			case '_passwd':
				$this->_set_validation02();
				break;
			case '_rank':
				$this->_set_validation03();
				break;
			case '_diff':
				$this->_set_validation04();
				break;
			default:
		}

		if ($this->form_validation->run() == TRUE)
		{

			switch ($input_post['submit'])
			{
				// メールアドレスの更新
				case '_mail':

					$this->load->model('client', 'cl', TRUE);

					if ($this->cl->check_LoginID($input_post['cl_email']) == FALSE)
					{

						unset($input_post["submit"]) ;
						unset($input_post["cl_password"]) ;
						unset($input_post["retype_password"]) ;
						unset($input_post["ta_price1"]) ;
						unset($input_post["ta_price2"]) ;
						unset($input_post["ta_price3"]) ;
						unset($input_post["taa_price1"]) ;
						unset($input_post["taa_price2"]) ;
						unset($input_post["taa_price3"]) ;

						$result = $this->cl->update_Client($input_post);
						$this->smarty->assign('res_mess',  '「メールアドレス（代表）＆　ログインID」が更新されました。');

					} else {

						$this->smarty->assign('err_email', TRUE);

					}

					break;

				// パスワードの更新
				case '_passwd':

					$input_post["cl_password"] = password_hash($input_post["cl_password"], PASSWORD_DEFAULT);

					unset($input_post["submit"]) ;
					unset($input_post["cl_email"]) ;
					unset($input_post["retype_password"]) ;
					unset($input_post["ta_price1"]) ;
					unset($input_post["ta_price2"]) ;
					unset($input_post["ta_price3"]) ;
					unset($input_post["taa_price1"]) ;
					unset($input_post["taa_price2"]) ;
					unset($input_post["taa_price3"]) ;

					$this->load->model('client', 'cl', TRUE);
					$result = $this->cl->update_Client($input_post);
					$this->smarty->assign('res_mess',  '「パスワード」が更新されました。');

					break;

				// 会員ランク単価の更新
				case '_rank':

					$set_data[1]       = $input_post["ta_price1"];
					$set_data[2]       = $input_post["ta_price2"];
					$set_data[3]       = $input_post["ta_price3"];

					$this->load->model('tanka', 'ta', TRUE);
					$result = $this->ta->update_tanka($input_post["cl_id"], $set_data);
					if ($result)
					{
						$this->smarty->assign('res_mess',  '「会員ランク単価」が更新されました。');
					} else {
						$this->smarty->assign('res_mess',  '更新に失敗しました。');
					}

					break;

				// 難易度単価の更新
				case '_diff':

						$set_data[0]       = $input_post["taa_price1"];
						$set_data[1]       = $input_post["taa_price2"];
						$set_data[2]       = $input_post["taa_price3"];

						$this->load->model('tanka', 'ta', TRUE);
						$result = $this->ta->update_tankaadd($input_post["cl_id"], $set_data);
						if ($result)
						{
							$this->smarty->assign('res_mess',  '「難易度単価」が更新されました。');
						} else {
							$this->smarty->assign('res_mess',  '更新に失敗しました。');
						}

						break;

				default:
			}

		}

		$this->load->model('Client', 'cl', TRUE);
		$get_data = $this->cl->select_client_id($tmp_clientid);
		$this->smarty->assign('client_info', $get_data[0]);

		// 現在の会員ランク単価を取得
		$this->_get_member_tanka($tmp_clientid);

		$this->view('client/cl_info/index.tpl');

	}

	// 現在の会員ランク単価＆難易度単価を取得
	private function _get_member_tanka($cl_id)
	{

		$this->load->model('tanka', 'ta', TRUE);
		$tanka_list = $this->ta->get_tanka($cl_id);
		$this->smarty->assign('tanka_list', $tanka_list);

		$tankaadd_list = $this->ta->get_tankaaad($cl_id);
		$this->smarty->assign('tankaadd_list', $tankaadd_list);

	}

	// フォーム・バリデーションチェック
	private function _set_validation()
	{

		$rule_set = array(
				array(
						'field'   => 'cl_email',
						'label'   => 'メールアドレス（代表）＆　ログインID',
						'rules'   => 'trim|required|valid_email'
				),
				array(
						'field'   => 'cl_password',
						'label'   => 'パスワード',
						'rules'   => 'trim|required|regex_match[/^[\x21-\x7e]+$/]|min_length[8]|max_length[50]|matches[retype_password]'
				),
				array(
						'field'   => 'retype_password',
						'label'   => 'パスワード再入力',
						'rules'   => 'trim|required|regex_match[/^[\x21-\x7e]+$/]|min_length[8]|max_length[50]|matches[cl_password]'
				),
				array(
						'field'   => 'ta_price1',
						'label'   => '会員ランク > ブロンズ',
						'rules'   => 'trim|required|decimal|max_length[4]'
				),
				array(
						'field'   => 'ta_price2',
						'label'   => '会員ランク > シルバー',
						'rules'   => 'trim|required|decimal|max_length[4]'
				),
				array(
						'field'   => 'ta_price3',
						'label'   => '会員ランク > ゴールド',
						'rules'   => 'trim|required|decimal|max_length[4]'
				),
				array(
						'field'   => 'taa_price1',
						'label'   => '難易度 > カンタン',
						'rules'   => 'trim|required|decimal|max_length[4]'
				),
				array(
						'field'   => 'taa_price2',
						'label'   => '難易度 > ふつう',
						'rules'   => 'trim|required|decimal|max_length[4]'
				),
				array(
						'field'   => 'taa_price3',
						'label'   => '難易度 > 難しい',
						'rules'   => 'trim|required|decimal|max_length[4]'
				),
		);

		$this->load->library('form_validation', $rule_set);							// バリデーションクラス読み込み

	}

	// mailaddress・バリデーションチェック
	private function _set_validation01()
	{

		$rule_set = array(
				array(
						'field'   => 'cl_email',
						'label'   => 'メールアドレス（代表）＆　ログインID',
						'rules'   => 'trim|required|valid_email'
				),
		);

		$this->load->library('form_validation', $rule_set);							// バリデーションクラス読み込み

	}

	// PASSWORD・バリデーションチェック
	private function _set_validation02()
	{

		$rule_set = array(
				array(
						'field'   => 'cl_password',
						'label'   => 'パスワード',
						'rules'   => 'trim|required|regex_match[/^[\x21-\x7e]+$/]|min_length[8]|max_length[50]'
				),
				array(
						'field'   => 'retype_password',
						'label'   => 'パスワード再入力',
						'rules'   => 'trim|required|regex_match[/^[\x21-\x7e]+$/]|min_length[8]|max_length[50]|matches[cl_password]'
				),
		);

		$this->load->library('form_validation', $rule_set);							// バリデーションクラス読み込み

	}

	// 会員ランク別設定・バリデーションチェック
	private function _set_validation03()
	{

		$rule_set = array(
				array(
						'field'   => 'ta_price1',
						'label'   => '会員ランク > ブロンズ',
						'rules'   => 'trim|required|decimal|max_length[4]'
				),
				array(
						'field'   => 'ta_price2',
						'label'   => '会員ランク > シルバー',
						'rules'   => 'trim|required|decimal|max_length[4]'
				),
				array(
						'field'   => 'ta_price3',
						'label'   => '会員ランク > ゴールド',
						'rules'   => 'trim|required|decimal|max_length[4]'
				),
		);

		$this->load->library('form_validation', $rule_set);							// バリデーションクラス読み込み

	}

	// 難易度別設定・バリデーションチェック
	private function _set_validation04()
	{

		$rule_set = array(
				array(
						'field'   => 'taa_price1',
						'label'   => '難易度 > カンタン',
						'rules'   => 'trim|required|decimal|max_length[4]'
				),
				array(
						'field'   => 'taa_price2',
						'label'   => '難易度 > ふつう',
						'rules'   => 'trim|required|decimal|max_length[4]'
				),
				array(
						'field'   => 'taa_price3',
						'label'   => '難易度 > 難しい',
						'rules'   => 'trim|required|decimal|max_length[4]'
				),
		);

		$this->load->library('form_validation', $rule_set);							// バリデーションクラス読み込み

	}

}
