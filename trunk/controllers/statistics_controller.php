<?php
class StatisticsController extends AppController {

	var $name = 'Statistics';
	var $helpers = array('Html', 'Form', 'Javascript', 'Ajax');
	var $contentHelpers = false;
	var $uses = array('Event', 'Org', 'Game', 'Statistic');

 

	function select_event() {
	
	  $this->layout = 'ajax';
	  Configure::write('debug', '0');
		
	  if(!empty($this->data['Statistic']['org_id']) || !empty($this->data['Statistic']['game_id'])) {

	  	$condition['conditions']['Event.teamsize >'] = "1";
	  	
	  	if (!empty($this->data['Statistic']['org_id']))
        	$condition['conditions']['Event.org_id'] = $this->data['Statistic']['org_id'];
       	if (!empty($this->data['Statistic']['game_id']))
       		$condition['conditions']['Event.game_id'] = $this->data['Statistic']['game_id'];
        
        $events = $this->Event->find('list', $condition);	  		
	    
	    $this->set('events', $events);
	    
	    if (!empty($this->data['Statistic']['event_id']))
	    	$this->set('selected', $this->data['Statistic']['event_id']);
	
	  }
	
	}
	
	function select_event_players() {
	
	  $this->layout = 'ajax';
	  Configure::write('debug', '0');
		
	  if(!empty($this->data['Statistic']['org_id']) || !empty($this->data['Statistic']['game_id'])) {

	  	$condition['conditions']['Event.teamsize'] = "1";
	  	
	  	if (!empty($this->data['Statistic']['org_id']))
        	$condition['conditions']['Event.org_id'] = $this->data['Statistic']['org_id'];
       	if (!empty($this->data['Statistic']['game_id']))
       		$condition['conditions']['Event.game_id'] = $this->data['Statistic']['game_id'];
        
        $events = $this->Event->find('list', $condition);	  		
	    
	    $this->set('events', $events);
	    
	    if (!empty($this->data['Statistic']['event_id']))
	    	$this->set('selected', $this->data['Statistic']['event_id']);
	
	  }
	
	}
	
 
	function serializeData($data){
    	$result = array();
 
        if (is_array($data)){
            foreach ($data as $values) {
               if (is_array($values)){
                   foreach($values as $name=>$val){
                   		if (!empty($val))
                          	$result[] = sprintf("%s:%s", $name, $val);
                        }
                  } else {
                    if (!empty($values))
                        $result[] = sprintf("%s", $values);
            	}
			}
		}
 
		$result = implode("/", $result);
 
		return $result;
	} 	
	
	function veryBigSelect()
	{
		
		
	}
	
