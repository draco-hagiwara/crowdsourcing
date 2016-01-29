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
     * @param    int
     * @return    boolen
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
     * @param    array() : 検索項目値
     * @param    int     : 1ページ当たりの表示件数(LIMIT値)
     * @param    int     : オフセット値(ページ番号)
     * @return    array()
     */
    public function get_entry($arr_post, $tmp_per_page, $tmp_offset=0)
    {

        // 各SQL項目へセット
        // WHERE
        $set_select["wi_wr_id"]          = $arr_post['wi_wr_id'];
        $set_select["wi_pj_work_status"] = $arr_post['wi_pj_work_status'];
        $set_select_like["pj_id"]        = $arr_post['pj_id'];

        // ORDER BY
        //if ($arr_post['orderid'] == '')
        //{
            //    $set_orderby["pj_en_cl_id"] = '';
            //}else {
            //    $set_orderby["pj_en_cl_id"] = $arr_post['orderid'];
            //}
            //
            //if ($arr_post['orderstatus'] == '')
            //{
            //    $set_orderby["pj_status"] = '';
            //}else {
            //    $set_orderby["pj_status"] = $arr_post['orderstatus'];
            //}
        //}

        // 対象クライアントメンバーの取得
        $entry_list = $this->select_entry($set_select, $set_select_like, $tmp_per_page, $tmp_offset);
        //$order_list = $this->select_orderlist($set_select, $set_select_like, $set_orderby, $tmp_per_page, $tmp_offset);

        return $entry_list;

    }

    /**
     * エントリーリスト＆件数を取得
     *
     * @param    array() : WHERE句項目
     * @param    array() : WHERE LIKE句項目
     * @param    array() : ORDER BY句項目
     * @param    int     : 1ページ当たりの表示件数
     * @param    int     : オフセット値(ページ番号)
     * @return    array()
     */
    //public function select_orderlist($set_select, $set_select_like, $set_orderby, $tmp_per_page, $tmp_offset=0)
    public function select_entry($set_select, $set_select_like, $tmp_per_page, $tmp_offset=0)
    {

        $sql  = 'SELECT * FROM `vw_my_entrylist` ';
        $sql .= ' WHERE `wi_del_flg` = 0';                                            // 削除フラグ

        // WHERE文 作成
        foreach ($set_select as $key => $val)
        {
            if (isset($val) && $val != '')
            {
                //if ($key == 'pj_genre01')
                //{
                //    if (intval($set_select["pj_genre01"]) > 1)                         // ジャンル："1"は選択文字
                //    {
                //        $sql .= ' AND `pj_genre01` = ' . $set_select["pj_genre01"];
                //    }
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
        //    if (isset($val) && $val != '')
        //    {
        //        if ($tmp_firstitem == FALSE)
        //        {
        //            $sql .= ' ORDER BY ' . $key . ' ' . $val;
        //            $tmp_firstitem = TRUE;
        //        } else {
        //            $sql .= ' , ' . $key . ' ' . $val;
        //        }
        //    }
        //}
        if ($tmp_firstitem == FALSE)
        {
            $sql .= ' ORDER BY wi_id DESC';                                        // デフォルト：「案件ID」降順
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
     * エントリーリスト＆件数を取得
     *
     * @param    array() : 検索項目値
     * @param    int     : 1ページ当たりの表示件数(LIMIT値)
     * @param    int     : オフセット値(ページ番号)
     * @return    array()
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
        //    $set_orderby["pj_en_cl_id"] = '';
        //}else {
        //    $set_orderby["pj_en_cl_id"] = $arr_post['orderid'];
        //}
        //
        //if ($arr_post['orderstatus'] == '')
        //{
        //    $set_orderby["pj_status"] = '';
        //}else {
        //    $set_orderby["pj_status"] = $arr_post['orderstatus'];
        //}

        // 対象クライアントメンバーの取得
        $order_list = $this->select_entrylist($set_select, $set_select_like, $tmp_per_page, $tmp_offset);
        //$order_list = $this->select_orderlist($set_select, $set_select_like, $set_orderby, $tmp_per_page, $tmp_offset);

        return $order_list;

    }

    /**
     * エントリーリスト＆件数を取得
     *
     * @param    array() : WHERE句項目
     * @param    array() : WHERE LIKE句項目
     * @param    array() : ORDER BY句項目
     * @param    int     : 1ページ当たりの表示件数
     * @param    int     : オフセット値(ページ番号)
     * @return    array()
     */
    //public function select_orderlist($set_select, $set_select_like, $set_orderby, $tmp_per_page, $tmp_offset=0)
    public function select_entrylist($set_select, $set_select_like, $tmp_per_page, $tmp_offset=0)
    {

        $sql  = 'SELECT * FROM `vw_my_entrylist` ';
        $sql .= ' WHERE `wi_del_flg` = 0';                                            // 削除フラグ

        // WHERE文 作成
        foreach ($set_select as $key => $val)
        {
            if (isset($val) && $val != '')
            {
                //if ($key == 'pj_genre01')
                //{
                //    if (intval($set_select["pj_genre01"]) > 1)                         // ジャンル："1"は選択文字
                //    {
                //        $sql .= ' AND `pj_genre01` = ' . $set_select["pj_genre01"];
                //    }
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
        //    if (isset($val) && $val != '')
        //    {
        //        if ($tmp_firstitem == FALSE)
        //        {
        //            $sql .= ' ORDER BY ' . $key . ' ' . $val;
        //            $tmp_firstitem = TRUE;
        //        } else {
        //            $sql .= ' , ' . $key . ' ' . $val;
        //        }
        //    }
        //}
        if ($tmp_firstitem == FALSE)
        {
            $sql .= ' ORDER BY wi_id DESC';                                        // デフォルト：「案件ID」降順
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
     * 獲得ポイント＆入金一覧を取得
     *
     * @param    array() : 検索項目値
     * @param    int     : 1ページ当たりの表示件数(LIMIT値)
     * @param    int     : オフセット値(ページ番号)
     * @param    int     : メンバー識別("w"=>ライター, "a"=>管理者)
     * @return   array()
     */
    public function get_pointlist($arr_post, $tmp_per_page, $tmp_offset=0, $mem="w")
    {

        // 各SQL項目へセット
        // WHERE
        $set_select["wi_wr_id"]          = $arr_post['wi_wr_id'];
        $set_select["wi_pay_status"]     = $arr_post['wi_pay_status'];
        if ($mem == "a")
        {
       		$set_select["wi_id"]             = $arr_post['wi_id'];
        	$set_select["wr_pay_limit_date"] = $arr_post['wr_pay_limit_date'];
        }
        $set_select_like["wi_pj_id"]     = $arr_post['wi_pj_id'];
        $set_select_like["pj_title"]     = $arr_post['pj_title'];
        $set_select_btw["check_date_st"] = $arr_post['check_date_st'];
        $set_select_btw["check_date_ed"] = $arr_post['check_date_ed'];
        $set_select_btw["pay_date_st"]   = $arr_post['pay_date_st'];
        $set_select_btw["pay_date_ed"]   = $arr_post['pay_date_ed'];

        // 対象クライアントメンバーの取得
        $order_list = $this->select_pointlist($set_select, $set_select_like, $set_select_btw, $tmp_per_page, $tmp_offset);

        return $order_list;

    }

    /**
     * 獲得ポイントリスト＆入金一覧件数を取得
     *
     * @param    array() : WHERE句項目
     * @param    array() : WHERE LIKE句項目
     * @param    array() : between句項目
     * @param    int     : 1ページ当たりの表示件数
     * @param    int     : オフセット値(ページ番号)
     * @return   array()
     */
    public function select_pointlist($set_select, $set_select_like, $set_select_btw, $tmp_per_page, $tmp_offset=0)
    {

        $sql  = 'SELECT * FROM `vw_my_point` ';
        $sql .= ' WHERE `wi_del_flg` = 0';                                            // 削除フラグ

        // WHERE文 作成
        foreach ($set_select as $key => $val)
        {

            if (isset($val) && $val != '')
            {
            	$sql .= ' AND ' . $key . ' = ' . $this->db->escape($val);
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

       	// WHERE-between文 作成
       	if ($set_select_btw["check_date_st"] != null)
       	{
          	$sql .= ' AND wi_check_date >= \'' . str_replace('/', '-', $set_select_btw["check_date_st"]) . '\'';
       	}
       	if ($set_select_btw["check_date_ed"] != null)
       	{
          	$sql .= ' AND wi_check_date <= \'' . str_replace('/', '-', $set_select_btw["check_date_ed"]) . '\'';
       	}
       	if ($set_select_btw["pay_date_st"] != null)
       	{
          	$sql .= ' AND wi_pay_date >= \'' . str_replace('/', '-', $set_select_btw["pay_date_st"]) . '\'';
       	}
       	if ($set_select_btw["pay_date_ed"] != null)
       	{
          	$sql .= ' AND wi_pay_date <= \'' . str_replace('/', '-', $set_select_btw["pay_date_ed"]) . '\'';
       	}

       	// ORDER BY文 作成 : ORDERBY の優先順位があるので注意 (ステータス > 案件申請ID)
       	//$tmp_firstitem = FALSE;
       	//if ($tmp_firstitem == FALSE)
       	//{
       	//   $sql .= ' ORDER BY wi_id DESC';                                        // デフォルト：「案件ID」降順
       	//}

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
     * @param    array()
     * @return    int
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
     * @param    array()
     * @param    int
     * @param    boolean
     * @return    boolean
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
     * @param    array()
     * @return    bool
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
     * 1レコード更新 :: 入金情報更新
     *
     * @param    array()
     * @return    bool
     */
    public function update_wi_pay($set_data)
    {

    	$where = array(
    			'wi_id' => $set_data['wi_id'],
    	);

    	$result = $this->db->update('tb_writer_info', $set_data, $where);
    	return $result;
    }

    /**
     * 案件ID・チェック
     *
     * @param    varchar
     * @return    array
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
     * アドミン：入金＆ポイント明細CSVを取得
     *
     * @param    array() : 検索項目値
     * @param    int     : 1ページ当たりの表示件数(LIMIT値)
     * @param    int     : オフセット値(ページ番号)
     * @return   array()
     */
    public function get_wrdetail_query($arr_post, $tmp_per_page, $tmp_offset=0)
    {

    	// 各SQL項目へセット
    	// WHERE
    	$set_select["wi_wr_id"]          = $arr_post['wi_wr_id'];
    	$set_select["wi_pay_status"]     = $arr_post['wi_pay_status'];
    	$set_select["wi_id"]             = $arr_post['wi_id'];
    	$set_select["wr_pay_limit_date"] = $arr_post['wr_pay_limit_date'];
    	$set_select_like["wi_pj_id"]     = $arr_post['wi_pj_id'];
    	$set_select_like["pj_title"]     = $arr_post['pj_title'];
    	$set_select_btw["check_date_st"] = $arr_post['check_date_st'];
    	$set_select_btw["check_date_ed"] = $arr_post['check_date_ed'];
    	$set_select_btw["pay_date_st"]   = $arr_post['pay_date_st'];
    	$set_select_btw["pay_date_ed"]   = $arr_post['pay_date_ed'];

    	// 対象クライアントメンバーの取得
    	$point_query = $this->select_wrdetail_query($set_select, $set_select_like, $set_select_btw, $tmp_per_page, $tmp_offset);

    	return $point_query;

    }

    /**
     * アドミン：入金＆ポイント明細CSVを取得
     *
     * @param    array() : WHERE句項目
     * @param    array() : WHERE LIKE句項目
     * @param    array() : between句項目
     * @param    int     : 1ページ当たりの表示件数
     * @param    int     : オフセット値(ページ番号)
     * @return   array()
     */
    public function select_wrdetail_query($set_select, $set_select_like, $set_select_btw, $tmp_per_page, $tmp_offset=0)
    {

    	$sql  = 'SELECT'
    			. ' wi_id AS `識別ID`,'
    			. ' wi_wr_id AS `ライターID`,'
    			. ' wi_pj_id AS `案件ID`,'
    			. ' wi_pay_status AS `入金状況`,'					// 入金状況(0：未支払、1：支払済、2：保留、3：返金)
    			. ' wi_point AS `獲得ポイント`,'
    			. ' wi_point_adjust AS `調整ポイント`,'
    			. ' wi_pay_money AS `入金金額`,'
    			. ' wi_check_date AS `ポイント獲得日`,'
    			. ' wi_pay_schedule AS `入金予定日`,'
    			. ' wi_pay_date AS `入金日`'
    			;
    			$sql .= ' FROM `tb_writer_info` WHERE `wi_del_flg` = 0';

    	// WHERE文 作成
    	foreach ($set_select as $key => $val)
    	{

    		if (isset($val) && $val != '')
    		{
    			$sql .= ' AND ' . $key . ' = ' . $this->db->escape($val);
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

    	// WHERE-between文 作成
    	if ($set_select_btw["check_date_st"] != null)
    	{
    		$sql .= ' AND wi_check_date >= \'' . str_replace('/', '-', $set_select_btw["check_date_st"]) . '\'';
    	}
    	if ($set_select_btw["check_date_ed"] != null)
    	{
    		$sql .= ' AND wi_check_date <= \'' . str_replace('/', '-', $set_select_btw["check_date_ed"]) . '\'';
    	}
    	if ($set_select_btw["pay_date_st"] != null)
    	{
    		$sql .= ' AND wi_pay_date >= \'' . str_replace('/', '-', $set_select_btw["pay_date_st"]) . '\'';
    	}
    	if ($set_select_btw["pay_date_ed"] != null)
    	{
    		$sql .= ' AND wi_pay_date <= \'' . str_replace('/', '-', $set_select_btw["pay_date_ed"]) . '\'';
    	}

    	// ORDER BY文 作成 : ORDERBY の優先順位があるので注意 (ステータス > 案件申請ID)
    	//$tmp_firstitem = FALSE;
    	//if ($tmp_firstitem == FALSE)
    	//{
    	//   $sql .= ' ORDER BY wi_id DESC';                                        // デフォルト：「案件ID」降順
    	//}

    	// 対象全件数を取得
    	//$query = $this->db->query($sql);
    	//$countall = $query->num_rows();

    	// LIMIT ＆ OFFSET 値をセット
    	$sql .= ' LIMIT ' . $tmp_per_page . ' OFFSET ' . $tmp_offset;

    	// クエリー実行
    	$query = $this->db->query($sql);

    	return $query;

    }

    /**
     * タイムオーバーのライター検索
     *
     * @param    varchar
     * @return    array
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
