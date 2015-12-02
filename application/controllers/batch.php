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
	 *  バッチのメイン処理
	 */
	public function test()
	{

		echo 'Hello from CLI!';

		// バッチのメイン処理
		log_message('info', 'バッチが実行されました。');
		exit;
	}

	/**
	 *  エントリー作業のタイムオーバー処理
	 */
	public function entry_timeover()
	{
		// バッチのメイン処理
		log_message('info', 'エントリー作業のタイムオーバー処理が実行されました。');

		// タイムオーバーのライター検索
		$this->load->model('Writer_info', 'wrinfo', TRUE);
		$get_timeover_list = $this->wrinfo->get_cron_timeover();

		if (count($get_timeover_list) > 0)
		{
			foreach ($get_timeover_list as $key1 => $val1)
			{


				print($key);
				print("<br>");
				print_r($val);

				exit;


				//foreach ($val1 as $key2 => $val2)
				//{

					// ライター個別情報は「エントリー無」「ライターキャンセル」
					$set_wdata['wi_wr_id'] = $flash_data['w_memID'];									// ライターID
					$set_wdata['wi_pj_id'] = $flash_data['w_pj_id'];									// 案件ID
					$set_wdata['wi_pj_entry_status'] = $this->config->item('PJ_ESTATUS_NOENTRY_ID');	// 「エントリー無」
					$set_wdata['wi_pj_work_status']  = $this->config->item('PJ_WSTATUS_CANCEL_ID');		// 「ライターキャンセル」
					$set_wdata['wi_update_date'] = date("Y-m-d H:i", $time);							// 更新日

					// 案件情報は「(再)公開」「エントリー無」「投稿なし」
					$set_pdata['pj_id'] = $flash_data['w_pj_id'];										// 案件ID
					$set_pdata['pj_status'] = $this->config->item('PJ_STATUS_REOPEN_ID');				// 「(再)公開」
					$set_pdata['pj_entry_status'] = $this->config->item('PJ_ESTATUS_NOENTRY_ID');		// 「エントリー無」
					$set_pdata['pj_work_status']  = $this->config->item('PJ_WSTATUS_ENTRY_ID');			// 「投稿なし」
					$set_pdata['pj_wr_id'] = NULL;														// ライターID:int
					$set_pdata['pj_wi_id'] = NULL;														// ライター個別情報ID:int
					$set_pdata['pj_update_date'] = date("Y-m-d H:i", $time);							// 更新日

					// 投稿記事個別情報は「チェックフラグ」「タイトル」「本文」クリア
					$set_edata['rep_pji_pj_id'] = $flash_data['w_pj_id'];								// 案件ID
					$set_edata['rep_check_flg'] = FALSE;												// チェックフラグ
					$set_edata['rep_title'] = NULL;														// タイトル
					$set_edata['rep_title_wordcount'] = 0;												// タイトル文字数:int
					$set_edata['rep_text_body'] = NULL;													// 本文
					$set_edata['rep_body_wordcount'] = 0;												// 本文文字数:int

					// トランザクション・START
					$this->db->trans_strict(FALSE);										// StrictモードをOFF
					$this->db->trans_start();											// trans_begin

						// UPDATE:ライター個別情報
						$this->wrinfo->update_entryinfo($set_wdata);

						// UPDATE:案件情報
						$this->pj->update_project($set_pdata);

						// UPDATE:投稿記事個別情報
						$get_infodata = $this->pj->get_entry_info($flash_data['w_pj_id']);
						$tmp_arr_cnt  = count($get_infodata);											// 作業件数有無チェック(作業1～3)

						for ($rep_seq = 0; $rep_seq < $tmp_arr_cnt; $rep_seq++)
						{
							$this->rep->update_entryinfo($set_edata, $set_edata['rep_pji_pj_id'], $rep_seq);
						}

					// トランザクション・COMMIT
					$this->db->trans_complete();										// trans_rollback & trans_commit
					if ($this->db->trans_status() === FALSE)
					{
						log_message('error', 'WRITER::[data_post()]ライター：エントリーキャンセル処理 トランザクションエラー');
					} else {
						$this->session->set_userdata('w_memENTRY', FALSE);				// ENTRY無をセッションデータに書き込み

						// エントリーキャンセル確認メールを送信
						$this->_mail_send02($post_data['pj_title'], $set_wdata, $flash_data);
					}

				//






			}


		}











	}

	/**
	 *  公開タイムオーバー処理
	 */
	public function opening_timeover()
	{
		// バッチのメイン処理
		log_message('info', '公開タイムオーバー処理が実行されました。');












	}





}