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
     * @return    array()
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
     * クライアントメンバーの取得
     *
     * @param    array() : 検索項目値
     * @param    int     : 1ページ当たりの表示件数(LIMIT値)
     * @param    int     : オフセット値(ページ番号)
     * @return    array()
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
     * 更新対象クライアントメンバーの取得
     *
     * @param    int
     * @return    array()
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

    /**
     * 対象クライアントメンバーの取得
     *
     * @param    array() : WHERE句項目
     * @param    array() : ORDER BY句項目
     * @param    int     : 1ページ当たりの表示件数
     * @param    int     : オフセット値(ページ番号)
     * @return    array()
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

    // クライアント新規会員登録
    public function insert_Client($set_data)
    {

        // データ追加
        $result = $this->db->insert('tb_client', $set_data);
        return $result;
    }

    /**
     * 1レコード更新 (tb_client)
     *
     * @param    array()
     * @return    bool
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
     * @return    bool
     */
    public function update_Client_info($set_data)
    {

        // 「手数料率」「月額固定」「契約日」のセット
        if (!empty($set_data['ci_agreement_st']))
        {
            $set_data['ci_agreement_st']  = $set_data['ci_agreement_st'];
        } else {
            $set_data['ci_agreement_st']  = NULL;
        }
        if (!empty($set_data['ci_agreement_end']))
        {
            $set_data['ci_agreement_end']  = $set_data['ci_agreement_end'];
        } else {
            $set_data['ci_agreement_end']  = NULL;
        }
        $set_data['ci_comment']       = $set_data['ci_comment'];

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
     * ログイン日時の更新
     *
     * @param    bigint
     * @return    bool
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
     * @return    bool
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

}
