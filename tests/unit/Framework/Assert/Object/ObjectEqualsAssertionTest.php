<?php declare(strict_types=1);
/*
 * This file is part of PHPUnit.
 *
 * (c) Sebastian Bergmann <sebastian@phpunit.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace PHPUnit\Framework\Assert\Object;

use PHPUnit\Framework\Assert\Assertable;
use PHPUnit\Framework\assertObjectEqualsTest;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProviderExternal;
use PHPUnit\Framework\Attributes\Small;
use PHPUnit\Framework\Constraint\LogicalNot;
use PHPUnit\Framework\Constraint\ObjectEquals;
use PHPUnit\Framework\TestCase;

#[CoversClass(ObjectEqualsAssertion::class)]
#[Small]
final class ObjectEqualsAssertionTest extends TestCase
{
    public function testAssertAndNotAssertAreAvailableInTestClass(): void
    {
        $this->assertTrue(method_exists($this, 'assertObjectEquals'));
        $this->assertTrue(method_exists($this, 'assertObjectNotEquals'));
    }

    #[DataProviderExternal(assertObjectEqualsTest::class, 'successProvider')]
    public function testAssertCallsRunnerWithGivenArguments(object $expected, object $actual, string $method): void
    {
        $runner = $this->createMock(Assertable::class);
        $runner
            ->expects($this->once())
            ->method('assert')
            ->with($actual, $this->isInstanceOf(ObjectEquals::class), '');

        new ObjectEqualsAssertion($runner)
            ->assert('', $actual, $expected, $method);
    }

    #[DataProviderExternal(assertObjectEqualsTest::class, 'successProvider')]
    public function testAssertNotCallsRunnerWithGivenArguments(object $expected, object $actual, string $method): void
    {
        $runner = $this->createMock(Assertable::class);
        $runner
            ->expects($this->once())
            ->method('assert')
            ->with($actual, $this->isInstanceOf(LogicalNot::class), '');

        new ObjectEqualsAssertion($runner)
            ->assertNot('', $actual, $expected, $method);
    }
}
