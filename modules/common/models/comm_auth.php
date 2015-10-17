<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Comm_auth extends CI_Model
{

	private $_hash_passwd;
	private $_memberID;
	private $_memberRANK;
<<<<<<< HEAD
<<<<<<< HEAD
	private $_memberNAME;
=======
>>>>>>> 778364b11983b8ecd0f1ae7ce60860e34a1a71c4
=======
	private $_memberNAME;
>>>>>>> develop

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

<<<<<<< HEAD
<<<<<<< HEAD
    	switch ($login_member)
    	{
=======
    	switch ($login_member){
>>>>>>> 778364b11983b8ecd0f1ae7ce60860e34a1a71c4
=======
    	switch ($login_member)
    	{
>>>>>>> develop
    		case 'writer':
    			$sql = 'SELECT * FROM `tb_writer` '
    					. 'WHERE `wr_email` = ? ';

    			$values = array(
    					$loginid
    			);

    			$query = $this->db->query($sql, $values);

    			// 重複チェック
<<<<<<< HEAD
<<<<<<< HEAD
   				if ($query->num_rows() >= 2)
   				{
=======
   				if ($query->num_rows() >= 2) {
>>>>>>> 778364b11983b8ecd0f1ae7ce60860e34a1a71c4
=======
   				if ($query->num_rows() >= 2)
   				{
>>>>>>> develop
   					$err_mess = '入力されたログインIDが重複しています。システム管理者に連絡してください。';
   					return $err_mess;
   				}

   				// ログインID＆パスワード読み込み
   				$arrData = $query->result('array');
<<<<<<< HEAD
<<<<<<< HEAD
    			if (is_array($arrData))
    			{
=======
    			if (is_array($arrData)) {
>>>>>>> 778364b11983b8ecd0f1ae7ce60860e34a1a71c4
=======
    			if (is_array($arrData))
    			{
>>>>>>> develop

    				$this->_hash_passwd = $arrData[0]['wr_password'];
    				$this->_memberID    = $arrData[0]['wr_id'];
    				$this->_memberRANK  = $arrData[0]['wr_mm_memberrank_id'];
<<<<<<< HEAD
<<<<<<< HEAD
    				$this->_memberNAME  = $arrData[0]['wr_nickname'];
=======
>>>>>>> 778364b11983b8ecd0f1ae7ce60860e34a1a71c4
=======
    				$this->_memberNAME  = $arrData[0]['wr_nickname'];
>>>>>>> develop

    				$this->_update_Session($login_member);
    			} else {
    				$err_mess = '入力されたログインID（メールアドレス）は登録されていません。';
    				return $err_mess;
    			}

    			break;
    		case 'client':
<<<<<<< HEAD
<<<<<<< HEAD
    	    	$sql = 'SELECT * FROM `tb_client` '
=======
    	    			$sql = 'SELECT * FROM `tb_client` '
>>>>>>> 778364b11983b8ecd0f1ae7ce60860e34a1a71c4
=======
    	    	$sql = 'SELECT * FROM `tb_client` '
>>>>>>> develop
    					. 'WHERE `cl_email` = ? ';

    			$values = array(
    					$loginid
    			);

    			$query = $this->db->query($sql, $values);

    			// 重複チェック
<<<<<<< HEAD
<<<<<<< HEAD
   				if ($query->num_rows() >= 2)
   				{
=======
   				if ($query->num_rows() >= 2) {
>>>>>>> 778364b11983b8ecd0f1ae7ce60860e34a1a71c4
=======
   				if ($query->num_rows() >= 2)
   				{
>>>>>>> develop
   					$err_mess = '入力されたログインIDが重複しています。システム管理者に連絡してください。';
   					return $err_mess;
   				}

   				// ログインID＆パスワード読み込み
   				$arrData = $query->result('array');
<<<<<<< HEAD
<<<<<<< HEAD
    			if (is_array($arrData))
    			{
=======
    			if (is_array($arrData)) {
>>>>>>> 778364b11983b8ecd0f1ae7ce60860e34a1a71c4
=======
    			if (is_array($arrData))
    			{
>>>>>>> develop

    				$this->_hash_passwd = $arrData[0]['cl_password'];
    				$this->_memberID    = $arrData[0]['cl_id'];
    				$this->_memberRANK  = '';
<<<<<<< HEAD
<<<<<<< HEAD
    				$this->_memberNAME  = $arrData[0]['cl_company'];
=======
>>>>>>> 778364b11983b8ecd0f1ae7ce60860e34a1a71c4
=======
    				$this->_memberNAME  = $arrData[0]['cl_company'];
>>>>>>> develop

    				$this->_update_Session($login_member);
    			} else {
    				$err_mess = '入力されたログインID（メールアドレス）は登録されていません。';
    				return $err_mess;
    			}

    			break;
    		case 'admin':
<<<<<<< HEAD
<<<<<<< HEAD
=======
>>>>>>> develop
    			/*
    			 * ADMIN管理者は クライアント登録(tb_client) の クライアントID(cl_id)=='1' 固定とする。
    			*/
    	    	$sql = 'SELECT * FROM `tb_client` '
    					. 'WHERE `cl_email` = ? ';

    			$values = array(
    					$loginid
    			);

    			$query = $this->db->query($sql, $values);

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
    					$this->_memberRANK  = '';
    					$this->_memberNAME  = $arrData[0]['cl_company'];

    					$this->_update_Session($login_member);
    				} else {
    					$err_mess = '入力されたログインID（メールアドレス）は管理者IDではありません。';
    					return $err_mess;
    				}

    			} else {
    				$err_mess = '入力されたログインID（メールアドレス）は登録されていません。';
    				return $err_mess;
    			}

<<<<<<< HEAD
=======
>>>>>>> 778364b11983b8ecd0f1ae7ce60860e34a1a71c4
=======
>>>>>>> develop
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
    public function logout()
    {

    	$setData = array(
    			'login_chk' => FALSE,
    	);
    	$this->session->set_userdata($setData);									// ログイン解除

		$this->session->sess_destroy();											// セッションデータ削除

    }

    /**
     * SESSION 書き込み
     *
     * @param	varchar
     */
    private function _update_Session($login_member)
    {
    	$this->session->set_userdata('login_chk' , TRUE);						// ログイン有無
    	$this->session->set_userdata('login_mem' , $login_member);				// ログインメンバー(writer/client/admin)
    	$this->session->set_userdata('memberID'  , $this->_memberID);			// メンバーID
    	$this->session->set_userdata('memberRANK', $this->_memberRANK);			// メンバーランキング(writerのみ)
<<<<<<< HEAD
<<<<<<< HEAD
    	$this->session->set_userdata('memberNAME', $this->_memberNAME);			// メンバー名前(writerはニックネーム)
=======
>>>>>>> 778364b11983b8ecd0f1ae7ce60860e34a1a71c4
=======
    	$this->session->set_userdata('memberNAME', $this->_memberNAME);			// メンバー名前(writerはニックネーム)
>>>>>>> develop
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
