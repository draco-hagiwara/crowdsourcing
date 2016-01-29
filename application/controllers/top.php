<?php

//class Top extends CI_Controller {
class Top extends MY_Controller
{

    function __construct()
    {
        parent::__construct();

        // セッションチェック
        if ($this->session->userdata('w_login') == TRUE)
        {
            redirect('/writer/top/');
        }

        if (!$this->session->userdata('ticket')) {
            $setData = array('ticket' => md5(uniqid(mt_rand(), true)));
            $this->session->set_userdata($setData);
        }

    }





    public function daily_backup()
    {

    	$time = time();
    	$_st_time = date("Y-m-d H:i:s", $time);

    	// プログラムが古いようだ！
//        // DB ユーティリティクラスをロード
//        $this->load->database();
//        $this->load->dbutil();
//        log_message('info', 'bat::バックアップ処理０１');
//
//        // データベース全体をバックアップしその結果を変数に代入
//        $prefs = array(
//                'tables'      => array('tb_writer', 'tb_writer_info'),      // バックアップするテーブルの配列。
//                'ignore'      => array(),                                   // バックアップしないテーブルのリスト。
//                'format'      => 'gzip',                                    // gzip, zip, txt
//                'filename'    => 'mybackup.sql',                            // ファイル名 - ZIP ファイルのときだけ必要
//                'add_drop'    => TRUE,                                      // バックアップファイルにDROP TABLE 文を追加するかどうか
//                'add_insert'  => TRUE,                                      // バックアップファイルにINSERT 文を追加するかどうか
//                'newline'     => "\n"                                       // バックアップファイルで使う改行文字
//        );
//        $backup =& $this->dbutil->backup();
//        log_message('info', 'bat::バックアップ処理０２');
//
//        // ヘルパーをロードし、サーバにファイルを書き出す
//        $this->load->helper('file');
//        write_file('/home/cs/www/cs.com.dev/daily_backup/mybackup_' . $_st_time . '.gz', $backup, 'c+');
//        log_message('info', 'bat::バックアップ処理０３');
//
//        // ダウンロードヘルパーをロードし、ファイルをデスクトップに送信する
//        $this->load->helper('download');
//        force_download('mybackup.gz', $backup);



    	$strCommand = '/home/cs/www/cs.com.dev/daily_backup/backup4mysql.sh';
    	exec( $strCommand );

    	$strCommand = '/home/cs/www/cs.com.dev/daily_backup/backup4pg.sh';
    	exec( $strCommand );


    	// ログ出力
    	$_ed_time = date("Y-m-d H:i:s", time());
    	log_message('info', 'bat::バックアップ処理が実行されました。' . $_st_time . ' => ' . $_ed_time);

    }







    public function index()
    {

        // 初期値セット
        $this->_form_item_set00();

        // バリデーション・チェック
        $this->_set_validation();                                            // バリデーション設定
        $this->form_validation->run();

        // 案件リストを取得
        $this->load->model('Project', 'pj', TRUE);
        $seach_list = $this->pj->get_seachlist(20);                        // 表示件数=LIMIT値
        $this->smarty->assign('seach_list', $seach_list);

        $this->view('top/index.tpl');

    }

    // ご利用ガイド
    public function guide()
    {

        // バリデーション・チェック
        $this->_set_validation();                                            // バリデーション設定
        $this->form_validation->run();

        $this->view('top/guide.tpl');

    }

    // 会社概要
    public function aboutus()
    {

        // バリデーション・チェック
        $this->_set_validation();                                            // バリデーション設定
        $this->form_validation->run();

        $this->view('top/aboutus.tpl');

    }

    // 個人情報保護方針
    public function privacy()
    {

        // バリデーション・チェック
        $this->_set_validation();                                            // バリデーション設定
        $this->form_validation->run();

        $this->view('top/privacy.tpl');

    }

    // サイトマップ
    public function sitemap()
    {

        // バリデーション・チェック
        $this->_set_validation();                                            // バリデーション設定
        $this->form_validation->run();

        $this->view('top/sitemap.tpl');

    }

    // 項目 初期値セット
    private function _form_item_set00()
    {

        // ジャンル 選択項目セット
        $this->load->model('comm_select', 'select', TRUE);
        $genre_list = $this->select->get_genre();

        $this->smarty->assign('options_genre_list',   $genre_list);

    }

    // フォーム・バリデーションチェック
    private function _set_validation()
    {

        $rule_set = array(
        );

        $this->load->library('form_validation', $rule_set);                        // バリデーションクラス読み込み

    }

}

/* End of file top.php */
/* Location: ./application/controllers/top.php */