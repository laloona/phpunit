<?php declare(strict_types=1);
/*
 * This file is part of PHPUnit.
 *
 * (c) Sebastian Bergmann <sebastian@phpunit.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace PHPUnit\Framework\Assert\Boolean;

use PHPUnit\Framework\Assert\Assertable;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Small;
use PHPUnit\Framework\Constraint\IsFalse;
use PHPUnit\Framework\Constraint\LogicalNot;
use PHPUnit\Framework\TestCase;
use function method_exists;

#[CoversClass(FalseAssertion::class)]
#[Small]
final class FalseAssertionTest extends TestCase
{
    public function testAssertAndNotAssertAreAvailableInTestClass(): void
    {
        $this->assertTrue(method_exists($this, 'assertFalse'));
        $this->assertTrue(method_exists($this, 'assertNotFalse'));
    }

    public function testAssertCall(): void
    {
        $runner = $this->createMock(Assertable::class);
        $runner
            ->expects($this->once())
            ->method('assert')
            ->with(false, $this->isInstanceOf(IsFalse::class), 'foo');

        new FalseAssertion($runner)
            ->assert('foo', false);
    }

    public function testAssertNotCall(): void
    {
        $runner = $this->createMock(Assertable::class);
        $runner
            ->expects($this->once())
            ->method('assert')
            ->with(false, $this->isInstanceOf(LogicalNot::class), 'bar');

        new FalseAssertion($runner)
            ->assertNot('bar', false);
    }
}
