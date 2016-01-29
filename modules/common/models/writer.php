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
     * @param    array() : 検索項目値
     * @param    int     : 1ページ当たりの表示件数(LIMIT値)
     * @param    int     : オフセット値(ページ番号)
     * @return    array()
     */
    public function get_writerlist($arr_post, $tmp_per_page, $tmp_offset=0)
    {

        // 各SQL項目へセット
        // WHERE
        $set_select["wr_nickname"] = $arr_post['wr_nickname'];
        $set_select["wr_id"]       = $arr_post['wr_id'];
        $set_select["wr_email"]    = $arr_post['wr_email'];
        $set_select["wr_status"]   = $arr_post['wr_status'];
        $set_select["wr_del_flg"]  = 0;

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
     * 対象クライアントメンバーの取得
     *
     * @param    array() : WHERE句項目
     * @param    array() : ORDER BY句項目
     * @param    int     : 1ページ当たりの表示件数
     * @param    int     : オフセット値(ページ番号)
     * @return    array()
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
     * アドミン：ライター入金一覧の取得
     *
     * @param    array() : 検索項目値
     * @param    int     : 1ページ当たりの表示件数(LIMIT値)
     * @param    int     : オフセット値(ページ番号)
     * @return   array()
     */
    public function get_paywrlist($arr_post, $tmp_per_page, $tmp_offset=0)
    {

    	// 各SQL項目へセット
    	// WHERE
    	$set_select["wp_wr_id"]        = $arr_post['wp_wr_id'];
    	$set_select["wp_status"]       = $arr_post['wp_status'];
    	$set_select_btw["pay_date_st"] = $arr_post['pay_date_st'];
    	$set_select_btw["pay_date_ed"] = $arr_post['pay_date_ed'];

    	// 対象クライアントメンバーの取得
    	$writer_list = $this->select_paywrlist($set_select, $set_select_btw, $tmp_per_page, $tmp_offset);

    	return $writer_list;

    }

    /**
     * アドミン：ライター入金一覧の取得
     *
     * @param    array() : WHERE句項目
     * @param    array() : ORDER BY句項目
     * @param    int     : 1ページ当たりの表示件数
     * @param    int     : オフセット値(ページ番号)
     * @return   array()
     */
    public function select_paywrlist($set_select, $set_select_btw, $tmp_per_page, $tmp_offset=0)
    {

    	$sql  = 'SELECT * FROM `tb_writer_pay` ';
    	$sql .= ' WHERE `wp_id` >= 0';

    	// WHERE文 作成
    	foreach ($set_select as $key => $val)
    	{
    		if ($val != "")
    		{
    			$sql .= ' AND ' . $key . ' = ' . $this->db->escape_like_str($val);
    		}
    	}

    	// WHERE-between文 作成
    	if ($set_select_btw["pay_date_st"] != null)
    	{
    		$sql .= ' AND wp_pay_date >= \'' . str_replace('/', '', $set_select_btw["pay_date_st"]) . '\'';
    	}
    	if ($set_select_btw["pay_date_ed"] != null)
    	{
    		$sql .= ' AND wp_pay_date <= \'' . str_replace('/', '', $set_select_btw["pay_date_ed"]) . '\'';
    	}

    	// ORDER BY文 作成
    	$sql .= ' ORDER BY wp_status ASC, wp_pay_date DESC';

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
     * ライター・入金情報の取得
     *
     * @param    int
     * @param    int
     * @return   array()
     */
    public function get_writer_pay($tmp_wpid)
    {

    	// 各SQL項目へセット
    	$sql = 'SELECT * FROM tb_writer_pay';
    	$sql .= ' WHERE wp_id = ' . $tmp_wpid;

    	// クエリー実行
    	$query = $this->db->query($sql);
    	$get_writer_pay = $query->result('array');

    	return $get_writer_pay;

    }


    /**
     * 更新対象ライターの取得
     *
     * @param    int
     * @return    array()
     */
    public function select_writer_id($tmp_writerid)
    {

    	// 各SQL項目へセット
    	$sql = 'SELECT * FROM `tb_writer` ';
    	$sql .= ' WHERE wr_id = ' . $tmp_writerid;
    	$sql .= ' AND wr_del_flg = 0';

    	// クエリー実行
    	$query = $this->db->query($sql);
    	$get_writer_info = $query->result('array');

    	return $get_writer_info;

    }

    /**
     * ライター新規会員登録
     *
     * @param    array
     * @return    bool
     */
    public function insert_Writer($setData)
    {

        // データ追加
        $result = $this->db->insert('tb_writer', $setData);
        return $result;
    }

    // ライター入金情報登録
    public function insert_writer_pay($setData)
    {

    	// データ追加
    	$result = $this->db->insert('tb_writer_pay', $setData);
    	return $result;
    }

    /**
     * 再発行パスワードの更新
     *
     * @param    varchar
     * @param    varchar
     * @param    bigint
     * @return    bool
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
                    'wr_id' => $wr_id,
                    'wr_del_flg' => 0,
            );
        } else {
            // 仮パスワード更新
            $randID = $this->_makeRandStr();                                        // ランダム文字列の生成

            $setData = array(
                    'wr_tmp_password' => password_hash($wr_password, PASSWORD_DEFAULT),
                    'wr_tmp_pwkey'    => $randID,
                    'wr_tmp_pwtime'   => date("Y-m-d H:i:s", $time),
            );
            $where = array(
                    'wr_email' => $wr_email,
                    'wr_del_flg' => 0,
            );
        }

        $result = $this->db->update('tb_writer', $setData, $where);
        return $result;
    }

    /**
     * 1レコード更新
     *
     * @param    array()
     * @return    bool
     */
    public function update_Writer($set_data)
    {

        // 更新日時をセット
        $time = time();
        $set_data['wr_update_date'] = date("Y-m-d H:i:s", $time);

        $where = array(
                'wr_id' => $set_data['wr_id'],
                'wr_del_flg' => 0,
        );

        $result = $this->db->update('tb_writer', $set_data, $where);
        return $result;
    }


    /**
     * 1レコード更新 :: 投稿記事 <= 審査OK
     *
     * @param    array()
     * @return    bool
     */
    public function update_wr_posting($set_data)
    {

        $where = array(
                'wr_id' => $set_data['wr_id'],
                'wr_del_flg' => 0,
        );

        $result = $this->db->update('tb_writer', $set_data, $where);
        return $result;
    }

    /**
     * 1レコード更新 (tb_writer_pay)
     *
     * @param    array()
     * @return   bool
     */
    public function update_writer_pay($set_data)
    {

    	// 更新日時をセット
    	$time = time();
    	$set_data['wp_update_date'] = date("Y-m-d H:i:s", $time);

    	$where = array(
    			'wp_id' => $set_data['wp_id'],
    	);

    	$result = $this->db->update('tb_writer_pay', $set_data, $where);
    	return $result;
    }

    /**
     * ログイン日時の更新
     *
     * @param    bigint
     * @return    bool
     */
    public function update_Logindate($wr_id)
    {

        $time = time();
        $setData = array(
                'wr_lastlogin' => date("Y-m-d H:i:s", $time)
        );
        $where = array(
                'wr_id' => $wr_id,
                'wr_del_flg' => 0,
        );
        $this->db->update('tb_writer', $setData, $where);
        return $result;
    }

    /**
     * パスワードの更新
     *
     * @param    bigint
     * @param    varchar
     * @return    bool
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
                'wr_id' => $wr_id,
                'wr_del_flg' => 0,
        );
        $result = $this->db->update('tb_writer', $setData, $where);
        return $result;
    }

    /**
     * ログイン・チェック：ログインID（メールアドレス）＆パスワード
     *
     * @param    varchar
     * @return    array
     */
    public function exist_LoginID($loginid)
    {
        $where = array(
                'wr_email' => $loginid,
                'wr_del_flg' => 0,
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
     * @param    varchar
     * @return    array
     */
    public function exist_WriterID($wrid)
    {
        $where = array(
                'wr_id' => $wrid,
                'wr_del_flg' => 0,
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
     * @param    bigint
     * @param    bool         :: FALSE => 新規登録時, 更新時使用。
     * @return    bool
     */
    public function duplicate_LoginID($loginid, $update = FALSE)
    {

    	$sql = 'SELECT * FROM `tb_writer` '
    			. 'WHERE `wr_email` = ? '
    					. 'AND `wr_del_flg` = 0 ';

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
     * アドミン：ライター入金一覧の取得
     *
     * @param    array() : 検索項目値
     * @param    int     : 1ページ当たりの表示件数(LIMIT値)
     * @param    int     : オフセット値(ページ番号)
     * @return   array()
     */
    public function get_paywrlist_query($arr_post, $tmp_per_page, $tmp_offset=0)
    {

    	// 各SQL項目へセット
    	// WHERE
    	$set_select["wp_wr_id"]        = $arr_post['wp_wr_id'];
    	$set_select["wp_status"]       = $arr_post['wp_status'];
    	$set_select_btw["pay_date_st"] = substr($arr_post['pay_date_st'],0,7);
    	$set_select_btw["pay_date_ed"] = substr($arr_post['pay_date_ed'],0,7);

    	// クエリー取得
    	$list_query = $this->select_paywrlist_query($set_select, $set_select_btw, $tmp_per_page, $tmp_offset);

    	return $list_query;

    }

    /**
     * アドミン：ライター入金一覧の取得
     *
     * @param    array() : WHERE句項目
     * @param    array() : ORDER BY句項目
     * @param    int     : 1ページ当たりの表示件数
     * @param    int     : オフセット値(ページ番号)
     * @return   array()
     */
    public function select_paywrlist_query($set_select, $set_select_btw, $tmp_per_page, $tmp_offset=0)
    {

    	$sql  = 'SELECT'
    			. ' wp_id AS `支払情報ID`,'
    			. ' wp_wr_id AS `ライターID`,'
    			. ' wp_pay_date AS `入金年月日`,'
    			. ' wp_status AS `入金状況`,'						// 0：未入金、1：入金済、2：保留、3：返金
    			. ' wp_pay_result AS `報酬金額`,'
    			. ' wp_pay_adjust AS `調整金額`,'
    			. ' wp_pay_total AS `入金金額`,'
    			. ' wp_bank_cd AS `銀行CD`,'
    			. ' wp_bk_no AS `口座番号`'
    	;
    	$sql .= ' FROM `tb_writer_pay` WHERE `wp_id` >= 0';

    	// WHERE文 作成
    	foreach ($set_select as $key => $val)
    	{
    		if ($val != "")
    		{
    			$sql .= ' AND ' . $key . ' = ' . $this->db->escape_like_str($val);
    		}
    	}

    	// WHERE-between文 作成
    	if ($set_select_btw["pay_date_st"] != null)
    	{
    		$sql .= ' AND wp_pay_date >= \'' . str_replace('/', '', $set_select_btw["pay_date_st"]) . '\'';
    	}
    	if ($set_select_btw["pay_date_ed"] != null)
    	{
    		$sql .= ' AND wp_pay_date <= \'' . str_replace('/', '', $set_select_btw["pay_date_ed"]) . '\'';
    	}

    	// ORDER BY文 作成
    	$sql .= ' ORDER BY wp_status ASC, wp_wr_id ASC, wp_pay_date DESC';

    	// 対象全件数を取得
    	//$query = $this->db->query($sql);
    	//$writer_countall = $query->num_rows();

    	// LIMIT ＆ OFFSET 値をセット
    	$sql .= ' LIMIT ' . $tmp_per_page . ' OFFSET ' . $tmp_offset;

    	// クエリー実行
    	$query = $this->db->query($sql);

    	return $query;
    }



    /**
     * ランダム文字列の生成
     *
     * @return    varchar
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
