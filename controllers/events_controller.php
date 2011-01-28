<?php
class EventsController extends CalendarAppController {

	var $name = 'Events';
	
	public $helpers = array('Calendar.TimeZone', 'Calendar.DatePicker');

	function index() {
		$this->data['Event']['start_date'] = $this->Event->deconstruct('start_date', $this->data['Event']['start_date']);
		$this->data['Event']['end_date']   = $this->Event->deconstruct('end_date', $this->data['Event']['end_date']);

		$this->paginate = array(
			'recurring',
			'start_date' => $this->data['Event']['start_date'],
			'end_date'   => $this->data['Event']['end_date'],
			'time_zone'  => $this->data['Event']['time_zone']
			);

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
			if ($this->Event->save($this->data)) {
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