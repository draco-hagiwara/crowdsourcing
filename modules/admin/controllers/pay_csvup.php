<?php

class Pay_csvup extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();

            if ($this->session->userdata('a_login') == TRUE)
        {
        	$this->smarty->assign('login_chk', TRUE);
        	$this->smarty->assign('login_name', $this->session->userdata('a_memNAME'));
        	$this->smarty->assign('auth_cd',    $this->session->userdata('a_authCD'));

        	$this->smarty->assign('up_mess01', '');
        	$this->smarty->assign('up_mess02', '');
        	$this->smarty->assign('up_mess03', '');
        	$this->smarty->assign('up_mess04', '');
        } else {
        	$this->smarty->assign('login_chk', FALSE);

        	redirect('/login/');
        }

    }

    // 初期画面TOP
    public function index()
    {

        // セッションデータをクリア
        $this->load->model('comm_auth', 'comm_auth', TRUE);
        $this->comm_auth->delete_session('admin');

        // バリデーション・チェック
        $this->_set_validation();                                            // バリデーション設定
        $this->form_validation->run();

        $this->view('admin/pay_csvup/index.tpl');

    }

    // // CSVデータのチェック:クライアント請求明細アップ
    public function cldetail_chk()
    {

        $tmp_inputpost = $this->input->post();

        $up_errflg = FALSE;
        $up_mess01 = '';

        $this->config->load('config_csv');
        $this->load->library('csvparser');
        $this->load->library('commonvalidator');

        switch ($tmp_inputpost['submit'])
        {
        	case '_cldetail':

        		// CSVファイルのアップロード
        		$this->load->library('upload', $this->config->item('AD_PAY_CLDETAIL'));

        		// CSVファイルの保存
        		if ($this->upload->do_upload('cl_detail'))
        		{
        			$up_mess01 .= ">> CSVファイルのアップロードに成功しました。<br>";
        			$_upload_data = $this->upload->data();
        		} else {
        			$up_mess01 .= ">> CSVファイルのアップロードに失敗しました。<br>";
        			$up_mess01 .= $this->upload->display_errors(' <p style="color:red;">', '</p>');

        			break;
        		}

        		try{
        			// CSVファイルの読み込み
        			$this->csvparser->load($_upload_data['full_path'], TRUE, 1000, ',', '"');
        			$_csv_data = $this->csvparser->parse();
        		} catch (Exception $e){
        			$up_mess03 .= "エラー発生:" . $e->getMessage();
        			break;
        		}

        		// CSVファイルのバリデーションチェック
        		$i = 0;
        		$j = 0;
        		foreach ($_csv_data as $key01 => $val01)
        		{
        			// 0:[案件ID],1:[クライアントID],2:[支払状況],3:[獲得ポイント],4:[調整ポイント],5:[領収(支払)金額],6:[納品日],7:[請求(支払)予定日],8:[領収(支払)日]
        			foreach ($val01 as $key02 => $val02)
        			{
        				 if (($j <= 1) OR ($j == 3) OR ($j == 5))
        				 {
        				 	// 数字型＆文字列の長さチェック
        				 	if ($this->commonvalidator->checkRange($val02, 0, 99999999))
        				 	{
        				 	} else {
        				 		$up_mess01 .= $i + 1 . "行目:「" . $key02 . "」項目で数字または範囲指定エラー。<br>";
        				 		$up_errflg = TRUE;
        				 	}
        				 }

        				 if ($j == 2)
        				 {
        				 	// 数字型＆文字列の長さチェック
       				 		if ($this->commonvalidator->checkRange($val02, 0, 3))
       				 		{
       				 		} else {
       				 			$up_mess01 .= $i + 1 . "行目:「" . $key02 . "」項目で数字または範囲指定(0～3)エラー。<br>";
        				 		$up_errflg = TRUE;
       				 		}
        				 }

        				 if ($j == 4)
        				 {
	        				 // int型文字列チェック
	        				 if ($this->commonvalidator->checkInt($val02))
	        				 {
	        				 	// 文字列の長さチェック
	        				 	if ($this->commonvalidator->checkLength($val02, 0, 9))
	        				 	{
	        				 	} else {
	        				 		$up_mess01 .= $i + 1 . "行目:「" . $key02 . "」項目で文字数エラー。<br>";
        				 			$up_errflg = TRUE;
	        				 	}
	        				 } else {
	        				 	$up_mess01 .= $i + 1 . "行目:「" . $key02 . "」項目でint数字エラー。<br>";
        				 		$up_errflg = TRUE;
	        				 }
        				 }

        				 if (($j == 6) && ($val02 != ''))	// 任意
        				 {
        				 	// 日付時間型チェック
        				 	if ($this->commonvalidator->checkDateFormat($val02, 'Y-m-d H:i:s'))
        				 	{
        				 	} else {
        				 		$up_mess01 .= $i + 1 . "行目:「" . $key02 . "」項目で日付時間エラー。<br>";
        				 		$up_errflg = TRUE;
        				 	}
        				 }

        				 if (($j >= 7) && ($val02 != ''))	// 任意
        				 {
        				 	// 日付型チェック
        				 	if ($this->commonvalidator->checkDateFormat($val02, 'Y-m-d'))
        				 	{
        				 	} else {
        				 		$up_mess01 .= $i + 1 . "行目:「" . $key02 . "」項目で日付エラー。<br>";
        				 		$up_errflg = TRUE;
        				 	}
        				 }
        				 $j++;
        			}
					$i++;
					$j = 0;
        		}

        		if ($up_errflg == TRUE)
        		{
        			$up_mess01 .= ">> CSVファイルのバリデーションチェックに失敗しました。<br>";
        			break;
        		} else {
        			$up_mess01 .= ">> CSVファイルのバリデーションチェックに成功しました。<br>";
        		}

        		// CSVファイルでのUPDATE
        		$this->load->model('Project', 'pj', TRUE);
        		$cnt = 0;
        		foreach ($_csv_data as $key01 => $val01)
        		{

        			// 「案件情報」更新
        			$set_update_data = array();
        			$set_update_data['pj_id']              = $val01['案件ID'];							// 案件ID
        			//$set_update_data['pj_wi_point']      = $val01['獲得ポイント'];					// 獲得ポイント
        			$set_update_data['pj_wi_point_adjust'] = $val01['調整ポイント'];					// 調整ポイント
        			$set_update_data['pj_delivery_date']   = $val01['納品日'];							// 納品日
        			$set_update_data['pj_pay_status']      = $val01['支払状況'];						// 請求状況
        			$set_update_data['pj_pay_money']       = $val01['領収(支払)金額'];					// 請求金額
        			if ($val01['請求(支払)予定日'] != '')
        			{
        				$set_update_data['pj_pay_schedule']    = $val01['請求(支払)予定日'];			// 請求(予定)日
        			}
        			if ($val01['領収(支払)日'] != '')
        			{
        				$set_update_data['pj_pay_date']        = $val01['領収(支払)日'];				// 領収日
        			}
        			$set_update_data['pj_creator_id']      = $this->session->userdata('a_personalID');	// 作成者ID
        			$time = time();
        			$set_update_data['pj_update_date'] = date("Y-m-d H:i:s", $time);                    // 更新日

        			// UPDATE <- 'tb_project'
        			$this->pj->update_pj_posting($set_update_data);

        			$cnt++;
        		}

        		$up_mess01 .= ">> CSVファイルによる更新が完了しました。 " . $cnt . "件<br>";

        		break;

        	default:
        }

        // バリデーション・チェック
        $this->_set_validation();                                            // バリデーション設定
        //$this->form_validation->run();

        $this->smarty->assign('up_mess01', $up_mess01);

        $this->view('admin/pay_csvup/index.tpl');

    }

    // CSVデータのチェック:クライアント月次請求アップ
    public function cllist_chk()
    {

    	$tmp_inputpost = $this->input->post();

    	$up_errflg = FALSE;
    	$up_mess02 = '';

    	$this->config->load('config_csv');
    	$this->load->library('csvparser');
    	$this->load->library('commonvalidator');

    	switch ($tmp_inputpost['submit'])
    	{
    		case '_cllist':

    			// CSVファイルのアップロード
    			$this->load->library('upload', $this->config->item('AD_PAY_CLLIST'));

    			// CSVファイルの保存
    			if ($this->upload->do_upload('cl_list'))
    			{
    				$up_mess02 .= ">> CSVファイルのアップロードに成功しました。<br>";
    				$_upload_data = $this->upload->data();
    			} else {
    				$up_mess02 .= ">> CSVファイルのアップロードに失敗しました。<br>";
    				$up_mess02 .= $this->upload->display_errors(' <p style="color:red;">', '</p>');

    				break;
    			}

    			try{
    				// CSVファイルの読み込み
    				$this->csvparser->load($_upload_data['full_path'], TRUE, 1000, ',', '"');
    				$_csv_data = $this->csvparser->parse();
    			} catch (Exception $e){
    				$up_mess03 .= "エラー発生:" . $e->getMessage();
    				break;
    			}

    			// CSVファイルのバリデーションチェック
    			$i = 0;
    			$j = 0;
    			foreach ($_csv_data as $key01 => $val01)
    			{
    				// 0:[支払情報ID],1:[クライアントID],2:[請求年月],3:[請求状況],4:[請求月額固定],5:[請求ライター発注額],6:[請求成果報酬],7:[請求調整額],8:[請求消費税率],9:[請求消費税額],10:[請求総合計],11:[初期費用],12:[手数料ID],13:[固定手数料],14:[成果手数料],15:[消費税計算],16:[計算方法]
    				foreach ($val01 as $key02 => $val02)
    				{
    					if (($j == 0) && ($val02 != ''))			// 任意:新規は空
    					{
    						// 数字型＆文字列の長さチェック
    						if ($this->commonvalidator->checkRange($val02, 0, 99999999))
    						{
    						} else {
    							$up_mess02 .= $i + 1 . "行目:「" . $key02 . "」項目で数字または範囲指定エラー。<br>";
    							$up_errflg = TRUE;
    						}
    					}

    					if (($j == 1) OR ($j == 4) OR ($j == 5) OR ($j == 6) OR ($j == 9) OR ($j == 10) OR ($j == 11) OR ($j == 13))
    					{
    						// 数字型＆文字列の長さチェック
    						if ($this->commonvalidator->checkRange($val02, 0, 99999999))
    						{
    						} else {
    							$up_mess02 .= $i + 1 . "行目:「" . $key02 . "」項目で数字または範囲指定エラー。<br>";
    							$up_errflg = TRUE;
    						}
    					}

    					if (($j == 3) OR ($j == 12) OR ($j == 15) OR ($j == 16))
    					{
    						// 数字型＆文字列の長さチェック
    						if ($this->commonvalidator->checkRange($val02, 0, 3))
    						{
    						} else {
    							$up_mess02 .= $i + 1 . "行目:「" . $key02 . "」項目で数字または範囲指定エラー。<br>";
    							$up_errflg = TRUE;
    						}
    					}

    					if ($j == 7)
    					{
    						// int型文字列チェック
    						if ($this->commonvalidator->checkInt($val02))
    						{
    							// 文字列の長さチェック
    							if ($this->commonvalidator->checkLength($val02, 0, 9))
    							{
    							} else {
    								$up_mess02 .= $i + 1 . "行目:「" . $key02 . "」項目で文字数エラー。<br>";
    								$up_errflg = TRUE;
    							}
    						} else {
    							$up_mess02 .= $i + 1 . "行目:「" . $key02 . "」項目でint数字エラー。<br>";
    							$up_errflg = TRUE;
    						}
    					}

    					if (($j == 8) OR ($j == 14))
    					{
    						// Decimal型チェック
    						if ($this->commonvalidator->checkDecimal($val02, 2))
    						{
    						} else {
    							$up_mess02 .= $i + 1 . "行目:「" . $key02 . "」項目で小数エラー。<br>";
    							$up_errflg = TRUE;
    						}
    					}

    					if ($j == 2)
    					{
    						// 文字列の長さチェック
    						if ($this->commonvalidator->checkLength($val02, 6, 6))
    						{
    							// 日付型チェック
    							$_val02 = substr($val02, 0, 4) . '-' . substr($val02, 4, 2);
    							if ($this->commonvalidator->checkDateFormat($_val02, 'Y-m'))
    							{
    							} else {
    								$up_mess02 .= $i + 1 . "行目:「" . $key02 . "」項目で日付エラー。<br>";
    								$up_errflg = TRUE;
    							}
    						} else {
    							$up_mess02 .= $i + 1 . "行目:「" . $key02 . "」項目で文字数エラー。<br>";
    							$up_errflg = TRUE;
    						}

    					}
    					$j++;
    				}
    				$i++;
    				$j = 0;
    			}

    			if ($up_errflg == TRUE)
    			{
    				$up_mess02 .= ">> CSVファイルのバリデーションチェックに失敗しました。<br>";
    				break;
    			} else {
    				$up_mess02 .= ">> CSVファイルのバリデーションチェックに成功しました。<br>";
    			}

    			// CSVファイルでのUPDATE
    			$this->load->model('Client',  'cl', TRUE);
    			$cnt = 0;
    			foreach ($_csv_data as $key01 => $val01)
    			{

    				// 「クライアント支払情報」更新
    				$set_update_data = array();
    				$set_update_data['cp_id']               = $val01['支払情報ID'];
    				$set_update_data['cp_cl_id']            = $val01['クライアントID'];
    				$set_update_data['cp_pay_date']         = $val01['請求年月'];
    				$set_update_data['cp_status']           = $val01['請求状況'];
    				$set_update_data['cp_pay_fix']          = $val01['請求月額固定'];
    				$set_update_data['cp_pay_writer']       = $val01['請求ライター発注額'];
    				$set_update_data['cp_pay_result']       = $val01['請求成果報酬'];
    				$set_update_data['cp_pay_adjust']       = $val01['請求調整額'];
    				$set_update_data['cp_pay_taxrate']      = $val01['請求消費税率'];
    				$set_update_data['cp_pay_tax']          = $val01['請求消費税額'];
    				$set_update_data['cp_pay_total']        = $val01['請求総合計'];
    				$set_update_data['cp_contract_initial'] = $val01['初期費用'];
    				$set_update_data['cp_contract_id']      = $val01['手数料ID'];
    				$set_update_data['cp_contract_fix']     = $val01['固定手数料'];
    				$set_update_data['cp_contract_result']  = $val01['成果手数料'];
    				$set_update_data['cp_contract_taxrule'] = $val01['消費税計算'];
    				$set_update_data['cp_contract_calrule'] = $val01['計算方法'];

    				if ($set_update_data['cp_id'] == "")
    				{
    					// INSERT <- 'tb_client_pay'
    					unset($set_update_data['cp_id']);
    					$this->cl->insert_client_pay($set_update_data);
    				} else {
    					// UPDATE <- 'tb_client_pay'
    					$this->cl->update_client_pay($set_update_data);
    				}

    				$cnt++;
    			}

    			$up_mess02 .= ">> CSVファイルによる更新が完了しました。 " . $cnt . "件<br>";

    			break;
    		default:
    	}

    	// バリデーション・チェック
    	$this->_set_validation();                                            // バリデーション設定
    	//$this->form_validation->run();

    	$this->smarty->assign('up_mess02', $up_mess02);

    	$this->view('admin/pay_csvup/index.tpl');

    }

    // CSVデータのチェック:ライター入金明細アップ
    public function wrdetail_chk()
    {

    	$tmp_inputpost = $this->input->post();

    	$up_errflg = FALSE;
    	$up_mess03 = '';

    	$this->config->load('config_csv');
    	$this->load->library('csvparser');
    	$this->load->library('commonvalidator');

    	switch ($tmp_inputpost['submit'])
    	{
    		case '_wrdetail':

				// CSVファイルのアップロード
				$this->load->library('upload', $this->config->item('AD_PAY_WRDETAIL'));

				// CSVファイルの保存
				if ($this->upload->do_upload('wr_detail'))
				{
					$up_mess03 .= ">> CSVファイルのアップロードに成功しました。<br>";
					$_upload_data = $this->upload->data();
				} else {
					$up_mess03 .= ">> CSVファイルのアップロードに失敗しました。<br>";
					$up_mess03 .= $this->upload->display_errors(' <p style="color:red;">', '</p>');

					break;
				}

				try{
					// CSVファイルの読み込み
					$this->csvparser->load($_upload_data['full_path'], TRUE, 1000, ',', '"');
					$_csv_data = $this->csvparser->parse();
				} catch (Exception $e){
					$up_mess03 .= "エラー発生:" . $e->getMessage();
					break;
				}

				// CSVファイルのバリデーションチェック
				$i = 0;
				$j = 0;
				foreach ($_csv_data as $key01 => $val01)
				{
					// 0:[識別ID],1:[ライターID],2:[案件ID],3:[入金状況],4:[獲得ポイント],5:[調整ポイント],6:[入金金額],7:[ポイント獲得日],8:[入金予定日],9:[入金日]
					foreach ($val01 as $key02 => $val02)
					{
						if (($j <= 2) OR ($j == 4) OR ($j == 6))
						{
							// 数字型＆文字列の長さチェック
							if ($this->commonvalidator->checkRange($val02, 0, 99999999))
							{
							} else {
								$up_mess03 .= $i + 1 . "行目:「" . $key02 . "」項目で数字または範囲指定エラー。<br>";
								$up_errflg = TRUE;
							}
						}

						if ($j == 3)
						{
							// 数字型＆文字列の長さチェック
							if ($this->commonvalidator->checkRange($val02, 0, 3))
							{
							} else {
								$up_mess03 .= $i + 1 . "行目:「" . $key02 . "」項目で数字または範囲指定(0～3)エラー。<br>";
								$up_errflg = TRUE;
							}
						}

						if ($j == 5)
						{
							// int型文字列チェック
							if ($this->commonvalidator->checkInt($val02))
							{
								// 文字列の長さチェック
								if ($this->commonvalidator->checkLength($val02, 0, 9))
								{
								} else {
									$up_mess03 .= $i + 1 . "行目:「" . $key02 . "」項目で文字数エラー。<br>";
									$up_errflg = TRUE;
								}
							} else {
								$up_mess03 .= $i + 1 . "行目:「" . $key02 . "」項目でint数字エラー。<br>";
								$up_errflg = TRUE;
							}
						}

						if (($j == 7) && ($val02 != ''))	// 任意
						{
							// 日付時間型チェック
							if ($this->commonvalidator->checkDateFormat($val02, 'Y-m-d H:i:s'))
							{
							} else {
								$up_mess03 .= $i + 1 . "行目:「" . $key02 . "」項目で日付時間エラー。<br>";
								$up_errflg = TRUE;
							}
						}

						if (($j >= 8) && ($val02 != ''))	// 任意
						{
							// 日付型チェック
							if ($this->commonvalidator->checkDateFormat($val02, 'Y-m-d'))
							{
							} else {
								$up_mess03 .= $i + 1 . "行目:「" . $key02 . "」項目で日付エラー。<br>";
								$up_errflg = TRUE;
							}
						}
						$j++;
					}
					$i++;
					$j = 0;
				}

				if ($up_errflg == TRUE)
				{
					$up_mess03 .= ">> CSVファイルのバリデーションチェックに失敗しました。<br>";
					break;
				} else {
					$up_mess03 .= ">> CSVファイルのバリデーションチェックに成功しました。<br>";
				}

				// CSVファイルでのUPDATE
				$this->load->model('Writer_info', 'wrinfo', TRUE);
				$cnt = 0;
				foreach ($_csv_data as $key01 => $val01)
				{

					// 「ライター個別情報」更新
					$set_update_data = array();
					$set_update_data['wi_id']           = $val01['識別ID'];
					$set_update_data['wi_pay_status']   = $val01['入金状況'];
					$set_update_data['wi_point_adjust'] = $val01['調整ポイント'];
					$set_update_data['wi_pay_money']    = $val01['入金金額'];
					if ($val01['入金予定日'] != '')
					{
						$set_update_data['wi_pay_schedule']    = $val01['入金予定日'];
					}
					if ($val01['入金日'] != '')
					{
						$set_update_data['wi_pay_date']        = $val01['入金日'];
					}
					$time = time();
					$set_update_data['wi_update_date'] = date("Y-m-d H:i:s", $time);

					// UPDATE <- 'tb_writer_info'
					$this->wrinfo->update_wi_pay($set_update_data);

					$cnt++;
				}

				$up_mess03 .= ">> CSVファイルによる更新が完了しました。 " . $cnt . "件<br>";

				break;

			default:
		}

    	// バリデーション・チェック
    	$this->_set_validation();                                            // バリデーション設定
    	//$this->form_validation->run();

    	$this->smarty->assign('up_mess03', $up_mess03);

    	$this->view('admin/pay_csvup/index.tpl');

    }

    // CSVデータのチェック:ライター締日入金アップ
    public function wrlist_chk()
    {

    	$tmp_inputpost = $this->input->post();

    	$up_errflg = FALSE;
    	$up_mess04 = '';

    	$this->config->load('config_csv');
    	$this->load->library('csvparser');
    	$this->load->library('commonvalidator');

    	switch ($tmp_inputpost['submit'])
    	{
    		case '_wrlist':

    			// CSVファイルのアップロード
    			$this->load->library('upload', $this->config->item('AD_PAY_WRLIST'));

    			// CSVファイルの保存
    			if ($this->upload->do_upload('wr_list'))
    			{
    				$up_mess04 .= ">> CSVファイルのアップロードに成功しました。<br>";
    				$_upload_data = $this->upload->data();
    			} else {
    				$up_mess04 .= '<p style="color:red;">>> CSVファイルのアップロードに失敗しました。</p>';
    				$up_mess04 .= $this->upload->display_errors(' <p style="color:red;">', '</p>');

    				break;
    			}

    			try{
    				// CSVファイルの読み込み
    				$this->csvparser->load($_upload_data['full_path'], TRUE, 1000, ',', '"');
    				$_csv_data = $this->csvparser->parse();
    			} catch (Exception $e){
    				$up_mess04 .= '<p style="color:red;">エラー発生:' . $e->getMessage() . '</p>';
    				break;
    			}

    			// CSVファイルのバリデーションチェック
    			$i = 0;
    			$j = 0;
    			foreach ($_csv_data as $key01 => $val01)
    			{
    				// 0:[支払情報ID],1:[ライターID],2:[入金年月日],3:[入金状況],4:[報酬金額],5:[調整金額],6:[入金金額],7:[銀行CD],8:[口座番号]
    				foreach ($val01 as $key02 => $val02)
    				{
    					if (($j == 0) && ($val02 != ''))			// 任意:新規は空
    					{
    						// 数字型＆文字列の長さチェック
    						if ($this->commonvalidator->checkRange($val02, 0, 99999999))
    						{
    						} else {
    							$up_mess04 .= $i + 1 . "行目:「" . $key02 . "」項目で数字または範囲指定エラー。<br>";
    							$up_errflg = TRUE;
    						}
    					}

    					if (($j == 1) OR ($j == 4) OR ($j == 6))
    					{
    						// 数字型＆文字列の長さチェック
    						if ($this->commonvalidator->checkRange($val02, 0, 99999999))
    						{
    						} else {
    							$up_mess04 .= $i + 1 . "行目:「" . $key02 . "」項目で数字または範囲指定エラー。<br>";
    							$up_errflg = TRUE;
    						}
    					}

    					if ($j == 3)
    					{
    						// 数字型＆文字列の長さチェック
    						if ($this->commonvalidator->checkRange($val02, 0, 3))
    						{
    						} else {
    							$up_mess04 .= $i + 1 . "行目:「" . $key02 . "」項目で数字または範囲指定エラー。<br>";
    							$up_errflg = TRUE;
    						}
    					}

    					if ($j == 5)
    					{
    						// int型文字列チェック
    						if ($this->commonvalidator->checkInt($val02))
    						{
    							// 文字列の長さチェック
    							if ($this->commonvalidator->checkLength($val02, 0, 9))
    							{
    							} else {
    								$up_mess04 .= $i + 1 . "行目:「" . $key02 . "」項目で文字数エラー。<br>";
    								$up_errflg = TRUE;
    							}
    						} else {
    							$up_mess04 .= $i + 1 . "行目:「" . $key02 . "」項目でint数字エラー。<br>";
    							$up_errflg = TRUE;
    						}
    					}

    					if ((($j == 6) OR ($j == 7)) && ($val02 != ''))
    					{
    						// int型文字列チェック
    						if ($this->commonvalidator->checkDigit($val02))
    						{
    						} else {
    							$up_mess04 .= $i + 1 . "行目:「" . $key02 . "」項目で数字エラー。<br>";
    							$up_errflg = TRUE;
    						}
    					}

    					if ($j == 2)
    					{
    						// 文字列の長さチェック
    						if ($this->commonvalidator->checkLength($val02, 8, 8))
    						{
    							// 日付型チェック
    							$_val02 = substr($val02, 0, 4) . '-' . substr($val02, 4, 2) . '-' . substr($val02, 6, 2);
    							if ($this->commonvalidator->checkDateFormat($_val02, 'Y-m-d'))
    							{
    							} else {
    								$up_mess04 .= $i + 1 . "行目:「" . $key02 . "」項目で日付エラー。<br>";
    								$up_errflg = TRUE;
    							}
    						} else {
    							$up_mess04 .= $i + 1 . "行目:「" . $key02 . "」項目で文字数エラー。<br>";
    							$up_errflg = TRUE;
    						}

    					}
    					$j++;
    				}
    				$i++;
    				$j = 0;
    			}

    			if ($up_errflg == TRUE)
    			{
    				$up_mess04 .= '<p style="color:red;">>> CSVファイルのバリデーションチェックに失敗しました。</p>';
    				break;
    			} else {
    				$up_mess04 .= ">> CSVファイルのバリデーションチェックに成功しました。<br>";
    			}

    			// CSVファイルでのUPDATE
    			$this->load->model('Writer', 'wr', TRUE);
    			$cnt = 0;
    			foreach ($_csv_data as $key01 => $val01)
    			{

    				// 「ライター入金情報」更新
    				$set_update_data = array();
    				$set_update_data['wp_id']         = $val01['支払情報ID'];
    				$set_update_data['wp_wr_id']      = $val01['ライターID'];
    				$set_update_data['wp_pay_date']   = $val01['入金年月日'];
    				$set_update_data['wp_status']     = $val01['入金状況'];
    				$set_update_data['wp_pay_result'] = $val01['報酬金額'];
    				$set_update_data['wp_pay_adjust'] = $val01['調整金額'];
    				$set_update_data['wp_pay_total']  = $val01['入金金額'];
    				$set_update_data['wp_bank_cd']    = $val01['銀行CD'];
    				$set_update_data['wp_bk_no']      = $val01['口座番号'];

    				if ($set_update_data['wp_id'] == "")
    				{
    					// INSERT <- 'tb_writer_pay'
    					unset($set_update_data['wp_id']);
    					$this->wr->insert_writer_pay($set_update_data);
    				} else {
    					// UPDATE <- 'tb_writer_pay'
    					$this->wr->update_writer_pay($set_update_data);
    				}

    				$cnt++;
    			}

    			$up_mess04 .= ">> CSVファイルによる更新が完了しました。 " . $cnt . "件<br>";

    			break;
    		default:
    	}

    	// バリデーション・チェック
    	$this->_set_validation();                                            // バリデーション設定
    	//$this->form_validation->run();

    	$this->smarty->assign('up_mess04', $up_mess04);

    	$this->view('admin/pay_csvup/index.tpl');

    }

    // フォーム・バリデーションチェック
    private function _set_validation()
    {

    	$rule_set = array(
    			array(
    					'field'   => 'user_csv',
    					'label'   => 'CSVファイル名',
    					'rules'   => 'trim|max_length[100]'
    			),
    	);

    	$this->load->library('form_validation', $rule_set);                            // バリデーションクラス読み込み

    }

}
