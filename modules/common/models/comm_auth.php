<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Comm_auth extends CI_Model
{

	private $_hash_passwd;
	private $_memberID;
	private $_memberRANK;

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

    	switch ($login_member){
    		case 'writer':
    			$sql = 'SELECT * FROM `tb_writer` '
    					. 'WHERE `wr_email` = ? ';

    			$values = array(
    					$loginid
    			);

    			$query = $this->db->query($sql, $values);

    			// 重複チェック
   				if ($query->num_rows() >= 2) {
   					$err_mess = '入力されたログインIDが重複しています。システム管理者に連絡してください。';
   					return $err_mess;
   				}

   				// ログインID＆パスワード読み込み
   				$arrData = $query->result('array');
    			if (is_array($arrData)) {

    				$this->_hash_passwd = $arrData[0]['wr_password'];
    				$this->_memberID    = $arrData[0]['wr_id'];
    				$this->_memberRANK  = $arrData[0]['wr_mm_memberrank_id'];

    				$this->_update_Session($login_member);
    			} else {
    				$err_mess = '入力されたログインID（メールアドレス）は登録されていません。';
    				return $err_mess;
    			}

    			break;
    		case 'client':
    	    			$sql = 'SELECT * FROM `tb_client` '
    					. 'WHERE `cl_email` = ? ';

    			$values = array(
    					$loginid
    			);

    			$query = $this->db->query($sql, $values);

    			// 重複チェック
   				if ($query->num_rows() >= 2) {
   					$err_mess = '入力されたログインIDが重複しています。システム管理者に連絡してください。';
   					return $err_mess;
   				}

   				// ログインID＆パスワード読み込み
   				$arrData = $query->result('array');
    			if (is_array($arrData)) {

    				$this->_hash_passwd = $arrData[0]['cl_password'];
    				$this->_memberID    = $arrData[0]['cl_id'];
    				$this->_memberRANK  = '';

    				$this->_update_Session($login_member);
    			} else {
    				$err_mess = '入力されたログインID（メールアドレス）は登録されていません。';
    				return $err_mess;
    			}

    			break;
    		case 'admin':
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
