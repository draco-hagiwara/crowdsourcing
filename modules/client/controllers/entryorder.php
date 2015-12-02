<?php

class Entryorder extends MY_Controller
{

	public function __construct()
	{

		parent::__construct();

		if ($this->session->userdata('c_login') == TRUE)
		{
			$this->smarty->assign('login_chk', TRUE);
			//$this->smarty->assign('login_mem', 'client');
			$this->smarty->assign('login_name', $this->session->userdata('c_memNAME'));
		} else {
			$this->smarty->assign('login_chk', FALSE);
			//$this->smarty->assign('login_mem', '');

			//$this->load->helper('url');
			redirect('/login/');
		}

		// セッション::フラッシュデータ(案件申請ID)書き込み
		if (!$this->session->userdata('c_pe_id')) {
			$flash_data['c_pe_id'] = '';
			$this->session->set_userdata($flash_data);
			$this->smarty->assign('flashdata_peid', $flash_data['c_pe_id']);
		}

	}

	// 申請内容TOP
	public function index()
	{

		// セッション::案件申請IDをクリア：：URIセグメントの取得
		//   href="/client/entryorder/index/0/" で取得
		$segments = $this->uri->segment_array();
		if ((isset($segments[3])) && $segments[3] == 0)
		{

//			// セッションデータをクリア
//			$this->load->model('comm_auth', 'comm_auth', TRUE);
//			$this->comm_auth->delete_session('client');


			$flash_data['c_pe_id'] = '';
			$this->session->set_userdata($flash_data);
		}

		// SELECT項目 初期値セット
		$this->_search_set();

		// セッションからフラッシュデータ読み込み
		$flash_data['c_pe_id'] = $this->session->userdata('c_pe_id');


		print("flash_data00 == ");
		print_r($flash_data['c_pe_id']);
		print("<br><br>");


		if (empty($flash_data['c_pe_id']))
		{
			// 各項目 初期値セット
			$this->_form_item_set00();
		} else {

			// 案内申請情報の取得
			$this->load->model('Project_entry', 'pro', TRUE);				// models 読み込み
			$get_data = $this->pro->get_entry($flash_data['c_pe_id']);

			$get_data[0]['pe_open_date']     = date('Y-m-d', strtotime($get_data[0]['pe_open_date']));
			$get_data[0]['pe_delivery_date'] = date('Y-m-d', strtotime($get_data[0]['pe_delivery_date']));

			$this->smarty->assign('set_val', $get_data[0]);

		}

		// session:フラッシュデータに案件申請ID書き込み
		$this->session->set_userdata($flash_data);
		$this->smarty->assign('flashdata_peid', $flash_data['c_pe_id']);

		// バリデーション・チェック
		$this->_set_validation01();											// バリデーション設定
		$this->form_validation->run();

		$this->smarty->assign('entry_no', '00');

		$this->view('client/entryorder/index.tpl');

	}

	// 申請案件１
	public function entry01()
	{

		// SELECT項目 初期値セット
		$this->_search_set();

		// セッションからフラッシュデータ読み込み
		$flash_data['c_pe_id'] = $this->session->userdata('c_pe_id');


		//print("flash_data01 == ");
		//print_r($flash_data['pe_id']);
		//print("<br><br>");



		if (empty($flash_data['c_pe_id']))
		{
			// 各項目 初期値セット
			$this->_form_item_set01();
		} else {

			// 案内申請情報の取得
			$this->load->model('Project_entry', 'pro', TRUE);				// models 読み込み
			$get_data = $this->pro->get_entry_info($flash_data['c_pe_id'], $pei_seq = 0);

			$this->smarty->assign('set_val', $get_data[0]);

		}

		// session:フラッシュデータに案件申請ID書き込み
		$this->session->set_userdata($flash_data);
		$this->smarty->assign('flashdata_peid', $flash_data['c_pe_id']);

		// バリデーション・チェック
		$this->_set_validation01();											// バリデーション設定
		$this->form_validation->run();

		$this->smarty->assign('entry_no', '01');

		$this->view('client/entryorder/index.tpl');

	}

