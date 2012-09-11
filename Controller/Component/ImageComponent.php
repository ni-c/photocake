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
class ImageComponent extends Component {

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

    /**
     * Parse the given file for exif data and wrap it into a photo dataset
     *
     * @param filename The filename to parse
     * @return The photo data
     */
    public function parse($filename) {
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
                'slug' => $this->strToAscii(html_entity_decode($tag, ENT_QUOTES, 'UTF-8'))
            );
        }

        $data['Photo']['filename'] = pathinfo($filename, PATHINFO_FILENAME) . '.' . pathinfo($filename, PATHINFO_EXTENSION);
        $data['Photo']['slug'] = $this->strToAscii(html_entity_decode($data['Photo']['title'], ENT_QUOTES, 'UTF-8'));
        return $data;
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
    public function resize($src, $dst, $max_width) {
        return exec('convert ' . $src . ' -resize ' . $max_width . 'x ' . $dst);
    }

}
