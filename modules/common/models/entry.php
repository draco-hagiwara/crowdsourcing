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
     * @return   array()
     */
    public function get_entry($get_en_id)
    {

        $set_where["en_id"] = $get_en_id;

        $query = $this->db->get_where('tb_entry', $set_where);

        $get_data = $query->result('array');

        return $get_data;

    }

    /**
     * 案件申請個別情報の取得
     *
     * @param    int
     * @param    int
     * @param    tinyint
     * @return   array()
     */
    public function get_entry_info($get_en_id, $ei_seq = NULL, $ei_status = NULL)
    {

        $set_where["ei_en_id"]      = $get_en_id;
        if ($ei_seq != NULL)
        {
            $set_where["ei_seq"]    = $ei_seq;
        }
        if ($ei_status != NULL)
        {
            $set_where["ei_status"] = 1;
        }

        $query = $this->db->get_where('tb_entry_info', $set_where);

        $get_data = $query->result('array');

        return $get_data;

    }
//    /**
//     * 案内申請個別情報の取得
//     *
//     * @param    int
//     * @param    tinyint
//     * @return    array()
//     */
//    public function get_entry_info($get_en_id, $ei_seq)
//    {
//
//        $set_where["ei_en_id"]    = $get_en_id;
//        $set_where['ei_en_cl_id'] = $this->session->userdata('c_memID');                // セッションデータからクライアントID
//        $set_where["ei_seq"]      = $ei_seq;
//
//        $query = $this->db->get_where('tb_entry_info', $set_where);
//
//        $get_data = $query->result('array');
//
//        return $get_data;
//
//    }

    /**
     * メール送信先クライアントの会社名＆メールアドレスを取得
     *
     * @param    int
     * @return    array()
     */
    public function get_client_name($get_en_id)
    {

        $sql = 'SELECT pe.en_entry_title, cl.cl_company, cl.cl_person01, cl.cl_person02, cl.cl_email';
        $sql .= ' FROM tb_entry AS pe JOIN tb_client AS cl ON pe.en_cl_id = cl.cl_id';
        $sql .= ' WHERE en_id = ' . $get_en_id;

        // クエリー実行
        $query = $this->db->query($sql);
        $get_client_info = $query->result('array');

        return $get_client_info;

    }

    /**
     * 案件申請情報のリスト＆件数を取得
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
        $set_select_like["en_entry_title"] = $arr_post['en_entry_title'];
        $set_select_like["en_id"]          = $arr_post['en_id'];
        $set_select_like["en_cl_id"]       = $arr_post['en_cl_id'];
        $set_select["en_genre01"]          = $arr_post['en_genre01'];
        $set_select["en_status"]           = $arr_post['en_status'];
        //$set_select['en_cl_id']   = $this->session->userdata('memberID');                // セッションデータからクライアントID

        // ORDER BY
        $set_orderby["en_status"] = $arr_post['orderstatus'];
        if ($arr_post['orderid'] == '')
        {
            $set_orderby["en_id"] = '';
        }else {
            $set_orderby["en_id"] = $arr_post['orderid'];
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
        //$sql .= ' WHERE `en_cl_id` = ' . $this->session->userdata('a_memID');    // セッションデータからクライアントID
        $sql .= ' WHERE `en_del_flg` = 0';                                        // 削除フラグ
        $sql .= ' AND `en_status` != 0';                                        // ステータス：「準備中」
        $sql .= ' AND `en_status` != 2';                                        // ステータス：「承認」
        $sql .= ' AND `en_status` != 4';                                        // ステータス：「取消」
        $sql .= ' AND `en_status` != 5';                                        // ステータス：「削除」
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
            if (isset($val) && $val != '')
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
            $sql .= ' ORDER BY en_id DESC';                                    // デフォルト：「申請id」降順
            //$sql .= ' ORDER BY en_entry_date DESC';                        // デフォルト：「申請日」降順
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
     * 案件申請情報のリスト＆件数を取得
     *
     * @param    array() : 検索項目値
     * @param    int     : 1ページ当たりの表示件数(LIMIT値)
     * @param    int     : オフセット値(ページ番号)
     * @return    array()
     */
    public function get_cl_entrylist($cl_id, $arr_post, $tmp_per_page, $tmp_offset=0)
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
        $entry_list = $this->select_cl_entrylist($set_select, $set_select_like, $set_orderby, $tmp_per_page, $tmp_offset);

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
    public function select_cl_entrylist($set_select, $set_select_like, $set_orderby, $tmp_per_page, $tmp_offset=0)
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

    /**
     * 案件情報レコード「tb_project」：新規作成
     *
     * @param    int
     * @return    bool
     */
    public function create_project($get_en_id)
    {

        // 案件申請情報の取得
        $get_data = $this->get_entry($get_en_id);

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
                'pj_status'            => $tmp_status,                        // ステータス：0=>準備中
                'pj_entry_status'      => $tmp_entry_status,                // エントリーステータス：0=>エントリーなし
                'pj_work_status'       => $tmp_work_status,                    // ライター作業ステータス：0=>投稿なし
                'pj_mm_rank_id'        => $tmp_mm_rank_id,                    // 会員ランク指定：1=>ブロンズ
                'pj_taa_difficulty_id' => $tmp_diff_id,                        // 難易度(単価加算)指定：1=>ふつう
                'pj_limit_time'        => $tmp_posting_time,                // ライター投稿制限時間
                'pj_order_title'       => $get_data[0]['en_entry_title'],
                'pj_genre01'           => $get_data[0]['en_genre01'],
                'pj_title'             => $get_data[0]['en_title'],
                'pj_work'              => $get_data[0]['en_work'],
                'pj_notice'            => $get_data[0]['en_notice'],
                'pj_example'           => $get_data[0]['en_example'],
                'pj_other'             => $get_data[0]['en_other'],
                'pj_addwork'           => $get_data[0]['en_addwork'],
                'pj_word_tanka'        => $get_data[0]['en_word_tanka'],
                'pj_start_time'        => $get_data[0]['en_open_date'],
                'pj_end_time'          => $get_data[0]['en_delivery_date'],
                'pj_delivery_time'     => $get_data[0]['en_delivery_date'],
                'pj_en_id'             => $get_data[0]['en_id'],
                'pj_en_cl_id'          => $get_data[0]['en_cl_id'],
                'pj_en_entry_date'     => $get_data[0]['en_entry_date'],
                'pj_en_delivery_date'  => $get_data[0]['en_delivery_date'],
        );

        $this->load->model('Project', 'pj', TRUE);
        $get_pj_id = $this->pj->insert_project($values);

        return $get_pj_id;

    }


    /**
     * 案件個別情報レコード「tb_project_info」：新規作成
     *
     * @param    int
     * @return    bool
     */
    public function create_project_info($get_en_id, $get_pj_id)
    {

        $this->load->model('Project', 'pj', TRUE);

        // 案件申請情報1～3の取得
        $get_data = $this->get_entry_info($get_en_id, NULL, TRUE);

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
                        'pji_status'  => $tmp_status,                        // 原稿作成中
                        'pji_work'    => $get_data[$num]['ei_work'],
                        'pji_notice'  => $get_data[$num]['ei_notice'],
                        'pji_example' => $get_data[$num]['ei_example'],
                        'pji_other'   => $get_data[$num]['ei_other'],
                        'pji_addwork' => $get_data[$num]['ei_addwork'],
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
                        $pre_key = str_replace("ei_", "rep_", $key);            // $prefix::「rep_」に置き換え

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
                unset($values["rep_en_id"]);
                unset($values["rep_en_cl_id"]);
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
