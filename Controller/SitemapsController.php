<?php
App::uses('AppController', 'Controller');
/**
 * Sitemaps Controller
 *
 * @property Sitemap $Sitemap
 */
class SitemapsController extends AppController {

    var $name = 'Sitemaps';
   
    var $uses = array(
        'Photo',
    );
	
    var $helpers = array('Time');
	
    var $components = array('RequestHandler');

    function xml() {
        $this->set('photos', $this->Photo->find('all', array(
            'conditions' => array(
                'status' => 'Published',
            ),
			'order' => 'Photo.datecreated DESC',
        )));
		$this->layout = 'xml/default';
        //debug logs will destroy xml format, make sure were not in drbug mode
        //Configure::write('debug', 0);
    }

}
