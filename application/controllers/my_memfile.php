<?php

class My_memfile extends MY_Controller
{

	public function __construct()
	{
		parent::__construct();

		if ($this->session->userdata('w_login') == TRUE)
		{
			$this->smarty->assign('login_chk',  TRUE);
			$this->smarty->assign('login_name', $this->session->userdata('w_memNAME'));
			$this->smarty->assign('mem_rank',   $this->session->userdata('w_memRANK'));
			$this->smarty->assign('mem_entry',  $this->session->userdata('w_memENTRY'));
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
		$this->comm_auth->delete_session('writer');

		// セッションからフラッシュデータ読み込み
		$tmp_writerid = $this->session->userdata('w_memID');

		// バリデーション・チェック
		$this->_set_validation();											// バリデーション設定

		// 検索項目 初期値セット
		$this->_search_set();
		$this->smarty->assign('err_email',  FALSE);
		$this->smarty->assign('err_passwd', FALSE);


		// ライター情報の読み込み
		$this->load->model('writer', 'wr', TRUE);
		$get_data = $this->wr->select_writer_id($tmp_writerid);

		$this->smarty->assign('writer_info', $get_data[0]);

		$this->view('writer/my_memfile/index.tpl');

	}

	// 完了画面表示
	public function complete()
	{

		$this->load->model('writer', 'wr', TRUE);

		$input_post = $this->input->post();
		$tmp_writerid = $input_post['wr_id'];

		// 検索項目 初期値セット
		$this->_search_set();
		$this->smarty->assign('err_email', FALSE);

		// バリデーション・チェック
		switch ($input_post['submit'])
		{
			case '_mail':
				$this->_set_validation01();
				break;
			case '_passwd':
				$this->_set_validation02();
				break;
			case '_bank':
				$this->_set_validation03();
				break;
			default:
		}

		if ($this->form_validation->run() == FALSE)
		{

			// ライター情報の読み込み
			$get_data = $this->wr->select_writer_id($tmp_writerid);
			$this->smarty->assign('writer_info', $get_data[0]);

			$this->view('writer/my_memfile/index.tpl');

		} else {

			switch ($input_post['submit'])
			{
				// メールアドレスの更新
				case '_mail':

					if ($this->wr->duplicate_LoginID($input_post['wr_email']) == FALSE)
					{

						unset($input_post["submit"]) ;
						unset($input_post["wr_password"]) ;
						unset($input_post["retype_password"]) ;
						unset($input_post["wr_bank_cd"]) ;
						unset($input_post["wr_bank"]) ;
						unset($input_post["wr_bk_branch_cd"]) ;
						unset($input_post["wr_bk_branch"]) ;
						unset($input_post["wr_bk_item"]) ;
						unset($input_post["wr_bk_no"]) ;
						unset($input_post["wr_bk_name"]) ;

						$result = $this->wr->update_Writer($input_post);

					} else {

						$this->smarty->assign('err_email', TRUE);

						// ライター情報の読み込み
						$get_data = $this->wr->select_writer_id($tmp_writerid);
						$this->smarty->assign('writer_info', $get_data[0]);

						$this->view('writer/my_memfile/index.tpl');
						return;

					}

					break;

				// パスワードの更新
				case '_passwd':

					$input_post["wr_password"] = password_hash($input_post["wr_password"], PASSWORD_DEFAULT);

					unset($input_post["submit"]) ;
					unset($input_post["wr_email"]) ;
					unset($input_post["retype_password"]) ;
					unset($input_post["wr_bank_cd"]) ;
					unset($input_post["wr_bank"]) ;
					unset($input_post["wr_bk_branch_cd"]) ;
					unset($input_post["wr_bk_branch"]) ;
					unset($input_post["wr_bk_item"]) ;
					unset($input_post["wr_bk_no"]) ;
					unset($input_post["wr_bk_name"]) ;

					$result = $this->wr->update_Writer($input_post);

					break;

				// 振込先銀行情報の更新
				case '_bank':

					unset($input_post["submit"]) ;
					unset($input_post["wr_email"]) ;
					unset($input_post["wr_password"]) ;
					unset($input_post["retype_password"]) ;

					$result = $this->wr->update_Writer($input_post);

					break;
				default:
			}

			redirect('/my_memfile/');
		}
	}

	private function _search_set()
	{

		// ステータス状態 選択項目セット
		$this->config->load('config_status');
		$arroptions_wrstatus01 = array (
				''  => '選択してください',
				'1' => $this->config->item('WRITER_KARISHINSEI'),
				'2' => $this->config->item('WRITER_SHINSEITYU'),
				'3' => $this->config->item('WRITER_KARITOUROKU'),
				'4' => $this->config->item('WRITER_TOUROKU'),
				'7' => $this->config->item('WRITER_ITIJITEISHI'),
				'8' => $this->config->item('WRITER_TEISHI'),
				'9' => $this->config->item('WRITER_TAIKAI'),
		);

		$arroptions_wrstatus02 = array (
				'1' => $this->config->item('WRITER_KARISHINSEI'),
				'2' => $this->config->item('WRITER_SHINSEITYU'),
				'3' => $this->config->item('WRITER_KARITOUROKU'),
				'4' => $this->config->item('WRITER_TOUROKU'),
				'7' => $this->config->item('WRITER_ITIJITEISHI'),
				'8' => $this->config->item('WRITER_TEISHI'),
				'9' => $this->config->item('WRITER_TAIKAI'),
		);

		// 会員ランク 選択項目セット
		$this->config->load('config_comm');
		$arroptions_mrank = array (
				//'0' => $this->config->item('RANK_GUEST'),
				'1' => $this->config->item('RANK_BRONZE'),
				'2' => $this->config->item('RANK_SILVER'),
				'3' => $this->config->item('RANK_GOLD'),
				//'4' => $this->config->item('RANK_PLATINUM'),
				//'5' => $this->config->item('RANK_PREMIERE'),
		);

		$this->smarty->assign('options_wr_status01',   $arroptions_wrstatus01);
		$this->smarty->assign('options_wr_status02',   $arroptions_wrstatus02);
		$this->smarty->assign('options_wr_mm_rank_id', $arroptions_mrank);

	}

	// フォーム・バリデーションチェック
	private function _set_validation()
	{

		$rule_set = array(
				array(
						'field'   => 'wr_email',
						'label'   => 'メールアドレス',
						'rules'   => 'trim|required|valid_email'
				),
				array(
						'field'   => 'wr_password',
						'label'   => 'パスワード',
						'rules'   => 'trim|required|regex_match[/^[\x21-\x7e]+$/]|min_length[8]|max_length[50]|matches[retype_password]'
				),
				array(
						'field'   => 'retype_password',
						'label'   => 'パスワード再入力',
						'rules'   => 'trim|required|regex_match[/^[\x21-\x7e]+$/]|min_length[8]|max_length[50]|matches[wr_password]'
				),
				array(
						'field'   => 'wr_bank_cd',
						'label'   => '振込先銀行コード',
						'rules'   => 'trim|required|max_length[10]|is_numeric'
				),
				array(
						'field'   => 'wr_bank',
						'label'   => '振込先銀行名',
						'rules'   => 'trim|required|max_length[50]'
				),
				array(
						'field'   => 'wr_bk_branch_cd',
						'label'   => '支店コード',
						'rules'   => 'trim|required|max_length[10]|is_numeric'
				),
				array(
						'field'   => 'wr_bk_branch',
						'label'   => '支店名',
						'rules'   => 'trim|required|max_length[50]'
				),
				array(
						'field'   => 'wr_bk_item',
						'label'   => '種目',
						'rules'   => 'trim|required|max_length[10]'
				),
				array(
						'field'   => 'wr_bk_no',
						'label'   => '口座番号',
						'rules'   => 'trim|required|max_length[20]|is_numeric'
				),
				array(
						'field'   => 'wr_bk_name',
						'label'   => '口座名義人 (半角カナ)',
						'rules'   => 'trim|required|max_length[50]'
				),
		);

		$this->load->library('form_validation', $rule_set);							// バリデーションクラス読み込み

	}

	// mailaddress・バリデーションチェック
	private function _set_validation01()
	{

		$rule_set = array(
				array(
						'field'   => 'wr_email',
						'label'   => 'メールアドレス',
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
						'field'   => 'wr_password',
						'label'   => 'パスワード',
						'rules'   => 'trim|required|regex_match[/^[\x21-\x7e]+$/]|min_length[8]|max_length[50]|matches[retype_password]'
				),
				array(
						'field'   => 'retype_password',
						'label'   => 'パスワード再入力',
						'rules'   => 'trim|required|regex_match[/^[\x21-\x7e]+$/]|min_length[8]|max_length[50]|matches[wr_password]'
				),
		);

		$this->load->library('form_validation', $rule_set);							// バリデーションクラス読み込み

	}

	// BANK・バリデーションチェック
	private function _set_validation03()
	{

		$rule_set = array(
				array(
						'field'   => 'wr_bank_cd',
						'label'   => '振込先銀行コード',
						'rules'   => 'trim|required|max_length[10]|is_numeric'
				),
				array(
						'field'   => 'wr_bank',
						'label'   => '振込先銀行名',
						'rules'   => 'trim|required|max_length[50]'
				),
				array(
						'field'   => 'wr_bk_branch_cd',
						'label'   => '支店コード',
						'rules'   => 'trim|required|max_length[10]|is_numeric'
				),
				array(
						'field'   => 'wr_bk_branch',
						'label'   => '支店名',
						'rules'   => 'trim|required|max_length[50]'
				),
				array(
						'field'   => 'wr_bk_item',
						'label'   => '種目',
						'rules'   => 'trim|required|max_length[10]'
				),
				array(
						'field'   => 'wr_bk_no',
						'label'   => '口座番号',
						'rules'   => 'trim|required|max_length[20]|is_numeric'
				),
				array(
						'field'   => 'wr_bk_name',
						'label'   => '口座名義人 (半角カナ)',
						'rules'   => 'trim|required|max_length[50]'
				),
		);

		$this->load->library('form_validation', $rule_set);							// バリデーションクラス読み込み

	}

}
