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

use PHPUnit\Framework\Assert\Identity\SameAssertion;
use PHPUnit\Framework\ExpectationFailedException;

trait IdentityAsserts
{
    /**
     * Asserts that two variables have the same type and value.
     * Used on objects, it asserts that two variables reference
     * the same object.
     *
     * @template ExpectedType
     *
     * @param ExpectedType $expected
     *
     * @throws ExpectationFailedException
     *
     * @phpstan-assert =ExpectedType $actual
     */
    final public static function assertSame(mixed $expected, mixed $actual, string $message = ''): void
    {
        new SameAssertion(AssertionRunner::get())->assert($message, $actual, $expected);
    }

    /**
     * Asserts that two variables do not have the same type and value.
     * Used on objects, it asserts that two variables do not reference
     * the same object.
     *
     * @throws ExpectationFailedException
     */
    final public static function assertNotSame(mixed $expected, mixed $actual, string $message = ''): void
    {
        new SameAssertion(AssertionRunner::get())->assertNot($message, $actual, $expected);
    }
}
