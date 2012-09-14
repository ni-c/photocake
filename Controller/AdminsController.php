<?php
/**
 * photocake - A markdown photo blog based on CakePHP.
 * Copyright (C) 2012 Willi Thiel <mail@willithiel.de>
 *
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation; either version 2
 * of the License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
 *
 * @copyright     Copyright 2012, Willi Thiel <mail@willithiel.de>
 * @link          https://github.com/ni-c/photocake
 * @license       GNU General Public License, version 2 (http://www.gnu.org/licenses/gpl-2.0.html)
 */

App::uses('AppController', 'Controller');
/**
 * Admins Controller
 *
 * @property Admins $Admins
 */
class AdminsController extends AppController {

    public $name = 'Admin';

    public $uses = array(
        'Option',
        'Photo',
        'Comment'
    );

    /**
     * Deny all actions on the admins controller
     */
    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->deny();
    }

    /**
     * The admin overview
     */
    public function index() {
        $this->Photo->recursive = -1;
        $this->Comment->recursive = -1;
        $this->set('photo_count', $this->Photo->find('count', array('conditions' => array('Photo.status' => 'published'))));
        $this->set('comment_count', $this->Comment->find('count'));
        $this->set('photo_last', $this->Photo->find('first', array('order' => array('Photo.created DESC'))));
    }

    /**
     * Publish new images
     */
    public function publish() {
        $this->Directory = $this->Components->load('Directory');

        $last = $this->Photo->find('first', array('order' => array('Photo.created DESC')));
        $last_import = strtotime($last['Photo']['created']);
        $files = $this->Directory->ls($this->parse_dir, 'image/jpeg');

        foreach ($files as $key => $file) {
            if ($file['modified'] < $last_import) {
                unset($files[$key]);
            }
        }

        $this->set('files', $files);
    }

    /**
     * AJAX parse function
     *
     * @param filename The image filename to parse
     */
    public function parse() {
    		
    	if (!$this->request->is('post') || (!isset($this->request->data['filename']))) {
    		return;
		}
    	$filename = $this->request->data['filename'];
    		
        $this->layout = 'ajax';

        str_replace(array("..", " ", '"', "'", "&", "/", "\\", "?", "#"), '', $filename);

        $dest_dir = ROOT . DS . APP_DIR . DS . 'webroot' . DS . 'img' . DS . 'm' . DS;

        $thumbnail_width = 132;
        $width = 800;

        $thumb_file = str_replace('.jpg', '_thumb.jpg', $dest_dir . $filename);
        $img_file = $dest_dir . $filename;

        $this->Image = $this->Components->load('Image');

        // Generate thumbnail
        $this->Image->resize($this->parse_dir . $filename, $thumb_file, $thumbnail_width);
        $this->Image->resize($this->parse_dir . $filename, $img_file, $width);

		// about.jpg is only used for the about page and should not be parsed
		if ($filename!='about.jpg') {

	        $value = $this->Image->parse($this->parse_dir . $filename);
	
	        if ($this->getOption('publish_immediately') == '1') {
	            $value['Photo']['status'] = 'Published';
	        }
	
	        // Save Photo
	        if ($this->Photo->saveAll($value)) {
	
	            // Save Tags
	            $tagdata = array();
	            foreach ($value['Tag'] as $key => $tag) {
	                $tagdata[] = array(
	                    'Tag' => $tag,
	                    'Photo' => array('id' => $this->Photo->id)
	                );
	            }
	            $this->Photo->Tag->saveAll($tagdata);
	
	            // Check for validation errors
	            if (count($this->Photo->Tag->validationErrors) > 0) {
	                $tag_errors = $this->Photo->Tag->validationErrors;
	            }
	
	        }
	        // Check for validation errors
	        if (count($this->Photo->validationErrors) > 0) {
	            $this->set('errors', $this->Photo->validationErrors);
	        }
		
			$photo = $this->Photo->findById($this->Photo->id);
			
		} else {
			$photo['Photo']['title'] = 'none';
			$photo['Photo']['description'] = '[This image is only used for the about page.]';
			$photo['Photo']['tags'] = array();
			$photo['Category'] = array('name' => '');
		}
		
        $this->set('thumb', str_replace('.jpg', '_thumb.jpg', $filename));
        $this->set('photo', $photo);
    }

    /**
     * Manipulate the options table
     */
    public function options() {
        if ($this->request->is('post')) {
            foreach ($this->request->data['Admin'] as $key => $value) {
                $option = $this->Option->findByKey($key);
                if ($option) {
                    $this->Option->save(array('Option' => array(
                            'id' => $option['Option']['id'],
                            'key' => $key,
                            'value' => $value
                        )));
                } else {
                    $this->Option->save(array('Option' => array(
                            'key' => $key,
                            'value' => $value
                        )));
                }
            }
        }
        $this->set('options', $this->getOptions());
    }

	public function clearcache() {
		$this->autoRender = false;
		Cache::clear();
		clearCache('*');
		$this->redirect('/');
	}
}
