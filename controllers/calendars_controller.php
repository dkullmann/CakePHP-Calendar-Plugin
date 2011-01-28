<?php
class CalendarsController extends CalendarAppController {

	var $name = 'Calendars';

	function index() {
		$this->Calendar->recursive = 0;
		$this->set('calendars', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid calendar', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('calendar', $this->Calendar->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Calendar->create();
			if ($this->Calendar->save($this->data)) {
				$this->Session->setFlash(__('The calendar has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The calendar could not be saved. Please, try again.', true));
			}
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid calendar', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Calendar->save($this->data)) {
				$this->Session->setFlash(__('The calendar has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The calendar could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Calendar->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for calendar', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Calendar->delete($id)) {
			$this->Session->setFlash(__('Calendar deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Calendar was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
?>