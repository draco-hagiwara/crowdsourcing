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


// 案件情報ステータス
$config['PJ_STATUS_JYUNBI_ID']   = '0';					// 準備中 (デフォルト)
$config['PJ_STATUS_JYUNBI']      = '準備中';
$config['PJ_STATUS_OPEN_ID']     = '1';					// 公開(募集中)
$config['PJ_STATUS_OPEN']        = '公開(募集中)';
$config['PJ_STATUS_REOPEN_ID']   = '2';					// 再公開
$config['PJ_STATUS_REOPEN']      = '再公開';
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
$config['PJ_ESTATUS_NOENTRY']     = 'エントリーなし';
$config['PJ_ESTATUS_ENTRY_ID']    = '1';				// エントリー中
$config['PJ_ESTATUS_ENTRY']       = 'エントリー中';


// ライター作業ステータス
$config['PJ_WSTATUS_ENTRY_ID']    = '0';						// 投稿なし
$config['PJ_WSTATUS_ENTRY']       = '投稿なし';
$config['PJ_WSTATUS_CREATE_ID']   = '1';						// 原稿作成中
$config['PJ_WSTATUS_CREATE']      = '原稿作成中';
$config['PJ_WSTATUS_RECREATE_ID'] = '2';						// 原稿再作成中
$config['PJ_WSTATUS_RECREATE']    = '原稿再作成中';
$config['PJ_WSTATUS_CHECK_ID']    = '3';						// 投稿審査待ち
$config['PJ_WSTATUS_CHECK']       = '投稿審査待ち';
//$config['PJ_WSTATUS_RECHECK_ID']  = '4';						// 投稿再審査待ち
//$config['PJ_WSTATUS_RECHECK']     = '投稿再審査待ち';
$config['PJ_WSTATUS_CHECKOK_ID']  = '4';						// 審査OK
$config['PJ_WSTATUS_CHECKOK']     = '審査OK';
$config['PJ_WSTATUS_CHECKNG_ID']  = '5';						// 審査NG
$config['PJ_WSTATUS_CHECKNG']     = '審査NG';
$config['PJ_WSTATUS_TIMEOVER_ID'] = '6';						// 投稿なし(時間オーバー)
$config['PJ_WSTATUS_TIMEOVER']    = '投稿なし(時間オーバー)';
$config['PJ_WSTATUS_CANCEL_ID']   = '7';						// ライターキャンセル
$config['PJ_WSTATUS_CANCEL']      = 'ライターキャンセル';





/* End of file config_status.php */
/* Location: ./application/config/config_status.php */