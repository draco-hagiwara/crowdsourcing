<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Project extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }


    /**
     * 投稿情報の取得
     *
     * @param    int
     * @return    array()
     */
    public function get_posting($get_pj_id)
    {

        $set_where["pj_id"] = $get_pj_id;

        $query = $this->db->get_where('vw_posting_pj', $set_where);

        $get_data = $query->result('array');

        return $get_data;

    }



    /**
     * 投稿記事情報のリスト＆件数を取得
     *
     * @param    array() : 検索項目値
     * @param    int     : 1ページ当たりの表示件数(LIMIT値)
     * @param    int     : オフセット値(ページ番号)
     * @return    array()
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
     * @return    array()
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
     * 案件情報の取得
     *
     * @param    int
     * @return    array()
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
     * @return    array()
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
     * 案件情報のリスト＆件数を取得
     *
     * @param    array() : 検索項目値
     * @param    int     : 1ページ当たりの表示件数(LIMIT値)
     * @param    int     : オフセット値(ページ番号)
     * @return    array()
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
     * @return    array()
     */
    public function select_orderlist($set_select, $set_select_like, $set_orderby, $tmp_per_page, $tmp_offset=0)
    {

        $sql  = 'SELECT * FROM `tb_project` ';
        $sql .= ' WHERE `pj_del_flg` = 0';                                        // 削除フラグ
        $sql .= ' AND `pj_status` = 0 OR `pj_status` = 8 OR `pj_status` = 9';    // ステータス：「準備中」「保留」「削除」
        if ($set_select["pj_genre01"] > '1')                                     // ジャンル："1"は選択文字
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
     * 案件情報：新規レード作成
     *
     * @param    array()
     * @return    int
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
     * @return    int
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
     * @return    int
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
     * @return    bool
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
     * @return    bool
     */
    public function update_pj_posting($set_data)
    {

        $where = array(
                'pj_id' => $set_data['pj_id']
        );

        $result = $this->db->update('tb_project', $set_data, $where);
        return $result;
    }


}
