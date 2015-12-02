<?php

class Clientlist extends MY_Controller
{

	public function __construct()
	{
		parent::__construct();

		if ($this->session->userdata('a_login') == TRUE)
		{
			$this->smarty->assign('login_chk', TRUE);
			//$this->smarty->assign('login_mem', 'admin');
			$this->smarty->assign('login_name', $this->session->userdata('a_memNAME'));
		} else {
			$this->smarty->assign('login_chk', FALSE);
			//$this->smarty->assign('login_mem', 'admin');
			$this->smarty->assign('login_name', '');

			//$this->load->helper('url');
			redirect('/login/');
		}

	}

	// クライアントTOP
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
		//$this->load->helper('url');
		$segments = $this->uri->segment_array();
		if (isset($segments[3]))
		{
			$tmp_offset = $segments[3];
		} else {
			$tmp_offset = 0;
		}

		// クライアントメンバーの取得
		$this->load->model('Client', 'cl', TRUE);
		list($client_list, $client_countall) = $this->cl->get_clientlist($this->input->post(), $tmp_per_page, $tmp_offset);
		$this->smarty->assign('client_list', $client_list);

		// Pagination 設定
		$set_pagination = $this->_get_Pagination($client_countall, $tmp_per_page);

		$this->smarty->assign('set_pagination', $set_pagination['page_link']);
		$this->smarty->assign('countall', $client_countall);