	function teams() {
				
		if (empty($this->data)){
			
            if (!empty($this->params["named"])){
                //unserialize passed params
                $this->data['Statistic'] = $this->params["named"];
            						
			 } 
			 else 
			 {
                $this->data['Statistic']['game_id'] = 1;	
                $this->data['Statistic']['event_id'] = -5;	 	
             }
             
             $event_query = '';
             
            if (!empty($this->data['Statistic']['event_id']) && $this->data['Statistic']['event_id'] < 0)
            {
				$event_query = ' and e.teamsize = '. ($this->data['Statistic']['event_id'] * -1);				
            }
            else
            {
				if (!empty($this->data['Statistic']['event_id']))
					$event_query = ' and matches.event_id = '. $this->data['Statistic']['event_id'];	            	
            }
             			
			$game_query = '';
			$org_query = '';
			
			if (!empty($this->data['Statistic']['game_id']))
				$game_query = ' and e.game_id = '. $this->data['Statistic']['game_id'];
		
		
			if (!empty($this->data['Statistic']['org_id']))
				$org_query = ' and e.org_id = '. $this->data['Statistic']['org_id'];
										
				
	
			
		
			
			$stats = $this->Statistic->query("select * from (select stat2.won as won, stat2.lost as lost, stat1.maps_count as maps_count, stat1.matches_count as matches_count, stat1.events as events_count, stat1.frags as frags, stat1.deaths as deaths, stat1.name as name, 
																TRUNCATE(stat2.won / stat1.matches_count * 100, 2) as eff	from
												(select count(DISTINCT map_id) as maps_count, COUNT(*) as matches_count, SUM(frags) as frags, SUM(deaths) as deaths, name, id, COUNT(DISTINCT event_id) as events from
												(select results.team1_score as frags, results.team2_score as deaths, results.map_id, t1.name, t1.id, matches.event_id  from results left join matchparts on results.matchpart_id = matchparts.id
																				left join matches on results.match_id = matches.id
																				left join teams t1 on matches.team1_id = t1.id
																				left join events e on matches.event_id = e.id											
												 where t1.type != 'solo' and matchparts.final = 1".$event_query."".$game_query."".$org_query."
												union all
												select results.team2_score as frags, results.team1_score as deaths, results.map_id, t2.name, t2.id, matches.event_id  from results left join matchparts on results.matchpart_id = matchparts.id
																				left join matches on results.match_id = matches.id
																				left join teams t2 on matches.team2_id = t2.id
																				left join events e on matches.event_id = e.id
																				
												 where t2.type != 'solo' and matchparts.final = 1".$event_query."".$game_query."".$org_query.") total group by name
												 ) 
												 stat1
												join
												(select SUM(won) as won, SUM(lost) as lost, id from(
												select SUM(1) as won, results.map_id, 0 as lost, t1.name, t1.id  from results left join matchparts on results.matchpart_id = matchparts.id
																				left join matches on results.match_id = matches.id
																				left join teams t1 on matches.team1_id = t1.id
																				left join events e on matches.event_id = e.id
																			
												 where t1.type != 'solo' and matchparts.final = 1".$event_query."".$game_query."".$org_query." and results.team1_score > results.team2_score group by t1.id, t1.name
												union all
												select 0 as won, results.map_id, SUM(1) as lost, t1.name, t1.id  from results left join matchparts on results.matchpart_id = matchparts.id
																				left join matches on results.match_id = matches.id
																				left join teams t1 on matches.team1_id = t1.id
																				left join events e on matches.event_id = e.id
																			
												 where t1.type != 'solo' and matchparts.final = 1".$event_query."".$game_query."".$org_query." and results.team1_score < results.team2_score group by t1.id, t1.name
												union all
												select SUM(1) as won, results.map_id, 0 as lost, t2.name, t2.id  from results left join matchparts on results.matchpart_id = matchparts.id
																				left join matches on results.match_id = matches.id
																				left join teams t2 on matches.team2_id = t2.id
																				left join events e on matches.event_id = e.id
																			
												 where t2.type != 'solo' and matchparts.final = 1".$event_query."".$game_query."".$org_query." and results.team2_score > results.team1_score group by t2.id, t2.name
												union all
												select 0 as won, results.map_id, SUM(1) as lost, t2.name, t2.id  from results left join matchparts on results.matchpart_id = matchparts.id
																				left join matches on results.match_id = matches.id
																				left join teams t2 on matches.team2_id = t2.id
																				left join events e on matches.event_id = e.id
																				
												 where t2.type != 'solo' and matchparts.final = 1".$event_query."".$game_query."".$org_query." and results.team2_score < results.team1_score group by t2.id, t2.name
												 )
												total group by name) stat2 
												on stat1.id = stat2.id) Statistic order by eff desc");
			
			
			$this->contentHelpers = false;
										
				
			
        } 
        else 
        {
            //serialize and redirect
            $searchParams = $this->serializeData($this->data);
            $this->redirect(array("action"=>"teams", $searchParams));
        } 
        
        $this->set('statistics', $stats);
        
        $condition['conditions']['Event.teamsize >'] = "1";
		
        if (!empty($this->data['Statistic']['org_id']))
        	$condition['conditions']['Event.org_id'] = $this->data['Statistic']['org_id'];
       	if (!empty($this->data['Statistic']['game_id']))
       		$condition['conditions']['Event.game_id'] = $this->data['Statistic']['game_id'];
        
        $events = $this->Event->find('list', $condition);
		
					
		$orgs = $this->Org->find('list');
		$games = $this->Game->find('list');		
		
		$this->set('events', $events);
		$this->set('orgs', $orgs);
		$this->set('games', $games);	
						
			
		$this->titleForContent = '<b>' . __('Teams statistics', true) . '</b>';
		
		
	}
	
	
	function players() {
				
		if (empty($this->data)){
			
            if (!empty($this->params["named"])){
                //unserialize passed params
                $this->data['Statistic'] = $this->params["named"];
            						
			 } 
			 else 
			 {
                $this->data['Statistic']['game_id'] = 1;		 	
             }
             
             $event_query = '';
             
            if (!empty($this->data['Statistic']['event_id']) && $this->data['Statistic']['event_id'] < 0)
            {
				$event_query = ' and e.teamsize = '. ($this->data['Statistic']['event_id'] * -1);				
            }
            else
            {
				if (!empty($this->data['Statistic']['event_id']))
					$event_query = ' and matches.event_id = '. $this->data['Statistic']['event_id'];	            	
            }
             			
			$game_query = '';
			$org_query = '';
			
			if (!empty($this->data['Statistic']['game_id']))
				$game_query = ' and e.game_id = '. $this->data['Statistic']['game_id'];
		
		
			if (!empty($this->data['Statistic']['org_id']))
				$org_query = ' and e.org_id = '. $this->data['Statistic']['org_id'];
										
				
	
			
		
			
			$stats = $this->Statistic->query("select * from (select stat2.won as won, stat2.lost as lost, stat1.maps_count as maps_count, stat1.matches_count as matches_count, stat1.events as events_count, stat1.frags as frags, stat1.deaths as deaths, stat1.name as name, 
																TRUNCATE(stat2.won / stat1.matches_count * 100, 2) as eff	from
												(select count(DISTINCT map_id) as maps_count, COUNT(*) as matches_count, SUM(frags) as frags, SUM(deaths) as deaths, name, id, COUNT(DISTINCT event_id) as events from
												(select results.team1_score as frags, results.team2_score as deaths, results.map_id, t1.name, t1.id, matches.event_id  from results left join matchparts on results.matchpart_id = matchparts.id
																				left join matches on results.match_id = matches.id
																				left join teams t1 on matches.team1_id = t1.id
																				left join events e on matches.event_id = e.id											
												 where t1.type = 'solo' and matchparts.final = 1".$event_query."".$game_query."".$org_query."
												union all
												select results.team2_score as frags, results.team1_score as deaths, results.map_id, t2.name, t2.id, matches.event_id  from results left join matchparts on results.matchpart_id = matchparts.id
																				left join matches on results.match_id = matches.id
																				left join teams t2 on matches.team2_id = t2.id
																				left join events e on matches.event_id = e.id
																				
												 where t2.type = 'solo' and matchparts.final = 1".$event_query."".$game_query."".$org_query.") total group by name
												 ) 
												 stat1
												join
												(select SUM(won) as won, SUM(lost) as lost, id from(
												select SUM(1) as won, results.map_id, 0 as lost, t1.name, t1.id  from results left join matchparts on results.matchpart_id = matchparts.id
																				left join matches on results.match_id = matches.id
																				left join teams t1 on matches.team1_id = t1.id
																				left join events e on matches.event_id = e.id
																			
												 where t1.type = 'solo' and matchparts.final = 1".$event_query."".$game_query."".$org_query." and results.team1_score > results.team2_score group by t1.id, t1.name
												union all
												select 0 as won, results.map_id, SUM(1) as lost, t1.name, t1.id  from results left join matchparts on results.matchpart_id = matchparts.id
																				left join matches on results.match_id = matches.id
																				left join teams t1 on matches.team1_id = t1.id
																				left join events e on matches.event_id = e.id
																			
												 where t1.type = 'solo' and matchparts.final = 1".$event_query."".$game_query."".$org_query." and results.team1_score < results.team2_score group by t1.id, t1.name
												union all
												select SUM(1) as won, results.map_id, 0 as lost, t2.name, t2.id  from results left join matchparts on results.matchpart_id = matchparts.id
																				left join matches on results.match_id = matches.id
																				left join teams t2 on matches.team2_id = t2.id
																				left join events e on matches.event_id = e.id
																			
												 where t2.type = 'solo' and matchparts.final = 1".$event_query."".$game_query."".$org_query." and results.team2_score > results.team1_score group by t2.id, t2.name
												union all
												select 0 as won, results.map_id, SUM(1) as lost, t2.name, t2.id  from results left join matchparts on results.matchpart_id = matchparts.id
																				left join matches on results.match_id = matches.id
																				left join teams t2 on matches.team2_id = t2.id
																				left join events e on matches.event_id = e.id
																				
												 where t2.type = 'solo' and matchparts.final = 1".$event_query."".$game_query."".$org_query." and results.team2_score < results.team1_score group by t2.id, t2.name
												 )
												total group by name) stat2 
												on stat1.id = stat2.id) Statistic order by eff desc");
			
			
			$this->contentHelpers = false;
										
				
			
        } 
        else 
        {
            //serialize and redirect
            $searchParams = $this->serializeData($this->data);
            $this->redirect(array("action" => "players", $searchParams));
        } 
        
        $this->set('statistics', $stats);
		
        $condition['conditions']['Event.teamsize'] = "1";
        
        if (!empty($this->data['Statistic']['org_id']))
        	$condition['conditions']['Event.org_id']['org_id'] = $this->data['Statistic']['org_id'];
       	if (!empty($this->data['Statistic']['game_id']))
       		$condition['conditions']['Event.game_id']['game_id'] = $this->data['Statistic']['game_id'];
        
        $events = $this->Event->find('list', $condition);
		
					
		$orgs = $this->Org->find('list');
		$games = $this->Game->find('list');		
		
		$this->set('events', $events);
		$this->set('orgs', $orgs);
		$this->set('games', $games);	
						
			
		$this->titleForContent = '<b>' . __('Players statistics', true) . '</b>';
		
		
	}
	
