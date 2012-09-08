<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//DE" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $lang;?>">
	<head>
		<script src="//ajax.googleapis.com/ajax/libs/mootools/1.4.5/mootools-yui-compressed.js"></script>
		<title><?php echo $title_for_layout . ' | ' . $site_title;?></title>
		<base href="<?php echo $this->Html->url('/', true);?>" />
		<meta http-equiv="Content-language" content="<?php echo $lang;?>" />
		<meta name="language" content="<?php
            if ($lang == 'de') {
                echo 'German';
            } else {
            	echo 'English';
            }
 ?>" />
		<meta name="generator" content="photocake (http://github.com/ni-c/photocake)" />
		<meta name="copyright" content="<?php echo $copyright?>" />
		<meta name="author" content="<?php echo $author?>" />
		<meta name="owner" content="<?php echo $author?>" />
		<meta name="publisher" content="<?php echo $author?>" />
		<meta name="version" content="0.2b" />
		<meta name="robots" content="all" />
		<?php
        echo $this->Html->charset();
        echo $this->Html->meta('icon');

        echo $this->Html->meta('keywords', $keywords);
        echo $this->Html->meta('description', $description);
        echo $this->Html->meta('RSS Feed', '/feed', array('type' => 'rss'));
        /* Google Webfonts */#
        echo $this->Html->css('http://fonts.googleapis.com/css?family=Source+Sans+Pro|Open+Sans+Condensed:300&amp;subset=latin,latin-ext');

        echo $this->Html->css('styles');
        echo $this->Html->css('light');

        echo $this->Html->script('mootools-more-1.4.0.1');
        echo $this->Html->script('photocake');

        echo $this->fetch('meta');
        echo $this->fetch('css');
        echo $this->fetch('script');
		?>
		<meta name="DC.Title" content="<?php echo $title_for_layout; ?>" />
		<meta name="DC.Subject" content="<?php echo $site_title; ?>" />
		<meta name="DC.Creator" content="photocake" />
		<meta name="DC.Subject" content="<?php echo $site_title; ?>" />
		<meta name="DC.Publisher" content="<?php echo $author; ?>" />
		<meta name="DC.Rights" content="<?php echo $author; ?>" />
		<meta name="DC.Language" content="<?php echo $lang;?>" />
		<meta name="og:title" content="<?php echo $title_for_layout;?>" />
		<meta name="og:site_name" content="<?php echo $site_title;?>" />
		<meta name="og:type" content="blog" />
		<?php
        if ($ga_code != '') {
            echo $this->GoogleAnalytics->trackingCode($ga_code);
        }
		?>
	</head>
	<body>
		<div id="wrapper">
			<div id="container">
				<div id="header">
					<h1 id="site-title"><?php echo $this->Html->link($site_title, array(
                        'controller' => 'photos',
                        'action' => 'view',
                        'last',
                        'full_base' => true
                    ));
					?></h1>
					<div id="menu">
						<ul>
							<li>
								<?php echo $this->Html->link(__('Latest'), array(
                                    'controller' => 'photos',
                                    'action' => 'view',
                                    'last',
                                    'full_base' => true
                                ), array('title' => __('Latest Photo')));
								?>
							</li>
							<li>
								&#183;
							</li>
							<li>
								<?php echo $this->Html->link(__('Archive'), array(
                                    'controller' => 'photos',
                                    'action' => 'archive',
                                    'full_base' => true
                                ), array('title' => __('Show photo archive')));
								?>
							</li>
							<li>
								&#183;
							</li>
							<li>
								<?php echo $this->Html->link(__('About'), array(
                                    'controller' => 'pages',
                                    'action' => 'display',
                                    'about',
                                    'full_base' => true
                                ), array('title' => __('About')));
								?>
							</li>
							<li>
								<?php
                                if ($lang != 'en') {
                                    echo $this->Html->link($this->Html->image('flag/en.png', array(
                                        'alt' => 'Switch to english',
                                        'class' => 'flag'
                                    )), array_merge(array('language' => 'en'), $this->params['pass']), array(
                                        'title' => 'Switch to english',
                                        'escape' => false
                                    ));
                                }
                                if ($lang != 'de') {
                                    echo $this->Html->link($this->Html->image('flag/de.png', array(
                                        'alt' => 'Webseite auf Deutsch umschalten',
                                        'class' => 'flag'
                                    )), array_merge(array('language' => 'de'), $this->params['pass']), array(
                                        'title' => 'Webseite auf Deutsch umschalten',
                                        'escape' => false
                                    ));
                                }
								?>
							</li>
						</ul>
						<h2 id="sub-title"><?php echo $site_subtitle
						?></h2>
					</div>
					<div class="clear"></div>
				</div>
				<div id="content">
					<?php echo $this->Session->flash();?>
					<?php echo $this->fetch('content');?>
					<div class="clear"></div>
				</div>
				<div id="footer">
					<ul>
						<li>
							All photos on <span xmlns:dct="http://purl.org/dc/terms/" href="http://purl.org/dc/dcmitype/StillImage" property="dct:title" rel="dct:type"><?php echo __($site_title);?></span> by <a xmlns:cc="http://creativecommons.org/ns#" href="<?php echo $this->Html->url('/', true);?>" property="cc:attributionName" rel="cc:attributionURL"><?php echo __($author);?></a> are licensed under a <a rel="license" href="http://creativecommons.org/licenses/by-nc-sa/3.0/deed.en_US">Creative Commons Attribution-NonCommercial-ShareAlike 3.0 Unported License</a>.
						</li>
						<li>
							Powered by <a href="http://github.com/ni-c/photocake">Photocake</a>.
						</li>
					</ul>
				</div>
			</div>
			<?php /*echo $this->element('sql_dump');*/?>
		</div>
	</body>
</html>