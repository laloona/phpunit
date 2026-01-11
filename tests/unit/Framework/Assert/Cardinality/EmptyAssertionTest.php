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
use PHPUnit\Framework\assertEmptyTest;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProviderExternal;
use PHPUnit\Framework\Attributes\Small;
use PHPUnit\Framework\Constraint\IsEmpty;
use PHPUnit\Framework\Constraint\LogicalNot;
use PHPUnit\Framework\GeneratorNotSupportedException;
use PHPUnit\Framework\TestCase;
use function PHPUnit\TestFixture\Generator\f;
use function method_exists;

#[CoversClass(EmptyAssertion::class)]
#[Small]
final class EmptyAssertionTest extends TestCase
{
    public function testAssertAndNotAssertAreAvailableInTestClass(): void
    {
        $this->assertTrue(method_exists($this, 'assertEmpty'));
        $this->assertTrue(method_exists($this, 'assertNotEmpty'));
    }

    #[DataProviderExternal(assertEmptyTest::class, 'successProvider')]
    public function testAssertCallsRunnerWithGivenArguments(mixed $actual): void
    {
        $runner = $this->createMock(Assertable::class);
        $runner
            ->expects($this->once())
            ->method('assert')
            ->with($actual, $this->isInstanceOf(IsEmpty::class), '');

        new EmptyAssertion($runner)
            ->assert('', $actual);
    }

    #[DataProviderExternal(assertEmptyTest::class, 'successProvider')]
    public function testAssertNotCallsRunnerWithGivenArguments(mixed $actual): void
    {
        $runner = $this->createMock(Assertable::class);
        $runner
            ->expects($this->once())
            ->method('assert')
            ->with($actual, $this->isInstanceOf(LogicalNot::class), '');

        new EmptyAssertion($runner)
            ->assertNot('', $actual);
    }

    public function testDoesNotSupportGenerators(): void
    {
        $runner = $this->createMock(Assertable::class);
        $runner
            ->expects($this->never())
            ->method('assert');

        $this->expectException(GeneratorNotSupportedException::class);
        $this->expectExceptionMessage('Passing an argument of type Generator for the $actual parameter is not supported');

        new EmptyAssertion($runner)
            ->assertNot('', f());
    }
}
