<?php
class ResultsController extends AppController {

	var $name = 'Results';
	var $helpers = array('Html', 'Form', 'OthAuth', 'Paginator', 'Ajax', 'Javascript', 'Session');
	var $paginate = array('limit' => 15, 'page' => 1);
	var $uses = array('Result', 'Match');

	/*
	 function index($match_id = null, $map_id = null) {
		//$this->params['pass'] = $this->params['named'];
		$this->Result->recursive = 0;
		$this->set('results', $this->paginate('Result', array('match_id' => $match_id)));
		}
		*/

	function view($id = null) {
		if (!$id) {
			$this->flash(__('Invalid Result', true), array('action'=>'index'));
		}
		$this->set('result', $this->Result->read(null, $id));
	}

	function generateFollowUpMatches($match)
	{

		if ($match["Playofftable"]["type"] == "S")
		{
			$tposition_xUpper = $match["Match"]["tposition_x"];
				
			$winTeamsUpper = array();
				
			//	Get expected final results count on upper brackets of current x round
			$neighbourResultsUpper = $this->Result->findAll(array("matchpart_id" => "1", "Match.tposition_x" => $tposition_xUpper, "Match.playofftable_id" => $match["Match"]["playofftable_id"]), null, "tposition_y ASC");
			$neighbourCountUpper =  count($neighbourResultsUpper);
			$tposition_x_reversedUpper = log($match["Playofftable"]["size"], 2) + 1 - $tposition_xUpper;
			$expectedUpper = pow(2, $tposition_x_reversedUpper) / 2;
				
			//	Update upper
			if ($neighbourCountUpper == $expectedUpper)
			{
				foreach ($neighbourResultsUpper as $r)
				{
					if ($r["Result"]["team1_score"] > $r["Result"]["team2_score"])
					{
						$winTeamsUpper[] = $r["Match"]["team1_id"];
					}
					elseif ($r["Result"]["team1_score"] < $r["Result"]["team2_score"])
					{
						$winTeamsUpper[] = $r["Match"]["team2_id"];
					}
					else
					{
						$this->Session->setFlash(__('Draw found in final result, cannot generate', true));
						$this->redirect(array('controller'=>'match','action'=>'view', $match["Match"]["id"]));
						exit();
					}
				}

				$i = 1;
				for ($n=0;$n<=count($winTeamsUpper)-2;$n=$n+2)
				{
					$m["Match"] = $match["Match"];
					$m["Match"]["id"] = "";
					$m["Match"]["team1_id"] = $winTeamsUpper[$n];
					$m["Match"]["team2_id"] = $winTeamsUpper[$n + 1];
					$m["Match"]["tposition_x"] = $tposition_xUpper + 1;
					$m["Match"]["tposition_y"] = $i;
					$this->Result->Match->save($m);
					$i++;
				}

			}
		}

		if ($match["Playofftable"]["type"] == "D")
		{
			//	Get x positions of lower and upper brackets of current match
			if ($match["Match"]["tposition_x"] > 0)
			{
				$tposition_xUpper = $match["Match"]["tposition_x"];
				if ($tposition_xUpper != 1)
				$tposition_xLower = ($tposition_xUpper * 2 - 3) * - 1;
				else
				$tposition_xLower = 0;
			}
			else
			{
				$tposition_xLower =  $match["Match"]["tposition_x"];
				$tposition_xUpper = ceil(((($tposition_xLower - 1 ) / - 1) + 1) / 2);

			}
				
			$winTeamsUpper = array();
			$winTeamsLower = array();
			$looseTeamsUpper = array();
				
			//	Get expected final results count on upper brackets of current x round
			$neighbourResultsUpper = $this->Result->findAll(array("matchpart_id" => "1", "Match.tposition_x" => $tposition_xUpper, "Match.playofftable_id" => $match["Match"]["playofftable_id"]), null, "tposition_y ASC");
			$neighbourCountUpper =  count($neighbourResultsUpper);
			$tposition_x_reversedUpper = log($match["Playofftable"]["size"], 2) + 1 - $tposition_xUpper;
			$expectedUpper = pow(2, $tposition_x_reversedUpper) / 2;
				
				
			//	Get expected final results count on lower brackets of current lower (loser) x round
			$neighbourResultsLower = $this->Result->findAll(array("matchpart_id" => "1", "Match.tposition_x" => $tposition_xLower, "Match.playofftable_id" => $match["Match"]["playofftable_id"]), null, "tposition_y ASC");
			$neighbourCountLower = count($neighbourResultsLower);
			$tposition_x_reversedLower = log($match["Playofftable"]["size"], 2) + 1 - ceil(($tposition_xLower * -1)/ 2);
			$expectedLower = (pow(2, $tposition_x_reversedLower) / 2) / 2;
			//$tposition_xLowerTarget = $tposition_xLower - 1;
				
				
			//	Update lower only (or looser final)
			if ($tposition_xLower % 2 == 0 && $tposition_xUpper != 1 && ($expectedLower == $neighbourCountLower))
			{

				foreach ($neighbourResultsLower as $r)
				{
					if ($r["Result"]["team1_score"] > $r["Result"]["team2_score"])
					{
						$winTeamsLower[] = $r["Match"]["team1_id"];
					}
					elseif ($r["Result"]["team1_score"] < $r["Result"]["team2_score"])
					{
						$winTeamsLower[] = $r["Match"]["team2_id"];
					}
					else
					{
						$this->Session->setFlash(__('Draw found in final result, cannot generate', true));
						$this->redirect(array('controller'=>'match','action'=>'view', $match["Match"]["id"]));
						exit();
					}
				}
					
					
				//	next round is final
				if ($expectedLower == 1)
				{
					foreach ($neighbourResultsUpper as $r)
					{
						if ($r["Result"]["team1_score"] > $r["Result"]["team2_score"])
						{
							$winTeamsUpper[] = $r["Match"]["team1_id"];
							$looseTeamsUpper[] = $r["Match"]["team2_id"];
						}
						elseif ($r["Result"]["team1_score"] < $r["Result"]["team2_score"])
						{
							$winTeamsUpper[] = $r["Match"]["team2_id"];
							$looseTeamsUpper[] = $r["Match"]["team1_id"];
						}
						else
						{
							$this->Session->setFlash(__('Draw found in final result, cannot generate', true));
							$this->redirect(array('controller'=>'match','action'=>'view', $match["Match"]["id"]));
							exit();
						}
					}

					$m["Match"] = $match["Match"];
					$m["Match"]["id"] = "";
					$m["Match"]["team1_id"] = $winTeamsLower[0];
					$m["Match"]["team2_id"] = $winTeamsUpper[0];
					$m["Match"]["tposition_x"] = 0;
					$m["Match"]["tposition_y"] = 0;
					$this->Result->Match->save($m);
					$i++;

				}
					
				$i = 1;
				for ($n=0;$n<=count($winTeamsLower)-2;$n=$n+2)
				{
					$m["Match"] = $match["Match"];
					$m["Match"]["id"] = "";
					$m["Match"]["team1_id"] = $winTeamsLower[$n];
					$m["Match"]["team2_id"] = $winTeamsLower[$n + 1];
					$m["Match"]["tposition_x"] = $tposition_xLower - 1;
					$m["Match"]["tposition_y"] = $i;
					$this->Result->Match->save($m);
					$i++;
				}
					
					
			}
				
				
			//	Update upper and lower
			if ((($tposition_xLower == 0) && ($neighbourCountUpper == $expectedUpper) && $tposition_xUpper != 0 ) || (($tposition_xLower % 2 != 0) && ($neighbourCountUpper == $expectedUpper) && ($neighbourCountLower == $expectedLower) && $tposition_xUpper != 0))
			{
				foreach ($neighbourResultsUpper as $r)
				{
					if ($r["Result"]["team1_score"] > $r["Result"]["team2_score"])
					{
						$winTeamsUpper[] = $r["Match"]["team1_id"];
						$looseTeamsUpper[] = $r["Match"]["team2_id"];
					}
					elseif ($r["Result"]["team1_score"] < $r["Result"]["team2_score"])
					{
						$winTeamsUpper[] = $r["Match"]["team2_id"];
						$looseTeamsUpper[] = $r["Match"]["team1_id"];
					}
					else
					{
						$this->Session->setFlash(__('Draw found in final result, cannot generate', true));
						$this->redirect(array('controller'=>'match','action'=>'view', $match["Match"]["id"]));
						exit();
					}
				}

				if ($tposition_xUpper != 1)
				{
					foreach ($neighbourResultsLower as $r)
					{
						if ($r["Result"]["team1_score"] > $r["Result"]["team2_score"])
						{
							$winTeamsLower[] = $r["Match"]["team1_id"];
						}
						elseif ($r["Result"]["team1_score"] < $r["Result"]["team2_score"])
						{
							$winTeamsLower[] = $r["Match"]["team2_id"];
						}
						else
						{
							$this->Session->setFlash(__('Draw found in final result, cannot generate', true));
							$this->redirect(array('controller'=>'match','action'=>'view', $match["Match"]["id"]));
							exit();
						}
					}
				}

				$i = 1;
				for ($n=0;$n<=count($winTeamsUpper)-2;$n=$n+2)
				{
					$m["Match"] = $match["Match"];
					$m["Match"]["id"] = "";
					$m["Match"]["team1_id"] = $winTeamsUpper[$n];
					$m["Match"]["team2_id"] = $winTeamsUpper[$n + 1];
					$m["Match"]["tposition_x"] = $tposition_xUpper + 1;
					$m["Match"]["tposition_y"] = $i;
					$this->Result->Match->save($m);
					$i++;
				}


				if ($tposition_xUpper != 1)
				{
					$i = 1;
					for ($n=0;$n<=count($winTeamsLower)-1;$n=$n+1)
					{
						$m["Match"] = $match["Match"];
						$m["Match"]["id"] = "";
						$m["Match"]["team1_id"] = $winTeamsLower[$n];
						$m["Match"]["team2_id"] = $looseTeamsUpper[$n];
						$m["Match"]["tposition_x"] = $tposition_xLower - 1;
						$m["Match"]["tposition_y"] = $i;
						$this->Result->Match->save($m);
						$i++;
					}
				}
				else
				{
					$i = 1;
					for ($n=0;$n<=count($looseTeamsUpper)-2;$n=$n+2)
					{
						$m["Match"] = $match["Match"];
						$m["Match"]["id"] = "";
						$m["Match"]["team1_id"] = $looseTeamsUpper[$n];
						$m["Match"]["team2_id"] = $looseTeamsUpper[$n + 1];
						$m["Match"]["tposition_x"] = $tposition_xLower - 1;
						$m["Match"]["tposition_y"] = $i;
						$this->Result->Match->save($m);
						$i++;
					}
				}
			}

		}




	}

