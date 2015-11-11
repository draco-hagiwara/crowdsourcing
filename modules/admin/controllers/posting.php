<?php

class Entrylist extends MY_Controller
{

	public function __construct()
	{
		parent::__construct();

		if ($this->session->userdata('a_login') == TRUE)
		{
			$this->smarty->assign('login_chk', TRUE);
			$this->smarty->assign('login_name', $this->session->userdata('a_memNAME'));
		} else {
			$this->smarty->assign('login_chk', FALSE);

			redirect('/login/');
		}

	}

	// 申請一覧TOP
	public function index()
	{

		// セッションデータをクリア
		$this->load->model('comm_auth', 'comm_auth', TRUE);
		$this->comm_auth->delete_session('admin');

		// バリデーション・チェック
		$this->_set_validation();											// バリデーション設定
		$this->form_validation->run();

		// 1ページ当たりの表示件数
		$this->config->load('config_comm');
		$tmp_per_page = $this->config->item('PAGINATION_PER_PAGE');

		// 検索項目 初期値セット
		$this->_search_set();

		// Pagination 現在ページ数の取得：：URIセグメントの取得
		$segments = $this->uri->segment_array();
		if (isset($segments[3]))
		{
			$tmp_offset = $segments[3];
		} else {
			$tmp_offset = 0;
		}

		// 案件申請情報のリスト＆件数を取得
		$this->load->model('Project_entry', 'pro', TRUE);
		list($entry_list, $entry_countall) = $this->pro->get_entrylist($this->input->post(), $tmp_per_page, $tmp_offset);
		$this->smarty->assign('entry_list', $entry_list);

		// Pagination 設定
		$set_pagination = $this->_get_Pagination($entry_countall, $tmp_per_page);

		$this->smarty->assign('set_pagination', $set_pagination['page_link']);
		$this->smarty->assign('countall',       $entry_countall);
		$this->smarty->assign('serch_item',     $this->input->post());

		$this->view('admin/entrylist/index.tpl');

	}

	// 一覧表示
	public function search()
	{

		// 検索項目の保存が上手くいかない。応急的に対応！
		if ($this->input->post('submit') == '_submit')
		{
			// セッションをフラッシュデータとして保存
			$data = array(
					'a_pe_entry_title' => $this->input->post('pe_entry_title'),
					'a_pe_id'          => $this->input->post('pe_id'),
					'a_pe_cl_id'       => $this->input->post('pe_cl_id'),
					'a_pe_status'      => $this->input->post('pe_status'),
					'a_pe_genre01'     => $this->input->post('pe_genre01'),
					'a_orderid'        => $this->input->post('orderid'),
					'a_orderstatus'    => $this->input->post('orderstatus'),
			);
			$this->session->set_userdata($data);

			$tmp_inputpost = $this->input->post();
			unset($tmp_inputpost["submit"]);

		} else {
			// セッションからフラッシュデータ読み込み
			$tmp_inputpost['pe_entry_title'] = $this->session->userdata('a_pe_entry_title');
			$tmp_inputpost['pe_id']          = $this->session->userdata('a_pe_id');
			$tmp_inputpost['pe_cl_id']       = $this->session->userdata('a_pe_cl_id');
			$tmp_inputpost['pe_status']      = $this->session->userdata('a_pe_status');
			$tmp_inputpost['pe_genre01']     = $this->session->userdata('a_pe_genre01');
			$tmp_inputpost['orderid']        = $this->session->userdata('a_orderid');
			$tmp_inputpost['orderstatus']    = $this->session->userdata('a_orderstatus');

			//$this->session->set_flashdata($tmp_inputpost);
		}

		// バリデーション・チェック
		$this->_set_validation();											// バリデーション設定
		$this->form_validation->run();

		// Pagination 現在ページ数の取得：：URIセグメントの取得
		//$this->load->helper('url');
		$segments = $this->uri->segment_array();
		if (isset($segments[3]))
		{
			$tmp_offset = $segments[3];
		} else {
			$tmp_offset = 0;
		}

		// 1ページ当たりの表示件数
		$this->config->load('config_comm');
		$tmp_per_page = $this->config->item('PAGINATION_PER_PAGE');

		// 案件申請情報のリスト＆件数を取得
		$this->load->model('Project_entry', 'pro', TRUE);
		list($entry_list, $entry_countall) = $this->pro->get_entrylist($tmp_inputpost, $tmp_per_page, $tmp_offset);
		$this->smarty->assign('entry_list', $entry_list);

		// Pagination 設定
		$set_pagination = $this->_get_Pagination($entry_countall, $tmp_per_page);

		// 検索項目 初期値セット
		$this->_search_set();

		$this->smarty->assign('set_pagination', $set_pagination['page_link']);
		$this->smarty->assign('countall',       $entry_countall);
		$this->smarty->assign('serch_item',     $tmp_inputpost);

		$this->view('admin/entrylist/index.tpl');

	}

