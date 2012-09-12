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
<div id="login-container" class="users form login">
	<h4>Create User</h4>
	<p>
		Please create a new user to administrate your photocake blog.
	</p>
	<?php echo $this->Form->create('User', array('action' => 'add'));?>
	<fieldset>
		<?php
        echo $this->Form->input('username', array(
            'label' => 'Desired Username (3-15 alphanumeric characters)',
            'maxLength' => 15,
            'pattern' => '^[A-Za-z0-9]{3,15}$',
            'required' => true
        ));
        echo $this->Form->input('password', array(
            'label' => 'Desired Password (min. 5 characters)',
            'maxLength' => 64,
            'pattern' => '^.{5,64}$',
            'required' => true
        ));
        echo $this->Form->input('passwordcheck', array(
            'type' => 'password',
            'maxLength' => 64,
            'pattern' => '^.{5,64}$',
            'label' => 'Repeat Password'
        ));
		?>
	</fieldset>
	<?php echo $this->Form->end(__('Create User'));?>
</div>