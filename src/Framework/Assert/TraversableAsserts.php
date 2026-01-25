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

use ArrayAccess;
use PHPUnit\Framework\Assert\Traversable\ArrayHasKeyAssertion;
use PHPUnit\Framework\Assert\Traversable\ArrayIsEqualToArrayIgnoringListOfKeysAssertion;
use PHPUnit\Framework\Assert\Traversable\ArrayIsEqualToArrayOnlyConsideringListOfKeysAssertion;
use PHPUnit\Framework\Assert\Traversable\ArrayIsIdenticalToArrayIgnoringListOfKeysAssertion;
use PHPUnit\Framework\Assert\Traversable\ArrayIsIdenticalToArrayOnlyConsideringListOfKeysAssertion;
use PHPUnit\Framework\Assert\Traversable\ArraysAreEqualAssertion;
use PHPUnit\Framework\Assert\Traversable\ArraysAreEqualIgnoringOrderAssertion;
use PHPUnit\Framework\Assert\Traversable\ArraysAreIdenticalAssertion;
use PHPUnit\Framework\Assert\Traversable\ArraysAreIdenticalIgnoringOrderAssertion;
use PHPUnit\Framework\Assert\Traversable\ArraysHaveEqualValuesAssertion;
use PHPUnit\Framework\Assert\Traversable\ArraysHaveEqualValuesIgnoringOrderAssertion;
use PHPUnit\Framework\Assert\Traversable\ArraysHaveIdenticalValuesAssertion;
use PHPUnit\Framework\Assert\Traversable\ArraysHaveIdenticalValuesIgnoringOrderAssertion;
use PHPUnit\Framework\Assert\Traversable\ContainsAssertion;
use PHPUnit\Framework\Assert\Traversable\ContainsEqualsAssertion;
use PHPUnit\Framework\Assert\Traversable\ContainsOnlyArrayAssertion;
use PHPUnit\Framework\Assert\Traversable\ContainsOnlyBoolAssertion;
use PHPUnit\Framework\Assert\Traversable\ContainsOnlyCallableAssertion;
use PHPUnit\Framework\Assert\Traversable\ContainsOnlyClosedResourceAssertion;
use PHPUnit\Framework\Assert\Traversable\ContainsOnlyFloatAssertion;
use PHPUnit\Framework\Assert\Traversable\ContainsOnlyInstancesOfAssertion;
use PHPUnit\Framework\Assert\Traversable\ContainsOnlyIntAssertion;
use PHPUnit\Framework\Assert\Traversable\ContainsOnlyIterableAssertion;
use PHPUnit\Framework\Assert\Traversable\ContainsOnlyNullAssertion;
use PHPUnit\Framework\Assert\Traversable\ContainsOnlyNumericAssertion;
use PHPUnit\Framework\Assert\Traversable\ContainsOnlyObjectAssertion;
use PHPUnit\Framework\Assert\Traversable\ContainsOnlyResourceAssertion;
use PHPUnit\Framework\Assert\Traversable\ContainsOnlyScalarAssertion;
use PHPUnit\Framework\Assert\Traversable\ContainsOnlyStringAssertion;
use PHPUnit\Framework\Exception;
use PHPUnit\Framework\ExpectationFailedException;

trait TraversableAsserts
{
    /**
     * Asserts that two arrays are equal while only considering a list of keys.
     *
     * @param array<mixed>              $expected
     * @param array<mixed>              $actual
     * @param non-empty-list<array-key> $keysToBeConsidered
     *
     * @throws Exception
     * @throws ExpectationFailedException
     */
    final public static function assertArrayIsEqualToArrayOnlyConsideringListOfKeys(array $expected, array $actual, array $keysToBeConsidered, string $message = ''): void
    {
        new ArrayIsEqualToArrayOnlyConsideringListOfKeysAssertion(AssertionRunner::get())->assert($message, $actual, $expected, $keysToBeConsidered);
    }

