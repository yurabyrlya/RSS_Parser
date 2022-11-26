<?php
declare(strict_types=1);

namespace App\Services;

use SimpleXMLElement;
/**
 * XMl Parser contract
 */
interface XmlParserInterface
{
    /**
     * @param string $path
     * @return SimpleXMLElement
     */
    public function parse(string $path): ?SimpleXMLElement;
}