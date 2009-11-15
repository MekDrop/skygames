<?php
class FilterComponent extends Object {


	function formatConditions($searchParams = array(), $post, $get)
	{
		if (!empty($searchParams))
		{
			foreach ($searchParams as $param)
			{
				if (!empty($post['game_id']))
				$conditions['game_id'] = $post['game_id'];
				elseif (!empty($this->params['named']['game_id']))
				{
					$post['game_id'] = $this->params['named']['game_id'];
					$conditions['game_id'] = $this->params['named']['game_id'];
				}
			}
		}
		else
		return null;
			
	}


}

?>