<?php
App::uses('AppController', 'Controller');
/**
 * User Controller
 *
 * @property User $User
 */
class UsersController extends AppController {

	/**
	 * Before filter
	 */
    public function beforeFilter() {
    	parent::beforeFilter();
        $this->Auth->allow('login', 'logout');
    }

	/**
	 * User login
	 */
    public function login() {
        if ($this->request->is('post')) {
            if ($this->Auth->login()) {
                $this->redirect($this->Auth->redirect());
            } else {
                $this->Session->setFlash(__('Invalid username or password, try again'));
            }
        }
    }

	/**
	 * User logout
	 */
    public function logout() {
        $this->redirect($this->Auth->logout());
    }

}
