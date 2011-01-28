<?php
/* Event Test cases generated on: 2011-01-27 13:58:08 : 1296154688*/
App::import('Model', 'Calendar.Event');

class EventTestCase extends CakeTestCase {
	function startTest() {
		$this->Event =& ClassRegistry::init('Event');
	}

	function endTest() {
		unset($this->Event);
		ClassRegistry::flush();
	}

}
?>