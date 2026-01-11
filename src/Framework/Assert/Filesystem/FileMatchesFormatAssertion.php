<?php
declare(strict_types=1);
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
use PHPUnit\Framework\Assert\String\StringMatchesFormatAssertion;

final class FileMatchesFormatAssertion extends BinaryAssertion
{
    protected function assertions($message, array &$values): Assertion
    {
        $actualFile = array_shift($values);
        new FileExistsAssertion($this->runner())->assert($message, $actualFile);

        array_unshift($values, file_get_contents($actualFile));

        return new StringMatchesFormatAssertion($this->runner());
    }
}
