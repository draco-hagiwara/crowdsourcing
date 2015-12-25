<?php

class Orderlist extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();

        if ($this->session->userdata('c_login') == TRUE)
        {
            $this->smarty->assign('login_chk', TRUE);
            $this->smarty->assign('login_name', $this->session->userdata('c_memNAME'));
            $this->smarty->assign('auth_cd',    $this->session->userdata('c_authCD'));
        } else {
            $this->smarty->assign('login_chk', FALSE);

            redirect('/login/');
        }
    }

    // 案件一覧TOP
    public function index()
    {

        // セッションデータをクリア
        $this->load->model('comm_auth', 'comm_auth', TRUE);
        $this->comm_auth->delete_session('client');

        // セッションからフラッシュデータ読み込み
        $flash_data['c_memID'] = $this->session->userdata('c_memID');

        // バリデーション・チェック
        $this->_set_validation();                                            // バリデーション設定
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

        // 投稿記事情報のリスト＆件数を取得
        $this->load->model('Project', 'pj', TRUE);
        $tmp_inputpost = $this->input->post();
        list($listall, $countall) = $this->pj->get_entrylist($flash_data['c_memID'], $tmp_inputpost, $tmp_per_page, $tmp_offset);
        $this->smarty->assign('listall', $listall);

        // Pagination 設定
        $set_pagination = $this->_get_Pagination($countall, $tmp_per_page);

        $this->smarty->assign('set_pagination', $set_pagination['page_link']);
        $this->smarty->assign('countall',       $countall);
        $this->smarty->assign('serch_item',     $this->input->post());

        $this->view('client/orderlist/index.tpl');

    }

    // 一覧表示
    public function search()
    {

        // セッションからフラッシュデータ読み込み
        $flash_data['c_memID'] = $this->session->userdata('c_memID');

        // 検索項目の保存が上手くいかない。応急的に対応！
        if ($this->input->post('submit') == '_submit')
        {
            // セッションをフラッシュデータとして保存
            $data = array(
                    'c_pj_en_id'        => $this->input->post('pj_en_id'),
                    'c_pj_status'       => $this->input->post('pj_status'),
                    'c_pj_work_status'  => $this->input->post('pj_work_status'),
                    'c_pj_genre01'      => $this->input->post('pj_genre01'),
                    'c_pj_title'        => $this->input->post('pj_title'),
                    'c_pj_entry_status' => $this->input->post('pj_entry_status'),
                    'c_orderid'         => $this->input->post('orderid'),
                    'c_orderstatus'     => $this->input->post('orderstatus'),
            );
            $this->session->set_userdata($data);

            $tmp_inputpost = $this->input->post();
            unset($tmp_inputpost["submit"]);

        } else {
            // セッションからフラッシュデータ読み込み
            $tmp_inputpost['pj_en_id']        = $this->session->userdata('c_pj_en_id');
            $tmp_inputpost['pj_status']       = $this->session->userdata('c_pj_status');
            $tmp_inputpost['pj_work_status']  = $this->session->userdata('c_pj_work_status');
            $tmp_inputpost['pj_genre01']      = $this->session->userdata('c_pj_genre01');
            $tmp_inputpost['pj_title']        = $this->session->userdata('c_pj_title');
            $tmp_inputpost['pj_entry_status'] = $this->session->userdata('c_pj_entry_status');
            $tmp_inputpost['orderid']         = $this->session->userdata('c_orderid');
            $tmp_inputpost['orderstatus']     = $this->session->userdata('c_orderstatus');
        }

        // バリデーション・チェック
        $this->_set_validation();                                            // バリデーション設定
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

        // 投稿記事情報のリスト＆件数を取得
        $this->load->model('Project', 'pj', TRUE);
        list($listall, $countall) = $this->pj->get_entrylist($flash_data['c_memID'], $tmp_inputpost, $tmp_per_page, $tmp_offset);
        //list($listall, $countall) = $this->pj->get_postinglist($tmp_inputpost, $tmp_per_page, $tmp_offset);
        $this->smarty->assign('listall', $listall);

        // Pagination 設定
        $set_pagination = $this->_get_Pagination($countall, $tmp_per_page);

        // 検索項目 初期値セット
        $this->_search_set();

        $this->smarty->assign('set_pagination', $set_pagination['page_link']);
        $this->smarty->assign('countall',       $countall);
        $this->smarty->assign('serch_item',     $tmp_inputpost);
        $this->smarty->assign('not_disp',       FALSE);

        $this->view('client/orderlist/index.tpl');

    }

    // 案件内容
    public function detail00()
    {

        // セッションからフラッシュデータ読み込み
        $flash_data['c_pj_id'] = $this->session->userdata('c_pj_id');


        // 投稿内容データ 初期値セット
        $this->load->model('Project', 'pj', TRUE);


        // 選択された案件ID取得
        $input_post = $this->input->post();
        if (empty($input_post['pjid_uniq']))
        {
            // ２回目以降
            $tmp_pjid = $flash_data['c_pj_id'];
        } else {
            // 初回
            $tmp_pjid = $input_post['pjid_uniq'];
        }




        print("flash_data00 == ");
        print($tmp_pjid);
        print("<br><br>");




        $get_data = $this->pj->get_entry_list($tmp_pjid);

        // SELECT項目 初期値セット
        $this->_form_item_set00($get_data[0]['pj_en_cl_id']);

        $get_data[0]['pj_delivery_time'] = date('Y-m-d H:i', strtotime($get_data[0]['pj_delivery_time']));
        $get_data[0]['pj_start_time']    = date('Y-m-d H:i', strtotime($get_data[0]['pj_start_time']));
        $get_data[0]['pj_end_time']      = date('Y-m-d H:i', strtotime($get_data[0]['pj_end_time']));
        $get_data[0]['pj_en_entry_date'] = date('Y-m-d',     strtotime($get_data[0]['pj_en_entry_date']));

        $this->smarty->assign('entry_info', $get_data[0]);

        // session:フラッシュデータに案件ID書き込み
        $tmp_flash_pjid = array('c_pj_id' => $get_data[0]['pj_id']);
        $this->session->set_userdata( $tmp_flash_pjid);

        // バリデーション設定
        $this->_set_validation00();
        //$this->form_validation->run();

        // 作業件数有無チェック(作業1～3)
        $this->_get_job_cnt($tmp_pjid);

        $this->smarty->assign('entry_no', '00');
        $this->smarty->assign('not_disp', FALSE);

        $this->view('client/orderlist/detail.tpl');

    }

    // 納品案件１
    public function detail01()
    {

        // SELECT項目 初期値セット
        //$this->_search_set01();

        // セッションからフラッシュデータ読み込み＆書き込み
        $flash_data['c_pj_id'] = $this->session->userdata('c_pj_id');
        //$this->session->set_flashdata( $flash_data);


        print("flash_data01 == ");
        print_r($flash_data['c_pj_id']);
        print("<br><br>");


        // 投稿データ 初期値セット
        $this->load->model('Project_info', 'pji', TRUE);                    // models 読み込み
        $get_data = $this->pji->get_order_info($flash_data['c_pj_id'], $pji_seq = 0);

        $this->smarty->assign('entry_info', $get_data[0]);

        // バリデーション・チェック
        $this->_set_validation01();                                            // バリデーション設定
        //$this->form_validation->run();

        // 作業件数有無チェック(作業1～3)
        $this->_get_job_cnt($flash_data['c_pj_id']);

        $this->smarty->assign('entry_no', '01');
        $this->smarty->assign('not_disp', FALSE);

        $this->view('client/orderlist/detail.tpl');

    }

    // 納品案件２
    public function detail02()
    {

        // セッションからフラッシュデータ読み込み＆書き込み
        $flash_data['c_pj_id'] = $this->session->userdata('c_pj_id');
        //$this->session->set_flashdata( $flash_data);


        print("flash_data02 == ");
        print_r($flash_data['c_pj_id']);
        print("<br><br>");


        // 申請案件データ 初期値セット
        $this->load->model('Project_info', 'pji', TRUE);                    // models 読み込み
        $get_data = $this->pji->get_order_info($flash_data['c_pj_id'], $pji_seq = 1);
        if (empty($get_data))
        {
            // 各項目 初期値セット
            $this->_form_item_set01($flash_data['c_pj_id']);
            $this->smarty->assign('not_disp', TRUE);
        } else {
            // 各項目 初期値セット
            $this->_form_item_set01($flash_data['c_pj_id']);
            $this->smarty->assign('entry_info', $get_data[0]);
            $this->smarty->assign('not_disp', FALSE);
        }

        // バリデーション・チェック
        $this->_set_validation01();                                            // バリデーション設定
        //$this->form_validation->run();

        // 作業件数有無チェック(作業1～3)
        $this->_get_job_cnt($flash_data['c_pj_id']);

        $this->smarty->assign('entry_no', '02');
        $this->view('client/orderlist/detail.tpl');

    }

    // 納品案件３
    public function detail03()
    {

        // セッションからフラッシュデータ読み込み＆書き込み
        $flash_data['c_pj_id'] = $this->session->userdata('c_pj_id');
        //$this->session->set_flashdata( $flash_data);


        print("flash_data03 == ");
        print_r($flash_data['c_pj_id']);
        print("<br><br>");


        // 申請案件データ 初期値セット
        $this->load->model('Project_info', 'pji', TRUE);                    // models 読み込み
        $get_data = $this->pji->get_order_info($flash_data['c_pj_id'], $pji_seq = 2);
        if (empty($get_data))
        {
            // 各項目 初期値セット
            $this->_form_item_set01($flash_data['c_pj_id']);
            $this->smarty->assign('not_disp', TRUE);
        } else {
            // 各項目 初期値セット
            $this->_form_item_set01($flash_data['c_pj_id']);
            $this->smarty->assign('entry_info', $get_data[0]);
            $this->smarty->assign('not_disp', FALSE);
        }

        // バリデーション・チェック
        $this->_set_validation01();                                            // バリデーション設定
        //$this->form_validation->run();

        // 作業件数有無チェック(作業1～3)
        $this->_get_job_cnt($flash_data['c_pj_id']);

        $this->smarty->assign('entry_no', '03');
        $this->view('client/orderlist/detail.tpl');

    }

    // COPY & CUT ボタン選択後の後処理
    public function select_copy()
    {

        // TAB毎に処理振り分け
        if ($this->input->post('entry_no') == '01')
        {
            $this->detail01();
        } elseif ($this->input->post('entry_no') == '02')
        {
            $this->detail02();
        } elseif ($this->input->post('entry_no') == '02')
        {
            $this->detail02();
        } elseif ($this->input->post('entry_no') == '03')
        {
            $this->detail03();
        }
        return;

    }

    // CSVデータの出力
    public function output_csv()
    {

        // セッションからフラッシュデータ読み込み＆書き込み
        $flash_data['c_pj_id'] = $this->session->userdata('c_pj_id');

        // 対象データを取得
        $this->load->model('Report_info',  'rep', TRUE);
        $get_query = $this->rep->get_report_csv($flash_data['c_pj_id']);

        // 作成したヘルパーを読み込む
        $this->load->helper(array('download', 'csvdata'));

        // ヘルパーに追加した関数を呼び出し、CSVデータ取得
        $get_report_csv = csv_from_result($get_query);

        $file_name = 'get_report_' . date('YmdHis') . '.csv';
        force_download($file_name, $get_report_csv);

        $tmp_pjid = $flash_data['c_pj_id'];
        $get_data = $this->pj->get_posting($tmp_pjid);

        // SELECT項目 初期値セット
        $this->_form_item_set00($get_data[0]['pj_en_cl_id']);

        $get_data[0]['pj_delivery_time'] = date('Y-m-d H:i', strtotime($get_data[0]['pj_delivery_time']));
        $get_data[0]['pj_start_time']    = date('Y-m-d H:i', strtotime($get_data[0]['pj_start_time']));
        $get_data[0]['pj_end_time']      = date('Y-m-d H:i', strtotime($get_data[0]['pj_end_time']));
        $get_data[0]['pj_en_entry_date'] = date('Y-m-d',     strtotime($get_data[0]['pj_en_entry_date']));

        $this->smarty->assign('entry_info', $get_data[0]);

        // session:フラッシュデータに案件ID書き込み
        $tmp_flash_pjid = array('c_pj_id' => $get_data[0]['pj_id']);
        $this->session->set_userdata( $tmp_flash_pjid);

        // バリデーション設定
        $this->_set_validation00();
        //$this->form_validation->run();

        // 作業件数有無チェック(作業1～3)
        $this->_get_job_cnt($tmp_pjid);

        $this->smarty->assign('entry_no', '00');
        $this->smarty->assign('not_disp', FALSE);

        $this->view('client/orderlist/detail.tpl');

    }

    // Pagination 設定
    private function _get_Pagination($countall, $tmp_per_page)
    {

        $config['base_url']       = base_url() . '/orderlist/search/';        // ページの基本URIパス。「/コントローラクラス/アクションメソッド/」
        $config['per_page']       = $tmp_per_page;                            // 1ページ当たりの表示件数。
        $config['total_rows']     = $countall;                                // 総件数。where指定するか？
        $config['uri_segment']    = 4;                                        // オフセット値がURIパスの何セグメント目とするか設定
        $config['num_links']      = 5;                                        //現在のページ番号の左右にいくつのページ番号リンクを生成するか設定
        $config['full_tag_open']  = '<p class="pagination">';                // ページネーションリンク全体を階層化するHTMLタグの先頭タグ文字列を指定
        $config['full_tag_close'] = '</p>';                                    // ページネーションリンク全体を階層化するHTMLタグの閉じタグ文字列を指定
        $config['first_link']     = '最初へ';                                // 最初のページを表すテキスト。
        $config['last_link']      = '最後へ';                                // 最後のページを表すテキスト。
        $config['prev_link']      = '前へ';                                    // 前のページへのリンクを表わす文字列を指定
        $config['next_link']      = '次へ';                                    // 次のページへのリンクを表わす文字列を指定

        $this->load->library('pagination', $config);                        // Paginationクラス読み込み
        $set_page['page_link'] = $this->pagination->create_links();

        return $set_page;

    }

    // 作業件数有無チェック(作業1～3)
    private function _get_job_cnt($pj_id)
    {

        $this->load->model('Project', 'pj', TRUE);

        $get_infodata = $this->pj->get_entry_info($pj_id);
        $tmp_arr_cnt  = count($get_infodata);
        $this->smarty->assign('job_cnt', $tmp_arr_cnt);

    }

    // 検索項目 初期値セット
    private function _search_set()
    {

        // ステータス状態 選択項目セット
        $this->config->load('config_status');
        $arroptions_pjstatus = array (
                ''  => '選択してください',
                '0' => $this->config->item('PJ_STATUS_JYUNBI'),
                '1' => $this->config->item('PJ_STATUS_OPEN'),
                '2' => $this->config->item('PJ_STATUS_REOPEN'),
                //'3' => $this->config->item('PJ_STATUS_PREMIERE'),
                //'4' => $this->config->item('PJ_STATUS_NOMINATE'),
                //'5' => $this->config->item('PJ_STATUS_CLOSE'),
                '6' => $this->config->item('PJ_STATUS_END'),
                '8' => $this->config->item('PJ_STATUS_HORYU'),
                //'9' => $this->config->item('PJ_STATUS_DELETE'),
        );

        $arroptions_pjworkstatus = array (
                ''  => '選択してください',
                '0' => $this->config->item('PJ_WSTATUS_ENTRY'),
                '1' => $this->config->item('PJ_WSTATUS_CREATE'),
                '2' => $this->config->item('PJ_WSTATUS_RECREATE'),
                '3' => $this->config->item('PJ_WSTATUS_CHECK'),
                '4' => $this->config->item('PJ_WSTATUS_CHECKOK'),
                '5' => $this->config->item('PJ_WSTATUS_CHECKNG'),
                '6' => $this->config->item('PJ_WSTATUS_TIMEOVER'),
                '7' => $this->config->item('PJ_WSTATUS_CANCEL'),
        );

        $arroptions_pjentrystatus = array (
                ''  => '選択してください',
                '0' => $this->config->item('PJ_ESTATUS_NOENTRY'),
                '1' => $this->config->item('PJ_ESTATUS_ENTRY'),
        );

        // ジャンル 選択項目セット
        $this->load->model('comm_select', 'select', TRUE);
        $genre_list = $this->select->get_genre();

        // 申請ID 並び替え選択項目セット
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

        $this->smarty->assign('options_pj_status',       $arroptions_pjstatus);
        $this->smarty->assign('options_pj_work_status',  $arroptions_pjworkstatus);
        $this->smarty->assign('options_pj_entry_status', $arroptions_pjentrystatus);
        $this->smarty->assign('options_genre_list',      $genre_list);
        $this->smarty->assign('options_orderid',         $arroptions_id);
        $this->smarty->assign('options_orderstatus',     $arroptions_status);

    }

    // 各項目 初期値セット :: 申請内容
    private function _form_item_set00($cl_id)
    {

        // ステータス状態 選択項目セット
        $this->config->load('config_status');
        $arroptions_pjstatus = array (
                '0' => $this->config->item('PJ_STATUS_JYUNBI'),
                '1' => $this->config->item('PJ_STATUS_OPEN'),
                '2' => $this->config->item('PJ_STATUS_REOPEN'),
                '3' => $this->config->item('PJ_STATUS_PREMIERE'),
                '4' => $this->config->item('PJ_STATUS_NOMINATE'),
                '5' => $this->config->item('PJ_STATUS_CLOSE'),
                '6' => $this->config->item('PJ_STATUS_END'),
                '9' => $this->config->item('PJ_STATUS_DELETE'),
        );

        $arroptions_pjworkstatus = array (
                ''  => '選択してください',
                '0' => $this->config->item('PJ_WSTATUS_ENTRY'),
                '1' => $this->config->item('PJ_WSTATUS_CREATE'),
                '2' => $this->config->item('PJ_WSTATUS_RECREATE'),
                '3' => $this->config->item('PJ_WSTATUS_CHECK'),
                '4' => $this->config->item('PJ_WSTATUS_CHECKOK'),
                '5' => $this->config->item('PJ_WSTATUS_CHECKNG'),
                '6' => $this->config->item('PJ_WSTATUS_TIMEOVER'),
                '7' => $this->config->item('PJ_WSTATUS_CANCEL'),
        );

        $delivre_flg = $this->config->item('PJ_DELIVER_FLG');


        // ジャンル 選択項目セット
        $this->load->model('comm_select', 'select', TRUE);
        $genre_list = $this->select->get_genre();

        // 会員ランク 選択項目セット
        $memrank_list = $this->select->get_memrank();

        // 加算単価情報 難易度セット
        $this->config->load('config_comm');
        $arroptions_diff = array (
                '0' => $this->config->item('ADDTANKA_KANTAN'),
                '1' => $this->config->item('ADDTANKA_FUTUU'),
                '2' => $this->config->item('ADDTANKA_NAN'),
        );
        $tankaadd_list = $this->select->get_tankaadd($cl_id);

        $this->smarty->assign('options_pj_status',       $arroptions_pjstatus);
        $this->smarty->assign('options_pj_work_status',  $arroptions_pjworkstatus);
        $this->smarty->assign('options_pj_deliver_flg',  $delivre_flg);
        $this->smarty->assign('options_genre_list',      $genre_list);
        $this->smarty->assign('options_memrank_list',    $memrank_list);
        $this->smarty->assign('options_difficulty_id',   $arroptions_diff);
        $this->smarty->assign('options_tankaadd_list',   $tankaadd_list);




        // レコード作成後に、格納データを表示するために必要
        //$set_val['en_entry_title']   = '';
        //$set_val['en_title']         = '';
        //$set_val['en_work']          = '';
        //$set_val['en_notice']        = '';
        //$set_val['en_example']       = '';
        //$set_val['en_other']         = '';
        //$set_val['en_addwork']       = '';
        //$set_val['en_word_tanka']    = '0.0';
        //$set_val['en_open_date']     = '';
        //$set_val['en_delivery_date'] = '';
        //$set_val['en_comment']       = '';

        //$this->smarty->assign('set_val',   $set_val);

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
                        'field'   => 'pj_en_id',
                        'label'   => '申請ID',
                        'rules'   => 'trim|numeric'
                ),
                array(
                        'field'   => 'pj_status',
                        'label'   => 'ステータス',
                        'rules'   => 'trim|numeric'
                ),
                array(
                        'field'   => 'pj_work_status',
                        'label'   => '作業ステータス',
                        'rules'   => 'trim|max_length[100]'
                ),
                array(
                        'field'   => 'en_genre01',
                        'label'   => 'ジャンル',
                        'rules'   => 'trim|numeric'
                ),
                array(
                        'field'   => 'pj_title',
                        'label'   => '案件タイトル',
                        'rules'   => 'trim|max_length[100]'
                ),
                array(
                        'field'   => 'pj_entry_status',
                        'label'   => 'エントリー',
                        'rules'   => 'trim|numeric'
                ),
        );

        $this->load->library('form_validation', $rule_set);                            // バリデーションクラス読み込み

    }


    // フォーム・バリデーションチェック:案件内容
    private function _set_validation00()
    {

        $rule_set = array(
                //array(
                //        'field'   => 'en_status',
                //        'label'   => 'ステータス (状態)',
                //        'rules'   => 'trim|required'
                //),
                //array(
                //        'field'   => 'en_entry_title',
                //        'label'   => 'タイトル（表示件名）',
                //        'rules'   => 'trim|required|max_length[100]'
                //),
                //array(
                //        'field'   => 'en_genre01',
                //        'label'   => '希望ジャンル',
                //        'rules'   => 'trim|required'
                //),
                //array(
                //        'field'   => 'en_title',
                //        'label'   => '案件申請：タイトル',
                //        'rules'   => 'trim|required|max_length[100]'
                //),
                //array(
                //        'field'   => 'en_work',
                //        'label'   => '案件申請：概要',
                //        'rules'   => 'trim|required|max_length[10000]'
                //),
                //array(
                //        'field'   => 'en_notice',
                //        'label'   => '案件申請：注意事項',
                //        'rules'   => 'trim|max_length[10000]'
                //),
                //array(
                //        'field'   => 'en_example',
                //        'label'   => '案件申請：例文',
                //        'rules'   => 'trim|max_length[10000]'
                //),
                //array(
                //        'field'   => 'en_other',
                //        'label'   => '案件申請：その他',
                //        'rules'   => 'trim|max_length[10000]'
                //),
                //array(
                //        'field'   => 'en_addwork',
                //        'label'   => '案件申請：追加内容',
                //        'rules'   => 'trim|max_length[10000]'
                //),
                //array(
                //        'field'   => 'en_word_tanka',
                //        'label'   => '個別文字単価指定',
                //        'rules'   => 'trim|decimal|max_length[4]'
                //),
                //array(
                //        'field'   => 'en_open_date',
                //        'label'   => '案件希望公開日',
                //        'rules'   => 'trim|required|regex_match[/^\d{4}-\d{1,2}-\d{1,2}+$/]|max_length[10]'
                //),
                //array(
                //        'field'   => 'en_delivery_date',
                //        'label'   => '案件希望納期',
                //        'rules'   => 'trim|required|regex_match[/^\d{4}-\d{1,2}-\d{1,2}+$/]|max_length[10]'
                //),
                //array(
                //        'field'   => 'en_comment',
                //        'label'   => '備考',
                //        'rules'   => 'trim|max_length[2000]'
                //),
                //array(
                //        'field'   => 'pj_addwork',
                //        'label'   => '追加内容',
                //        'rules'   => 'trim|max_length[10000]'
                //),

        );

        $this->load->library('form_validation', $rule_set);                            // バリデーションクラス読み込み

    }

    // フォーム・バリデーションチェック::申請案件１～３
    private function _set_validation01()
    {

        $rule_set = array(
        //        array(
        //                'field'   => 'ei_status',
        //                'label'   => '使用有無設定',
        //                'rules'   => ''
        //        ),
        //
        //        array(
        //                'field'   => 'ei_t_keyword01',
        //                'label'   => 'タイトル：必須ワード指定',
        //                'rules'   => 'trim|max_length[100]'
        //        ),
        //        array(
        //                'field'   => 'ei_t_keyword02',
        //                'label'   => 'タイトル：必須ワード指定',
        //                'rules'   => 'trim|max_length[100]'
        //        ),
        //        array(
        //                'field'   => 'ei_t_keyword03',
        //                'label'   => 'タイトル：必須ワード指定',
        //                'rules'   => 'trim|max_length[100]'
        //        ),
        //        array(
        //                'field'   => 'ei_t_count_min01',
        //                'label'   => 'タイトル：最低 使用回数',
        //                'rules'   => 'trim|max_length[3]'
        //        ),
        //        array(
        //                'field'   => 'ei_t_count_min02',
        //                'label'   => 'タイトル：最低 使用回数',
        //                'rules'   => 'trim|max_length[3]'
        //        ),
        //        array(
        //                'field'   => 'ei_t_count_min03',
        //                'label'   => 'タイトル：最低 使用回数',
        //                'rules'   => 'trim|max_length[3]'
        //        ),
        //        array(
        //                'field'   => 'ei_t_count_max01',
        //                'label'   => 'タイトル：最大 使用回数',
        //                'rules'   => 'trim|max_length[3]'
        //        ),
        //        array(
        //                'field'   => 'ei_t_count_max02',
        //                'label'   => 'タイトル：最大 使用回数',
        //                'rules'   => 'trim|max_length[3]'
        //        ),
        //        array(
        //                'field'   => 'ei_t_count_max03',
        //                'label'   => 'タイトル：最大 使用回数',
        //                'rules'   => 'trim|max_length[3]'
        //        ),
        //        array(
        //                'field'   => 'ei_t_char_min',
        //                'label'   => 'タイトル：最低 使用文字数',
        //                'rules'   => 'trim|max_length[4]'
        //        ),
        //        array(
        //                'field'   => 'ei_t_char_max',
        //                'label'   => 'タイトル：最大 使用文字数',
        //                'rules'   => 'trim|max_length[4]'
        //        ),
        //
        //        array(
        //                'field'   => 'ei_b_word01',
        //                'label'   => '本文：必須ワード指定',
        //                'rules'   => 'trim|max_length[10]'
        //        ),
        //        array(
        //                'field'   => 'ei_b_word02',
        //                'label'   => '本文：必須ワード指定',
        //                'rules'   => 'trim|max_length[10]'
        //        ),
        //        array(
        //                'field'   => 'ei_b_word03',
        //                'label'   => '本文：必須ワード指定',
        //                'rules'   => 'trim|max_length[10]'
        //        ),
        //        array(
        //                'field'   => 'ei_b_word04',
        //                'label'   => '本文：必須ワード指定',
        //                'rules'   => 'trim|max_length[10]'
        //        ),
        //        array(
        //                'field'   => 'ei_b_word05',
        //                'label'   => '本文：必須ワード指定',
        //                'rules'   => 'trim|max_length[10]'
        //        ),
        //        array(
        //                'field'   => 'ei_b_count_min01',
        //                'label'   => 'タイトル：最低 使用回数',
        //                'rules'   => 'trim|max_length[4]'
        //        ),
        //        array(
        //                'field'   => 'ei_b_count_min02',
        //                'label'   => 'タイトル：最低 使用回数',
        //                'rules'   => 'trim|max_length[4]'
        //        ),
        //        array(
        //                'field'   => 'ei_b_count_min03',
        //                'label'   => 'タイトル：最低 使用回数',
        //                'rules'   => 'trim|max_length[4]'
        //        ),
        //        array(
        //                'field'   => 'ei_b_count_min04',
        //                'label'   => 'タイトル：最低 使用回数',
        //                'rules'   => 'trim|max_length[4]'
        //        ),
        //        array(
        //                'field'   => 'ei_b_count_min05',
        //                'label'   => 'タイトル：最低 使用回数',
        //                'rules'   => 'trim|max_length[4]'
        //        ),
        //        array(
        //                'field'   => 'ei_b_count_max01',
        //                'label'   => 'タイトル：最大 使用回数',
        //                'rules'   => 'trim|max_length[4]'
        //        ),
        //        array(
        //                'field'   => 'ei_b_count_max02',
        //                'label'   => 'タイトル：最大 使用回数',
        //                'rules'   => 'trim|max_length[4]'
        //        ),
        //        array(
        //                'field'   => 'ei_b_count_max03',
        //                'label'   => 'タイトル：最大 使用回数',
        //                'rules'   => 'trim|max_length[4]'
        //        ),
        //        array(
        //                'field'   => 'ei_b_count_max04',
        //                'label'   => 'タイトル：最大 使用回数',
        //                'rules'   => 'trim|max_length[4]'
        //        ),
        //        array(
        //                'field'   => 'ei_b_count_max05',
        //                'label'   => 'タイトル：最大 使用回数',
        //                'rules'   => 'trim|max_length[4]'
        //        ),
        //        array(
        //                'field'   => 'ei_b_char_min',
        //                'label'   => 'タイトル：最低 使用文字数',
        //                'rules'   => 'trim|max_length[4]'
        //        ),
        //        array(
        //                'field'   => 'ei_b_char_max',
        //                'label'   => 'タイトル：最大 使用文字数',
        //                'rules'   => 'trim|max_length[4]'
        //        ),
        //
        //        array(
        //                'field'   => 'ei_work',
        //                'label'   => '案件申請：概要',
        //                'rules'   => 'trim|required|max_length[10000]'
        //        ),
        //        array(
        //                'field'   => 'ei_notice',
        //                'label'   => '案件申請：注意事項',
        //                'rules'   => 'trim|max_length[10000]'
        //        ),
        //        array(
        //                'field'   => 'rep_title',
        ///                'label'   => 'タイトル',
        //                'rules'   => 'trim|max_length[100]'
        //        ),
        //        array(
        //                'field'   => 'rep_text_body',
        //                'label'   => '本文',
        //                'rules'   => 'trim|max_length[10000]'
        //        ),
        //        array(
        //                'field'   => 'pji_addwork',
        //                'label'   => '追加内容',
        //                'rules'   => 'trim|max_length[10000]'
        //        ),

        );

        $this->load->library('form_validation', $rule_set);                            // バリデーションクラス読み込み

    }

}
