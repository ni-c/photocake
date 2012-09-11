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
?>
<?php echo $this->element('adminmenu'); ?>

<div id="admin-container">

<h4>Settings</h4>

<?php

$descriptions = array(
	'_1' => __('Website Metadata'),
	'site_title' => __('The title of the website'), 
	'site_subtitle' => __('The subtitle of the website'), 
	'keywords' => __('Keywords for the website meta keywords'), 
	'license' => __('URL to the license of the website'),
	'_2' => __('Settings'),
	'parse_dir' => __('Directory containing your images and markdown files (relative or absolute)'),
	'publish_immediately' => __('1 if parsed images should be published immediately, 0 if not'),
	'_3' => __('External Tools'),
	'ga_code' => __('Google Analytics Code (Statistics)'),
	'defensio_apikey' => __('API Key for Defensio (Comment Spam)'),
	'rss_feed' => __('URL of extern RSS feed (e.g. Feedburner)'),
);

echo $this->Form->create('Admin', array('action' => 'options'));

foreach ($descriptions as $key => $label) {
	if (strpos($key, '_') === 0) {
		echo "<h5>" . $label . "</h5>";
	} else {
		echo $this->Form->input($key, array(
		    'label' => $label,
		    'size' => '150',
		    'maxLength' => '255',
		    'required' => false,
		    'value' => isset($options[$key]) ? $options[$key] : ''
		));
	}
}
echo $this->Form->end(__('save'));

?>
</div>
