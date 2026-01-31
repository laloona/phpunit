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

use function array_key_last;
use PHPUnit\Framework\Assert\Contraints\Filesystem\FileExistsAssertion;
use PHPUnit\Framework\Assert\UnaryAssertion;

abstract class StringFileAssertion extends UnaryAssertion
{
    protected function actual(array &$values): mixed
    {
        $expectedFile = $values[array_key_last($values)] ?? '';
        new FileExistsAssertion($this->runner())->assert($this->message, $expectedFile);

        return parent::actual($values);
    }
}
