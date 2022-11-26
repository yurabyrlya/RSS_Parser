<?php
declare(strict_types=1);
namespace App\Services;

use SimpleXMLElement;

class RssFeedParser implements XmlParserInterface
{

    /**
     * @param string $path
     * @return SimpleXMLElement|null
     */
    public function parse(string $path): ?SimpleXMLElement
    {
        $XMLData = file_get_contents($path);
        $xml = simplexml_load_string($XMLData, 'SimpleXMLElement', LIBXML_NOCDATA);
        if ($xml === false) {
            echo "Failed loading XML: ";
            foreach(libxml_get_errors() as $error) {
                echo "<br>", $error->message;
                return null;
            }
        }
        return $xml;
    }
}