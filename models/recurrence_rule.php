<?php
class RecurrenceRule extends CalendarAppModel {
	var $name = 'RecurrenceRule';
	var $validate = array(
		'event_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $belongsTo = array(
		'Event' => array(
			'className' => 'Event',
			'foreignKey' => 'event_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
	
	public function ruleIsTrue($rule, $date) {

		extract($rule);

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