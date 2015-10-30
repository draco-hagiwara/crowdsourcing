<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Project_info extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }



    /**
     * 1レコード更新 :: 案件内容
     *
     * @param	array()
     * @return	bool
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
