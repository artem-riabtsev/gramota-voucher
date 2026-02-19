<?php

namespace App\MessageHandler;

use App\Message\CleanupTempPdf;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
class CleanupTempPdfHandler
{
    public function __invoke(CleanupTempPdf $message): void
    {
        $tempDir = '/tmp/voucher_pdf';

        if (!is_dir($tempDir)) {
            return;
        }

        $files = glob($tempDir . '/*.pdf');
        $now = time();

        foreach ($files as $file) {
            if ($now - filemtime($file) > 60) {
                unlink($file);
            }
        }
    }
}
