<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Writer_info extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }


	/**
	 * エントリー有無のチェック
	 *
	 * @param	int
	 * @return	boolen
	 */
	public function check_entry($wr_id)
    {

		$sql = 'SELECT * FROM `tb_writer_info` '
					. 'WHERE `wi_wr_id` = ? '
					. ' AND  `wi_pj_entry_status` = ? ';

		$values = array(
				$wr_id,
				1,
		);

		$query = $this->db->query($sql, $values);

		// チェック
		if ($query->num_rows() >= 1) {
			return TRUE;
		} else {
			return FALSE;
		}

    }

    /**
     * エントリーリスト＆件数を取得
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
    	$set_select_like["pj_id"]        = $arr_post['pj_id'];
    	$set_select["wi_pj_work_status"] = $arr_post['wi_pj_work_status'];

    	// ORDER BY
    	//if ($arr_post['orderid'] == '')
    	//{
    		//	$set_orderby["pj_pe_cl_id"] = '';
    		//}else {
    		//	$set_orderby["pj_pe_cl_id"] = $arr_post['orderid'];
    		//}
    		//
    		//if ($arr_post['orderstatus'] == '')
    		//{
    			//	$set_orderby["pj_status"] = '';
    			//}else {
    			//	$set_orderby["pj_status"] = $arr_post['orderstatus'];
    			//}

    			// 対象クライアントメンバーの取得
    			$order_list = $this->select_entrylist($set_select, $set_select_like, $tmp_per_page, $tmp_offset);
    			//$order_list = $this->select_orderlist($set_select, $set_select_like, $set_orderby, $tmp_per_page, $tmp_offset);

    			return $order_list;

    }

    /**
     * エントリーリスト＆件数を取得
     *
     * @param	array() : WHERE句項目
     * @param	array() : WHERE LIKE句項目
     * @param	array() : ORDER BY句項目
     * @param	int     : 1ページ当たりの表示件数
     * @param	int     : オフセット値(ページ番号)
     * @return	array()
     */
    //public function select_orderlist($set_select, $set_select_like, $set_orderby, $tmp_per_page, $tmp_offset=0)
    public function select_entrylist($set_select, $set_select_like, $tmp_per_page, $tmp_offset=0)
    {

    	$sql  = 'SELECT * FROM `vw_my_entrylist` ';
    	$sql .= ' WHERE `wi_del_flg` = 0';											// 削除フラグ

    	// WHERE文 作成
    	foreach ($set_select as $key => $val)
    	{
    		if (isset($val) && $val != '')
    		{
    			//if ($key == 'pj_genre01')
    			//{
    			//	if (intval($set_select["pj_genre01"]) > 1) 						// ジャンル："1"は選択文字
    			//	{
    			//		$sql .= ' AND `pj_genre01` = ' . $set_select["pj_genre01"];
    			//	}
    			//} else {
    				$sql .= ' AND ' . $key . ' = ' . $this->db->escape($val);
    			//}
    		}
    	}

    	// WHERE-LIKE文 作成
    	$tmp_firstitem = FALSE;
    	foreach ($set_select_like as $key => $val)
    	{
    		if (isset($val) && $val != '')
    		{
    			if ($tmp_firstitem == FALSE)
    			{
    				$sql .= ' AND (' . $key . ' LIKE \'%' . $this->db->escape_like_str($val) . '%\'';
    				$tmp_firstitem = TRUE;
    			} else {
    				$sql .= ' OR  ' . $key . ' LIKE \'%' . $this->db->escape_like_str($val) . '%\'';
    			}
    		}
    	}
    	if ($tmp_firstitem == TRUE)
    	{
    		$sql .= ')';
    	}

    	// ORDER BY文 作成 : ORDERBY の優先順位があるので注意 (ステータス > 案件申請ID)
    	$tmp_firstitem = FALSE;
    	//foreach ($set_orderby as $key => $val)
    	//{
    	//	if (isset($val) && $val != '')
    	//	{
    	//		if ($tmp_firstitem == FALSE)
    	//		{
    	//			$sql .= ' ORDER BY ' . $key . ' ' . $val;
    		//			$tmp_firstitem = TRUE;
    		//		} else {
    		//			$sql .= ' , ' . $key . ' ' . $val;
    		//		}
    		//	}
    		//}
    		if ($tmp_firstitem == FALSE)
    		{
    			$sql .= ' ORDER BY wi_id DESC';										// デフォルト：「案件ID」降順
    		}

    		// 対象全件数を取得
    		$query = $this->db->query($sql);
    		$countall = $query->num_rows();

    		// LIMIT ＆ OFFSET 値をセット
    		$sql .= ' LIMIT ' . $tmp_per_page . ' OFFSET ' . $tmp_offset;

    		// クエリー実行
    		$query = $this->db->query($sql);
    		$listall = $query->result('array');

    		return array($listall, $countall);

    	}

    /**
     * ライター個別情報：新規レード作成
     *
     * @param	array()
     * @return	int
     */
    public function insert_writer_info($values)
    {

    	// INSERT
    	$result = $this->db->insert('tb_writer_info', $values);

    	// 「ライター個別ID['wi_id']」を取得
    	$sql = 'SELECT LAST_INSERT_ID()';
    	$query = $this->db->query($sql);
    	$get_wi_id = $query->result('array');

    	// 追加された「ライター個別ID」を返す
    	return $get_wi_id;

    }

    /**
     * 1レコード更新
     *
     * @param	array()
     * @param	int
     * @param	boolean
     * @return	boolean
     */
    public function update_entryinfo($set_data)
    {

    	$where = array(
    			'wi_wr_id' => $set_data['wi_wr_id'],
    			'wi_pj_id' => $set_data['wi_pj_id'],
    	);

    	$result = $this->db->update('tb_writer_info', $set_data, $where);
    	return $result;
    }

    /**
     * 1レコード更新 :: 投稿記事 <= 審査OK
     *
     * @param	array()
     * @return	bool
     */
    public function update_wi_posting($set_data)
    {

    	$where = array(
    			'wi_wr_id' => $set_data['wi_wr_id'],
    			'wi_pj_id' => $set_data['wi_pj_id'],
    	);

    	$result = $this->db->update('tb_writer_info', $set_data, $where);
    	return $result;
    }

    /**
     * 案件ID・チェック
     *
     * @param	varchar
     * @return	array
     */
    public function exist_pjid($pj_id)
    {
    	$where = array(
    			'wi_pj_id' => $pj_id,
    	);
    	$query = $this->db->get_where('tb_writer_info', $where);

    	if ($query->num_rows() == 0) {
    		return FALSE;
    	} else {
    		$result = $query->result('array');
    		return $result;
    	}
    }

    /**
     * タイムオーバーのライター検索
     *
     * @param	varchar
     * @return	array
     */
    public function get_cron_timeover()
    {

    	$sql = 'SELECT * FROM vw_entry_timeover';

    	// クエリー実行
    	$query = $this->db->query($sql);
    	$get_timeover = $query->result('array');

    	return $get_timeover;

    }
}
