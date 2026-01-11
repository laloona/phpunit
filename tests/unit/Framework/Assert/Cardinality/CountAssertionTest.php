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
use PHPUnit\Framework\assertCountTest;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProviderExternal;
use PHPUnit\Framework\Attributes\Small;
use PHPUnit\Framework\Constraint\Count;
use PHPUnit\Framework\Constraint\LogicalNot;
use PHPUnit\Framework\GeneratorNotSupportedException;
use PHPUnit\Framework\TestCase;
use function PHPUnit\TestFixture\Generator\f;
use function method_exists;
use Countable;

#[CoversClass(CountAssertion::class)]
#[Small]
final class CountAssertionTest extends TestCase
{
    public function testAssertAndNotAssertAreAvailableInTestClass(): void
    {
        $this->assertTrue(method_exists($this, 'assertCount'));
        $this->assertTrue(method_exists($this, 'assertNotCount'));
    }

    #[DataProviderExternal(assertCountTest::class, 'successProvider')]
    public function testAssertCallsRunnerWithGivenArguments(int $expectedCount, Countable|iterable $haystack): void
    {
        $runner = $this->createMock(Assertable::class);
        $runner
            ->expects($this->once())
            ->method('assert')
            ->with($haystack, $this->isInstanceOf(Count::class), '');

        new CountAssertion($runner)
            ->assert('', $haystack, $expectedCount);
    }

    #[DataProviderExternal(assertCountTest::class, 'successProvider')]
    public function testAssertNotCallsRunnerWithGivenArguments(int $expectedCount, Countable|iterable $haystack): void
    {
        $runner = $this->createMock(Assertable::class);
        $runner
            ->expects($this->once())
            ->method('assert')
            ->with($haystack, $this->isInstanceOf(LogicalNot::class), '');

        new CountAssertion($runner)
            ->assertNot('', $haystack, $expectedCount);
    }

    public function testDoesNotSupportGenerators(): void
    {
        $runner = $this->createMock(Assertable::class);
        $runner
            ->expects($this->never())
            ->method('assert');

        $this->expectException(GeneratorNotSupportedException::class);
        $this->expectExceptionMessage('Passing an argument of type Generator for the $haystack parameter is not supported');

        new CountAssertion($runner)
            ->assertNot('', f(), 0);
    }
}
