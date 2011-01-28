<?php
/* Calendar Test cases generated on: 2011-01-27 13:56:10 : 1296154570*/
App::import('Model', 'Calendar.Calendar');

class CalendarTestCase extends CakeTestCase {
	function startTest() {
		$this->Calendar =& ClassRegistry::init('Calendar');
	}

	function endTest() {
		unset($this->Calendar);
		ClassRegistry::flush();
	}

}
?>