	function index()
	{
		$this->setAction('teams');
	}
	
	function events($id = null) {
				
		
		$event_query = '';
		if ($id != null)
			$event_query = ' and matches.event_id = '. $id;
		
		$stats = $this->Statistic->query("select * from (select stat2.won as won, stat2.lost as lost, stat1.maps_count as maps_count, stat1.matches_count as matches_count, stat1.events as events_count, stat1.frags as frags, stat1.deaths as deaths, stat1.name as name, 
															TRUNCATE(stat2.won / stat1.matches_count * 100, 2) as eff	from
											(select count(DISTINCT map_id) as maps_count, COUNT(*) as matches_count, SUM(frags) as frags, SUM(deaths) as deaths, name, id, COUNT(DISTINCT event_id) as events from
											(select results.team1_score as frags, results.team2_score as deaths, results.map_id, t1.name, t1.id, matches.event_id  from results left join matchparts on results.matchpart_id = matchparts.id
																			left join matches on results.match_id = matches.id
																			left join teams t1 on matches.team1_id = t1.id
											 where matchparts.final = 1".$event_query."
											union all
											select results.team2_score as frags, results.team1_score as deaths, results.map_id, t2.name, t2.id, matches.event_id  from results left join matchparts on results.matchpart_id = matchparts.id
																			left join matches on results.match_id = matches.id
																			left join teams t2 on matches.team2_id = t2.id
											 where matchparts.final = 1".$event_query.") total group by name
											 ) 
											 stat1
											join
											(select SUM(won) as won, SUM(lost) as lost, id from(
											select SUM(1) as won, results.map_id, 0 as lost, t1.name, t1.id  from results left join matchparts on results.matchpart_id = matchparts.id
																			left join matches on results.match_id = matches.id
																			left join teams t1 on matches.team1_id = t1.id
											 where matchparts.final = 1".$event_query." and results.team1_score > results.team2_score group by t1.id, t1.name
											union all
											select 0 as won, results.map_id, SUM(1) as lost, t1.name, t1.id  from results left join matchparts on results.matchpart_id = matchparts.id
																			left join matches on results.match_id = matches.id
																			left join teams t1 on matches.team1_id = t1.id
											 where matchparts.final = 1".$event_query." and results.team1_score < results.team2_score group by t1.id, t1.name
											union all
											select SUM(1) as won, results.map_id, 0 as lost, t2.name, t2.id  from results left join matchparts on results.matchpart_id = matchparts.id
																			left join matches on results.match_id = matches.id
																			left join teams t2 on matches.team2_id = t2.id
											 where matchparts.final = 1".$event_query." and results.team2_score > results.team1_score group by t2.id, t2.name
											union all
											select 0 as won, results.map_id, SUM(1) as lost, t2.name, t2.id  from results left join matchparts on results.matchpart_id = matchparts.id
																			left join matches on results.match_id = matches.id
																			left join teams t2 on matches.team2_id = t2.id
											 where matchparts.final = 1".$event_query." and results.team2_score < results.team1_score group by t2.id, t2.name
											 )
											total group by name) stat2 
											on stat1.id = stat2.id) Statistic order by eff desc");
		
		
		$this->contentHelpers = false;
		
		if(isset($this->params['requested'])) {		 	 
             return $stats;
        } 
		else
		{

				
			$this->set('statistics', $stats);
			

		}
	}

