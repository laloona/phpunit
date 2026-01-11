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
use PHPUnit\Framework\Assert\String\StringMatchesFormatAssertion;
use PHPUnit\Framework\Assert\Type\IsStringAssertion;

final class FileMatchesFormatFileAssertion extends FileContentAssertion
{
    protected function expectation($message, array &$values): Assertion
    {
        $formatDescription = $values[array_key_last($values)];
        new IsStringAssertion($this->runner())->assert($message, $formatDescription);

        return new StringMatchesFormatAssertion($this->runner());
    }
}
