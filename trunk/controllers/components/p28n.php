<?php 
class P28nComponent extends Object {
    var $components = array('Session', 'Cookie');

    function startup() {
        if (!$this->Session->check('Config.language')) {
            $this->change(($this->Cookie->read('language') ? $this->Cookie->read('language') : DEFAULT_LANGUAGE));
        }        //
    }

    function change($lang = null) {
        if (!empty($lang)) {
            $this->Session->write('Config.language', $lang);
            $this->Cookie->write('language', $lang, null, '+350 day'); 
        }
    }
    
    function get() {
    	$lang = $this->Session->read('Config.language');
    	return $lang;
    }
    
}
?>