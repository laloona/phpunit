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

abstract class BinaryAssertion extends Assertion
{
    /**
     * positive execution of the given assertion.
     */
    final public function assert($message, mixed ...$values): void
    {
        $this->assertions($message, $values)->assert($message, ...$values);
    }

    /**
     * negative execution of the given assertion.
     */
    final public function assertNot($message, mixed ...$values): void
    {
        $this->assertions($message, $values)->assertNot($message, ...$values);
    }

    /**
     * build assertions and return the assertion for evaluation.
     */
    abstract protected function assertions(string $message, array &$values): Assertion;
}
