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
use ArrayAccess;
use ArrayObject;
use PHPUnit\Framework\Assert\Assertable;
use PHPUnit\Framework\Assert\Traversable\ArrayHasKeyAssertion;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Small;
use PHPUnit\Framework\Constraint\ArrayHasKey;
use PHPUnit\Framework\Constraint\LogicalNot;
use PHPUnit\Framework\TestCase;
use PHPUnit\TestFixture\SampleArrayAccess;

#[CoversClass(ArrayHasKeyAssertion::class)]
#[Small]
#[Group('framework')]
#[Group('framework/assertions')]
final class ArrayHasKeyAssertionTest extends TestCase
{
    /**
     * @return non-empty-list<array{0: int|string, 1: array<mixed>|ArrayAccess<array-key, mixed>, 2: string}>
     */
    public static function dataProvider(): array
    {
        $arrayAccess        = new SampleArrayAccess;
        $arrayAccess['foo'] = 'bar';

        $arrayObject        = new ArrayObject;
        $arrayObject['foo'] = 'bar';

        return [
            [0, ['foo'], ''],
            ['foo', ['foo' => 'bar'], 'foo bar'],
            ['foo', $arrayAccess, 'foo'],
            ['foo', $arrayObject, 'bar'],
        ];
    }

    public function testAssertAndNotAssertAreAvailableInTestClass(): void
    {
        $this->assertTrue(method_exists($this, 'assertArrayHasKey'));
        $this->assertTrue(method_exists($this, 'assertArrayNotHasKey'));
    }

    #[DataProvider('dataProvider')]
    public function testAssertCallsRunnerWithGivenArguments(int|string $key, array|ArrayAccess $array, string $message): void
    {
        $runner = $this->createMock(Assertable::class);
        $runner
            ->expects($this->once())
            ->method('assert')
            ->with($array, $this->isInstanceOf(ArrayHasKey::class), $message);

        new ArrayHasKeyAssertion($runner)
            ->assert($message, $array, $key);
    }

    #[DataProvider('dataProvider')]
    public function testAssertNotCallsRunnerWithGivenArguments(int|string $key, array|ArrayAccess $array, string $message): void
    {
        $runner = $this->createMock(Assertable::class);
        $runner
            ->expects($this->once())
            ->method('assert')
            ->with($array, $this->isInstanceOf(LogicalNot::class), $message);

        new ArrayHasKeyAssertion($runner)
            ->assertNot($message, $array, $key);
    }
}