	// 申請案件２
	public function entry02()
	{

		// SELECT項目 初期値セット
		$this->_search_set();

		// セッションからフラッシュデータ読み込み
		$flash_data['c_pe_id'] = $this->session->userdata('c_pe_id');


		//print("flash_data02 == ");
		//print_r($flash_data['pe_id']);
		//print("<br><br>");



		if (empty($flash_data['c_pe_id']))
		{
			// 各項目 初期値セット
			$this->_form_item_set01();
		} else {

			// 案内申請情報の取得
			$this->load->model('Project_entry', 'pro', TRUE);				// models 読み込み
			$get_data = $this->pro->get_entry_info($flash_data['c_pe_id'], $pei_seq = 1);

			if (empty($get_data[0]))
			{
				$this->_form_item_set01();
			} else {
				$this->smarty->assign('set_val', $get_data[0]);
			}

		}

		// session:フラッシュデータに案件申請ID書き込み
		$this->session->set_userdata($flash_data);
		$this->smarty->assign('flashdata_peid', $flash_data['c_pe_id']);

		// バリデーション・チェック
		$this->_set_validation01();											// バリデーション設定
		$this->form_validation->run();

		$this->smarty->assign('entry_no', '02');

		$this->view('client/entryorder/index.tpl');

	}

	// 申請案件３
	public function entry03()
	{

		// SELECT項目 初期値セット
		$this->_search_set();

		// セッションからフラッシュデータ読み込み
		$flash_data['c_pe_id'] = $this->session->userdata('c_pe_id');


		//print("flash_data03 == ");
		//print_r($flash_data['pe_id']);
		//print("<br><br>");



		if (empty($flash_data['c_pe_id']))
		{
			// 各項目 初期値セット
			$this->_form_item_set01();
		} else {

			// 案内申請情報の取得
			$this->load->model('Project_entry', 'pro', TRUE);				// models 読み込み
			$get_data = $this->pro->get_entry_info($flash_data['c_pe_id'], $pei_seq = 2);

			if (empty($get_data[0]))
			{
				$this->_form_item_set01();
			} else {
				$this->smarty->assign('set_val', $get_data[0]);
			}
		}

		// session:フラッシュデータに案件申請ID書き込み
		$this->session->set_userdata($flash_data);
		$this->smarty->assign('flashdata_peid', $flash_data['c_pe_id']);

		// バリデーション・チェック
		$this->_set_validation01();											// バリデーション設定
		$this->form_validation->run();

		$this->smarty->assign('entry_no', '03');

		$this->view('client/entryorder/index.tpl');

	}

