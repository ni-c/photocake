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
//    	$this->User->create();
//		$this->User->save(array('User' => array('username' => 'admin', 'password' => 'photocake')));
		
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