	// 申請内容
	public function detail00()
	{

		// SELECT項目 初期値セット
		$this->_form_item_set00();

		// セッションからフラッシュデータ読み込み
		$flash_data['a_pe_id'] = $this->session->userdata('a_pe_id');


		// 申請内容データ 初期値セット
		$this->load->model('Project_entry', 'pro', TRUE);


		// 案件申請ID取得
		$input_post = $this->input->post();
		if (empty($input_post['peid_uniq']))
		{
			// ２回目以降
			$tmp_peid = $flash_data['a_pe_id'];
		} else {
			// 初回
			$tmp_peid = $input_post['peid_uniq'];
		}




		print("flash_data00 == ");
		print($tmp_peid);
		print("<br><br>");




		$get_data = $this->pro->get_entry($tmp_peid);

		// ジャンル 選択項目セット
		$this->load->model('comm_genre', 'gr', TRUE);
		$genre_list = $this->gr->get_genre();
		$get_data[0]['genre01_name']     = $genre_list[$get_data[0]['pe_genre01']];

		$get_data[0]['pe_open_date']     = date('Y-m-d', strtotime($get_data[0]['pe_open_date']));
		$get_data[0]['pe_delivery_date'] = date('Y-m-d', strtotime($get_data[0]['pe_delivery_date']));

		$this->smarty->assign('entry_info', $get_data[0]);

		// session:フラッシュデータに案件申請ID書き込み
		$tmp_flash_peid = array('a_pe_id' => $get_data[0]['pe_id']);
		$this->session->set_userdata( $tmp_flash_peid);

		// バリデーション設定
		$this->_set_validation00();
		//$this->form_validation->run();

		$this->smarty->assign('entry_no', '00');

		$this->view('admin/entrylist/detail.tpl');

	}

	// 申請案件１
	public function detail01()
	{

		// SELECT項目 初期値セット
		//$this->_search_set01();

		// セッションからフラッシュデータ読み込み＆書き込み
		$flash_data['a_pe_id'] = $this->session->userdata('a_pe_id');
		//$this->session->set_flashdata( $flash_data);


		print("flash_data01 == ");
		print_r($flash_data['a_pe_id']);
		print("<br><br>");


		// 申請案件データ 初期値セット
		$this->load->model('Project_entry', 'pro', TRUE);					// models 読み込み
		$get_data = $this->pro->get_entry_info($flash_data['a_pe_id'], $pei_seq = 0);



		//print_r($get_data[0]);


		$this->smarty->assign('entry_info', $get_data[0]);

		// バリデーション・チェック
		$this->_set_validation01();											// バリデーション設定
		//$this->form_validation->run();

		$this->smarty->assign('entry_no', '01');
		$this->view('admin/entrylist/detail.tpl');

	}

