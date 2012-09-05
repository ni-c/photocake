<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//DE" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="de">
	<head>
		<title><?php echo __($title_for_layout); ?></title>
		<base href="<?php echo $this->Html->url('/', true); ?>" />
		<meta http-equiv="Content-language" content="<?php echo $lang; ?>" />
		<?php
        echo $this->Html->charset();
        echo $this->Html->meta('icon');
        echo $this->Html->meta('generator', 'photocake (http://github.com/ni-c/photocake)');
        echo $this->Html->meta('keywords', $keywords);
        echo $this->Html->meta('description', $site_subtitle);
        echo $this->Html->meta('copyright', $copyright);
        echo $this->Html->meta('DC.rights', $copyright);
        echo $this->Html->meta('author', $author);
        echo $this->Html->meta('owner', $author);
        echo $this->Html->meta('publisher', $author);
        echo $this->Html->meta('version', '1.0');
        echo $this->Html->meta('robots', 'all');
        echo $this->Html->meta(array(
            'name' => 'DC.rights',
            'scheme' => 'DCTERMS.URI',
            'content' => $license
        ));
        echo $this->Html->meta('RSS Feed', '/feed', array('type' => 'rss'));

        /* Facebook OpenGraph */
        echo $this->Html->meta('og:title', __($title_for_layout));
        echo $this->Html->meta('og:site_name', __($site_title));
        echo $this->Html->meta('og:type', 'blog');

        /* Google Webfonts */#
        echo $this->Html->css('http://fonts.googleapis.com/css?family=Source+Sans+Pro|Open+Sans+Condensed:300&amp;subset=latin,latin-ext');

        echo $this->Html->css('styles');
        echo $this->Html->css('light');

        echo $this->fetch('meta');
        echo $this->fetch('css');
        echo $this->fetch('script');
		?>
	</head>

	<body>
		<div id="wrapper">
			<div id="container">
				<div id="header">
					<div id="site-title">
					    <?php echo $this->html->link($site_title, '/'); ?>
					</div>
		
					<div id="menu">
						<ul>
							<li>
								<?php echo $this->html->link(__('Latest'), '/', array('title' => __('Latest Photo'))); ?>
							</li>
							<li>
								&#183;
							</li>
							<li>
								<?php echo $this->html->link(__('Archive'), '/browse/1', array('title' => __('Show photo archive'))); ?>
							</li>
							<li>
								&#183;
							</li>
							<li>
								<?php echo $this->html->link(__('About'), '/about', array('title' => __('About'))); ?>
							</li>
						</ul>
						<div id="sub-title">
							<?php echo $site_subtitle ?>
						</div>
					</div>
					<div class="clear"></div>
				</div>
				<div id="content">
					<?php echo $this->Session->flash(); ?>
					<?php echo $this->fetch('content'); ?>
			        <div class="clear"></div>
				</div>
				<div id="footer">
		        <ul>
					<li>All photos on <span xmlns:dct="http://purl.org/dc/terms/" href="http://purl.org/dc/dcmitype/StillImage" property="dct:title" rel="dct:type"><?php echo __($site_title); ?></span> by <a xmlns:cc="http://creativecommons.org/ns#" href="<?php echo $this->Html->url('/', true); ?>" property="cc:attributionName" rel="cc:attributionURL"><?php echo __($author); ?></a> are licensed under a <a rel="license" href="http://creativecommons.org/licenses/by-nc-sa/3.0/deed.en_US">Creative Commons Attribution-NonCommercial-ShareAlike 3.0 Unported License</a>.</li>
		        </ul>
				</div>
			</div>
			<?php echo $this->element('sql_dump'); ?>
		</div>
	</body>
</html>
