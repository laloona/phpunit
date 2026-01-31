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

use function array_shift;
use PHPUnit\Framework\Constraint\Constraint;
use PHPUnit\Framework\Constraint\LogicalNot;

abstract class UnaryAssertion extends Assertion
{
    protected string $message;

    /**
     * send the positive expecation to the runner for evaluation.
     */
    final public function assert(string $message, mixed ...$values): void
    {
        $this->message = $message;
        $this->runner()->assert(
            $this->actual($values),
            $this->expectation($values),
            $message,
        );
    }

    /**
     * negate the expectation and send the negative expecation to the runner for evaluation.
     */
    final public function assertNot(string $message, mixed ...$values): void
    {
        $this->message = $message;
        $this->runner()->assert(
            $this->actual($values),
            new LogicalNot($this->expectation($values)),
            $message,
        );
    }

    /**
     * build the constraint for evaluation.
     */
    abstract protected function expectation(array &$values): Constraint;

    /**
     * get the actual value to evaluate against the constraint.
     */
    protected function actual(array &$values): mixed
    {
        return array_shift($values);
    }
}
