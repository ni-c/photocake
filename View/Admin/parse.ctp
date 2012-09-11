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
<div class="parse-result">
	<?php
    echo $this->Html->image('m/' . $thumb, array(
        'class' => array(
            'thumbnails',
            'border-matte'
        ),
        'width' => '132',
        'height' => '84',
        'class' => 'left'
    ));
	?>
	<div class="right image-description">
		<?php if (isset($errors)): ?>
		<strong>ERROR: Image not imported.</strong>
		<?php endif; ?>
		<table>
			<tbody>
				<?php if (isset($errors)):
					foreach ($errors as $key => $error): ?>
						<tr class="error">
							<td>
								<?php echo $key; ?>
							</td>
							<td>
								<?php echo $error[0]; ?>
							</td>
						</tr>
				<?php endforeach;
				else: ?>
				<tr>
					<td><strong>Title:</strong></td>
					<td><?php echo $photo['Photo']['title'];?></td>
				</tr>
				<tr>
					<td><strong>Description:</strong></td>
					<td><?php echo $this->Markdown->transform($photo['Photo']['description']);?></td>
				</tr>
				<tr>
					<td><strong>Category:</strong></td>
					<td><?php echo $photo['Category']['name']; ?></td>
				</tr>
				<tr>
					<td><strong>Tags:</strong></td>
					<td><?php
                    if (!empty($photo['Tag'])) {
                        foreach ($photo['Tag'] as $tag) {
                        	echo $tag['name'] . ' ';
                        }
                    }
					?></td>
				</tr>
				<?php endif; ?>
			</tbody>
		</table>
	</div>
	<div class="clear"></div>
</div>