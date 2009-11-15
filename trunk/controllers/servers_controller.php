<?php
class ServersController extends AppController {

	var $name = 'Servers';
	var $helpers = array('Html', 'Form', 'Ajax', 'Javascript');	
	var $components = array('Lgsl');
	var $defaultGameId = 2;
	var $lgsl_types = array(
		'Counter-Strike' => 'halflife',
		'Counter-Strike: Source' => 'source',
		'Call of Duty 4' => 'callofduty4',
		'Warcraft 3' => ''
	);
	
	var $paginate = array('Servercomment' => array('limit' => 8, 'page' => 'last'));	
	

	function grab_feed($url, $cacheTimeMinutes)
    {
			
		$fn = ROOT . DS . APP_DIR . DS . 'tmp' . DS . 'cache' . DS . 'servers' . DS . md5($url);		// Final filename.
		
		if (file_exists($fn) && (time() - filemtime($fn) > $cacheTimeMinutes * 60))
		{
			return unserialize(file_get_contents($fn));		
		}
		else
		{

			/* write the file to disk */
		
			$f = fopen($fn,"w");
		
			$curl = curl_init($url);
			
			curl_setopt ($curl, CURLOPT_FILE, $f);
			curl_setopt ($curl, CURLOPT_HEADER, 0);
			$curl_result = curl_exec($curl);
		
			curl_close($curl);
			fclose($f);
		
			/* Save the file to the valid array */
		
			return unserialize(file_get_contents($fn));
		}
					
		 
   
    }
    
	
    function getLgslType($game_id)
    {
    	$game = $this->Server->Game->read(null, $game_id);
    	return $this->lgsl_types[$game['Game']['name']];
    	
    }
    
	function index($id = null) {

		if (isset($this->data['Server']['game_id']))
			$game_id = $this->data['Server']['game_id'];
		else
			$game_id = 2;

		if (isset($this->data['Server']['sort']))
			$sort =  $this->data['Server']['sort'];
		else
			$sort = "players";

			
		if (isset($this->data['Server']['refresh']))
			$refresh = $this->data['Server']['refresh'];
		else
			$refresh = 60;
			
			
			
		
		$this->useAjaxForMonitor = false;
		$this->monitor($game_id, $sort);
		$this->layout = 'skygames';
				
		$games = $this->Server->Game->find('list');
		$this->set('games', $games);
		
		$this->set('game_id', $game_id);		
		$this->set('sort', $sort);
		$this->set('refresh', $refresh);
		
		
		$this->contentHelpers = false;
		
	}
	
	function monitor($game_id = null, $sort = null)
	{
		function cmpServersPlayers($a, $b) { 	 	return $b["Server"]["players"] - $a["Server"]["players"];		}
		function cmpServersPing($a, $b) { 	 	
			$i = 0;
			return $a["Server"]["ping"] - $b["Server"]["ping"];		
		}
		

		$this->layout = 'ajax';
		Configure::write('debug', '0');
		
	
		if (!$game_id)
			$id = $this->defaultGameId;
		else
			$id = $game_id;
		
		
		$servers = $this->Server->findAll(array("game_id" => $id));

		
		foreach ($servers as $key => $srv)
		{
			//$url = "http://module.game-monitor.com/" . $srv["Server"]['ip'] . ":" . $srv["Server"]['port'] . "/data/server.php";			
			//$server = $this->grab_feed($url, $srv["Server"]['cachetime']);
			
					
			$server = $this->Lgsl->get_server($srv["Server"]['ip'],  $srv["Server"]['port'], $this->getLgslType( $srv["Server"]['game_id']));

			if ($server['b']['status'])
			{
				$servers[$key]["Server"]["name"] = $server['s']['name'];
				$servers[$key]["Server"]["ping"] = $server['s']['query_time'];			
				$servers[$key]["Server"]["maxplayers"] = $server['s']['playersmax'];
				$servers[$key]["Server"]["players"] = $server['s']['players'];
				$servers[$key]["Server"]["map"] = $server['s']['map'];
			}
			else
				unset($servers[$key]);
			
		}
		
		if ($sort == "players")
		{
			$i = 0;
			usort($servers, "cmpServersPlayers");
		}
		elseif ($sort == "ms")
		{
			$i = 0;		
			usort($servers, "cmpServersPing");
		}
		
		$this->set('servers', $servers);		
				
		
		
	}
	
	
	function addcomment()
	{
		if (!empty($this->data)) {
			$this->data['Servercomment']['user_id'] = $this->othAuth->user('id');

			$this->Server->Servercomment->create();
			if ($this->Server->Servercomment->save($this->data)) {
				$this->Session->setFlash(__('Comment has been submited', true));		
			} else {
				$this->Session->setFlash(__('Error occured', true));													
			}
			
			$this->redirect(array('action'=>'view', $this->data['Servercomment']['server_id']));										
			exit();		
		}	
		
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid Server.', true));
			$this->redirect(array('action'=>'index'));
		}
		
		$server = $this->Server->read(null, $id);
		
		$info = $this->Lgsl->get_server($server["Server"]['ip'],  $server["Server"]['port'], $this->getLgslType( $server["Server"]['game_id']));
		$players = $this->Lgsl->get_players($server["Server"]['ip'],  $server["Server"]['port'], $this->getLgslType( $server["Server"]['game_id']));
		
		
		$comments = $this->paginate('Servercomment', array('server_id' => $id));
		
		$this->set('server', $server);
		$this->set('players', $players['p']);
		$this->set('info', $info);
		$this->set('comments', $comments);
		
		$this->titleForContent = '<b>' . $info["s"]["name"]  . '</b>';
	}
	


	function admin_index() {
		$this->Server->recursive = 0;
		$this->set('servers', $this->paginate());
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid Server.', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->set('server', $this->Server->read(null, $id));
	}

	function admin_add() {
		if (!empty($this->data)) {
			$this->Server->create();
			if ($this->Server->save($this->data)) {
				$this->Session->setFlash(__('The Server has been saved', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The Server could not be saved. Please, try again.', true));
			}
		}
		$games = $this->Server->Game->find('list');
		$this->set(compact('games'));
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid Server', true));
			$this->redirect(array('action'=>'index'));
		}
		if (!empty($this->data)) {
			if ($this->Server->save($this->data)) {
				$this->Session->setFlash(__('The Server has been saved', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The Server could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Server->read(null, $id);
		}
		$games = $this->Server->Game->find('list');
		$this->set(compact('games'));
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for Server', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Server->del($id)) {
			$this->Session->setFlash(__('Server deleted', true));
			$this->redirect(array('action'=>'index'));
		}
	}

}
?>