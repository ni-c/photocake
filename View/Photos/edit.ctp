<div class="photos form">
<?php echo $this->Form->create('Photo'); ?>
	<fieldset>
		<legend><?php echo __('Edit Photo'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('category_id');
		echo $this->Form->input('cameramodelname_id');
		echo $this->Form->input('flash_id');
		echo $this->Form->input('lens_id');
		echo $this->Form->input('exposureprogram_id');
		echo $this->Form->input('meteringmode_id');
		echo $this->Form->input('title');
		echo $this->Form->input('description');
		echo $this->Form->input('datecreated');
		echo $this->Form->input('focallength');
		echo $this->Form->input('aperturevalue');
		echo $this->Form->input('shutterspeedvalue');
		echo $this->Form->input('iso');
		echo $this->Form->input('gpslatituderef');
		echo $this->Form->input('gpslatitude');
		echo $this->Form->input('gpslongituderef');
		echo $this->Form->input('gpslongitude');
		echo $this->Form->input('status');
		echo $this->Form->input('Tag');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Photo.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('Photo.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Photos'), array('action' => 'index')); ?></li>
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
