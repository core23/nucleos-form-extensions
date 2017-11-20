<?php

/*
 * (c) Christian Gripp <mail@core23.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Core23\FormExtensionsBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\DataTransformer\NumberToLocalizedStringTransformer;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class NumberOutputType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->addViewTransformer(
            new NumberToLocalizedStringTransformer(
                $options['precision'],
                $options['grouping'],
                $options['rounding_mode']
            )
        );
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver
            ->setDefaults(array(
                'precision'     => null,
                'grouping'      => false,
                'rounding_mode' => NumberToLocalizedStringTransformer::ROUND_HALF_UP,
                'suffix'        => '',
                'prefix'        => '',
                'required'      => false,
                'read_only'     => true,
                'disabled'      => true,
            ))
            ->setAllowedTypes('precision', array('null', 'int'))
            ->setAllowedTypes('grouping', 'bool')
            ->setAllowedTypes('suffix', 'string')
            ->setAllowedTypes('prefix', 'string')
            ->setAllowedValues('rounding_mode', array(
                NumberToLocalizedStringTransformer::ROUND_FLOOR,
                NumberToLocalizedStringTransformer::ROUND_DOWN,
                NumberToLocalizedStringTransformer::ROUND_HALF_DOWN,
                NumberToLocalizedStringTransformer::ROUND_HALF_EVEN,
                NumberToLocalizedStringTransformer::ROUND_HALF_UP,
                NumberToLocalizedStringTransformer::ROUND_UP,
                NumberToLocalizedStringTransformer::ROUND_CEILING,
            ))
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return $this->getBlockPrefix();
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'number_output';
    }

    /**
     * {@inheritdoc}
     */
    public function getParent()
    {
        return OutputType::class;
    }
}
