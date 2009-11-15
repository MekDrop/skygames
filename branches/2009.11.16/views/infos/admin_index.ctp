<div class="infos index">
<h2><?php __('Infos');?></h2>
<div class="actions">
<ul>
	<li><?php echo $html->link(__('New Info', true), array('action'=>'add')); ?></li>
	<!-- <li><?php echo $html->link(__('List Users', true), array('controller'=> 'users', 'action'=>'index')); ?>
	</li>
	<li><?php echo $html->link(__('New User', true), array('controller'=> 'users', 'action'=>'add')); ?>
	</li>
	<li><?php echo $html->link(__('List Infocats', true), array('controller'=> 'infocats', 'action'=>'index')); ?>
	</li>
	<li><?php echo $html->link(__('New Infocat', true), array('controller'=> 'infocats', 'action'=>'add')); ?>
	</li>
	<li><?php echo $html->link(__('List Langs', true), array('controller'=> 'langs', 'action'=>'index')); ?>
	</li>
	<li><?php echo $html->link(__('New Lang', true), array('controller'=> 'langs', 'action'=>'add')); ?>
	</li>
	<li><?php echo $html->link(__('List Games', true), array('controller'=> 'games', 'action'=>'index')); ?>
	</li>
	<li><?php echo $html->link(__('New Game', true), array('controller'=> 'games', 'action'=>'add')); ?>
	</li>
	<li><?php echo $html->link(__('List Infocomments', true), array('controller'=> 'infocomments', 'action'=>'index')); ?>
	</li>
	<li><?php echo $html->link(__('New Infocomment', true), array('controller'=> 'infocomments', 'action'=>'add')); ?> -->
	</li>
</ul>
</div>
<p><?php
echo $paginator->counter(array(
'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
));
?></p>
<table cellpadding="0" cellspacing="0" width="100%" style="width: 100%;">
	<tr>
		<th><?php echo $paginator->sort('id');?></th>
		<th><?php echo $paginator->sort('title');?></th>
		<!-- <th><?php echo $paginator->sort('desc');?></th> -->
		<!-- <th><?php echo $paginator->sort('body');?></th> -->
		<th><?php echo $paginator->sort('created');?></th>
		<th><?php echo $paginator->sort('modified');?></th>
		<th><?php echo $paginator->sort('user_id');?></th>
		<th><?php echo $paginator->sort('infocat_id');?></th>
		<th><?php echo $paginator->sort('lang_id');?></th>
		<th><?php echo $paginator->sort('game_id');?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($infos as $info):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
	?>
	<tr <?php echo $class;?>>
		<td><?php echo $info['Info']['id']; ?></td>
		<td><?php echo $info['Info']['title']; ?></td>
		<!-- <td><?php echo strip_tags(substr($info['Info']['desc'],0,64)); ?></td> -->
		<!-- <td><?php echo strip_tags(substr($info['Info']['body'],0,64)); ?></td> -->
		<td><?php echo $info['Info']['created']; ?></td>
		<td><?php echo $info['Info']['modified']; ?></td> 
		<td><?php echo $html->link($info['User']['name'], array('controller'=> 'users', 'action'=>'view', $info['User']['id'])); ?>
		</td>
		<td><?php echo $html->link($info['Infocat']['name'], array('controller'=> 'infocats', 'action'=>'view', $info['Infocat']['id'])); ?>
		</td>
		<td><?php echo $html->link($info['Lang']['name'], array('controller'=> 'langs', 'action'=>'view', $info['Lang']['id'])); ?>
		</td>
		<td><?php echo $html->link($info['Game']['name'], array('controller'=> 'games', 'action'=>'view', $info['Game']['id'])); ?>
		</td>
		<td class="actions"><?php echo $html->link(__('View', true), array('action'=>'view', $info['Info']['id'])); ?><br />
		<?php echo $html->link(__('Edit', true), array('action'=>'edit', $info['Info']['id'])); ?><br />
		<?php echo $html->link(__('Delete', true), array('action'=>'delete', $info['Info']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $info['Info']['id'])); ?>
		</td>
	</tr>
	<?php endforeach; ?>
</table>
</div>
<div class="paging"><?php echo $paginator->prev('<< '.__('previous', true), array(), null, array('class'=>'disabled'));?>
| <?php echo $paginator->numbers();?> <?php echo $paginator->next(__('next', true).' >>', array(), null, array('class'=>'disabled'));?>
</div>
