<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
| -------------------------------------------------------------------
| Mail Template SETTINGS
| -------------------------------------------------------------------
*/

$config['MAILTPL_CONTACT_ID']    = '1';					// 問合せメール（全体）
$config['MAILTPL_CONTACT_WR_ID'] = '2';					// 問合せメール（ライターから）
$config['MAILTPL_CONTACT_CL_ID'] = '3';					// 問合せメール（クライアントから）

$config['MAILTPL_ENT_WRITER_ID'] = '11';				// ライター新規会員登録メール
$config['MAILTPL_ENT_CLIENT_ID'] = '12';				// クライアント新規会員登録メール

$config['MAILTPL_REPASSWORD_ID'] = '20';				// 仮パスワード登録メール

$config['MAILTPL_W_ENTRY_ID']    = '30';				// 仕事エントリー確認メール
$config['MAILTPL_W_POSTING_ID']  = '31';				// 仕事投稿確認メール
$config['MAILTPL_W_CANSEL_ID']   = '32';				// 仕事エントリーキャンセル確認メール



// 【クライアント 発送】
$config['MAILTPL_CL_xxxxxxxx_ID'] = '40';				// 仮パスワード登録メール






// 【ADMIN 発送】
$config['MAILTPL_AD_EL_ACCEPT_ID'] = '61';				// 案件申請「(非)承認」通知メール

$config['MAILTPL_AD_CHECKOK_ID']   = '65';				// 投稿審査通知メール

$config['MAILTPL_AD_DELIVER_ID']   = '66';				// 納品通知メール





/* End of file config_mailtpl.php */
/* Location: ./application/config/config_mailtpl.php */