	// 申請案件２
	public function detail02()
	{

		// セッションからフラッシュデータ読み込み＆書き込み
		$flash_data['a_pe_id'] = $this->session->userdata('a_pe_id');
		//$this->session->set_flashdata( $flash_data);


		print("flash_data02 == ");
		print_r($flash_data['a_pe_id']);
		print("<br><br>");


		// 申請案件データ 初期値セット
		$this->load->model('Project_entry', 'pro', TRUE);					// models 読み込み
		$get_data = $this->pro->get_entry_info($flash_data['a_pe_id'], $pei_seq = 1);
		if (empty($get_data))
		{
			// 各項目 初期値セット
			$this->_form_item_set01($flash_data['a_pe_id']);
		} else {
			// 各項目 初期値セット
			$this->_form_item_set01($flash_data['a_pe_id']);
			$this->smarty->assign('entry_info', $get_data[0]);
		}

		// バリデーション・チェック
		$this->_set_validation01();											// バリデーション設定
		//$this->form_validation->run();

		$this->smarty->assign('entry_no', '02');
		$this->view('admin/entrylist/detail.tpl');

	}

	// 申請案件３
	public function detail03()
	{

		// セッションからフラッシュデータ読み込み＆書き込み
		$flash_data['a_pe_id'] = $this->session->userdata('a_pe_id');
		//$this->session->set_flashdata( $flash_data);


		print("flash_data03 == ");
		print_r($flash_data['a_pe_id']);
		print("<br><br>");


		// 申請案件データ 初期値セット
		$this->load->model('Project_entry', 'pro', TRUE);					// models 読み込み
		$get_data = $this->pro->get_entry_info($flash_data['a_pe_id'], $pei_seq = 2);
		if (empty($get_data))
		{
			// 各項目 初期値セット
			$this->_form_item_set01($flash_data['a_pe_id']);
		} else {
			// 各項目 初期値セット
			$this->_form_item_set01($flash_data['a_pe_id']);
			$this->smarty->assign('entry_info', $get_data[0]);
		}

		// バリデーション・チェック
		$this->_set_validation01();											// バリデーション設定
		//$this->form_validation->run();

		$this->smarty->assign('entry_no', '03');
		$this->view('admin/entrylist/detail.tpl');

	}

