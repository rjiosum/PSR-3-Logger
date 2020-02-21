<?php declare(strict_types=1);

namespace Tests\Unit\Logger;

use App\Logger\Logger;
use App\Utility\Config;
use Tests\TestCase;
use Psr\Log\InvalidArgumentException;
use Psr\Log\LoggerInterface;
use Psr\Log\LogLevel;

/** @property Logger $logger */
class LoggerTest extends TestCase
{
    private $logger;

    protected function setUp(): void
    {
        parent::setUp();
        $this->logger = new Logger();
        putenv('APP_ENV=testing');
    }

    /** @test */
    public function implements_psr_logger_interface()
    {
        $this->assertInstanceOf(LoggerInterface::class, $this->logger);
    }

    /** @test */
    public function will_throw_invalid_argument_exception_for_invalid_log_level()
    {
        $this->expectException(InvalidArgumentException::class);
        $this->logger->log('invalid', 'This is test log');
    }

    /** @test */
    public function can_create_logs()
    {
        $this->logger->emergency('This is a test for LogLevel::EMERGENCY');
        $this->logger->alert('This is a test for LogLevel::ALERT');
        $this->logger->critical('This is a test for LogLevel::CRITICAL');
        $this->logger->error('This is a test for LogLevel::ERROR');
        $this->logger->warning('This is a test for LogLevel::WARNING');
        $this->logger->notice('This is a test for LogLevel::NOTICE');
        $this->logger->info('This is a test for LogLevel::INFO');
        $this->logger->debug('This is a test for LogLevel::DEBUG');
        $this->logger->log(LogLevel::ALERT, 'This is a test for Log with an arbitrary level');

        $path = Config::get('app.log.path');
        $env = Config::get('app.env');

        $file = sprintf("%s".DIRECTORY_SEPARATOR."%s-%s.log", $path, $env, date("d-m-Y"));
        self::assertFileExists($file);

        $content = file_get_contents($file);
        self::assertStringContainsString('This is a test for LogLevel::EMERGENCY', $content);
        self::assertStringContainsString('This is a test for Log with an arbitrary level', $content);

        unlink($file);
        self::assertFileNotExists($file);
    }

    public function tearDown(): void
    {
        parent::tearDown();
        unset($this->logger);
    }
}