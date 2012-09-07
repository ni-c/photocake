<?php
/**
 * Component to parse Comments for spam.
 */

App::uses('Component', 'Controller');

App::import('Vendor', 'defensio-php/Defensio');

class DefensioComponent extends Component {

    public function check($api_key, $comment, $name, $email, $url = '') {

        $defensio = new Defensio($api_key);
        $document = array();

        if (array_shift($defensio->getUser()) != 200) {
            // api key is invalid
            return false;
        }

        $document = array(
            'type' => 'comment',
            'content' => $comment,
            'author-name' => $name,
            'author-email' => $email,
            'platform' => 'php',
            'client' => 'Photocake',
            'async' => 'false'
        );
		if ($url != '') {
            $document['author-url'] = $url;
			
		} 

        $result = $defensio->postDocument($document);
		return ($result[1]->classification == 'legitimate');
    }

}
