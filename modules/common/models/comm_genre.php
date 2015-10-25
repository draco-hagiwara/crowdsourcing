<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Comm_genre extends CI_Model
{

    //public function __construct()
    //{
    //    parent::__construct();
    //
    //}

	/**
	 * ジャンル 選択項目セット
	 *
	 * @return	array()
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

}

