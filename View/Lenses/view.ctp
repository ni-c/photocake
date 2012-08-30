<div class="lenses view">
<h2><?php  echo __('Lense'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($lense['Lense']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($lense['Lense']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($lense['Lense']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($lense['Lense']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Lense'), array('action' => 'edit', $lense['Lense']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Lense'), array('action' => 'delete', $lense['Lense']['id']), null, __('Are you sure you want to delete # %s?', $lense['Lense']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Lenses'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Lense'), array('action' => 'add')); ?> </li>
	</ul>
</div>
