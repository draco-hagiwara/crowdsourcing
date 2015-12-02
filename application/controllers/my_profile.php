<?php

class My_profile extends MY_Controller
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
		$this->form_validation->run();

		// 検索項目 初期値セット
		$this->_search_set();

		// ライター情報の読み込み
		$this->load->model('writer', 'wr', TRUE);
		$get_data = $this->wr->select_writer_id($tmp_writerid);

		$this->smarty->assign('writer_info', $get_data[0]);

		// 都道府県情報設定
		$this->config->load('config_pref');									// 都道府県情報読み込み
		$this->_options_pref = $this->config->item('pref');
		$this->smarty->assign('options_pref', $this->_options_pref);

		$this->_pref_name    = $this->_options_pref[$get_data[0]['wr_pref']];
		$this->smarty->assign('pref_name', $this->_pref_name);

		// メルマガ配信チェックボックスのチェック
		if ($get_data[0]['wr_mailmaga_flg'])
		{
			$this->smarty->assign('mailmaga_flg', TRUE);
		} else {
			$this->smarty->assign('mailmaga_flg', FALSE);
		}

		$this->view('writer/my_profile/index.tpl');

	}

	// 入力データで更新
	public function complete()
	{

		$this->load->model('writer', 'wr', TRUE);

		// メルマガ配信チェックボックスのチェック
		$mm_flg = TRUE;
		if ($this->input->post('wr_mailmaga_flg'))
		{
			$this->smarty->assign('mailmaga_flg', TRUE);
		} else {
			$this->smarty->assign('mailmaga_flg', FALSE);
			$mm_flg = FALSE;
		}

		// バリデーション・チェック
		$this->_set_validation();
		$this->form_validation->run();
		if ($this->form_validation->run() == FALSE)
		{

			// 検索項目 初期値セット
			$this->_search_set();

			// セッションからフラッシュデータ読み込み
			$tmp_writerid = $this->session->userdata('w_memID');

			// ライター情報の読み込み
			$get_data = $this->wr->select_writer_id($tmp_writerid);
			$this->smarty->assign('writer_info', $get_data[0]);

			// 都道府県情報設定
			$this->config->load('config_pref');									// 都道府県情報読み込み
			$this->_options_pref = $this->config->item('pref');
			$this->smarty->assign('options_pref', $this->_options_pref);

			$this->_pref_name    = $this->_options_pref[$get_data[0]['wr_pref']];
			$this->smarty->assign('pref_name', $this->_pref_name);

			$this->view('writer/my_profile/index.tpl');

		} else {

			// データセット
			$this->setData = $this->input->post();
			$this->setData["wr_mailmaga_flg"] = $mm_flg;

			// 不要パラメータ削除
			unset($this->setData["submit"]) ;

			// DB更新
			$this->wr->update_Writer($this->setData);

			redirect('/my_profile/');
		}

	}

	// 初期値セット
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
			);

		$this->load->library('form_validation', $rule_set);							// バリデーションクラス読み込み

	}

}
