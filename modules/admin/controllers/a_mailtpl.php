<?php

class Writerlist extends MY_Controller
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
            $this->smarty->assign('login_name', '');

            redirect('/login/');
        }

    }

    // ライターTOP
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
        //$this->load->helper('url');
        $segments = $this->uri->segment_array();
        if (isset($segments[3]))
        {
            $tmp_offset = $segments[3];
        } else {
            $tmp_offset = 0;
        }

        // ライターの取得
        $this->load->model('Writer', 'wr', TRUE);
        list($writer_list, $writer_countall) = $this->wr->get_writerlist($this->input->post(), $tmp_per_page, $tmp_offset);
        $this->smarty->assign('writer_list', $writer_list);

        // Pagination 設定
        $set_pagination = $this->_get_Pagination($writer_countall, $tmp_per_page);

        $this->smarty->assign('set_pagination', $set_pagination['page_link']);
        $this->smarty->assign('countall', $writer_countall);

        $this->view('admin/writerlist/index.tpl');

    }

    // 一覧表示
    public function search()
    {

        // 検索項目の保存が上手くいかない。応急的に対応！
        if ($this->input->post('submit') == '_submit')
        {
            // セッションをフラッシュデータとして保存
            $data = array(
                    'a_wr_nickname' => $this->input->post('wr_nickname'),
                    'a_wr_id'       => $this->input->post('wr_id'),
                    'a_wr_email'    => $this->input->post('wr_email'),
                    'a_wr_status'   => $this->input->post('wr_status'),
                    'a_orderid'     => $this->input->post('orderid'),
                    'a_orderstatus' => $this->input->post('orderstatus'),
            );
            $this->session->set_userdata($data);

            $tmp_inputpost = $this->input->post();
            unset($tmp_inputpost["submit"]);

        } else {
            // セッションからフラッシュデータ読み込み
            $tmp_inputpost['wr_nickname'] = $this->session->userdata('a_wr_nickname');
            $tmp_inputpost['wr_id']       = $this->session->userdata('a_wr_id');
            $tmp_inputpost['wr_email']    = $this->session->userdata('a_wr_email');
            $tmp_inputpost['wr_status']   = $this->session->userdata('a_wr_status');
            $tmp_inputpost['orderid']     = $this->session->userdata('a_orderid');
            $tmp_inputpost['orderstatus'] = $this->session->userdata('a_orderstatus');

            //$this->session->set_userdata($tmp_inputpost);
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

        // ライターメンバーの取得
        $this->load->model('Writer', 'wr', TRUE);
        list($writer_list, $writer_countall) = $this->wr->get_writerlist($tmp_inputpost, $tmp_per_page, $tmp_offset);
        $this->smarty->assign('writer_list', $writer_list);

        // 検索項目 初期値セット
        $this->_search_set();

        // Pagination 設定
        $set_pagination = $this->_get_Pagination($writer_countall, $tmp_per_page);

        $this->smarty->assign('set_pagination', $set_pagination['page_link']);
        $this->smarty->assign('countall', $writer_countall);

        $this->view('admin/writerlist/index.tpl');

    }

    // ライター情報編集
    public function detail()
    {

        $this->load->library('form_validation');                            // バリデーションクラス読み込み

        // ライターステータス設定  <-- 検索項目 初期値セット
        $this->_search_set();

        // 更新対象ライターのデータ取得
        // 初期表示はバリデーションチェックを回避 <- チェックは要らない！
        $input_post = $this->input->post();
        $this->load->model('writer', 'wr', TRUE);
        if (isset($input_post['wrid_uniq']))
        {

            $tmp_writerid = $input_post['wrid_uniq'];
            $get_data = $this->wr->select_writer_id($tmp_writerid);

            $this->smarty->assign('writer_info', $get_data[0]);

            // 都道府県情報設定
            $this->config->load('config_pref');                                    // 都道府県情報読み込み
            $this->_options_pref = $this->config->item('pref');
            $this->_pref_name    = $this->_options_pref[$get_data[0]['wr_pref']];
            $this->smarty->assign('pref_name', $this->_pref_name);

            // メルマガ配信チェックボックスのチェック
            if ($get_data[0]['wr_mailmaga_flg'])
            {
                $this->smarty->assign('mailmaga_flg', TRUE);
            } else {
                $this->smarty->assign('mailmaga_flg', FALSE);
            }

        } else {

            $set_data['wr_status']         = $this->input->post('wr_status');
            $set_data['wr_id']             = $this->input->post('wr_id');
            $set_data['wr_mm_rank_id']     = $this->input->post('wr_mm_rank_id');
            $set_data['wr_pay_limit_date'] = $this->input->post('wr_pay_limit_date');

            if ($this->wr->update_Writer($set_data))
            {
            } else {
                echo "会員更新に失敗しました。";
            }

            // 検索一覧へ
            //$this->load->helper('url');
            redirect('/writerlist/');

        }

        $this->view('admin/writerlist/detail.tpl');

    }

    // Pagination 設定
    private function _get_Pagination($writer_countall, $tmp_per_page)
    {

        $config['base_url']       = base_url() . '/writerlist/search/';        // ページの基本URIパス。「/コントローラクラス/アクションメソッド/」
        $config['per_page']       = $tmp_per_page;                            // 1ページ当たりの表示件数。
        $config['total_rows']     = $writer_countall;                        // 総件数。where指定するか？
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
        $arroptions_wrstatus01 = array (
                ''  => '選択してください',
                '1' => $this->config->item('WRITER_KARISHINSEI'),
                '2' => $this->config->item('WRITER_SHINSEITYU'),
                '3' => $this->config->item('WRITER_KARITOUROKU'),
                '4' => $this->config->item('WRITER_TOUROKU'),
                '7' => $this->config->item('WRITER_ITIJITEISHI'),
                '8' => $this->config->item('WRITER_TEISHI'),
                '9' => $this->config->item('WRITER_TAIKAI'),
        );

        $arroptions_wrstatus02 = array (
                '1' => $this->config->item('WRITER_KARISHINSEI'),
                '2' => $this->config->item('WRITER_SHINSEITYU'),
                '3' => $this->config->item('WRITER_KARITOUROKU'),
                '4' => $this->config->item('WRITER_TOUROKU'),
                '7' => $this->config->item('WRITER_ITIJITEISHI'),
                '8' => $this->config->item('WRITER_TEISHI'),
                '9' => $this->config->item('WRITER_TAIKAI'),
        );

        // 会員ランク 選択項目セット
        $this->config->load('config_comm');
        $arroptions_mrank = array (
                //'0' => $this->config->item('RANK_GUEST'),
                '1' => $this->config->item('RANK_BRONZE'),
                '2' => $this->config->item('RANK_SILVER'),
                '3' => $this->config->item('RANK_GOLD'),
                //'4' => $this->config->item('RANK_PLATINUM'),
                //'5' => $this->config->item('RANK_PREMIERE'),
        );

        // ライターID 並び替え選択項目セット
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

        $arroptions_paylimit = array (
        		'0' => '日　次',
        		'1' => '週　次',
        		'2' => '月　次',
        		'3' => '曜　日',
        		'4' => '10日〆',
        );

        $this->smarty->assign('options_wr_status01',   $arroptions_wrstatus01);
        $this->smarty->assign('options_wr_status02',   $arroptions_wrstatus02);
        $this->smarty->assign('options_wr_mm_rank_id', $arroptions_mrank);
        $this->smarty->assign('options_orderid',       $arroptions_id);
        $this->smarty->assign('options_orderstatus',   $arroptions_status);
        $this->smarty->assign('options_paylimit',      $arroptions_paylimit);

    }

    // フォーム・バリデーションチェック
    private function _set_validation()
    {

        $rule_set = array(
                array(
                        'field'   => 'wr_nickname',
                        'label'   => 'ニックネーム',
                        'rules'   => 'trim|max_length[50]'
                ),
                array(
                        'field'   => 'wr_id',
                        'label'   => 'ライターID',
                        'rules'   => 'trim|numeric'
                ),
                array(
                        'field'   => 'wr_email',
                        'label'   => 'メールアドレス',
                        'rules'   => 'trim|max_length[50]'
                ),
                array(
                        'field'   => 'wr_status',
                        'label'   => 'ステータス',
                        'rules'   => 'trim|numeric'
                ),
        );

        $this->load->library('form_validation', $rule_set);                            // バリデーションクラス読み込み

    }

    // フォーム・バリデーションチェック :: ライター更新フォーム
    private function _set_validation01()
    {

        $rule_set = array(
                array(
                        'field'   => 'wr_name01',
                        'label'   => '姓',
                        'rules'   => 'trim|required|max_length[50]'
                ),
                array(
                        'field'   => 'wr_name02',
                        'label'   => '名',
                        'rules'   => 'trim|required|max_length[50]'
                ),
                array(
                        'field'   => 'wr_namekana01',
                        'label'   => 'セイ（全角カタカナ）',
                        'rules'   => 'trim|required|max_length[50]'
                ),
                array(
                        'field'   => 'wr_namekana02',
                        'label'   => 'メイ（全角カタカナ）',
                        'rules'   => 'trim|required|max_length[50]'
                ),
                array(
                        'field'   => 'wr_nickname',
                        'label'   => 'ニックネーム',
                        'rules'   => 'trim|required|max_length[50]'
                ),
                array(
                        'field'   => 'wr_zip01',
                        'label'   => '郵便番号（3ケタ）',
                        'rules'   => 'trim|required|max_length[3]|is_numeric'
                ),
                array(
                        'field'   => 'wr_zip02',
                        'label'   => '郵便番号（4ケタ）',
                        'rules'   => 'trim|required|max_length[4]|is_numeric'
                ),
                array(
                        'field'   => 'wr_pref',
                        'label'   => '都道府県',
                        'rules'   => 'trim|required|max_length[2]'
                ),
                array(
                        'field'   => 'wr_addr01',
                        'label'   => '市区町村',
                        'rules'   => 'trim|required|max_length[100]'
                ),
                array(
                        'field'   => 'wr_addr02',
                        'label'   => '町名・番地',
                        'rules'   => 'trim|required|max_length[100]'
                ),
                array(
                        'field'   => 'wr_buil',
                        'label'   => 'ビル・マンション名など',
                        'rules'   => 'trim|max_length[100]'
                ),
                array(
                        'field'   => 'wr_email',
                        'label'   => 'メールアドレス',
                        'rules'   => 'trim|required|valid_email'
                ),
                array(
                        'field'   => 'wr_email_mobile',
                        'label'   => '携帯メールアドレス',
                        'rules'   => 'trim|valid_email'
                ),
                array(
                        'field'   => 'wr_tel',
                        'label'   => '電話番号',
                        'rules'   => 'trim|required|regex_match[/^[0-9\-]+$/]|max_length[15]'
                ),
                array(
                        'field'   => 'wr_mobile',
                        'label'   => '携帯番号',
                        'rules'   => 'trim|regex_match[/^[0-9\-]+$/]|max_length[15]'
                ),
                array(
                        'field'   => 'wr_mobile',
                        'label'   => '携帯番号',
                        'rules'   => 'trim|regex_match[/^[0-9\-]+$/]|max_length[15]'
                ),
                array(
                        'field'   => 'wr_mailmaga_flg[]',
                        'label'   => 'メルマガ配信希望',
                        'rules'   => ''
                ),
                array(
                        'field'   => 'wr_password',
                        'label'   => 'パスワード',
                        'rules'   => 'trim|regex_match[/^[\x21-\x7e]+$/]|min_length[8]|max_length[50]|matches[retype_password]'
                ),
                array(
                        'field'   => 'retype_password',
                        'label'   => 'パスワード再入力',
                        'rules'   => 'trim|regex_match[/^[\x21-\x7e]+$/]|min_length[8]|max_length[50]|matches[wr_password]'
                )
        );

        $this->load->library('form_validation', $rule_set);                            // バリデーションクラス読み込み

    }

}
