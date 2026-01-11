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
use PHPUnit\Framework\Constraint\IsTrue;
use PHPUnit\Framework\Constraint\LogicalNot;
use PHPUnit\Framework\TestCase;
use function method_exists;

#[CoversClass(TrueAssertion::class)]
#[Small]
final class TrueAssertionTest extends TestCase
{
    public function testAssertAndNotAssertAreAvailableInTestClass(): void
    {
        $this->assertTrue(method_exists($this, 'assertTrue'));
        $this->assertTrue(method_exists($this, 'assertNotTrue'));
    }

    public function testAssertCall(): void
    {
        $runner = $this->createMock(Assertable::class);
        $runner
            ->expects($this->once())
            ->method('assert')
            ->with(true, $this->isInstanceOf(IsTrue::class), 'foo');

        new TrueAssertion($runner)
            ->assert('foo', true);
    }

    public function testAssertNotCall(): void
    {
        $runner = $this->createMock(Assertable::class);
        $runner
            ->expects($this->once())
            ->method('assert')
            ->with(true, $this->isInstanceOf(LogicalNot::class), 'bar');

        new TrueAssertion($runner)
            ->assertNot('bar', true);
    }
}
