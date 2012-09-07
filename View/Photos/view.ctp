<div id="img-nav-links">
	<?php if (isset($next_photo)):
	?>
	<div id="img-nav-nextlink" class="right">
		<?php
        /* TODO: Javascript for onMouseOver / onMouseOut hidden/visible */
        echo $this->Html->link(__('Next') . '&nbsp;&rarr;', '/p/' . $next_photo['Photo']['id'], array(
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
        /* TODO: Javascript for onMouseOver / onMouseOut hidden/visible */
        echo $this->Html->link('&larr;&nbsp;' . __('Previous'), '/p/' . $prev_photo['Photo']['id'], array(
            'title' => __('Previous Photo'),
            'escape' => false
        ));
		?>
	</div>
	<?php endif; ?>
	<div class="clear"></div>
</div>
<div id="img-wrapper">
	<?php
    if (isset($prev_photo)) {
        /* TODO: Javascript for onMouseOver / onMouseOut hidden/visible */
        echo $this->Html->link($this->Html->image('prev.gif', array(
            'id' => 'img-nav-prevarrow',
            //          	'class' => 'hidden',
            'alt' => _('Previous Photo'),
        )), '/p/' . $prev_photo['Photo']['id'], array(
            'title' => __('Previous'),
            'escape' => false
        ));
    }
    if (isset($next_photo)) {
        /* TODO: Javascript for onMouseOver / onMouseOut hidden/visible */
        echo $this->Html->link($this->Html->image('next.gif', array(
            'id' => 'img-nav-nextarrow',
            //        	'class' => 'hidden',
            'alt' => _('Next Photo'),
        )), '/p/' . $next_photo['Photo']['id'], array(
            'title' => __('Next'),
            'escape' => false
        ));
    }
	?>

	<div id="img-border" class="border-frame">
		<?php echo $this->Html->image('m/' . h($photo['Photo']['filename']), array(
            'id' => 'img-photo',
            'class' => 'border-matte',
            'usemap' => '#img-photo-map',
            'alt' => $photo['Photo']['title'],
            'title' => $photo['Photo']['title'],
        ));
		?>
		<map name="img-photo-map" id="img-photo-map">
			<?php if (isset($next_photo)):
			?>
			<area title="<?php echo __('Next Photo'); ?>" id="img-map-next" shape="rect" coords="400,0,800,600" href="p/<?php echo $next_photo['Photo']['id']; ?>" alt="<?php echo __('Next Photo'); ?>" onmouseover="return navMouseEvent('img-nav-nextarrow', 'visible');" onmouseout="return navMouseEvent('img-nav-nextarrow', 'hidden');" />
			<?php
            endif;
            if (isset($prev_photo)):
			?>
			<area title="<?php echo __('Previous Photo'); ?>" id="img-map-prev" shape="rect" coords="0,0,400,600" href="p/<?php echo $prev_photo['Photo']['id']; ?>" alt="<?php echo __('Previous Photo'); ?>" onmouseover="return navMouseEvent('img-nav-prevarrow', 'visible');" onmouseout="return navMouseEvent('img-nav-prevarrow', 'hidden');" />
			<?php
            endif;
			?>
		</map>
	</div>
</div>
<div id="img-title-date-comments">
	<div id="img-title">
		<?php echo $this->Html->link($photo['Photo']['title'], '/p/' . $photo['Photo']['id'], array(
            'title' => __('Permalink for ') . $photo['Photo']['title'],
            'escape' => false
        ));
 ?>
	</div>
	<div id="img-info-comment">
		<a id="info-toggle" href="javascript:void(0);" title="<?php echo __('Comments &amp; EXIF for ') . $photo['Photo']['title']; ?>"> <?php
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
		<?php echo $this->Time->format(__('Y-m-d H:i:s'), $photo['Photo']['datecreated']); ?>
	</div>
	<div class="clear"></div>
</div>
<div class="clear"></div>
<div id="notes-cmts-container">
	<div id="img-notes">
		<div class="notes-cmts-inner-wrapper">
			<h3><?php echo __('Description'); ?></h3>
			<div class="description">
				<?php echo $this->Markdown->transform($photo['Photo']['description']); ?>
			</div>
			<?php echo $this->Html->link(__('Permalink'), '/p/' . $photo['Photo']['id'], array('title' => __('Permalink for ') . $photo['Photo']['title'], 'escape' => false)); ?>
			<h3><?php echo __('EXIF Data'); ?></h3>
			<table id="exif">
				<tbody>
					<tr>
						<td><?php echo __('Camera') . ':'; ?></td>
						<td><?php echo $photo['Cameramodelname']['name'] != '' ? h($photo['Cameramodelname']['name']) : $na; ?></td>
					</tr>
					<tr>
						<td><?php echo __('Focal Length') . ':'; ?></td>
						<td><?php echo $photo['Photo']['focallength'] != '' ? h($photo['Photo']['focallength']) . 'mm' : $na; ?></td>
					</tr>
					<tr>
						<td><?php echo __('Aperture') . ':'; ?></td>
						<td><?php echo $photo['Photo']['fnumber'] != '' ? h($photo['Photo']['fnumber']) : $na; ?></td>
					</tr>
					<tr>
						<td><?php echo __('Exposure') . ':'; ?></td>
						<td><?php echo $photo['Photo']['exposuretime'] != '' ? h($photo['Photo']['exposuretime']) : $na; ?></td>
					</tr>
					<tr>
						<td><?php echo __('ISO Speed') . ':'; ?></td>
						<td><?php echo $photo['Photo']['iso'] != '' ? h($photo['Photo']['iso']) : $na; ?></td>
					</tr>
					<tr>
						<td><?php echo __('Exposure Program') . ':'; ?></td>
						<td><?php echo $photo['Exposureprogram']['name'] != '' ? __(trim($photo['Exposureprogram']['name'])) : $na; ?></td>
					</tr>
					<tr>
						<td><?php echo __('Flash') . ':'; ?></td>
						<td><?php echo $photo['Flash']['name'] != '' ? __($photo['Flash']['name']) : $na; ?></td>
					</tr>
					<tr>
						<td><?php echo __('Lens') . ':'; ?></td>
						<td><?php echo $photo['Lens']['name'] != '' ? h($photo['Lens']['name']) : $na; ?></td>
					</tr>
					<tr>
						<td><?php echo __('GPS') . ':'; ?></td>
						<td>
							<?php
                            if (($photo['Photo']['gpslatituderef'] != '') && ($photo['Photo']['gpslatitude'] != '') && ($photo['Photo']['gpslongituderef'] != '') && ($photo['Photo']['gpslongitude'] != '')) {
                                echo h($photo['Photo']['gpslatituderef']) . ' ' . substr(h($photo['Photo']['gpslatitude']), 0, 8) . '&deg;, ' . h($photo['Photo']['gpslongituderef']) . ' ' . substr(h($photo['Photo']['gpslongitude']), 0, 8) . '&deg;';
                            } else {
                            	echo $na;
                            }
							?>
						</td>
					</tr>
					<tr>
						<td><?php echo __('Metering Mode') . ':'; ?></td>
						<td><?php echo $photo['Meteringmode']['name'] != '' ? __($photo['Meteringmode']['name']) : $na; ?></td>
					</tr>
				</tbody>
			</table>
			<p>
				<b><?php echo __('Category') . ':'; ?></b>&nbsp;<?php echo $this->Html->link(__($photo['Category']['name']), '/browse/category/' . $photo['Category']['slug'], array('title' => __($photo['Category']['name']))); ?>
				&nbsp;
			</p>
			<p>
				<b><?php echo __('Tags') . ':'; ?></b>&nbsp;
				<tr>
					<?php
                    if (!empty($photo['Tag'])) {
                        foreach ($photo['Tag'] as $tag) {
                            echo '<td>' . $this->Html->link(__($tag['name']), '/browse/tag/' . $tag['slug'], array('title' => __($tag['name']))) . '&nbsp;</td>';
                        }
                    }
					?>
				</tr>
			</p>
		</div>
	</div>
	<div id="img-comments">
		<div class="notes-cmts-inner-wrapper">
			<h3><?php echo __('Comments'); ?></h3>
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
								<?php echo h($comment['comment']); ?>
							</p>
						</blockquote>
						<div class="tip"></div>
						<p>
							<strong> <?php
if ($comment['website']!=''):
							?>
							<a rel="nofollow" title="Visit Homepage" href="<?php echo h($comment['website']); ?>"> <?php echo h($comment['name']); ?></a> <?php
                            else:
                            echo h($comment['name']);
                            endif;
							?></strong>
							<?php echo __('on') . ' ' . $this->Time->format(__('Y-m-d H:i:s'), $comment['created']); ?>
						</p>
					</div>
					<?php endforeach; endif; ?>
				</div>
			</div>
			<h3><?php echo __('Leave a Comment'); ?></h3>
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
	<!--[if IE 8]><br class="clear" /><![endif]-->
