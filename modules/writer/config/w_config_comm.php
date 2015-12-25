<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
| -------------------------------------------------------------------
| Common SETTINGS
| -------------------------------------------------------------------
*/

// ログインメンバー
$config['LOGIN_WRITER']     = 'writer';						// ライター
$config['LOGIN_CLIENT']     = 'client';						// クライアント
$config['LOGIN_ADMIN']      = 'admin';						// 管理者





/**
 * 【ライター情報】
 */

// 会員ランク名称
$config['MEM_RANK_NAME'] =
	array(
			"0" => "ゲスト",
			"1" => "ブロンズ",
			"2" => "シルバー",
			"3" => "ゴールド",
			"4" => "プラチナ",
			"5" => "プレミアム",
	);

// 会員ランク
$config['RANK_GUEST_ID']    = '0';							// ゲスト
$config['RANK_GUEST']       = 'ゲスト';
$config['RANK_BRONZE_ID']   = '1';							// ブロンズ
$config['RANK_BRONZE']      = 'ブロンズ';
$config['RANK_SILVER_ID']   = '2';							// シルバー
$config['RANK_SILVER']      = 'シルバー';
$config['RANK_GOLD_ID']     = '3';							// ゴールド
$config['RANK_GOLD']        = 'ゴールド';
$config['RANK_PLATINUM_ID'] = '4';							// プラチナ
$config['RANK_PLATINUM']    = 'プラチナ';
$config['RANK_PREMIERE_ID'] = '5';							// プレミアム
$config['RANK_PREMIERE']    = 'プレミアム';









// 仮PW発行制限時間
$config['REPASSWD_TIME']     = '30';							// 「分」指定







/**
 * 【クライアント情報】
 */

// デフォルト手数料率
$config['CLIENT_DEF_FEEID']   = '0';							// 料率設定
$config['CLIENT_DEF_FEE']     = '0.2';							// 20%

// デフォルト会員単価 (円)
$config['MEM_TANKA_PRICE'] =
	array(
			"0" => '0.0',										// ゲスト
			"1" => '0.8',										// ブロンズ
			"2" => '0.9',										// シルバー
			"3" => '1.0',										// ゴールド
			"4" => '1.0',										// プラチナ
			"5" => '1.0',										// プレミアム
	);

// 加算単価名称
$config['TANKA_ADD_NAME'] =
	array(
			"0" => "カンタン",
			"1" => "ふつう",
			"2" => "難しい",
	);

// デフォルト加算単価 (円)
$config['TANKA_ADD_PRICE'] =
	array(
			"0" => "-0.1",										// カンタン
			"1" => "0.0",										// ふつう
			"2" => "+0.1",										// 難しい
	);





/**
 * 【その他】
 */

// Pagination 設定:1ページ当たりの表示件数
$config['PAGINATION_PER_PAGE'] = '5';






/* End of file config_comm.php */
/* Location: ./application/config/config_comm.php */