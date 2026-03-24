<?php

namespace App\Form;

use App\Entity\Voucher;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;

class PublicVoucherFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $today = new \DateTime();


        $builder
            ->add('fullName', TextType::class, [
                'label' => 'ФИО',
                'attr' => [
                    'placeholder' => 'Иванов Иван Иванович',
                    'required' => true,
                ],
            ])
            ->add('orcid', TextType::class, [
                'label' => 'ORCID',
                'attr' => [
                    'placeholder' => '0000-0000-0000-0000',
                    'required' => true,
                    'oninput' => 'this.value = this.value.replace(/[^0-9]/g, "").replace(/(\d{4})(?=\d)/g, "$1-").slice(0, 19);',
                ],
            ])
            ->add('email', EmailType::class, [
                'label' => 'Email',
                'attr' => [
                    'placeholder' => 'name@example.com',
                    'required' => true,
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
