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

use function array_shift;
use PHPUnit\Framework\Assert\UnaryAssertion;
use PHPUnit\Framework\Constraint\Constraint;
use PHPUnit\Framework\Constraint\IsEqual;
use PHPUnit\Framework\Constraint\LessThan;
use PHPUnit\Framework\Constraint\LogicalOr;

final class LessThanOrEqualAssertion extends UnaryAssertion
{
    protected function expectation(array &$values): Constraint
    {
        $maximum = array_shift($values);

        return LogicalOr::fromConstraints(
            new IsEqual($maximum),
            new LessThan($maximum),
        );
    }
}
