<?php

App::uses('HtmlHelper', 'View/Helper');

/**
 * Extension of Html->url() that supports multilangueage
 */
class LanguageHtmlHelper extends HtmlHelper {

    public function url($url = null, $full = false) {
        if (is_array($url)) {
            if (!isset($url['language']) && isset($this->params['language'])) {
                $url['language'] = $this->params['language'];
            }
			if ((isset($url['language'])) && ($url['language'] == Configure::read('Config.default_language'))) {
				$url['language'] = null;
			}
        } else {
            if ((strlen($url) < 3) || (substr($url, 1, 2) != $this->params['language'])) {
                $url = '/' . $this->params['language'] . $url;
            }
			if (substr($url, 1, 2) == Configure::read('Config.default_language')) {
				$url = substr($url, 3);
			}
        }
        return parent::url($url, $full);
    }

}