    /**
     * Asserts that two arrays are equal while ignoring a list of keys.
     *
     * @param array<mixed>              $expected
     * @param array<mixed>              $actual
     * @param non-empty-list<array-key> $keysToBeIgnored
     *
     * @throws Exception
     * @throws ExpectationFailedException
     */
    final public static function assertArrayIsEqualToArrayIgnoringListOfKeys(array $expected, array $actual, array $keysToBeIgnored, string $message = ''): void
    {
        new ArrayIsEqualToArrayIgnoringListOfKeysAssertion(AssertionRunner::get())->assert($message, $actual, $expected, $keysToBeIgnored);
    }

    /**
     * Asserts that two arrays are identical while only considering a list of keys.
     *
     * @param array<mixed>              $expected
     * @param array<mixed>              $actual
     * @param non-empty-list<array-key> $keysToBeConsidered
     *
     * @throws Exception
     * @throws ExpectationFailedException
     */
    final public static function assertArrayIsIdenticalToArrayOnlyConsideringListOfKeys(array $expected, array $actual, array $keysToBeConsidered, string $message = ''): void
    {
        new ArrayIsIdenticalToArrayOnlyConsideringListOfKeysAssertion(AssertionRunner::get())->assert($message, $actual, $expected, $keysToBeConsidered);
    }

    /**
     * Asserts that two arrays are identical while ignoring a list of keys.
     *
     * @param array<mixed>              $expected
     * @param array<mixed>              $actual
     * @param non-empty-list<array-key> $keysToBeIgnored
     *
     * @throws Exception
     * @throws ExpectationFailedException
     */
    final public static function assertArrayIsIdenticalToArrayIgnoringListOfKeys(array $expected, array $actual, array $keysToBeIgnored, string $message = ''): void
    {
        new ArrayIsIdenticalToArrayIgnoringListOfKeysAssertion(AssertionRunner::get())->assert($message, $actual, $expected, $keysToBeIgnored);
    }

    /**
     * Asserts that an array has a specified key.
     *
     * @param array<mixed>|ArrayAccess<array-key, mixed> $array
     *
     * @throws Exception
     * @throws ExpectationFailedException
     */
    final public static function assertArrayHasKey(mixed $key, array|ArrayAccess $array, string $message = ''): void
    {
        new ArrayHasKeyAssertion(AssertionRunner::get())->assert($message, $array, $key);
    }

    /**
     * Asserts that an array does not have a specified key.
     *
     * @param array<mixed>|ArrayAccess<array-key, mixed> $array
     *
     * @throws Exception
     * @throws ExpectationFailedException
     */
    final public static function assertArrayNotHasKey(mixed $key, array|ArrayAccess $array, string $message = ''): void
    {
        new ArrayHasKeyAssertion(AssertionRunner::get())->assertNot($message, $array, $key);
    }

    /**
     * Assert that two arrays are identical.
     *
     * The (key, value) relationship matters, the order of the (key, value) pairs in the array matters, and keys as well as values are compared strictly.
     *
     * @param array<mixed> $expected
     * @param array<mixed> $actual
     *
     * @throws ExpectationFailedException
     */
    final public static function assertArraysAreIdentical(array $expected, array $actual, string $message = ''): void
    {
        new ArraysAreIdenticalAssertion(AssertionRunner::get())->assert($message, $actual, $expected);
    }

    /**
     * Assert that two arrays are identical while ignoring the order of their values.
     *
     * The (key, value) relationship matters, the order of the (key, value) pairs in the array does not matter, and keys as well as values are compared strictly.
     *
     * @param array<mixed> $expected
     * @param array<mixed> $actual
     *
     * @throws ExpectationFailedException
     */
    final public static function assertArraysAreIdenticalIgnoringOrder(array $expected, array $actual, string $message = ''): void
    {
        new ArraysAreIdenticalIgnoringOrderAssertion(AssertionRunner::get())->assert($message, $actual, $expected);
    }

