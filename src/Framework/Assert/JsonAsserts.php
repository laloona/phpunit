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

use PHPUnit\Framework\Assert\Json\JsonFileEqualsJsonFileAssertion;
use PHPUnit\Framework\Assert\Json\JsonStringEqualsJsonFileAssertion;
use PHPUnit\Framework\Assert\Json\JsonStringEqualsJsonStringAssertion;
use PHPUnit\Framework\ExpectationFailedException;

trait JsonAsserts
{
    /**
     * Asserts that two given JSON encoded objects or arrays are equal.
     *
     * @throws ExpectationFailedException
     */
    final public static function assertJsonStringEqualsJsonString(string $expectedJson, string $actualJson, string $message = ''): void
    {
        new JsonStringEqualsJsonStringAssertion(AssertionRunner::get())->assert($message, $actualJson, $expectedJson);
    }

    /**
     * Asserts that two given JSON encoded objects or arrays are not equal.
     *
     * @throws ExpectationFailedException
     */
    final public static function assertJsonStringNotEqualsJsonString(string $expectedJson, string $actualJson, string $message = ''): void
    {
        new JsonStringEqualsJsonStringAssertion(AssertionRunner::get())->assertNot($message, $actualJson, $expectedJson);
    }

    /**
     * Asserts that the generated JSON encoded object and the content of the given file are equal.
     *
     * @throws ExpectationFailedException
     */
    final public static function assertJsonStringEqualsJsonFile(string $expectedFile, string $actualJson, string $message = ''): void
    {
        new JsonStringEqualsJsonFileAssertion(AssertionRunner::get())->assert($message, $actualJson, $expectedFile);
    }

    /**
     * Asserts that the generated JSON encoded object and the content of the given file are not equal.
     *
     * @throws ExpectationFailedException
     */
    final public static function assertJsonStringNotEqualsJsonFile(string $expectedFile, string $actualJson, string $message = ''): void
    {
        new JsonStringEqualsJsonFileAssertion(AssertionRunner::get())->assertNot($message, $actualJson, $expectedFile);
    }

    /**
     * Asserts that two JSON files are equal.
     *
     * @throws ExpectationFailedException
     */
    final public static function assertJsonFileEqualsJsonFile(string $expectedFile, string $actualFile, string $message = ''): void
    {
        new JsonFileEqualsJsonFileAssertion(AssertionRunner::get())->assert($message, $actualFile, $expectedFile);
    }

    /**
     * Asserts that two JSON files are not equal.
     *
     * @throws ExpectationFailedException
     */
    final public static function assertJsonFileNotEqualsJsonFile(string $expectedFile, string $actualFile, string $message = ''): void
    {
        new JsonFileEqualsJsonFileAssertion(AssertionRunner::get())->assertNot($message, $actualFile, $expectedFile);
    }
}
