<?php
App::uses('AppController', 'Controller');
/**
 * Sitemaps Controller
 *
 * @property Sitemap $Sitemap
 */
class SitemapController extends AppController {

    public $name = 'Sitemap';

    public $uses = array('Photo', );

    public $helpers = array('Time');

    public $components = array('RequestHandler');

    public function index() {
        $this->set('photos', $this->Photo->find('all', array(
            'conditions' => array('status' => 'Published', ),
            'order' => 'Photo.datecreated DESC',
        )));
    }

}
