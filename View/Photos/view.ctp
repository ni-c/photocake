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
<div itemscope="itemscope" itemtype="http://schema.org/CreativeWork" class="hAtom">
	<div id="img-nav-links">
		<?php if (isset($next_photo)):
		?>
		<div id="img-nav-nextlink" class="right">
			<?php
	        echo $this->Html->link(__('Next') . '&nbsp;&rarr;', array(
	            'controller' => 'photos',
	            'action' => 'view',
	            $next_photo['Photo']['slug'],
	            'full_base' => true
	        ), array(
	            'title' => __('Next Photo'),
	            'escape' => false
	        ));
			?>
		</div>
		<?php
	    endif;
	    if (isset($prev_photo)):
		?>
		<div id="img-nav-prevlink" class="left">
			<?php
	        echo $this->Html->link('&larr;&nbsp;' . __('Previous'), array(
	            'controller' => 'photos',
	            'action' => 'view',
	            $prev_photo['Photo']['slug'],
	            'full_base' => true
	        ), array(
	            'title' => __('Previous Photo'),
	            'escape' => false
	        ));
			?>
		</div>
		<?php endif;?>
		<div class="clear"></div>
	</div>
	<div class="hEntry">
		<div id="img-wrapper">
			<?php
		    if (isset($prev_photo)) {
		        echo $this->Html->link($this->Html->image('prev.gif', array(
		            'id' => 'img-nav-prevarrow',
		            'alt' => _('Previous Photo'),
		        )), array(
		            'controller' => 'photos',
		            'action' => 'view',
		            $prev_photo['Photo']['slug'],
		            'full_base' => true
		        ), array(
		            'title' => __('Previous Photo'),
		            'escape' => false
		        ));
		    }
		    if (isset($next_photo)) {
		        echo $this->Html->link($this->Html->image('next.gif', array(
		            'id' => 'img-nav-nextarrow',
		            'alt' => _('Next Photo'),
		        )), array(
		            'controller' => 'photos',
		            'action' => 'view',
		            $next_photo['Photo']['slug'],
		            'full_base' => true
		        ), array(
		            'title' => __('Next Photo'),
		            'escape' => false
		        ));
		    }
			?>
		
			<div id="img-border" class="border-frame">
				<?php echo $this->Html->image('m/' . $photo['Photo']['filename'], array(
		            'id' => 'img-photo',
		            'class' => 'border-matte',
		            'usemap' => '#img-photo-map',
		            'alt' => $photo['Photo']['title'],
		            'title' => $photo['Photo']['title'],
		            'itemprop' => 'image'
		        ));
				?>
				<map name="img-photo-map" id="img-photo-map">
					<?php if (isset($next_photo)):
					?>
					<area title="<?php echo __('Next Photo');?>" id="img-map-next" shape="rect" coords="400,0,800,600" href="<?php echo $this->Html->url(array(
		                    'controller' => 'photos',
		                    'action' => 'view',
		                    $next_photo['Photo']['slug'],
		                    'full_base' => true
		                ));
		 ?>" alt="<?php echo __('Next Photo');?>" />
					<?php
		            endif;
		            if (isset($prev_photo)):
					?>
					<area title="<?php echo __('Previous Photo');?>" id="img-map-prev" shape="rect" coords="0,0,400,600" href="<?php echo $this->Html->url(array(
		                    'controller' => 'photos',
		                    'action' => 'view',
		                    $prev_photo['Photo']['slug'],
		                    'full_base' => true
		                ));
		 ?>" alt="<?php echo __('Previous Photo');?>" />
					<?php
		            endif;
					?>
				</map>
			</div>
		</div>
		<div id="img-title-date-comments">
			<h3 id="img-title" class="entry-title">
				<?php echo $this->Html->link('<span itemprop="name">' . $photo['Photo']['title'] . '</span>', array(
		            'controller' => 'photos',
		            'action' => 'view',
		            $photo['Photo']['slug'],
		            'full_base' => true
		        ), array(
		            'title' => __('Permalink for ') . $photo['Photo']['title'],
		            'itemprop' => 'url',
		            'escape' => false
		        ));
				?>
			</h3>
			<div id="img-info-comment">
				<a id="info-toggle" href="javascript:void(0);" title="<?php echo __('Comments &amp; EXIF for ') . $photo['Photo']['title'];?>"> <?php
		        echo count($photo['Comment']) . '&nbsp;';
		        if (count($photo['Comment']) != 1) {
		            echo __('Comments');
		        } else {
		            echo __('Comment');
		        }
				?></a>
			</div>
			<div class="clear"></div>
			<div id="img-date">
				<?php echo $this->Time->format(__('Y-m-d H:i:s'), $photo['Photo']['datecreated']);?>
			</div>
			<div class="clear"></div>
		</div>
		<div class="clear"></div>
		<div id="notes-cmts-container">
			<div id="img-notes">
				<div class="notes-cmts-inner-wrapper">
					<h4><?php echo __('Description');?></h4>
					<div class="description entry-content">
						<?php echo $this->Markdown->transform($photo['Photo']['description']);?>
					</div>
					<?php echo $this->Html->link(__('Permalink'), array(
		                    'controller' => 'photos',
		                    'action' => 'view',
		                    $photo['Photo']['slug'],
		                    'full_base' => true
		                ), array(
		                    'title' => __('Permalink for ') . $photo['Photo']['title'],
		                    'escape' => false
		                ));
					?>
					<h4><?php echo __('EXIF Data');?></h4>
					<table id="exif">
						<tbody>
							<tr>
								<td><?php echo __('Camera') . ':';?></td>
								<td><?php echo $photo['Cameramodelname']['name'] != '' ? h($photo['Cameramodelname']['name']) : $na;?></td>
							</tr>
							<tr>
								<td><?php echo __('Focal Length') . ':';?></td>
								<td><?php echo $photo['Photo']['focallength'] != '' ? h($photo['Photo']['focallength']) . 'mm' : $na;?></td>
							</tr>
							<tr>
								<td><?php echo __('Aperture') . ':';?></td>
								<td><?php echo $photo['Photo']['fnumber'] != '' ? h($photo['Photo']['fnumber']) . ((strpos($photo['Photo']['fnumber'], '.')==false) ? '.0' : '') : $na;?></td>
							</tr>
							<tr>
								<td><?php echo __('Exposure') . ':';?></td>
								<td><?php echo $photo['Photo']['exposuretime'] != '' ? h($photo['Photo']['exposuretime']) : $na;?></td>
							</tr>
							<tr>
								<td><?php echo __('ISO Speed') . ':';?></td>
								<td><?php echo $photo['Photo']['iso'] != '' ? h($photo['Photo']['iso']) : $na;?></td>
							</tr>
							<tr>
								<td><?php echo __('Exposure Program') . ':';?></td>
								<td><?php echo $photo['Exposureprogram']['name'] != '' ? __(trim($photo['Exposureprogram']['name'])) : $na;?></td>
							</tr>
							<tr>
								<td><?php echo __('Flash') . ':';?></td>
								<td><?php echo $photo['Flash']['name'] != '' ? __($photo['Flash']['name']) : $na;?></td>
							</tr>
							<tr>
								<td><?php echo __('Lens') . ':';?></td>
								<td><?php echo $photo['Lens']['name'] != '' ? h($photo['Lens']['name']) : $na;?></td>
							</tr>
							<tr>
								<td><?php echo __('GPS') . ':';?></td>
								<td><?php
		                        if (($photo['Photo']['gpslatituderef'] != '') && ($photo['Photo']['gpslatitude'] != '') && ($photo['Photo']['gpslongituderef'] != '') && ($photo['Photo']['gpslongitude'] != '')) {
		                        	$geo = str_replace('N', '', str_replace('S', '-', str_replace('E', '', str_replace('W', '-', $photo['Photo']['gpslatituderef'] . $photo['Photo']['gpslatitude'] . ';' . $photo['Photo']['gpslongituderef'] . $photo['Photo']['gpslongitude']))));
		                            echo '<abbr class="geo" title="' . $geo .'">';
									echo h($photo['Photo']['gpslatituderef']) . ' ' . substr(h($photo['Photo']['gpslatitude']), 0, 8) . '&deg;, ' . h($photo['Photo']['gpslongituderef']) . ' ' . substr(h($photo['Photo']['gpslongitude']), 0, 8) . '&deg;';
									echo '</abbr>';
									$this->Html->meta(array('name' => 'geo.position', 'content' => $geo), false, array('inline' => false));
		                        } else {
		                            echo $na;
		                        }
								?></td>
							</tr>
							<tr>
								<td><?php echo __('Metering Mode') . ':';?></td>
								<td><?php echo $photo['Meteringmode']['name'] != '' ? __($photo['Meteringmode']['name']) : $na;?></td>
							</tr>
						</tbody>
					</table>
					<p>
						<h4 class="inline"><?php echo __('Category') . ':';?></h4>&nbsp;<?php echo $this->Html->link(__($photo['Category']['name']), array(
		                        'controller' => 'photos',
		                        'action' => 'category',
		                        $photo['Category']['slug'],
		                        'full_base' => true
		                    ), array(
		                        'title' => __($photo['Category']['name']),
		                        'escape' => false
		                    ));
						?>
						&nbsp;
					</p>
					<span><h4 class="inline"><?php echo __('Tags') . ':';?></h4>&nbsp;
						<ul id="taglist">
							<?php
		                    if (!empty($photo['Tag'])) {
		                        foreach ($photo['Tag'] as $tag) {
		                            echo '<li class="tag">' . $this->Html->link(__($tag['name']), array(
		                                'controller' => 'photos',
		                                'action' => 'tag',
		                                $tag['slug'],
		                                'full_base' => true
		                            ), array(
		                                'title' => __($tag['name']),
		                                'escape' => false
		                            )) . '</li>&nbsp;';
		                        }
		                    }
							?>
						</ul> </span>
				</div>
			</div>
			<div id="img-comments">
				<div class="notes-cmts-inner-wrapper">
					<h4><?php echo __('Comments');?></h4>
					<div class="bubbles">
						<div>
							<?php
		if (count($photo['Comment'])==0):
		echo __('No comments.');
		else:
		foreach ($photo['Comment'] as $key => $comment):
							?>
							<div class="bubble">
								<blockquote>
									<p>
										<?php echo h($comment['comment']);?>
									</p>
								</blockquote>
								<div class="tip"></div>
								<p>
									<strong> <?php
		if ($comment['website']!=''):
									?>
									<a rel="nofollow" title="Visit Homepage" href="<?php echo h($comment['website']);?>"> <?php echo h($comment['name']);?></a> <?php
		                            else:
		                            echo h($comment['name']);
		                            endif;
									?></strong>
									<?php echo __('on') . ' ' . $this->Time->format(__('Y-m-d H:i:s'), $comment['created']);?>
								</p>
							</div>
							<?php endforeach; endif;?>
						</div>
					</div>
					<h4><?php echo __('Leave a Comment');?></h4>
					<?php
		            echo $this->Form->create('Comment', array('action' => 'add'));
		            echo $this->Form->hidden('Comment.photo_id', array('value' => $photo['Photo']['id']));
		            echo $this->Form->input('name', array(
		                'label' => __('Name (required)'),
		                'size' => '40',
		                'maxLength' => '32',
		                'required' => true,
		            ));
		            echo $this->Form->input('email', array(
		                'label' => __('Email (required, not shown)'),
		                'size' => '40',
		                'maxLength' => '32',
		                'type' => 'email',
		                'required' => true,
		            ));
		            echo $this->Form->input('website', array(
		                'label' => __('Website (optional)'),
		                'size' => '40',
		                'maxLength' => '255',
		                'type' => 'url',
		            ));
		            echo $this->Form->input('comment', array(
		                'label' => __('Comment (required)'),
		                'size' => '40',
		                'required' => true,
		            ));
		            echo $this->Form->end(__('submit'));
					?>
				</div>
			</div>
		</div>
		<!--[if IE 8]><br class="clear" /><![endif]-->
	</div>
</div>