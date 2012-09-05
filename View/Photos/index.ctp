<div class="photos index">
	<h2><?php echo __('Photos'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('category_id'); ?></th>
			<th><?php echo $this->Paginator->sort('cameramodelname_id'); ?></th>
			<th><?php echo $this->Paginator->sort('flash_id'); ?></th>
			<th><?php echo $this->Paginator->sort('lens_id'); ?></th>
			<th><?php echo $this->Paginator->sort('exposureprogram_id'); ?></th>
			<th><?php echo $this->Paginator->sort('meteringmode_id'); ?></th>
			<th><?php echo $this->Paginator->sort('filename'); ?></th>
			<th><?php echo $this->Paginator->sort('title'); ?></th>
			<th><?php echo $this->Paginator->sort('description'); ?></th>
			<th><?php echo $this->Paginator->sort('datecreated'); ?></th>
			<th><?php echo $this->Paginator->sort('focallength'); ?></th>
			<th><?php echo $this->Paginator->sort('fnumber'); ?></th>
			<th><?php echo $this->Paginator->sort('exposuretime'); ?></th>
			<th><?php echo $this->Paginator->sort('iso'); ?></th>
			<th><?php echo $this->Paginator->sort('gpslatituderef'); ?></th>
			<th><?php echo $this->Paginator->sort('gpslatitude'); ?></th>
			<th><?php echo $this->Paginator->sort('gpslongituderef'); ?></th>
			<th><?php echo $this->Paginator->sort('gpslongitude'); ?></th>
			<th><?php echo $this->Paginator->sort('status'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th><?php echo $this->Paginator->sort('modified'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
	foreach ($photos as $photo): ?>
	<tr>
		<td><?php echo h($photo['Photo']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($photo['Category']['name'], array('controller' => 'categories', 'action' => 'view', $photo['Category']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($photo['Cameramodelname']['name'], array('controller' => 'cameramodelnames', 'action' => 'view', $photo['Cameramodelname']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($photo['Flash']['name'], array('controller' => 'flashes', 'action' => 'view', $photo['Flash']['id'])); ?>
		</td>
		<td><?php echo h($photo['Photo']['lens_id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($photo['Exposureprogram']['name'], array('controller' => 'exposureprograms', 'action' => 'view', $photo['Exposureprogram']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($photo['Meteringmode']['name'], array('controller' => 'meteringmodes', 'action' => 'view', $photo['Meteringmode']['id'])); ?>
		</td>
		<td><?php echo h($photo['Photo']['filename']); ?>&nbsp;</td>
		<td><?php echo h($photo['Photo']['title']); ?>&nbsp;</td>
		<td><?php echo h($photo['Photo']['description']); ?>&nbsp;</td>
		<td><?php echo h($photo['Photo']['datecreated']); ?>&nbsp;</td>
		<td><?php echo h($photo['Photo']['focallength']); ?>&nbsp;</td>
		<td><?php echo h($photo['Photo']['fnumber']); ?>&nbsp;</td>
		<td><?php echo h($photo['Photo']['exposuretime']); ?>&nbsp;</td>
		<td><?php echo h($photo['Photo']['iso']); ?>&nbsp;</td>
		<td><?php echo h($photo['Photo']['gpslatituderef']); ?>&nbsp;</td>
		<td><?php echo h($photo['Photo']['gpslatitude']); ?>&nbsp;</td>
		<td><?php echo h($photo['Photo']['gpslongituderef']); ?>&nbsp;</td>
		<td><?php echo h($photo['Photo']['gpslongitude']); ?>&nbsp;</td>
		<td><?php echo h($photo['Photo']['status']); ?>&nbsp;</td>
		<td><?php echo h($photo['Photo']['created']); ?>&nbsp;</td>
		<td><?php echo h($photo['Photo']['modified']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $photo['Photo']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $photo['Photo']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $photo['Photo']['id']), null, __('Are you sure you want to delete # %s?', $photo['Photo']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</p>

	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Photo'), array('action' => 'add')); ?></li>
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