	function admins()
	{
		if (empty($this->data)){
			
            if (!empty($this->params["named"])){
                $this->data['Statistic'] = $this->params["named"];
            						
			} 
		
             
            
            $condition1 = "";
			$condition2 = "";
								
			
			if (!empty($this->params['named']['org_id']))
			{
				$condition1 = 'join events e on m.event_id = e.id where e.org_id = ' . $this->params['named']['org_id'];
				$condition2 = ' and e.org_id = ' . $this->params['named']['org_id'];
			}
				 
			if (!empty($this->params['named']['game_id']))
			{				
				$condition1 .= ($condition1 ? ' and' : 'join events e on m.event_id = e.id where') . ' e.game_id = ' . $this->params['named']['game_id'];
				$condition2 .= ' and e.game_id = ' . $this->params['named']['game_id'];
			}
			
			$stats = $this->Statistic->query( "select username, user_id, matches, events from
			(select username,totalmatches.id 'user_id', matches
			, Count(e.id) as 'events'
			from
			(
			select u.username, u.id, SUM(emcount.matchescount) as 'matches'
			from
			(
			
			select COUNT(m.id) as 'matchescount', u.user_id as 'user_id' from staffs u left join matches m on m.user_id = u.user_id  
			" . $condition1 . "
			group by u.user_id
			
			union all
			
			select COUNT(m.id) as 'matchescount', e.user_id as 'user_id' from events e left join matches m on m.event_id = e.id 
			where m.user_id IS NULL " . $condition2 . "
			group by e.id, m.user_id
			
			) emcount left join  users u 
			on u.id = emcount.user_id group by u.id
			)
			totalmatches
			left join events e on totalmatches.id = e.user_id
			".$condition2 ."
			group by totalmatches.id order by totalmatches.matches desc) Statistic");
				
			
			$this->contentHelpers = false;
										
				
			
        } 
        else 
        {
            //serialize and redirect
            $searchParams = $this->serializeData($this->data);
            $this->redirect(array("action" => "admins", $searchParams));
        } 
        
        $this->set('stats', $stats);
		
	
					
		$orgs = $this->Org->find('list');
		$games = $this->Game->find('list');		
				
		$this->set('orgs', $orgs);
		$this->set('games', $games);	
						
			
		$this->titleForContent = '<b>' . __('Admins statistics', true) . '</b>';
		
	}
	
	function orgs()	
	{
		$condition1 = "";
		$condition2 = "";
		
		$org_id = $this->params['named']['org_id'];
		$game_id = $this->params['named']['game_id'];
		
		if (!empty($org_id))
		{
			
			$condition1 = 'join events e on m.event_id = e.id where e.org_id = ' . $org_id;
			$condition2 = ' and e.org_id = ' . $org_id;
		}
			 
		if (!empty($game_id))
		{
			$condition1 .= ($condition1 ? ' and' : 'join events e on m.event_id = e.id where') . ' e.game_id = ' . $game_id;
			$condition2 .= ' and e.game_id = ' . $game_id;
		}
		
		$stats = $this->Statistic->query( 
		"select username, user_id, matches, events from
			(select username,totalmatches.id 'user_id', matches, Count(e.id) as 'events' from
				(
				select u.username, u.id, SUM(emcount.matchescount) as 'matches' from
					(	select COUNT(m.id) as 'matchescount', u.user_id as 'user_id' from staffs u left join matches m on m.user_id = u.user_id  
						" . ($condition1 ? $condition1 . " and " : "where ") . "u.status = 'member'" . "
						group by u.user_id
		
						union all
		
						select COUNT(m.id) as 'matchescount', e.user_id as 'user_id' from events e left join matches m on m.event_id = e.id 
						where m.user_id IS NULL " . $condition2 . "
						group by e.id, m.user_id
		
					) emcount left join  users u on u.id = emcount.user_id group by u.id
				) totalmatches
			left join events e on totalmatches.id = e.user_id
			".$condition2 ."
			group by totalmatches.id order by totalmatches.matches desc) Statistic");
		

		
		$this->contentHelpers = false;
		
		if(isset($this->params['requested'])) {		 	 
             return $stats;
        } 
		else
		$this->set('statistics', $stats);
	}
	
}
?>