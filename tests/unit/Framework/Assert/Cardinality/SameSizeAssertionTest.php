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

use Countable;
use PHPUnit\Framework\assertSameSizeTest;
use PHPUnit\Framework\Assert\Assertable;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProviderExternal;
use PHPUnit\Framework\Attributes\Small;
use PHPUnit\Framework\Constraint\LogicalNot;
use PHPUnit\Framework\Constraint\SameSize;
use PHPUnit\Framework\GeneratorNotSupportedException;
use PHPUnit\Framework\TestCase;
use function method_exists;

#[CoversClass(SameSizeAssertion::class)]
#[Small]
final class SameSizeAssertionTest extends TestCase
{
    public function testAssertAndNotAssertAreAvailableInTestClass(): void
    {
        $this->assertTrue(method_exists($this, 'assertSameSize'));
        $this->assertTrue(method_exists($this, 'assertNotSameSize'));
    }

    #[DataProviderExternal(assertSameSizeTest::class, 'successProvider')]
    public function testAssertCallsRunnerWithGivenArguments(Countable|iterable $expected, Countable|iterable $actual): void
    {
        $runner = $this->createMock(Assertable::class);
        $runner
            ->expects($this->once())
            ->method('assert')
            ->with($actual, $this->isInstanceOf(SameSize::class), '');

        new SameSizeAssertion($runner)
            ->assert('', $actual, $expected);
    }

    #[DataProviderExternal(assertSameSizeTest::class, 'successProvider')]
    public function testAssertNotCallsRunnerWithGivenArguments(Countable|iterable $expected, Countable|iterable $actual): void
    {
        $runner = $this->createMock(Assertable::class);
        $runner
            ->expects($this->once())
            ->method('assert')
            ->with($actual, $this->isInstanceOf(LogicalNot::class), '');

        new SameSizeAssertion($runner)
            ->assertNot('', $actual, $expected);
    }

    #[DataProviderExternal(assertSameSizeTest::class, 'errorProvider')]
    public function testDoesNotSupportGenerators(Countable|iterable $expected, Countable|iterable $actual): void
    {
        $this->expectException(GeneratorNotSupportedException::class);

        $runner = $this->createMock(Assertable::class);
        $runner
            ->expects($this->never())
            ->method('assert');

        new SameSizeAssertion($runner)
            ->assert('', $actual, $expected);
    }
}
