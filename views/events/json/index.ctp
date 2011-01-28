<?php

$json_events = array();

foreach($events as $event) {

	/* Could set defaults here */
	$json_event = array();
	
	$utc_tz = new DateTimeZone('UTC');
	
	$offset = new DateInterval('PT'.abs($browser_offset).'H');
	
	$start = new DateTime($event['Event']['start_date'], $utc_tz);
	$end   = new DateTime($event['Event']['end_date'], $utc_tz);
	
	if(abs($browser_offset) == $browser_offset) {
		$start->add($offset);
		$end->add($offset);
	} else {
		$start->sub($offset);
		$end->sub($offset);
	}
	
	/* Event properties from http://arshaw.com/fullcalendar/docs/event_data/Event_Object/ */
	$json_event['id']		= $event['Event']['id'];
	$json_event['title']	= $event['Event']['description'];
	$json_event['start']	= $this->Time->toAtom($start->format('Y-m-d H:i:s'));
	$json_event['end']		= $this->Time->toAtom($end->format('Y-m-d H:i:s'));
	$json_event['url']      = $this->Html->url(array('plugin' => 'calendar', 'controller' => 'events', 'action' => 'view', $event['Event']['id']));

	/* Other available attributes for fullCalendar.js */
	#$event['allDay']	= false;
	#$json_event['url']
	#$json_event['className']
	#$json_event['editable']

	$json_events[] = $json_event;
}

echo $this->Js->object($json_events); ?>