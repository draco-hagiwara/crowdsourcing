<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Client extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * 重複データのチェック：ログインID（メールアドレス）
     *
     * @param    int
     * @return    boolean
     */
    // 重複データのチェック：ログインID（メールアドレス）
    public function check_LoginID($loginid)
    {

        $sql = 'SELECT * FROM `tb_client_mem` '
                . 'WHERE `cm_login` = ? '
                . '  AND `cm_del_flg` = 0 ';

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

    /**
     * クライアント新規会員登録
     *
     * @param    array()
     * @return    boolean
     */
    public function insert_Client($setData)
    {

        // データ追加
        $_loginpw = $setData["cm_password"];
        unset($setData["cm_password"]) ;
        $result = $this->db->insert('tb_client', $setData);

        // クライアント個別情報レコード新規作成
        if ($result)
        {
            // 上で作成したレコードの「クライアントID(cl_id)」を取得
            $where = array(
                    'cl_email' => $setData['cl_email'],
            );
            $query = $this->db->get_where('tb_client', $where);
            $cl_getresult = $query->result('array');

            // デフォルト手数料の読み込み
            $this->config->load('config_comm');
            $tmp_feeid = $this->config->item('CLIENT_DEF_FEEID');
            $tmp_fee   = $this->config->item('CLIENT_DEF_FEE');

            $data = array(
                    'ci_cl_id'  => $cl_getresult[0]['cl_id'],
                    'ci_fee_id' => $tmp_feeid,
                    'ci_fee'    => $tmp_fee,
            );
            $this->db->set($data);
            $result = $this->db->insert('tb_client_info', $data);

            if ($result)
            {
                // 会員ランク別単価情報レコード新規作成
                // デフォルト単価の読み込み
                $tmp_tankaprice = $this->config->item('MEM_TANKA_PRICE');

                foreach ($tmp_tankaprice as $key => $vale)
                {
                    $data = array(
                            'ta_cl_id'            => $cl_getresult[0]['cl_id'],
                            'ta_mm_rank_id'       => $key,
                            'ta_price'            => $vale,
                    );
                    $this->db->set($data);
                    $result = $this->db->insert('tb_tanka', $data);

                }

                // 会員別加算単価情報レコード新規作成
                // デフォルト加算単価の読み込み
                $tmp_tankaadd = $this->config->item('TANKA_ADD_PRICE');

                foreach ($tmp_tankaadd as $key => $vale)
                {
                    $data = array(
                            'taa_cl_id'           => $cl_getresult[0]['cl_id'],
                            'taa_difficulty_id'   => $key,
                            'taa_price'           => $vale,
                    );
                    $this->db->set($data);
                    $result = $this->db->insert('tb_tankaadd', $data);

                }

                // メンバー個別情報へ書き込み
                if ($result)
                {
                    $_hash_pw = password_hash($_loginpw, PASSWORD_DEFAULT);
                    $data = array(
                            'cm_cl_id'      => $cl_getresult[0]['cl_id'],
                            'cm_status'     => 1,
                            'cm_login'      => $setData['cl_email'],
                            'cm_password'   => $_hash_pw,
                            'cm_authority'  => 10,
                            'cm_person01'   => $setData['cl_person01'],
                            'cm_person02'   => $setData['cl_person02'],
                            'cm_department' => $setData['cl_department'],
                    );
                    $this->db->set($data);
                    $result = $this->db->insert('tb_client_mem', $data);

                }
            }
        }

        return $result;
    }


}
