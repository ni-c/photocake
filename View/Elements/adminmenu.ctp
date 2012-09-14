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
<ul id="admin-menu">
	<li>
<?php
echo $this->Html->link(__('Status'), array(
    'controller' => 'admins',
    'action' => 'index',
    'full_base' => true
), array('title' => __('Status')));
?>
	</li>
	<li>
		&#183;
	</li>
	<li>
<?php
echo $this->Html->link(__('Publish'), array(
    'controller' => 'admins',
    'action' => 'publish',
    'full_base' => true
), array('title' => __('Publish')));
?>
	</li>
	<li>
		&#183;
	</li>
	<li>
<?php
echo $this->Html->link(__('Settings'), array(
    'controller' => 'admins',
    'action' => 'options',
    'full_base' => true
), array('title' => __('Settings')));
?>
	</li>
	<li>
		&#183;
	</li>
	<li>
<?php
echo $this->Html->link(__('Clear Cache'), array(
    'controller' => 'admins',
    'action' => 'clearCache',
    'full_base' => true
), array('title' => __('Clear Cache')));
?>
	</li>
</ul>
<div class="clear"></div>
