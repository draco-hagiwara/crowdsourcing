<?php

class My_point extends MY_Controller
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

        $tmp_inputpost                  = $this->input->post();
        $tmp_inputpost['wi_wr_id']      = $this->session->userdata('w_memID');
        $tmp_inputpost['wi_pay_status'] = NULL;
        $tmp_inputpost['wi_pj_id']      = NULL;
        $tmp_inputpost['pj_title']      = NULL;
        $tmp_inputpost['check_date_st'] = date('Y/m/d', strtotime("-1 month"));
        $tmp_inputpost['check_date_ed'] = NULL;
        $tmp_inputpost['pay_date_st']   = NULL;
        $tmp_inputpost['pay_date_ed']   = NULL;

        list($point_list, $point_countall) = $this->wrinfo->get_pointlist($tmp_inputpost, $tmp_per_page, $tmp_offset);

        // Pagination 設定
        $set_pagination = $this->_get_Pagination($point_countall, $tmp_per_page, NULL);

        $this->smarty->assign('listall',        $point_list);

        $this->smarty->assign('set_pagination', $set_pagination['page_link']);
        $this->smarty->assign('countall',       $point_countall);

        $tmp_inputpost['check_date_st'] = date('Y/m/d', strtotime("-1 month"));
        $this->smarty->assign('serch_item',     $tmp_inputpost);

        $this->view('writer/my_point/index.tpl');

    }

    // 一覧表示
    public function search()
    {

        $tmp_inputpost = array();
        if ($this->input->post('submit') == '_submit')
        {
            // セッションをフラッシュデータとして保存
            $data = array(
                    'w_wi_pay_status' => $this->input->post('wi_pay_status'),
            		'w_pj_id'         => $this->input->post('pj_id'),
                    'w_pj_title'      => $this->input->post('pj_title'),
                    'w_check_date_st' => $this->input->post('check_date_st'),
                    'w_check_date_ed' => $this->input->post('check_date_ed'),
                    'w_pay_date_st'   => $this->input->post('pay_date_st'),
                    'w_pay_date_ed'   => $this->input->post('pay_date_ed'),
            );
            $this->session->set_userdata($data);

            $tmp_inputpost = $this->input->post();
            $tmp_inputpost['wi_wr_id'] = $this->session->userdata('w_memID');
            unset($tmp_inputpost["submit"]);

        } else {
            // セッションからフラッシュデータ読み込み
            $tmp_inputpost['wi_wr_id']      = $this->session->userdata('w_memID');
            $tmp_inputpost['wi_pay_status'] = $this->session->userdata('w_wi_pay_status');
            $tmp_inputpost['pj_id']         = $this->session->userdata('w_pj_id');
            $tmp_inputpost['pj_title']      = $this->session->userdata('w_pj_title');
            $tmp_inputpost['check_date_st'] = $this->session->userdata('w_check_date_st');
            $tmp_inputpost['check_date_ed'] = $this->session->userdata('w_check_date_ed');
            $tmp_inputpost['pay_date_st']   = $this->session->userdata('w_pay_date_st');
            $tmp_inputpost['pay_date_ed']   = $this->session->userdata('w_pay_date_ed');
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
        list($point_list, $point_countall) = $this->wrinfo->get_pointlist($tmp_inputpost, $tmp_per_page, $tmp_offset);

        // Pagination 設定
        $set_pagination = $this->_get_Pagination($point_countall, $tmp_per_page);

        // 検索項目 初期値セット
        $this->_search_set();

        $this->smarty->assign('listall',        $point_list);

        $this->smarty->assign('set_pagination', $set_pagination['page_link']);
        $this->smarty->assign('countall',       $point_countall);
        $this->smarty->assign('serch_item',     $tmp_inputpost);

        $this->view('writer/my_point/index.tpl');

    }

    // Pagination 設定
    private function _get_Pagination($entry_countall, $tmp_per_page)
    {

        $config['base_url']       = base_url() . '/my_point/search/';       // ページの基本URIパス。「/コントローラクラス/アクションメソッド/」
        $config['per_page']       = 20;                                     // 1ページ当たりの表示件数。
        //$config['per_page']       = $tmp_per_page;                        // 1ページ当たりの表示件数。
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

        $this->smarty->assign('options_paystatus', $arroptions_paystatus);

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
                        'field'   => 'pj_title',
                        'label'   => '作業件名',
                        'rules'   => 'trim|max_length[100]'
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

}