	function add($match_id = null) {



		$this->layout = 'popup';
		Configure::write('debug', '0');

		if (!$match_id && !$this->data["Result"]["match_id"])
		{
			$this->Session->setFlash(__('Wrong match id', true));
			$this->redirect(array('controller'=>'matches','action'=>'view', $this->data["Result"]["match_id"]));
			exit();
		}

		if ($this->data["Result"]["matchpart_id"] == 1 && count($this->Result->findAll(array("matchpart_id" => "1", "match_id" => $this->data["Result"]["match_id"]))) > 0)
		{
			$this->Session->setFlash(__('You can not add second final result', true));
			$this->redirect(array('controller'=>'matches','action'=>'view', $this->data["Result"]["match_id"]));
			exit();
		}

		if (!empty($this->data)) {
			//$this->data["Match"]["id"] = $this->data["Result"]["match_id"];
			//$this->data["Match"]["date"] = date("Y.m.d H:m:s");
			$this->Result->create();
			if ($this->Result->save($this->data)) {

				$match = $this->Result->Match->read(null, $this->data["Result"]["match_id"]);

				if ($this->data["Result"]["matchpart_id"] == 1)
				{
					/* Start betts */
						
					$winTeamId = ($this->data["Result"]["team1_score"] > $this->data["Result"]["team2_score"] ?
					$match["Match"]["team1_id"] :	$match["Match"]["team2_id"]
					);
						
					$looseTeamId = ($this->data["Result"]["team1_score"] > $this->data["Result"]["team2_score"] ?
					$match["Match"]["team2_id"] :	$match["Match"]["team1_id"]
					);
						
					//	Update odds
						
					$this->Result->query("
					
							update betts b set b.odds = 
							(
								select claim from
								(
									select (stake.sum / winsum * lostsum) / stake.sum as claim, id, bid from 
							
									(select sum(team1_users.sum) winsum from 
									(select betts.sum from users join betts on users.id = betts.user_id where betts.match_id = ".$this->data["Result"]["match_id"]."
									and betts.team_id = ".$winTeamId.") team1_users
									) win
							
									join
							
									(select sum(team1_users.sum) lostsum from 
									(select betts.sum from users join betts on users.id = betts.user_id where betts.match_id = ".$this->data["Result"]["match_id"]."
									and betts.team_id = ".$looseTeamId.") team1_users
									) lost
							
									join 
							
									(select users.id, users.name, betts.sum, betts.id as bid from users join betts on users.id = betts.user_id where betts.match_id = ".$this->data["Result"]["match_id"]."
									and betts.team_id = ".$winTeamId."
									) stake
								) odds
								where odds.bid = b.id
							)						
							where b.match_id = ".$this->data["Result"]["match_id"]." and b.team_id = ".$winTeamId." and b.claimed != 1
	
					");
						
					//	Update sums
						
					$this->Result->query("update betts b set b.won = sum * b.odds + sum
											where b.match_id = ".$this->data["Result"]["match_id"]." and b.team_id = ".$winTeamId." and b.claimed != 1");
						
					//	Update claims - user points
						
					$this->Result->query("
								update users u set 
									u.points = u.points + 
									(
									select sum(won) from betts where betts.team_id = ".$winTeamId." and betts.match_id = ".$this->data["Result"]["match_id"]." and betts.claimed != 1
									and betts.user_id = u.id
									group by betts.user_id 
									)
									where u.id in
									(
									select betts.user_id from betts where betts.team_id = ".$winTeamId." and betts.match_id = ".$this->data["Result"]["match_id"]." and betts.claimed != 1
									)
					");
						
					//	Update bett status
						
					$this->Result->query("
						update betts b set 
						b.claimed = 1
						where b.team_id = ".$winTeamId." and b.match_id = ".$this->data["Result"]["match_id"]."");
						
					/* End betts */
				}
					

				if ($this->data["Result"]["matchpart_id"] == 1  && !($match["Match"]["tposition_x"] == 0 && $match["Match"]["tposition_y"] == 0)
				&& count($match['Playofftable']) > 0)
				$this->generateFollowUpMatches($match);
					
				$this->Session->setFlash(__('Result saved', true));
				$this->redirect(array('controller'=>'results','action'=>'add', $this->data["Result"]["match_id"]));
				exit();
			}
			else
			{
				$this->Session->setFlash(__('Error', true));
				$this->redirect(array('controller'=>'results','action'=>'add', $this->data["Result"]["match_id"]));
				exit();
			}
		}

		if ($match_id != null)
		{
			$match = $this->Result->Match->read(null, $match_id);
		}

		if (count($match["Result"]) > 0)
		$matchparts = $this->Result->Matchpart->find('list');
		else
		$matchparts = $this->Result->Matchpart->find('list', array('limit' => '1'));
			
		$maps = $this->Result->Map->find('list');

		$this->set(compact('matchparts', 'match', 'maps'));

		$this->titleForContent = __("Match", true) . ' <b>' . $match["Team1"]["name"] . '</b>' . ' vs ' . '<b>' . $match["Team2"]["name"] .  '</b> (' . $match["Event"]["name"] . ')';

	}

	function edit($id = null) {

		$this->layout = 'popup';
		Configure::write('debug', '0');

		if (!$id && empty($this->data)) {
			$this->flash(__('Invalid Result', true), array('action'=>'index'));
			exit();
		}
		if (!empty($this->data)) {
			if ($this->Result->save($this->data)) {
				$this->Session->setFlash(__('Result saved', true));
				$this->redirect(array('controller'=>'results','action'=>'add', $this->data["Result"]["match_id"]));
				exit();
			} else {
				$this->Session->setFlash(__('Error', true));
				$this->redirect(array('controller'=>'results','action'=>'edit', $this->data["Result"]["match_id"]));
				exit();
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Result->read(null, $id);
			$match = $this->Result->Match->read(null, $this->data["Result"]["match_id"]);
		}

			
		$matchparts = $this->Result->Matchpart->find('list');
		$maps = $this->Result->Map->find('list');
		$this->set(compact('matchparts','matches','maps', 'match'));

		$this->titleForContent = __("Match", true) . ' <b>' . $match["Team1"]["name"] . '</b>' . ' vs ' . '<b>' . $match["Team2"]["name"] .  '</b> (' . $match["Event"]["name"] . ')';
	}

	function delete($id = null, $match_id = null) {
		if (!$id) {
			$this->flash(__('Invalid Result', true));
		}
		if ($this->Result->del($id)) {
			//$this->flash(__('Result deleted.', true), array('action'=>'add', $match_id ));
			$this->Session->setFlash(__('Result deleted', true));
			$this->redirect(array('controller'=>'results','action'=>'add', $match_id));
		}
	}


	function admin_index() {
		$this->Result->recursive = 0;
		$this->set('results', $this->paginate());
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->flash(__('Invalid Result', true), array('action'=>'index'));
		}
		$this->set('result', $this->Result->read(null, $id));
	}

	function admin_add() {
		if (!empty($this->data)) {
			$this->Result->create();
			if ($this->Result->save($this->data)) {
				$this->flash(__('Result saved.', true), array('action'=>'index'));
				exit();
			} else {
			}
		}
		$matchparts = $this->Result->Matchpart->find('list');
		$matches = $this->Result->Match->findAll('');


		foreach ($matches as $id => $match)
		$matchlist[$match['Match']['id']] = $match['Team1']['name'] . " vs. " . $match['Team2']['name'];
			

		$maps = $this->Result->Map->find('list');

		$this->set('matches', $matchlist);
		$this->set('matchparts', $matchparts);
		$this->set('maps', $maps);
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->flash(__('Invalid Result', true), array('action'=>'index'));
			exit();
		}
		if (!empty($this->data)) {
			if ($this->Result->save($this->data)) {
				$this->flash(__('The Result has been saved.', true), array('action'=>'index'));
				exit();
			} else {
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Result->read(null, $id);
		}
		$matchparts = $this->Result->Matchpart->find('list');
		$matches = $this->Result->Match->find('list');
		$maps = $this->Result->Map->find('list');
		$this->set(compact('matchparts','matches','maps'));
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->flash(__('Invalid Result', true), array('action'=>'index'));
		}
		if ($this->Result->del($id)) {
			$this->flash(__('Result deleted', true), array('action'=>'index'));
		}
	}

}
?>