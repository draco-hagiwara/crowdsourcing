<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
| -------------------------------------------------------------------
| Common SETTINGS
| -------------------------------------------------------------------
*/

// ログインメンバー
$config['LOGIN_WRITER']     = 'writer';						// ライター
$config['LOGIN_CLIENT']     = 'client';                     // クライアント
$config['LOGIN_ADMIN']      = 'admin';                      // 管理者

// 会員ランク
$config['RANK_GUEST_ID']    = '0';                          // ゲスト
$config['RANK_BRONZE_ID']   = '1';                          // ブロンズ
$config['RANK_SILVER_ID']   = '2';                          // シルバー
$config['RANK_GOLD_ID']     = '3';                          // ゴールド
$config['RANK_PLATINUM_ID'] = '4';                          // プラチナ
$config['RANK_PREMIERE_ID'] = '5';                          // プレミアム

$config['RANK_GUEST']       = 'ゲスト';                     // ゲスト
$config['RANK_BRONZE']      = 'ブロンズ';                   // ブロンズ
$config['RANK_SILVER']      = 'シルバー';                   // シルバー
$config['RANK_GOLD']        = 'ゴールド';                   // ゴールド
$config['RANK_PLATINUM']    = 'プラチナ';                   // プラチナ
$config['RANK_PREMIERE']    = 'プレミアム';                 // プレミアム

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

// 加算単価情報
$config['ADDTANKA_KANTAN_ID'] = '0';                        // カンタン
$config['ADDTANKA_FUTUU_ID']  = '1';                        // ふつう
$config['ADDTANKA_NAN_ID']    = '2';                        // 難しい

$config['ADDTANKA_KANTAN']    = 'カンタン';                 // カンタン
$config['ADDTANKA_FUTUU']     = 'ふつう';                   // ふつう
$config['ADDTANKA_NAN']       = '難しい';                   // 難しい


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
$config['PJ_EVENT_MOJISHORT_ID'] = '99';
$config['PJ_EVENT_MOJISHORT']    = '締切間近';



// ライター入金状況名称
$config['WRITER_PAY_FLG'] =
array(
		'0' => '未入金',
		'1' => '入金済',
		'2' => '保留',
		'3' => '返金',
);

// ライター締日設定名称
$config['WRITER_PAY_LIMIT'] =
array(
		'0' => '日次',
		'1' => '週次',
		'2' => '月次',
		'3' => '曜日',
		'4' => '10日',
);

// クライアント支払状況名称
$config['CLIENT_PAY_FLG'] =
array(
		'0' => '未支払',
		'1' => '支払済',
		'2' => '保留',
		'3' => '返金',
);


// デフォルト会員単価 (円)
$config['MEM_TANKA_PRICE'] =
array(
        "0" => '0.0',                                       // ゲスト
        "1" => '0.8',                                       // ブロンズ
        "2" => '0.9',                                       // シルバー
        "3" => '1.0',                                       // ゴールド
        "4" => '1.0',                                       // プラチナ
        "5" => '1.0',                                       // プレミアム
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
        "0" => "-0.1",                                      // カンタン
        "1" => "0.0",                                       // ふつう
        "2" => "+0.1",                                      // 難しい
);

// ライター投稿制限時間デフォルト値
$config['POSTING_LIMIT_TIME'] = '120';                      // 「分」指定

// 仮PW発行制限時間デフォルト値
$config['REPASSWD_TIME']      = '30';                       // 「分」指定

// ポイント計算
$config['POINT_CAL'] =
    array(
        '0' => '切り上げ',
        '1' => '切り捨て',
        '2' => '四捨五入',
);
$config['POINT_CAL_ID']       = '0';                        // デフォルト値指定

// 税額計算
$config['TAX_CAL'] =
array(
        '0' => '切り上げ',
        '1' => '切り捨て',
        '2' => '四捨五入',
);
$config['TAX_CAL_ID']         = '1';                        // デフォルト値指定

$config['TAX_INOUT'] =
array(
        '0' => '税抜',
        '1' => '税込',
        '2' => 'なし',
);
$config['TAX_INOUT_ID']       = '0';                        // デフォルト値指定
$config['TAX_RATE']           = '8';                        // 税率 8％


// デフォルト手数料 : クライアント新規登録時のデフォルト値
$config['CLIENT_DEF_FEEID']   = '2';						// 手数料設定
$config['CLIENT_DEF_FIX']     = '49800';					// 月額固定金額
$config['CLIENT_DEF_RESULT']  = '0.2';						// 成果報酬率
$config['CLIENT_DEF_ADJUST']  = '0';						// 調整金額
$config['CLIENT_DEF_INITIAL'] = '0';						// 初期導入費用

$config['CLIENT_FEE'] =
array(
		'0' => '月額固定',
		'1' => '成果報酬',
		'2' => '月額固定 + 成果報酬',
);




// Pagination 設定:1ページ当たりの表示件数
//                 ※ ～/system/libraries/Pagination.php に不具合あり
$config['PAGINATION_PER_PAGE'] = '5';



/* End of file config_comm.php */
/* Location: ./application/config/config_comm.php */