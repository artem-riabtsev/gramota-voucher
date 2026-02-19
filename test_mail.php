<?php
require 'vendor/autoload.php';

use Symfony\Component\Mailer\Transport\Smtp\EsmtpTransport;
use Symfony\Component\Mailer\Mailer;
use Symfony\Component\Mime\Email;

$transport = new EsmtpTransport('mailer', 1025);
$mailer = new Mailer($transport);

$email = (new Email())
    ->from('test@example.com')
    ->to('test@example.com')
    ->subject('Test from CLI')
    ->text('This is a test message');

try {
    $mailer->send($email);
    echo "✅ Email sent successfully!\n";
} catch (Exception $e) {
    echo "❌ Error: " . $e->getMessage() . "\n";
}
