<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    // 重複データのチェック：ログインID（メールアドレス）
<<<<<<< HEAD
    /*
     * ADMIN管理者は クライアント登録(tb_client) の クライアントID(cl_id)=='1' 固定とする。
     */
    public function check_LoginID($loginid)
    {

    	$sql = 'SELECT * FROM `tb_client` '
    			. 'WHERE `cl_email` = ? '
    			. 'AND `cl_id` = ? ';

    	$values = array(
    			$loginid,
    			'1',
=======
    public function check_LoginID($loginid)
    {

    	$sql = 'SELECT * FROM `tb_admin` '
    			. 'WHERE `ad_email1` = ? ';

    	$values = array(
    			$loginid,
>>>>>>> 778364b11983b8ecd0f1ae7ce60860e34a1a71c4
    	);

    	$query = $this->db->query($sql, $values);

    	if ($query->num_rows() > 0)
    	{
    		return TRUE;
    	} else {
    		return FALSE;
    	}
    }

	// ADMIN登録
    public function insert_Admin($setData)
    {

    	// データ追加
<<<<<<< HEAD
    	//$result = $this->db->insert('tb_admin', $setData);
		//return $result;
=======
    	$result = $this->db->insert('tb_admin', $setData);
		return $result;
>>>>>>> 778364b11983b8ecd0f1ae7ce60860e34a1a71c4
    }

    /**
     * ログイン日時の更新
     *
     * @param	bigint
     * @return	bool
     */
    public function update_Logindate($cl_id)
    {

    	$time = time();
    	$setData = array(
<<<<<<< HEAD
    			'cl_lastlogin' => date("Y-m-d H:i:s", $time)
    	);
    	$where = array(
    			'cl_id' => $cl_id
    	);
    	$result = $this->db->update('tb_client', $setData, $where);
=======
    			'ad_lastlogin' => date("Y-m-d H:i:s", $time)
    	);
    	$where = array(
    			'ad_id' => $cl_id
    	);
    	$result = $this->db->update('tb_admin', $setData, $where);
>>>>>>> 778364b11983b8ecd0f1ae7ce60860e34a1a71c4
    	return $result;
    }


}