	// 案件申請データ更新
	public function data_entry()
	{

		// セッションからフラッシュデータ読み込み＆書き込み
		$flash_data['a_pe_id'] = $this->session->userdata('a_pe_id');
		//$this->session->set_flashdata($flash_data);



		print("flash_data_entry == ");
		print_r($flash_data['a_pe_id']);
		print("<br><br>");




		// バリデーション・チェック::TAB毎に処理振り分け
		$this->_set_validation00();
		if ($this->form_validation->run() == FALSE)
		{
			// 各項目 初期値セット
			$this->_form_item_set00();
		} else {

			$this->load->model('Project_entry', 'pro', TRUE);						// models 読み込み
			$this->config->load('config_status');

			$tmp_submit = $this->input->post('submit');

			if ($tmp_submit == '_accept')
			{

				// トランザクション・START
				$this->db->trans_strict(FALSE);									// StrictモードをOFF
				$this->db->trans_start();										// trans_begin

				// 「承認」の場合
				$set_update_data = array();
				$set_update_data['pe_id']          = $flash_data['a_pe_id'];							// 案件申請ID
				$set_update_data['pe_status']      = $this->config->item('C_ENTRY_SYOUNIN_ID');			// 承認
				$set_update_data['pe_reason']      = $this->input->post('pe_reason');					// 非承認　理由
				$time = time();
				$set_update_data['pe_accept_date'] = date("Y-m-d H:i:s", $time);						// (非)承認日

				// UPDATE <- 'tb_project_entry'
				$this->pro->update_pro_entry($set_update_data);




				// 案件情報テーブルを新規作成 -> 案件IDを取得「pj_id」
				$get_pj_id = $this->pro->create_project($set_update_data['pe_id']);
				$tmp_pj_id = $get_pj_id[0]['LAST_INSERT_ID()'];

				// 案件個別情報 ＆ 投稿記事個別情報テーブルを新規作成 -> 案件個別ID ＆ 投稿記事個別IDを取得
				list($get_pji_id, $get_rep_id) = $this->pro->create_project_info($set_update_data['pe_id'], $tmp_pj_id);


				// トランザクション・COMMIT
				$this->db->trans_complete();									// trans_rollback & trans_commit
				if ($this->db->trans_status() === FALSE)
				{
					log_message('error', 'ADMIN::[data_entry()]案件承認処理 トランザクションエラー');
				} else {
					// ステータス変更で確認メールを送信
					$this->_mail_send($flash_data['a_pe_id'], '承認');
				}

			} else {
				// 「非承認」の場合
				$set_update_data = array();
				$set_update_data['pe_id']          = $flash_data['a_pe_id'];							// 案件申請ID
				$set_update_data['pe_status']      = $this->config->item('C_ENTRY_HISYOUNIN_ID');		// 非承認
				$set_update_data['pe_reason']      = $this->input->post('pe_reason');					// 非承認　理由
				$time = time();
				$set_update_data['pe_accept_date'] = date("Y-m-d H:i:s", $time);						// (非)承認日

				// UPDATE
				$result = $this->pro->update_pro_entry($set_update_data);

				// ステータス変更で確認メールを送信
				$this->_mail_send($flash_data['a_pe_id'], '非承認');

			}
		}

		// session:フラッシュデータに案件申請ID書き込み
		//$this->smarty->assign('flashdata_peid', $flash_data['a_pe_id']);

		redirect('/entrylist/');
		//$this->view('admin/entrylist/index.tpl');

		//$this->smarty->assign('entry_info', $this->input->post());
		//$this->smarty->assign('entry_info', $this->input->post());
		//$this->smarty->assign('entry_no', $tmp_entry_no);
		//$this->view('admin/entrylist/detail.tpl');

	}

	// ステータス変更で確認メールを送信
	private function _mail_send($get_pe_id, $accept = NULL)
	{

		// メール送信先クライアントの会社名＆メールアドレスを取得
		$get_client_info = $this->pro->get_client_name($get_pe_id);

		// メール送信先設定
		$mail['from']      = "";
		$mail['from_name'] = "";
		$mail['subject']   = "";
		$mail['to']        = $get_client_info[0]['cl_email'];
		$mail['cc']        = "";
		$mail['bcc']       = "";

		// メール本文置き換え文字設定
		$arrRepList = array(
				'cl_company'     => $get_client_info[0]['cl_company'],
				'cl_person01'    => $get_client_info[0]['cl_person01'],
				'cl_person02'    => $get_client_info[0]['cl_person02'],
				'pe_id'          => $get_pe_id,
				'pe_entry_title' => $get_client_info[0]['pe_entry_title'],
				'accept'         => $accept,
		);

		// メールテンプレートの読み込み
		$this->config->load('config_mailtpl');								// メールテンプレート情報読み込み
		$mail_tpl = $this->config->item('MAILTPL_AD_EL_ACCEPT_ID');

		// メール送信
		$this->load->model('Mailtpl', 'mailtpl', TRUE);
		$this->mailtpl->getMailTpl($mail, $arrRepList, $mail_tpl);

	}

