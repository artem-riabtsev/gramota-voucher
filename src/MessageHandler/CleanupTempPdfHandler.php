<?php

namespace App\MessageHandler;

use App\Message\CleanupTempPdf;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
class CleanupTempPdfHandler
{
    public function __invoke(CleanupTempPdf $message): void
    {
        $file = '/app/var/voucher_pdf/' . $message->uuid . '.pdf';

        if (file_exists($file)) {
            unlink($file);
        }
    }
}