	// 案件申請データ作成
	public function data_entry()
	{

		// 「新規作成」ボタン押下時
		if ($this->input->post('submit') == '_new')
		{

			redirect('/entryorder/index/0/');

			// 初期値セット
			$this->_search_set();
			$this->smarty->assign('entry_no', '00');

			$this->view('client/entryorder/index.tpl');

			return;
		}

		// セッションからフラッシュデータ読み込み
		$flash_data['c_pe_id'] = $this->session->userdata('c_pe_id');


		//print("flash_data_entry == ");
		//print_r($flash_data['pe_id']);
		//print("<br><br>");




		// SELECT項目 初期値セット
		$this->_search_set();

		// バリデーション・チェック::TAB毎に処理振り分け
		if ($this->input->post('entry_no') == '00')
		{
			$this->_set_validation();
		} else {
			$this->_set_validation01();
		}

		if ($this->form_validation->run() == FALSE)
		{
			// 各項目 初期値セット
			$this->_form_item_set00();

			// session:フラッシュデータに案件申請ID書き込み
			//$this->session->set_flashdata($flash_data);
		} else {

			$this->load->model('Project_entry', 'pro', TRUE);					// models 読み込み

			// フラッシュデータの「案件申請ID」チェック
			if (empty($flash_data['c_pe_id']))
			{

				// 新規にレコード作成::「tb_project_entry」
				$set_insert_data = $this->input->post();

				$set_insert_data['pe_cl_id'] = $this->session->userdata('c_memID');							// クライアントID
				$set_insert_data['pe_word_tanka'] = sprintf('%0.1f', $this->input->post('pe_word_tanka'));	// DECIMAL形式対策
				$date = $this->input->post('pe_open_date');
				$set_insert_data['pe_open_date'] = date('Y-m-d', strtotime($date));							// 日付け形式
				$date = $this->input->post('pe_delivery_date');
				$set_insert_data['pe_delivery_date'] = date('Y-m-d', strtotime($date));						// 日付け形式

				unset($set_insert_data["entry_no"]) ;
				unset($set_insert_data["submit"]) ;

				// INSERT
				$get_pe_id = $this->pro->insert_pro_entry($set_insert_data);	// insert & 直前のIDを取得
				$tmp_pe_id = $get_pe_id[0]['LAST_INSERT_ID()'];

				// 新規にレコード作成::「tb_project_entry_info」
				$set_insert_data = array();
				$set_insert_data['pei_pe_id']    = $tmp_pe_id;												// 案件申請ID
				$set_insert_data['pei_pe_cl_id'] = $this->session->userdata('c_memID');						// クライアントID
				$set_insert_data['pei_seq']      = 0;														// 枝番：初期デフォルト=0
				$set_insert_data['pei_status']   = 1;														// 使用有無ステータス

				// INSERT
				$result = $this->pro->insert_pro_entryinfo($set_insert_data);

				// session:フラッシュデータに案件申請ID書き込み
				$flash_data['c_pe_id'] = $tmp_pe_id;
				//$this->session->set_flashdata($flash_data);

				// 各項目 初期値セット
				$this->_form_item_set00();

			} else {

				// レコード更新
				$set_update_data = array();
				$set_update_data = $this->input->post();
				$set_entryno     = $set_update_data['entry_no'];

				if ($set_entryno == '00')
				{
					$set_update_data['pe_id']        = $flash_data['c_pe_id'];								// 案件申請ID
					$set_update_data['pe_cl_id']     = $this->session->userdata('c_memID');					// クライアントID

					unset($set_update_data["entry_no"]) ;
					unset($set_update_data["submit"]) ;

					// UPDATE
					$result = $this->pro->update_pro_entry($set_update_data);

					// 各項目 初期値セット
					$this->_form_item_set00();

				} else {
					$set_update_data['pei_pe_id']    = $flash_data['c_pe_id'];								// 案件申請ID
					$set_update_data['pei_pe_cl_id'] = $this->session->userdata('c_memID');					// クライアントID

					foreach ($set_update_data as $key => $val)
					{
						if ($set_update_data[$key] == '')
						{
							unset($set_update_data[$key]) ;
						}
					}
					unset($set_update_data["entry_no"]) ;
					unset($set_update_data["submit"]) ;

					// UPDATE
					$result = $this->pro->update_pro_entryinfo($set_entryno, $set_update_data);

					// 各項目 初期値セット
					$this->_form_item_set01();

				}
			}

			// ステータス変更で確認メールを送信
			// とりあえずここでは、ステータス(準備中)変更はさせない！

		}

		// session:フラッシュデータに案件申請ID書き込み
		$this->session->set_userdata($flash_data);
		$this->smarty->assign('flashdata_peid', $flash_data['c_pe_id']);

		$this->smarty->assign('entry_no', $this->input->post('entry_no'));
		$this->view('client/entryorder/index.tpl');

	}

















	// SELECTボックス 初期値セット
	private function _search_set()
	{

		// ステータス状態 選択項目セット
		$this->config->load('config_status');
		$arroptions_entrystatus = array (
				'0' => $this->config->item('C_ENTRY_JYUNBI'),
				//'1' => $this->config->item('C_ENTRY_SHINSEI'),
				//'2' => $this->config->item('C_ENTRY_SYOUNIN'),
				//'3' => $this->config->item('C_ENTRY_HISYOUNIN'),
				//'4' => $this->config->item('C_ENTRY_CANSEL'),
				//'5' => $this->config->item('C_ENTRY_DELETE'),
		);

		// ジャンル 選択項目セット
		$this->load->model('comm_select', 'select', TRUE);
		$genre_list = $this->select->get_genre();

		// ライターID 並び替え選択項目セット
		$arroptions_pei_status = array (
				'0' => '使用しない',
				'1' => '使用する',
		);

		$this->smarty->assign('options_entry_status', $arroptions_entrystatus);
		$this->smarty->assign('options_genre_list',   $genre_list);
		$this->smarty->assign('options_pei_status',   $arroptions_pei_status);

	}

	// 各項目 初期値セット :  申請内容
	private function _form_item_set00()
	{

		// レコード作成後に、格納データを表示するために必要
		$set_val['pe_entry_title']   = '';
		$set_val['pe_title']         = '';
		$set_val['pe_work']          = '';
		$set_val['pe_notice']        = '';
		$set_val['pe_example']       = '';
		$set_val['pe_other']         = '';
		$set_val['pe_addwork']       = '';
		$set_val['pe_word_tanka']    = '0.0';
		$set_val['pe_open_date']     = date('Y-m-d');
		$set_val['pe_delivery_date'] = date('Y-m-d', strtotime('+1 month'));
		$set_val['pe_comment']       = '';

		$this->smarty->assign('set_val',   $set_val);

	}

