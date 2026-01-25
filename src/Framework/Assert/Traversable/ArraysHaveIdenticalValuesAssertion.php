<?php declare(strict_types=1);
/*
 * This file is part of PHPUnit.
 *
 * (c) Sebastian Bergmann <sebastian@phpunit.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace PHPUnit\Framework\Assert\Traversable;

use PHPUnit\Framework\Assert\UrnaryAssertion;
use PHPUnit\Framework\Constraint\ArraysAreIdentical;
use PHPUnit\Framework\Constraint\Constraint;

final class ArraysHaveIdenticalValuesAssertion extends UrnaryAssertion
{
    protected function expectation(array &$values): Constraint
    {
        return new ArraysAreIdentical(array_shift($values), false, true);
    }
}
