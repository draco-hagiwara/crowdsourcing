<?php

class My_byebye extends MY_Controller
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
    }

    // 会員登録解除(退会)画面表示
    public function index()
    {

        // セッションデータをクリア
        $this->load->model('comm_auth', 'comm_auth', TRUE);
        $this->comm_auth->delete_session('writer');

        // セッションからフラッシュデータ読み込み
        $tmp_writerid = $this->session->userdata('w_memID');

        // バリデーション・チェック
        $this->_set_validation();                                            // バリデーション設定

        // 検索項目 初期値セット
        $this->_search_set();

        // ライター情報の読み込み
        $this->load->model('writer', 'wr', TRUE);
        $get_data = $this->wr->select_writer_id($tmp_writerid);

        $this->smarty->assign('writer_info', $get_data[0]);

        $this->view('writer/my_byebye/index.tpl');

    }

    // 完了画面表示
    public function complete()
    {

        $this->load->model('writer', 'wr', TRUE);

        // セッションからフラッシュデータ読み込み
        $tmp_writerid = $this->session->userdata('w_memID');

        // 検索項目 初期値セット
        //$this->_search_set();

        // バリデーション・チェック
        //$this->_set_validation();

        // 「退会」ステータスID を取得
        $this->config->load('config_status');

        $set_data['wr_id']     = $tmp_writerid;
        $set_data['wr_status'] = $this->config->item('WRITER_TAIKAI_ID');

        // UPDATE
        $result = $this->wr->update_Writer($set_data);

        // SESSION クリア
        $this->load->model('comm_auth', 'auth', TRUE);
        $this->auth->logout('writer');

        // LOGOUT処理 => TOPへリダイレクト
        $this->load->helper('url');
        redirect(base_url());

    }

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

        $this->smarty->assign('options_wr_status01',   $arroptions_wrstatus01);
        $this->smarty->assign('options_wr_status02',   $arroptions_wrstatus02);
        $this->smarty->assign('options_wr_mm_rank_id', $arroptions_mrank);

    }

    // フォーム・バリデーションチェック
    private function _set_validation()
    {

        $rule_set = array(
        );

        $this->load->library('form_validation', $rule_set);                            // バリデーションクラス読み込み

    }

}
