<div id="browse-nav-container">
	<h4><?php echo __('Archive');?>&nbsp;<span class="rsaquo">&#8250;</span>&nbsp;<?php
        if ($current != 'archivedate') {
            echo $current;
        } else {
            echo __($this->Time->format('F', $archivedate)) . $this->Time->format(', Y', $archivedate);
        }
	?></h4>
	<ul id="categorylist">
		<li>
			<?php
            echo $this->Html->link(__('all') . ' (' . $count . ')', '/browse', array('title' => __('all')));
			?>
		</li>
		<?php
foreach ($categories as $category):
		?>
		<li>
			<?php
            echo $this->Html->link($category['Category']['name'] . ' (' . count($category['Photo']) . ')', '/browse/category/' . $category['Category']['slug'], array(
                'title' => $category['Category']['name'],
                'escape' => false
            ));
			?>
		</li>
		<?php
        endforeach;
		?>
	</ul>
	<h4><?php echo __('View By Month');?></h4>
	<ul id="monthlist">
		<li>
			<?php
            echo $this->Html->link(__('all') . ' (' . $count . ')', '/browse', array('title' => __('all')));
			?>
		</li>
		<?php
foreach ($month as $m):
		?>
		<li>
			<?php

            echo $this->Html->link(__($this->Time->format('F', $m['month'])) . $this->Time->format(', Y', $m['month']) . ' (' . $m['count'] . ')', '/browse/archivedate/' . $m['month'], array('title' => $m['month']));
			?>
		</li>
		<?php
        endforeach;
		?>
	</ul>
	<h4><?php echo __('View By Tag');?></h4>
	<ul id="taglist">
		<li>
			<?php
            echo $this->Html->link(__('all') . ' (' . $count . ')', '/browse', array('title' => __('all')));
			?>
		</li>
		<?php
foreach ($tags as $tag):
		?>
		<li>
			<?php
            echo $this->Html->link($tag['Tag']['name'], '/browse/tag/' . $tag['Tag']['slug'], array(
                'title' => $tag['Tag']['name'],
                'escape' => false
            ));
			?>
		</li>
		<?php
        endforeach;
		?>
	</ul>
</div>
<div id="thumbnail-nav-container" style="width: 610px;">
	<div id="thumbnail-container">
		<?php
foreach ($photos as $photo):
$i = 0;
		?>
		<div id="thumbnail-border-<?php echo $i;?>" class="border-frame thumbnail-border-frame">
			<?php
            echo $this->Html->link($this->Html->image('m/' . str_replace('.jpg', '_thumb.jpg', $photo['Photo']['filename']), array(
                'id' => 'thumbnail' . $i,
                'alt' => $photo['Photo']['title'],
                'title' => $photo['Photo']['title'],
                'class' => array(
                    'thumbnails',
                    'border-matte'
                ),
                'width' => '132',
                'height' => '84'
            )), '/p/' . $photo['Photo']['id'], array(
                'title' => $photo['Photo']['title'],
                'escape' => false
            ));
			?>
		</div>
		<?php
        $i++;
        endforeach;
		?>
	</div>
	<div id="paging-nav-container">
		<div class="results">
			<?php if ($pages>1):
			?>
			<div class="paginator">
				<?php echo $this->Html->Link('&larr;&nbsp;' . __('First') . '&nbsp;', $cururl . '1', array(
                    'class' => 'page',
                    'title' => __('Go To First Page'),
                    'escape' => false
                ));
				?>
				<?php if ($pages>2):
				?>
				<?php echo $this->Html->Link('&lsaquo;&nbsp;' . __('Previous') . '&nbsp;', $cururl . ($curpage - 1 < 1 ? 1 : $curpage), array(
                        'class' => 'page',
                        'title' => __('Go To Previous Page'),
                        'escape' => false
                    ));
				?>
				<?php endif;?>

				<?php
                for ($i = 1; $i < $pages+1; $i++) {
                    echo $this->Html->Link($i, $cururl . $i, array(
                        'class' => 'page',
                        'title' => __('Go To Page') . ' ' . $i,
                        'escape' => false
                    ));
                }
				?>

				<?php if ($pages>2):
				?>
				<?php echo $this->Html->Link('&nbsp;' . __('Next') . '&nbsp;&rsaquo;', $cururl . ($curpage + 1 > $pages ? $pages : $curpage + 1), array(
                        'class' => 'page',
                        'title' => __('Go To Next Page'),
                        'escape' => false
                    ));
				?>
				<?php endif;?>
				<?php echo $this->Html->Link('&nbsp;' . __('Last') . '&nbsp;&rarr;', $cururl . $pages, array(
                        'class' => 'page',
                        'title' => __('Go to Last Page'),
                        'escape' => false
                    ));
				?>
			</div>
			<?php endif;?>
			(<?php echo $photocount . ' ' . __('items');?>)
		</div>
	</div>
</div>
<div class="clear"></div>
