<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Project_entry extends CI_Model
{

    //public function __construct()
    //{
    //    parent::__construct();
    //}


	/**
	 * 案件申請情報の取得
	 *
	 * @param	int
	 * @return	array()
	 */
	public function get_entry($get_pe_id)
	{

		$set_where["pe_id"] = $get_pe_id;

		$query = $this->db->get_where('tb_project_entry', $set_where);

		$get_data = $query->result('array');

		return $get_data;

	}

	/**
	 * 案件申請個別情報の取得
	 *
	 * @param	int
	 * @param	int
	 * @param	tinyint
	 * @return	array()
	 */
	public function get_entry_info($get_pe_id, $pei_seq = NULL, $pei_status = NULL)
	{

		$set_where["pei_pe_id"]      = $get_pe_id;
		if ($pei_seq != NULL)
		{
			$set_where["pei_seq"]    = $pei_seq;
		}
		if ($pei_status != NULL)
		{
			$set_where["pei_status"] = 1;
		}

		$query = $this->db->get_where('tb_project_entry_info', $set_where);

		$get_data = $query->result('array');

		return $get_data;

	}

	/**
	 * メール送信先クライアントの会社名＆メールアドレスを取得
	 *
	 * @param	int
	 * @return	array()
	 */
	public function get_client_name($get_pe_id)
	{

		$sql = 'SELECT pe.pe_entry_title, cl.cl_company, cl.cl_person01, cl.cl_person02, cl.cl_email';
		$sql .= ' FROM tb_project_entry AS pe JOIN tb_client AS cl ON pe.pe_cl_id = cl.cl_id';
		$sql .= ' WHERE pe_id = ' . $get_pe_id;

		// クエリー実行
		$query = $this->db->query($sql);
		$get_client_info = $query->result('array');

		return $get_client_info;

	}

	/**
	 * 案件申請情報のリスト＆件数を取得
	 *
	 * @param	array() : 検索項目値
	 * @param	int     : 1ページ当たりの表示件数(LIMIT値)
	 * @param	int     : オフセット値(ページ番号)
	 * @return	array()
	 */
	public function get_entrylist($arr_post, $tmp_per_page, $tmp_offset=0)
	{

		// 各SQL項目へセット
		// WHERE
		$set_select_like["pe_entry_title"] = $arr_post['pe_entry_title'];
		$set_select_like["pe_id"]          = $arr_post['pe_id'];
		$set_select_like["pe_cl_id"]       = $arr_post['pe_cl_id'];
		$set_select["pe_genre01"]          = $arr_post['pe_genre01'];
		$set_select["pe_status"]           = $arr_post['pe_status'];
		//$set_select['pe_cl_id']   = $this->session->userdata('memberID');				// セッションデータからクライアントID

		// ORDER BY
		$set_orderby["pe_status"] = $arr_post['orderstatus'];
		if ($arr_post['orderid'] == '')
		{
			$set_orderby["pe_id"] = '';
		}else {
			$set_orderby["pe_id"] = $arr_post['orderid'];
		}

		// 対象クライアントメンバーの取得
		$entry_list = $this->select_entrylist($set_select, $set_select_like, $set_orderby, $tmp_per_page, $tmp_offset);

		return $entry_list;

	}

    /**
     * 対象案件申請情報のリスト＆件数を取得
     *
     * @param	array() : WHERE句項目
     * @param	array() : WHERE LIKE句項目
     * @param	array() : ORDER BY句項目
     * @param	int     : 1ページ当たりの表示件数
     * @param	int     : オフセット値(ページ番号)
     * @return	array()
     */
    public function select_entrylist($set_select, $set_select_like, $set_orderby, $tmp_per_page, $tmp_offset=0)
    {

    	$sql  = 'SELECT * FROM `tb_project_entry` ';
    	//$sql .= ' WHERE `pe_cl_id` = ' . $this->session->userdata('a_memID');	// セッションデータからクライアントID
    	$sql .= ' WHERE `pe_del_flg` = 0';										// 削除フラグ
    	$sql .= ' AND `pe_status` != 0';										// ステータス：「準備中」
    	$sql .= ' AND `pe_status` != 2';										// ステータス：「承認」
    	$sql .= ' AND `pe_status` != 4';										// ステータス：「取消」
    	$sql .= ' AND `pe_status` != 5';										// ステータス：「削除」
    	if ($set_select["pe_status"] != '') 									// ステータス
    	{
    		$sql .= ' AND `pe_status`  = ' . $set_select["pe_status"];
    	}
    	if ($set_select["pe_genre01"] > '1') 									// ジャンル："1"は選択文字
    	{
    		$sql .= ' AND `pe_genre01` = ' . $set_select["pe_genre01"];
    	}

    	// WHERE文 作成
    	//$tmp_firstitem = FALSE;
    	foreach ($set_select_like as $key => $val)
    	{
	    	if (isset($val) && $val != '')
	    	{
	    		//if ($tmp_firstitem == FALSE)
	    		//{
	    		//	$sql .= ' WHERE ' . $key . ' LIKE \'%' . $this->db->escape_like_str($val) . '%\'';
	    		//	$tmp_firstitem = TRUE;
	    		//} else {
	    			$sql .= ' AND ' . $key . ' LIKE \'%' . $this->db->escape_like_str($val) . '%\'';
	    		//}
	    	}
    	}

    	// ORDER BY文 作成 : ORDERBY の優先順位があるので注意 (ステータス > 案件申請ID)
    	$tmp_firstitem = FALSE;
    	foreach ($set_orderby as $key => $val)
    	{
    		if (isset($val) && $val != '')
    		{
    			if ($tmp_firstitem == FALSE)
    			{
    				$sql .= ' ORDER BY ' . $key . ' ' . $val;
    				$tmp_firstitem = TRUE;
    			} else {
    				$sql .= ' , ' . $key . ' ' . $val;
    			}
    		}
    	}
    	if ($tmp_firstitem == FALSE)
    	{
    		$sql .= ' ORDER BY pe_id DESC';									// デフォルト：「申請id」降順
    		//$sql .= ' ORDER BY pe_entry_date DESC';						// デフォルト：「申請日」降順
    	}

    	// 対象全件数を取得
    	$query = $this->db->query($sql);
    	$entry_countall = $query->num_rows();

    	// LIMIT ＆ OFFSET 値をセット
    	$sql .= ' LIMIT ' . $tmp_per_page . ' OFFSET ' . $tmp_offset;

    	// クエリー実行
    	$query = $this->db->query($sql);
    	$entry_list = $query->result('array');

		return array($entry_list, $entry_countall);
    }

    /**
     * 新規 案件申請 登録 => 追加された「案件申請ID」を返す
     *
     * @param	array
     * @return	int
     */
    public function insert_pro_entry($setData)
    {

    	// データ追加
    	$setData = $this->db->escape($setData);

    	$this->db->insert('tb_project_entry', $setData);

    	// 「案件申請ID['pe_id']」を取得
    	$sql = 'SELECT LAST_INSERT_ID()';
    	$query = $this->db->query($sql);
    	$get_pe_id = $query->result('array');

    	// 追加された「案件申請ID」を返す
    	return $get_pe_id;

    }

    /**
     * 新規 個別案件申請 登録
     *
     * @param	int
     * @return	boolen
     */
    public function insert_pro_entryinfo($setData)
    {

    	// データ追加
    	$result = $this->db->insert('tb_project_entry_info', $setData);

    	return $result;

    }

    /**
     * 1レコード更新 :: 案件内容
     *
     * @param	array()
     * @return	bool
     */
    public function update_pro_entry($set_data)
    {

    	// 更新日時をセット
    	$time = time();
    	$set_data['pe_update_date'] = date("Y-m-d H:i:s", $time);

    	$where = array(
    			'pe_id' => $set_data['pe_id']
    	);

    	$result = $this->db->update('tb_project_entry', $set_data, $where);
    	return $result;
    }

    /**
     * 1レコード更新 :: 個別案件申請 1～3
     *
     * @param	int
     * @param	array()
     * @return	bool
     */
    public function update_pro_entryinfo($entry_no, $set_data)
    {

    	// 「pei_seq」チェック
    	if ($entry_no == '01')
    	{
    		$set_data['pei_seq'] = 0;
    	} elseif ($entry_no == '02')
    	{
    		$set_data['pei_seq'] = 1;
    	} elseif ($entry_no == '03')
    	{
    		$set_data['pei_seq'] = 2;
		//} else {
		}

		$where = array(
				'pei_pe_id'    => $set_data['pei_pe_id'],
				'pei_pe_cl_id' => $set_data['pei_pe_cl_id'],
				'pei_seq'      => $set_data['pei_seq'],
		);

    	// 対象レコードの存在チェック (ON DUPLICATE KEY)
    	$query = $this->db->get_where('tb_project_entry_info', $where);

    	if ($query->num_rows() == 0) {

    		// INSERT
    		$set_data['pei_status']   = 1;

    		$result = $this->db->insert('tb_project_entry_info', $set_data);

    	} else {

    		// UPDATE

    		// 更新日時をセット
    		$time = time();
    		$set_data['pei_update_date'] = date("Y-m-d H:i:s", $time);

    		$result = $this->db->update('tb_project_entry_info', $set_data, $where);
    	}

    	return $result;
    }


    /**
     * 案件情報レコード「tb_project」：新規作成
     *
     * @param	int
     * @return	bool
     */
    public function create_project($get_pe_id)
    {

    	// 案件申請情報の取得
    	$get_data = $this->get_entry($get_pe_id);

    	// デフォルト設定の読み込み
    	$this->config->load('config_status');
    	$tmp_status       = $this->config->item('PJ_STATUS_JYUNBI_ID');
    	$tmp_entry_status = $this->config->item('PJ_ESTATUS_NOENTRY_ID');
    	$tmp_work_status = $this->config->item('PJ_WSTATUS_ENTRY_ID');

    	$this->config->load('config_comm');
    	$tmp_mm_rank_id   = $this->config->item('RANK_BRONZE_ID');
    	$tmp_diff_id      = $this->config->item('ADDTANKA_FUTUU_ID');
    	$tmp_posting_time = $this->config->item('POSTING_LIMIT_TIME');

		$values = array();
    	$values = array(
    			'pj_status'            => $tmp_status,						// ステータス：0=>準備中
    			'pj_entry_status'      => $tmp_entry_status,				// エントリーステータス：0=>エントリーなし
    			'pj_work_status'       => $tmp_work_status,					// ライター作業ステータス：0=>投稿なし
    			'pj_mm_rank_id'        => $tmp_mm_rank_id,					// 会員ランク指定：1=>ブロンズ
    			'pj_taa_difficulty_id' => $tmp_diff_id,						// 難易度(単価加算)指定：1=>ふつう
    			'pj_limit_time'        => $tmp_posting_time,				// ライター投稿制限時間
    			'pj_order_title'       => $get_data[0]['pe_entry_title'],
    			'pj_genre01'           => $get_data[0]['pe_genre01'],
    			'pj_title'             => $get_data[0]['pe_title'],
    			'pj_work'              => $get_data[0]['pe_work'],
    			'pj_notice'            => $get_data[0]['pe_notice'],
    			'pj_example'           => $get_data[0]['pe_example'],
    			'pj_other'             => $get_data[0]['pe_other'],
    			'pj_addwork'           => $get_data[0]['pe_addwork'],
    			'pj_word_tanka'        => $get_data[0]['pe_word_tanka'],
    			'pj_start_time'        => $get_data[0]['pe_open_date'],
    			'pj_end_time'          => $get_data[0]['pe_delivery_date'],
    			'pj_delivery_time'     => $get_data[0]['pe_delivery_date'],
    			'pj_pe_id'             => $get_data[0]['pe_id'],
    			'pj_pe_cl_id'          => $get_data[0]['pe_cl_id'],
    			'pj_pe_entry_date'     => $get_data[0]['pe_entry_date'],
    			'pj_pe_delivery_date'  => $get_data[0]['pe_delivery_date'],
    	);

    	$this->load->model('Project', 'pj', TRUE);
    	$get_pj_id = $this->pj->insert_project($values);

    	return $get_pj_id;

    }


    /**
     * 案件個別情報レコード「tb_project_info」：新規作成
     *
     * @param	int
     * @return	bool
     */
    public function create_project_info($get_pe_id, $get_pj_id)
    {

    	$this->load->model('Project', 'pj', TRUE);

    	// 案件申請情報1～3の取得
    	$get_data = $this->get_entry_info($get_pe_id, NULL, TRUE);

    	// デフォルト設定の読み込み
    	$this->config->load('config_status');
    	$tmp_status       = $this->config->item('PJI_STATUS_CREATE_ID');

    	// 案件個別情報 ＆ 投稿記事個別情報 の作成
    	$cnt = 0;
    	for ($num = 0; $num <= 2; $num++)
    	{
    		if (!empty($get_data[$num]))
    		{
	    		$values = array();
	    		$values = array(
	    				'pji_pj_id'   => $get_pj_id,
	    				'pji_seq'     => $cnt,
	    				'pji_status'  => $tmp_status,						// 原稿作成中
	    				'pji_work'    => $get_data[$num]['pei_work'],
	    				'pji_notice'  => $get_data[$num]['pei_notice'],
	    				'pji_example' => $get_data[$num]['pei_example'],
	    				'pji_other'   => $get_data[$num]['pei_other'],
	    				'pji_addwork' => $get_data[$num]['pei_addwork'],
	    		);




	    		//print("create_project_info --><br>");
	    		//print_r($values);
	    		//exit;




	    		// INSERT : 案件個別情報
	    		$get_pji_id = $this->pj->insert_project_info($values);
	    		$tmp_pji_id = $get_pji_id[0]['LAST_INSERT_ID()'];


	    		$values = array();
	    		$values = array(
	    				'rep_pji_id'    => $tmp_pji_id,
	    				'rep_pji_pj_id' => $get_pj_id,
	    				'rep_pji_seq'   => $cnt,
	    		);
	    		foreach ($get_data[$num] as $key => $val)
	    		{
	    			if (!empty($get_data[$num][$key]))
	    			{
	    				$pre_key = str_replace("pei_", "rep_", $key);			// $prefix::「rep_」に置き換え

	    				//print($pre_key);
	    				//print("<br>");
	    				//print($val);
	    				//print("<br>");

	    				$values[$pre_key] = $val;

	    				//print_r($values);
	    				//print("<br>");


	    			}
	    		}


	    		unset($values["rep_id"]);
	    		unset($values["rep_pe_id"]);
	    		unset($values["rep_pe_cl_id"]);
	    		unset($values["rep_seq"]);
	    		unset($values["rep_status"]);
	    		unset($values["rep_work"]);
	    		unset($values["rep_notice"]);
	    		unset($values["rep_example"]);
	    		unset($values["rep_other"]);
	    		unset($values["rep_addwork"]);
	    		unset($values["rep_create_date"]);
	    		unset($values["rep_update_date"]);

	    		//print("<br><br>create_project_info --><br>");
	    		//print_r($values);
	    		//exit;




	    		// INSERT : 投稿記事個別情報
	    		$get_rep_id = $this->pj->insert_report_info($values);

	    		$cnt++;
    		}
    	}

    	return array($get_pji_id, $get_rep_id);
    }

}
