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

use PHPUnit\Framework\Assert\Type\InstanceOfAssertion;
use PHPUnit\Framework\Assert\Type\IsArrayAssertion;
use PHPUnit\Framework\Assert\Type\IsBoolAssertion;
use PHPUnit\Framework\Assert\Type\IsCallableAssertion;
use PHPUnit\Framework\Assert\Type\IsClosedResourceAssertion;
use PHPUnit\Framework\Assert\Type\IsFloatAssertion;
use PHPUnit\Framework\Assert\Type\IsIntAssertion;
use PHPUnit\Framework\Assert\Type\IsIterableAssertion;
use PHPUnit\Framework\Assert\Type\IsListAssertion;
use PHPUnit\Framework\Assert\Type\IsNumericAssertion;
use PHPUnit\Framework\Assert\Type\IsObjectAssertion;
use PHPUnit\Framework\Assert\Type\IsResourceAssertion;
use PHPUnit\Framework\Assert\Type\IsScalarAssertion;
use PHPUnit\Framework\Assert\Type\IsStringAssertion;
use PHPUnit\Framework\Assert\Type\JsonAssertion;
use PHPUnit\Framework\Assert\Type\NullAssertion;
use PHPUnit\Framework\Exception;
use PHPUnit\Framework\ExpectationFailedException;
use PHPUnit\Framework\UnknownClassOrInterfaceException;

trait TypeAsserts
{
    /**
     * Asserts that a variable is null.
     *
     * @throws ExpectationFailedException
     *
     * @phpstan-assert null $actual
     */
    final public static function assertNull(mixed $actual, string $message = ''): void
    {
        new NullAssertion(AssertionRunner::get())->assert($message, $actual);
    }

    /**
     * Asserts that a variable is not null.
     *
     * @throws ExpectationFailedException
     *
     * @phpstan-assert !null $actual
     */
    final public static function assertNotNull(mixed $actual, string $message = ''): void
    {
        new NullAssertion(AssertionRunner::get())->assertNot($message, $actual);
    }

    /**
     * Asserts that a variable is of a given type.
     *
     * @template ExpectedType of object
     *
     * @param class-string<ExpectedType> $expected
     *
     * @throws Exception
     * @throws ExpectationFailedException
     * @throws UnknownClassOrInterfaceException
     *
     * @phpstan-assert =ExpectedType $actual
     */
    final public static function assertInstanceOf(string $expected, mixed $actual, string $message = ''): void
    {
        new InstanceOfAssertion(AssertionRunner::get())->assert($message, $actual, $expected);
    }

    /**
     * Asserts that a variable is not of a given type.
     *
     * @template ExpectedType of object
     *
     * @param class-string<ExpectedType> $expected
     *
     * @throws Exception
     * @throws ExpectationFailedException
     *
     * @phpstan-assert !ExpectedType $actual
     */
    final public static function assertNotInstanceOf(string $expected, mixed $actual, string $message = ''): void
    {
        new InstanceOfAssertion(AssertionRunner::get())->assertNot($message, $actual, $expected);
    }

    /**
     * Asserts that a variable is a list.
     *
     * @phpstan-assert list<mixed> $array
     *
     * @throws ExpectationFailedException
     */
    final public static function assertIsList(mixed $array, string $message = ''): void
    {
        new IsListAssertion(AssertionRunner::get())->assert($message, $array);
    }

    /**
     * Asserts that a variable is not a list.
     *
     * @phpstan-assert list<mixed> $array
     *
     * @throws ExpectationFailedException
     */
    final public static function assertIsNotList(mixed $array, string $message = ''): void
    {
        new IsListAssertion(AssertionRunner::get())->assertNot($message, $array);
    }

    /**
     * Asserts that a variable is of type array.
     *
     * @throws Exception
     * @throws ExpectationFailedException
     *
     * @phpstan-assert array<mixed> $actual
     */
    final public static function assertIsArray(mixed $actual, string $message = ''): void
    {
        new IsArrayAssertion(AssertionRunner::get())->assert($message, $actual);
    }

    /**
     * Asserts that a variable is not of type array.
     *
     * @throws Exception
     * @throws ExpectationFailedException
     *
     * @phpstan-assert !array<mixed> $actual
     */
    final public static function assertIsNotArray(mixed $actual, string $message = ''): void
    {
        new IsArrayAssertion(AssertionRunner::get())->assertNot($message, $actual);
    }

