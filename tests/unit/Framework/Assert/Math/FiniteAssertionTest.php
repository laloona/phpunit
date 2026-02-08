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
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Small;
use PHPUnit\Framework\Constraint\IsFinite;
use PHPUnit\Framework\Constraint\LogicalNot;
use PHPUnit\Framework\TestCase;

#[CoversClass(FiniteAssertion::class)]
#[Small]
#[Group('framework')]
#[Group('framework/assertions')]
final class FiniteAssertionTest extends TestCase
{
    /**
     * @return non-empty-list<array{0: mixed}>
     */
    public static function dataProvider(): array
    {
        return [
            [1],
            [INF]
        ];
    }

    public function testAssertIsAvailableInTestClass(): void
    {
        $this->assertTrue(method_exists($this, 'assertFinite'));
    }

    #[DataProvider('dataProvider')]
    public function testAssertCallsRunnerWithGivenArguments(mixed $actual): void
    {
        $runner = $this->createMock(Assertable::class);
        $runner
            ->expects($this->once())
            ->method('assert')
            ->with($actual, $this->isInstanceOf(IsFinite::class), '');

        new FiniteAssertion($runner)
            ->assert('', $actual);
    }

    #[DataProvider('dataProvider')]
    public function testAssertNotCallsRunnerWithGivenArguments(mixed $actual): void
    {
        $runner = $this->createMock(Assertable::class);
        $runner
            ->expects($this->once())
            ->method('assert')
            ->with($actual, $this->isInstanceOf(LogicalNot::class), '');

        new FiniteAssertion($runner)
            ->assertNot('', $actual);
    }
}
