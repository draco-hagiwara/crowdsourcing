<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
| -------------------------------------------------------------------
| Member Status SETTINGS
| -------------------------------------------------------------------
*/

// 【ライター】
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


// 【クライアント】
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

// 案件申請ステータス
$config['C_ENTRY_JYUNBI_ID']     = '0';					// 準備中 (デフォルト)
$config['C_ENTRY_SHINSEI_ID']    = '1';					// 申請中
$config['C_ENTRY_SYOUNIN_ID']    = '2';					// 承認
$config['C_ENTRY_HISYOUNIN_ID']  = '3';					// 非承認
$config['C_ENTRY_CANSEL_ID']     = '4';					// 取消
$config['C_ENTRY_DELETE_ID']     = '5';					// 削除

$config['C_ENTRY_JYUNBI']        = '準備中';			// 準備中 (デフォルト)
$config['C_ENTRY_SHINSEI']       = '申請';				// 申請中
$config['C_ENTRY_SYOUNIN']       = '承認';				// 承認
$config['C_ENTRY_HISYOUNIN']     = '非承認';			// 非承認
$config['C_ENTRY_CANSEL']        = '取消';				// 取消
$config['C_ENTRY_DELETE']        = '削除';				// 削除





//$config['CLIENT_SEL_STATUS'] =
//	array(
//        ''  => '選択してください',
//		'0' => $config['CLIENT_SHINSEITYU'],
//		'1' => $config['CLIENT_SHONIN'],
//		'2' => $config['CLIENT_HISYONIN'],
//		'7' => $config['CLIENT_ITIJITEISHI'],
//		'8' => $config['CLIENT_TEISHI'],
//		'9' => $config['CLIENT_TAIKAI']
//);
//
//$config['CLIENT_SEL_ORDERBY01'] =
//	array (
//			'DESC' => '降順',
//			'ASC'  => '昇順'
//);
//
//$config['CLIENT_SEL_ORDERBY02'] =
//	array (
//			''     => '選択してください',
//			'DESC' => '降順',
//			'ASC'  => '昇順'
//);






/* End of file config_status.php */
/* Location: ./application/config/config_status.php */