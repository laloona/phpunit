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

use PHPUnit\Framework\Constraint\ArrayHasKey;
use PHPUnit\Framework\Constraint\Callback;
use PHPUnit\Framework\Constraint\Constraint;
use PHPUnit\Framework\Constraint\Count;
use PHPUnit\Framework\Constraint\DirectoryExists;
use PHPUnit\Framework\Constraint\FileExists;
use PHPUnit\Framework\Constraint\GreaterThan;
use PHPUnit\Framework\Constraint\IsAnything;
use PHPUnit\Framework\Constraint\IsEmpty;
use PHPUnit\Framework\Constraint\IsEqual;
use PHPUnit\Framework\Constraint\IsEqualCanonicalizing;
use PHPUnit\Framework\Constraint\IsEqualIgnoringCase;
use PHPUnit\Framework\Constraint\IsEqualWithDelta;
use PHPUnit\Framework\Constraint\IsFalse;
use PHPUnit\Framework\Constraint\IsFinite;
use PHPUnit\Framework\Constraint\IsIdentical;
use PHPUnit\Framework\Constraint\IsInfinite;
use PHPUnit\Framework\Constraint\IsInstanceOf;
use PHPUnit\Framework\Constraint\IsJson;
use PHPUnit\Framework\Constraint\IsList;
use PHPUnit\Framework\Constraint\IsNan;
use PHPUnit\Framework\Constraint\IsNull;
use PHPUnit\Framework\Constraint\IsReadable;
use PHPUnit\Framework\Constraint\IsTrue;
use PHPUnit\Framework\Constraint\IsType;
use PHPUnit\Framework\Constraint\IsWritable;
use PHPUnit\Framework\Constraint\LessThan;
use PHPUnit\Framework\Constraint\LogicalAnd;
use PHPUnit\Framework\Constraint\LogicalNot;
use PHPUnit\Framework\Constraint\LogicalOr;
use PHPUnit\Framework\Constraint\LogicalXor;
use PHPUnit\Framework\Constraint\ObjectEquals;
use PHPUnit\Framework\Constraint\RegularExpression;
use PHPUnit\Framework\Constraint\StringContains;
use PHPUnit\Framework\Constraint\StringEndsWith;
use PHPUnit\Framework\Constraint\StringEqualsStringIgnoringLineEndings;
use PHPUnit\Framework\Constraint\StringMatchesFormatDescription;
use PHPUnit\Framework\Constraint\StringStartsWith;
use PHPUnit\Framework\Constraint\TraversableContainsEqual;
use PHPUnit\Framework\Constraint\TraversableContainsIdentical;
use PHPUnit\Framework\Constraint\TraversableContainsOnly;
use PHPUnit\Framework\Exception;
use PHPUnit\Framework\InvalidArgumentException;
use PHPUnit\Framework\NativeType;
use PHPUnit\Framework\UnknownClassOrInterfaceException;

trait Constraints
{
    final public static function logicalAnd(mixed ...$constraints): LogicalAnd
    {
        return LogicalAnd::fromConstraints(...$constraints);
    }

    final public static function logicalOr(mixed ...$constraints): LogicalOr
    {
        return LogicalOr::fromConstraints(...$constraints);
    }

    final public static function logicalNot(Constraint $constraint): LogicalNot
    {
        return new LogicalNot($constraint);
    }

    final public static function logicalXor(mixed ...$constraints): LogicalXor
    {
        return LogicalXor::fromConstraints(...$constraints);
    }

    final public static function anything(): IsAnything
    {
        return new IsAnything;
    }

    final public static function isTrue(): IsTrue
    {
        return new IsTrue;
    }

    /**
     * @template CallbackInput of mixed
     *
     * @param callable(CallbackInput $callback): bool $callback
     *
     * @return Callback<CallbackInput>
     */
    final public static function callback(callable $callback): Callback
    {
        return new Callback($callback);
    }

    final public static function isFalse(): IsFalse
    {
        return new IsFalse;
    }

    final public static function isJson(): IsJson
    {
        return new IsJson;
    }

    final public static function isNull(): IsNull
    {
        return new IsNull;
    }

    final public static function isFinite(): IsFinite
    {
        return new IsFinite;
    }

    final public static function isInfinite(): IsInfinite
    {
        return new IsInfinite;
    }

    final public static function isNan(): IsNan
    {
        return new IsNan;
    }

    final public static function containsEqual(mixed $value): TraversableContainsEqual
    {
        return new TraversableContainsEqual($value);
    }

    final public static function containsIdentical(mixed $value): TraversableContainsIdentical
    {
        return new TraversableContainsIdentical($value);
    }

    final public static function containsOnlyArray(): TraversableContainsOnly
    {
        return TraversableContainsOnly::forNativeType(NativeType::Array);
    }

    final public static function containsOnlyBool(): TraversableContainsOnly
    {
        return TraversableContainsOnly::forNativeType(NativeType::Bool);
    }

    final public static function containsOnlyCallable(): TraversableContainsOnly
    {
        return TraversableContainsOnly::forNativeType(NativeType::Callable);
    }

    final public static function containsOnlyFloat(): TraversableContainsOnly
    {
        return TraversableContainsOnly::forNativeType(NativeType::Float);
    }

    final public static function containsOnlyInt(): TraversableContainsOnly
    {
        return TraversableContainsOnly::forNativeType(NativeType::Int);
    }

    final public static function containsOnlyIterable(): TraversableContainsOnly
    {
        return TraversableContainsOnly::forNativeType(NativeType::Iterable);
    }

    final public static function containsOnlyNull(): TraversableContainsOnly
    {
        return TraversableContainsOnly::forNativeType(NativeType::Null);
    }

