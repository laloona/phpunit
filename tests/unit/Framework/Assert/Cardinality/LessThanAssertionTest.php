<?php declare(strict_types=1);
/*
 * This file is part of PHPUnit.
 *
 * (c) Sebastian Bergmann <sebastian@phpunit.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace PHPUnit\Framework\Assert\Cardinality;

use PHPUnit\Framework\Assert\Assertable;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Small;
use PHPUnit\Framework\Constraint\LessThan;
use PHPUnit\Framework\Constraint\LogicalNot;
use PHPUnit\Framework\TestCase;
use function method_exists;

#[CoversClass(LessThanAssertion::class)]
#[Small]
#[Group('framework')]
#[Group('framework/assertions')]
final class LessThanAssertionTest extends TestCase
{
    public function testAssertIsAvailableInTestClass(): void
    {
        $this->assertTrue(method_exists($this, 'assertLessThan'));
    }

    public function testAssertCallsRunnerWithGivenArguments(): void
    {
        $runner = $this->createMock(Assertable::class);
        $runner
            ->expects($this->once())
            ->method('assert')
            ->with(1, $this->isInstanceOf(LessThan::class), 'foo');

        new LessThanAssertion($runner)
            ->assert('foo', 1, 2);
    }

    public function testAssertNotCallsRunnerWithGivenArguments(): void
    {
        $runner = $this->createMock(Assertable::class);
        $runner
            ->expects($this->once())
            ->method('assert')
            ->with(2, $this->isInstanceOf(LogicalNot::class), 'bar');

        new LessThanAssertion($runner)
            ->assertNot('bar', 2, 1);
    }
}