		$this->view('admin/clientlist/index.tpl');

	}

	// 一覧表示
	public function search()
	{

		// 検索項目の保存が上手くいかない。応急的に対応！
		if ($this->input->post('submit') == '_submit')
		{
			// セッションをフラッシュデータとして保存
			$data = array(
					'a_cl_company'  => $this->input->post('cl_company'),
					'a_cl_id'       => $this->input->post('cl_id'),
					'a_cl_email'    => $this->input->post('cl_email'),
					'a_cl_status'   => $this->input->post('cl_status'),
					'a_orderid'     => $this->input->post('orderid'),
					'a_orderstatus' => $this->input->post('orderstatus'),
			);
			$this->session->set_userdata($data);

			$tmp_inputpost = $this->input->post();
			unset($tmp_inputpost["submit"]);

		} else {
			// セッションからフラッシュデータ読み込み
			$tmp_inputpost['cl_company']  = $this->session->userdata('a_cl_company');
			$tmp_inputpost['cl_id']       = $this->session->userdata('a_cl_id');
			$tmp_inputpost['cl_email']    = $this->session->userdata('a_cl_email');
			$tmp_inputpost['cl_status']   = $this->session->userdata('a_cl_status');
			$tmp_inputpost['orderid']     = $this->session->userdata('a_orderid');
			$tmp_inputpost['orderstatus'] = $this->session->userdata('a_orderstatus');

			//$this->session->set_userdata($tmp_inputpost);
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

		// クライアントメンバーの取得
		$this->load->model('Client', 'cl', TRUE);
		list($client_list, $client_countall) = $this->cl->get_clientlist($tmp_inputpost, $tmp_per_page, $tmp_offset);
		$this->smarty->assign('client_list', $client_list);

		// 検索項目 初期値セット
		$this->_search_set();

		// Pagination 設定
		$set_pagination = $this->_get_Pagination($client_countall, $tmp_per_page);

		$this->smarty->assign('set_pagination', $set_pagination['page_link']);
		$this->smarty->assign('countall', $client_countall);

		$this->view('admin/clientlist/index.tpl');

	}

	// クライアント情報編集
	public function detail()
	{

		// クライアントステータス設定  <-- 検索項目 初期値セット
		$this->_search_set();

		// 更新対象クライアントメンバーのデータ取得
		$input_post = $this->input->post();
		$this->load->model('Client', 'cl', TRUE);

		$tmp_clientid = $input_post['clid_uniq'];
		$get_data = $this->cl->select_client_id($tmp_clientid);

		// 都道府県情報＆手数料選択設定
		$this->set_optionitem($get_data[0]);

		// 現在の会員ランク単価を取得
		$this->_get_member_tanka($tmp_clientid);

		$this->smarty->assign('client_info', $get_data[0]);

		// バリデーション設定
		$this->_set_validation01();

		$this->view('admin/clientlist/detail.tpl');

	}

	// クライアント情報チェック
	public function detailchk()
	{

		// クライアントステータス設定  <-- 検索項目 初期値セット
		$this->_search_set();

		// 更新対象クライアントメンバーのデータ取得
		$input_post = $this->input->post();
		$this->load->model('Client', 'cl', TRUE);

		// 都道府県情報＆手数料選択設定
		$this->set_optionitem($input_post);

		$this->_set_validation01();											// バリデーション設定
		if ($this->form_validation->run() == FALSE)
		{
			$this->smarty->assign('client_info', $this->input->post());
		} else {
			// DB書き込み
			$set_data01['cl_status']       = $this->input->post('cl_status');
			$set_data01['cl_id']           = $this->input->post('cl_id');
			$set_data01['cl_company']      = $this->input->post('cl_company');
			$set_data01['cl_company_kana'] = $this->input->post('cl_company_kana');

			if ($this->cl->update_Client($set_data01))
			{

				// クライアント個別情報更新
				$set_data02['cl_id']            = $this->input->post('cl_id');
				$set_data02['ci_fee_id']        = $this->input->post('ci_fee_id');
				$set_data02['ci_fee']           = $this->input->post('ci_fee');
				$set_data02['ci_agreement_st']  = $this->input->post('ci_agreement_st');
				$set_data02['ci_agreement_end'] = $this->input->post('ci_agreement_end');
				$set_data02['ci_comment']       = $this->input->post('ci_comment');

				if ($this->cl->update_Client_info($set_data02)) {
				} else {
					echo "クライアント個別更新に失敗しました。";
				}

			} else {
				echo "クライアント更新に失敗しました。";
			}

			// 検索一覧へ
			//$this->load->helper('url');
			redirect('/clientlist/');
		}

		$this->view('admin/clientlist/detail.tpl');

	}

	// 都道府県情報＆手数料選択設定
	private function set_optionitem($input_data)
	{

		// 都道府県情報設定
		$this->config->load('config_pref');									// 都道府県情報読み込み
		$this->_options_pref = $this->config->item('pref');
		$this->_pref_name    = $this->_options_pref[$input_data['cl_pref']];
		$this->smarty->assign('pref_name', $this->_pref_name);

		// 手数料状態選択
		$this->smarty->assign('ci_fee_id', $input_data['ci_fee_id']);
		$this->smarty->assign('ci_fee',    $input_data['ci_fee']);

	}

	// 現在の会員ランク単価＆難易度単価を取得
	private function _get_member_tanka($cl_id)
	{

		$this->load->model('tanka', 'ta', TRUE);
		$tanka_list = $this->ta->get_tanka($cl_id);
		$tmp_tankainfo = "ブロンズ=" . $tanka_list[1]['ta_price'] . " 円、シルバー=" . $tanka_list[2]['ta_price'] . " 円、ゴールド=" . $tanka_list[3]['ta_price'] . " 円";
		$this->smarty->assign('tanka_info', $tmp_tankainfo);

		$tankaadd_list = $this->ta->get_tankaaad($cl_id);
		$tmp_tankaaddinfo = "カンタン=" . $tankaadd_list[0]['taa_price'] . " 円、ふつう=" . $tankaadd_list[1]['taa_price'] . " 円、難しい=" . $tankaadd_list[2]['taa_price'] . " 円";
		$this->smarty->assign('tankaadd_info', $tmp_tankaaddinfo);


	}

	// Pagination 設定
	private function _get_Pagination($client_countall, $tmp_per_page)
	{

		$config['base_url']       = base_url() . '/clientlist/search/';		// ページの基本URIパス。「/コントローラクラス/アクションメソッド/」
		$config['per_page']       = $tmp_per_page;							// 1ページ当たりの表示件数。
		$config['total_rows']     = $client_countall;						// 総件数。where指定するか？
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
		$arroptions_clstatus01 = array (
				''  => '選択してください',
				'0' => $this->config->item('CLIENT_SHINSEITYU'),
				'1' => $this->config->item('CLIENT_SHONIN'),
				'2' => $this->config->item('CLIENT_HISYONIN'),
				'7' => $this->config->item('CLIENT_ITIJITEISHI'),
				'8' => $this->config->item('CLIENT_TEISHI'),
				'9' => $this->config->item('CLIENT_TAIKAI'),
		);

		$arroptions_clstatus02 = array (
				'0' => $this->config->item('CLIENT_SHINSEITYU'),
				'1' => $this->config->item('CLIENT_SHONIN'),
				'2' => $this->config->item('CLIENT_HISYONIN'),
				'7' => $this->config->item('CLIENT_ITIJITEISHI'),
				'8' => $this->config->item('CLIENT_TEISHI'),
				'9' => $this->config->item('CLIENT_TAIKAI'),
		);

		// クライアントID 並び替え選択項目セット
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

		// 手数料状態選択
		$arroptions_ci_fee_id = array (
				'0'    => '手数料:率',
				'1'    => '手数料:月額固定',
		);

		$this->smarty->assign('options_cl_status01',   $arroptions_clstatus01);
		$this->smarty->assign('options_cl_status02',   $arroptions_clstatus02);
		$this->smarty->assign('options_orderid',       $arroptions_id);
		$this->smarty->assign('options_orderstatus',   $arroptions_status);
		$this->smarty->assign('options_ci_fee_id',     $arroptions_ci_fee_id);
	}

	// フォーム・バリデーションチェック
	private function _set_validation()
	{

		$rule_set = array(
				array(
						'field'   => 'cl_company',
						'label'   => '会社名',
						'rules'   => 'trim|max_length[100]'
				),
				array(
						'field'   => 'cl_id',
						'label'   => 'クライアントID',
						'rules'   => 'trim|numeric'
				),
				array(
						'field'   => 'cl_email',
						'label'   => 'メールアドレス',
						'rules'   => 'trim|max_length[50]'
				),
				array(
						'field'   => 'cl_status',
						'label'   => 'ステータス',
						'rules'   => 'trim|numeric'
				),
		);

		$this->load->library('form_validation', $rule_set);							// バリデーションクラス読み込み

	}

	// フォーム・バリデーションチェック :: クライアント更新フォーム
	private function _set_validation01()
	{

		$rule_set = array(
				array(
						'field'   => 'cl_status',
						'label'   => 'ステータス',
						'rules'   => 'trim|required'
				),
				array(
						'field'   => 'ci_fee_id',
						'label'   => '手数料設定',
						'rules'   => 'trim|required'
				),
				array(
						'field'   => 'ci_agreement_st',
						'label'   => '契約開始日',
						'rules'   => 'trim|regex_match[/^\d{4}-\d{1,2}-\d{1,2}+$/]|max_length[10]'
				),
				array(
						'field'   => 'ci_agreement_end',
						'label'   => '契約終了(予定)日',
						'rules'   => 'trim|regex_match[/^\d{4}-\d{1,2}-\d{1,2}+$/]|max_length[10]'
				),
				array(
						'field'   => 'ci_comment',
						'label'   => '備考',
						'rules'   => 'trim|max_length[2000]'
				),
				array(
						'field'   => 'cl_company',
						'label'   => '会社名',
						'rules'   => 'trim|required|max_length[100]'
				),
				array(
						'field'   => 'cl_company_kana',
						'label'   => '会社名カナ（全角）',
						'rules'   => 'trim|regex_match[/^[ァ-タダ-ヴ　ー・]+$/]|required|max_length[100]'
				),
		);



//				array(
//						'field'   => 'cl_president01',
//						'label'   => '代表者姓',
//						'rules'   => 'trim|required|max_length[50]'
//				),
//				array(
//						'field'   => 'cl_president02',
//						'label'   => '代表者名',
//						'rules'   => 'trim|required|max_length[50]'
//				),
//				array(
//						'field'   => 'cl_president_kana01',
//						'label'   => '代表者セイ（全角）',
//						'rules'   => 'trim|required|max_length[50]'
//				),
//				array(
//						'field'   => 'cl_president_kana02',
//						'label'   => '代表者メイ（全角）',
//						'rules'   => 'trim|required|max_length[50]'
//				),
//				array(
//						'field'   => 'cl_department',
//						'label'   => '担当部署',
//						'rules'   => 'trim|max_length[50]'
//				),
//				array(
//						'field'   => 'cl_person01',
//						'label'   => '担当者姓',
//						'rules'   => 'trim|required|max_length[50]'
//				),
//				array(
//						'field'   => 'cl_person02',
//						'label'   => '担当者名',
//						'rules'   => 'trim|required|max_length[50]'
//				),
//				array(
//						'field'   => 'cl_person_kana01',
//						'label'   => '担当者セイ（全角）',
//						'rules'   => 'trim|required|max_length[50]'
//				),
//				array(
//						'field'   => 'cl_person_kana02',
//						'label'   => '担当者メイ（全角）',
//						'rules'   => 'trim|required|max_length[50]'
//				),
//				array(
//						'field'   => 'cl_zip01',
//						'label'   => '郵便番号（3ケタ）',
//						'rules'   => 'trim|required|max_length[3]|is_numeric'
//				),
//				array(
//						'field'   => 'cl_zip02',
//						'label'   => '郵便番号（4ケタ）',
//						'rules'   => 'trim|required|max_length[4]|is_numeric'
//				),
//				array(
//						'field'   => 'cl_pref',
//						'label'   => '都道府県',
//						'rules'   => 'trim|required|max_length[2]'
//				),
//				array(
//						'field'   => 'cl_addr01',
//						'label'   => '市区町村',
//						'rules'   => 'trim|required|max_length[100]'
//				),
//				array(
//						'field'   => 'cl_addr02',
//						'label'   => '町名・番地',
//						'rules'   => 'trim|required|max_length[100]'
//				),
//				array(
//						'field'   => 'cl_buil',
//						'label'   => 'ビル・マンション名など',
//						'rules'   => 'trim|max_length[100]'
//				),
//				array(
//						'field'   => 'cl_email',
//						'label'   => 'メールアドレス（代表）',
//						'rules'   => 'trim|required|valid_email'
//				),
//				array(
//						'field'   => 'cl_email2',
//						'label'   => 'メールアドレス（予備）',
//						'rules'   => 'trim|valid_email'
//				),
//				array(
//						'field'   => 'cl_tel01',
//						'label'   => '代表電話番号',
//						'rules'   => 'trim|required|regex_match[/^[0-9\-]+$/]|max_length[15]'
//				),
//				array(
//						'field'   => 'cl_tel02',
//						'label'   => '担当者電話番号',
//						'rules'   => 'trim|regex_match[/^[0-9\-]+$/]|max_length[15]'
//				),
//				array(
//						'field'   => 'cl_mobile',
//						'label'   => '担当者携帯番号',
//						'rules'   => 'trim|regex_match[/^[0-9\-]+$/]|max_length[15]'
//				),
//				array(
//						'field'   => 'cl_fax',
//						'label'   => 'ＦＡＸ番号',
//						'rules'   => 'trim|regex_match[/^[0-9\-]+$/]|max_length[15]'
//				),
//				array(
//						'field'   => 'cl_hp',
//						'label'   => '会社ＨＰ(http://～)',
//						'rules'   => 'trim|regex_match[/^(https?)(:\/\/[-_.!~*\'()a-zA-Z0-9;\/?:\@&=+\$,%#]+)$/]|max_length[100]'
//				),
//				array(
//						'field'   => 'cl_password',
//						'label'   => 'パスワード',
//						'rules'   => 'trim|regex_match[/^[\x21-\x7e]+$/]|min_length[8]|max_length[50]|matches[retype_password]'
//				),
//				array(
//						'field'   => 'retype_password',
//						'label'   => 'パスワード再入力',
//						'rules'   => 'trim|regex_match[/^[\x21-\x7e]+$/]|min_length[8]|max_length[50]|matches[cl_password]'
//				)
//		);

		$this->load->library('form_validation', $rule_set);							// バリデーションクラス読み込み

	}

}
