<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tanka extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * ライター「会員ランク」単価を取得
     *
     * @param    int
     * @param    tinyint
     * @return    array()
     */
    public function get_memtanka($get_cl_id, $rankid)
    {

        $set_where["ta_cl_id"]      = $get_cl_id;
        $set_where["ta_mm_rank_id"] = $rankid;

        $query = $this->db->get_where('tb_tanka', $set_where);

        $get_data = $query->result('array');

        return $get_data[0];

    }

    /**
     * ライター「難易度」単価を取得
     *
     * @param    int
     * @param    tinyint
     * @return    array()
     */
    public function get_difftanka($get_cl_id, $diffid)
    {

        $set_where["taa_cl_id"]         = $get_cl_id;
        $set_where["taa_difficulty_id"] = $diffid;

        $query = $this->db->get_where('tb_tankaadd', $set_where);

        $get_data = $query->result('array');

        return $get_data[0];

    }

    /**
     * 会員ランク単価表を取得
     *
     * @param    int
     * @return    array()
     */
    public function get_tanka($get_cl_id)
    {

        $set_where["ta_cl_id"] = $get_cl_id;

        $query = $this->db->get_where('tb_tanka', $set_where);

        $get_data = $query->result('array');

        return $get_data;

    }

}
