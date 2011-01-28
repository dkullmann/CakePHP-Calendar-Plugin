<?php
/* Calendars Test cases generated on: 2011-01-27 13:58:54 : 1296154734*/
App::import('Controller', 'Calendar.Calendars');

class TestCalendarsController extends CalendarsController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class CalendarsControllerTestCase extends CakeTestCase {
	function startTest() {
		$this->Calendars =& new TestCalendarsController();
		$this->Calendars->constructClasses();
	}

	function endTest() {
		unset($this->Calendars);
		ClassRegistry::flush();
	}

}
?>