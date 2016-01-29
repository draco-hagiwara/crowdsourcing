<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Project extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }


    /**
     * TOP：案件検索一覧情報の取得
     *
     * @param    int
     * @return    array()
     */
    public function get_seachlist($limit_cnt)
    {

        $query = $this->db->get('vw_searchlist_pj', $limit_cnt);                    // LIMIT=20
        $get_data = $query->result('array');

        return $get_data;

    }

    /**
     * 投稿情報の取得
     *
     * @param    int
     * @return   array()
     */
    public function get_posting($get_pj_id)
    {

        $set_where["pj_id"] = $get_pj_id;

        $query = $this->db->get_where('vw_posting_pj', $set_where);

        $get_data = $query->result('array');

        return $get_data;

    }

    /**
     * 作業エントリー一覧の取得
     *
     * @param    int
     * @return    array()
     */
    public function get_entry_data($get_pj_id)
    {

        $set_where["pj_id"] = $get_pj_id;

        $query = $this->db->get_where('vw_posting_pj', $set_where);

        $get_data = $query->result('array');

        return $get_data;

    }

    /**
     * 案件状況管理の取得
     *
     * @param    int
     * @return   array()
     */
    public function get_entry_list($get_pj_id)
    {

        $set_where["pj_id"] = $get_pj_id;

        $query = $this->db->get_where('vw_orderlist_pj', $set_where);

        $get_data = $query->result('array');

        return $get_data;

    }

    /**
     * 案件情報の取得
     *
     * @param    int
     * @return   array()
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
     * @param    int
     * @param    int
     * @param    tinyint
     * @return   array()
     */
    public function get_order_info($get_pj_id, $pji_seq = NULL)
    {

       $set_where["pji_pj_id"]      = $get_pj_id;
       if ($pji_seq != NULL)
       {
          $set_where["pji_seq"]    = $pji_seq;
       }

       // view から取得
       $query = $this->db->get_where('vw_order_pji', $set_where);

       $get_data = $query->result('array');

       return $get_data;

    }

    /**
     * 作業個別情報の取得
     *
     * @param    int
     * @param    int
     * @param    tinyint
     * @return   array()
     */
    public function get_entry_info($get_pj_id, $pji_seq = NULL, $pji_status = NULL)
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
       $query = $this->db->get_where('vw_posting_pji', $set_where);

       $get_data = $query->result('array');

       return $get_data;

    }




    /**
     * 案件状況管理のリスト＆件数を取得
     *
     * @param    array() : 検索項目値
     * @param    int     : 1ページ当たりの表示件数(LIMIT値)
     * @param    int     : オフセット値(ページ番号)
     * @return   array()
     */
    public function get_entrylist($cl_id, $arr_post, $tmp_per_page, $tmp_offset=0)
    {

        // 各SQL項目へセット
        // WHERE
        $set_select_like["pj_en_id"]    = $arr_post['pj_en_id'];
        $set_select_like["pj_title"]    = $arr_post['pj_title'];
        $set_select["pj_en_cl_id"]      = $cl_id;
        $set_select["pj_status"]        = $arr_post['pj_status'];
        $set_select["pj_work_status"]   = $arr_post['pj_work_status'];
        $set_select["pj_entry_status"]  = $arr_post['pj_entry_status'];
        $set_select["pj_genre01"]       = $arr_post['pj_genre01'];


        // ORDER BY
        if ($arr_post['orderid'] == '')
        {
            $set_orderby["pj_en_id"] = '';
        }else {
            $set_orderby["pj_en_id"] = $arr_post['orderid'];
        }

        if ($arr_post['orderstatus'] == '')
        {
            $set_orderby["pj_status"] = '';
        }else {
            $set_orderby["pj_status"] = $arr_post['orderstatus'];
        }

        // 対象クライアントメンバーの取得
        $entry_list = $this->select_entrylist($set_select, $set_select_like, $set_orderby, $tmp_per_page, $tmp_offset);

        return $entry_list;

    }

    /**
     * 案件状況管理のリスト＆件数を取得
     *
     * @param    array() : WHERE句項目
     * @param    array() : WHERE LIKE句項目
     * @param    array() : ORDER BY句項目
     * @param    int     : 1ページ当たりの表示件数
     * @param    int     : オフセット値(ページ番号)
     * @return   array()
     */
    public function select_entrylist($set_select, $set_select_like, $set_orderby, $tmp_per_page, $tmp_offset=0)
    {

        $sql  = 'SELECT * FROM `vw_orderlist_pj` ';
        $sql .= ' WHERE `pj_del_flg` = 0';                                            // 削除フラグ

        // WHERE文 作成
        foreach ($set_select as $key => $val)
        {
            if (isset($val) && $val != '')
            {
                if ($key == 'pj_genre01')
                {
                    if (intval($set_select["pj_genre01"]) > 1)                         // ジャンル："1"は選択文字
                    {
                        $sql .= ' AND `pj_genre01` = ' . $set_select["pj_genre01"];
                    }
                } else {
                    $sql .= ' AND ' . $key . ' = ' . $this->db->escape($val);
                }
            }
        }

        // WHERE-LIKE文 作成
        foreach ($set_select_like as $key => $val)
        {
            if (isset($val) && $val != '')
            {
                $sql .= ' AND ' . $key . ' LIKE \'%' . $this->db->escape_like_str($val) . '%\'';
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
            $sql .= ' ORDER BY pj_id DESC';                                        // デフォルト：「案件ID」降順
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
     * 投稿記事情報のリスト＆件数を取得
     *
     * @param    array() : 検索項目値
     * @param    int     : 1ページ当たりの表示件数(LIMIT値)
     * @param    int     : オフセット値(ページ番号)
     * @return   array()
     */
    public function get_postinglist($arr_post, $tmp_per_page, $tmp_offset=0)
    {

        // 各SQL項目へセット
        // WHERE
        $set_select_like["pj_id"]       = $arr_post['pj_id'];
        $set_select_like["pj_en_id"]    = $arr_post['pj_en_id'];
        $set_select_like["pj_en_cl_id"] = $arr_post['pj_en_cl_id'];
        $set_select_like["pj_title"]    = $arr_post['pj_title'];
        $set_select["pj_status"]        = $arr_post['pj_status'];
        $set_select["pj_work_status"]   = $arr_post['pj_work_status'];
        $set_select["pj_entry_status"]  = $arr_post['pj_entry_status'];
        $set_select["pj_genre01"]       = $arr_post['pj_genre01'];

        // ORDER BY
        if ($arr_post['orderid'] == '')
        {
            $set_orderby["pj_en_cl_id"] = '';
        }else {
            $set_orderby["pj_en_cl_id"] = $arr_post['orderid'];
        }

        if ($arr_post['orderstatus'] == '')
        {
            $set_orderby["pj_status"] = '';
        }else {
            $set_orderby["pj_status"] = $arr_post['orderstatus'];
        }

        // 対象クライアントメンバーの取得
        $entry_list = $this->select_postinglist($set_select, $set_select_like, $set_orderby, $tmp_per_page, $tmp_offset);

        return $entry_list;

    }

    /**
     * 対象投稿記事情報のリスト＆件数を取得
     *
     * @param    array() : WHERE句項目
     * @param    array() : WHERE LIKE句項目
     * @param    array() : ORDER BY句項目
     * @param    int     : 1ページ当たりの表示件数
     * @param    int     : オフセット値(ページ番号)
     * @return   array()
     */
    public function select_postinglist($set_select, $set_select_like, $set_orderby, $tmp_per_page, $tmp_offset=0)
    {

        $sql  = 'SELECT * FROM `vw_posting_pj` ';
        $sql .= ' WHERE `pj_del_flg` = 0';                                            // 削除フラグ

        // WHERE文 作成
        foreach ($set_select as $key => $val)
        {
            if (isset($val) && $val != '')
            {
                if ($key == 'pj_genre01')
                {
                    if (intval($set_select["pj_genre01"]) > 1)                         // ジャンル："1"は選択文字
                    {
                        $sql .= ' AND `pj_genre01` = ' . $set_select["pj_genre01"];
                    }
                } else {
                    $sql .= ' AND ' . $key . ' = ' . $this->db->escape($val);
                }
            }
        }

        // WHERE-LIKE文 作成
        foreach ($set_select_like as $key => $val)
        {
            if (isset($val) && $val != '')
            {
                   $sql .= ' AND ' . $key . ' LIKE \'%' . $this->db->escape_like_str($val) . '%\'';
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
            $sql .= ' ORDER BY pj_id DESC';                                        // デフォルト：「案件ID」降順
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
     * 案件情報のリスト＆件数を取得
     *
     * @param    array() : 検索項目値
     * @param    int     : 1ページ当たりの表示件数(LIMIT値)
     * @param    int     : オフセット値(ページ番号)
     * @return   array()
     */
    public function get_orderlist($arr_post, $tmp_per_page, $tmp_offset=0)
    {

        // 各SQL項目へセット
        // WHERE
        $set_select_like["pj_id"]          = $arr_post['pj_id'];
        $set_select_like["pj_en_id"]       = $arr_post['pj_en_id'];
        $set_select_like["pj_en_cl_id"]    = $arr_post['pj_en_cl_id'];
        $set_select_like["pj_order_title"] = $arr_post['pj_order_title'];
        $set_select["pj_genre01"]          = $arr_post['pj_genre01'];


        // ORDER BY
        if ($arr_post['orderpjid'] == '')
        {
            $set_orderby["pj_id"] = '';
        }else {
            $set_orderby["pj_id"] = $arr_post['orderpjid'];
        }

        if ($arr_post['orderpeid'] == '')
        {
            $set_orderby["pj_en_id"] = '';
        }else {
            $set_orderby["pj_en_id"] = $arr_post['orderpeid'];
        }

        // 対象クライアントメンバーの取得
        $entry_list = $this->select_orderlist($set_select, $set_select_like, $set_orderby, $tmp_per_page, $tmp_offset);

        return $entry_list;

    }

    /**
     * 対象案件申請情報のリスト＆件数を取得
     *
     * @param    array() : WHERE句項目
     * @param    array() : WHERE LIKE句項目
     * @param    array() : ORDER BY句項目
     * @param    int     : 1ページ当たりの表示件数
     * @param    int     : オフセット値(ページ番号)
     * @return   array()
     */
    public function select_orderlist($set_select, $set_select_like, $set_orderby, $tmp_per_page, $tmp_offset=0)
    {

        $sql  = 'SELECT * FROM `tb_project` ';
        $sql .= ' WHERE `pj_del_flg` = 0';                                        // 削除フラグ
        $sql .= ' AND `pj_status` = 0 OR `pj_status` = 8';                        // ステータス：「準備中」「保留」
        if ($set_select["pj_genre01"] > '1')                                      // ジャンル："1"は選択文字
        {
            $sql .= ' AND `pj_genre01` = ' . $set_select["pj_genre01"];
        }

        // WHERE文 作成
        foreach ($set_select_like as $key => $val)
        {
            if (isset($val) && $val != '')
            {
                $sql .= ' AND ' . $key . ' LIKE \'%' . $this->db->escape_like_str($val) . '%\'';
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
            $sql .= ' ORDER BY pj_en_entry_date DESC';                            // デフォルト：「案件ID」降順
        }

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
     * 作業情報のリスト＆件数を取得
     *
     * @param    array() : 検索項目値
     * @param    int     : 1ページ当たりの表示件数(LIMIT値)
     * @param    int     : オフセット値(ページ番号)
     * @return    array()
     */
    public function get_genrelist($arr_post, $tmp_per_page, $tmp_offset=0)
    {

        // 各SQL項目へセット
        // WHERE
        $set_select_like["pj_order_title"] = $arr_post['pj_order_title'];
        $set_select_like["pj_title"]       = $arr_post['pj_order_title'];
        $set_select_like["pj_work"]        = $arr_post['pj_order_title'];
        $set_select["pj_genre01"]          = $arr_post['pj_genre01'];

        // 「気になるリスト」検索専用
        if (isset($arr_post['pj_id']))
        {
            $set_select["pj_id"]               = $arr_post['pj_id'];
        }

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
        $genre_list = $this->select_genrelist($set_select, $set_select_like, $tmp_per_page, $tmp_offset);
        //$order_list = $this->select_orderlist($set_select, $set_select_like, $set_orderby, $tmp_per_page, $tmp_offset);

        return $genre_list;

    }

    /**
     * 作業情報のリスト＆件数を取得
     *
     * @param    array() : WHERE句項目
     * @param    array() : WHERE LIKE句項目
     * @param    array() : ORDER BY句項目
     * @param    int     : 1ページ当たりの表示件数
     * @param    int     : オフセット値(ページ番号)
     * @return    array()
     */
    //public function select_orderlist($set_select, $set_select_like, $set_orderby, $tmp_per_page, $tmp_offset=0)
    public function select_genrelist($set_select, $set_select_like, $tmp_per_page, $tmp_offset=0)
    {

        $sql  = 'SELECT * FROM `vw_searchlist_pj` ';
        $sql .= ' WHERE `pj_del_flg` = 0';                                            // 削除フラグ

        // WHERE文 作成
        foreach ($set_select as $key => $val)
        {
            if (isset($val) && $val != '')
            {
                if ($key == 'pj_genre01')
                {
                    if (intval($set_select["pj_genre01"]) > 1)                         // ジャンル："1"は選択文字
                    {
                        $sql .= ' AND `pj_genre01` = ' . $set_select["pj_genre01"];
                    }
                } else {
                    $sql .= ' AND ' . $key . ' = ' . $this->db->escape($val);
                }
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
            $sql .= ' ORDER BY pj_id DESC';                                        // デフォルト：「案件ID」降順
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
     * 獲得ポイント＆支払一覧を取得
     *
     * @param    array() : 検索項目値
     * @param    int     : 1ページ当たりの表示件数(LIMIT値)
     * @param    int     : オフセット値(ページ番号)
     * @param    int     : 0 => 'select_like', 1 => 'select'
     * @return   array()
     */
    public function get_pointlist($arr_post, $tmp_per_page, $tmp_offset=0, $selectid=0)
    {

        // 各SQL項目へセット
        // WHERE
        $set_select["pj_en_cl_id"]          = $arr_post['pj_en_cl_id'];
        $set_select["pj_pay_status"]        = $arr_post['pj_pay_status'];
        if ($selectid == 0)
        {
        	$set_select_like["pj_id"]       = $arr_post['pj_id'];
        } else {
        	$set_select["pj_id"]            = $arr_post['pj_id'];
        }
        $set_select_like["pj_title"]        = $arr_post['pj_title'];
        $set_select_btw["delivery_date_st"] = $arr_post['delivery_date_st'];
        $set_select_btw["delivery_date_ed"] = $arr_post['delivery_date_ed'];
        $set_select_btw["pay_date_st"]      = $arr_post['pay_date_st'];
        $set_select_btw["pay_date_ed"]      = $arr_post['pay_date_ed'];

        // 対象クライアントメンバーの取得
        $point_list = $this->select_pointlist($set_select, $set_select_like, $set_select_btw, $tmp_per_page, $tmp_offset);

        return $point_list;

    }

    /**
     * 獲得ポイントリスト＆支払一覧件数を取得
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

        $sql  = 'SELECT * FROM `tb_project` ';
        $sql .= ' WHERE `pj_del_flg` = 0';                                            // 削除フラグ

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
        if ($set_select_btw["delivery_date_st"] != null)
        {
            $sql .= ' AND pj_delivery_date >= \'' . str_replace('/', '-', $set_select_btw["delivery_date_st"]) . '\'';
        }
        if ($set_select_btw["delivery_date_ed"] != null)
        {
            $sql .= ' AND pj_delivery_date <= \'' . str_replace('/', '-', $set_select_btw["delivery_date_ed"]) . '\'';
        }
        if ($set_select_btw["pay_date_st"] != null)
        {
            $sql .= ' AND pj_pay_schedule >= \'' . str_replace('/', '-', $set_select_btw["pay_date_st"]) . '\'';
        }
        if ($set_select_btw["pay_date_ed"] != null)
        {
            $sql .= ' AND pj_pay_schedule <= \'' . str_replace('/', '-', $set_select_btw["pay_date_ed"]) . '\'';
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
     * 案件情報：新規レード作成
     *
     * @param    array()
     * @return   int
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
     * @param    int
     * @return   int
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
     * @param    int
     * @return   int
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
     * @param    array()
     * @return   bool
     */
    public function update_project($set_data)
    {

        $time = time();

        // 公開日時をチェック
        $current_time = date("Y-m-d H:i:s", $time);
        if (strtotime($set_data['pj_start_time']) <= strtotime($current_time))
        {
            // エントリーステータス(エントリーなし)
            $set_data['pj_entry_status'] = 0;

            // 公開設置日時をセット
            $set_data['pj_open_date'] = date("Y-m-d H:i:s", $time);
        } else {
            // エントリーステータス(予約)
            $set_data['pj_entry_status'] = 2;
        }

        // 更新日時をセット
        $set_data['pj_update_date'] = date("Y-m-d H:i:s", $time);

        $where = array(
                'pj_id' => $set_data['pj_id']
        );

        $result = $this->db->update('tb_project', $set_data, $where);
        return $result;
    }


    /**
     * 1レコード更新 :: 投稿記事
     *
     * @param    array()
     * @return   bool
     */
    public function update_pj_posting($set_data)
    {

        $where = array(
                'pj_id' => $set_data['pj_id']
        );

        $result = $this->db->update('tb_project', $set_data, $where);
        return $result;
    }


    /**
     * アドミン：請求＆ポイント明細CSVを取得
     *
     * @param    array() : 検索項目値
     * @param    int     : 1ページ当たりの表示件数(LIMIT値)
     * @param    int     : オフセット値(ページ番号)
     * @param    int     : 0 => 'select_like', 1 => 'select'
     * @return   array()
     */
    public function get_cldetail_query($arr_post, $tmp_per_page, $tmp_offset=0, $selectid=0)
    {

    	// 各SQL項目へセット
    	// WHERE
    	$set_select["pj_en_cl_id"]          = $arr_post['pj_en_cl_id'];
    	$set_select["pj_pay_status"]        = $arr_post['pj_pay_status'];
    	//if ($selectid == 0)		// 通常検索と結果が変わってしまう？
    	//{
    		$set_select_like["pj_id"]       = $arr_post['pj_id'];
    	//} else {
    	//	$set_select["pj_id"]            = $arr_post['pj_id'];
    	//}
    	$set_select_like["pj_title"]        = $arr_post['pj_title'];
    	$set_select_btw["delivery_date_st"] = $arr_post['delivery_date_st'];
    	$set_select_btw["delivery_date_ed"] = $arr_post['delivery_date_ed'];
    	$set_select_btw["pay_date_st"]      = $arr_post['pay_date_st'];
    	$set_select_btw["pay_date_ed"]      = $arr_post['pay_date_ed'];

    	// クエリー取得
    	$point_query = $this->select_cldetail_query($set_select, $set_select_like, $set_select_btw, $tmp_per_page, $tmp_offset);

    	return $point_query;

    }

    /**
     * アドミン：請求＆ポイント明細CSVを取得
     *
     * @param    array() : WHERE句項目
     * @param    array() : WHERE LIKE句項目
     * @param    array() : between句項目
     * @param    int     : 1ページ当たりの表示件数
     * @param    int     : オフセット値(ページ番号)
     * @return   array()
     */
    public function select_cldetail_query($set_select, $set_select_like, $set_select_btw, $tmp_per_page, $tmp_offset=0)
    {

    	$sql  = 'SELECT'
    			. ' pj_id AS `案件ID`,'								// 案件ID
    			. ' pj_en_cl_id AS `クライアントID`,'				// クライアントID
    			. ' pj_pay_status AS `支払状況`,'					// 支払状況(0：未支払、1：支払済、2：保留、3：返金)
    			. ' pj_wi_point AS `獲得ポイント`,'					// 獲得ポイント
    			. ' pj_wi_point_adjust AS `調整ポイント`,'			// 調整ポイント
    			. ' pj_pay_money AS `領収(支払)金額`,'				// 領収(支払)金額
    			. ' pj_delivery_date AS `納品日`,'					// 納品日
    			. ' pj_pay_schedule AS `請求(支払)予定日`,'			// 請求(支払)予定日
    			. ' pj_pay_date AS `領収(支払)日`'					// 領収(支払)日
    			;
    	$sql .= ' FROM `tb_project` WHERE `pj_del_flg` = 0';        // 削除フラグ

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
    	if ($set_select_btw["delivery_date_st"] != null)
    	{
    		$sql .= ' AND pj_delivery_date >= \'' . str_replace('/', '-', $set_select_btw["delivery_date_st"]) . '\'';
    	}
    	if ($set_select_btw["delivery_date_ed"] != null)
    	{
    		$sql .= ' AND pj_delivery_date <= \'' . str_replace('/', '-', $set_select_btw["delivery_date_ed"]) . '\'';
    	}
    	if ($set_select_btw["pay_date_st"] != null)
    	{
    		$sql .= ' AND pj_pay_schedule >= \'' . str_replace('/', '-', $set_select_btw["pay_date_st"]) . '\'';
    	}
    	if ($set_select_btw["pay_date_ed"] != null)
    	{
    		$sql .= ' AND pj_pay_schedule <= \'' . str_replace('/', '-', $set_select_btw["pay_date_ed"]) . '\'';
    	}

    	// 対象全件数を取得
    	//$query = $this->db->query($sql);
    	//$countall = $query->num_rows();

    	// LIMIT ＆ OFFSET 値をセット
    	$sql .= ' LIMIT ' . $tmp_per_page . ' OFFSET ' . $tmp_offset;

    	// クエリー実行
    	$query = $this->db->query($sql);

    	return $query;

    }

}
