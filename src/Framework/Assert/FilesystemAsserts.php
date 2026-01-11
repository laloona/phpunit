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

use PHPUnit\Framework\Assert\Contraints\Filesystem\DirectoryExistsAssertion;
use PHPUnit\Framework\Assert\Contraints\Filesystem\DirectoryIsReadableAssertion;
use PHPUnit\Framework\Assert\Contraints\Filesystem\DirectoryIsWritableAssertion;
use PHPUnit\Framework\Assert\Contraints\Filesystem\FileEqualsAssertion;
use PHPUnit\Framework\Assert\Contraints\Filesystem\FileEqualsCanonicalizingAssertion;
use PHPUnit\Framework\Assert\Contraints\Filesystem\FileEqualsIgnoringCaseAssertion;
use PHPUnit\Framework\Assert\Contraints\Filesystem\FileExistsAssertion;
use PHPUnit\Framework\Assert\Contraints\Filesystem\FileIsReadableAssertion;
use PHPUnit\Framework\Assert\Contraints\Filesystem\FileIsWritableAssertion;
use PHPUnit\Framework\Assert\Contraints\Filesystem\FileMatchesFormatAssertion;
use PHPUnit\Framework\Assert\Contraints\Filesystem\FileMatchesFormatFileAssertion;
use PHPUnit\Framework\Assert\Contraints\Filesystem\IsReadableAssertion;
use PHPUnit\Framework\Assert\Contraints\Filesystem\IsWritableAssertion;
use PHPUnit\Framework\ExpectationFailedException;

trait FilesystemAsserts
{
    /**
     * Asserts that the contents of one file is equal to the contents of another
     * file.
     *
     * @throws ExpectationFailedException
     */
    final public static function assertFileEquals(string $expected, string $actual, string $message = ''): void
    {
        new FileEqualsAssertion(AssertionRunner::get())->assert($message, $actual, $expected);
    }

    /**
     * Asserts that the contents of one file is not equal to the contents of
     * another file.
     *
     * @throws ExpectationFailedException
     */
    final public static function assertFileNotEquals(string $expected, string $actual, string $message = ''): void
    {
        new FileEqualsAssertion(AssertionRunner::get())->assertNot($message, $actual, $expected);
    }

    /**
     * Asserts that the contents of one file is equal to the contents of another
     * file (canonicalizing).
     *
     * @throws ExpectationFailedException
     */
    final public static function assertFileEqualsCanonicalizing(string $expected, string $actual, string $message = ''): void
    {
        new FileEqualsCanonicalizingAssertion(AssertionRunner::get())->assert($message, $actual, $expected);
    }

    /**
     * Asserts that the contents of one file is not equal to the contents of another
     * file (canonicalizing).
     *
     * @throws ExpectationFailedException
     */
    final public static function assertFileNotEqualsCanonicalizing(string $expected, string $actual, string $message = ''): void
    {
        new FileEqualsCanonicalizingAssertion(AssertionRunner::get())->assertNot($message, $actual, $expected);
    }

    /**
     * Asserts that the contents of one file is equal to the contents of another
     * file (ignoring case).
     *
     * @throws ExpectationFailedException
     */
    final public static function assertFileEqualsIgnoringCase(string $expected, string $actual, string $message = ''): void
    {
        new FileEqualsIgnoringCaseAssertion(AssertionRunner::get())->assert($message, $actual, $expected);
    }

    /**
     * Asserts that the contents of one file is not equal to the contents of another
     * file (ignoring case).
     *
     * @throws ExpectationFailedException
     */
    final public static function assertFileNotEqualsIgnoringCase(string $expected, string $actual, string $message = ''): void
    {
        new FileEqualsIgnoringCaseAssertion(AssertionRunner::get())->assertNot($message, $actual, $expected);
    }

    /**
     * Asserts that a file/dir is readable.
     *
     * @throws ExpectationFailedException
     */
    final public static function assertIsReadable(string $filename, string $message = ''): void
    {
        new IsReadableAssertion(AssertionRunner::get())->assert($message, $filename);
    }

    /**
     * Asserts that a file/dir exists and is not readable.
     *
     * @throws ExpectationFailedException
     */
    final public static function assertIsNotReadable(string $filename, string $message = ''): void
    {
        new IsReadableAssertion(AssertionRunner::get())->assertNot($message, $filename);
    }

    /**
     * Asserts that a file/dir exists and is writable.
     *
     * @throws ExpectationFailedException
     */
    final public static function assertIsWritable(string $filename, string $message = ''): void
    {
        new IsWritableAssertion(AssertionRunner::get())->assert($message, $filename);
    }

