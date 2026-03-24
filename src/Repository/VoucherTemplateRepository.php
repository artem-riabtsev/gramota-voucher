<?php
// src/Repository/VoucherTemplateRepository.php

namespace App\Repository;

use App\Entity\VoucherTemplate;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<VoucherTemplate>
 */
class VoucherTemplateRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, VoucherTemplate::class);
    }
}
