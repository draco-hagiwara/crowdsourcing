<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mailtpl extends CI_Model
{

    public function __construct()
    {
        parent::__construct();

    	$this->load->library('email');										// メール送信クラス読み込み
    }

    // メールテンプレートの取得からメール送信
    public function getMailTpl_contact($mail, $arrRepList = NULL, $mail_tpl)
    {

		$where = array('mt_id' => $mail_tpl);
		$query = $this->db->get_where('tb_mail_tpl', $where);
		foreach ($query->result_array() as $row)
		{
			if ($mail['from'] == "") {
				$mail['from']      = $row['mt_from'];
			} else {
				$mail['from']      = $mail['from'];
			}
			if ($mail['from_name'] == "") {
				$mail['from_name'] = $row['mt_from_name'];
			} else {
				$mail['from_name'] = $mail['from_name'];
			}
			if ($mail['subject'] == "") {
				$mail['subject']   = $row['mt_subject'];
			} else {
				$mail['subject']   = $mail['subject'];
			}
			if ($mail['to'] == "") {
				$mail['to']        = $row['mt_to'];
			} else {
				$mail['to']        = $mail['to'];
			}
			if ($mail['cc'] == "") {
				$mail['cc']        = $row['mt_cc'];
			} else {
				$mail['cc']        = $mail['cc'];
			}
			if ($mail['bcc'] == "") {
				$mail['bcc']       = $row['mt_bcc'];
			} else {
				$mail['bcc']       = $mail['bcc'];
			}

			// Body部のtag項目置き換え
			if ($arrRepList) {
				$strResult = $this->_repMailBody($arrRepList, $row['mt_body']);
			} else {
				$strResult = $row['mt_body'];
			}

			$mail['body'] = $strResult;
		}

		// メール送信
		$result = $this->_sendmail($mail);
		return $result;

    }

    // メール送信処理
    private function _sendmail($mail)
    {

    	$from_name = mb_encode_mimeheader($mail['from_name'], 'ISO-2022-JP', 'UTF-8');
    	$subject   = mb_convert_encoding ($mail['subject'],   'SJIS-win',    'UTF-8');
    	$body      = mb_convert_encoding ($mail['body'],      'SJIS-win',    'UTF-8');
    	//$subject   = mb_convert_encoding ($mail['subject'], 'ISO-2022-JP-MS', 'UTF-8');		// 一部で文字化けが発生！
    	//$body      = mb_convert_encoding ($mail['body'],    'ISO-2022-JP-MS', 'UTF-8');

    	$this->email->clear();
    	$this->email->reply_to('autoreply@cs.com.dev', 'CrowdSourcing');
    	$this->email->from($mail['from'] , $from_name);
    	$this->email->to($mail['to']);
    	$this->email->cc($mail['cc']);
    	$this->email->bcc($mail['bcc']);
    	$this->email->subject($subject);
    	$this->email->message($body);

    	if ($this->email->send()) {
    		return TRUE;
    	} else {
    		return FALSE;
    	}

    	echo $this->email->print_debugger();

    }

	// 置き換え文字列の処理
    private function _repMailBody($arrRepList, $row)
    {

		$arrRepPattern = array();
		$arrRepTag     = array();
		foreach( $arrRepList as $strKey => $strValue )
		{
			$arrRepPattern[] = '/\[' . $strKey . '\]/';
			$arrRepTag[]     = $strValue;
		}

		$strResult = preg_replace( $arrRepPattern, $arrRepTag, $row );

    	return $strResult;
    }
}

