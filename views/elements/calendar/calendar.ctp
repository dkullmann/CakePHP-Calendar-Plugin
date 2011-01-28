<div id="calendar"></div>

<?php $this->Html->script(array(
		'/calendar/js/fullcalendar/fullcalendar.js',
		'/calendar/js/fullcalendar/fullcalendar.min.js',
		'/calendar/js/fullcalendar/gcal.js'),
		array('inline' => false)
	);
?>

<?php
	
	$events_url = $this->Html->url(array('plugin' => 'calendar', 'controller' => 'events', 'action' => 'index', 'ext' => 'json', $this->params['pass'][0]));
	
	$fullCalendar = "

$('#calendar').fullCalendar({
	editable: true,
	events: '$events_url',
	});

	";

?>

<?php $this->Js->buffer($fullCalendar); ?>