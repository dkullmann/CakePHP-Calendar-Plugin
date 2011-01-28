<?php
/* Event Fixture generated on: 2011-01-27 13:58:08 : 1296154688 */
class EventFixture extends CakeTestFixture {
	var $name = 'Event';

	var $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'calendar_id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'index'),
		'description' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 45, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'start_date' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'end_date' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'summary' => array('type' => 'string', 'null' => true, 'default' => NULL, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1), 'fk_events_calendars' => array('column' => 'calendar_id', 'unique' => 0)),
		'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_swedish_ci', 'engine' => 'InnoDB')
	);

	var $records = array(
		array(
			'id' => 1,
			'calendar_id' => 1,
			'description' => 'Lorem ipsum dolor sit amet',
			'start_date' => '2011-01-27 13:58:08',
			'end_date' => '2011-01-27 13:58:08',
			'summary' => 'Lorem ipsum dolor sit amet'
		),
	);
}
?>