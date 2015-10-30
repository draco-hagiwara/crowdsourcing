<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
| -------------------------------------------------------------------
| Common SETTINGS
| -------------------------------------------------------------------
*/

// ログインメンバー
$config['LOGIN_WRITER']     = 'writer';					// ライター
$config['LOGIN_CLIENT']     = 'client';					// クライアント
$config['LOGIN_ADMIN']      = 'admin';					// 管理者

// 会員ランク
$config['RANK_GUEST_ID']    = '0';						// ゲスト
$config['RANK_BRONZE_ID']   = '1';						// ブロンズ
$config['RANK_SILVER_ID']   = '2';						// シルバー
$config['RANK_GOLD_ID']     = '3';						// ゴールド
$config['RANK_PLATINUM_ID'] = '4';						// プラチナ
$config['RANK_PREMIERE_ID'] = '5';						// プレミアム

$config['RANK_GUEST']       = 'ゲスト';					// ゲスト
$config['RANK_BRONZE']      = 'ブロンズ';				// ブロンズ
$config['RANK_SILVER']      = 'シルバー';				// シルバー
$config['RANK_GOLD']        = 'ゴールド';				// ゴールド
$config['RANK_PLATINUM']    = 'プラチナ';				// プラチナ
$config['RANK_PREMIERE']    = 'プレミアム';				// プレミアム

// 加算単価情報
$config['ADDTANKA_KANTAN_ID'] = '0';					// カンタン
$config['ADDTANKA_FUTUU_ID']  = '1';					// ふつう
$config['ADDTANKA_NAN_ID']    = '2';					// 難しい

$config['ADDTANKA_KANTAN']    = 'カンタン';				// カンタン
$config['ADDTANKA_FUTUU']     = 'ふつう';				// ふつう
$config['ADDTANKA_NAN']       = '難しい';				// 難しい


// イベント情報
$config['PJ_EVENT_OSUSUME_ID']   = '1';
$config['PJ_EVENT_OSUSUME']      = 'オススメ';
$config['PJ_EVENT_KYUBO_ID']     = '2';
$config['PJ_EVENT_KYUBO']        = '急　募';
$config['PJ_EVENT_HITANKA_ID']   = '3';
$config['PJ_EVENT_HITANKA']      = '高単価';
$config['PJ_EVENT_LONG_ID']      = '4';
$config['PJ_EVENT_LONG']         = '期間長';
$config['PJ_EVENT_MOJISHORT_ID'] = '5';
$config['PJ_EVENT_MOJISHORT']    = '文字数少';







// ライター投稿制限時間
$config['POSTING_LIMIT_TIME'] = '120';					// 「分」指定

// 仮PW発行制限時間
$config['REPASSWD_TIME']     = '30';					// 「分」指定




// Pagination 設定:1ページ当たりの表示件数
$config['PAGINATION_PER_PAGE'] = '5';



/* End of file config_comm.php */
/* Location: ./application/config/config_comm.php */