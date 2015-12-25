<?php

class Search_genre extends MY_Controller
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

	// 検索一覧TOP
	public function index()
	{

		// セッションデータをクリア
		$this->load->model('comm_auth', 'comm_auth', TRUE);
		$this->comm_auth->delete_session('writer');

		// バリデーション・チェック
		$this->_set_validation();											// バリデーション設定
		$this->form_validation->run();

		// 検索項目 初期値セット
		$this->_search_set();

		// 1ページ当たりの表示件数
		$this->config->load('config_comm');
		$tmp_per_page = $this->config->item('PAGINATION_PER_PAGE');

		// Pagination 現在ページ数の取得：：URIセグメントの取得
		$segments = $this->uri->segment_array();
		if (isset($segments[3]))
		{
			$tmp_offset = $segments[3];
		} else {
			$tmp_offset = 0;
		}

		// 案件情報のリスト＆件数を取得
		$this->load->model('Project', 'pj', TRUE);
		list($order_list, $order_countall) = $this->pj->get_orderlist($this->input->post(), $tmp_per_page, $tmp_offset);

		// 文字単価＆文字数 計算
		$this->load->model('Tanka', 'tanka', TRUE);
		$this->load->model('Report_info', 'rep', TRUE);
		$tmp_memrank = $this->session->userdata('w_memRANK');
		foreach ($order_list as $key => $val)
		{

			if ($val['pj_word_tanka'] > 0)
			{
				// 難易度単価の取得
				$tmp_diff_tanka = $this->tanka->get_difftanka($val['pj_en_cl_id'], $val['pj_taa_difficulty_id']);

				$order_list[$key]['word_tanka'] =  $val['pj_word_tanka'] +  $tmp_diff_tanka['taa_price'];
			} else {
				// 会員単価の取得
				$tmp_rank_tanka = $this->tanka->get_memtanka($val['pj_en_cl_id'], $tmp_memrank);

				// 難易度単価の取得
				$tmp_diff_tanka = $this->tanka->get_difftanka($val['pj_en_cl_id'], $val['pj_taa_difficulty_id']);

				$order_list[$key]['word_tanka'] =  $tmp_rank_tanka['ta_price'] +  $tmp_diff_tanka['taa_price'];
			}

			// 文字数の取得 (タイトル+本文の最小文字数)
			//$tmp_wordcnt = $this->rep->get_word_cnt($val['pj_id']);
			//$order_list[$key]['word_count'] = $tmp_wordcnt['SUM(rep_t_char_min)'] + $tmp_wordcnt['SUM(rep_b_char_min)'];

		}

		// Pagination 設定
		$set_pagination = $this->_get_Pagination($order_countall, $tmp_per_page);

		$this->smarty->assign('order_list',     $order_list);

		$this->smarty->assign('set_pagination', $set_pagination['page_link']);
		$this->smarty->assign('countall',       $order_countall);
		$this->smarty->assign('serch_item',     $this->input->post());

		$this->view('writer/search_genre/index.tpl');

	}

	// 一覧表示
	public function search()
	{

		// 検索項目の保存が上手くいかない。応急的に対応！
		// 検索項目=「pj_order_title」「pj_title」「pj_work」「pj_genre01」
		$tmp_inputpost = array();
		if ($this->input->post('submit') == '_submit')
		{
			// セッションをフラッシュデータとして保存
			$data = array(
					'w_pj_order_title' => $this->input->post('pj_order_title'),
					'w_pj_genre01'     => $this->input->post('pj_genre01'),
			);
			$this->session->set_userdata($data);

			$tmp_inputpost = $this->input->post();
			unset($tmp_inputpost["submit"]);

		} else {
			// セッションからフラッシュデータ読み込み
			$tmp_inputpost['pj_order_title'] = $this->session->userdata('w_pj_order_title');
			$tmp_inputpost['pj_genre01']     = $this->session->userdata('w_pj_genre01');
		}

		// バリデーション・チェック
		$this->_set_validation();											// バリデーション設定
		$this->form_validation->run();

		// Pagination 現在ページ数の取得：：URIセグメントの取得
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

		// 案件情報のリスト＆件数を取得
		$this->load->model('Project', 'pj', TRUE);
		list($order_list, $order_countall) = $this->pj->get_orderlist($tmp_inputpost, $tmp_per_page, $tmp_offset);

		// 文字単価 計算
		$this->load->model('Tanka', 'tanka', TRUE);
		$this->load->model('Report_info', 'rep', TRUE);
		$tmp_memrank = $this->session->userdata('w_memRANK');
		foreach ($order_list as $key => $val)
		{

			if ($val['pj_word_tanka'] > 0)
			{
				// 難易度単価の取得
				$tmp_diff_tanka = $this->tanka->get_difftanka($val['pj_en_cl_id'], $val['pj_taa_difficulty_id']);

				$order_list[$key]['word_tanka'] =  $val['pj_word_tanka'] +  $tmp_diff_tanka['taa_price'];
			} else {
				// 会員単価の取得
				$tmp_rank_tanka = $this->tanka->get_memtanka($val['pj_en_cl_id'], $tmp_memrank);

				// 難易度単価の取得
				$tmp_diff_tanka = $this->tanka->get_difftanka($val['pj_en_cl_id'], $val['pj_taa_difficulty_id']);

				$order_list[$key]['word_tanka'] =  $tmp_rank_tanka['ta_price'] +  $tmp_diff_tanka['taa_price'];
			}

		}

		// Pagination 設定
		$set_pagination = $this->_get_Pagination($order_countall, $tmp_per_page);

		// 検索項目 初期値セット
		$this->_search_set();

		$this->smarty->assign('order_list', $order_list);

		$this->smarty->assign('set_pagination', $set_pagination['page_link']);
		$this->smarty->assign('countall',       $order_countall);
		$this->smarty->assign('serch_item',     $tmp_inputpost);

		$this->view('writer/search_genre/index.tpl');

	}

	// 案件内容
	public function detail00($_res_mess=NULL)
	{

		// セッションからフラッシュデータ読み込み
		$flash_data['w_pj_id'] = $this->session->userdata('w_pj_id');

		// 案件内容データ 初期値セット
		$this->load->model('Project', 'pj', TRUE);

		// 案件ID取得
		$input_post = $this->input->post();
		if (empty($input_post['pjid_uniq']))
		{
			// ２回目以降
			$tmp_pjid = $flash_data['w_pj_id'];
		} else {
			// 初回
			$tmp_pjid = $input_post['pjid_uniq'];
		}
		$get_data = $this->pj->get_order($tmp_pjid);

		// 作業件数有無チェック(作業1～3)
		$this->_get_job_cnt($tmp_pjid);



		print("flash_data00 == ");
		print($tmp_pjid);
		print("<br><br>");




		// SELECT項目 初期値セット
		$this->_form_item_set00();


		//// ジャンル 選択項目セット
		//$this->load->model('comm_select', 'select', TRUE);
		//$genre_list = $this->select->get_genre();
		//$get_data[0]['genre01_name']     = $genre_list[$get_data[0]['pj_genre01']];

		//$get_data[0]['pj_delivery_time'] = date('Y-m-d H:i', strtotime($get_data[0]['pj_delivery_time']));
		$get_data[0]['pj_start_time']    = date('Y-m-d H:i', strtotime($get_data[0]['pj_start_time']));
		$get_data[0]['pj_end_time']      = date('Y-m-d H:i', strtotime($get_data[0]['pj_end_time']));

		// 個別会員単価を取得
		$this->load->model('Tanka', 'tanka', TRUE);
		$this->load->model('Report_info', 'rep', TRUE);
		$tmp_memrank = $this->session->userdata('w_memRANK');
		if ($get_data[0]['pj_word_tanka'] > 0)
		{
			// 難易度単価の取得
			$tmp_diff_tanka = $this->tanka->get_difftanka($get_data[0]['pj_en_cl_id'], $get_data[0]['pj_taa_difficulty_id']);

			$writer_tanka =  $get_data[0]['pj_word_tanka'] +  $tmp_diff_tanka['taa_price'];
		} else {
			// 会員単価の取得
			$tmp_rank_tanka = $this->tanka->get_memtanka($get_data[0]['pj_en_cl_id'], $tmp_memrank);

			// 難易度単価の取得
			$tmp_diff_tanka = $this->tanka->get_difftanka($get_data[0]['pj_en_cl_id'], $get_data[0]['pj_taa_difficulty_id']);

			$writer_tanka =  $tmp_rank_tanka['ta_price'] +  $tmp_diff_tanka['taa_price'];
		}

		$this->smarty->assign('order_info', $get_data[0]);
		$this->smarty->assign('writer_tanka', $writer_tanka);

		// 現在の会員ランク単価を取得
		$this->_get_member_tanka($get_data[0]['pj_en_cl_id']);
		//$this->load->model('tanka', 'ta', TRUE);
		//$tanka_list = $this->ta->get_tanka($get_data[0]['pj_en_cl_id']);
		//$tmp_tankainfo = "ブロンズ=" . $tanka_list[1]['ta_price'] . " 円、シルバー=" . $tanka_list[2]['ta_price'] . " 円、ゴールド=" . $tanka_list[3]['ta_price'] . " 円";
		//$this->smarty->assign('tanka_info', $tmp_tankainfo);

		// session:フラッシュデータに案件ID書き込み
		$tmp_flash_pjid = array('w_pj_id' => $get_data[0]['pj_id']);
		$this->session->set_userdata( $tmp_flash_pjid);

		// バリデーション設定
		$this->_set_validation00();

		$this->smarty->assign('not_disp', FALSE);
		$this->smarty->assign('order_no', '00');
		$this->smarty->assign('result_mess', $_res_mess);

		$this->view('writer/search_genre/detail.tpl');

	}

	// 案件１
	public function detail01()
	{

		// SELECT項目 初期値セット
		//$this->_search_set01();

		// セッションからフラッシュデータ読み込み＆書き込み
		$flash_data['w_pj_id'] = $this->session->userdata('w_pj_id');

		// 作業件数有無チェック(作業1～3)
		$this->load->model('Project', 'pj', TRUE);
		$this->_get_job_cnt($flash_data['w_pj_id']);



		print("flash_data01 == ");
		print_r($flash_data['w_pj_id']);
		print("<br><br>");


		// 案件データ 初期値セット
		$this->load->model('Project', 'pj', TRUE);							// models 読み込み
		$get_data = $this->pj->get_order_info($flash_data['w_pj_id'], $pji_seq = 0);

		$this->smarty->assign('order_info', $get_data[0]);

		// バリデーション・チェック
		$this->_set_validation01();											// バリデーション設定
		//$this->form_validation->run();

		$this->smarty->assign('not_disp', FALSE);
		$this->smarty->assign('order_no', '01');
		$this->view('writer/search_genre/detail.tpl');

	}

	// 申請案件２
	public function detail02()
	{

		// セッションからフラッシュデータ読み込み＆書き込み
		$flash_data['w_pj_id'] = $this->session->userdata('w_pj_id');
		//$this->session->set_flashdata( $flash_data);

		// 作業件数有無チェック(作業1～3)
		$this->load->model('Project', 'pj', TRUE);
		$this->_get_job_cnt($flash_data['w_pj_id']);


		print("flash_data02 == ");
		print_r($flash_data['w_pj_id']);
		print("<br><br>");


		// 申請案件データ 初期値セット
		$this->load->model('Project', 'pj', TRUE);							// models 読み込み
		$get_data = $this->pj->get_order_info($flash_data['w_pj_id'], $pji_seq = 1);
		if (empty($get_data))
		{
			// 表示なし
			$this->smarty->assign('not_disp', TRUE);
		} else {
			// 各項目 初期値セット
			$this->_form_item_set01($flash_data['w_pj_id']);
			$this->smarty->assign('order_info', $get_data[0]);
			$this->smarty->assign('not_disp', FALSE);
		}

		// バリデーション・チェック
		$this->_set_validation01();											// バリデーション設定
		//$this->form_validation->run();

		$this->smarty->assign('order_no', '02');
		$this->view('writer/search_genre/detail.tpl');

	}

	// 申請案件３
	public function detail03()
	{

		// セッションからフラッシュデータ読み込み＆書き込み
		$flash_data['w_pj_id'] = $this->session->userdata('w_pj_id');
		//$this->session->set_flashdata( $flash_data);

		// 作業件数有無チェック(作業1～3)
		$this->load->model('Project', 'pj', TRUE);
		$this->_get_job_cnt($flash_data['w_pj_id']);



		print("flash_data03 == ");
		print_r($flash_data['w_pj_id']);
		print("<br><br>");


		// 申請案件データ 初期値セット
		$this->load->model('Project', 'pj', TRUE);					// models 読み込み
		$get_data = $this->pj->get_order_info($flash_data['w_pj_id'], $pji_seq = 2);
		if (empty($get_data))
		{
			// 表示なし
			$this->smarty->assign('not_disp', TRUE);
		} else {
			// 各項目 初期値セット
			$this->_form_item_set01($flash_data['w_pj_id']);
			$this->smarty->assign('order_info', $get_data[0]);
			$this->smarty->assign('not_disp', FALSE);
		}

		// バリデーション・チェック
		$this->_set_validation01();											// バリデーション設定
		//$this->form_validation->run();

		$this->smarty->assign('order_no', '03');
		$this->view('writer/search_genre/detail.tpl');

	}

	// ライターエントリー開始
	public function data_entry()
	{

		// セッションからフラッシュデータ読み込み＆書き込み
		$flash_data['w_pj_id']   = $this->session->userdata('w_pj_id');
		$flash_data['w_memID']   = $this->session->userdata('w_memID');
		$flash_data['w_memRANK'] = $this->session->userdata('w_memRANK');
		$flash_data['w_memNAME'] = $this->session->userdata('w_memNAME');



		print("flash_data_entry == ");
		print_r($flash_data['w_pj_id']);
		print("<br><br>");



		$post_data = array();
		$post_data = $this->input->post();

		// バリデーション・チェック
		$this->_set_validation00();
		$this->form_validation->run();

		// ２度目のエントリー却下
		$this->load->model('Writer_info', 'wrinfo', TRUE);
		$res_chk = $this->wrinfo->exist_pjid($flash_data['w_pj_id'], $flash_data['w_memID']);
		if ($res_chk)
		{
			// エラーメッセージを出す！　または選択不可にする。
			$_res_mess = '既に一度エントリーしています。二度エントリーすることはできません。';

			$this->detail00($_res_mess);
			return;
		}

		// エントリー情報の書き込み
		$this->config->load('config_status');
		$time = time();

		// ライター個別情報
		$set_wdata['wi_wr_id'] = $flash_data['w_memID'];								// ライターID
		$set_wdata['wi_pj_id'] = $flash_data['w_pj_id'];								// 案件ID
		$set_wdata['wi_pj_entry_status'] = $this->config->item('PJ_ESTATUS_ENTRY_ID');	// 「エントリー有」
		$set_wdata['wi_pj_work_status'] = $this->config->item('PJ_WSTATUS_CREATE_ID');	// 「原稿作成中」
		$set_wdata['wi_rank_id'] = $flash_data['w_memRANK'];							// メンバーRANK
		$set_wdata['wi_difficulty_id'] = $post_data['pj_taa_difficulty_id'];			// 難易度
		$set_wdata['wi_word_tanka'] = $post_data['wi_word_tanka'];						// 一文字単価
		$set_wdata['wi_entry_date'] = date("Y-m-d H:i", $time);							// エントリー日

		$tmp_limit_time = $time + ($post_data['pj_limit_time'] * 60);					// 分に変換のため * 60
		$tmp_end_time = strtotime($post_data['pj_end_time']);
		if ($tmp_limit_time <= $tmp_end_time)											// 投稿〆日 = 制限時間 < 公開〆切時間
		{
			$set_wdata['wi_posting_limit_date'] = date("Y-m-d H:i", $tmp_limit_time);
		} else {
			$set_wdata['wi_posting_limit_date'] = date("Y-m-d H:i", $tmp_end_time);
		}

		// 案件情報
		$set_pdata['pj_id'] = $flash_data['w_pj_id'];									// 案件ID
		$set_pdata['pj_entry_status'] = $this->config->item('PJ_ESTATUS_ENTRY_ID');		// 「エントリー有」
		$set_pdata['pj_work_status'] = $this->config->item('PJ_WSTATUS_CREATE_ID');		// 「原稿作成中」
		$set_pdata['pj_wr_id'] = $flash_data['w_memID'];								// ライターID

		// トランザクション・START
		$this->db->trans_strict(FALSE);										// StrictモードをOFF
		$this->db->trans_start();											// trans_begin

			// INSERT
			$_wi_id = $this->wrinfo->insert_writer_info($set_wdata);					// 「ライター個別情報ID」取得

			// UPDATE
			$this->load->model('Project', 'pj', TRUE);
			$set_pdata['pj_wi_id'] = $_wi_id[0]['LAST_INSERT_ID()'];					// ライター個別情報ID
			$result = $this->pj->update_project($set_pdata);

		// トランザクション・COMMIT
		$this->db->trans_complete();										// trans_rollback & trans_commit
		if ($this->db->trans_status() === FALSE)
		{
			log_message('error', 'WRITER::[data_entry()]ライターエントリー開始処理 トランザクションエラー');
		} else {
			$this->session->set_userdata('w_memENTRY', TRUE);				// ENTRY有をセッションデータに書き込み

			// エントリー確認メールを送信
			$this->_mail_send($post_data, $set_wdata, $flash_data);
		}

		redirect('/my_entrylist/');

	}

	// 作業件数有無チェック(作業1～3)
	private function _get_job_cnt($pj_id)
	{

		$get_infodata = $this->pj->get_entry_info($pj_id);
		$tmp_arr_cnt  = count($get_infodata);
		$this->smarty->assign('job_cnt', $tmp_arr_cnt);

	}

	// 現在の会員ランク単価を取得
	private function _get_member_tanka($cl_id)
	{

		$this->load->model('tanka', 'ta', TRUE);
		$tanka_list = $this->ta->get_tanka($cl_id);

		/* デバッグ用 */
		$tmp_tankainfo = "ブロンズ=" . $tanka_list[1]['ta_price'] . " 円、シルバー=" . $tanka_list[2]['ta_price'] . " 円、ゴールド=" . $tanka_list[3]['ta_price'] . " 円";
		$this->smarty->assign('tanka_info', $tmp_tankainfo);

		$tmp_diff_tanka0 = $this->ta->get_difftanka($cl_id, 0);
		$tmp_diff_tanka1 = $this->ta->get_difftanka($cl_id, 1);
		$tmp_diff_tanka2 = $this->ta->get_difftanka($cl_id, 2);
		$this->smarty->assign('diff_tanka0', $tmp_diff_tanka0['taa_price']);
		$this->smarty->assign('diff_tanka1', $tmp_diff_tanka1['taa_price']);
		$this->smarty->assign('diff_tanka2', $tmp_diff_tanka2['taa_price']);
		/* -------- */

	}

	// エントリー確認メールを送信
	private function _mail_send($post_data, $set_wdata, $wr_data)
	{

		// ライターのメールアドレスを取得する
		$this->load->model('Writer', 'wr', TRUE);
		$get_data = $this->wr->select_writer_id($wr_data['w_memID']);

		// メール送信先設定
		$mail['from']      = "";
		$mail['from_name'] = "";
		$mail['subject']   = "";
		$mail['to']        = $get_data[0]['wr_email'];
		$mail['cc']        = "";
		$mail['bcc']       = "";

		// メール本文置き換え文字設定
		$arrRepList = array(
				'wr_nickname'           => $wr_data['w_memNAME'],
				'wi_pj_id'              => $set_wdata['wi_pj_id'],
				'pj_title'              => $post_data['pj_title'],
				'wi_word_tanka'         => $set_wdata['wi_word_tanka'],
				'wi_entry_date'         => $set_wdata['wi_entry_date'],
				'wi_posting_limit_date' => $set_wdata['wi_posting_limit_date'],
		);

		// メールテンプレートの読み込み
		$this->config->load('config_mailtpl');								// メールテンプレート情報読み込み
		$mail_tpl = $this->config->item('MAILTPL_W_ENTRY_ID');

		// メール送信
		$this->load->model('Mailtpl', 'mailtpl', TRUE);
		$this->mailtpl->getMailTpl($mail, $arrRepList, $mail_tpl);

	}

	// Pagination 設定
	private function _get_Pagination($entry_countall, $tmp_per_page)
	{

		$config['base_url']       = base_url() . '/search_genre/search/';	// ページの基本URIパス。「/コントローラクラス/アクションメソッド/」
		$config['per_page']       = $tmp_per_page;							// 1ページ当たりの表示件数。
		$config['total_rows']     = $entry_countall;						// 総件数。where指定するか？
		$config['uri_segment']    = 4;										// オフセット値がURIパスの何セグメント目とするか設定
		$config['num_links']      = 5;										// 現在のページ番号の左右にいくつのページ番号リンクを生成するか設定
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

		// ジャンル 選択項目セット
		$this->load->model('comm_select', 'select', TRUE);
		$genre_list = $this->select->get_genre();

		// 会員 選択項目セット
		$rank_list = $this->select->get_memrank();

		// 難易度 選択項目セット
		$this->config->load('config_comm');
		$diff_list = $this->config->item('TANKA_ADD_NAME');

		// 案件ID 並び替え選択項目セット
		$arroptions_orderpjid = array (
				''     => '選択してください',
				'DESC' => '降順',
				'ASC'  => '昇順',
		);

		// 申請ID 並び替え選択項目セット
		$arroptions_orderpeid = array (
				''     => '選択してください',
				'DESC' => '降順',
				'ASC'  => '昇順',
		);

		$this->smarty->assign('options_genre_list', $genre_list);
		$this->smarty->assign('options_rank_list',  $rank_list);
		$this->smarty->assign('options_diff_list',  $diff_list);
		$this->smarty->assign('options_orderpjid',  $arroptions_orderpjid);
		$this->smarty->assign('options_orderpeid',  $arroptions_orderpeid);

	}

	// 各項目 初期値セット :: 申請内容
	private function _form_item_set00()
	{

		// ステータス状態 選択項目セット
		$this->config->load('config_status');
		$arroptions_pjstatus = array (
				'0' => $this->config->item('PJ_STATUS_JYUNBI'),
				'1' => $this->config->item('PJ_STATUS_OPEN'),
				'8' => $this->config->item('PJ_STATUS_HORYU'),
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

		// 難易度 選択項目セット
		$arroptions_diff = $this->config->item('TANKA_ADD_NAME');
		//$arroptions_diff = array (
		//		'0' => $this->config->item('ADDTANKA_KANTAN'),
		//		'1' => $this->config->item('ADDTANKA_FUTUU'),
		//		'2' => $this->config->item('ADDTANKA_NAN'),
		//);

		// イベント 選択項目セット
		$arroptions_event = array (
				'0' => '選択してください',
				'1' => $this->config->item('PJ_EVENT_OSUSUME'),
				'2' => $this->config->item('PJ_EVENT_KYUBO'),
				'3' => $this->config->item('PJ_EVENT_HITANKA'),
				'4' => $this->config->item('PJ_EVENT_LONG'),
				'5' => $this->config->item('PJ_EVENT_MOJISHORT'),
		);

		// ジャンル 選択項目セット
		$this->load->model('comm_select', 'select', TRUE);
		$genre_list = $this->select->get_genre();

		$this->smarty->assign('options_pj_status',            $arroptions_pjstatus);
		$this->smarty->assign('options_pj_mm_rank_id',        $arroptions_mrank);
		$this->smarty->assign('options_pj_taa_difficulty_id', $arroptions_diff);
		$this->smarty->assign('options_pj_event_id',          $arroptions_event);
		$this->smarty->assign('options_genre_list',           $genre_list);

	}

	// 各項目 初期値セット :: 申請案件2 and 3
	private function _form_item_set01($en_id)
	{
		// ステータス：使用有無選択項目セット
		$arroptions_ei_status = array (
				'0' => '使用しない',
				'1' => '使用する',
		);

		// レコード作成後に、格納データを表示するために必要
		$set_val['ei_en_id']       = $en_id;
		$set_val['ei_status']      = 0;

		for ($i = 1; $i <= 5; $i++ )
		{
			$item = 'ei_t_keyword' . sprintf("%'.02d", $i);
			$set_val[$item]    = '';
			$item = 'ei_t_count_min' . sprintf("%'.02d", $i);
			$set_val[$item]    = '';
			$item = 'ei_t_count_max' . sprintf("%'.02d", $i);
			$set_val[$item]    = '';
		}
		$set_val['ei_t_char_min']  = '';
		$set_val['ei_t_char_max']  = '';

		for ($i = 1; $i <= 10; $i++ )
		{
			$item = 'ei_b_word' . sprintf("%'.02d", $i);
			$set_val[$item]    = '';
			$item = 'ei_b_count_min' . sprintf("%'.02d", $i);
			$set_val[$item]    = '';
			$item = 'ei_b_count_max' . sprintf("%'.02d", $i);
			$set_val[$item]    = '';
		}
		$set_val['ei_b_char_min']  = '';
		$set_val['ei_b_char_max']  = '';

		$set_val['ei_work']        = '';
		$set_val['ei_notice']      = '';
		$set_val['ei_example']     = '';
		$set_val['ei_other']       = '';
		$set_val['ei_addwork']     = '';
		$set_val['ei_comment']     = '';

		$this->smarty->assign('options_ei_status', $arroptions_ei_status);
		$this->smarty->assign('entry_info',         $set_val);

	}

	// フォーム・バリデーションチェック
	private function _set_validation()
	{

		$rule_set = array(
				array(
						'field'   => 'pj_id',
						'label'   => '案件ID',
						'rules'   => 'trim|numeric'
				),
				array(
						'field'   => 'pj_en_id',
						'label'   => '申請ID',
						'rules'   => 'trim|numeric'
				),
				array(
						'field'   => 'pj_en_cl_id',
						'label'   => 'クライアントID',
						'rules'   => 'trim|numeric'
				),
				array(
						'field'   => 'pj_genre01',
						'label'   => 'ジャンル',
						'rules'   => 'trim|numeric'
				),
				array(
						'field'   => 'pj_order_title',
						'label'   => '案件タイトル',
						'rules'   => 'trim|max_length[100]'
				),
		);

		$this->load->library('form_validation', $rule_set);							// バリデーションクラス読み込み

	}

	// フォーム・バリデーションチェック:案件内容
	private function _set_validation00()
	{

		$rule_set = array(

		);

		$this->load->library('form_validation', $rule_set);							// バリデーションクラス読み込み
	}

	// フォーム・バリデーションチェック:申請案件１～３
	private function _set_validation01()
	{

		$rule_set = array(

		);

		$this->load->library('form_validation', $rule_set);							// バリデーションクラス読み込み
	}



//	// フォーム・バリデーションチェック:案件内容
//	private function _set_validation00()
//	{
//
//		$rule_set = array(
//				array(
//						'field'   => 'pj_status',
//						'label'   => 'ステータス (状態)',
//						'rules'   => 'trim|required|numeric'
//				),
//				array(
//						'field'   => 'pj_order_title',
//						'label'   => 'タイトル（表示件名）',
//						'rules'   => 'trim|required|max_length[100]'
//				),
//				array(
//						'field'   => 'pj_genre01',
//						'label'   => '希望ジャンル',
//						'rules'   => 'trim|required|numeric'
//				),
//				array(
//						'field'   => 'pj_title',
//						'label'   => '案件：タイトル',
//						'rules'   => 'trim|required|max_length[100]'
//				),
//				array(
//						'field'   => 'pj_work',
//						'label'   => '案件：概要',
//						'rules'   => 'trim|required|max_length[10000]'
//				),
//				array(
//						'field'   => 'pj_notice',
//						'label'   => '案件：注意事項',
//						'rules'   => 'trim|max_length[10000]'
//				),
//				array(
//						'field'   => 'pj_example',
//						'label'   => '案件：例文',
//						'rules'   => 'trim|max_length[10000]'
//				),
//				array(
//						'field'   => 'pj_other',
//						'label'   => '案件：その他',
//						'rules'   => 'trim|max_length[10000]'
//				),
//				array(
//						'field'   => 'pj_addwork',
//						'label'   => '案件：追加内容',
//						'rules'   => 'trim|max_length[10000]'
//				),
//
//
//				array(
//						'field'   => 'pj_mm_rank_id',
//						'label'   => '会員ランク指定',
//						'rules'   => 'trim|required|numeric'
//				),
//				array(
//						'field'   => 'pj_word_tanka',
//						'label'   => '個別文字単価指定',
//						'rules'   => 'trim|decimal|max_length[4]'
//				),
//				array(
//						'field'   => 'pj_taa_difficulty_id',
//						'label'   => '難易度(単価加算)指定',
//						'rules'   => 'trim|required|numeric'
//				),
//				array(
//						'field'   => 'pj_event_id',
//						'label'   => 'イベント指定',
//						'rules'   => 'trim|numeric'
//				),
//
//				array(
//						'field'   => 'pj_delivery_time',
//						'label'   => 'ライター投稿納期',
//						'rules'   => 'trim|required|regex_match[/^\d{4}-\d{1,2}-\d{1,2} \d{1,2}:\d{1,2}+$/]|max_length[16]'
//				),
//				array(
//						'field'   => 'pj_limit_time',
//						'label'   => 'ライター投稿制限時間',
//						'rules'   => 'trim|required|numeric|max_length[6]'
//				),
//				array(
//						'field'   => 'pj_start_time',
//						'label'   => '公開(募集)開始日時',
//						'rules'   => 'trim|required|regex_match[/^\d{4}-\d{1,2}-\d{1,2} \d{1,2}:\d{1,2}+$/]|max_length[16]'
//				),
//				array(
//						'field'   => 'pj_end_time',
//						'label'   => '公開(募集)終了日時',
//						'rules'   => 'trim|required|regex_match[/^\d{4}-\d{1,2}-\d{1,2} \d{1,2}:\d{1,2}+$/]|max_length[16]'
//				),
//				array(
//						'field'   => 'pj_comment',
//						'label'   => '備考',
//						'rules'   => 'trim|max_length[2000]'
//				),
//
//		);
//
//		$this->load->library('form_validation', $rule_set);							// バリデーションクラス読み込み
//
//	}
//
//	// フォーム・バリデーションチェック::申請案件１～３
//	private function _set_validation01()
//	{
//
//		$rule_set = array(
//				array(
//						'field'   => 'rep_status',
//						'label'   => '使用有無設定',
//						'rules'   => ''
//				),
//
//				array(
//						'field'   => 'rep_t_keyword01',
//						'label'   => 'タイトル：必須ワード指定',
//						'rules'   => 'trim|max_length[100]'
//				),
//				array(
//						'field'   => 'rep_t_keyword02',
//						'label'   => 'タイトル：必須ワード指定',
//						'rules'   => 'trim|max_length[100]'
//				),
//				array(
//						'field'   => 'rep_t_keyword03',
//						'label'   => 'タイトル：必須ワード指定',
//						'rules'   => 'trim|max_length[100]'
//				),
//				array(
//						'field'   => 'rep_t_count_min01',
//						'label'   => 'タイトル：最低 使用回数',
//						'rules'   => 'trim|max_length[10]'
//				),
//				array(
//						'field'   => 'rep_t_count_min02',
//						'label'   => 'タイトル：最低 使用回数',
//						'rules'   => 'trim|max_length[10]'
//				),
//				array(
//						'field'   => 'rep_t_count_min03',
//						'label'   => 'タイトル：最低 使用回数',
//						'rules'   => 'trim|max_length[10]'
//				),
//				array(
//						'field'   => 'rep_t_count_max01',
//						'label'   => 'タイトル：最大 使用回数',
//						'rules'   => 'trim|max_length[10]'
//				),
//				array(
//						'field'   => 'rep_t_count_max02',
//						'label'   => 'タイトル：最大 使用回数',
//						'rules'   => 'trim|max_length[10]'
//				),
//				array(
//						'field'   => 'rep_t_count_max03',
//						'label'   => 'タイトル：最大 使用回数',
//						'rules'   => 'trim|max_length[10]'
//				),
//				array(
//						'field'   => 'rep_t_char_min',
//						'label'   => 'タイトル：最低 使用文字数',
//						'rules'   => 'trim|max_length[10000]'
//				),
//				array(
//						'field'   => 'rep_t_char_max',
//						'label'   => 'タイトル：最大 使用文字数',
//						'rules'   => 'trim|max_length[10000]'
//				),
//
//				array(
//						'field'   => 'rep_b_word01',
//						'label'   => '本文：必須ワード指定',
//						'rules'   => 'trim|max_length[100]'
//				),
//				array(
//						'field'   => 'rep_b_word02',
//						'label'   => '本文：必須ワード指定',
//						'rules'   => 'trim|max_length[100]'
//				),
//				array(
//						'field'   => 'rep_b_word03',
//						'label'   => '本文：必須ワード指定',
//						'rules'   => 'trim|max_length[100]'
//				),
//				array(
//						'field'   => 'rep_b_word04',
//						'label'   => '本文：必須ワード指定',
//						'rules'   => 'trim|max_length[100]'
//				),
//				array(
//						'field'   => 'rep_b_word05',
//						'label'   => '本文：必須ワード指定',
//						'rules'   => 'trim|max_length[100]'
//				),
//				array(
//						'field'   => 'rep_b_count_min01',
//						'label'   => 'タイトル：最低 使用回数',
//						'rules'   => 'trim|max_length[10]'
//				),
//				array(
//						'field'   => 'rep_b_count_min02',
//						'label'   => 'タイトル：最低 使用回数',
//						'rules'   => 'trim|max_length[10]'
//				),
//				array(
//						'field'   => 'rep_b_count_min03',
//						'label'   => 'タイトル：最低 使用回数',
//						'rules'   => 'trim|max_length[10]'
//				),
//				array(
//						'field'   => 'rep_b_count_min04',
//						'label'   => 'タイトル：最低 使用回数',
//						'rules'   => 'trim|max_length[10]'
//				),
//				array(
//						'field'   => 'rep_b_count_min05',
//						'label'   => 'タイトル：最低 使用回数',
//						'rules'   => 'trim|max_length[10]'
//				),
//				array(
//						'field'   => 'rep_b_count_max01',
//						'label'   => 'タイトル：最大 使用回数',
//						'rules'   => 'trim|max_length[10]'
//				),
//				array(
//						'field'   => 'rep_b_count_max02',
//						'label'   => 'タイトル：最大 使用回数',
//						'rules'   => 'trim|max_length[10]'
//				),
//				array(
//						'field'   => 'rep_b_count_max03',
//						'label'   => 'タイトル：最大 使用回数',
//						'rules'   => 'trim|max_length[10]'
//				),
//				array(
//						'field'   => 'rep_b_count_max04',
//						'label'   => 'タイトル：最大 使用回数',
//						'rules'   => 'trim|max_length[10]'
//				),
//				array(
//						'field'   => 'rep_b_count_max05',
//						'label'   => 'タイトル：最大 使用回数',
//						'rules'   => 'trim|max_length[10]'
//				),
//				array(
//						'field'   => 'rep_b_char_min',
//						'label'   => 'タイトル：最低 使用文字数',
//						'rules'   => 'trim|max_length[10000]'
//				),
//				array(
//						'field'   => 'rep_b_char_max',
//						'label'   => 'タイトル：最大 使用文字数',
//						'rules'   => 'trim|max_length[10000]'
//				),
//
//				array(
//						'field'   => 'pji_work',
//						'label'   => '案件申請：概要',
//						'rules'   => 'trim|required|max_length[10000]'
//				),
//				array(
//						'field'   => 'pji_notice',
//						'label'   => '案件申請：注意事項',
//						'rules'   => 'trim|max_length[10000]'
//				),
//				array(
//						'field'   => 'pji_example',
//						'label'   => '案件申請：例文',
//						'rules'   => 'trim|max_length[10000]'
//				),
//				array(
//						'field'   => 'pji_other',
//						'label'   => '案件申請：その他',
//						'rules'   => 'trim|max_length[10000]'
//				),
//				array(
//						'field'   => 'pji_addwork',
//						'label'   => '案件申請：追加内容',
//						'rules'   => 'trim|max_length[10000]'
//				),
//
//		);
//
//		$this->load->library('form_validation', $rule_set);							// バリデーションクラス読み込み
//
//	}

}
