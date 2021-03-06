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
            $this->smarty->assign('auth_cd',    $this->session->userdata('c_authCD'));
        } else {
            $this->smarty->assign('login_chk', FALSE);
            //$this->smarty->assign('login_mem', '');

            //$this->load->helper('url');
            redirect('/login/');
        }

        // セッション::フラッシュデータ(案件申請ID)書き込み
        if (!$this->session->userdata('c_en_id')) {
            $flash_data['c_en_id'] = '';
            $this->session->set_userdata($flash_data);
            $this->smarty->assign('flashdata_peid', $flash_data['c_en_id']);
        }

        $this->smarty->assign('result_mess', '');

    }

    // 申請内容TOP
    public function index()
    {

        // セッション::案件申請IDをクリア：：URIセグメントの取得
        //   href="/client/entryorder/index/0/" で取得
        $segments = $this->uri->segment_array();
        if ((isset($segments[3])) && $segments[3] == 0)
        {

//            // セッションデータをクリア
//            $this->load->model('comm_auth', 'comm_auth', TRUE);
//            $this->comm_auth->delete_session('client');


            $flash_data['c_en_id'] = '';
            $this->session->set_userdata($flash_data);
        }

        // SELECT項目 初期値セット
        $this->_search_set();

        // セッションからフラッシュデータ読み込み
        $flash_data['c_en_id'] = $this->session->userdata('c_en_id');


        print("flash_data00 == ");
        print_r($flash_data['c_en_id']);
        print("<br><br>");


        if (empty($flash_data['c_en_id']))
        {
            // 各項目 初期値セット
            $this->_form_item_set00();
        } else {

            // 案内申請情報の取得
            $this->load->model('Entry', 'ent', TRUE);                // models 読み込み
            $get_data = $this->ent->get_entry($flash_data['c_en_id']);

            $get_data[0]['en_open_date']     = date('Y-m-d', strtotime($get_data[0]['en_open_date']));
            $get_data[0]['en_delivery_date'] = date('Y-m-d', strtotime($get_data[0]['en_delivery_date']));

            $this->smarty->assign('set_val', $get_data[0]);

        }

        // session:フラッシュデータに案件申請ID書き込み
        $this->session->set_userdata($flash_data);
        $this->smarty->assign('flashdata_peid', $flash_data['c_en_id']);

        // バリデーション・チェック
        $this->_set_validation01();                                            // バリデーション設定
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
        $flash_data['c_en_id'] = $this->session->userdata('c_en_id');


        //print("flash_data01 == ");
        //print_r($flash_data['en_id']);
        //print("<br><br>");



        if (empty($flash_data['c_en_id']))
        {
            // 各項目 初期値セット
            $this->_form_item_set01();
        } else {

            // 案内申請情報の取得
            $this->load->model('Entry', 'ent', TRUE);                // models 読み込み
            $get_data = $this->ent->get_cl_entrylist($flash_data['c_en_id'], $ei_seq = 0);

            $this->smarty->assign('set_val', $get_data[0]);

        }

        // session:フラッシュデータに案件申請ID書き込み
        $this->session->set_userdata($flash_data);
        $this->smarty->assign('flashdata_peid', $flash_data['c_en_id']);

        // バリデーション・チェック
        $this->_set_validation01();                                            // バリデーション設定
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
        $flash_data['c_en_id'] = $this->session->userdata('c_en_id');


        //print("flash_data02 == ");
        //print_r($flash_data['en_id']);
        //print("<br><br>");



        if (empty($flash_data['c_en_id']))
        {
            // 各項目 初期値セット
            $this->_form_item_set01();
        } else {

            // 案内申請情報の取得
            $this->load->model('Entry', 'ent', TRUE);                // models 読み込み
            $get_data = $this->ent->get_cl_entrylist($flash_data['c_en_id'], $ei_seq = 1);

            if (empty($get_data[0]))
            {
                $this->_form_item_set01();
            } else {
                $this->smarty->assign('set_val', $get_data[0]);
            }

        }

        // session:フラッシュデータに案件申請ID書き込み
        $this->session->set_userdata($flash_data);
        $this->smarty->assign('flashdata_peid', $flash_data['c_en_id']);

        // バリデーション・チェック
        $this->_set_validation01();                                            // バリデーション設定
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
        $flash_data['c_en_id'] = $this->session->userdata('c_en_id');


        //print("flash_data03 == ");
        //print_r($flash_data['en_id']);
        //print("<br><br>");



        if (empty($flash_data['c_en_id']))
        {
            // 各項目 初期値セット
            $this->_form_item_set01();
        } else {

            // 案内申請情報の取得
            $this->load->model('Entry', 'ent', TRUE);                // models 読み込み
            $get_data = $this->ent->get_cl_entrylist($flash_data['c_en_id'], $ei_seq = 2);

            if (empty($get_data[0]))
            {
                $this->_form_item_set01();
            } else {
                $this->smarty->assign('set_val', $get_data[0]);
            }
        }

        // session:フラッシュデータに案件申請ID書き込み
        $this->session->set_userdata($flash_data);
        $this->smarty->assign('flashdata_peid', $flash_data['c_en_id']);

        // バリデーション・チェック
        $this->_set_validation01();                                            // バリデーション設定
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
        $flash_data['c_en_id'] = $this->session->userdata('c_en_id');


        //print("flash_data_entry == ");
        //print_r($flash_data['en_id']);
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
            if ($this->input->post('entry_no') == '00')
            {
                $this->_form_item_set00();
            } else {
                $this->_form_item_set01();
            }
        } else {

            $this->load->model('Entry', 'ent', TRUE);                    // models 読み込み

            // フラッシュデータの「案件申請ID」チェック
            if (empty($flash_data['c_en_id']))
            {

                // 新規にレコード作成::「tb_Entry」
                $set_insert_data = $this->input->post();

                $set_insert_data['en_cl_id'] = $this->session->userdata('c_memID');                            // クライアントID
                $set_insert_data['en_word_tanka'] = sprintf('%0.1f', $this->input->post('en_word_tanka'));    // DECIMAL形式対策
                $date = $this->input->post('en_open_date');
                $set_insert_data['en_open_date'] = date('Y-m-d', strtotime($date));                            // 日付け形式
                $date = $this->input->post('en_delivery_date');
                $set_insert_data['en_delivery_date'] = date('Y-m-d', strtotime($date));                        // 日付け形式

                unset($set_insert_data["entry_no"]) ;
                unset($set_insert_data["submit"]) ;

                // INSERT
                $get_en_id = $this->ent->insert_entry($set_insert_data);    // insert & 直前のIDを取得
                $tmp_en_id = $get_en_id[0]['LAST_INSERT_ID()'];

                // 新規にレコード作成::「tb_Entry_info」
                $set_insert_data = array();
                $set_insert_data['ei_en_id']    = $tmp_en_id;                                                // 案件申請ID
                $set_insert_data['ei_en_cl_id'] = $this->session->userdata('c_memID');                        // クライアントID
                $set_insert_data['ei_seq']      = 0;                                                        // 枝番：初期デフォルト=0
                $set_insert_data['ei_status']   = 1;                                                        // 使用有無ステータス

                // INSERT
                $result = $this->ent->insert_entryinfo($set_insert_data);

                // session:フラッシュデータに案件申請ID書き込み
                $flash_data['c_en_id'] = $tmp_en_id;
                //$this->session->set_flashdata($flash_data);

                // 各項目 初期値セット
                $this->_form_item_set00();
                $this->smarty->assign('result_mess', '申請案件が登録されました。引き続き「申請記事」の登録をお願いします。');

            } else {

                // レコード更新
                $set_update_data = array();
                $set_update_data = $this->input->post();
                $set_entryno     = $set_update_data['entry_no'];

                if ($set_entryno == '00')
                {

                    // 「申請中」にステータスを変更
                    $this->config->load('config_status');
                    if ($this->input->post('submit') == '_entry')
                    {

                        // 記事1 の入力チェック : 代表して「タイトルワード回数 (min)」をチェック
                        $get_data = $this->ent->get_cl_entrylist($flash_data['c_en_id'], 0, 1);
                        if (! is_numeric($get_data[0]['ei_t_char_min']))
                        {
                            $this->smarty->assign('result_mess', '申請記事１(必須)が入力されていません。');

                            // 各項目 初期値セット
                            $this->_form_item_set00();

                            $this->smarty->assign('flashdata_peid', $flash_data['c_en_id']);
                            //$this->smarty->assign('entry_info',     $this->input->post());
                            $this->smarty->assign('entry_no',       $this->input->post('entry_no'));
                            $this->view('client/entryorder/index.tpl');

                            return;
                        }

                        $set_update_data['en_status'] = $this->config->item('C_ENTRY_SHINSEI_ID');

                    }

                    $set_update_data['en_id']        = $flash_data['c_en_id'];                                // 案件申請ID
                    $set_update_data['en_cl_id']     = $this->session->userdata('c_memID');                    // クライアントID

                    unset($set_update_data["entry_no"]) ;
                    unset($set_update_data["submit"]) ;

                    // UPDATE
                    $result = $this->ent->update_entry($set_update_data);

                    if ($this->input->post('submit') == '_entry')
                    {
                        $this->smarty->assign('result_mess', '案件が申請されました。');

                        redirect('/entrylist/');
                    } else {
                        $this->smarty->assign('result_mess', '申請案件が更新されました。');

                        // 各項目 初期値セット
                        $this->_form_item_set00($set_update_data['en_status']);
                    }

                } else {
                    $set_update_data['ei_en_id']    = $flash_data['c_en_id'];                                // 案件申請ID
                    $set_update_data['ei_en_cl_id'] = $this->session->userdata('c_memID');                    // クライアントID

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
                    $this->_form_item_set01();
                    $this->smarty->assign('result_mess', '申請記事が更新されました。');

                }
            }

            // ステータス変更で確認メールを送信
            // とりあえずここでは、ステータス(準備中)変更はさせない！

        }

        // session:フラッシュデータに案件申請ID書き込み
        $this->session->set_userdata($flash_data);
        $this->smarty->assign('flashdata_peid', $flash_data['c_en_id']);

        $this->smarty->assign('entry_no',   $this->input->post('entry_no'));
        $this->view('client/entryorder/index.tpl');

    }

















    // SELECTボックス 初期値セット
    private function _search_set()
    {

        // ステータス状態 選択項目セット
        $this->config->load('config_status');
        $arroptions_entrystatus = array (
                '0' => $this->config->item('C_ENTRY_JYUNBI'),
                '1' => $this->config->item('C_ENTRY_SHINSEI'),
                //'2' => $this->config->item('C_ENTRY_SYOUNIN'),
                //'3' => $this->config->item('C_ENTRY_HISYOUNIN'),
                //'4' => $this->config->item('C_ENTRY_CANSEL'),
                //'5' => $this->config->item('C_ENTRY_DELETE'),
        );

        // ジャンル 選択項目セット
        $this->load->model('comm_select', 'select', TRUE);
        $genre_list = $this->select->get_genre();

        // ライターID 並び替え選択項目セット
        $arroptions_ei_status = array (
                '0' => '使用しない',
                '1' => '使用する',
        );

        $this->smarty->assign('options_entry_status', $arroptions_entrystatus);
        $this->smarty->assign('options_genre_list',   $genre_list);
        $this->smarty->assign('options_ei_status',   $arroptions_ei_status);

    }

    // 各項目 初期値セット :  申請内容
    private function _form_item_set00($status_no=0)
    {

        // レコード作成後に、格納データを表示するために必要
        $set_val['en_status']        = $status_no;
        $set_val['en_genre01']       = '';
        $set_val['en_entry_title']   = '';
        $set_val['en_title']         = '';
        $set_val['en_work']          = '';
        $set_val['en_notice']        = '';
        $set_val['en_example']       = '';
        $set_val['en_other']         = '';
        $set_val['en_addwork']       = '';
        $set_val['en_word_tanka']    = '0.0';
        $set_val['en_open_date']     = date('Y-m-d');
        $set_val['en_delivery_date'] = date('Y-m-d', strtotime('+1 month'));
        $set_val['en_comment']       = '';

        $this->smarty->assign('set_val',   $set_val);

    }

    // 各項目 初期値セット :: 申請案件1～3
    private function _form_item_set01()
    {

        // レコード作成後に、格納データを表示するために必要
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

        $set_val['ei_work']    = '';
        $set_val['ei_notice']  = '';
        $set_val['ei_example'] = '';
        $set_val['ei_other']   = '';
        $set_val['ei_addwork'] = '';
        $set_val['ei_comment'] = '';

        $this->smarty->assign('set_val',   $set_val);

    }

    // フォーム・バリデーションチェック
    private function _set_validation()
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
