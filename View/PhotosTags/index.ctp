<div class="photosTags index">
	<h2><?php echo __('Photos Tags'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('photo_id'); ?></th>
			<th><?php echo $this->Paginator->sort('tag_id'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th><?php echo $this->Paginator->sort('modified'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
	foreach ($photosTags as $photosTag): ?>
	<tr>
		<td><?php echo h($photosTag['PhotosTag']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($photosTag['Photo']['title'], array('controller' => 'photos', 'action' => 'view', $photosTag['Photo']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($photosTag['Tag']['name'], array('controller' => 'tags', 'action' => 'view', $photosTag['Tag']['id'])); ?>
		</td>
		<td><?php echo h($photosTag['PhotosTag']['created']); ?>&nbsp;</td>
		<td><?php echo h($photosTag['PhotosTag']['modified']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $photosTag['PhotosTag']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $photosTag['PhotosTag']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $photosTag['PhotosTag']['id']), null, __('Are you sure you want to delete # %s?', $photosTag['PhotosTag']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Photos Tag'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Photos'), array('controller' => 'photos', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Photo'), array('controller' => 'photos', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Tags'), array('controller' => 'tags', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Tag'), array('controller' => 'tags', 'action' => 'add')); ?> </li>
	</ul>
</div>
