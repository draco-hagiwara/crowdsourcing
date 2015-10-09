<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Writer extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    // 重複データのチェック：ログインID（メールアドレス）
    public function check_LoginID($loginid)
    {

    	$sql = 'SELECT * FROM `tb_writer` '
    			. 'WHERE `wr_email` = ? ';

    	$values = array(
    			$loginid
    	);

    	$query = $this->db->query($sql, $values);

    	if ($query->num_rows() > 0) {
    		return TRUE;
    	} else {
    		return FALSE;
    	}
    }

	// クライアント新規会員登録
    public function insert_Writer($setData)
    {

    	// データ追加
    	$result = $this->db->insert('tb_writer', $setData);
		return $result;
    }

}
