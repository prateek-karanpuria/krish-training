<?php

/**
 * Arabic to english translation helper class file
 */

namespace Ktpl\CityDropdown\Helper;

use Magento\Framework\Locale\ResolverInterface;

/**
 * TranslateArabicToEnglish class
 * @package Ktpl\CityDropdown\Helper
 */
class TranslateArabicToEnglish
{
    /**
     * @var ResolverInterface
     */
    public $currentLocale;

    /**
     * [__construct description]
     * @param ResolverInterface $localeResolver [description]
     */
    public function __construct(
        ResolverInterface $localeResolver
    )
    {
        $this->currentLocale = $localeResolver->getLocale();  
    }

    /**
     * This function is used to translate arabic string to english using GoogleAPIs translate service
     * @param  string $str
     * @return string
     */
    public function translate($str) {
        $returnasit = $str;

        if (mb_detect_encoding($str) !== 'UTF-8') {
            $str = mb_convert_encoding($str, mb_detect_encoding($str),'UTF-8');
        }

        preg_match_all('/.|\n/u', $str, $matches);

        $chars = $matches[0];
        $arabic_count = 0;
        $latin_count = 0;
        $total_count = 0;

        foreach ($chars as $char) {
            $pos = $this->uniord($char);

            if ($pos >= 1536 && $pos <= 1791) {
                $arabic_count++;
            } else if($pos > 123 && $pos < 123) {
                $latin_count++;
            }
            $total_count++;
        }

        if (($arabic_count/$total_count) > 0.3) {
            // 30% arabic chars, its probably arabic
            // return true;
            $res = file_get_contents("https://translate.googleapis.com/translate_a/single?client=gtx&ie=UTF-8&oe=UTF-8&dt=bd&dt=ex&dt=ld&dt=md&dt=qca&dt=rw&dt=rm&dt=ss&dt=t&dt=at&sl=ar&tl=en&hl=hl&q=".urlencode($str), $_SERVER['DOCUMENT_ROOT']."/transes.html");
            $res = json_decode($res);

            if (isset($res[0][0][0])) {
                if (strlen($res[0][0][0]) > 35) {
                    return substr($res[0][0][0], 0, 35);
                }
                return $res[0][0][0];
            }
        }
    }

    public function uniord($u) { 
        $k = mb_convert_encoding($u, 'UCS-2LE', 'UTF-8'); 

        $k1 = ord(substr($k, 0, 1));
        $k2 = ord(substr($k, 1, 1));

        return $k2 * 256 + $k1; 
    }

    /**
     * Prints content in formatted way with code die facility
     * @param  string/array $content
     * @param  boolean $die
     */
    public function print2($content = '', $die = false)
    {
        echo "<pre>".print_r($content)."</pre>";
        if ($die) die();
    }
}