    /**
     * Assert that two arrays have identical values.
     *
     * The (key, value) relationship does not matter, the order of the (key, value) pairs in the array matters, and values are compared strictly.
     *
     * @param array<mixed> $expected
     * @param array<mixed> $actual
     *
     * @throws ExpectationFailedException
     */
    final public static function assertArraysHaveIdenticalValues(array $expected, array $actual, string $message = ''): void
    {
        new ArraysHaveIdenticalValuesAssertion(AssertionRunner::get())->assert($message, $actual, $expected);
    }

    /**
     * Assert that two arrays have identical values while ignoring the order of these values.
     *
     * The (key, value) relationship does not matter, the order of the (key, value) pairs in the array does not matter, and values are compared strictly.
     *
     * @param array<mixed> $expected
     * @param array<mixed> $actual
     *
     * @throws ExpectationFailedException
     */
    final public static function assertArraysHaveIdenticalValuesIgnoringOrder(array $expected, array $actual, string $message = ''): void
    {
        new ArraysHaveIdenticalValuesIgnoringOrderAssertion(AssertionRunner::get())->assert($message, $actual, $expected);
    }

    /**
     * Assert that two arrays are equal.
     *
     * The (key, value) relationship matters, the order of the (key, value) pairs in the array matters, and keys as well as values are compared loosely.
     *
     * @param array<mixed> $expected
     * @param array<mixed> $actual
     */
    final public static function assertArraysAreEqual(array $expected, array $actual, string $message = ''): void
    {
        new ArraysAreEqualAssertion(AssertionRunner::get())->assert($message, $actual, $expected);
    }

    /**
     * Assert that two arrays are equal while ignoring the order of their values.
     *
     * The (key, value) relationship matters, the order of the (key, value) pairs in the array does not matter, and keys as well as values are compared loosely.
     *
     * @param array<mixed> $expected
     * @param array<mixed> $actual
     *
     * @throws ExpectationFailedException
     */
    final public static function assertArraysAreEqualIgnoringOrder(array $expected, array $actual, string $message = ''): void
    {
        new ArraysAreEqualIgnoringOrderAssertion(AssertionRunner::get())->assert($message, $actual, $expected);
    }

    /**
     * Assert that two arrays have equal values.
     *
     * The (key, value) relationship does not matter, the order of the (key, value) pairs in the array matters, and values are compared loosely.
     *
     * @param array<mixed> $expected
     * @param array<mixed> $actual
     */
    final public static function assertArraysHaveEqualValues(array $expected, array $actual, string $message = ''): void
    {
        new ArraysHaveEqualValuesAssertion(AssertionRunner::get())->assert($message, $actual, $expected);
    }

    /**
     * Assert that two arrays have equal values while ignoring the order of these values.
     *
     * The (key, value) relationship does not matter, the order of the (key, value) pairs in the array does not matter, and values are compared loosely.
     *
     * @param array<mixed> $expected
     * @param array<mixed> $actual
     *
     * @throws ExpectationFailedException
     */
    final public static function assertArraysHaveEqualValuesIgnoringOrder(array $expected, array $actual, string $message = ''): void
    {
        new ArraysHaveEqualValuesIgnoringOrderAssertion(AssertionRunner::get())->assert($message, $actual, $expected);
    }

    /**
     * Asserts that a haystack contains a needle.
     *
     * @param iterable<mixed> $haystack
     *
     * @throws Exception
     * @throws ExpectationFailedException
     */
    final public static function assertContains(mixed $needle, iterable $haystack, string $message = ''): void
    {
        new ContainsAssertion(AssertionRunner::get())->assert($message, $haystack, $needle);
    }

    /**
     * Asserts that a haystack does not contain a needle.
     *
     * @param iterable<mixed> $haystack
     *
     * @throws Exception
     * @throws ExpectationFailedException
     */
    final public static function assertNotContains(mixed $needle, iterable $haystack, string $message = ''): void
    {
        new ContainsAssertion(AssertionRunner::get())->assertNot($message, $haystack, $needle);
    }

    /**
     * @param iterable<mixed> $haystack
     *
     * @throws ExpectationFailedException
     */
    final public static function assertContainsEquals(mixed $needle, iterable $haystack, string $message = ''): void
    {
        new ContainsEqualsAssertion(AssertionRunner::get())->assert($message, $haystack, $needle);
    }

