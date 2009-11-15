<table align="left" cellspacing="0" cellpadding="0" class="meniuivestis">
	<tr>
		<td class="meniubg1"></td>
		<td class="meniukaire"><?php
		$menus = $this->requestAction('menus/index');
		$mpart[0] = array_slice($menus, 0, 3);
		$mpart[1] = array_slice($menus, 3);
			
		foreach($mpart[0] as $menu):
		?> <?php
		echo $html->link(strtoupper(__($menu['Menu']['title'], true)),  $menu['Menu']['link']);
		//$html->link(__('New Group', true), array('action'=>'add'));
		?>&nbsp;&nbsp;&nbsp;&nbsp; <?php
		endforeach;
		?></td>
		<td class="desinysmeniu"><?php
		foreach($mpart[1] as $menu):
		?> <?php
		echo $html->link(strtoupper(__($menu['Menu']['title'], true)),  $menu['Menu']['link']);
		//$html->link(__('New Group', true), array('action'=>'add'));
		?>&nbsp;&nbsp;&nbsp;&nbsp; <?php
		endforeach;
		?></td>
	</tr>
</table>
