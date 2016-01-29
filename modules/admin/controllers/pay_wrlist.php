<?php

class Pay_wrlist extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();

            if ($this->session->userdata('a_login') == TRUE)
        {
        	$this->smarty->assign('login_chk', TRUE);
        	$this->smarty->assign('login_name', $this->session->userdata('a_memNAME'));
        	$this->smarty->assign('auth_cd',    $this->session->userdata('a_authCD'));
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
        $this->comm_auth->delete_session('admin');

        // バリデーション・チェック
        $this->_set_validation();                                            // バリデーション設定
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

        // エントリーリスト＆件数を取得
        $this->load->model('Writer', 'wr', TRUE);

        $tmp_inputpost                = $this->input->post();
        $tmp_inputpost['wp_wr_id']    = NULL;
        $tmp_inputpost['wp_status']   = NULL;
        $tmp_inputpost['pay_date_st'] = date('Y/m/d', strtotime("-1 month"));;
        $tmp_inputpost['pay_date_ed'] = NULL;

        // セッションをフラッシュデータとして保存
        $data = array(
        		'a_pay_date_st' => date('Y/m/d', strtotime("-1 month")),
        );
        $this->session->set_userdata($data);

        $tmp_per_page = 20;
        list($pay_list, $pay_countall) = $this->wr->get_paywrlist($tmp_inputpost, $tmp_per_page, $tmp_offset);

        // Pagination 設定
        $set_pagination = $this->_get_Pagination($pay_countall, $tmp_per_page, NULL);

        $this->smarty->assign('listall',        $pay_list);

        $this->smarty->assign('set_pagination', $set_pagination['page_link']);
        $this->smarty->assign('countall',       $pay_countall);

        $this->smarty->assign('serch_item',     $tmp_inputpost);

        $this->view('admin/pay_wrlist/index.tpl');

    }

    // 一覧表示
    public function search()
    {

        $tmp_inputpost = array();
        if (($this->input->post('submit') == '_submit') OR ($this->input->post('submit') == '_dlcsv'))
        {
            // セッションをフラッシュデータとして保存
            $data = array(
                    'a_wp_wr_id'    => $this->input->post('wp_wr_id'),
            		'a_wp_status'   => $this->input->post('wp_status'),
                    'a_pay_date_st' => $this->input->post('pay_date_st'),
                    'a_pay_date_ed' => $this->input->post('pay_date_ed'),
            );
            $this->session->set_userdata($data);

            $tmp_inputpost = $this->input->post();
            unset($tmp_inputpost["submit"]);

        } else {
            // セッションからフラッシュデータ読み込み
            $tmp_inputpost['wp_wr_id']    = $this->session->userdata('a_wp_wr_id');
            $tmp_inputpost['wp_status']   = $this->session->userdata('a_wp_status');
            $tmp_inputpost['pay_date_st'] = $this->session->userdata('a_pay_date_st');
            $tmp_inputpost['pay_date_ed'] = $this->session->userdata('a_pay_date_ed');
        }

        $this->load->model('Writer', 'wr', TRUE);

        // バリデーション・チェック
        $this->_set_validation();                                            // バリデーション設定
        if ($this->form_validation->run() == FALSE)
        {

        	$tmp_inputpost                = $this->input->post();
        	$tmp_inputpost['wp_wr_id']    = NULL;
        	$tmp_inputpost['wp_status']   = NULL;
        	$tmp_inputpost['pay_date_st'] = date('Y/m/d', strtotime("-1 month"));;
        	$tmp_inputpost['pay_date_ed'] = NULL;

        	// セッションをフラッシュデータとして保存
        	$data = array(
        			'a_pay_date_st' => date('Y/m/d', strtotime("-1 month")),
        	);
        	$this->session->set_userdata($data);

        } else {

        	// CSVデータ作成＆ダウンロード
        	if ($this->input->post('submit') == '_dlcsv')
        	{
        		// 請求リスト＆件数(max1000件)のクエリー取得
        		$tmp_offset = 0;
        		$tmp_per_page = 1000;
        		$query = $this->wr->get_paywrlist_query($tmp_inputpost, $tmp_per_page, $tmp_offset, '0');

        		// 作成したヘルパーを読み込む
        		$this->load->helper(array('download', 'csvdata'));

        		// ヘルパーに追加した関数を呼び出し、CSVデータ取得
        		$get_pay_csv = csv_from_result($query);

        		$file_name = 'dl_wr_paylist_' . date('YmdHis') . '.csv';
        		force_download($file_name, $get_pay_csv);

        	}
        }

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

        // エントリーリスト＆件数を取得
        $tmp_per_page = 20;
        list($pay_list, $pay_countall) = $this->wr->get_paywrlist($tmp_inputpost, $tmp_per_page, $tmp_offset);

        // Pagination 設定
        $set_pagination = $this->_get_Pagination($pay_countall, $tmp_per_page);

        // 検索項目 初期値セット
        $this->_search_set();

        $this->smarty->assign('listall',        $pay_list);

        $this->smarty->assign('set_pagination', $set_pagination['page_link']);
        $this->smarty->assign('countall',       $pay_countall);
        $this->smarty->assign('serch_item',     $tmp_inputpost);

        $this->view('admin/pay_wrlist/index.tpl');

    }

    // クライアント 請求情報編集
    public function detail()
    {

    	// 初期値セット
    	$this->_search_set();

    	// 更新対象 請求データ取得
    	$this->load->model('Writer', 'wr', TRUE);

    	$tmp_inputpost                     = $this->input->post();
    	$tmp_inputpost['wp_id']            = $this->input->post('wpid_uniq');
    	$get_writer_pay = $this->wr->get_writer_pay($tmp_inputpost['wp_id']);

    	$this->smarty->assign('list', $get_writer_pay[0]);

    	// 「ニックネーム」「入金締日」取得
    	$get_writer_detail = $this->wr->select_writer_id($get_writer_pay[0]['wp_wr_id']);
    	$this->smarty->assign('wrnickname',    $get_writer_detail[0]['wr_nickname']);
    	$this->smarty->assign('pay_limitdate', $get_writer_detail[0]['wr_pay_limit_date']);

    	// バリデーション設定
    	$this->_set_validation01();

    	$this->view('admin/pay_wrlist/detail.tpl');

    }

    // クライアント 請求情報チェック＆更新
    public function detailchk()
    {

    	// 初期値セット
    	$this->_search_set();

    	// 入力データ取得
    	$input_post = $this->input->post();
    	$this->load->model('Writer', 'wr', TRUE);

    	$this->_set_validation01();                                         // バリデーション設定
    	if ($this->form_validation->run() == FALSE)
    	{
    	} else {

    		// 「ライター入金情報」更新
    		$set_update_data = array();
    		$set_update_data['wp_id']         = $this->input->post('wp_id');					// 入金情報ID
    		$set_update_data['wp_status']     = $this->input->post('wp_status');				// 入金状況
    		$set_update_data['wp_pay_result'] = $this->input->post('wp_pay_result');			// 報酬金額
    		$set_update_data['wp_pay_adjust'] = $this->input->post('wp_pay_adjust');			// 調整金額
    		$set_update_data['wp_pay_total']  = $this->input->post('wp_pay_total');				// 入金金額
    		$set_update_data['wp_bank_cd']    = $this->input->post('wp_bank_cd');				// 銀行CD
    		$set_update_data['wp_bk_no']      = $this->input->post('wp_bk_no');					// 口座番号
    		$set_update_data['wp_comment']    = $this->input->post('wp_comment');				// メモ

    		// UPDATE <- 'tb_writer_pay'
    		$this->wr->update_writer_pay($set_update_data);

    	}

    	$this->smarty->assign('list', $this->input->post());
    	$this->smarty->assign('wrnickname',    $this->input->post('wrnickname'));
    	$this->smarty->assign('pay_limitdate', $this->input->post('pay_limitdate'));

    	$this->view('admin/pay_wrlist/detail.tpl');

    }

    // Pagination 設定
    private function _get_Pagination($entry_countall, $tmp_per_page)
    {

        $config['base_url']       = base_url() . '/pay_cllist/search/';     // ページの基本URIパス。「/コントローラクラス/アクションメソッド/」
        $config['per_page']       = $tmp_per_page;                        // 1ページ当たりの表示件数。
        $config['total_rows']     = $entry_countall;                        // 総件数。where指定するか？
        $config['uri_segment']    = 4;                                      // オフセット値がURIパスの何セグメント目とするか設定
        $config['num_links']      = 5;                                      //現在のページ番号の左右にいくつのページ番号リンクを生成するか設定
        $config['full_tag_open']  = '<p class="pagination">';               // ページネーションリンク全体を階層化するHTMLタグの先頭タグ文字列を指定
        $config['full_tag_close'] = '</p>';                                 // ページネーションリンク全体を階層化するHTMLタグの閉じタグ文字列を指定
        $config['first_link']     = '最初へ';                               // 最初のページを表すテキスト。
        $config['last_link']      = '最後へ';                               // 最後のページを表すテキスト。
        $config['prev_link']      = '前へ';                                 // 前のページへのリンクを表わす文字列を指定
        $config['next_link']      = '次へ';                                 // 次のページへのリンクを表わす文字列を指定

        $this->load->library('pagination', $config);                        // Paginationクラス読み込み
        $set_page['page_link'] = $this->pagination->create_links();

        return $set_page;

    }

    // 検索項目 初期値セット
    private function _search_set()
    {

        // ステータス状態 選択項目セット
        $this->config->load('config_comm');

        $arroptions_paystatus = array (
        		''  => '選択してください',
        		'0' => '未入金',
        		'1' => '入金済',
        		'2' => '保　留',
        		'3' => '返　金',
        );

        $arroptions_paylimit = array (
        		''  => '選択してください',
        		'0' => '日　次',
        		'1' => '週　次',
        		'2' => '月　次',
        		'3' => '曜　日',
        		'4' => '10日〆',
        );

        $this->smarty->assign('options_paystatus', $arroptions_paystatus);
        $this->smarty->assign('options_paylimit',  $arroptions_paylimit);

        $arroptions_paystate   = $this->config->item('WRITER_PAY_FLG');
        $this->smarty->assign('options_paystate',   $arroptions_paystate);

    }

    // フォーム・バリデーションチェック
    private function _set_validation()
    {

        $rule_set = array(
                array(
                        'field'   => 'wp_wr_id',
                        'label'   => 'ライターID',
                        'rules'   => 'trim|numeric'
                ),
                array(
                        'field'   => 'wp_status',
                        'label'   => '入金有無',
                        'rules'   => 'trim|numeric'
                ),
                array(
                        'field'   => 'pay_date_st',
                        'label'   => '入金予定日(開始)',
                        'rules'   => 'trim|regex_match[/^\d{4}\/\d{1,2}\/\d{1,2}+$/]|max_length[10]'
                ),
                array(
                        'field'   => 'pay_date_ed',
                        'label'   => '入金予定日(終了)',
                        'rules'   => 'trim|regex_match[/^\d{4}\/\d{1,2}\/\d{1,2}+$/]|max_length[10]'
                ),
        );

        $this->load->library('form_validation', $rule_set);                            // バリデーションクラス読み込み

    }

    // フォーム・バリデーションチェック
    private function _set_validation01()
    {

    	$rule_set = array(
    			array(
    					'field'   => 'wp_status',
    					'label'   => '入金状況',
    					'rules'   => 'trim|numeric'
    			),
    			array(
    					'field'   => 'wp_pay_result',
    					'label'   => '報酬金額',
    					'rules'   => 'trim|required|numeric|max_length[9]'
    			),
    			array(
    					'field'   => 'wp_pay_adjust',
    					'label'   => '調整金額',
    					'rules'   => 'trim|required|numeric|max_length[9]'
    			),
    			array(
    					'field'   => 'wp_pay_total',
    					'label'   => '入金金額',
    					'rules'   => 'trim|required|numeric|max_length[9]'
    			),
    			array(
    					'field'   => 'wp_bank_cd',
    					'label'   => '銀行コード',
    					'rules'   => 'trim|max_length[10]|is_numeric'
    			),
    			array(
    					'field'   => 'cp_pay_total',
    					'label'   => '口座番号',
    					'rules'   => 'trim|max_length[20]|is_numeric'
    			),
    			array(
    					'field'   => 'cp_comment',
    					'label'   => 'メモ',
    					'rules'   => 'trim|max_length[2000]'
    			),
    	);

    	$this->load->library('form_validation', $rule_set);                            // バリデーションクラス読み込み

    }

}
