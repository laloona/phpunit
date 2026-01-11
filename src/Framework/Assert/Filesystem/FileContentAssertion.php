<?php declare(strict_types=1);
/*
 * This file is part of PHPUnit.
 *
 * (c) Sebastian Bergmann <sebastian@phpunit.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace PHPUnit\Framework\Assert\Contraints\Filesystem;

use function array_shift;
use function array_unshift;
use function file_get_contents;
use PHPUnit\Framework\Assert\Assertion;
use PHPUnit\Framework\Assert\BinaryAssertion;

abstract class FileContentAssertion extends BinaryAssertion
{
    final protected function assertions(string $message, array &$values): Assertion
    {
        $actual   = array_shift($values);
        $expected = array_shift($values);

        new FileExistsAssertion($this->runner())->assert($message, $actual);
        new FileExistsAssertion($this->runner())->assert($message, $expected);

        array_unshift($values, file_get_contents($actual), file_get_contents($expected));

        return $this->expectation($message, $values);
    }

    abstract protected function expectation(string $message, array &$values): Assertion;
}
