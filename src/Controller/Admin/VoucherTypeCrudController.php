<?php

namespace App\Controller\Admin;

use App\Entity\VoucherType;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;

class VoucherTypeCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return VoucherType::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('Тип ваучера')
            ->setEntityLabelInPlural('Типы ваучеров')
            ->setPageTitle('index', 'Типы ваучеров')
            ->setPageTitle('new', 'Создать новый тип')
            ->setPageTitle('edit', 'Редактировать тип');
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('name', 'Название журнала')
                ->setHelp('Например: "Педагогика. Вопросы теории и практики"'),
            IntegerField::new('defaultDiscount', 'Скидка по умолчанию (%)')
                ->setHelp('Эта скидка будет применяться к новым ваучерам этого типа'),
        ];
    }
}
