<?php echo $this->element('adminmenu'); ?>

<div id="admin-container">

<h4>Settings</h4>

<?php

$descriptions = array(
	'site_title' => __('The title of the website'), 
	'site_subtitle' => __('The subtitle of the website'), 
	'keywords' => __('Keywords for the website meta'), 
	'parse_dir' => __('Directory containing your images and markdown files'),
	'license' => __('URL to the license of the website'),
	'ga_code' => __('Google Analytics Code'),
	'defensio_apikey' => __('API Key for Defensio'),
	'publish_immediately' => __('1 if parsed images should be published immediately, 0 if not'),
	'rss_feed' => __('URL of extern RSS feed'),
);

echo $this->Form->create('Admin', array('action' => 'options'));

foreach ($descriptions as $key => $label) {
	echo $this->Form->input($key, array(
	    'label' => $label,
	    'size' => '80',
	    'maxLength' => '255',
	    'required' => false,
	    'value' => isset($options[$key]) ? $options[$key] : ''
	));
}
echo $this->Form->end(__('save'));

?>
</div>
