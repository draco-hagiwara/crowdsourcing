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
     * 作業個別情報の取得
     *
     * @param    int
     * @param    int
     * @param    tinyint
     * @return    array()
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
     * 作業情報の取得
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
     * 作業個別情報の取得
     *
     * @param    int
     * @param    int
     * @param    tinyint
     * @return    array()
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
        $query = $this->db->get_where('vw_searchlist_pji', $set_where);

        $get_data = $query->result('array');

        return $get_data;

    }

    /**
     * 作業情報のリスト＆件数を取得
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
        $order_list = $this->select_orderlist($set_select, $set_select_like, $tmp_per_page, $tmp_offset);
        //$order_list = $this->select_orderlist($set_select, $set_select_like, $set_orderby, $tmp_per_page, $tmp_offset);

        return $order_list;

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
    public function select_orderlist($set_select, $set_select_like, $tmp_per_page, $tmp_offset=0)
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
     * 1レコード更新
     *
     * @param    array()
     * @return    bool
     */
    public function update_project($set_data)
    {

        $where = array(
                'pj_id' => $set_data['pj_id'],
        );

        $result = $this->db->update('tb_project', $set_data, $where);
        return $result;
    }

















/** ---------------------------- DELETE ------------------------------------------------------- **/

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




}
