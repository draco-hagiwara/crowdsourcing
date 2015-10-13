<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Client extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    // 重複データのチェック：ログインID（メールアドレス）
    public function check_LoginID($loginid)
    {

    	$sql = 'SELECT * FROM `tb_client` '
    			. 'WHERE `cl_email1` = ? ';

    	$values = array(
    			$loginid,
    	);

    	$query = $this->db->query($sql, $values);

    	if ($query->num_rows() > 0) {
    		return TRUE;
    	} else {
    		return FALSE;
    	}
    }

	// クライアント新規会員登録
    public function insert_Client($setData)
    {

    	// データ追加
    	$result = $this->db->insert('tb_client', $setData);
		return $result;
    }








}
