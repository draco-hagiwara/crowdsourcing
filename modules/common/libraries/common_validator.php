<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 汎用バリデータ用クラス
 * 文字列・数字・文字数などのチェックを行う
 */
class CommonValidator
{
    /**
     * 日付のフォーマット配列
     */
    private static $DATE_FORMAT_ARRAY = array(
        self::DATE_FORMAT_YMD => self::NEW_DATE_FORMAT_YMD,
        self::DATE_FORMAT_YMDHIS => self::NEW_DATE_FORMAT_YMDHIS,
        self::DATE_FORMAT_YMD_H_I_S => self::NEW_DATE_FORMAT_YMD_H_I_S,
        self::DATE_FORMAT_Y_M_D => self::NEW_DATE_FORMAT_Y_M_D,
        self::DATE_FORMAT_Y_M_D_H_I_S => self::NEW_DATE_FORMAT_Y_M_D_H_I_S
    );

    /**
     * 日付のフォーマット
     */
    const NEW_DATE_FORMAT_YMD = '%Y%m%d';
    const NEW_DATE_FORMAT_Y_M_D = '%Y-%m-%d';
    const NEW_DATE_FORMAT_YMDHIS = '%Y%m%d%H%M%S';
    const NEW_DATE_FORMAT_YMD_H_I_S = '%Y%m%d %H:%M:%S';
    const NEW_DATE_FORMAT_Y_M_D_H_I_S = '%Y-%m-%d %H:%M:%S';

    const DATE_FORMAT_YMD = 'Ymd';
    const DATE_FORMAT_Y_M_D = 'Y-m-d';
    const DATE_FORMAT_YMDHIS = 'YmdHis';
    const DATE_FORMAT_YMD_H_I_S = 'Ymd H:i:s';
    const DATE_FORMAT_Y_M_D_H_I_S = 'Y-m-d H:i:s';


    /**
     * 日付(YYYYMMDD)の制限文字数
     */
    const YYYYMMDD_LENGTH = 8;


    /**
     * 英数字チェック
     *
     * @param string $arg チェックする値
     * @return bool 英数字のみの場合true、そうでなければfalse
     */
    public static function checkAlphanumeric($arg)
    {
        if(CommonValidator::checkString($arg) && preg_match('/^[a-zA-Z0-9]+$/', $arg)){
            return true;
        } else {
            return false;
        }
    }

    /**
     * 日付型のチェック<br>
     * フォーマットを指定した場合は指定したフォーマットでチェック<br>
     * フォーマットを指定しない場合はYYYYMMDDの形でチェック<br>
     * 存在しない日付はNGとする
     *
     * @param string $arg チェックする値
     * @param string $format フォーマット
     * @return bool フォーマットで指定された日付で且つ、存在する日付の場合true、そうでなければfalse
     */
    public static function checkDate($arg, $format = 'Ymd')
    {
        if(isset(self::$DATE_FORMAT_ARRAY[$format])){
            $tmpFormat = self::$DATE_FORMAT_ARRAY[$format];
            if(!is_null($tmpFormat)){
                $format = $tmpFormat;
            }
        }else{
            $format = null;
        }

        if (CommonValidator::checkString($arg) && CommonValidator::checkLength($arg,1)
        || CommonValidator::checkRange($arg,1) && CommonValidator::checkString($format)) {
            $date = new CommonDate($arg);
            if($date && $arg == $date->format($format) && checkdate($date->getMonth(), $date->getDay(), $date->getYear())){
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    /**
     * 日付時間型のチェック<br>
     * フォーマットを指定した場合は指定したフォーマットでチェック<br>
     * フォーマットを指定しない場合はYYYYMMDDhhmmssの形でチェック<br>
     * 存在しない日時はNGとする
     *
     * @param string $arg チェックする値
     * @param string $format フォーマット
     * @return bool フォーマットで指定された日付時間で且つ、存在する日付時間の場合true、そうでなければfalse
     */
    public static function checkDateTime($arg, $format = self::DATE_FORMAT_YMDHIS)
    {
        if (CommonValidator::checkDate($arg, $format)) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * 数字型チェック<br>
     * 数字だけからできていることをチェックする
     *
     * @param string $arg チェックする値
     * @return bool 数字だけの場合true、そうでなければfalse
     */
    public static function checkDigit($arg)
    {
        if (CommonValidator::checkString($arg) && ctype_digit((string)$arg)) {
            return true;
        } else {
            return false;
        }

    }

    /**
     * int型文字列のチェック<br>
     *
     * @param string $arg チェックする値
     * @return bool int型文字列の場合true、そうでなければfalse
     */
    public static function checkInt($arg)
    {
        if (CommonValidator::checkString($arg) && is_numeric((string)$arg)) {
            $arg += 0;
            if (is_int($arg)) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    /**
     * 文字列の長さチェック<br>
     * string型文字列の長さチェック<br>
     * 最小と最大を指定、最大を指定しない場合は無制限
     *
     * @param string $arg チェックする値(string型の文字列を設定すること)
     * @return bool 指定された範囲内の文字列長だった場合true、そうでなければfalse
     */
    public static function checkLength($arg, $min, $max = null)
    {
        if (is_string($arg) && CommonValidator::checkDigit($min) && mb_strlen($arg) >= $min
        && (is_null($max) || (CommonValidator::checkDigit($max) && mb_strlen($arg) <= $max))){
            return true;
        } else {
            return false;
        }
    }

    /**
     * 数値の範囲チェック<br>
     * 整数型数値の範囲チェック<br>
     * 最小と最大を指定、最大を指定しない場合は無制限
     *
     * @param int $arg チェックする値(整数型数値を設定すること)
     * @return bool 指定された範囲内の数値だった場合true、そうでなければfalse
     */
    public static function checkRange($arg, $min, $max = null)
    {
        if (CommonValidator::checkDigit($arg) && CommonValidator::checkDigit($min) && $arg >= $min
        && (is_null($max) || (CommonValidator::checkDigit($max) && $arg <= $max))){
            return true;
        } else {
            return false;
        }
    }

    /**
     * メールアドレス形チェック<br>
     * メールアドレスとして正しいかのチェックを行う
     *
     * @param string $arg チェックする値
     * @return bool メールアドレス形式の文字列だった場合true、そうでなければfalse
     */
    public static function checkMailAddress($mailAddress)
    {
        if (CommonValidator::checkString($mailAddress) && preg_match('/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/', $mailAddress)){
            return true;
        } else {
            return false;
        }
    }

    /**
     * シングルバイト文字列型チェック<br>
     * シングルバイト文字列かのチェックを行う
     *
     * @param string $arg チェックする値
     * @return bool シングルバイト文字列の場合true、そうでなければfalse
     */
    public static function checkSingleByte($arg)
    {
        if (CommonValidator::checkString($arg) && preg_match('/^[!-~]+$/i', $arg)) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * 文字列型チェック<br>
     * 文字列として扱えるかどうかのチェック<br>
     * 数字もOKとするが、arrayやクラスはNGとする
     *
     * @param string $arg チェックする値
     * @return bool 文字列の場合true、そうでなければfalse
     */
    public static function checkString($arg)
    {
        if (is_string($arg) || is_numeric($arg)) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * URI型のチェック<br>
     * https://mailto: の形をチェックする
     *
     * @param string $arg チェックする値
     * @return bool URI型文字列の場合true、そうでなければfalse
     */
    public static function checkUri($arg)
    {
        if (CommonValidator::checkString($arg) && preg_match(';^(https?://).+|(mailto:).+@.+;', $arg)) {
            return true;
        } else {
            return false;
        }
    }

}
