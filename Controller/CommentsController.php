<?php
App::uses('AppController', 'Controller');
/**
 * Comments Controller
 *
 * @property Comment $Comment
 */
class CommentsController extends AppController {

    var $components = array('Defensio');

    /**
     * add method
     *
     * @return void
     */
    public function add() {

        if ($this->request->is('post')) {
            $this->Comment->create();
            $api_key = $this->getOption('defensio_apikey');
            if (($api_key == '') || 
            	($this->Defensio->check($api_key, $this->request->data['Comment']['comment'], $this->request->data['Comment']['name'], $this->request->data['Comment']['email'], $this->request->data['Comment']['website']))) {
                if ($this->Comment->save($this->request->data)) {
                    $this->Session->setFlash(__('The comment has been saved'));
                } else {
                    $this->Session->setFlash(__('The comment could not be saved. Please, try again.'));
                }
            }
        }
        $this->redirect($this->referer());
    }

}
