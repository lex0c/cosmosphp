<?php
namespace Cosmos\Logger;

use \Monolog\Logger;
use \Monolog\Formatter\LineFormatter;
use \Monolog\Handler\SyslogHandler;
use \Monolog\Handler\StreamHandler;
use \Monolog\Handler\ErrorLogHandler;
use \Psr\Log\LoggerInterface;

/**
 * Logger Writer
 * @link https://github.com/lleocastro/cosmosphp/
 * @license https://github.com/lleocastro/cosmosphp/blob/master/LICENSE
 * @author Léo Castro <leonardo_carvalho@outlook.com>
 * @package \Cosmos\Logger
 */
class LogWriter implements LoggerInterface
{
    /**
     * Monolog instance.
     *
     * @var \Monolog\Logger
     */
    protected $monoLog = null;

    /**
     * Log levels.
     *
     * @var array
     */
    protected $levels = [
        'info'       => Logger::INFO,
        'notice'     => Logger::NOTICE,
        'alert'      => Logger::ALERT,
        'emergency'  => Logger::EMERGENCY,
        'warning'    => Logger::WARNING,
        'error'      => Logger::ERROR,
        'critical'   => Logger::CRITICAL,
        'debug'      => Logger::DEBUG
    ];

    /**
     * Create a new log writer instance.
     *
     * @param Logger $monoLog
     */
    public function __construct(Logger $monoLog)
    {
        $this->monoLog = $monoLog;
    }

    /**
     * Interesting events.
     * Info message to the logs.
     *
     * @param string $message
     * @param array $context
     *
     * @return void
     */
    public function info(string $message, array $context = []):void
    {}

    /**
     * Normal but significant events.
     * Notice message to the logs.
     *
     * @param string $message
     * @param array $context
     *
     * @return void
     */
    public function notice(string $message, array $context = []):void
    {}

    /**
     * Action must be taken immediately.
     * Alert message to the logs.
     *
     * @param string $message
     * @param array $context
     *
     * @return void
     */
    public function alert(string $message, array $context = []):void
    {}

    /**
     * System is unusable.
     * Emergency message to the logs.
     *
     * @param string $message
     * @param array $context
     *
     * @return void
     */
    public function emergency(string $message, array $context = []):void
    {}

    /**
     * Exceptional occurrences that are not errors.
     * Warning message to the logs.
     *
     * @param string $message
     * @param array $context
     *
     * @return void
     */
    public function warning(string $message, array $context = []):void
    {}

    /**
     * Runtime errors that do not require immediate action.
     * Error message to the logs.
     *
     * @param string $message
     * @param array $context
     *
     * @return void
     */
    public function error(string $message, array $context = []):void
    {}

    /**
     * Critical conditions.
     * Critical message to the logs.
     *
     * @param string $message
     * @param array $context
     *
     * @return void
     */
    public function critical(string $message, array $context = []):void
    {}

    /**
     * Detailed debug information.
     * Debug message to the logs.
     *
     * @param string $message
     * @param array $context
     *
     * @return void
     */
    public function debug(string $message, array $context = []):void
    {}

    /**
     * Logs with an arbitrary level.
     * Log message to the logs.
     *
     * @param string $level
     * @param string $message
     * @param array $context
     *
     * @return void
     */
    public function log(string $level, string $message, array $context = []):void
    {}

    /**
     * Get MonoLog instance.
     *
     * @return Logger
     */
    public function getMonoLog():Logger
    {
        return $this->monoLog;
    }

    /**
     * Get level into a MonoLog constant.
     *
     * @param string $level
     *
     * @return int
     *
     * @throws \InvalidArgumentException
     */
    public function getLevel(string $level):int
    {
        if (array_key_exists($level, $this->levels)) {
            return $this->levels[$level];
        }

        throw new \InvalidArgumentException("Key '{$level}' not found in 'levels'.");
    }

}
