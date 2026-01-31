<?php declare(strict_types=1);
/*
 * This file is part of PHPUnit.
 *
 * (c) Sebastian Bergmann <sebastian@phpunit.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace PHPUnit\Framework\Assert\String;

use function array_shift;
use PHPUnit\Framework\Assert\UnaryAssertion;
use PHPUnit\Framework\Constraint\Constraint;
use PHPUnit\Framework\Constraint\StringContains;

final class StringContainsStringAssertion extends UnaryAssertion
{
    protected function expectation(array &$values): Constraint
    {
        return new StringContains(array_shift($values));
    }
}
