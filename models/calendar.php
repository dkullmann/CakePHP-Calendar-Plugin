<?php
class Calendar extends CalendarAppModel {

/**
 * Name
 *
 * @var string
 */
 	var $name = 'Calendar';

/**
 * displayField
 *
 * @var string
 */
	var $displayField = 'title';

/**
 * hasMany associations
 *
 * @var array
 */
	var $hasMany = array(
		'Event' => array(
			'className' => 'Event',
			'foreignKey' => 'calendar_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);

}
?>