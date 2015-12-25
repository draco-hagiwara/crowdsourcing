<?php

class My_entrylist extends MY_Controller
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

        $this->smarty->assign('result_mess_ok', '');
        $this->smarty->assign('result_mess_ng', '');

    }

    // 検索一覧TOP
    public function index()
    {

        // セッションデータをクリア
        $this->load->model('comm_auth', 'comm_auth', TRUE);
        $this->comm_auth->delete_session('writer');

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
        $this->load->model('Writer_info', 'wrinfo', TRUE);

        $tmp_inputpost['wi_wr_id'] = $this->session->userdata('w_memID');
        $tmp_inputpost['pj_id']    = NULL;
        $tmp_inputpost['wi_pj_work_status'] = NULL;

        list($entry_list, $entry_countall) = $this->wrinfo->get_entrylist($tmp_inputpost, $tmp_per_page, $tmp_offset);

        // Pagination 設定
        $set_pagination = $this->_get_Pagination($entry_countall, $tmp_per_page, NULL);

        $this->smarty->assign('entry_list',     $entry_list);

        $this->smarty->assign('set_pagination', $set_pagination['page_link']);
        $this->smarty->assign('countall',       $entry_countall);
        $this->smarty->assign('serch_item',     $this->input->post());

        $this->view('writer/my_entrylist/index.tpl');

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
                    'w_pj_id'             => $this->input->post('pj_id'),
                    'w_wi_pj_work_status' => $this->input->post('wi_pj_work_status'),
            );
            $this->session->set_userdata($data);

            $tmp_inputpost = $this->input->post();
            $tmp_inputpost['wi_wr_id'] = $this->session->userdata('w_memID');
            unset($tmp_inputpost["submit"]);

        } else {
            // セッションからフラッシュデータ読み込み
            $tmp_inputpost['wi_wr_id']          = $this->session->userdata('w_memID');
            $tmp_inputpost['pj_id']             = $this->session->userdata('w_pj_id');
            $tmp_inputpost['wi_pj_work_status'] = $this->session->userdata('w_wi_pj_work_status');
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

        // エントリーリスト＆件数を取得
        $this->load->model('Writer_info', 'wrinfo', TRUE);
        list($entry_list, $entry_countall) = $this->wrinfo->get_entrylist($tmp_inputpost, $tmp_per_page, $tmp_offset);

        // Pagination 設定
        $set_pagination = $this->_get_Pagination($entry_countall, $tmp_per_page);

        // 検索項目 初期値セット
        $this->_search_set();

        $this->smarty->assign('entry_list', $entry_list);

        $this->smarty->assign('set_pagination', $set_pagination['page_link']);
        $this->smarty->assign('countall',       $entry_countall);
        $this->smarty->assign('serch_item',     $tmp_inputpost);

        $this->view('writer/my_entrylist/index.tpl');

    }

    // 作業内容
    public function detail00()
    {

        // セッションからフラッシュデータ読み込み
        $flash_data['w_pj_id'] = $this->session->userdata('w_pj_id');

        // 作業ID取得
        $input_post = $this->input->post();
        if (empty($input_post['pjid_uniq']))
        {
            // ２回目以降
            $tmp_pjid = $flash_data['w_pj_id'];
        } else {
            // 初回
            $tmp_pjid = $input_post['pjid_uniq'];
        }

        // 個別情報データ読み込み
        $this->load->model('Project', 'pj', TRUE);
        $get_data = $this->pj->get_entry_data($tmp_pjid);
        $this->smarty->assign('order_info', $get_data[0]);

        // 作業件数有無チェック(作業1～3)
        $this->_get_job_cnt($tmp_pjid);




        print("flash_data00 == ");
        print($tmp_pjid);
        print("<br><br>");






        // SELECT項目 初期値セット
        $this->_form_item_set00();

        // session:フラッシュデータに案件ID書き込み
        $tmp_flash_pjid = array('w_pj_id' => $get_data[0]['pj_id']);
        $this->session->set_userdata( $tmp_flash_pjid);

        // バリデーション設定
        $this->_set_validation00();

        $this->smarty->assign('not_disp', FALSE);
        $this->smarty->assign('order_no', '00');

        $this->view('writer/my_entrylist/detail.tpl');

    }

    // 作業１
    public function detail01()
    {

        // セッションからフラッシュデータ読み込み＆書き込み
        $flash_data['w_pj_id'] = $this->session->userdata('w_pj_id');


        print("flash_data01 == ");
        print_r($flash_data['w_pj_id']);
        print("<br><br>");


        // 作業データ 初期値セット
        $this->load->model('Project', 'pj', TRUE);                            // models 読み込み
        $get_data = $this->pj->get_order_info($flash_data['w_pj_id'], $pji_seq = 0);
        $this->smarty->assign('order_info', $get_data[0]);

        // 作業件数有無チェック(作業1～3)
        $this->_get_job_cnt($flash_data['w_pj_id']);

        // バリデーション・チェック
        $this->_set_validation01();                                            // バリデーション設定

        $this->smarty->assign('not_disp', FALSE);
        $this->smarty->assign('order_no', '01');
        $this->view('writer/my_entrylist/detail.tpl');

    }

    // 作業２
    public function detail02()
    {

        // セッションからフラッシュデータ読み込み＆書き込み
        $flash_data['w_pj_id'] = $this->session->userdata('w_pj_id');


        print("flash_data02 == ");
        print_r($flash_data['w_pj_id']);
        print("<br><br>");


        // 作業データ 初期値セット
        $this->load->model('Project', 'pj', TRUE);                            // models 読み込み
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

        // 作業件数有無チェック(作業1～3)
        $this->_get_job_cnt($flash_data['w_pj_id']);

        // バリデーション・チェック
        $this->_set_validation01();                                            // バリデーション設定

        $this->smarty->assign('order_no', '02');
        $this->view('writer/my_entrylist/detail.tpl');

    }

    // 作業３
    public function detail03()
    {

        // セッションからフラッシュデータ読み込み＆書き込み
        $flash_data['w_pj_id'] = $this->session->userdata('w_pj_id');
        //$this->session->set_flashdata( $flash_data);


        print("flash_data03 == ");
        print_r($flash_data['w_pj_id']);
        print("<br><br>");


        // 作業データ 初期値セット
        $this->load->model('Project', 'pj', TRUE);                    // models 読み込み
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

        // 作業件数有無チェック(作業1～3)
        $this->_get_job_cnt($flash_data['w_pj_id']);

        // バリデーション・チェック
        $this->_set_validation01();                                            // バリデーション設定

        $this->smarty->assign('order_no', '03');
        $this->view('writer/my_entrylist/detail.tpl');

    }

    // 投稿＆エントリーキャンセル
    public function data_post()
    {

        // セッションからフラッシュデータ読み込み＆書き込み
        $flash_data['w_pj_id']   = $this->session->userdata('w_pj_id');
        $flash_data['w_memID']   = $this->session->userdata('w_memID');
        $flash_data['w_memRANK'] = $this->session->userdata('w_memRANK');
        $flash_data['w_memNAME'] = $this->session->userdata('w_memNAME');



        print("flash_data_entry == ");
        print_r($flash_data['w_pj_id']);
        print("<br><br>");
        //print_r($post_data);



        $post_data = array();
        $post_data = $this->input->post();

        $this->load->model('Project',     'pj',     TRUE);
        $this->load->model('Report_info', 'rep',    TRUE);
        $this->load->model('Writer_info', 'wrinfo', TRUE);

        $this->config->load('config_status');
        $time = time();

        // 投稿 or キャンセル
        if ($post_data['submit'] =='_submit')
        {

            // 投稿内容のチェック
            $get_infodata = $this->pj->get_entry_info($flash_data['w_pj_id']);
            $tmp_arr_cnt  = count($get_infodata);                                            // 作業件数有無チェック(作業1～3)

            $tmp_chkok = TRUE;
            for ($rep_seq = 0; $rep_seq < $tmp_arr_cnt; $rep_seq++)
            {
                $get_data = $this->rep->get_report_data($flash_data['w_pj_id'], $rep_seq);

                if ($get_data[0]['rep_check_flg'] != TRUE)
                {
                    $tmp_chkok = FALSE;
                }
            }

            if ($tmp_chkok == FALSE)
            {

                // エラーメッセージを出す！
                $this->smarty->assign('result_mess_ng', '投稿条件を満たしていません。');


                // 作業データ 初期値セット
                $get_data = $this->pj->get_entry_data($flash_data['w_pj_id']);
                $this->smarty->assign('order_info', $get_data[0]);

                // 作業件数有無チェック(作業1～3)
                $this->_get_job_cnt($flash_data['w_pj_id']);

                // SELECT項目 初期値セット
                $this->_form_item_set00();

                // バリデーション設定
                $this->_set_validation00();

                $this->smarty->assign('not_disp', FALSE);
                $this->smarty->assign('order_no', '00');
                $this->view('writer/my_entrylist/detail.tpl');

                return;

            }

            // ライター個別情報は「エントリー無」「投稿審査待ち」
            $set_wdata['wi_wr_id'] = $flash_data['w_memID'];                                    // ライターID
            $set_wdata['wi_pj_id'] = $flash_data['w_pj_id'];                                    // 案件ID
            $set_wdata['wi_pj_entry_status'] = $this->config->item('PJ_ESTATUS_NOENTRY_ID');    // 「エントリー無」
            $set_wdata['wi_pj_work_status']  = $this->config->item('PJ_WSTATUS_CHECK_ID');        // 「投稿審査待ち」
            $set_wdata['wi_posting_date'] = date("Y-m-d H:i", $time);                            // 投稿日
            $set_wdata['wi_update_date']  = date("Y-m-d H:i", $time);                            // 更新日

            // 案件情報は「投稿審査待ち」
            $set_pdata['pj_id'] = $flash_data['w_pj_id'];                                        // 案件ID
            $set_pdata['pj_work_status']  = $this->config->item('PJ_WSTATUS_CHECK_ID');            // 「投稿審査待ち」
            $set_pdata['pj_wi_posting_date'] = date("Y-m-d H:i", $time);                        // 投稿日
            $set_pdata['pj_update_date'] = date("Y-m-d H:i", $time);                            // 更新日

            // トランザクション・START
            $this->db->trans_strict(FALSE);                                        // StrictモードをOFF
            $this->db->trans_start();                                            // trans_begin

            // UPDATE:ライター個別情報
            $this->wrinfo->update_entryinfo($set_wdata);

            // UPDATE:案件情報
            $this->pj->update_project($set_pdata);

            // トランザクション・COMMIT
            $this->db->trans_complete();                                        // trans_rollback & trans_commit
            if ($this->db->trans_status() === FALSE)
            {
                log_message('error', 'WRITER::[data_post()]ライター：投稿処理 トランザクションエラー');
            } else {
                $this->session->set_userdata('w_memENTRY', FALSE);                // ENTRY無をセッションデータに書き込み

                // 投稿確認メールを送信
                $this->_mail_send01($post_data['pj_title'], $set_wdata, $flash_data);
            }

            redirect('/search_list/');

        } else {

            // ライター個別情報は「エントリー無」「ライターキャンセル」
            $set_wdata['wi_wr_id'] = $flash_data['w_memID'];                                    // ライターID
            $set_wdata['wi_pj_id'] = $flash_data['w_pj_id'];                                    // 案件ID
            $set_wdata['wi_pj_entry_status'] = $this->config->item('PJ_ESTATUS_NOENTRY_ID');    // 「エントリー無」
            $set_wdata['wi_pj_work_status']  = $this->config->item('PJ_WSTATUS_CANCEL_ID');        // 「ライターキャンセル」
            $set_wdata['wi_update_date'] = date("Y-m-d H:i", $time);                            // 更新日

            // 案件情報は「(再)公開」「エントリー無」「投稿なし」
            $set_pdata['pj_id'] = $flash_data['w_pj_id'];                                        // 案件ID
            $set_pdata['pj_status'] = $this->config->item('PJ_STATUS_REOPEN_ID');                // 「(再)公開」
            $set_pdata['pj_entry_status'] = $this->config->item('PJ_ESTATUS_NOENTRY_ID');        // 「エントリー無」
            $set_pdata['pj_work_status']  = $this->config->item('PJ_WSTATUS_ENTRY_ID');            // 「投稿なし」
            $set_pdata['pj_wr_id'] = NULL;                                                        // ライターID:int
            $set_pdata['pj_wi_id'] = NULL;                                                        // ライター個別情報ID:int
            $set_pdata['pj_update_date'] = date("Y-m-d H:i", $time);                            // 更新日

            // 投稿記事個別情報は「チェックフラグ」「タイトル」「本文」クリア
            $set_edata['rep_pji_pj_id'] = $flash_data['w_pj_id'];                                // 案件ID
            $set_edata['rep_check_flg'] = FALSE;                                                // チェックフラグ
            $set_edata['rep_title'] = NULL;                                                        // タイトル
            $set_edata['rep_title_wordcount'] = 0;                                                // タイトル文字数:int
            $set_edata['rep_text_body'] = NULL;                                                    // 本文
            $set_edata['rep_body_wordcount'] = 0;                                                // 本文文字数:int

            // トランザクション・START
            $this->db->trans_strict(FALSE);                                        // StrictモードをOFF
            $this->db->trans_start();                                            // trans_begin

                // UPDATE:ライター個別情報
                $this->wrinfo->update_entryinfo($set_wdata);

                // UPDATE:案件情報
                $this->pj->update_project($set_pdata);

                // UPDATE:投稿記事個別情報
                $get_infodata = $this->pj->get_entry_info($flash_data['w_pj_id']);
                $tmp_arr_cnt  = count($get_infodata);                                            // 作業件数有無チェック(作業1～3)

                for ($rep_seq = 0; $rep_seq < $tmp_arr_cnt; $rep_seq++)
                {
                    $this->rep->update_entryinfo($set_edata, $set_edata['rep_pji_pj_id'], $rep_seq);
                }

            // トランザクション・COMMIT
            $this->db->trans_complete();                                        // trans_rollback & trans_commit
            if ($this->db->trans_status() === FALSE)
            {
                log_message('error', 'WRITER::[data_post()]ライター：エントリーキャンセル処理 トランザクションエラー');
            } else {
                $this->session->set_userdata('w_memENTRY', FALSE);                // ENTRY無をセッションデータに書き込み

                // エントリーキャンセル確認メールを送信
                $this->_mail_send02($post_data['pj_title'], $set_wdata, $flash_data);
            }

            redirect('/search_list/');

        }

    }

    // 個別投稿チェック＆保存
    public function data_save()
    {

        $set_data = array();
        $set_data['rep_check_flg'] = TRUE;

        // バリデーション・チェック
        $this->_set_validation01();
        $this->form_validation->run();

        $post_data = array();
        $post_data = $this->input->post();

        // 仕事別の投稿記事個別情報を取得
        $tmp_rep_pji_pj_id = $post_data['pji_pj_id'];
        $tmp_rep_pji_seq = intval($post_data['order_no']) - 1;
        $this->load->model('Report_info', 'rep', TRUE);
        $get_data = $this->rep->get_report_data($tmp_rep_pji_pj_id, $tmp_rep_pji_seq);

        // 文字数カウント＆チェック（min～max）
        $title_len = $this->_get_strlen_cnt($post_data['rep_title']);                            // 「空白」「改行」を除く
        if (($title_len < $get_data[0]['rep_t_char_min']) OR ($get_data[0]['rep_t_char_max'] < $title_len))
        {

            print("title_len = $title_len <br>");
            print("NG<br>");

            $set_data['rep_check_flg'] = FALSE;
            $this->smarty->assign('result_mess_ng', '投稿条件を満たしていません。');
        }
        $set_data['rep_title']           = $post_data['rep_title'];
        $set_data['rep_title_wordcount'] = $title_len;

        $body_len = $this->_get_strlen_cnt($post_data['rep_text_body']);                        // 「空白」「改行」を除く
        if (($body_len < $get_data[0]['rep_b_char_min']) OR ($get_data[0]['rep_b_char_max'] < $body_len))
        {

            print("body_len = $body_len <br>");
            print("NG<br>");

            $set_data['rep_check_flg'] = FALSE;
            $this->smarty->assign('result_mess_ng', '投稿条件を満たしていません。');
        }
        $set_data['rep_text_body']      = $post_data['rep_text_body'];
        $set_data['rep_body_wordcount'] = $body_len;

        // キーワード使用回数チェック（min～max）
        if ($set_data['rep_check_flg'] == TRUE)
        {
            $i = 1;
            $j = 1;
            foreach ($get_data[0] as $key => $val)
            {
                // タイトル部チェック
                if ((strpos($key, 'ep_t_k') == 1) && isset($val))
                {
                    $title_cnt = substr_count($post_data['rep_title'], $val);
                    $item = 'rep_t_count_min0' . $i;
                    if ((isset($get_data[0][$item])) && ($title_cnt < $get_data[0][$item]))
                    {

                        print("$item > $title_cnt <br>");
                        print("NG<br>");

                        $set_data['rep_check_flg'] = FALSE;
                        $this->smarty->assign('result_mess_ng', '投稿条件を満たしていません。');
                    }

                    $item = 'rep_t_count_max0' . $i;
                    if ((isset($get_data[0][$item])) && ($title_cnt > $get_data[0][$item]))
                    {

                        print("$item < $title_cnt <br>");
                        print("NG<br>");

                        $set_data['rep_check_flg'] = FALSE;
                        $this->smarty->assign('result_mess_ng', '投稿条件を満たしていません。');
                    }
                    $i++;
                }

                // 本文部チェック
                if ((strpos($key, 'ep_b_w') == 1) && isset($val))
                {
                    $body_cnt = substr_count($post_data['rep_text_body'], $val);
                    $item = 'rep_b_count_min0' . $j;
                    if ((isset($get_data[0][$item])) && ($body_cnt < $get_data[0][$item]))
                    {

                        print("$item > $body_cnt <br>");
                        print("NG<br>");

                        $set_data['rep_check_flg'] = FALSE;
                        $this->smarty->assign('result_mess_ng', '投稿条件を満たしていません。');
                    }

                    $item = 'rep_b_count_max0' . $j;
                    if ((isset($get_data[0][$item])) && ($body_cnt > $get_data[0][$item]))
                    {

                        print("$item < $body_cnt <br>");
                        print("NG<br>");

                        $set_data['rep_check_flg'] = FALSE;
                        $this->smarty->assign('result_mess_ng', '投稿条件を満たしていません。');
                    }
                    $j++;
                }
            }
        }



        //print_r($post_data);
        //print("<br><br>CHECK == ");
        //print($set_data['rep_check_flg']);
        //exit;


        // チェック後OK/NG保存
        $this->load->model('Report_info', 'rep', TRUE);
        $result = $this->rep->update_entryinfo($set_data, $tmp_rep_pji_pj_id, $tmp_rep_pji_seq);


        // セッションからフラッシュデータ読み込み＆書き込み
        //$flash_data['w_pj_id'] = $this->session->userdata('w_pj_id');

        // 作業データ 初期値セット
        $this->load->model('Project', 'pj', TRUE);                            // models 読み込み
        $get_data = $this->pj->get_order_info($tmp_rep_pji_pj_id, $tmp_rep_pji_seq);
        $this->smarty->assign('order_info', $get_data[0]);

        // 作業件数有無チェック(作業1～3)
        $this->_get_job_cnt($tmp_rep_pji_pj_id);

        // バリデーション・チェック
        //$this->_set_validation01();                                            // バリデーション設定

        $this->smarty->assign('not_disp', FALSE);
        $this->smarty->assign('order_no', $post_data['order_no']);
        $this->smarty->assign('result_mess_ok', '内容を保存しました。');
        $this->view('writer/my_entrylist/detail.tpl');

    }

    // 作業件数有無チェック(作業1～3)
    private function _get_job_cnt($pj_id)
    {

        $get_infodata = $this->pj->get_entry_info($pj_id);
        $tmp_arr_cnt  = count($get_infodata);
        $this->smarty->assign('job_cnt', $tmp_arr_cnt);

    }

    // 入力された文字列から「空白」「改行」を削除し文字数をカウントする
    private function _get_strlen_cnt($get_str)
    {

        // 空白削除
        $string = str_replace(array(' ', '　'), '', $get_str);

        // 改行削除 ＆ 文字数カウント
        $get_strlen_cnt = mb_strlen(str_replace(PHP_EOL, '' , $string));

        return $get_strlen_cnt;

    }

    // 現在の会員ランク単価を取得
    private function _get_member_tanka($cl_id)
    {

        $this->load->model('tanka', 'ta', TRUE);
        $tanka_list = $this->ta->get_tanka($cl_id);
        $tmp_tankainfo = "ブロンズ=" . $tanka_list[1]['ta_price'] . " 円、シルバー=" . $tanka_list[2]['ta_price'] . " 円、ゴールド=" . $tanka_list[3]['ta_price'] . " 円";
        $this->smarty->assign('tanka_info', $tmp_tankainfo);

    }

    // 投稿確認メールを送信
    private function _mail_send01($pj_title, $set_wdata, $wr_data)
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
                'pj_title'              => $pj_title,
                'wi_posting_date'       => $set_wdata['wi_posting_date'],
        );

        // メールテンプレートの読み込み
        $this->config->load('config_mailtpl');                                // メールテンプレート情報読み込み
        $mail_tpl = $this->config->item('MAILTPL_W_POSTING_ID');

        // メール送信
        $this->load->model('Mailtpl', 'mailtpl', TRUE);
        $this->mailtpl->getMailTpl($mail, $arrRepList, $mail_tpl);

    }

    // エントリーキャンセル確認メールを送信
    private function _mail_send02($pj_title, $set_wdata, $wr_data)
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
                'pj_title'              => $pj_title,
                'wi_update_date'        => $set_wdata['wi_update_date'],
        );

        // メールテンプレートの読み込み
        $this->config->load('config_mailtpl');                                // メールテンプレート情報読み込み
        $mail_tpl = $this->config->item('MAILTPL_W_CANSEL_ID');

        // メール送信
        $this->load->model('Mailtpl', 'mailtpl', TRUE);
        $this->mailtpl->getMailTpl($mail, $arrRepList, $mail_tpl);

    }

    // Pagination 設定
    private function _get_Pagination($entry_countall, $tmp_per_page)
    {

        $config['base_url']       = base_url() . '/orderlist/search/';        // ページの基本URIパス。「/コントローラクラス/アクションメソッド/」
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
        $arroptions_workstatus = array (
                ''  => '選択してください',
                '1' => $this->config->item('PJ_WSTATUS_CREATE'),
                '3' => $this->config->item('PJ_WSTATUS_CHECK'),
                '4' => $this->config->item('PJ_WSTATUS_CHECKOK'),
                '5' => $this->config->item('PJ_WSTATUS_CHECKNG'),
                '6' => $this->config->item('PJ_WSTATUS_TIMEOVER'),
                '7' => $this->config->item('PJ_WSTATUS_CANCEL'),
        );

        $this->smarty->assign('options_workstatus', $arroptions_workstatus);

    }

    // 各項目 初期値セット :: 申請内容
    private function _form_item_set00()
    {

        // ステータス状態 選択項目セット
        $this->config->load('config_status');
        $arroptions_workstatus = array (
                ''  => '選択してください',
                '1' => $this->config->item('PJ_WSTATUS_CREATE'),
                '3' => $this->config->item('PJ_WSTATUS_CHECK'),
                '4' => $this->config->item('PJ_WSTATUS_CHECKOK'),
                '5' => $this->config->item('PJ_WSTATUS_CHECKNG'),
                '6' => $this->config->item('PJ_WSTATUS_TIMEOVER'),
                '7' => $this->config->item('PJ_WSTATUS_CANCEL'),
        );

        // 難易度 選択項目セット
        $this->config->load('config_comm');
        $arroptions_diff = $this->config->item('TANKA_ADD_NAME');

        // ジャンル 選択項目セット
        $this->load->model('comm_select', 'select', TRUE);
        $genre_list = $this->select->get_genre();

        $this->smarty->assign('options_workstatus',       $arroptions_workstatus);
        $this->smarty->assign('options_wi_difficulty_id', $arroptions_diff);
        $this->smarty->assign('options_genre_list',       $genre_list);

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
                        'label'   => '作業ID',
                        'rules'   => 'trim|numeric'
                ),
                array(
                        'field'   => 'wi_pj_work_status',
                        'label'   => '作業状態',
                        'rules'   => 'trim|numeric'
                ),
        );

        $this->load->library('form_validation', $rule_set);                            // バリデーションクラス読み込み

    }

    // フォーム・バリデーションチェック:案件内容
    private function _set_validation00()
    {

        $rule_set = array(

        );

        $this->load->library('form_validation', $rule_set);                            // バリデーションクラス読み込み
    }

    // フォーム・バリデーションチェック:申請案件１～３
    private function _set_validation01()
    {

        $rule_set = array(
                array(
                        'field'   => 'rep_title',
                        'label'   => 'タイトル入力欄',
                        'rules'   => 'trim|max_length[100]'
                ),
                array(
                        'field'   => 'rep_text_body',
                        'label'   => '本文入力欄',
                        'rules'   => 'trim|max_length[10000]'
                ),
        );

        $this->load->library('form_validation', $rule_set);                            // バリデーションクラス読み込み
    }



