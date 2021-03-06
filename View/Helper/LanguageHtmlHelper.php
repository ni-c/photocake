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

App::uses('HtmlHelper', 'View/Helper');

/**
 * Extension of Html->url() that supports multilangueage
 */
class LanguageHtmlHelper extends HtmlHelper {

    public function url($url = null, $full = false) {
        if (is_array($url)) {
            if (!isset($url['language']) && isset($this->params['language'])) {
                $url['language'] = $this->params['language'];
            }
			if ((isset($url['language'])) && ($url['language'] == Configure::read('Config.default_language'))) {
				$url['language'] = null;
			}
        } else {
            if ((strlen($url) < 3) || (substr($url, 1, 2) != $this->params['language'])) {
                $url = '/' . $this->params['language'] . $url;
            }
			if (substr($url, 1, 2) == Configure::read('Config.default_language')) {
				$url = substr($url, 3);
			}
        }
        return parent::url($url, $full);
    }

}
