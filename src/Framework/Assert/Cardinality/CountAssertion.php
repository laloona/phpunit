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
use PHPUnit\Framework\Constraint\Count;

final class CountAssertion extends GeneratorCheckAssertion
{
    protected function actual(array &$values): mixed
    {
        $haystack = $values[array_key_first($values)] ?? null;
        $this->checkGenerator('$haystack', $haystack);

        return parent::actual($values);
    }

    protected function expectation(array &$values): Constraint
    {
        return new Count(array_shift($values));
    }
}
