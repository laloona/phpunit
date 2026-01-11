<?php declare(strict_types=1);
/*
 * This file is part of PHPUnit.
 *
 * (c) Sebastian Bergmann <sebastian@phpunit.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace PHPUnit\Framework\Assert\Xml;

use DOMDocument;
use PHPUnit\Framework\Assert\BinaryAssertion;
use PHPUnit\Util\Xml\Loader as XmlLoader;

abstract class XmlAssertion extends BinaryAssertion
{
    protected function file(string $file): DOMDocument
    {
        return (new XmlLoader)->loadFile($file);
    }

    protected function string(string $xml): DOMDocument
    {
        return (new XmlLoader)->load($xml);
    }
}