//    // フォーム・バリデーションチェック:案件内容
//    private function _set_validation00()
//    {
//
//        $rule_set = array(
//                array(
//                        'field'   => 'pj_status',
//                        'label'   => 'ステータス (状態)',
//                        'rules'   => 'trim|required|numeric'
//                ),
//                array(
//                        'field'   => 'pj_order_title',
//                        'label'   => 'タイトル（表示件名）',
//                        'rules'   => 'trim|required|max_length[100]'
//                ),
//                array(
//                        'field'   => 'pj_genre01',
//                        'label'   => '希望ジャンル',
//                        'rules'   => 'trim|required|numeric'
//                ),
//                array(
//                        'field'   => 'pj_title',
//                        'label'   => '案件：タイトル',
//                        'rules'   => 'trim|required|max_length[100]'
//                ),
//                array(
//                        'field'   => 'pj_work',
//                        'label'   => '案件：概要',
//                        'rules'   => 'trim|required|max_length[10000]'
//                ),
//                array(
//                        'field'   => 'pj_notice',
//                        'label'   => '案件：注意事項',
//                        'rules'   => 'trim|max_length[10000]'
//                ),
//                array(
//                        'field'   => 'pj_example',
//                        'label'   => '案件：例文',
//                        'rules'   => 'trim|max_length[10000]'
//                ),
//                array(
//                        'field'   => 'pj_other',
//                        'label'   => '案件：その他',
//                        'rules'   => 'trim|max_length[10000]'
//                ),
//                array(
//                        'field'   => 'pj_addwork',
//                        'label'   => '案件：追加内容',
//                        'rules'   => 'trim|max_length[10000]'
//                ),
//
//
//                array(
//                        'field'   => 'pj_mm_rank_id',
//                        'label'   => '会員ランク指定',
//                        'rules'   => 'trim|required|numeric'
//                ),
//                array(
//                        'field'   => 'pj_word_tanka',
//                        'label'   => '個別文字単価指定',
//                        'rules'   => 'trim|decimal|max_length[4]'
//                ),
//                array(
//                        'field'   => 'pj_taa_difficulty_id',
//                        'label'   => '難易度(単価加算)指定',
//                        'rules'   => 'trim|required|numeric'
//                ),
//                array(
//                        'field'   => 'pj_event_id',
//                        'label'   => 'イベント指定',
//                        'rules'   => 'trim|numeric'
//                ),
//
//                array(
//                        'field'   => 'pj_delivery_time',
//                        'label'   => 'ライター投稿納期',
//                        'rules'   => 'trim|required|regex_match[/^\d{4}-\d{1,2}-\d{1,2} \d{1,2}:\d{1,2}+$/]|max_length[16]'
//                ),
//                array(
//                        'field'   => 'pj_limit_time',
//                        'label'   => 'ライター投稿制限時間',
//                        'rules'   => 'trim|required|numeric|max_length[6]'
//                ),
//                array(
//                        'field'   => 'pj_start_time',
//                        'label'   => '公開(募集)開始日時',
//                        'rules'   => 'trim|required|regex_match[/^\d{4}-\d{1,2}-\d{1,2} \d{1,2}:\d{1,2}+$/]|max_length[16]'
//                ),
//                array(
//                        'field'   => 'pj_end_time',
//                        'label'   => '公開(募集)終了日時',
//                        'rules'   => 'trim|required|regex_match[/^\d{4}-\d{1,2}-\d{1,2} \d{1,2}:\d{1,2}+$/]|max_length[16]'
//                ),
//                array(
//                        'field'   => 'pj_comment',
//                        'label'   => '備考',
//                        'rules'   => 'trim|max_length[2000]'
//                ),
//
//        );
//
//        $this->load->library('form_validation', $rule_set);                            // バリデーションクラス読み込み
//
//    }
//
//    // フォーム・バリデーションチェック::申請案件１～３
//    private function _set_validation01()
//    {
//
//        $rule_set = array(
//                array(
//                        'field'   => 'rep_status',
//                        'label'   => '使用有無設定',
//                        'rules'   => ''
//                ),
//
//                array(
//                        'field'   => 'rep_t_keyword01',
//                        'label'   => 'タイトル：必須ワード指定',
//                        'rules'   => 'trim|max_length[100]'
//                ),
//                array(
//                        'field'   => 'rep_t_keyword02',
//                        'label'   => 'タイトル：必須ワード指定',
//                        'rules'   => 'trim|max_length[100]'
//                ),
//                array(
//                        'field'   => 'rep_t_keyword03',
//                        'label'   => 'タイトル：必須ワード指定',
//                        'rules'   => 'trim|max_length[100]'
//                ),
//                array(
//                        'field'   => 'rep_t_count_min01',
//                        'label'   => 'タイトル：最低 使用回数',
//                        'rules'   => 'trim|max_length[10]'
//                ),
//                array(
//                        'field'   => 'rep_t_count_min02',
//                        'label'   => 'タイトル：最低 使用回数',
//                        'rules'   => 'trim|max_length[10]'
//                ),
//                array(
//                        'field'   => 'rep_t_count_min03',
//                        'label'   => 'タイトル：最低 使用回数',
//                        'rules'   => 'trim|max_length[10]'
//                ),
//                array(
//                        'field'   => 'rep_t_count_max01',
//                        'label'   => 'タイトル：最大 使用回数',
//                        'rules'   => 'trim|max_length[10]'
//                ),
//                array(
//                        'field'   => 'rep_t_count_max02',
//                        'label'   => 'タイトル：最大 使用回数',
//                        'rules'   => 'trim|max_length[10]'
//                ),
//                array(
//                        'field'   => 'rep_t_count_max03',
//                        'label'   => 'タイトル：最大 使用回数',
//                        'rules'   => 'trim|max_length[10]'
//                ),
//                array(
//                        'field'   => 'rep_t_char_min',
//                        'label'   => 'タイトル：最低 使用文字数',
//                        'rules'   => 'trim|max_length[10000]'
//                ),
//                array(
//                        'field'   => 'rep_t_char_max',
//                        'label'   => 'タイトル：最大 使用文字数',
//                        'rules'   => 'trim|max_length[10000]'
//                ),
//
//                array(
//                        'field'   => 'rep_b_word01',
//                        'label'   => '本文：必須ワード指定',
//                        'rules'   => 'trim|max_length[100]'
//                ),
//                array(
//                        'field'   => 'rep_b_word02',
//                        'label'   => '本文：必須ワード指定',
//                        'rules'   => 'trim|max_length[100]'
//                ),
//                array(
//                        'field'   => 'rep_b_word03',
//                        'label'   => '本文：必須ワード指定',
//                        'rules'   => 'trim|max_length[100]'
//                ),
//                array(
//                        'field'   => 'rep_b_word04',
//                        'label'   => '本文：必須ワード指定',
//                        'rules'   => 'trim|max_length[100]'
//                ),
//                array(
//                        'field'   => 'rep_b_word05',
//                        'label'   => '本文：必須ワード指定',
//                        'rules'   => 'trim|max_length[100]'
//                ),
//                array(
//                        'field'   => 'rep_b_count_min01',
//                        'label'   => 'タイトル：最低 使用回数',
//                        'rules'   => 'trim|max_length[10]'
//                ),
//                array(
//                        'field'   => 'rep_b_count_min02',
//                        'label'   => 'タイトル：最低 使用回数',
//                        'rules'   => 'trim|max_length[10]'
//                ),
//                array(
//                        'field'   => 'rep_b_count_min03',
//                        'label'   => 'タイトル：最低 使用回数',
//                        'rules'   => 'trim|max_length[10]'
//                ),
//                array(
//                        'field'   => 'rep_b_count_min04',
//                        'label'   => 'タイトル：最低 使用回数',
//                        'rules'   => 'trim|max_length[10]'
//                ),
//                array(
//                        'field'   => 'rep_b_count_min05',
//                        'label'   => 'タイトル：最低 使用回数',
//                        'rules'   => 'trim|max_length[10]'
//                ),
//                array(
//                        'field'   => 'rep_b_count_max01',
//                        'label'   => 'タイトル：最大 使用回数',
//                        'rules'   => 'trim|max_length[10]'
//                ),
//                array(
//                        'field'   => 'rep_b_count_max02',
//                        'label'   => 'タイトル：最大 使用回数',
//                        'rules'   => 'trim|max_length[10]'
//                ),
//                array(
//                        'field'   => 'rep_b_count_max03',
//                        'label'   => 'タイトル：最大 使用回数',
//                        'rules'   => 'trim|max_length[10]'
//                ),
//                array(
//                        'field'   => 'rep_b_count_max04',
//                        'label'   => 'タイトル：最大 使用回数',
//                        'rules'   => 'trim|max_length[10]'
//                ),
//                array(
//                        'field'   => 'rep_b_count_max05',
//                        'label'   => 'タイトル：最大 使用回数',
//                        'rules'   => 'trim|max_length[10]'
//                ),
//                array(
//                        'field'   => 'rep_b_char_min',
//                        'label'   => 'タイトル：最低 使用文字数',
//                        'rules'   => 'trim|max_length[10000]'
//                ),
//                array(
//                        'field'   => 'rep_b_char_max',
//                        'label'   => 'タイトル：最大 使用文字数',
//                        'rules'   => 'trim|max_length[10000]'
//                ),
//
//                array(
//                        'field'   => 'pji_work',
//                        'label'   => '案件申請：概要',
//                        'rules'   => 'trim|required|max_length[10000]'
//                ),
//                array(
//                        'field'   => 'pji_notice',
//                        'label'   => '案件申請：注意事項',
//                        'rules'   => 'trim|max_length[10000]'
//                ),
//                array(
//                        'field'   => 'pji_example',
//                        'label'   => '案件申請：例文',
//                        'rules'   => 'trim|max_length[10000]'
//                ),
//                array(
//                        'field'   => 'pji_other',
//                        'label'   => '案件申請：その他',
//                        'rules'   => 'trim|max_length[10000]'
//                ),
//                array(
//                        'field'   => 'pji_addwork',
//                        'label'   => '案件申請：追加内容',
//                        'rules'   => 'trim|max_length[10000]'
//                ),
//
//        );
//
//        $this->load->library('form_validation', $rule_set);                            // バリデーションクラス読み込み
//
//    }

}
