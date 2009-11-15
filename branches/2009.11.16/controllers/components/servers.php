<?php


class GameServersComponent extends Object {
	var $cache;

	function __construct() {
		$this->cache = CACHE . 'rss' . DS;
	}

	function get_object($feed_url) {

		// Make the cache dir if it doesn't exist
		if (!file_exists($this->cache)) {
			uses('folder');
			$folder = new Folder();
			$folder->mkdirr($this->cache);
		}

		// Include the vendor class
		vendor('lastrss');
		//App::import('Vendor', 'lastrss');

		// Setup LastRSS
		$feed = new lastRSS();
		$feed->cache_dir = $this->cache;
		$feed->cache_time = 3600; // one hour

		// Load RSS file
		if($rss = $feed->get($feed_url)) {
			$items = $rss;
			return $items;
		} else {
			// Return false
			return false;
		}
	}
}
?>