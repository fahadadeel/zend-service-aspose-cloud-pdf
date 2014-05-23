<?php
/**
 * Created by PhpStorm.
 * User: Fahad Adeel
 * Date: 5/9/14
 * Time: 12:34 PM
 */

namespace ZendService\Aspose\Cloud\Pdf;


class Utils {

    /**
     * @param $value
     * @return mixed
     */

    private static function encodeBase64UrlSafe($value) {
        return str_replace(array('+', '/'), array('-', '_'), base64_encode($value));
    }

    /**
     * @param $value
     * @return string
     */

    private static function decodeBase64UrlSafe($value) {
        return base64_decode(str_replace(array('-', '_'), array('+', '/'), $value));
    }

    /**
     * @param $uri
     * @param $appSid
     * @param $appKey
     * @return string
     */

    public static function sign($uri, $appSid, $appKey)
    {
        // parse the uri
        $uri = rtrim($uri, '/');
        $uriParts = parse_url($uri);



        $uriToSign = $uriParts['scheme'] . '://' . $uriParts['host'] . str_replace(array(' ','+'),array('%20','%2B'),$uriParts['path']);

        if(isset($uriParts['query']) && !empty($uriParts['query']))
        {
            $uriToSign .= "?" . str_replace(array(' ','+'),array('%20','%2B'),$uriParts['query']) . '&appSID=' . $appSid;
        }
        else
        {
            $uriToSign .= '?appSID=' . $appSid;
        }

        // Create a signature using the private key and the URL-encoded
        // string using HMAC SHA1. This signature will be binary.
        $signature = hash_hmac('sha1', $uriToSign, $appKey, true);

        $encodedSignature = self::encodeBase64UrlSafe($signature);
        $encodedSignature = str_replace(array('=','-','_'),array('','%2b','%2f'),$encodedSignature);

        preg_match_all("/%[0-9a-f]{2}/",$encodedSignature,$m);
        foreach($m[0] as $code)
        {
            $encodedSignature = str_replace($code,strtoupper($code),$encodedSignature);
        }

        return $uriToSign . '&signature=' . $encodedSignature;
    }

    /**
     * Saves the files
     *
     * @param string $input input stream.
     * @param string $fileName fileName along with the full path.
     *
     *
     */
    public static function saveFile($input, $fileName)
    {
        $fh = fopen($fileName, 'w') or die('cant open file');
        fwrite($fh, $input);
        fclose($fh);
    }

    /**
     * Validates the output stream
     *
     * @param string $result input stream.
     *
     */

    public static function validateOutput($result) {
        $string = (string) $result;
        $validate = array('Unknown file format.', 'Unable to read beyond the end of the stream',
            'Index was out of range', 'Cannot read that as a ZipFile', 'Not a Microsoft PowerPoint 2007 presentation',
            'Index was outside the bounds of the array', 'An attempt was made to move the position before the beginning of the stream',
        );
        $invalid = 0;
        foreach ($validate as $key => $value) {
            $pos = strpos($string, $value);
            if ($pos === 1) {
                $invalid = 1;
            }
        }
        if ($invalid == 1)
            return $string;
        else
            return '';
    }

    /**
     * returns the file name
     *
     * @param string $file input filename.
     *
     */

    public static function getFileName($file) {
        $info = pathinfo($file);

        $file_name = basename($file, '.' . $info['extension']);
        return $file_name;
    }


} 