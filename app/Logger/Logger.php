<?php declare(strict_types=1);

namespace App\Logger;


use App\Utility\Config;
use DateTimeImmutable;
use DateTimeZone;
use Exception;
use Psr\Log\InvalidArgumentException;
use Psr\Log\LoggerInterface;
use Psr\Log\LogLevel;
use ReflectionClass;

class Logger implements LoggerInterface
{
    private $logPath;
    private $env;

    public function __construct(string $logPath, string $env)
    {
        $this->logPath = $logPath;
        $this->env = $env;
    }

    /**
     * System is unusable.
     *
     * @param string $message
     * @param array $context
     *
     * @return void
     */
    public function emergency($message, array $context = array())
    {
        $this->addRecord(LogLevel::EMERGENCY, $message, $context);
    }

    /**
     * Action must be taken immediately.
     *
     * Example: Entire website down, database unavailable, etc. This should
     * trigger the SMS alerts and wake you up.
     *
     * @param string $message
     * @param array $context
     *
     * @return void
     */
    public function alert($message, array $context = array())
    {
        $this->addRecord(LogLevel::ALERT, $message, $context);
    }

    /**
     * Critical conditions.
     *
     * Example: Application component unavailable, unexpected exception.
     *
     * @param string $message
     * @param array $context
     *
     * @return void
     */
    public function critical($message, array $context = array())
    {
        $this->addRecord(LogLevel::CRITICAL, $message, $context);
    }

    /**
     * Runtime errors that do not require immediate action but should typically
     * be logged and monitored.
     *
     * @param string $message
     * @param array $context
     *
     * @return void
     */
    public function error($message, array $context = array())
    {
        $this->addRecord(LogLevel::ERROR, $message, $context);
    }

    /**
     * Exceptional occurrences that are not errors.
     *
     * Example: Use of deprecated APIs, poor use of an API, undesirable things
     * that are not necessarily wrong.
     *
     * @param string $message
     * @param array $context
     *
     * @return void
     */
    public function warning($message, array $context = array())
    {
        $this->addRecord(LogLevel::WARNING, $message, $context);
    }

    /**
     * Normal but significant events.
     *
     * @param string $message
     * @param array $context
     *
     * @return void
     */
    public function notice($message, array $context = array())
    {
        $this->addRecord(LogLevel::NOTICE, $message, $context);
    }

    /**
     * Interesting events.
     *
     * Example: User logs in, SQL logs.
     *
     * @param string $message
     * @param array $context
     *
     * @return void
     */
    public function info($message, array $context = array())
    {
        $this->addRecord(LogLevel::INFO, $message, $context);
    }

    /**
     * Detailed debug information.
     *
     * @param string $message
     * @param array $context
     *
     * @return void
     */
    public function debug($message, array $context = array())
    {
        $this->addRecord(LogLevel::DEBUG, $message, $context);
    }

    /**
     * Logs with an arbitrary level.
     *
     * @param mixed $level
     * @param string $message
     * @param array $context
     *
     * @return void
     *
     * @throws \Psr\Log\InvalidArgumentException
     *
     */
    public function log($level, $message, array $context = array())
    {
        $log = new ReflectionClass(LogLevel::class);
        $logLevelsConstants = $log->getConstants();
        if(!in_array($level, $logLevelsConstants)){
            throw new InvalidArgumentException();
        }
        $this->addRecord($level, $message, $context);
    }

    /**
     * @param string $level
     * @param string $message
     * @param array $context
     */
    private function addRecord(string $level, string $message, array $context = [])
    {
        $date = (new DateTimeImmutable('now', new DateTimeZone('Europe/London')))->format('Y-m-d H:i:s');
        $content = sprintf("%s - Level: %s - Message: %s - Context: %s", $date, $level, $message, json_encode($context)).PHP_EOL;
        $file = sprintf("%s".DIRECTORY_SEPARATOR."%s-%s.log", $this->logPath, $this->env, date("d-m-Y"));
        file_put_contents($file, $content, FILE_APPEND);
    }
}