<?php

class Entrywriter extends MY_Controller
{

	private $_options_pref;
	private $_pref_name;

	public function __construct()
	{
		parent::__construct();

		$this->config->load('config_pref');									// 都道府県情報読み込み

			// セッション書き込み
		if (!$this->session->userdata('ticket')) {
			$setData = array(
					'ticket' => md5(uniqid(mt_rand(), true)),
					'login_chk' => '',
					'login_mem' => '',
			);
			$this->session->set_userdata($setData);
		} else {
			// ログイン有無のチェック
			if ($this->session->userdata('login_chk') == TRUE) {
				// TOPへリダイレクト
				$this->load->helper('url');
				redirect(base_url());
				return;
			}
			$this->smarty->assign('login_chk', FALSE);
			$this->smarty->assign('login_mem', $this->session->userdata('login_mem'));
		}

		// 都道府県情報設定
		$this->_options_pref = $this->config->item('pref');
		$this->smarty->assign('options_pref', $this->_options_pref);

		// 都道府県チェック
		if ($this->input->post('wr_pref')) {
			$pref_id = $this->input->post('wr_pref');
			$this->_pref_name = $this->_options_pref[$pref_id];
		}


		$this->_set_validation();											// バリデーションチェック



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

		$this->smarty->assign('err_checkKiyaku', FALSE);
		$this->view('writer/entrywriter/kiyaku.tpl');
	}

