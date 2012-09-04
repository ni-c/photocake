<?php
App::uses('AppController', 'Controller');
/**
 * Lenses Controller
 *
 * @property Lense $Lense
 */
class LensesController extends AppController {

    /**
     * index method
     *
     * @return void
     */
    public function index() {
        $this->Lense->recursive = 0;
        $this->set('lenses', $this->paginate());
    }

    /**
     * view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function view($id = null) {
        $this->Lense->id = $id;
        if (!$this->Lense->exists()) {
            throw new NotFoundException(__('Invalid lense'));
        }
        $this->set('lense', $this->Lense->read(null, $id));
    }

    /**
     * add method
     *
     * @return void
     */
    public function add() {
        if ($this->request->is('post')) {
            $this->Lense->create();
            if ($this->Lense->save($this->request->data)) {
                $this->Session->setFlash(__('The lense has been saved'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The lense could not be saved. Please, try again.'));
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
        $this->Lense->id = $id;
        if (!$this->Lense->exists()) {
            throw new NotFoundException(__('Invalid lense'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->Lense->save($this->request->data)) {
                $this->Session->setFlash(__('The lense has been saved'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The lense could not be saved. Please, try again.'));
            }
        } else {
            $this->request->data = $this->Lense->read(null, $id);
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
        $this->Lense->id = $id;
        if (!$this->Lense->exists()) {
            throw new NotFoundException(__('Invalid lense'));
        }
        $this->request->onlyAllow('post', 'delete');
        if ($this->Lense->delete()) {
            $this->Session->setFlash(__('Lense deleted'));
            $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash(__('Lense was not deleted'));
        $this->redirect(array('action' => 'index'));
    }

}
