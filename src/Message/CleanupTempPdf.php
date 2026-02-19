<?php

namespace App\Message;

class CleanupTempPdf
{
    public function __construct(
        public string $uuid
    ) {}
}
