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

use PHPUnit\Framework\Assert\String\MatchesRegularExpressionAssertion;
use PHPUnit\Framework\Assert\String\StringContainsStringAssertion;
use PHPUnit\Framework\Assert\String\StringContainsStringIgnoringCaseAssertion;
use PHPUnit\Framework\Assert\String\StringContainsStringIgnoringLineEndingsAssertion;
use PHPUnit\Framework\Assert\String\StringEndsWithAssertion;
use PHPUnit\Framework\Assert\String\StringEqualsFileAssertion;
use PHPUnit\Framework\Assert\String\StringEqualsFileCanonicalizingAssertion;
use PHPUnit\Framework\Assert\String\StringEqualsFileIgnoringCaseAssertion;
use PHPUnit\Framework\Assert\String\StringEqualsStringIgnoringLineEndingsAssertion;
use PHPUnit\Framework\Assert\String\StringMatchesFormatAssertion;
use PHPUnit\Framework\Assert\String\StringMatchesFormatFileAssertion;
use PHPUnit\Framework\Assert\String\StringStartsWithAssertion;
use PHPUnit\Framework\ExpectationFailedException;
use PHPUnit\Framework\InvalidArgumentException;

trait StringAsserts
{
    /**
     * Asserts that the contents of a string is equal
     * to the contents of a file.
     *
     * @throws ExpectationFailedException
     */
    final public static function assertStringEqualsFile(string $expectedFile, string $actualString, string $message = ''): void
    {
        new StringEqualsFileAssertion(AssertionRunner::get())->assert($message, $actualString, $expectedFile);
    }

    /**
     * Asserts that the contents of a string is not equal
     * to the contents of a file.
     *
     * @throws ExpectationFailedException
     */
    final public static function assertStringNotEqualsFile(string $expectedFile, string $actualString, string $message = ''): void
    {
        new StringEqualsFileAssertion(AssertionRunner::get())->assertNot($message, $actualString, $expectedFile);
    }

    /**
     * Asserts that the contents of a string is equal
     * to the contents of a file (canonicalizing).
     *
     * @throws ExpectationFailedException
     */
    final public static function assertStringEqualsFileCanonicalizing(string $expectedFile, string $actualString, string $message = ''): void
    {
        new StringEqualsFileCanonicalizingAssertion(AssertionRunner::get())->assert($message, $actualString, $expectedFile);
    }

    /**
     * Asserts that the contents of a string is not equal
     * to the contents of a file (canonicalizing).
     *
     * @throws ExpectationFailedException
     */
    final public static function assertStringNotEqualsFileCanonicalizing(string $expectedFile, string $actualString, string $message = ''): void
    {
        new StringEqualsFileCanonicalizingAssertion(AssertionRunner::get())->assertNot($message, $actualString, $expectedFile);
    }

    /**
     * Asserts that the contents of a string is equal
     * to the contents of a file (ignoring case).
     *
     * @throws ExpectationFailedException
     */
    final public static function assertStringEqualsFileIgnoringCase(string $expectedFile, string $actualString, string $message = ''): void
    {
        new StringEqualsFileIgnoringCaseAssertion(AssertionRunner::get())->assert($message, $actualString, $expectedFile);
    }

    /**
     * Asserts that the contents of a string is not equal
     * to the contents of a file (ignoring case).
     *
     * @throws ExpectationFailedException
     */
    final public static function assertStringNotEqualsFileIgnoringCase(string $expectedFile, string $actualString, string $message = ''): void
    {
        new StringEqualsFileIgnoringCaseAssertion(AssertionRunner::get())->assertNot($message, $actualString, $expectedFile);
    }

    /**
     * @throws ExpectationFailedException
     */
    final public static function assertStringContainsStringIgnoringLineEndings(string $needle, string $haystack, string $message = ''): void
    {
        new StringContainsStringIgnoringLineEndingsAssertion(AssertionRunner::get())->assert($message, $haystack, $needle);
    }

    /**
     * Asserts that two strings are equal except for line endings.
     *
     * @throws ExpectationFailedException
     */
    final public static function assertStringEqualsStringIgnoringLineEndings(string $expected, string $actual, string $message = ''): void
    {
        new StringEqualsStringIgnoringLineEndingsAssertion(AssertionRunner::get())->assert($message, $actual, $expected);
    }

