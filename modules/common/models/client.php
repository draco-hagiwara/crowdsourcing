<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Client extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * メール送信先クライアントの会社名＆メールアドレスを取得
     *
     * @param    int
     * @return   array()
     */
    public function get_client_name($get_cl_id)
    {

        $sql = 'SELECT cl_company, cl_person01, cl_person02, cl_email';
        $sql .= ' FROM tb_client';
        $sql .= ' WHERE cl_id = ' . $get_cl_id;

        // クエリー実行
        $query = $this->db->query($sql);
        $get_client_info = $query->result('array');

        return $get_client_info;

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
     * クライアント・月額支払情報の取得
     *
     * @param    int
     * @param    int
     * @return   array()
     */
    public function get_client_pay($tmp_cpid)
    {

    	// 各SQL項目へセット
    	$sql = 'SELECT * FROM tb_client_pay';
    	$sql .= ' WHERE cp_id = ' . $tmp_cpid;

    	// クエリー実行
    	$query = $this->db->query($sql);
    	$get_client_pay = $query->result('array');

    	return $get_client_pay;

    }


    /**
     * クライアントメンバーの取得
     *
     * @param    array() : 検索項目値
     * @param    int     : 1ページ当たりの表示件数(LIMIT値)
     * @param    int     : オフセット値(ページ番号)
     * @return   array()
     */
    public function get_clientlist($arr_post, $tmp_per_page, $tmp_offset=0)
    {

        // 各SQL項目へセット
        // WHERE
        $set_select["cl_company"] = $arr_post['cl_company'];
        $set_select["cl_id"]      = $arr_post['cl_id'];
        $set_select["cl_email"]   = $arr_post['cl_email'];
        $set_select["cl_status"]  = $arr_post['cl_status'];

        // ORDER BY
        if ($arr_post['orderid'] == 'ASC')
        {
            $set_orderby["cl_id"] = $arr_post['orderid'];
        }else {
            $set_orderby["cl_id"] = 'DESC';
        }
        $set_orderby["cl_status"] = $arr_post['orderstatus'];

        // 対象クライアントメンバーの取得
        $client_list = $this->select_clientlist($set_select, $set_orderby, $tmp_per_page, $tmp_offset);

        return $client_list;

    }

    /**
     * 対象クライアントメンバーの取得
     *
     * @param    array() : WHERE句項目
     * @param    array() : ORDER BY句項目
     * @param    int     : 1ページ当たりの表示件数
     * @param    int     : オフセット値(ページ番号)
     * @return   array()
     */
    public function select_clientlist($set_select, $set_orderby, $tmp_per_page, $tmp_offset=0)
    {

        $sql = 'SELECT * FROM tb_client AS cl JOIN tb_client_info AS ci ON cl.cl_id = ci.ci_cl_id';
        //$sql = 'SELECT * FROM `tb_client` ';

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
        $client_countall = $query->num_rows();

        // LIMIT ＆ OFFSET 値をセット
        $sql .= ' LIMIT ' . $tmp_per_page . ' OFFSET ' . $tmp_offset;

        // クエリー実行
        $query = $this->db->query($sql);
        $client_list = $query->result('array');

        return array($client_list, $client_countall);
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


    /**
     * アドミン：クライアント 請求(支払)一覧の取得
     *
     * @param    array() : 検索項目値
     * @param    int     : 1ページ当たりの表示件数(LIMIT値)
     * @param    int     : オフセット値(ページ番号)
     * @return   array()
     */
    public function get_paycllist($arr_post, $tmp_per_page, $tmp_offset=0)
    {

    	// 各SQL項目へセット
    	// WHERE
    	$set_select["cp_cl_id"]        = $arr_post['cp_cl_id'];
    	$set_select["cp_status"]       = $arr_post['cp_status'];
        $set_select_btw["pay_date_st"] = substr($arr_post['pay_date_st'],0,7);
        $set_select_btw["pay_date_ed"] = substr($arr_post['pay_date_ed'],0,7);

    	// 対象クライアントメンバーの取得
    	$client_list = $this->select_paycllist($set_select, $set_select_btw, $tmp_per_page, $tmp_offset);

    	return $client_list;

    }

    /**
     * アドミン：クライアント 請求(支払)一覧の取得
     *
     * @param    array() : WHERE句項目
     * @param    array() : ORDER BY句項目
     * @param    int     : 1ページ当たりの表示件数
     * @param    int     : オフセット値(ページ番号)
     * @return   array()
     */
    public function select_paycllist($set_select, $set_select_btw, $tmp_per_page, $tmp_offset=0)
    {

    	$sql  = 'SELECT * FROM `tb_client_pay` ';
    	$sql .= ' WHERE `cp_id` >= 0';

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
    		$sql .= ' AND cp_pay_date >= \'' . str_replace('/', '', $set_select_btw["pay_date_st"]) . '\'';
    	}
    	if ($set_select_btw["pay_date_ed"] != null)
    	{
    		$sql .= ' AND cp_pay_date <= \'' . str_replace('/', '', $set_select_btw["pay_date_ed"]) . '\'';
    	}

    	// ORDER BY文 作成
    	$sql .= ' ORDER BY cp_status ASC, cp_pay_date DESC';

    	// 対象全件数を取得
    	$query = $this->db->query($sql);
    	$client_countall = $query->num_rows();

    	// LIMIT ＆ OFFSET 値をセット
    	$sql .= ' LIMIT ' . $tmp_per_page . ' OFFSET ' . $tmp_offset;

    	// クエリー実行
    	$query = $this->db->query($sql);
    	$client_list = $query->result('array');

    	return array($client_list, $client_countall);
    }


    /**
     * 更新対象クライアントメンバーの取得
     *
     * @param    int
     * @return   array()
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

    // クライアント新規会員登録
    public function insert_client_member($setData)
    {

        // データ追加
        $result = $this->db->insert('tb_client_mem', $setData);
        return $result;
    }

    // クライアント支払情報登録
    public function insert_client_pay($setData)
    {

    	// データ追加
    	$result = $this->db->insert('tb_client_pay', $setData);
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
     * 1レコード更新 (tb_client_info)
     *
     * @param    array()
     * @return   bool
     */
    public function update_Client_info($set_data)
    {

        // 「手数料率」「月額固定」「契約日」のセット
        //if (!empty($set_data['ci_agreement_st']))
        //{
        //    $set_data['ci_agreement_st']  = $set_data['ci_agreement_st'];
        //} else {
        //    $set_data['ci_agreement_st']  = NULL;
        //}
        //if (!empty($set_data['ci_agreement_end']))
        //{
        //    $set_data['ci_agreement_end']  = $set_data['ci_agreement_end'];
        //} else {
        //    $set_data['ci_agreement_end']  = NULL;
        //}
        //$set_data['ci_comment']       = $set_data['ci_comment'];

        // 更新日時をセット
        $time = time();
        $set_data['ci_update_date'] = date("Y-m-d H:i:s", $time);

        $where = array(
                'ci_cl_id' => $set_data['cl_id']
        );

        unset($set_data['cl_id']);

        $result = $this->db->update('tb_client_info', $set_data, $where);
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
     * 1レコード更新 (tb_client_pay)
     *
     * @param    array()
     * @return   bool
     */
    public function update_client_pay($set_data)
    {

    	// 更新日時をセット
    	$time = time();
    	$set_data['cp_update_date'] = date("Y-m-d H:i:s", $time);

    	$where = array(
    			'cp_id' => $set_data['cp_id'],
    	);

    	$result = $this->db->update('tb_client_pay', $set_data, $where);
    	return $result;
    }

    /**
     * ログイン日時の更新
     *
     * @param    bigint
     * @return   bool
     */
    public function update_Logindate($cl_id)
    {

        $time = time();
        $set_data = array(
                'cl_lastlogin' => date("Y-m-d H:i:s", $time)
        );
        $where = array(
                'cl_id' => $cl_id
        );
        $result = $this->db->update('tb_client', $set_data, $where);
        return $result;
    }

    /**
     * 重複データのチェック：ログインID（メールアドレス）
     *
     * @param    bigint
     * @param    bool         :: FALSE => 新規登録時。 TRUE => 更新時使用。
     * @return   bool
     */
    public function check_LoginID($loginid, $update = FALSE)
    {

        $sql = 'SELECT * FROM `tb_client` '
                . 'WHERE `cl_email` = ? ';

        $values = array(
                $loginid,
        );

        $query = $this->db->query($sql, $values);

        if ($update == FALSE)
        {
            $count = 0;
        } else {
            $count = 1;
        }

        if ($query->num_rows() > $count) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    /**
     * ログイン日時の更新
     *
     * @param    bigint
     * @return   bool
     */
    public function update_mlogindate($cm_mem_id)
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
     * アドミン：クライアント 請求(支払)一覧の取得
     *
     * @param    array() : 検索項目値
     * @param    int     : 1ページ当たりの表示件数(LIMIT値)
     * @param    int     : オフセット値(ページ番号)
     * @return   array()
     */
    public function get_paycllist_query($arr_post, $tmp_per_page, $tmp_offset=0)
    {

    	// 各SQL項目へセット
    	// WHERE
    	$set_select["cp_cl_id"]        = $arr_post['cp_cl_id'];
    	$set_select["cp_status"]       = $arr_post['cp_status'];
    	$set_select_btw["pay_date_st"] = substr($arr_post['pay_date_st'],0,7);
    	$set_select_btw["pay_date_ed"] = substr($arr_post['pay_date_ed'],0,7);

    	// クエリー取得
    	$list_query = $this->select_paycllist_query($set_select, $set_select_btw, $tmp_per_page, $tmp_offset);

    	return $list_query;

    }

    /**
     * アドミン：クライアント 請求(支払)一覧の取得
     *
     * @param    array() : WHERE句項目
     * @param    array() : ORDER BY句項目
     * @param    int     : 1ページ当たりの表示件数
     * @param    int     : オフセット値(ページ番号)
     * @return   array()
     */
    public function select_paycllist_query($set_select, $set_select_btw, $tmp_per_page, $tmp_offset=0)
    {

    	$sql  = 'SELECT'
    			. ' cp_id AS `支払情報ID`,'
    			. ' cp_cl_id AS `クライアントID`,'
    			. ' cp_pay_date AS `請求年月`,'
    			. ' cp_status AS `請求状況`,'						// 0：未支払、1：支払済、2：保留、3：返金
    			. ' cp_pay_fix AS `請求月額固定`,'
    			. ' cp_pay_writer AS `請求ライター発注額`,'
    			. ' cp_pay_result AS `請求成果報酬`,'
    			. ' cp_pay_adjust AS `請求調整額`,'
    			. ' cp_pay_taxrate AS `請求消費税率`,'
    			. ' cp_pay_tax AS `請求消費税額`,'
    			. ' cp_pay_total AS `請求総合計`,'
    			. ' cp_contract_initial AS `初期費用`,'
    			. ' cp_contract_id AS `手数料ID`,'					// 0：料率、1：月額固定料金、2：固定+成果報酬
    			. ' cp_contract_fix AS `固定手数料`,'
    			. ' cp_contract_result AS `成果手数料`,'
    			. ' cp_contract_taxrule AS `消費税計算`,'			// 0：税抜、1：税込、2：なし
    			. ' cp_contract_calrule AS `計算方法`'				// 0：切り上げ、1：切り捨て、2：四捨五入
    	;
    	$sql .= ' FROM `tb_client_pay` WHERE `cp_id` >= 0';

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
    		$sql .= ' AND cp_pay_date >= \'' . str_replace('/', '', $set_select_btw["pay_date_st"]) . '\'';
    	}
    	if ($set_select_btw["pay_date_ed"] != null)
    	{
    		$sql .= ' AND cp_pay_date <= \'' . str_replace('/', '', $set_select_btw["pay_date_ed"]) . '\'';
    	}

    	// ORDER BY文 作成
    	$sql .= ' ORDER BY cp_status ASC, cp_cl_id ASC, cp_pay_date DESC';

    	// 対象全件数を取得
    	//$query = $this->db->query($sql);
    	//$client_countall = $query->num_rows();

    	// LIMIT ＆ OFFSET 値をセット
    	$sql .= ' LIMIT ' . $tmp_per_page . ' OFFSET ' . $tmp_offset;

    	// クエリー実行
    	$query = $this->db->query($sql);

    	return $query;
    }


    /**
     * 重複データのチェック：ログインID（メールアドレス）
     *
     * @param    varchar
     * @return   bool
     */
    public function check_mloginid($loginid)
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
