<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    // 重複データのチェック：ログインID（メールアドレス）
    public function check_LoginID($loginid)
    {

    	$sql = 'SELECT * FROM `tb_admin` '
    			. 'WHERE `ad_email1` = ? ';

    	$values = array(
    			$loginid,
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
    	$result = $this->db->insert('tb_admin', $setData);
		return $result;
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
    			'ad_lastlogin' => date("Y-m-d H:i:s", $time)
    	);
    	$where = array(
    			'ad_id' => $cl_id
    	);
    	$result = $this->db->update('tb_admin', $setData, $where);
    	return $result;
    }


}
