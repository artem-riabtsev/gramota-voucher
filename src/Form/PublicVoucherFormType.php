<?php

namespace App\Form;

use App\Entity\Voucher;
use App\Entity\VoucherType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PublicVoucherFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('fullName')
            ->add('orcid')
            ->add('email')
            ->add('voucherType', EntityType::class, [
                'class' => VoucherType::class,
                'choice_label' => 'name',
                'label' => 'Журнал',
                'placeholder' => 'Выберите журнал',
                'required' => true,
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Voucher::class,
        ]);
    }
}
