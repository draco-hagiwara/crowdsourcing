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
     * @param    varchar
     * @param    string
     * @return    string
     */
    public function check_Login($loginid, $password, $login_member)
    {

        $err_mess = NULL;
        switch ($login_member)
        {
            case 'writer':
                $sql = 'SELECT * FROM `tb_writer` '
                        . 'WHERE `wr_email` = ? '
                        . 'AND `wr_status`  = 4 '
                        . 'AND `wr_del_flg` = 0 ';

                $values = array(
                        $loginid
                );

                $query = $this->db->query($sql, $values);

                // レコードチェック
                if ($query->num_rows() == 0)
                {
                    $err_mess = '入力されたログインID（メールアドレス）またはパスワードが間違っています。';
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
                    // パスワードのチェック
                    $this->_hash_passwd = $arrData[0]['wr_password'];
                    $res = $this->_check_password($password);
                    if ($res == TRUE)
                    {
                        $err_mess = '入力されたログインID（メールアドレス）またはパスワードが間違っています。';
                        return $err_mess;
                    } else {
                        $this->_memberID    = $arrData[0]['wr_id'];
                        $this->_memberRANK  = $arrData[0]['wr_mm_rank_id'];
                        $this->_memberRATE  = $arrData[0]['wr_measure'];
                        $this->_memberNAME  = $arrData[0]['wr_nickname'];

                        $this->_update_Session($login_member);
                    }
                }

                break;
            case 'client':
                $sql = 'SELECT * FROM `tb_client` '
                        . 'WHERE `cl_email`   = ? '
                        . 'AND   `cl_status`  = 1 '
                        . 'AND   `cl_del_flg` = 0 ';

                $values = array(
                        $loginid
                );

                $query = $this->db->query($sql, $values);

                // レコードチェック
                if ($query->num_rows() == 0)
                {
                    $err_mess = '入力されたログインID（メールアドレス）またはパスワードが間違っています。';
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
                    // パスワードのチェック
                    $this->_hash_passwd = $arrData[0]['cl_password'];
                    $res = $this->_check_password($password);
                    if ($res == TRUE)
                    {
                        $err_mess = '入力されたログインID（メールアドレス）またはパスワードが間違っています。';
                        return $err_mess;
                    } else {
                        $this->_memberID    = $arrData[0]['cl_id'];
                        //$this->_memberRANK  = '';
                        //$this->_memberRATE  = ''];
                        $this->_memberNAME  = $arrData[0]['cl_company'];

                        $this->_update_Session($login_member);
                    }
                }

                break;
            case 'admin':
                /*
                 * ADMIN管理者は クライアント登録(tb_client) の クライアントID(cl_id)=='1' 固定とする。
                */
                $sql = 'SELECT * FROM `tb_client` '
                        . 'WHERE `cl_email`   = ? '
                        . 'AND   `cl_status`  = 1 '
                        . 'AND   `cl_del_flg` = 0 ';

                $values = array(
                        $loginid
                );

                $query = $this->db->query($sql, $values);

                // レコードチェック
                if ($query->num_rows() == 0)
                {
                    $err_mess = '入力されたログインID（メールアドレス）またはパスワードが間違っています。';
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
                        // パスワードのチェック
                        $this->_hash_passwd = $arrData[0]['cl_password'];
                        $res = $this->_check_password($password);
                        if ($res == TRUE)
                        {
                            $err_mess = '入力されたログインID（メールアドレス）またはパスワードが間違っています。';
                            return $err_mess;
                        } else {
                            $this->_hash_passwd = $arrData[0]['cl_password'];
                            $this->_memberID    = $arrData[0]['cl_id'];
                            //$this->_memberRANK  = '';
                            //$this->_memberRATE  = ''];
                            $this->_memberNAME  = $arrData[0]['cl_company'];

                            $this->_update_Session($login_member);
                        }
                    } else {
                        $err_mess = '入力されたログインID（メールアドレス）は管理者IDではありません。';
                        return $err_mess;
                    }
                }

                break;
            default:
        }

        //$err_mess = $this->_check_password($password);
        return $err_mess;

    }

    /**
     * LOGOUT ＆ SESSIONクリア
     *
     * @return    bool
     */
    public function logout($login_member)
    {

        // 特定のセッションユーザデータを削除
        switch ($login_member)
        {
            case 'writer':
                $seach_key = 'w';
                break;
            case 'client':
                $seach_key = 'c';
                break;
            case 'admin':
                $seach_key = 'a';
                break;
            default:
        }

        $get_data = $this->session->all_userdata();
        $unset_data = array();
        foreach ($get_data as $key => $val)
        {
            if (substr($key, 0, 1) == $seach_key)
            {
                $unset_data[$key] = '';
            }
        }

        $this->session->unset_userdata($unset_data);                            // セッションデータ削除

        // ログイン解除
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

        $this->session->set_userdata($setData);                                    // ログイン解除
        //$this->session->sess_destroy();                                        // 全セッションデータ削除

    }

    /**
     * SESSION 書き込み
     *
     * @param    varchar
     */
    private function _update_Session($login_member)
    {

        switch ($login_member)
        {
            case 'writer':
                $this->session->set_userdata('w_login',   TRUE);                    // ログイン有無
                $this->session->set_userdata('w_memID',   $this->_memberID);        // メンバーID
                $this->session->set_userdata('w_memRANK', $this->_memberRANK);        // メンバーランキング(writerのみ)
                $this->session->set_userdata('w_memNAME', $this->_memberNAME);        // メンバー名前(writerはニックネーム)

                break;
            case 'client':
                $this->session->set_userdata('c_login',   TRUE);                    // ログイン有無
                $this->session->set_userdata('c_memID',   $this->_memberID);        // メンバーID
                //$this->session->set_userdata('c_memRANK', $this->_memberRANK);        // メンバーランキング(writerのみ)
                $this->session->set_userdata('c_memNAME', $this->_memberNAME);        // メンバー名前(writerはニックネーム)

                break;
            case 'admin':
                $this->session->set_userdata('a_login',   TRUE);                    // ログイン有無
                $this->session->set_userdata('a_memID',   $this->_memberID);        // メンバーID
                //$this->session->set_userdata('a_memRANK', $this->_memberRANK);        // メンバーランキング(writerのみ)
                $this->session->set_userdata('a_memNAME', $this->_memberNAME);        // メンバー名前(writerはニックネーム)

                break;
            default:
        }

        //$this->session->set_userdata('login_mem' , $login_member);            // ログインメンバー(writer/client/admin)
    }





    /**
     * 不要なセッションデータの削除
     *
     * @param    string
     * @return    bool
     */
    public function delete_session($login_member)
    {

        switch ($login_member)
        {
            case 'writer':
                $backup_w_login    = $this->session->userdata('w_login');
                $backup_w_memID    = $this->session->userdata('w_memID');
                $backup_w_memNAME  = $this->session->userdata('w_memNAME');
                $backup_w_memRANK  = $this->session->userdata('w_memRANK');
                $backup_w_memENTRY = $this->session->userdata('w_memENTRY');

                $get_data = $this->session->all_userdata();
                $unset_data = array();
                foreach ($get_data as $key => $val)
                {
                    if (substr($key, 0, 2) == 'w_')
                    {
                        $unset_data[$key] = '';
                    }
                }
                $this->session->unset_userdata($unset_data);

                $this->session->set_userdata('w_login',    $backup_w_login);        // ログイン有無
                $this->session->set_userdata('w_memID',    $backup_w_memID);        // メンバーID
                $this->session->set_userdata('w_memNAME',  $backup_w_memNAME);        // メンバーランキング(writerのみ)
                $this->session->set_userdata('w_memRANK',  $backup_w_memRANK);        // メンバー名前(writerはニックネーム)
                $this->session->set_userdata('w_memENTRY', $backup_w_memENTRY);        // ENTRY有無


                break;
            case 'client':
                $backup_c_login   = $this->session->userdata('c_login');
                $backup_c_memID   = $this->session->userdata('c_memID');
                $backup_c_memNAME = $this->session->userdata('c_memNAME');

                $get_data = $this->session->all_userdata();
                $unset_data = array();
                foreach ($get_data as $key => $val)
                {
                    if (substr($key, 0, 2) == 'c_')
                    {
                        $unset_data[$key] = '';
                    }
                }
                $this->session->unset_userdata($unset_data);

                $this->session->set_userdata('c_login',   $backup_c_login);            // ログイン有無
                $this->session->set_userdata('c_memID',   $backup_c_memID);            // メンバーID
                $this->session->set_userdata('c_memNAME', $backup_c_memNAME);        // メンバー名前

                break;
            case 'admin':
                $backup_a_login   = $this->session->userdata('a_login');
                $backup_a_memID   = $this->session->userdata('a_memID');
                $backup_a_memNAME = $this->session->userdata('a_memNAME');

                $get_data = $this->session->all_userdata();
                $unset_data = array();
                foreach ($get_data as $key => $val)
                {
                    if (substr($key, 0, 2) == 'a_')
                    {
                        $unset_data[$key] = '';
                    }
                }
                $this->session->unset_userdata($unset_data);

                $this->session->set_userdata('a_login',   $backup_a_login);            // ログイン有無
                $this->session->set_userdata('a_memID',   $backup_a_memID);            // メンバーID
                $this->session->set_userdata('a_memNAME', $backup_a_memNAME);        // メンバー名前

                break;
            default:
        }

    }

    /**
     * パスワードチェック
     *
     * @param    varchar
     * @param    varchar
     * @return    string
     */
     private function _check_password($password)
    {
        // パスワードハッシュ認証チェック
        if (password_verify($password, $this->_hash_passwd)) {
            $result = FALSE;
        } else {
            $result = TRUE;
        }

        return $result;
    }


