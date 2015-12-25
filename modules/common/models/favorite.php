<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Favorite extends CI_Model
{

    //public function __construct()
    //{
    //    parent::__construct();
    //
    //}

	/**
	 * 作業エントリー一覧の取得
	 *
	 * @param	int
	 * @return	array()
	 */
	public function get_entry_data($get_pj_id)
	{

		$set_where["pj_id"] = $get_pj_id;

		$query = $this->db->get_where('vw_posting_pj', $set_where);

		$get_data = $query->result('array');

		return $get_data;

	}

	/**
	 * 気になるリスト情報：新規レード作成
	 *
	 * @param	array()
	 * @return	int
	 */
	public function insert_favorite($wr_id, $pj_id, $post_data)
	{

   	// 各SQL項目へセット
    	$sql = 'INSERT INTO `tb_favorite` ';
    	$sql .= ' (`fa_wr_id`, `fa_pj_id`, `fa_pj_title`, `fa_pj_mm_rank_id`, `fa_pj_taa_difficulty_id`, `fa_wi_word_tanka`, `fa_pj_char_cnt`, `fa_pj_start_time`, `fa_pj_end_time`) ';
    	$sql .= ' VALUES ($wr_id, $pj_id, $post_data('pj_title'), $post_data('pj_mm_rank_id'), $post_data('pj_taa_difficulty_id'), $post_data('wi_word_tanka'), $post_data('pj_char_cnt'), $post_data('pj_start_time'), $post_data('pj_end_time')) ';
    	$sql .= ' ON DUPLICATE KEY UPDATE $post_data('pj_title'), $post_data('pj_mm_rank_id'), $post_data('pj_taa_difficulty_id'), $post_data('wi_word_tanka'), $post_data('pj_char_cnt'), $post_data('pj_start_time'), $post_data('pj_end_time')';



    	print($sql);
    	exit;


    	// クエリー実行
    	$result = $this->db->query($sql);

    	return $result;

	}

}

