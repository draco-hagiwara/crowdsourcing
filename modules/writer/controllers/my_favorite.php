<?php

class My_favorite extends MY_Controller
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

        // 初期値セット
        $this->_form_item_set00();

        // 1ページ当たりの表示件数
        //$this->config->load('config_comm');
        //$tmp_per_page = $this->config->item('PAGINATION_PER_PAGE');
        $tmp_per_page = 20;

        // Pagination 現在ページ数の取得：：URIセグメントの取得
        $segments = $this->uri->segment_array();
        if (isset($segments[3]))
        {
            $tmp_offset = $segments[3];
        } else {
            $tmp_offset = 0;
        }

        // 気になるリスト＆件数を取得
        $this->load->model('Favorite', 'fav', TRUE);

        $tmp_setdata['fa_wr_id'] = $this->session->userdata('w_memID');
        list($favorite_list, $favorite_countall) = $this->fav->get_favist($tmp_setdata, $tmp_per_page, $tmp_offset);

        // Pagination 設定
        $set_pagination = $this->_get_Pagination($favorite_countall, $tmp_per_page, NULL);

        $this->smarty->assign('set_pagination', $set_pagination['page_link']);
        $this->smarty->assign('countall',       $favorite_countall);
        $this->smarty->assign('favorite_list',  $favorite_list);

        $this->view('writer/my_favorite/index.tpl');

    }

    // 仕事ページ ＆ 削除
    public function detail()
    {

        // セッションからフラッシュデータ読み込み＆書き込み
        //$flash_data['w_pj_id']   = $this->session->userdata('w_pj_id');
        //$flash_data['w_memID']   = $this->session->userdata('w_memID');
        //$flash_data['w_memRANK'] = $this->session->userdata('w_memRANK');
        //$flash_data['w_memNAME'] = $this->session->userdata('w_memNAME');

        $post_data = array();
        $post_data = $this->input->post();

        if (isset($post_data['pjid_uniq']))
        {
            // セッションをフラッシュデータとして保存
            $data = array(
                    'w_pj_id' => $post_data['pjid_uniq'],
            );
            $this->session->set_userdata($data);

            // 「仕事検索」ページへ遷移
            redirect('/search_list/search_favorite/');
            return;
        }

        if (isset($post_data['delid_uniq']))
        {

            $this->load->model('Favorite', 'fav', TRUE);

            $tmp_setdata['fa_wr_id'] = $this->session->userdata('w_memID');
            $tmp_setdata['fa_pj_id'] = $post_data['delid_uniq'];
            $this->fav->delete_favorite($tmp_setdata);

            redirect('/my_favorite/');
            return;
        }

    }

    // Pagination 設定
    private function _get_Pagination($entry_countall, $tmp_per_page)
    {

        $config['base_url']       = base_url() . 'my_favorite/index/';        // ページの基本URIパス。「/コントローラクラス/アクションメソッド/」
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

    // 各項目 初期値セット
    private function _form_item_set00()
    {

        // 会員ランク 項目セット
        $this->config->load('config_comm');
        $arroptions_rank = $this->config->item('MEM_RANK_NAME');

        // 難易度 項目セット
        $arroptions_diff = $this->config->item('TANKA_ADD_NAME');

        $this->smarty->assign('options_rank', $arroptions_rank);
        $this->smarty->assign('options_diff', $arroptions_diff);

    }

    // フォーム・バリデーションチェック
    private function _set_validation()
    {

        $rule_set = array(
        );

        $this->load->library('form_validation', $rule_set);                            // バリデーションクラス読み込み

    }

}
