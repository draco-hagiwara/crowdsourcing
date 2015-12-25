<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    // 重複データのチェック：ログインID（メールアドレス）
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
        //$result = $this->db->insert('tb_admin', $setData);
        //return $result;
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
     * ポイント 計算
     *
     * @param    int
     * @param    decimal
     * @return    int
     * @return    decimal
     */
    public function cal_point($value, $rate)
    {

        // ポイントの端数処理の選択
        $this->config->load('config_comm');
        $point_cal = $this->config->item('POINT_CAL_ID');

        $point_cnt = $value * $rate;

        // ポイント計算
        switch ($point_cal)
        {
            case 0:                                                // 切り上げ
                $point_cnt = $point_cnt + 0.9;
                break;
            case 1:                                                // 切り捨て
                break;
            case 2:                                                // 四捨五入
            default:
                $point_cnt = $point_cnt + 0.5;
        }

        $cal["val"]  = floor($point_cnt);
        $cal["rate"] = $rate;

        return $cal;
    }

    /**
     * 税額 計算
     *
     * @param    int
     * @param    decimal
     * @return    int
     * @return    decimal
     */
    public function cal_tax($value)
    {

        // ポイントの端数処理の選択
        $this->config->load('config_comm');
           $tax_rate  = $this->config->item('TAX_RATE');
        $tax_cal   = $this->config->item('TAX_CAL_ID');
        $tax_inout = $this->config->item('TAX_INOUT_ID');

        if ($tax_inout == 0)
        {
            // 税抜の場合
            $rate       = $tax_rate * 0.01;
            $tax_total  = $value * $rate;

            // ポイント計算
            switch ($tax_cal)
            {
                case 0:                                                // 切り上げ
                    $tax_total = $tax_total + 0.9;
                    break;
                case 1:                                                // 切り捨て
                    break;
                case 2:                                                // 四捨五入
                default:
                    $tax_total = $tax_total + 0.5;
            }

            $cal["val"]  = floor($tax_total);
            $cal["rate"] = $rate;
        } else {

            // 税込
            $cal["val"]  = $value;
            $cal["rate"] = 0;

        }

        return $cal;

    }

}
