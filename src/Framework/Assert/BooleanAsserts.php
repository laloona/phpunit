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

use PHPUnit\Framework\Assert\Boolean\FalseAssertion;
use PHPUnit\Framework\Assert\Boolean\TrueAssertion;
use PHPUnit\Framework\ExpectationFailedException;

trait BooleanAsserts
{
    /**
     * Asserts that a condition is true.
     *
     * @throws ExpectationFailedException
     *
     * @phpstan-assert true $condition
     */
    final public static function assertTrue(mixed $condition, string $message = ''): void
    {
        new TrueAssertion(AssertionRunner::get())->assert($message, $condition);
    }

    /**
     * Asserts that a condition is not true.
     *
     * @throws ExpectationFailedException
     *
     * @phpstan-assert !true $condition
     */
    final public static function assertNotTrue(mixed $condition, string $message = ''): void
    {
        new TrueAssertion(AssertionRunner::get())->assertNot($message, $condition);
    }

    /**
     * Asserts that a condition is false.
     *
     * @throws ExpectationFailedException
     *
     * @phpstan-assert false $condition
     */
    final public static function assertFalse(mixed $condition, string $message = ''): void
    {
        new FalseAssertion(AssertionRunner::get())->assert($message, $condition);
    }

    /**
     * Asserts that a condition is not false.
     *
     * @throws ExpectationFailedException
     *
     * @phpstan-assert !false $condition
     */
    final public static function assertNotFalse(mixed $condition, string $message = ''): void
    {
        new FalseAssertion(AssertionRunner::get())->assertNot($message, $condition);
    }
}
