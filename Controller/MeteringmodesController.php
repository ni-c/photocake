<?php
App::uses('AppController', 'Controller');
/**
 * Meteringmodes Controller
 *
 * @property Meteringmode $Meteringmode
 */
class MeteringmodesController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Meteringmode->recursive = 0;
		$this->set('meteringmodes', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->Meteringmode->id = $id;
		if (!$this->Meteringmode->exists()) {
			throw new NotFoundException(__('Invalid meteringmode'));
		}
		$this->set('meteringmode', $this->Meteringmode->read(null, $id));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Meteringmode->create();
			if ($this->Meteringmode->save($this->request->data)) {
				$this->Session->setFlash(__('The meteringmode has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The meteringmode could not be saved. Please, try again.'));
			}
		}
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		$this->Meteringmode->id = $id;
		if (!$this->Meteringmode->exists()) {
			throw new NotFoundException(__('Invalid meteringmode'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Meteringmode->save($this->request->data)) {
				$this->Session->setFlash(__('The meteringmode has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The meteringmode could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->Meteringmode->read(null, $id);
		}
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @throws MethodNotAllowedException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Meteringmode->id = $id;
		if (!$this->Meteringmode->exists()) {
			throw new NotFoundException(__('Invalid meteringmode'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Meteringmode->delete()) {
			$this->Session->setFlash(__('Meteringmode deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Meteringmode was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
