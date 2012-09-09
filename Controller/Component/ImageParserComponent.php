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

App::uses('Component', 'Controller');
/**
 * Component to parse JPG-Files for EXIF data.
 */
class ImageParserComponent extends Component {

    public $components = array('Exif');

    private $dbMapping = array(
        'id' => 'id',
        'Flash' => 'flash_id',
        'LensID' => 'lens_id',
        'ExposureProgram' => 'exposureprogram_id',
        'MeteringMode' => 'meteringmode_id',
        'Title' => 'title',
        'Description' => 'description',
        'DateCreated' => 'datecreated',
        'FocalLength' => 'focallength',
        'FNumber' => 'fnumber',
        'ExposureTime' => 'exposuretime',
        'ISO' => 'iso',
        'GpsLatitudeRef' => 'gpslatituderef',
        'GpsLatitude' => 'gpslatitude',
        'GpsLongitudeRef' => 'gpslongituderef',
        'GpsLongitude' => 'gpslongitude'
    );

    # 	Column 	Type 	Collation 	Attributes 	Null 	Default 	Extra 	Action
    #	2 	category_id 	int(11) 		UNSIGNED 	No 	None 		Change Change 	Drop Drop 	More Show more actions
    #	8 	filename 	varchar(255) 	utf8_unicode_ci 		No 	None 		Change Change 	Drop Drop 	More Show more actions
    #	20 	status 	enum('Draft', 'Published') 	utf8_unicode_ci 		No 	Draft 		Change Change 	Drop Drop 	More Show more actions

    /**
     * Parses the given directory for images, extracts exif data and resamples the image to $dest_directory with the given $max_width
     *
     * @param $directory The directory to parse
     * @param $dest_directory The destination directory
     * @param $max_width The max width of the destination images
     */
    public function parse($directory, $dest_directory, $max_width, $max_thumbnail_width) {
		if (!is_writable($dest_directory)) {
			echo 'ERROR: ' . $dest_directory . ' is not writeable!<br />';
			return array();
		}
        $result = array();
        $files = $this->dirToArray($directory, false, false, true);
        foreach ($files as $id => $filename) {
            $dest_filename = str_replace($directory, $dest_directory, $filename);
            $this->resize($filename, $dest_filename, $max_width);
            $this->resize($filename, str_replace('.jpg', '_thumb.jpg', $dest_filename), $max_thumbnail_width);
            if ((substr($filename, strlen($filename) - 4, 4) == '.jpg') || (substr($filename, strlen($filename) - 5, 5) == '.jpeg')) {
				if (substr($filename, strlen($filename) - 9, 9)!='about.jpg') {
	                $exif = $this->Exif->load($filename);
	                $data = array(
	                    'Photo' => array(),
	                    'Cameramodelname' => array()
	                );
	                $data['Cameramodelname']['name'] = $exif['Model'];
	                $data['Category']['name'] = $exif['Category'];
	                $data['Category']['slug'] = $this->strToAscii($data['Category']['name']);
	                foreach ($this->dbMapping as $key => $value) {
	                    $data['Photo'][$value] = $exif[$key];
	                }
					$data['Tag'] = array();
					foreach ($exif['Tags'] as $key => $tag) {
						$data['Tag'][] = array(
							'name' => $tag,
							'slug' => $this->strToAscii(html_entity_decode($tag, ENT_QUOTES,'UTF-8'))
						);
					}
	                $data['Photo']['filename'] = str_replace($dest_directory, '', $dest_filename);
	                $data['Photo']['slug'] = $this->strToAscii(html_entity_decode($data['Photo']['title'], ENT_QUOTES,'UTF-8'));
	                $result[] = $data;
	                unset($data);
				}
            }
        }
        return $result;
    }

    /**
     * Get an array that represents directory tree
     *
     * @param string $directory     Directory path
     * @param bool $recursive         Include sub directories
     * @param bool $listDirs         Include directories on listing
     * @param bool $listFiles         Include files on listing
     * @param regex $exclude         Exclude paths that matches this regex
     */
    private function dirToArray($directory, $recursive = false, $listDirs = true, $listFiles = false, $exclude = '') {
        $array_items = array();
        $skip_by_exclude = false;
        if ($directory[strlen($directory) - 1] == DS) {
            $directory = substr($directory, 0, strlen($directory) - 1);
        }
        $handle = opendir($directory);
        if ($handle) {
            while (false !== ($file = readdir($handle))) {
                preg_match("/(^(([\.]){1,2})$|(\.(svn|git|md))|(Thumbs\.db|\.DS_STORE))$/iu", $file, $skip);
                if ($exclude) {
                    preg_match($exclude, $file, $skip_by_exclude);
                }
                if (!$skip && !$skip_by_exclude) {
                    if (is_dir($directory . DS . $file)) {
                        if ($recursive) {
                            $array_items = array_merge($array_items, dir_to_array($directory . DS . $file, $recursive, $listDirs, $listFiles, $exclude));
                        }
                        if ($listDirs) {
                            $file = $directory . DS . $file;
                            $array_items[] = $file;
                        }
                    } else {
                        if ($listFiles) {
                            $file = $directory . DS . $file;
                            $array_items[] = $file;
                        }
                    }
                }
            }
            closedir($handle);
        }
        asort($array_items);
        return $array_items;
    }

    /**
     * Converts a string to ASCII
     *
     * @param $str The string to convert to ASCII
     * @param $replace Optional replace array
     * @param $delimiter The delimiter to use for whitespaces
     * @return The string as ASCII
     */
    private function strToAscii($str, $replace = array(), $delimiter = '-') {
        if (!empty($replace)) {
            $str = str_replace((array)$replace, ' ', $str);
        }
		
        $clean = iconv('UTF-8', 'ASCII//TRANSLIT', $str);
        $clean = preg_replace("/[^a-zA-Z0-9\/_|+ -]/", '', $clean);
        $clean = strtolower(trim($clean, '-'));
        $clean = preg_replace("/[\/_|+ -]+/", $delimiter, $clean);

        return $clean;
    }

    /**
     * Resample the image given as $src and save it to $dst
     *
     * @param $src Filename of the source image
     * @param $dst Filename of the destination image
     * @param $width The width of the new image
     */
    private static function resize($src, $dst, $max_width) {
        return exec('convert ' . $src . ' -resize ' . $max_width . 'x ' . $dst);
    }

}
