<?php
/* Events Test cases generated on: 2011-01-27 13:59:16 : 1296154756*/
App::import('Controller', 'Calendar.Events');

class TestEventsController extends EventsController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class EventsControllerTestCase extends CakeTestCase {
	function startTest() {
		$this->Events =& new TestEventsController();
		$this->Events->constructClasses();
	}

	function endTest() {
		unset($this->Events);
		ClassRegistry::flush();
	}

}
?>