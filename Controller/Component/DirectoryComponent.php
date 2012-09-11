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
 * Component to parse directories.
 */
class DirectoryComponent extends Component {

    /**
     * Creates a sorted filelist from the given directory, just containing the given mimetype or all files
	 * The filelist is sorted descended by modified date
	 * 
	 * @param directory The directory to scan
	 * @param mimetype The mime type to filter for
	 * @return An array containing the file data
     */
    public function ls($directory, $mimetype = null) {
        $files = $this->dir_to_array($directory, false, false, true);
        $result = array();
        foreach ($files as $key => $file) {
            $info = array(
                'file' => $file,
                'filename' => pathinfo($file, PATHINFO_FILENAME),
                'extension' => pathinfo($file, PATHINFO_EXTENSION),
                'mimetype' => $this->mimetype($file),
                'modified' => filemtime($file),
            );
            if ((!isset($mimetype)) || ($info['mimetype'] == $mimetype)) {
                $result[] = $info;
            }
        }
        $tmp = Array();
        foreach ($result as &$ma)
            $tmp[] = &$ma["modified"];
        array_multisort($tmp, SORT_DESC, SORT_NUMERIC, $result);
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
     * @return The files in the directory as array
     */
    private function dir_to_array($directory, $recursive = false, $listDirs = true, $listFiles = false, $exclude = '') {
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
     * Get the mimetype of the given file
     *
     * @param filename The filename to get the mimetype for
     * @return The mimetype of the file with the given filename
     */
    private function mimetype($filename) {
        $finfo = new finfo(FILEINFO_MIME);
        $type = $finfo->file($filename);
        return substr($type, 0, strpos($type, ';'));
    }

}
