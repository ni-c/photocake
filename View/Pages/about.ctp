<?php
	$this->set('title_for_layout', __('About'));
?>
<div id="img-nav-links">
</div>
<div id="img-border" class="border-frame">
	<?php echo $this->Html->image('m/about.jpg', array(
        'id' => 'img-photo',
        'class' => 'border-matte',
        'alt' => __('About'),
        'title' => __('About'),
    ));
	?>
</div>
<div id="notes-about-container">
	<h3><?php echo __('About');?></h3>
	<p>
		<?php echo $about;?>
	</p>
	<h3>Kontakt</h3>
	<p>
		<div>
			<?php
	        if ($email != '') {
	            echo 'eMail: <a href="mailto:' . $email . '">' . $email . '</a>';
	        }
			?>
		</div>
		<div>
			<?php
	        if ($twitter != '') {
	            echo 'Twitter: <a href="http://twitter.com/' . $twitter . '">' . $twitter . '</a>';
	        }
			?>
		</div>
		<div>
			<?php
	        if ($facebook != '') {
	            echo 'Facebook: <a href="http://facebook.com/' . $facebook . '">' . $facebook . '</a>';
	        }
			?>
		</div>
	</p>
	<h3><?php echo __('Tag Cloud');?></h3>
	<div id="tag_cloud">
		<?php
		foreach ($cloud as $tag => $data):
		?>
		<span style="font-size:<?php echo $data['size'];?>px"> <?php echo $this->Html->link($tag, array(
                'controller' => 'photos',
                'action' => 'tag',
                $data['slug'],
                'full_base' => true
            ), array('escape' => false));?></span>
		<?php
        endforeach;
		?>
	</div>
</div>
