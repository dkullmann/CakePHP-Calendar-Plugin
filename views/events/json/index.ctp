<?php

$json_events = array();

foreach($events as $event) {

	/* Could set defaults here */
	$json_event = array();
	
	/* Event properties from http://arshaw.com/fullcalendar/docs/event_data/Event_Object/ */
	$json_event['id']		= $event['Event']['id'];
	$json_event['title']	= $event['Event']['description'];
	$json_event['start']	= $event['Event']['start_date'];
	$json_event['end']		= $event['Event']['end_date'];
	$json_event['url']      = $this->Html->url(array('plugin' => 'calendar', 'controller' => 'events', 'action' => 'view', $event['Event']['id']));

	/* Not used yet */
	#$event['allDay']	= false;
	#$json_event['url']
	#$json_event['className']
	#$json_event['editable']

	$json_events[] = $json_event;
}

echo $this->Js->object($json_events); ?>