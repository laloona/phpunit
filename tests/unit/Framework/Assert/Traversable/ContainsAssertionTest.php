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

use function method_exists;
use stdClass;
use PHPUnit\Framework\Assert\Assertable;
use PHPUnit\Framework\Assert\Traversable\ContainsAssertion;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Small;
use PHPUnit\Framework\Constraint\LogicalNot;
use PHPUnit\Framework\Constraint\TraversableContainsIdentical;
use PHPUnit\Framework\TestCase;

#[CoversClass(ContainsAssertion::class)]
#[Small]
final class ContainsAssertionTest extends TestCase
{
    /**
     * @return non-empty-list<array{0: mixed, 1: iterable, 2: string}>
     */
    public static function dataProvider(): array
    {
        $a = new stdClass;

        return [
            [0, [0], ''],
            [0.0, [0.0], 'foo'],
            [false, [false], 'bar'],
            [null, [null], 'foo foo'],
            ['string', ['string'], 'bar bar'],
            [['string'], [['string']], 'bar foo'],
            [$a, [$a], ''],
        ];
    }

    public function testAssertAndNotAssertAreAvailableInTestClass(): void
    {
        $this->assertTrue(method_exists($this, 'assertContains'));
        $this->assertTrue(method_exists($this, 'assertNotContains'));
    }

    #[DataProvider('dataProvider')]
    public function testAssertCallsRunnerWithGivenArguments(mixed $needle, iterable $haystack, string $message): void
    {
        $runner = $this->createMock(Assertable::class);
        $runner
            ->expects($this->once())
            ->method('assert')
            ->with($haystack, $this->isInstanceOf(TraversableContainsIdentical::class), $message);

        (new ContainsAssertion($runner))
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

        (new ContainsAssertion($runner))
            ->assertNot($message, $haystack, $needle);
    }
}
