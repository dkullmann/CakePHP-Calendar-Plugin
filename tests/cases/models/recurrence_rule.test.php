<?php
/* RecurrenceRule Test cases generated on: 2011-01-27 13:58:22 : 1296154702*/
App::import('Model', 'Calendar.RecurrenceRule');

class RecurrenceRuleTestCase extends CakeTestCase {
	function startTest() {
		$this->RecurrenceRule =& ClassRegistry::init('RecurrenceRule');
	}

	function endTest() {
		unset($this->RecurrenceRule);
		ClassRegistry::flush();
	}

}
?>