    final public static function containsOnlyNumeric(): TraversableContainsOnly
    {
        return TraversableContainsOnly::forNativeType(NativeType::Numeric);
    }

    final public static function containsOnlyObject(): TraversableContainsOnly
    {
        return TraversableContainsOnly::forNativeType(NativeType::Object);
    }

    final public static function containsOnlyResource(): TraversableContainsOnly
    {
        return TraversableContainsOnly::forNativeType(NativeType::Resource);
    }

    final public static function containsOnlyClosedResource(): TraversableContainsOnly
    {
        return TraversableContainsOnly::forNativeType(NativeType::ClosedResource);
    }

    final public static function containsOnlyScalar(): TraversableContainsOnly
    {
        return TraversableContainsOnly::forNativeType(NativeType::Scalar);
    }

    final public static function containsOnlyString(): TraversableContainsOnly
    {
        return TraversableContainsOnly::forNativeType(NativeType::String);
    }

    /**
     * @param class-string $className
     *
     * @throws Exception
     */
    final public static function containsOnlyInstancesOf(string $className): TraversableContainsOnly
    {
        return TraversableContainsOnly::forClassOrInterface($className);
    }

    final public static function arrayHasKey(mixed $key): ArrayHasKey
    {
        return new ArrayHasKey($key);
    }

    final public static function isList(): IsList
    {
        return new IsList;
    }

    final public static function equalTo(mixed $value): IsEqual
    {
        return new IsEqual($value);
    }

    final public static function equalToCanonicalizing(mixed $value): IsEqualCanonicalizing
    {
        return new IsEqualCanonicalizing($value);
    }

    final public static function equalToIgnoringCase(mixed $value): IsEqualIgnoringCase
    {
        return new IsEqualIgnoringCase($value);
    }

    final public static function equalToWithDelta(mixed $value, float $delta): IsEqualWithDelta
    {
        return new IsEqualWithDelta($value, $delta);
    }

    final public static function isEmpty(): IsEmpty
    {
        return new IsEmpty;
    }

    final public static function isWritable(): IsWritable
    {
        return new IsWritable;
    }

    final public static function isReadable(): IsReadable
    {
        return new IsReadable;
    }

    final public static function directoryExists(): DirectoryExists
    {
        return new DirectoryExists;
    }

    final public static function fileExists(): FileExists
    {
        return new FileExists;
    }

    final public static function greaterThan(mixed $value): GreaterThan
    {
        return new GreaterThan($value);
    }

    final public static function greaterThanOrEqual(mixed $value): LogicalOr
    {
        return self::logicalOr(
            new IsEqual($value),
            new GreaterThan($value),
        );
    }

    final public static function identicalTo(mixed $value): IsIdentical
    {
        return new IsIdentical($value);
    }

    /**
     * @throws UnknownClassOrInterfaceException
     */
    final public static function isInstanceOf(string $className): IsInstanceOf
    {
        return new IsInstanceOf($className);
    }

    final public static function isArray(): IsType
    {
        return new IsType(NativeType::Array);
    }

    final public static function isBool(): IsType
    {
        return new IsType(NativeType::Bool);
    }

    final public static function isCallable(): IsType
    {
        return new IsType(NativeType::Callable);
    }

    final public static function isFloat(): IsType
    {
        return new IsType(NativeType::Float);
    }

    final public static function isInt(): IsType
    {
        return new IsType(NativeType::Int);
    }

    final public static function isIterable(): IsType
    {
        return new IsType(NativeType::Iterable);
    }

    final public static function isNumeric(): IsType
    {
        return new IsType(NativeType::Numeric);
    }

    final public static function isObject(): IsType
    {
        return new IsType(NativeType::Object);
    }

    final public static function isResource(): IsType
    {
        return new IsType(NativeType::Resource);
    }

    final public static function isClosedResource(): IsType
    {
        return new IsType(NativeType::ClosedResource);
    }

    final public static function isScalar(): IsType
    {
        return new IsType(NativeType::Scalar);
    }

    final public static function isString(): IsType
    {
        return new IsType(NativeType::String);
    }

    final public static function lessThan(mixed $value): LessThan
    {
        return new LessThan($value);
    }

    final public static function lessThanOrEqual(mixed $value): LogicalOr
    {
        return self::logicalOr(
            new IsEqual($value),
            new LessThan($value),
        );
    }

    final public static function matchesRegularExpression(string $pattern): RegularExpression
    {
        return new RegularExpression($pattern);
    }

    final public static function matches(string $string): StringMatchesFormatDescription
    {
        return new StringMatchesFormatDescription($string);
    }

    /**
     * @param non-empty-string $prefix
     *
     * @throws InvalidArgumentException
     */
    final public static function stringStartsWith(string $prefix): StringStartsWith
    {
        return new StringStartsWith($prefix);
    }

    final public static function stringContains(string $string, bool $case = true): StringContains
    {
        return new StringContains($string, $case);
    }

    /**
     * @param non-empty-string $suffix
     *
     * @throws InvalidArgumentException
     */
    final public static function stringEndsWith(string $suffix): StringEndsWith
    {
        return new StringEndsWith($suffix);
    }

    final public static function stringEqualsStringIgnoringLineEndings(string $string): StringEqualsStringIgnoringLineEndings
    {
        return new StringEqualsStringIgnoringLineEndings($string);
    }

    final public static function countOf(int $count): Count
    {
        return new Count($count);
    }

    final public static function objectEquals(object $object, string $method = 'equals'): ObjectEquals
    {
        return new ObjectEquals($object, $method);
    }
}
