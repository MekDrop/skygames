<?php
class FeedsController extends AppController {
	
     var $name = 'Feeds';
     var $components = array('Lastrss');
     var $uses = false;
     var $helpers = array('Cache');	
    
 	 var $cacheAction = '1 hour';
   
    
     var $convert = array (
   
  	  "img" => "img style='width:50px;height:auto;'"
   
     );
   
     var $contentHelpers = false;
     var $defaultImgUrl = "img/uploads/grabs/";
     var $defaultImgPath = "";

     var $badStrings = array (
     	"&lt;![CDATA[" => "",
     	"<![CDATA[" => "",
     	"]]>" => "",
     	"]]&gt;" => "",
     	
     );

     
    function filter($text)
    {
     
     	foreach ($this->badStrings as $key => $value)
     	{
    		$text = str_replace ($key, $value, $text);
    	}
     
    	return $text;
    }
     
    function grab($url)
     {
   	  $DUMP = ROOT . DS . APP_DIR . DS . WEBROOT_DIR . DS . 'img' . DS . 'uploads' . DS . 'grabs' . DS;
	  $TYPES = "jpg|gif|png|jpeg";
	
	  $url = trim($url); 				// Trim off whitespace at the end of the url
	  if (eregi("^.*\.(" . $TYPES . ")$", $url))
	  {
		
		$filename = explode("/",$url);		// Break the filename up into chunks
		$fn = $filename[count($filename) - 1];
		$fn_chunks = explode(".",$fn);
		
		$fileA = "";				// FileA is the first part, ex. foo of foo.bar
		$ch = 0;
	
		foreach($fn_chunks as $chunk)
		{
			if ($ch != ( count($fn_chunks) - 1) )
				$fileA .= $chunk;
			else
				$fileB = $chunk;
			$ch++;
		}
	
		$c = 1;
		$fileAsave = $fileA;
							// Check and see if the file exists
							// If it does, rename the file and check again.
	
		while (file_exists($DUMP . $fileA . "." . $fileB))
		{
				return $fileA . "." . $fileB;
		}
	
		$fn = $fileA . "." . $fileB;		// Final filename.
	
	
		/* write the file to disk */
	
		$f = fopen($DUMP . $fn,"w");
	
		$curl = curl_init($url);
		
		curl_setopt ($curl, CURLOPT_FILE, $f);
		curl_setopt ($curl, CURLOPT_HEADER, 0);
		$curl_result = curl_exec($curl);
	
		curl_close($curl);
		fclose($f);
	
		/* Save the file to the valid array */
	
		return $fn;
	
	  }
	
		/* If we end up here we have an invalid filename */
	  else
      {
		return false;
	  }
   
     }
   
    function channel($url)
    {
   	  $this->defaultImgPath = ROOT . DS . APP_DIR . DS . WEBROOT_DIR . DS . 'img' . DS . 'uploads' . DS . 'grabs' . DS;
   	
   	  $channel = $this->Lastrss->feed($url);

      $imgs = false;
      $i = 0;
      
      if (!empty($channel['items']))
      {
      	 
		      foreach ($channel['items'] as $item)
		      {
		      	 if (isset($item['description']))
      	  			{
				      $html = htmlspecialchars_decode($item['description'], ENT_QUOTES);
				      preg_match_all('/(["\'])?(([^\.]*\.)*?(jpe?|pn)g)\1/', $html, $imgs);
				      foreach ($imgs['2'] as $img)
				      {
				      	if ($name = $this->grab($img))
				      	{
				      		$channel['items'][$i]['description'] = str_replace($img, $this->defaultImgUrl . $name, $html);
				      	}
				      }
				      
				      $channel['items'][$i]['description'] = $this->filter($channel['items'][$i]['description']);
				      $channel['items'][$i]['title'] = $this->filter($channel['items'][$i]['title']);
				      $channel['items'][$i]['link'] = $this->filter($channel['items'][$i]['link']);
				      
				      $i++;
		      		}
      	  		}
      }
   	
      return $channel;
    }
   
