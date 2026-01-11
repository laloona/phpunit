<?php declare(strict_types=1);
/*
 * This file is part of PHPUnit.
 *
 * (c) Sebastian Bergmann <sebastian@phpunit.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace PHPUnit\Framework\Assert\Json;

use function array_pop;
use function file_get_contents;
use PHPUnit\Framework\Assert\Assertion;
use PHPUnit\Framework\Assert\BinaryAssertion;
use PHPUnit\Framework\Assert\Contraints\Filesystem\FileExistsAssertion;
use PHPUnit\Framework\Assert\Type\IsStringAssertion;

final class JsonStringEqualsJsonFileAssertion extends BinaryAssertion
{
    protected function assertions(string $message, array &$values): Assertion
    {
        $expectedFile = array_pop($values);
        new FileExistsAssertion($this->runner())->assert($message, $expectedFile);

        $expectedJson = file_get_contents($expectedFile);
        new IsStringAssertion($this->runner())->assert($message, $expectedJson);

        $values[] = $expectedJson;

        return new JsonStringEqualsJsonStringAssertion($this->runner());
    }
}
