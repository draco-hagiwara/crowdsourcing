<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Report_info extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }


    /**
     * 個別投稿情報を取得
     *
     * @param    int
     * @param    int
     * @return    array()
     */
    public function get_report_data($pji_id, $pji_seq)
    {

        $set_where["rep_pji_pj_id"] = $pji_id;
        $set_where["rep_pji_seq"]   = $pji_seq;

        $query = $this->db->get_where('tb_report_info', $set_where);

        $get_data = $query->result('array');

        return $get_data;

    }

    /**
     * 指定された最小文字数カウント
     *
     * @param    int
     * @return    array()
     */
    public function get_word_cnt($pj_id)
    {

        // 最小文字数の合計(タイトル+本文)を取得
        $sql  = 'SELECT SUM(rep_t_char_min), SUM(rep_b_char_min) FROM tb_report_info';
        $sql .= ' WHERE rep_pji_pj_id = ' . $pj_id;
        $sql .= ' GROUP BY rep_pji_pj_id';

        $query = $this->db->query($sql);
        $word_cnt = $query->result('array');

        return $word_cnt[0];

    }

    /**
     * 1レコード更新>投稿記事個別ID :: 案件内容
     *
     * @param    array()
     * @return    bool
     */
    public function update_reportinfo($set_data)
    {

        // 更新日時をセット
        $time = time();
        $set_data['rep_update_date'] = date("Y-m-d H:i:s", $time);

        $where = array(
                'rep_pji_pj_id' => $set_data['rep_pji_pj_id']
        );

        $result = $this->db->update('tb_report_info', $set_data, $where);
        return $result;
    }

    /**
     * 1レコード更新>rep_pji_seq :: 個別投稿内容
     *
     * @param    array()
     * @param    int
     * @param    boolean
     * @return    boolean
     */
    public function update_entryinfo($set_data, $pj_id, $rep_seq)
    {

        $time = time();

        // 更新日時をセット
        $set_data['rep_update_date'] = date("Y-m-d H:i:s", $time);

        $where = array(
                'rep_pji_pj_id' => $pj_id,
                'rep_pji_seq'   => $rep_seq,
        );

        $result = $this->db->update('tb_report_info', $set_data, $where);
        return $result;
    }

}
