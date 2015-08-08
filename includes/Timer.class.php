<?php
class Timer
{
	/** @var float time precision */
	var $precision;

	/** @var string default timer name */
	var $_default_name;

	/** @var array timer values */
	var $_time;

	/**
	 * Initialize properties
	 */
	function Timer()
	{
		$this->precision     =  6;
		$this->_default_name = 'php';
		$this->_time         =  array();
	}

	/**
	 * Starts a timer
	 *
	 * @access public
	 * @param string $name timer name
	 * @param string $microtime microtime to use as start value
	 * @return void
	 */
	function start($name = '', $microtime = '')
	{
  		// check timer name
		if (empty($name)) {
			$name = $this->_default_name;
		}

		// if start microtime was not defined, get current microtime
		if (empty($microtime)) {
			$start = $last = microtime();
		} else {
			$start = $microtime;
			$last  =  microtime();
		}

		// initialize vars
		$this->_time[$name]['start'] = $start;
		$this->_time[$name]['last']  = $last;
	}

	/**
	 * Return parcial/total time
	 *
	 * @access public
	 * @param string $name timer name
	 * @return array hash with last and total time
	 */
	function getTime($name = '')
	{
		// check timer name
		if (empty($name)) {
			$name = $this->_default_name;
		}

		// check if timer was started
		if (! isset($this->_time[$name]['start']) ) {
			$this->start($name);
		}

		// get current time
		$current = microtime();

		// parse microtime string
		$now   = $this->_parseMicrotime($current);
		$start = $this->_parseMicrotime($this->_time[$name]['start']);
		$last  = $this->_parseMicrotime($this->_time[$name]['last']);

		// calculate and round times
		$time['last']  = round($now - $last,  $this->precision);
		$time['total'] = round($now - $start, $this->precision);

		// format string using $this->precision value
		$format = "%.". $this->precision ."f";
		$time['last']  = sprintf($format, $time['last']);
		$time['total'] = sprintf($format, $time['total']);

		// set last time
		$this->_time[$name]['last'] = $current;

		return $time;
	}

	/**
	 * Send to PHP error handler the values of a specified timer
	 *
	 * @param string $message message to be placed before time values
	 * @param string $name timer name
	 * @return void
	 */
	function logTime($message = '', $name = '')
	{
		trigger_error($this->_getFormatedOutput($message ,$name), E_USER_NOTICE);
	}

	/**
	 * Send time values to stdout
	 *
	 * @param string $message message to be sent to stdout with time values
	 * @param string $name timer name
	 * @return void
	 */
	 function printTime($message = '', $name = '')
	 {
		print $this->_getFormatedOutput($message, $name) ."\n";
	 }

	/**
	 * Format output message
	 *
	 * @param string $message output message 
	 * @param string $name timer name
	 * @return void
	 */
	function _getFormatedOutput($message = '', $name = '')
	{
		// check timer name
		if (empty($name)) {
			$name = $this->_default_name;
		}

		// get times
		$time = $this->getTime($name);

		// put last and total times before message
		$output = "Página Gerada em $time[total] segundos.";

		return $output;
	}

	/**
	 * Parse string returned by microtime()
	 *
	 * @access private
	 * @param string $microtime string returned by microtime()
	 * @return array hash with integer and decimal portion of microtime
	 */
	function _parseMicrotime($microtime)
	{
		// separate values
		$integer = substr($microtime, 10, strlen($microtime));
		$decimal = substr($microtime, 0, 10);

		// set correct variable types
		settype($integer, 'integer');

		if (strcmp(phpversion(), '4.2.0') >= 0) {
			settype($decimal, 'float');
		}
		else {
			settype($decimal, 'double');
		}

		// sum integer and decimal values
		$time = $integer + $decimal;

		return $time;
	}

}
?>
