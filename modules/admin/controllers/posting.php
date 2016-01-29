<?php

class Posting extends MY_Controller
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

    // 投稿一覧TOP
    public function index()
    {

        // セッションデータをクリア
        $this->load->model('comm_auth', 'comm_auth', TRUE);
        $this->comm_auth->delete_session('admin');

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
        list($listall, $countall) = $this->pj->get_postinglist($this->input->post(), $tmp_per_page, $tmp_offset);
        $this->smarty->assign('listall', $listall);

        // Pagination 設定
        $set_pagination = $this->_get_Pagination($countall, $tmp_per_page);

        $this->smarty->assign('set_pagination', $set_pagination['page_link']);
        $this->smarty->assign('countall',       $countall);
        $this->smarty->assign('serch_item',     $this->input->post());

        $this->view('admin/posting/index.tpl');

    }

    // 一覧表示
    public function search()
    {

        // 検索項目の保存が上手くいかない。応急的に対応！
        if ($this->input->post('submit') == '_submit')
        {
            // セッションをフラッシュデータとして保存
            $data = array(
                    'a_pj_id'           => $this->input->post('pj_id'),
                    'a_pj_en_id'        => $this->input->post('pj_en_id'),
                    'a_pj_en_cl_id'     => $this->input->post('pj_en_cl_id'),
                    'a_pj_status'       => $this->input->post('pj_status'),
                    'a_pj_work_status'  => $this->input->post('pj_work_status'),
                    'a_pj_genre01'      => $this->input->post('pj_genre01'),
                    'a_pj_title'        => $this->input->post('pj_title'),
                    'a_pj_entry_status' => $this->input->post('pj_entry_status'),
                    'a_orderid'         => $this->input->post('orderid'),
                    'a_orderstatus'     => $this->input->post('orderstatus'),
            );
            $this->session->set_userdata($data);

            $tmp_inputpost = $this->input->post();
            unset($tmp_inputpost["submit"]);

        } else {
            // セッションからフラッシュデータ読み込み
            $tmp_inputpost['pj_id']           = $this->session->userdata('a_pj_id');
            $tmp_inputpost['pj_en_id']        = $this->session->userdata('a_pj_en_id');
            $tmp_inputpost['pj_en_cl_id']     = $this->session->userdata('a_pj_en_cl_id');
            $tmp_inputpost['pj_status']       = $this->session->userdata('a_pj_status');
            $tmp_inputpost['pj_work_status']  = $this->session->userdata('a_pj_work_status');
            $tmp_inputpost['pj_genre01']      = $this->session->userdata('a_pj_genre01');
            $tmp_inputpost['pj_title']        = $this->session->userdata('a_pj_title');
            $tmp_inputpost['pj_entry_status'] = $this->session->userdata('a_pj_entry_status');
            $tmp_inputpost['orderid']         = $this->session->userdata('a_orderid');
            $tmp_inputpost['orderstatus']     = $this->session->userdata('a_orderstatus');
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
        list($listall, $countall) = $this->pj->get_postinglist($tmp_inputpost, $tmp_per_page, $tmp_offset);
        $this->smarty->assign('listall', $listall);

        // Pagination 設定
        $set_pagination = $this->_get_Pagination($countall, $tmp_per_page);

        // 検索項目 初期値セット
        $this->_search_set();

        $this->smarty->assign('set_pagination', $set_pagination['page_link']);
        $this->smarty->assign('countall',       $countall);
        $this->smarty->assign('serch_item',     $tmp_inputpost);
        $this->smarty->assign('not_disp',       FALSE);

        $this->view('admin/posting/index.tpl');

    }

    // 申請内容
    public function detail00()
    {

        // セッションからフラッシュデータ読み込み
        $flash_data['a_pj_id'] = $this->session->userdata('a_pj_id');


        // 投稿内容データ 初期値セット
        $this->load->model('Project', 'pj', TRUE);


        // 案件申請ID取得
        $input_post = $this->input->post();
        if (empty($input_post['pjid_uniq']))
        {
            // ２回目以降
            $tmp_pjid = $flash_data['a_pj_id'];
        } else {
            // 初回
            $tmp_pjid = $input_post['pjid_uniq'];
        }




        print("flash_data00 == ");
        print($tmp_pjid);
        print("<br><br>");




        $get_data = $this->pj->get_posting($tmp_pjid);

        // SELECT項目 初期値セット
        $this->_form_item_set00($get_data[0]['pj_en_cl_id']);

        $get_data[0]['pj_delivery_time'] = date('Y-m-d H:i', strtotime($get_data[0]['pj_delivery_time']));
        $get_data[0]['pj_start_time']    = date('Y-m-d H:i', strtotime($get_data[0]['pj_start_time']));
        $get_data[0]['pj_end_time']      = date('Y-m-d H:i', strtotime($get_data[0]['pj_end_time']));
        $get_data[0]['pj_en_entry_date'] = date('Y-m-d',     strtotime($get_data[0]['pj_en_entry_date']));

        $this->smarty->assign('entry_info', $get_data[0]);

        // session:フラッシュデータに案件申請ID書き込み
        $tmp_flash_pjid = array('a_pj_id' => $get_data[0]['pj_id']);
        $this->session->set_userdata( $tmp_flash_pjid);

        // バリデーション設定
        $this->_set_validation00();
        //$this->form_validation->run();

        $this->smarty->assign('entry_no', '00');
        $this->smarty->assign('not_disp', FALSE);

        $this->view('admin/posting/detail.tpl');

    }

    // 申請案件１
    public function detail01()
    {

        // SELECT項目 初期値セット
        //$this->_search_set01();

        // セッションからフラッシュデータ読み込み＆書き込み
        $flash_data['a_pj_id'] = $this->session->userdata('a_pj_id');
        //$this->session->set_flashdata( $flash_data);


        print("flash_data01 == ");
        print_r($flash_data['a_pj_id']);
        print("<br><br>");


        // 投稿データ 初期値セット
        $this->load->model('Project_info', 'pji', TRUE);                    // models 読み込み
        $get_data = $this->pji->get_order_info($flash_data['a_pj_id'], $pji_seq = 0);

        $this->smarty->assign('entry_info', $get_data[0]);

        // バリデーション・チェック
        $this->_set_validation01();                                            // バリデーション設定
        //$this->form_validation->run();

        $this->smarty->assign('entry_no', '01');
        $this->smarty->assign('not_disp', FALSE);

        $this->view('admin/posting/detail.tpl');

    }

    // 申請案件２
    public function detail02()
    {

        // セッションからフラッシュデータ読み込み＆書き込み
        $flash_data['a_pj_id'] = $this->session->userdata('a_pj_id');
        //$this->session->set_flashdata( $flash_data);


        print("flash_data02 == ");
        print_r($flash_data['a_pj_id']);
        print("<br><br>");


        // 申請案件データ 初期値セット
        $this->load->model('Project_info', 'pji', TRUE);                    // models 読み込み
        $get_data = $this->pji->get_order_info($flash_data['a_pj_id'], $pji_seq = 1);
        if (empty($get_data))
        {
            // 各項目 初期値セット
            $this->_form_item_set01($flash_data['a_pj_id']);
            $this->smarty->assign('not_disp', TRUE);
        } else {
            // 各項目 初期値セット
            $this->_form_item_set01($flash_data['a_pj_id']);
            $this->smarty->assign('entry_info', $get_data[0]);
            $this->smarty->assign('not_disp', FALSE);
        }

        // バリデーション・チェック
        $this->_set_validation01();                                            // バリデーション設定
        //$this->form_validation->run();

        $this->smarty->assign('entry_no', '02');
        $this->view('admin/posting/detail.tpl');

    }

    // 申請案件３
    public function detail03()
    {

        // セッションからフラッシュデータ読み込み＆書き込み
        $flash_data['a_pj_id'] = $this->session->userdata('a_pj_id');
        //$this->session->set_flashdata( $flash_data);


        print("flash_data03 == ");
        print_r($flash_data['a_pj_id']);
        print("<br><br>");


        // 申請案件データ 初期値セット
        $this->load->model('Project_info', 'pji', TRUE);                    // models 読み込み
        $get_data = $this->pji->get_order_info($flash_data['a_pj_id'], $pji_seq = 2);
        if (empty($get_data))
        {
            // 各項目 初期値セット
            $this->_form_item_set01($flash_data['a_pj_id']);
            $this->smarty->assign('not_disp', TRUE);
        } else {
            // 各項目 初期値セット
            $this->_form_item_set01($flash_data['a_pj_id']);
            $this->smarty->assign('entry_info', $get_data[0]);
            $this->smarty->assign('not_disp', FALSE);
        }

        // バリデーション・チェック
        $this->_set_validation01();                                            // バリデーション設定
        //$this->form_validation->run();

        $this->smarty->assign('entry_no', '03');
        $this->view('admin/posting/detail.tpl');

    }

    // 案件申請データ更新
    public function data_entry()
    {

        $this->load->model('Project_info', 'pji', TRUE);                            // models 読み込み
        $this->load->model('Report_info',  'rep', TRUE);


        // セッションからフラッシュデータ読み込み＆書き込み
        $flash_data['a_pj_id'] = $this->session->userdata('a_pj_id');



        print("flash_data_entry == ");
        print_r($flash_data['a_pj_id']);
        print("<br><br>");



        $get_post_data = array();
        $get_post_data = $this->input->post();
        $set_orderno   = $get_post_data['entry_no'];


        // バリデーション・チェック::TAB毎に処理振り分け
        $this->_set_validation01();
        if ($this->form_validation->run() == TRUE)
        {
            // 案件個別情報('pji_')を抽出＆更新
            $set_update_data['pji_pj_id']   = $flash_data['a_pj_id'];                // 案件ID
            $set_update_data['pji_seq']     = intval($set_orderno) -1;                // 枝番
            $set_update_data['pji_addwork'] = $get_post_data['pji_addwork'];        // 追加仕事情報

            // UPDATE
            $result = $this->pji->update_orderinfo($set_update_data);

            // 納品前の校正
            if (isset($get_post_data['rep_title']))
            {
                $time = time();

                $set_update_info['rep_title']       = $get_post_data['rep_title'];            // タイトル
                $set_update_info['rep_text_body']   = $get_post_data['rep_text_body'];        // 本文
                $set_update_info['rep_update_date'] = date("Y-m-d H:i", $time);                // 更新日

                $this->rep->update_entryinfo($set_update_info, $flash_data['a_pj_id'], intval($set_orderno) -1);
            }

        }

        // 各項目 初期値セット
        $get_data = $this->pji->get_order_info($flash_data['a_pj_id'], intval($set_orderno) -1);

        $this->smarty->assign('not_disp', FALSE);

        $this->smarty->assign('entry_info', $get_data[0]);
        $this->smarty->assign('entry_no', $set_orderno);
        $this->view('admin/posting/detail.tpl');

    }

    // データ更新 (更新＆審査＆納品)
    public function data_update()
    {

        $this->load->model('Project',      'pj',     TRUE);
        $this->load->model('Project_info', 'pjinfo', TRUE);
        $this->load->model('Report_info',  'rep',    TRUE);
        $this->load->model('Writer',       'wr',     TRUE);
        $this->load->model('Writer_info',  'wrinfo', TRUE);
        $this->config->load('config_status');


        // セッションからフラッシュデータ読み込み＆書き込み
        $flash_data['a_pj_id'] = $this->session->userdata('a_pj_id');

        // バリデーション・チェック::TAB毎に処理振り分け
        $this->_set_validation00();
        if ($this->form_validation->run() == FALSE)
        {

            // 投稿内容データの再取得
            $tmp_pjid = $flash_data['a_pj_id'];
            $get_data = $this->pj->get_posting($tmp_pjid);

            // 初期値セット
            $this->_form_item_set00($get_data[0]['pj_en_cl_id']);

            $get_data[0]['pj_delivery_time'] = date('Y-m-d H:i', strtotime($get_data[0]['pj_delivery_time']));
            $get_data[0]['pj_start_time']    = date('Y-m-d H:i', strtotime($get_data[0]['pj_start_time']));
            $get_data[0]['pj_end_time']      = date('Y-m-d H:i', strtotime($get_data[0]['pj_end_time']));
            $get_data[0]['pj_en_entry_date'] = date('Y-m-d',     strtotime($get_data[0]['pj_en_entry_date']));

            $this->smarty->assign('entry_info', $get_data[0]);

            $this->smarty->assign('entry_no', '00');
            $this->smarty->assign('not_disp', FALSE);

            $this->view('admin/posting/detail.tpl');

        } else {

            // 「pj_work_status」毎に処理を分ける
            $input_post = $this->input->post();
            $time = time();

            if ($input_post['submit'] == '_update')
            {

                // ★「追加内容」の更新
                $set_update_data['pj_id']            = $flash_data['a_pj_id'];                      // 案件ID
                $set_update_data['pj_status']        = $input_post['pj_status'];                    // ステータス
                $set_update_data['pj_delivery_time'] = $input_post['pj_delivery_time'];             // ライター投稿期限
                $set_update_data['pj_start_time']    = $input_post['pj_start_time'];                // 公開(募集)開始日時
                $set_update_data['pj_end_time']      = $input_post['pj_end_time'];                  // 公開(募集)終了日時
                $set_update_data['pj_addwork']       = $input_post['pj_addwork'];                   // 追加仕事情報
                $set_update_data['pj_comment']       = $input_post['pj_comment'];                   // メモ
                $set_update_data['pj_update_date']   = date("Y-m-d H:i", $time);                    // 更新日

                // UPDATE
                $result = $this->pj->update_pj_posting($set_update_data);

            } elseif ($input_post['submit'] == '_ok') {
                // ★「審査OK」処理

                // 総文字数をカウント
                $get_data_info = $this->pjinfo->get_order_info($flash_data['a_pj_id']);
                $tmp_wordcnt = 0;
                foreach ($get_data_info as $key => $val)
                {
                    $tmp_wordcnt += $get_data_info[$key]['rep_title_wordcount'] + $get_data_info[$key]['rep_body_wordcount'];
                }

                // ライター情報の読み込み
                $get_data_wr = $this->pj->get_posting($flash_data['a_pj_id']);

                $set_widata['wi_wr_id']          = $get_data_wr[0]['pj_wr_id'];                     // ライターID
                $set_widata['wi_pj_id']          = $flash_data['a_pj_id'];                          // 案件ID
                $set_widata['wi_pj_work_status'] = $this->config->item('PJ_WSTATUS_CHECKOK_ID');    // 「審査OK」
                $set_widata['wi_word_count']     = $tmp_wordcnt;                                    // 総文字数

                $this->load->model('Admin', ad, TRUE);
                $get_point = $this->ad->cal_point($tmp_wordcnt, $get_data_wr[0]['wi_word_tanka']);
                $set_widata['wi_point']        = $get_point["val"];                                 // 獲得ポイント
                $set_widata['wi_point_adjust'] = $input_post['wi_point_adjust'];                    // 調整ポイント
                $set_widata['wi_pay_money']    = $get_point["val"] + $input_post['wi_point_adjust'];// 入金金額(予定)

                $set_widata['wi_check_date']  = date("Y-m-d H:i", $time);                           // 審査完了日
                $set_widata['wi_update_date'] = date("Y-m-d H:i", $time);                           // 更新日

                $set_wdata['wr_id'] = $get_data_wr[0]['pj_wr_id'];                                  // ライターID
                $set_wdata['wr_entry_count']  = $get_data_wr[0]['wr_entry_count'] + 1;              // エントリー回数
                $set_wdata['wr_saiyo_count']  = $get_data_wr[0]['wr_saiyo_count'] + 1;              // 採用回数
                $set_wdata['wr_point_total']  = $get_data_wr[0]['wr_point_total']
                                                + $get_point["val"]
                                                + $input_post['wi_point_adjust'];                   // ポイント累計
                $set_wdata['wr_update_date']  = date("Y-m-d H:i", $time);                           // 更新日

                $set_pdata['pj_id'] = $flash_data['a_pj_id'];                                       // 案件ID
                $set_pdata['pj_status']          = $this->config->item('PJ_STATUS_END_ID');         // 「公開終了」
                $set_pdata['pj_work_status']     = $this->config->item('PJ_WSTATUS_CHECKOK_ID');    // 「審査OK」
                $set_pdata['pj_wi_point']        = $get_point["val"];                               // 獲得ポイント
                $set_pdata['pj_wi_point_adjust'] = $input_post['wi_point_adjust'];                  // 調整ポイント
                $set_pdata['pj_comment']         = $input_post['pj_comment'];                       // メモ
                $set_pdata['pj_wi_check_date']   = date("Y-m-d H:i", $time);                        // 審査完了日
                $set_pdata['pj_update_date']     = date("Y-m-d H:i", $time);                        // 更新日

                // トランザクション・START
                $this->db->trans_strict(FALSE);                                      // StrictモードをOFF
                $this->db->trans_start();                                            // trans_begin

                    // UPDATE:ライター個別情報
                    $this->wrinfo->update_wi_posting($set_widata);

                    // UPDATE:ライター情報
                    $this->wr->update_wr_posting($set_wdata);

                    // UPDATE:案件情報
                    $this->pj->update_pj_posting($set_pdata);

                // トランザクション・COMMIT
                $this->db->trans_complete();                                        // trans_rollback & trans_commit
                if ($this->db->trans_status() === FALSE)
                {
                    log_message('error', 'ADMIN::[data_update()]ADMIN：投稿審査OK処理 トランザクションエラー');
                } else {
                    // 審査OKメールを送信
                    $set_mail['wr_email']       = $get_data_wr[0]['wr_email'];
                    $set_mail['wr_nickname']    = $get_data_wr[0]['wr_nickname'];
                    $set_mail['pj_id']          = $flash_data['a_pj_id'];
                    $set_mail['pj_order_title'] = $get_data_info[0]['pj_order_title'];
                    $set_mail['pj_wi_point']    = $get_point["val"] + $input_post['wi_point_adjust'];
                    $this->_mail_send01($set_mail, '審査合格');
                }



            } elseif ($input_post['submit'] == '_ng') {
                // ★「審査NG」処理

                $get_data_info = $this->pjinfo->get_order_info($flash_data['a_pj_id']);
                $get_data_wr = $this->pj->get_posting($flash_data['a_pj_id']);

                $set_widata['wi_wr_id']          = $get_data_wr[0]['pj_wr_id'];                     // ライターID
                $set_widata['wi_pj_id']          = $flash_data['a_pj_id'];                          // 案件ID
                $set_widata['wi_pj_work_status'] = $this->config->item('PJ_WSTATUS_CHECKNG_ID');    // 「審査NG」
                $set_widata['wi_check_date']     = date("Y-m-d H:i", $time);                        // 審査完了日
                $set_widata['wi_update_date']    = date("Y-m-d H:i", $time);                        // 更新日

                $set_wdata['wr_id']          = $get_data_wr[0]['pj_wr_id'];                         // ライターID
                $set_wdata['wr_entry_count'] = $get_data_wr[0]['wr_entry_count'] + 1;               // エントリー回数
                $set_wdata['wr_update_date'] = date("Y-m-d H:i", $time);                            // 更新日

                $set_pdata['pj_id']           = $flash_data['a_pj_id'];                             // 案件ID
                $set_pdata['pj_status']       = $this->config->item('PJ_STATUS_REOPEN_ID');         // 「(再)公開」
                $set_pdata['pj_entry_status'] = $this->config->item('PJ_ESTATUS_NOENTRY_ID');       // 「エントリー無」
                $set_pdata['pj_work_status']  = $this->config->item('PJ_WSTATUS_ENTRY_ID');         // 「投稿なし」
                $set_pdata['pj_wr_id'] = NULL;                                                      // ライターID:int
                $set_pdata['pj_wi_id'] = NULL;                                                      // ライター個別情報ID:int
                $set_pdata['pj_comment']      = $input_post['pj_comment'];                          // メモ
                $set_pdata['pj_update_date']  = date("Y-m-d H:i", $time);                           // 更新日

                $set_pdata['pj_id']               = $flash_data['a_pj_id'];                         // 案件ID
                $set_edata['rep_check_flg']       = FALSE;                                          // チェックフラグ
                $set_edata['rep_title']           = NULL;                                           // タイトル
                $set_edata['rep_title_wordcount'] = 0;                                              // タイトル文字数:int
                $set_edata['rep_text_body']       = NULL;                                           // 本文
                $set_edata['rep_body_wordcount']  = 0;                                              // 本文文字数:int
                $set_edata['rep_update_date']     = date("Y-m-d H:i", $time);                       // 更新日

                // トランザクション・START
                $this->db->trans_strict(FALSE);                                      // StrictモードをOFF
                $this->db->trans_start();                                            // trans_begin

                    // UPDATE:ライター個別情報
                    $this->wrinfo->update_wi_posting($set_widata);

                    // UPDATE:ライター情報
                    $this->wr->update_wr_posting($set_wdata);

                    // UPDATE:案件情報
                    $this->pj->update_pj_posting($set_pdata);

                    // UPDATE:投稿記事個別情報
                    $get_infodata = $this->pj->get_order_info($flash_data['a_pj_id']);
                    $tmp_arr_cnt  = count($get_infodata);                                            // 作業件数有無チェック(作業1～3)
                    for ($rep_seq = 0; $rep_seq < $tmp_arr_cnt; $rep_seq++)
                    {
                        $this->rep->update_entryinfo($set_edata, $set_edata['rep_pji_pj_id'], $rep_seq);
                    }

                // トランザクション・COMMIT
                $this->db->trans_complete();                                        // trans_rollback & trans_commit
                if ($this->db->trans_status() === FALSE)
                {
                    log_message('error', 'ADMIN::[data_update()]ADMIN：投稿審査NG処理 トランザクションエラー');
                } else {
                    // 審査NGメールを送信
                    $set_mail['wr_email']       = $get_data_wr[0]['wr_email'];
                    $set_mail['wr_nickname']    = $get_data_wr[0]['wr_nickname'];
                    $set_mail['pj_id']          = $flash_data['a_pj_id'];
                    $set_mail['pj_order_title'] = $get_data_info[0]['pj_order_title'];
                    $set_mail['pj_wi_point']    = 0;
                    $this->_mail_send01($set_mail, '審査不合格');
                }

            } elseif ($input_post['submit'] == '_deliver') {
                // ★「納品」処理

                // バリデーション・チェック::TAB毎に処理振り分け
                $this->_set_validation01();
                $this->form_validation->run();

                $set_pdata['pj_id']            = $flash_data['a_pj_id'];                            // 案件ID
                $set_pdata['pj_pay_money']     = $input_post['wi_point']
                                                 + $input_post['wi_point_adjust'];                  // 支払金額
                $set_pdata['pj_deliver_flg']   = $this->config->item('PJ_DSTATUS_OK_ID');           // 「納品済」
                $set_pdata['pj_delivery_date'] = date("Y-m-d H:i", $time);                          // 納品日
                $set_pdata['pj_update_date']   = date("Y-m-d H:i", $time);                          // 更新日
                $set_pdata['pj_comment']       = $input_post['pj_comment'];                         // メモ

                // UPDATE:案件情報
                $this->pj->update_pj_posting($set_pdata);

                // 納品メールを送信
                $get_data_info = $this->pjinfo->get_order_info($flash_data['a_pj_id']);

                $set_mail['pj_id']            = $flash_data['a_pj_id'];
                $set_mail['pj_en_cl_id']      = $get_data_info[0]['pj_en_cl_id'];
                $set_mail['pj_order_title']   = $input_post['pj_order_title'];
                $set_mail['pj_delivery_date'] = date("Y-m-d H:i", $time);
                $this->_mail_send02($set_mail);

            }

            redirect('/posting/');

        }
    }

    // 審査完了メールを送信
    private function _mail_send01($set_mail, $accept = NULL)
    {

        // メール送信先設定
        $mail['from']      = "";
        $mail['from_name'] = "";
        $mail['subject']   = "";
        $mail['to']        = $set_mail['wr_email'];
        $mail['cc']        = "";
        $mail['bcc']       = "";

        // メール本文置き換え文字設定
        $arrRepList = array(
                'wr_nickname'    => $set_mail['wr_nickname'],
                'pj_id'          => $set_mail['pj_id'],
                'pj_order_title' => $set_mail['pj_order_title'],
                'pj_wi_point'    => $set_mail['pj_wi_point'],
                'accept'         => $accept,
        );

        // メールテンプレートの読み込み
        $this->config->load('config_mailtpl');                                // メールテンプレート情報読み込み
        $mail_tpl = $this->config->item('MAILTPL_AD_CHECKOK_ID');

        // メール送信
        $this->load->model('Mailtpl', 'mailtpl', TRUE);
        $this->mailtpl->getMailTpl($mail, $arrRepList, $mail_tpl);

    }

    // 納品確認メールを送信
    private function _mail_send02($set_mail)
    {

        // メール送信先クライアントの会社名＆メールアドレスを取得
        $this->load->model('Client', 'cl', TRUE);
        $get_client_info = $this->cl->get_client_name($set_mail['pj_en_cl_id']);

        // メール送信先設定
        $mail['from']      = "";
        $mail['from_name'] = "";
        $mail['subject']   = "";
        $mail['to']        = $get_client_info[0]['cl_email'];
        $mail['cc']        = "";
        $mail['bcc']       = "";

        // メール本文置き換え文字設定
        $arrRepList = array(
                'cl_company'       => $get_client_info[0]['cl_company'],
                'cl_person01'      => $get_client_info[0]['cl_person01'],
                'cl_person02'      => $get_client_info[0]['cl_person02'],
                'pj_id'            => $set_mail['pj_id'],
                'pj_order_title'   => $set_mail['pj_order_title'],
                'pj_delivery_date' => $set_mail['pj_delivery_date'],
        );

        // メールテンプレートの読み込み
        $this->config->load('config_mailtpl');                                // メールテンプレート情報読み込み
        $mail_tpl = $this->config->item('MAILTPL_AD_DELIVER_ID');

        // メール送信
        $this->load->model('Mailtpl', 'mailtpl', TRUE);
        $this->mailtpl->getMailTpl($mail, $arrRepList, $mail_tpl);

    }

    // Pagination 設定
    private function _get_Pagination($countall, $tmp_per_page)
    {

        $config['base_url']       = base_url() . '/posting/search/';        // ページの基本URIパス。「/コントローラクラス/アクションメソッド/」
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

    // 検索項目 初期値セット
    private function _search_set()
    {

        // ステータス状態 選択項目セット
        $this->config->load('config_status');
        $arroptions_pjstatus = array (
                ''  => '選択してください',
                '1' => $this->config->item('PJ_STATUS_OPEN'),
                '2' => $this->config->item('PJ_STATUS_REOPEN'),
                '3' => $this->config->item('PJ_STATUS_PREMIERE'),
                '4' => $this->config->item('PJ_STATUS_NOMINATE'),
                '5' => $this->config->item('PJ_STATUS_CLOSE'),
                '6' => $this->config->item('PJ_STATUS_END'),
                '8' => $this->config->item('PJ_STATUS_HORYU'),
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
                '8' => $this->config->item('PJ_STATUS_HORYU'),
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
                array(
                        'field'   => 'wi_point_adjust',
                        'label'   => '調整ポイント数',
                        'rules'   => 'trim|numeric|max_length[9]'
                ),
        		array(
                        'field'   => 'pj_delivery_time',
                        'label'   => 'ライター投稿期限',
                        'rules'   => 'trim|required|regex_match[/^\d{4}-\d{1,2}-\d{1,2} \d{1,2}:\d{1,2}+$/]|max_length[16]'
                ),
                array(
                        'field'   => 'pj_start_time',
                        'label'   => '公開(募集)開始日時',
                        'rules'   => 'trim|required|regex_match[/^\d{4}-\d{1,2}-\d{1,2} \d{1,2}:\d{1,2}+$/]|max_length[16]'
                ),
        		array(
                        'field'   => 'pj_end_time',
                        'label'   => '公開(募集)終了日時',
                        'rules'   => 'trim|required|regex_match[/^\d{4}-\d{1,2}-\d{1,2} \d{1,2}:\d{1,2}+$/]|max_length[16]'
                ),
                array(
                        'field'   => 'en_comment',
                        'label'   => '備考',
                        'rules'   => 'trim|max_length[10000]'
                ),
                array(
                        'field'   => 'pj_addwork',
                        'label'   => '追加内容',
                        'rules'   => 'trim|max_length[10000]'
                ),

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
                array(
                        'field'   => 'rep_title',
                        'label'   => 'タイトル',
                        'rules'   => 'trim|max_length[100]'
                ),
                array(
                        'field'   => 'rep_text_body',
                        'label'   => '本文',
                        'rules'   => 'trim|max_length[10000]'
                ),
                array(
                        'field'   => 'pji_addwork',
                        'label'   => '追加内容',
                        'rules'   => 'trim|max_length[10000]'
                ),

        );

        $this->load->library('form_validation', $rule_set);                            // バリデーションクラス読み込み

    }

}
