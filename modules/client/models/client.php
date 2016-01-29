<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Client extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * 更新対象クライアント・個別情報の取得
     *
     * @param    int
     * @return   array()
     */
    public function get_client_info($tmp_clientid)
    {

        // 各SQL項目へセット :: JOIN 個別情報
        $sql = 'SELECT * FROM tb_client AS cl JOIN tb_client_info AS ci ON cl.cl_id = ci.ci_cl_id';
        $sql .= ' WHERE cl.cl_id = ' . $tmp_clientid;
        $sql .= '   AND cl.cl_del_flg = 0';

        // クエリー実行
        $query = $this->db->query($sql);
        $get_client_info = $query->result('array');

        return $get_client_info;

    }

    /**
     * クライアント・個別(契約)情報の取得
     *
     * @param    int
     * @return   array()
     */
    public function get_client_contract($tmp_clientid)
    {

    	// 各SQL項目へセット :: JOIN 個別情報
    	$sql = 'SELECT * FROM tb_client_info';
    	$sql .= ' WHERE ci_cl_id = ' . $tmp_clientid;

    	// クエリー実行
    	$query = $this->db->query($sql);
    	$get_client_info = $query->result('array');

    	return $get_client_info;

    }

    /**
     * 更新対象クライアント・メンバー情報の取得
     *
     * @param    int
     * @return   array()
     */
    public function get_client_memlist($tmp_clientid)
    {

        // 各SQL項目へセット :: JOIN 個別情報
        $sql = 'SELECT * FROM tb_client_mem';
        $sql .= ' WHERE cm_cl_id   = ' . $tmp_clientid;
        $sql .= '   AND cm_del_flg = 0';
        $sql .= ' ORDER BY cm_mem_id ASC';

        //$sql = 'SELECT * FROM tb_client AS cl JOIN tb_client_mem AS cm ON cl.cl_id = cm.cm_cl_id';
        //$sql .= ' WHERE cl.cl_id = ' . $tmp_clientid;
        //$sql .= '   AND cl.cl_del_flg = 0';
        //$sql .= '   AND cm.cm_del_flg = 0';
        //$sql .= ' ORDER BY cm.cm_mem_id ASC';

        // クエリー実行
        $query = $this->db->query($sql);
        $get_client_mem = $query->result('array');

        return $get_client_mem;

    }

    /**
     * 更新対象クライアント・メンバー個別情報の取得
     *
     * @param    int
     * @param    int
     * @return   array()
     */
    public function get_client_member($tmp_memid, $tmp_clientid)
    {

        // 各SQL項目へセット :: JOIN 個別情報
        $sql = 'SELECT * FROM tb_client AS cl JOIN tb_client_mem AS cm ON cl.cl_id = cm.cm_cl_id';
        $sql .= ' WHERE cl.cl_id = ' . $tmp_clientid;
        $sql .= '   AND cm.cm_mem_id = ' . $tmp_memid;
        $sql .= '   AND cl.cl_del_flg = 0';
        $sql .= '   AND cm.cm_del_flg = 0';

        // クエリー実行
        $query = $this->db->query($sql);
        $get_client_mem = $query->result('array');

        return $get_client_mem;

    }


    /**
     * 獲得ポイント＆支払一覧を取得
     *
     * @param    array() : 検索項目値
     * @param    int     : 1ページ当たりの表示件数(LIMIT値)
     * @param    int     : オフセット値(ページ番号)
     * @return   array()
     */
    public function get_paylist($arr_post, $tmp_per_page, $tmp_offset=0)
    {

    	// 各SQL項目へセット
    	// WHERE
    	$set_select["cp_cl_id"] = $arr_post['cp_cl_id'];

    	// 対象クライアントメンバーの取得
    	$pay_list = $this->select_paylist($set_select, $tmp_per_page, $tmp_offset);

    	return $pay_list;

    }

    /**
     * 支払情報のリスト＆件数を取得
     *
     * @param    array() : WHERE句項目
     * @param    int     : 1ページ当たりの表示件数
     * @param    int     : オフセット値(ページ番号)
     * @return   array()
     */
    public function select_paylist($set_select, $tmp_per_page, $tmp_offset=0)
    {

    	$sql  = 'SELECT * FROM `tb_client_pay` ';
    	$sql .= ' WHERE `cp_cl_id` = ' . $set_select['cp_cl_id'];
   		$sql .= ' ORDER BY cp_pay_date DESC';

    	// 対象全件数を取得
    	$query = $this->db->query($sql);
    	$pay_countall = $query->num_rows();

    	// LIMIT ＆ OFFSET 値をセット
    	$sql .= ' LIMIT ' . $tmp_per_page . ' OFFSET ' . $tmp_offset;

    	// クエリー実行
    	$query = $this->db->query($sql);
    	$pay_list = $query->result('array');

    	return array($pay_list, $pay_countall);
    }


    // クライアント新規会員登録
    public function insert_Client($setData)
    {

        // データ追加
        $result = $this->db->insert('tb_client', $setData);
        return $result;
    }

    // クライアント新規会員登録
    public function insert_client_member($setData)
    {

        // データ追加
        $result = $this->db->insert('tb_client_mem', $setData);
        return $result;
    }

    /**
     * 1レコード更新 (tb_client)
     *
     * @param    array()
     * @return   bool
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
     * 1レコード更新 (tb_client_mem)
     *
     * @param    array()
     * @return   bool
     */
    public function update_client_mem($set_data)
    {

        // 更新日時をセット
        $time = time();
        $set_data['cm_update_date'] = date("Y-m-d H:i:s", $time);

        $where = array(
                'cm_mem_id' => $set_data['cm_mem_id'],
                'cm_cl_id'  => $set_data['cm_cl_id'],
        );

        $result = $this->db->update('tb_client_mem', $set_data, $where);
        return $result;
    }

    /**
     * ログイン日時の更新
     *
     * @param    bigint
     * @return   bool
     */
    public function update_Logindate($cm_mem_id)
    {

        $time = time();
        $setData = array(
                'cm_login_date' => date("Y-m-d H:i:s", $time)
        );
        $where = array(
                'cm_mem_id' => $cm_mem_id
        );
        $result = $this->db->update('tb_client_mem', $setData, $where);
        return $result;
    }

    /**
     * 重複データのチェック：ログインID（メールアドレス）
     *
     * @param    varchar
     * @return   bool
     */
    public function check_LoginID($loginid)
    {

        $sql = 'SELECT * FROM `tb_client_mem` '
                . 'WHERE `cm_login` = ? '
                . 'AND `cm_del_flg` = 0 ';

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
