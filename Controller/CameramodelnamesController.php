<?php
App::uses('AppController', 'Controller');
/**
 * Cameramodelnames Controller
 *
 * @property Cameramodelname $Cameramodelname
 */
class CameramodelnamesController extends AppController {

    /**
     * index method
     *
     * @return void
     */
    public function index() {
        $this->Cameramodelname->recursive = 0;
        $this->set('cameramodelnames', $this->paginate());
    }

    /**
     * view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function view($id = null) {
        $this->Cameramodelname->id = $id;
        if (!$this->Cameramodelname->exists()) {
            throw new NotFoundException(__('Invalid cameramodelname'));
        }
        $this->set('cameramodelname', $this->Cameramodelname->read(null, $id));
    }

    /**
     * add method
     *
     * @return void
     */
    public function add() {
        if ($this->request->is('post')) {
            $this->Cameramodelname->create();
            if ($this->Cameramodelname->save($this->request->data)) {
                $this->Session->setFlash(__('The cameramodelname has been saved'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The cameramodelname could not be saved. Please, try again.'));
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
        $this->Cameramodelname->id = $id;
        if (!$this->Cameramodelname->exists()) {
            throw new NotFoundException(__('Invalid cameramodelname'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->Cameramodelname->save($this->request->data)) {
                $this->Session->setFlash(__('The cameramodelname has been saved'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The cameramodelname could not be saved. Please, try again.'));
            }
        } else {
            $this->request->data = $this->Cameramodelname->read(null, $id);
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
        $this->Cameramodelname->id = $id;
        if (!$this->Cameramodelname->exists()) {
            throw new NotFoundException(__('Invalid cameramodelname'));
        }
        $this->request->onlyAllow('post', 'delete');
        if ($this->Cameramodelname->delete()) {
            $this->Session->setFlash(__('Cameramodelname deleted'));
            $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash(__('Cameramodelname was not deleted'));
        $this->redirect(array('action' => 'index'));
    }

}
