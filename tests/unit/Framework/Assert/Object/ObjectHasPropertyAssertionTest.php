<?php declare(strict_types=1);
/*
 * This file is part of PHPUnit.
 *
 * (c) Sebastian Bergmann <sebastian@phpunit.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace PHPUnit\Framework\Assert\Object;

use PHPUnit\Framework\Assert\Assertable;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Small;
use PHPUnit\Framework\Constraint\LogicalNot;
use PHPUnit\Framework\Constraint\ObjectHasProperty;
use PHPUnit\Framework\TestCase;
use stdClass;

#[CoversClass(ObjectHasPropertyAssertion::class)]
#[Small]
final class ObjectHasPropertyAssertionTest extends TestCase
{
    public function testAssertAndNotAssertAreAvailableInTestClass(): void
    {
        $this->assertTrue(method_exists($this, 'assertObjectEquals'));
        $this->assertTrue(method_exists($this, 'assertObjectNotHasProperty'));
    }

    public function testAssertCallsRunnerWithGivenArguments(): void
    {
        $object              = new stdClass;
        $object->theProperty = 'value';

        $runner = $this->createMock(Assertable::class);
        $runner
            ->expects($this->once())
            ->method('assert')
            ->with($object, $this->isInstanceOf(ObjectHasProperty::class), '');

        new ObjectHasPropertyAssertion($runner)
            ->assert('', $object, 'theProperty');
    }

    public function testAssertNotCallsRunnerWithGivenArguments(): void
    {
        $object = new stdClass;

        $runner = $this->createMock(Assertable::class);
        $runner
            ->expects($this->once())
            ->method('assert')
            ->with($object, $this->isInstanceOf(LogicalNot::class), '');

        new ObjectHasPropertyAssertion($runner)
            ->assertNot('', $object, 'theProperty');
    }
}
