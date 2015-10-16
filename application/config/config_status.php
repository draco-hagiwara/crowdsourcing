<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
| -------------------------------------------------------------------
| Member Status SETTINGS
| -------------------------------------------------------------------
*/

// ライター会員ステータス
$config['WRITER_KARISHINSEI_ID'] = '1';					// 仮申請
$config['WRITER_SHINSEITYU_ID']  = '2';					// 登録申請中
$config['WRITER_KARITOUROKU_ID'] = '3';					// 仮登録 (デフォルト)
$config['WRITER_TOUROKU_ID']     = '4';					// 登録
$config['WRITER_ITIJITEISHI_ID'] = '7';					// 一時停止
$config['WRITER_TEISHI_ID']      = '8';					// 強制停止
$config['WRITER_TAIKAI_ID']      = '9';					// 退会

$config['WRITER_KARISHINSEI']    = '仮申請';
$config['WRITER_SHINSEITYU']     = '登録申請中';
$config['WRITER_KARITOUROKU']    = '仮登録';
$config['WRITER_TOUROKU']        = '登録';
$config['WRITER_ITIJITEISHI']    = '一時停止';
$config['WRITER_TEISHI']         = '強制停止';
$config['WRITER_TAIKAI']         = '退会';



// クライアント会員ステータス
$config['CLIENT_SHINSEITYU_ID']  = '0';					// 登録申請中 (デフォルト)
$config['CLIENT_SHONIN_ID']      = '1';					// 承認
$config['CLIENT_HISYONIN_ID']    = '2';					// 非承認
$config['CLIENT_ITIJITEISHI_ID'] = '7';					// 一時停止
$config['CLIENT_TEISHI_ID']      = '8';					// 強制停止
$config['CLIENT_TAIKAI_ID']      = '9';					// 退会

$config['CLIENT_SHINSEITYU']     = '登録申請中';
$config['CLIENT_SHONIN']         = '承認';
$config['CLIENT_HISYONIN']       = '非承認';
$config['CLIENT_ITIJITEISHI']    = '一時停止';
$config['CLIENT_TEISHI']         = '強制停止';
$config['CLIENT_TAIKAI']         = '退会';








/* End of file config_status.php */
/* Location: ./application/config/config_status.php */