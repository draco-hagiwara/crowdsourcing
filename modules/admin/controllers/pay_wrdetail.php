<?php

class Pay_wrdetail extends MY_Controller
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

        // 入金リスト＆件数を取得
        $this->load->model('Writer_info', 'wrinfo', TRUE);

        $tmp_inputpost                      = $this->input->post();
        $tmp_inputpost['wi_id']             = NULL;
        $tmp_inputpost['wi_wr_id']          = NULL;
        $tmp_inputpost['wi_pj_id']          = NULL;
        $tmp_inputpost['wi_pay_status']     = NULL;
        $tmp_inputpost['wr_pay_limit_date'] = NULL;
        $tmp_inputpost['pj_title']          = NULL;
        $tmp_inputpost['check_date_st']     = date('Y/m/d', strtotime("-1 month"));
        $tmp_inputpost['check_date_ed']     = NULL;
        $tmp_inputpost['pay_date_st']       = NULL;
        $tmp_inputpost['pay_date_ed']       = NULL;

        // セッションをフラッシュデータとして保存
        $data = array(
        		'a_check_date_st' => date('Y/m/d', strtotime("-1 month")),
        );
        $this->session->set_userdata($data);

        $tmp_per_page = 20;
        list($point_list, $point_countall) = $this->wrinfo->get_pointlist($tmp_inputpost, $tmp_per_page, $tmp_offset);

        // Pagination 設定
        $set_pagination = $this->_get_Pagination($point_countall, $tmp_per_page, NULL);

        $this->smarty->assign('listall',        $point_list);

        $this->smarty->assign('set_pagination', $set_pagination['page_link']);
        $this->smarty->assign('countall',       $point_countall);

        $tmp_inputpost['check_date_st'] = date('Y/m/d', strtotime("-1 month"));
        $this->smarty->assign('serch_item',     $tmp_inputpost);

        $this->view('admin/pay_wrdetail/index.tpl');

    }

    // 一覧表示
    public function search()
    {

        $tmp_inputpost = array();
        if (($this->input->post('submit') == '_submit') OR ($this->input->post('submit') == '_dlcsv'))
        {
            // セッションをフラッシュデータとして保存
            $data = array(
                    'a_wi_wr_id'          => $this->input->post('wi_wr_id'),
                    'a_wi_pj_id'          => $this->input->post('wi_pj_id'),
                    'a_wi_pay_status'     => $this->input->post('wi_pay_status'),
                    'a_wr_pay_limit_date' => $this->input->post('wr_pay_limit_date'),
                    'a_pj_title'          => $this->input->post('pj_title'),
            		'a_check_date_st'     => $this->input->post('check_date_st'),
                    'a_check_date_ed'     => $this->input->post('check_date_ed'),
                    'a_pay_date_st'       => $this->input->post('pay_date_st'),
                    'a_pay_date_ed'       => $this->input->post('pay_date_ed'),
            );
            $this->session->set_userdata($data);

            $tmp_inputpost = $this->input->post();
            $tmp_inputpost['wi_id']             = NULL;
            unset($tmp_inputpost["submit"]);

        } else {
            // セッションからフラッシュデータ読み込み
        	$tmp_inputpost['wi_id']             = NULL;
            $tmp_inputpost['wi_wr_id']          = $this->session->userdata('a_wi_wr_id');
            $tmp_inputpost['wi_pj_id']          = $this->session->userdata('a_wi_pj_id');
            $tmp_inputpost['wi_pay_status']     = $this->session->userdata('a_wi_pay_status');
            $tmp_inputpost['wr_pay_limit_date'] = $this->session->userdata('a_wr_pay_limit_date');
            $tmp_inputpost['pj_title']          = $this->session->userdata('a_pj_title');
            $tmp_inputpost['check_date_st']     = $this->session->userdata('a_check_date_st');
            $tmp_inputpost['check_date_ed']     = $this->session->userdata('a_check_date_ed');
            $tmp_inputpost['pay_date_st']       = $this->session->userdata('a_pay_date_st');
            $tmp_inputpost['pay_date_ed']       = $this->session->userdata('a_pay_date_ed');
        }

        $this->load->model('Writer_info', 'wrinfo', TRUE);

        // バリデーション・チェック
        $this->_set_validation();                                            // バリデーション設定
        if ($this->form_validation->run() == FALSE)
        {
        	$tmp_inputpost                      = $this->input->post();
        	$tmp_inputpost['wi_id']             = NULL;
        	$tmp_inputpost['wi_wr_id']          = NULL;
        	$tmp_inputpost['wi_pj_id']          = NULL;
        	$tmp_inputpost['wi_pay_status']     = NULL;
        	$tmp_inputpost['wr_pay_limit_date'] = NULL;
        	$tmp_inputpost['pj_title']          = NULL;
        	$tmp_inputpost['check_date_st']     = date('Y/m/d', strtotime("-1 month"));
        	$tmp_inputpost['check_date_ed']     = NULL;
        	$tmp_inputpost['pay_date_st']       = NULL;
        	$tmp_inputpost['pay_date_ed']       = NULL;

        	// セッションをフラッシュデータとして保存
        	$data = array(
        			'a_check_date_st' => date('Y/m/d', strtotime("-1 month")),
        	);
        	$this->session->set_userdata($data);

        } else {

        	// CSVデータ作成＆ダウンロード
        	if ($this->input->post('submit') == '_dlcsv')
        	{

        		// 請求リスト＆件数(max1000件)を取得
        		$tmp_offset = 0;
        		$tmp_per_page = 1000;
        		$query = $this->wrinfo->get_wrdetail_query($tmp_inputpost, $tmp_per_page, $tmp_offset, '0');

        		// 作成したヘルパーを読み込む
        		$this->load->helper(array('download', 'csvdata'));

        		// ヘルパーに追加した関数を呼び出し、CSVデータ取得
        		$get_pay_csv = csv_from_result($query);

        		$file_name = 'dl_wr_paydetail_' . date('YmdHis') . '.csv';
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

        // 入金リスト＆件数を取得
        $tmp_per_page = 20;
        list($point_list, $point_countall) = $this->wrinfo->get_pointlist($tmp_inputpost, $tmp_per_page, $tmp_offset, "a");

        // Pagination 設定
        $set_pagination = $this->_get_Pagination($point_countall, $tmp_per_page);

        // 検索項目 初期値セット
        $this->_search_set();

        $this->smarty->assign('listall',        $point_list);

        $this->smarty->assign('set_pagination', $set_pagination['page_link']);
        $this->smarty->assign('countall',       $point_countall);
        $this->smarty->assign('serch_item',     $tmp_inputpost);

        $this->view('admin/pay_wrdetail/index.tpl');

    }

    // ライター 入金情報編集
    public function detail()
    {

    	// 初期値セット
    	$this->_search_set();

    	// 更新対象 入金データ取得
        $this->load->model('Writer_info', 'wrinfo', TRUE);

    	$tmp_inputpost                      = $this->input->post();
    	$tmp_inputpost['wi_id']             = $this->input->post('wiid_uniq');
    	$tmp_inputpost['wi_wr_id']          = NULL;
    	$tmp_inputpost['wi_pj_id']          = NULL;
    	$tmp_inputpost['wi_pay_status']     = NULL;
    	$tmp_inputpost['wr_pay_limit_date'] = NULL;
    	$tmp_inputpost['pj_title']          = NULL;
    	$tmp_inputpost['check_date_st']     = NULL;
    	$tmp_inputpost['check_date_ed']     = NULL;
    	$tmp_inputpost['pay_date_st']       = NULL;
    	$tmp_inputpost['pay_date_ed']       = NULL;

    	$tmp_per_page = 1;
    	$tmp_offset   = 0;
        list($point_list, $point_countall) = $this->wrinfo->get_pointlist($tmp_inputpost, $tmp_per_page, $tmp_offset, "a");

    	$this->smarty->assign('list', $point_list[0]);

    	// バリデーション設定
    	$this->_set_validation01();

    	$this->view('admin/pay_wrdetail/detail.tpl');

    }

    // ライター 入金情報チェック＆更新
    public function detailchk()
    {

    	// 初期値セット
    	$this->_search_set();

    	// 入力データ取得
    	$input_post = $this->input->post();
    	$this->load->model('Writer_info', 'wrinfo', TRUE);

    	$this->_set_validation01();                                         // バリデーション設定
    	if ($this->form_validation->run() == FALSE)
    	{
    	} else {

    		// 「ライター個別情報」更新
    		$set_update_data = array();
    		$set_update_data['wi_id']           = $this->input->post('wi_id');					// ライター個別情報ID
    		$set_update_data['wi_pay_status']   = $this->input->post('wi_pay_status');			// 入金状況
    		$set_update_data['wi_point_adjust'] = $this->input->post('wi_point_adjust');		// 調整ポイント
    		$set_update_data['wi_pay_money']    = $this->input->post('wi_pay_money');			// ポイント合計
    		if ($this->input->post('wi_pay_schedule') != '')
    		{
    			$set_update_data['wi_pay_schedule'] = $this->input->post('wi_pay_schedule');		// 入金予定日
    		} else {
    			$set_update_data['wi_pay_schedule'] = NULL;
    		}
    		if ($this->input->post('wi_pay_date') != '')
    		{
    			$set_update_data['wi_pay_date']     = $this->input->post('wi_pay_date');			// 入金日
    		} else {
    			$set_update_data['wi_pay_date']     = NULL;
    		}
    		$time = time();
    		$set_update_data['wi_update_date'] = date("Y-m-d H:i:s", $time);                        // 更新日

    		// UPDATE <- 'tb_writer_info'
    		$this->wrinfo->update_wi_pay($set_update_data);

    	}

    	$this->smarty->assign('list', $this->input->post());

    	$this->view('admin/pay_wrdetail/detail.tpl');

    }

    // Pagination 設定
    private function _get_Pagination($entry_countall, $tmp_per_page)
    {

        $config['base_url']       = base_url() . '/pay_wrdetail/search/';   // ページの基本URIパス。「/コントローラクラス/アクションメソッド/」
        $config['per_page']       = $tmp_per_page;                          // 1ページ当たりの表示件数。
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
        //$this->config->load('config_comm');
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

    }

    // フォーム・バリデーションチェック
    private function _set_validation()
    {

        $rule_set = array(
                array(
                        'field'   => 'wi_pj_id',
                        'label'   => '作業ID',
                        'rules'   => 'trim|numeric'
                ),
                array(
                        'field'   => 'wi_wr_id',
                        'label'   => 'ライターID',
                        'rules'   => 'trim|numeric'
                ),
                array(
                        'field'   => 'wi_pay_status',
                        'label'   => '入金有無',
                        'rules'   => 'trim|numeric'
                ),
                array(
                        'field'   => 'wr_bk_limit_date',
                        'label'   => '締日設定',
                        'rules'   => 'trim|numeric'
                ),
        		array(
                        'field'   => 'pj_title',
                        'label'   => '作業件名',
                        'rules'   => 'trim|max_length[50]'
                ),
                array(
                        'field'   => 'check_date_st',
                        'label'   => 'ポイント獲得日',
                        'rules'   => 'trim|regex_match[/^\d{4}\/\d{1,2}\/\d{1,2}+$/]|max_length[10]'
                ),
                array(
                        'field'   => 'check_date_ed',
                        'label'   => 'ポイント獲得日',
                        'rules'   => 'trim|regex_match[/^\d{4}\/\d{1,2}\/\d{1,2}+$/]|max_length[10]'
                ),
                array(
                        'field'   => 'pay_date_st',
                        'label'   => '入金日',
                        'rules'   => 'trim|regex_match[/^\d{4}\/\d{1,2}\/\d{1,2}+$/]|max_length[10]'
                ),
                array(
                        'field'   => 'pay_date_ed',
                        'label'   => '入金日',
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
    					'field'   => 'wi_pay_status',
    					'label'   => '入金状況',
    					'rules'   => 'trim|required|numeric'
    			),
    			array(
    					'field'   => 'wi_point_adjust',
    					'label'   => '調整ポイント',
    					'rules'   => 'trim|numeric|max_length[9]'
    			),
    			array(
    					'field'   => 'wi_pay_money',
    					'label'   => 'ポイント合計',
    					'rules'   => 'trim|required|numeric|max_length[9]'
    			),
    			array(
    					'field'   => 'wi_pay_schedule',
    					'label'   => '入金予定日',
    					'rules'   => 'trim|regex_match[/^\d{4}-\d{1,2}-\d{1,2}+$/]|max_length[10]'
    			),
    			array(
    					'field'   => 'wi_pay_date',
    					'label'   => '入金日',
    					'rules'   => 'trim|regex_match[/^\d{4}-\d{1,2}-\d{1,2}+$/]|max_length[10]'
    			),
    	);

    	$this->load->library('form_validation', $rule_set);                            // バリデーションクラス読み込み

    }

}
