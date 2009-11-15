<div class="teamplayers index">
<h2><?php __('Teamplayers');?></h2>
<p>
<?php
echo $paginator->counter(array(
'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
));
?></p>
<table cellpadding="0" cellspacing="0">
<tr>
	<th><?php echo $paginator->sort('id');?></th>
	<th><?php echo $paginator->sort('name');?></th>
	<th><?php echo $paginator->sort('mail');?></th>
	<th><?php echo $paginator->sort('skype');?></th>
	<th><?php echo $paginator->sort('uniqueid');?></th>
	<th><?php echo $paginator->sort('team_id');?></th>
	<th class="actions"><?php __('Actions');?></th>
</tr>
<?php
$i = 0;
foreach ($teamplayers as $teamplayer):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
?>
	<tr<?php echo $class;?>>
		<td>
			<?php echo $teamplayer['Teamplayer']['id']; ?>
		</td>
		<td>
			<?php echo $teamplayer['Teamplayer']['name']; ?>
		</td>
		<td>
			<?php echo $teamplayer['Teamplayer']['mail']; ?>
		</td>
		<td>
			<?php echo $teamplayer['Teamplayer']['skype']; ?>
		</td>
		<td>
			<?php echo $teamplayer['Teamplayer']['uniqueid']; ?>
		</td>
		<td>
			<?php echo $html->link($teamplayer['Team']['name'], array('controller'=> 'teams', 'action'=>'view', $teamplayer['Team']['id'])); ?>
		</td>
		<td class="actions">
			<?php echo $html->link(__('View', true), array('action'=>'view', $teamplayer['Teamplayer']['id'])); ?>
			<?php echo $html->link(__('Edit', true), array('action'=>'edit', $teamplayer['Teamplayer']['id'])); ?>
			<?php echo $html->link(__('Delete', true), array('action'=>'delete', $teamplayer['Teamplayer']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $teamplayer['Teamplayer']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
</table>
</div>
<div class="paging">
	<?php echo $paginator->prev('<< '.__('previous', true), array(), null, array('class'=>'disabled'));?>
 | 	<?php echo $paginator->numbers();?>
	<?php echo $paginator->next(__('next', true).' >>', array(), null, array('class'=>'disabled'));?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('New Teamplayer', true), array('action'=>'add')); ?></li>
		<li><?php echo $html->link(__('List Teams', true), array('controller'=> 'teams', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Team', true), array('controller'=> 'teams', 'action'=>'add')); ?> </li>
	</ul>
</div>