	// Pagination 設定
	private function _get_Pagination($entry_countall, $tmp_per_page)
	{

		$config['base_url']       = base_url() . '/entrylist/search/';		// ページの基本URIパス。「/コントローラクラス/アクションメソッド/」
		$config['per_page']       = $tmp_per_page;							// 1ページ当たりの表示件数。
		$config['total_rows']     = $entry_countall;						// 総件数。where指定するか？
		$config['uri_segment']    = 4;										// オフセット値がURIパスの何セグメント目とするか設定
		$config['num_links']      = 5;										//現在のページ番号の左右にいくつのページ番号リンクを生成するか設定
		$config['full_tag_open']  = '<p class="pagination">';				// ページネーションリンク全体を階層化するHTMLタグの先頭タグ文字列を指定
		$config['full_tag_close'] = '</p>';									// ページネーションリンク全体を階層化するHTMLタグの閉じタグ文字列を指定
		$config['first_link']     = '最初へ';								// 最初のページを表すテキスト。
		$config['last_link']      = '最後へ';								// 最後のページを表すテキスト。
		$config['prev_link']      = '前へ';									// 前のページへのリンクを表わす文字列を指定
		$config['next_link']      = '次へ';									// 次のページへのリンクを表わす文字列を指定

		$this->load->library('pagination', $config);						// Paginationクラス読み込み
		$set_page['page_link'] = $this->pagination->create_links();

		return $set_page;

	}

	// 検索項目 初期値セット
	private function _search_set()
	{

		// ステータス状態 選択項目セット
		$this->config->load('config_status');
		$arroptions_pestatus = array (
				''  => '選択してください',
				'1' => $this->config->item('C_ENTRY_SHINSEI'),
				'3' => $this->config->item('C_ENTRY_HISYOUNIN'),
		);

		// ジャンル 選択項目セット
		$this->load->model('comm_genre', 'gr', TRUE);
		$genre_list = $this->gr->get_genre();

		// 案件申請ID 並び替え選択項目セット
		$arroptions_id = array (
				''     => '選択してください',
				'DESC' => '降順',
				'ASC'  => '昇順',
		);

		// ステータス状態 並び替え選択項目セット
		$arroptions_status = array (
				''     => '選択してください',
				'DESC' => '降順',
				'ASC'  => '昇順',
		);

		$this->smarty->assign('options_pe_status',   $arroptions_pestatus);
		$this->smarty->assign('options_genre_list',  $genre_list);
		$this->smarty->assign('options_orderid',     $arroptions_id);
		$this->smarty->assign('options_orderstatus', $arroptions_status);

	}

	// 各項目 初期値セット :: 申請内容
	private function _form_item_set00()
	{

		// ステータス状態 選択項目セット
		$this->config->load('config_status');
		$arroptions_entrystatus = array (
				//'0' => $this->config->item('C_ENTRY_JYUNBI'),
				//'1' => $this->config->item('C_ENTRY_SHINSEI'),
				'2' => $this->config->item('C_ENTRY_SYOUNIN'),
				'3' => $this->config->item('C_ENTRY_HISYOUNIN'),
				//'4' => $this->config->item('C_ENTRY_CANSEL'),
				//'5' => $this->config->item('C_ENTRY_DELETE'),
		);

		// ジャンル 選択項目セット
		$this->load->model('comm_genre', 'gr', TRUE);
		$genre_list = $this->gr->get_genre();

		$this->smarty->assign('options_entry_status', $arroptions_entrystatus);
		$this->smarty->assign('options_genre_list',   $genre_list);




		// レコード作成後に、格納データを表示するために必要
		//$set_val['pe_entry_title']   = '';
		//$set_val['pe_title']         = '';
		//$set_val['pe_work']          = '';
		//$set_val['pe_notice']        = '';
		//$set_val['pe_example']       = '';
		//$set_val['pe_other']         = '';
		//$set_val['pe_addwork']       = '';
		//$set_val['pe_word_tanka']    = '0.0';
		//$set_val['pe_open_date']     = '';
		//$set_val['pe_delivery_date'] = '';
		//$set_val['pe_comment']       = '';

		//$this->smarty->assign('set_val',   $set_val);

	}

