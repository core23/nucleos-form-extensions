<?php

/*
 * (c) Christian Gripp <mail@core23.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Core23\Form\Tests\Bridge\Symfony\DependencyInjection;

use Core23\Form\Bridge\Symfony\DependencyInjection\Core23FormExtension;
use Core23\Form\Extension\DownloadTypeExtension;
use Core23\Form\Extension\HelpTypeExtension;
use Core23\Form\Extension\ImageTypeExtension;
use Core23\Form\Type\AutocompleteType;
use Core23\Form\Type\BatchTimeType;
use Core23\Form\Type\DACHCountryType;
use Core23\Form\Type\DateOutputType;
use Core23\Form\Type\DatePickerType;
use Core23\Form\Type\DateTimePickerType;
use Core23\Form\Type\GenderType;
use Core23\Form\Type\NumberOutputType;
use Core23\Form\Type\OutputType;
use Core23\Form\Type\TimePickerType;
use Core23\Form\Validator\Constraints\BatchTimeAfterValidator;
use Core23\Form\Validator\Constraints\DateAfterValidator;
use Matthias\SymfonyDependencyInjectionTest\PhpUnit\AbstractExtensionTestCase;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\PrependExtensionInterface;

class Core23FormExtensionTest extends AbstractExtensionTestCase
{
    public function testLoadDefault(): void
    {
        $this->load();

        $this->assertContainerBuilderHasService('core23_form.type.dach_country', DACHCountryType::class);
        $this->assertContainerBuilderHasService('core23_form.type.gender', GenderType::class);
        $this->assertContainerBuilderHasService('core23_form.type.output', OutputType::class);
        $this->assertContainerBuilderHasService('core23_form.type.date_output', DateOutputType::class);
        $this->assertContainerBuilderHasService('core23_form.type.number_output', NumberOutputType::class);
        $this->assertContainerBuilderHasService('core23_form.type.batch_time', BatchTimeType::class);
        $this->assertContainerBuilderHasService('core23_form.type.time_picker', TimePickerType::class);
        $this->assertContainerBuilderHasService('core23_form.type.datetime_picker', DateTimePickerType::class);
        $this->assertContainerBuilderHasService('core23_form.type.date_picker', DatePickerType::class);
        $this->assertContainerBuilderHasService('core23_form.type.autocomplete', AutocompleteType::class);
        $this->assertContainerBuilderHasService('core23_form.image_type_extension', ImageTypeExtension::class);
        $this->assertContainerBuilderHasService('core23_form.download_type_extension', DownloadTypeExtension::class);
        $this->assertContainerBuilderHasService('core23_form.help_type_extension', HelpTypeExtension::class);

        $this->assertContainerBuilderHasService('core23_form.validator.date_after', DateAfterValidator::class);
        $this->assertContainerBuilderHasService('core23_form.validator.batch_time_after', BatchTimeAfterValidator::class);
    }

    public function testLoadWithTwigExtension(): void
    {
        $fakeContainer = $this->createMock(ContainerBuilder::class);
        $fakeContainer->expects($this->once())
            ->method('hasExtension')
            ->with($this->equalTo('twig'))
            ->willReturn(true)
        ;
        $fakeContainer->expects($this->once())
            ->method('prependExtensionConfig')
            ->with('twig', ['form_themes' => ['@Core23Form/Form/widgets.html.twig']])
        ;

        foreach ($this->getContainerExtensions() as $extension) {
            if ($extension instanceof PrependExtensionInterface) {
                $extension->prepend($fakeContainer);
            }
        }
    }

    protected function getContainerExtensions()
    {
        return [
            new Core23FormExtension(),
        ];
    }
}