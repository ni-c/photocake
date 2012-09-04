<?php
App::uses('AppController', 'Controller');
/**
 * Flashes Controller
 *
 * @property Flash $Flash
 */
class FlashesController extends AppController {

    /**
     * index method
     *
     * @return void
     */
    public function index() {
        $this->Flash->recursive = 0;
        $this->set('flashes', $this->paginate());
    }

    /**
     * view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function view($id = null) {
        $this->Flash->id = $id;
        if (!$this->Flash->exists()) {
            throw new NotFoundException(__('Invalid flash'));
        }
        $this->set('flash', $this->Flash->read(null, $id));
    }

    /**
     * add method
     *
     * @return void
     */
    public function add() {
        if ($this->request->is('post')) {
            $this->Flash->create();
            if ($this->Flash->save($this->request->data)) {
                $this->Session->setFlash(__('The flash has been saved'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The flash could not be saved. Please, try again.'));
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
        $this->Flash->id = $id;
        if (!$this->Flash->exists()) {
            throw new NotFoundException(__('Invalid flash'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->Flash->save($this->request->data)) {
                $this->Session->setFlash(__('The flash has been saved'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The flash could not be saved. Please, try again.'));
            }
        } else {
            $this->request->data = $this->Flash->read(null, $id);
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
        $this->Flash->id = $id;
        if (!$this->Flash->exists()) {
            throw new NotFoundException(__('Invalid flash'));
        }
        $this->request->onlyAllow('post', 'delete');
        if ($this->Flash->delete()) {
            $this->Session->setFlash(__('Flash deleted'));
            $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash(__('Flash was not deleted'));
        $this->redirect(array('action' => 'index'));
    }

}
