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

echo $this->element('adminmenu');
echo $this->Html->script('admin', false);
?>
<input type="hidden" id="parse_url" value="<?php echo $this->Html->url(array(
        'controller' => 'admin',
        'action' => 'parse'
    ), true);
 ?>/"/>
<div id="admin-container">
	<h4>Publish</h4>
	<?php if (count($files)>0):
	?>

	<h5>New Files</h5>
	<table id="publish-table">
		<tbody>
			<?php foreach ($files as $key => $file):
			?>
			<tr id="file-<?php echo $key;?>">
				<td id="loading-<?php echo $key;?>" class="loading hidden"></td>
				<td>
				<input type="hidden" id="filename-<?php echo $key;?>" class="filename" value="<?php echo $file['filename'] . '.' . $file['extension'];?>" />
				<?php echo $file['filename'];?></td>
				<td id="modified-<?php echo $key;?>"><?php echo $this->Time->format(__('Y-m-d H:i:s'), $file['modified']);?></td>
			</tr>
			<tr id="infocontainer-<?php echo $key;?>" class="hidden">
				<td colspan="3" id ="info-<?php echo $key;?>"></td>
			</tr>
			<?php endforeach;?>
		</tbody>
	</table>
	<?php else:?>

	<p>
		No new images found, everything up to date.
	</p>
	<?php endif;?>
</div>