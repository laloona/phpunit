<?php declare(strict_types=1);
/*
 * This file is part of PHPUnit.
 *
 * (c) Sebastian Bergmann <sebastian@phpunit.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace PHPUnit\Framework;

use PHPUnit\Framework\Assert\AssertionRunner;
use PHPUnit\Framework\Assert\BooleanAsserts;
use PHPUnit\Framework\Assert\CardinalityAsserts;
use PHPUnit\Framework\Assert\Constraints;
use PHPUnit\Framework\Assert\EqualityAsserts;
use PHPUnit\Framework\Assert\FilesystemAsserts;
use PHPUnit\Framework\Assert\IdentityAsserts;
use PHPUnit\Framework\Assert\JsonAsserts;
use PHPUnit\Framework\Assert\MathAsserts;
use PHPUnit\Framework\Assert\ObjectAsserts;
use PHPUnit\Framework\Assert\StringAsserts;
use PHPUnit\Framework\Assert\ThatAssertion;
use PHPUnit\Framework\Assert\TraversableAsserts;
use PHPUnit\Framework\Assert\TypeAsserts;
use PHPUnit\Framework\Assert\XmlAsserts;
use PHPUnit\Framework\Constraint\Constraint;

/**
 * @no-named-arguments Parameter names are not covered by the backward compatibility promise for PHPUnit
 */
abstract class Assert
{
    use BooleanAsserts;
    use CardinalityAsserts;
    use Constraints;
    use EqualityAsserts;
    use FilesystemAsserts;
    use IdentityAsserts;
    use JsonAsserts;
    use MathAsserts;
    use ObjectAsserts;
    use StringAsserts;
    use TraversableAsserts;
    use TypeAsserts;
    use XmlAsserts;

    /**
     * Evaluates a PHPUnit\Framework\Constraint matcher object.
     *
     * @throws ExpectationFailedException
     */
    final public static function assertThat(mixed $value, Constraint $constraint, string $message = ''): void
    {
        new ThatAssertion(AssertionRunner::get())->assert($message, $value, $constraint);
    }

    /**
     * Fails a test with the given message.
     *
     * @throws AssertionFailedError
     */
    final public static function fail(string $message = ''): never
    {
        AssertionRunner::increase(1);

        throw new AssertionFailedError($message);
    }

    /**
     * Return the current assertion count.
     */
    final public static function getCount(): int
    {
        return AssertionRunner::getCount();
    }

    /**
     * Reset the assertion counter.
     */
    final public static function resetCount(): void
    {
        AssertionRunner::resetCount();
    }

    /**
     * Mark the test as incomplete.
     *
     * @throws IncompleteTestError
     */
    final public static function markTestIncomplete(string $message = ''): never
    {
        throw new IncompleteTestError($message);
    }

    /**
     * Mark the test as skipped.
     *
     * @throws SkippedWithMessageException
     */
    final public static function markTestSkipped(string $message = ''): never
    {
        throw new SkippedWithMessageException($message);
    }
}
