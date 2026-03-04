<?php

namespace App\Controller\Admin;

use App\Entity\Voucher;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
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
        $uuidField = TextField::new('uuid', 'UUID')
            ->formatValue(function ($value) {
                if ($value instanceof \Symfony\Component\Uid\Uuid) {
                    return $value->toRfc4122();
                }
                return $value;
            })
            ->hideWhenCreating()
            ->setDisabled();

        return [
            IdField::new('id')->hideOnForm(),
            $uuidField,
            AssociationField::new('voucherType', 'Тип ваучера')
                ->setHelp('Выберите журнал')
                ->setRequired(true),
            TextField::new('journal', 'Журнал')
                ->formatValue(function ($value, $entity) {
                    return $entity->getVoucherType()?->getName() ?? 'Не указан';
                })
                ->hideOnForm()
                ->setDisabled(),
            TextField::new('fullName', 'Полное имя'),
            TextField::new('orcid', 'ORCID'),
            EmailField::new('email', 'Email'),
            IntegerField::new('discount', 'Скидка (%)')
                ->setHelp('Индивидуальная скидка для этого ваучера'),
            DateTimeField::new('validFrom', 'Действует с')
                ->setFormat('dd.MM.yyyy HH:mm'),
            DateTimeField::new('validTo', 'Действует до')
                ->setFormat('dd.MM.yyyy HH:mm'),
            DateTimeField::new('createdAt', 'Создан')
                ->setFormat('dd.MM.yyyy HH:mm')
                ->hideOnForm(),
        ];
    }

    public function configureFilters(Filters $filters): Filters
    {
        return $filters
            ->add('voucherType')
            ->add('fullName')
            ->add('email')
            ->add('discount')
            ->add('validFrom')
            ->add('validTo')
            ->add('createdAt');
    }
}
