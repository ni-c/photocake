<?php
App::uses('AppController', 'Controller');
/**
 * Photos Controller
 *
 * @property Photo $Photo
 */
class PhotosController extends AppController {

    public $paginate = array(
        'limit' => 40,
        'conditions' => array('Photo.status' => 'Published')
    );

    /**
     * Refreshes the photo tables with the files in the image folder
     *
     * @return void
     */
    public function refresh() {

        // Truncate database
        $this->Photo->query('TRUNCATE `photos`;');
        $this->Photo->query('TRUNCATE `cameramodelnames`;');
        $this->Photo->query('TRUNCATE `categories`;');
        $this->Photo->query('TRUNCATE `photos_tags`;');
        $this->Photo->query('TRUNCATE `tags`;');

        $this->ImageParser = $this->Components->load('ImageParser');

        $photo_dir = $this->getOption('photo_dir');

        // absolute or relative path
        if ($photo_dir[0] != DS) {
            $photo_dir = ROOT . DS . APP_DIR . DS . $photo_dir;
        }
        $dest_dir = ROOT . DS . APP_DIR . DS . 'webroot' . DS . 'img' . DS . 'm' . DS;

        $data = $this->ImageParser->parse($photo_dir, $dest_dir, 800, 132);

        foreach ($data as $key => $value) {

            if ($this->getOption('publish_immediately') == '1') {
                $data['Photo']['status'] = 'Published';
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
                if (count($this->Photo->validationErrors) > 0) {
                    debug($this->Photo->validationErrors);
                }
            }
        }
    }

    /**
     * browse method
     *
     * @return void
     */
    public function browse($page = 1) {

        $this->Photo->recursive = 0;
        $this->paginate['page'] = $page;
        $this->set('photos', $this->paginate());
		$photocount = $this->Photo->find('count', array('conditions' => array('Photo.status' => 'Published')));
        $this->set('photocount', $photocount);
        $this->set('pages', ceil($photocount/$this->paginate['limit']));
        $this->set('current', __('all'));
		$this->set('cururl', '/browse/');
		$this->set('title_for_layout', __('Archive'));
        $this->setBrowseVars();
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
        $this->set('pages', ceil($photocount/$this->paginate['limit']));
        $this->set('current', $C['Category']['name']);
        $this->setBrowseVars();
		$this->set('cururl', '/browse/category/' . $category . '/');
		$this->set('title_for_layout', __('Archive') . ': ' . $C['Category']['name']);
        $this->render('browse');
    }

    /**
     * browse by archivedate
     */
    public function archivedate($date, $page = 1) {
        $date = preg_replace('/[^0-9\-]/', '', $date);
        $date_start = $date . "-01 00:00:00";
        $date_end = $date . "-31 23:59:59";

        $this->Photo->recursive = 0;
        $this->paginate['page'] = $page;
        $this->set('photos', $this->paginate(array(
            'Photo.datecreated >=' => $date_start,
            'Photo.datecreated <=' => $date_end,
        )));
		$photocount = $this->Photo->find('count', array('conditions' => array(
                'Photo.status' => 'Published',
                'Photo.datecreated >=' => $date_start,
                'Photo.datecreated <=' => $date_end,
            )));
        $this->set('photocount', $photocount);
        $this->set('pages', ceil($photocount/$this->paginate['limit']));
        $this->set('current', 'archivedate');
        $this->set('archivedate', $date);
        $this->setBrowseVars();
		$this->set('cururl', '/browse/archivedate/' . $date . '/');
		$this->set('title_for_layout', __('Archive') . ': ' . __(date('F', strtotime($date_start))) . date(', Y', strtotime($date_start)));
        $this->render('browse');
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
        $this->set('pages', ceil($photocount/$this->paginate['limit']));
        $this->set('current', $T['Tag']['name']);
        $this->setBrowseVars();
		$this->set('cururl', '/browse/tag/' . $tag . '/');
		$this->set('title_for_layout', __('Archive') . ': ' . $T['Tag']['name']);
        $this->render('browse');
    }

    /**
     * Set the browse variables
     */
    private function setBrowseVars() {
        // photo count
        $this->set('count', $this->Photo->find('count', array('conditions' => array('Photo.status' => 'Published'))));
		
		// page
		$this->set('curpage', $this->paginate['page']);

        // by Category
        $this->Photo->Category->recursive = 1;
        $this->set('categories', $this->Photo->Category->find('all'));

        // by Month
        $all_month = $this->Photo->query('SELECT DISTINCT DATE_FORMAT(`datecreated`, "%Y-%m") as `month` FROM `photos` ORDER BY `datecreated` DESC;');
        $month_archive = array();
        foreach ($all_month as $key => $month) {
            $count = $this->Photo->query('SELECT count(*) AS `count` FROM `photos` WHERE DATE_FORMAT(`datecreated`, "%Y-%m")="' . $month[0]['month'] . '";');
            $month_archive[] = array(
                'month' => $month[0]['month'],
                'count' => $count[0][0]['count']
            );
        }
        $this->set('month', $month_archive);

        // by Tag
        $this->set('tags', $this->Photo->Tag->find('all'));
    }

    /**
     * view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function view($id = null) {

        // Get first photo if no id is given
        if (($id == null) || ($id == 'last')) {
            $photo = $this->Photo->find('first');
            $id = $photo['Photo']['id'];
        } else {
            // Load the photo with the given id
            $this->Photo->id = $id;
            if (!$this->Photo->exists()) {
                throw new NotFoundException(__('Invalid photo'));
            }
            $photo = $this->Photo->read(null, $id);
        }

        // Get prev and next photo
        $neighbors = $this->Photo->find('neighbors', array(
            'field' => 'datecreated',
            'value' => $photo['Photo']['datecreated'],
        ));

		$this->set('title_for_layout', $photo['Photo']['title']);
        $this->set('photo', $photo);
        $this->set('next_photo', $neighbors['prev']);
        $this->set('prev_photo', $neighbors['next']);
    }
}
