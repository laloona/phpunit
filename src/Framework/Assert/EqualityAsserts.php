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

use PHPUnit\Framework\Assert\Equality\EqualsAssertion;
use PHPUnit\Framework\Assert\Equality\EqualsCanonicalizingAssertion;
use PHPUnit\Framework\Assert\Equality\EqualsIgnoringCaseAssertion;
use PHPUnit\Framework\Assert\Equality\EqualsWithDeltaAssertion;
use PHPUnit\Framework\ExpectationFailedException;

trait EqualityAsserts
{
    /**
     * Asserts that two variables are equal.
     *
     * @throws ExpectationFailedException
     */
    final public static function assertEquals(mixed $expected, mixed $actual, string $message = ''): void
    {
        new EqualsAssertion(AssertionRunner::get())->assert($message, $actual, $expected);
    }

    /**
     * Asserts that two variables are not equal.
     *
     * @throws ExpectationFailedException
     */
    final public static function assertNotEquals(mixed $expected, mixed $actual, string $message = ''): void
    {
        new EqualsAssertion(AssertionRunner::get())->assertNot($message, $actual, $expected);
    }

    /**
     * Asserts that two variables are equal (canonicalizing).
     *
     * @throws ExpectationFailedException
     */
    final public static function assertEqualsCanonicalizing(mixed $expected, mixed $actual, string $message = ''): void
    {
        new EqualsCanonicalizingAssertion(AssertionRunner::get())->assert($message, $actual, $expected);
    }

    /**
     * Asserts that two variables are not equal (canonicalizing).
     *
     * @throws ExpectationFailedException
     */
    final public static function assertNotEqualsCanonicalizing(mixed $expected, mixed $actual, string $message = ''): void
    {
        new EqualsCanonicalizingAssertion(AssertionRunner::get())->assertNot($message, $actual, $expected);
    }

    /**
     * Asserts that two variables are equal (ignoring case).
     *
     * @throws ExpectationFailedException
     */
    final public static function assertEqualsIgnoringCase(mixed $expected, mixed $actual, string $message = ''): void
    {
        new EqualsIgnoringCaseAssertion(AssertionRunner::get())->assert($message, $actual, $expected);
    }

    /**
     * Asserts that two variables are not equal (ignoring case).
     *
     * @throws ExpectationFailedException
     */
    final public static function assertNotEqualsIgnoringCase(mixed $expected, mixed $actual, string $message = ''): void
    {
        new EqualsIgnoringCaseAssertion(AssertionRunner::get())->assertNot($message, $actual, $expected);
    }

    /**
     * Asserts that two variables are equal (with delta).
     *
     * @throws ExpectationFailedException
     */
    final public static function assertEqualsWithDelta(mixed $expected, mixed $actual, float $delta, string $message = ''): void
    {
        new EqualsWithDeltaAssertion(AssertionRunner::get())->assert($message, $actual, $expected, $delta);
    }

    /**
     * Asserts that two variables are not equal (with delta).
     *
     * @throws ExpectationFailedException
     */
    final public static function assertNotEqualsWithDelta(mixed $expected, mixed $actual, float $delta, string $message = ''): void
    {
        new EqualsWithDeltaAssertion(AssertionRunner::get())->assertNot($message, $actual, $expected, $delta);
    }
}
