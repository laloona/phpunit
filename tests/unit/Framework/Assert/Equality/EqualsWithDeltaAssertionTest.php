<?php declare(strict_types=1);
/*
 * This file is part of PHPUnit.
 *
 * (c) Sebastian Bergmann <sebastian@phpunit.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace PHPUnit\Framework\Assert\Equality;

use PHPUnit\Framework\Assert\Assertable;
use PHPUnit\Framework\assertEqualsWithDeltaTest;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProviderExternal;
use PHPUnit\Framework\Attributes\Small;
use PHPUnit\Framework\Constraint\IsEqualWithDelta;
use PHPUnit\Framework\Constraint\LogicalNot;
use PHPUnit\Framework\TestCase;
use function method_exists;

#[CoversClass(EqualsWithDeltaAssertion::class)]
#[Small]
final class EqualsWithDeltaAssertionTest extends TestCase
{
    public function testAssertAndNotAssertAreAvailableInTestClass(): void
    {
        $this->assertTrue(method_exists($this, 'assertEqualsWithDelta'));
        $this->assertTrue(method_exists($this, 'assertNotEqualsWithDelta'));
    }

    #[DataProviderExternal(assertEqualsWithDeltaTest::class, 'successProvider')]
    public function testAssertCallsRunnerWithGivenArguments(mixed $expected, mixed $actual, float $delta): void
    {
        $runner = $this->createMock(Assertable::class);
        $runner
            ->expects($this->once())
            ->method('assert')
            ->with($actual, $this->isInstanceOf(IsEqualWithDelta::class), '');

        new EqualsWithDeltaAssertion($runner)
            ->assert('', $actual, $expected, $delta);
    }

    #[DataProviderExternal(assertEqualsWithDeltaTest::class, 'successProvider')]
    public function testAssertNotCallsRunnerWithGivenArguments(mixed $expected, mixed $actual, float $delta): void
    {
        $runner = $this->createMock(Assertable::class);
        $runner
            ->expects($this->once())
            ->method('assert')
            ->with($actual, $this->isInstanceOf(LogicalNot::class), '');

        new EqualsWithDeltaAssertion($runner)
            ->assertNot('', $actual, $expected, $delta);
    }
}
