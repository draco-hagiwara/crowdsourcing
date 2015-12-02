<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Client extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * 更新対象クライアントメンバーの取得
     *
     * @param	int
     * @return	array()
     */
    public function select_client_id($tmp_clientid)
    {

    	// 各SQL項目へセット :: JOIN 個別情報
    	$sql = 'SELECT * FROM tb_client AS cl JOIN tb_client_info AS ci ON cl.cl_id = ci.ci_cl_id';
    	$sql .= ' WHERE cl.cl_id = ' . $tmp_clientid;

    	// クエリー実行
    	$query = $this->db->query($sql);
    	$get_client_info = $query->result('array');

    	return $get_client_info;

    }

	// クライアント新規会員登録
    public function insert_Client($setData)
    {

    	// データ追加
    	$result = $this->db->insert('tb_client', $setData);
		return $result;
    }

    /**
     * 1レコード更新 (tb_client)
     *
     * @param	array()
     * @return	bool
     */
    public function update_Client($set_data)
    {

    	// 更新日時をセット
    	$time = time();
    	$set_data['cl_update_date'] = date("Y-m-d H:i:s", $time);

    	$where = array(
    			'cl_id' => $set_data['cl_id']
    	);

    	$result = $this->db->update('tb_client', $set_data, $where);
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
    			'cl_lastlogin' => date("Y-m-d H:i:s", $time)
    	);
    	$where = array(
    			'cl_id' => $cl_id
    	);
    	$result = $this->db->update('tb_client', $setData, $where);
    	return $result;
    }

    /**
     * 重複データのチェック：ログインID（メールアドレス）
     *
     * @param	varchar
     * @return	bool
     */
    public function check_LoginID($loginid)
    {

    	$sql = 'SELECT * FROM `tb_client` '
    			. 'WHERE `cl_email` = ? '
    			. 'AND `cl_del_flg` = 0 ';

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

}
