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

use Generator;
use PHPUnit\Framework\Assert\UrnaryAssertion;
use PHPUnit\Framework\GeneratorNotSupportedException;

abstract class GeneratorCheckAssertion extends UrnaryAssertion
{
    final protected function checkGenerator(string $name, mixed $value): void
    {
        if ($value instanceof Generator) {
            throw GeneratorNotSupportedException::fromParameterName($name);
        }
    }
}