    /**
     * @param iterable<mixed> $haystack
     *
     * @throws ExpectationFailedException
     */
    final public static function assertNotContainsEquals(mixed $needle, iterable $haystack, string $message = ''): void
    {
        new ContainsEqualsAssertion(AssertionRunner::get())->assertNot($message, $haystack, $needle);
    }

    /**
     * Asserts that a haystack contains only values of type array.
     *
     * @phpstan-assert iterable<array<mixed>> $haystack
     *
     * @param iterable<mixed> $haystack
     *
     * @throws ExpectationFailedException
     */
    final public static function assertContainsOnlyArray(iterable $haystack, string $message = ''): void
    {
        new ContainsOnlyArrayAssertion(AssertionRunner::get())->assert($message, $haystack);
    }

    /**
     * Asserts that a haystack does not contain only values of type array.
     *
     * @param iterable<mixed> $haystack
     *
     * @throws ExpectationFailedException
     */
    final public static function assertContainsNotOnlyArray(iterable $haystack, string $message = ''): void
    {
        new ContainsOnlyArrayAssertion(AssertionRunner::get())->assertNot($message, $haystack);
    }

    /**
     * Asserts that a haystack contains only values of type bool.
     *
     * @phpstan-assert iterable<bool> $haystack
     *
     * @param iterable<mixed> $haystack
     *
     * @throws ExpectationFailedException
     */
    final public static function assertContainsOnlyBool(iterable $haystack, string $message = ''): void
    {
        new ContainsOnlyBoolAssertion(AssertionRunner::get())->assert($message, $haystack);
    }

    /**
     * Asserts that a haystack does not contain only values of type bool.
     *
     * @param iterable<mixed> $haystack
     *
     * @throws ExpectationFailedException
     */
    final public static function assertContainsNotOnlyBool(iterable $haystack, string $message = ''): void
    {
        new ContainsOnlyBoolAssertion(AssertionRunner::get())->assertNot($message, $haystack);
    }

    /**
     * Asserts that a haystack contains only values of type callable.
     *
     * @phpstan-assert iterable<callable> $haystack
     *
     * @param iterable<mixed> $haystack
     *
     * @throws ExpectationFailedException
     */
    final public static function assertContainsOnlyCallable(iterable $haystack, string $message = ''): void
    {
        new ContainsOnlyCallableAssertion(AssertionRunner::get())->assert($message, $haystack);
    }

    /**
     * Asserts that a haystack does not contain only values of type callable.
     *
     * @param iterable<mixed> $haystack
     *
     * @throws ExpectationFailedException
     */
    final public static function assertContainsNotOnlyCallable(iterable $haystack, string $message = ''): void
    {
        new ContainsOnlyCallableAssertion(AssertionRunner::get())->assertNot($message, $haystack);
    }

    /**
     * Asserts that a haystack contains only values of type float.
     *
     * @phpstan-assert iterable<float> $haystack
     *
     * @param iterable<mixed> $haystack
     *
     * @throws ExpectationFailedException
     */
    final public static function assertContainsOnlyFloat(iterable $haystack, string $message = ''): void
    {
        new ContainsOnlyFloatAssertion(AssertionRunner::get())->assert($message, $haystack);
    }

    /**
     * Asserts that a haystack does not contain only values of type float.
     *
     * @param iterable<mixed> $haystack
     *
     * @throws ExpectationFailedException
     */
    final public static function assertContainsNotOnlyFloat(iterable $haystack, string $message = ''): void
    {
        new ContainsOnlyFloatAssertion(AssertionRunner::get())->assertNot($message, $haystack);
    }

    /**
     * Asserts that a haystack contains only values of type int.
     *
     * @phpstan-assert iterable<int> $haystack
     *
     * @param iterable<mixed> $haystack
     *
     * @throws ExpectationFailedException
     */
    final public static function assertContainsOnlyInt(iterable $haystack, string $message = ''): void
    {
        new ContainsOnlyIntAssertion(AssertionRunner::get())->assert($message, $haystack);
    }

