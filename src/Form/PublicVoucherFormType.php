<?php

namespace App\Form;

use App\Entity\Voucher;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Validator\Constraints as Assert;

class PublicVoucherFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {

        $today = new \DateTime();

        $builder
            ->add('fullName', TextType::class, [
                'label' => 'Full name',
                'attr' => [
                    'placeholder' => 'Иванов Иван Иванович',
                    'pattern' => '[а-яА-ЯёЁa-zA-Z\s\-]+',  // Только буквы, пробелы, дефисы
                    'minlength' => 5,
                    'maxlength' => 255,
                    'title' => 'ФИО должно содержать только буквы, пробелы и дефисы (минимум 5 символов)',
                    'required' => true,
                ],
            ])
            ->add('orcid', TextType::class, [
                'label' => 'Orcid',
                'attr' => [
                    'placeholder' => '0000-0000-0000-0000',
                    'pattern' => '\d{4}-\d{4}-\d{4}-\d{4}',
                    'title' => 'ORCID должен быть в формате 0000-0000-0000-0000',
                    'required' => true,
                ],
            ])
            ->add('email', EmailType::class, [
                'label' => 'Email',
                'attr' => [
                    'placeholder' => 'name@example.com',
                    'required' => true,
                ],
            ])
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
