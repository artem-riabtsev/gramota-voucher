<?php

namespace App\Controller\Admin;

use App\Entity\VoucherTemplate;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use Symfony\Component\Uid\Uuid;

class VoucherTemplateCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return VoucherTemplate::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('Шаблон ваучера')
            ->setEntityLabelInPlural('Шаблоны ваучеров')
            ->setPageTitle('index', 'Список шаблонов')
            ->setPageTitle('new', 'Создать шаблон')
            ->setPageTitle('edit', 'Редактировать шаблон')
            ->setDefaultSort(['createdAt' => 'DESC']);
    }

    public function configureFields(string $pageName): iterable
    {
        $uuid = TextField::new('uuid', 'UUID')
            ->setFormTypeOption('disabled', true)
            ->hideWhenCreating();

        if ($pageName === Crud::PAGE_NEW) {
            $uuid = TextField::new('uuid', 'UUID')
                ->setFormTypeOption('data', Uuid::v4())
                ->setFormTypeOption('disabled', true);
        }

        $now = new \DateTime();
        $nextMonth = (clone $now)->modify('+1 month');

        return [
            IdField::new('id')->hideOnForm(),
            $uuid,
            TextField::new('title', 'Заголовок')
                ->setHelp('Например: Педагогика. Вопросы теории и практики')
                ->setRequired(false),
            TextareaField::new('description', 'Описание')
                ->setHelp('Например: Скидка 15%')
                ->setRequired(false),
            TextareaField::new('terms', 'Условия использования')
                ->setHelp('Подробные условия использования ваучера')
                ->setRequired(true),
            DateField::new('releasedFrom', 'Доступен с')
                ->setFormTypeOption('data', $now)
                ->setRequired(true)
                ->setFormat('dd.MM.yyyy'),
            DateField::new('releasedTo', 'Доступен по')
                ->setFormTypeOption('data', $nextMonth)
                ->setRequired(true)
                ->setFormat('dd.MM.yyyy'),
            ChoiceField::new('availabilityStatus', 'Статус')
                ->setChoices([
                    'Активен' => 'active',
                    'Неактивен' => 'inactive',
                    'Просрочен' => 'expired',
                    'Черновик' => 'draft',
                ])
                ->setRequired(true),
            DateTimeField::new('createdAt', 'Создан')
                ->setFormat('dd.MM.yyyy HH:mm')
                ->hideOnForm(),
            IntegerField::new('activeFromDelay', 'Задержка активации (дни)')
                ->setHelp('Через сколько дней после выдачи ваучер станет активным. 0 - сразу')
                ->setRequired(false),
            IntegerField::new('activeToDelay', 'Задержка деактивации (дни)')
                ->setHelp('Через сколько дней после активации ваучер станет неактивным')
                ->setRequired(false),
        ];
    }
}
