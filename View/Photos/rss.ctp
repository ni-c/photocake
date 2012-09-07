<?php
$this->set('channelData', array(
    'title' => $site_title,
    'link' => $this->Html->url('/', true),
    'description' => $site_subtitle,
    'language' => 'de-DE'
));

App::uses('Sanitize', 'Utility', 'Markdown');

foreach ($photos as $photo) {
    $postTime = strtotime($photo['Photo']['created']);

    $postLink = array(
        'controller' => 'photos',
        'action' => 'view',
        $photo['Photo']['id']
    );

    // This is the part where we clean the body text for output as the description
    // of the rss item, this needs to have only text to make sure the feed validates
    $bodyText = $this->Html->image('m/' . $photo['Photo']['filename']) . '<br />' . $this->Markdown->transform($photo['Photo']['description']);

    echo  $this->Rss->item(array(), array(
        'title' => $photo['Photo']['title'],
        'link' => $postLink,
        'guid' => array('url' => $postLink, 'isPermaLink' => 'true'),
        'description' => $bodyText,
        'pubDate' => $photo['Photo']['created']
    ));
}
