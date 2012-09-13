<?php
/**
 * photocake - A markdown photo blog based on CakePHP.
 * Copyright (C) 2012 Willi Thiel <mail@willithiel.de>
 *
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation; either version 2
 * of the License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
 *
 * @copyright     Copyright 2012, Willi Thiel <mail@willithiel.de>
 * @link          https://github.com/ni-c/photocake
 * @license       GNU General Public License, version 2 (http://www.gnu.org/licenses/gpl-2.0.html)
 */
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $lang;?>">
	<head>
		<?php if ($ga_code != ''): ?>
		<script type="text/javascript">
			var _gaq = _gaq || [];
			_gaq.push(['_setAccount', '<?php echo $ga_code; ?>']);
			_gaq.push (['_gat._anonymizeIp']);
			_gaq.push(['_trackPageview']);
			(function() {
				var ga = document.createElement('script');
				ga.type = 'text/javascript';
				ga.async = true;
				ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
				var s = document.getElementsByTagName('script')[0];
				s.parentNode.insertBefore(ga, s);
			})();
		</script>
        <?php endif; ?>
		<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/mootools/1.4.5/mootools-yui-compressed.js"></script>
		<title><?php echo $title_for_layout . ' | ' . $site_title;?></title>
		<base href="<?php echo $this->Html->url('/', true);?>" />
		<meta http-equiv="Content-language" content="<?php echo $lang;?>" />
		<meta name="language" content="<?php
			echo $available_languages[$lang]['english_name']; 
		?>" />
		<?php
        echo $this->Html->charset();
        echo $this->Html->meta('icon');

        echo $this->Html->meta('keywords', $keywords);
        echo $this->Html->meta('description', $description);

		if (isset($rss_feed)) {
			echo '<link href="' . $rss_feed . '" type="application/rss+xml" rel="alternate" title="RSS Feed" />';
		} else {
	        echo $this->Html->meta('RSS Feed', '/feed.rss', array('type' => 'rss'));
		}
        
        /* Google Webfonts */
        echo $this->Html->css('http://fonts.googleapis.com/css?family=Source+Sans+Pro|Open+Sans+Condensed:300&amp;subset=latin,latin-ext');

        echo $this->Html->css('photocake');
        echo $this->Html->script('photocake');

        echo $this->fetch('meta');
        echo $this->fetch('css');
        echo $this->fetch('script');
		?>
		<meta name="generator" content="photocake (http://github.com/ni-c/photocake)" />
		<meta name="copyright" content="<?php echo $copyright?>" />
		<meta name="author" content="<?php echo $author?>" />
		<meta name="owner" content="<?php echo $author?>" />
		<meta name="publisher" content="<?php echo $author?>" />
		<meta name="version" content="0.2b" />
		<meta name="robots" content="all" />
		<meta name="DC.Title" content="<?php echo $title_for_layout;?>" />
		<meta name="DC.Subject" content="<?php echo $site_title;?>" />
		<meta name="DC.Creator" content="photocake" />
		<meta name="DC.Subject" content="<?php echo $site_title;?>" />
		<meta name="DC.Publisher" content="<?php echo $author;?>" />
		<meta name="DC.Rights" content="<?php echo $author;?>" />
		<meta name="DC.Language" content="<?php echo $lang;?>" />
		<meta name="og:title" content="<?php echo $title_for_layout;?>" />
		<meta name="og:site_name" content="<?php echo $site_title;?>" />
		<meta name="og:type" content="blog" />
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
                                ), array('title' => __('Latest Photo'), 'id' => 'latest_link'));
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
                                ), array('title' => __('Show photo archive'), 'id' => 'archive_link'));
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
                                ), array('title' => __('About'), 'id' => 'about_link'));
								?>
							</li>
							<?php if ($logged_in): ?>
							<li>
								&#183;
							</li>
							<li>
								<?php echo $this->Html->link(__('Admin'), array(
                                    'controller' => 'admins',
                                    'action' => 'index',
                                    'full_base' => true
                                ), array('title' => __('Admin'), 'id' => 'admin_link'));
								?>
							</li>
							<li>
								&#183;
							</li>
							<li>
								<?php echo $this->Html->link(__('Logout'), array(
                                    'controller' => 'users',
                                    'action' => 'logout',
                                    'full_base' => true
                                ), array('title' => __('Logout'), 'id' => 'logout_link'));
								?>
							</li>
							<?php endif; ?>
							<li>
								<?php
								foreach ($available_languages as $key => $language) {
									if ($key != $lang) {
                                    echo $this->Html->link($this->Html->image('flag/' . $key . '.png', array(
                                        'alt' => $language['alt'],
                                        'class' => 'flag'
                                    )), array_merge(array('language' => $key), $this->params['pass']), array(
                                        'title' => $language['alt'],
                                        'escape' => false
                                    ));
									}
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
							Powered by <a href="http://github.com/ni-c/photocake">photocake</a>.
						</li>
					</ul>
				</div>
			</div>
		</div>
		<?php
        echo $this->element('sql_dump');
		?>
	</body>
</html>