    /**
     * Asserts that a string matches a given format string.
     *
     * @throws ExpectationFailedException
     */
    final public static function assertStringMatchesFormat(string $format, string $string, string $message = ''): void
    {
        new StringMatchesFormatAssertion(AssertionRunner::get())->assert($message, $string, $format);
    }

    /**
     * Asserts that a string matches a given format file.
     *
     * @throws ExpectationFailedException
     */
    final public static function assertStringMatchesFormatFile(string $formatFile, string $string, string $message = ''): void
    {
        new StringMatchesFormatFileAssertion(AssertionRunner::get())->assert($message, $string, $formatFile);
    }

    /**
     * Asserts that a string starts with a given prefix.
     *
     * @param non-empty-string $prefix
     *
     * @throws ExpectationFailedException
     * @throws InvalidArgumentException
     */
    final public static function assertStringStartsWith(string $prefix, string $string, string $message = ''): void
    {
        new StringStartsWithAssertion(AssertionRunner::get())->assert($message, $string, $prefix);
    }

    /**
     * Asserts that a string starts not with a given prefix.
     *
     * @param non-empty-string $prefix
     *
     * @throws ExpectationFailedException
     * @throws InvalidArgumentException
     */
    final public static function assertStringStartsNotWith(string $prefix, string $string, string $message = ''): void
    {
        new StringStartsWithAssertion(AssertionRunner::get())->assertNot($message, $string, $prefix);
    }

    /**
     * @throws ExpectationFailedException
     */
    final public static function assertStringContainsString(string $needle, string $haystack, string $message = ''): void
    {
        new StringContainsStringAssertion(AssertionRunner::get())->assert($message, $haystack, $needle);
    }

    /**
     * @throws ExpectationFailedException
     */
    final public static function assertStringNotContainsString(string $needle, string $haystack, string $message = ''): void
    {
        new StringContainsStringAssertion(AssertionRunner::get())->assertNot($message, $haystack, $needle);
    }

    /**
     * @throws ExpectationFailedException
     */
    final public static function assertStringContainsStringIgnoringCase(string $needle, string $haystack, string $message = ''): void
    {
        new StringContainsStringIgnoringCaseAssertion(AssertionRunner::get())->assert($message, $haystack, $needle);
    }

    /**
     * @throws ExpectationFailedException
     */
    final public static function assertStringNotContainsStringIgnoringCase(string $needle, string $haystack, string $message = ''): void
    {
        new StringContainsStringIgnoringCaseAssertion(AssertionRunner::get())->assertNot($message, $haystack, $needle);
    }

    /**
     * Asserts that a string ends with a given suffix.
     *
     * @param non-empty-string $suffix
     *
     * @throws ExpectationFailedException
     * @throws InvalidArgumentException
     */
    final public static function assertStringEndsWith(string $suffix, string $string, string $message = ''): void
    {
        new StringEndsWithAssertion(AssertionRunner::get())->assert($message, $string, $suffix);
    }

    /**
     * Asserts that a string ends not with a given suffix.
     *
     * @param non-empty-string $suffix
     *
     * @throws ExpectationFailedException
     * @throws InvalidArgumentException
     */
    final public static function assertStringEndsNotWith(string $suffix, string $string, string $message = ''): void
    {
        new StringEndsWithAssertion(AssertionRunner::get())->assertNot($message, $string, $suffix);
    }

    /**
     * Asserts that a string matches a given regular expression.
     *
     * @throws ExpectationFailedException
     */
    final public static function assertMatchesRegularExpression(string $pattern, string $string, string $message = ''): void
    {
        new MatchesRegularExpressionAssertion(AssertionRunner::get())->assert($message, $string, $pattern);
    }

    /**
     * Asserts that a string does not match a given regular expression.
     *
     * @throws ExpectationFailedException
     */
    final public static function assertDoesNotMatchRegularExpression(string $pattern, string $string, string $message = ''): void
    {
        new MatchesRegularExpressionAssertion(AssertionRunner::get())->assertNot($message, $string, $pattern);
    }
}