	// 各項目 初期値セット :: 申請案件1～3
	private function _form_item_set01()
	{

		// レコード作成後に、格納データを表示するために必要
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

		$set_val['pei_work']    = '';
		$set_val['pei_notice']  = '';
		$set_val['pei_example'] = '';
		$set_val['pei_other']   = '';
		$set_val['pei_addwork'] = '';
		$set_val['pei_comment'] = '';

		$this->smarty->assign('set_val',   $set_val);

	}

	// フォーム・バリデーションチェック
	private function _set_validation()
	{

		$rule_set = array(
				array(
						'field'   => 'pe_status',
						'label'   => 'ステータス (状態)',
						'rules'   => 'trim|required'
				),
				array(
						'field'   => 'pe_entry_title',
						'label'   => 'タイトル（表示件名）',
						'rules'   => 'trim|required|max_length[100]'
				),
				array(
						'field'   => 'pe_genre01',
						'label'   => '希望ジャンル',
						'rules'   => 'trim|required'
				),
				array(
						'field'   => 'pe_title',
						'label'   => '案件申請：タイトル',
						'rules'   => 'trim|required|max_length[100]'
				),
				array(
						'field'   => 'pe_work',
						'label'   => '案件申請：概要',
						'rules'   => 'trim|required|max_length[10000]'
				),
				array(
						'field'   => 'pe_notice',
						'label'   => '案件申請：注意事項',
						'rules'   => 'trim|max_length[10000]'
				),
				array(
						'field'   => 'pe_example',
						'label'   => '案件申請：例文',
						'rules'   => 'trim|max_length[10000]'
				),
				array(
						'field'   => 'pe_other',
						'label'   => '案件申請：その他',
						'rules'   => 'trim|max_length[10000]'
				),
				array(
						'field'   => 'pe_addwork',
						'label'   => '案件申請：追加内容',
						'rules'   => 'trim|max_length[10000]'
				),
				array(
						'field'   => 'pe_word_tanka',
						'label'   => '個別文字単価指定',
						'rules'   => 'trim|decimal|max_length[4]'
				),
				array(
						'field'   => 'pe_open_date',
						'label'   => '案件希望公開日',
						'rules'   => 'trim|required|regex_match[/^\d{4}-\d{1,2}-\d{1,2}+$/]|max_length[10]'
				),
				array(
						'field'   => 'pe_delivery_date',
						'label'   => '案件希望納期',
						'rules'   => 'trim|required|regex_match[/^\d{4}-\d{1,2}-\d{1,2}+$/]|max_length[10]'
				),
				array(
						'field'   => 'pe_comment',
						'label'   => '備考',
						'rules'   => 'trim|max_length[2000]'
				),

		);

		$this->load->library('form_validation', $rule_set);							// バリデーションクラス読み込み

	}

