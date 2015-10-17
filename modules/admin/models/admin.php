<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    // 重複データのチェック：ログインID（メールアドレス）
<<<<<<< HEAD
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
=======
    /*
     * ADMIN管理者は クライアント登録(tb_client) の クライアントID(cl_id)=='1' 固定とする。
     */
>>>>>>> develop
    public function check_LoginID($loginid)
    {

    	$sql = 'SELECT * FROM `tb_client` '
    			. 'WHERE `cl_email` = ? '
    			. 'AND `cl_id` = ? ';

    	$values = array(
    			$loginid,
<<<<<<< HEAD
>>>>>>> 778364b11983b8ecd0f1ae7ce60860e34a1a71c4
=======
    			'1',
>>>>>>> develop
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
<<<<<<< HEAD
    	//$result = $this->db->insert('tb_admin', $setData);
		//return $result;
=======
    	$result = $this->db->insert('tb_admin', $setData);
		return $result;
>>>>>>> 778364b11983b8ecd0f1ae7ce60860e34a1a71c4
=======
    	//$result = $this->db->insert('tb_admin', $setData);
		//return $result;
>>>>>>> develop
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
<<<<<<< HEAD
    			'cl_lastlogin' => date("Y-m-d H:i:s", $time)
    	);
    	$where = array(
    			'cl_id' => $cl_id
    	);
    	$result = $this->db->update('tb_client', $setData, $where);
=======
    			'ad_lastlogin' => date("Y-m-d H:i:s", $time)
=======
    			'cl_lastlogin' => date("Y-m-d H:i:s", $time)
>>>>>>> develop
    	);
    	$where = array(
    			'cl_id' => $cl_id
    	);
<<<<<<< HEAD
    	$result = $this->db->update('tb_admin', $setData, $where);
>>>>>>> 778364b11983b8ecd0f1ae7ce60860e34a1a71c4
=======
    	$result = $this->db->update('tb_client', $setData, $where);
>>>>>>> develop
    	return $result;
    }


}
