<?php
App::uses('AppController', 'Controller');
/**
 * Exposureprograms Controller
 *
 * @property Exposureprogram $Exposureprogram
 */
class ExposureprogramsController extends AppController {

    /**
     * index method
     *
     * @return void
     */
    public function index() {
        $this->Exposureprogram->recursive = 0;
        $this->set('exposureprograms', $this->paginate());
    }

    /**
     * view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function view($id = null) {
        $this->Exposureprogram->id = $id;
        if (!$this->Exposureprogram->exists()) {
            throw new NotFoundException(__('Invalid exposureprogram'));
        }
        $this->set('exposureprogram', $this->Exposureprogram->read(null, $id));
    }

    /**
     * add method
     *
     * @return void
     */
    public function add() {
        if ($this->request->is('post')) {
            $this->Exposureprogram->create();
            if ($this->Exposureprogram->save($this->request->data)) {
                $this->Session->setFlash(__('The exposureprogram has been saved'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The exposureprogram could not be saved. Please, try again.'));
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
        $this->Exposureprogram->id = $id;
        if (!$this->Exposureprogram->exists()) {
            throw new NotFoundException(__('Invalid exposureprogram'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->Exposureprogram->save($this->request->data)) {
                $this->Session->setFlash(__('The exposureprogram has been saved'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The exposureprogram could not be saved. Please, try again.'));
            }
        } else {
            $this->request->data = $this->Exposureprogram->read(null, $id);
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
        $this->Exposureprogram->id = $id;
        if (!$this->Exposureprogram->exists()) {
            throw new NotFoundException(__('Invalid exposureprogram'));
        }
        $this->request->onlyAllow('post', 'delete');
        if ($this->Exposureprogram->delete()) {
            $this->Session->setFlash(__('Exposureprogram deleted'));
            $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash(__('Exposureprogram was not deleted'));
        $this->redirect(array('action' => 'index'));
    }

}
