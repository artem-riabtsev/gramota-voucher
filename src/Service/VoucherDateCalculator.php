<?php

namespace App\Service;

use App\Entity\Voucher;
use App\Entity\VoucherTemplate;

class VoucherDateCalculator
{
    /**
     * Рассчитывает даты для ваучера на основе шаблона
     */
    public function calculateDates(Voucher $voucher, VoucherTemplate $template): void
    {
        $now = new \DateTime();

        $voucher->setCreatedAt($now);
        $activeFrom = clone $now;
        if ($template->getActiveFromDelay()) {
            $activeFrom->modify("+{$template->getActiveFromDelay()} days");
        }
        $voucher->setActiveFrom($activeFrom);

        $activeTo = clone $activeFrom;
        if ($template->getActiveToDelay()) {
            $activeTo->modify("+{$template->getActiveToDelay()} days");
        }
        $voucher->setActiveTo($activeTo);
    }
}
