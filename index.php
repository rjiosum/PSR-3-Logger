<?php declare(strict_types=1);

require_once __DIR__.'/bootstrap/boot.php';

use App\Logger\Logger;
use App\Utility\Config;
use Psr\Log\LogLevel;

try {
    $path = Config::get('app.log.path');
    $env = Config::get('app.env');
} catch (Exception $e) {
    die($e->getMessage());
}

$logger = new Logger($path, $env);

$logger->emergency('This is a test for LogLevel::EMERGENCY');
$logger->alert('This is a test for LogLevel::ALERT');
$logger->critical('This is a test for LogLevel::CRITICAL');
$logger->error('This is a test for LogLevel::ERROR');
$logger->warning('This is a test for LogLevel::WARNING');
$logger->notice('This is a test for LogLevel::NOTICE');
$logger->info('This is a test for LogLevel::INFO');
$logger->debug('This is a test for LogLevel::DEBUG');
$logger->log(LogLevel::ALERT, 'This is a test for Log with an arbitrary level');
