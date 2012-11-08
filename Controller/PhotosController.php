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
 * Photos Controller
 *
 * @property Photo $Photo
 */
class PhotosController extends AppController {

    /**
     * Pagination settings
     */
    public $paginate = array(
        'limit' => 10,
        'conditions' => array('Photo.status' => 'Published')
    );

    /**
     * Before filter
     */
    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('archive', 'category', 'archivedate', 'tag');
    }

    /**
     * Caching enabled
     */
    public $cacheAction = array(
        'view' => array('callbacks' => true, 'duration' => '1 week'),
        'archive' => array('callbacks' => true, 'duration' => '1 week'),
        'category' => array('callbacks' => true, 'duration' => '1 week'),
        'archivedate' => array('callbacks' => true, 'duration' => '1 week'),
        'tag' => array('callbacks' => true, 'duration' => '1 week'),
    );

    /**
     * view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function view($slug = null) {

        // Get first photo if no id is given
        if (($slug == null) || ($slug == 'last')) {
            $photo = $this->Photo->find('first');
	        if ($photo == false) {
	        	$this->render('empty');
				return;
			}
            $id = $photo['Photo']['id'];
        } else {
            $photo = $this->Photo->findBySlug($slug);
        }
        if ($photo == false) {
            throw new NotFoundException(__('Invalid photo'));
        }

        // Get prev and next photo
        $this->Photo->recursive = -1;
        $neighbors = $this->Photo->find('neighbors', array(
            'field' => 'datecreated',
            'value' => $photo['Photo']['datecreated'],
        ));

        // Meta stuff
        $this->keywords = $this->keywords . ',' . $photo['Category']['name'];
        foreach ($photo['Tag'] as $tag) {
            $this->keywords = $this->keywords . ',' . $tag['name'];
        }
        $this->description = $this->description . ': ' . $photo['Photo']['description'];

		$prefetch = array();
		if (isset($neighbors['prev'])) {
			$prefetch[] = 'img/m/' . $neighbors['prev']['Photo']['filename'];
		}
		if (isset($neighbors['prev'])) {
			$prefetch[] = 'img/m/' . $neighbors['next']['Photo']['filename'];
		}

        $this->set('title_for_layout', $photo['Photo']['title']);
        $this->set('photo', $photo);
		$this->set('prefetch', $prefetch);
        $this->set('next_photo', $neighbors['prev']);
        $this->set('prev_photo', $neighbors['next']);
    }

    /**
     * browse method
     *
     * @return void
     */
    public function archive($page = 1) {

        $this->Photo->recursive = 0;
        $this->paginate['page'] = $page;
        $this->set('photos', $this->paginate());
        $photocount = $this->Photo->find('count', array('conditions' => array('Photo.status' => 'Published')));
        $this->set('photocount', $photocount);
        $this->set('pages', ceil($photocount / $this->paginate['limit']));
        $this->set('current', __('all'));
        $this->set('title_for_layout', __('Archive'));
        $this->keywords = $this->keywords . ',archiv,archive';
        $this->setArchiveVars();
    }

    /**
     * browse by category
     */
    public function category($category, $page = 1) {

        $C = $this->Photo->Category->findBySlug($category);

        if ($C == false) {
            throw new NotFoundException(__('Invalid category'));
        }

        $this->Photo->recursive = 0;
        $this->paginate['page'] = $page;
        $this->set('photos', $this->paginate(array('Photo.category_id' => $C['Category']['id'])));
        $photocount = $this->Photo->find('count', array('conditions' => array(
                'Photo.category_id' => $C['Category']['id'],
                'Photo.status' => 'Published'
            )));
        $this->set('photocount', $photocount);
        $this->set('pages', ceil($photocount / $this->paginate['limit']));
        $this->set('current', $C['Category']['name']);
        $this->setArchiveVars();
        $this->set('title_for_layout', __('Archive') . ': ' . $C['Category']['name']);
        $this->keywords = $this->keywords . ',archiv,archive,' . $C['Category']['name'];
        $this->render('archive');
    }

    /**
     * browse by archivedate
     */
    public function archivedate($date, $page = 1) {
        $date = preg_replace('/[^0-9\-]/', '', $date);
        $date_start = $date . "-01 00:00:00";
        $date_end = $date . "-31 23:59:59";

        $this->Photo->recursive = 0;

        $photocount = $this->Photo->find('count', array('conditions' => array(
                'Photo.status' => 'Published',
                'Photo.datecreated >=' => $date_start,
                'Photo.datecreated <=' => $date_end,
            )));

        $this->paginate['page'] = $page;
        $this->set('photos', $this->paginate(array(
            'Photo.datecreated >=' => $date_start,
            'Photo.datecreated <=' => $date_end,
        )));
        $this->set('photocount', $photocount);
        $this->set('pages', ceil($photocount / $this->paginate['limit']));
        $this->set('current', 'archivedate');
        $this->set('archivedate', $date);
        $this->setArchiveVars();
        $this->set('title_for_layout', __('Archive') . ': ' . __(date('F', strtotime($date_start))) . date(', Y', strtotime($date_start)));
        $this->keywords = $this->keywords . ',archiv,archive';
        $this->render('archive');
    }

    /**
     * browse by tag
     */
    public function tag($tag, $page = 1) {

        $this->Photo->Tag->recursive = 1;
        $T = $this->Photo->Tag->findBySlug($tag);

        if ($T == false) {
            throw new NotFoundException(__('Invalid tag'));
        }

        // Lets create a list of IDs for pagination
        $photoids = array();
        foreach ($T['Photo'] as $key => $value) {
            $photoids[] = $value['id'];
        }

        // Paginate
        $this->Photo->recursive = 0;
        $this->paginate['page'] = $page;
        $this->set('photos', $this->paginate(array('Photo.id' => $photoids)));
        $photocount = $this->Photo->find('count', array('conditions' => array(
                'Photo.status' => 'Published',
                'Photo.id' => $photoids,
            )));
        $this->set('photocount', $photocount);
        $this->set('pages', ceil($photocount / $this->paginate['limit']));
        $this->set('current', $T['Tag']['name']);
        $this->setArchiveVars();
        $this->set('title_for_layout', __('Archive') . ': ' . $T['Tag']['name']);
        $this->keywords = $this->keywords . ',archiv,archive,' . $T['Tag']['name'];
        $this->render('archive');
    }

    /**
     * Set the browse variables
     */
    private function setArchiveVars() {

        $archiveVars = Cache::read('archive_vars');
        if (!$archiveVars) {
            $archiveVars = array();

            // Count
            $archiveVars['count'] = $this->Photo->find('count', array('conditions' => array('Photo.status' => 'Published')));

            // Categories
            $this->Photo->Category->recursive = 1;
            $archiveVars['categories'] = $this->Photo->Category->find('all');

            // Month
            $all_month = $this->Photo->query('SELECT DISTINCT DATE_FORMAT(`datecreated`, "%Y-%m") as `month` FROM `photos` WHERE `status` = "Published" ORDER BY `datecreated` DESC;');
            $month_archive = array();
            foreach ($all_month as $key => $month) {
                $count = $this->Photo->query('SELECT count(*) AS `count` FROM `photos` WHERE DATE_FORMAT(`datecreated`, "%Y-%m")="' . $month[0]['month'] . '" AND `status` = "Published";');
                $month_archive[] = array(
                    'month' => $month[0]['month'],
                    'count' => $count[0][0]['count']
                );
            }
            $archiveVars['month'] = $month_archive;

            // Tags
            $archiveVars['tags'] = $this->Photo->Tag->find('all');

            Cache::write('archive_vars', $archiveVars);
        }

        // photo count
        $this->set('count', $archiveVars['count']);

        // page
        $this->set('curpage', $this->paginate['page']);

        // by Category
        $this->set('categories', $archiveVars['categories']);

        // by Month
        $this->set('month', $archiveVars['month']);

        // by Tag
        $this->set('tags', $archiveVars['tags']);
    }

}
