<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
| -------------------------------------------------------------------
| Member Status SETTINGS
| -------------------------------------------------------------------
*/

// ライター会員ステータス
<<<<<<< HEAD
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




=======
$config['WRITER_KARISHINSEI']    = '1';					// 仮申請
$config['WRITER_SHINSEITYU']     = '2';					// 登録申請中
$config['WRITER_KARITOUROKU']    = '3';					// 仮登録
$config['WRITER_TOUROKU']        = '4';					// 登録
$config['WRITER_ITIJITEISHI']    = '7';					// 一時停止
$config['WRITER_TEISHI']         = '8';					// 強制停止
$config['WRITER_TAIKAI']         = '9';					// 退会
>>>>>>> 778364b11983b8ecd0f1ae7ce60860e34a1a71c4


/* End of file config_status.php */
/* Location: ./application/config/config_status.php */