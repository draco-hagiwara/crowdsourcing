<?php

class Pay_cldetail extends MY_Controller
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

        // 請求リスト＆件数を取得
        $this->load->model('Project', 'pj', TRUE);

        $tmp_inputpost                     = $this->input->post();
        $tmp_inputpost['pj_en_cl_id']      = NULL;
        $tmp_inputpost['pj_pay_status']    = NULL;
        $tmp_inputpost['pj_id']            = NULL;
        $tmp_inputpost['pj_title']         = NULL;
        $tmp_inputpost['delivery_date_st'] = date('Y/m/d', strtotime("-1 month"));
        $tmp_inputpost['delivery_date_ed'] = NULL;
        $tmp_inputpost['pay_date_st']      = NULL;
        $tmp_inputpost['pay_date_ed']      = NULL;

        // セッションをフラッシュデータとして保存
        $data = array(
        		'a_delivery_date_st' => date('Y/m/d', strtotime("-1 month")),
        );
        $this->session->set_userdata($data);

        $tmp_per_page = 20;
        list($point_list, $point_countall) = $this->pj->get_pointlist($tmp_inputpost, $tmp_per_page, $tmp_offset, '0');

        // Pagination 設定
        $set_pagination = $this->_get_Pagination($point_countall, $tmp_per_page, NULL);

        $this->smarty->assign('listall',        $point_list);

        $this->smarty->assign('set_pagination', $set_pagination['page_link']);
        $this->smarty->assign('countall',       $point_countall);

        $tmp_inputpost['delivery_date_st'] = date('Y/m/d', strtotime("-1 month"));
        $this->smarty->assign('serch_item',     $tmp_inputpost);

        $this->view('admin/pay_cldetail/index.tpl');

    }

    // 一覧表示
    public function search()
    {

        $tmp_inputpost = array();
        if (($this->input->post('submit') == '_submit') OR ($this->input->post('submit') == '_dlcsv'))
        {
            // セッションをフラッシュデータとして保存
            $data = array(
            		'a_pj_en_cl_id'      => $this->input->post('pj_en_cl_id'),
            		'a_pj_pay_status'    => $this->input->post('pj_pay_status'),
            		'a_pj_id'            => $this->input->post('pj_id'),
                    'a_pj_title'         => $this->input->post('pj_title'),
                    'a_delivery_date_st' => $this->input->post('delivery_date_st'),
                    'a_delivery_date_ed' => $this->input->post('delivery_date_ed'),
                    'a_pay_date_st'      => $this->input->post('pay_date_st'),
                    'a_pay_date_ed'      => $this->input->post('pay_date_ed'),
            );
            $this->session->set_userdata($data);

            $tmp_inputpost = $this->input->post();
            unset($tmp_inputpost["submit"]);
        } else {
            // セッションからフラッシュデータ読み込み
            $tmp_inputpost['pj_en_cl_id']      = $this->session->userdata('a_pj_en_cl_id');
            $tmp_inputpost['pj_pay_status']    = $this->session->userdata('a_pj_pay_status');
            $tmp_inputpost['pj_id']            = $this->session->userdata('a_pj_id');
            $tmp_inputpost['pj_title']         = $this->session->userdata('a_pj_title');
            $tmp_inputpost['delivery_date_st'] = $this->session->userdata('a_delivery_date_st');
            $tmp_inputpost['delivery_date_ed'] = $this->session->userdata('a_delivery_date_ed');
            $tmp_inputpost['pay_date_st']      = $this->session->userdata('a_pay_date_st');
            $tmp_inputpost['pay_date_ed']      = $this->session->userdata('a_pay_date_ed');
        }

        $this->load->model('Project', 'pj', TRUE);

        // バリデーション・チェック
        $this->_set_validation();                                            // バリデーション設定
        if ($this->form_validation->run() == FALSE)
        {

	        $tmp_inputpost                     = $this->input->post();
	        $tmp_inputpost['pj_en_cl_id']      = NULL;
	        $tmp_inputpost['pj_pay_status']    = NULL;
	        $tmp_inputpost['pj_id']            = NULL;
	        $tmp_inputpost['pj_title']         = NULL;
	        $tmp_inputpost['delivery_date_st'] = date('Y/m/d', strtotime("-1 month"));
	        $tmp_inputpost['delivery_date_ed'] = NULL;
	        $tmp_inputpost['pay_date_st']      = NULL;
	        $tmp_inputpost['pay_date_ed']      = NULL;

	        // セッションをフラッシュデータとして保存
	        $data = array(
	        		'a_delivery_date_st' => date('Y/m/d', strtotime("-1 month")),
	        );

	        $this->session->set_userdata($data);

        } else {

	        // CSVデータ作成＆ダウンロード
	        if ($this->input->post('submit') == '_dlcsv')
	        {
	        	// 請求リスト＆件数(max1000件)を取得
	        	$tmp_offset = 0;
	        	$tmp_per_page = 1000;
	        	$query = $this->pj->get_cldetail_query($tmp_inputpost, $tmp_per_page, $tmp_offset, '0');

	        	// 作成したヘルパーを読み込む
	        	$this->load->helper(array('download', 'csvdata'));

	        	// ヘルパーに追加した関数を呼び出し、CSVデータ取得
	        	$get_pay_csv = csv_from_result($query);

	        	$file_name = 'dl_cl_paydetail_' . date('YmdHis') . '.csv';
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

        // 請求リスト＆件数を取得
        $tmp_per_page = 20;
        list($point_list, $point_countall) = $this->pj->get_pointlist($tmp_inputpost, $tmp_per_page, $tmp_offset, '0');

        // Pagination 設定
        $set_pagination = $this->_get_Pagination($point_countall, $tmp_per_page);

        // 検索項目 初期値セット
        $this->_search_set();

        $this->smarty->assign('listall',        $point_list);

        $this->smarty->assign('set_pagination', $set_pagination['page_link']);
        $this->smarty->assign('countall',       $point_countall);
        $this->smarty->assign('serch_item',     $tmp_inputpost);

        $this->view('admin/pay_cldetail/index.tpl');

    }

    // クライアント 請求情報編集
    public function detail()
    {

    	// 初期値セット
    	$this->_search_set();

    	// 更新対象 請求データ取得
        $this->load->model('Project', 'pj', TRUE);
        $this->load->model('Client',  'cl', TRUE);

        $tmp_inputpost                     = $this->input->post();
        $tmp_inputpost['pj_en_cl_id']      = NULL;
        $tmp_inputpost['pj_pay_status']    = NULL;
        $tmp_inputpost['pj_id']            = $this->input->post('pjid_uniq');
        $tmp_inputpost['pj_title']         = NULL;
        $tmp_inputpost['delivery_date_st'] = NULL;
        $tmp_inputpost['delivery_date_ed'] = NULL;
        $tmp_inputpost['pay_date_st']      = NULL;
        $tmp_inputpost['pay_date_ed']      = NULL;

        $tmp_per_page = 1;
        $tmp_offset   = 0;
        list($point_list, $point_countall) = $this->pj->get_pointlist($tmp_inputpost, $tmp_per_page, $tmp_offset, '1');

    	$this->smarty->assign('list', $point_list[0]);

    	// 「会社名」取得
    	$get_company = $this->cl->get_client_name($point_list[0]['pj_en_cl_id']);
    	$this->smarty->assign('clcompany', $get_company[0]['cl_company']);


    	// バリデーション設定
    	$this->_set_validation01();

    	$this->view('admin/pay_cldetail/detail.tpl');

    }

    // クライアント 請求情報チェック＆更新
    public function detailchk()
    {

    	// 初期値セット
    	$this->_search_set();

    	// 入力データ取得
    	$input_post = $this->input->post();
        $this->load->model('Project',     'pj', TRUE);
    	//$this->load->model('Writer_info', 'wi', TRUE);

    	$this->_set_validation01();                                         // バリデーション設定
    	if ($this->form_validation->run() == FALSE)
    	{
    	} else {

    	    // トランザクション・START
            //$this->db->trans_strict(FALSE);                                 // StrictモードをOFF
            //$this->db->trans_start();                                       // trans_begin

                // 「案件情報」更新
                $set_update_data = array();
                $set_update_data['pj_id']              = $this->input->post('pj_id');					// 案件ID
                //$set_update_data['pj_wi_point']        = $this->input->post('pj_wi_point');				// 獲得ポイント
                $set_update_data['pj_wi_point_adjust'] = $this->input->post('pj_wi_point_adjust');		// 調整ポイント
                $set_update_data['pj_delivery_date']   = $this->input->post('pj_delivery_date');		// 納品日
                $set_update_data['pj_pay_status']      = $this->input->post('pj_pay_status');			// 請求状況
                $set_update_data['pj_pay_money']       = $this->input->post('pj_pay_money');			// 請求金額
                if ($this->input->post('pj_pay_schedule') != '')
                {
                	$set_update_data['pj_pay_schedule'] = $this->input->post('pj_pay_schedule');		// 請求(予定)日
                } else {
                	$set_update_data['pj_pay_schedule'] = NULL;
                }
                if ($this->input->post('pj_pay_date') != '')
                {
                	$set_update_data['pj_pay_date']     = $this->input->post('pj_pay_date');			// 領収日
                } else {
                	$set_update_data['pj_pay_date']     = NULL;
                }
                $set_update_data['pj_creator_id']      = $this->session->userdata('a_personalID');		// 作成者ID
                $time = time();
                $set_update_data['pj_update_date'] = date("Y-m-d H:i:s", $time);                        // 更新日

                // UPDATE <- 'tb_project'
                $this->pj->update_pj_posting($set_update_data);


                // 「ライター個別情報」更新
                //$set_update_data = array();
                //$set_update_data['wi_wr_id']        = $this->input->post('pj_wr_id');					// ライターID
                //$set_update_data['wi_pj_id']        = $this->input->post('pj_id');					// 案件ID
                //$set_update_data['wi_point']        = $this->input->post('pj_wi_point');				// 獲得ポイント
                //$set_update_data['wi_point_adjust'] = $this->input->post('pj_wi_point_adjust');		// 調整ポイント
                ////$set_update_data['wi_pay_status']   = $this->input->post('pj_pay_status');			// 支払状況
                //$set_update_data['wi_pay_money']    = $this->input->post('pj_pay_money');				// 支払金額
                //$time = time();
                //$set_update_data['wi_update_date']  = date("Y-m-d H:i:s", $time);                     // 更新日

                // UPDATE <- 'tb_writer_info'
                //$this->wi->update_wi_posting($set_update_data);

            // トランザクション・COMMIT
            //$this->db->trans_complete();                                    // trans_rollback & trans_commit
            //if ($this->db->trans_status() === FALSE)
            //{
            //    log_message('error', 'ADMIN::[Pay_cldetail()]クライアント請求処理 トランザクションエラー');
            //}
    	}

    	$this->smarty->assign('list', $this->input->post());
    	$this->smarty->assign('clcompany', $this->input->post('cl_company'));

    	$this->view('admin/pay_cldetail/detail.tpl');

    }

    // Pagination 設定
    private function _get_Pagination($entry_countall, $tmp_per_page)
    {

        $config['base_url']       = base_url() . '/pay_cldetail/search/';   // ページの基本URIパス。「/コントローラクラス/アクションメソッド/」
        $config['per_page']       = $tmp_per_page;                          // 1ページ当たりの表示件数。
        $config['total_rows']     = $entry_countall;                        // 総件数。where指定するか？
        $config['uri_segment']    = 4;                                      // オフセット値がURIパスの何セグメント目とするか設定
        $config['num_links']      = 5;                                      // 現在のページ番号の左右にいくつのページ番号リンクを生成するか設定
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
        $arroptions_paystatus = array (
                ''  => '選択してください',
                '0' => '未支払',
                '1' => '支払済',
                '2' => '保　留',
                '3' => '返　金',
        );

        $this->smarty->assign('options_paystatus', $arroptions_paystatus);

    }

    // フォーム・バリデーションチェック
    private function _set_validation()
    {

        $rule_set = array(
                array(
                        'field'   => 'pj_en_cl_id',
                        'label'   => 'クライアントID',
                        'rules'   => 'trim|numeric'
                ),
                array(
                        'field'   => 'pj_id',
                        'label'   => '作業ID',
                        'rules'   => 'trim|numeric'
                ),
        		array(
                        'field'   => 'pj_title',
                        'label'   => '作業件名',
                        'rules'   => 'trim|max_length[100]'
                ),
                array(
                        'field'   => 'delivery_date_st',
                        'label'   => '納品日',
                        'rules'   => 'trim|regex_match[/^\d{4}\/\d{1,2}\/\d{1,2}+$/]|max_length[10]'
                ),
                array(
                        'field'   => 'delivery_date_ed',
                        'label'   => '納品日',
                        'rules'   => 'trim|regex_match[/^\d{4}\/\d{1,2}\/\d{1,2}+$/]|max_length[10]'
                ),
                array(
                        'field'   => 'pay_date_st',
                        'label'   => '支払日',
                        'rules'   => 'trim|regex_match[/^\d{4}\/\d{1,2}\/\d{1,2}+$/]|max_length[10]'
                ),
                array(
                        'field'   => 'pay_date_ed',
                        'label'   => '支払日',
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
    					'field'   => 'pj_pay_status',
    					'label'   => '支払状況',
    					'rules'   => 'trim|required|numeric'
    			),
    			array(
    					'field'   => 'pj_wi_point',
    					'label'   => '獲得ポイント',
    					'rules'   => 'trim|required|numeric|max_length[9]'
    			),
    			array(
    					'field'   => 'pj_wi_point_adjust',
    					'label'   => '調整ポイント',
    					'rules'   => 'trim|numeric|max_length[9]'
    			),
    			array(
    					'field'   => 'pj_delivery_date',
    					'label'   => '納品日',
    					'rules'   => 'trim|required|regex_match[/^\d{4}-\d{1,2}-\d{1,2} \d{1,2}:\d{1,2}+$/]|max_length[16]'
    			),
    			array(
    					'field'   => 'pj_pay_money',
    					'label'   => '請求金額',
    					'rules'   => 'trim|required|numeric|max_length[9]'
    			),
    			array(
    					'field'   => 'pj_pay_schedule',
    					'label'   => '請求(予定)日',
    					'rules'   => 'trim|regex_match[/^\d{4}-\d{1,2}-\d{1,2}+$/]|max_length[10]'
    			),
    			array(
    					'field'   => 'pj_pay_date',
    					'label'   => '領収日',
    					'rules'   => 'trim|regex_match[/^\d{4}-\d{1,2}-\d{1,2}+$/]|max_length[10]'
    			),
    	);

    	$this->load->library('form_validation', $rule_set);                            // バリデーションクラス読み込み

    }

}
