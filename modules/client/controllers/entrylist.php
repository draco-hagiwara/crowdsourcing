<?php

class Entrylist extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();

        if ($this->session->userdata('c_login') == TRUE)
        {
            $this->smarty->assign('login_chk', TRUE);
            //$this->smarty->assign('login_mem', 'client');
            $this->smarty->assign('login_name', $this->session->userdata('c_memNAME'));
            $this->smarty->assign('auth_cd',    $this->session->userdata('c_authCD'));
        } else {
            $this->smarty->assign('login_chk', FALSE);
            //$this->smarty->assign('login_mem', '');

            //$this->load->helper('url');
            redirect('/login/');
        }

        // セッション::フラッシュデータ(案件申請ID)書き込み
        //if (!$this->session->flashdata('en_id')) {
        //    $flash_data['en_id'] = '';
        //    $this->session->set_flashdata($flash_data);
        //    $this->smarty->assign('flashdata_peid', $flash_data['en_id']);
        //}

        $this->smarty->assign('result_mess', '');

    }

    // 検索TOP
    public function index()
    {

        // セッションデータをクリア
        $this->load->model('comm_auth', 'comm_auth', TRUE);
        $this->comm_auth->delete_session('client');

        // セッション::案件申請IDをクリア
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
        //$this->load->helper('url');
        $segments = $this->uri->segment_array();
        if (isset($segments[3]))
        {
            $tmp_offset = $segments[3];
        } else {
            $tmp_offset = 0;
        }

        // 案件申請情報のリスト＆件数を取得
        $this->load->model('Entry', 'ent', TRUE);
        $tmp_inputpost = $this->input->post();
        list($entry_list, $entry_countall) = $this->ent->get_cl_entrylist($flash_data['c_memID'], $tmp_inputpost, $tmp_per_page, $tmp_offset);
        $this->smarty->assign('entry_list', $entry_list);

        // Pagination 設定
        $set_pagination = $this->_get_Pagination($entry_countall, $tmp_per_page);

        $this->smarty->assign('set_pagination', $set_pagination['page_link']);
        $this->smarty->assign('countall',       $entry_countall);
        $this->smarty->assign('serch_item',     $this->input->post());

        $this->view('client/entrylist/index.tpl');

    }

    // 一覧表示
    public function search()
    {

        // セッション::案件申請IDをクリア
        $flash_data['c_memID'] = $this->session->userdata('c_memID');

        // 検索項目の保存が上手くいかない。応急的に対応！
        if ($this->input->post('submit') == '_submit')
        {
            // セッションをフラッシュデータとして保存
            $data = array(
                    'c_en_entry_title' => $this->input->post('en_entry_title'),
                    'c_en_id'          => $this->input->post('en_id'),
                    'c_en_status'      => $this->input->post('en_status'),
                    'c_en_genre01'     => $this->input->post('en_genre01'),
                    'c_orderid'        => $this->input->post('orderid'),
                    'c_orderstatus'    => $this->input->post('orderstatus'),
            );
            $this->session->set_userdata($data);

            $tmp_inputpost = $this->input->post();
            unset($tmp_inputpost["submit"]);

        } else {
            // セッションからフラッシュデータ読み込み
            $tmp_inputpost['en_entry_title'] = $this->session->userdata('c_en_entry_title');
            $tmp_inputpost['en_id']          = $this->session->userdata('c_en_id');
            $tmp_inputpost['en_status']      = $this->session->userdata('c_en_status');
            $tmp_inputpost['en_genre01']     = $this->session->userdata('c_en_genre01');
            $tmp_inputpost['orderid']        = $this->session->userdata('c_orderid');
            $tmp_inputpost['orderstatus']    = $this->session->userdata('c_orderstatus');

            //$this->session->set_flashdata($tmp_inputpost);
        }

        // バリデーション・チェック
        $this->_set_validation();                                            // バリデーション設定
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
        $this->load->model('Entry', 'ent', TRUE);
        list($entry_list, $entry_countall) = $this->ent->get_cl_entrylist($flash_data['c_memID'], $tmp_inputpost, $tmp_per_page, $tmp_offset);
        $this->smarty->assign('entry_list', $entry_list);

        // Pagination 設定
        $set_pagination = $this->_get_Pagination($entry_countall, $tmp_per_page);

        // 検索項目 初期値セット
        $this->_search_set();

        $this->smarty->assign('set_pagination', $set_pagination['page_link']);
        $this->smarty->assign('countall',       $entry_countall);
        $this->smarty->assign('serch_item',     $tmp_inputpost);

        $this->view('client/entrylist/index.tpl');

    }

    // 申請内容
    public function detail00()
    {

        // SELECT項目 初期値セット
        $this->_form_item_set00();

        // セッションからフラッシュデータ読み込み
        $flash_data['c_en_id'] = $this->session->userdata('c_en_id');


        // 申請内容データ 初期値セット
        $this->load->model('Entry', 'ent', TRUE);


        // 案件申請ID取得
        $input_post = $this->input->post();
        if (empty($input_post['peid_uniq']))
        {
            // ２回目以降
            $tmp_peid = $flash_data['c_en_id'];
        } else {
            // 初回
            $tmp_peid = $input_post['peid_uniq'];
        }




        print("flash_data00 == ");
        print($tmp_peid);
        print("<br><br>");




        $get_data = $this->ent->get_entry($tmp_peid);

        $get_data[0]['en_open_date']     = date('Y-m-d', strtotime($get_data[0]['en_open_date']));
        $get_data[0]['en_delivery_date'] = date('Y-m-d', strtotime($get_data[0]['en_delivery_date']));

        $this->smarty->assign('entry_info', $get_data[0]);

        // session:フラッシュデータに案件申請ID書き込み
        $tmp_flash_peid = array('c_en_id' => $get_data[0]['en_id']);
        $this->session->set_userdata( $tmp_flash_peid);

        // バリデーション設定
        $this->_set_validation00();
        //$this->form_validation->run();

        $this->smarty->assign('entry_no', '00');

        $this->view('client/entrylist/detail.tpl');

    }

    // 申請案件１
    public function detail01()
    {

        // SELECT項目 初期値セット
        //$this->_search_set01();

        // セッションからフラッシュデータ読み込み＆書き込み
        $flash_data['c_en_id'] = $this->session->userdata('c_en_id');
        //$this->session->set_flashdata( $flash_data);


        print("flash_data01 == ");
        print_r($flash_data['c_en_id']);
        print("<br><br>");


        // 申請案件データ 初期値セット
        $this->load->model('Entry', 'ent', TRUE);                    // models 読み込み
        $get_data = $this->ent->get_entry_info($flash_data['c_en_id'], $ei_seq = 0);



        //print_r($get_data[0]);


        $this->smarty->assign('entry_info', $get_data[0]);

        // バリデーション・チェック
        $this->_set_validation01();                                            // バリデーション設定
        //$this->form_validation->run();

        $this->smarty->assign('entry_no', '01');
        $this->view('client/entrylist/detail.tpl');

    }

    // 申請案件２
    public function detail02()
    {

        // セッションからフラッシュデータ読み込み＆書き込み
        $flash_data['c_en_id'] = $this->session->userdata('c_en_id');
        //$this->session->set_flashdata( $flash_data);


        print("flash_data02 == ");
        print_r($flash_data['c_en_id']);
        print("<br><br>");


        // 申請案件データ 初期値セット
        $this->load->model('Entry', 'ent', TRUE);                    // models 読み込み
        $get_data = $this->ent->get_entry_info($flash_data['c_en_id'], $ei_seq = 1);
        if (empty($get_data))
        {
            // 各項目 初期値セット
            $this->_form_item_set01($flash_data['c_en_id']);
        } else {
            // 各項目 初期値セット
            $this->_form_item_set01($flash_data['c_en_id']);
            $this->smarty->assign('entry_info', $get_data[0]);
        }

        // バリデーション・チェック
        $this->_set_validation01();                                            // バリデーション設定
        //$this->form_validation->run();

        $this->smarty->assign('entry_no', '02');
        $this->view('client/entrylist/detail.tpl');

    }

    // 申請案件３
    public function detail03()
    {

        // セッションからフラッシュデータ読み込み＆書き込み
        $flash_data['c_en_id'] = $this->session->userdata('c_en_id');
        //$this->session->set_flashdata( $flash_data);


        print("flash_data03 == ");
        print_r($flash_data['c_en_id']);
        print("<br><br>");


        // 申請案件データ 初期値セット
        $this->load->model('Entry', 'ent', TRUE);                    // models 読み込み
        $get_data = $this->ent->get_entry_info($flash_data['c_en_id'], $ei_seq = 2);
        if (empty($get_data))
        {
            // 各項目 初期値セット
            $this->_form_item_set01($flash_data['c_en_id']);
        } else {
            // 各項目 初期値セット
            $this->_form_item_set01($flash_data['c_en_id']);
            $this->smarty->assign('entry_info', $get_data[0]);
        }

        // バリデーション・チェック
        $this->_set_validation01();                                            // バリデーション設定
        //$this->form_validation->run();

        $this->smarty->assign('entry_no', '03');
        $this->view('client/entrylist/detail.tpl');

    }

    // 案件申請データ更新
    public function data_entry()
    {

        // セッションからフラッシュデータ読み込み＆書き込み
        $flash_data['c_en_id'] = $this->session->userdata('c_en_id');
        //$this->session->set_flashdata($flash_data);



        print("flash_data_entry == ");
        print_r($flash_data['c_en_id']);
        print("<br><br>");




        // SELECT項目 初期値セット
        //$this->_search_set();

        // バリデーション・チェック::TAB毎に処理振り分け
        $tmp_entry_no = $this->input->post('entry_no');
        if ($tmp_entry_no == '00')
        {
            $this->_set_validation00();
        } else {
            $this->_set_validation01();
        }

        if ($this->form_validation->run() == FALSE)
        {

            // 各項目 初期値セット
            if ($tmp_entry_no == '00')
            {
                $this->_form_item_set00();
            } else {
                $this->_form_item_set01($flash_data['c_en_id']);
            }

        } else {

            $this->load->model('Entry', 'ent', TRUE);                        // models 読み込み

            // レコード更新
            $set_update_data = array();
            $set_update_data = $this->input->post();
            $set_entryno     = $set_update_data['entry_no'];

            if ($set_entryno == '00')
            {
                $set_update_data['en_id']        = $flash_data['c_en_id'];                                // 案件申請ID
                $set_update_data['en_cl_id']     = $this->session->userdata('c_memID');                    // クライアントID

                // 記事1 の入力チェック : 代表して「タイトルワード回数 (min)」をチェック
                $get_data = $this->ent->get_entry_info($flash_data['c_en_id'], 0, 1);
                if (! is_numeric($get_data[0]['ei_t_char_min']))
                {
                    $this->smarty->assign('result_mess', '申請記事１(必須)が入力されていません。');

                    // 各項目 初期値セット
                    $this->_form_item_set00();

                    $this->smarty->assign('flashdata_peid', $flash_data['c_en_id']);
                    $this->smarty->assign('entry_info',     $this->input->post());
                    $this->smarty->assign('entry_no',       $tmp_entry_no);
                    $this->view('client/entrylist/detail.tpl');

                    return;
                }

                if ($set_update_data['en_status'] == '1')
                {
                    $set_update_data['en_reason'] = NULL;                                                // 非承認 理由
                }


                unset($set_update_data["entry_no"]) ;
                unset($set_update_data["submit"]) ;

                // UPDATE
                $result = $this->ent->update_entry($set_update_data);

                if ($set_update_data['en_status'] == '1')
                {
                    redirect('/entrylist/');
                } else {
                    // 各項目 初期値セット
                    $this->_form_item_set00();
                    $this->smarty->assign('result_mess', '申請内容が更新されました。');
                }

            } else {
                $set_update_data['ei_en_id']    = $flash_data['c_en_id'];                                // 案件申請ID
                $set_update_data['ei_en_cl_id'] = $this->session->userdata('c_memID');                    // クライアントID

                // 入力項目がNULLの場合unset
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
                $result = $this->ent->update_entryinfo($set_entryno, $set_update_data);

                // 各項目 初期値セット
                $this->_form_item_set01($flash_data['c_en_id']);
                $this->smarty->assign('result_mess', '申請記事が更新されました。');

            }

            // ステータス変更で確認メールを送信 ??

        }

        // session:フラッシュデータに案件申請ID書き込み
        $this->smarty->assign('flashdata_peid', $flash_data['c_en_id']);

        $this->smarty->assign('entry_info', $this->input->post());
        //$this->smarty->assign('entry_info', $this->input->post());
        $this->smarty->assign('entry_no', $tmp_entry_no);
        $this->view('client/entrylist/detail.tpl');

    }





    // Pagination 設定
    private function _get_Pagination($entry_countall, $tmp_per_page)
    {

        $config['base_url']       = base_url() . '/entrylist/search/';        // ページの基本URIパス。「/コントローラクラス/アクションメソッド/」
        $config['per_page']       = $tmp_per_page;                            // 1ページ当たりの表示件数。
        $config['total_rows']     = $entry_countall;                        // 総件数。where指定するか？
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

    // 検索項目 初期値セット
    private function _search_set()
    {

        // ステータス状態 選択項目セット
        $this->config->load('config_status');
        $arroptions_pestatus = array (
                ''  => '選択してください',
                '0' => $this->config->item('C_ENTRY_JYUNBI'),
                '1' => $this->config->item('C_ENTRY_SHINSEI'),
                '3' => $this->config->item('C_ENTRY_HISYOUNIN'),
                '4' => $this->config->item('C_ENTRY_CANSEL'),
        );

        // ジャンル 選択項目セット
        $this->load->model('comm_select', 'select', TRUE);
        $genre_list = $this->select->get_genre();
        //$genre_list[''] = '選択してください';

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

        $this->smarty->assign('options_en_status',   $arroptions_pestatus);
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
                '0' => $this->config->item('C_ENTRY_JYUNBI'),
                '1' => $this->config->item('C_ENTRY_SHINSEI'),
                //'2' => $this->config->item('C_ENTRY_SYOUNIN'),
                //'3' => $this->config->item('C_ENTRY_HISYOUNIN'),
                '4' => $this->config->item('C_ENTRY_CANSEL'),
                //'5' => $this->config->item('C_ENTRY_DELETE'),
        );

        // ジャンル 選択項目セット
        $this->load->model('comm_select', 'select', TRUE);
        $genre_list = $this->select->get_genre();

        $this->smarty->assign('options_entry_status', $arroptions_entrystatus);
        $this->smarty->assign('options_genre_list',   $genre_list);




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
                        'field'   => 'en_entry_title',
                        'label'   => '申請案件タイトル',
                        'rules'   => 'trim|max_length[100]'
                ),
                array(
                        'field'   => 'en_id',
                        'label'   => '案件申請ID',
                        'rules'   => 'trim|numeric'
                ),
                array(
                        'field'   => 'en_genre01',
                        'label'   => 'ジャンル',
                        'rules'   => 'trim|numeric'
                ),
                array(
                        'field'   => 'en_status',
                        'label'   => 'ステータス',
                        'rules'   => 'trim|numeric'
                ),
        );

        $this->load->library('form_validation', $rule_set);                            // バリデーションクラス読み込み

    }


    // フォーム・バリデーションチェック:案件内容
    private function _set_validation00()
    {

        $rule_set = array(
                array(
                        'field'   => 'en_status',
                        'label'   => 'ステータス (状態)',
                        'rules'   => 'trim|required'
                ),
                array(
                        'field'   => 'en_entry_title',
                        'label'   => 'タイトル（表示件名）',
                        'rules'   => 'trim|required|max_length[100]'
                ),
                array(
                        'field'   => 'en_genre01',
                        'label'   => '希望ジャンル',
                        'rules'   => 'trim|required|greater_than[1]'
                ),
                array(
                        'field'   => 'en_title',
                        'label'   => '案件申請：タイトル',
                        'rules'   => 'trim|required|max_length[100]'
                ),
                array(
                        'field'   => 'en_work',
                        'label'   => '案件申請：概要',
                        'rules'   => 'trim|required|max_length[10000]'
                ),
                array(
                        'field'   => 'en_notice',
                        'label'   => '案件申請：注意事項',
                        'rules'   => 'trim|max_length[10000]'
                ),
                array(
                        'field'   => 'en_example',
                        'label'   => '案件申請：例文',
                        'rules'   => 'trim|max_length[10000]'
                ),
                array(
                        'field'   => 'en_other',
                        'label'   => '案件申請：その他',
                        'rules'   => 'trim|max_length[10000]'
                ),
                array(
                        'field'   => 'en_addwork',
                        'label'   => '案件申請：追加内容',
                        'rules'   => 'trim|max_length[10000]'
                ),
                array(
                        'field'   => 'en_word_tanka',
                        'label'   => '個別文字単価指定',
                        'rules'   => 'trim|decimal|max_length[4]'
                ),
                array(
                        'field'   => 'en_open_date',
                        'label'   => '案件希望公開日',
                        'rules'   => 'trim|required|regex_match[/^\d{4}-\d{1,2}-\d{1,2}+$/]|max_length[10]'
                ),
                array(
                        'field'   => 'en_delivery_date',
                        'label'   => '案件希望納期',
                        'rules'   => 'trim|required|regex_match[/^\d{4}-\d{1,2}-\d{1,2}+$/]|max_length[10]'
                ),
                array(
                        'field'   => 'en_comment',
                        'label'   => '備考',
                        'rules'   => 'trim|max_length[2000]'
                ),

        );

        $this->load->library('form_validation', $rule_set);                            // バリデーションクラス読み込み

    }

    // フォーム・バリデーションチェック::申請案件１～３
    private function _set_validation01()
    {

        $rule_set = array(
                array(
                        'field'   => 'ei_status',
                        'label'   => '使用有無設定',
                        'rules'   => ''
                ),

                array(
                        'field'   => 'ei_t_keyword01',
                        'label'   => 'タイトル：必須ワード指定',
                        'rules'   => 'trim|max_length[100]'
                ),
                array(
                        'field'   => 'ei_t_keyword02',
                        'label'   => 'タイトル：必須ワード指定',
                        'rules'   => 'trim|max_length[100]'
                ),
                array(
                        'field'   => 'ei_t_keyword03',
                        'label'   => 'タイトル：必須ワード指定',
                        'rules'   => 'trim|max_length[100]'
                ),
                array(
                        'field'   => 'ei_t_count_min01',
                        'label'   => 'タイトル：最低 使用回数',
                        'rules'   => 'trim|max_length[3]'
                ),
                array(
                        'field'   => 'ei_t_count_min02',
                        'label'   => 'タイトル：最低 使用回数',
                        'rules'   => 'trim|max_length[3]'
                ),
                array(
                        'field'   => 'ei_t_count_min03',
                        'label'   => 'タイトル：最低 使用回数',
                        'rules'   => 'trim|max_length[3]'
                ),
                array(
                        'field'   => 'ei_t_count_max01',
                        'label'   => 'タイトル：最大 使用回数',
                        'rules'   => 'trim|max_length[3]'
                ),
                array(
                        'field'   => 'ei_t_count_max02',
                        'label'   => 'タイトル：最大 使用回数',
                        'rules'   => 'trim|max_length[3]'
                ),
                array(
                        'field'   => 'ei_t_count_max03',
                        'label'   => 'タイトル：最大 使用回数',
                        'rules'   => 'trim|max_length[3]'
                ),
                array(
                        'field'   => 'ei_t_char_min',
                        'label'   => 'タイトル：最低 使用文字数',
                        'rules'   => 'trim|required|max_length[4]'
                ),
                array(
                        'field'   => 'ei_t_char_max',
                        'label'   => 'タイトル：最大 使用文字数',
                        'rules'   => 'trim|required|max_length[4]'
                ),

                array(
                        'field'   => 'ei_b_word01',
                        'label'   => '本文：必須ワード指定',
                        'rules'   => 'trim|max_length[100]'
                ),
                array(
                        'field'   => 'ei_b_word02',
                        'label'   => '本文：必須ワード指定',
                        'rules'   => 'trim|max_length[100]'
                ),
                array(
                        'field'   => 'ei_b_word03',
                        'label'   => '本文：必須ワード指定',
                        'rules'   => 'trim|max_length[100]'
                ),
                array(
                        'field'   => 'ei_b_word04',
                        'label'   => '本文：必須ワード指定',
                        'rules'   => 'trim|max_length[100]'
                ),
                array(
                        'field'   => 'ei_b_word05',
                        'label'   => '本文：必須ワード指定',
                        'rules'   => 'trim|max_length[100]'
                ),
                array(
                        'field'   => 'ei_b_count_min01',
                        'label'   => 'タイトル：最低 使用回数',
                        'rules'   => 'trim|max_length[4]'
                ),
                array(
                        'field'   => 'ei_b_count_min02',
                        'label'   => 'タイトル：最低 使用回数',
                        'rules'   => 'trim|max_length[4]'
                ),
                array(
                        'field'   => 'ei_b_count_min03',
                        'label'   => 'タイトル：最低 使用回数',
                        'rules'   => 'trim|max_length[4]'
                ),
                array(
                        'field'   => 'ei_b_count_min04',
                        'label'   => 'タイトル：最低 使用回数',
                        'rules'   => 'trim|max_length[4]'
                ),
                array(
                        'field'   => 'ei_b_count_min05',
                        'label'   => 'タイトル：最低 使用回数',
                        'rules'   => 'trim|max_length[4]'
                ),
                array(
                        'field'   => 'ei_b_count_max01',
                        'label'   => 'タイトル：最大 使用回数',
                        'rules'   => 'trim|max_length[4]'
                ),
                array(
                        'field'   => 'ei_b_count_max02',
                        'label'   => 'タイトル：最大 使用回数',
                        'rules'   => 'trim|max_length[4]'
                ),
                array(
                        'field'   => 'ei_b_count_max03',
                        'label'   => 'タイトル：最大 使用回数',
                        'rules'   => 'trim|max_length[4]'
                ),
                array(
                        'field'   => 'ei_b_count_max04',
                        'label'   => 'タイトル：最大 使用回数',
                        'rules'   => 'trim|max_length[4]'
                ),
                array(
                        'field'   => 'ei_b_count_max05',
                        'label'   => 'タイトル：最大 使用回数',
                        'rules'   => 'trim|max_length[4]'
                ),
                array(
                        'field'   => 'ei_b_char_min',
                        'label'   => 'タイトル：最低 使用文字数',
                        'rules'   => 'trim|required|max_length[4]'
                ),
                array(
                        'field'   => 'ei_b_char_max',
                        'label'   => 'タイトル：最大 使用文字数',
                        'rules'   => 'trim|required|max_length[4]'
                ),

                array(
                        'field'   => 'ei_work',
                        'label'   => '案件申請：概要',
                        'rules'   => 'trim|required|max_length[10000]'
                ),
                array(
                        'field'   => 'ei_notice',
                        'label'   => '案件申請：注意事項',
                        'rules'   => 'trim|max_length[10000]'
                ),
                array(
                        'field'   => 'ei_example',
                        'label'   => '案件申請：例文',
                        'rules'   => 'trim|max_length[10000]'
                ),
                array(
                        'field'   => 'ei_other',
                        'label'   => '案件申請：その他',
                        'rules'   => 'trim|max_length[10000]'
                ),
                array(
                        'field'   => 'ei_addwork',
                        'label'   => '案件申請：追加内容',
                        'rules'   => 'trim|max_length[10000]'
                ),

        );

        $this->load->library('form_validation', $rule_set);                            // バリデーションクラス読み込み

    }

}
