<?php
App::uses('AppController', 'Controller');
/**
 * Robots Controller
 *
 * @property Robots $Robots
 */
class RobotsController extends AppController {

    public $name = 'Robot';

    public $components = array('RequestHandler');

    public $helpers = array(
        'Html',
        'Text'
    );

    public function index() {
        $lines = array(
            'User-agent: *',
            'Disallow: /' . Configure::read('Config.default_language') . '/',
            'Sitemap: [URL]sitemap.xml'
        );
        $this->set('lines', $lines);
    }

}
