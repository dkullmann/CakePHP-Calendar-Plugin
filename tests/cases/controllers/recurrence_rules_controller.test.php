<?php
/* RecurrenceRules Test cases generated on: 2011-01-27 13:59:24 : 1296154764*/
App::import('Controller', 'Calendar.RecurrenceRules');

class TestRecurrenceRulesController extends RecurrenceRulesController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class RecurrenceRulesControllerTestCase extends CakeTestCase {
	function startTest() {
		$this->RecurrenceRules =& new TestRecurrenceRulesController();
		$this->RecurrenceRules->constructClasses();
	}

	function endTest() {
		unset($this->RecurrenceRules);
		ClassRegistry::flush();
	}

}
?>