<?php

namespace sync;

class Functions {

    public static function getUrlFromLink($link) {
        $result = preg_replace('#^https?://#', '', rtrim($link, '/'));
        return $result;
    }

    public static function getIdFromUrl($pattern, $url) {
        $id = str_replace($pattern, "", $url);
        return $id;
    }

    public static function convertCategoryArrayToString($categories) {
        $result = "";
        $count = 0;
        foreach ($categories as $category) {
            $result .= $category->getName();
            if ($count < count($categories) - 1) {
                $result .= ", ";
            }
            $count++;
        }
        return $result;
    }

    public static function convertStringToUtf8($string) {
//        setlocale(LC_ALL, "hu_HU");
//       $string =  utf8_encode($string);
//        $text = iconv("UTF-8", "ISO-8859-2", $string);
        return $string;
//        return html_entity_decode($text);
    }

}
