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
<urlset xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd" xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
	<?php
	foreach ($available_languages as $key => $language): 
		?>
		    <url>
		        <loc><?php echo $this->Html->url(array('controller'=>'photos','action'=>'view', 'language' => $key, 'last'), true); ?></loc>
		        <changefreq>daily</changefreq>
		        <priority>1.0</priority>
		    </url>
		    <url>
		        <loc><?php echo $this->Html->url(array('controller'=>'pages','action'=>'display', 'language' => $key, 'about'), true); ?></loc>
		        <changefreq>monthly</changefreq>
		        <priority>0.9</priority>
		    </url>
		    <?php foreach ($photos as $photo):?>
		    <url>
		        <loc><?php echo $this->Html->url(array('controller'=>'photos','action'=>'view', 'language' => $key, $photo['Photo']['slug']),true); ?></loc>
		        <lastmod><?php echo $this->Time->toAtom($photo['Photo']['modified']); ?></lastmod>
		        <priority>0.8</priority>
		    </url>
		    <?php endforeach; ?>
		<?php 
	endforeach; 
	?>
</urlset>