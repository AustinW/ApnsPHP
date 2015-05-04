<?php
/**
 * @file
 * ApnsPHP_Log_Laravel3 class definition.
 *
 * @author (C) 2015 Austin White (austingym@gmail.com)
 * @version $Id$
 */

/**
 * Laravel 3's Logger
 *
 * This simple logger implements the Log Interface.
 *
 * This sends the message to laravel's logger.
 *
 * @ingroup ApnsPHP_Log
 */

use \Laravel\Log;

class ApnsPHP_Log_Laravel3 implements ApnsPHP_Log_Interface
{
    const
        STATUS  = 0,
        INFO    = 1,
        WARNING = 2,
        ERROR   = 3;

    protected $logLevelDescriptions = array(
        self::STATUS  => 'STATUS',
        self::INFO    => 'INFO',
        self::WARNING => 'WARNING',
        self::ERROR   => 'ERROR',
    );

    protected $logLevel = 0;

	/**
	 * Logs a message.
	 *
	 * @param  $sMessage @type string The message.
	 * @param  $nLevel   @type int    The log level.
	 */
	public function log($sMessage, $nLevel)
	{
       if ($nLevel < $this->logLevel) return;

       Log::write(strtolower($this->logLevelDescriptions[$nLevel]), sprintf("ApnsPHP[%d]: %s", getmypid(), $sMessage));
	}

	/**
	 * Set the minimum log level of messages that should be logged.
	 */
	public function getLogLevel()
	{
	    return $this->logLevel;
	}

	/**
	 * Sets the minimum log level of messages that should be logged.
	 *
	 * @param  $nLevel @type int The log level.
	 */
	public function setLogLevel($nLevel)
	{
	    if (!isset($this->logLevelDescriptions[$nLevel])) {
            throw new ApnsPHP_Exception('Unknown Log Level: ' . $nLevel);
	    }

	    $this->logLevel = $nLevel;
	}

	/**
	 * Logs a status message.
	 *
	 * @param  $sMessage @type string The message.
	 */
	public function status($sMessage)
	{
	    $this->log($sMessage, self::STATUS);
	}

	/**
	 * Logs an info message.
	 *
	 * @param  $sMessage @type string The message.
	 */
	public function info($sMessage)
	{
	    $this->log($sMessage, self::INFO);
	}

	/**
	 * Logs a warning message.
	 *
	 * @param  $sMessage @type string The message.
	 */
	public function warning($sMessage)
	{
	    $this->log($sMessage, self::WARNING);
	}

	/**
	 * Logs an error message.
	 *
	 * @param  $sMessage @type string The message.
	 */
	public function error($sMessage)
	{
	    $this->log($sMessage, self::ERROR);
	}
}
