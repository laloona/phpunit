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

use function array_shift;
use function array_unshift;
use PHPUnit\Framework\Assert\Assertion;
use PHPUnit\Framework\Assert\BinaryAssertion;
use PHPUnit\Framework\Assert\ThatAssertion;
use PHPUnit\Framework\Assert\Type\JsonAssertion;
use PHPUnit\Framework\Constraint\JsonMatches;

final class JsonStringEqualsJsonStringAssertion extends BinaryAssertion
{
    protected function assertions(string $message, array &$values): Assertion
    {
        $actualJson   = array_shift($values);
        $expectedJson = array_shift($values);

        new JsonAssertion($this->runner())->assert($message, $expectedJson);
        new JsonAssertion($this->runner())->assert($message, $actualJson);

        array_unshift($values, $actualJson, new JsonMatches($expectedJson));

        return new ThatAssertion($this->runner());
    }
}
