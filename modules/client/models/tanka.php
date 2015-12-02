<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tanka extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * ライター個別「会員ランク」単価を取得
     *
     * @param	int
     * @param	tinyint
     * @return	array()
     */
    public function get_memtanka($get_cl_id, $rankid)
    {

    	$set_where["ta_cl_id"]      = $get_cl_id;
    	$set_where["ta_mm_rank_id"] = $rankid;

    	$query = $this->db->get_where('tb_tanka', $set_where);

    	$get_data = $query->result('array');

    	return $get_data[0];

    }

    /**
     * ライター個別「難易度」単価を取得
     *
     * @param	int
     * @param	tinyint
     * @return	array()
     */
    public function get_difftanka($get_cl_id, $diffid)
    {

    	$set_where["taa_cl_id"]         = $get_cl_id;
    	$set_where["taa_difficulty_id"] = $diffid;

    	$query = $this->db->get_where('tb_tankaadd', $set_where);

    	$get_data = $query->result('array');

    	return $get_data[0];

    }

    /**
     * 会員ランク単価を取得
     *
     * @param	int
     * @return	array()
     */
    public function get_tanka($get_cl_id)
    {

    	$set_where["ta_cl_id"] = $get_cl_id;

    	$query = $this->db->get_where('tb_tanka', $set_where);

    	$get_data = $query->result('array');

    	return $get_data;

    }

    /**
     * 難易度単価を取得
     *
     * @param	int
     * @return	array()
     */
    public function get_tankaaad($get_cl_id)
    {

    	$set_where["taa_cl_id"] = $get_cl_id;

    	$query = $this->db->get_where('tb_tankaadd', $set_where);

    	$get_data = $query->result('array');

    	return $get_data;

    }

    /**
     * 1レコード更新 ：会員ランク(tb_tanka)
     *
     * @param	array()
     * @return	bool
     */
    public function update_tanka($cl_id, $set_data)
    {

    	// 更新日時をセット
    	$time = time();
    	$set_updata['ta_update_date'] = date("Y-m-d H:i:s", $time);

    	foreach ($set_data as $key => $val)
    	{
    		$set_updata['ta_price'] = $val;

	    	$where = array(
	    			'ta_cl_id'      => $cl_id,
	    			'ta_mm_rank_id' => $key,
	    	);

	    	$result = $this->db->update('tb_tanka', $set_updata, $where);
	    	if (!$result)
	    	{
	    		return $result;
	    	}
    	}

    	return $result;

    }

    /**
     * 1レコード更新 ：難易度(tb_tanka)
     *
     * @param	array()
     * @return	bool
     */
    public function update_tankaadd($cl_id, $set_data)
    {

    	// 更新日時をセット
    	$time = time();
    	$set_updata['taa_update_date'] = date("Y-m-d H:i:s", $time);

    	foreach ($set_data as $key => $val)
    	{
    		$set_updata['taa_price'] = $val;

    		$where = array(
    				'taa_cl_id'         => $cl_id,
    				'taa_difficulty_id' => $key,
    		);

    		$result = $this->db->update('tb_tankaadd', $set_updata, $where);
    		if (!$result)
    		{
    			return $result;
    		}
    	}

    	return $result;

    }

}
