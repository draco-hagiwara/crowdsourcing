<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Comm_select extends CI_Model
{

    //public function __construct()
    //{
    //    parent::__construct();
    //
    //}

    /**
     * ジャンル 選択項目セット
     *
     * @return    array()
     */
    public function get_genre()
    {

        // DB読み込み
        $query = $this->db->get('mb_genre');

        $genre_list = array();
        foreach ($query->result_array() as $row)
        {
            $genre_list += array($row['mg_genre_id'] => $row['mg_genre_name']);
        }

        return $genre_list;
    }

    /**
     * 会員ランク 選択項目セット
     *
     * @return    array()
     */
    public function get_memrank()
    {

        // DB読み込み
        $query = $this->db->get('mb_memberrank');

        $memrank_list = array();
        foreach ($query->result_array() as $row)
        {
            $memrank_list += array($row['mm_rank_id'] => $row['mm_rank_name']);
        }

        return $memrank_list;
    }

    /**
     * 加算単価情報 難易度セット
     *
     * @param    int
     * @return    array()
     */
    public function get_tankaadd($cl_id)
    {

        // DB読み込み
        $this->db->where('taa_cl_id', $cl_id);
        $query = $this->db->get('tb_tankaadd');

        $tankaadd_list = array();
        foreach ($query->result_array() as $row)
        {
            $tankaadd_list += array($row['taa_difficulty_id'] => $row['taa_price']);
        }

        return $tankaadd_list;
    }

}