    /**
     * Asserts that a variable is of type bool.
     *
     * @throws Exception
     * @throws ExpectationFailedException
     *
     * @phpstan-assert bool $actual
     */
    final public static function assertIsBool(mixed $actual, string $message = ''): void
    {
        new IsBoolAssertion(AssertionRunner::get())->assert($message, $actual);
    }

    /**
     * Asserts that a variable is not of type bool.
     *
     * @throws Exception
     * @throws ExpectationFailedException
     *
     * @phpstan-assert !bool $actual
     */
    final public static function assertIsNotBool(mixed $actual, string $message = ''): void
    {
        new IsBoolAssertion(AssertionRunner::get())->assertNot($message, $actual);
    }

    /**
     * Asserts that a variable is of type float.
     *
     * @throws Exception
     * @throws ExpectationFailedException
     *
     * @phpstan-assert float $actual
     */
    final public static function assertIsFloat(mixed $actual, string $message = ''): void
    {
        new IsFloatAssertion(AssertionRunner::get())->assert($message, $actual);
    }

    /**
     * Asserts that a variable is not of type float.
     *
     * @throws Exception
     * @throws ExpectationFailedException
     *
     * @phpstan-assert !float $actual
     */
    final public static function assertIsNotFloat(mixed $actual, string $message = ''): void
    {
        new IsFloatAssertion(AssertionRunner::get())->assertNot($message, $actual);
    }

    /**
     * Asserts that a variable is of type int.
     *
     * @throws Exception
     * @throws ExpectationFailedException
     *
     * @phpstan-assert int $actual
     */
    final public static function assertIsInt(mixed $actual, string $message = ''): void
    {
        new IsIntAssertion(AssertionRunner::get())->assert($message, $actual);
    }

    /**
     * Asserts that a variable is not of type int.
     *
     * @throws Exception
     * @throws ExpectationFailedException
     *
     * @phpstan-assert !int $actual
     */
    final public static function assertIsNotInt(mixed $actual, string $message = ''): void
    {
        new IsIntAssertion(AssertionRunner::get())->assertNot($message, $actual);
    }

    /**
     * Asserts that a variable is of type numeric.
     *
     * @throws Exception
     * @throws ExpectationFailedException
     *
     * @phpstan-assert numeric $actual
     */
    final public static function assertIsNumeric(mixed $actual, string $message = ''): void
    {
        new IsNumericAssertion(AssertionRunner::get())->assert($message, $actual);
    }

    /**
     * Asserts that a variable is not of type numeric.
     *
     * @throws Exception
     * @throws ExpectationFailedException
     *
     * @phpstan-assert !numeric $actual
     */
    final public static function assertIsNotNumeric(mixed $actual, string $message = ''): void
    {
        new IsNumericAssertion(AssertionRunner::get())->assertNot($message, $actual);
    }

    /**
     * Asserts that a variable is of type object.
     *
     * @throws Exception
     * @throws ExpectationFailedException
     *
     * @phpstan-assert object $actual
     */
    final public static function assertIsObject(mixed $actual, string $message = ''): void
    {
        new IsObjectAssertion(AssertionRunner::get())->assert($message, $actual);
    }

    /**
     * Asserts that a variable is not of type object.
     *
     * @throws Exception
     * @throws ExpectationFailedException
     *
     * @phpstan-assert !object $actual
     */
    final public static function assertIsNotObject(mixed $actual, string $message = ''): void
    {
        new IsObjectAssertion(AssertionRunner::get())->assertNot($message, $actual);
    }

    /**
     * Asserts that a variable is of type resource.
     *
     * @throws Exception
     * @throws ExpectationFailedException
     *
     * @phpstan-assert resource $actual
     */
    final public static function assertIsResource(mixed $actual, string $message = ''): void
    {
        new IsResourceAssertion(AssertionRunner::get())->assert($message, $actual);
    }

    /**
     * Asserts that a variable is not of type resource.
     *
     * @throws Exception
     * @throws ExpectationFailedException
     *
     * @phpstan-assert !resource $actual
     */
    final public static function assertIsNotResource(mixed $actual, string $message = ''): void
    {
        new IsResourceAssertion(AssertionRunner::get())->assertNot($message, $actual);
    }

