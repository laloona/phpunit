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

abstract class Assertion
{
    final public function __construct(private Assertable $assertable)
    {
    }

    /**
     * evaluates the positive assertion.
     */
    abstract public function assert(string $message, mixed ...$values): void;

    /**
     * evaluates the negation assertion.
     */
    abstract public function assertNot(string $message, mixed ...$values): void;

    final protected function runner(): Assertable
    {
        return $this->assertable;
    }
}
