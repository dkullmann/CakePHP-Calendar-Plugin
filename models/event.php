<?php
class Event extends CalendarAppModel {

/**
 * Name
 *
 * @var string
 */
	var $name = 'Event';

/**
 * Additional Find types to be used with find($type);
 *
 * @var array
 */
	public $_findMethods = array('recurring' => true);

/**
 * recurrenceStart and recurrenceEnd - the start and end
 * dates to use in calculating recurring events
 *
 * @var string
 * @see Event::beforeFind() and Event::afterFind()
 */
	public $_recurrenceStart = null;
	public $_recurrenceEnd = null;

/**
 * Validation rules
 *
 * @var array
 */
	var $validate = array(
		'calendar_id' => array(
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
	
/**
 * belongsTo associations
 *
 * @var array
 */
	var $belongsTo = array(
		'Calendar' => array(
			'className' => 'Calendar',
			'foreignKey' => 'calendar_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
	
/**
 * hasMany associations
 *
 * @var array
 */
	var $hasMany = array(
		'RecurrenceRule' => array(
			'className' => 'Calendar.RecurrenceRule',
			'foreignKey' => 'event_id',
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
	
/**
 * Common format for dates
 *
 * @var string
 */
	public $date_format = 'Y-m-d H:i:s';
	
/**
 * DateTimeZone object in UTC 
 *
 * @var array
 * @see Event::__construct()
 */
	public $utc_tz;
	
	public function __construct($id = false, $table = null, $ds = null) {
		parent::__construct($id, $table, $ds);
		$this->utc_tz = new DateTimeZone('UTC');
		$this->_findMethods['recurring'] = true;
	}

/**
 * Converts a string or DateTime object from a UTC to a local time zone. Returns a string or
 * DateTime object depending on what was passed in.
 *
 * @param string or DateTime $date A date string or DateTime object in UTC time.
 * @param string or DateTimeZone $time_zone A string or DateTimeZone object to change to.
 * @param string $return_format A DateTime format to use to return a string date
 * @return string or DateTime object A string representing the time in the local time zone, or a DateTime object
 * @access public
 */	
	public function utcToTimezone($date, $time_zone, $return_format = 'Y-m-d H:i:s') {
			
		if(!is_a($time_zone, 'DateTimeZone')) {
			$time_zone = new DateTimeZone($time_zone);
		}
	
		if(!is_a($date, 'DateTime')) {
			$date = new DateTime($date, $this->utc_tz);
			$date->setTimezone($time_zone);
			return $date->format($return_format);
		}
		
		return $date->setTimezone($time_zone);
	}

/**
 * Converts a string or DateTime object from a local time zone to UTC. Returns a string or
 * DateTime object depending on what was passed in.
 *
 * @param string or DateTime $date A date string or DateTime object in a local time zone.
 * @param string or DateTimeZone $time_zone A string or DateTimeZone object to change to.
 * @param string $return_format A DateTime format to use to return a string date
 * @return string or DateTime object A string representing the time in UTC or a DateTime object
 * @access public
 */	
	public function timezoneToUtc($date, $time_zone, $return_format = 'Y-m-d H:i:s') {
			
		if(!is_a($time_zone, 'DateTimeZone')) {
			$time_zone = new DateTimeZone($time_zone);
		}
	
		if(!is_a($date, 'DateTime')) {
			$date = new DateTime($date, $time_zone);
			$date->setTimezone($this->utc_tz);
			return $date->format($return_format);
		}
		
		return $date->setTimezone($time_zone);
	}

/**
 * Converts a unix timestamp into a SQL date..
 *
 * @param string Unix timestamp.
 * @return string Time formatted as $this->date_format
 * @access public
 */		
	public function unixToDate($unixtime = null) {
		$date = new DateTime('@'.$unixtime);
		return $date->format($this->date_format);
	}
	
/**
 * Renders a recurring event for the given date. Does not check to make sure the
 * event occurs on this date (use RecurrenceRule::ruleIsTrue for that).
 *
 * @param array $event Contains data formatted the same as a retrieved Event from a find.
 * @param DateTime $date A DateTime object in UTC time. This is the date to render the event for.
 * @return array The instance rendered for this recurring event
 * @access public
 */
	public function renderEventForDate($event, $date) {
	
		$rendered_event = $event;
		
		$user_tz = new DateTimeZone($event[$this->alias]['time_zone']);
		
		$start_date = new DateTime($event[$this->alias]['start_date'], $this->utc_tz);
		$end_date   = new DateTime($event[$this->alias]['end_date'], $this->utc_tz);
		
		$interval = $start_date->diff($end_date);
						
		$start_date->setTimezone($user_tz);
		
		$floating_start_hour = $start_date->format('H');
		
		$date->setTimezone($user_tz);
		$date->setTime($floating_start_hour, $date->format('i'), $date->format('s'));
		$date->setTimezone($this->utc_tz);
		$event[$this->alias]['start_date'] = $date->format($this->date_format);
		
		$date->add($interval);
		$event[$this->alias]['end_date']   = $date->format($this->date_format);
		
		return $event;
		
	}

/**
 * Called before each save operation, after validation. Return a non-true result
 * to halt the save. Converts times to UTC before saving them in the database.
 *
 * @return boolean True if the operation should continue, false if it should abort
 * @access public
 * @link http://book.cakephp.org/view/1048/Callback-Methods#beforeSave-1052
 */
	public function beforeSave($options = array()) {

		extract($this->data[$this->alias]);
				
		$user_tz = new DateTimeZone($time_zone);

		$this->data[$this->alias]['start_date'] = $this->timezoneToUtc($start_date, $user_tz);
		$this->data[$this->alias]['end_date']   = $this->timezoneToUtc($end_date, $user_tz);
				
		return true;

	}
	
/**
 * Handles the before/after filter logic for find('recurring') operations.  Only called by Model::find().
 *
 * @param string $state Either "before" or "after"
 * @param array $query
 * @param array $data
 * @return array The records found exptrapolated to include recurrence
 * @access protected
 * @see Model::find()
 */
	protected function _findRecurring($state, $query, $results = array()) {

		/* $events = array(); */
	
		if ($state == 'before' ) {
			$start_date = $query['start_date'];
			$end_date   = $query['end_date'];
		
			$query['page'] = 1;
			$query['conditions'] = array(
					"AND" => array(
						"OR" => array (
							"AND" => array (
								"Event.end_date >" => $start_date,
								"Event.start_date <" => $end_date,
							),
							"Event.recurring" => true,
						),
					)
				);
				
			if (!empty($query['calendar_id'])) {
				$query['conditions']['AND'][] = array( "Event.calendar_id" => $query['calendar_id'] );
			}

			return $query;

		} elseif ($state == 'after') {

			/* Moved to afterFind()	so it would affect all queries */
			/*		
			foreach ($results as $event) {
				if (count($event['RecurrenceRule']) >= 1) {
				
					$one_day = new DateInterval('P1D');
					$end_day = new DateTime($query['end_date'], $this->utc_tz);
					
					for ($date = new DateTime($query['start_date'], $this->utc_tz); $date <= $end_day; $date->add($one_day)) {

						foreach ($event['RecurrenceRule'] as $rule) {
							if ($this->RecurrenceRule->ruleIsTrue($rule, $date)) {
								$events[] = $this->renderEventForDate($event, $date);
							}
						}
					}
					
				} else {
					$events[] = $event;
				}
			}
			*/
		}

		/* return $events; */
		return $results;
	}

/**
 * beforeFind() saves the start and end time given to the find operation
 * so that recurring events can be calculated in afterFind
 *
 * @param mixed $query Query data based in from find method
 * @return mixed $query Query data
 * @access public
 */
 
 	/* TODO: We should make a $query parameter 'recurring' to use here */
	public function beforeFind($query) {

		if(!empty($query['start_date']) && !empty($query['end_date'])) {
			$this->_recurrenceStart = $query['start_date'];
			$this->_recurrenceEnd = $query['end_date'];
		}
		
		return parent::beforeFind($query);
	}

/**
 * afterFind() creates recurring events from results set
 *
 * @param array $results The results from the find operation
 * @param bool $primary true if this is the primary model for the find operation
 * @return array Modified results set
 * @access public
 */
 
 	/* TODO: There may be more logic required if we are not the primary model. */
	public function afterFind($results, $primary) {
		debug($results);
			foreach ($results as $event) {
				if (isset($event['RecurrenceRule']) && count($event['RecurrenceRule']) >= 1) {
				
					$one_day = new DateInterval('P1D');
					$end_day = new DateTime($this->_recurrenceEnd, $this->utc_tz);
					
					for ($date = new DateTime($this->_recurrenceStart, $this->utc_tz); $date <= $end_day; $date->add($one_day)) {

						foreach ($event['RecurrenceRule'] as $rule) {
							if ($this->RecurrenceRule->ruleIsTrue($rule, $date)) {
								$events[] = $this->renderEventForDate($event, $date);
							}
						}
					}
					
				} else {
					$events[] = $event;
				}
			}
			
		debug($events);			
		return parent::afterFind($events, $primary);
	}

}
?>