	// フォーム・バリデーションチェック::申請案件１～３
	private function _set_validation01()
	{

		$rule_set = array(
				array(
						'field'   => 'pei_status',
						'label'   => '使用有無設定',
						'rules'   => ''
				),

				array(
						'field'   => 'pei_t_keyword01',
						'label'   => 'タイトル：必須ワード指定',
						'rules'   => 'trim|max_length[100]'
				),
				array(
						'field'   => 'pei_t_keyword02',
						'label'   => 'タイトル：必須ワード指定',
						'rules'   => 'trim|max_length[100]'
				),
				array(
						'field'   => 'pei_t_keyword03',
						'label'   => 'タイトル：必須ワード指定',
						'rules'   => 'trim|max_length[100]'
				),
				array(
						'field'   => 'pei_t_count_min01',
						'label'   => 'タイトル：最低 使用回数',
						'rules'   => 'trim|max_length[10]'
				),
				array(
						'field'   => 'pei_t_count_min02',
						'label'   => 'タイトル：最低 使用回数',
						'rules'   => 'trim|max_length[10]'
				),
				array(
						'field'   => 'pei_t_count_min03',
						'label'   => 'タイトル：最低 使用回数',
						'rules'   => 'trim|max_length[10]'
				),
				array(
						'field'   => 'pei_t_count_max01',
						'label'   => 'タイトル：最大 使用回数',
						'rules'   => 'trim|max_length[10]'
				),
				array(
						'field'   => 'pei_t_count_max02',
						'label'   => 'タイトル：最大 使用回数',
						'rules'   => 'trim|max_length[10]'
				),
				array(
						'field'   => 'pei_t_count_max03',
						'label'   => 'タイトル：最大 使用回数',
						'rules'   => 'trim|max_length[10]'
				),
				array(
						'field'   => 'pei_t_char_min',
						'label'   => 'タイトル：最低 使用文字数',
						'rules'   => 'trim|max_length[10000]'
				),
				array(
						'field'   => 'pei_t_char_max',
						'label'   => 'タイトル：最大 使用文字数',
						'rules'   => 'trim|max_length[10000]'
				),

				array(
						'field'   => 'pei_b_word01',
						'label'   => '本文：必須ワード指定',
						'rules'   => 'trim|max_length[10]'
				),
				array(
						'field'   => 'pei_b_word02',
						'label'   => '本文：必須ワード指定',
						'rules'   => 'trim|max_length[10]'
				),
				array(
						'field'   => 'pei_b_word03',
						'label'   => '本文：必須ワード指定',
						'rules'   => 'trim|max_length[10]'
				),
				array(
						'field'   => 'pei_b_word04',
						'label'   => '本文：必須ワード指定',
						'rules'   => 'trim|max_length[10]'
				),
				array(
						'field'   => 'pei_b_word05',
						'label'   => '本文：必須ワード指定',
						'rules'   => 'trim|max_length[10]'
				),
				array(
						'field'   => 'pei_b_count_min01',
						'label'   => 'タイトル：最低 使用回数',
						'rules'   => 'trim|max_length[10]'
				),
				array(
						'field'   => 'pei_b_count_min02',
						'label'   => 'タイトル：最低 使用回数',
						'rules'   => 'trim|max_length[10]'
				),
				array(
						'field'   => 'pei_b_count_min03',
						'label'   => 'タイトル：最低 使用回数',
						'rules'   => 'trim|max_length[10]'
				),
				array(
						'field'   => 'pei_b_count_min04',
						'label'   => 'タイトル：最低 使用回数',
						'rules'   => 'trim|max_length[10]'
				),
				array(
						'field'   => 'pei_b_count_min05',
						'label'   => 'タイトル：最低 使用回数',
						'rules'   => 'trim|max_length[10]'
				),
				array(
						'field'   => 'pei_b_count_max01',
						'label'   => 'タイトル：最大 使用回数',
						'rules'   => 'trim|max_length[10]'
				),
				array(
						'field'   => 'pei_b_count_max02',
						'label'   => 'タイトル：最大 使用回数',
						'rules'   => 'trim|max_length[10]'
				),
				array(
						'field'   => 'pei_b_count_max03',
						'label'   => 'タイトル：最大 使用回数',
						'rules'   => 'trim|max_length[10]'
				),
				array(
						'field'   => 'pei_b_count_max04',
						'label'   => 'タイトル：最大 使用回数',
						'rules'   => 'trim|max_length[10]'
				),
				array(
						'field'   => 'pei_b_count_max05',
						'label'   => 'タイトル：最大 使用回数',
						'rules'   => 'trim|max_length[10]'
				),
				array(
						'field'   => 'pei_b_char_min',
						'label'   => 'タイトル：最低 使用文字数',
						'rules'   => 'trim|max_length[10000]'
				),
				array(
						'field'   => 'pei_b_char_max',
						'label'   => 'タイトル：最大 使用文字数',
						'rules'   => 'trim|max_length[10000]'
				),

				array(
						'field'   => 'pei_work',
						'label'   => '案件申請：概要',
						'rules'   => 'trim|required|max_length[10000]'
				),
				array(
						'field'   => 'pei_notice',
						'label'   => '案件申請：注意事項',
						'rules'   => 'trim|max_length[10000]'
				),
				array(
						'field'   => 'pei_example',
						'label'   => '案件申請：例文',
						'rules'   => 'trim|max_length[10000]'
				),
				array(
						'field'   => 'pei_other',
						'label'   => '案件申請：その他',
						'rules'   => 'trim|max_length[10000]'
				),
				array(
						'field'   => 'pei_addwork',
						'label'   => '案件申請：追加内容',
						'rules'   => 'trim|max_length[10000]'
				),

		);

		$this->load->library('form_validation', $rule_set);							// バリデーションクラス読み込み

	}


}