    /**
     * Asserts that a variable is of type resource and is closed.
     *
     * @throws Exception
     * @throws ExpectationFailedException
     *
     * @phpstan-assert resource $actual
     */
    final public static function assertIsClosedResource(mixed $actual, string $message = ''): void
    {
        new IsClosedResourceAssertion(AssertionRunner::get())->assert($message, $actual);
    }

    /**
     * Asserts that a variable is not of type resource.
     *
     * @throws Exception
     * @throws ExpectationFailedException
     *
     * @phpstan-assert !resource $actual
     */
    final public static function assertIsNotClosedResource(mixed $actual, string $message = ''): void
    {
        new IsClosedResourceAssertion(AssertionRunner::get())->assertNot($message, $actual);
    }

    /**
     * Asserts that a variable is of type string.
     *
     * @throws Exception
     * @throws ExpectationFailedException
     *
     * @phpstan-assert string $actual
     */
    final public static function assertIsString(mixed $actual, string $message = ''): void
    {
        new IsStringAssertion(AssertionRunner::get())->assert($message, $actual);
    }

    /**
     * Asserts that a variable is not of type string.
     *
     * @throws Exception
     * @throws ExpectationFailedException
     *
     * @phpstan-assert !string $actual
     */
    final public static function assertIsNotString(mixed $actual, string $message = ''): void
    {
        new IsStringAssertion(AssertionRunner::get())->assertNot($message, $actual);
    }

    /**
     * Asserts that a variable is of type scalar.
     *
     * @throws Exception
     * @throws ExpectationFailedException
     *
     * @phpstan-assert scalar $actual
     */
    final public static function assertIsScalar(mixed $actual, string $message = ''): void
    {
        new IsScalarAssertion(AssertionRunner::get())->assert($message, $actual);
    }

    /**
     * Asserts that a variable is not of type scalar.
     *
     * @throws Exception
     * @throws ExpectationFailedException
     *
     * @phpstan-assert !scalar $actual
     */
    final public static function assertIsNotScalar(mixed $actual, string $message = ''): void
    {
        new IsScalarAssertion(AssertionRunner::get())->assertNot($message, $actual);
    }

    /**
     * Asserts that a variable is of type callable.
     *
     * @throws Exception
     * @throws ExpectationFailedException
     *
     * @phpstan-assert callable $actual
     */
    final public static function assertIsCallable(mixed $actual, string $message = ''): void
    {
        new IsCallableAssertion(AssertionRunner::get())->assert($message, $actual);
    }

    /**
     * Asserts that a variable is not of type callable.
     *
     * @throws Exception
     * @throws ExpectationFailedException
     *
     * @phpstan-assert !callable $actual
     */
    final public static function assertIsNotCallable(mixed $actual, string $message = ''): void
    {
        new IsCallableAssertion(AssertionRunner::get())->assertNot($message, $actual);
    }

    /**
     * Asserts that a variable is of type iterable.
     *
     * @throws Exception
     * @throws ExpectationFailedException
     *
     * @phpstan-assert iterable<mixed> $actual
     */
    final public static function assertIsIterable(mixed $actual, string $message = ''): void
    {
        new IsIterableAssertion(AssertionRunner::get())->assert($message, $actual);
    }

    /**
     * Asserts that a variable is not of type iterable.
     *
     * @throws Exception
     * @throws ExpectationFailedException
     *
     * @phpstan-assert !iterable<mixed> $actual
     */
    final public static function assertIsNotIterable(mixed $actual, string $message = ''): void
    {
        new IsIterableAssertion(AssertionRunner::get())->assertNot($message, $actual);
    }

    /**
     * Asserts that a string is a valid JSON string.
     *
     * @throws ExpectationFailedException
     */
    final public static function assertJson(string $actual, string $message = ''): void
    {
        new JsonAssertion(AssertionRunner::get())->assert($message, $actual);
    }

    /**
     * Asserts that a string is not a valid JSON string.
     *
     * @throws ExpectationFailedException
     */
    final public static function assertNotJson(string $actual, string $message = ''): void
    {
        new JsonAssertion(AssertionRunner::get())->assertNot($message, $actual);
    }
}
