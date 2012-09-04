<?php
/**
 * Component to parse JPG-Files for EXIF data.
 */

App::uses('Component', 'Controller');

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
        'FocalLength' => 'focallenght',
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

    public function parse($directory) {
		$result = array();
        $files = $this->dirToArray($directory, false, false, true);
        foreach ($files as $id => $filename) {
            $exif = $this->Exif->load($filename);
            $data = array(
                'Photo' => array(),
                'Cameramodelname' => array()
            );
			$data['Cameramodelname']['name'] = $exif['Model'];
            foreach ($this->dbMapping as $key => $value) {
                $data['Photo'][$value] = $exif[$key];
            }
            $data['Photo']['filename'] = $filename;
            $data['Photo']['status'] = 'Draft';
			$result[] = $data;
			unset($data);
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
        if ($directory[strlen($directory) - 1] == DIRECTORY_SEPARATOR) {
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
                    if (is_dir($directory . DIRECTORY_SEPARATOR . $file)) {
                        if ($recursive) {
                            $array_items = array_merge($array_items, dir_to_array($directory . DIRECTORY_SEPARATOR . $file, $recursive, $listDirs, $listFiles, $exclude));
                        }
                        if ($listDirs) {
                            $file = $directory . DIRECTORY_SEPARATOR . $file;
                            $array_items[] = $file;
                        }
                    } else {
                        if ($listFiles) {
                            $file = $directory . DIRECTORY_SEPARATOR . $file;
                            $array_items[] = $file;
                        }
                    }
                }
            }
            closedir($handle);
        }
        return $array_items;
    }

}
