<div id="calendar"></div>

<?php $this->Html->script(array(
		'/calendar/js/fullcalendar/fullcalendar.js',
		'/calendar/js/fullcalendar/fullcalendar.min.js',
		'/calendar/js/fullcalendar/gcal.js'),
		array('inline' => false)
	);
?>

<?php
	$app_base = '/sites/caldev';
	$fullCalendar = "

$('#calendar').fullCalendar({
	editable: true,
	events: '$app_base/calendar/events/index.json'
	});

	";

?>

<?php $this->Js->buffer($fullCalendar); ?>