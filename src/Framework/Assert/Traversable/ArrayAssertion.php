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

use function array_combine;
use function array_intersect_key;
use ArrayAccess;
use PHPUnit\Framework\Assert\BinaryAssertion;

abstract class ArrayAssertion extends BinaryAssertion
{
    final protected function filterByConsideredKeys(array|ArrayAccess $array, array $keysToBeConsidered): array
    {
        return array_intersect_key(
            $array,
            array_combine($keysToBeConsidered, $keysToBeConsidered),
        );
    }

    final protected function filterIgnoringListOfKeys(array|ArrayAccess $array, array $keysToBeIgnored): array
    {
        foreach ($keysToBeIgnored as $key) {
            if (isset($array[$key])) {
                unset($array[$key]);
            }
        }

        return $array;
    }
}
