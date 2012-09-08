<?php
App::uses('AppController', 'Controller');
/**
 * Feed Controller
 *
 * @property Feed $Feed
 */
class FeedController extends AppController {

    public $name = 'Feed';

    public $uses = array('Photo', );

    public $components = array('RequestHandler');

    public $helpers = array('Text');

    public function index() {
        $photos = $this->Photo->find('all', array(
            'limit' => 20,
            'order' => 'Photo.datecreated DESC',
            'Photo.status' => 'Published'
        ));
        $this->set(compact('photos'));
    }

}