    /**
     * Asserts that a haystack does not contain only values of type int.
     *
     * @param iterable<mixed> $haystack
     *
     * @throws ExpectationFailedException
     */
    final public static function assertContainsNotOnlyInt(iterable $haystack, string $message = ''): void
    {
        new ContainsOnlyIntAssertion(AssertionRunner::get())->assertNot($message, $haystack);
    }

    /**
     * Asserts that a haystack contains only values of type iterable.
     *
     * @phpstan-assert iterable<iterable<mixed>> $haystack
     *
     * @param iterable<mixed> $haystack
     *
     * @throws ExpectationFailedException
     */
    final public static function assertContainsOnlyIterable(iterable $haystack, string $message = ''): void
    {
        new ContainsOnlyIterableAssertion(AssertionRunner::get())->assert($message, $haystack);
    }

    /**
     * Asserts that a haystack does not contain only values of type iterable.
     *
     * @param iterable<mixed> $haystack
     *
     * @throws ExpectationFailedException
     */
    final public static function assertContainsNotOnlyIterable(iterable $haystack, string $message = ''): void
    {
        new ContainsOnlyIterableAssertion(AssertionRunner::get())->assertNot($message, $haystack);
    }

    /**
     * Asserts that a haystack contains only values of type null.
     *
     * @phpstan-assert iterable<null> $haystack
     *
     * @param iterable<mixed> $haystack
     *
     * @throws ExpectationFailedException
     */
    final public static function assertContainsOnlyNull(iterable $haystack, string $message = ''): void
    {
        new ContainsOnlyNullAssertion(AssertionRunner::get())->assert($message, $haystack);
    }

    /**
     * Asserts that a haystack does not contain only values of type null.
     *
     * @param iterable<mixed> $haystack
     *
     * @throws ExpectationFailedException
     */
    final public static function assertContainsNotOnlyNull(iterable $haystack, string $message = ''): void
    {
        new ContainsOnlyNullAssertion(AssertionRunner::get())->assertNot($message, $haystack);
    }

    /**
     * Asserts that a haystack contains only values of type numeric.
     *
     * @phpstan-assert iterable<numeric> $haystack
     *
     * @param iterable<mixed> $haystack
     *
     * @throws ExpectationFailedException
     */
    final public static function assertContainsOnlyNumeric(iterable $haystack, string $message = ''): void
    {
        new ContainsOnlyNumericAssertion(AssertionRunner::get())->assert($message, $haystack);
    }

    /**
     * Asserts that a haystack does not contain only values of type numeric.
     *
     * @param iterable<mixed> $haystack
     *
     * @throws ExpectationFailedException
     */
    final public static function assertContainsNotOnlyNumeric(iterable $haystack, string $message = ''): void
    {
        new ContainsOnlyNumericAssertion(AssertionRunner::get())->assertNot($message, $haystack);
    }

    /**
     * Asserts that a haystack contains only values of type object.
     *
     * @phpstan-assert iterable<object> $haystack
     *
     * @param iterable<mixed> $haystack
     *
     * @throws ExpectationFailedException
     */
    final public static function assertContainsOnlyObject(iterable $haystack, string $message = ''): void
    {
        new ContainsOnlyObjectAssertion(AssertionRunner::get())->assert($message, $haystack);
    }

    /**
     * Asserts that a haystack does not contain only values of type object.
     *
     * @param iterable<mixed> $haystack
     *
     * @throws ExpectationFailedException
     */
    final public static function assertContainsNotOnlyObject(iterable $haystack, string $message = ''): void
    {
        new ContainsOnlyObjectAssertion(AssertionRunner::get())->assertNot($message, $haystack);
    }

    /**
     * Asserts that a haystack contains only values of type resource.
     *
     * @phpstan-assert iterable<resource> $haystack
     *
     * @param iterable<mixed> $haystack
     *
     * @throws ExpectationFailedException
     */
    final public static function assertContainsOnlyResource(iterable $haystack, string $message = ''): void
    {
        new ContainsOnlyResourceAssertion(AssertionRunner::get())->assert($message, $haystack);
    }

