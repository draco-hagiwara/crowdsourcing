<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
| -------------------------------------------------------------------
| Common SETTINGS
| -------------------------------------------------------------------
*/

// ファイルアップロード 設定


// クライアント 請求明細情報
$config['AD_PAY_CLDETAIL'] =
    array(
        "upload_path"   => '../user_data/csv_up/pay_cldetail/',		// ドキュメントルートからの相対パス
        "allowed_types" => 'csv',									// 許容するファイルのMIMEタイプを設定
        "overwrite"     => TRUE,									// ファイルは上書き
        "max_size"      => '10000',									// 許容する最大ファイルサイズをKB単位で設定
    );


// クライアント 月次請求情報
$config['AD_PAY_CLLIST'] =
array(
		"upload_path"   => '../user_data/csv_up/pay_cllist/',		// ドキュメントルートからの相対パス
		"allowed_types" => 'csv',									// 許容するファイルのMIMEタイプを設定
		"overwrite"     => TRUE,									// ファイルは上書き
		"max_size"      => '10000',									// 許容する最大ファイルサイズをKB単位で設定
);


// ライター 入金明細情報
$config['AD_PAY_WRDETAIL'] =
array(
		"upload_path"   => '../user_data/csv_up/pay_wrdetail/',		// ドキュメントルートからの相対パス
		"allowed_types" => 'csv',									// 許容するファイルのMIMEタイプを設定
		"overwrite"     => TRUE,									// ファイルは上書き
		"max_size"      => '10000',									// 許容する最大ファイルサイズをKB単位で設定
);


// ライター 締日入金情報
$config['AD_PAY_WRLIST'] =
array(
		"upload_path"   => '../user_data/csv_up/pay_wrlist/',		// ドキュメントルートからの相対パス
		"allowed_types" => 'csv',									// 許容するファイルのMIMEタイプを設定
		"overwrite"     => TRUE,									// ファイルは上書き
		"max_size"      => '10000',									// 許容する最大ファイルサイズをKB単位で設定
);


/* End of file config_comm.php */
/* Location: ./application/config/config_comm.php */