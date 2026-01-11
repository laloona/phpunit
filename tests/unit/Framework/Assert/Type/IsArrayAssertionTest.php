<?php declare(strict_types=1);
/*
 * This file is part of PHPUnit.
 *
 * (c) Sebastian Bergmann <sebastian@phpunit.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace PHPUnit\Framework\Assert\Type;

use PHPUnit\Framework\Assert\Assertable;
use PHPUnit\Framework\assertInstanceOfTest;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProviderExternal;
use PHPUnit\Framework\Attributes\Small;
use PHPUnit\Framework\Constraint\IsType;
use PHPUnit\Framework\Constraint\LogicalNot;
use PHPUnit\Framework\TestCase;
use function method_exists;

#[CoversClass(IsArrayAssertion::class)]
#[Small]
final class IsArrayAssertionTest extends TestCase
{
    public function testAssertAndNotAssertAreAvailableInTestClass(): void
    {
        $this->assertTrue(method_exists($this, 'assertIsArray'));
        $this->assertTrue(method_exists($this, 'assertIsNotArray'));
    }

    public function testAssertCallsRunnerWithGivenArguments(): void
    {
        $runner = $this->createMock(Assertable::class);
        $runner
            ->expects($this->once())
            ->method('assert')
            ->with([], $this->isInstanceOf(IsType::class), '');

        new IsArrayAssertion($runner)
            ->assert('', []);
    }

    #[DataProviderExternal(assertInstanceOfTest::class, 'successProvider')]
    public function testAssertNotCallsRunnerWithGivenArguments(string $expected, mixed $actual): void
    {
        $runner = $this->createMock(Assertable::class);
        $runner
            ->expects($this->once())
            ->method('assert')
            ->with([], $this->isInstanceOf(LogicalNot::class), '');

        new IsArrayAssertion($runner)
            ->assertNot('', []);
    }
}
