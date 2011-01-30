<div id="calendar"></div>

<?php
	$this->Html->script(array(
		'/calendar/js/fullcalendar/fullcalendar.js',
		'/calendar/js/fullcalendar/gcal.js'),
		array('inline' => false)
	);

	$this->Html->css('/calendar/css/fullcalendar/fullcalendar.css', 'stylesheet', array('inline'=>false));	

	$events_url = $this->Html->url(array('plugin' => 'calendar', 'controller' => 'events', 'action' => 'index', 'ext' => 'json', $this->params['pass'][0]));
	
	$fullCalendar = "
	
var d = new Date();

$('#calendar').fullCalendar({
	editable: true,
	events: '$events_url',
	defaultView: 'agendaWeek',
	allDayDefault: false,
	ignoreTimezone: false,
	selectable: true,
	browserOffset: -d.getTimezoneOffset()/60,
	});

	";

	$this->Js->buffer($fullCalendar);
?>