    /**
     * Asserts that a file/dir exists and is not writable.
     *
     * @throws ExpectationFailedException
     */
    final public static function assertIsNotWritable(string $filename, string $message = ''): void
    {
        new IsWritableAssertion(AssertionRunner::get())->assertNot($message, $filename);
    }

    /**
     * Asserts that a directory exists.
     *
     * @throws ExpectationFailedException
     */
    final public static function assertDirectoryExists(string $directory, string $message = ''): void
    {
        new DirectoryExistsAssertion(AssertionRunner::get())->assert($message, $directory);
    }

    /**
     * Asserts that a directory does not exist.
     *
     * @throws ExpectationFailedException
     */
    final public static function assertDirectoryDoesNotExist(string $directory, string $message = ''): void
    {
        new DirectoryExistsAssertion(AssertionRunner::get())->assertNot($message, $directory);
    }

    /**
     * Asserts that a directory exists and is readable.
     *
     * @throws ExpectationFailedException
     */
    final public static function assertDirectoryIsReadable(string $directory, string $message = ''): void
    {
        new DirectoryIsReadableAssertion(AssertionRunner::get())->assert($message, $directory);
    }

    /**
     * Asserts that a directory exists and is not readable.
     *
     * @throws ExpectationFailedException
     */
    final public static function assertDirectoryIsNotReadable(string $directory, string $message = ''): void
    {
        new DirectoryIsReadableAssertion(AssertionRunner::get())->assertNot($message, $directory);
    }

    /**
     * Asserts that a directory exists and is writable.
     *
     * @throws ExpectationFailedException
     */
    final public static function assertDirectoryIsWritable(string $directory, string $message = ''): void
    {
        new DirectoryIsWritableAssertion(AssertionRunner::get())->assert($message, $directory);
    }

    /**
     * Asserts that a directory exists and is not writable.
     *
     * @throws ExpectationFailedException
     */
    final public static function assertDirectoryIsNotWritable(string $directory, string $message = ''): void
    {
        new DirectoryIsWritableAssertion(AssertionRunner::get())->assertNot($message, $directory);
    }

    /**
     * Asserts that a file exists.
     *
     * @throws ExpectationFailedException
     */
    final public static function assertFileExists(string $filename, string $message = ''): void
    {
        new FileExistsAssertion(AssertionRunner::get())->assert($message, $filename);
    }

    /**
     * Asserts that a file does not exist.
     *
     * @throws ExpectationFailedException
     */
    final public static function assertFileDoesNotExist(string $filename, string $message = ''): void
    {
        new FileExistsAssertion(AssertionRunner::get())->assertNot($message, $filename);
    }

    /**
     * Asserts that a file exists and is readable.
     *
     * @throws ExpectationFailedException
     */
    final public static function assertFileIsReadable(string $file, string $message = ''): void
    {
        new FileIsReadableAssertion(AssertionRunner::get())->assert($message, $file);
    }

    /**
     * Asserts that a file exists and is not readable.
     *
     * @throws ExpectationFailedException
     */
    final public static function assertFileIsNotReadable(string $file, string $message = ''): void
    {
        new FileIsReadableAssertion(AssertionRunner::get())->assertNot($message, $file);
    }

    /**
     * Asserts that a file exists and is writable.
     *
     * @throws ExpectationFailedException
     */
    final public static function assertFileIsWritable(string $file, string $message = ''): void
    {
        new FileIsWritableAssertion(AssertionRunner::get())->assert($message, $file);
    }

    /**
     * Asserts that a file exists and is not writable.
     *
     * @throws ExpectationFailedException
     */
    final public static function assertFileIsNotWritable(string $file, string $message = ''): void
    {
        new FileIsWritableAssertion(AssertionRunner::get())->assertNot($message, $file);
    }

    /**
     * Asserts that a string matches a given format string.
     *
     * @throws ExpectationFailedException
     */
    final public static function assertFileMatchesFormat(string $format, string $actualFile, string $message = ''): void
    {
        new FileMatchesFormatAssertion(AssertionRunner::get())->assert($message, $actualFile, $format);
    }

    /**
     * Asserts that a string matches a given format string.
     *
     * @throws ExpectationFailedException
     */
    final public static function assertFileMatchesFormatFile(string $formatFile, string $actualFile, string $message = ''): void
    {
        new FileMatchesFormatFileAssertion(AssertionRunner::get())->assert($message, $actualFile, $formatFile);
    }
}
