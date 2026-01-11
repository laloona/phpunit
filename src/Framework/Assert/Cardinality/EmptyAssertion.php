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
use PHPUnit\Framework\Constraint\Constraint;
use PHPUnit\Framework\Constraint\IsEmpty;

final class EmptyAssertion extends GeneratorCheckAssertion
{
    protected function actual(array &$values): mixed
    {
        $actual = $values[array_key_first($values)] ?? null;
        $this->checkGenerator('$actual', $actual);

        return parent::actual($values);
    }

    protected function expectation(array &$values): Constraint
    {
        return new IsEmpty;
    }
}
