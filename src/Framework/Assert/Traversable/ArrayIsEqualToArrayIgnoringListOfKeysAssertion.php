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

use function array_shift;
use function array_unshift;
use PHPUnit\Framework\Assert\Assertion;
use PHPUnit\Framework\Assert\Equality\EqualsAssertion;

final class ArrayIsEqualToArrayIgnoringListOfKeysAssertion extends ArrayAssertion
{
    protected function assertions(string $message, array &$values): Assertion
    {
        $actual          = array_shift($values);
        $expected        = array_shift($values);
        $keysToBeIgnored = array_shift($values);

        array_unshift($values, $this->filterIgnoringListOfKeys($actual, $keysToBeIgnored), $this->filterIgnoringListOfKeys($expected, $keysToBeIgnored));

        return new EqualsAssertion($this->runner());
    }
}
