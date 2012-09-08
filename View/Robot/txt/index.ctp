<?php
foreach ($lines as $key => $value) {
	if (strpos($value, '[URL]')!==false) {
		$value = str_replace('[URL]', $this->Html->url('/', true), $value);
	}
	echo $value . "\n";
}