//    private $_hash_passwd;
//    private $_memberID;
//    private $_memberRANK;
//    private $_memberNAME;
//
//    public function __construct()
//    {
//        parent::__construct();
//    }
//
//
//    /**
//     * ログイン・チェック：ログインID（メールアドレス）＆パスワード
//     *
//     * @param    varchar
//     * @param    string
//     * @return    string
//     */
//    public function check_Login($loginid, $password, $login_member)
//    {
//
//        switch ($login_member){
//            case 'writer':
//                $sql = 'SELECT * FROM `tb_writer` '
//                        . 'WHERE `wr_email` = ? ';
//
//                $values = array(
//                        $loginid
//                );
//
//                $query = $this->db->query($sql, $values);
//
//                // 重複チェック
//                   if ($query->num_rows() >= 2) {
//                       $err_mess = '入力されたログインIDが重複しています。システム管理者に連絡してください。';
//                       return $err_mess;
//                   }
//
//                   // ログインID＆パスワード読み込み
//                   $arrData = $query->result('array');
//                if (is_array($arrData)) {
//
//                    $this->_hash_passwd = $arrData[0]['wr_password'];
//                    $this->_memberID    = $arrData[0]['wr_id'];
//                    $this->_memberRANK  = $arrData[0]['wr_mm_rank_id'];
//                    $this->_memberNAME  = $arrData[0]['wr_nickname'];
//
//                    $this->_update_Session($login_member);
//                } else {
//                    $err_mess = '入力されたログインID（メールアドレス）は登録されていません。';
//                    return $err_mess;
//                }
//
//                break;
//            case 'client':
//                break;
//            case 'admin':
//                break;
//            default:
//        }
//
//        $err_mess = $this->_check_password($password);
//        return $err_mess;
//
//    }
//
//    /**
//     * LOGOUT ＆ SESSIONクリア
//     *
//     * @return    bool
//     */
//    public function logout($login_member)
//    {
//
//
//        switch ($login_member)
//        {
//            case 'writer':
//                $setData = array('w_login' => FALSE);
//                break;
//            case 'client':
//                $setData = array('c_login' => FALSE);
//                break;
//            case 'admin':
//                $setData = array('a_login' => FALSE);
//                break;
//            default:
//        }
//
//        $this->session->set_userdata($setData);                                        // ログイン解除
//
//        //$this->session->sess_destroy();                                            // セッションデータ削除
//
//    }
//
//    /**
//     * SESSION 書き込み
//     *
//     * @param    varchar
//     */
//    private function _update_Session($login_member)
//    {
//
//        switch ($login_member)
//        {
//            case 'writer':
//                $this->session->set_userdata('w_login',   TRUE);                    // ログイン有無
//                $this->session->set_userdata('w_memID',   $this->_memberID);        // メンバーID
//                $this->session->set_userdata('w_memRANK', $this->_memberRANK);        // メンバーランキング(writerのみ)
//                $this->session->set_userdata('w_memNAME', $this->_memberNAME);        // メンバー名前(writerはニックネーム)
//
//                break;
//            case 'client':
//                $this->session->set_userdata('c_login',   TRUE);                    // ログイン有無
//                $this->session->set_userdata('c_memID',   $this->_memberID);        // メンバーID
//                //$this->session->set_userdata('c_memRANK', $this->_memberRANK);        // メンバーランキング(writerのみ)
//                $this->session->set_userdata('c_memNAME', $this->_memberNAME);        // メンバー名前(writerはニックネーム)
//
//                break;
//            case 'admin':
//                $this->session->set_userdata('a_login',   TRUE);                    // ログイン有無
//                $this->session->set_userdata('a_memID',   $this->_memberID);        // メンバーID
//                //$this->session->set_userdata('a_memRANK', $this->_memberRANK);        // メンバーランキング(writerのみ)
//                $this->session->set_userdata('a_memNAME', $this->_memberNAME);        // メンバー名前(writerはニックネーム)
//
//                break;
//            default:
//        }
//
//        //$this->session->set_userdata('login_mem' , $login_member);            // ログインメンバー(writer/client/admin)
//    }
//
//    /**
//     * パスワードチェック
//     *
//     * @param    varchar
//     * @param    varchar
//     * @return    string
//     */
//    private function _check_password($password)
//    {
//        // パスワードハッシュ認証チェック
//        if (!password_verify($password, $this->_hash_passwd)) {
//            $err_mess = '入力されたパスワードが一致しません。';
//            return $err_mess;
//        }
//    }
//
//
//
//
//
//
//
//
//    /**
//     * LOGOUT ＆ SESSIONクリア
//     *
//     * @return    bool
//     */
//    //public function logout()
//    //{
//    //
//    //    $setData = array(
//    //            'login_chk' => FALSE,
//    //    );
//    //    $this->session->set_userdata($setData);                                    // ログイン解除
//    //
//    //    $this->session->sess_destroy();                                            // セッションデータ削除
//    //
//    //}
//
//    /**
//     * SESSION 書き込み
//     *
//     * @param    varchar
//     */
//    //private function _update_Session($login_member)
//    //{
//    //    $this->session->set_userdata('login_chk' , TRUE);                        // ログイン有無
//    //    $this->session->set_userdata('login_mem' , $login_member);                // ログインメンバー
//    //    $this->session->set_userdata('memberID'  , $this->_memberID);            // ログインメンバーID
//    //    $this->session->set_userdata('memberRANK', $this->_memberRANK);            // ログインメンバーランキング
//    //}
//

}
