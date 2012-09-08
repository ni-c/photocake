<?php
/**
 * Component to parse JPG-Files for EXIF data.
 */

App::uses('Component', 'Controller');

App::import('Vendor', 'pel/src/PelJpeg');

class ExifComponent extends Component {

    /**
     * Loads the EXIF data from the given file and returns it
     *
     * @param $filename Filename of the file to load the exif data from
     * @return The EXIF data as array
     */
    public function load($filename) {

        if (!file_exists($filename)) {
            throw new Exception('File "' . $filename . '" not found!');
        }

        $jpeg = new PelJpeg($filename);

        $exif = array(
            PelIfd::IFD0 => $jpeg->getExif()->getTiff()->getIfd(),
            PelIfd::IFD1 => $jpeg->getExif()->getTiff()->getIfd()->getNextIfd(),
            PelIfd::EXIF => $jpeg->getExif()->getTiff()->getIfd()->getSubIfd(PelIfd::EXIF),
            PelIfd::GPS => $jpeg->getExif()->getTiff()->getIfd()->getSubIfd(PelIfd::GPS),
        );

		echo '<br />Filename:' . $filename . ' ';

        $result = array(
            'id' => $this->getDescriptionPart($exif, 'id'),
            'Model' => str_replace('\0', '', $this->getValue($exif[PelIfd::IFD0]->getEntry(PelTag::MODEL))),
            'Flash' => $this->getValue($exif[PelIfd::EXIF]->getEntry(PelTag::FLASH)),
            'LensID' => $this->parseXmpData($filename, 'aux:LensID')!='' ? $this->parseXmpData($filename, 'aux:LensID') : '0',
            'Lens' => $this->parseXmpData($filename, 'aux:Lens'),
            'ExposureProgram' => $this->getValue($exif[PelIfd::EXIF]->getEntry(PelTag::EXPOSURE_PROGRAM)),
            'MeteringMode' => $this->getValue($exif[PelIfd::EXIF]->getEntry(PelTag::METERING_MODE)),
            'Title' => $this->getDescriptionPart($exif, 'Title'),
            'Description' => $this->getDescriptionPart($exif, 'Description'),
            'Category' => $this->getDescriptionPart($exif, 'Category'),
            'Tags' => explode(',', $this->getDescriptionPart($exif, 'Tags')),
            'DateCreated' => date('Y-m-d H:i:s', $this->getValue($exif[PelIfd::EXIF]->getEntry(PelTag::DATE_TIME_ORIGINAL))!="" ? $this->getValue($exif[PelIfd::EXIF]->getEntry(PelTag::DATE_TIME_ORIGINAL)) : $this->getValue($exif[PelIfd::EXIF]->getEntry(PelTag::DATE_TIME_DIGITIZED))),
            'FocalLength' => $this->getFocalLength($exif),
            'FNumber' => $this->getFNumber($exif),
            'ExposureTime' => $this->getExposureTime($exif),
            'ISO' => $this->getValue($exif[PelIfd::EXIF]->getEntry(PelTag::ISO_SPEED_RATINGS)),
            'GpsLatitudeRef' => isset($exif[PelIfd::GPS]) ? $this->getValue($exif[PelIfd::GPS]->getEntry(PelTag::GPS_LATITUDE_REF)) : '',
            'GpsLatitude' => isset($exif[PelIfd::GPS]) ? $this->gpsExtract($exif[PelIfd::GPS]->getEntry(PelTag::GPS_LATITUDE)->getValue()) : '',
            'GpsLongitudeRef' => isset($exif[PelIfd::GPS]) ? $this->getValue($exif[PelIfd::GPS]->getEntry(PelTag::GPS_LONGITUDE_REF)) : '',
            'GpsLongitude' => isset($exif[PelIfd::GPS]) ? $this->gpsExtract($exif[PelIfd::GPS]->getEntry(PelTag::GPS_LONGITUDE)->getValue()) : '',
        );

        return $result;
    }

    /**
     * Updates the description of an image with the given data
     *
     * @param $id The internal id of the image
     * @param $title The title of the image
     * @param $description The description of the image
     * @param $category The category of the image
     * @param $tags An array of tags of the image
	 */
    public function updateDescription($filename, $id, $title, $description, $category, $tags) {

        $data = new PelDataWindow(file_get_contents($filename));

        if (PelJpeg::isValid($data)) {
            $jpeg = $file = new PelJpeg();
            $jpeg->load($data);
            $exif = $jpeg->getExif();
            if ($exif == null) {
                $exif = new PelExif();
                $jpeg->setExif($exif);
                $tiff = new PelTiff();
                $exif->setTiff($tiff);
            } else {
                $tiff = $exif->getTiff();
            }
        } elseif (PelTiff::isValid($data)) {
            $tiff = $file = new PelTiff();
            $tiff->load($data);
        } else {
            return 0;
        }

        $ifd0 = $tiff->getIfd();

        if ($ifd0 == null) {
            $ifd0 = new PelIfd(PelIfd::IFD0);
            $tiff->setIfd($ifd0);
        }

        $desc = $ifd0->getEntry(PelTag::IMAGE_DESCRIPTION);

        $description = json_encode(array(
            'id' => $id,
            'Title' => $title,
            'Description' => $description,
            'Category' => $category,
            'Tags' => implode(',', $tags)
        ));

        if ($desc == null) {
            $desc = new PelEntryAscii(PelTag::IMAGE_DESCRIPTION, $description);
            $ifd0->addEntry($desc);
        } else {
            $desc->setValue($description);
        }
        $file->saveFile($filename);
    }

