<?php declare(strict_types=1);
/*
 * This file is part of PHPUnit.
 *
 * (c) Sebastian Bergmann <sebastian@phpunit.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace PHPUnit\Framework\Traversable;

use PHPUnit\Framework\Attributes\Group;
use function method_exists;
use stdClass;
use PHPUnit\Framework\Assert\Assertable;
use PHPUnit\Framework\Assert\Traversable\ContainsEqualsAssertion;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Small;
use PHPUnit\Framework\Constraint\TraversableContainsEqual;
use PHPUnit\Framework\Constraint\LogicalNot;
use PHPUnit\Framework\TestCase;

#[CoversClass(ContainsEqualsAssertion::class)]
#[Small]
#[Group('framework')]
#[Group('framework/assertions')]
final class ContainsEqualsAssertionTest extends TestCase
{
    /**
     * @return non-empty-list<array{0: mixed, 1: iterable, 2: string}>
     */
    public static function dataProvider(): array
    {
        $a      = new stdClass;
        $a->foo = 'bar';

        $b      = new stdClass;
        $b->foo = 'bar';

        return [
            [0, [0], ''],
            [0, ['0'], 'foo'],
            [0, [0.0], 'foo bar'],
            [0, [false], 'bar'],
            [0, [null], 'foo foo'],
            ['string', ['string'], 'bar bar'],
            [['string'], [['string']], 'bar foo'],
            [$a, [$b], ''],
        ];
    }

    public function testAssertAndNotAssertAreAvailableInTestClass(): void
    {
        $this->assertTrue(method_exists($this, 'assertContainsEquals'));
        $this->assertTrue(method_exists($this, 'assertNotContainsEquals'));
    }

    #[DataProvider('dataProvider')]
    public function testAssertCallsRunnerWithGivenArguments(mixed $needle, iterable $haystack, string $message): void
    {
        $runner = $this->createMock(Assertable::class);
        $runner
            ->expects($this->once())
            ->method('assert')
            ->with($haystack, $this->isInstanceOf(TraversableContainsEqual::class), $message);

        (new ContainsEqualsAssertion($runner))
            ->assert($message, $haystack, $needle);
    }

    #[DataProvider('dataProvider')]
    public function testAssertNotCallsRunnerWithGivenArguments(mixed $needle, iterable $haystack, string $message): void
    {
        $runner = $this->createMock(Assertable::class);
        $runner
            ->expects($this->once())
            ->method('assert')
            ->with($haystack, $this->isInstanceOf(LogicalNot::class), $message);

        (new ContainsEqualsAssertion($runner))
            ->assertNot($message, $haystack, $needle);
    }
}
