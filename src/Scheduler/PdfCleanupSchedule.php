<?php

// namespace App\Scheduler;

// use App\Message\CleanupTempPdf;
// use Symfony\Component\Scheduler\Attribute\AsSchedule;
// use Symfony\Component\Scheduler\RecurringMessage;
// use Symfony\Component\Scheduler\Schedule;
// use Symfony\Component\Scheduler\ScheduleProviderInterface;

// #[AsSchedule('pdf_cleanup')]
// class PdfCleanupSchedule implements ScheduleProviderInterface
// {
//     public function getSchedule(): Schedule
//     {
//         return (new Schedule())->add(
//             RecurringMessage::every('1 minute', new CleanupTempPdf())
//         );
//     }
// }