	// 各項目 初期値セット :: 申請案件2 and 3
	private function _form_item_set01($pe_id)
	{
		// ステータス：使用有無選択項目セット
		$arroptions_pei_status = array (
				'0' => '使用しない',
				'1' => '使用する',
		);

		// レコード作成後に、格納データを表示するために必要
		$set_val['pei_pe_id']       = $pe_id;
		$set_val['pei_status']      = 0;

		for ($i = 1; $i <= 5; $i++ )
		{
			$item = 'pei_t_keyword' . sprintf("%'.02d", $i);
			$set_val[$item]    = '';
			$item = 'pei_t_count_min' . sprintf("%'.02d", $i);
			$set_val[$item]    = '';
			$item = 'pei_t_count_max' . sprintf("%'.02d", $i);
			$set_val[$item]    = '';
		}
		$set_val['pei_t_char_min']  = '';
		$set_val['pei_t_char_max']  = '';

		for ($i = 1; $i <= 10; $i++ )
		{
			$item = 'pei_b_word' . sprintf("%'.02d", $i);
			$set_val[$item]    = '';
			$item = 'pei_b_count_min' . sprintf("%'.02d", $i);
			$set_val[$item]    = '';
			$item = 'pei_b_count_max' . sprintf("%'.02d", $i);
			$set_val[$item]    = '';
		}
		$set_val['pei_b_char_min']  = '';
		$set_val['pei_b_char_max']  = '';

		$set_val['pei_work']        = '';
		$set_val['pei_notice']      = '';
		$set_val['pei_example']     = '';
		$set_val['pei_other']       = '';
		$set_val['pei_addwork']     = '';
		$set_val['pei_comment']     = '';

		$this->smarty->assign('options_pei_status', $arroptions_pei_status);
		$this->smarty->assign('entry_info',         $set_val);

	}

	// フォーム・バリデーションチェック
	private function _set_validation()
	{

		$rule_set = array(
				array(
						'field'   => 'pe_entry_title',
						'label'   => '申請案件タイトル',
						'rules'   => 'trim|max_length[100]'
				),
				array(
						'field'   => 'pe_id',
						'label'   => '案件申請ID',
						'rules'   => 'trim|numeric'
				),
				array(
						'field'   => 'pe_cl_id',
						'label'   => 'クライアントID',
						'rules'   => 'trim|numeric'
				),
				array(
						'field'   => 'pe_genre01',
						'label'   => 'ジャンル',
						'rules'   => 'trim|numeric'
				),
				array(
						'field'   => 'pe_status',
						'label'   => 'ステータス',
						'rules'   => 'trim|numeric'
				),
		);

		$this->load->library('form_validation', $rule_set);							// バリデーションクラス読み込み

	}


	// フォーム・バリデーションチェック:案件内容
	private function _set_validation00()
	{

		$rule_set = array(
				//array(
				//		'field'   => 'pe_status',
				//		'label'   => 'ステータス (状態)',
				//		'rules'   => 'trim|required'
				//),
				//array(
				//		'field'   => 'pe_entry_title',
				//		'label'   => 'タイトル（表示件名）',
				//		'rules'   => 'trim|required|max_length[100]'
				//),
				//array(
				//		'field'   => 'pe_genre01',
				//		'label'   => '希望ジャンル',
				//		'rules'   => 'trim|required'
				//),
				//array(
				//		'field'   => 'pe_title',
				//		'label'   => '案件申請：タイトル',
				//		'rules'   => 'trim|required|max_length[100]'
				//),
				//array(
				//		'field'   => 'pe_work',
				//		'label'   => '案件申請：概要',
				//		'rules'   => 'trim|required|max_length[10000]'
				//),
				//array(
				//		'field'   => 'pe_notice',
				//		'label'   => '案件申請：注意事項',
				//		'rules'   => 'trim|max_length[10000]'
				//),
				//array(
				//		'field'   => 'pe_example',
				//		'label'   => '案件申請：例文',
				//		'rules'   => 'trim|max_length[10000]'
				//),
				//array(
				//		'field'   => 'pe_other',
				//		'label'   => '案件申請：その他',
				//		'rules'   => 'trim|max_length[10000]'
				//),
				//array(
				//		'field'   => 'pe_addwork',
				//		'label'   => '案件申請：追加内容',
				//		'rules'   => 'trim|max_length[10000]'
				//),
				//array(
				//		'field'   => 'pe_word_tanka',
				//		'label'   => '個別文字単価指定',
				//		'rules'   => 'trim|decimal|max_length[4]'
				//),
				//array(
				//		'field'   => 'pe_open_date',
				//		'label'   => '案件希望公開日',
				//		'rules'   => 'trim|required|regex_match[/^\d{4}-\d{1,2}-\d{1,2}+$/]|max_length[10]'
				//),
				//array(
				//		'field'   => 'pe_delivery_date',
				//		'label'   => '案件希望納期',
				//		'rules'   => 'trim|required|regex_match[/^\d{4}-\d{1,2}-\d{1,2}+$/]|max_length[10]'
				//),
				//array(
				//		'field'   => 'pe_comment',
				//		'label'   => '備考',
				//		'rules'   => 'trim|max_length[2000]'
				//),
				array(
						'field'   => 'pe_reason',
						'label'   => '非承認　理由',
						'rules'   => 'trim|max_length[2000]'
				),

		);

		$this->load->library('form_validation', $rule_set);							// バリデーションクラス読み込み

	}

