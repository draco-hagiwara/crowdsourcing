<?php

//class Top extends CI_Controller {
class Top extends MY_Controller
{

	function __construct()
	{
		parent::__construct();

		// セッションチェック
		if ($this->session->userdata('w_login') == TRUE)
		{
			$this->smarty->assign('login_chk', TRUE);
		} else {
			$this->smarty->assign('login_chk', FALSE);
		}

		if (!$this->session->userdata('w_ticket')) {
			$setData = array('w_ticket' => md5(uniqid(mt_rand(), true)));
			$this->session->set_userdata($setData);
		}

	}

	public function index()
	{

		// セッションデータをクリア
		$this->load->model('comm_auth', 'comm_auth', TRUE);
		$this->comm_auth->delete_session('writer');

		// 初期値セット
		$this->_form_item_set00();

		// バリデーション・チェック
		$this->_set_validation();											// バリデーション設定
		$this->form_validation->run();

		if ($this->session->userdata('w_login') == FALSE)
		{

			// 案件リストを取得
			$this->load->model('Project', 'pj', TRUE);
			$seach_list = $this->pj->get_seachlist(20);						// 表示件数=LIMIT値
			$this->smarty->assign('seach_list', $seach_list);

		} else {
			$this->smarty->assign('login_name', $this->session->userdata('w_memNAME'));
			$this->smarty->assign('mem_rank', $this->session->userdata('w_memRANK'));

			// エントリー有無のチェック
			$wr_id = $this->session->userdata('w_memID');
			$this->load->model('Writer_info', 'wrinfo', TRUE);
			if ($this->wrinfo->check_entry($wr_id))
			{
				$this->session->set_userdata('w_memENTRY', TRUE);
				$this->smarty->assign('mem_entry', TRUE);
			} else {
				$this->session->set_userdata('w_memENTRY', FALSE);
				$this->smarty->assign('mem_entry', FALSE);
			}

		}

		//$this->session->set_userdata('w_memID',   $this->_memberID);		// メンバーID
		//$this->session->set_userdata('w_memRANK', $this->_memberRANK);		// メンバーランキング(writerのみ)
		//$this->session->set_userdata('w_memNAME', $this->_memberNAME);		// メンバー名前(writerはニックネーム)

		//$this->smarty->assign('login_chk', $this->session->userdata('w_login'));

		$this->view('writer/top/index.tpl');

		//phpinfo();

	}

	// ご利用ガイド
	public function guide()
	{

		// セッションデータをクリア
		$this->load->model('comm_auth', 'comm_auth', TRUE);
		$this->comm_auth->delete_session('writer');

		// バリデーション・チェック
		$this->_set_validation();											// バリデーション設定
		$this->form_validation->run();

		if ($this->session->userdata('w_login') == TRUE)
		{

			$this->smarty->assign('login_name', $this->session->userdata('w_memNAME'));
			$this->smarty->assign('mem_rank', $this->session->userdata('w_memRANK'));

			// エントリー有無のチェック
			$wr_id = $this->session->userdata('w_memID');
			$this->load->model('Writer_info', 'wrinfo', TRUE);
			if ($this->wrinfo->check_entry($wr_id))
			{
				$this->session->set_userdata('w_memENTRY', TRUE);
				$this->smarty->assign('mem_entry', TRUE);
			} else {
				$this->session->set_userdata('w_memENTRY', FALSE);
				$this->smarty->assign('mem_entry', FALSE);
			}

		}

		$this->view('writer/top/guide.tpl');

	}

