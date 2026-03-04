<?php

namespace App\DataFixtures;

use App\Entity\VoucherType;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class VoucherTypeFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $type1 = new VoucherType();
        $type1->setName('Педагогика. Вопросы теории и практики');
        $type1->setDefaultDiscount(15);
        $manager->persist($type1);

        $type2 = new VoucherType();
        $type2->setName('Манускрипт');
        $type2->setDefaultDiscount(15);
        $manager->persist($type2);

        $type3 = new VoucherType();
        $type3->setName('Pan-Art');
        $type3->setDefaultDiscount(15);
        $manager->persist($type3);

        $type4 = new VoucherType();
        $type4->setName('Филологические науки. Вопросы теории и практики');
        $type4->setDefaultDiscount(15);
        $manager->persist($type4);

        $manager->flush();
    }
}
