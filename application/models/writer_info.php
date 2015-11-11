<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Writer_info extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }


	/**
	 * エントリー有無のチェック
	 *
	 * @param	int
	 * @return	boolen
	 */
	public function check_entry($wr_id)
    {

		$sql = 'SELECT * FROM `tb_writer_info` '
					. 'WHERE `wi_wr_id` = ? '
					. ' AND  `wi_pj_entry_status` = ? ';

		$values = array(
				$wr_id,
				1,
		);

		$query = $this->db->query($sql, $values);

		// チェック
		if ($query->num_rows() >= 1) {
			return TRUE;
		} else {
			return FALSE;
		}

    }

    /**
     * ライター個別情報：新規レード作成
     *
     * @param	array()
     * @return	int
     */
    public function insert_writer_info($values)
    {

    	// INSERT
    	$result = $this->db->insert('tb_writer_info', $values);

    	// 「ライター個別ID['wi_id']」を取得
    	$sql = 'SELECT LAST_INSERT_ID()';
    	$query = $this->db->query($sql);
    	$get_wi_id = $query->result('array');

    	// 追加された「ライター個別ID」を返す
    	return $get_wi_id;

    }

}