	// フォーム・バリデーションチェック::申請案件１～３
	private function _set_validation01()
	{

		$rule_set = array(
		//		array(
		//				'field'   => 'pei_status',
		//				'label'   => '使用有無設定',
		//				'rules'   => ''
		//		),
        //
		//		array(
		//				'field'   => 'pei_t_keyword01',
		//				'label'   => 'タイトル：必須ワード指定',
		//				'rules'   => 'trim|max_length[100]'
		//		),
		//		array(
		//				'field'   => 'pei_t_keyword02',
		//				'label'   => 'タイトル：必須ワード指定',
		//				'rules'   => 'trim|max_length[100]'
		//		),
		//		array(
		//				'field'   => 'pei_t_keyword03',
		//				'label'   => 'タイトル：必須ワード指定',
		//				'rules'   => 'trim|max_length[100]'
		//		),
		//		array(
		//				'field'   => 'pei_t_count_min01',
		//				'label'   => 'タイトル：最低 使用回数',
		//				'rules'   => 'trim|max_length[10]'
		//		),
		//		array(
		//				'field'   => 'pei_t_count_min02',
		//				'label'   => 'タイトル：最低 使用回数',
		//				'rules'   => 'trim|max_length[10]'
		//		),
		//		array(
		//				'field'   => 'pei_t_count_min03',
		//				'label'   => 'タイトル：最低 使用回数',
		//				'rules'   => 'trim|max_length[10]'
		//		),
		//		array(
		//				'field'   => 'pei_t_count_max01',
		//				'label'   => 'タイトル：最大 使用回数',
		//				'rules'   => 'trim|max_length[10]'
		//		),
		//		array(
		//				'field'   => 'pei_t_count_max02',
		//				'label'   => 'タイトル：最大 使用回数',
		//				'rules'   => 'trim|max_length[10]'
		//		),
		//		array(
		//				'field'   => 'pei_t_count_max03',
		//				'label'   => 'タイトル：最大 使用回数',
		//				'rules'   => 'trim|max_length[10]'
		//		),
		//		array(
		//				'field'   => 'pei_t_char_min',
		//				'label'   => 'タイトル：最低 使用文字数',
		//				'rules'   => 'trim|max_length[10000]'
		//		),
		//		array(
		//				'field'   => 'pei_t_char_max',
		//				'label'   => 'タイトル：最大 使用文字数',
		//				'rules'   => 'trim|max_length[10000]'
		//		),
        //
		//		array(
		//				'field'   => 'pei_b_word01',
		//				'label'   => '本文：必須ワード指定',
		//				'rules'   => 'trim|max_length[10]'
		//		),
		//		array(
		//				'field'   => 'pei_b_word02',
		//				'label'   => '本文：必須ワード指定',
		//				'rules'   => 'trim|max_length[10]'
		//		),
		//		array(
		//				'field'   => 'pei_b_word03',
		//				'label'   => '本文：必須ワード指定',
		//				'rules'   => 'trim|max_length[10]'
		//		),
		//		array(
		//				'field'   => 'pei_b_word04',
		//				'label'   => '本文：必須ワード指定',
		//				'rules'   => 'trim|max_length[10]'
		//		),
		//		array(
		//				'field'   => 'pei_b_word05',
		//				'label'   => '本文：必須ワード指定',
		//				'rules'   => 'trim|max_length[10]'
		//		),
		//		array(
		//				'field'   => 'pei_b_count_min01',
		//				'label'   => 'タイトル：最低 使用回数',
		//				'rules'   => 'trim|max_length[10]'
		//		),
		//		array(
		//				'field'   => 'pei_b_count_min02',
		//				'label'   => 'タイトル：最低 使用回数',
		//				'rules'   => 'trim|max_length[10]'
		//		),
		//		array(
		//				'field'   => 'pei_b_count_min03',
		//				'label'   => 'タイトル：最低 使用回数',
		//				'rules'   => 'trim|max_length[10]'
		//		),
		//		array(
		//				'field'   => 'pei_b_count_min04',
		//				'label'   => 'タイトル：最低 使用回数',
		//				'rules'   => 'trim|max_length[10]'
		//		),
		//		array(
		//				'field'   => 'pei_b_count_min05',
		//				'label'   => 'タイトル：最低 使用回数',
		//				'rules'   => 'trim|max_length[10]'
		//		),
		//		array(
		//				'field'   => 'pei_b_count_max01',
		//				'label'   => 'タイトル：最大 使用回数',
		//				'rules'   => 'trim|max_length[10]'
		//		),
		//		array(
		//				'field'   => 'pei_b_count_max02',
		//				'label'   => 'タイトル：最大 使用回数',
		//				'rules'   => 'trim|max_length[10]'
		//		),
		//		array(
		//				'field'   => 'pei_b_count_max03',
		//				'label'   => 'タイトル：最大 使用回数',
		//				'rules'   => 'trim|max_length[10]'
		//		),
		//		array(
		//				'field'   => 'pei_b_count_max04',
		//				'label'   => 'タイトル：最大 使用回数',
		//				'rules'   => 'trim|max_length[10]'
		//		),
		//		array(
		//				'field'   => 'pei_b_count_max05',
		//				'label'   => 'タイトル：最大 使用回数',
		//				'rules'   => 'trim|max_length[10]'
		//		),
		//		array(
		//				'field'   => 'pei_b_char_min',
		//				'label'   => 'タイトル：最低 使用文字数',
		//				'rules'   => 'trim|max_length[10000]'
		//		),
		//		array(
		//				'field'   => 'pei_b_char_max',
		//				'label'   => 'タイトル：最大 使用文字数',
		//				'rules'   => 'trim|max_length[10000]'
		//		),
        //
		//		array(
		//				'field'   => 'pei_work',
		//				'label'   => '案件申請：概要',
		//				'rules'   => 'trim|required|max_length[10000]'
		//		),
		//		array(
		//				'field'   => 'pei_notice',
		//				'label'   => '案件申請：注意事項',
		//				'rules'   => 'trim|max_length[10000]'
		//		),
		//		array(
		//				'field'   => 'pei_example',
		//				'label'   => '案件申請：例文',
		//				'rules'   => 'trim|max_length[10000]'
		//		),
		//		array(
		//				'field'   => 'pei_other',
		//				'label'   => '案件申請：その他',
		//				'rules'   => 'trim|max_length[10000]'
		//		),
		//		array(
		//				'field'   => 'pei_addwork',
		//				'label'   => '案件申請：追加内容',
		//				'rules'   => 'trim|max_length[10000]'
		//		),
        //
		);
		//
		$this->load->library('form_validation', $rule_set);							// バリデーションクラス読み込み

	}








}
