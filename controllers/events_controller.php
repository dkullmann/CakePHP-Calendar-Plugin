<?php
class EventsController extends CalendarAppController {

/**
 * Name
 *
 * @var string
 */
	var $name = 'Events';

/**
 * Helpers
 *
 * @var array
 */
	public $helpers = array('Time', 'Calendar.TimeZone', 'Calendar.DatePicker', 'Calendar.Calendar');

/**
 * Components
 *
 * @var array
 */
	public $components = array('RequestHandler');

	function index() {
	
		if(isset($this->data)) {			
			$this->data['Event']['start_date'] = $this->Event->deconstruct('start_date', $this->data['Event']['start_date']);
			$this->data['Event']['end_date']   = $this->Event->deconstruct('end_date', $this->data['Event']['end_date']);	
		}
		
		if(!isset($this->data['Event']['time_zone'])) {
			$time_zone = 'UTC';
		} else {
			$time_zone = $this->data['Event']['time_zone'];
		}
		
		if($this->RequestHandler->isAjax()) {
			$this->data['Event']['start_date'] = $this->Event->unixToDate($this->params['url']['start']);	
			$this->data['Event']['end_date']   = $this->Event->unixToDate($this->params['url']['end']);
			$this->set('browser_offset', $this->params['url']['browserOffset']);
		}
		
		if(isset($this->data)) {
			$this->paginate = array(
				'recurring',
				'start_date' => $this->data['Event']['start_date'],
				'end_date'   => $this->data['Event']['end_date'],
				'time_zone'  => $time_zone,
				'calendar_id'=> $this->params['pass'],
				);
		}
		$this->set('events', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid event', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('event', $this->Event->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Event->create();
			if ($this->Event->saveAll($this->data)) {
				$this->Session->setFlash(__('The event has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The event could not be saved. Please, try again.', true));
			}
		}
		$calendars = $this->Event->Calendar->find('list');
		$this->set(compact('calendars'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid event', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Event->save($this->data)) {
				$this->Session->setFlash(__('The event has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The event could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Event->read(null, $id);
		}
		$calendars = $this->Event->Calendar->find('list');
		$this->set(compact('calendars'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for event', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Event->delete($id)) {
			$this->Session->setFlash(__('Event deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Event was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
?>