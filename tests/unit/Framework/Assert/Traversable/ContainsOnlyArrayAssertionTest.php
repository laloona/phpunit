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
use PHPUnit\Framework\Assert\Assertable;
use PHPUnit\Framework\Assert\Traversable\ContainsOnlyArrayAssertion;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Small;
use PHPUnit\Framework\Constraint\LogicalNot;
use PHPUnit\Framework\Constraint\TraversableContainsOnly;
use PHPUnit\Framework\TestCase;

#[CoversClass(ContainsOnlyArrayAssertion::class)]
#[Small]
#[Group('framework')]
#[Group('framework/assertions')]
final class ContainsOnlyArrayAssertionTest extends TestCase
{
    /**
     * @return non-empty-list<array{0: iterable, 1: string}>
     */
    public static function dataProvider(): array
    {
        return [
            [[[]], 'foo'],
        ];
    }

    public function testAssertAndNotAssertAreAvailableInTestClass(): void
    {
        $this->assertTrue(method_exists($this, 'assertContainsOnlyArray'));
        $this->assertTrue(method_exists($this, 'assertContainsNotOnlyArray'));
    }

    #[DataProvider('dataProvider')]
    public function testAssertCallsRunnerWithGivenArguments(iterable $haystack, string $message): void
    {
        $runner = $this->createMock(Assertable::class);
        $runner
            ->expects($this->once())
            ->method('assert')
            ->with($haystack, $this->isInstanceOf(TraversableContainsOnly::class), $message);

        (new ContainsOnlyArrayAssertion($runner))
            ->assert($message, $haystack);
    }

    #[DataProvider('dataProvider')]
    public function testAssertNotCallsRunnerWithGivenArguments(iterable $haystack, string $message): void
    {
        $runner = $this->createMock(Assertable::class);
        $runner
            ->expects($this->once())
            ->method('assert')
            ->with($haystack, $this->isInstanceOf(LogicalNot::class), $message);

        (new ContainsOnlyArrayAssertion($runner))
            ->assertNot($message, $haystack);
    }
}
