<div class="photosTags form">
<?php echo $this->Form->create('PhotosTag'); ?>
	<fieldset>
		<legend><?php echo __('Edit Photos Tag'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('photo_id');
		echo $this->Form->input('tag_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('PhotosTag.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('PhotosTag.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Photos Tags'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Photos'), array('controller' => 'photos', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Photo'), array('controller' => 'photos', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Tags'), array('controller' => 'tags', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Tag'), array('controller' => 'tags', 'action' => 'add')); ?> </li>
	</ul>
</div>
