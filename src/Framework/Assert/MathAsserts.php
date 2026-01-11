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

use PHPUnit\Framework\Assert\Math\FiniteAssertion;
use PHPUnit\Framework\Assert\Math\InfiniteAssertion;
use PHPUnit\Framework\Assert\Math\NanAssertion;
use PHPUnit\Framework\ExpectationFailedException;

trait MathAsserts
{
    /**
     * Asserts that a variable is finite.
     *
     * @throws ExpectationFailedException
     */
    final public static function assertFinite(mixed $actual, string $message = ''): void
    {
        new FiniteAssertion(AssertionRunner::get())->assert($message, $actual);
    }

    /**
     * Asserts that a variable is infinite.
     *
     * @throws ExpectationFailedException
     */
    final public static function assertInfinite(mixed $actual, string $message = ''): void
    {
        new InfiniteAssertion(AssertionRunner::get())->assert($message, $actual);
    }

    /**
     * Asserts that a variable is nan.
     *
     * @throws ExpectationFailedException
     */
    final public static function assertNan(mixed $actual, string $message = ''): void
    {
        new NanAssertion(AssertionRunner::get())->assert($message, $actual);
    }
}
