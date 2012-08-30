<?php
App::uses('AppController', 'Controller');
/**
 * Photos Controller
 *
 * @property Photo $Photo
 */
class PhotosController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Photo->recursive = 0;
		$this->set('photos', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->Photo->id = $id;
		if (!$this->Photo->exists()) {
			throw new NotFoundException(__('Invalid photo'));
		}
		$this->set('photo', $this->Photo->read(null, $id));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Photo->create();
			if ($this->Photo->save($this->request->data)) {
				$this->Session->setFlash(__('The photo has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The photo could not be saved. Please, try again.'));
			}
		}
		$categories = $this->Photo->Category->find('list');
		$cameramodelnames = $this->Photo->Cameramodelname->find('list');
		$flashes = $this->Photo->Flash->find('list');
		$lens = $this->Photo->Len->find('list');
		$exposureprograms = $this->Photo->Exposureprogram->find('list');
		$meteringmodes = $this->Photo->Meteringmode->find('list');
		$tags = $this->Photo->Tag->find('list');
		$this->set(compact('categories', 'cameramodelnames', 'flashes', 'lens', 'exposureprograms', 'meteringmodes', 'tags'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		$this->Photo->id = $id;
		if (!$this->Photo->exists()) {
			throw new NotFoundException(__('Invalid photo'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Photo->save($this->request->data)) {
				$this->Session->setFlash(__('The photo has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The photo could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->Photo->read(null, $id);
		}
		$categories = $this->Photo->Category->find('list');
		$cameramodelnames = $this->Photo->Cameramodelname->find('list');
		$flashes = $this->Photo->Flash->find('list');
		$lens = $this->Photo->Len->find('list');
		$exposureprograms = $this->Photo->Exposureprogram->find('list');
		$meteringmodes = $this->Photo->Meteringmode->find('list');
		$tags = $this->Photo->Tag->find('list');
		$this->set(compact('categories', 'cameramodelnames', 'flashes', 'lens', 'exposureprograms', 'meteringmodes', 'tags'));
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
		$this->Photo->id = $id;
		if (!$this->Photo->exists()) {
			throw new NotFoundException(__('Invalid photo'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Photo->delete()) {
			$this->Session->setFlash(__('Photo deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Photo was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
