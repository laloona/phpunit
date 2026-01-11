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

use PHPUnit\Framework\Assert\Object\ObjectEqualsAssertion;
use PHPUnit\Framework\Assert\Object\ObjectHasPropertyAssertion;
use PHPUnit\Framework\ExpectationFailedException;

trait ObjectAsserts
{
    /**
     * @throws ExpectationFailedException
     */
    final public static function assertObjectEquals(object $expected, object $actual, string $method = 'equals', string $message = ''): void
    {
        new ObjectEqualsAssertion(AssertionRunner::get())->assert($message, $actual, $expected, $method);
    }

    /**
     * @throws ExpectationFailedException
     */
    final public static function assertObjectNotEquals(object $expected, object $actual, string $method = 'equals', string $message = ''): void
    {
        new ObjectEqualsAssertion(AssertionRunner::get())->assertNot($message, $actual, $expected, $method);
    }

    /**
     * Asserts that an object has a specified property.
     *
     * @throws ExpectationFailedException
     */
    final public static function assertObjectHasProperty(string $propertyName, object $object, string $message = ''): void
    {
        new ObjectHasPropertyAssertion(AssertionRunner::get())->assert($message, $object, $propertyName);
    }

    /**
     * Asserts that an object does not have a specified property.
     *
     * @throws ExpectationFailedException
     */
    final public static function assertObjectNotHasProperty(string $propertyName, object $object, string $message = ''): void
    {
        new ObjectHasPropertyAssertion(AssertionRunner::get())->assertNot($message, $object, $propertyName);
    }
}
