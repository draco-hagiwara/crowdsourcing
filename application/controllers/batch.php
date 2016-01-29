<?php

class Batch extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();

        // CLI実行かのチェック
        if (!$this->input->is_cli_request()) {
            log_message('error', 'CLI以外からのアクセスがありました。');
            exit;
        }
    }

    /**
     *  「分」間隔バッチのメイン処理
     */
    public function minute_bat()
    {

        // エントリー(制作)作業のタイムオーバー処理
        $this->_entry_timeover();

        // 公開案件のタイムオーバー処理
        $this->_opening_timeover();

        // 予約公開処理
        $this->_reserve_unlock();

        // 気になるリスト削除処理
        $this->_favorite_del();

    }

    /**
     *  「時::夜間(02:10)」バッチのメイン処理
     */
    public function hour_bat()
    {
    	$_st_day = date("Y-m-d H:i:s", $time);

    	// DB & PG のバックアップ処理
    	$this->_system_backup();

    	$_ed_day = date("Y-m-d H:i:s", time());
    	log_message('info', 'bat::** 夜間バッチ **' . $_cnt . '件 ' . $_st_day . ' => ' . $_ed_day);
    }

    /**
     *  「日」間隔バッチのメイン処理
     */
    public function day_bat()
    {

    }





    /**
     *  エントリー(制作)作業のタイムオーバー処理
     */
    public function _entry_timeover()
    {

        // タイムオーバーのライター検索
        $this->load->model('Writer_info', 'wrinfo', TRUE);
        $get_timeover_list = $this->wrinfo->get_cron_timeover();
        $_cnt = count($get_timeover_list);

        $time = time();
        $_set_time = date("Y-m-d H:i:s", $time);

        if ( $_cnt > 0)
        {

            $this->load->model('Project',     'pj',  TRUE);
            $this->load->model('Report_info', 'rep', TRUE);
            $this->config->load('config_status');

            // トランザクション・START
            $this->db->trans_strict(FALSE);                                        // StrictモードをOFF
            $this->db->trans_start();                                              // trans_begin

            foreach ($get_timeover_list as $key => $val)
            {

                // ライター個別情報は「エントリー無」「投稿なし(時間オーバー)」
                $set_wdata['wi_wr_id'] = $val['wi_wr_id'];                                              // ライターID
                $set_wdata['wi_pj_id'] = $val['wi_pj_id'];                                              // 案件ID
                $set_wdata['wi_pj_entry_status'] = $this->config->item('PJ_ESTATUS_NOENTRY_ID');        // 「エントリー無」
                $set_wdata['wi_pj_work_status']  = $this->config->item('PJ_WSTATUS_TIMEOVER_ID');       // 「投稿なし(時間オーバー)」
                $set_wdata['wi_update_date'] = date("Y-m-d H:i", $time);                                // 更新日

                // 案件情報は「(再)公開」「エントリー無」「投稿なし」
                $set_pdata['pj_id'] = $val['wi_pj_id'];                                                 // 案件ID
                $set_pdata['pj_status'] = $this->config->item('PJ_STATUS_REOPEN_ID');                   // 「(再)公開」
                $set_pdata['pj_entry_status'] = $this->config->item('PJ_ESTATUS_NOENTRY_ID');           // 「エントリー無」
                $set_pdata['pj_work_status']  = $this->config->item('PJ_WSTATUS_ENTRY_ID');             // 「投稿なし」
                $set_pdata['pj_wr_id'] = NULL;                                                          // ライターID:int
                $set_pdata['pj_wi_id'] = NULL;                                                          // ライター個別情報ID:int
                $set_pdata['pj_update_date'] = date("Y-m-d H:i", $time);                                // 更新日

                // 投稿記事個別情報は「チェックフラグ」「タイトル」「本文」クリア
                $set_rdata['rep_pji_pj_id'] = $val['wi_pj_id'];                                         // 案件ID
                $set_rdata['rep_check_flg'] = FALSE;                                                    // チェックフラグ
                $set_rdata['rep_title'] = NULL;                                                         // タイトル
                $set_rdata['rep_title_wordcount'] = 0;                                                  // タイトル文字数:int
                $set_rdata['rep_text_body'] = NULL;                                                     // 本文
                $set_rdata['rep_body_wordcount'] = 0;                                                   // 本文文字数:int

                // UPDATE:ライター個別情報
                $this->wrinfo->update_entryinfo($set_wdata);

                // UPDATE:案件情報
                $this->pj->update_project($set_pdata);

                // UPDATE:投稿記事個別情報
                $get_infodata = $this->pj->get_entry_info($val['wi_pj_id']);
                $tmp_arr_cnt  = count($get_infodata);                                            // 作業件数有無チェック(作業1～

                for ($rep_seq = 0; $rep_seq < $tmp_arr_cnt; $rep_seq++)
                {
                    $this->rep->update_entryinfo($set_rdata, $val['wi_pj_id'], $rep_seq);
                }

            }

            // トランザクション・COMMIT
            $this->db->trans_complete();                                        // trans_rollback & trans_commit
            if ($this->db->trans_status() === FALSE)
            {
                log_message('error', 'bat::[entry_timeover]タイムオーバー処理 トランザクションエラー');
                return;
            }

        }

        // ログ出力
        $_ed_time = date("Y-m-d H:i:s", time());
        log_message('info', 'bat::エントリー作業タイムオーバー処理が実行されました。' . $_cnt . '件 ' . $_set_time . ' => ' . $_ed_time);

    }

    /**
     *  公開案件のタイムオーバー処理
     */
    public function _opening_timeover()
    {

    	// タイムオーバーのプロジェクト検索
        $time = time();
        $_set_time = date("Y-m-d H:i:s", $time);

        // 予約公開の案件検索
        $this->load->model('Project', 'pj', TRUE);
        $get_openinglist = $this->pj->get_cron_openinglist($_set_time);
        $_cnt = count($get_openinglist);

    	if ( $_cnt > 0)
    	{

    		$this->load->model('Project',     'pj',  TRUE);
    		$this->load->model('Report_info', 'rep', TRUE);
    		$this->config->load('config_status');

    		// トランザクション・START
    		$this->db->trans_strict(FALSE);                                        // StrictモードをOFF
    		$this->db->trans_start();                                              // trans_begin

    		foreach ($get_openinglist as $key => $val)
    		{

    			// 案件情報は「6：公開終了」「0：エントリーなし」「6：投稿なし」
    			$set_pdata['pj_id'] = $val['pj_id'];                                                    // 案件ID
    			$set_pdata['pj_status'] = $this->config->item('PJ_STATUS_END_ID');                      // 「公開終了」
    			$set_pdata['pj_entry_status'] = $this->config->item('PJ_ESTATUS_NOENTRY_ID');           // 「エントリー無」
    			$set_pdata['pj_work_status']  = $this->config->item('PJ_WSTATUS_ENTRY_ID');             // 「投稿なし」
    			$set_pdata['pj_wr_id'] = NULL;                                                          // ライターID:int
    			$set_pdata['pj_wi_id'] = NULL;                                                          // ライター個別情報ID:int
    			$set_pdata['pj_update_date'] = date("Y-m-d H:i", $time);                                // 更新日

    			// 投稿記事個別情報は「チェックフラグ」「タイトル」「本文」クリア
    			$set_rdata['rep_pji_pj_id'] = $val['pj_id'];                                            // 案件ID
    			$set_rdata['rep_check_flg'] = FALSE;                                                    // チェックフラグ
    			$set_rdata['rep_title'] = NULL;                                                         // タイトル
    			$set_rdata['rep_title_wordcount'] = 0;                                                  // タイトル文字数:int
    			$set_rdata['rep_text_body'] = NULL;                                                     // 本文
    			$set_rdata['rep_body_wordcount'] = 0;                                                   // 本文文字数:int

    			// UPDATE:案件情報
    			$this->pj->update_project($set_pdata);

    			// UPDATE:投稿記事個別情報
    			$get_infodata = $this->pj->get_entry_info($val['pj_id']);
    			$tmp_arr_cnt  = count($get_infodata);                                            // 作業件数有無チェック(作業1～

    			for ($rep_seq = 0; $rep_seq < $tmp_arr_cnt; $rep_seq++)
    			{
    				$this->rep->update_entryinfo($set_rdata, $val['pj_id'], $rep_seq);
    			}

    		}

    		// トランザクション・COMMIT
    		$this->db->trans_complete();                                        // trans_rollback & trans_commit
    		if ($this->db->trans_status() === FALSE)
    		{
    			log_message('error', 'bat::[opening_timeover]公開案件タイムオーバー処理 トランザクションエラー');
    			return;
    		}

    	}

    	// ログ出力
    	$_ed_time = date("Y-m-d H:i:s", time());
    	log_message('info', 'bat::公開案件タイムオーバー処理が実行されました。' . $_cnt . '件 ' . $_set_time . ' => ' . $_ed_time);

    }

    /**
     *  予約公開処理
     */
    public function _reserve_unlock()
    {

        $time = time();
        $_set_time = date("Y-m-d H:i:s", $time);

        // 予約公開の案件検索
        $this->load->model('Project', 'pj', TRUE);
        $get_reservelist = $this->pj->get_cron_reservelist($_set_time);
        $_cnt = count($get_reservelist);

        // 「エントリーステータス」を書き換え (2 -> 1)
        if ( $_cnt > 0)
        {

        	foreach ($get_reservelist as $key => $val)
        	{

                $set_pdata['pj_id']           = $val['pj_id'];                                          // 案件ID
                $set_pdata['pj_entry_status'] = 0;                                                      // エントリーステータス
                $set_pdata['pj_update_date']  = $_set_time;                                              // 更新日

                // UPDATE:案件情報
                $this->pj->update_project($set_pdata);

        	}
        }

        // ログ出力
        $_ed_time = date("Y-m-d H:i:s", time());
        log_message('info', 'bat::予約公開処理が実行されました。' . $_cnt . '件 ' . $_set_time . ' => ' . $_ed_time);

    }

    /**
     *  気になるリスト削除処理
     */
    public function _favorite_del()
    {

    	$time = time();
    	$_set_time = date("Y-m-d H:i:s", $time);

        // 気になるリスト検索
        $this->load->model('Favorite', 'favo', TRUE);
        $get_favorite_list = $this->favo->get_cron_favolist($_set_time);
        $_cnt = count($get_favorite_list);

        if ( $_cnt > 0)
        {

        	foreach ($get_favorite_list as $key => $val)
        	{

        		$set_pdata['fa_wr_id']       = $val['fa_wr_id'];                                        // fa_wr_id
        		$set_pdata['fa_pj_id']       = $val['fa_pj_id'];                                        // 案件ID
        		$set_pdata['fa_update_date'] = $_set_time;                                               // 更新日

        		// DELETE:気になるリスト
        		$this->favo->delete_favorite($set_pdata);

        	}
        }

        // ログ出力
        $_ed_time = date("Y-m-d H:i:s", time());
        log_message('info', 'bat::気になるリスト削除処理が実行されました。' . $_cnt . '件 ' . $_set_time . ' => ' . $_ed_time);

    }








    /**
     *  DB & PG のシステムバックアップ処理
     */
    public function _system_backup()
    {

    	$time = time();
    	$_set_time = date("Y-m-d H:i:s", $time);

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
//        write_file('/home/cs/www/cs.com.dev/daily_backup/mybackup_' . $_set_time . '.gz', $backup, 'c+');
//        log_message('info', 'bat::バックアップ処理０３');
//
//        // ダウンロードヘルパーをロードし、ファイルをデスクトップに送信する
//        $this->load->helper('download');
//        force_download('mybackup.gz', $backup);


		// sh に記述
    	$strCommand = '/home/cs/www/cs.com.dev/daily_backup/backup4mysql.sh';
    	exec( $strCommand );

    	$strCommand = '/home/cs/www/cs.com.dev/daily_backup/backup4pg.sh';
    	exec( $strCommand );


    	// ログ出力
    	$_ed_time = date("Y-m-d H:i:s", time());
    	log_message('info', 'bat::バックアップ処理が実行されました。' . $_set_time . ' => ' . $_ed_time);

    }

}