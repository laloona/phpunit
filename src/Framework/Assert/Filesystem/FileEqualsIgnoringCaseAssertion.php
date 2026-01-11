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

use PHPUnit\Framework\Assert\Assertion;
use PHPUnit\Framework\Assert\Equality\EqualsIgnoringCaseAssertion;

final class FileEqualsIgnoringCaseAssertion extends FileContentAssertion
{
    protected function expectation(string $message, array &$values): Assertion
    {
        return new EqualsIgnoringCaseAssertion($this->runner());
    }
}
