<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Project extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }


    /**
     * 案件情報の取得
     *
     * @param	int
     * @return	array()
     */
    public function get_order($get_pj_id)
    {

    	$set_where["pj_id"] = $get_pj_id;

    	$query = $this->db->get_where('tb_project', $set_where);

    	$get_data = $query->result('array');

    	return $get_data;

    }

    /**
     * 案件情報の取得
     *
     * @param	int
     * @param	int
     * @param	tinyint
     * @return	array()
     */
    public function get_order_info($get_pj_id, $pji_seq = NULL, $pji_status = NULL)
    {

    	$set_where["pji_pj_id"]      = $get_pj_id;
    	if ($pji_seq != NULL)
    	{
    		$set_where["pji_seq"]    = $pji_seq;
    	}
    	if ($pji_status != NULL)
    	{
    		$set_where["pji_status"] = 1;
    	}

    	// view から取得
    	$query = $this->db->get_where('vw_orderlist', $set_where);

    	$get_data = $query->result('array');

    	return $get_data;

    }



    /**
     * 案件情報のリスト＆件数を取得
     *
     * @param	array() : 検索項目値
     * @param	int     : 1ページ当たりの表示件数(LIMIT値)
     * @param	int     : オフセット値(ページ番号)
     * @return	array()
     */
    public function get_orderlist($arr_post, $tmp_per_page, $tmp_offset=0)
    {

    	// 各SQL項目へセット
    	// WHERE
    	$set_select_like["pj_id"]          = $arr_post['pj_id'];
    	$set_select_like["pj_pe_id"]       = $arr_post['pj_pe_id'];
    	$set_select_like["pj_pe_cl_id"]    = $arr_post['pj_pe_cl_id'];
    	$set_select_like["pj_order_title"] = $arr_post['pj_order_title'];
    	$set_select["pj_genre01"]          = $arr_post['pj_genre01'];


    	// ORDER BY
        if ($arr_post['orderpjid'] == 'ASC')
    	{
    		$set_orderby["pj_id"] = $arr_post['orderpjid'];
    	}else {
    		$set_orderby["pj_id"] = 'DESC';
    	}

    	if ($arr_post['orderpeid'] == 'ASC')
    	{
    		$set_orderby["pj_pe_id"] = $arr_post['orderpeid'];
    	}else {
    		$set_orderby["pj_pe_id"] = 'DESC';
    	}

    	// 対象クライアントメンバーの取得
    	$entry_list = $this->select_orderlist($set_select, $set_select_like, $set_orderby, $tmp_per_page, $tmp_offset);

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
    public function select_orderlist($set_select, $set_select_like, $set_orderby, $tmp_per_page, $tmp_offset=0)
    {

    	$sql  = 'SELECT * FROM `tb_project` ';
    	$sql .= ' WHERE `pj_del_flg` = 0';										// 削除フラグ
    	$sql .= ' AND `pj_status` = 0 OR `pj_status` = 8';						// ステータス：「準備中」「保留」
    	if ($set_select["pj_genre01"] > '1') 									// ジャンル："1"は選択文字
    	{
    		$sql .= ' AND `pj_genre01` = ' . $set_select["pj_genre01"];
    	}

    	// WHERE文 作成
    	foreach ($set_select_like as $key => $val)
    	{
    		if (isset($val))
    		{
    			$sql .= ' AND ' . $key . ' LIKE \'%' . $this->db->escape_like_str($val) . '%\'';
    		}
    	}

    	// ORDER BY文 作成 : ORDERBY の優先順位があるので注意 (ステータス > 案件申請ID)
    	$tmp_firstitem = FALSE;
    	foreach ($set_orderby as $key => $val)
    	{
    		if (isset($val))
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
    	$sql .= ' , pj_pe_entry_date DESC';									// デフォルト：「申請日」降順

    	// 対象全件数を取得
    	$query = $this->db->query($sql);
    	$order_countall = $query->num_rows();

    	// LIMIT ＆ OFFSET 値をセット
    	$sql .= ' LIMIT ' . $tmp_per_page . ' OFFSET ' . $tmp_offset;

    	// クエリー実行
    	$query = $this->db->query($sql);
    	$order_list = $query->result('array');

    	return array($order_list, $order_countall);
    }



	/**
	 * 案件情報：新規レード作成
	 *
	 * @param	array()
	 * @return	int
	 */
	public function insert_project($values)
    {

    	// INSERT
		$result = $this->db->insert('tb_project', $values);

		// 「案件ID['pj_id']」を取得
		$sql = 'SELECT LAST_INSERT_ID()';
		$query = $this->db->query($sql);
		$get_pj_id = $query->result('array');

		// 追加された「案件ID」を返す
		return $get_pj_id;

    }

    /**
     * 案件個別情報：新規レード作成
     *
     * @param	int
     * @return	int
     */
    public function insert_project_info($values)
    {

    	// INSERT
    	$result = $this->db->insert('tb_project_info', $values);

    	// 「案件個別ID['pji_id']」を取得
    	$sql = 'SELECT LAST_INSERT_ID()';
    	$query = $this->db->query($sql);
    	$get_pji_id = $query->result('array');

    	// 追加された「案件ID」を返す
    	return $get_pji_id;

    }

    /**
     * 投稿記事個別情報：新規レード作成
     *
     * @param	int
     * @return	int
     */
    public function insert_report_info($values)
    {

    	// INSERT
    	$result = $this->db->insert('tb_report_info', $values);

    	// 「投稿記事個別ID['rep_id']」を取得
    	$sql = 'SELECT LAST_INSERT_ID()';
    	$query = $this->db->query($sql);
    	$get_rep_id = $query->result('array');

    	// 追加された「案件ID」を返す
    	return $get_rep_id;

    }



    /**
     * 1レコード更新 :: 案件内容
     *
     * @param	array()
     * @return	bool
     */
    public function update_project($set_data)
    {

    	$time = time();

    	// 公開設置日時をチェック
    	if ($set_data['pj_status'] == '1')
    	{
    		$set_data['pj_open_date'] = date("Y-m-d H:i:s", $time);
    	}

    	// 更新日時をセット
    	$set_data['pj_update_date'] = date("Y-m-d H:i:s", $time);

    	$where = array(
    			'pj_id' => $set_data['pj_id']
    	);

    	$result = $this->db->update('tb_project', $set_data, $where);
    	return $result;
    }




}
