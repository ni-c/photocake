<?php
App::uses('AppController', 'Controller');
/**
 * Photos Controller
 *
 * @property Photo $Photo
 */
class PhotosController extends AppController {

    /**
     * Refreshes the photo tables with the files in the image folder
     *
     * @return void
     */
    public function refresh() {
        $this->Photo->query('TRUNCATE `photos`;');
        $this->Photo->query('TRUNCATE `cameramodelnames`;');
        $this->Photo->query('TRUNCATE `categories`;');
        $this->Photo->query('TRUNCATE `tags`;');

        $this->ImageParser = $this->Components->load('ImageParser');

        $photo_dir = $this->getOption('photo_dir');

        // absolute or relative path
        if ($photo_dir[0] != DIRECTORY_SEPARATOR) {
            $photo_dir = ROOT . DIRECTORY_SEPARATOR . APP_DIR . DIRECTORY_SEPARATOR . $photo_dir;
        }
        $dest_dir = ROOT . DIRECTORY_SEPARATOR . APP_DIR . DIRECTORY_SEPARATOR . 'webroot' . DIRECTORY_SEPARATOR . 'img' . DIRECTORY_SEPARATOR . 'm' . DIRECTORY_SEPARATOR;

        $data = $this->ImageParser->parse($photo_dir, $dest_dir, 800);

		$this->Photo->Cameramodelname->recursive = -1;
       	$this->Photo->Category->recursive = -1;

        foreach ($data as $key => $value) {
        	$cameramodelname = $this->Photo->Cameramodelname->findByName($value['Cameramodelname']['name']);
			if ($cameramodelname!==false) {
				$value['Cameramodelname']['id'] = $cameramodelname['Cameramodelname']['id'];
			}
        	$category = $this->Photo->Category->findByName($value['Category']['name']);
			if ($category!==false) {
				$value['Category']['id'] = $category['Category']['id'];
			}
            $this->Photo->saveAll($value);
            if (count($this->Photo->validationErrors) > 0) {
                debug($this->Photo->validationErrors);
            }
        }
    }

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
        if (($id == null) || ($id == 'last')) {
        	$photo = $this->Photo->find('first', array('order' => array('Photo.datecreated DESC')));
            $id = $photo['Photo']['id'];
        } else {
	        $this->Photo->id = $id;
	        if (!$this->Photo->exists()) {
	            throw new NotFoundException(__('Invalid photo'));
	        }
			$photo = $this->Photo->read(null, $id);
        }
        $neighbors = $this->Photo->find('neighbors', array(
            'field' => 'id',
            'value' => $id,
            'order' => array('Photo.datecreated ASC'),
        ));
		
        $this->set('photo', $photo);
        $this->set('next_photo', $neighbors['next']);
        $this->set('prev_photo', $neighbors['prev']);
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
