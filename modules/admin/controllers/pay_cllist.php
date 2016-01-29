<?php

class Pay_cllist extends MY_Controller
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
        $this->load->model('Client', 'cl', TRUE);

        $tmp_inputpost                = $this->input->post();
        $tmp_inputpost['cp_cl_id']    = NULL;
        $tmp_inputpost['cp_status']   = NULL;
        $tmp_inputpost['pay_date_st'] = date('Y/m/d', strtotime("-1 month"));;
        $tmp_inputpost['pay_date_ed'] = NULL;

        // セッションをフラッシュデータとして保存
        $data = array(
        		'a_pay_date_st' => date('Y/m/d', strtotime("-1 month")),
        );
        $this->session->set_userdata($data);

        $tmp_per_page = 20;
        list($pay_list, $pay_countall) = $this->cl->get_paycllist($tmp_inputpost, $tmp_per_page, $tmp_offset);

        // Pagination 設定
        $set_pagination = $this->_get_Pagination($pay_countall, $tmp_per_page, NULL);

        $this->smarty->assign('listall',        $pay_list);

        $this->smarty->assign('set_pagination', $set_pagination['page_link']);
        $this->smarty->assign('countall',       $pay_countall);

        $this->smarty->assign('serch_item',     $tmp_inputpost);

        $this->view('admin/pay_cllist/index.tpl');

    }

    // 一覧表示
    public function search()
    {

        $tmp_inputpost = array();
        if (($this->input->post('submit') == '_submit') OR ($this->input->post('submit') == '_dlcsv'))
        {
            // セッションをフラッシュデータとして保存
            $data = array(
                    'a_cp_cl_id'    => $this->input->post('cp_cl_id'),
            		'a_cp_status'   => $this->input->post('cp_status'),
                    'a_pay_date_st' => $this->input->post('pay_date_st'),
                    'a_pay_date_ed' => $this->input->post('pay_date_ed'),
            );
            $this->session->set_userdata($data);

            $tmp_inputpost = $this->input->post();
            unset($tmp_inputpost["submit"]);

        } else {
            // セッションからフラッシュデータ読み込み
            $tmp_inputpost['cp_cl_id']    = $this->session->userdata('a_cp_cl_id');
            $tmp_inputpost['cp_status']   = $this->session->userdata('a_cp_status');
            $tmp_inputpost['pay_date_st'] = $this->session->userdata('a_pay_date_st');
            $tmp_inputpost['pay_date_ed'] = $this->session->userdata('a_pay_date_ed');
        }

        $this->load->model('Client', 'cl', TRUE);

        // バリデーション・チェック
        $this->_set_validation();                                            // バリデーション設定
        if ($this->form_validation->run() == FALSE)
        {

        	$tmp_inputpost                = $this->input->post();
        	$tmp_inputpost['cp_cl_id']    = NULL;
        	$tmp_inputpost['cp_status']   = NULL;
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
        		$query = $this->cl->get_paycllist_query($tmp_inputpost, $tmp_per_page, $tmp_offset, '0');

        		// 作成したヘルパーを読み込む
        		$this->load->helper(array('download', 'csvdata'));

        		// ヘルパーに追加した関数を呼び出し、CSVデータ取得
        		$get_pay_csv = csv_from_result($query);

        		$file_name = 'dl_cl_paylist_' . date('YmdHis') . '.csv';
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
        list($pay_list, $pay_countall) = $this->cl->get_paycllist($tmp_inputpost, $tmp_per_page, $tmp_offset);

        // Pagination 設定
        $set_pagination = $this->_get_Pagination($pay_countall, $tmp_per_page);

        // 検索項目 初期値セット
        $this->_search_set();

        $this->smarty->assign('listall',        $pay_list);

        $this->smarty->assign('set_pagination', $set_pagination['page_link']);
        $this->smarty->assign('countall',       $pay_countall);
        $this->smarty->assign('serch_item',     $tmp_inputpost);

        $this->view('admin/pay_cllist/index.tpl');

    }

    // クライアント 請求情報編集
    public function detail()
    {

    	// 初期値セット
    	$this->_search_set();

    	// 更新対象 請求データ取得
    	$this->load->model('Client',  'cl', TRUE);

    	$tmp_inputpost                     = $this->input->post();
    	$tmp_inputpost['cp_id']            = $this->input->post('cpid_uniq');
    	$get_client_pay = $this->cl->get_client_pay($tmp_inputpost['cp_id']);

    	$this->smarty->assign('list', $get_client_pay[0]);

    	// 「会社名」取得
    	$get_company = $this->cl->get_client_name($get_client_pay[0]['cp_cl_id']);
    	$this->smarty->assign('clcompany', $get_company[0]['cl_company']);


    	// バリデーション設定
    	$this->_set_validation01();

    	$this->view('admin/pay_cllist/detail.tpl');

    }

    // クライアント 請求情報チェック＆更新
    public function detailchk()
    {

    	// 初期値セット
    	$this->_search_set();

    	// 入力データ取得
    	$input_post = $this->input->post();
    	$this->load->model('Client',  'cl', TRUE);

    	$this->_set_validation01();                                         // バリデーション設定
    	if ($this->form_validation->run() == FALSE)
    	{
    	} else {

    		// トランザクション・START
    		//$this->db->trans_strict(FALSE);                                 // StrictモードをOFF
    		//$this->db->trans_start();                                       // trans_begin

    		// 「クライアント支払情報」更新
    		$set_update_data = array();
    		$set_update_data['cp_id']               = $this->input->post('cp_id');					// 支払情報ID
    		$set_update_data['cp_status']           = $this->input->post('cp_status');				// 支払状況
    		$set_update_data['cp_pay_fix']          = $this->input->post('cp_pay_fix');				// 月額固定
    		$set_update_data['cp_pay_writer']       = $this->input->post('cp_pay_writer');			// ライター発注額
    		$set_update_data['cp_pay_result']       = $this->input->post('cp_pay_result');			// 成果報酬
    		$set_update_data['cp_pay_adjust']       = $this->input->post('cp_pay_adjust');			// 調整額
    		$set_update_data['cp_pay_taxrate']      = $this->input->post('cp_pay_taxrate');			// 消費税率
    		$set_update_data['cp_pay_tax']          = $this->input->post('cp_pay_tax');				// 消費税額
    		$set_update_data['cp_pay_total']        = $this->input->post('cp_pay_total');			// 総合計
    		$set_update_data['cp_contract_initial'] = $this->input->post('cp_contract_initial');	// 初期費用
    		$set_update_data['cp_contract_id']      = $this->input->post('cp_contract_id');			// 手数料ID
    		$set_update_data['cp_contract_fix']     = $this->input->post('cp_contract_fix');		// 固定手数料
    		$set_update_data['cp_contract_result']  = $this->input->post('cp_contract_result');		// 成果手数料
    		$set_update_data['cp_contract_taxrule'] = $this->input->post('cp_contract_taxrule');	// 消費税計算
    		$set_update_data['cp_contract_calrule'] = $this->input->post('cp_contract_calrule');	// 計算方法
    		$set_update_data['cp_comment']          = $this->input->post('cp_comment');				// メモ

    		// UPDATE <- 'tb_client_pay'
    		$this->cl->update_client_pay($set_update_data);

    		// トランザクション・COMMIT
    		//$this->db->trans_complete();                                    // trans_rollback & trans_commit
    		//if ($this->db->trans_status() === FALSE)
    		//{
    		//    log_message('error', 'ADMIN::[Pay_cldetail()]クライアント請求処理 トランザクションエラー');
    		//}
    	}

    	$this->smarty->assign('list', $this->input->post());
    	$this->smarty->assign('clcompany', $this->input->post('cl_company'));

    	$this->view('admin/pay_cllist/detail.tpl');

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
        		'0' => '未支払',
        		'1' => '支払済',
        		'2' => '保　留',
        		'3' => '返　金',
        );
        $this->smarty->assign('options_paystatus',  $arroptions_paystatus);

        $arroptions_paystate   = $this->config->item('CLIENT_PAY_FLG');
        $arroptions_payfee     = $this->config->item('CLIENT_FEE');
        $arroptions_paytaxrule = $this->config->item('TAX_INOUT');
        $arroptions_paytaxcal  = $this->config->item('TAX_CAL');

        $this->smarty->assign('options_paystate',   $arroptions_paystate);
        $this->smarty->assign('options_payfee',     $arroptions_payfee);
        $this->smarty->assign('options_paytaxrule', $arroptions_paytaxrule);
        $this->smarty->assign('options_paytaxcal',  $arroptions_paytaxcal);

    }

    // フォーム・バリデーションチェック
    private function _set_validation()
    {

        $rule_set = array(
                array(
                        'field'   => 'cp_cl_id',
                        'label'   => 'クライアントID',
                        'rules'   => 'trim|numeric'
                ),
                array(
                        'field'   => 'cp_status',
                        'label'   => '支払有無',
                        'rules'   => 'trim|numeric'
                ),
                array(
                        'field'   => 'pay_date_st',
                        'label'   => '請求予定日(開始)',
                        'rules'   => 'trim|regex_match[/^\d{4}\/\d{1,2}\/\d{1,2}+$/]|max_length[10]'
                ),
                array(
                        'field'   => 'pay_date_ed',
                        'label'   => '請求予定日(終了)',
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
    					'field'   => 'cp_status',
    					'label'   => '支払状況',
    					'rules'   => 'trim|numeric'
    			),
    			array(
    					'field'   => 'cp_pay_fix',
    					'label'   => '月額固定',
    					'rules'   => 'trim|numeric|max_length[9]'
    			),
    			array(
    					'field'   => 'cp_pay_writer',
    					'label'   => 'ライター発注額',
    					'rules'   => 'trim|numeric|max_length[9]'
    			),
    			array(
    					'field'   => 'cp_pay_result',
    					'label'   => '成果報酬',
    					'rules'   => 'trim|numeric|max_length[9]'
    			),
    			array(
    					'field'   => 'cp_pay_adjust',
    					'label'   => '調整額',
    					'rules'   => 'trim|numeric|max_length[9]'
    			),
    			array(
    					'field'   => 'cp_pay_taxrate',
    					'label'   => '消費税率',
    					'rules'   => 'trim|regex_match[/^[0](\.\d{1,2})+$/]|less_than[0.11]'
    			),
    			array(
    					'field'   => 'cp_pay_tax',
    					'label'   => '消費税額',
    					'rules'   => 'trim|numeric|max_length[9]'
    			),
    			array(
    					'field'   => 'cp_pay_total',
    					'label'   => '総合計',
    					'rules'   => 'trim|required|numeric|max_length[9]'
    			),
    			array(
    					'field'   => 'cp_contract_initial',
    					'label'   => '初期費用',
    					'rules'   => 'trim|numeric|max_length[9]'
    			),
    			array(
    					'field'   => 'cp_contract_id',
    					'label'   => '手数料ID',
    					'rules'   => 'trim|numeric'
    			),
    			array(
    					'field'   => 'cp_contract_fix',
    					'label'   => '固定手数料',
    					'rules'   => 'trim|numeric|max_length[9]'
    			),
    			array(
    					'field'   => 'cp_contract_result',
    					'label'   => '成果手数料',
    					'rules'   => 'trim|numeric|max_length[9]'
    			),
    			array(
    					'field'   => 'cp_contract_taxrule',
    					'label'   => '消費税計算',
    					'rules'   => 'trim|numeric'
    			),
    			array(
    					'field'   => 'cp_contract_calrule',
    					'label'   => '計算方法',
    					'rules'   => 'trim|numeric'
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