    /**
     * Extracts the JSON value with the given key from the JSON in the ImageDescription EXIF data and returns it
     *
     * @param $exif The image exif data to parse
     * @param $key The key of the JSON element
     * @return The value of the JSON element
     */
    private function getDescriptionPart($exif, $key) {
        if ($exif[PelIfd::IFD0]->getEntry(PelTag::IMAGE_DESCRIPTION) == null) {
            return '';
        }
        $json = json_decode($exif[PelIfd::IFD0]->getEntry(PelTag::IMAGE_DESCRIPTION)->getValue(), true);
        if (isset($json[$key])) {
            return $json[$key];
        }
        return '';
    }

    /**
     * Extracts the focal length from the exif data and returns it
     *
     * @param $exif The image exif data to parse
     * @return The focal length
     */
    private function getFocalLength($exif) {
        if ($exif[PelIfd::EXIF]->getEntry(PelTag::FOCAL_LENGTH) == null) {
            return '';
        }
        $focal_length = $exif[PelIfd::EXIF]->getEntry(PelTag::FOCAL_LENGTH)->getValue();
        return $focal_length[0];
    }

    /**
     * Extracts the FNumber from the exif data and returns it
     *
     * @param $exif The image exif data to parse
     * @return The FNumber
     */
    private function getFNumber($exif) {
        if ($exif[PelIfd::EXIF]->getEntry(PelTag::FNUMBER) == null) {
            return '';
        }
        $fnumber = $exif[PelIfd::EXIF]->getEntry(PelTag::FNUMBER)->getValue();
        return 'f/' . $fnumber[0] / $fnumber[1];
    }

    /**
     * Extracts the ExposureTime from the exif data and returns it
     *
     * @param $exif The image exif data to parse
     * @return The ExposureTime
     */
    private function getExposureTime($exif) {
        if ($exif[PelIfd::EXIF]->getEntry(PelTag::EXPOSURE_TIME) == null) {
            return '';
        }
        $exposure_time = $exif[PelIfd::EXIF]->getEntry(PelTag::EXPOSURE_TIME)->getValue();
        // 1/x sec.
        if ($exposure_time[0] == 1) {
            return '1/' . $exposure_time[1] . 's';
        }
        return $exposure_time[0];
    }

    /**
     * Convert deg,min,sec to decimal
     *
     * @param $deg Deg value
     * @param $min Min value
     * @param $sec Sec value
     * @return The dec value
     */
    private function dmsToDec($deg, $min, $sec) {
        return $deg + ((($min * 60) + ($sec)) / 3600);
    }

    /**
     * Extracts deg,min,sec from the given GPS data and returns it as decimal value
     *
     * @param $gpsdata The Latitude or Longitude to parse
     * @return The decimal value of the Latitude or Longitude
     */
    private function gpsExtract($gpsdata) {
        return $this->dmsToDec($gpsdata[0][0], $gpsdata[1][0], $gpsdata[2][0] / $gpsdata[2][1]);
    }

    /**
     * Returns the value of the given EXIF entry or an empty string if the entry is null
     *
     * @param $entry The EXIF entry to get the value from
     * @return The value of the entry or an empty string if the entry is null
     */
    private function getValue($entry) {
        if ($entry == null) {
            return '';
        }
        return $entry->getValue();
    }

    /**
     * Extracts the Adobe XMP data from a jpg file
     *
     * @param $filename The name of the JPG file
     * @return The XMP data
     */
    private function loadXmpData($filename) {
        $string = file_get_contents($filename);
        $start = strpos($string, "<x:xmpmeta");
        $length = strpos($string, "</x:xmpmeta>") - $start + 12;
        $result = substr($string, $start, $length);
        return $result;
    }

    /**
     * Parses the XMP data for the given tag and returns it
     *
     * @param $filename The name of the image to parse
     * @param $tag The XMP tag to parse for
     * @return The content of the XMP tag
     */
    private function parseXmpData($filename, $tag) {
        unset($result);
        preg_match('/<' . $tag . '>.+<\/' . $tag . '>/', $this->loadXmpData($filename), $result);
		if (isset($result[0])) {
	        return str_replace('<' . $tag . '>', '', str_replace('</' . $tag . '>', '', $result[0]));
		}
		return '';
    }

}
