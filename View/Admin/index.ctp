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
<?php echo $this->element('adminmenu');?>

<div id="admin-container">
	<h4>Status</h4>
	<table>
		<tbody>
			<tr>
				<td> Published Photos: </td>
				<td><?php echo $photo_count;?></td>
			</tr>
			<tr>
				<td> Comments: </td>
				<td><?php echo $comment_count;?></td>
			</tr>
			<tr>
				<td> Last scan: </td>
				<td><?php echo $photo_last['Photo']['created'];?></td>
			</tr>
		</tbody>
	</table>
	<h4>Change Password</h4>
	<?php
    echo $this->Form->create('User', array('action' => 'changepassword'));
    echo $this->Form->input('password', array(
        'label' => __('New Password'),
        'type' => 'password',
        'size' => '40',
        'maxLength' => '32',
        'required' => true,
    ));
    echo $this->Form->input('passwordrepeat', array(
        'label' => __('Repeat Password'),
        'type' => 'password',
        'size' => '40',
        'maxLength' => '32',
        'required' => true,
    ));
    echo $this->Form->end(__('submit'));
	?>
</div>