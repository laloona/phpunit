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

use function array_shift;
use function array_unshift;
use PHPUnit\Framework\Assert\Assertion;
use PHPUnit\Framework\Assert\Equality\EqualsAssertion;

final class XmlStringEqualsXmlFileAssertion extends XmlAssertion
{
    protected function assertions(string $message, array &$values): Assertion
    {
        $actualXml    = array_shift($values);
        $expectedFile = array_shift($values);

        $expected = $this->file($expectedFile);
        $actual   = $this->string($actualXml);

        array_unshift($values, $actual, $expected);

        return new EqualsAssertion($this->runner());
    }
}
