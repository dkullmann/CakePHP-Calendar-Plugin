<?php
class RecurrenceRule extends CalendarAppModel {

/**
 * Name
 *
 * @var string
 */
	var $name = 'RecurrenceRule';

/**
 * Validation rules
 *
 * @var array
 */
	var $validate = array(
		'event_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
			),
		),
	);

/**
 * belongsTo associations
 *
 * @var array
 */
	var $belongsTo = array(
		'Event' => array(
			'className' => 'Event',
			'foreignKey' => 'event_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
	
/**
 * Validates a recurrence rule for a particular date.
 *
 * @param array $rule An array describing a recurrence rule 
 * @param array $date A DateTime object to test the rule against.
 * @return bool true if the rule is valid for this date, false if it is not
 * @access public
 */
	public function ruleIsTrue($rule, $date) {

		extract($rule);

		/* TODO
		 * 
		 * Add support for other types of recurrence here. All recurrence
		 * modeling should be done after the iCal spec shown here:
		 * http://developer.apple.com/library/mac/documentation/AppleApplications/Reference/SyncServicesSchemaRef/Articles/Calendars.html#//apple_ref/doc/uid/TP40001540-174926
		 */
		if ($frequency == 'weekly') {
			$days = explode(',', $bydaydays);
			foreach ($days as $day) {
				if ($day == strtolower($date->format('l'))) {
					return true;
				}
			}
		}
		
		return false;
	}
}
?>