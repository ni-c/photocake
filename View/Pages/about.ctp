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
<div id="img-nav-links"></div>
<?php
if (isset($missing_image)):
?>
<p>
	No <strong>about.jpg</strong> in your images folder found.
</p>
<?php else:?>
<div id="img-border" class="border-frame">
	<?php
    echo $this->Html->image('m/about.jpg', array(
        'id' => 'img-photo',
        'class' => 'border-matte',
        'alt' => __('About'),
        'title' => __('About'),
    ));
	?>
</div>
<?php
endif;
?>
<div id="notes-about-container">
	<h3><?php echo __('About');?></h3>
	<?php
if (isset($about)):
	$html = $this->Markdown->transform($about);
	for ($i=6; $i > 0 ; $i--) {
		$html = preg_replace('/<h' . $i . '>(.*?)<\/h' . $i . '>/', '<h' . (($i + 3) > 6 ? 6 : ($i + 3)) . '>$1</h' . (($i + 3) > 6 ? 6 : ($i + 3)) . '>', $html);
	}
	echo $html;
else:
	?>

	<p>
		Please create a file named <strong>about.md</strong> in your images folder containing your markdown formatted about page.
	</p>
	<?php endif;?>

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
            ), array('escape' => false));
			?></span>
		<?php
        endforeach;
		?>
	</div>
</div>
