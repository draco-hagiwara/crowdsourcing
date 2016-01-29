<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Project_info extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * 投稿情報の取得
     *
     * @param    int
     * @param    int
     * @param    tinyint
     * @return   array()
     */
    public function get_order_info($get_pj_id, $pji_seq = NULL)
    {

        $set_where["pji_pj_id"]      = $get_pj_id;
        if ($pji_seq != NULL)
        {
            $set_where["pji_seq"]    = $pji_seq;
        }

        // view から取得
        $query = $this->db->get_where('vw_posting_pji', $set_where);

        $get_data = $query->result('array');

        return $get_data;

    }


    /**
     * 1レコード更新 :: 案件内容
     *
     * @param    array()
     * @return   bool
     */
    public function update_orderinfo($set_data)
    {

        // 更新日時をセット
        $time = time();
        $set_data['pji_update_date'] = date("Y-m-d H:i:s", $time);

        $where = array(
                'pji_pj_id' => $set_data['pji_pj_id']
        );

        $result = $this->db->update('tb_project_info', $set_data, $where);
        return $result;
    }

}
