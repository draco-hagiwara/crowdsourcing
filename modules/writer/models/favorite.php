<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Favorite extends CI_Model
{

    //public function __construct()
    //{
    //    parent::__construct();
    //
    //}

    /**
     * 気になるリスト＆件数を取得
     *
     * @param    array() : 検索項目値
     * @param    int     : 1ページ当たりの表示件数(LIMIT値)
     * @param    int     : オフセット値(ページ番号)
     * @return    array()
     */
    public function get_favist($set_data, $tmp_per_page, $tmp_offset=0)
    {

        // 各SQL項目へセット
        // WHERE
        $set_select["fa_wr_id"]          = $set_data['fa_wr_id'];

        // 対象リストの取得
        $favorite_list = $this->select_favist($set_select, $set_select_like=NULL, $tmp_per_page, $tmp_offset);

        return $favorite_list;

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
    public function select_favist($set_select, $set_select_like, $tmp_per_page, $tmp_offset=0)
    {

        $sql  = 'SELECT * FROM `tb_favorite` ';
        $sql .= ' WHERE `fa_wr_id`   = ' . $set_select["fa_wr_id"];                    // ライターID
        $sql .= '   AND `fa_del_flg` = 0';                                            // 削除フラグ
        $sql .= ' ORDER BY fa_create_date DESC';                                    // 「作成日時」降順

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
     * 気になるリスト情報：新規レード作成 & 更新
     *
     * @param    int()
     * @param    int()
     * @param    array()
     * @return    boolean
     */
    public function insert_favorite($wr_id, $pj_id, $post_data)
    {

           // 各SQL項目へセット
        $sql = 'INSERT INTO `tb_favorite` ';
        $sql .= ' (`fa_wr_id`, `fa_pj_id`, `fa_pj_title`, `fa_pj_mm_rank_id`, `fa_pj_taa_difficulty_id`, `fa_wi_word_tanka`, `fa_pj_char_cnt`, `fa_pj_start_time`, `fa_pj_end_time`) ';
        $sql .= ' VALUES ( ';
        $sql .= "'" . $wr_id . "','" . $pj_id . "','" . $post_data['pj_title'] . "','" . $post_data['pj_mm_rank_id'] . "','" . $post_data['pj_taa_difficulty_id'] . "','" . $post_data['wi_word_tanka'] . "','" . $post_data['pj_char_cnt'] . "','" . $post_data['pj_start_time'] . "','" . $post_data['pj_end_time'] . "'";
        $sql .= ' ) ';
        $sql .= ' ON DUPLICATE KEY UPDATE ';
        $sql .= "fa_pj_title='" . $post_data['pj_title'] . "',fa_pj_mm_rank_id='" . $post_data['pj_mm_rank_id'] . "',fa_pj_taa_difficulty_id='" . $post_data['pj_taa_difficulty_id'] . "',fa_wi_word_tanka='" . $post_data['wi_word_tanka'] . "',fa_pj_char_cnt='" . $post_data['pj_char_cnt'] . "',fa_pj_start_time='" . $post_data['pj_start_time'] . "',fa_pj_end_time='" . $post_data['pj_end_time'] . "'";

        // クエリー実行
        $result = $this->db->query($sql);

        return $result;

    }

    /**
     * 気になるリスト情報：削除
     *
     * @param    int
     * @return    array()
     */
    public function delete_favorite($set_data)
    {

        $where = array(
                'fa_wr_id' => $set_data['fa_wr_id'],
                'fa_pj_id' => $set_data['fa_pj_id'],
        );

        $result = $this->db->delete('tb_favorite', $where);

        return $result;

    }

}

