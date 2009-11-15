
<?php if (!$othAuth->sessionValid()): ?>
<div><?php echo $form->create('User',array('action'=>'login'));?>
<table cellspacing="0" cellpadding="0"
	style="width: 181px; height: 112px; vertical-align: top; text-align: center;"
	border="0">
	<tr>
		<td style="text-align: left" colspan="2"><font class="">&nbsp;&nbsp;&nbsp;<?php __('Username');?>:</font></td>
	</tr>
	<tr>
		<td style="height: 2px;" colspan="2"></td>
	</tr>
	<tr>
		<td style="text-align: left; vertical-align: top;" colspan="2">
		&nbsp;&nbsp; <?php echo $form->input('login', array("label"=>false,"class"=>"ivestis", "div"=>false)); ?>

		</td>
	</tr>
	<tr>
		<td style="height: 2px;" colspan="2"></td>
	</tr>
	<tr>
		<td style="text-align: left; vertical-align: top;" colspan="2"><font
			class="">&nbsp;&nbsp;&nbsp;<?php __('Password');?>:</font><br />
		</td>
	</tr>
	<tr>
		<td style="height: 2px;" colspan="2"></td>
	</tr>
	<tr>
		<td style="text-align: left; vertical-align: top;" colspan="2">
		&nbsp;&nbsp; <?php echo $form->input('passwd', array("label"=>false,"class"=>"ivestis", "div"=>false)); ?>

		</td>
	</tr>
	<tr>
		<td style="height: 5px;" colspan="2"></td>
	</tr>
	<tr>
		<td style="text-align: right; vertical-align: top; width: 56%;"><?php echo $form->submit(strtoupper(__('Submit', true)), array("class"=>"knopke", "div"=>false)); ?>
		</td>
		<td rowspan="3" style="text-align: center; vertical-align: middle;"><span
			style="font-size: 9px"><?php echo $html->link(__("Forgot your password?",true),array("controller" => "users", "action" => "reset")) ?></span>
		</td>
	</tr>
	<tr>
		<td style="height: 5px;"></td>
	</tr>
	<tr>
		<td style="text-align: right; vertical-align: top;">
			<?php echo $form->button(strtoupper(__('Register', true)), array("class"=>"knopke", "onclick"=>"window.location='" . $html->url(array('controller'=>'users', 'action'=>'register')) . "'")); ?>
		</td>
	</tr>
</table>
<?php echo $form->end();?></div>
<?php else: ?>
<?php
$user = $this->requestAction('users/loginbox/' . $othAuth->user('id'));
if (count($user['Team']) > 2)
{
	$more_teams = array_slice($user['Team'], 2);
	$user['Team'] = array_slice($user['Team'], 0, 2);
}
else
$more_teams = false;
?>

<script>
		function toggleMoreTeams()
		{
			$('divMoreTeams').toggle();
			$('divMoreTeamsButton').toggle();
		}
	</script>

<div class="list">
<table>
	<tr>
		<td style="width: 10px;"></td>
		<td><b><span style="background-color: #f5f5f5;"><?php echo $html->link($othAuth->user('username'), array('controller'=>'users', 'action'=>'view', $othAuth->user('id'))); ?>
		</span></b>| <?php echo $user["User"]["points"]; ?><br />
		<?php __('Last login') ?>:&nbsp;<?php echo substr($user["User"]["last_visit"],5); ?><br />

		<b>&raquo;</b> <?php echo $html->link(__('Edit my profile', true), array('controller'=>'users', 'action'=>'edit', $othAuth->user('id') ) ); ?>
		<br />
		
		<?php if($othAuth->group("level") == 200): ?> <b>&raquo;</b> <?php echo $html->link(__('Manage news', true), '/admin/infos/index', array("target"=>"_self")); ?>
		<br />
		<?php endif; ?>
		<?php if($othAuth->group("level") >= 300): ?> <b>&raquo;</b> <?php echo $html->link(__('Administrate', true), '/admin/infos/index', array("target"=>"_blank")); ?>
		<br />
		<?php endif; ?> <b>&raquo;</b> <?php echo $html->link(__('Logout', true), array('controller'=>'users', 'action'=>'logout')); ?>
		<br />
		<br />

		<?php foreach($user['Team'] as $index => $team):?> <b>&raquo;</b> <?php echo $html->link(__('Edit', true) .' '.$team['name'], array('controller'=>'teams', 'action'=>'edit', $team['id'])); ?>
		<br />
		<?php endforeach; ?> <?php foreach($user['Clan'] as $index => $team):?>

		<?php if ($team['Membership']['status'] == 'invited'): ?> <b>&raquo;</b>
		<?php echo $html->link(__('Accept invitation to', true) .' '.$team['name'], array('controller'=>'teams', 'action'=>'join', $team['id'])); ?>
		<br />
		<?php endif; ?> <?php endforeach; ?> <?php if ($more_teams): ?>
		<div id="divMoreTeamsButton"><b>&raquo;</b> <a
			href="javascript:toggleMoreTeams();"><?php __('Edit other teams'); ?></a>...</div>
		<div id="divMoreTeams" style="display: none"><b>&raquo;</b> <a
			href="javascript:toggleMoreTeams();"><?php __('Edit other teams'); ?></a>...
		<br />
		<?php foreach($more_teams as $team):?> <b>&raquo;</b> <?php echo $html->link($team['name'], array('controller'=>'teams', 'action'=>'edit', $team['id'])); ?>
		<br />
		<?php endforeach; ?></div>
		<?php endif; ?> <b>&raquo;</b> <?php echo $html->link(__('Add new team', true), array('controller'=>'teams', 'action'=>'add', $othAuth->user('id'))); ?>
		<br />
		<br />

		<!-- 												
					<?php foreach($user['Org'] as $index => $org):?>
						<b>&raquo;</b> <?php echo $html->link(__('Edit', true) .' '.$org['name'], array('controller'=>'orgs', 'action'=>'edit', $org['id'])); ?> <br/>				
					<?php endforeach; ?>
					 --> <?php if($othAuth->group("level") >= 150): ?> <b>&raquo;</b> <?php echo $html->link(__("Create event", true), array('controller'=> 'events', 'action'=>'add')); ?>
		<br />
		<?php endif; ?> <?php foreach($user['Organization'] as $index => $org):?>
		<?php if ($org['Staff']['position'] == 'headadmin'): ?> <b>&raquo;</b>
		<?php echo $html->link(__('Edit', true) .' '.$org['name'], array('controller'=>'orgs', 'action'=>'edit', $org['id'])); ?>
		<br />
		<?php endif; ?> <?php if ($org['Staff']['status'] == 'invited'): ?> <b>&raquo;</b>
		<?php echo $html->link(__('Accept invitation to', true) .' '.$org['name'], array('controller'=>'orgs', 'action'=>'join', $org['id'])); ?>
		<br />
		<?php endif; ?> <?php endforeach; ?></td>
	</tr>
</table>
</div>

		<?php endif; ?>


