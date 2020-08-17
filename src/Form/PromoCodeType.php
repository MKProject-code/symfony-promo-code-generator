<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\LessThanOrEqual;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Positive;

class PromoCodeType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('length', IntegerType::class, [
                'mapped' => false,
                'constraints' => array(
                    new NotBlank(array(
                        'message' => 'Please enter a value.'
                    )),
                    new LessThanOrEqual(array(
                        'value' => 20,
                        'message' => 'Please use a number less than or equal to 20.'
                    )),
                    new Positive(array(
                        'message' => 'Please use only positive numbers.'
                    ))
                )
            ])
            ->add('amount', IntegerType::class, [
                'mapped' => false,
                'constraints' => array(
                    new NotBlank(array(
                        'message' => 'Please enter a value.'
                    )),
                    new LessThanOrEqual(array(
                        'value' => 1000,
                        'message' => 'Please use a number less than or equal to 1000.'
                    )),
                    new Positive(array(
                        'message' => 'Please use only positive numbers.'
                    ))
                )
            ])
            ->add('type', ChoiceType::class, [
                'choices' => [
                    'Alphanumeric' => true,
                    'Only numbers' => false,
                ],
                'mapped' => false
            ])
            ->add('generate', SubmitType::class);
    }
}
