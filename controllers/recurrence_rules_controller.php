<?php
class RecurrenceRulesController extends CalendarAppController {

	var $name = 'RecurrenceRules';

	function index() {
		$this->RecurrenceRule->recursive = 0;
		$this->set('recurrenceRules', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid recurrence rule', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('recurrenceRule', $this->RecurrenceRule->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->RecurrenceRule->create();
			if ($this->RecurrenceRule->save($this->data)) {
				$this->Session->setFlash(__('The recurrence rule has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The recurrence rule could not be saved. Please, try again.', true));
			}
		}
		$events = $this->RecurrenceRule->Event->find('list');
		$this->set(compact('events'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid recurrence rule', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->RecurrenceRule->save($this->data)) {
				$this->Session->setFlash(__('The recurrence rule has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The recurrence rule could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->RecurrenceRule->read(null, $id);
		}
		$events = $this->RecurrenceRule->Event->find('list');
		$this->set(compact('events'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for recurrence rule', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->RecurrenceRule->delete($id)) {
			$this->Session->setFlash(__('Recurrence rule deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Recurrence rule was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
?>