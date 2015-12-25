<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Entry extends CI_Model
{

    //public function __construct()
    //{
    //    parent::__construct();
    //}


    /**
     * 案内申請情報の取得
     *
     * @param    int
     * @return    array()
     */
    public function get_entry($get_en_id)
    {

        $set_where["en_id"] = $get_en_id;

        $query = $this->db->get_where('tb_entry', $set_where);

        $get_data = $query->result('array');

        return $get_data;

    }

    /**
     * 案内申請個別情報の取得
     *
     * @param    int
     * @param    tinyint
     * @return    array()
     */
    public function get_entry_info($get_en_id, $ei_seq)
    {

        $set_where["ei_en_id"]    = $get_en_id;
        $set_where['ei_en_cl_id'] = $this->session->userdata('c_memID');                // セッションデータからクライアントID
        $set_where["ei_seq"]      = $ei_seq;

        $query = $this->db->get_where('tb_entry_info', $set_where);

        $get_data = $query->result('array');

        return $get_data;

    }

    /**
     * 案件申請情報のリスト＆件数を取得
     *
     * @param    array() : 検索項目値
     * @param    int     : 1ページ当たりの表示件数(LIMIT値)
     * @param    int     : オフセット値(ページ番号)
     * @return    array()
     */
    public function get_entrylist($cl_id, $arr_post, $tmp_per_page, $tmp_offset=0)
    {

        // 各SQL項目へセット
        // WHERE
        $set_select_like["en_entry_title"] = $arr_post['en_entry_title'];
        $set_select_like["en_id"]          = $arr_post['en_id'];
        $set_select["en_cl_id"]            = $cl_id;
        $set_select["en_genre01"]          = $arr_post['en_genre01'];
        $set_select["en_status"]           = $arr_post['en_status'];

        // ORDER BY
        if ($arr_post['orderstatus'] != '')
        {
            $set_orderby["en_status"] = $arr_post['orderstatus'];
        }
        if ($arr_post['orderid'] == 'ASC')
        {
            $set_orderby["en_id"] = $arr_post['orderid'];
        }else {
            $set_orderby["en_id"] = 'DESC';
        }

        // 対象クライアントメンバーの取得
        $entry_list = $this->select_entrylist($set_select, $set_select_like, $set_orderby, $tmp_per_page, $tmp_offset);

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
    public function select_entrylist($set_select, $set_select_like, $set_orderby, $tmp_per_page, $tmp_offset=0)
    {

        $sql  = 'SELECT * FROM `tb_entry` ';
        $sql .= ' WHERE `en_cl_id` = ' . $this->session->userdata('c_memID');    // セッションデータからクライアントID
        $sql .= ' AND `en_del_flg` = 0';                                        // 削除フラグ
        $sql .= ' AND `en_status` != 2';                                        // ステータス：「承認」
        //$sql .= ' AND `en_status` != 3';                                        // ステータス：「非承認」
        if ($set_select["en_status"] != '')                                     // ステータス
        {
            $sql .= ' AND `en_status`  = ' . $set_select["en_status"];
        }
        if ($set_select["en_genre01"] > '1')                                     // ジャンル："1"は選択文字
        {
            $sql .= ' AND `en_genre01` = ' . $set_select["en_genre01"];
        }

        // WHERE文 作成
        //$tmp_firstitem = FALSE;
        foreach ($set_select_like as $key => $val)
        {
            if (isset($val))
            {
                //if ($tmp_firstitem == FALSE)
                //{
                //    $sql .= ' WHERE ' . $key . ' LIKE \'%' . $this->db->escape_like_str($val) . '%\'';
                //    $tmp_firstitem = TRUE;
                //} else {
                    $sql .= ' AND ' . $key . ' LIKE \'%' . $this->db->escape_like_str($val) . '%\'';
                //}
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
     * @param    array
     * @return    int
     */
    public function insert_entry($setData)
    {

        // データ追加
        $setData = $this->db->escape($setData);

        $this->db->insert('tb_entry', $setData);

        // 「案件申請ID['en_id']」を取得
        $sql = 'SELECT LAST_INSERT_ID()';
        $query = $this->db->query($sql);
        $get_en_id = $query->result('array');

        // 追加された「案件申請ID」を返す
        return $get_en_id;

    }

    /**
     * 新規 個別案件申請 登録
     *
     * @param    int
     * @return    boolen
     */
    public function insert_entryinfo($setData)
    {

        // データ追加
        $result = $this->db->insert('tb_entry_info', $setData);

        return $result;

    }

    /**
     * 1レコード更新 :: 案件内容
     *
     * @param    array()
     * @return    bool
     */
    public function update_entry($set_data)
    {

        $time = time();

        // 申請日時をチェック
        if ($set_data['en_status'] == '1')
        {
            $set_data['en_entry_date'] = date("Y-m-d H:i:s", $time);
        }

        // 更新日時をセット
        $set_data['en_update_date'] = date("Y-m-d H:i:s", $time);

        $where = array(
                'en_id' => $set_data['en_id']
        );

        $result = $this->db->update('tb_entry', $set_data, $where);
        return $result;
    }

    /**
     * 1レコード更新 :: 個別案件申請 1～3
     *
     * @param    int
     * @param    array()
     * @return    bool
     */
    public function update_entryinfo($entry_no, $set_data)
    {

        // 「ei_seq」チェック
        if ($entry_no == '01')
        {
            $set_data['ei_seq'] = 0;
        } elseif ($entry_no == '02')
        {
            $set_data['ei_seq'] = 1;
        } elseif ($entry_no == '03')
        {
            $set_data['ei_seq'] = 2;
        //} else {
        }

        $where = array(
                'ei_en_id'    => $set_data['ei_en_id'],
                'ei_en_cl_id' => $set_data['ei_en_cl_id'],
                'ei_seq'      => $set_data['ei_seq'],
        );

        // 対象レコードの存在チェック (ON DUPLICATE KEY)
        $query = $this->db->get_where('tb_entry_info', $where);

        if ($query->num_rows() == 0) {

            // INSERT
            $set_data['ei_status']   = 1;

            $result = $this->db->insert('tb_entry_info', $set_data);

        } else {

            // UPDATE

            // 更新日時をセット
            $time = time();
            $set_data['ei_update_date'] = date("Y-m-d H:i:s", $time);

            $result = $this->db->update('tb_entry_info', $set_data, $where);
        }

        return $result;
    }

}
