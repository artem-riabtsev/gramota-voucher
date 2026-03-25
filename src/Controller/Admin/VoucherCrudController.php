<?php

namespace App\Controller\Admin;

use App\Entity\Voucher;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;

class VoucherCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Voucher::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('Ваучер')
            ->setEntityLabelInPlural('Ваучеры')
            ->setPageTitle('index', 'Список ваучеров')
            ->setPageTitle('new', 'Создать новый ваучер')
            ->setPageTitle('edit', 'Редактировать ваучер')
            ->setDefaultSort(['createdAt' => 'DESC']);
    }

    public function configureFields(string $pageName): iterable
    {
        $uuid = TextField::new('uuid', 'UUID')
            ->setFormTypeOption('disabled', true)
            ->hideWhenCreating();

        return [
            IdField::new('id')->hideOnForm(),
            $uuid,
            TextField::new('fullName', 'ФИО')->setDisabled(true),
            TextField::new('orcid', 'ORCID')->setDisabled(true),
            EmailField::new('email', 'Email')->setDisabled(true),
            BooleanField::new('redeemed', 'Использован'),
            TextareaField::new('terms', 'Условия использования')
                ->setHelp('Подробные условия использования ваучера')
                ->setRequired(true)
                ->setDisabled(true),
            DateTimeField::new('activeFrom', 'Активен с')
                ->setDisabled(true)
                ->setFormat('dd.MM.yyyy HH:mm'),
            DateTimeField::new('activeTo', 'Активен по')
                ->setDisabled(true)
                ->setFormat('dd.MM.yyyy HH:mm'),
            DateTimeField::new('createdAt', 'Создан')
                ->setDisabled(true)
                ->setFormat('dd.MM.yyyy HH:mm')
                ->hideOnForm(),
        ];
    }

    public function configureFilters(Filters $filters): Filters
    {
        return $filters
            ->add('template')
            ->add('fullName')
            ->add('email')
            ->add('redeemed')
            ->add('activeFrom')
            ->add('activeTo');
    }
}
