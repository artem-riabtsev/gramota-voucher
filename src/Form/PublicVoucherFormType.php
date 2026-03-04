<?php

namespace App\Form;

use App\Entity\Voucher;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;

class PublicVoucherFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {

        $today = new \DateTime();

        $builder
            ->add('fullName')
            ->add('orcid')
            ->add('email')
            ->add('type', ChoiceType::class, [
                'label' => 'Type',
                'choices' => [
                    'Для себя' => Voucher::TYPE_SELF,
                    'Подарочный' => Voucher::TYPE_GIFT,
                ],
                'expanded' => true,
                'multiple' => false,
                'data' => Voucher::TYPE_SELF,
            ])
            ->add('validFrom', DateType::class, [
                'label' => 'Дата начала действия',
                'widget' => 'single_text',
                'html5' => true,
                'required' => false,
                'data' => $today,
                'attr' => [
                    'min' => $today->format('Y-m-d'),
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Voucher::class,
        ]);
    }
}
