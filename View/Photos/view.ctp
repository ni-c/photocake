<div class="photos view">
<h2><?php  echo __('Photo'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($photo['Photo']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Category'); ?></dt>
		<dd>
			<?php echo $this->Html->link($photo['Category']['name'], array('controller' => 'categories', 'action' => 'view', $photo['Category']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Cameramodelname'); ?></dt>
		<dd>
			<?php echo $this->Html->link($photo['Cameramodelname']['name'], array('controller' => 'cameramodelnames', 'action' => 'view', $photo['Cameramodelname']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Flash'); ?></dt>
		<dd>
			<?php echo $this->Html->link($photo['Flash']['name'], array('controller' => 'flashes', 'action' => 'view', $photo['Flash']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Lens Id'); ?></dt>
		<dd>
			<?php echo h($photo['Photo']['lens_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Exposureprogram'); ?></dt>
		<dd>
			<?php echo $this->Html->link($photo['Exposureprogram']['name'], array('controller' => 'exposureprograms', 'action' => 'view', $photo['Exposureprogram']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Meteringmode'); ?></dt>
		<dd>
			<?php echo $this->Html->link($photo['Meteringmode']['name'], array('controller' => 'meteringmodes', 'action' => 'view', $photo['Meteringmode']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Title'); ?></dt>
		<dd>
			<?php echo h($photo['Photo']['title']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Description'); ?></dt>
		<dd>
			<?php echo h($photo['Photo']['description']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Datecreated'); ?></dt>
		<dd>
			<?php echo h($photo['Photo']['datecreated']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Focallength'); ?></dt>
		<dd>
			<?php echo h($photo['Photo']['focallength']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Aperturevalue'); ?></dt>
		<dd>
			<?php echo h($photo['Photo']['aperturevalue']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Shutterspeedvalue'); ?></dt>
		<dd>
			<?php echo h($photo['Photo']['shutterspeedvalue']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Iso'); ?></dt>
		<dd>
			<?php echo h($photo['Photo']['iso']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Gpslatituderef'); ?></dt>
		<dd>
			<?php echo h($photo['Photo']['gpslatituderef']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Gpslatitude'); ?></dt>
		<dd>
			<?php echo h($photo['Photo']['gpslatitude']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Gpslongituderef'); ?></dt>
		<dd>
			<?php echo h($photo['Photo']['gpslongituderef']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Gpslongitude'); ?></dt>
		<dd>
			<?php echo h($photo['Photo']['gpslongitude']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Status'); ?></dt>
		<dd>
			<?php echo h($photo['Photo']['status']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($photo['Photo']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($photo['Photo']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Photo'), array('action' => 'edit', $photo['Photo']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Photo'), array('action' => 'delete', $photo['Photo']['id']), null, __('Are you sure you want to delete # %s?', $photo['Photo']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Photos'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Photo'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Categories'), array('controller' => 'categories', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Category'), array('controller' => 'categories', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Cameramodelnames'), array('controller' => 'cameramodelnames', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Cameramodelname'), array('controller' => 'cameramodelnames', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Flashes'), array('controller' => 'flashes', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Flash'), array('controller' => 'flashes', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Lenses'), array('controller' => 'lenses', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Lense'), array('controller' => 'lenses', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Exposureprograms'), array('controller' => 'exposureprograms', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Exposureprogram'), array('controller' => 'exposureprograms', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Meteringmodes'), array('controller' => 'meteringmodes', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Meteringmode'), array('controller' => 'meteringmodes', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Comments'), array('controller' => 'comments', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Comment'), array('controller' => 'comments', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Tags'), array('controller' => 'tags', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Tag'), array('controller' => 'tags', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Comments'); ?></h3>
	<?php if (!empty($photo['Comment'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Photo Id'); ?></th>
		<th><?php echo __('Name'); ?></th>
		<th><?php echo __('Email'); ?></th>
		<th><?php echo __('Website'); ?></th>
		<th><?php echo __('Comment'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($photo['Comment'] as $comment): ?>
		<tr>
			<td><?php echo $comment['id']; ?></td>
			<td><?php echo $comment['photo_id']; ?></td>
			<td><?php echo $comment['name']; ?></td>
			<td><?php echo $comment['email']; ?></td>
			<td><?php echo $comment['website']; ?></td>
			<td><?php echo $comment['comment']; ?></td>
			<td><?php echo $comment['created']; ?></td>
			<td><?php echo $comment['modified']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'comments', 'action' => 'view', $comment['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'comments', 'action' => 'edit', $comment['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'comments', 'action' => 'delete', $comment['id']), null, __('Are you sure you want to delete # %s?', $comment['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Comment'), array('controller' => 'comments', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related Tags'); ?></h3>
	<?php if (!empty($photo['Tag'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Name'); ?></th>
		<th><?php echo __('Slug'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($photo['Tag'] as $tag): ?>
		<tr>
			<td><?php echo $tag['id']; ?></td>
			<td><?php echo $tag['name']; ?></td>
			<td><?php echo $tag['slug']; ?></td>
			<td><?php echo $tag['created']; ?></td>
			<td><?php echo $tag['modified']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'tags', 'action' => 'view', $tag['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'tags', 'action' => 'edit', $tag['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'tags', 'action' => 'delete', $tag['id']), null, __('Are you sure you want to delete # %s?', $tag['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Tag'), array('controller' => 'tags', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
