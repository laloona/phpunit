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

use function array_key_first;
use function array_shift;
use PHPUnit\Framework\Constraint\Constraint;
use PHPUnit\Framework\Constraint\SameSize;

final class SameSizeAssertion extends GeneratorCheckAssertion
{
    protected function actual(array &$values): mixed
    {
        $actual      = array_shift($values);
        $expectation = $values[array_key_first($values)] ?? null;
        $this->checkGenerator('$expectation', $expectation);
        $this->checkGenerator('$actual', $actual);

        return $actual;
    }

    protected function expectation(array &$values): Constraint
    {
        return new SameSize(array_shift($values));
    }
}
