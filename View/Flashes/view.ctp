<div class="flashes view">
<h2><?php  echo __('Flash'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($flash['Flash']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($flash['Flash']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($flash['Flash']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($flash['Flash']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Flash'), array('action' => 'edit', $flash['Flash']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Flash'), array('action' => 'delete', $flash['Flash']['id']), null, __('Are you sure you want to delete # %s?', $flash['Flash']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Flashes'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Flash'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Photos'), array('controller' => 'photos', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Photo'), array('controller' => 'photos', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Photos'); ?></h3>
	<?php if (!empty($flash['Photo'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Category Id'); ?></th>
		<th><?php echo __('Cameramodelname Id'); ?></th>
		<th><?php echo __('Flash Id'); ?></th>
		<th><?php echo __('Lens Id'); ?></th>
		<th><?php echo __('Exposureprogram Id'); ?></th>
		<th><?php echo __('Meteringmode Id'); ?></th>
		<th><?php echo __('Title'); ?></th>
		<th><?php echo __('Description'); ?></th>
		<th><?php echo __('Datecreated'); ?></th>
		<th><?php echo __('Focallength'); ?></th>
		<th><?php echo __('Aperturevalue'); ?></th>
		<th><?php echo __('Shutterspeedvalue'); ?></th>
		<th><?php echo __('Iso'); ?></th>
		<th><?php echo __('Gpslatituderef'); ?></th>
		<th><?php echo __('Gpslatitude'); ?></th>
		<th><?php echo __('Gpslongituderef'); ?></th>
		<th><?php echo __('Gpslongitude'); ?></th>
		<th><?php echo __('Status'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($flash['Photo'] as $photo): ?>
		<tr>
			<td><?php echo $photo['id']; ?></td>
			<td><?php echo $photo['category_id']; ?></td>
			<td><?php echo $photo['cameramodelname_id']; ?></td>
			<td><?php echo $photo['flash_id']; ?></td>
			<td><?php echo $photo['lens_id']; ?></td>
			<td><?php echo $photo['exposureprogram_id']; ?></td>
			<td><?php echo $photo['meteringmode_id']; ?></td>
			<td><?php echo $photo['title']; ?></td>
			<td><?php echo $photo['description']; ?></td>
			<td><?php echo $photo['datecreated']; ?></td>
			<td><?php echo $photo['focallength']; ?></td>
			<td><?php echo $photo['aperturevalue']; ?></td>
			<td><?php echo $photo['shutterspeedvalue']; ?></td>
			<td><?php echo $photo['iso']; ?></td>
			<td><?php echo $photo['gpslatituderef']; ?></td>
			<td><?php echo $photo['gpslatitude']; ?></td>
			<td><?php echo $photo['gpslongituderef']; ?></td>
			<td><?php echo $photo['gpslongitude']; ?></td>
			<td><?php echo $photo['status']; ?></td>
			<td><?php echo $photo['created']; ?></td>
			<td><?php echo $photo['modified']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'photos', 'action' => 'view', $photo['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'photos', 'action' => 'edit', $photo['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'photos', 'action' => 'delete', $photo['id']), null, __('Are you sure you want to delete # %s?', $photo['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Photo'), array('controller' => 'photos', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
