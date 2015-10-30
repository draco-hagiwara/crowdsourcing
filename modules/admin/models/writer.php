<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Writer extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * ライターメンバーの取得
     *
     * @param	array() : 検索項目値
     * @param	int     : 1ページ当たりの表示件数(LIMIT値)
     * @param	int     : オフセット値(ページ番号)
     * @return	array()
     */
    public function get_writerlist($arr_post, $tmp_per_page, $tmp_offset=0)
    {

    	// 各SQL項目へセット
    	// WHERE
    	$set_select["wr_nickname"] = $arr_post['wr_nickname'];
    	$set_select["wr_id"]       = $arr_post['wr_id'];
    	$set_select["wr_email"]    = $arr_post['wr_email'];
    	$set_select["wr_status"]   = $arr_post['wr_status'];

    	// ORDER BY
    	if ($arr_post['orderid'] == 'ASC')
    	{
    		$set_orderby["wr_id"] = $arr_post['orderid'];
    	}else {
    		$set_orderby["wr_id"] = 'DESC';
    	}
    	$set_orderby["wr_status"] = $arr_post['orderstatus'];

    	// 対象ライターメンバーの取得
    	$writer_list = $this->select_writerlist($set_select, $set_orderby, $tmp_per_page, $tmp_offset);

    	return $writer_list;

    }

    /**
     * 更新対象ライターの取得
     *
     * @param	int
     * @return	array()
     */
    public function select_writer_id($tmp_writerid)
    {

    	// 各SQL項目へセット
    	$sql = 'SELECT * FROM `tb_writer` ';
    	$sql .= ' WHERE wr_id = ' . $tmp_writerid;

    	// クエリー実行
    	$query = $this->db->query($sql);
    	$get_writer_info = $query->result('array');

    	return $get_writer_info;

    }

    /**
     * 対象クライアントメンバーの取得
     *
     * @param	array() : WHERE句項目
     * @param	array() : ORDER BY句項目
     * @param	int     : 1ページ当たりの表示件数
     * @param	int     : オフセット値(ページ番号)
     * @return	array()
     */
    public function select_writerlist($set_select, $set_orderby, $tmp_per_page, $tmp_offset=0)
    {

    	$sql = 'SELECT * FROM `tb_writer` ';

    	// WHERE文 作成
    	$tmp_firstitem = FALSE;
    	foreach ($set_select as $key => $val)
    	{
    		if (isset($val))
    		{
    			if ($tmp_firstitem == FALSE)
    			{
    				$sql .= ' WHERE ' . $key . ' LIKE \'%' . $this->db->escape_like_str($val) . '%\'';
    				$tmp_firstitem = TRUE;
    			} else {
    				$sql .= ' AND ' . $key . ' LIKE \'%' . $this->db->escape_like_str($val) . '%\'';
    			}
    		}
    	}

    	// ORDER BY文 作成
    	$tmp_firstitem = FALSE;
    	foreach ($set_orderby as $key => $val)
    	{
    		if (isset($val))
    		{
    			if ($tmp_firstitem == FALSE)
    			{
    				$sql .= ' ORDER BY ' . $key . ' ' . $val;
    				$tmp_firstitem = TRUE;
    			} else {
    				$sql .= ' , ' . $key . ' ' . $val;
    			}
    		}
    	}

    	// 対象全件数を取得
    	$query = $this->db->query($sql);
    	$writer_countall = $query->num_rows();

    	// LIMIT ＆ OFFSET 値をセット
    	$sql .= ' LIMIT ' . $tmp_per_page . ' OFFSET ' . $tmp_offset;

    	// クエリー実行
    	$query = $this->db->query($sql);
    	$writer_list = $query->result('array');

    	return array($writer_list, $writer_countall);
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
    				'wr_password' => $wr_tmp_password,
    				'wr_tmp_password' => NULL,
    				'wr_tmp_pwkey' => NULL,
    				'wr_tmp_pwtime' => NULL,
    				'wr_update_date' => date("Y-m-d H:i:s", $time),
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
     * 1レコード更新
     *
     * @param	array()
     * @return	bool
     */
    public function update_Writer($set_data)
    {

    	// 更新日時をセット
    	$time = time();
    	$set_data['wr_update_date'] = date("Y-m-d H:i:s", $time);

    	$where = array(
    			'wr_id' => $set_data['wr_id']
    	);

    	$result = $this->db->update('tb_writer', $set_data, $where);
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
     * @param	bigint
     * @param	bool         :: FALSE => 新規登録時, 更新時使用。
	 * @return	bool
	 */
    public function duplicate_LoginID($loginid, $update = FALSE)
    {

    	$sql = 'SELECT * FROM `tb_writer` '
    			. 'WHERE `wr_email` = ? ';

    	$values = array(
    			$loginid
    	);

    	$query = $this->db->query($sql, $values);

    	if ($update == FALSE)
    	{
    		$count = 1;
    	} else {
    		$count = 2;
    	}

    	if ($query->num_rows() >= $count) {
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
