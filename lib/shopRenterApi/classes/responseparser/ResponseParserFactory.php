<?php
namespace lib\shopRenterApi\classes\responseparser;
//require_once 'abstract.php';
/**
 * ResponseParser Factory
 *
 * @author Kántor András
 * @since 2013.02.22. 14:56
 */
class ResponseParserFactory
{
    /**
     * @param $contentType
     * @return XmlResponseParser
     */
    public function createParser($contentType)
    {
        switch ($contentType) {
            case 'application/xml':
                require_once 'XmlResponseParser.php';
                return new XmlResponseParser();
            case 'application/json':
                require_once 'JsonResponseParser.php';
                return new JsonResponseParser();
        }

        return false;
    }
}
