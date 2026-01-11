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

use PHPUnit\Framework\assertLessThanOrEqualTest;
use PHPUnit\Framework\Assert\Assertable;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Small;
use PHPUnit\Framework\Constraint\LogicalNot;
use PHPUnit\Framework\Constraint\LogicalOr;
use PHPUnit\Framework\TestCase;
use function method_exists;

#[CoversClass(LessThanOrEqualAssertion::class)]
#[Small]
final class LessThanOrEqualAssertionTest extends TestCase
{
    /**
     * @return non-empty-list<array{0: int, 1: int}>
     */
    public static function dataProvider(): array
    {
        return assertLessThanOrEqualTest::successProvider();
    }

    public function testAssertIsAvailableInTestClass(): void
    {
        $this->assertTrue(method_exists($this, 'assertLessThan'));
    }

    #[DataProvider('dataProvider')]
    public function testAssertCallsRunnerWithGivenArguments(mixed $maximum, mixed $actual, string $message): void
    {
        $runner = $this->createMock(Assertable::class);
        $runner
            ->expects($this->once())
            ->method('assert')
            ->with($actual, $this->isInstanceOf(LogicalOr::class), $message);

        new LessThanOrEqualAssertion($runner)
            ->assert($message, $actual, $maximum);
    }

    public function testAssertNotCallsRunnerWithGivenArguments(): void
    {
        $runner = $this->createMock(Assertable::class);
        $runner
            ->expects($this->once())
            ->method('assert')
            ->with(2, $this->isInstanceOf(LogicalNot::class), 'bar');

        new LessThanOrEqualAssertion($runner)
            ->assertNot('bar', 2, 1);
    }
}
