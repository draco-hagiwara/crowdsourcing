<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Client extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

	// クライアント新規会員登録
    public function insert_Client($setData)
    {
    	// データ追加
    	$result = $this->db->insert('tb_client', $setData);
		return $result;
    }















    // メール送信処理
    private function _sendmail($mail)
    {

    	$from_name = mb_encode_mimeheader($mail['from_name'], 'ISO-2022-JP'   , 'UTF-8');
    	$subject   = mb_convert_encoding ($mail['subject']  , 'ISO-2022-JP-MS', 'UTF-8');
    	$body      = mb_convert_encoding ($mail['body']     , 'ISO-2022-JP-MS', 'UTF-8');

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

