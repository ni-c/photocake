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

$this->set('channelData', array(
    'title' => $site_title,
    'link' => $this->Html->url('/', true),
    'description' => $site_subtitle,
    'language' => 'de-DE'
));

App::uses('Sanitize', 'Utility', 'Markdown');

foreach ($photos as $photo) {
    $postTime = strtotime($photo['Photo']['created']);

    $postLink = array(
        'controller' => 'photos',
        'action' => 'view',
        $photo['Photo']['slug'],
	'full_base' => true
    );

    // This is the part where we clean the body text for output as the description
    // of the rss item, this needs to have only text to make sure the feed validates
    $bodyText = $this->Html->image('m/' . $photo['Photo']['filename'], array('fullBase' => true)) . '<br />' . $this->Markdown->transform($photo['Photo']['description']);

    echo  $this->Rss->item(array(), array(
        'title' => $photo['Photo']['title'],
        'link' => $postLink,
        'guid' => array('url' => $postLink, 'isPermaLink' => 'true'),
        'description' => $bodyText,
        'pubDate' => $photo['Photo']['created']
    ));
}