	// 新規会員登録画面表示
	public function entry()
	{

		// セッションのチェック
		$this->ticket = $this->session->userdata('ticket');
		if (!$this->input->post('ticket') || $this->input->post('ticket') !== $this->ticket) {
			$message = 'セッション・エラーが発生しました。';
			show_error($message, 400);
		} else {
			$this->smarty->assign('ticket', $this->ticket);
		}

		// チェックボックスのバリデーション・チェック が上手く動かない
		$this->smarty->assign('mailmaga_flg', FALSE);
		if ($this->input->post('checkKiyaku')) {
			$this->smarty->assign('err_email', FALSE);
			$this->smarty->assign('err_passwd', FALSE);
			$this->view('writer/entrywriter/entry.tpl');
		} else {
			$this->smarty->assign('err_checkKiyaku', TRUE);
			$this->view('writer/entrywriter/kiyaku.tpl');
		}


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

		// メルマガ配信チェックボックスのチェック
		if ($this->input->post('wr_mailmaga_flg')) {
			$this->smarty->assign('mailmaga_flg', TRUE);
		} else {
			$this->smarty->assign('mailmaga_flg', FALSE);
		}

		// バリデーション・チェック
		if ($this->form_validation->run() == FALSE) {
			$this->smarty->assign('err_email', FALSE);
			$this->smarty->assign('err_passwd', FALSE);
			$this->view('writer/entrywriter/entry.tpl');
		} else {

			// パスワード再入力チェック
			if ($this->input->post('wr_password') !== $this->input->post('retype_password')) {
				$this->smarty->assign('err_email', FALSE);
				$this->smarty->assign('err_passwd', TRUE);
				$this->view('writer/entrywriter/entry.tpl');
				return;
			}

			$this->view('writer/entrywriter/confirm.tpl');
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

		// メルマガ配信チェックボックスのチェック
		$mm_flg = TRUE;
		if ($this->input->post('wr_mailmaga_flg')) {
			$this->smarty->assign('mailmaga_flg', TRUE);
		} else {
			$this->smarty->assign('mailmaga_flg', FALSE);
			$mm_flg = FALSE;
		}

		// バリデーション・チェック
		$this->form_validation->run();

		// 「戻る」ボタン押下の場合
		if ( $this->input->post('_back') ) {
			$this->smarty->assign('err_email', FALSE);
			$this->smarty->assign('err_passwd', FALSE);
			$this->view('writer/entrywriter/entry.tpl');
			return;
		}

		// ログインID(メールアドレス)の重複チェック
		$this->load->model('Writer', 'wr', TRUE);

		if ($this->wr->duplicate_LoginID($this->input->post('wr_email'))) {
			$this->smarty->assign('err_email', TRUE);
			$this->smarty->assign('err_passwd', FALSE);
			$this->view('writer/entrywriter/entry.tpl');
			return;
		}

		// DB書き込み
		$this->setData = $this->input->post();
		$this->setData["wr_password"] = password_hash($this->input->post('wr_password'), PASSWORD_DEFAULT);

		// 会員ステータス（：仮登録）の読み込み
		$this->config->load('config_status');
		$this->member_status = $this->config->item('WRITER_KARITOUROKU');
		$this->setData["wr_status"] = $this->member_status;

		// メルマガ有無フラグ判定
		if ($mm_flg == FALSE) {
			$this->setData["wr_mailmaga_flg"] = $mm_flg;
		}



		// 不要パラメータ削除
		unset($this->setData["ticket"]) ;
		unset($this->setData["submit"]) ;
		unset($this->setData["retype_password"]) ;

		if ($this->wr->insert_Writer($this->setData)) {
			$this->view('writer/entrywriter/end.tpl');
		} else {
			echo "会員登録に失敗しました。時間をおいてもう一度登録をお願いします。";
			$this->view('writer/entrywriter/end.tpl');
		}

		// メール送信先設定
		$mail['from']      = "";
		$mail['from_name'] = "";
		$mail['subject']   = "";
		$mail['to']        = $this->input->post('wr_email');
		$mail['cc']        = "";
		$mail['bcc']       = "";

		// メール本文置き換え文字設定
		$arrRepList = array(
				'wr_name01'       => $this->input->post('wr_name01'),
				'wr_name02'       => $this->input->post('wr_name02'),
				'wr_nickname'     => $this->input->post('wr_nickname'),
				'wr_email'        => $this->input->post('wr_email'),
				'wr_tel'          => $this->input->post('wr_tel')
		);

		// メールテンプレートの読み込み
		$this->config->load('config_mailtpl');								// メールテンプレート情報読み込み
		$mail_tpl = $this->config->item('MAILTPL_ENT_WRITER_ID');

		// メール送信
		$this->load->model('Mailtpl', 'mailtpl', TRUE);
		if ($this->mailtpl->getMailTpl($mail, $arrRepList, $mail_tpl)) {
			$this->view('writer/entrywriter/end.tpl');
		} else {
			echo "メール送信エラー";
			$this->view('writer/entrywriter/end.tpl');
		}


	}






	// フォーム・バリデーションチェック
	private function _set_validation()
	{

		$rule_set = array(
				array(
						'field'   => 'checkKiyaku[]',
						'label'   => '規約同意チェック',
						'rules'   => ''
				),
				array(
						'field'   => 'wr_name01',
						'label'   => '姓',
						'rules'   => 'trim|required|max_length[50]'
				),
				array(
						'field'   => 'wr_name02',
						'label'   => '名',
						'rules'   => 'trim|required|max_length[50]'
				),
				array(
						'field'   => 'wr_namekana01',
						'label'   => 'セイ（全角カタカナ）',
						'rules'   => 'trim|required|max_length[50]'
				),
				array(
						'field'   => 'wr_namekana02',
						'label'   => 'メイ（全角カタカナ）',
						'rules'   => 'trim|required|max_length[50]'
				),
				array(
						'field'   => 'wr_nickname',
						'label'   => 'ニックネーム',
						'rules'   => 'trim|required|max_length[50]'
				),
				array(
						'field'   => 'wr_zip01',
						'label'   => '郵便番号（3ケタ）',
						'rules'   => 'trim|required|max_length[3]|is_numeric'
				),
				array(
						'field'   => 'wr_zip02',
						'label'   => '郵便番号（4ケタ）',
						'rules'   => 'trim|required|max_length[4]|is_numeric'
				),
				array(
						'field'   => 'wr_pref',
						'label'   => '都道府県',
						'rules'   => 'trim|required|max_length[2]'
				),
				array(
						'field'   => 'wr_addr01',
						'label'   => '市区町村',
						'rules'   => 'trim|required|max_length[100]'
				),
				array(
						'field'   => 'wr_addr02',
						'label'   => '町名・番地',
						'rules'   => 'trim|required|max_length[100]'
				),
				array(
						'field'   => 'wr_buil',
						'label'   => 'ビル・マンション名など',
						'rules'   => 'trim|max_length[100]'
				),
				array(
						'field'   => 'wr_email',
						'label'   => 'メールアドレス',
						'rules'   => 'trim|required|valid_email'
				),
				array(
						'field'   => 'wr_email_mobile',
						'label'   => '携帯メールアドレス',
						'rules'   => 'trim|valid_email'
				),
				array(
						'field'   => 'wr_tel',
						'label'   => '電話番号',
						'rules'   => 'trim|required|regex_match[/^[0-9\-]+$/]|max_length[15]'
				),
				array(
						'field'   => 'wr_mobile',
						'label'   => '携帯番号',
						'rules'   => 'trim|regex_match[/^[0-9\-]+$/]|max_length[15]'
				),
				array(
						'field'   => 'wr_mobile',
						'label'   => '携帯番号',
						'rules'   => 'trim|regex_match[/^[0-9\-]+$/]|max_length[15]'
				),
				array(
						'field'   => 'wr_mailmaga_flg[]',
						'label'   => 'メルマガ配信希望',
						'rules'   => ''
				),
				array(
						'field'   => 'wr_password',
						'label'   => 'パスワード',
						'rules'   => 'trim|required|regex_match[/^[\x21-\x7e]+$/]|min_length[8]|max_length[50]'
				),
				array(
						'field'   => 'retype_password',
						'label'   => 'パスワード再入力',
						'rules'   => 'trim|required|regex_match[/^[\x21-\x7e]+$/]|min_length[8]|max_length[50]'
				)
			);

		$this->load->library('form_validation', $rule_set);							// バリデーションクラス読み込み

	}

}
