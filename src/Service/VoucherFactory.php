<?php

namespace App\Service;

use App\Entity\Voucher;
use App\Entity\VoucherTemplate;

class VoucherFactory
{
    private VoucherDateCalculator $dateCalculator;

    public function __construct(VoucherDateCalculator $dateCalculator)
    {
        $this->dateCalculator = $dateCalculator;
    }

    /**
     * Создает ваучер из шаблона
     */
    public function createFromTemplate(VoucherTemplate $template, ?\DateTime $customActiveFrom = null): Voucher
    {
        $voucher = new Voucher();
        $voucher->setTemplate($template);
        $voucher->setRedeemed(false);
        $voucher->setTerms($template->getTerms());

        $this->dateCalculator->calculateDates($voucher, $template, $customActiveFrom);

        return $voucher;
    }
}
