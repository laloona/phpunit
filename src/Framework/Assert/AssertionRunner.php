<?php declare(strict_types=1);
/*
 * This file is part of PHPUnit.
 *
 * (c) Sebastian Bergmann <sebastian@phpunit.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace PHPUnit\Framework\Assert;

use function count;
use PHPUnit\Framework\Constraint\Constraint;
use PHPUnit\Framework\ExpectationFailedException;

final class AssertionRunner implements Assertable
{
    private static int $count = 0;

    /**
     * Increade counter.
     */
    public static function increase(int $count = 1): void
    {
        self::$count += $count;
    }

    /**
     * Return the current assertion count.
     */
    public static function getCount(): int
    {
        return self::$count;
    }

    /**
     * Reset the assertion counter.
     */
    public static function resetCount(): void
    {
        self::$count = 0;
    }

    public static function get(): self
    {
        return new self;
    }

    /**
     * Evaluates a PHPUnit\Framework\Constraint matcher object.
     *
     * @throws ExpectationFailedException
     */
    public function assert(mixed $value, Constraint $constraint, string $message): void
    {
        self::increase(count($constraint));

        $constraint->evaluate($value, $message);
    }
}
