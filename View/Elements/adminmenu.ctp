<ul id="admin-menu">
	<li>
<?php
echo $this->Html->link(__('Settings'), array(
    'controller' => 'admins',
    'action' => 'settings',
    'full_base' => true
), array('title' => __('Settings')));
?>
	</li>
</ul>
