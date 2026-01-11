<?php declare(strict_types=1);
/*
 * This file is part of PHPUnit.
 *
 * (c) Sebastian Bergmann <sebastian@phpunit.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace PHPUnit\Framework\Assert\String;

use function array_pop;
use function file_get_contents;
use PHPUnit\Framework\Assert\Assertion;
use PHPUnit\Framework\Assert\BinaryAssertion;
use PHPUnit\Framework\Assert\Contraints\Filesystem\FileExistsAssertion;
use PHPUnit\Framework\Assert\Type\IsStringAssertion;

final class StringMatchesFormatFileAssertion extends BinaryAssertion
{
    protected function assertions($message, array &$values): Assertion
    {
        $formatFile = array_pop($values);
        new FileExistsAssertion($this->runner())->assert($message, $formatFile);

        $formatDescription = file_get_contents($formatFile);
        new IsStringAssertion($this->runner())->assert($message, $formatDescription);

        $values[] = $formatDescription;

        return new StringMatchesFormatAssertion($this->runner());
    }
}
