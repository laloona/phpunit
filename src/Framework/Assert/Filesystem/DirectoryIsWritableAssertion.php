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

use function array_key_last;
use PHPUnit\Framework\Assert\Assertion;
use PHPUnit\Framework\Assert\BinaryAssertion;

final class DirectoryIsWritableAssertion extends BinaryAssertion
{
    protected function assertions($message, array &$values): Assertion
    {
        $directory = $values[array_key_last($values)] ?? '';
        new DirectoryExistsAssertion($this->runner())->assert($message, $directory);

        return new IsWritableAssertion($this->runner());
    }
}
