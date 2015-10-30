<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tanka extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * 会員ランク単価を取得
     *
     * @param	int
     * @return	array()
     */
    public function get_tanka($get_cl_id)
    {

    	$set_where["ta_cl_id"] = $get_cl_id;

    	$query = $this->db->get_where('tb_tanka', $set_where);

    	$get_data = $query->result('array');

    	return $get_data;

    }

}
