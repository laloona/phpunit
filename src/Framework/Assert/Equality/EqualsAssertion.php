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

use function array_shift;
use PHPUnit\Framework\Assert\UrnaryAssertion;
use PHPUnit\Framework\Constraint\Constraint;
use PHPUnit\Framework\Constraint\IsEqual;

final class EqualsAssertion extends UrnaryAssertion
{
    protected function expectation(array &$values): Constraint
    {
        return new IsEqual(array_shift($values));
    }
}
