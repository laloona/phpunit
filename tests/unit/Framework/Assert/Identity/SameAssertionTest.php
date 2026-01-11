<?php declare(strict_types=1);
/*
 * This file is part of PHPUnit.
 *
 * (c) Sebastian Bergmann <sebastian@phpunit.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace PHPUnit\Framework\Assert\Identity;

use PHPUnit\Framework\Assert\Assertable;
use PHPUnit\Framework\assertSameTest;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProviderExternal;
use PHPUnit\Framework\Attributes\Small;
use PHPUnit\Framework\Constraint\IsIdentical;
use PHPUnit\Framework\Constraint\LogicalNot;
use PHPUnit\Framework\TestCase;

#[CoversClass(SameAssertion::class)]
#[Small]
final class SameAssertionTest extends TestCase
{
    public function testAssertAndNotAssertAreAvailableInTestClass(): void
    {
        $this->assertTrue(method_exists($this, 'assertSame'));
        $this->assertTrue(method_exists($this, 'assertNotSame'));
    }

    #[DataProviderExternal(assertSameTest::class, 'successProvider')]
    public function testAssertCallsRunnerWithGivenArguments(mixed $expected, mixed $actual): void
    {
        $runner = $this->createMock(Assertable::class);
        $runner
            ->expects($this->once())
            ->method('assert')
            ->with($actual, $this->isInstanceOf(IsIdentical::class), '');

        new SameAssertion($runner)
            ->assert('', $actual, $expected);
    }

    #[DataProviderExternal(assertSameTest::class, 'successProvider')]
    public function testAssertNotCallsRunnerWithGivenArguments(mixed $expected, mixed $actual): void
    {
        $runner = $this->createMock(Assertable::class);
        $runner
            ->expects($this->once())
            ->method('assert')
            ->with($actual, $this->isInstanceOf(LogicalNot::class), '');

        new SameAssertion($runner)
            ->assertNot('', $actual, $expected);
    }
}
