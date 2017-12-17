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

}
