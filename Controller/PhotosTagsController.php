<?php
App::uses('AppController', 'Controller');
/**
 * PhotosTags Controller
 *
 * @property PhotosTag $PhotosTag
 */
class PhotosTagsController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->PhotosTag->recursive = 0;
		$this->set('photosTags', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->PhotosTag->id = $id;
		if (!$this->PhotosTag->exists()) {
			throw new NotFoundException(__('Invalid photos tag'));
		}
		$this->set('photosTag', $this->PhotosTag->read(null, $id));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->PhotosTag->create();
			if ($this->PhotosTag->save($this->request->data)) {
				$this->Session->setFlash(__('The photos tag has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The photos tag could not be saved. Please, try again.'));
			}
		}
		$photos = $this->PhotosTag->Photo->find('list');
		$tags = $this->PhotosTag->Tag->find('list');
		$this->set(compact('photos', 'tags'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		$this->PhotosTag->id = $id;
		if (!$this->PhotosTag->exists()) {
			throw new NotFoundException(__('Invalid photos tag'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->PhotosTag->save($this->request->data)) {
				$this->Session->setFlash(__('The photos tag has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The photos tag could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->PhotosTag->read(null, $id);
		}
		$photos = $this->PhotosTag->Photo->find('list');
		$tags = $this->PhotosTag->Tag->find('list');
		$this->set(compact('photos', 'tags'));
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
		$this->PhotosTag->id = $id;
		if (!$this->PhotosTag->exists()) {
			throw new NotFoundException(__('Invalid photos tag'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->PhotosTag->delete()) {
			$this->Session->setFlash(__('Photos tag deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Photos tag was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
