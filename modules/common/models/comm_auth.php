<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Comm_auth extends CI_Model
{

	private $_hash_passwd;
	private $_memberID;
	private $_memberRANK;
	private $_memberNAME;

    public function __construct()
    {
        parent::__construct();
    }

	/**
	 * ログイン・チェック：ログインID（メールアドレス）＆パスワード
	 *
	 * @param	varchar
	 * @param	string
	 * @return	string
	 */
	public function check_Login($loginid, $password, $login_member)
    {

    	switch ($login_member)
    	{
    		case 'writer':
    			$sql = 'SELECT * FROM `tb_writer` '
    					. 'WHERE `wr_email` = ? ';

    			$values = array(
    					$loginid
    			);

    			$query = $this->db->query($sql, $values);

    			// レコードチェック
    			if ($query->num_rows() == 0)
    			{
    				$err_mess = '入力されたログインID（メールアドレス）は登録されていません。';
    				return $err_mess;
    			}

    			// 重複チェック
   				if ($query->num_rows() >= 2)
   				{
   					$err_mess = '入力されたログインIDが重複しています。システム管理者に連絡してください。';
   					return $err_mess;
   				}

   				// ログインID＆パスワード読み込み
   				$arrData = $query->result('array');
    			if (is_array($arrData))
    			{

    				$this->_hash_passwd = $arrData[0]['wr_password'];
    				$this->_memberID    = $arrData[0]['wr_id'];
    				$this->_memberRANK  = $arrData[0]['wr_mm_rank_id'];
    				$this->_memberRATE  = $arrData[0]['wr_measure'];
    				$this->_memberNAME  = $arrData[0]['wr_nickname'];

    				$this->_update_Session($login_member);
    			//} else {
    			//	$err_mess = '入力されたログインID（メールアドレス）は登録されていません。';
    			//	return $err_mess;
    			}

    			break;
    		case 'client':
    	    	$sql = 'SELECT * FROM `tb_client` '
    					. 'WHERE `cl_email` = ? ';

    			$values = array(
    					$loginid
    			);

    			$query = $this->db->query($sql, $values);

    			// レコードチェック
    			if ($query->num_rows() == 0)
    			{
    				$err_mess = '入力されたログインID（メールアドレス）は登録されていません。';
    				return $err_mess;
    			}

    			// 重複チェック
   				if ($query->num_rows() >= 2)
   				{
   					$err_mess = '入力されたログインIDが重複しています。システム管理者に連絡してください。';
   					return $err_mess;
   				}

   				// ログインID＆パスワード読み込み
   				$arrData = $query->result('array');
    			if (is_array($arrData))
    			{

    				$this->_hash_passwd = $arrData[0]['cl_password'];
    				$this->_memberID    = $arrData[0]['cl_id'];
    				//$this->_memberRANK  = '';
    				//$this->_memberRATE  = ''];
    				$this->_memberNAME  = $arrData[0]['cl_company'];

    				$this->_update_Session($login_member);
    			//} else {
    			//	$err_mess = '入力されたログインID（メールアドレス）は登録されていません。';
    			//	return $err_mess;
    			}

    			break;
    		case 'admin':
    			/*
    			 * ADMIN管理者は クライアント登録(tb_client) の クライアントID(cl_id)=='1' 固定とする。
    			*/
    	    	$sql = 'SELECT * FROM `tb_client` '
    					. 'WHERE `cl_email` = ? ';

    			$values = array(
    					$loginid
    			);

    			$query = $this->db->query($sql, $values);

    			// レコードチェック
    			if ($query->num_rows() == 0)
    			{
    				$err_mess = '入力されたログインID（メールアドレス）は登録されていません。';
    				return $err_mess;
    			}

    			// 重複チェック
   				if ($query->num_rows() >= 2)
   				{
   					$err_mess = '入力されたログインIDが重複しています。システム管理者に連絡してください。';
   					return $err_mess;
   				}

   				// ログインID＆パスワード読み込み
   				$arrData = $query->result('array');
    			if (is_array($arrData))
    			{
    				// クライアントID(cl_id)=='1' チェック
    				if ((isset($arrData[0]['cl_id'])) && ($arrData[0]['cl_id'] == 1))
    				{
    					$this->_hash_passwd = $arrData[0]['cl_password'];
    					$this->_memberID    = $arrData[0]['cl_id'];
    					//$this->_memberRANK  = '';
    					//$this->_memberRATE  = ''];
    					$this->_memberNAME  = $arrData[0]['cl_company'];

    					$this->_update_Session($login_member);
    				} else {
    					$err_mess = '入力されたログインID（メールアドレス）は管理者IDではありません。';
    					return $err_mess;
    				}

    			//} else {
    			//	$err_mess = '入力されたログインID（メールアドレス）は登録されていません。';
    			//	return $err_mess;
    			}

    			break;
    		default:
    	}

    	$err_mess = $this->_check_password($password);
    	return $err_mess;

    }

    /**
     * LOGOUT ＆ SESSIONクリア
     *
	 * @return	bool
     */
    public function logout($login_member)
    {


    	switch ($login_member)
    	{
    		case 'writer':
		    	$setData = array('w_login' => FALSE);
    			break;
    		case 'client':
		    	$setData = array('c_login' => FALSE);
    			break;
    		case 'admin':
		    	$setData = array('a_login' => FALSE);
    			break;
    		default:
    	}

    	$this->session->set_userdata($setData);									// ログイン解除

		//$this->session->sess_destroy();											// セッションデータ削除

    }

    /**
     * SESSION 書き込み
     *
     * @param	varchar
     */
    private function _update_Session($login_member)
    {

    	switch ($login_member)
    	{
    		case 'writer':
    			$this->session->set_userdata('w_login',   TRUE);					// ログイン有無
    			$this->session->set_userdata('w_memID',   $this->_memberID);		// メンバーID
    			$this->session->set_userdata('w_memRANK', $this->_memberRANK);		// メンバーランキング(writerのみ)
    			$this->session->set_userdata('w_memNAME', $this->_memberNAME);		// メンバー名前(writerはニックネーム)

    			break;
    		case 'client':
    			$this->session->set_userdata('c_login',   TRUE);					// ログイン有無
    			$this->session->set_userdata('c_memID',   $this->_memberID);		// メンバーID
    			//$this->session->set_userdata('c_memRANK', $this->_memberRANK);		// メンバーランキング(writerのみ)
    			$this->session->set_userdata('c_memNAME', $this->_memberNAME);		// メンバー名前(writerはニックネーム)

    			break;
    		case 'admin':
    			$this->session->set_userdata('a_login',   TRUE);					// ログイン有無
    			$this->session->set_userdata('a_memID',   $this->_memberID);		// メンバーID
    			//$this->session->set_userdata('a_memRANK', $this->_memberRANK);		// メンバーランキング(writerのみ)
    			$this->session->set_userdata('a_memNAME', $this->_memberNAME);		// メンバー名前(writerはニックネーム)

    			break;
    		default:
    	}

    	//$this->session->set_userdata('login_mem' , $login_member);			// ログインメンバー(writer/client/admin)
    }

	/**
	 * パスワードチェック
	 *
	 * @param	varchar
	 * @param	varchar
	 * @return	string
	 */
	 private function _check_password($password)
    {
		// パスワードハッシュ認証チェック
    	if (!password_verify($password, $this->_hash_passwd)) {
    		$err_mess = '入力されたパスワードが一致しません。';
    		return $err_mess;
    	}
    }

}
