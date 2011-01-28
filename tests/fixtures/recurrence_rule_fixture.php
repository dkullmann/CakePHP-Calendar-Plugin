<?php
/* RecurrenceRule Fixture generated on: 2011-01-27 13:58:22 : 1296154702 */
class RecurrenceRuleFixture extends CakeTestFixture {
	var $name = 'RecurrenceRule';

	var $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary', 'comment' => '	'),
		'event_id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'index'),
		'bydaydays' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 45, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'frequency' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 45, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1), 'id' => array('column' => 'event_id', 'unique' => 0)),
		'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_swedish_ci', 'engine' => 'InnoDB')
	);

	var $records = array(
		array(
			'id' => 1,
			'event_id' => 1,
			'bydaydays' => 'Lorem ipsum dolor sit amet',
			'frequency' => 'Lorem ipsum dolor sit amet'
		),
	);
}
?>