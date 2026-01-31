<?php declare(strict_types=1);
/*
 * This file is part of PHPUnit.
 *
 * (c) Sebastian Bergmann <sebastian@phpunit.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace PHPUnit\Framework\Assert\Identity;

use function array_shift;
use PHPUnit\Framework\Assert\UnaryAssertion;
use PHPUnit\Framework\Constraint\Constraint;
use PHPUnit\Framework\Constraint\IsIdentical;

final class SameAssertion extends UnaryAssertion
{
    protected function expectation(array &$values): Constraint
    {
        return new IsIdentical(array_shift($values));
    }
}
