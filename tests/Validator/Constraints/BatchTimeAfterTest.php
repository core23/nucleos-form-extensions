<?php

/*
 * (c) Christian Gripp <mail@core23.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Core23\Form\Tests\Validator\Constraints;

use Core23\Form\Validator\Constraints\BatchTimeAfter;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Validator\Exception\InvalidOptionsException;
use Symfony\Component\Validator\Exception\MissingOptionsException;

class BatchTimeAfterTest extends TestCase
{
    public function testItIsNotInstantiableWithMissingFirstField(): void
    {
        $this->expectException(MissingOptionsException::class);
        $this->expectExceptionMessage(sprintf('The options "firstField" must be set for constraint %s', BatchTimeAfter::class));

        new BatchTimeAfter([
            'secondField' => 'first',
        ]);
    }

    public function testItIsNotInstantiableWithMissingSecondField(): void
    {
        $this->expectException(MissingOptionsException::class);
        $this->expectExceptionMessage(sprintf('The options "secondField" must be set for constraint %s', BatchTimeAfter::class));

        new BatchTimeAfter([
            'firstField' => 'first',
        ]);
    }

    public function testItIsNotInstantiableWithSameField(): void
    {
        $this->expectException(InvalidOptionsException::class);
        $this->expectExceptionMessage('The options "firstField" and "secondField" can not be the same for constraint '.BatchTimeAfter::class);

        new BatchTimeAfter([
            'firstField'  => 'first',
            'secondField' => 'first',
        ]);
    }

    public function testItIsInstantiable(): void
    {
        $dateAfter = new BatchTimeAfter([
            'firstField'  => 'first',
            'secondField' => 'second',
        ]);

        $this->assertSame('first', $dateAfter->firstField);
        $this->assertSame('second', $dateAfter->secondField);
    }
}