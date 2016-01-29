<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
| -------------------------------------------------------------------
| Form_Validation SETTINGS
| -------------------------------------------------------------------
*/

// 各項目のバリデーションルール設定
$config = array(
		// お問合せフォーム（全体）
		'contact/contact' => array(
				array(
						'field'   => 'inputName',
						'label'   => '名　前',
						'rules'   => 'trim|required|max_length[50]'
				),
				array(
						'field'   => 'inputEmail',
						'label'   => 'メールアドレス',
						'rules'   => 'trim|required|valid_email'
				),
				array(
						'field'   => 'inputTel',
						'label'   => '連絡先',
						'rules'   => 'trim|regex_match[/^[0-9\-]+$/]|max_length[15]'
				),
				array(
						'field'   => 'inputComment',
						'label'   => 'お問合せ内容',
						'rules'   => 'trim|max_length[100]'
				)
		),
		'contact/confirm' => array(
				array(
						'field'   => 'inputName',
						'label'   => '名　前',
						'rules'   => 'trim|required|max_length[50]'
				),
				array(
						'field'   => 'inputEmail',
						'label'   => 'メールアドレス',
						'rules'   => 'trim|required|valid_email'
				),
				array(
						'field'   => 'inputTel',
						'label'   => '連絡先',
						'rules'   => 'trim|regex_match[/^[0-9\-]+$/]|max_length[15]'
				),
				array(
						'field'   => 'inputComment',
						'label'   => 'お問合せ内容',
						'rules'   => 'trim|max_length[100]'
				)
		),
		'contact/complete' => array(
				array(
						'field'   => 'inputName',
						'label'   => '名　前',
						'rules'   => 'trim|required|max_length[50]'
				),
				array(
						'field'   => 'inputEmail',
						'label'   => 'メールアドレス',
						'rules'   => 'trim|required|valid_email'
				),
				array(
						'field'   => 'inputTel',
						'label'   => '連絡先',
						'rules'   => 'trim|regex_match[/^[0-9\-]+$/]|max_length[15]'
				),
				array(
						'field'   => 'inputComment',
						'label'   => 'お問合せ内容',
						'rules'   => 'trim|max_length[100]'
				)
		),
		// クライアント新規登録フォーム
		'entryclient/entryclient' => array(
				array(
						'field'   => 'cl_company',
						'label'   => '会社名',
						'rules'   => 'trim|required|max_length[100]'
				),
				array(
						'field'   => 'cl_company_kana',
						'label'   => '会社名カナ（全角）',
						'rules'   => 'trim|regex_match[/^[ァ-タダ-ヴ　ー・]+$/]|required|max_length[100]'
				),
				array(
						'field'   => 'cl_president01',
						'label'   => '代表者姓',
						'rules'   => 'trim|required|max_length[50]'
				),
				array(
						'field'   => 'cl_president02',
						'label'   => '代表者名',
						'rules'   => 'trim|required|max_length[50]'
				),
				array(
						'field'   => 'cl_president_kana01',
						'label'   => '代表者セイ（全角）',
						'rules'   => 'trim|required|max_length[50]'
				),
				array(
						'field'   => 'cl_president_kana02',
						'label'   => '代表者メイ（全角）',
						'rules'   => 'trim|required|max_length[50]'
				),
				array(
						'field'   => 'cl_department',
						'label'   => '担当部署',
						'rules'   => 'trim|max_length[50]'
				),
				array(
						'field'   => 'cl_person01',
						'label'   => '担当者姓',
						'rules'   => 'trim|required|max_length[50]'
				),
				array(
						'field'   => 'cl_person02',
						'label'   => '担当者名',
						'rules'   => 'trim|required|max_length[50]'
				),
				array(
						'field'   => 'cl_person_kana01',
						'label'   => '担当者セイ（全角）',
						'rules'   => 'trim|required|max_length[50]'
				),
				array(
						'field'   => 'cl_person_kana02',
						'label'   => '担当者メイ（全角）',
						'rules'   => 'trim|required|max_length[50]'
				),
				array(
						'field'   => 'cl_zip01',
						'label'   => '郵便番号（3ケタ）',
						'rules'   => 'trim|required|max_length[3]|is_numeric'
				),
				array(
						'field'   => 'cl_zip02',
						'label'   => '郵便番号（4ケタ）',
						'rules'   => 'trim|required|max_length[4]|is_numeric'
				),
				array(
						'field'   => 'cl_pref',
						'label'   => '都道府県',
						'rules'   => 'trim|required|max_length[2]'
				),
				array(
						'field'   => 'cl_addr01',
						'label'   => '市区町村',
						'rules'   => 'trim|required|max_length[100]'
				),
				array(
						'field'   => 'cl_addr02',
						'label'   => '町名・番地',
						'rules'   => 'trim|required|max_length[100]'
				),
				array(
						'field'   => 'cl_buil',
						'label'   => 'ビル・マンション名など',
						'rules'   => 'trim|max_length[100]'
				),
				array(
						'field'   => 'cl_email',
						'label'   => 'メールアドレス（代表）',
						'rules'   => 'trim|required|valid_email'
				),
				array(
						'field'   => 'cl_email2',
						'label'   => 'メールアドレス（予備）',
						'rules'   => 'trim|valid_email'
				),
				array(
						'field'   => 'cl_tel01',
						'label'   => '代表電話番号',
						'rules'   => 'trim|required|regex_match[/^[0-9\-]+$/]|max_length[15]'
				),
				array(
						'field'   => 'cl_tel02',
						'label'   => '担当者電話番号',
						'rules'   => 'trim|regex_match[/^[0-9\-]+$/]|max_length[15]'
				),
				array(
						'field'   => 'cl_mobile',
						'label'   => '担当者携帯番号',
						'rules'   => 'trim|regex_match[/^[0-9\-]+$/]|max_length[15]'
				),
				array(
						'field'   => 'cl_fax',
						'label'   => 'ＦＡＸ番号',
						'rules'   => 'trim|regex_match[/^[0-9\-]+$/]|max_length[15]'
				),
				array(
						'field'   => 'cl_hp',
						'label'   => '会社ＨＰ(http://～)',
						'rules'   => 'trim|regex_match[/^(https?)(:\/\/[-_.!~*\'()a-zA-Z0-9;\/?:\@&=+\$,%#]+)$/]|max_length[100]'
				),
				array(
						'field'   => 'cm_password',
						'label'   => 'パスワード',
						'rules'   => 'trim|required|regex_match[/^[\x21-\x7e]+$/]|min_length[8]|max_length[50]|matches[retype_password]'
				),
				array(
						'field'   => 'retype_password',
						'label'   => 'パスワード再入力',
						'rules'   => 'trim|required|regex_match[/^[\x21-\x7e]+$/]|min_length[8]|max_length[50]|matches[cm_password]'
				)
		),
		'entryclient/confirm' => array(
				array(
						'field'   => 'cl_company',
						'label'   => '会社名',
						'rules'   => 'trim|required|max_length[100]'
				),
				array(
						'field'   => 'cl_company_kana',
						'label'   => '会社名カナ（全角）',
						'rules'   => 'trim|regex_match[/^[ァ-タダ-ヴ　ー・]+$/]|required|max_length[100]'
				),
				array(
						'field'   => 'cl_president01',
						'label'   => '代表者姓',
						'rules'   => 'trim|required|max_length[50]'
				),
				array(
						'field'   => 'cl_president02',
						'label'   => '代表者名',
						'rules'   => 'trim|required|max_length[50]'
				),
				array(
						'field'   => 'cl_president_kana01',
						'label'   => '代表者セイ（全角）',
						'rules'   => 'trim|required|max_length[50]'
				),
				array(
						'field'   => 'cl_president_kana02',
						'label'   => '代表者メイ（全角）',
						'rules'   => 'trim|required|max_length[50]'
				),
				array(
						'field'   => 'cl_department',
						'label'   => '担当部署',
						'rules'   => 'trim|max_length[50]'
				),
				array(
						'field'   => 'cl_person01',
						'label'   => '担当者姓',
						'rules'   => 'trim|required|max_length[50]'
				),
				array(
						'field'   => 'cl_person02',
						'label'   => '担当者名',
						'rules'   => 'trim|required|max_length[50]'
				),
				array(
						'field'   => 'cl_person_kana01',
						'label'   => '担当者セイ（全角）',
						'rules'   => 'trim|required|max_length[50]'
				),
				array(
						'field'   => 'cl_person_kana02',
						'label'   => '担当者メイ（全角）',
						'rules'   => 'trim|required|max_length[50]'
				),
				array(
						'field'   => 'cl_zip01',
						'label'   => '郵便番号（3ケタ）',
						'rules'   => 'trim|required|max_length[3]|is_numeric'
				),
				array(
						'field'   => 'cl_zip02',
						'label'   => '郵便番号（4ケタ）',
						'rules'   => 'trim|required|max_length[4]|is_numeric'
				),
				array(
						'field'   => 'cl_pref',
						'label'   => '都道府県',
						'rules'   => 'trim|required|max_length[2]'
				),
				array(
						'field'   => 'cl_addr01',
						'label'   => '市区町村',
						'rules'   => 'trim|required|max_length[100]'
				),
				array(
						'field'   => 'cl_addr02',
						'label'   => '町名・番地',
						'rules'   => 'trim|required|max_length[100]'
				),
				array(
						'field'   => 'cl_buil',
						'label'   => 'ビル・マンション名など',
						'rules'   => 'trim|max_length[100]'
				),
				array(
						'field'   => 'cl_email',
						'label'   => 'メールアドレス（代表）',
						'rules'   => 'trim|required|valid_email'
				),
				array(
						'field'   => 'cl_email2',
						'label'   => 'メールアドレス（予備）',
						'rules'   => 'trim|valid_email'
				),
				array(
						'field'   => 'cl_tel01',
						'label'   => '代表電話番号',
						'rules'   => 'trim|required|regex_match[/^[0-9\-]+$/]|max_length[15]'
				),
				array(
						'field'   => 'cl_tel02',
						'label'   => '担当者電話番号',
						'rules'   => 'trim|regex_match[/^[0-9\-]+$/]|max_length[15]'
				),
				array(
						'field'   => 'cl_mobile',
						'label'   => '担当者携帯番号',
						'rules'   => 'trim|regex_match[/^[0-9\-]+$/]|max_length[15]'
				),
				array(
						'field'   => 'cl_fax',
						'label'   => 'ＦＡＸ番号',
						'rules'   => 'trim|regex_match[/^[0-9\-]+$/]|max_length[15]'
				),
				array(
						'field'   => 'cl_hp',
						'label'   => '会社ＨＰ(http://～)',
						'rules'   => 'trim|regex_match[/^(https?)(:\/\/[-_.!~*\'()a-zA-Z0-9;\/?:\@&=+\$,%#]+)$/]|max_length[100]'
				),
				array(
						'field'   => 'cm_password',
						'label'   => 'パスワード',
						'rules'   => 'trim|required|regex_match[/^[\x21-\x7e]+$/]|min_length[8]|max_length[50]|matches[retype_password]'
				),
				array(
						'field'   => 'retype_password',
						'label'   => 'パスワード再入力',
						'rules'   => 'trim|required|regex_match[/^[\x21-\x7e]+$/]|min_length[8]|max_length[50]|matches[cm_password]'
				)
		),
		'entryclient/complete' => array(
				array(
						'field'   => 'cl_company',
						'label'   => '会社名',
						'rules'   => 'trim|required|max_length[100]'
				),
				array(
						'field'   => 'cl_company_kana',
						'label'   => '会社名カナ（全角）',
						'rules'   => 'trim|regex_match[/^[ァ-タダ-ヴ　ー・]+$/]|required|max_length[100]'
				),
				array(
						'field'   => 'cl_president01',
						'label'   => '代表者姓',
						'rules'   => 'trim|required|max_length[50]'
				),
				array(
						'field'   => 'cl_president02',
						'label'   => '代表者名',
						'rules'   => 'trim|required|max_length[50]'
				),
				array(
						'field'   => 'cl_president_kana01',
						'label'   => '代表者セイ（全角）',
						'rules'   => 'trim|required|max_length[50]'
				),
				array(
						'field'   => 'cl_president_kana02',
						'label'   => '代表者メイ（全角）',
						'rules'   => 'trim|required|max_length[50]'
				),
				array(
						'field'   => 'cl_department',
						'label'   => '担当部署',
						'rules'   => 'trim|max_length[50]'
				),
				array(
						'field'   => 'cl_person01',
						'label'   => '担当者姓',
						'rules'   => 'trim|required|max_length[50]'
				),
				array(
						'field'   => 'cl_person02',
						'label'   => '担当者名',
						'rules'   => 'trim|required|max_length[50]'
				),
				array(
						'field'   => 'cl_person_kana01',
						'label'   => '担当者セイ（全角）',
						'rules'   => 'trim|required|max_length[50]'
				),
				array(
						'field'   => 'cl_person_kana02',
						'label'   => '担当者メイ（全角）',
						'rules'   => 'trim|required|max_length[50]'
				),
				array(
						'field'   => 'cl_zip01',
						'label'   => '郵便番号（3ケタ）',
						'rules'   => 'trim|required|max_length[3]|is_numeric'
				),
				array(
						'field'   => 'cl_zip02',
						'label'   => '郵便番号（4ケタ）',
						'rules'   => 'trim|required|max_length[4]|is_numeric'
				),
				array(
						'field'   => 'cl_pref',
						'label'   => '都道府県',
						'rules'   => 'trim|required|max_length[2]'
				),
				array(
						'field'   => 'cl_addr01',
						'label'   => '市区町村',
						'rules'   => 'trim|required|max_length[100]'
				),
				array(
						'field'   => 'cl_addr02',
						'label'   => '町名・番地',
						'rules'   => 'trim|required|max_length[100]'
				),
				array(
						'field'   => 'cl_buil',
						'label'   => 'ビル・マンション名など',
						'rules'   => 'trim|max_length[100]'
				),
				array(
						'field'   => 'cl_email',
						'label'   => 'メールアドレス（代表）',
						'rules'   => 'trim|required|valid_email'
				),
				array(
						'field'   => 'cl_email2',
						'label'   => 'メールアドレス（予備）',
						'rules'   => 'trim|valid_email'
				),
				array(
						'field'   => 'cl_tel01',
						'label'   => '代表電話番号',
						'rules'   => 'trim|required|regex_match[/^[0-9\-]+$/]|max_length[15]'
				),
				array(
						'field'   => 'cl_tel02',
						'label'   => '担当者電話番号',
						'rules'   => 'trim|regex_match[/^[0-9\-]+$/]|max_length[15]'
				),
				array(
						'field'   => 'cl_mobile',
						'label'   => '担当者携帯番号',
						'rules'   => 'trim|regex_match[/^[0-9\-]+$/]|max_length[15]'
				),
				array(
						'field'   => 'cl_fax',
						'label'   => 'ＦＡＸ番号',
						'rules'   => 'trim|regex_match[/^[0-9\-]+$/]|max_length[15]'
				),
				array(
						'field'   => 'cl_hp',
						'label'   => '会社ＨＰ(http://～)',
						'rules'   => 'trim|regex_match[/^(https?)(:\/\/[-_.!~*\'()a-zA-Z0-9;\/?:\@&=+\$,%#]+)$/]|max_length[100]'
				),
				array(
						'field'   => 'cm_password',
						'label'   => 'パスワード',
						'rules'   => 'trim|required|regex_match[/^[\x21-\x7e]+$/]|min_length[8]|max_length[50]|matches[retype_password]'
				),
				array(
						'field'   => 'retype_password',
						'label'   => 'パスワード再入力',
						'rules'   => 'trim|required|regex_match[/^[\x21-\x7e]+$/]|min_length[8]|max_length[50]|matches[cm_password]'
				)
		),
);
//$config = array('entryclient/confirm' => $config['entryclient/entryclient']);			// 上手く動かない。1つはOK、2つ×。



/* End of file form_validation.php */
/* Location: ./application/config/form_validation.php */