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



// 【アドミン】
// 案件情報ステータス
$config['PJ_STATUS_JYUNBI_ID']   = '0';					// 準備中 (デフォルト)
$config['PJ_STATUS_JYUNBI']      = '準備中';
$config['PJ_STATUS_OPEN_ID']     = '1';					// 公開(募集中)
$config['PJ_STATUS_OPEN']        = '公開(募集中)';
$config['PJ_STATUS_REOPEN_ID']   = '2';					// (再)公開
$config['PJ_STATUS_REOPEN']      = '(再)公開';
$config['PJ_STATUS_PREMIERE_ID'] = '3';					// プレミア公開
$config['PJ_STATUS_PREMIERE']    = 'プレミア公開';
$config['PJ_STATUS_NOMINATE_ID'] = '4';					// 指名公開
$config['PJ_STATUS_NOMINATE']    = '指名公開';
$config['PJ_STATUS_CLOSE_ID']    = '5';					// 非公開
$config['PJ_STATUS_CLOSE']       = '非公開';
$config['PJ_STATUS_END_ID']      = '6';					// 公開終了
$config['PJ_STATUS_END']         = '公開終了';
$config['PJ_STATUS_HORYU_ID']    = '8';					// 保留
$config['PJ_STATUS_HORYU']       = '保留';
$config['PJ_STATUS_DELETE_ID']   = '9';					// 削除
$config['PJ_STATUS_DELETE']      = '削除';


// エントリーステータス
$config['PJ_ESTATUS_NOENTRY_ID']  = '0';				// エントリーなし (デフォルト)
$config['PJ_ESTATUS_ENTRY_ID']    = '1';				// エントリー中

$config['PJ_ESTATUS_NOENTRY']     = 'エントリーなし';	// エントリーなし (デフォルト)
$config['PJ_ESTATUS_ENTRY']       = 'エントリー中';		// エントリー中

// ライター作業ステータス
$config['PJ_WSTATUS_ENTRY_ID']    = '0';						// 投稿なし
$config['PJ_WSTATUS_CREATE_ID']   = '1';						// 原稿作成中
$config['PJ_WSTATUS_RECREATE_ID'] = '2';						// 原稿再作成中
$config['PJ_WSTATUS_CHECK_ID']    = '3';						// 投稿審査待ち
$config['PJ_WSTATUS_RECHECK_ID']  = '4';						// 投稿再審査待ち
$config['PJ_WSTATUS_CHECKOK_ID']  = '5';						// 審査OK
$config['PJ_WSTATUS_CHECKNG_ID']  = '6';						// 審査NG
$config['PJ_WSTATUS_TIMEOVER_ID'] = '7';						// 投稿なし(時間オーバー)

$config['PJ_WSTATUS_ENTRY']       = '投稿なし';					// 投稿なし
$config['PJ_WSTATUS_CREATE']      = '原稿作成中';				// 原稿作成中
$config['PJ_WSTATUS_RECREATE']    = '原稿再作成中';				// 原稿再作成中
$config['PJ_WSTATUS_CHECK']       = '投稿審査待ち';				// 投稿審査待ち
$config['PJ_WSTATUS_RECHECK']     = '投稿再審査待ち';			// 投稿再審査待ち
$config['PJ_WSTATUS_CHECKOK']     = '審査OK';					// 審査OK
$config['PJ_WSTATUS_CHECKNG']     = '審査NG';					// 審査NG
$config['PJ_WSTATUS_TIMEOVER']    = '投稿なし(時間オーバー)';	// 投稿なし(時間オーバー)

// 案件個別情報ステータス
$config['PJI_STATUS_CREATE_ID']   = '0';				// 原稿作成中 (デフォルト)
$config['PJI_STATUS_RECREATE_ID'] = '1';				// 原稿再作成中
$config['PJI_STATUS_CHECK_ID']    = '2';				// 審査待ち
$config['PJI_STATUS_CHECKOK_ID']  = '3';				// 審査OK
$config['PJI_STATUS_CHECKNG_ID']  = '4';				// 審査NG

$config['PJI_STATUS_CREATED']     = '原稿作成中';		// 原稿作成中 (デフォルト)
$config['PJI_STATUS_RECREATE']    = '原稿再作成中';	// 原稿再作成中
$config['PJI_STATUS_CHECK']       = '審査待ち';		// 審査待ち
$config['PJI_STATUS_CHECKOK']     = '審査OK';			// 審査OK
$config['PJI_STATUS_CHECKNG']     = '審査NG';			// 審査NG












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