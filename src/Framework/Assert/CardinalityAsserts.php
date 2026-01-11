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

use Countable;
use PHPUnit\Framework\Assert\Cardinality\CountAssertion;
use PHPUnit\Framework\Assert\Cardinality\EmptyAssertion;
use PHPUnit\Framework\Assert\Cardinality\GreaterThanAssertion;
use PHPUnit\Framework\Assert\Cardinality\GreaterThanOrEqualAssertion;
use PHPUnit\Framework\Assert\Cardinality\LessThanAssertion;
use PHPUnit\Framework\Assert\Cardinality\LessThanOrEqualAssertion;
use PHPUnit\Framework\Assert\Cardinality\SameSizeAssertion;
use PHPUnit\Framework\Exception;
use PHPUnit\Framework\ExpectationFailedException;
use PHPUnit\Framework\GeneratorNotSupportedException;

trait CardinalityAsserts
{
    /**
     * Asserts that a value is greater than another value.
     *
     * @throws ExpectationFailedException
     */
    final public static function assertGreaterThan(mixed $minimum, mixed $actual, string $message = ''): void
    {
        new GreaterThanAssertion(AssertionRunner::get())->assert($message, $actual, $minimum);
    }

    /**
     * Asserts that a value is not greater than another value.
     *
     * @throws ExpectationFailedException
     */
    final public static function assertNotGreaterThan(mixed $minimum, mixed $actual, string $message = ''): void
    {
        new GreaterThanAssertion(AssertionRunner::get())->assertNot($message, $actual, $minimum);
    }

    /**
     * Asserts that a value is greater than or equal to another value.
     *
     * @throws ExpectationFailedException
     */
    final public static function assertGreaterThanOrEqual(mixed $minimum, mixed $actual, string $message = ''): void
    {
        new GreaterThanOrEqualAssertion(AssertionRunner::get())->assert($message, $actual, $minimum);
    }

    /**
     * Asserts that a value is smaller than another value.
     *
     * @throws ExpectationFailedException
     */
    final public static function assertLessThan(mixed $maximum, mixed $actual, string $message = ''): void
    {
        new LessThanAssertion(AssertionRunner::get())->assert($message, $actual, $maximum);
    }

    /**
     * Asserts that a value is smaller than or equal to another value.
     *
     * @throws ExpectationFailedException
     */
    final public static function assertLessThanOrEqual(mixed $maximum, mixed $actual, string $message = ''): void
    {
        new LessThanOrEqualAssertion(AssertionRunner::get())->assert($message, $actual, $maximum);
    }

    /**
     * Assert that the size of two arrays (or `Countable` or `Traversable` objects)
     * is the same.
     *
     * @param Countable|iterable<mixed> $expected
     * @param Countable|iterable<mixed> $actual
     *
     * @throws Exception
     * @throws ExpectationFailedException
     * @throws GeneratorNotSupportedException
     */
    final public static function assertSameSize(Countable|iterable $expected, Countable|iterable $actual, string $message = ''): void
    {
        new SameSizeAssertion(AssertionRunner::get())->assert($message, $actual, $expected);
    }

    /**
     * Assert that the size of two arrays (or `Countable` or `Traversable` objects)
     * is not the same.
     *
     * @param Countable|iterable<mixed> $expected
     * @param Countable|iterable<mixed> $actual
     *
     * @throws Exception
     * @throws ExpectationFailedException
     * @throws GeneratorNotSupportedException
     */
    final public static function assertNotSameSize(Countable|iterable $expected, Countable|iterable $actual, string $message = ''): void
    {
        new SameSizeAssertion(AssertionRunner::get())->assertNot($message, $actual, $expected);
    }

    /**
     * Asserts the number of elements of an array, Countable or Traversable.
     *
     * @param Countable|iterable<mixed> $haystack
     *
     * @throws Exception
     * @throws ExpectationFailedException
     * @throws GeneratorNotSupportedException
     */
    final public static function assertCount(int $expectedCount, Countable|iterable $haystack, string $message = ''): void
    {
        new CountAssertion(AssertionRunner::get())->assert($message, $haystack, $expectedCount);
    }

    /**
     * Asserts the number of elements of an array, Countable or Traversable.
     *
     * @param Countable|iterable<mixed> $haystack
     *
     * @throws Exception
     * @throws ExpectationFailedException
     * @throws GeneratorNotSupportedException
     */
    final public static function assertNotCount(int $expectedCount, Countable|iterable $haystack, string $message = ''): void
    {
        new CountAssertion(AssertionRunner::get())->assertNot($message, $haystack, $expectedCount);
    }

    /**
     * Asserts that a variable is empty.
     *
     * @throws ExpectationFailedException
     * @throws GeneratorNotSupportedException
     */
    final public static function assertEmpty(mixed $actual, string $message = ''): void
    {
        new EmptyAssertion(AssertionRunner::get())->assert($message, $actual);
    }

    /**
     * Asserts that a variable is not empty.
     *
     * @throws ExpectationFailedException
     * @throws GeneratorNotSupportedException
     */
    final public static function assertNotEmpty(mixed $actual, string $message = ''): void
    {
        new EmptyAssertion(AssertionRunner::get())->assertNot($message, $actual);
    }
}
