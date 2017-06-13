<?php

namespace Seven;

final class Utils
{
    /**
     * @var string
     */
    private static $key = 'forevermerciless';

    /**
     * @param $text
     * @return string
     */
    public static function encrypt($text) : string
    {
        if ($text == '')
            return $text;
        $IV = mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_CBC), MCRYPT_RAND);

        return base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, self::$key, $text, MCRYPT_MODE_CBC, $IV)."-[--IV-[-".$IV);
    }

    /**
     * @param $text
     * @return string
     */
    public static function decrypt($text) : string
    {
        if ($text == '')
            return $text;
        $text = base64_decode($text);
        $IV = substr($text, strrpos($text, "-[--IV-[-") + 9);
        $text = str_replace("-[--IV-[-".$IV, "", $text);

        return rtrim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, self::$key, $text, MCRYPT_MODE_CBC, $IV), "\0");
    }

    /**
     * @param array $array
     * @param bool $encryptedArrayKey
     * @return array
     */
    public static function encryptArray(array $array, $encryptedArrayKey = false) : array
    {
        $encrypted = array();
        if ($encryptedArrayKey) {
            foreach ($array as $key => $value) {
                $encrypted[self::encrypt($key)] = self::encrypt($value);
            }
            return $encrypted;
        }
        foreach ($array as $key => $value) {
            $encrypted[$key] = self::encrypt($value);
        }

        return $encrypted;
    }

    /**
     * @param array $array
     * @param bool $encryptedArrayKey
     * @return array
     */
    public static function decryptArray(array $array, $encryptedArrayKey = false) : array
    {
        $decrypted = array();
        if ($encryptedArrayKey) {
            foreach ($array as $key => $value) {
                $decrypted[self::decrypt($key)] = self::decrypt($value);
            }
            return $decrypted;
        }
        foreach ($array as $key => $value) {
            $decrypted[$key] = self::decrypt($value);
        }

        return $decrypted;
    }

    /**
     * @param $str
     * @return string
     */
    public static function removeAccentedChars($str)
    {
        $str = self::strToUtf8(
            $str,
            'áéíóúàèìòùãõâêîôôäëïöüÁÉÍÓÚÀÈÌÒÙÃÕÂÊÎÔÛÄËÏÖÜ',
            'aeiouaeiouaoaeiooaeiouAEIOUAEIOUAOAEIOOAEIOU'
        );

        return $str;
    }

    /**
     * @param $str
     * @param $from
     * @param $to
     * @return string
     */
    private static function strToUtf8($str, $from, $to)
    {
        $keys = array();
        $values = array();
        preg_match_all('/./u', $from, $keys);
        preg_match_all('/./u', $to, $values);
        $mapping = array_combine($keys[0], $values[0]);

        return strtr($str, $mapping);
    }

    /**
     * @param $bytes
     * @param int $decimals
     * @return string
     */
    public static function humanBytes($bytes, $decimals = 2) : string
    {
        $sz = 'BKMGTP';
        $factor = (int)floor((strlen($bytes) - 1) / 3);
        return sprintf("%.{$decimals}f", $bytes / pow(1024, $factor)) . @$sz[$factor];
    }

    /**
     * Generic mask
     * Example: mask(11222333000199, '##.###.###/####-##');
     * @param $val
     * @param string $mask
     * @return string
     */
    public static function mask($val, string $mask) : string
    {
        $masked = '';
        $k = 0;
        $val = (string) $val;
        for ($i = 0; $i <= strlen($mask) - 1; $i++) {
            if ($mask[$i] == '#') {
                if (isset($val[$k])) {
                    $masked .= $val[$k++];
                }
            }
            else {
                if (isset($mask[$i])) {
                    $masked .= $mask[$i];
                }
            }
        }
        return $masked;
    }

    /**
     * Removes a directory recursively
     * @param $dir
     */
    public static function delDirTree($dir)
    {
        $files = glob( $dir . '*', GLOB_MARK );
        foreach ($files as $file) {
            if (substr($file, -1 ) == '/') {
                self::delDirTree($file);
            }
            else {
                unlink($file);
            }
        }
        if (is_dir($dir)) {
            rmdir($dir);
        }
    }

    public static function sendMail()
    {
        $mail = new \PHPMailer();
        $mail->IsSMTP();
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = 'ssl';
        $mail->Host = "smtp.gmail.com";
        $mail->Port = 465;
        $mail->IsHTML(true);
        $mail->Username = "siipecapoeira@gmail.com";
        $mail->Password = "(*lfagsiipe1992)*";
        $mail->SetFrom("lfaugusto.gomes@gmail.com");
        $mail->Subject = "Test";
        $mail->Body = "hello";
        $mail->AddAddress("siipecapoeira@gmail.com");

        if(!$mail->Send()) {
            echo "Mailer Error: " . $mail->ErrorInfo;
        } else {
            echo "Message has been sent";
        }
    }
}