	// 会社概要
	public function aboutus()
	{

		// セッションデータをクリア
		$this->load->model('comm_auth', 'comm_auth', TRUE);
		$this->comm_auth->delete_session('writer');

		// バリデーション・チェック
		$this->_set_validation();											// バリデーション設定
		$this->form_validation->run();

		if ($this->session->userdata('w_login') == TRUE)
		{

			$this->smarty->assign('login_name', $this->session->userdata('w_memNAME'));
			$this->smarty->assign('mem_rank', $this->session->userdata('w_memRANK'));

			// エントリー有無のチェック
			$wr_id = $this->session->userdata('w_memID');
			$this->load->model('Writer_info', 'wrinfo', TRUE);
			if ($this->wrinfo->check_entry($wr_id))
			{
				$this->session->set_userdata('w_memENTRY', TRUE);
				$this->smarty->assign('mem_entry', TRUE);
			} else {
				$this->session->set_userdata('w_memENTRY', FALSE);
				$this->smarty->assign('mem_entry', FALSE);
			}

		}

		$this->view('writer/top/aboutus.tpl');

	}

	// 個人情報保護方針
	public function privacy()
	{

		// セッションデータをクリア
		$this->load->model('comm_auth', 'comm_auth', TRUE);
		$this->comm_auth->delete_session('writer');

		// バリデーション・チェック
		$this->_set_validation();											// バリデーション設定
		$this->form_validation->run();

		if ($this->session->userdata('w_login') == TRUE)
		{

			$this->smarty->assign('login_name', $this->session->userdata('w_memNAME'));
			$this->smarty->assign('mem_rank', $this->session->userdata('w_memRANK'));

			// エントリー有無のチェック
			$wr_id = $this->session->userdata('w_memID');
			$this->load->model('Writer_info', 'wrinfo', TRUE);
			if ($this->wrinfo->check_entry($wr_id))
			{
				$this->session->set_userdata('w_memENTRY', TRUE);
				$this->smarty->assign('mem_entry', TRUE);
			} else {
				$this->session->set_userdata('w_memENTRY', FALSE);
				$this->smarty->assign('mem_entry', FALSE);
			}

		}

		$this->view('writer/top/privacy.tpl');

	}

	// サイトマップ
	public function sitemap()
	{

		// セッションデータをクリア
		$this->load->model('comm_auth', 'comm_auth', TRUE);
		$this->comm_auth->delete_session('writer');

		// バリデーション・チェック
		$this->_set_validation();											// バリデーション設定
		$this->form_validation->run();

		if ($this->session->userdata('w_login') == TRUE)
		{

			$this->smarty->assign('login_name', $this->session->userdata('w_memNAME'));
			$this->smarty->assign('mem_rank', $this->session->userdata('w_memRANK'));

			// エントリー有無のチェック
			$wr_id = $this->session->userdata('w_memID');
			$this->load->model('Writer_info', 'wrinfo', TRUE);
			if ($this->wrinfo->check_entry($wr_id))
			{
				$this->session->set_userdata('w_memENTRY', TRUE);
				$this->smarty->assign('mem_entry', TRUE);
			} else {
				$this->session->set_userdata('w_memENTRY', FALSE);
				$this->smarty->assign('mem_entry', FALSE);
			}

		}

		$this->view('writer/top/sitemap.tpl');

	}



	// ログアウト チェック
	public function logout()
	{
		// セッションのチェック
		$this->ticket = $this->session->userdata('w_ticket');
		if (!$this->ticket) {
			$message = 'セッション・エラーが発生しました。';
			show_error($message, 400);
		} else {
			$this->smarty->assign('ticket', $this->ticket);
		}

		// SESSION クリア
		$this->load->model('comm_auth', 'auth', TRUE);
		$this->auth->logout('writer');

		// TOPへリダイレクト
		$this->load->helper('url');
		redirect(base_url());
	}


	// 項目 初期値セット
	private function _form_item_set00()
	{

		// ジャンル 選択項目セット
		$this->load->model('comm_select', 'select', TRUE);
		$genre_list = $this->select->get_genre();

		$this->smarty->assign('options_genre_list',   $genre_list);

	}

	// フォーム・バリデーションチェック
	private function _set_validation()
	{

		$rule_set = array(
		);

		$this->load->library('form_validation', $rule_set);						// バリデーションクラス読み込み

	}



}

/* End of file top.php */
/* Location: ./application/controllers/top.php */