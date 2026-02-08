<?php declare(strict_types=1);
/*
 * This file is part of PHPUnit.
 *
 * (c) Sebastian Bergmann <sebastian@phpunit.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace PHPUnit\Framework\Assert\Equality;

use PHPUnit\Framework\Assert\Assertable;
use PHPUnit\Framework\assertEqualsCanonicalizingTest;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProviderExternal;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Small;
use PHPUnit\Framework\Constraint\IsEqualCanonicalizing;
use PHPUnit\Framework\Constraint\LogicalNot;
use PHPUnit\Framework\TestCase;
use function method_exists;

#[CoversClass(EqualsCanonicalizingAssertion::class)]
#[Small]
#[Group('framework')]
#[Group('framework/assertions')]
final class EqualsCanonicalizingAssertionTest extends TestCase
{
    public function testAssertAndNotAssertAreAvailableInTestClass(): void
    {
        $this->assertTrue(method_exists($this, 'assertEqualsCanonicalizing'));
        $this->assertTrue(method_exists($this, 'assertNotEqualsCanonicalizing'));
    }

    #[DataProviderExternal(assertEqualsCanonicalizingTest::class, 'successProvider')]
    public function testAssertCallsRunnerWithGivenArguments(mixed $expected, mixed $actual): void
    {
        $runner = $this->createMock(Assertable::class);
        $runner
            ->expects($this->once())
            ->method('assert')
            ->with($actual, $this->isInstanceOf(IsEqualCanonicalizing::class), '');

        new EqualsCanonicalizingAssertion($runner)
            ->assert('', $actual, $expected);
    }

    #[DataProviderExternal(assertEqualsCanonicalizingTest::class, 'successProvider')]
    public function testAssertNotCallsRunnerWithGivenArguments(mixed $expected, mixed $actual): void
    {
        $runner = $this->createMock(Assertable::class);
        $runner
            ->expects($this->once())
            ->method('assert')
            ->with($actual, $this->isInstanceOf(LogicalNot::class), '');

        new EqualsCanonicalizingAssertion($runner)
            ->assertNot('', $actual, $expected);
    }
}
