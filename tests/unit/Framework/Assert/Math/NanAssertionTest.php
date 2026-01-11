<?php declare(strict_types=1);
/*
 * This file is part of PHPUnit.
 *
 * (c) Sebastian Bergmann <sebastian@phpunit.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace PHPUnit\Framework\Assert\Math;

use PHPUnit\Framework\Assert\Assertable;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Small;
use PHPUnit\Framework\Constraint\IsNan;
use PHPUnit\Framework\Constraint\LogicalNot;
use PHPUnit\Framework\TestCase;
use const NAN;

#[CoversClass(NanAssertion::class)]
#[Small]
final class NanAssertionTest extends TestCase
{
    public function testAssertIsAvailableInTestClass(): void
    {
        $this->assertTrue(method_exists($this, 'assertNan'));
    }

    public function testAssertCallsRunnerWithGivenArguments(): void
    {
        $runner = $this->createMock(Assertable::class);
        $runner
            ->expects($this->once())
            ->method('assert')
            ->with(NAN, $this->isInstanceOf(IsNan::class), '');

        new NanAssertion($runner)
            ->assert('', NAN);
    }

    public function testAssertNotCallsRunnerWithGivenArguments(): void
    {
        $runner = $this->createMock(Assertable::class);
        $runner
            ->expects($this->once())
            ->method('assert')
            ->with(1, $this->isInstanceOf(LogicalNot::class), '');

        new NanAssertion($runner)
            ->assertNot('', 1);
    }
}
