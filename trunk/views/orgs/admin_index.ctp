<div class="orgs index">
<h2><?php __('Orgs');?></h2>
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
	<th><?php echo $paginator->sort('user_id');?></th>
	<th><?php echo $paginator->sort('created');?></th>
	<th><?php echo $paginator->sort('website');?></th>
	<th><?php echo $paginator->sort('irc');?></th>
	<th><?php echo $paginator->sort('logo');?></th>
	<th><?php echo $paginator->sort('country_id');?></th>
	<th class="actions"><?php __('Actions');?></th>
</tr>
<?php
$i = 0;
foreach ($orgs as $org):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
?>
	<tr<?php echo $class;?>>
		<td>
			<?php echo $org['Org']['id']; ?>
		</td>
		<td>
			<?php echo $org['Org']['name']; ?>
		</td>
		<td>
			<?php echo $html->link($org['User']['name'], array('controller'=> 'users', 'action'=>'view', $org['User']['id'])); ?>
		</td>
		<td>
			<?php echo $org['Org']['created']; ?>
		</td>
		<td>
			<?php echo $org['Org']['website']; ?>
		</td>
		<td>
			<?php echo $org['Org']['irc']; ?>
		</td>
		<td>
			<?php echo $org['Org']['logo']; ?>
		</td>
		<td>
			<?php echo $org['Org']['country_id']; ?>
		</td>
		<td class="actions">
			<?php echo $html->link(__('View', true), array('action'=>'view', $org['Org']['id'])); ?>
			<?php echo $html->link(__('Edit', true), array('action'=>'edit', $org['Org']['id'])); ?>
			<?php echo $html->link(__('Delete', true), array('action'=>'delete', $org['Org']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $org['Org']['id'])); ?>
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
		<li><?php echo $html->link(__('New Org', true), array('action'=>'add')); ?></li>
		<li><?php echo $html->link(__('List Users', true), array('controller'=> 'users', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New User', true), array('controller'=> 'users', 'action'=>'add')); ?> </li>
		<li><?php echo $html->link(__('List Events', true), array('controller'=> 'events', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Event', true), array('controller'=> 'events', 'action'=>'add')); ?> </li>
	</ul>
</div>
