<div class="photosTags view">
<h2><?php  echo __('Photos Tag'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($photosTag['PhotosTag']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Photo'); ?></dt>
		<dd>
			<?php echo $this->Html->link($photosTag['Photo']['title'], array('controller' => 'photos', 'action' => 'view', $photosTag['Photo']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Tag'); ?></dt>
		<dd>
			<?php echo $this->Html->link($photosTag['Tag']['name'], array('controller' => 'tags', 'action' => 'view', $photosTag['Tag']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($photosTag['PhotosTag']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($photosTag['PhotosTag']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Photos Tag'), array('action' => 'edit', $photosTag['PhotosTag']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Photos Tag'), array('action' => 'delete', $photosTag['PhotosTag']['id']), null, __('Are you sure you want to delete # %s?', $photosTag['PhotosTag']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Photos Tags'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Photos Tag'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Photos'), array('controller' => 'photos', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Photo'), array('controller' => 'photos', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Tags'), array('controller' => 'tags', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Tag'), array('controller' => 'tags', 'action' => 'add')); ?> </li>
	</ul>
</div>
