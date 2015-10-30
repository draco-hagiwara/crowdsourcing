<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Writer extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

	/**
	 * クライアント新規会員登録
	 *
	 * @param	array
	 * @return	bool
	 */
    public function insert_Writer($setData)
    {

    	// データ追加
    	$result = $this->db->insert('tb_writer', $setData);
		return $result;
    }

    /**
     * 再発行パスワードの更新
     *
     * @param	varchar
     * @param	varchar
     * @param	bigint
     * @return	bool
     */
    public function update_Repasswd($wr_email, $wr_password, $wr_id = NULL)
    {

    	$time = time();

    	if (isset($wr_id)) {
    		// 既存レコード読み込み
    		$arrData = $this->exist_WriterID($wr_id);
    		foreach ($arrData as $r) {
    			$wr_tmp_password = $r['wr_tmp_password'];
    		}

    		// パスワード更新
    		$setData = array(
    				'wr_password'     => $wr_tmp_password,
    				'wr_tmp_password' => NULL,
    				'wr_tmp_pwkey'    => NULL,
    				'wr_tmp_pwtime'   => NULL,
    				'wr_update_date'  => date("Y-m-d H:i:s", $time),
    		);
    		$where = array(
    				'wr_id' => $wr_id
    		);
    	} else {
    		// 仮パスワード更新
    		$randID = $this->_makeRandStr();										// ランダム文字列の生成

	    	$setData = array(
	    			'wr_tmp_password' => password_hash($wr_password, PASSWORD_DEFAULT),
	    			'wr_tmp_pwkey'    => $randID,
	    			'wr_tmp_pwtime'   => date("Y-m-d H:i:s", $time),
	    	);
			$where = array(
						'wr_email' => $wr_email
			);
    	}

		$result = $this->db->update('tb_writer', $setData, $where);
    	return $result;
    }

    /**
     * ログイン日時の更新
     *
     * @param	bigint
     * @return	bool
     */
    public function update_Logindate($wr_id)
    {

    	$time = time();
    	$setData = array(
    			'wr_lastlogin' => date("Y-m-d H:i:s", $time)
    	);
    	$where = array(
    			'wr_id' => $wr_id
    	);
    	$this->db->update('tb_writer', $setData, $where);
    	return $result;
    }

    /**
     * パスワードの更新
     *
     * @param	bigint
     * @param	varchar
     * @return	bool
     */
    public function update_Password($wr_id, $wr_password)
    {

    	$time = time();
    	$setData = array(
    			'wr_password'     => $wr_password,
    			'wr_tmp_password' => NULL,
    			'wr_tmp_pwkey'    => NULL,
    			'wr_tmp_pwtime'   => NULL,
    			'wr_update_date'  => date("Y-m-d H:i:s", $time),
    	);
    	$where = array(
    			'wr_id' => $wr_id
    	);
    	$result = $this->db->update('tb_writer', $setData, $where);
    	return $result;
    }

	/**
	 * ログイン・チェック：ログインID（メールアドレス）＆パスワード
	 *
	 * @param	varchar
	 * @return	array
	 */
	public function exist_LoginID($loginid)
    {
    	$where = array(
    			'wr_email' => $loginid,
    	);
    	$query = $this->db->get_where('tb_writer', $where);

    	if ($query->num_rows() == 0) {
    		return array();
    	} else {
    		$result = $query->result('array');
    		return $result;
    	}
    }

    /**
     * ライターID・チェック
     *
     * @param	varchar
     * @return	array
     */
    public function exist_WriterID($wrid)
    {
    	$where = array(
    			'wr_id' => $wrid,
    	);
    	$query = $this->db->get_where('tb_writer', $where);

    	if ($query->num_rows() == 0) {
    		return array();
    	} else {
    		$result = $query->result('array');
    		return $result;
    	}
    }

	/**
	 * 重複データのチェック：ログインID（メールアドレス）
	 *
	 * @param	varchar
	 * @return	bool
	 */
    public function duplicate_LoginID($loginid)
    {

    	$sql = 'SELECT * FROM `tb_writer` '
    			. 'WHERE `wr_email` = ? ';

    	$values = array(
    			$loginid
    	);

    	$query = $this->db->query($sql, $values);

    	if ($query->num_rows() >= 1) {
    		return TRUE;
    	} else {
    		return FALSE;
    	}
    }

    /**
     * ランダム文字列の生成
     *
     * @return	varchar
     */
    private function _makeRandStr($length = 15)
    {

	    static $chars;
	    if (!$chars) {
	        $chars = array_flip(array_merge(
	            range('a', 'z'), range('A', 'Z'), range('0', '9')
	        ));
	    }

	    $str = '';
	    for ($i = 0; $i < $length; ++$i) {
	        $str .= array_rand($chars);
	    }
	    return $str;

    }

}
