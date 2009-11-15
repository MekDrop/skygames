<table class="list">
	<tr>
		<td class="contentheading" width="100%"><?php __('Choose team'); ?></td>


	</tr>
</table>
<table class="list">
	<tr>
		<td valign="top">
		<div class="choose team">

		<ul>
		<?php foreach($teams as $team):?>
			<li><?php echo $html->link(__('Sign up', true) .' '.$team['Team']['name'], array('controller'=>'events', 'action'=>'sign', $id, $team['Team']['id'])); ?>
			</li>
			<?php endforeach; ?>
			<br />
		</ul>

		</div>

		</td>
	</tr>
</table>