    /**
     * Asserts that a haystack does not contain only values of type resource.
     *
     * @param iterable<mixed> $haystack
     *
     * @throws ExpectationFailedException
     */
    final public static function assertContainsNotOnlyResource(iterable $haystack, string $message = ''): void
    {
        new ContainsOnlyResourceAssertion(AssertionRunner::get())->assertNot($message, $haystack);
    }

    /**
     * Asserts that a haystack contains only values of type closed resource.
     *
     * @phpstan-assert iterable<resource> $haystack
     *
     * @param iterable<mixed> $haystack
     *
     * @throws ExpectationFailedException
     */
    final public static function assertContainsOnlyClosedResource(iterable $haystack, string $message = ''): void
    {
        new ContainsOnlyClosedResourceAssertion(AssertionRunner::get())->assert($message, $haystack);
    }

    /**
     * Asserts that a haystack does not contain only values of type closed resource.
     *
     * @param iterable<mixed> $haystack
     *
     * @throws ExpectationFailedException
     */
    final public static function assertContainsNotOnlyClosedResource(iterable $haystack, string $message = ''): void
    {
        new ContainsOnlyClosedResourceAssertion(AssertionRunner::get())->assertNot($message, $haystack);
    }

    /**
     * Asserts that a haystack contains only values of type scalar.
     *
     * @phpstan-assert iterable<scalar> $haystack
     *
     * @param iterable<mixed> $haystack
     *
     * @throws ExpectationFailedException
     */
    final public static function assertContainsOnlyScalar(iterable $haystack, string $message = ''): void
    {
        new ContainsOnlyScalarAssertion(AssertionRunner::get())->assert($message, $haystack);
    }

    /**
     * Asserts that a haystack does not contain only values of type scalar.
     *
     * @param iterable<mixed> $haystack
     *
     * @throws ExpectationFailedException
     */
    final public static function assertContainsNotOnlyScalar(iterable $haystack, string $message = ''): void
    {
        new ContainsOnlyScalarAssertion(AssertionRunner::get())->assertNot($message, $haystack);
    }

    /**
     * Asserts that a haystack contains only values of type string.
     *
     * @phpstan-assert iterable<string> $haystack
     *
     * @param iterable<mixed> $haystack
     *
     * @throws ExpectationFailedException
     */
    final public static function assertContainsOnlyString(iterable $haystack, string $message = ''): void
    {
        new ContainsOnlyStringAssertion(AssertionRunner::get())->assert($message, $haystack);
    }

    /**
     * Asserts that a haystack does not contain only values of type string.
     *
     * @param iterable<mixed> $haystack
     *
     * @throws ExpectationFailedException
     */
    final public static function assertContainsNotOnlyString(iterable $haystack, string $message = ''): void
    {
        new ContainsOnlyStringAssertion(AssertionRunner::get())->assertNot($message, $haystack);
    }

    /**
     * Asserts that a haystack contains only instances of a specified interface or class name.
     *
     * @template T
     *
     * @phpstan-assert iterable<T> $haystack
     *
     * @param class-string<T> $className
     * @param iterable<mixed> $haystack
     *
     * @throws Exception
     * @throws ExpectationFailedException
     */
    final public static function assertContainsOnlyInstancesOf(string $className, iterable $haystack, string $message = ''): void
    {
        new ContainsOnlyInstancesOfAssertion(AssertionRunner::get())->assert($message, $haystack, $className);
    }

    /**
     * Asserts that a haystack does not contain only instances of a specified interface or class name.
     *
     * @param class-string    $className
     * @param iterable<mixed> $haystack
     *
     * @throws Exception
     * @throws ExpectationFailedException
     */
    final public static function assertContainsNotOnlyInstancesOf(string $className, iterable $haystack, string $message = ''): void
    {
        new ContainsOnlyInstancesOfAssertion(AssertionRunner::get())->assertNot($message, $haystack, $className);
    }
}