 	function show($name = "sk_all")
    {
    	
      function cmpFeedItems($a, $b) { return strtotime($b["pubDate"]) - strtotime($a["pubDate"]); }
     
   	  $feeds = $this->Feed->findAll(array('show'=>'1', 'game_id' => 0, 'source' => 'SK Gaming'));
	  
	  $items = array();
		
		
	  foreach ($feeds as $feed)
	  {
	  	$ch = $this->channel($feed["Feed"]["url"]);
		$chunkOfItems = $ch['items'];
			
		if (!empty($chunkOfItems))
		{
					
		  foreach ($chunkOfItems as $key => $value)
		  	$chunkOfItems[$key]['source'] = $feed["Feed"]["source"];					
				
		  if (!empty($items))
		  	$items = array_merge($items, $chunkOfItems);
		  else
			$items = $chunkOfItems;
		 }				
	   }		
		

	   usort($items, "cmpFeedItems");
	
		   		  
	  
	   $channelData = $items;
      
      
       if(isset($this->params['requested'])) {		 	 
       	return $channelData;
       } 
	   else
	   	$this->set("channel", $channelData);
      
       return true;
    }
     
    function game($game_id = null) 
    {
    	
    	function cmpFeedItems($a, $b) {
		    
	   	 	return strtotime($b["pubDate"]) - strtotime($a["pubDate"]);

		}
		
		if (!$game_id)		
			$feeds = $this->Feed->findAll(array('show'=>'1'), null, 'Feed.game_id');
		else		
			$feeds = $this->Feed->findAll(array('show'=>'1', 'game_id' => $game_id));
		
		$itemsByGame = array();
		$i = 0;
		
		foreach ($feeds as $feed)
		{
			$ch = $this->channel($feed["Feed"]["url"]);
			$chunkOfItems = $ch['items'];
			
			if (!empty($chunkOfItems))
			{
				
				if ($feed["Game"]["id"])
				{
					$id = $feed["Game"]["id"];					
				}
				else
					$id = '0';
					
				foreach ($chunkOfItems as $key => $value)
					$chunkOfItems[$key]['source'] = $feed["Feed"]["source"];					
				
				if (!empty($itemsByGame[$id]["Items"]))
					$itemsByGame[$id]["Items"] = array_merge($itemsByGame[$id]["Items"], $chunkOfItems);
				else
					$itemsByGame[$id]["Items"] = $chunkOfItems;
					
				$itemsByGame[$id]["Game"] = $feed["Game"];
				

				
			}
			$i++;			
		}		

		foreach ($itemsByGame as $key => $item)
		{			
			usort($itemsByGame[$key]["Items"], "cmpFeedItems");
			if ($key != 0 && !$game_id)
				$itemsByGame[$key]["Items"] = array_slice($itemsByGame[$key]["Items"], 0, 6);			
		}
		
		$this->set("items", $itemsByGame);

		$this->contentHelpers = false;		
		$this->titleForContent = '<b>' . __('E-Scene', true) . '</b>';		
    	
    }

   
	function index() {
		
		$this->game();	
				
		$this->titleForContent = '<b>' . __('E-Scene', true) . '</b>';
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid Feed.', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->set('feed', $this->Feed->read(null, $id));
	}

	

	function admin_index() {
		$this->Feed->recursive = 0;
		$this->set('feeds', $this->paginate());
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid Feed.', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->set('feed', $this->Feed->read(null, $id));
	}

	function admin_add() {
		if (!empty($this->data)) {
			$this->Feed->create();
			if ($this->Feed->save($this->data)) {
				$this->Session->setFlash(__('The Feed has been saved', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The Feed could not be saved. Please, try again.', true));
			}
		}
		$games = $this->Feed->Game->find('list');
		$this->set(compact('games'));
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid Feed', true));
			$this->redirect(array('action'=>'index'));
		}
		if (!empty($this->data)) {
			if ($this->Feed->save($this->data)) {
				$this->Session->setFlash(__('The Feed has been saved', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The Feed could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Feed->read(null, $id);
		}
		$games = $this->Feed->Game->find('list');
		$this->set(compact('games'));
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for Feed', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Feed->del($id)) {
			$this->Session->setFlash(__('Feed deleted', true));
			$this->redirect(array('action'=>'index'));
		}
	}

}
?>