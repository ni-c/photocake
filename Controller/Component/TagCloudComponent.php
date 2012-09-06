<?php
/**
 * Components/TagCloudComponent.php
 *
 * A CakePHP Component that can generate a tag cloud from your models.
 *
 * Copyright 2009, Will Demaine - http://www.charityware.org
 * Licensed under The MIT License - Modification, Redistribution allowed but must retain the above copyright notice
 * This file is distributed as Charityware. All donations recieved from this software will be donated to charity
 * For more information, please see http://www.charityware.org
 *
 * @link        http://www.opensource.org/licenses/mit-license.php
 *
 * @package     Tqag Cloud Componenet
 * @created     August 1st 2009
 * @version     1.0
 */

class TagCloudComponent extends Component {
    /**
     * The name of the Tag model.
     * @var String
     */
    private $tagName = 'Tag';

    /**
     * The name of the join table in the HABTM relationship with the Tag model
     * @var String
     */
    private $listName = 'PhotosTag';

    /**
     * The field in your model that the string representation of the tag is stored.
     * @var String
     */
    private $tagDescription = 'name';

    /**
     * True if the tag cloud should be randomised
     * @var bool
     */
    private $random = true;

    /**
     * A list of font sizes to be used with the tag cloud.
     * @var Array
     */
    private $sizes = array(
        12,
        14,
        16,
        18,
        20,
        22,
        24,
        26,
        28,
        30,
        32
    );

    /**
     * The cakephp tag model derrived from the name.
     * @var Model
     */
    private $tagModel;

    /**
     * The cakephp join table model derived from the name
     * @var Model
     */
    private $listModel;

    /**
     * Integer to store the highest occurence of any given tag
     * @var int
     */
    private $max = 0;

    /**
     * The array representation of the tag cloud
     * @var Array
     */
    private $cloud = array();

    /**
     * Should the results be cached?
     * @var bool
     */
    private $cache = true;

    /**
     * How long should the cache last
     * @var String
     */
    private $cacheTime = '+1 day';

    /**
     * Get the models from Cake by their name
     */
    public function __construct() {
        $this->tagModel = ClassRegistry::init($this->tagName);
        $this->listModel = ClassRegistry::init($this->listName);

        if (Cache::config('tagcloud') === false) {
            Cache::config('tagcloud', array(
                'engine' => 'File',
                'serialize' => true,
                'prefix' => ''
            ));
        }
    }

    /*
     * Getters and Setters
     */

    /**
     * Sets the name of the Tag Model
     * @param String $name
     */
    public function setTagName($name) {
        if (is_string($name)) {
            $this->tagName = $name;
        }
    }

    /**
     * Sets the name of the join table or 'list' model
     * @param String $name
     */
    public function setListName($name) {
        if (is_string($name)) {
            $this->listName = $name;
        }
    }

    /**
     * Set the font sizes the tag cloud should use
     * @param Array $sizes
     */
    public function setFontSizes($sizes) {
        if (is_array($sizes)) {
            $this->sizes = $sizes;
        }
    }

    /**
     * Set whether the tag cloud should be in a random order or not
     * @param bool $rand
     */
    public function setRandomize($rand) {
        if (is_bool($rand)) {
            $this->random = $rand;
        }
    }

    /**
     * Set whether the cache should be used
     * @param bool $bool
     */
    public function setCaching($bool) {
        if (is_bool($bool)) {
            $this->cache = $bool;
        }
    }

    /**
     * Set the cache time. Given as a string
     * @param String $time
     */
    public function setCacheTime($time) {
        if (is_string($time)) {
            $this->cacheTime = $time;
        }
    }

    /**
     * Generates the cloud from the information given and returns it in array form
     * @return Array The cloud
     */
    public function generateCloud() {
        if ($this->cache) {
            Cache::set(array('duration' => $this->cacheTime));
            $this->cloud = Cache::read('tag_cloud', 'tagcloud');
            if ($this->cloud != false) {
                return $this->cloud;
            }
        }

        $tags = $this->_getTags();
        foreach ($tags as $tag) {
            $count = $this->_findTagCount($tag[$this->tagName]['id']);
            $this->cloud[$tag[$this->tagName][$this->tagDescription]] = array(
                'id' => $tag[$this->tagName]['id'],
                'slug' => $tag[$this->tagName]['slug'],
                'count' => $count,
                'size' => $this->_getTagSize($count)
            );
        }
        if ($this->random) {
            $this->_writeCache();
            return $this->cloud = $this->_shuffleCloud($this->cloud);
        } else {
            $this->_writeCache();
            return $this->cloud;
        }

    }

    /**
     * Write the cloud to the cache if it's turned on
     */
    private function _writeCache() {
        if ($this->cache) {
            Cache::write('tag_cloud', $this->cloud, 'tagcloud');
        }
    }

    /**
     * Get an array of all of the tag names from our model
     * @return Array
     */
    private function _getTags() {
        return $this->tagModel->find('all');
    }

    /**
     * Find the number of times each tag is used by it's id
     * Update the max value if a new high point is reached
     * @param int $id
     * @return int
     */
    private function _findTagCount($id) {
        $count = $this->listModel->find('count', array('conditions' => array(strtolower($this->tagName) . '_id' => $id)));
        if ($count > $this->max) {
            $this->max = $count;
        }
        return $count;
    }

    /**
     * Calculate the font size from the number of times the tag is found
     * with respect to the highest occurance of any tag
     * @param int $count
     * @return int
     */
    private function _getTagSize($count) {
        $p = round(($count / $this->max) * 10);
        return $this->sizes[$p];
    }

    /**
     * Shuffle the array, but preserve the keys
     * @param Array $array
     * @return Array
     */
    private function _shuffleCloud($array) {
        $temp = array();
        while (count($array)) {
            $element = array_rand($array);
            $temp[$element] = $array[$element];
            unset($array[$element]);
        }
        return $temp;
    }

}
?> 