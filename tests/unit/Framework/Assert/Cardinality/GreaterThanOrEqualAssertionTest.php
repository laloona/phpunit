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
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Small;
use PHPUnit\Framework\Constraint\LogicalNot;
use PHPUnit\Framework\Constraint\LogicalOr;
use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\assertGreaterThanOrEqualTest;
use function method_exists;

#[CoversClass(GreaterThanOrEqualAssertion::class)]
#[Small]
#[Group('framework')]
#[Group('framework/assertions')]
final class GreaterThanOrEqualAssertionTest extends TestCase
{
    /**
     * @return non-empty-list<array{0: int, 1: int}>
     */
    public static function dataProvider(): array
    {
        return assertGreaterThanOrEqualTest::successProvider();
    }

    public function testAssertIsAvailableInTestClass(): void
    {
        $this->assertTrue(method_exists($this, 'assertGreaterThan'));
    }

    #[DataProvider('dataProvider')]
    public function testAssertCallsRunnerWithGivenArguments(mixed $minimum, mixed $actual): void
    {
        $runner = $this->createMock(Assertable::class);
        $runner
            ->expects($this->once())
            ->method('assert')
            ->with($actual, $this->isInstanceOf(LogicalOr::class), '');

        new GreaterThanOrEqualAssertion($runner)
            ->assert('', $actual, $minimum);
    }

    public function testAssertNotCallsRunnerWithGivenArguments(): void
    {
        $runner = $this->createMock(Assertable::class);
        $runner
            ->expects($this->once())
            ->method('assert')
            ->with(1, $this->isInstanceOf(LogicalNot::class), 'bar');

        new GreaterThanOrEqualAssertion($runner)
            ->assertNot('bar', 1, 2);
    }
}
