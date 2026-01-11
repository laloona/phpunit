<?php declare(strict_types=1);
/*
 * This file is part of PHPUnit.
 *
 * (c) Sebastian Bergmann <sebastian@phpunit.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace PHPUnit\Framework\Assert;

use PHPUnit\Framework\Assert\Xml\XmlFileEqualsXmlFileAssertion;
use PHPUnit\Framework\Assert\Xml\XmlStringEqualsXmlFileAssertion;
use PHPUnit\Framework\Assert\Xml\XmlStringEqualsXmlStringAssertion;
use PHPUnit\Framework\Exception;
use PHPUnit\Framework\ExpectationFailedException;
use PHPUnit\Util\Xml\XmlException;

trait XmlAsserts
{
    /**
     * Asserts that two XML files are equal.
     *
     * @throws Exception
     * @throws ExpectationFailedException
     * @throws XmlException
     */
    final public static function assertXmlFileEqualsXmlFile(string $expectedFile, string $actualFile, string $message = ''): void
    {
        new XmlFileEqualsXmlFileAssertion(AssertionRunner::get())->assert($message, $actualFile, $expectedFile);
    }

    /**
     * Asserts that two XML files are not equal.
     *
     * @throws Exception
     * @throws ExpectationFailedException
     * @throws XmlException
     */
    final public static function assertXmlFileNotEqualsXmlFile(string $expectedFile, string $actualFile, string $message = ''): void
    {
        new XmlFileEqualsXmlFileAssertion(AssertionRunner::get())->assertNot($message, $actualFile, $expectedFile);
    }

    /**
     * Asserts that two XML documents are equal.
     *
     * @throws ExpectationFailedException
     * @throws XmlException
     */
    final public static function assertXmlStringEqualsXmlFile(string $expectedFile, string $actualXml, string $message = ''): void
    {
        new XmlStringEqualsXmlFileAssertion(AssertionRunner::get())->assert($message, $actualXml, $expectedFile);
    }

    /**
     * Asserts that two XML documents are not equal.
     *
     * @throws ExpectationFailedException
     * @throws XmlException
     */
    final public static function assertXmlStringNotEqualsXmlFile(string $expectedFile, string $actualXml, string $message = ''): void
    {
        new XmlStringEqualsXmlFileAssertion(AssertionRunner::get())->assertNot($message, $actualXml, $expectedFile);
    }

    /**
     * Asserts that two XML documents are equal.
     *
     * @throws ExpectationFailedException
     * @throws XmlException
     */
    final public static function assertXmlStringEqualsXmlString(string $expectedXml, string $actualXml, string $message = ''): void
    {
        new XmlStringEqualsXmlStringAssertion(AssertionRunner::get())->assert($message, $actualXml, $expectedXml);
    }

    /**
     * Asserts that two XML documents are not equal.
     *
     * @throws ExpectationFailedException
     * @throws XmlException
     */
    final public static function assertXmlStringNotEqualsXmlString(string $expectedXml, string $actualXml, string $message = ''): void
    {
        new XmlStringEqualsXmlStringAssertion(AssertionRunner::get())->assertNot($message, $actualXml, $expectedXml);
    }
}
