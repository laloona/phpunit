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

use function array_key_first;
use PHPUnit\Framework\Assert\Assertion;
use PHPUnit\Framework\Assert\BinaryAssertion;

final class FileIsWritableAssertion extends BinaryAssertion
{
    protected function assertions($message, array &$values): Assertion
    {
        $file = $values[array_key_first($values)] ?? '';
        new FileExistsAssertion($this->runner())->assert($message, $file);

        return new IsWritableAssertion($this->runner());
    }
}
