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
<?php
	$this->set('title_for_layout', __('About'));
?>
<div id="img-nav-links">
</div>
<div id="img-border" class="border-frame">
	<?php echo $this->Html->image('m/about.jpg', array(
        'id' => 'img-photo',
        'class' => 'border-matte',
        'alt' => __('About'),
        'title' => __('About'),
    ));
	?>
</div>
<div id="notes-about-container">
	<h3><?php echo __('About');?></h3>
	<p>
		<?php echo $about;?>
	</p>
	<h3>Kontakt</h3>
	<p>
		<div>
			<?php
	        if ($email != '') {
	            echo 'eMail: <a href="mailto:' . $email . '">' . $email . '</a>';
	        }
			?>
		</div>
		<div>
			<?php
	        if ($twitter != '') {
	            echo 'Twitter: <a href="http://twitter.com/' . $twitter . '">' . $twitter . '</a>';
	        }
			?>
		</div>
		<div>
			<?php
	        if ($facebook != '') {
	            echo 'Facebook: <a href="http://facebook.com/' . $facebook . '">' . $facebook . '</a>';
	        }
			?>
		</div>
	</p>
	<h3><?php echo __('Tag Cloud');?></h3>
	<div id="tag_cloud">
		<?php
		foreach ($cloud as $tag => $data):
		?>
		<span style="font-size:<?php echo $data['size'];?>px"> <?php echo $this->Html->link($tag, array(
                'controller' => 'photos',
                'action' => 'tag',
                $data['slug'],
                'full_base' => true
            ), array('escape' => false));?></span>
		<?php
        endforeach;
		?>
	</div>
</div>
